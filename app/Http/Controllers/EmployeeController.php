<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return response()->json(Employee::all());
    }

    public function store(Request $request)
    {
       $incomingFields = $request->validate([
        "name" => "required|string",
        "email" => ["required","email","unique:employees,email"],
        "phone" => ["required","unique:employees,phone"],
        "role" => "required|string",
       ]);

       $employee = Employee::create($incomingFields);

       return response()->json($employee, 201);
    }

    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);

        return response()->json($employee);
    }

    public function update(Request $request, string $id)
    {
      $employee = Employee::findOrFail($id);

      $incomingFields = $request->validate([
        'name' => 'required|string',
        'email' => ['required','email','unique:employees,email,'.$id],
        'phone' => ['required', 'unique:employees,phone,'.$id],
        'role' => 'required|string',
      ]);

      $employee->update($incomingFields);

      return response()->json($employee,200);
    }

    public function destroy(string $id)
    {
      $employee = Employee::findOrFail($id);

      $employee->delete();

      return response()->json([
        'message'=> "Employee deleted succesfully"
      ]);
    }
}
