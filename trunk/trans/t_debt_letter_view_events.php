<?php
//Page_BeforeInitialize @1-1A4177C0
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_debt_letter_view; //Compatibility
//End Page_BeforeInitialize

	if(isset($_POST["t_customer_order_id"]) && isset($_POST["p_vat_type_id"])){
		$t_customer_order_id = $_POST["t_customer_order_id"];
		$p_vat_type_id = $_POST["p_vat_type_id"];
		header("Location: ../report/view_daftar_surat_teguran_pdf.php?t_customer_order_id=$t_customer_order_id&p_vat_type_id=$p_vat_type_id");
		exit;
	}

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
