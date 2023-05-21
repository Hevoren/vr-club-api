<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delete\DeleteRequest;
use App\Http\Requests\Store\VrDeviceStoreRequest;
use App\Http\Requests\Update\VrDeviceUpdateRequest;
use App\Http\Resources\VrDeviceResource;
use App\Models\VrDevice;
use Illuminate\Http\Request;

class VrDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vrdevice = VrDevice::all();
        if ($vrdevice) {
            return VrDeviceResource::collection(VrDevice::all());
        } else {
            return response()->json(['message' => 'VrDevices not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VrDeviceStoreRequest $request)
    {
        $vrdevice = VrDevice::create($request->validated());
        return (new VrDeviceResource($vrdevice))
            ->additional(['message' => 'VrDevice success added'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vrdevice = VrDevice::find($id);
        if ($vrdevice) {
            return new VrDeviceResource($vrdevice);
        } else {
            return response()->json(['message' => 'VrDevice not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VrDeviceUpdateRequest $request, string $id)
    {
        $vrdevice = VrDevice::find($id);
        if ($vrdevice) {
            $vrdevice->update($request->all());
            return (new VrDeviceResource($vrdevice))
                ->additional(['message' => 'VrDevice successfully updated'])
                ->response()
                ->setStatusCode(200);
        } else {
            return response()->json(['message' => 'VrDevice not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request, string $id)
    {
        $vrdevice = VrDevice::findOrFail($id);

        // Проверяем, авторизован ли пользователь и имеет ли он права на удаление
        if ($request->user()->tokenCan('delete')) {
            $vrdevice->delete();
            return response()->json(['message' => 'VrDevice deleted']);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
