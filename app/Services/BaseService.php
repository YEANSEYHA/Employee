<?php
class BaseService{
    public $model;

    public function create(array $attributes){
        return $this->model->create($attributes);
    }
}