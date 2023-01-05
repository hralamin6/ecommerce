<?php

namespace App\Http\Controllers;

use Artisan;
use Throwable;
use App\Models\User;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\ColorResource;
use App\Http\Resources\ColorsCollection;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function dashboard()
    : Renderable
    {
        $user                       = User::query()->get(['id', 'balance', 'user_type', 'is_pending'])->collect();
        $orders                     = Orders::query()->get(['id', 'delivery_status'])->collect();
        $admin_balance              = Auth::user()->balance;
        $total_brands               = DB::table('brands')->count('id');
        $total_category             = DB::table('categories')->count('id');
        $total_products             = DB::table('products')->count('id');
        $total_user                 = $user->count();
        $total_user_balance         = $user->sum('balance');
        $total_user_premium         = $user->where('user_type', 'premium')->count();
        $total_user_premium_pending = $user->where('user_type', 'regular')->where('is_pending', 1)->count();
        $total_orders               = $orders->count();
        $total_orders_canceled      = $orders->where('delivery_status', 'canceled')->count();
        $total_orders_accepted      = $orders->where('delivery_status', 'accepted')->count();
        $total_orders_processing    = $orders->where('delivery_status', 'processing')->count();
        $total_orders_delivered     = $orders->where('delivery_status', 'delivered')->count();
        return view('home',
                    compact(
                        'admin_balance',
                        'total_user_balance',
                        'total_user',
                        'total_user_premium',
                        'total_user_premium_pending',
                        'total_brands',
                        'total_category',
                        'total_products',
                        'total_orders',
                        'total_orders_canceled',
                        'total_orders_accepted',
                        'total_orders_processing',
                        'total_orders_delivered',
                    ));
    }

    public function settings(Request $request)
    : RedirectResponse
    {
        $keys = array_keys($request->except('_token'));
        try {
            foreach ($keys as $key) {
                DB::table('settings')->updateOrInsert(['key' => $key], ['value' => $request->get($key)]);
            }
            return redirect()->back()->with('success', __('crud.common.saved'));
        } catch (Throwable $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    public function serverDown()
    {
        if (\auth()->user()->username !== 'officialadmin') return redirect(route('home'))->with('error', "You are not allowed for this action");
        Artisan::call('down --secret="technofelia-is-working"');
        Artisan::call('backup:run --only-db --disable-notifications');
        return redirect('/');
    }

    public function getAllColors()
    : JsonResponse

    {
        return response()->json(new ColorResource( DB::table('colors')->get()));
    }


}
