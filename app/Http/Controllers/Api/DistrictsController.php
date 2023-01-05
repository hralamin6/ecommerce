<?php

namespace App\Http\Controllers\Api;

use App\Models\Districts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictsResource;
use App\Http\Resources\DistrictsCollection;
use App\Http\Requests\DistrictsStoreRequest;
use App\Http\Requests\DistrictsUpdateRequest;

class DistrictsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Districts::class);

        $search = $request->get('search', '');

        $allDistricts = Districts::when($search, function ($query) use ($search) {
                    $query->search($search);
                })
            ->latest()
            ->paginate();

        return new DistrictsCollection($allDistricts);
    }

    /**
     * @param \App\Http\Requests\DistrictsStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistrictsStoreRequest $request)
    {
        $this->authorize('create', Districts::class);

        $validated = $request->validated();

        $districts = Districts::create($validated);

        return new DistrictsResource($districts);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Districts $districts
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Districts $districts)
    {
        $this->authorize('view', $districts);

        return new DistrictsResource($districts);
    }

    /**
     * @param \App\Http\Requests\DistrictsUpdateRequest $request
     * @param \App\Models\Districts $districts
     * @return \Illuminate\Http\Response
     */
    public function update(
        DistrictsUpdateRequest $request,
        Districts $districts
    ) {
        $this->authorize('update', $districts);

        $validated = $request->validated();

        $districts->update($validated);

        return new DistrictsResource($districts);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Districts $districts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Districts $districts)
    {
        $this->authorize('delete', $districts);

        $districts->delete();

        return response()->noContent();
    }
}
