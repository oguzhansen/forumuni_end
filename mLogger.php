<?php

class mLogger
{
    const LOG_DIRECTORY = "logs";
    static function insert($log)
    {
        $logFile = date("Y-m-d") . ".log";
        
        if(!file_exists(self::LOG_DIRECTORY))
        {
            mkdir(self::LOG_DIRECTORY);
        } 
        
        else 
        {
            $file = fopen(self::LOG_DIRECTORY."/".$logFile, 'a');
            $write = fwrite($file, "[" . date("Y-m-d H:i:s") . "]: " . $log.PHP_EOL.PHP_EOL);
            fclose($file);
        }
    }
}

?>