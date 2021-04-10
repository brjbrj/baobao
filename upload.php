<?php
// 允许上传的图片后缀
//echo "上传信息表"."<br>";
$allowedExts = array("gif", "jpeg", "jpg", "png","txt","pptx");
$temp = explode(".", $_FILES["file"]["name"]);
//echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名
		
       // echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
        //echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
       // echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
      //  echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
        
        // 判断当前目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("upload/" . $_FILES["file"]["name"]))
        {
           $up_ok= $_FILES["file"]["name"] . " 文件已经存在。 ";
        }
        else
        {
			if (move_uploaded_file($_FILES['file']['tmp_name'], "upload/".$_FILES["file"]["name"])) {   // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
    			$up_ok="文件上传成功";   // echo "文件存储在: " . "upload/" . $_FILES["file"]["name"];
				require("config.php");
				if ((!defined('SQLITE') && !$dbconfig['user'] || !$dbconfig['pwd'] || !$dbconfig['dbname']|| !$dbconfig['port']|| !$dbconfig['host'])) {
				header('Content-type:text/html;charset=utf-8');
				echo '你还没安装！<a href="/install/">点此安装</a>';
				exit(0);
				}
			#连接数据库
				$db = new mysqli($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port']);
				#设置查询数据格式
				$db->query("SET NAMES UTF8");
				#编辑sql语句
				$date = date("Y-m-d H-i-s");
				$up_url= $_FILES["file"]["name"];
				$sql = "insert into tool_files values (null,\"$up_url\",\"$date\")";
				#执行sql 语句
				$result = $db->query($sql);

				#判断是否注册成功并返回数据
			} else { 		
		$up_ok="文件上传失败"; 
			}    
	}#接收表单注册数据
?>
<style>
	.tip2{
text-align:center;
	margin-top:30px;
	font-size:15px;
	color:red;
	margin:0 auto;
	background-color: transparent;
	border: 0;
	display: block;
	vertical-align:middel;
	outline:none;
	}
</style>
<div class="tip2"><?php echo $up_ok;?></div>
