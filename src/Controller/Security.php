<?php
    class Security{
        private DatabaseController $mysql;

        function __construct(){
            $this->mysql = new DatabaseController();
        }
    }