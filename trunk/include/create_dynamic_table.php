<?php


/*
===========================================================
PERHATIAN : 
file yang akan meng-include file ini harus meng-include juga
file Common.php
===========================================================
*/

/*
function untuk buat td di grid
*/
function create_th_grid ($arrField, $style, $query = "", &$arrJml) 
{
	$td = "<tr class=".$style.">\n";
	
	$i = 0;
	//print_r($arrField);
	//die($arrField);
	
	$query = ($query == "") ? "" : "&" . $query;
	
	foreach ($arrField as $val) {
		
		//die($query);
		if ($arrField[0] == "D") {
		
			$type = substr($val,0,1);
			$field = substr($val,1);
			
			if (is_array($arrJml)) {
				for ($j=0; $j<=(count($arrJml)-1); $j++) {
					
					if ( $arrJml[$j]["POS"] == $i )
						$arrJml[$j]["JML"] = $arrJml[$j]["JML"] + intval(trim($val));
				}
			}
			
			//die();
			if ($type == "L") {
				
				$arrA = explode("#", $field);
				if (count($arrA) == 2)
					$field = "<a href='javascript:toDetail(\"" . $arrA[1] . $query . "\")'>" . $arrA[0] . "</a>";
				
				
				//die($query);
			} 
			
			if ($type == "P") {
				
				$arrA = explode("#", $field);
				if (count($arrA) == 2)
					$field = "<a href='javascript:toPopUp(\"" . $arrA[1] . $query . "\")'>" . $arrA[0] . "</a>";
			}
			
		} elseif ($arrField[0] == "H") {
		
			$type = "V";
			$field = $val;
			
			if (is_array($arrJml) && $i != 0) {
	
				for ($j=0; $j<=(count($arrJml)-1); $j++) {
					
					if ($arrJml[$j]["NAMA"] == $val)
						$arrJml[$j]["POS"] = $i;
				}
			}
		} elseif ($arrField[0] == "S") {
			$type = substr($val,0,1);
			$field = substr($val,1);
			
			if (is_array($arrJml)) {
				for ($j=0; $j<=(count($arrJml)-1); $j++) {
					
					if ( $arrJml[$j]["POS"] == $i )
						$arrJml[$j]["JML"] = $arrJml[$j]["JML"] + intval(trim($val));
				}
			}
			
			//die();
			if ($type == "L") {
				
				$arrA = explode("#", $field);
				if (count($arrA) == 2)
					$field = "<a href='javascript:toDetail(\"" . $arrA[1] . $query . "\")'>" . $arrA[0] . "</a>";
				
				
				//die($query);
			} 
			
			if ($type == "P") {
				
				$arrA = explode("#", $field);
				if (count($arrA) == 2)
					$field = "<a href='javascript:toPopUp(\"" . $arrA[1] . $query . "\")'>" . $arrA[0] . "</a>";
			}
			
		}
		
		if ($type == "N") {
		
			$field = number_format($field,2);
			$align = "right";
		} else {
			
			$align = "left";		
		}

		if ($type == "R") {
		
			$field = number_format($field,5);
			$align = "right";
		}
		
		

		if ($i != 0) {

			$td = $td. "<th style='BORDER-RIGHT: #dcdcdc 1px solid' nowrap align='" . $align . "' class='" . $style . "'>&nbsp;" . $field . "&nbsp;</th>\n";
		}
		
		$i++;
		
	}
	// loop foreach
	$td = $td . "</tr>\n";
	
	return $td;
}

