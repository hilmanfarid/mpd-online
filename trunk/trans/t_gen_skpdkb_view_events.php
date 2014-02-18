<?php
//Page_BeforeInitialize @1-D9BF4BC7
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_gen_skpdkb_view; //Compatibility
//End Page_BeforeInitialize

//Custom Code @65-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

	if(isset($_POST["t_customer_order_id"]) && isset($_POST["p_vat_type_id"])){
		$t_customer_order_id = $_POST["t_customer_order_id"];
		$p_vat_type_id = $_POST["p_vat_type_id"];
		$p_account_status_array = $_POST["p_account_status_array"];
		header("Location: ../report/view_daftar_gen_skpdkb.php?t_customer_order_id=$t_customer_order_id&p_vat_type_id=$p_vat_type_id&p_account_status_array=$p_account_status_array");
		exit;
	}

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
