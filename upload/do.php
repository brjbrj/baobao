<?php
$name=$_GET["name"];
$url="../show.php";
 if(unlink("$name")){
 $res="删除成功";
require('../config.php');
$con = mysqli_connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port']);
// 检测连接
if (mysqli_connect_errno())
{
    echo "连接失败: " . mysqli_connect_error();
}
mysqli_query($con,"DELETE FROM tool_files WHERE filepath='$name'");
mysqli_close($con);
 }else{
  $res="删除失败";
 }
?>
<html>
	<title>
		<?php echo $res;?>
	</title>
	<head>
	<meta charset="utf-8" http-equiv = "refresh" content="1; url =<?php echo $url;?>">
	</head>
	<body>
	deteting······1s跳转
	</body>
</html>