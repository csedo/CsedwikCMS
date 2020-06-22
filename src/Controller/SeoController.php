<?php 
    class SeoController{

        public $FQDN;
        public $Charset;
        public $Description;
        public $MetaKeywords;
        public $Title;
        public $OpenGraphImage;

        function __construct(){
            $this->FQDN = Config::$SeoController_FQDN;
            $this->Charset = Config::$SeoController_Charset;
            $this->Description = Config::$SeoController_Description;
            $this->MetaKeywords = Config::$SeoController_MetaKeywords;
            $this->Title = Config::$SeoController_Title;
            $this->OpenGraphImage = Config::$SeoController_OpenGraphImage;
        }

        public function InitSeoController(){
            echo '<title>'.$this->Title.'</title>';
            echo '<meta charset="'.$this->Charset.'">';
            echo '<meta name="description" content="'.$this->Description.'">';
            echo '<meta name=viewport content="width=device-width, initial-scale=1">';
            echo '<meta name="language" content="HU">';
            echo '<meta http-equiv="Pragma" content="no-cache">';
            echo '<meta http-equiv="Cache-Control" content="no-cache">';
            echo '<meta name="identifier-URL" content="'.$this->FQDN.'">';
            echo '<meta name="keywords" content="'.$this->MetaKeywords.'"/>';

            //Facebook's OpenGraph meta tags
            echo '<meta property="og:type" content="article" />';
            echo '<meta property="og:title" content="'.$this->Title.'" />';
            echo '<meta property="og:description" content="'.$this->Description.'" />';
            echo '<meta property="og:image" content="'.$this->OpenGraphImage.'" />';
        }
    }
?>