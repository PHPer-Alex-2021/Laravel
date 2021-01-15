<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadify.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>
</head>

<body>
	<h1>Uploadify Demo</h1>
	<form>
		<div id="queue"></div>
		<input id="file_upload" name="file_upload" type="file" multiple="true">
	</form>

  <script type="text/javascript">
     $(document).ready(function() {
     $("#fileInput2").uploadify({
     'uploader': 'js/uploadify.swf',//所需要的flash文件
     'cancelImg': 'cancel.png',//单个取消上传的图片
     'script': 'js/uploadify.php',//实现上传的程序
     'folder': 'uploads',//服务端的上传目录
     //'auto': true,//自动上传
     'multi': true,//是否多文件上传
     //'checkScript': 'js/check.php',//验证 ，服务端的
     'displayData': 'speed',//进度条的显示方式
     //'fileDesc': 'Image(*.jpg;*.gif;*.png)',//对话框的文件类型描述
     'fileExt': '*.jpg;*.jpeg;*.gif;*.png',//可上传的文件类型
     //'sizeLimit': 999999 ,//限制上传文件的大小
     'simUploadLimit' :3, //并发上传数据
     'queueSizeLimit' :20, //可上传的文件个数
     'buttonText' :'文件上传',//通过文字替换钮扣上的文字
     'buttonImg': 'css/images/browseBtn.png',//替换上传钮扣
     'width': 80,//buttonImg的大小
     'height': 24,//
     'rollover': true,//button是否变换
     onComplete: function (evt, queueID, fileObj, response, data) {
     //alert("Successfully uploaded: "+fileObj.filePath);
     //alert(response);
     getResult(response);//获得上传的文件路径
     }
     //onError: function(errorObj) {
     //     alert(errorObj.info+"  "+errorObj.type);
     //}
     });
     });
     </script>
</body>
</html>