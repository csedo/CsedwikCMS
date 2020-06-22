<?php
    class DatabaseController{

        public $connection;
        public $error   = array();

        public $host;
        public $user;
        public $password;
        public $database;
        public $encoding;

        public function __construct($host = '', $user = '', $password = '', $database = ''){
            $_GET       = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
            $_POST      = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $_REQUEST   = (array)$_POST + (array)$_GET + (array)$_REQUEST;

            $this->host = Config::$DatabaseController_host;
            $this->user = Config::$DatabaseController_user;
            $this->password = Config::$DatabaseController_password;
            $this->database = Config::$DatabaseController_database;

            if($host != ''){
                $this->host = $host;
                $this->user = $user;
                $this->password = $password;
                $this->database = $database;
            } 
            try{
                $this->MySQLConnect();

            }catch(Exception $e){
                echo $e->getMessage();
            }
        }

        public function __destruct(){
            $this->host = NULL;
            $this->user = NULL;
            $this->password = NULL;
            $this->database = NULL;

            mysqli_close($this->connection);
        }

        public function MySQLConnect(){
            $this->connection = mysqli_connect($this->host,$this->user,$this->password,$this->database);
            if(! $this->connection){
                throw new Exception("Failed to connect to Database", 1);
            }
            return $this->connection;
        }

        protected function setError($error){
            array_push($this->error,$error);
        }
        public function error(){
            return $this->error[count($this->error)-1];
        }

        protected function Query($query){
            
            if($this->CheckConnection() === false){
                return false;
            }
            $execute            = mysqli_query($this->connection,$query);
            if(!$execute){
                $e  = 'MySQL query error: '.mysqli_error($this->connection);
                $this->setError($e);
            }
            return $execute;
        }

        protected function CheckConnection(){
            if(! $this->connection){
                $e  = 'DB connection failed';
                $this->setError($e);
                return false;
            }
            return true;
        }

        public function AffectedRows(){
            return mysqli_affected_rows($this->connection);
        }

        public function Execute($query){
            if($this->CheckConnection() === false){
                return false;
            }
            $return = array();
            $execute = $this->Query($query);
            if($execute === false){
                $e = 'MySQL query error '.mysqli_error($this->connection);
                $this->setError($e);

                echo $e;

                return false;
            }
            if(!is_bool($execute)){
                while($row = mysqli_fetch_array($execute)){
                    $return[] = $row;
                }
            }
            return $return;
        }
        
        static function StaticValue($query,$column){
            $mysql = new self;
            return $mysql->connection-> query($query)->fetch_array(MYSQLI_ASSOC)[$column];
        }
        /**
         * SELECT $column FROM $table WHERE $where = $value
         */
        /*static function GetValueMysql($column,$table,$where,$value){
            $query = self::Execute('SELECT "'.$column.'" FROM "'.$table.'" WHERE "'.$where.'" = "'.$value.'"');
            {
                foreach($query as $row){
                    return $row[$column];
                }
            }
        }*/
    }
?>