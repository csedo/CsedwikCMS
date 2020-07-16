<?php 
    require_once('Controller/ClassAutoLoader.php');
    try {
        new ClassAutoLoader();
        SessionController::InitSession();
        SiteGenerator::RenderSite();
    } catch (\Throwable $th) {
        new ExceptionHandler($th);
    }
?>