function create_td_grid ($arrField, $style, $query = "", &$arrJml) 
{
	$td = "<tr>\n";
	
	$i = 0;
	//print_r($arrField);
	//die($arrField);
	
	$query = ($query == "") ? "" : "&" . $query;
	
	foreach ($arrField as $val) {
		
		//die($query);
		if ($arrField[0] == "D") {
		
			$type = substr($val,0,1);
			$field = substr($val,1);
			
			if (is_array($arrJml)) {
				for ($j=0; $j<=(count($arrJml)-1); $j++) {
					
					if ( $arrJml[$j]["POS"] == $i )
						$arrJml[$j]["JML"] = $arrJml[$j]["JML"] + intval(trim($val));
				}
			}
			
			//die();
			if ($type == "L") {
				
				$arrA = explode("#", $field);
				if (count($arrA) == 2)
					$field = "<a href='javascript:toDetail(\"" . $arrA[1] . $query . "\")'>" . $arrA[0] . "</a>";
				
				
				//die($query);
			} 
			
			if ($type == "P") {
				
				$arrA = explode("#", $field);
				if (count($arrA) == 2)
					$field = "<a href='javascript:toPopUp(\"" . $arrA[1] . $query . "\")'>" . $arrA[0] . "</a>";
			}
			
		} elseif ($arrField[0] == "H") {
		
			$type = "V";
			$field = $val;
			
			if (is_array($arrJml) && $i != 0) {
	
				for ($j=0; $j<=(count($arrJml)-1); $j++) {
					
					if ($arrJml[$j]["NAMA"] == $val)
						$arrJml[$j]["POS"] = $i;
				}
			}
		} elseif ($arrField[0] == "S") {
			$type = substr($val,0,1);
			$field = substr($val,1);
			
			if (is_array($arrJml)) {
				for ($j=0; $j<=(count($arrJml)-1); $j++) {
					
					if ( $arrJml[$j]["POS"] == $i )
						$arrJml[$j]["JML"] = $arrJml[$j]["JML"] + intval(trim($val));
				}
			}
			
			//die();
			if ($type == "L") {
				
				$arrA = explode("#", $field);
				if (count($arrA) == 2)
					$field = "<a href='javascript:toDetail(\"" . $arrA[1] . $query . "\")'>" . $arrA[0] . "</a>";
				
				
				//die($query);
			} 
			
			if ($type == "P") {
				
				$arrA = explode("#", $field);
				if (count($arrA) == 2)
					$field = "<a href='javascript:toPopUp(\"" . $arrA[1] . $query . "\")'>" . $arrA[0] . "</a>";
			}
			
		}
		
		if ($type == "N") {
		
			$field = number_format($field,2);
			$align = "right";
		} else {
			
			$align = "left";		
		}

		if ($type == "R") {
		
			$field = number_format($field,5);
			$align = "right";
		}
		
		

		if ($i != 0) {

			$td = $td. "<td style='BORDER: #dcdcdc 1px solid' nowrap align='" . $align . "' class='" . $style . "'>&nbsp;" . $field . "&nbsp;</td>\n";
		}
		
		$i++;
		
	}
	// loop foreach
	$td = $td . "</tr>\n";
	
	return $td;
}


/*
function untuk buat td di grid

H|Akun|Service No|Tanggal|Seq
D|0101002|0215741781|17-AUG-2008|1
D|0203221|0227766767|13-NOV-2008|4
*/
function create_td_grid_v2 ($arrField, $style, $query = "", &$arrJml) 
{
	$td = "<tr>\n";
	
	$i = 0;
	
	//die($query);
	
	$query = ($query == "") ? "" : "&" . $query;
	
	foreach ($arrField as $key => $val) {
		
		$field = $val;
		$align = "left";		
		
		if (is_array($arrJml) && $arrField[0] == "H" && $i != 0) {
	
			for ($j=0; $j<=(count($arrJml)-1); $j++) {
				
				if ($arrJml[$j]["NAMA"] == $val)
					$arrJml[$j]["POS"] = $i;
			}
		}
		
		if (is_numeric($field)) 
		{  if ($key == 3 || $key == 4 || $key == 1) {
				$align = 'left';
				$format='notnumber';
			} else {
				$align = 'right';
				$format='number';
			}
		}
		else
		{  $align = 'left';
		   $format='notnumber';
		}


		if ($i != 0) {
		
			if ($format == 'number')
			{
			$td = $td. "<td style='BORDER: #dcdcdc 1px solid' nowrap align='" . $align . "' class='" . $style . "'>&nbsp;" . number_format(trim($field),2) . "&nbsp;</td>\n";
			}
			else
			{
			$td = $td. "<td style='BORDER: #dcdcdc 1px solid' nowrap align='" . $align . "' class='" . $style . "'>&nbsp;" . trim($field) . "&nbsp;</td>\n";
			}
			if ($arrField[0] == "D" && is_array($arrJml)) {
				
				for ($j=0; $j<=(count($arrJml)-1); $j++) {
				
					if ( $arrJml[$j]["POS"] == $i )
						$arrJml[$j]["JML"] = $arrJml[$j]["JML"] + intval(trim($val));
				}
				
			}
		}
		
		$i++;
		
	}
	$td = $td . "</tr>\n";
	
	return $td;
}

