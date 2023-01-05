<?php

    namespace App\Http\Controllers;

    use App\Models\Brand;
    use Illuminate\Support\Str;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Contracts\View\View;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Support\Facades\Storage;
    use App\Http\Requests\BrandStoreRequest;
    use App\Http\Requests\BrandUpdateRequest;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Auth\Access\AuthorizationException;

    class BrandController extends Controller
    {
        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function index(Request $request)
        {
            $this->authorize('view-any', Brand::class);

            $search = $request->get('search', '');

            $brands = Brand::query()
                ->when($search, function ($query) use ($search) {
                    $query->search($search);
                })
                ->latest()
                ->paginate(15);

            return view('app.brands.index', compact('brands', 'search'));
        }

        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function create(Request $request)
        {
            $this->authorize('create', Brand::class);

            return view('app.brands.create');
        }

        /**
         * @param BrandStoreRequest $request
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function store(BrandStoreRequest $request)
        {
            $this->authorize('create', Brand::class);

            $validated = $request->validated();
            if ($request->hasFile('logo')) {
                $validated['logo'] = $request->file('logo')->store('public');
            }
            $validated['slug'] = Str::slug($validated['name']);
            $brand = Brand::create($validated);

            return redirect()
                ->route('brands.edit', $brand)
                ->withSuccess(__('crud.common.created'));
        }

        /**
         * @param Request $request
         * @param Brand   $brand
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function show(Request $request, Brand $brand)
        {
            $this->authorize('view', $brand);

            return view('app.brands.show', compact('brand'));
        }

        /**
         * @param Request $request
         * @param Brand   $brand
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function edit(Request $request, Brand $brand)
        {
            $this->authorize('update', $brand);

            return view('app.brands.edit', compact('brand'));
        }

        /**
         * @param BrandUpdateRequest $request
         * @param Brand              $brand
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function update(BrandUpdateRequest $request, Brand $brand)
        {
            $this->authorize('update', $brand);

            $validated = $request->validated();

            if ($request->hasFile('logo')) {
                if ($brand->logo) {
                    Storage::delete($brand->logo);
                }

                $validated['logo'] = $request->file('logo')->store('public');
            }

            $brand->update($validated);

            return redirect()
                ->route('brands.edit', $brand)
                ->withSuccess(__('crud.common.saved'));
        }

        /**
         * @param Request $request
         * @param Brand   $brand
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function destroy(Request $request, Brand $brand)
        {
            $this->authorize('delete', $brand);

            if ($brand->logo) {
                Storage::delete($brand->logo);
            }

            $brand->delete();

            return redirect()
                ->route('brands.index')
                ->withSuccess(__('crud.common.removed'));
        }
    }
