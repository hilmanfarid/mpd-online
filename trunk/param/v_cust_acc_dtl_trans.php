<?php
//Include Common Files @1-5794DC3F
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "v_cust_acc_dtl_trans.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridVIEWDETTRANS { //VIEWDETTRANS class @2-1212C8D9

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

//Class_Initialize Event @2-7B1BC0E2
    function clsGridVIEWDETTRANS($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "VIEWDETTRANS";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid VIEWDETTRANS";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsVIEWDETTRANSDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->trans_date = & new clsControl(ccsLabel, "trans_date", "trans_date", ccsText, "", CCGetRequestParam("trans_date", ccsGet, NULL), $this);
        $this->bill_no = & new clsControl(ccsLabel, "bill_no", "bill_no", ccsText, "", CCGetRequestParam("bill_no", ccsGet, NULL), $this);
        $this->service_desc = & new clsControl(ccsLabel, "service_desc", "service_desc", ccsText, "", CCGetRequestParam("service_desc", ccsGet, NULL), $this);
        $this->service_charge = & new clsControl(ccsLabel, "service_charge", "service_charge", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge", ccsGet, NULL), $this);
        $this->vat_charge = & new clsControl(ccsLabel, "vat_charge", "vat_charge", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("vat_charge", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @2-9B97B474
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_vat_setllement_id"] = CCGetFromGet("t_vat_setllement_id", NULL);
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
            $this->ControlsVisible["trans_date"] = $this->trans_date->Visible;
            $this->ControlsVisible["bill_no"] = $this->bill_no->Visible;
            $this->ControlsVisible["service_desc"] = $this->service_desc->Visible;
            $this->ControlsVisible["service_charge"] = $this->service_charge->Visible;
            $this->ControlsVisible["vat_charge"] = $this->vat_charge->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->trans_date->SetValue($this->DataSource->trans_date->GetValue());
                $this->bill_no->SetValue($this->DataSource->bill_no->GetValue());
                $this->service_desc->SetValue($this->DataSource->service_desc->GetValue());
                $this->service_charge->SetValue($this->DataSource->service_charge->GetValue());
                $this->vat_charge->SetValue($this->DataSource->vat_charge->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->trans_date->Show();
                $this->bill_no->Show();
                $this->service_desc->Show();
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
        $this->Button1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-8D867751
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->trans_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->bill_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_charge->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_charge->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End VIEWDETTRANS Class @2-FCB6E20C

class clsVIEWDETTRANSDataSource extends clsDBConnSIKP {  //VIEWDETTRANSDataSource Class @2-519AA05F

//DataSource Variables @2-01A630AB
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $trans_date;
    var $bill_no;
    var $service_desc;
    var $service_charge;
    var $vat_charge;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-6804860D
    function clsVIEWDETTRANSDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid VIEWDETTRANS";
        $this->Initialize();
        $this->trans_date = new clsField("trans_date", ccsText, "");
        
        $this->bill_no = new clsField("bill_no", ccsText, "");
        
        $this->service_desc = new clsField("service_desc", ccsText, "");
        
        $this->service_charge = new clsField("service_charge", ccsFloat, "");
        
        $this->vat_charge = new clsField("vat_charge", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-2F1EDB74
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_setllement_id", ccsFloat, "", "", $this->Parameters["urlt_vat_setllement_id"], 0, false);
        $this->wp->AddParameter("2", "urlt_cust_account_id", ccsFloat, "", "", $this->Parameters["urlt_cust_account_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-B40346C1
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select  c.trans_date, c.bill_no, c.service_desc, c.service_charge, c.vat_charge \n" .
        "from t_vat_setllement a, \n" .
        "t_vat_setllement_dtl b, \n" .
        "t_cust_acc_dtl_trans c\n" .
        "where a.t_vat_setllement_id = b.t_vat_setllement_id and\n" .
        "      a.t_vat_setllement_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " and\n" .
        "      b.t_cust_acc_dtl_trans_id = c.t_cust_acc_dtl_trans_id and\n" .
        "      b.t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . ") cnt";
        $this->SQL = "select  c.trans_date, c.bill_no, c.service_desc, c.service_charge, c.vat_charge \n" .
        "from t_vat_setllement a, \n" .
        "t_vat_setllement_dtl b, \n" .
        "t_cust_acc_dtl_trans c\n" .
        "where a.t_vat_setllement_id = b.t_vat_setllement_id and\n" .
        "      a.t_vat_setllement_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " and\n" .
        "      b.t_cust_acc_dtl_trans_id = c.t_cust_acc_dtl_trans_id and\n" .
        "      b.t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-235A5CF9
    function SetValues()
    {
        $this->trans_date->SetDBValue($this->f("trans_date"));
        $this->bill_no->SetDBValue($this->f("bill_no"));
        $this->service_desc->SetDBValue($this->f("service_desc"));
        $this->service_charge->SetDBValue(trim($this->f("service_charge")));
        $this->vat_charge->SetDBValue(trim($this->f("vat_charge")));
    }
//End SetValues Method

} //End VIEWDETTRANSDataSource Class @2-FCB6E20C

//Initialize Page @1-24AE14B7
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
$TemplateFileName = "v_cust_acc_dtl_trans.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-40DD7E7E
include_once("./v_cust_acc_dtl_trans_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-5B215682
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$VIEWDETTRANS = & new clsGridVIEWDETTRANS("", $MainPage);
$MainPage->VIEWDETTRANS = & $VIEWDETTRANS;
$VIEWDETTRANS->Initialize();

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

//Go to destination page @1-5DA8D6C6
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($VIEWDETTRANS);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-2969AF5F
$VIEWDETTRANS->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-2E5E1A68
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($VIEWDETTRANS);
unset($Tpl);
//End Unload Page


?>