/*
function untuk buat td di form

*/
function create_td_form ($arrField, $style_col, $style_data, $query = "") 
{
	$i = 0;
	$td = "";
	
	foreach ($arrField as $val) {
	
		if ($i == 0) {
		
			$td = $td . "<td class='" . $style_col . "'>&nbsp;" . $val . "&nbsp;</td>\n";
		} else {
		
			$type = substr($val,0,1);
			$field = substr($val,1);
			
			if ($type == "N") {
			
				$field = number_format($field);
				$align = "right";
			} else {
				
				$align = "left";		
			}

			if ($type == "R") {
			
				$field = number_format($field,5);
				$align = "right";
			} else {
				
				$align = "left";		
			}

						
			$td = $td . "<td align='" . $align ."' class='" . $style_data . "'>&nbsp;" . $field . "&nbsp;</td>\n";
		}
		
		$i++;
	}
	
	return $td;
}

/*
function untuk buat td di form

H|Akun|Service No|Tanggal|Seq
D|0101002|0215741781|17-AUG-2008|1
D|0203221|0227766767|13-NOV-2008|4
*/
function create_td_form_v2 ($arrField, $style_col, $style_data, $query = "") 
{
	$i = 0;
	$td = "";
	
	foreach ($arrField as $val) {
	
		if ($i == 0) {
		
			$td = $td . "<td class='" . $style_col . "'>&nbsp;" . $val . "&nbsp;</td>\n";
		} else {
		
			$align = "left";
			$td = $td . "<td align='" . $align ."' class='" . $style_data . "'>&nbsp;" . $val . "&nbsp;</td>\n";
		}
		
		$i++;
	}
	
	return $td;
}

//jumlah untuk yang ada jumlahnya
function create_tr_summary(&$arrJml, $jmlField, &$table, $style, $firstsign)
{
	if (is_array($arrJml) && $jmlField != 0) {
		
		$z = 0;
		$tot = "<tr>\n";
		
		for ($i=0; $i<=($jmlField-1); $i++) {
			for ($j=0; $j<=(count($arrJml)-1); $j++) {
				
				if ($arrJml[$j]["POS"] == $i) {
					
					$z = $arrJml[$j]["POS"] - $z;
					
					if (($z-1) != 0)
						$tot = $tot . "<td colspan='" . ($z-1) . "' class='" . $style["td_footer"] . "' align='right'>&nbsp;</td>\n";
						
					$tot = $tot . "<td class='" . $style["td_footer"] . "' align='right'><b>" . number_format($arrJml[$j]["JML"],2) . "</b></td>\n";
					
					$z = $arrJml[$j]["POS"];
					
				}
			}
		}
		
		if ($firstsign == "H")
			for ($j=0; $j<=(count($arrJml)-1); $j++) {
				$arrJml[$j]["JML"] = 0;
			}
		
		$z = $jmlField - 1 - $z;
		
		if ($z != 0)
			$tot = $tot . "<td colspan='" . $z . "' class='" . $style["td_footer"] . "' align='right'>&nbsp;</td>\n";
			
		$tot = $tot . "</tr>\n";
		
		$table = $table . $tot;
	}
}

