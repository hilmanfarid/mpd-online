<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_app_menu_tree.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");

$dbConn = new clsDBConnSIKP();
?>
<html>
<head>
    <title>MENU TREE</title>
    <link href="../Styles/StyleMENU.css" type="text/css" rel="stylesheet" />
    <style>
	/* Style for tree item text */
	.t0i {
		font-family: Calibri, Arial, Tahoma;
		font-size: 10pt;
		color: #000000;
		/*background-color: #EFEFEF;*/
		text-decoration: none;
	}
	/* Style for tree item image */
	.t0im {
		border: 0px;
		width: 14px;
		height: 14px;
	}
	/* Style for overmouse item text */
	.t0iMO {
		font-family: Calibri, Arial, Tahoma;
		font-size: 10pt;
		color: silver;
		background-color: #000000;
		text-decoration: none;
	}
	.t0i:hover {
		font-family: Calibri, Arial, Tahoma;
		font-size: 10pt;
		color: #FF0000;
		/*background-color: #EFEFEF;*/
		text-decoration: none;
	}
	.t0i:active {
		font-family: Calibri, Arial, Tahoma;
		font-size: 10pt;
		color: #FF0000;
		/*background-color: #EFEFEF;*/
		text-decoration: none;
	}
.style1 {font-family: Calibri, Arial, Tahoma}
    </style>
</head>
<body style="border:1px solid #A2A2A2;height:100%;" class="" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<?php
	$queryApp = "select upper(code) code from p_application where p_application_id=".$_GET["p_application_id"];
	$dbConn->query($queryApp);
	$dbConn->next_record();
	$appCode = $dbConn->f("code");
	$query = "SELECT p_app_menu_id p_menu_id, NVL (parent_id, 0) parent_id, menu, path_file_name, description "
		. "FROM (SELECT   p_app_menu_id, parent_id, upper(code) menu, NVL (file_name, '0') path_file_name, description, "
		. "listing_no FROM p_app_menu WHERE p_application_id = ".$_GET["p_application_id"]." "
		. "ORDER BY NVL (parent_id, 0), listing_no) x START WITH x.parent_id IS NULL "
		. "CONNECT BY PRIOR x.p_app_menu_id = x.parent_id ORDER SIBLINGS BY NVL (listing_no, 9999)";
	$dbConn->query($query);
?>
<div id="menu-container" style="padding: 5px;">
    <table style="background-color:#EFEFEF;border: 1px solid #A2A2A2;border-radius: 4px 4px 4px 4px;padding: 0;" cellspacing="0" width="100%" border="0">
        <tbody>
            <tr>
                <td class="CobaltHeaderTD" style="color: #696969;font-size: 11pt;font-weight: bold;font-family:Calibri,Arial,Tahoma;>
                    <span class="style1">&nbsp;<b>MENU</b></span></td>
            </tr>
            <tr>
                <td style="COLOR: #000000;" valign="top" height="100%">
                    <script language="JavaScript" src="../js/white_tree.js"></script>
                    <script language="JavaScript">

var tree_tpl = {
	'target'  : 'mamain',	// name of the frame links will be opened in
				// other possible values are: _blank, _parent, _search, _self and _top
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


var TREE_ITEMS =
 [
  ['HOME (ROOT)', 'p_app_menu.php?retree=1&parent_id=0&p_application_id=<?=$_GET["p_application_id"]?>&p_applicationGridPage=<?=$_GET["p_applicationGridPage"]?>&app_s_keyword=<?=$_GET["app_s_keyword"]?>"'
<?php
	$PLevel= array (-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,);
	$level = 0;
	$bdmnid = 0;
	$nplevel = 0;
	$parid = 0;
	while ($dbConn->next_record()) {
		if ($dbConn->f("p_menu_id")!=$bdmnid) {
			$bdmnid=$dbConn->f("p_menu_id");
			$parid= $dbConn->f("parent_id");
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
			$nplevel = $dbConn->f("p_menu_id");
			$fileName = $dbConn->f("path_file_name");
			echo "['" . $dbConn->f("menu");
			if ($fileName=="") {
				echo "',''";
			} else {
				
				//echo "','sip_open.php?NAMAPHP=" . $fileName . "&P_APP_MENU_ID=" . $dbConnTwo->f("p_menu_id")."'";
				echo "','p_app_menu.php?retree=1&parent_id=".$dbConn->f("p_menu_id")."&p_application_id="
					.$_GET["p_application_id"]."&p_applicationGridPage=".$_GET["p_applicationGridPage"]."&app_s_keyword=".$_GET["app_s_keyword"]."'";
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
</td>
            </tr>
        </tbody>
</table>
</div>
</body>
</html>
