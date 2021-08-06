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
        //return Employee::all();
        //return Employee::paginate(20);
        $query = Employee::query();
        $query->when(request()->filled('filter'),function($query){
            $filters = explode(',',request('filter'));
            foreach($filters as $filter){
                [$criteria, $value] = explode(':',$filter);
                $query->where($criteria,$value);
            }
            return $query;
        });

        return $query->paginate(20);
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