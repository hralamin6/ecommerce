<?php

    namespace App\Http\Controllers;

    use App\Models\Banners;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Contracts\View\View;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Support\Facades\Storage;
    use App\Http\Requests\BannersStoreRequest;
    use App\Http\Requests\BannersUpdateRequest;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Auth\Access\AuthorizationException;

    class BannersController extends Controller
    {
        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function index(Request $request)
        {
            $this->authorize('view-any', Banners::class);

            $search = $request->get('search', '');

            $allBanners = Banners::query()
                ->when($search, function ($query) use ($search) {
                    $query->search($search);
                })
                ->latest()
                ->paginate(15);

            return view('app.all_banners.index', compact('allBanners', 'search'));
        }

        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function create(Request $request)
        {
            $this->authorize('create', Banners::class);

            return view('app.all_banners.create');
        }

        /**
         * @param BannersStoreRequest $request
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function store(BannersStoreRequest $request)
        {
            $this->authorize('create', Banners::class);

            $validated = $request->validated();
            if ($request->hasFile('photo')) {
                $validated['photo'] = $request->file('photo')->store('banners');
            }

            $banners = Banners::create($validated);

            return redirect()
                ->route('all-banners.edit', $banners)
                ->withSuccess(__('crud.common.created'));
        }

        /**
         * @param Request $request
         * @param Banners $banners
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function show(Request $request, Banners $banners)
        {
            $this->authorize('view', $banners);

            return view('app.all_banners.show', compact('banners'));
        }

        /**
         * @param Request $request
         * @param Banners $banners
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function edit(Request $request, Banners $banners)
        {
            $this->authorize('update', $banners);

            return view('app.all_banners.edit', compact('banners'));
        }

        /**
         * @param BannersUpdateRequest $request
         * @param Banners              $banners
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function update(BannersUpdateRequest $request, Banners $banners)
        {
            $this->authorize('update', $banners);

            $validated = $request->validated();

            if ($request->hasFile('photo')) {
                if ($banners->photo) {
                    Storage::delete($banners->photo);
                }

                $validated['photo'] = $request->file('photo')->store('banners');
            }

            $banners->update($validated);

            return redirect()
                ->route('all-banners.edit', $banners)
                ->withSuccess(__('crud.common.saved'));
        }

        /**
         * @param Request $request
         * @param Banners $banners
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function destroy(Request $request, Banners $banners)
        {
            $this->authorize('delete', $banners);

            if ($banners->photo) {
                Storage::delete($banners->photo);
            }

            $banners->delete();

            return redirect()
                ->route('all-banners.index')
                ->withSuccess(__('crud.common.removed'));
        }
    }
