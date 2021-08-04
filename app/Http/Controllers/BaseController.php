<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\EmployeeService;


class BaseController extends Controller
{   
    public $service;
    protected $model;

    public function __construct(EmployeeService $employeeService){
        $this->service = $employeeService;
    }

    public function index()
    {
        //return Employee::all();
        return $this->service->index();
    }

    public function store(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
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
}
