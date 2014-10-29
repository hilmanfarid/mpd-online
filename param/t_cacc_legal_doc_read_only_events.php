<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-64D430A6
function BindEvents()
{
    global $t_cacc_legal_docGrid;
    global $CCSEvents;
    $t_cacc_legal_docGrid->CCSEvents["BeforeShowRow"] = "t_cacc_legal_docGrid_BeforeShowRow";
    $t_cacc_legal_docGrid->CCSEvents["BeforeSelect"] = "t_cacc_legal_docGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_cacc_legal_docGrid_BeforeShowRow @2-95D975D3
function t_cacc_legal_docGrid_BeforeShowRow(& $sender)
{
    $t_cacc_legal_docGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cacc_legal_docGrid; //Compatibility
//End t_cacc_legal_docGrid_BeforeShowRow

// Start Bdr
    global $t_cacc_legal_docForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_cacc_legal_doc_id->GetValue();
        $t_cacc_legal_docForm->DataSource->Parameters["urlt_cacc_legal_doc_id"] = $selected_id;
        $t_cacc_legal_docForm->DataSource->Prepare();
        $t_cacc_legal_docForm->EditMode = $t_cacc_legal_docForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->t_cacc_legal_doc_id->GetValue()== $selected_id) {
    	$img_radio= "<img border='0' src='../images/radio_s.gif'>";
        $Style = $styles[1];
        $is_show_form=1;
    }	
// End Bdr    

    if (count($styles)) {
//        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style
	$Component->DLink->SetValue($img_radio); // Bdr

//Close t_cacc_legal_docGrid_BeforeShowRow @2-30B9E74F
    return $t_cacc_legal_docGrid_BeforeShowRow;
}
//End Close t_cacc_legal_docGrid_BeforeShowRow

//t_cacc_legal_docGrid_BeforeSelect @2-00901244
function t_cacc_legal_docGrid_BeforeSelect(& $sender)
{
    $t_cacc_legal_docGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cacc_legal_docGrid; //Compatibility
//End t_cacc_legal_docGrid_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_cacc_legal_docGrid_BeforeSelect @2-658636C1
    return $t_cacc_legal_docGrid_BeforeSelect;
}
//End Close t_cacc_legal_docGrid_BeforeSelect

//Page_OnInitializeView @1-5B4D42A4
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cacc_legal_doc_read_only; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("t_cacc_legal_doc_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

?>
