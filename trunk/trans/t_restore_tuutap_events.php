<?php
//BindEvents Method @1-FDFEAE1D
function BindEvents()
{
    global $t_vat_setllementGrid;
    global $CCSEvents;
    $t_vat_setllementGrid->CCSEvents["BeforeShowRow"] = "t_vat_setllementGrid_BeforeShowRow";
    $t_vat_setllementGrid->CCSEvents["BeforeSelect"] = "t_vat_setllementGrid_BeforeSelect";
    $t_vat_setllementGrid->CCSEvents["BeforeShow"] = "t_vat_setllementGrid_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_vat_setllementGrid_BeforeShowRow @2-292D3A2A
function t_vat_setllementGrid_BeforeShowRow(& $sender)
{
    $t_vat_setllementGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeShowRow

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close t_vat_setllementGrid_BeforeShowRow @2-CAEE8B40
    return $t_vat_setllementGrid_BeforeShowRow;
}
//End Close t_vat_setllementGrid_BeforeShowRow

//t_vat_setllementGrid_BeforeSelect @2-6B06F902
function t_vat_setllementGrid_BeforeSelect(& $sender)
{
    $t_vat_setllementGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeSelect

//Custom Code @124-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

	$Component->DataSource->Parameters["urls_npwpd"] = strtoupper(CCGetFromGet("s_npwpd", NULL));
	$Component->DataSource->Parameters["urls_tahun"] = strtoupper(CCGetFromGet("s_tahun", NULL));

//Close t_vat_setllementGrid_BeforeSelect @2-3DD75ADF
    return $t_vat_setllementGrid_BeforeSelect;
}
//End Close t_vat_setllementGrid_BeforeSelect

//t_vat_setllementGrid_BeforeShow @2-27F9F7A4
function t_vat_setllementGrid_BeforeShow(& $sender)
{
    $t_vat_setllementGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeShow

//Custom Code @316-2A29BDB7
// -------------------------
	if(CCGetFromGet("s_npwpd") == "") {
		$t_vat_setllementGrid->Visible = false;
	}else {
		$t_vat_setllementGrid->Visible = true;
	}
// -------------------------
//End Custom Code

//Close t_vat_setllementGrid_BeforeShow @2-542B3DA4
    return $t_vat_setllementGrid_BeforeShow;
}
//End Close t_vat_setllementGrid_BeforeShow


//Page_OnInitializeView @1-B13AC304
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_restore_tuutap; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-3AC55A9F
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_restore_tuutap; //Compatibility
//End Page_BeforeShow

//Custom Code @193-2A29BDB7
// -------------------------
    $action = CCGetFromGet('action');
	
	$data = array();
	$param_arr = array();
		
	if($action == 'doMigration') {
		
		$npwpd_gab = CCGetFromGet('npwpd_gab');
		$periode_gab = CCGetFromGet('periode_gab');
		$thn_bln = CCGetFromGet('thn_bln');
		$no_kohir = CCGetFromGet('no_kohir');


		$dbConn = new clsDBConnSIKP();
		
		try {
			$query = "call p_mig_piutang_by_request('".$npwpd_gab."','".$periode_gab."','".$thn_bln."','".$no_kohir."', 'ADMIN')";
			$result = $dbConn->query($query);
			
			echo '<script> alert("'.$result.'"); </script>';
		}catch(Exception $e) {
			echo '<script> alert("'.$e->getMessage().'"); </script>';
		}
		
		$dbConn->close();
		
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

?>
