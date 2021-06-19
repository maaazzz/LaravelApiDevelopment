<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest('id')->get();
        return response()->json([
            'status' => 1,
            'message' => "Listing Employees",
            'data' => $employees,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        //store employee
        Employee::create($request->validated());

        // return response
        return response()->json([
            'status' => 1,
            'message' => 'Employee Created Successfully',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        // if (Employee::where('id', $employee->id)->exists()) {
        $employee_detail = Employee::where('id', $employee->id)->firstOrFail();
        return response()->json([
            'status' => 1,
            'message' => 'Emplyee Result',
            'data' => $employee_detail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->name = !empty(request('name')) ? request('name') : $employee->name;
        $employee->email = !empty(request('email')) ? request('email') : $employee->email;
        $employee->phone_no = !empty(request('phone_no')) ? request('phone_no') : $employee->phone_no;
        $employee->gender = !empty(request('gender')) ? request('gender') : $employee->gender;
        $employee->age = !empty(request('age')) ? request('age') : $employee->age;

        $employee->update();
        return response()->json([
            'status' => 1,
            'message' => "Employee Updated",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Employee Deleted Successfully',
        ]);
    }
}
