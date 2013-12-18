<?php
//Include Common Files @1-41A19FE2
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_cust_acc_dtl_trans_month.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);

class clsGridt_cust_acc_dtl_transGrid { //t_cust_acc_dtl_transGrid class @2-8C4C454D

//Variables @2-AC1EDBB9

    // Public variables
    var $ComponentType = "Grid";
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $ErrorBlock;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $ForceIteration = false;
    var $HasRecord = false;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $RowNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";
    var $Attributes;

    // Grid Controls
    var $StaticControls;
    var $RowControls;
//End Variables

//Class_Initialize Event @2-0D345453
    function clsGridt_cust_acc_dtl_transGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_cust_acc_dtl_transGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_cust_acc_dtl_transGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_cust_acc_dtl_transGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 40;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->trans_date_txt = & new clsControl(ccsLabel, "trans_date_txt", "trans_date_txt", ccsText, "", CCGetRequestParam("trans_date_txt", ccsGet, NULL), $this);
        $this->service_charge = & new clsControl(ccsLabel, "service_charge", "service_charge", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge", ccsGet, NULL), $this);
        $this->vat_charge = & new clsControl(ccsLabel, "vat_charge", "vat_charge", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("vat_charge", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->npwd = & new clsControl(ccsHidden, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", ccsGet, NULL), $this);
        $this->trans_date = & new clsControl(ccsHidden, "trans_date", "trans_date", ccsText, "", CCGetRequestParam("trans_date", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->Button1 = & new clsButton("Button1", ccsGet, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-9F7E3FD1
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["trans_date_txt"] = $this->trans_date_txt->Visible;
            $this->ControlsVisible["service_charge"] = $this->service_charge->Visible;
            $this->ControlsVisible["vat_charge"] = $this->vat_charge->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->trans_date_txt->SetValue($this->DataSource->trans_date_txt->GetValue());
                $this->service_charge->SetValue($this->DataSource->service_charge->GetValue());
                $this->vat_charge->SetValue($this->DataSource->vat_charge->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->trans_date_txt->Show();
                $this->service_charge->Show();
                $this->vat_charge->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Navigator->Show();
        $this->npwd->Show();
        $this->trans_date->Show();
        $this->t_cust_account_id->Show();
        $this->Button1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-A77E8EA7
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->trans_date_txt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_charge->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_charge->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_cust_acc_dtl_transGrid Class @2-FCB6E20C

class clst_cust_acc_dtl_transGridDataSource extends clsDBConnSIKP {  //t_cust_acc_dtl_transGridDataSource Class @2-BC8B0014

//DataSource Variables @2-659AE4DA
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $trans_date_txt;
    var $service_charge;
    var $vat_charge;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-D7AC2335
    function clst_cust_acc_dtl_transGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_cust_acc_dtl_transGrid";
        $this->Initialize();
        $this->trans_date_txt = new clsField("trans_date_txt", ccsText, "");
        
        $this->service_charge = new clsField("service_charge", ccsFloat, "");
        
        $this->vat_charge = new clsField("vat_charge", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-B2B86AA2
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "trans_date_txt desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-43315469
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_account_id", ccsFloat, "", "", $this->Parameters["urlt_cust_account_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-EC3D8B14
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select * from f_get_cust_acc_dtl_trans_month(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ")) cnt";
        $this->SQL = "select * from f_get_cust_acc_dtl_trans_month(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ") {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-D206B5C8
    function SetValues()
    {
        $this->trans_date_txt->SetDBValue($this->f("trans_date_txt"));
        $this->service_charge->SetDBValue(trim($this->f("service_charge")));
        $this->vat_charge->SetDBValue(trim($this->f("vat_charge")));
    }
//End SetValues Method

} //End t_cust_acc_dtl_transGridDataSource Class @2-FCB6E20C

//Initialize Page @1-12253B5C
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
$TemplateFileName = "t_cust_acc_dtl_trans_month.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C9542DCE
include_once("./t_cust_acc_dtl_trans_month_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-BB0EDAA8
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_cust_acc_dtl_transGrid = & new clsGridt_cust_acc_dtl_transGrid("", $MainPage);
$MainPage->t_cust_acc_dtl_transGrid = & $t_cust_acc_dtl_transGrid;
$t_cust_acc_dtl_transGrid->Initialize();

BindEvents();

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

//Go to destination page @1-95FE7B97
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_cust_acc_dtl_transGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F2ACF535
$t_cust_acc_dtl_transGrid->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-35F8D23F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_cust_acc_dtl_transGrid);
unset($Tpl);
//End Unload Page


?>
