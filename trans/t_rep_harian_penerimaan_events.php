<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-89F9EAB4
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_harian_penerimaan; //Compatibility
//End Page_BeforeShow

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow
?>
