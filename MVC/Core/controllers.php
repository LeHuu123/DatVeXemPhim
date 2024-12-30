<?php

class Controllers{
    public function models($model){
        include_once './MVC/Models/' .$model. '.php';
        return new $model;
    }

    public function view($view , $data = []){
        extract($data);
        include_once './MVC/Views/' .$view. '.php';
    }
}