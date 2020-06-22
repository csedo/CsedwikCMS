<?php 
    class Alerts {

        static function Info($message){
            echo '<div class="alert alert-info" role="alert">
            '.$message.'
        </div>';
        }

        static function Success($message){
            echo '<div class="alert alert-success" role="alert">
            '.$message.'
        </div>';
        }

        static function Warning($message){
            echo '<div class="alert alert-warning" role="alert">
            '.$message.'
        </div>';
        }

        static function Error($message){
            echo '<div class="alert alert-danger" role="alert">
            '.$message.'
        </div>';
        }

    }
