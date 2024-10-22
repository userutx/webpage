<?php  
$servername = "localhost";  
$username = "your_username";  
$password = "your_password";  
$dbname = "mydatabase";  
  
// 创建连接  
$conn = new mysqli($servername, $username, $password, $dbname);  
  
// 检查连接  
if ($conn->connect_error) {  
    die("连接失败: " . $conn->connect_error);  
}  
  
function insertUrl($conn, $url) {  
    $sql = "INSERT INTO urls (url) VALUES ('$url')";  
    if ($conn->query($sql) === TRUE) {  
        echo "新记录插入成功";  
    } else {  
        echo "Error: " . $sql . "<br>" . $conn->error;  
    }  
}  
  
function fetchUrls($conn) {  
    $sql = "SELECT id, url FROM urls";  
    $result = $conn->query($sql);  
  
    $urls = array();  
    if ($result->num_rows > 0) {  
        // 输出数据  
        while($row = $result->fetch_assoc()) {  
            $urls[] = $row;  
        }  
    } else {  
        echo "0 结果";  
    }  
    $conn->close();  
    return json_encode($urls);  
}  
?>
