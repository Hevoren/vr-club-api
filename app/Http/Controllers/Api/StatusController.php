<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusStoreRequest;
use App\Http\Resources\StatusResource;
use App\Models\Statuse;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = Statuse::all();
        if ($status) {
            return StatusResource::collection(Statuse::all());
        } else {
            return response()->json('Statuses not found', 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusStoreRequest $request)
    {
        $status = Statuse::create($request->validated());

        return new StatusResource($status);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $status = Statuse::find($id);
        if ($status) {
            return new StatusResource($status);
        } else {
            return response()->json('Status not found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status = Statuse::findOrFail($id);
        if ($status) {
            $status->delete();
            return response()->json('status delete');
        } else {
            return response()->json(error);
        }


    }

    public function destroyAll()
    {
        Statuse::query()->delete();
        return response()->json('All statuses deleted');
    }
}
