<?php 

    date_default_timezone_set('Europe/Budapest');

    class Log extends DatabaseController{

        protected static $Logdir;
        static $timeStamp = "Y-m-d H:i:s";
        static $fileName = "HS-Core-Log.txt";   

        function __construct(){
            self::$Logdir = dirname(__FILE__) . DIRECTORY_SEPARATOR ."Log";
            parent::__construct();
            $this->CreateDirectory();
            $this->CreateFile();
        }

        protected function sqlquery($log){
            $this->Execute('INSERT INTO `log` (`log`,`date`) VALUES ("'.$log.'","'.date('Y-m-d H:i:s').'")');
        }
        static function Add($log){
            if(!empty($log)){
                $database = new self;
                $database->sqlquery($log);
                $string = self::logTime().$log.PHP_EOL;
                $filename = self::$Logdir.'/'.Log::LogFileName();
                file_put_contents($filename,$string,FILE_APPEND);
            }
        }

        protected static function logTime(){
			return date('Y-m-d H:i:s: ');
        }

        protected static function logDate(){
			return date('Y-m-d');
        }

        static function LogFileName(){
            return Log::LogDate().'-'.self::$fileName;
        }

        // Create today's logfile if not exist
        protected function CreateFile(){
            if(!file_exists(self::$Logdir.'/'.Log::LogFileName())){
                file_put_contents(self::$Logdir.'/'.Log::LogFileName(),self::logTime().'Log file created.'.PHP_EOL);
            }
        }

        // Create Logs directory if not exist
        public function CreateDirectory(){
            if(!file_exists(self::$Logdir)){
                mkdir(self::$Logdir,0777);
            }
        }
    }
?>