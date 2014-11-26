<?php  
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
include_once(RelativePath . "/Common.php");
include(RelativePath . "/include/create_dynamic_table.php");

//create data
//------------------
function create_info_ama() 
{
		
$DBConn = new clsDBConnSIKP();
	$nilai=CCGetFromGet("nilai","");
	if (empty($nilai)){
	   		
	}else{
		$SQL = "select replace(replace(f_monitor_tipro_v2(".$nilai."),'(\"',''),'\")','') from dual";	
		//die($SQL);
		$DBConn->query($SQL);
			  
		return create_table_grid ($DBConn, "INFORMASI MONITORING", "", $qs, "Y", $arrJml, "2");
	}
}

$nilai=CCGetFromGet("nilai","");
if (empty($nilai)){
   $cls = "";		   		
}else{
   $cls = "grid-table-container";	
}	
?>
<html>
<head>
<?php
		      	$DBConn = new clsDBConnSIKP();
		      	$list = "select * from p_workflow";
		      	$DBConn->query($list);
		      	$option = array();
		      	while($DBConn->next_record()){
		      		$option[$DBConn->f(0)]=$DBConn->f(1);
		      	}
		      	?>
<title>MONITORING TITK PROSES</title>
<link rel="stylesheet" type="text/css" href="../Styles/sikp/Style_doctype.css">
<script src="../js/jquery.min.js" type="text/javascript"></script>
<!-script language="JavaScript" src="../js/oframeentry.js" script -->
<script language="javascript" type="text/javascript">
$(document).ready(function()
{
    $(window).scroll(function()
    {
            $('#tabtop').css('top', $(window).scrollTop());
    });
});
</script>
</head>
<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<div class="tab-container" id="tabtop" style="BORDER-TOP: #a2a2a2 1px solid; WIDTH: 99.9%; POSITION: absolute; HEIGHT: 37px">
  <div class="tab-background-styled">
    <div class="th tab-button">
      <div class="tab-title-selected">
        MONITORING TITIK PROSES
      </div>
    </div>
  </div>
</div>
<div style="CLEAR: both; PADDING-TOP: 50px">
        <form>
	  <table class="search-field" cellspacing="0" cellpadding="0" border="0">
	<tr>
	<td valign="top">
	 <table class="Record" cellspacing="0" cellpadding="0" border="0">
	    <tr class="Controls">
	      <td class="search-field">Workflow</td>
	      <td class="search-field"> 
	      	<select name="nilai">
		        <option value="0">Pilih</option>
		        <?php
		        	foreach($option as $key => $value){
		        		echo "<option value=".$key.">".$value."</option>";
		        	}
		        ?>	      
		      </select></td>
	      <td class="search-field"><label>
	        <input name="Cari" type="submit" class="btn_tambah" value="CARI">
	      </label></td>
	    </tr>
 	</table>
	</td>
	</tr>
	</table>
	</form>
 	<br>	

	<table class="<?php echo $cls; ?>" cellspacing="0" cellpadding="0" border="0">
	<tr>
	<td><?php echo create_info_ama();?></td>
	</tr>
	</table>

</div>
</body>
</html>
