
<?php
header('Content-Type: text/html; charset=utf-8');
require("config.php");
if ((!defined('SQLITE') && !$dbconfig['user'] || !$dbconfig['pwd'] || !$dbconfig['dbname']|| !$dbconfig['port']|| !$dbconfig['host'])) {
	header('Content-type:text/html;charset=utf-8');
	echo '你还没安装！<a href="/install/">点此安装</a>';
	exit(0);
}
$l1=$dbconfig['domain']."assets/show.css";
echo "<link href=\"$l1\" rel=\"stylesheet\"/>";
// 创建连接
$conn = new mysqli($dbconfig['host'], $dbconfig['user'], $dbconfig['pwd'], $dbconfig['dbname']);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$sql = "SELECT * FROM tool_files";
$result = $conn->query($sql);
	echo "<p class=\"headname\">"."<a>"."文件列表"."</a>"."</p>";
if ($result->num_rows > 0) {
    // 输出数据
	echo "<p class=\"myp\"><a class=\"myid\">"."ID"."</a><a class=\"myfn\">"."文件名称"."<a  class=\"delete\">"."删除键"."</a><a class=\"dload\">下载键"."</a>"."<a class=\"mydate\">创&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp建&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp日&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp期"."</a>"."</p>";
    while($row = $result->fetch_assoc()) {
		$fid=$row["id"];
		$file=$row["filepath"];
		$path=$dbconfig['domain'].$dbconfig["file"]."/".$file;
		$filep=$dbconfig['domain'].$dbconfig["file"]."/do.php?name=".$file;
		//$path="http://jz.jiyijian.com/cloud/upload/".$row["filepath"];
		$fdate=$row["update"];
       echo "<p class=\"myp\"><a class=\"myid\">".$fid."&nbsp".":</a><a class=\"myfn\">".$file."<a href=\"$filep\"  class=\"delete\">"."删&nbsp&nbsp&nbsp除"."</a><a  href=\"$path\" download=\"$path\" class=\"dload\">下&nbsp&nbsp&nbsp载"."</a>"."<a class=\"mydate\">".$fdate."</a>"."</p>";
    }
} else {
    echo "<p class=\"nodata\"><a >暂无数据</a></p>";
}
$ret=$dbconfig['domain']."index.php";
echo "<p class=\"back\">"."<a href=\"$ret\" style=\"text-decoration: none;\">"."返回"."</a>"."</p>";
?>