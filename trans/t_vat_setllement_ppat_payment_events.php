<?php
//include_once(RelativePath . "/include/sessi.inc");
include_once(RelativePath . "/check_open_session.php");
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");
$no_kohir = CCGetFromGet('s_keyword');
$payment_key = $no_kohir;
	if(!empty($payment_key)){
		$dbConn = new clsDBConnSIKP();
  		$sql="select t_customer_order_id from t_vat_setllement_ppat where payment_key='".$payment_key."'";
  		$dbConn->query($sql);
  		$dbConn->next_record();
		$_POST['t_customer_order_id']=$_GET['t_customer_order_id'] = $dbConn->f('t_customer_order_id');
		$dbConn->close();

	}else{
		$_POST['t_customer_order_id']=$_GET['t_customer_order_id'] = CCGetFromGet('CURR_DOC_ID');
	}
//exit;
//BindEvents Method @1-06B40C42
function BindEvents()
{
    global $t_vat_setllementForm;
    global $CCSEvents;
    $t_vat_setllementForm->CCSEvents["BeforeShow"] = "t_vat_setllementForm_BeforeShow";
    $t_vat_setllementForm->CCSEvents["BeforeSelect"] = "t_vat_setllementForm_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_vat_setllementForm_BeforeShow @23-FE2321F2
function t_vat_setllementForm_BeforeShow(& $sender)
{
    $t_vat_setllementForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_BeforeShow
	global $t_vat_setllementGrid;
//Custom Code @380-2A29BDB7
// -------------------------
    // Write your own code here.
	$action_button = CCGetFromGet('action_button');
  	if($action_button=='flag_payment'){
  		$dbConn = new clsDBConnSIKP();
  		$sql="select sikp.f_payment_manual_ppat(".CCGetFromGet('t_customer_order_id').",'".CCGetSession('UserLogin')."')";
  		//echo $sql;exit;
		$dbConn->query($sql);
  		$dbConn->next_record();
		$pesan = $dbConn->f('f_payment_manual_ppat');
  		echo "
  		<script>
  		alert('".$pesan."');
		location.href='t_vat_setllement_ppat_payment.php';
  		</script>
  		";
		$dbConn->close();
  	}
// -------------------------
//End Custom Code

//Close t_vat_setllementForm_BeforeShow @23-08204CD1
    return $t_vat_setllementForm_BeforeShow;
}
//End Close t_vat_setllementForm_BeforeShow

//t_vat_setllementForm_BeforeSelect @23-46687DEC
function t_vat_setllementForm_BeforeSelect(& $sender)
{
    $t_vat_setllementForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementForm; //Compatibility
//End t_vat_setllementForm_BeforeSelect

//Custom Code @381-2A29BDB7
// -------------------------
    // Write your own code here.
	//$_SESSION['thisFormParam']='';
	
	if(!empty($_POST['t_customer_order_id'])||!empty($_GET['t_customer_order_id'])){
		$t_vat_setllementForm->EditMode=true;
		$t_vat_setllementForm->Visible=true;
	}else{
		$t_vat_setllementForm->Visible=false;
	}
	     // Write your own code here.
// -------------------------
//End Custom Code

//Close t_vat_setllementForm_BeforeSelect @23-489DCACD
    return $t_vat_setllementForm_BeforeSelect;
}
//End Close t_vat_setllementForm_BeforeSelect

//Page_OnInitializeView @1-EF0C024A
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ppat_payment; //Compatibility
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
        $selected_id=CCGetFromGet("t_vat_setllement_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-E900E7F5
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ppat_payment; //Compatibility
//End Page_BeforeShow

//Custom Code @193-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeInitialize @1-A4B76FEB
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllement_ppat_payment; //Compatibility
//End Page_BeforeInitialize

//Custom Code @384-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize
?>
