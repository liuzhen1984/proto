<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Proto upload</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="js/remodal/dist/remodal.css">
    <link rel="stylesheet" href="js/remodal/dist/remodal-default-theme.css">
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/remodal/dist/remodal.min.js"></script>

 <script type="text/javascript">
     function downloadSource(){
       var url = $("#downloadUrl").val();
        if(url&& url.indexOf("about:")==-1){
            window.open(url);
        }else{
            alert("No original files");
        }
     }
     function jumpUrl(){
        var url = parent.document.getElementById("sourceUrl").contentWindow.location.href;
        window.open(url);
     }
     function jumpImgUrl(){
        var url = parent.document.getElementById("ptUrl").contentWindow.location.href;
        if(url&& url.indexOf("about:")==-1){
            window.open(url);
        }else{
            alert("No image files");
        }
     }
     function jumpAdmin(){
        var url = window.location.href;
         if(url.indexOf("&")>0){
             window.open(window.location.href+"&user=admin");
         }else{
             window.open(window.location.href+"?user=admin");
         }
     }


//整个页面的提交 
function formSubmit(oForm) { 
  $("#displayphoto").html("After uploading successfully, please close the page to refresh view");
} 
    </script>
</head>
<body>
<div align="center" style="font-size:28px">
    Demand prototype management
</div>
<p/>

<div >
     <table width=100%>
        <tr>
           <td >
            <div style="color:red">
<?php
   global $outType;
   if(!isset($outType) ){
       exec("cat conf/type.conf",$outType);
   }
   foreach ($outType as $type){
          $tvalue=explode("=",$type);
          system("mkdir -p ".$tvalue[0]);
          echo "&nbsp;&nbsp;&nbsp;&nbsp;";
          echo "<span><a class='remodal-cancel' href='./?type=".$tvalue[0]."&name=".$tvalue[1]."' >".$tvalue[1]."</a></span> ";
   } 
?>
             </div>
           </td>
        <td align='right'>
<a href="#upload_proto" class="remodal-confirm">Upload Prototype</a>

<div class="remodal" data-remodal-id="upload_proto">
  <button data-remodal-action="close" class="remodal-close"></button>
          <form action="upload_file.php" method="post" enctype="multipart/form-data" target="_blank">

<div align="center">File upload</div>
<br/>

&nbsp;&nbsp;&nbsp;&nbsp;         file type:
<select name="type">
 <?php
   foreach ($outType as $type){
     $tvalue=explode("=",$type);
     echo '<option value ="'.$tvalue[0].'" >'.$tvalue[1].'</option>';
   }
?>
</select>
         <label for="file" style="color:red">&nbsp;&nbsp;Prototype:</label>
          <input type="file" name="file" id="file" accept=".zip"/>
<br/>
<br/>
          <input class="remodal-confirm" type="submit" name="submit" value="Submit" onclick="formSubmit()"/>
         </form>
  <div id="displayphoto"></div> 
</div>

       </td>
      </tr>
    </table>
    <br/> 
    <br/> 
    <br/> 
<input type="button" value="Url" onclick="jumpUrl()" />
<input type="button" value="Image Url" onclick="jumpImgUrl()" />
<input id="bt_download" disabled="disabled" type="button" value="Download sources" onclick="downloadSource()" />
<input type="button" value="Admin" onclick="jumpAdmin()" />
<input type="hidden" id="downloadUrl" value="" />
</div>
<hr/>
<?php 
   $isAdmin="user";
   if(isset($_GET['user'])){
      $isAdmin=$_GET["user"];
   }
   if(!isset($_GET['type']) || empty($_GET['type'])
   ||!isset($_GET['name']) || empty($_GET['name'])){
      $tvalue=explode("=",$outType[0]);
      $url="list.php?type=".$tvalue[0]."&name=".$tvalue[1]."&user=".$isAdmin;
   }
   else{
      $url="list.php?type=".$_GET['type']."&name=".$_GET['name']."&user=".$isAdmin;
   }
?>
<iframe id='sourceUrl' border=2 frameborder=0 width=65% height=1000px marginheight=0 marginwidth=0 scrolling=yes src="<?php echo $url;?>"  style="position:relative;">
</iframe>
<iframe id='ptUrl' border=2 frameborder=0 width=30% height=1000px marginheight=0 marginwidth=0 scrolling=yes src="" style="position:relative;">
</iframe>
</body>
</html>
