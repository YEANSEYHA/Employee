<?php
use App\Models\Employee;

class EmployeeService extends BaseService{
    public function create(array $attributes){
        return Employee::create($attributes);
    }
}