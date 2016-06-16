<?php
//BindEvents Method @1-2B397B5B
function BindEvents()
{
    global $t_customer_orderForm;
    $t_customer_orderForm->CCSEvents["AfterUpdate"] = "t_customer_orderForm_AfterUpdate";
}
//End BindEvents Method

//t_customer_orderForm_AfterUpdate @28-919BB324
function t_customer_orderForm_AfterUpdate(& $sender)
{
    $t_customer_orderForm_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_customer_orderForm; //Compatibility
//End t_customer_orderForm_AfterUpdate

//Custom Code @103-2A29BDB7
// -------------------------
    // Write your own code here.
	if($row = pg_fetch_array($t_customer_orderForm->DataSource->itemResult)) {
	
	}
	
    echo "<script> 
		alert('".$row['msg']."');
		window.close();
	</script>";
	exit;
// -------------------------
//End Custom Code

//Close t_customer_orderForm_AfterUpdate @28-961EBACC
    return $t_customer_orderForm_AfterUpdate;
}
//End Close t_customer_orderForm_AfterUpdate


?>
