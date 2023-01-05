<?php

    namespace App\Http\Controllers;

    use App\Models\Work;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Contracts\View\View;
    use Illuminate\Contracts\View\Factory;
    use App\Http\Requests\WorkStoreRequest;
    use App\Http\Requests\WorkUpdateRequest;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Auth\Access\AuthorizationException;

    class WorkController extends Controller
    {
        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function index(Request $request)
        {
            $this->authorize('view-any', Work::class);

            $search = $request->get('search', '');

            $works = Work::when($search, function ($query) use ($search) {
                    $query->search($search);
                })
                ->latest()
                ->paginate(5);

            return view('app.works.index', compact('works', 'search'));
        }

        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function create(Request $request)
        {
            $this->authorize('create', Work::class);

            return view('app.works.create');
        }

        /**
         * @param WorkStoreRequest $request
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function store(WorkStoreRequest $request)
        {
            $this->authorize('create', Work::class);

            $validated = $request->validated();

            if ($request->hasFile('file')) {
                $validated['file'] = $request->file('file')->store('works');
            }

            $work = Work::create($validated);

            return redirect()
                ->route('works.edit', $work)
                ->withSuccess(__('crud.common.created'));
        }

        /**
         * @param Request $request
         * @param Work    $work
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function show(Request $request, Work $work)
        {
            $this->authorize('view', $work);

            return view('app.works.show', compact('work'));
        }

        /**
         * @param Request $request
         * @param Work    $work
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function edit(Request $request, Work $work)
        {
            $this->authorize('update', $work);

            return view('app.works.edit', compact('work'));
        }

        /**
         * @param WorkUpdateRequest $request
         * @param Work              $work
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function update(WorkUpdateRequest $request, Work $work)
        {
            $this->authorize('update', $work);

            $validated = $request->validated();

            $work->update($validated);

            return redirect()
                ->route('works.edit', $work)
                ->withSuccess(__('crud.common.saved'));
        }

        /**
         * @param Request $request
         * @param Work    $work
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function destroy(Request $request, Work $work)
        {
            $this->authorize('delete', $work);

            $work->delete();

            return redirect()
                ->route('works.index')
                ->withSuccess(__('crud.common.removed'));
        }
    }
