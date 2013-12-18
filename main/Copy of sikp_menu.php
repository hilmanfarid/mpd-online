<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/main/");
define("FileName", "sikp_menu.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
$dbConn = new clsDBConnSIKP();
$dbConnTwo = new clsDBConnSIKP();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>header</title>
<link href="../Styles/sip/layout.css" type="text/css" rel="stylesheet"/>
<style>
	/* Style for tree item text */
	body {
		background-color: #5A718B;
		font-size: 11px;
	}
	.t0i {
		font-family: Tahoma, Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 10px;
		color: #EBF9FF;
		background-color: #313E4D;
		text-decoration: none;
	}
	.t0i:hover {
		font-family: Tahoma, Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 10px;
		color: #00FFFF;
		background-color: #313E4D;
		text-decoration: none;
	}
	.t0i:active {
		font-family: Tahoma, Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 10px;
		color: #FFFF00;
		background-color: #313E4D;
		text-decoration: none;
	}

	/* Style for tree item image */
	.t0im {
		border: 1px;
		width: 18px;
		height: 16px;
	}
</style>
<script type="text/javascript" language="JavaScript" src="../js/menu_tree.js"></script>
<script type="text/javascript" language="javascript">
var tree_tpl = {

	'target'  : 'frmmain',	// name of the frame links will be opened in  other possible values are: _blank, _parent, _search, _self and _top

	'icon_e'  : '../images/empty.gif', // empty image

	'icon_l'  : '../images/line.gif',  // vertical line

	

	'icon_48' : '../images/list.gif',   // root icon normal

	'icon_52' : '../images/list.gif',   // root icon selected

	'icon_56' : '../images/list.gif',   // root icon opened

	'icon_60' : '../images/list.gif',   // root icon selected

	

	'icon_16' : '../images/folder.gif', // node icon normal

	'icon_20' : '../images/folderopen.gif', // node icon selected

	'icon_24' : '../images/folder.gif', // node icon opened

	'icon_28' : '../images/folderopen.gif', // node icon selected opened



	'icon_0'  : '../images/page.gif', // leaf icon normal

	'icon_4'  : '../images/page.gif', // leaf icon selected

	'icon_8'  : '../images/page.gif', // leaf icon opened

	'icon_12' : '../images/page.gif', // leaf icon selected

	

	'icon_2'  : '../images/joinbottom.gif', // junction for leaf

	'icon_3'  : '../images/join.gif',       // junction for last leaf

	'icon_18' : '../images/plusbottom.gif', // junction for closed node

	'icon_19' : '../images/plus.gif',       // junctioin for last closed node

	'icon_26' : '../images/minusbottom.gif',// junction for opened node

	'icon_27' : '../images/minus.gif'       // junctioin for last opended node

};

</script>
</head>

<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<div id="links"  style="font-family: Tahoma, Verdana, Geneva, Arial, Helvetica, sans-serif;font-size: 12px;>
<form name="menuform" id="menuform">
<?php
	$queryCount = "select count(*) jums " 
			. "from (select a.p_application_id, d.code from p_application d, p_application_role a, p_app_role b, p_app_user_role c "
			. "where d.p_application_id = a.p_application_id "
			. "and a.p_app_role_id = b.p_app_role_id and c.p_app_role_id = b.p_app_role_id "
			. "and c.p_app_user_id = " . CCGetUserID() 
			. " group by a.p_application_id, d.code " 
			. ")";
	
	$dbConn->query($queryCount);
	$dbConn->next_record();
	$count = $dbConn->f("jums");
	
	$query = "select rownum as idap, p_application_id, code from " 
	        ."(select a.p_application_id, d.code from p_application d, p_application_role a, p_app_role b, p_app_user_role c "
		. "where d.p_application_id = a.p_application_id "
		. "and a.p_app_role_id = b.p_app_role_id and c.p_app_role_id = b.p_app_role_id "
		. "and c.p_app_user_id = " . CCGetUserID()
		. " group by a.p_application_id, d.code "
		.")";
	
	$dbConn->query($query); 	
 
      
?>
	<ul>
<?php


	while ($dbConn->next_record()) { 
 
		$idap = $dbConn->f("idap");	
		$p_application_id = $dbConn->f("p_application_id");	   
 
?>
		<li>
			<a href="#" onclick="show('menu_<?=$idap?>', <?=$count?>)"><?=$dbConn->f("code")?></a>
			<span id="menu_<?=$idap?>" style="background-color: #313E4D;border: 0px solid #000000">
<?php
    
	$queryMenu = "select p_app_menu_id as p_menu_id, nvl (parent_id, 0) parent_id, menu, file_name, description, listing_no "
			."from "
			."(select * "
			."from (select p_app_menu_id, parent_id, code as menu, nvl (file_name, '0') as file_name,"
			."	description, listing_no "
			."	from p_app_menu "
			."	where is_active = 'Y' "
			."	and p_application_id = ".$p_application_id." "
			."	and p_app_menu_id in ( "
			."	select rm.p_app_menu_id "
			."	from p_app_role_menu rm, p_app_user_role ur, p_app_user u "
			."	where rm.p_app_role_id = ur.p_app_role_id "
			."	and ur.p_app_user_id = u.p_app_user_id "
			."	and ur.p_app_user_id = (select x.p_app_user_id from p_app_user x where x.app_user_name = decode('".CCGetSession("UserLogin")."','ADMIN',u.app_user_name,'".CCGetSession("UserLogin")."'))) " 
			." start with parent_id is null connect by prior p_app_menu_id = parent_id order siblings by nvl(listing_no, 9999)))";
			//die($queryMenu);
	//echo($queryMenu);
          
        // SQL SALAH ganti  
	//$queryMenu = "select * from ( "
	//	. "select x.P_APP_MENU_ID as P_MENU_ID, nvl(x.PARENT_ID,0) PARENT_ID, "
	//	. "x.CODE as MENU, x.FILE_NAME from p_app_menu z, "
	//	. "(select a.* from p_app_menu a order by a.parent_id, a.listing_no) x "
	//	. "where z.p_app_menu_id = x.p_app_menu_id and x.is_active = 'Y' and x.p_application_id = ".$idap." "
	//	. "start with nvl(x.parent_id,0)=0 connect by prior x.p_app_menu_id=x.parent_id) aa";	
	//echo($queryMenu);	
			
	$dbConnTwo->query($queryMenu);

	
?>
				<script language="JavaScript" type="text/javascript">
					var TREE_ITEMS = 
						[
							['HOME', 'sikp_home.php'
					<?php
						$PLevel= array (-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,);
						$level = 0;
						$bdmnid = 0;
						$nplevel = 0;
						$parid = 0;
						  
						while ($dbConnTwo->next_record()) {
							
							
							
							if ($dbConnTwo->f("p_menu_id")!=$bdmnid) {
								$bdmnid=$dbConnTwo->f("p_menu_id");

								$parid= $dbConnTwo->f("parent_id");

								if ($parid==$PLevel[$level]) {
									echo "]," . chr(13);
								} else {
									if ($parid==$nplevel) {
										echo "," . chr(13);
										$level=$level+1;
										$PLevel[$level]=$parid;
									} else {
										echo "]," . chr(13);
										while ($PLevel[$level]!=$parid && $level>0) {
											echo "]," . chr(13);
											$level=$level-1;
										}
									}
								}

								$nplevel = $dbConnTwo->f("p_menu_id");
								$fileName = $dbConnTwo->f("file_name");
								echo "['" . $dbConnTwo->f("menu");
								
								if (empty($fileName)) {
									echo "',''";
								} else {
									echo "','sikp_open.php?NAMAPHP=" . $fileName . "&P_APP_MENU_ID=" . $dbConnTwo->f("p_menu_id")."'";
								}
							}
						}
						while ($level>0) {
							echo "]," . chr(13);
							$level=$level-1;
						}
					?>
						],
					];
					new tree (TREE_ITEMS, tree_tpl);
				</script>
			</span>
		</li>
<?php
	}
	$dbConn->close();
	$dbConnTwo->close();
	
	//echo($queryMenu);		
		
?>
	</ul>
	<ul>
	<li>
	<a href="../main/sikp_logout.php" target="frmmain">LOGOUT</a>
	</li>
	</ul>
<form>
</div>

</body>
</html>
<script language="javascript" type="text/javascript">
function show(id, jums) { 
	var displayVal = "";
	var namaId = "";
	for (var i=1; i<=jums; i++) { 
		namaId = "menu_" + i; 
		displayVal = "";
		if (namaId == id) {
			displayVal = "block";
			if (document.getElementById(namaId).style.display == "block") {
			   displayVal = "none";
		         }	
		} else {
			displayVal = "none";
		}
		document.getElementById(namaId).style.display = displayVal;
	}
}
</script>

