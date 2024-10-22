<?php  
// log.php  
//function logMessage($message) {  
//    $logFilePath = 'log.txt';  
//    $currentTime = date('Y-m-d H:i:s');  
//    $logMessage = "$currentTime - $message\n";  
      
    // 使用FILE_APPEND标志以追加模式打开文件  
//    file_put_contents($logFilePath, $logMessage, FILE_APPEND | LOCK_EX);  
//}  
  
// 如果直接访问此文件，则记录一个测试消息（通常不会这样做，这里只是为了测试）  
//if (php_sapi_name() === 'cli' || empty($_SERVER['REMOTE_ADDR'])) {  
//    logMessage('This is a test log message from log.php directly.');  
//}  
//?>

//<?php  
// log.php  
function logMessage($message) {  
    $logFilePath = __DIR__ . '/log.log'; // 假设日志文件名为 log.log  
    $currentTime = date('Y-m-d H:i:s');  
    $logMessage = "$currentTime - $message\n";  
    file_put_contents($logFilePath, $logMessage, FILE_APPEND | LOCK_EX);  
}  
  
// 如果直接访问 log.php，则返回“测试访问”  
if ($_SERVER['SCRIPT_FILENAME'] == __FILE__) {  
    echo "测试访问";  
    exit;  
}  
?>
