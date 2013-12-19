<?php
//BindEvents Method @1-FAFD03E9
function BindEvents()
{
    global $t_bphtb_registration_list;
    global $CCSEvents;
    $t_bphtb_registration_list->CCSEvents["BeforeShowRow"] = "t_bphtb_registration_list_BeforeShowRow";
    $t_bphtb_registration_list->CCSEvents["BeforeSelect"] = "t_bphtb_registration_list_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_bphtb_registration_list_BeforeShowRow @2-85900DD6
function t_bphtb_registration_list_BeforeShowRow(& $sender)
{
    $t_bphtb_registration_list_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registration_list; //Compatibility
//End t_bphtb_registration_list_BeforeShowRow

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close t_bphtb_registration_list_BeforeShowRow @2-96DA6DA7
    return $t_bphtb_registration_list_BeforeShowRow;
}
//End Close t_bphtb_registration_list_BeforeShowRow

//t_bphtb_registration_list_BeforeSelect @2-0E7F8E53
function t_bphtb_registration_list_BeforeSelect(& $sender)
{
    $t_bphtb_registration_list_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registration_list; //Compatibility
//End t_bphtb_registration_list_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registration_list_BeforeSelect @2-BA5BB964
    return $t_bphtb_registration_list_BeforeSelect;
}
//End Close t_bphtb_registration_list_BeforeSelect

//Page_OnInitializeView @1-FC77777F
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registration_list; //Compatibility
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


?>
