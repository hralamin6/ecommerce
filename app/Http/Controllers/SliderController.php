<?php

    namespace App\Http\Controllers;

    use App\Models\Slider;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Contracts\View\View;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Support\Facades\Storage;
    use App\Http\Requests\SliderStoreRequest;
    use App\Http\Requests\SliderUpdateRequest;
    use Illuminate\Contracts\Foundation\Application;
    use Illuminate\Auth\Access\AuthorizationException;

    class SliderController extends Controller
    {
        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function index(Request $request)
        {
            $this->authorize('view-any', Slider::class);

            $search = $request->get('search', '');

            $sliders = Slider::when($search, function ($query) use ($search) {
                    $query->search($search);
                })
                ->latest()
                ->paginate(15);

            return view('app.sliders.index', compact('sliders', 'search'));
        }

        /**
         * @param Request $request
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function create(Request $request)
        {
            $this->authorize('create', Slider::class);

            return view('app.sliders.create');
        }

        /**
         * @param SliderStoreRequest $request
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function store(SliderStoreRequest $request)
        {
            $this->authorize('create', Slider::class);

            $validated = $request->validated();
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('sliders');
            }

            $slider = Slider::create($validated);

            return redirect()
                ->route('sliders.edit', $slider)
                ->withSuccess(__('crud.common.created'));
        }

        /**
         * @param Request $request
         * @param Slider  $slider
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function show(Request $request, Slider $slider)
        {
            $this->authorize('view', $slider);

            return view('app.sliders.show', compact('slider'));
        }

        /**
         * @param Request $request
         * @param Slider  $slider
         *
         * @return Application|Factory|View
         * @throws AuthorizationException
         */
        public function edit(Request $request, Slider $slider)
        {
            $this->authorize('update', $slider);

            return view('app.sliders.edit', compact('slider'));
        }

        /**
         * @param SliderUpdateRequest $request
         * @param Slider              $slider
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function update(Request $request, Slider $slider)
        {
            $this->authorize('update', $slider);

            $validated = $request->except('_token');

            if ($request->hasFile('image')) {
                if ($slider->image) {
                    Storage::delete($slider->image);
                }

                $validated['image'] = $request->file('image')->store('sliders');
            }

            $slider->update($validated);

            return redirect()
                ->route('sliders.edit', $slider)
                ->withSuccess(__('crud.common.saved'));
        }

        /**
         * @param Request $request
         * @param Slider  $slider
         *
         * @return Response
         * @throws AuthorizationException
         */
        public function destroy(Request $request, Slider $slider)
        {
            $this->authorize('delete', $slider);

            if ($slider->image) {
                Storage::delete($slider->image);
            }

            $slider->delete();

            return redirect()
                ->route('sliders.index')
                ->withSuccess(__('crud.common.removed'));
        }
    }