/* 
--------------
fungsi untuk membentuk table secara dinamis
dengan menggunakan refcursor.
--------------
*/
function create_table_grid ($conn, 
							$header_name,  
							$style, 
							$query = "", 
							$altcol = "N", 
							$arrJml = "", 
							$version = "1",
							$delimiter = "|")
{
	/*
	//info_ama.php
	//-----------
	$arrJml = array(
			array("NAMA" => "EVENT_COST_MNY",
				  "JML" => 0,
				  "POS" => 0)
		  );
	*/
	
	if (!is_array($style)) {
		
		$style = array(
			"table" => "grid-table",
			"td_header" => "th",
			"td_column" => "",
			"th_column" => "Caption",
			"td_data" => "OliveDataTD",
			"td_altdata" => "OliveAltDataTD",
			"td_footer" => "OliveFooterTD"
		);	
	}
	
	$class = $style["td_data"];
	$table = "";
	$i = 1;
	$jmlField = 0;
	
	$ada = $conn->next_record();
	$headerGrid='';
	$columnHeader='';
	$dataGrid='';
	$SGrid='';
	$headerGrid = "<table class='" . $style["table"] . "' width='100%' cellspacing='0' cellpadding='0' border='0'>
							  <tr>
								  <td class='HeaderLeft'><img border='0' src='../Styles/sikp/Images/Spacer.gif' alt=''></td>
								  <td class='". $style["td_header"] . "' colspan='" . $jmlField . "'><strong>" . $header_name . "</strong></td>
								  <td class='HeaderRight'><img border='0' src='../Styles/sikp/Images/Spacer.gif' alt=''></td>
							  </tr>
							  </table>";
	while ($ada) {
		
		$class = ($altcol == "Y" && $class == $style["td_data"]) 
				? $style["td_altdata"] 
				: $style["td_data"];
				
		
		$nilai = $conn->f(0);
		
		if ( $nilai != "") {
			
			$arrField = explode($delimiter, $nilai);
			$jmlField = count($arrField);
			//print_r($arrField);
			
			if ($arrField[0] == "H") {
			    //Header Row 
				if ($i != 1) {
					//hanya dijalankan klo bukan pertama kali
					create_tr_summary($arrJml, $jmlField, $table, $style, "H");
					$table = $table . "</table><br>\n";
				}		  
				
				switch ($version) {
					
					case "1" :	$td = create_th_grid ($arrField, $style["th_column"], $query, $arrJml);
								break;
					case "2" :	$td = create_th_grid ($arrField, $style["th_column"], $query, $arrJml);
								break;
					default	 :	$td = create_th_grid ($arrField, $style["th_column"], $query, $arrJml);
					
				}
				$columnHeader = $td;
				
			} elseif ($arrField[0] == "D") {
			  //Data row 
				switch ($version) {
					
					case "1" :	$td = create_td_grid ($arrField, $class, $query, $arrJml);
								break;
					case "2" :	$td = create_td_grid_v2 ($arrField, $class, $query, $arrJml);
								break;
					default  :	$td = create_td_grid ($arrField, $class, $query, $arrJml);
				}
				
				$dataGrid .= $td;
			} elseif ($arrField[0] == "S") {
			  //Sumarry Row
			  switch ($version) {
					
					case "1" :	$td = create_td_grid ($arrField, $style["td_footer"], $query, $arrJml);
								break;
					case "2" :	$td = create_td_grid_v2 ($arrField, $style["footer"], $query, $arrJml);
								break;
					default  :	$td = create_td_grid ($arrField, $style["td_footer"], $query, $arrJml);
			  }	
			  
			  $SGrid .= $td;
		    }	
		}
		
		$ada = $conn->next_record();
		
		//$class = $style["td_data"];
		$i++;
	}
	$table.=$headerGrid."<table class='grid' cellspacing='0' cellpadding='0'>".$columnHeader.$dataGrid.'</table>'.$SGrid;
	create_tr_summary($arrJml, $jmlField, $table, $style, "D");
	/*
	if (is_array($arrJml) && $jmlField != 0) {
		
		$z = 0;
		$tot = "<tr>\n";
		
		for ($i=0; $i<=($jmlField-1); $i++) {
			for ($j=0; $j<=(count($arrJml)-1); $j++) {
				
				if ($arrJml[$j]["POS"] == $i) {
					
					$z = $arrJml[$j]["POS"] - $z;
					
					if (($z-1) != 0)
						$tot = $tot . "<td colspan='" . ($z-1) . "' class='" . $style["td_footer"] . "' align='right'>&nbsp;</td>\n";
					
					
					$tot = $tot . "<td class='" . $style["td_footer"] . "' align='right'><b>" . number_format($arrJml[$j]["JML"],2)  . "</b></td>\n";
					
					$z = $arrJml[$j]["POS"];
					
				}
			}
		}
		
		$z = $jmlField - 1 - $z;
		
		if ($z != 0)
			$tot = $tot . "<td colspan='" . $z . "' class='" . $style["td_footer"] . "' align='right'>&nbsp;</td>\n";
			
		$tot = $tot . "</tr>\n";
		
		$table = $table . $tot;
	}
	*/
	
	
	
	$table = $table . "</table>\n";
	
	// echo "<pre>";
	// print_r ($arrJml);
	// echo "</pre>";
	// die();
	
	return $table;
}

