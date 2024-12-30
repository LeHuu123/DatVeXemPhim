<?php

class DatVe extends controllers{
    protected $dv;
    protected $data;
    protected $datVe;
    protected $pageComBo;
    function __construct()
    {
        $this -> data = [];
        $this -> dv = $this -> models("DatVeMd");
        $this -> dv -> dat_ve_list();
    }
    
    function index(){
        if(isset($_GET['page'])){
            $this -> data['content']['page'] = $_GET['page'];
            $this -> data['page'] = $_GET['page'];
          $this -> dv -> dat_ve_list();
        } 
        $this -> view('masterLayout' , $this -> data);

    }
}