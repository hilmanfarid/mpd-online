<?php
//Include Common Files @1-6B6005D9
define("RelativePath", "..");
define("PathToCurrentPage", "/include/");
define("FileName", "head_lap.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");

$name_of_report=CCGetRequestParam("name_of_report",ccsGet,"_");
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../Styles/hms/Style_doctype.css">
<script language="javascript" src="../js/qs.js"></script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <table border="0" cellspacing="0" cellpadding="0" width="100%">
    <tr>
      <td><img border="0" src="../images/tab_s_off.gif"></td> 
      <td><img border="0" src="../images/tab_off.gif"></td> 
      <td class="th" background="../images/tab_off.gif" ><img onclick="javascript:to_caller()" border="0" alt="back" src="../images/to_left_black.gif"></td> 
      <td><img border="0" src="../images/tab_off.gif"></td> 
      <td><img border="0" src="../images/tab_e_off.gif"></td> 
      <td><img border="0" src="../images/tab_s_on.gif"></td> 
      <td class="th" background="../images/tab_on.gif" nowrap align="center"><?=$name_of_report?></td> 
      <td><img border="0" src="../images/tab_e_on.gif"></td> 
      <td background="../images/tab_back.gif" width="100%"></td>
    </tr>
  </table>
<script language="javascript">
function to_caller() {                
    var caller = QueryString("caller_program");
    var origin_param=QueryString_Remove(null, "caller_program");
        origin_param=QueryString_Remove(origin_param, "name_of_report");
//        origin_param=origin_param.substring(1);
    var mylocation=caller+"?"+origin_param;    
    mylocation = mylocation.replace(/%2F/g,"/").replace(/%3F/g,"?").replace(/%3D/g,"=").replace(/%26/g,"&");    
    parent.location.href=mylocation;
}
</script>
</body>
</html>