<?php

    class SiteGenerator{

        function __construct($command = ''){
            if($command == 'InitHtml'){
                $this->GenerateHTML();
            }
        }

        static function ElementIncluder(){
            $self = new self();
            $self->MainIncluder();   
        }

        private function MainIncluder(){
            $includeDir = ".".DIRECTORY_SEPARATOR."Model".DIRECTORY_SEPARATOR;
            $includeDefault = $includeDir."home.php";
            if(isset($_GET['pages']) && !empty($_GET['pages'])){
                $includeFile = basename(realpath($includeDir.strtolower($_GET['pages']).".php"));
                $includePath = $includeDir.strtolower($includeFile);
                if(!empty(strtolower($includeFile)) && file_exists($includePath)) {
                    include($includePath);
                } else {
                    include($includeDefault);
                }
            } else{
                include($includeDefault);
            }
        }

        static function ViewInclude($filename){
            require_once('View/'.$filename.'.php');
        }

        static function ModelInclude($filename){
            require_once('Model/'.$filename.'.php');
        }

        protected function GenerateHTML(){
            SessionController::InitSession();
            new PHPHeader();
            try {
                new ErrorHandler();
                new DatabaseController();
            } catch (\Throwable $th) {
                new ExceptionHandler($th);
            }
            HtmlElement::BaseHtml();
        }
    }

    class HtmlElement{

        function __construct($lang = ''){
            $html = '<!DOCTYPE html>';
            if(empty($lang)){
                $lang = 'HU';
            }
            $html .= '<html lang="'.$lang.'">';
            echo $html;
        }

        static function BaseHtml(){
            HtmlElementTags::TagsGenerator();
        }

        function __destruct(){
            AssetsInclude::js('scripts.min.js');
            AssetsInclude::js('sweetalert2.all.min.js');
            echo '</html>';
        }
    }

    class HtmlElementTags extends HtmlElement{

        public static function TagsGenerator(){
            $HtmlElementTags = new self();
            $HtmlElementTags->Head();
            echo '<body><div id="wrapper">';
            $HtmlElementTags->Body();
            echo '</div></body>';
        }

        protected function Head(){
            $html = '<head>';
            new SeoController();
            $html .= '<title>'.SeoController::GetTitle().'</title>';
            $this->Styles();
            AssetsInclude::js('vendor.min.js');
            $html .= '</head>';
            echo $html;
        }

        protected function Body(){
            SiteGenerator::ViewInclude('Header');
            SiteGenerator::ElementIncluder();
            SiteGenerator::ViewInclude('Footer');
            
        }

        protected function Styles(){
            //Stylesheets
            //Bootstrap, Font Icons, Plugins, etc.
            AssetsInclude::css('vendor.min.css');
            //Template design
            AssetsInclude::css('styles.min.css'); 
            //egyedi weboldal css módosítások
            AssetsInclude::ccss('custom.style.css');   
            //Modernizr
            AssetsInclude::js('modernizr.min.js');  
        }

        static function Scripts(){
            //Scripts
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>';
            AssetsInclude::js('scripts.min.js');
            AssetsInclude::js('sweetalert2.all.min.js');
        }
    }

    Class ElementAssets{

        static function StyleInclude($filename){
            if(empty($filename)){
                throw new Exception("No StyleSheet found in Assets/css folder.", 1);
            }
            echo '<link href="Assets/css/'.$filename.'" rel="stylesheet" type="text/css" />';
        }

        static function ScriptInclude($filename){
            if(empty($filename)){
                throw new Exception("No Script found in Assets/js folder.", 1);
            }
            echo '<script src="Assets/js/'.$filename.'"></script>';
        }
    }
?>