<?php 
    class MailForm{

        public $textBig;
        public	$textSmall;
        public	$buttonLink;
        public	$buttonText;
        
        public function textBig(){
            return $this->textBig;
        }
        
        public function textSmall(){
            echo $this->textSmall;
        }
        
        public function buttonLink(){
            echo $this->buttonLink;
        }
        
        public function buttonText(){
            echo $this->buttonText;
        }
        
        public function LoadForm(){
            ob_start();
            include('Forms/EmailForm.php');
            $html = ob_get_contents();
            ob_end_clean();
            return $html;
        }
    }
?>