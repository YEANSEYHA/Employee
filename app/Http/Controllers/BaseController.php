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
    protected $validate;

    public function index(Request $request)
    {
        //return Employee::all();
        return $this->service->index($request);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->validate);
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
        $data = $this->service->destroy($id);
        return success_delete($data);
    }
}
