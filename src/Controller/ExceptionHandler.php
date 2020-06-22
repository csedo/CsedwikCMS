<?php 
    Class ExceptionHandler{

        function __construct($ErrorMessage){
            $this->ErrorHandler($this->$ErrorMessage);
        }

        private function ErrorHandler($th){
            echo '<div class="alert alert-danger" role="alert">'.$th->getMessage().'</div>';
        }
    }
?>