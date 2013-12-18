<?php
   if ($_SESSION["UserName"]=="") 
   {
?>
   <script language="Javascript">
     top.ttop.location.href="../index.php";
   </script>
<?php   	
     exit;
   } else {
//     echo $_SESSION["UserName"];
   }
?>
