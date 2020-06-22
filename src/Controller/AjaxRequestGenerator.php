<?php
    class AjaxRequestGenerator {

        public $UseJavascript;
        public $ErrorMessage = ""; 
          
        private $class;
        private $method;
        protected $MainSuccessMessage;
        protected $SecondarySuccessMessage = "";
        

        function __construct($class, $method){
            $this->class = $class;
            $this->method = $method;
        }

        function SuccessMessage(array $SuccessMessage){
            if(!empty($SuccessMessage[0])){
                $this->MainSuccessMessage = $SuccessMessage[0];
            }

            if(!empty($SuccessMessage[1])){
                $this->SecondarySuccessMessage = $SuccessMessage[1];
            }
        }


        protected function ReturnSuccess(){
            if(!$this->UseJavascript){
                return 'Swal.fire("'.$this->MainSuccessMessage.'","'.$this->SecondarySuccessMessage.'","success")';
            } else {
                return $this->MainSuccessMessage;
            }
        }
        protected $click;
        protected function ReturnError(){
            /*if($this->click){
                return false;
            }*/
            return 'Swal.fire("'.$this->ErrorMessage.'",response,"error")';
        }

        function GenerateAjaxRequest($click = false){
            $this->click = $click;
            if($click){
                $js = '$("#'.$this->method.'").click(function()';
                $formdata = null;
            } else {
                $js = '$("#'.$this->method.'").submit(function()';
                $formdata = 'this';
            }
            $script = '
            <script>
                '.$js.' {
                    event.preventDefault();
                    var dataForm = new FormData('.$formdata.');
                    dataForm.append("class","'.$this->class.'")
                    dataForm.append("method","'.$this->method.'")
                    dataForm.append("token","'.SessionController::CSRFToken().'")
                    $.ajax({
                        url: "ajax/AjaxRequestHandler.php",
                        type: "POST",
                        data: dataForm,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response){
                            if(!$.trim(response)){
                                '.$this->ReturnSuccess().'
                            } else {
                                '.$this->ReturnError().'
                            }           
                        }
                    });
                });
            </script>';
            echo $script;
        }

        static function SimpleAjax($class, array $method, $javascript =''){
            if(!empty($method[1])){
                $parameter = $method[1];
                $paramjs = 'dataForm.append("parameter",'.$parameter.')';
            } else {
                $parameter = null;
                $paramjs = null;
            }
            echo '
            <script>
                function '.$method[0].'('.$parameter.') {
                    var dataForm = new FormData();
                    dataForm.append("class","'.$class.'")
                    dataForm.append("method","'.$method[0].'")
                    dataForm.append("token","'.SessionController::CSRFToken().'")
                    '.$paramjs.'
                    $.ajax({
                        url: "ajax/AjaxRequestHandler.php",
                        type: "POST",
                        data: dataForm,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response){
                            '.$javascript.'
                            $("#'.$method[0].'").html(response);    
                        }
                    });
                };
            </script>';
        }
    }
?>