<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delete\DeleteRequest;
use App\Http\Requests\Store\RoomStoreRequest;
use App\Http\Requests\Update\RoleUpdateRequest;
use App\Http\Requests\Update\RoomUpdateRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $room = Room::all();
        if ($room) {
            return RoomResource::collection(Room::all());
        } else {
            return response()->json(['message' => 'Rooms not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomStoreRequest $request)
    {
        $room = Room::create($request->validated());
        return (new RoomResource($room))
            ->additional(['message' => 'Room success added'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::find($id);
        if ($room) {
            return new RoomResource($room);
        } else {
            return response()->json(['message' => 'Room not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomUpdateRequest $request, string $id)
    {
        $room = Room::find($id);
        if ($room) {
            $room->update($request->all());
            return (new RoomResource($room))
                ->additional(['message' => 'Room successfully updated'])
                ->response()
                ->setStatusCode(200);
        } else {
            return response()->json(['message' => 'Room not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request, string $id)
    {
        $room = Room::findOrFail($id);

        if ($request->user()->tokenCan('delete')) {
            $room->delete();
            return response()->json(['message' => 'Room deleted']);
        } else {
            return response()->json(['message' => 'Unauthorized']);
        }
    }
}
