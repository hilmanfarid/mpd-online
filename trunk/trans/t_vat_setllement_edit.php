<?php
//Include Common Files @1-D69AF621
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_setllement_edit.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_vat_setllementGrid { //t_vat_setllementGrid class @2-AD714316

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

//Class_Initialize Event @2-5BF6F102
    function clsGridt_vat_setllementGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_setllementGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_setllementGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_setllementGridDataSource($this);
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
        $this->DLink->Page = "t_vat_setllement_edit.php";
        $this->order_no = & new clsControl(ccsLabel, "order_no", "order_no", ccsText, "", CCGetRequestParam("order_no", ccsGet, NULL), $this);
        $this->total_trans_amount = & new clsControl(ccsLabel, "total_trans_amount", "total_trans_amount", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("total_trans_amount", ccsGet, NULL), $this);
        $this->total_vat_amount = & new clsControl(ccsLabel, "total_vat_amount", "total_vat_amount", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("total_vat_amount", ccsGet, NULL), $this);
        $this->finance_period_code = & new clsControl(ccsLabel, "finance_period_code", "finance_period_code", ccsText, "", CCGetRequestParam("finance_period_code", ccsGet, NULL), $this);
        $this->t_vat_setllement_id = & new clsControl(ccsHidden, "t_vat_setllement_id", "t_vat_setllement_id", ccsFloat, "", CCGetRequestParam("t_vat_setllement_id", ccsGet, NULL), $this);
        $this->npwd = & new clsControl(ccsLabel, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", ccsGet, NULL), $this);
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

//Show Method @2-E3AFD77B
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr261"] = 1;
        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["expr373"] = 2;

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
            $this->ControlsVisible["order_no"] = $this->order_no->Visible;
            $this->ControlsVisible["total_trans_amount"] = $this->total_trans_amount->Visible;
            $this->ControlsVisible["total_vat_amount"] = $this->total_vat_amount->Visible;
            $this->ControlsVisible["finance_period_code"] = $this->finance_period_code->Visible;
            $this->ControlsVisible["t_vat_setllement_id"] = $this->t_vat_setllement_id->Visible;
            $this->ControlsVisible["npwd"] = $this->npwd->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_vat_setllement_id", $this->DataSource->f("t_vat_setllement_id"));
                $this->order_no->SetValue($this->DataSource->order_no->GetValue());
                $this->total_trans_amount->SetValue($this->DataSource->total_trans_amount->GetValue());
                $this->total_vat_amount->SetValue($this->DataSource->total_vat_amount->GetValue());
                $this->finance_period_code->SetValue($this->DataSource->finance_period_code->GetValue());
                $this->t_vat_setllement_id->SetValue($this->DataSource->t_vat_setllement_id->GetValue());
                $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->order_no->Show();
                $this->total_trans_amount->Show();
                $this->total_vat_amount->Show();
                $this->finance_period_code->Show();
                $this->t_vat_setllement_id->Show();
                $this->npwd->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-B4B23835
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->order_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_trans_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_vat_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->finance_period_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_setllement_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->npwd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_setllementGrid Class @2-FCB6E20C

class clst_vat_setllementGridDataSource extends clsDBConnSIKP {  //t_vat_setllementGridDataSource Class @2-F0AECE38

//DataSource Variables @2-3A9E3928
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $order_no;
    var $total_trans_amount;
    var $total_vat_amount;
    var $finance_period_code;
    var $t_vat_setllement_id;
    var $npwd;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-C26FF617
    function clst_vat_setllementGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_setllementGrid";
        $this->Initialize();
        $this->order_no = new clsField("order_no", ccsText, "");
        
        $this->total_trans_amount = new clsField("total_trans_amount", ccsFloat, "");
        
        $this->total_vat_amount = new clsField("total_vat_amount", ccsFloat, "");
        
        $this->finance_period_code = new clsField("finance_period_code", ccsText, "");
        
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsFloat, "");
        
        $this->npwd = new clsField("npwd", ccsText, "");
        

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

//Prepare Method @2-C2C1BDBF
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr261", ccsFloat, "", "", $this->Parameters["expr261"], "", false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("3", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("4", "expr373", ccsFloat, "", "", $this->Parameters["expr373"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "p_order_status_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "upper(npwd)", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "upper(finance_period_code)", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "p_settlement_type_id", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsFloat),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], $this->wp->opOR(
             true, 
             $this->wp->Criterion[2], 
             $this->wp->Criterion[3])), 
             $this->wp->Criterion[4]);
    }
//End Prepare Method

//Open Method @2-786280E0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_vat_setllement";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_vat_setllement {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-6DF14179
    function SetValues()
    {
        $this->order_no->SetDBValue($this->f("order_no"));
        $this->total_trans_amount->SetDBValue(trim($this->f("total_trans_amount")));
        $this->total_vat_amount->SetDBValue(trim($this->f("total_vat_amount")));
        $this->finance_period_code->SetDBValue($this->f("finance_period_code"));
        $this->t_vat_setllement_id->SetDBValue(trim($this->f("t_vat_setllement_id")));
        $this->npwd->SetDBValue($this->f("npwd"));
    }
