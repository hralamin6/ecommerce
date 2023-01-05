<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Throwable;
use App\Helper;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SubDistricts;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Doctrine\DBAL\Query\QueryException;


class CheckoutController extends Controller
{

    public function getSubDistrict (Request $request): JsonResponse
    {
        $subDistricts = SubDistricts::whereDistrictId ($request->district)
            ->whereStatus (0)
            ->orderBy ('name', 'asc')
            ->pluck ('name', 'id');
        return response ()->json ($subDistricts);
    }

    public function checkout (Request $request)
    {

        $sum = Helper::getCartTotal ();

        if ($sum['count'] === 0) return redirect (route ('shop.cart'))->with ('error', "Cart is empty");

        $total = Session::has ('coupon_discount') ? round (Session::get ('coupon_discount'), 0, PHP_ROUND_HALF_UP) : $sum['total'];
        $data['delivery_inside_dhaka'] = Setting::where('key', 'inside_dhaka')->first()->value;
        $data['delivery_outside_dhaka'] = Setting::where('key', 'outside_dhaka')->first()->value;
        $data['delivery_time_outside_dhaka'] = Setting::where('key', 'delivery_time_outside_dhaka')->first()->value;
        $data['delivery_time_inside_dhaka'] = Setting::where('key', 'delivery_time_inside_dhaka')->first()->value;
        return view ('web.pages.checkout.checkout', compact ('total', 'data'));

    }

    /**
     * @throws Throwable
     */
    public function confirm (Request $request)
    {
        $request->validate ([
            'agreement'        => 'required',
            'name'             => 'required|string',
            'phone'            => 'required|string',
            'delivery_address' => 'required|string',
            'payment_type'     => 'required|in:0,1,2,3',
            'district'         => 'required|exists:districts,name',
            'sub_district'     => 'required|exists:sub_districts,name',
        ]);
        $carts = Helper::getCartTotal ();
        // true = 'Dhaka' & false = 'Others'
        $settings = collect (DB::table ('settings')->get ());
        $inside_dhaka = optional ($settings->where ('key', 'inside_dhaka')->first ())->value;
        $outside_dhaka = optional ($settings->where ('key', 'outside_dhaka')->first ())->value;
        $shipping = strtolower($request->district) == 'dhaka' ? $inside_dhaka : $outside_dhaka;
        $roundDiscountTotal = round (Session::get ('coupon_discount'), 0, PHP_ROUND_HALF_UP);
        $grandTotal = ($roundDiscountTotal > 0 ? $roundDiscountTotal : $carts['total']) + $shipping;

        if (auth ()->check () && auth ()->user ()->isPremium ()) {
            // 1 = point & 2 = balance
            if ($request->payment_type == 1 && auth ()->user ()->point < $grandTotal) return back ()->with ('error', "Insufficient Balance!");
            if ($request->payment_type == 2 && auth ()->user ()->balance < $grandTotal) return back ()->with ('error', "Insufficient Balance!");
        }
        switch ($request->payment_type) {
            case "1":
                $payment_type = 'shopping balance';
                break;
            case "2":
                $payment_type = 'income balance';
                break;
            case "3":
                if (Str::length ($request->payment_from) < 10 || Str::length ($request->trx) < 4) return back ()->with ('error', "Invalid payment information")->withInput ();
                $payment_type = 'mobile banking';
                break;
            default:
                $payment_type = "cash on delivery";
        }
        $coupon_discount = $roundDiscountTotal > 0 ? $carts['total'] - $roundDiscountTotal : 0;
        $shipping_districts = (isset($request->postal_code)) ? "$request->sub_district, $request->district-$request->postal_code" : "$request->sub_district, $request->district";
        DB::beginTransaction ();
        try {
            $order = new Orders();
            $order->code = uniqid ('b2e');
            $order->user_id = auth ()->user () ? auth ()->user ()->id : 0;
            $order->shipping_address = "$request->name , <br/>$request->phone , <br/>$request->delivery_address, <br> $shipping_districts";
            $order->shipping_cost = $shipping;
            $order->delivery_status = 'ordered';
            $order->payment_type = $payment_type;
            $order->payment_status = (in_array ($request->payment_type, [ 1, 2 ])) ? 'paid' : 'unpaid';
            $order->grand_total = $grandTotal;
            $order->coupon_discount = $coupon_discount;
            $order->shipping_cost = $shipping;
            $order->shipping_district = $request->district;
            $order->payment_number = $request->payment_from;
            $order->trx = $request->trx;
            $order->save ();
            foreach ($carts['cart'] as $item) $order->allOrderDetails ()->create (collect ($item)->toArray ());
            if (auth ()->check () && in_array ($request->payment_type, [ 1, 2 ])) {
                if (auth ()->user ()->isPremium () || auth ()->user ()->isAdmin ()) {
                    if ($request->payment_type == 1) {
                        auth ()->user ()->decrement ('point', $grandTotal);
                        auth ()->user ()->transactions ()->create ([
                            'type'   => 'shop expense',
                            'amount' => $grandTotal,
                            'note'   => __ ('bonus.expense.shop_expense', [ 'code' => $order->code ]),
                        ]);
                        $order->update ([ 'payment_status' => 'paid' ]);
                    }
                    if ($request->payment_type == 2) {
                        auth ()->user ()->decrement ('balance', $grandTotal);
                        auth ()->user ()->transactions ()->create ([
                            'type'   => 'income expense',
                            'amount' => $grandTotal,
                            'note'   => __ ('bonus.expense.income_expense', [ 'code' => $order->code ]),
                        ]);
                        $order->update ([ 'payment_status' => 'paid' ]);
                    }
                    Helper::giveBonusToUsers ($order);
                }
                Cart::query ()->where ('user_id', auth ()->user ()->id)->delete ();
            }
            Cart::query ()->where ('temp_id', $request->session ()->get ('temp_id'))->delete ();
            $request->session ()->forget ([ 'temp_id', 'coupon_discount' ]);
            DB::commit ();
            return redirect ()->route ('shop')->with ('code', $order->code);
        } catch (QueryException $exception) {
            DB::rollBack ();
            return back ()->with ('error', $exception->getMessage ())->withInput ();
        }
    }
}
