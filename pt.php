<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>效果图查看</title>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script>
 <script type="text/javascript">
     function jumpUrl(){
        var url = parent.document.getElementById("sourceUrl").contentWindow.location.href;
        window.open(url);
     }
     function del(value){
         if(confirm("是否继续")){
            var url="./delete.php?value="+$("#pwd").val()+"/"+value;
            window.open(url);
          }
     }
    </script>
</head>
<body>
   <?php
     $type=$_GET['type']; 
   ?>
   <div style="margin:20px" align='left' >
             <?php
                  exec("ls ./".$type,$output);
                  foreach ($output as $value) {
                     echo "<a href='./".$type."/".$value."' target='_blank'><img width='100%' src='./".$type."/".$value."' /></a>";
                     echo "<br/><br/>";
                  }
              ?>
    </dir>
</body>
</html>
