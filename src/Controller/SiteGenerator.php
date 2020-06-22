<?php

    class SiteGenerator{
        protected string $HtmlLang;

        function __construct(){
            $this->HtmlLang = Config::$SiteGenerator_HtmlLang;
        }

        static function RenderSite(){
            $html = new Html();
            return $html->HtmlRender();
        }

        static function ViewInclude($filename){
            require_once('View/'.$filename.'.php');
        }

        static function ModelInclude($filename){
            require_once('Model/'.$filename.'.php');
        }

    }

    class Html extends SiteGenerator{

        private function StartHtml(){
            $html = '<!DOCTYPE html>';
            $html .= '<html lang="'.$this->HtmlLang.'">';
            echo $html;
        }

        private function EndHtml() {
            echo '</html>';
        }

        public function HtmlRender(): void{
            $this->StartHtml();

            $head = new Head();
            $head->HeadRender();

            $body = new Body();
            $body->BodyRender();

            $this->EndHtml();
        }
    }

    class Head extends SiteGenerator{
        public function HeadRender(): void{
            $this->StartHead();
            $this->HeadContent();
            $this->EndHead();
        }

        private function StartHead() {
            echo '<head>';
        }

        private function HeadContent(): void {
            $Seo = new SeoController();
            $Seo->InitSeoController();
            ExternalFileInclude::DesignInclude();
            ExternalFileInclude::TopJavascript();
        }

        private function EndHead() {
            echo '</head>';
        }
    }

    class Body extends SiteGenerator{
        function __construct()
        {
            echo '<body>';
        }

        public function BodyRender(): void{
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

        function __destruct()
        {
            ExternalFileInclude::BottomJavascript();
            echo '</body>';
        }
    }

    Class ElementAssets{

        static function StyleInclude($filename){
            echo '<link href="Assets/css/'.$filename.'" rel="stylesheet" type="text/css" />';
        }

        static function ScriptInclude($filename){
            echo '<script src="Assets/js/'.$filename.'"></script>';
        }
    }