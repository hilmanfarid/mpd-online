<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_organization_tree.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");

$dbConn = new clsDBConnSIKP();
?>
<html>
<head>
    <title>ORGANIZATION TREE</title>
    <link href="../Styles/StyleMENU.css" type="text/css" rel="stylesheet" />
    <style>
	/* Style for tree item text */
	.t0i {
		font-family: Calibri, Arial, Tahoma;
		font-size: 10pt;
		color: #000000;
		background-color: #EFEFEF;
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
		background-color: #EFEFEF;
		text-decoration: none;
	}
	.t0i:active {
		font-family: Calibri, Arial, Tahoma;
		font-size: 10pt;
		color: #FF0000;
		background-color: #EFEFEF;
		text-decoration: none;
	}
.style1 {
	font-family: Calibri, Arial, Tahoma;
	font-weight: bold;
}
    </style>
</head>
<body style="border:1px solid #A2A2A2;height:100%;" class="" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<?php
$query = "SELECT * from (select p_organization_id, organization_code code, NVL (parent_id, 0) parent_id, "
	. "upper(REPLACE(organization_code, '''', '`')||' '||organization_name) organization_code, "
	. "NVL (organization_name, '0') path_organization_name, "
	. "description FROM p_organization START WITH parent_id IS NULL "
	. "CONNECT BY PRIOR p_organization_id = parent_id) order by code"; //order by organization_code";

$dbConn->query($query);
?>
      <div id="menu-container" style="padding: 5px;">
    <table style="background-color:#EFEFEF;border: 1px solid #A2A2A2;border-radius: 4px 4px 4px 4px;padding: 0;" cellspacing="0" width="100%" border="0">
        <tbody>
            <tr>
                <td class="CobaltHeaderTD" style="color: #696969;font-size: 11pt;font-weight: bold;font-family:Calibri,Arial,Tahoma;>
                    <span class="style1">&nbsp;<b>ORGANISASI</b></span></td>
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
  ['HOME (ROOT)', 'p_organization.php?parent_id=0&retree=1'
<?php
	$PLevel= array (-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,);
	$level = 0;
	$bdmnid = 0;
	$nplevel = 0;
	$parid = 0;
	while ($dbConn->next_record()) {
		if ($dbConn->f("p_organization_id")!=$bdmnid) {
			$bdmnid=$dbConn->f("p_organization_id");
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
			$fileName = "p_organization_list.php";
			$nplevel = $dbConn->f("p_organization_id");
			echo "['" . $dbConn->f("organization_code");
			if ($fileName=="") {
				echo "',''";
			} else {
				echo "','p_organization.php?retree=1&parent_id=".$dbConn->f("p_organization_id")."'";
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
</body>
</html>
<?php
$dbConn->close();
?>