/* 
--------------
fungsi untuk membentuk table secara dinamis berbentuk form
dengan menggunakan refcursor.

contoh data yang dihasilkan :
==========================
Akun|V0101002
Service No|V0227766767
Tanggal|V13-NOV-2008
Seq|N4
--------------
*/

function create_table_form ($conn, $header_name, 
					 $style, $query = "", $altcol = "N", $delimiter = "|") 
{
	
	if (!is_array($style)) {
		
		$style = array(
			"table" => "OliveFormTABLE",
			"td_header" => "OliveTabON",
			"td_column" => "OliveColumnTD",
			"td_data" => "OliveDataTD",
			"td_altdata" => "OliveAltDataTD",
			"td_footer" => "OliveFooterTD"
		);	
	}
	
	$ada = $conn->next_record();
	
	$i = 1;
	$table = "<table class='" . $style["table"] . "' cellpadding='2' border='1' cellspacing='0' width='100%' background=''>\n";
	$table = $table . "<tr>\n";
	$table = $table . "<td class='" . $style["td_header"] . "' colspan='4'>" . $header_name . "</td>\n";
	$table = $table . "</tr>\n";
	
	while ($ada) {
		
		
		//echo $conn->f(0) . "<br>";
		
		$nilai = $conn->f(0);
		$sign = "genap";
		
		if ( $nilai != "") {
			
			$arrField = explode($delimiter, $nilai);
			$jmlField = count($arrField);
			
			$td = "<tr>\n";				
			$td = $td . create_td_form ($arrField, $style["td_column"], $style["td_data"], $query);
			
			$ada = $conn->next_record();
			
			if ($ada) {
				
				$nilai = $conn->f(0);
				
				if ($nilai != "") {
				
					$arrField = explode($delimiter, $nilai);
					$jmlField = count($arrField);
					
					$td = $td . create_td_form ($arrField, $style["td_column"], $style["td_data"], $query);
				}
			} else {
				$i++;
				$sign = "ganjil";
				if ($i % 2 != 0)
					$td = $td . "<td class='" . $style["td_data"] . "' colspan='2'></td>";
				
				$td = $td . "</tr>\n";
				break;
			}
			
			
			$td = $td . "</tr>\n";
			
			$table = $table . $td;
			
			
			
		}
		
		$i++;
		$ada = $conn->next_record();
	}
	
	if ($sign != "ganjil")
		$td = "";
		
	$table = $table . $td . "</table>\n";
	
	return $table;
}


