<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delete\DeleteRequest;
use App\Http\Requests\Store\UserRequestStoreRequest;
use App\Http\Resources\ComputerResource;
use App\Http\Resources\UserRequestResource;
use App\Models\Computer;
use App\Models\UserRequest;
use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userrequest = UserRequest::all();
        if ($userrequest) {
            return UserRequestResource::collection(UserRequest::all());
        } else {
            return response()->json(['message' => 'Requests not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequestStoreRequest $request)
    {
        $userrequest = UserRequest::create($request->validated());
        return (new UserRequestResource($userrequest))
            ->additional(['message' => 'Request success send'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userrequest = UserRequest::find($id);
        if ($userrequest) {
            return new UserRequestResource($userrequest);
        } else {
            return response()->json(['message' => 'Request not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userrequest = UserRequest::find($id);
        if ($userrequest) {
            $userrequest->update($request->all());
            return (new UserRequestResource($userrequest))
                ->additional(['message' => 'Request successfully updated'])
                ->response()
                ->setStatusCode(200);
        } else {
            return response()->json(['message' => 'Request not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request, string $id)
    {
        $userrequest = UserRequest::findOrFail($id);

        if ($request->user()->tokenCan('delete')) {
            $userrequest->delete();
            return response()->json(['message' => 'Request deleted']);
        } else {
            return response()->json(['message' => 'Unauthorized']);
        }
    }
}
