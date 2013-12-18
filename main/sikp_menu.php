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
<link href="../Styles/sikp/layout.css" type="text/css" rel="stylesheet"/>
<style>
	/* Style for tree item text */
	body {
		    border: 1px solid #A2A2A2;
            color: #363636;
            font-size: 20pt;
            height: 99.5%;
            margin: 0 3px 0 5px;
            padding: 0;
	}
	.t0i {
		font-family: Calibri, Arial, Tahoma;
		font-size: 9pt;
		color: #363636;
		background-color: #EFEFEF;
		text-decoration: none;
	}
	.t0i:hover {
		font-family: Calibri, Arial, Tahoma;
		font-size: 9pt;
		color: #363636;
		background-color: #EFEFEF;
		text-decoration: none;
	}
	.t0i:active {
		font-family: Calibri, Arial, Tahoma;
		font-size: 9pt;
		color: #363636;
		background-color: #EFEFEF;
		text-decoration: none;
	}

	/* Style for tree item image */
	.t0im {
		border: 0px;
		width: 14px;
		height: 14px;
	}
</style>
<script type="text/javascript" language="JavaScript" src="../js/menu_tree.js"></script>
<script type="text/javascript" language="javascript">
var tree_tpl = {

	'target'  : 'frmmain',	// name of the frame links will be opened in  other possible values are: _blank, _parent, _search, _self and _top

	'icon_e'  : '../images/empty.gif', // empty image

	'icon_l'  : '../images/line.gif',  // vertical line

	

	'icon_48' : '../images/base.gif',   // root icon normal

	'icon_52' : '../images/base.gif',   // root icon selected

	'icon_56' : '../images/base.gif',   // root icon opened

	'icon_60' : '../images/base.gif',   // root icon selected

	

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

	'icon_18' : '../images/a_plus.gif', // junction for closed node

	'icon_19' : '../images/a_plus.gif',       // junctioin for last closed node

	'icon_26' : '../images/a_minus.gif',// junction for opened node

	'icon_27' : '../images/a_minus.gif'       // junctioin for last opended node

};

</script>
</head>

<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<div id="menu-container" style="height: 100%;overflow-y: auto;width: 100%;">
<table border="0" cellspacing="0" cellpadding="0" width="100%">
</div>
  <tr>
    <td width="100%" valign="top">
<div id="links" style="font-family: Calibri, Arial, Tahoma;">
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
	$count = $dbConn->f("jums")+1;
	
	$query = "select rownum as idap, p_application_id, code from " 
	        ."(select a.p_application_id, d.code from p_application d, p_application_role a, p_app_role b, p_app_user_role c "
		. "where d.p_application_id = a.p_application_id "
		. "and a.p_app_role_id = b.p_app_role_id and c.p_app_role_id = b.p_app_role_id "
		. "and c.p_app_user_id = " . CCGetUserID()
		. " group by a.p_application_id, d.code, d.listing_no order by d.listing_no asc"
		.")";
	
	$dbConn->query($query); 	
 
      
?>
	<ul>
<?php


	while ($dbConn->next_record()) { 
 
		$idap = $dbConn->f("idap");	
		$p_application_id = $dbConn->f("p_application_id");	   
 
?>
		<li style="margin-bottom: 7px;background-color: #EFEFEF;text-align:left; padding:1px;border-radius: 4px 4px 4px 4px;">

                          <table border="0" cellspacing="0" cellpadding="0" width="100%">
                          <tr>
                            <td></td>
                            <td width="100%" style="text-align:center" nowrap>
                               <a style="color:#696969; font-size:11pt; font-weight:bold" href="#" onClick="show('menu_<?=$idap?>', <?=$count?>)"><?=$dbConn->f("code")?></a>
                            </td>
                            <td></td>
                          </tr>
                          </table>
			
			
			<span id="menu_<?=$idap?>" style="text-align:left; background-color: #EFEFEF; border-top: 0px solid #0969B0; border-left: 0px solid #0969B0; border-bottom: 0px solid #7EB5F1; border-right: 0px solid #7EB5F1">
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
	$idap=$idap+1;
	//echo($queryMenu);		
		
?>
	</ul>
	
</form>
</div>
</tr>    
</table>
 
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

function logout()
{
       top.location.href="../main/sikp_logout.php";
}

function SetHeadON()
{
     document.getElementById("tdtoup").style.display="";
     document.getElementById("tdtodown").style.display="none";
     parent.document.getElementById('UTAMA').setAttribute('rows', '104,*,30');

}

function SetHeadOFF()
{
     document.getElementById("tdtoup").style.display="none";
     document.getElementById("tdtodown").style.display="";
     parent.document.getElementById('UTAMA').setAttribute('rows', '1,*,30');
}

</script>