//End SetValues Method

} //End t_vat_setllementGridDataSource Class @2-FCB6E20C

class clsRecordt_vat_setllementForm { //t_vat_setllementForm Class @23-D94969C3

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

//Class_Initialize Event @23-DD6B11EF
    function clsRecordt_vat_setllementForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_vat_setllementForm/Error";
        $this->DataSource = new clst_vat_setllementFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_vat_setllementForm";
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
            $this->finance_period_code = & new clsControl(ccsTextBox, "finance_period_code", "finance_period_code", ccsText, "", CCGetRequestParam("finance_period_code", $Method, NULL), $this);
            $this->finance_period_code->Required = true;
            $this->order_no = & new clsControl(ccsTextBox, "order_no", "order_no", ccsText, "", CCGetRequestParam("order_no", $Method, NULL), $this);
            $this->order_no->Required = true;
            $this->total_trans_amount = & new clsControl(ccsTextBox, "total_trans_amount", "total_trans_amount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_trans_amount", $Method, NULL), $this);
            $this->total_trans_amount->Required = true;
            $this->total_vat_amount = & new clsControl(ccsTextBox, "total_vat_amount", "total_vat_amount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_vat_amount", $Method, NULL), $this);
            $this->total_vat_amount->Required = true;
            $this->npwd = & new clsControl(ccsTextBox, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", $Method, NULL), $this);
            $this->npwd->Required = true;
            $this->t_vat_setllement_id = & new clsControl(ccsHidden, "t_vat_setllement_id", "Id", ccsFloat, "", CCGetRequestParam("t_vat_setllement_id", $Method, NULL), $this);
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", $Method, NULL), $this);
            $this->p_rqst_type_id = & new clsControl(ccsHidden, "p_rqst_type_id", "p_rqst_type_id", ccsFloat, "", CCGetRequestParam("p_rqst_type_id", $Method, NULL), $this);
            $this->year_code = & new clsControl(ccsTextBox, "year_code", "Periode Tahun", ccsText, "", CCGetRequestParam("year_code", $Method, NULL), $this);
            $this->year_code->Required = true;
            $this->p_year_period_id = & new clsControl(ccsHidden, "p_year_period_id", "p_year_period_id", ccsFloat, "", CCGetRequestParam("p_year_period_id", $Method, NULL), $this);
            $this->jenis_pajak = & new clsControl(ccsTextBox, "jenis_pajak", "Jenis Pajak", ccsText, "", CCGetRequestParam("jenis_pajak", $Method, NULL), $this);
            $this->wp_name = & new clsControl(ccsTextBox, "wp_name", "Nama Wajib Pajak", ccsText, "", CCGetRequestParam("wp_name", $Method, NULL), $this);
            $this->wp_address_name = & new clsControl(ccsTextArea, "wp_address_name", "Alamat Wajib Pajak", ccsText, "", CCGetRequestParam("wp_address_name", $Method, NULL), $this);
            $this->start_period = & new clsControl(ccsTextBox, "start_period", "Masa Pajak", ccsText, "", CCGetRequestParam("start_period", $Method, NULL), $this);
            $this->start_period->Required = true;
            $this->DatePicker_start_period = & new clsDatePicker("DatePicker_start_period", "t_vat_setllementForm", "start_period", $this);
            $this->end_period = & new clsControl(ccsTextBox, "end_period", "end_period", ccsText, "", CCGetRequestParam("end_period", $Method, NULL), $this);
            $this->end_period->Required = true;
            $this->DatePicker_end_period = & new clsDatePicker("DatePicker_end_period", "t_vat_setllementForm", "end_period", $this);
            $this->due_date = & new clsControl(ccsTextBox, "due_date", "due_date", ccsText, "", CCGetRequestParam("due_date", $Method, NULL), $this);
            $this->due_date->Required = true;
            $this->debt_vat_amt = & new clsControl(ccsTextBox, "debt_vat_amt", "debt_vat_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("debt_vat_amt", $Method, NULL), $this);
            $this->debt_vat_amt->Required = true;
            $this->cr_adjustment = & new clsControl(ccsTextBox, "cr_adjustment", "cr_adjustment", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("cr_adjustment", $Method, NULL), $this);
            $this->cr_adjustment->Required = true;
            $this->cr_others = & new clsControl(ccsTextBox, "cr_others", "cr_others", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("cr_others", $Method, NULL), $this);
            $this->cr_others->Required = true;
            $this->cr_payment = & new clsControl(ccsTextBox, "cr_payment", "cr_payment", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("cr_payment", $Method, NULL), $this);
            $this->cr_payment->Required = true;
            $this->cr_stp = & new clsControl(ccsTextBox, "cr_stp", "cr_stp", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("cr_stp", $Method, NULL), $this);
            $this->cr_stp->Required = true;
            $this->db_interest_charge = & new clsControl(ccsTextBox, "db_interest_charge", "db_interest_charge", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("db_interest_charge", $Method, NULL), $this);
            $this->db_interest_charge->Required = true;
            $this->db_increasing_charge = & new clsControl(ccsTextBox, "db_increasing_charge", "db_increasing_charge", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("db_increasing_charge", $Method, NULL), $this);
            $this->db_increasing_charge->Required = true;
            $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsFloat, "", CCGetRequestParam("t_customer_order_id", $Method, NULL), $this);
            $this->p_finance_period_id = & new clsControl(ccsHidden, "p_finance_period_id", "p_finance_period_id", ccsFloat, "", CCGetRequestParam("p_finance_period_id", $Method, NULL), $this);
            $this->DatePicker_due_date = & new clsDatePicker("DatePicker_due_date", "t_vat_setllementForm", "due_date", $this);
            $this->total_penalty_amount = & new clsControl(ccsTextBox, "total_penalty_amount", "total_penalty_amount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_penalty_amount", $Method, NULL), $this);
            $this->total_penalty_amount->Required = true;
            if(!$this->FormSubmitted) {
                if(!is_array($this->total_trans_amount->Value) && !strlen($this->total_trans_amount->Value) && $this->total_trans_amount->Value !== false)
                    $this->total_trans_amount->SetText(0);
                if(!is_array($this->total_vat_amount->Value) && !strlen($this->total_vat_amount->Value) && $this->total_vat_amount->Value !== false)
                    $this->total_vat_amount->SetText(0);
                if(!is_array($this->start_period->Value) && !strlen($this->start_period->Value) && $this->start_period->Value !== false)
                    $this->start_period->SetText(date("d-M-Y"));
                if(!is_array($this->end_period->Value) && !strlen($this->end_period->Value) && $this->end_period->Value !== false)
                    $this->end_period->SetText(date("d-M-Y"));
                if(!is_array($this->due_date->Value) && !strlen($this->due_date->Value) && $this->due_date->Value !== false)
                    $this->due_date->SetText(date("d-M-Y"));
                if(!is_array($this->debt_vat_amt->Value) && !strlen($this->debt_vat_amt->Value) && $this->debt_vat_amt->Value !== false)
                    $this->debt_vat_amt->SetText(0);
                if(!is_array($this->cr_adjustment->Value) && !strlen($this->cr_adjustment->Value) && $this->cr_adjustment->Value !== false)
                    $this->cr_adjustment->SetText(0);
                if(!is_array($this->cr_others->Value) && !strlen($this->cr_others->Value) && $this->cr_others->Value !== false)
                    $this->cr_others->SetText(0);
                if(!is_array($this->cr_payment->Value) && !strlen($this->cr_payment->Value) && $this->cr_payment->Value !== false)
                    $this->cr_payment->SetText(0);
                if(!is_array($this->cr_stp->Value) && !strlen($this->cr_stp->Value) && $this->cr_stp->Value !== false)
                    $this->cr_stp->SetText(0);
                if(!is_array($this->db_interest_charge->Value) && !strlen($this->db_interest_charge->Value) && $this->db_interest_charge->Value !== false)
                    $this->db_interest_charge->SetText(0);
                if(!is_array($this->db_increasing_charge->Value) && !strlen($this->db_increasing_charge->Value) && $this->db_increasing_charge->Value !== false)
                    $this->db_increasing_charge->SetText(0);
                if(!is_array($this->total_penalty_amount->Value) && !strlen($this->total_penalty_amount->Value) && $this->total_penalty_amount->Value !== false)
                    $this->total_penalty_amount->SetText(0);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @23-F2D2DDB3
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_vat_setllement_id"] = CCGetFromGet("t_vat_setllement_id", NULL);
    }
