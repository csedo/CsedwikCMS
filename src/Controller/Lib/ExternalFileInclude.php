<?php
    Class ExternalFileInclude{

        static function DesignInclude(){
            ElementAssets::StyleInclude('bootstrap.min.css');
        }

        static function TopJavascript(){

        }

        static function BottomJavascript(){
            ElementAssets::ScriptInclude('jquery-3.5.1.min.js');
            ElementAssets::ScriptInclude('bootstrap.min.js');
            ElementAssets::ScriptInclude('sweetalert2.all.min.js');

        }
    }

?>