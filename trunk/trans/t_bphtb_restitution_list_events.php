<?php
//BindEvents Method @1-9EDF8271
function BindEvents()
{
    global $t_bphtb_registration_list;
    global $CCSEvents;
    $t_bphtb_registration_list->CCSEvents["BeforeShowRow"] = "t_bphtb_registration_list_BeforeShowRow";
    $t_bphtb_registration_list->CCSEvents["BeforeSelect"] = "t_bphtb_registration_list_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
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

//Custom Code @705-2A29BDB7
// -------------------------
    // Write your own code here.
	// Start Bdr
	global $selected_id;
    global $add_flag;
	global $t_cust_order_legal_docSearch1;

    if ($selected_id<0 && $add_flag!="ADD") {
    	$selected_id = $Component->DataSource->t_bphtb_registration_id->GetValue();
		$t_cust_order_legal_docSearch1->t_bphtb_registration_id->SetValue($selected_id);
   }
    
// End Bdr  

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
	// Start Bdr    
      $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
      $Style = $styles[0];
      
      if ($Component->DataSource->t_bphtb_registration_id->GetValue()== $selected_id) {
      	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
          $Style = $styles[1];
          $is_show_form=1;
      }	
  // End Bdr  
    if (count($styles)) {
        //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style
	 $Component->DLink->SetValue($img_radio); // Bdr
// -------------------------
//End Custom Code

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

//Page_OnInitializeView @1-55F0EBD2
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_restitution_list; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
	global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("t_bphtb_registration_id", $selected_id);
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-7FB85AD5
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_restitution_list; //Compatibility
//End Page_BeforeShow

//Custom Code @703-2A29BDB7
// -------------------------
    // Write your own code here.
	if(CCGetFromGet("submit_bphtb")==1){
		$dbConn = new clsDBConnSIKP();
		$sql="select count(*) as jml from t_product_order_control where doc_id = ".CCGetFromGet('t_customer_order_id')."and and p_w_doc_type_id = 505";
		$dbConn->query($sql);
		$jumlah_data;
		if ($dbConn->next_record()){
            $jumlah_data = $dbConn->f('jml');
        }
		if($jumlah_data==0){
			$sql="select sikp.f_first_submit_engine(505,".CCGetFromGet('t_customer_order_id').",'".CCGetSession('UserLogin')."')";
			$dbConn->query($sql);
		}else{
			echo "
				<script>
					alert('Data BPHTB Sudah Tersubmit');
				</script>
			";
			//exit;
		}
		$dbConn->close();
		header('Location:t_bphtb_registration_list.php');
		exit;
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>
