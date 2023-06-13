<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delete\DeleteRequest;
use App\Http\Requests\Store\RoleStoreRequest;
use App\Http\Requests\Update\RoleUpdateRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::all();
        if ($role) {
            return RoleResource::collection(Role::all());
        } else {
            return response()->json(['message' => 'Roles not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request)
    {
        return response()->json(['error' => 'Forbidden'], 403);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        if ($role) {
            return new RoleResource($role);
        } else {
            return response()->json(['message' => 'Role not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, string $id)
    {
        return response()->json(['error' => 'Forbidden'], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request, string $id)
    {
        return response()->json(['error' => 'Forbidden'], 403);
    }
}
