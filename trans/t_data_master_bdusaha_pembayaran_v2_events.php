<?php
//include_once(RelativePath . "/include/sessi.inc");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-524F4A1D
function BindEvents()
{
    global $t_ppatGrid;
    global $CCSEvents;
    $t_ppatGrid->CCSEvents["BeforeSelect"] = "t_ppatGrid_BeforeSelect";
    $t_ppatGrid->CCSEvents["BeforeShowRow"] = "t_ppatGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_ppatGrid_BeforeSelect @2-2236C6D0
function t_ppatGrid_BeforeSelect(& $sender)
{
    $t_ppatGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_ppatGrid; //Compatibility
//End t_ppatGrid_BeforeSelect

//Custom Code @226-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	$Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------

//Close t_ppatGrid_BeforeSelect @2-D9B5983D
    return $t_ppatGrid_BeforeSelect;
}
//End Close t_ppatGrid_BeforeSelect

//t_ppatGrid_BeforeShowRow @2-5A3DCF3B
function t_ppatGrid_BeforeShowRow(& $sender)
{
    $t_ppatGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_ppatGrid; //Compatibility
//End t_ppatGrid_BeforeShowRow

//Custom Code @227-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code
//Close t_ppatGrid_BeforeShowRow @2-840E6AD6
    return $t_ppatGrid_BeforeShowRow;
}
//End Close t_ppatGrid_BeforeShowRow

//Page_OnInitializeView @1-01C5058A
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_data_master_bdusaha_pembayaran_v2; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

  // -------------------------
      // Write your own code here.
  	  global $selected_id;
        $selected_id = -1;
        $selected_id=CCGetFromGet("t_ppat_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>
