<?php
namespace App\Services;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\EmployeeFilters;

class EmployeeService extends BaseService{

    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes){
        return parent::create($attributes);
    }

    public function index(Request $request)
    {

        $employee = (new Employee)->newQuery();
        if ($request->has('role')){
            $employee->where('role', $request->role);
        }
        if ($request->has('gender')){
            $employee->where('gender', $request->gender);
        }
        if ($request->has('name_latin')){
            $employee->where('name_latin', $request->name_latin);
        }
        if ($request->has('phone')){
            $employee->where('phone', $request->phone);
        }
        if($request->has('namelatin')){
            $employee->where('name_latin', 'like','%'.request('namelatin').'%');
        }
        if($request->has('namekh')){
            $employee->where('name_kh', 'like','%'.request('namekh').'%');
        }
        if($request->has('email')){
            $employee->where('email', 'like','%'.request('email').'%');
        }
        return $employee->paginate(20);
    }

    public function store(Request $request)
    {
        return parent::create($request->all());
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function update(Request $request, $id)
    {
        $error = "Employee";
        $employee = $this->model->find($id);
        if($employee->email!==$request->email){
            $exist = $this->model->where('email','=',$request->email)->first();
            $error = "emial";
            if(!$exist){
                $employee->update($request->all());
            }else{
                return notFound([
                    "message"=>"$error already exist!"
                ],404);
            }
        }else{
            return error($request->all());
        }
        return $employee;
    }

    public function destroy($id)
    {
        $this->model->destroy($id);
        return success([
            "message"=>"deleted"
        ],204);
    }

}
