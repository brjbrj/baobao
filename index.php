<?php
	require("config.php");
	$l1=$dbconfig['domain']."assets/index.css";
	$l2=$dbconfig['domain']."show.php";
?>
</html><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"> 
<title>大宝贝助手</title> 

<link href="<?php echo $l1;?>" rel="stylesheet"/>
<script  type="text/javascript">
	function F_Open()
	{
		document.getElementById("file").click();
		document.getElementById('back').style.display='none';
		document.getElementById('parent').style.display = 'none'; 
	}
	function F_show() 
	{
		if(file.value){
			file_name.value=file.value;
		}else{
			file_name.value="请选择要上传的文件";
		}
	}
	function change_back()
	{
		document.getElementById('back').style.display='block';
	
	}
	function sub() { 
      if(file.value){
		var obj = new XMLHttpRequest(); 
      obj.onreadystatechange = function() { 
        if (obj.status == 200 && obj.readyState == 4) { 
          document.getElementById('con').innerHTML = obj.responseText; 
        } 
      } 
      // 通过Ajax对象的upload属性的onprogress事件感知当前文件上传状态 
      obj.upload.onprogress = function(evt) { 
        // 上传附件大小的百分比 
        var per = Math.floor((evt.loaded / evt.total) * 100) + "%"; 
        // 当上传文件时显示进度条 
        document.getElementById('parent').style.display = 'block'; 
        // 通过上传百分比设置进度条样式的宽度 
        document.getElementById('son').style.width = per; 
        // 在进度条上显示上传的进度值 
        document.getElementById('son').innerHTML = per; 
      } 
      // 通过FormData收集零散的文件上传信息 
      var fm = document.getElementById('file').files[0]; 
      var fd = new FormData(); 
      fd.append('file', fm); 
      obj.open("post", "upload.php"); 
      obj.send(fd); 
	  
			file_name.value="请选择要上传的文件";
		}else{
			file_name.value="无文件上传，请选择文件";
		}
		Show.onclick();
    } 
	function turn()
	{
		location.href="<?php echo $l2;?>";//不给予权限
	}
</script>
</head>
<body >
	<div class="box"></div>
	<div class="theme">大宝贝助手</div>
	
	<div><input class="tip" type="text" id="file_name" disabled="disabled" value="选择要上传的文件"></div>
	<input type="file" id="file" name="file" style="display:none" onchange="F_show()">
	<div class="mydiv_1">
		<button type="button" id="btn_submit" class="mybtn_1" onclick="F_Open()"><span>选择文件</span></button>
	</div>
	<div class="mydiv_2">
    	<button type="submit" class="mybtn_2" onclick="sub()"><span>上传文件</span></button>
	</div>
	<input type="button"  id="Show" onclick="change_back()" style="display:none;">
	<div id="parent"> 
    <div id="son"></div> 
	</div>
	<p id="con"></p> 
	<div class="mydiv_2">
		<button type="button" id="look" class="mybtn_1" onclick="turn()"><span>查看文件</span></button>
	</div>
	
</body>	
</html>