<?php
//BindEvents Method @1-AA556BD3
function BindEvents()
{
    global $lblIFrame;
    $lblIFrame->CCSEvents["BeforeShow"] = "lblIFrame_BeforeShow";
}
//End BindEvents Method

//lblIFrame_BeforeShow @2-D45BDAE3
function lblIFrame_BeforeShow(& $sender)
{
    $lblIFrame_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $lblIFrame; //Compatibility
//End lblIFrame_BeforeShow

//Custom Code @3-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close lblIFrame_BeforeShow @2-13DF2DA1
    return $lblIFrame_BeforeShow;
}
//End Close lblIFrame_BeforeShow


?>
