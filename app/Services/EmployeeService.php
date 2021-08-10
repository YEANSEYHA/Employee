<?php
namespace App\Services;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\EmployeeFilters;

class EmployeeService extends BaseService{

    public function create(array $attributes){
        return Employee::create($attributes);
    }

    public function index(Request $request)
    {

        $employee = (new Employee)->newQuery();
        if ($request->has('role')){
            $employee->where('role', $request->role)->get();
        }
        if ($request->has('gender')){
            $employee->where('gender', $request->gender)->get();
        }
        if ($request->has('name_latin')){
            $employee->where('name_latin', $request->name_latin)->get();
        }
        if ($request->has('phone')){
            $employee->where('phone', $request->phone)->get();
        }
        if($request->has('namelatin')){
            $employee->where('name_latin', 'like','%'.request('namelatin').'%')->get();
        }
        if($request->has('namekh')){
            $employee->where('name_kh', 'like','%'.request('namekh').'%')->get();
        }
        return $employee->paginate(20);
    }

    public function store(Request $request)
    {   // Check existing employees
        $employees_namelatin = Employee::where('name_latin', '=', $request->input('name_latin'))->first();
        $employees_namekh = Employee::where('name_kh', '=', $request->input('name_kh'))->first();
        if ($employees_namelatin === null && $employees_namekh === null) {
        // User does not exist
            return Employee::create($request->all());
        } else {
        // User exits
            return 'Employee already exists';
        }
        //return Employee::create($request->all());
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
