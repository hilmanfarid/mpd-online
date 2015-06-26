<?php
	//echo base64_encode('Anda Mendapatkan 1 Pekerjaan belum disubmit :');
	//exit;
?>
<html>
	<head>
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	</head>
	<body>
		<form id="Login" name="Login" action="main/sikp_login.php?ccsForm=Login&redirect=<?php echo $_GET['redirect'];?>" method="post">
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
