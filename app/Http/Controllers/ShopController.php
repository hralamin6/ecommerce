<?php

    namespace App\Http\Controllers;

    use Throwable;
    use App\Helper;
    use Carbon\Carbon;
    use App\Models\User;
    use App\Models\Category;
    use App\Models\Products;
    use App\Rules\isBlocked;
    use App\Models\Wishlists;
    use App\Rules\spaceCheck;
    use Illuminate\Http\Request;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Auth\Events\Registered;

    class ShopController extends Controller
    {
        public function index(Request $request)
        {
            $search = $request->get('search', '');
            if ($search) {
                $categories = Category::when($search, function ($query) use ($search) {
                    $query->search($search);
                })->where('status', 1)->latest()->limit(3)->get();
                $products = Products::when($search, function ($query) use ($search) {
                    $query->search($search);
                })->whereStatus(1)->latest()->paginate(20);
                return view('web.pages.shop.all-products', compact('categories', 'products'));
            }

            $sliders = DB::table('sliders')->latest('updated_at')->whereStatus(1)->limit(3)->get();
            $products = collect(Products::query()->latest('updated_at')->with('allReviews')->whereStatus(1)->limit(100)->get());
            $flash_sale = $products->where('is_flash', 1)->take(10)->all();
            $feature_products = $products->where('is_feature', 1)->take(8)->all();
            $top_products = $products->sortBy('total_sale')->take(8)->all();
            $weeklySale = $products->whereBetween('updated_at', [Carbon::now()->subWeek(), Carbon::now()])->sortByDesc('total_sale')->take(6)->all();
            $home_banner = DB::table('banners')->latest('updated_at')->where('status', 1)->orderBy('position')->limit(1)->get();
            $coupon = DB::table('coupons')->latest('updated_at')->whereDate('end', '>', Carbon::now())->first();

            return view('web.pages.shop.home', compact(
                'coupon',
                'home_banner',
                'flash_sale',
                'feature_products',
                'sliders',
                'top_products',
                'weeklySale',
            ));

        }

        public function all_category()
        {
            $categories = Category::query()->where('status', 1)->latest()->get();
            return view('web.pages.shop.all-category', compact('categories'));
        }

        public function all_products()
        {
            $categories = Category::query()->where('status', 1)->latest()->limit(3)->get();
            $products = Products::query()->where('status', 1)->latest()->paginate(20);
            return view('web.pages.shop.all-products', compact('categories', 'products'));
        }


        public function single_category()
        {
            $category = Category::whereSlug(request('category'))
                ->with([
                    'allProducts:id,category_id,name,slug,thumbnail_img,sale_price,point,discount,discount_type',
                    'sub_categories:id,category_id,name,image,slug'
                ])
                ->first();
            return view('web.pages.shop.category', compact('category'));
        }

        public function single_product($product)
        {
            $product = Products::query()->where('slug', $product)->with('category:id,name,slug')->with('allReviews')->first();
            return view('web.pages.shop.single-product', compact('product'));
        }

        public function addToWishlist($id): JsonResponse
        {
            try {
                if (auth()->check()) {
                    $hasList = \auth()->user()->allWishlists()->where('products_id', $id)->count();
                    $count = \auth()->user()->allWishlists()->count();
                    if (!$hasList) {
                        \auth()->user()->allWishlists()->create(['products_id' => $id]);
                        $count = \auth()->user()->allWishlists()->count();
                        return response()->json(['message' => "Successfully added to wishlist", 'count' => $count]);
                    }
                    return response()->json(['message' => "Already in wishlist", 'count' => $count]);
                }
                return response()->json(['message' => 'Please login to use this feature.', 'count' => 0]);
            }
            catch (Throwable $exception) {
                return response()->json(['message' => $exception->getMessage(), 'count' => 0]);
            }

        }

        public function getWishlist()
        {
            $wishlists = Wishlists::query()->with('products:id,name,slug,thumbnail_img,point,rating')->where('user_id', auth()->user()->id)->get();
            return view('web.pages.user.wishlist', compact('wishlists'));
        }

        public function removeFromWishlist($id): JsonResponse
        {
            \auth()->user()->allWishlists()->where('products_id', $id)->delete();
            $wishlists = \auth()->user()->allWishlists()->with('products:id,name,slug,thumbnail_img,point,rating')->get();
            return response()->json(['view' => view('web.partials.wishlist', compact('wishlists'))->render(), 'count' => count($wishlists)]);
        }


        /**
         * Customer login
         *
         * @param Request $request
         *
         * @return RedirectResponse
         */
        public function customer_login(Request $request): RedirectResponse
        {
            $request->validate([
                'username' => ['required','string', new isBlocked()],
                'password' => 'required|string',
            ]);
            $credentials = ['username' => strtolower($request->username), 'password' => $request->password];

            if (Auth::attempt($credentials)) {
                $rank = Helper::generateRank ();
                \auth ()->user ()->update(['rank'=>$rank]);
                return redirect()->route('shop');
            }

            return redirect()->route('b2e.login')->with('error', __('auth.failed'));
        }

        /**
         * Customer register
         *
         * @param Request $request
         *
         * @return RedirectResponse
         */
        public function customer_register(Request $request): RedirectResponse
        {

            $request->validate([
                "username" => ['required', 'alpha_num', 'unique:users,username', new spaceCheck()],
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);
            $user = User::create([
                'name'      => $request->name,
                'username'  => strtolower($request->username),
                'email'     => $request->email,
                'user_type' => 'regular',
                'password'  => Hash::make($request->password),
            ]);
            event(new Registered($user));
            Auth::guard()->login($user);
            return redirect()->route('shop');
        }


    }
