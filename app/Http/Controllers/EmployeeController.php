<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Employee;
use App\Company;
use Session;

class EmployeeController extends Controller
{
    public function index()
    {
      $employees = Employee::with('company')->paginate(10);
      return view('admin.employees.index', compact('employees'));
    }
    public function create()
    {
        $companies = Company::select('id', 'name')->get();
        return view('admin.employees.create', compact('companies'));
    }
    public function store(StoreEmployeeRequest $request)
    {
      $validated = $request->validated();

      $input = [
        'firstName' => $request->input('firstName'),
        'lastName' => $request->input('lastName'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'company' => $request->input('company')
      ];

      Employee::create($input);
      return redirect()->route('employees.index');
    }
    public function show($id)
    {
      $employee = Employee::find($id);
      return view('admin.employees.show', compact('employee'));
    }
    public function edit($id)
    {
      $employee = Employee::find($id);
      $companies = Company::select('id', 'name')->get();
      return view('admin.employees.edit', compact(['employee', 'companies']));
    }
    public function update(UpdateEmployeeRequest $request, $id)
    {
      $validated = $request->validated();

      $input = [
        'firstName' => $request->input('firstName'),
        'lastName' => $request->input('lastName'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'company' => $request->input('company')
      ];
      $oldEmployeeRecord = Employee::find($id);
      $oldEmployeeRecord->update($input);
      return redirect()->route('employees.index');
    }
    public function destroy($id)
    {
      $employee = Company::find($id);
      $employee->delete();
      return redirect()->route('employees.index');
    }
}
