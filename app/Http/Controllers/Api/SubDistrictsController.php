<?php

namespace App\Http\Controllers\Api;

use App\Models\SubDistricts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubDistrictsResource;
use App\Http\Resources\SubDistrictsCollection;
use App\Http\Requests\SubDistrictsStoreRequest;
use App\Http\Requests\SubDistrictsUpdateRequest;

class SubDistrictsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', SubDistricts::class);

        $search = $request->get('search', '');

        $allSubDistricts = SubDistricts::when($search, function ($query) use ($search) {
                    $query->search($search);
                })
            ->latest()
            ->paginate();

        return new SubDistrictsCollection($allSubDistricts);
    }

    /**
     * @param \App\Http\Requests\SubDistrictsStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubDistrictsStoreRequest $request)
    {
        $this->authorize('create', SubDistricts::class);

        $validated = $request->validated();

        $subDistricts = SubDistricts::create($validated);

        return new SubDistrictsResource($subDistricts);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SubDistricts $subDistricts
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SubDistricts $subDistricts)
    {
        $this->authorize('view', $subDistricts);

        return new SubDistrictsResource($subDistricts);
    }

    /**
     * @param \App\Http\Requests\SubDistrictsUpdateRequest $request
     * @param \App\Models\SubDistricts $subDistricts
     * @return \Illuminate\Http\Response
     */
    public function update(
        SubDistrictsUpdateRequest $request,
        SubDistricts $subDistricts
    ) {
        $this->authorize('update', $subDistricts);

        $validated = $request->validated();

        $subDistricts->update($validated);

        return new SubDistrictsResource($subDistricts);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SubDistricts $subDistricts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SubDistricts $subDistricts)
    {
        $this->authorize('delete', $subDistricts);

        $subDistricts->delete();

        return response()->noContent();
    }
}
