<?php

function logError($message, $file, $line) {
   
    $logFile ='logs/error_log.txt'; 
    $currentDateTime = date('Y-m-d H:i:s');
    $errorMessage = "[$currentDateTime] Error in $file at line $line: $message" . PHP_EOL;
    file_put_contents($logFile, $errorMessage, FILE_APPEND);
}


