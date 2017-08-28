<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
</head>
<body>
<div align='center'>
<?php
if(isset($_GET["value"])){
   $value=$_GET['value'];
   system("rm -rf ".$value);
   echo "删除成功!".$value;
}else{
   echo "参数错误";
}
?>
</div>
</body>
</html>