//create tree
//
function create_tree($filename, $conn, $frmain_name = "frmain", $query_string = "", $js_file="white_tree.js") 
{
	
	$param = ($query_string == "") ? "" : "&" . $query_string;
?>
	<html>

	<head>
	<link rel="stylesheet" type="text/css" href="../Themes/Olive/Style.css">
	<style>
		/* Style for tree item text */
		.t0i {
			font-family: Tahoma, Verdana, Geneva, Arial, Helvetica, sans-serif;
			font-size: 10px;
			color: #000080;
			background-color: #fffff;
			text-decoration: none;
		}
		/* Style for tree item image */
		.t0im {
			border: 1px;
			width: 18px;
			height: 16px;
		}
		/* Style for overmouse item text */
		.t0iMO {
			font-family: Tahoma, Verdana, Geneva, Arial, Helvetica, sans-serif;
			font-size: 10px;
			color: #FFFFFF;
			background-color: #fffff;
			text-decoration: none;
		}
	</style>

	</head>

	<body bgcolor="#fffff" leftmargin=0 topmargin=0 marginheight=0 marginwidth=0 >
	<table width="100%" cellspacing="0" border="1" height="100%">
	  <tr>
	    <td valign="top" height="100%" style="background-color:#fffff; color:#000080">
	
		<script language="JavaScript" src="../js/<?php echo $js_file; ?>"></script>
		<script language="JavaScript">

		var tree_tpl = {
			'target'  : '<?php echo $frmain_name; ?>',	// name of the frame links will be opened in
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
			'icon_18' : '../images/plusbottom.gif', // junction for closed node
			'icon_19' : '../images/plus.gif',       // junctioin for last closed node
			'icon_26' : '../images/minusbottom.gif',// junction for opened node
			'icon_27' : '../images/minus.gif'       // junctioin for last opended node
		};
		
		var TREE_ITEMS = 
		[
			
		  
			<?php
				$PLevel= array (-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1);
				$level = 0;
				$nplevel = 0;
				
				$anak = "";
				
				while ($conn->next_record()) 
				{
					
					$arr = explode("|", $conn->f(0));
					$primary_id = $arr[0];
					$code_id = $arr[1];
					$parent_id = $arr[2];
					$add_qs = ($arr[3] == "") ? "" : "&" . $arr[3];
					
					$parid = $parent_id;
				
					if ($parid == $PLevel[$level]) {
						$anak = $anak . "]," . chr(13);
					} else {
						
						if ($parid == $nplevel) {
							
							$anak = $anak . "," . chr(13);
							$level = $level + 1;
							$PLevel[$level] = $parid;
						} else {
							
							$anak = $anak . "]," . chr(13);
							while ($PLevel[$level] != $parid && $level > 0) {
							
								$anak = $anak . "]," . chr(13);
								$level = $level - 1;
							}
						}
					}
					$nplevel = $primary_id;

					$anak = $anak . "['" . $code_id;
					$anak = $anak . "','" . $filename . "?PRIMARY_ID=" . $primary_id . $param . $add_qs . "'";

				}
				
				while ($level > 0) {
					
					$anak = $anak . "]," . chr(13);
					$level = $level - 1;
				}
				
				$tree = "['HOME', ''";
				$tree = $tree . $anak;
				
				echo $tree;

			?>
			],
		];

		 new tree (TREE_ITEMS, tree_tpl);

		</script>

		<?php
		$conn->Close();
		?>


		</td>
	  </tr>
	</table>
	</body>

	</html>

<?php
}

