<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delete\DeleteRequest;
use App\Http\Requests\Store\StatusStoreRequest;
use App\Http\Requests\Update\StatusUpdateRequest;
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
            return response()->json(['message' => 'Statuses not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusStoreRequest $request)
    {
        $status = Statuse::create($request->validated());
        return (new StatusResource($status))
            ->additional(['message' => 'Status success added'])
            ->response()
            ->setStatusCode(201);
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
            return response()->json(['message' => 'Status not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusUpdateRequest $request, string $id)
    {
        $status = Statuse::find($id);
        if ($status) {
            $status->update($request->all());
            return (new StatusResource($status))
                ->additional(['message' => 'Status successfully updated'])
                ->response()
                ->setStatusCode(200);
        } else {
            return response()->json(['message' => 'Status success added'], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request, string $id)
    {
        $status = Statuse::findOrFail($id);

        if ($request->user()->tokenCan('delete')) {
            $status->delete();
            return response()->json(['message' => 'Status deleted']);
        } else {
            return response()->json(['message' => 'Unauthorized']);
        }
    }

    public function destroyAll()
    {
        Statuse::query()->delete();
        return response()->json('All statuses deleted');
    }
}
