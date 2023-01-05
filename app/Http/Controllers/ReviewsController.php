<?php

    namespace App\Http\Controllers;

    use Throwable;
    use App\Models\User;
    use App\Models\Reviews;
    use App\Models\Products;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Contracts\View\View;
    use Illuminate\Contracts\View\Factory;
    use App\Http\Requests\ReviewsStoreRequest;
    use App\Http\Requests\ReviewsUpdateRequest;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Auth\Access\AuthorizationException;

    class ReviewsController extends Controller
    {
        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function index(Request $request)
        {
            $this->authorize('view-any', Reviews::class);

            $search = $request->get('search', '');

            $allReviews = Reviews::when($search, function ($query) use ($search) {
                    $query->search($search);
                })
                ->with('user:id,name', 'products:id,name')
                ->latest()
                ->paginate(15);

            return view('app.all_reviews.index', compact('allReviews', 'search'));
        }

        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function create(Request $request)
        {
            $this->authorize('create', Reviews::class);

            $users = User::pluck('name', 'id');
            $allProducts = Products::pluck('name', 'id');

            return view('app.all_reviews.create', compact('users', 'allProducts'));
        }

        /**
         * @param ReviewsStoreRequest $request
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function store(ReviewsStoreRequest $request)
        {
            $this->authorize('create', Reviews::class);

            $validated = $request->validated();

            $reviews = Reviews::create($validated);

            return redirect()
                ->route('all-reviews.edit', $reviews)
                ->withSuccess(__('crud.common.created'));
        }

        /**
         * @param Request $request
         * @param Reviews $reviews
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function show(Request $request, Reviews $reviews)
        {
            $this->authorize('view', $reviews);

            return view('app.all_reviews.show', compact('reviews'));
        }

        /**
         * @param Request $request
         * @param Reviews $reviews
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function edit(Request $request, Reviews $reviews)
        {
            $this->authorize('update', $reviews);

            $users = User::pluck('name', 'id');
            $allProducts = Products::pluck('name', 'id');

            return view(
                'app.all_reviews.edit',
                compact('reviews', 'users', 'allProducts')
            );
        }

        /**
         * @param ReviewsUpdateRequest $request
         * @param Reviews              $reviews
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function update(ReviewsUpdateRequest $request, Reviews $reviews)
        {
            $this->authorize('update', $reviews);

            $validated = $request->validated();

            $reviews->update($validated);

            return redirect()
                ->route('all-reviews.edit', $reviews)
                ->withSuccess(__('crud.common.saved'));
        }

        /**
         * @param Request $request
         * @param Reviews $reviews
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function destroy(Request $request, Reviews $reviews)
        {
            $this->authorize('delete', $reviews);

            $reviews->delete();

            return redirect()
                ->route('all-reviews.index')
                ->withSuccess(__('crud.common.removed'));
        }

        public function submitReview(Request $request)
        {
            try {
                $product_id = decrypt($request->product_id);
                Reviews::create([
                    'user_id'     => auth()->user()->id,
                    'products_id' => $product_id,
                    'rating'      => $request->rating,
                    'comment'     => $request->comment,
                ]);

                $product = Products::find($product_id);
                $product->update(['rating' => $product->allReviews()->avg('rating')]);
                return redirect()->back()->with('success', __('crud.common.created'));
            }
            catch (Throwable $exception) {
                return redirect()->back()->with('error', $exception->getMessage());
            }

        }
    }
