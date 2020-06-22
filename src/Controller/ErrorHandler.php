<?php 
    class ErrorHandler{

        /**
         * 0 - No Error
         * 1 - Only Notice
         * 2 - Warning - Parse
         * 3 - Errors
         * 4 - Report all error
         */
        protected $ErrorLevel = 4;

        function __construct(){
            $this->SetErrorLevel();
        }

        private function SetErrorLevel(){
            if($this->ErrorLevel == 0){
                error_reporting(0);
            } else {
                ini_set("display_errors", 1);
                if($this->ErrorLevel == 1){
                    error_reporting(E_NOTICE);
                } elseif($this->ErrorLevel == 2){
                    error_reporting(E_WARNING | E_PARSE | E_NOTICE);
                } elseif($this->ErrorLevel == 3){
                    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
                } elseif($this->ErrorLevel == 4){
                    error_reporting(-1);
                }
            }
        }
    }
?>