//End Initialize Method

//Validate Method @23-31826067
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->finance_period_code->Validate() && $Validation);
        $Validation = ($this->order_no->Validate() && $Validation);
        $Validation = ($this->total_trans_amount->Validate() && $Validation);
        $Validation = ($this->total_vat_amount->Validate() && $Validation);
        $Validation = ($this->npwd->Validate() && $Validation);
        $Validation = ($this->t_vat_setllement_id->Validate() && $Validation);
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id->Validate() && $Validation);
        $Validation = ($this->p_rqst_type_id->Validate() && $Validation);
        $Validation = ($this->year_code->Validate() && $Validation);
        $Validation = ($this->p_year_period_id->Validate() && $Validation);
        $Validation = ($this->jenis_pajak->Validate() && $Validation);
        $Validation = ($this->wp_name->Validate() && $Validation);
        $Validation = ($this->wp_address_name->Validate() && $Validation);
        $Validation = ($this->start_period->Validate() && $Validation);
        $Validation = ($this->end_period->Validate() && $Validation);
        $Validation = ($this->due_date->Validate() && $Validation);
        $Validation = ($this->debt_vat_amt->Validate() && $Validation);
        $Validation = ($this->cr_adjustment->Validate() && $Validation);
        $Validation = ($this->cr_others->Validate() && $Validation);
        $Validation = ($this->cr_payment->Validate() && $Validation);
        $Validation = ($this->cr_stp->Validate() && $Validation);
        $Validation = ($this->db_interest_charge->Validate() && $Validation);
        $Validation = ($this->db_increasing_charge->Validate() && $Validation);
        $Validation = ($this->t_customer_order_id->Validate() && $Validation);
        $Validation = ($this->p_finance_period_id->Validate() && $Validation);
        $Validation = ($this->total_penalty_amount->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->finance_period_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->order_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->total_trans_amount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->total_vat_amount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npwd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_vat_setllement_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rqst_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->year_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_year_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->jenis_pajak->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->start_period->Errors->Count() == 0);
        $Validation =  $Validation && ($this->end_period->Errors->Count() == 0);
        $Validation =  $Validation && ($this->due_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->debt_vat_amt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cr_adjustment->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cr_others->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cr_payment->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cr_stp->Errors->Count() == 0);
        $Validation =  $Validation && ($this->db_interest_charge->Errors->Count() == 0);
        $Validation =  $Validation && ($this->db_increasing_charge->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_order_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_finance_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->total_penalty_amount->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-94EAC1AB
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->finance_period_code->Errors->Count());
        $errors = ($errors || $this->order_no->Errors->Count());
        $errors = ($errors || $this->total_trans_amount->Errors->Count());
        $errors = ($errors || $this->total_vat_amount->Errors->Count());
        $errors = ($errors || $this->npwd->Errors->Count());
        $errors = ($errors || $this->t_vat_setllement_id->Errors->Count());
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
        $errors = ($errors || $this->p_rqst_type_id->Errors->Count());
        $errors = ($errors || $this->year_code->Errors->Count());
        $errors = ($errors || $this->p_year_period_id->Errors->Count());
        $errors = ($errors || $this->jenis_pajak->Errors->Count());
        $errors = ($errors || $this->wp_name->Errors->Count());
        $errors = ($errors || $this->wp_address_name->Errors->Count());
        $errors = ($errors || $this->start_period->Errors->Count());
        $errors = ($errors || $this->DatePicker_start_period->Errors->Count());
        $errors = ($errors || $this->end_period->Errors->Count());
        $errors = ($errors || $this->DatePicker_end_period->Errors->Count());
        $errors = ($errors || $this->due_date->Errors->Count());
        $errors = ($errors || $this->debt_vat_amt->Errors->Count());
        $errors = ($errors || $this->cr_adjustment->Errors->Count());
        $errors = ($errors || $this->cr_others->Errors->Count());
        $errors = ($errors || $this->cr_payment->Errors->Count());
        $errors = ($errors || $this->cr_stp->Errors->Count());
        $errors = ($errors || $this->db_interest_charge->Errors->Count());
        $errors = ($errors || $this->db_increasing_charge->Errors->Count());
        $errors = ($errors || $this->t_customer_order_id->Errors->Count());
        $errors = ($errors || $this->p_finance_period_id->Errors->Count());
        $errors = ($errors || $this->DatePicker_due_date->Errors->Count());
        $errors = ($errors || $this->total_penalty_amount->Errors->Count());
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

