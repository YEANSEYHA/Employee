<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends BaseController
{
    public function __construct(EmployeeService $employeeService){
        $this->service = $employeeService;
    }

    public function store(Request $request)
    {
        $this->validate = [
            'name_kh' => 'required',
            'name_latin' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|min:9|max:10',
            'birth_date'=> 'required',
            'address'=> 'required|max:100',
            'gender' => 'required|max:10'
        ];
        return parent::store($request);
    }

    public function multipleCreate(Request $request){
        $valids = [];
        $rules = [
            //'name_latin'=>'/^[a-Z]/i',
            'email'=>'/^[^@]+@[^@]+\.[a-z]{2,6}/i',
            //'email' => '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'
            //'phone'=>'/^[0-9]/i',
        ];
         if($request->isMethod('post')){
            foreach($request->employees as $key => $value){
                $skip = false;
                foreach($rules as $key_rule => $rule){
                    if(isset($value[$key_rule])){
                        $check = preg_match($rules[$key_rule],$value[$key_rule]);
                        if(!$check){
                            $valids['invalid'][$value['name_latin']]=$value;
                            $skip = true;
                        }
                    }
                }
                if(!$skip){
                    $employee = $this->service->create($value);
                    $valids['valid'][]=$employee;
                }
            }
            return $valids;
            //return 'Import Success';
         }
    }
}
