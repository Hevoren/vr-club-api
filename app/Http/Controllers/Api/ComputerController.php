<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delete\DeleteRequest;
use App\Http\Requests\Store\ComputerStoreRequest;
use App\Http\Requests\Update\ComputerUpdateRequest;
use App\Http\Resources\ComputerResource;
use App\Models\Computer;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $computer = Computer::all();
        if ($computer) {
            return ComputerResource::collection(Computer::all());
        } else {
            return response()->json(['message' => 'Computer not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComputerStoreRequest $request)
    {
        $computer = Computer::create($request->validated());

        return (new ComputerResource($computer))
            ->additional(['message' => 'Computer success added'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $computer = Computer::find($id);
        if ($computer) {
            return new ComputerResource($computer);
        } else {
            return response()->json(['message' => 'Computer not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComputerUpdateRequest $request, string $id)
    {
        $computer = Computer::find($id);
        if ($computer) {
            $computer->update($request->all());
            return (new ComputerResource($computer))
                ->additional(['message' => 'Computer successfully updated'])
                ->response()
                ->setStatusCode(200);
        } else {
            return response()->json(['message' => 'Computer not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
        public function destroy(DeleteRequest $request, string $id)
        {
            $computer = Computer::findOrFail($id);

            // Проверяем, авторизован ли пользователь и имеет ли он права на удаление
            if ($request->user()->tokenCan('delete')) {
                $computer->delete();
                return response()->json(['message' => 'Computer deleted'], 201);
            } else {
                return response()->json(['message' => 'Forbidden'], 403);
            }
        }
}