//Operation Method @23-1579D4B7
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

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
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_vat_setllement_id"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
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

//UpdateRow Method @23-27C4DA20
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_finance_period_id->SetValue($this->p_finance_period_id->GetValue(true));
        $this->DataSource->start_period->SetValue($this->start_period->GetValue(true));
        $this->DataSource->end_period->SetValue($this->end_period->GetValue(true));
        $this->DataSource->total_trans_amount->SetValue($this->total_trans_amount->GetValue(true));
        $this->DataSource->total_vat_amount->SetValue($this->total_vat_amount->GetValue(true));
        $this->DataSource->total_penalty_amount->SetValue($this->total_penalty_amount->GetValue(true));
        $this->DataSource->due_date->SetValue($this->due_date->GetValue(true));
        $this->DataSource->debt_vat_amt->SetValue($this->debt_vat_amt->GetValue(true));
        $this->DataSource->cr_adjustment->SetValue($this->cr_adjustment->GetValue(true));
        $this->DataSource->cr_payment->SetValue($this->cr_payment->GetValue(true));
        $this->DataSource->cr_others->SetValue($this->cr_others->GetValue(true));
        $this->DataSource->cr_stp->SetValue($this->cr_stp->GetValue(true));
        $this->DataSource->db_interest_charge->SetValue($this->db_interest_charge->GetValue(true));
        $this->DataSource->db_increasing_charge->SetValue($this->db_increasing_charge->GetValue(true));
        $this->DataSource->t_vat_setllement_id->SetValue($this->t_vat_setllement_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-7BF969AE
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_customer_order_id->SetValue($this->t_customer_order_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-562B0ADB
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
                    $this->finance_period_code->SetValue($this->DataSource->finance_period_code->GetValue());
                    $this->order_no->SetValue($this->DataSource->order_no->GetValue());
                    $this->total_trans_amount->SetValue($this->DataSource->total_trans_amount->GetValue());
                    $this->total_vat_amount->SetValue($this->DataSource->total_vat_amount->GetValue());
                    $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                    $this->t_vat_setllement_id->SetValue($this->DataSource->t_vat_setllement_id->GetValue());
                    $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                    $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                    $this->p_rqst_type_id->SetValue($this->DataSource->p_rqst_type_id->GetValue());
                    $this->year_code->SetValue($this->DataSource->year_code->GetValue());
                    $this->p_year_period_id->SetValue($this->DataSource->p_year_period_id->GetValue());
                    $this->jenis_pajak->SetValue($this->DataSource->jenis_pajak->GetValue());
                    $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                    $this->wp_address_name->SetValue($this->DataSource->wp_address_name->GetValue());
                    $this->start_period->SetValue($this->DataSource->start_period->GetValue());
                    $this->end_period->SetValue($this->DataSource->end_period->GetValue());
                    $this->due_date->SetValue($this->DataSource->due_date->GetValue());
                    $this->debt_vat_amt->SetValue($this->DataSource->debt_vat_amt->GetValue());
                    $this->cr_adjustment->SetValue($this->DataSource->cr_adjustment->GetValue());
                    $this->cr_others->SetValue($this->DataSource->cr_others->GetValue());
                    $this->cr_payment->SetValue($this->DataSource->cr_payment->GetValue());
                    $this->cr_stp->SetValue($this->DataSource->cr_stp->GetValue());
                    $this->db_interest_charge->SetValue($this->DataSource->db_interest_charge->GetValue());
                    $this->db_increasing_charge->SetValue($this->DataSource->db_increasing_charge->GetValue());
                    $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                    $this->p_finance_period_id->SetValue($this->DataSource->p_finance_period_id->GetValue());
                    $this->total_penalty_amount->SetValue($this->DataSource->total_penalty_amount->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->finance_period_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->order_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->total_trans_amount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->total_vat_amount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npwd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_vat_setllement_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rqst_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->year_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_year_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->jenis_pajak->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->start_period->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_start_period->Errors->ToString());
            $Error = ComposeStrings($Error, $this->end_period->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_end_period->Errors->ToString());
            $Error = ComposeStrings($Error, $this->due_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->debt_vat_amt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cr_adjustment->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cr_others->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cr_payment->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cr_stp->Errors->ToString());
            $Error = ComposeStrings($Error, $this->db_interest_charge->Errors->ToString());
            $Error = ComposeStrings($Error, $this->db_increasing_charge->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_order_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_finance_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_due_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->total_penalty_amount->Errors->ToString());
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
        $this->finance_period_code->Show();
        $this->order_no->Show();
        $this->total_trans_amount->Show();
        $this->total_vat_amount->Show();
        $this->npwd->Show();
        $this->t_vat_setllement_id->Show();
        $this->t_cust_account_id->Show();
        $this->p_vat_type_id->Show();
        $this->p_rqst_type_id->Show();
        $this->year_code->Show();
        $this->p_year_period_id->Show();
        $this->jenis_pajak->Show();
        $this->wp_name->Show();
        $this->wp_address_name->Show();
        $this->start_period->Show();
        $this->DatePicker_start_period->Show();
        $this->end_period->Show();
        $this->DatePicker_end_period->Show();
        $this->due_date->Show();
        $this->debt_vat_amt->Show();
        $this->cr_adjustment->Show();
        $this->cr_others->Show();
        $this->cr_payment->Show();
        $this->cr_stp->Show();
        $this->db_interest_charge->Show();
        $this->db_increasing_charge->Show();
        $this->t_customer_order_id->Show();
        $this->p_finance_period_id->Show();
        $this->DatePicker_due_date->Show();
        $this->total_penalty_amount->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_vat_setllementForm Class @23-FCB6E20C

class clst_vat_setllementFormDataSource extends clsDBConnSIKP {  //t_vat_setllementFormDataSource Class @23-AF9958CC

//DataSource Variables @23-FD911D63
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $finance_period_code;
    var $order_no;
    var $total_trans_amount;
    var $total_vat_amount;
    var $npwd;
    var $t_vat_setllement_id;
    var $t_cust_account_id;
    var $p_vat_type_id;
    var $p_rqst_type_id;
    var $year_code;
    var $p_year_period_id;
    var $jenis_pajak;
    var $wp_name;
    var $wp_address_name;
    var $start_period;
    var $end_period;
    var $due_date;
    var $debt_vat_amt;
    var $cr_adjustment;
    var $cr_others;
    var $cr_payment;
    var $cr_stp;
    var $db_interest_charge;
    var $db_increasing_charge;
    var $t_customer_order_id;
    var $p_finance_period_id;
    var $total_penalty_amount;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-D2FFD726
    function clst_vat_setllementFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_vat_setllementForm/Error";
        $this->Initialize();
        $this->finance_period_code = new clsField("finance_period_code", ccsText, "");
        
        $this->order_no = new clsField("order_no", ccsText, "");
        
        $this->total_trans_amount = new clsField("total_trans_amount", ccsFloat, "");
        
        $this->total_vat_amount = new clsField("total_vat_amount", ccsFloat, "");
        
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsFloat, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsText, "");
        
        $this->p_rqst_type_id = new clsField("p_rqst_type_id", ccsFloat, "");
        
        $this->year_code = new clsField("year_code", ccsText, "");
        
        $this->p_year_period_id = new clsField("p_year_period_id", ccsFloat, "");
        
        $this->jenis_pajak = new clsField("jenis_pajak", ccsText, "");
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->wp_address_name = new clsField("wp_address_name", ccsText, "");
        
        $this->start_period = new clsField("start_period", ccsText, "");
        
        $this->end_period = new clsField("end_period", ccsText, "");
        
        $this->due_date = new clsField("due_date", ccsText, "");
        
        $this->debt_vat_amt = new clsField("debt_vat_amt", ccsFloat, "");
        
        $this->cr_adjustment = new clsField("cr_adjustment", ccsFloat, "");
        
        $this->cr_others = new clsField("cr_others", ccsFloat, "");
        
        $this->cr_payment = new clsField("cr_payment", ccsFloat, "");
        
        $this->cr_stp = new clsField("cr_stp", ccsFloat, "");
        
        $this->db_interest_charge = new clsField("db_interest_charge", ccsFloat, "");
        
        $this->db_increasing_charge = new clsField("db_increasing_charge", ccsFloat, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsFloat, "");
        
        $this->p_finance_period_id = new clsField("p_finance_period_id", ccsFloat, "");
        
        $this->total_penalty_amount = new clsField("total_penalty_amount", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-1736D257
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_setllement_id", ccsFloat, "", "", $this->Parameters["urlt_vat_setllement_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_vat_setllement_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @23-ACB07381
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM v_vat_setllement {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-868B54AD
    function SetValues()
    {
        $this->finance_period_code->SetDBValue($this->f("finance_period_code"));
        $this->order_no->SetDBValue($this->f("order_no"));
        $this->total_trans_amount->SetDBValue(trim($this->f("total_trans_amount")));
        $this->total_vat_amount->SetDBValue(trim($this->f("total_vat_amount")));
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->t_vat_setllement_id->SetDBValue(trim($this->f("t_vat_setllement_id")));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->p_vat_type_id->SetDBValue($this->f("p_vat_type_id"));
        $this->p_rqst_type_id->SetDBValue(trim($this->f("p_rqst_type_id")));
        $this->year_code->SetDBValue($this->f("year_code"));
        $this->p_year_period_id->SetDBValue(trim($this->f("p_year_period_id")));
        $this->jenis_pajak->SetDBValue($this->f("jenis_pajak"));
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->wp_address_name->SetDBValue($this->f("wp_address_name"));
        $this->start_period->SetDBValue($this->f("start_period"));
        $this->end_period->SetDBValue($this->f("end_period"));
        $this->due_date->SetDBValue($this->f("due_date"));
        $this->debt_vat_amt->SetDBValue(trim($this->f("debt_vat_amt")));
        $this->cr_adjustment->SetDBValue(trim($this->f("cr_adjustment")));
        $this->cr_others->SetDBValue(trim($this->f("cr_others")));
        $this->cr_payment->SetDBValue(trim($this->f("cr_payment")));
        $this->cr_stp->SetDBValue(trim($this->f("cr_stp")));
        $this->db_interest_charge->SetDBValue(trim($this->f("db_interest_charge")));
        $this->db_increasing_charge->SetDBValue(trim($this->f("db_increasing_charge")));
        $this->t_customer_order_id->SetDBValue(trim($this->f("t_customer_order_id")));
        $this->p_finance_period_id->SetDBValue(trim($this->f("p_finance_period_id")));
        $this->total_penalty_amount->SetDBValue(trim($this->f("total_penalty_amount")));
    }
//End SetValues Method

//Update Method @23-B40184C8
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["o_result_msg"] = new clsSQLParameter("urlo_result_msg", ccsText, "", "", CCGetFromGet("o_result_msg", NULL), "", false, $this->ErrorBlock);
        $this->cp["i_finance_period_id"] = new clsSQLParameter("ctrlp_finance_period_id", ccsFloat, "", "", $this->p_finance_period_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_start_period"] = new clsSQLParameter("ctrlstart_period", ccsText, "", "", $this->start_period->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_end_period"] = new clsSQLParameter("ctrlend_period", ccsText, "", "", $this->end_period->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_total_trans_amount"] = new clsSQLParameter("ctrltotal_trans_amount", ccsFloat, "", "", $this->total_trans_amount->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_total_vat_amount"] = new clsSQLParameter("ctrltotal_vat_amount", ccsFloat, "", "", $this->total_vat_amount->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_total_penalty_amount"] = new clsSQLParameter("ctrltotal_penalty_amount", ccsFloat, "", "", $this->total_penalty_amount->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_due_date"] = new clsSQLParameter("ctrldue_date", ccsText, "", "", $this->due_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_debt_vat_amt"] = new clsSQLParameter("ctrldebt_vat_amt", ccsFloat, "", "", $this->debt_vat_amt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_cr_adjustment"] = new clsSQLParameter("ctrlcr_adjustment", ccsFloat, "", "", $this->cr_adjustment->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_cr_payment"] = new clsSQLParameter("ctrlcr_payment", ccsFloat, "", "", $this->cr_payment->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_cr_others"] = new clsSQLParameter("ctrlcr_others", ccsFloat, "", "", $this->cr_others->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_cr_stp"] = new clsSQLParameter("ctrlcr_stp", ccsFloat, "", "", $this->cr_stp->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_db_interest_charge"] = new clsSQLParameter("ctrldb_interest_charge", ccsFloat, "", "", $this->db_interest_charge->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_db_increasing_charge"] = new clsSQLParameter("ctrldb_increasing_charge", ccsFloat, "", "", $this->db_increasing_charge->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_vat_setllement_id"] = new clsSQLParameter("ctrlt_vat_setllement_id", ccsFloat, "", "", $this->t_vat_setllement_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_user"] = new clsSQLParameter("exprKey390", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["i_status"] = new clsSQLParameter("exprKey391", ccsText, "", "", '1', "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["o_result_msg"]->GetValue()) and !strlen($this->cp["o_result_msg"]->GetText()) and !is_bool($this->cp["o_result_msg"]->GetValue())) 
            $this->cp["o_result_msg"]->SetText(CCGetFromGet("o_result_msg", NULL));
        if (!is_null($this->cp["i_finance_period_id"]->GetValue()) and !strlen($this->cp["i_finance_period_id"]->GetText()) and !is_bool($this->cp["i_finance_period_id"]->GetValue())) 
            $this->cp["i_finance_period_id"]->SetValue($this->p_finance_period_id->GetValue(true));
        if (!is_null($this->cp["i_start_period"]->GetValue()) and !strlen($this->cp["i_start_period"]->GetText()) and !is_bool($this->cp["i_start_period"]->GetValue())) 
            $this->cp["i_start_period"]->SetValue($this->start_period->GetValue(true));
        if (!is_null($this->cp["i_end_period"]->GetValue()) and !strlen($this->cp["i_end_period"]->GetText()) and !is_bool($this->cp["i_end_period"]->GetValue())) 
            $this->cp["i_end_period"]->SetValue($this->end_period->GetValue(true));
        if (!is_null($this->cp["i_total_trans_amount"]->GetValue()) and !strlen($this->cp["i_total_trans_amount"]->GetText()) and !is_bool($this->cp["i_total_trans_amount"]->GetValue())) 
            $this->cp["i_total_trans_amount"]->SetValue($this->total_trans_amount->GetValue(true));
        if (!is_null($this->cp["i_total_vat_amount"]->GetValue()) and !strlen($this->cp["i_total_vat_amount"]->GetText()) and !is_bool($this->cp["i_total_vat_amount"]->GetValue())) 
            $this->cp["i_total_vat_amount"]->SetValue($this->total_vat_amount->GetValue(true));
        if (!is_null($this->cp["i_total_penalty_amount"]->GetValue()) and !strlen($this->cp["i_total_penalty_amount"]->GetText()) and !is_bool($this->cp["i_total_penalty_amount"]->GetValue())) 
            $this->cp["i_total_penalty_amount"]->SetValue($this->total_penalty_amount->GetValue(true));
        if (!is_null($this->cp["i_due_date"]->GetValue()) and !strlen($this->cp["i_due_date"]->GetText()) and !is_bool($this->cp["i_due_date"]->GetValue())) 
            $this->cp["i_due_date"]->SetValue($this->due_date->GetValue(true));
        if (!is_null($this->cp["i_debt_vat_amt"]->GetValue()) and !strlen($this->cp["i_debt_vat_amt"]->GetText()) and !is_bool($this->cp["i_debt_vat_amt"]->GetValue())) 
            $this->cp["i_debt_vat_amt"]->SetValue($this->debt_vat_amt->GetValue(true));
        if (!is_null($this->cp["i_cr_adjustment"]->GetValue()) and !strlen($this->cp["i_cr_adjustment"]->GetText()) and !is_bool($this->cp["i_cr_adjustment"]->GetValue())) 
            $this->cp["i_cr_adjustment"]->SetValue($this->cr_adjustment->GetValue(true));
        if (!is_null($this->cp["i_cr_payment"]->GetValue()) and !strlen($this->cp["i_cr_payment"]->GetText()) and !is_bool($this->cp["i_cr_payment"]->GetValue())) 
            $this->cp["i_cr_payment"]->SetValue($this->cr_payment->GetValue(true));
        if (!is_null($this->cp["i_cr_others"]->GetValue()) and !strlen($this->cp["i_cr_others"]->GetText()) and !is_bool($this->cp["i_cr_others"]->GetValue())) 
            $this->cp["i_cr_others"]->SetValue($this->cr_others->GetValue(true));
        if (!is_null($this->cp["i_cr_stp"]->GetValue()) and !strlen($this->cp["i_cr_stp"]->GetText()) and !is_bool($this->cp["i_cr_stp"]->GetValue())) 
            $this->cp["i_cr_stp"]->SetValue($this->cr_stp->GetValue(true));
        if (!is_null($this->cp["i_db_interest_charge"]->GetValue()) and !strlen($this->cp["i_db_interest_charge"]->GetText()) and !is_bool($this->cp["i_db_interest_charge"]->GetValue())) 
            $this->cp["i_db_interest_charge"]->SetValue($this->db_interest_charge->GetValue(true));
        if (!is_null($this->cp["i_db_increasing_charge"]->GetValue()) and !strlen($this->cp["i_db_increasing_charge"]->GetText()) and !is_bool($this->cp["i_db_increasing_charge"]->GetValue())) 
            $this->cp["i_db_increasing_charge"]->SetValue($this->db_increasing_charge->GetValue(true));
        if (!is_null($this->cp["i_vat_setllement_id"]->GetValue()) and !strlen($this->cp["i_vat_setllement_id"]->GetText()) and !is_bool($this->cp["i_vat_setllement_id"]->GetValue())) 
            $this->cp["i_vat_setllement_id"]->SetValue($this->t_vat_setllement_id->GetValue(true));
        if (!is_null($this->cp["i_user"]->GetValue()) and !strlen($this->cp["i_user"]->GetText()) and !is_bool($this->cp["i_user"]->GetValue())) 
            $this->cp["i_user"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["i_status"]->GetValue()) and !strlen($this->cp["i_status"]->GetText()) and !is_bool($this->cp["i_status"]->GetValue())) 
            $this->cp["i_status"]->SetValue('1');
        $this->SQL = "SELECT f_crud_setllement_update (" . $this->ToSQL($this->cp["i_finance_period_id"]->GetDBValue(), $this->cp["i_finance_period_id"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_start_period"]->GetDBValue(), $this->cp["i_start_period"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_end_period"]->GetDBValue(), $this->cp["i_end_period"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_total_trans_amount"]->GetDBValue(), $this->cp["i_total_trans_amount"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_total_vat_amount"]->GetDBValue(), $this->cp["i_total_vat_amount"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_total_penalty_amount"]->GetDBValue(), $this->cp["i_total_penalty_amount"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_due_date"]->GetDBValue(), $this->cp["i_due_date"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_debt_vat_amt"]->GetDBValue(), $this->cp["i_debt_vat_amt"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_cr_adjustment"]->GetDBValue(), $this->cp["i_cr_adjustment"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_cr_payment"]->GetDBValue(), $this->cp["i_cr_payment"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_cr_others"]->GetDBValue(), $this->cp["i_cr_others"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_cr_stp"]->GetDBValue(), $this->cp["i_cr_stp"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_db_interest_charge"]->GetDBValue(), $this->cp["i_db_interest_charge"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_db_increasing_charge"]->GetDBValue(), $this->cp["i_db_increasing_charge"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_vat_setllement_id"]->GetDBValue(), $this->cp["i_vat_setllement_id"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_user"]->GetDBValue(), $this->cp["i_user"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_status"]->GetDBValue(), $this->cp["i_status"]->DataType) . ");";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-1F6E5C2C
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_customer_order_id"] = new clsSQLParameter("ctrlt_customer_order_id", ccsFloat, "", "", $this->t_customer_order_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["UserName"] = new clsSQLParameter("expr343", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_customer_order_id"]->GetValue()) and !strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue())) 
            $this->cp["t_customer_order_id"]->SetValue($this->t_customer_order_id->GetValue(true));
        if (!strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue(true))) 
            $this->cp["t_customer_order_id"]->SetText(0);
        if (!is_null($this->cp["UserName"]->GetValue()) and !strlen($this->cp["UserName"]->GetText()) and !is_bool($this->cp["UserName"]->GetValue())) 
            $this->cp["UserName"]->SetValue(CCGetUserLogin());
        $this->SQL = "select o_result_code, o_result_msg from f_first_submit_engine(501," . $this->SQLValue($this->cp["t_customer_order_id"]->GetDBValue(), ccsFloat) . ",'" . $this->SQLValue($this->cp["UserName"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_vat_setllementFormDataSource Class @23-FCB6E20C

class clsRecordt_vat_setllementSearch { //t_vat_setllementSearch Class @3-56E11780

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

//Class_Initialize Event @3-D84A44C2
    function clsRecordt_vat_setllementSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_vat_setllementSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_vat_setllementSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_keyword = & new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-A144A629
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-D6729123
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
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

//Operation Method @3-9CCF4F6F
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
        $Redirect = "t_vat_setllement_edit.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_vat_setllement_edit.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-7913FA87
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
            $Error = ComposeStrings($Error, $this->s_keyword->Errors->ToString());
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

        $this->s_keyword->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_vat_setllementSearch Class @3-FCB6E20C

//Initialize Page @1-F0ECA235
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
$TemplateFileName = "t_vat_setllement_edit.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-79AA5620
include_once("./t_vat_setllement_edit_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-14E68814
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_vat_setllementGrid = & new clsGridt_vat_setllementGrid("", $MainPage);
$t_vat_setllementForm = & new clsRecordt_vat_setllementForm("", $MainPage);
$t_vat_setllementSearch = & new clsRecordt_vat_setllementSearch("", $MainPage);
$MainPage->t_vat_setllementGrid = & $t_vat_setllementGrid;
$MainPage->t_vat_setllementForm = & $t_vat_setllementForm;
$MainPage->t_vat_setllementSearch = & $t_vat_setllementSearch;
$t_vat_setllementGrid->Initialize();
$t_vat_setllementForm->Initialize();

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

//Execute Components @1-9F20D4A1
$t_vat_setllementForm->Operation();
$t_vat_setllementSearch->Operation();
//End Execute Components

//Go to destination page @1-B96B3335
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_vat_setllementGrid);
    unset($t_vat_setllementForm);
    unset($t_vat_setllementSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-82B07B1E
$t_vat_setllementGrid->Show();
$t_vat_setllementForm->Show();
$t_vat_setllementSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-33B98A02
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_vat_setllementGrid);
unset($t_vat_setllementForm);
unset($t_vat_setllementSearch);
unset($Tpl);
//End Unload Page


?>
