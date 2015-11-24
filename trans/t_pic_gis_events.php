<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
//BindEvents Method @1-B45DBCF7
function BindEvents()
{
    global $t_custAccountGrid;
    global $t_pic_gisGrid;
    global $t_pic_gisForm;
    global $CCSEvents;
    $t_custAccountGrid->CCSEvents["BeforeShowRow"] = "t_custAccountGrid_BeforeShowRow";
    $t_custAccountGrid->CCSEvents["BeforeSelect"] = "t_custAccountGrid_BeforeSelect";
    $t_pic_gisGrid->CCSEvents["BeforeShowRow"] = "t_pic_gisGrid_BeforeShowRow";
    $t_pic_gisGrid->CCSEvents["BeforeSelect"] = "t_pic_gisGrid_BeforeSelect";
    $t_pic_gisForm->ds->CCSEvents["BeforeBuildInsert"] = "t_pic_gisForm_ds_BeforeBuildInsert";
    $t_pic_gisForm->CCSEvents["BeforeInsert"] = "t_pic_gisForm_BeforeInsert";
    $t_pic_gisForm->CCSEvents["BeforeShow"] = "t_pic_gisForm_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_custAccountGrid_BeforeShowRow @656-89E3060F
function t_custAccountGrid_BeforeShowRow(& $sender)
{
    $t_custAccountGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_custAccountGrid; //Compatibility
//End t_custAccountGrid_BeforeShowRow
    global $selected_id2;
    global $add_flag;
	global $t_pic_gisGrid;
	global $t_pic_gisForm;
    if ($selected_id2 < 0 ) {
    	$selected_id2 = $Component->DataSource->t_cust_account_id->GetValue();
		$t_pic_gisGrid->DataSource->Parameters["urlt_cust_account_id"] = $selected_id2;
        $t_pic_gisGrid->DataSource->Prepare();
        
    }
    $styles = array("Row", "AltRow");
 // Start Bdr    
     $img_radio= "<img border='0' src='../images/radio.gif'>";
     $Style = $styles[0];
     
     if ($Component->DataSource->t_cust_account_id->GetValue()== $selected_id2) {
     	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
         $Style = $styles[1];
         $is_show_form=1;
     }	
 // End Bdr    
 
     if (count($styles)) {
         $Style = $styles[($Component->RowNumber - 1) % count($styles)];
         if (strlen($Style) && !strpos($Style, "="))
             $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
         $Component->Attributes->SetValue("rowStyle", $Style);
     }
    $Component->DLink->SetValue($img_radio);
//Close t_custAccountGrid_BeforeShowRow @656-2A4E10AA
    return $t_custAccountGrid_BeforeShowRow;
}
//End Close t_custAccountGrid_BeforeShowRow

//t_custAccountGrid_BeforeSelect @656-F5F352F2
function t_custAccountGrid_BeforeSelect(& $sender)
{
    $t_custAccountGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_custAccountGrid; //Compatibility
//End t_custAccountGrid_BeforeSelect

//Close t_custAccountGrid_BeforeSelect @656-48A5AED5
    return $t_custAccountGrid_BeforeSelect;
}
//End Close t_custAccountGrid_BeforeSelect

//t_pic_gisGrid_BeforeShowRow @2-95BABDC9
function t_pic_gisGrid_BeforeShowRow(& $sender)
{
    $t_pic_gisGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_pic_gisGrid; //Compatibility
//End t_pic_gisGrid_BeforeShowRow
	global $t_pic_gisForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;
	
    if ($selected_id < 0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->pic_id->GetValue();
        $t_pic_gisForm->DataSource->Parameters["urlpic_id"] = $selected_id;
        $t_pic_gisForm->DataSource->Prepare();
        $t_pic_gisForm->EditMode = $t_pic_gisForm->DataSource->AllParametersSet;
        
    }
    $styles = array("Row", "AltRow");
 // Start Bdr    
     $img_radio= "<img border='0' src='../images/radio.gif'>";
     $Style = $styles[0];
     
     if ($Component->DataSource->pic_id->GetValue()== $selected_id) {
     	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
         $Style = $styles[1];
         $is_show_form=1;
     }	
 // End Bdr    
 
     if (count($styles)) {
         $Style = $styles[($Component->RowNumber - 1) % count($styles)];
         if (strlen($Style) && !strpos($Style, "="))
             $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
         $Component->Attributes->SetValue("rowStyle", $Style);
     }
    $Component->DLink->SetValue($img_radio);

	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
//Close t_pic_gisGrid_BeforeShowRow @2-9AC38FC5
    return $t_pic_gisGrid_BeforeShowRow;
}
//End Close t_pic_gisGrid_BeforeShowRow

//t_pic_gisGrid_BeforeSelect @2-E05DE382
function t_pic_gisGrid_BeforeSelect(& $sender)
{
    $t_pic_gisGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_pic_gisGrid; //Compatibility
//End t_pic_gisGrid_BeforeSelect
	global $selected_id2;
	if($t_pic_gisGrid->DataSource->Parameters["urlt_cust_account_id"] == NULL){
		$t_pic_gisGrid->DataSource->Parameters["urlt_cust_account_id"] = $selected_id2;
	}
//Close t_pic_gisGrid_BeforeSelect @2-15A2E3AF
    return $t_pic_gisGrid_BeforeSelect;
}
//End Close t_pic_gisGrid_BeforeSelect

//t_pic_gisForm_ds_BeforeBuildInsert @94-00A06975
function t_pic_gisForm_ds_BeforeBuildInsert(& $sender)
{
    $t_pic_gisForm_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_pic_gisForm; //Compatibility
//End t_pic_gisForm_ds_BeforeBuildInsert
	
//Close t_pic_gisForm_ds_BeforeBuildInsert @94-DBE4253D
    return $t_pic_gisForm_ds_BeforeBuildInsert;
}
//End Close t_pic_gisForm_ds_BeforeBuildInsert

//t_pic_gisForm_BeforeInsert @94-02FC327E
function t_pic_gisForm_BeforeInsert(& $sender)
{
    $t_pic_gisForm_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_pic_gisForm; //Compatibility
//End t_pic_gisForm_BeforeInsert

//Close t_pic_gisForm_BeforeInsert @94-95B18A10
    return $t_pic_gisForm_BeforeInsert;
}
//End Close t_pic_gisForm_BeforeInsert

//t_pic_gisForm_BeforeShow @94-48E1A1A8
function t_pic_gisForm_BeforeShow(& $sender)
{
    $t_pic_gisForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_pic_gisForm; //Compatibility
//End t_pic_gisForm_BeforeShow
	global $selected_id2;
	$t_pic_gisForm->t_cust_account_id->SetValue($selected_id2);
//Close t_pic_gisForm_BeforeShow @94-0EFEE2D0
    return $t_pic_gisForm_BeforeShow;
}
//End Close t_pic_gisForm_BeforeShow

//Page_OnInitializeView @1-7971F32C
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_pic_gis; //Compatibility
//End Page_OnInitializeView
	global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("pic_id", $selected_id);

	global $selected_id2;
    $selected_id2 = -1;
    $selected_id2=CCGetFromGet("t_cust_account_id", $selected_id2);
//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView


?>
