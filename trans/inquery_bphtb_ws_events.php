<?php
//BindEvents Method @1-AF7F43B5
function BindEvents()
{
    global $LOV;
    global $bphtb_wsForm;
    global $CCSEvents;
    $LOV->Button_DoSearch->CCSEvents["OnClick"] = "LOV_Button_DoSearch_OnClick";
    $bphtb_wsForm->CCSEvents["BeforeSelect"] = "bphtb_wsForm_BeforeSelect";
    $bphtb_wsForm->CCSEvents["BeforeInsert"] = "bphtb_wsForm_BeforeInsert";
    $bphtb_wsForm->ds->CCSEvents["AfterExecuteDelete"] = "bphtb_wsForm_ds_AfterExecuteDelete";
    $bphtb_wsForm->CCSEvents["AfterUpdate"] = "bphtb_wsForm_AfterUpdate";
    $bphtb_wsForm->CCSEvents["BeforeShow"] = "bphtb_wsForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//LOV_Button_DoSearch_OnClick @4-70A4A3C4
function LOV_Button_DoSearch_OnClick(& $sender)
{
    $LOV_Button_DoSearch_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $LOV; //Compatibility
//End LOV_Button_DoSearch_OnClick
    global $ws_data;
//Custom Code @50-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close LOV_Button_DoSearch_OnClick @4-B6F3F37C
    return $LOV_Button_DoSearch_OnClick;
}
//End Close LOV_Button_DoSearch_OnClick

//bphtb_wsForm_BeforeSelect @51-2E342CC5
function bphtb_wsForm_BeforeSelect(& $sender)
{
    $bphtb_wsForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $bphtb_wsForm; //Compatibility
//End bphtb_wsForm_BeforeSelect

//Custom Code @60-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close bphtb_wsForm_BeforeSelect @51-39A788EC
    return $bphtb_wsForm_BeforeSelect;
}
//End Close bphtb_wsForm_BeforeSelect

//bphtb_wsForm_BeforeInsert @51-395B6171
function bphtb_wsForm_BeforeInsert(& $sender)
{
    $bphtb_wsForm_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $bphtb_wsForm; //Compatibility
//End bphtb_wsForm_BeforeInsert

//Custom Code @61-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close bphtb_wsForm_BeforeInsert @51-CCFE7141
    return $bphtb_wsForm_BeforeInsert;
}
//End Close bphtb_wsForm_BeforeInsert

//bphtb_wsForm_ds_AfterExecuteDelete @51-07EDCCD9
function bphtb_wsForm_ds_AfterExecuteDelete(& $sender)
{
    $bphtb_wsForm_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $bphtb_wsForm; //Compatibility
//End bphtb_wsForm_ds_AfterExecuteDelete

//Custom Code @62-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close bphtb_wsForm_ds_AfterExecuteDelete @51-8FF9AA0D
    return $bphtb_wsForm_ds_AfterExecuteDelete;
}
//End Close bphtb_wsForm_ds_AfterExecuteDelete

//bphtb_wsForm_AfterUpdate @51-11DF8128
function bphtb_wsForm_AfterUpdate(& $sender)
{
    $bphtb_wsForm_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $bphtb_wsForm; //Compatibility
//End bphtb_wsForm_AfterUpdate

//Custom Code @64-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close bphtb_wsForm_AfterUpdate @51-CC9F910A
    return $bphtb_wsForm_AfterUpdate;
}
//End Close bphtb_wsForm_AfterUpdate

//bphtb_wsForm_BeforeShow @51-8F7FCE37
function bphtb_wsForm_BeforeShow(& $sender)
{
    $bphtb_wsForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $bphtb_wsForm; //Compatibility
//End bphtb_wsForm_BeforeShow
	global $ws_data;
//Custom Code @293-2A29BDB7
// -------------------------
    // Write your own code hereglobal $ws_data;
	$dbConn				= new clsDBConnSIKP();
	$NOP = CCGetFromGet('NOP_SEARCH');
	$Tahun = CCGetFromGet('TAHUN_SEARCH');
	if(!empty($NOP)&&!empty($Tahun)){
		$ws_data = file_get_contents('http://202.154.24.4:81/webservice-pbb/trans/bphtb_webservice.php?method=bphtb&param='.$NOP.$Tahun);
		$ws_data = json_decode($ws_data);
		if($ws_data->success){
			$items = $ws_data->items;
			$bphtb_wsForm->NOP->SetValue($items->NOP);
			$bphtb_wsForm->kota->SetValue($items->KOTA_OP);
			$query = "select * from f_get_region_nascode('".$items->KOTA_OP."')";
			$data = array();
			$dbConn->query($query);
			while ($dbConn->next_record()) {				
				$data["p_region_id"]	= $dbConn->f("p_region_id");
				$data["region_name"]	= $dbConn->f("region_name");
			}
			$bphtb_wsForm->nama_kota->SetValue($data["region_name"]);
			$bphtb_wsForm->id_kota->SetValue($data["p_region_id"]);

			$bphtb_wsForm->kecamatan->SetValue($items->KEC_OP);
			$query = "select * from f_get_region_nascode('".$items->KEC_OP."')";
			$data = array();
			$dbConn->query($query);
			while ($dbConn->next_record()) {				
				$data["p_region_id"]	= $dbConn->f("p_region_id");
				$data["region_name"]	= $dbConn->f("region_name");
			}
			$bphtb_wsForm->nama_kecamatan->SetValue($data["region_name"]);
			$bphtb_wsForm->id_kecamatan->SetValue($data["p_region_id"]);

			$bphtb_wsForm->kelurahan->SetValue($items->KEL_OP);
			$query = "select * from f_get_region_nascode('".$items->KEL_OP."')";
			$data = array();
			$dbConn->query($query);
			while ($dbConn->next_record()) {				
				$data["p_region_id"]	= $dbConn->f("p_region_id");
				$data["region_name"]	= $dbConn->f("region_name");
			}
			$bphtb_wsForm->nama_kelurahan->SetValue($data["region_name"]);
			$bphtb_wsForm->id_kelurahan->SetValue($data["p_region_id"]);
			$bphtb_wsForm->jalan->SetValue($items->JALAN_OP);
			$bphtb_wsForm->rt->SetValue($items->RT_OP);
			$bphtb_wsForm->rw->SetValue($items->RW_OP);
			$bphtb_wsForm->luas_bumi->SetValue($items->LUAS_BUMI);
			$bphtb_wsForm->luas_bangunan->SetValue($items->LUAS_BANG);
			$bphtb_wsForm->njop_bangunan->SetValue($items->NJOP_BANG);
			$bphtb_wsForm->njop_bumi->SetValue($items->NJOP_BUMI);
			$bphtb_wsForm->njop_pbb->SetValue($items->NJOP_PBB);
			$bphtb_wsForm->pbb_terhutang->SetValue($items->PBB_TERHUTANG);
			$bphtb_wsForm->Visible=true;
		}
	}else{
		$bphtb_wsForm->Visible=false;
	}
// -------------------------
//End Custom Code

//Close bphtb_wsForm_BeforeShow @51-7130E28B
    return $bphtb_wsForm_BeforeShow;
}
//End Close bphtb_wsForm_BeforeShow

//Page_OnInitializeView @1-77F893A5
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $inquery_bphtb_ws; //Compatibility
//End Page_OnInitializeView

//Custom Code @294-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>
