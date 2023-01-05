<?php

namespace App\Http\Controllers\Api;

use App\Models\Districts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubDistrictsResource;
use App\Http\Resources\SubDistrictsCollection;

class DistrictsAllSubDistrictsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Districts $districts
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Districts $districts)
    {
        $this->authorize('view', $districts);

        $search = $request->get('search', '');

        $allSubDistricts = $districts
            ->allSubDistricts()
            ->search($search)
            ->latest()
            ->paginate();

        return new SubDistrictsCollection($allSubDistricts);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Districts $districts
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Districts $districts)
    {
        $this->authorize('create', SubDistricts::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'status' => ['required', 'boolean'],
        ]);

        $subDistricts = $districts->allSubDistricts()->create($validated);

        return new SubDistrictsResource($subDistricts);
    }
}
