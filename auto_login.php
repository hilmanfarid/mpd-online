<?php
	//echo urlencode('http://172.16.20.3:81/mpd-development/workflow/workflow_summary.php?ELEMENT_ID=1050002017&P_W_DOC_TYPE_ID=500&P_W_PROC_ID=2&PROFILE_TYPE=INBOX&P_APP_USER_ID=17&sumworkflowDir=Asc&sumworkflowPageSize=50');
	//exit;
?>
<html>
	<head>
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	</head>
	<body>
		<form id="Login" name="Login" action="main/sikp_login.php?ccsForm=Login" method="post">
			<input class="input-login" value="<?php echo $_GET['username'];?>" name="redirect"><br>
			<input class="input-login" value="<?php echo $_GET['username'];?>" name="login"><br>
			<input class="input-login" style="BACKGROUND: url(../images/lock.png) buttonhighlight no-repeat left center; background-size: contain" type="password" value="<?php echo $_GET['password'];?>" name="password"><br>
			<input class="btn_tambah" id="LoginButton_DoLogin" style="MARGIN-TOP: 6px; MARGIN-BOTTOM: 7px; WIDTH: 95px; HEIGHT: 32px" type="submit" size="28" value="LOGIN" name="Button_DoLogin">&nbsp; 
		</form>
		<script>
			$(document).ready(function(){
				$('#Login').submit(); 
			});
			
		</script>
	</body>
</html>
