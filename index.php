
<?php  
// index.php  
require_once 'conn.php';  
require_once 'check.php';  
require_once 'log.php';  
  
// 处理POST请求  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
    $device_id = isset($_POST['device_id']) ? $_POST['device_id'] : null;  
    $url = isset($_POST['url']) ? $_POST['url'] : null;  
      
    if (checkPostData($device_id, $url)) {  
        // 如果数据有效，则将其存入数据库  
        $stmt = $conn->prepare("INSERT INTO urls (device_id, url) VALUES (?, ?)");  
        $stmt->execute([$device_id, $url]);  
          
        logMessage("URL '$url' from device '$device_id' has been stored in the database.");  
        echo "数据更新正确";  
    } else {  
        // 如果数据无效，则丢弃数据并记录日志  
        logMessage("Invalid data received: device_id='$device_id', url='$url'");  
        echo "数据不正确，已丢弃";  
    }  
}  
  
// 处理GET请求  
elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {  
    // 从数据库中获取所有正确的URL（这里假设您有一个is_valid字段来标记，但上面的conn.php和check.php中并未提及，因此这里简化处理）  
    // 注意：实际上，您可能需要在数据库中添加一个is_valid字段，并在插入时设置其值，或者在查询时添加额外的逻辑来过滤无效的URL  
    $stmt = $conn->query("SELECT url FROM urls");  
    $urls = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);  
      
    // 读取client.html内容  
    $clientHtml = file_get_contents(__DIR__ . '/client.html');  
      
    // 将URL列表和client.html内容作为JSON响应给客户端  
    header('Content-Type: application/json');  
    echo json_encode(['urls' => $urls, 'html' => $clientHtml]);  
      
    logMessage("Fetched and returned " . count($urls) . " URLs and client.html content.");  
} else {  
    // 如果请求方法不是POST或GET，则记录日志并返回错误消息  
    logMessage("Unsupported request method: " . $_SERVER['REQUEST_METHOD']);  
    echo "不支持的请求方法";  
}  
  
// 关闭数据库连接（注意：在PHP中，当脚本执行完毕时，PDO对象会自动关闭连接，但显式关闭是一个好习惯）  
$conn = null;  
?>
