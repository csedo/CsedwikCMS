<?php 
    require_once(dirname(__FILE__). DIRECTORY_SEPARATOR .'ClassAutoLoader.php');
    new ClassAutoloader;
    SessionController::InitSession();
    
    //Remote Procedural Call
    class rpc {
        
        /**
         * Osztályok metódusainak dinamikus példányosítása
         * @param type $class
         * @param type $method
         * @param type $param
         */
        public function dorpc($class, $method, $param = ''){
            if($param == '') $param = array();
            $class = ucfirst($class);
            if (class_exists($class)){
                $obj = new $class();
                if (method_exists($obj, $method)){
                    return call_user_func(array($obj, $method), $param);
                } else {
                    throw new Exception("Method not found.", 1);
                }
            } else {
                throw new Exception("Class not found.", 1);   
            }
        }
    }


    //Ajax request handler
    try {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']  == 'XMLHttpRequest'){
            if (!empty($_POST['token'])) {
                $request = new rpc();
                if (hash_equals(SessionController::CSRFToken(),$_POST['token'])) {
                    try {
                        $request->dorpc($_POST['class'],$_POST['method']);
                    } catch (\Throwable $th) {
                        echo $th->getMessage();
                    }
                } else {
                    throw new Exception("Invalid request.", 1);
                }
            } else {
                throw new Exception("CSRF Protection error. Invalid POST token.", 1);
            }
        }  else {
            throw new Exception("Request error. No ajax found.", 1);
        }
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
