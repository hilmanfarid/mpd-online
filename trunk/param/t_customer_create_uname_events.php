<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-885CAF5C
function BindEvents()
{
    global $t_customerGrid;
    global $CCSEvents;
    $t_customerGrid->CCSEvents["BeforeShowRow"] = "t_customerGrid_BeforeShowRow";
    $t_customerGrid->CCSEvents["BeforeSelect"] = "t_customerGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_customerGrid_BeforeShowRow @2-75C38576
function t_customerGrid_BeforeShowRow(& $sender)
{
    $t_customerGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customerGrid; //Compatibility
//End t_customerGrid_BeforeShowRow

// Start Bdr
    global $t_customer_updateForm;
    global $selected_id;
    global $add_flag;
    global $is_show_form;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_customer_id->GetValue();
        $t_customer_updateForm->DataSource->Parameters["urlt_customer_id"] = $selected_id;
        $t_customer_updateForm->DataSource->Prepare();
        $t_customer_updateForm->EditMode = $t_customer_updateForm->DataSource->AllParametersSet;
        
   }
// End Bdr    

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
// Start Bdr    
    $img_radio= "<img border='0' src='../images/radio.gif'>";
    $Style = $styles[0];
    
    if ($Component->DataSource->t_customer_id->GetValue()== $selected_id) {
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

//Close t_customerGrid_BeforeShowRow @2-7E840202
    return $t_customerGrid_BeforeShowRow;
}
//End Close t_customerGrid_BeforeShowRow

//t_customerGrid_BeforeSelect @2-95E5E7C8
function t_customerGrid_BeforeSelect(& $sender)
{
    $t_customerGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customerGrid; //Compatibility
//End t_customerGrid_BeforeSelect
	
	/*
			select *
			from t_customer a 
			where (upper(a.company_owner) like upper('%{s_keyword}%') 
			       or upper(a.address_name_owner) like upper('%{s_keyword}%')
			       )
	       and exists (select 1 from t_cust_account x
	                   where x.t_customer_id = a.t_customer_id 
	                        and upper(x.npwd) like upper('%{s_npwd}%')
	                        and upper(x.wp_name) like upper('%{s_wp_name}%')
	                        and upper(x.company_name) like upper('%{s_company_name}%')
	                        and upper(x.company_brand) like upper('%{s_company_brand}%')
                  		)
	*/
//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
        $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
// -------------------------
//End Custom Code

//Close t_customerGrid_BeforeSelect @2-5CE02F23
    return $t_customerGrid_BeforeSelect;
}
//End Close t_customerGrid_BeforeSelect

//Page_OnInitializeView @1-DBA0AAB0
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_create_uname; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
    global $selected_id;
    $selected_id = -1;
    $selected_id=CCGetFromGet("t_customer_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-FC3A394B
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_create_uname; //Compatibility
//End Page_BeforeShow

//Custom Code @529-2A29BDB7
// -------------------------
   $generate = CCGetFromGet("generate");
   $t_customer_id = CCGetFromGet("t_customer_id");
   $result = '';
   if($generate == "yes" and !empty($t_customer_id)) {
		$dbConn	= new clsDBConnSIKP(); 
		$query = "SELECT * FROM f_create_uname_password_wp(".$t_customer_id.") as hasil";
		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$result	 = $dbConn->f("hasil");
		}
		$dbConn->close();

		print_r($result);
		exit;
   }
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>
