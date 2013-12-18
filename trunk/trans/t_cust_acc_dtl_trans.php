<?php
//Include Common Files @1-920789A2
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_cust_acc_dtl_trans.php");
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

//Class_Initialize Event @2-1748800A
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
            $this->PageSize = 5;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_cust_acc_dtl_trans.php";
        $this->service_charge = & new clsControl(ccsLabel, "service_charge", "service_charge", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge", ccsGet, NULL), $this);
        $this->bill_no = & new clsControl(ccsLabel, "bill_no", "bill_no", ccsText, "", CCGetRequestParam("bill_no", ccsGet, NULL), $this);
        $this->t_cust_acc_dtl_trans_id = & new clsControl(ccsHidden, "t_cust_acc_dtl_trans_id", "t_cust_acc_dtl_trans_id", ccsFloat, "", CCGetRequestParam("t_cust_acc_dtl_trans_id", ccsGet, NULL), $this);
        $this->vat_charge = & new clsControl(ccsLabel, "vat_charge", "vat_charge", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("vat_charge", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->service_desc = & new clsControl(ccsLabel, "service_desc", "service_desc", ccsText, "", CCGetRequestParam("service_desc", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "t_cust_acc_dtl_trans.php";
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @2-6A21A472
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);
        $this->DataSource->Parameters["urltrans_date"] = CCGetFromGet("trans_date", NULL);

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
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["service_charge"] = $this->service_charge->Visible;
            $this->ControlsVisible["bill_no"] = $this->bill_no->Visible;
            $this->ControlsVisible["t_cust_acc_dtl_trans_id"] = $this->t_cust_acc_dtl_trans_id->Visible;
            $this->ControlsVisible["vat_charge"] = $this->vat_charge->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["service_desc"] = $this->service_desc->Visible;
            $this->ControlsVisible["t_cust_account_id"] = $this->t_cust_account_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_cust_acc_dtl_trans_id", $this->DataSource->f("t_cust_acc_dtl_trans_id"));
                $this->service_charge->SetValue($this->DataSource->service_charge->GetValue());
                $this->bill_no->SetValue($this->DataSource->bill_no->GetValue());
                $this->t_cust_acc_dtl_trans_id->SetValue($this->DataSource->t_cust_acc_dtl_trans_id->GetValue());
                $this->vat_charge->SetValue($this->DataSource->vat_charge->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->service_desc->SetValue($this->DataSource->service_desc->GetValue());
                $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->service_charge->Show();
                $this->bill_no->Show();
                $this->t_cust_acc_dtl_trans_id->Show();
                $this->vat_charge->Show();
                $this->description->Show();
                $this->service_desc->Show();
                $this->t_cust_account_id->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("t_cust_acc_dtl_trans", "s_keyword", "ccsForm"));
        $this->Insert_Link->Parameters = CCAddParam($this->Insert_Link->Parameters, "FLAG", "ADD");
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Insert_Link->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-396FC43D
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_charge->Errors->ToString());
        $errors = ComposeStrings($errors, $this->bill_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_acc_dtl_trans_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_charge->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_account_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_cust_acc_dtl_transGrid Class @2-FCB6E20C

class clst_cust_acc_dtl_transGridDataSource extends clsDBConnSIKP {  //t_cust_acc_dtl_transGridDataSource Class @2-BC8B0014

//DataSource Variables @2-0C8D47ED
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $service_charge;
    var $bill_no;
    var $t_cust_acc_dtl_trans_id;
    var $vat_charge;
    var $description;
    var $service_desc;
    var $t_cust_account_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-25D8D4AC
    function clst_cust_acc_dtl_transGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_cust_acc_dtl_transGrid";
        $this->Initialize();
        $this->service_charge = new clsField("service_charge", ccsFloat, "");
        
        $this->bill_no = new clsField("bill_no", ccsText, "");
        
        $this->t_cust_acc_dtl_trans_id = new clsField("t_cust_acc_dtl_trans_id", ccsFloat, "");
        
        $this->vat_charge = new clsField("vat_charge", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->service_desc = new clsField("service_desc", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        

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

//Prepare Method @2-488D2F2B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_account_id", ccsFloat, "", "", $this->Parameters["urlt_cust_account_id"], 0, false);
        $this->wp->AddParameter("2", "urltrans_date", ccsText, "", "", $this->Parameters["urltrans_date"], "", false);
    }
//End Prepare Method

//Open Method @2-8ADCEE72
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select t_cust_acc_dtl_trans_id, t_cust_account_id, bill_no, service_desc, service_charge, vat_charge, description\n" .
        "from f_get_cust_acc_dtl_trans(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ",'" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "')AS tbl (t_cust_acc_dtl_trans_id)) cnt";
        $this->SQL = "select t_cust_acc_dtl_trans_id, t_cust_account_id, bill_no, service_desc, service_charge, vat_charge, description\n" .
        "from f_get_cust_acc_dtl_trans(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ",'" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "')AS tbl (t_cust_acc_dtl_trans_id)";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-DB36CF83
    function SetValues()
    {
        $this->service_charge->SetDBValue(trim($this->f("service_charge")));
        $this->bill_no->SetDBValue($this->f("bill_no"));
        $this->t_cust_acc_dtl_trans_id->SetDBValue(trim($this->f("t_cust_acc_dtl_trans_id")));
        $this->vat_charge->SetDBValue(trim($this->f("vat_charge")));
        $this->description->SetDBValue($this->f("description"));
        $this->service_desc->SetDBValue($this->f("service_desc"));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
    }
//End SetValues Method

} //End t_cust_acc_dtl_transGridDataSource Class @2-FCB6E20C

class clsRecordt_cust_acc_dtl_transForm { //t_cust_acc_dtl_transForm Class @23-045A3E61

//Variables @23-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @23-4E47F91C
    function clsRecordt_cust_acc_dtl_transForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_cust_acc_dtl_transForm/Error";
        $this->DataSource = new clst_cust_acc_dtl_transFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_cust_acc_dtl_transForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->t_cust_acc_dtl_trans_id = & new clsControl(ccsHidden, "t_cust_acc_dtl_trans_id", "Id", ccsFloat, "", CCGetRequestParam("t_cust_acc_dtl_trans_id", $Method, NULL), $this);
            $this->bill_no = & new clsControl(ccsTextBox, "bill_no", "No Faktur", ccsText, "", CCGetRequestParam("bill_no", $Method, NULL), $this);
            $this->bill_no->Required = true;
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->t_cust_acc_dtl_transGridPage = & new clsControl(ccsHidden, "t_cust_acc_dtl_transGridPage", "t_cust_acc_dtl_transGridPage", ccsText, "", CCGetRequestParam("t_cust_acc_dtl_transGridPage", $Method, NULL), $this);
            $this->service_charge = & new clsControl(ccsTextBox, "service_charge", "Nilai Transaksi", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge", $Method, NULL), $this);
            $this->service_charge->Required = true;
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            $this->trans_date = & new clsControl(ccsHidden, "trans_date", "Tgl. Transaksi", ccsText, "", CCGetRequestParam("trans_date", $Method, NULL), $this);
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->vat_charge = & new clsControl(ccsTextBox, "vat_charge", "Nila Pajak", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("vat_charge", $Method, NULL), $this);
            $this->service_desc = & new clsControl(ccsTextBox, "service_desc", "Nama Faktur", ccsText, "", CCGetRequestParam("service_desc", $Method, NULL), $this);
            $this->Button1 = & new clsButton("Button1", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->t_cust_acc_dtl_trans_id->Value) && !strlen($this->t_cust_acc_dtl_trans_id->Value) && $this->t_cust_acc_dtl_trans_id->Value !== false)
                    $this->t_cust_acc_dtl_trans_id->SetText(0);
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->trans_date->Value) && !strlen($this->trans_date->Value) && $this->trans_date->Value !== false)
                    $this->trans_date->SetText(date("Y-m-d"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @23-B53CC0E2
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_cust_acc_dtl_trans_id"] = CCGetFromGet("t_cust_acc_dtl_trans_id", NULL);
    }
//End Initialize Method

//Validate Method @23-FBE0E838
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_cust_acc_dtl_trans_id->Validate() && $Validation);
        $Validation = ($this->bill_no->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->t_cust_acc_dtl_transGridPage->Validate() && $Validation);
        $Validation = ($this->service_charge->Validate() && $Validation);
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $Validation = ($this->trans_date->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->vat_charge->Validate() && $Validation);
        $Validation = ($this->service_desc->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_cust_acc_dtl_trans_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bill_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_acc_dtl_transGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->service_charge->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->trans_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vat_charge->Errors->Count() == 0);
        $Validation =  $Validation && ($this->service_desc->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-0E3F325B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_cust_acc_dtl_trans_id->Errors->Count());
        $errors = ($errors || $this->bill_no->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->t_cust_acc_dtl_transGridPage->Errors->Count());
        $errors = ($errors || $this->service_charge->Errors->Count());
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->trans_date->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->vat_charge->Errors->Count());
        $errors = ($errors || $this->service_desc->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @23-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @23-97692C4F
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;
		
		//asep edit
		$trx = CCGetFromGet("trans_date",""); //$trans_date = empty(something) ? sysdate: something;
		$trans_date = empty($trx) ? date('Y-m-d') : $trx;
		$cusId = $this->t_cust_account_id->GetValue();
		//end asep

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            } else if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            //edit asep
			if(empty($trx)){
            	$Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_cust_acc_dtl_trans_id", "t_cust_acc_dtl_transGridPage"))."&t_cust_account_id=" .$cusId."&trans_date=".$trans_date;
			}else{
				$Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_cust_acc_dtl_trans_id", "t_cust_acc_dtl_transGridPage"));
			}
			//end 	
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_cust_acc_dtl_trans_id", "t_cust_acc_dtl_transGridPage"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                //edit
				if(empty($trx)){
	                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"))."&t_cust_account_id=" .$cusId."&trans_date=".$trans_date;
	            }else{
					$Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
				}
				//end
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                //edit
				if(empty($trx)){
	                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"))."&t_cust_account_id=" .$cusId."&trans_date=".$trans_date;
				}else{
					$Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
				}	
				//end
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @23-6B01329B
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->service_desc->SetValue($this->service_desc->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->t_cust_account_id->SetValue($this->t_cust_account_id->GetValue(true));
        $this->DataSource->bill_no->SetValue($this->bill_no->GetValue(true));
        $this->DataSource->service_charge->SetValue($this->service_charge->GetValue(true));
        $this->DataSource->vat_charge->SetValue($this->vat_charge->GetValue(true));
        $this->DataSource->trans_date->SetValue($this->trans_date->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//DeleteRow Method @23-BF3E18BA
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_cust_acc_dtl_trans_id->SetValue($this->t_cust_acc_dtl_trans_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-AD5EC3EC
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->t_cust_acc_dtl_trans_id->SetValue($this->DataSource->t_cust_acc_dtl_trans_id->GetValue());
                    $this->bill_no->SetValue($this->DataSource->bill_no->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->service_charge->SetValue($this->DataSource->service_charge->GetValue());
                    $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                    $this->trans_date->SetValue($this->DataSource->trans_date->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->vat_charge->SetValue($this->DataSource->vat_charge->GetValue());
                    $this->service_desc->SetValue($this->DataSource->service_desc->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_cust_acc_dtl_trans_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bill_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cust_acc_dtl_transGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->service_charge->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->trans_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vat_charge->Errors->ToString());
            $Error = ComposeStrings($Error, $this->service_desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $this->t_cust_acc_dtl_trans_id->Show();
        $this->bill_no->Show();
        $this->creation_date->Show();
        $this->created_by->Show();
        $this->updated_date->Show();
        $this->updated_by->Show();
        $this->t_cust_acc_dtl_transGridPage->Show();
        $this->service_charge->Show();
        $this->t_cust_account_id->Show();
        $this->trans_date->Show();
        $this->description->Show();
        $this->vat_charge->Show();
        $this->service_desc->Show();
        $this->Button1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_cust_acc_dtl_transForm Class @23-FCB6E20C

class clst_cust_acc_dtl_transFormDataSource extends clsDBConnSIKP {  //t_cust_acc_dtl_transFormDataSource Class @23-E3BC96E0

//DataSource Variables @23-9AC25C25
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $t_cust_acc_dtl_trans_id;
    var $bill_no;
    var $creation_date;
    var $created_by;
    var $updated_date;
    var $updated_by;
    var $t_cust_acc_dtl_transGridPage;
    var $service_charge;
    var $t_cust_account_id;
    var $trans_date;
    var $description;
    var $vat_charge;
    var $service_desc;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-776B300C
    function clst_cust_acc_dtl_transFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_cust_acc_dtl_transForm/Error";
        $this->Initialize();
        $this->t_cust_acc_dtl_trans_id = new clsField("t_cust_acc_dtl_trans_id", ccsFloat, "");
        
        $this->bill_no = new clsField("bill_no", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->t_cust_acc_dtl_transGridPage = new clsField("t_cust_acc_dtl_transGridPage", ccsText, "");
        
        $this->service_charge = new clsField("service_charge", ccsFloat, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->trans_date = new clsField("trans_date", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->vat_charge = new clsField("vat_charge", ccsFloat, "");
        
        $this->service_desc = new clsField("service_desc", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-3072739C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_acc_dtl_trans_id", ccsFloat, "", "", $this->Parameters["urlt_cust_acc_dtl_trans_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @23-D0C757A4
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT t_cust_acc_dtl_trans_id, t_cust_account_id, to_char(trans_date,'YYYY-MM-DD')as trans_date, bill_no, p_entertaintment_type_id, p_hotel_grade_id, p_room_type_id,\n" .
        "p_parking_classification_id, updated_by, to_char(updated_date,'DD-MON-YYYY')as updated_date, created_by, to_char(creation_date,'DD-MON-YYYY')as creation_date, description, portion_person, f_and_b,\n" .
        "booking_hour, clerk_qty, room_qty, seat_qty, vat_charge, service_charge, service_desc, p_rest_service_type_id, power_capacity,\n" .
        "p_pwr_classification_id \n" .
        "FROM t_cust_acc_dtl_trans\n" .
        "WHERE t_cust_acc_dtl_trans_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-34DFDE41
    function SetValues()
    {
        $this->t_cust_acc_dtl_trans_id->SetDBValue(trim($this->f("t_cust_acc_dtl_trans_id")));
        $this->bill_no->SetDBValue($this->f("bill_no"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->service_charge->SetDBValue(trim($this->f("service_charge")));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->trans_date->SetDBValue($this->f("trans_date"));
        $this->description->SetDBValue($this->f("description"));
        $this->vat_charge->SetDBValue(trim($this->f("vat_charge")));
        $this->service_desc->SetDBValue($this->f("service_desc"));
    }
//End SetValues Method

//Insert Method @23-DA43526F
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["service_desc"] = new clsSQLParameter("ctrlservice_desc", ccsText, "", "", $this->service_desc->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_cust_account_id"] = new clsSQLParameter("ctrlt_cust_account_id", ccsFloat, "", "", $this->t_cust_account_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["bill_no"] = new clsSQLParameter("ctrlbill_no", ccsText, "", "", $this->bill_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["service_charge"] = new clsSQLParameter("ctrlservice_charge", ccsFloat, "", "", $this->service_charge->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["vat_charge"] = new clsSQLParameter("ctrlvat_charge", ccsFloat, "", "", $this->vat_charge->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["UserName"] = new clsSQLParameter("expr263", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["trans_date"] = new clsSQLParameter("ctrltrans_date", ccsText, "", "", $this->trans_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["service_desc"]->GetValue()) and !strlen($this->cp["service_desc"]->GetText()) and !is_bool($this->cp["service_desc"]->GetValue())) 
            $this->cp["service_desc"]->SetValue($this->service_desc->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["t_cust_account_id"]->GetValue()) and !strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue())) 
            $this->cp["t_cust_account_id"]->SetValue($this->t_cust_account_id->GetValue(true));
        if (!strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue(true))) 
            $this->cp["t_cust_account_id"]->SetText(0);
        if (!is_null($this->cp["bill_no"]->GetValue()) and !strlen($this->cp["bill_no"]->GetText()) and !is_bool($this->cp["bill_no"]->GetValue())) 
            $this->cp["bill_no"]->SetValue($this->bill_no->GetValue(true));
        if (!is_null($this->cp["service_charge"]->GetValue()) and !strlen($this->cp["service_charge"]->GetText()) and !is_bool($this->cp["service_charge"]->GetValue())) 
            $this->cp["service_charge"]->SetValue($this->service_charge->GetValue(true));
        if (!strlen($this->cp["service_charge"]->GetText()) and !is_bool($this->cp["service_charge"]->GetValue(true))) 
            $this->cp["service_charge"]->SetText(0);
        if (!is_null($this->cp["vat_charge"]->GetValue()) and !strlen($this->cp["vat_charge"]->GetText()) and !is_bool($this->cp["vat_charge"]->GetValue())) 
            $this->cp["vat_charge"]->SetValue($this->vat_charge->GetValue(true));
        if (!strlen($this->cp["vat_charge"]->GetText()) and !is_bool($this->cp["vat_charge"]->GetValue(true))) 
            $this->cp["vat_charge"]->SetText(0);
        if (!is_null($this->cp["UserName"]->GetValue()) and !strlen($this->cp["UserName"]->GetText()) and !is_bool($this->cp["UserName"]->GetValue())) 
            $this->cp["UserName"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["trans_date"]->GetValue()) and !strlen($this->cp["trans_date"]->GetText()) and !is_bool($this->cp["trans_date"]->GetValue())) 
            $this->cp["trans_date"]->SetValue($this->trans_date->GetValue(true));
        $this->SQL = "select o_result_code, o_result_msg from \n" .
        "f_ins_cust_acc_dtl_trans(" . $this->SQLValue($this->cp["t_cust_account_id"]->GetDBValue(), ccsFloat) . ",\n" .
        "                         '" . $this->SQLValue($this->cp["trans_date"]->GetDBValue(), ccsText) . "',\n" .
        "                         '" . $this->SQLValue($this->cp["bill_no"]->GetDBValue(), ccsText) . "',\n" .
        "                         null,\n" .
        "                         " . $this->SQLValue($this->cp["service_charge"]->GetDBValue(), ccsFloat) . ",\n" .
        "                         null,\n" .
        "                         '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "',\n" .
        "                         '" . $this->SQLValue($this->cp["UserName"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
			while ($this->next_record()){
				$msg = $this->f("o_result_msg");
			}
						
			if(trim($msg) != 'OK'){
				$this->Errors->addError("Penyimpanan Gagal Dilakukan");
				return;
			}
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Delete Method @23-0123EEB3
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_cust_acc_dtl_trans_id"] = new clsSQLParameter("ctrlt_cust_acc_dtl_trans_id", ccsFloat, "", "", $this->t_cust_acc_dtl_trans_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_cust_acc_dtl_trans_id"]->GetValue()) and !strlen($this->cp["t_cust_acc_dtl_trans_id"]->GetText()) and !is_bool($this->cp["t_cust_acc_dtl_trans_id"]->GetValue())) 
            $this->cp["t_cust_acc_dtl_trans_id"]->SetValue($this->t_cust_acc_dtl_trans_id->GetValue(true));
        if (!strlen($this->cp["t_cust_acc_dtl_trans_id"]->GetText()) and !is_bool($this->cp["t_cust_acc_dtl_trans_id"]->GetValue(true))) 
            $this->cp["t_cust_acc_dtl_trans_id"]->SetText(0);
        $this->SQL = "DELETE FROM t_cust_acc_dtl_trans\n" .
        "WHERE  t_cust_acc_dtl_trans_id = " . $this->SQLValue($this->cp["t_cust_acc_dtl_trans_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_cust_acc_dtl_transFormDataSource Class @23-FCB6E20C

class clsRecordt_cust_acc_dtl_transSearch { //t_cust_acc_dtl_transSearch Class @3-3FDFD0AF

//Variables @3-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @3-6331BF10
    function clsRecordt_cust_acc_dtl_transSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_cust_acc_dtl_transSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_cust_acc_dtl_transSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->trans_date = & new clsControl(ccsTextBox, "trans_date", "Tgl. Transaksi", ccsText, "", CCGetRequestParam("trans_date", $Method, NULL), $this);
            $this->trans_date->Required = true;
            $this->DatePicker_trans_date = & new clsDatePicker("DatePicker_trans_date", "t_cust_acc_dtl_transSearch", "trans_date", $this);
            $this->npwd = & new clsControl(ccsTextBox, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->trans_date->Value) && !strlen($this->trans_date->Value) && $this->trans_date->Value !== false)
                    $this->trans_date->SetText(date("Y-m-d"));
            }
        }
    }
//End Class_Initialize Event

//Validate Method @3-731ECDED
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->trans_date->Validate() && $Validation);
        $Validation = ($this->npwd->Validate() && $Validation);
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->trans_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npwd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-DF9EFDB4
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->trans_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_trans_date->Errors->Count());
        $errors = ($errors || $this->npwd->Errors->Count());
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @3-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @3-2837BDCE
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "t_cust_acc_dtl_trans.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_cust_acc_dtl_trans.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-CF438434
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->trans_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_trans_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npwd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->trans_date->Show();
        $this->DatePicker_trans_date->Show();
        $this->npwd->Show();
        $this->Button_DoSearch->Show();
        $this->t_cust_account_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_cust_acc_dtl_transSearch Class @3-FCB6E20C

class clsRecorduploadForm { //uploadForm Class @94-A431A843

//Variables @94-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @94-7310CDC4
    function clsRecorduploadForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record uploadForm/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "uploadForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_xl = & new clsButton("Button_xl", $Method, $this);
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            $this->trans_date = & new clsControl(ccsHidden, "trans_date", "trans_date", ccsText, "", CCGetRequestParam("trans_date", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @94-BD47BD3C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $Validation = ($this->trans_date->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->trans_date->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-BA09CE1C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->trans_date->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @94-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @94-9A6B869C
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;
		
		$ids = $this->t_cust_account_id->GetValue();
		$dtl = $this->trans_date->GetValue();

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_xl";
            if($this->Button_xl->Pressed) {
                $this->PressedButton = "Button_xl";
            }
        }
        $Redirect = "t_cust_acc_dtl_trans.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_xl") {
                $Redirect = "t_cust_acc_dtl_trans.php?t_cust_account_id=".$ids."&trans_date=".$dtl;
                if(!CCGetEvent($this->Button_xl->CCSEvents, "OnClick", $this->Button_xl)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @94-4C45AF46
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->trans_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_xl->Show();
        $this->t_cust_account_id->Show();
        $this->trans_date->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End uploadForm Class @94-FCB6E20C



//Initialize Page @1-39776536
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
$TemplateFileName = "t_cust_acc_dtl_trans.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-09D9DC12
include_once("./t_cust_acc_dtl_trans_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-76F85A82
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_cust_acc_dtl_transGrid = & new clsGridt_cust_acc_dtl_transGrid("", $MainPage);
$t_cust_acc_dtl_transForm = & new clsRecordt_cust_acc_dtl_transForm("", $MainPage);
$t_cust_acc_dtl_transSearch = & new clsRecordt_cust_acc_dtl_transSearch("", $MainPage);
$uploadForm = & new clsRecorduploadForm("", $MainPage);
$MainPage->t_cust_acc_dtl_transGrid = & $t_cust_acc_dtl_transGrid;
$MainPage->t_cust_acc_dtl_transForm = & $t_cust_acc_dtl_transForm;
$MainPage->t_cust_acc_dtl_transSearch = & $t_cust_acc_dtl_transSearch;
$MainPage->uploadForm = & $uploadForm;
$t_cust_acc_dtl_transGrid->Initialize();
$t_cust_acc_dtl_transForm->Initialize();

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

//Execute Components @1-6DE3552A
$t_cust_acc_dtl_transForm->Operation();
$t_cust_acc_dtl_transSearch->Operation();
$uploadForm->Operation();
//End Execute Components

//Go to destination page @1-79F265ED
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_cust_acc_dtl_transGrid);
    unset($t_cust_acc_dtl_transForm);
    unset($t_cust_acc_dtl_transSearch);
    unset($uploadForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-CD5EB681
$t_cust_acc_dtl_transGrid->Show();
$t_cust_acc_dtl_transForm->Show();
$t_cust_acc_dtl_transSearch->Show();
$uploadForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-140F7B17
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_cust_acc_dtl_transGrid);
unset($t_cust_acc_dtl_transForm);
unset($t_cust_acc_dtl_transSearch);
unset($uploadForm);
unset($Tpl);
//End Unload Page


?>
