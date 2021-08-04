<?php
namespace App\Services;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeService extends BaseService{

    public function create(array $attributes){
        return Employee::create($attributes);
    }

    public function index()
    {
        return Employee::all();
    }

    public function store(Request $request)
    {   
        return Employee::create($request->all());
    }

    public function show($id)
    {
        return Employee::find($id);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->update($request->all());
        return $employee;
    }

    public function destroy($id)
    {
        Employee::destroy($id);
    }
}