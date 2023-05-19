<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\Statuse;
use http\Env\Response;
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
            return response()->json('Employees not found', 404);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            return response()->json('Employee not found', 404);
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
        $employee = Employee::findOrFail($id);
        if ($employee) {
            $employee->delete();
            return response()->json('employee delete');
        } else {
            return response()->json(error);
        }


    }

    public function destroyAll()
    {
        Employee::query()->delete();
        return response()->json('All employees deleted');
    }
}