<?php

    class App{

        protected $controller ,$action ,$params , $__router ;
        

        function __construct(){
           
            global $routes;

            // echo '<pre>';
            // print_r ( $routes);
            // echo '</pre>';
            $this -> __router = new Router();

            if(!empty($routes['default_controller']) ){
                $this-> controller = $routes['default_controller'];
            }
            $this -> action = 'index';
            $this -> params = [];
           $this -> handleUrl();
        } 

        function handleUrl(){
            $arrUrl = $this -> processURL();
            // $this ->__router ->handleUrl();
           // XỬ LÝ CONTROLLER
           if(!empty($arrUrl[0])){
                $this -> controller = ucfirst($arrUrl[0]);
           }
           else {
                $this -> controller = ucfirst( $this -> controller);
           }

           if(file_exists('./MVC/Controllers/' .$this->controller. '.php'))
           {
               include_once './MVC/Controllers/' .$this->controller. '.php';
               $this -> controller = new $this -> controller();
               unset($arrUrl[0]);
           }
           else{
                echo "LỖI ";
           }
           // XỬ LÝ ACTION
           if(!empty($arrUrl[1])){
                $this -> action = $arrUrl[1];
                unset($arrUrl[1]);
           }
           // XỬ LÝ PARAMS
           $this -> params = array_values($arrUrl);
        //    echo '<pre>';
        //    print_r ( $this -> params);
        //    echo '</pre>';

           call_user_func_array([$this -> controller , $this -> action] , $this -> params);
        }

        function processURL() {
            if(!empty($_GET['url']) )
            {
                return array_filter( explode('/' , filter_var($this->__router ->handleUrl()) , FILTER_DEFAULT ) ) ;
                // return array_filter( explode('/' , filter_var( trim($_GET['url']) , FILTER_DEFAULT ) ) );
            }
            return [];
        }
    }
?>
