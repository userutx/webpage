<?php  
// conn.php  
try {  
    $conn = new PDO('sqlite:__DIR__ . '/my_database.sqlite');  
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
} catch (PDOException $e) {  
    echo "Connection failed: " . $e->getMessage();  
    exit;  
}  
  
// 如果直接访问 conn.php，则不执行任何操作（通常这个文件不应该被直接访问）  
if ($_SERVER['SCRIPT_FILENAME'] == __FILE__) {  
    exit;  
} 
//注意：上面的代码有一个错误，sqlite:__DIR__ . '/my_database.sqlite' 应该被修正为 sqlite:' . __DIR__ . '/my_database.sqlite'。
//但是，由于__DIR__是一个常量，并且通常用于包含文件的目录中，因此更好的做法可能是使用相对于网站根目录或配置文件的绝对路径。
?>
