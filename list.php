<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Demand List</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="js/remodal/dist/remodal.css">
    <link rel="stylesheet" href="js/remodal/dist/remodal-default-theme.css">
    <script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script>
<style>
a:link, a:visited {
 text-decoration: none;
 color:black;
 background-color: #fff;
}
a:hover{
color:#f00; //Red
}
</style>
 <script type="text/javascript">
     function jumpUrl(){
        var url = parent.document.getElementById("sourceUrl").contentWindow.location.href;
        window.open(url);
     }
     function setDownloadUrl(url){
        if(url){
             parent.document.getElementById("downloadUrl").value=url;
             parent.document.getElementById("bt_download").disabled="";
             parent.document.getElementById("bt_download").style.background="blue";
        }else{
             parent.document.getElementById("bt_download").disabled="disabled";
             parent.document.getElementById("bt_download").style.background="";
        }
     }
     function setImgUrl(url,url2){
        if(url){
            parent.document.getElementById("ptUrl").contentWindow.location.href=url;
            parent.document.getElementById("ptUrl").width='33%';
            parent.document.getElementById("sourceUrl").width='65%';

        }else{
            parent.document.getElementById("ptUrl").width='1%';
            parent.document.getElementById("sourceUrl").width='100%';

        }
        parent.document.getElementById("sourceUrl").contentWindow.location.href=url2;
     }
     function del(value){
         if(confirm("DELETE?")){
            var url="./delete.php?value="+$("#pwd").val()+"/"+value;
            window.open(url);
          }
     }
    </script>
</head>
<body>
   <?php
     $type=$_GET['type']; 
     $name=$_GET['name'];
      echo "<h1>".$name."</h1>";
      echo "<input type='hidden' id='pwd' value='".$type."'/>";
   ?>
   <div style="margin:20px" align='left' >
             <?php
                  if(is_file("./".$type)){
                       header("Location: ./".$type);
                  }
                  exec("ls ./".$type,$output);
                  if(in_array("index.html",$output)){
                       if(file_exists("./".$type."/PT")){
                           echo "<script type='text/javascript'>setImgUrl('./pt.php?type=./".$type."/PT/','./".$type."/')</script>";
                       }else{
                           echo "<script type='text/javascript'>setImgUrl('','./".$type."/')</script>";
                       }
                       //header("Location: ./".$type."/");
                  }
		 echo "<table>";
                  $isDown = 0;
                  foreach ($output as $value) {
                     $showname=$value;
                     
                     if(substr($value,-4)==".zip"){
                         $showname=substr($value,0,-4);
                     }
                     if(substr($value,0,15)=="proto_download_"){
		   	 echo "<script type='text/javascript'>setDownloadUrl('./".$type."/".$value."')</script>";
                         $isDown=1;
                         continue;
                     }
                     echo "<tr height='30px'><td >&middot;&nbsp;&nbsp;<a style='text-decoration:none' href='./list.php?type=".$type."/".$value."&name=".$value."/' >".$showname."</a></td>";
                     if(isset($_GET['user']) && $_GET['user']=="admin"){
                        echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\"delete\" class='remodal-cancel' onclick=\"del('".$value."')\"/> </td>";
                     }
                     echo "</tr>";
                  }
                  if($isDown==0){
			echo "<script type='text/javascript'>setDownloadUrl('')</script>";
                  }
		 echo "</table>";
              ?>
    </dir>
</body>
</html>
