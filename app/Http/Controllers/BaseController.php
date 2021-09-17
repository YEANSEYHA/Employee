<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\EmployeeService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;


class BaseController extends Controller
{
    public $service;
    protected $model;

    public function __construct(EmployeeService $employeeService){
        $this->service = $employeeService;
    }

    public function index(Request $request)
    {
        //return Employee::all();
        return $this->service->index($request);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name_kh' => 'required',
            'name_latin' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|min:9|max:10',
            'birth_date'=> 'required',
            'address'=> 'required|max:100',
            'gender' => 'required|max:10'
        ]);
        //return Employee::create($request->all());
        return $this->service->store($request);
    }

    public function show($id)
    {
        //return Employee::find($id);
        return $this->service->show($id);
    }

    public function update(Request $request, $id)
    {

        //return $employee;
        return $this->service->update($request, $id);
    }

    public function destroy($id)
    {
        //Employee::destroy($id);
        $this->service->destroy($id);
    }

    public function multipleCreate(Request $request){
        $valids = [];
        $rules = [
            //'name_latin'=>'/^[a-Z]/i',
            'email'=>'/^[^@]+@[^@]+\.[a-z]{2,6}/i',
            //'email' => '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'

            //'phone'=>'/^[0-9]/i',
        ];
         /* Employee::insert($request->all());
         return 'Create Successful'; */

         if($request->isMethod('post')){

            /* $employeeData = $request->all(); */
            //dd($request->all());
            foreach($request->employees as $key => $value){
                // $this->validate($request,[
                //     'email'=>'required|email|string'
                // ]);
                $skip = false;
                foreach($rules as $key_rule => $rule){
                    if(isset($rules[$key])){
                        $check = preg_match($rules[$key_rule],$value[$key]);
                        if(!$check){
                            $valids[$key]=$value;
                            $skip = true;
                        }
                    }
                }
                if(!$skip){
                    $employee = new Employee;
                    $employee->name_kh = $value['name_kh'];
                    $employee->name_latin = $value['name_latin'];
                    $employee->email = $value['email'];
                    $employee->phone = $value['phone'];
                    $employee->birth_date = $value['birth_date'];
                    $employee->address = $value['address'];
                    $employee->active = $value['active'];
                    $employee->role= $value['role'];
                    $employee->gender = $value['gender'];
                    $employee->save();
                }
                //$check_email = preg_match('/^[^@]+@[^@]+\.[a-z]{2,6}/i',$value['email']);
            }
            return $valids;
            //return 'Import Success';
         }

    }

    public function multipleCreate2(Request $request){

    }
}
