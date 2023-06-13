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
    public function storeRequest(UserRequestStoreRequest $request)
    {
        $userrequest = UserRequest::create($request->validated());
        return (new UserRequestResource($userrequest))
            ->additional(['message' => 'Request success send'])
            ->response()
            ->setStatusCode(201);

    }

    public function showRequest()
    {
        $userrequest = UserRequest::all();
        if ($userrequest) {
            return response()->json(['user_requests' => UserRequestResource::collection(UserRequest::all())], 201);
        } else {
            return response()->json(['message' => 'Requests not found'], 404);
        }
    }

}
