<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VrDeviceStoreRequest;
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
            return response()->json('VrDevices not found', 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VrDeviceStoreRequest $request)
    {
        $vrdevice = VrDevice::create($request->validated());

        return new VrDeviceResource($vrdevice);
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
            return response()->json('VrDevice not found', 404);
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
        //
    }
}