function create_tree_bulk($filename, $results,$rowcount, $frmain_name = "frmain", $query_string = "", $js_file="white_tree.js") 
{
	
	$param = ($query_string == "") ? "" : "&" . $query_string;
?>
	<html>

	<head>
	<link rel="stylesheet" type="text/css" href="../Themes/Olive/Style.css">
	<style>
		/* Style for tree item text */
		.t0i {
			font-family: Tahoma, Verdana, Geneva, Arial, Helvetica, sans-serif;
			font-size: 10px;
			color: #000080;
			background-color: #fffff;
			text-decoration: none;
		}
		/* Style for tree item image */
		.t0im {
			border: 0px;
			width: 18px;
			height: 16px;
		}
		/* Style for overmouse item text */
		.t0iMO {
			font-family: Tahoma, Verdana, Geneva, Arial, Helvetica, sans-serif;
			font-size: 10px;
			color: #FFFFFF;
			background-color: #fffff;
			text-decoration: none;
		}
	</style>

	</head>

	<body bgcolor="#fffff" leftmargin=0 topmargin=0 marginheight=0 marginwidth=0 >
	<table width="100%" cellspacing="0" border="0" height="100%">
	  <tr>
	    <td valign="top" height="100%" style="background-color:#fffff; color:#000080">
	
		<script language="JavaScript" src="../js/<?php echo $js_file; ?>"></script>
		<script language="JavaScript">

		var tree_tpl = {
			'target'  : '<?php echo $frmain_name; ?>',	// name of the frame links will be opened in
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
			'icon_18' : '../images/plusbottom.gif', // junction for closed node
			'icon_19' : '../images/plus.gif',       // junctioin for last closed node
			'icon_26' : '../images/minusbottom.gif',// junction for opened node
			'icon_27' : '../images/minus.gif'       // junctioin for last opended node
		};
		
		var TREE_ITEMS = 
		[
			
		  
			<?php
				$PLevel= array (-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1);
				$level = 0;
				$nplevel = 0;
				
				$anak = "";
				
				if ($rowcount > 5000)
				{
					$jml_row = 5000;
			    }else
			    {
				    $jml_row = $rowcount;
			    }
			    
				
/*				
				while ($conn->next_record()) 
				{
					
					$arr = explode("|", $conn->f(0));
					$primary_id = $arr[0];
					$code_id = $arr[1];
					$parent_id = $arr[2];
					$add_qs = ($arr[3] == "") ? "" : "&" . $arr[3];
					
					$parid = $parent_id;
				
					if ($parid == $PLevel[$level]) {
						$anak = $anak . "]," . chr(13);
					} else {
						
						if ($parid == $nplevel) {
							
							$anak = $anak . "," . chr(13);
							$level = $level + 1;
							$PLevel[$level] = $parid;
						} else {
							
							$anak = $anak . "]," . chr(13);
							while ($PLevel[$level] != $parid && $level > 0) {
							
								$anak = $anak . "]," . chr(13);
								$level = $level - 1;
							}
						}
					}
					$nplevel = $primary_id;

					$anak = $anak . "['" . $code_id;
					$anak = $anak . "','" . $filename . "?PRIMARY_ID=" . $primary_id . $param . $add_qs . "'";

				}
*/
                for ($i = 0; $i < $jml_row; $i++) 
		        {
			        //print_r ($results);
			        foreach ($results as &$data)
			        {
				        //$data[$i]
				        $arr = explode("|", $data[$i]);
				        $primary_id = $arr[0];
						$code_id = $arr[1];
						$parent_id = $arr[2];
						$add_qs = ($arr[3] == "") ? "" : "&" . $arr[3];
						
						$parid = $parent_id;
					
						if ($parid == $PLevel[$level]) {
							$anak = $anak . "]," . chr(13);
						} else {
							
							if ($parid == $nplevel) {
								
								$anak = $anak . "," . chr(13);
								$level = $level + 1;
								$PLevel[$level] = $parid;
							} else {
								
								$anak = $anak . "]," . chr(13);
								while ($PLevel[$level] != $parid && $level > 0) {
								
									$anak = $anak . "]," . chr(13);
									$level = $level - 1;
								}
							}
						}
						$nplevel = $primary_id;

						$anak = $anak . "['" . $code_id;
						$anak = $anak . "','" . $filename . "?PRIMARY_ID=" . $primary_id . $param . $add_qs . "'";
			        }
		        }				
				
				while ($level > 0) {
					
					$anak = $anak . "]," . chr(13);
					$level = $level - 1;
				}
				
				$tree = "['HOME', ''";
				$tree = $tree . $anak;
				
				echo $tree;

			?>
			],
		];

		 new tree (TREE_ITEMS, tree_tpl);

		</script>

		<?php
		//$conn->Close();
		unset($results);
		?>


		</td>
	  </tr>
	</table>
	</body>

	</html>

<?php
}
?>