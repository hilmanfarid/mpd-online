<?php
//Include Common Files @1-AE154B22
define("RelativePath", "..");
define("PathToCurrentPage", "/workflow/");
define("FileName", "php_submitter_start.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Initialize Page @1-7E5FC5E7
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "php_submitter_start.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-E6A8E7D0
include_once("./php_submitter_start_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E22AAD7C
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$lblIFrame = & new clsControl(ccsLabel, "lblIFrame", "lblIFrame", ccsText, "", CCGetRequestParam("lblIFrame", ccsGet, null), $MainPage);
$lblIFrame->HTML = true;
$MainPage->lblIFrame = & $lblIFrame;
if(!is_array($lblIFrame->Value) && !strlen($lblIFrame->Value) && $lblIFrame->Value !== false)
    $lblIFrame->SetText("-");

////start swt 2010 
$lblIFrame->SetText(
	"<iframe id=frameboxsubmitter src='../lov/lov_submitter_start.php?" .   
	"CURR_DOC_ID=" . CCGetFromGet("CURR_DOC_ID", null) .
	"&CURR_DOC_TYPE_ID=" . CCGetFromGet("CURR_DOC_TYPE_ID", null) .  
	"&CURR_PROC_ID="   . CCGetFromGet("CURR_PROC_ID", null) .  
	"&CURR_CTL_ID="    . CCGetFromGet("CURR_CTL_ID", null) .  
	"&USER_ID_DOC="    . CCGetFromGet("USER_ID_DOC", null) . 
	"&USER_ID_DONOR="  . CCGetFromGet("USER_ID_DONOR", null) . 
	"&USER_ID_LOGIN="  . CCGetFromGet("USER_ID_LOGIN", null) . 
	"&USER_ID_TAKEN="  . CCGetFromGet("USER_ID_TAKEN", null) . 
	"&IS_CREATE_DOC="  . CCGetFromGet("IS_CREATE_DOC", null) . 
	"&IS_MANUAL="      . CCGetFromGet("IS_MANUAL", null) . 
	"&CURR_PROC_STATUS=" . CCGetFromGet("CURR_PROC_STATUS", null) . 
	"&CURR_DOC_STATUS="  . CCGetFromGet("CURR_DOC_STATUS", null) . 
	"&PREV_DOC_ID="  . CCGetFromGet("PREV_DOC_ID", null) . 
	"&PREV_DOC_TYPE_ID="  . CCGetFromGet("PREV_DOC_TYPE_ID", null) . 
	"&PREV_PROC_ID="  . CCGetFromGet("PREV_PROC_ID", null) . 
	"&PREV_CTL_ID="  . CCGetFromGet("PREV_CTL_ID", null) . 
	"&SLOT_1="  . CCGetFromGet("SLOT_1", null) . 
	"&SLOT_2="  . CCGetFromGet("SLOT_2", null) . 
	"&SLOT_3="  . CCGetFromGet("SLOT_3", null) . 
	"&SLOT_4="  . CCGetFromGet("SLOT_4", null) . 
	"&SLOT_5="  . CCGetFromGet("SLOT_5", null) . 
	"&MESSAGE="  . CCGetFromGet("MESSAGE", null) . 
	"' style='HEIGHT: 1000px; WIDTH: 1000px' frameBorder=0 frameSpacing=0 scrolling='no'></iframe>"
);
////end swt 

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects


//Initialize HTML Template @1-52F9C312
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Go to destination page @1-FBA93089
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    header("Location: " . $Redirect);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D2485354
$lblIFrame->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-74A7C1E7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
unset($Tpl);
//End Unload Page


?>
