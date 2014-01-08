<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/main/");
define("FileName", "sikp_header.php");
include_once(RelativePath . "/Common.php");

$user = CCGetUserLogin();
?>
<html>
<head>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="../Styles/sikp/Style_doctype.css">
<script>
	var refreshIntervalId = setInterval(function(){
		$.getJSON( "../services/session_check.php", function( data ) {
			var items = [];
			if(data.UserName == '' || data.UserName == null || data.UserName == "undefinied"){
				alert('Session Anda Telah Habis, Silahkan Login Kembali');
				window.parent.document.location='../index.php';
			}
			$.each( data, function( key, val ) {
				//items.push( "<li id='" + key + "'>" + val + "</li>" );
			});
		});
		
    },20000);
    function callModal()
     {
        window.parent.myModal(); // I know this wont work.. just an example
     }
</script>
</head>
<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<div class="header-app">
    <div style="border-radius: 4px 4px 4px 4px;bottom: 9px;color: #F3FCFF;font-size: 21px;font-weight: bold;margin-left: 18px;padding: 2px 10px 2px 9px;position: absolute;"> Modul Penerimaan Pajak Daerah </div>
    <div id="header-info" style="font-weight:bold;color:#ECECEC;bottom: 9px;position: absolute;right: 21px;text-align: right;">Selamat datang <?=$user?> | <a href="#" onClick="logout();">Logout</a></div>
    <div style="width:100%;background: url('../images/header.png') no-repeat scroll right 7px / 70% 48px rgba(0, 0, 0, 0);height: 100%;"></div>
</div>
</body>
</html>
<script>
 function logout(){
		if (confirm("Anda yakin mau logout?")==1)
		  {
			 top.location.href="../main/sikp_logout.php";
		  }
		}
</script>
