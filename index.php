<?php
 define("RelativePath", ".");
 define("PathToCurrentPage", "/");
 define("FileName", "index.php");
 include_once(RelativePath . "/Common.php");

 if (CCGetUserLogin()!="")
 {
 $dbConn = new clsDBConnSIKP();
	
	$query="SELECT user_role.code FROM sikp.p_app_user usr
	LEFT JOIN sikp.p_app_user_role roles on usr.p_app_user_id = roles.p_app_user_id
	LEFT join sikp.p_app_role user_role on user_role.p_app_role_id = roles.p_app_role_id
	where usr.app_user_name = '".CCGetUserLogin()."'";
	$dbConn->query($query);
	$items=array();
	while($dbConn->next_record()){
		$items = array('code' => $dbConn->f("code"));
	}
?>
<html>
<head>
    <title>.:o:. MPD-Online [<?php echo CCGetUserLogin(); ?>] .:o:.</title>
    <script>
        function closeMyModal(){
            var main_on_child = window.frames['frmmain']['mamain'];
            if(!main_on_child){
                main_frame=window.frames['frmmain'];
            }else{
                main_frame=window.frames['frmmain']['mamain'];
                window.frames['frmmain']['matree'].document.getElementById('mask').style.display='none';
            }
            main_frame.document.getElementById('mask').style.display='none';
            window.frames['frmmenu'].document.getElementById('mask').style.display='none';
            main_frame.document.getElementById('mask-dialog').style.display='none';
        }
        function myModal(){
            var main_on_child = window.frames['frmmain']['mamain'];
            if(!main_on_child){
                main_frame=window.frames['frmmain'];
            }else{
                main_frame=window.frames['frmmain']['mamain'];
            }
            var isMasking = main_frame.document.getElementById('mask');
            if(!isMasking){
                var masking=document.createElement('div');
                masking.setAttribute("id","mask");
                masking.style.backgroundColor='#000000';
                masking.style.height='100%';
                masking.style.opacity='0.28';
                masking.style.position='fixed';
                masking.style.width='100%';
                masking.style.zIndex='0';
                masking.style.display='block';
                var dialog=document.createElement('div');
                dialog.setAttribute("id","mask-dialog");
                dialog.style.backgroundColor= '#FFFFFF';
                dialog.style.border= '1px solid #A2A2A2';
                dialog.style.borderRadius= '4px 4px 4px 4px';
                dialog.style.marginLeft= '40%';
                dialog.style.padding= '7px';
                dialog.style.position= 'fixed';
                dialog.style.top= '35%';
                dialog.style.zIndex= '9999';
                dialog.innerHTML="<div class='dialog-title'>Perhatian</div>Anda Yakin untuk lgout?"+
                '<div id="dialog-option"><input type="button" value="Ya" onClick="top.location.href='+"'../main/sikp_logout.php';"+'"/><input type="button" value="Tidak" onClick="window.parent.closeMyModal();"/></div>';
                //var masking=document.createElement('<div id="mask" style=": 100%;: 0.28;: fixed;: 100%;:0;display:none"></div>');
                //main_frame.document.body.innerHTML+='<div id="mask" style="background-color: #000000;height: 100%;opacity: 0.28;position: fixed;width: 100%;z-index:0;display:none"></div>';
                var maskingMenu=masking.cloneNode(true);
                if(main_on_child){
                    main_frame.document.body.insertBefore(dialog,main_frame.document.getElementById('tabtop'));
                    var maskingRightMenu=masking.cloneNode(true);
                    window.frames['frmmain']['matree'].document.body.insertBefore(maskingRightMenu, window.frames['frmmain']['matree'].document.getElementById('menu-container'));
                    dialog.innerHTML="<div class='dialog-title'>Perhatian</div>Anda Yakin untuk lgout?"+
                '<div id="dialog-option"><input type="button" value="Ya" onClick="top.location.href='+"'../main/sikp_logout.php';"+'"/><input type="button" value="Tidak" onClick="window.parent.parent.closeMyModal();"/></div>';
                }
                main_frame.document.body.insertBefore(masking, main_frame.document.getElementById('tabtop').nextSibling);
                window.frames['frmmenu'].document.body.insertBefore(maskingMenu, window.frames['frmmenu'].document.getElementById('menu-container'));
                main_frame.document.body.insertBefore(dialog,main_frame.document.getElementById('tabtop'));
            }else{
                if(main_frame.document.getElementById('mask').style.display == 'block'){
                    main_frame.document.getElementById('mask').style.display='none';
                    window.frames['frmmenu'].document.getElementById('mask').style.display='none';
                    main_frame.document.getElementById('mask-dialog').style.display='none';
                }else{
                    main_frame.document.getElementById('mask').style.display='block';
                    window.frames['frmmenu'].document.getElementById('mask').style.display='block';
                    main_frame.document.getElementById('mask-dialog').style.display='block';
                    if(main_on_child){
                        window.frames['frmmain']['matree'].document.getElementById('mask').style.display='block';
                    }
                }
            }
        }
    </script>
</head>
<frameset id="UTAMA" border="0" framespacing="0" rows="54,100%,22" frameborder="0">
    <frame name="header" src="main/sikp_header.php" noresize="noresize" scrolling="no" />
    <frameset id="TENGAH" framespacing="1" frameborder="0" cols="20%,*">
        <frame name="frmmenu" src="main/sikp_menu.php" noresize="noresize" scrolling="no"/>
		<?php
			if($items['code']=='WALIKOTA'){
			?>
        	<frame name="frmmain" src="main/p_change_pass_only.php" noresize="noresize" scrolling="yes" />
			<?php }else{ ?>
			<frame name="frmmain" src="main/sikp_home.php" noresize="noresize" scrolling="yes" />
			<?php } ?>
		?>
    </frameset>
    <frame name="footer" src="main/sikp_footer.html" noresize="noresize" scrolling="no" />
    <noframes>
        <body>
            <p>
                This page uses frames, but your browser doesn't support them. 
            </p>
        </body>
    </noframes>
</frameset>
</html>
<?php
} else {
?>
<html>
<head>
    <title>.:o:. MPD-Online .:o:.</title>
</head>
<frameset id="UTAMA" border="0" framespacing="0" rows="100%" frameborder="0">
    <frame name="login" src="main/sikp_login.php" noresize="noresize" scrolling="no" />
    <noframes>
        <body>
            <p>
                This page uses frames, but your browser doesn't support them. 
            </p>
        </body>
    </noframes>
</frameset>
</html>
<?php
 }
?>


