<?php 
    require_once('Controller/ClassAutoLoader.php');
    try {
        new ClassAutoLoader();
        SiteGenerator::RenderSite();
    } catch (\Throwable $th) {
        new ExceptionHandler($th);
    }
?>