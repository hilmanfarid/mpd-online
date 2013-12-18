<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/main/");
define("FileName", "sip_logout.php");
include_once(RelativePath . "/Common.php");

CCLogoutUser();
?>
<script language="JavaScript" type="text/javascript">
 top.location.href= "../index.php"; 
</script>
<?php
//
?>


