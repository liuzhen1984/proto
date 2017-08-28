<?php  
   $uid=$_GET["uid"];
   $url="http://api.sso.letv.com/api/getUserByID/uid/".$uid;
   $html=file_get_contents($url);
   echo($html); 
?>
