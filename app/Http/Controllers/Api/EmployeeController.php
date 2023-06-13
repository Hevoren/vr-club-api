<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delete\DeleteRequest;
use App\Http\Requests\Store\EmployeeStoreRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::all();
        if ($employee) {
            return EmployeeResource::collection(Employee::all());
        } else {
            return response()->json(['message' => 'Employees not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeStoreRequest $request)
    {
        $employee = Employee::create($request->validated());

        return (new EmployeeResource($employee))
            ->additional(['message' => 'Employee success added'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            return new EmployeeResource($employee);
        } else {
            return response()->json(['message' => 'Employee not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeStoreRequest $request, string $id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->update($request->all());
            return (new EmployeeResource($employee))
                ->additional(['message' => 'Employee successfully updated'])
                ->response()
                ->setStatusCode(200);
        } else {
            return response()->json(['message' => 'Employee not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request, string $id)
    {
        $employee = Employee::findOrFail($id);

        if ($request->user()->token('delete')) {
            $employee->delete();
            return response()->json(['message' => 'Employee delete'], 201);
        } else {
            return response()->json(['error' => 'Forbidden'], 403);
        }
    }
}
