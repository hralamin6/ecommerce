<?php

    namespace App\Http\Controllers;

    use App\Models\Districts;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Contracts\View\View;
    use Illuminate\Contracts\View\Factory;
    use App\Http\Requests\DistrictsStoreRequest;
    use App\Http\Requests\DistrictsUpdateRequest;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Auth\Access\AuthorizationException;

    class DistrictsController extends Controller
    {
        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function index(Request $request)
        {
            $this->authorize('view-any', Districts::class);

            $search = $request->get('search', '');

            $allDistricts = Districts::when($search, function ($query) use ($search) {
                    $query->search($search);
                })
                ->latest()
                ->paginate(20);

            return view(
                'app.all_districts.index',
                compact('allDistricts', 'search')
            );
        }

        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function create(Request $request)
        {
            $this->authorize('create', Districts::class);

            return view('app.all_districts.create');
        }

        /**
         * @param DistrictsStoreRequest $request
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function store(DistrictsStoreRequest $request)
        {
            $this->authorize('create', Districts::class);

            $validated = $request->validated();

            $districts = Districts::create($validated);

            return redirect()
                ->route('all-districts.index')
                ->withSuccess(__('crud.common.created'));
        }

        /**
         * @param Request   $request
         * @param Districts $districts
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function show(Request $request, Districts $districts)
        {
            $this->authorize('view', $districts);

            return view('app.all_districts.show', compact('districts'));
        }

        /**
         * @param Request   $request
         * @param Districts $districts
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function edit(Request $request, Districts $districts)
        {
            $this->authorize('update', $districts);

            return view('app.all_districts.edit', compact('districts'));
        }

        /**
         * @param DistrictsUpdateRequest $request
         * @param Districts              $districts
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function update(
            DistrictsUpdateRequest $request,
            Districts $districts
        )
        {
            $this->authorize('update', $districts);

            $validated = $request->validated();

            $districts->update($validated);

            return redirect()
                ->route('all-districts.edit', $districts)
                ->withSuccess(__('crud.common.saved'));
        }

        /**
         * @param Request   $request
         * @param Districts $districts
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function destroy(Request $request, Districts $districts)
        {
            $this->authorize('delete', $districts);

            $districts->delete();

            return redirect()
                ->route('all-districts.index')
                ->withSuccess(__('crud.common.removed'));
        }
    }
