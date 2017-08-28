<html>
<head>
<title>Uploading...</title>
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
      system("cp  ".$fullname." ./bak/".$filename."-".time());
      system("mv  ".$fullname." ".$downname);
      echo "Sucessful";
    }
}else{
  echo "file type=".$_FILES['file']['type']."\n";
  echo "Format error";
}
?>
  </div>
</body>
</html>
