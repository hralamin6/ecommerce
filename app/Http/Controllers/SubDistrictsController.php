<?php

    namespace App\Http\Controllers;

    use App\Models\Districts;
    use App\Models\SubDistricts;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Contracts\View\View;
    use Illuminate\Contracts\View\Factory;
    use App\Http\Requests\SubDistrictsStoreRequest;
    use App\Http\Requests\SubDistrictsUpdateRequest;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Auth\Access\AuthorizationException;

    class SubDistrictsController extends Controller
    {
        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function index(Request $request)
        {
            $this->authorize('view-any', SubDistricts::class);

            $search = $request->get('search', '');
            $allDistricts = Districts::pluck('name', 'id');
            $allSubDistricts = SubDistricts::when($search, function ($query) use ($search) {
                $query->search($search);
            })
                ->orderBy('name')
                ->with('districts')
                ->latest()
                ->paginate(20);

            return view(
                'app.all_sub_districts.index',
                compact('allSubDistricts', 'search', 'allDistricts')
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
            $this->authorize('create', SubDistricts::class);

            $allDistricts = Districts::pluck('name', 'id');

            return view('app.all_sub_districts.create', compact('allDistricts'));
        }

        /**
         * @param SubDistrictsStoreRequest $request
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function store(SubDistrictsStoreRequest $request)
        {
            $this->authorize('create', SubDistricts::class);

            $validated = $request->validated();

            $subDistricts = SubDistricts::create($validated);

            return redirect()
                ->route('all-sub-districts.edit', $subDistricts)
                ->withSuccess(__('crud.common.created'));
        }

        /**
         * @param Request      $request
         * @param SubDistricts $subDistricts
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function show(Request $request, SubDistricts $subDistricts)
        {
            $this->authorize('view', $subDistricts);

            return view('app.all_sub_districts.show', compact('subDistricts'));
        }

        /**
         * @param Request      $request
         * @param SubDistricts $subDistricts
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function edit(Request $request, SubDistricts $subDistricts)
        {
            $this->authorize('update', $subDistricts);

            $allDistricts = Districts::pluck('name', 'id');

            return view(
                'app.all_sub_districts.edit',
                compact('subDistricts', 'allDistricts')
            );
        }

        /**
         * @param SubDistrictsUpdateRequest $request
         * @param SubDistricts              $subDistricts
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function update(
            SubDistrictsUpdateRequest $request,
            SubDistricts $subDistricts
        )
        {
            $this->authorize('update', $subDistricts);

            $validated = $request->validated();

            $subDistricts->update($validated);

            return redirect()
                ->route('all-sub-districts.edit', $subDistricts)
                ->withSuccess(__('crud.common.saved'));
        }

        /**
         * @param Request      $request
         * @param SubDistricts $subDistricts
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function destroy(Request $request, SubDistricts $subDistricts)
        {
            $this->authorize('delete', $subDistricts);

            $subDistricts->delete();

            return redirect()
                ->route('all-sub-districts.index')
                ->withSuccess(__('crud.common.removed'));
        }
    }
