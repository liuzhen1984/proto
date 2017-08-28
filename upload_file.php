<html>
<head>
<title>上传中...</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
</head>
<body>
  <div align='center'>
<?php
$type=$_POST['type'];
if($_FILES["file"]["type"]=="application/zip"|| $_FILES["file"]["type"]=="application/octet-stream"|| $_FILES["file"]["type"]=="application/x-msdownload"
|| $_FILES["file"]["type"]=="application/x-zip-compressed"){
  if($_FILES["file"]["error"] > 0)
    {
    echo "Error: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    $filename=$_FILES["file"]["name"];
    $dirname=$_FILES["file"]["name"];
    $path = $type."/".$dirname;
    $fullname=$path."/".$filename;
    $fulldir = $path."/".$dirname;
    $downname = $path."/proto_download_".$filename;
     if (file_exists($fulldir))
      {
         system("rm -rf ".$fulldir);
      }
      system("mkdir -p ".$path);
      move_uploaded_file($_FILES["file"]["tmp_name"], $fullname);
      system("python unzip.py ".$fullname." ".$path);
      system("cp  ".$fullname." /letv/proto/".$filename."-".time());
      system("mv  ".$fullname." ".$downname);
      echo "上传成功";
    }
}else{
  echo "file type=".$_FILES['file']['type']."\n";
  echo "文件格式错误";
}
?>
  </div>
</body>
</html>
