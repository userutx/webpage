<?php  
// check.php  
function checkPostData($device_id, $url) {  
    // 这里应该添加实际的检查逻辑  
    // 例如，验证设备标识是否在允许的列表中，以及URL是否符合特定的格式  
      
    // 假设这里只是简单地检查设备标识是否为"valid_device"且URL不为空  
    $isValidDevice = ($device_id === "valid_device");  
    $isValidUrl = (!empty($url) && filter_var($url, FILTER_VALIDATE_URL));  
      
    return $isValidDevice && $isValidUrl;  
}  
  
// 如果直接访问 check.php，则不执行任何操作（通常这个文件不应该被直接访问）  
if ($_SERVER['SCRIPT_FILENAME'] == __FILE__) {  
    exit;  
}  
?>
