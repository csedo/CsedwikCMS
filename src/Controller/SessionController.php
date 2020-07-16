<?php 

    class SessionController{

        public $SessionName;
        protected $csrftoken;

        static function InitSession(){
            $self = new self;
            $self->SessionName();
            session_start();
            $self->SessionHeader();
            $self->SetCSRFToken();
        }

        protected function SessionName(){
            $this->SessionName = Config::$SessionController_SessionName;
            if(!empty($this->SessionName)){
                session_name($this->SessionName);
            } else {
                session_name(PHPHeader::Random(8));
            }
        }

        protected function SessionHeader(){
            header('Access-Control-Allow-Origin: *');
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
        }

        protected function SetCSRFToken(){
            //Set token with 32 bytes random string
            $this->csrftoken = PHPHeader::Random(32);
            if(empty($_SESSION['CSRFToken'])){
                $_SESSION['CSRFToken'] = $this->csrftoken;
            }
        }

        static function CSRFToken(){
            if(isset($_SESSION['CSRFToken'])){
                return $_SESSION['CSRFToken'];
            }
        }
    }
?>