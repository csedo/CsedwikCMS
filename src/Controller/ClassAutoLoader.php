<?php
    class ClassAutoLoader {
        public function __construct() {
            spl_autoload_register(array($this, 'loader'));
        }
        
        private function loader($class) {
            if(file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $class . '.php')){
                require_once  dirname(__FILE__) . DIRECTORY_SEPARATOR . $class . '.php';
            } else if(file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Lib' . DIRECTORY_SEPARATOR .$class . '.php')){
                require_once  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Lib' . DIRECTORY_SEPARATOR .$class . '.php';
            } else if(file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Lib' .DIRECTORY_SEPARATOR. 'Kulcs' . DIRECTORY_SEPARATOR .$class . '.php')){
                require_once  dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Lib' .DIRECTORY_SEPARATOR. 'Kulcs' . DIRECTORY_SEPARATOR .$class . '.php';
            }
        }
    }
?>