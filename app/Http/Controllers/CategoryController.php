<?php

    namespace App\Http\Controllers;

    use App\Models\Category;
    use Illuminate\Support\Str;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Contracts\View\View;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Support\Facades\Storage;
    use App\Http\Requests\CategoryStoreRequest;
    use App\Http\Requests\CategoryUpdateRequest;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Auth\Access\AuthorizationException;

    class CategoryController extends Controller
    {
        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function index(Request $request)
        {
            $this->authorize('view-any', Category::class);

            $search = $request->get('search', '');

            $categories = Category::when($search, function ($query) use ($search) {
                $query->search($search);
            })
                ->with('category:id,category_id,name')
                ->latest()
                ->simplePaginate(15);

            return view('app.categories.index', compact('categories', 'search'));
        }

        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function create(Request $request)
        {
            $this->authorize('create', Category::class);
            $categories = Category::whereStatus(true)->where('category_id', 0)->pluck('name', 'id');
            return view('app.categories.create', compact('categories'));
        }

        /**
         * @param CategoryStoreRequest $request
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function store(CategoryStoreRequest $request)
        {
            $this->authorize('create', Category::class);

            $validated = $request->validated();
            if ($request->hasFile('banner')) {
                $validated['banner'] = $request->file('banner')->store('categories');
            }

            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('categories');
            }
            $validated['slug'] = Str::slug($validated['name']);
            $category = Category::create($validated);

            return redirect()
                ->route('categories.edit', $category)
                ->withSuccess(__('crud.common.created'));
        }

        /**
         * @param Request  $request
         * @param Category $category
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function show(Request $request, Category $category)
        {
            $this->authorize('view', $category);

            return view('app.categories.show', compact('category'));
        }

        /**
         * @param Request  $request
         * @param Category $category
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function edit(Request $request, Category $category)
        {
            $this->authorize('update', $category);
            $categories = Category::whereStatus(true)->where('category_id', 0)->pluck('name', 'id');
            return view('app.categories.edit', compact('category', 'categories'));
        }

        /**
         * @param CategoryUpdateRequest $request
         * @param Category              $category
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function update(CategoryUpdateRequest $request, Category $category)
        {
            $this->authorize('update', $category);

            $validated = $request->validated();

            if ($request->hasFile('banner')) {
                if ($category->banner) {
                    Storage::delete($category->banner);
                }

                $validated['banner'] = $request->file('banner')->store('categories');
            }

            if ($request->hasFile('image')) {
                if ($category->image) {
                    Storage::delete($category->image);
                }

                $validated['image'] = $request->file('image')->store('categories');
            }

            $category->update($validated);

            return redirect()
                ->route('categories.edit', $category)
                ->withSuccess(__('crud.common.saved'));
        }

        /**
         * @param Request  $request
         * @param Category $category
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function destroy(Request $request, Category $category)
        {
            $this->authorize('delete', $category);

            if ($category->banner) {
                Storage::delete($category->banner);
            }

            if ($category->image) {
                Storage::delete($category->image);
            }

            $category->delete();

            return redirect()
                ->route('categories.index')
                ->withSuccess(__('crud.common.removed'));
        }
    }
