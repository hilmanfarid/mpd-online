<?php
//Include Common Files @1-8D77183D
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_setllement_ro_new.php");
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

//Class_Initialize Event @2-90EE1D16
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
            $this->PageSize = 15;
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
        $this->DLink->Page = "t_vat_setllement_ro_new.php";
        $this->npwd = & new clsControl(ccsLabel, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", ccsGet, NULL), $this);
        $this->finance_period_code = & new clsControl(ccsLabel, "finance_period_code", "finance_period_code", ccsText, "", CCGetRequestParam("finance_period_code", ccsGet, NULL), $this);
        $this->order_no = & new clsControl(ccsLabel, "order_no", "order_no", ccsText, "", CCGetRequestParam("order_no", ccsGet, NULL), $this);
        $this->t_vat_setllement_id = & new clsControl(ccsHidden, "t_vat_setllement_id", "t_vat_setllement_id", ccsFloat, "", CCGetRequestParam("t_vat_setllement_id", ccsGet, NULL), $this);
        $this->total_trans_amount = & new clsControl(ccsLabel, "total_trans_amount", "total_trans_amount", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("total_trans_amount", ccsGet, NULL), $this);
        $this->p_rqst_type_id = & new clsControl(ccsHidden, "p_rqst_type_id", "p_rqst_type_id", ccsFloat, "", CCGetRequestParam("p_rqst_type_id", ccsGet, NULL), $this);
        $this->total_vat_amount = & new clsControl(ccsLabel, "total_vat_amount", "total_vat_amount", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("total_vat_amount", ccsGet, NULL), $this);
        $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsFloat, "", CCGetRequestParam("p_vat_type_id", ccsGet, NULL), $this);
        $this->cetak = & new clsControl(ccsLabel, "cetak", "cetak", ccsText, "", CCGetRequestParam("cetak", ccsGet, NULL), $this);
        $this->cetak->HTML = true;
        $this->no_kohir = & new clsControl(ccsLabel, "no_kohir", "no_kohir", ccsText, "", CCGetRequestParam("no_kohir", ccsGet, NULL), $this);
        $this->wp_name = & new clsControl(ccsLabel, "wp_name", "wp_name", ccsText, "", CCGetRequestParam("wp_name", ccsGet, NULL), $this);
        $this->cetak_payment = & new clsButton("cetak_payment", ccsGet, $this);
        $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsInteger, "", CCGetRequestParam("t_customer_order_id", ccsGet, NULL), $this);
        $this->total_penalty_amount = & new clsControl(ccsLabel, "total_penalty_amount", "total_penalty_amount", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("total_penalty_amount", ccsGet, NULL), $this);
        $this->cetak_register = & new clsButton("cetak_register", ccsGet, $this);
        $this->cetak_sptpd = & new clsControl(ccsLabel, "cetak_sptpd", "cetak_sptpd", ccsText, "", CCGetRequestParam("cetak_sptpd", ccsGet, NULL), $this);
        $this->cetak_sptpd->HTML = true;
        $this->BtnUbahDenda = & new clsButton("BtnUbahDenda", ccsGet, $this);
        $this->Button1 = & new clsButton("Button1", ccsGet, $this);
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

//Show Method @2-70513BAD
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;


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
            $this->ControlsVisible["npwd"] = $this->npwd->Visible;
            $this->ControlsVisible["finance_period_code"] = $this->finance_period_code->Visible;
            $this->ControlsVisible["order_no"] = $this->order_no->Visible;
            $this->ControlsVisible["t_vat_setllement_id"] = $this->t_vat_setllement_id->Visible;
            $this->ControlsVisible["total_trans_amount"] = $this->total_trans_amount->Visible;
            $this->ControlsVisible["p_rqst_type_id"] = $this->p_rqst_type_id->Visible;
            $this->ControlsVisible["total_vat_amount"] = $this->total_vat_amount->Visible;
            $this->ControlsVisible["p_vat_type_id"] = $this->p_vat_type_id->Visible;
            $this->ControlsVisible["cetak"] = $this->cetak->Visible;
            $this->ControlsVisible["no_kohir"] = $this->no_kohir->Visible;
            $this->ControlsVisible["wp_name"] = $this->wp_name->Visible;
            $this->ControlsVisible["cetak_payment"] = $this->cetak_payment->Visible;
            $this->ControlsVisible["t_customer_order_id"] = $this->t_customer_order_id->Visible;
            $this->ControlsVisible["total_penalty_amount"] = $this->total_penalty_amount->Visible;
            $this->ControlsVisible["cetak_register"] = $this->cetak_register->Visible;
            $this->ControlsVisible["cetak_sptpd"] = $this->cetak_sptpd->Visible;
            $this->ControlsVisible["BtnUbahDenda"] = $this->BtnUbahDenda->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_vat_setllement_id", $this->DataSource->f("t_vat_setllement_id"));
                $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                $this->finance_period_code->SetValue($this->DataSource->finance_period_code->GetValue());
                $this->order_no->SetValue($this->DataSource->order_no->GetValue());
                $this->t_vat_setllement_id->SetValue($this->DataSource->t_vat_setllement_id->GetValue());
                $this->total_trans_amount->SetValue($this->DataSource->total_trans_amount->GetValue());
                $this->p_rqst_type_id->SetValue($this->DataSource->p_rqst_type_id->GetValue());
                $this->total_vat_amount->SetValue($this->DataSource->total_vat_amount->GetValue());
                $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                $this->no_kohir->SetValue($this->DataSource->no_kohir->GetValue());
                $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                $this->total_penalty_amount->SetValue($this->DataSource->total_penalty_amount->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->npwd->Show();
                $this->finance_period_code->Show();
                $this->order_no->Show();
                $this->t_vat_setllement_id->Show();
                $this->total_trans_amount->Show();
                $this->p_rqst_type_id->Show();
                $this->total_vat_amount->Show();
                $this->p_vat_type_id->Show();
                $this->cetak->Show();
                $this->no_kohir->Show();
                $this->wp_name->Show();
                $this->cetak_payment->Show();
                $this->t_customer_order_id->Show();
                $this->total_penalty_amount->Show();
                $this->cetak_register->Show();
                $this->cetak_sptpd->Show();
                $this->BtnUbahDenda->Show();
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
        $this->Button1->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-1761AAA7
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->npwd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->finance_period_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->order_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_setllement_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_trans_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_rqst_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_vat_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_vat_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cetak->Errors->ToString());
        $errors = ComposeStrings($errors, $this->no_kohir->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wp_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_customer_order_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_penalty_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cetak_sptpd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_setllementGrid Class @2-FCB6E20C

class clst_vat_setllementGridDataSource extends clsDBConnSIKP {  //t_vat_setllementGridDataSource Class @2-F0AECE38

//DataSource Variables @2-DD4850F9
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $npwd;
    var $finance_period_code;
    var $order_no;
    var $t_vat_setllement_id;
    var $total_trans_amount;
    var $p_rqst_type_id;
    var $total_vat_amount;
    var $p_vat_type_id;
    var $no_kohir;
    var $wp_name;
    var $t_customer_order_id;
    var $total_penalty_amount;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-BDCBEB97
    function clst_vat_setllementGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_setllementGrid";
        $this->Initialize();
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->finance_period_code = new clsField("finance_period_code", ccsText, "");
        
        $this->order_no = new clsField("order_no", ccsText, "");
        
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsFloat, "");
        
        $this->total_trans_amount = new clsField("total_trans_amount", ccsFloat, "");
        
        $this->p_rqst_type_id = new clsField("p_rqst_type_id", ccsFloat, "");
        
        $this->total_vat_amount = new clsField("total_vat_amount", ccsFloat, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsFloat, "");
        
        $this->no_kohir = new clsField("no_kohir", ccsText, "");
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsInteger, "");
        
        $this->total_penalty_amount = new clsField("total_penalty_amount", ccsFloat, "");
        

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

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-FE02C76C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.no_kohir,d.wp_name, a.t_vat_setllement_id, a.t_customer_order_id, a.total_penalty_amount, \n" .
        "a.settlement_date, a.p_finance_period_id, \n" .
        "a.t_cust_account_id, a.npwd, a.total_trans_amount,\n" .
        "a.total_vat_amount, b.code as finance_period_code, c.order_no, c.p_rqst_type_id, e.code as rqst_type_code, d.p_vat_type_id\n" .
        "FROM t_vat_setllement a, p_finance_period b, t_customer_order c, t_cust_account d, p_rqst_type e\n" .
        "WHERE a.p_finance_period_id = b.p_finance_period_id AND\n" .
        "a.t_customer_order_id = c.t_customer_order_id AND\n" .
        "a.t_cust_account_id = d.t_cust_account_id AND\n" .
        "c.p_rqst_type_id = e.p_rqst_type_id AND\n" .
        "a.is_settled = 'Y') cnt";
        $this->SQL = "SELECT a.no_kohir,d.wp_name, a.t_vat_setllement_id, a.t_customer_order_id, a.total_penalty_amount, \n" .
        "a.settlement_date, a.p_finance_period_id, \n" .
        "a.t_cust_account_id, a.npwd, a.total_trans_amount,\n" .
        "a.total_vat_amount, b.code as finance_period_code, c.order_no, c.p_rqst_type_id, e.code as rqst_type_code, d.p_vat_type_id\n" .
        "FROM t_vat_setllement a, p_finance_period b, t_customer_order c, t_cust_account d, p_rqst_type e\n" .
        "WHERE a.p_finance_period_id = b.p_finance_period_id AND\n" .
        "a.t_customer_order_id = c.t_customer_order_id AND\n" .
        "a.t_cust_account_id = d.t_cust_account_id AND\n" .
        "c.p_rqst_type_id = e.p_rqst_type_id AND\n" .
        "a.is_settled = 'Y'";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-063E86C3
    function SetValues()
    {
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->finance_period_code->SetDBValue($this->f("finance_period_code"));
        $this->order_no->SetDBValue($this->f("order_no"));
        $this->t_vat_setllement_id->SetDBValue(trim($this->f("t_vat_setllement_id")));
        $this->total_trans_amount->SetDBValue(trim($this->f("total_trans_amount")));
        $this->p_rqst_type_id->SetDBValue(trim($this->f("p_rqst_type_id")));
        $this->total_vat_amount->SetDBValue(trim($this->f("total_vat_amount")));
        $this->p_vat_type_id->SetDBValue(trim($this->f("p_vat_type_id")));
        $this->no_kohir->SetDBValue($this->f("no_kohir"));
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->t_customer_order_id->SetDBValue(trim($this->f("t_customer_order_id")));
        $this->total_penalty_amount->SetDBValue(trim($this->f("total_penalty_amount")));
    }
//End SetValues Method

} //End t_vat_setllementGridDataSource Class @2-FCB6E20C

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

//Class_Initialize Event @3-233DCD3A
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
            $this->TAKEN_CTL = & new clsControl(ccsHidden, "TAKEN_CTL", "TAKEN_CTL", ccsText, "", CCGetRequestParam("TAKEN_CTL", $Method, NULL), $this);
            $this->IS_TAKEN = & new clsControl(ccsHidden, "IS_TAKEN", "IS_TAKEN", ccsText, "", CCGetRequestParam("IS_TAKEN", $Method, NULL), $this);
            $this->CURR_DOC_ID = & new clsControl(ccsHidden, "CURR_DOC_ID", "CURR_DOC_ID", ccsText, "", CCGetRequestParam("CURR_DOC_ID", $Method, NULL), $this);
            $this->CURR_DOC_TYPE_ID = & new clsControl(ccsHidden, "CURR_DOC_TYPE_ID", "CURR_DOC_TYPE_ID", ccsText, "", CCGetRequestParam("CURR_DOC_TYPE_ID", $Method, NULL), $this);
            $this->CURR_PROC_ID = & new clsControl(ccsHidden, "CURR_PROC_ID", "CURR_PROC_ID", ccsText, "", CCGetRequestParam("CURR_PROC_ID", $Method, NULL), $this);
            $this->CURR_CTL_ID = & new clsControl(ccsHidden, "CURR_CTL_ID", "CURR_CTL_ID", ccsText, "", CCGetRequestParam("CURR_CTL_ID", $Method, NULL), $this);
            $this->USER_ID_DOC = & new clsControl(ccsHidden, "USER_ID_DOC", "USER_ID_DOC", ccsText, "", CCGetRequestParam("USER_ID_DOC", $Method, NULL), $this);
            $this->USER_ID_DONOR = & new clsControl(ccsHidden, "USER_ID_DONOR", "USER_ID_DONOR", ccsText, "", CCGetRequestParam("USER_ID_DONOR", $Method, NULL), $this);
            $this->USER_ID_LOGIN = & new clsControl(ccsHidden, "USER_ID_LOGIN", "USER_ID_LOGIN", ccsText, "", CCGetRequestParam("USER_ID_LOGIN", $Method, NULL), $this);
            $this->USER_ID_TAKEN = & new clsControl(ccsHidden, "USER_ID_TAKEN", "USER_ID_TAKEN", ccsText, "", CCGetRequestParam("USER_ID_TAKEN", $Method, NULL), $this);
            $this->IS_CREATE_DOC = & new clsControl(ccsHidden, "IS_CREATE_DOC", "IS_CREATE_DOC", ccsText, "", CCGetRequestParam("IS_CREATE_DOC", $Method, NULL), $this);
            $this->IS_MANUAL = & new clsControl(ccsHidden, "IS_MANUAL", "IS_MANUAL", ccsText, "", CCGetRequestParam("IS_MANUAL", $Method, NULL), $this);
            $this->CURR_PROC_STATUS = & new clsControl(ccsHidden, "CURR_PROC_STATUS", "CURR_PROC_STATUS", ccsText, "", CCGetRequestParam("CURR_PROC_STATUS", $Method, NULL), $this);
            $this->CURR_DOC_STATUS = & new clsControl(ccsHidden, "CURR_DOC_STATUS", "CURR_DOC_STATUS", ccsText, "", CCGetRequestParam("CURR_DOC_STATUS", $Method, NULL), $this);
            $this->PREV_DOC_ID = & new clsControl(ccsHidden, "PREV_DOC_ID", "PREV_DOC_ID", ccsText, "", CCGetRequestParam("PREV_DOC_ID", $Method, NULL), $this);
            $this->PREV_DOC_TYPE_ID = & new clsControl(ccsHidden, "PREV_DOC_TYPE_ID", "PREV_DOC_TYPE_ID", ccsText, "", CCGetRequestParam("PREV_DOC_TYPE_ID", $Method, NULL), $this);
            $this->PREV_PROC_ID = & new clsControl(ccsHidden, "PREV_PROC_ID", "PREV_PROC_ID", ccsText, "", CCGetRequestParam("PREV_PROC_ID", $Method, NULL), $this);
            $this->PREV_CTL_ID = & new clsControl(ccsHidden, "PREV_CTL_ID", "PREV_CTL_ID", ccsText, "", CCGetRequestParam("PREV_CTL_ID", $Method, NULL), $this);
            $this->SLOT_1 = & new clsControl(ccsHidden, "SLOT_1", "SLOT_1", ccsText, "", CCGetRequestParam("SLOT_1", $Method, NULL), $this);
            $this->SLOT_2 = & new clsControl(ccsHidden, "SLOT_2", "SLOT_2", ccsText, "", CCGetRequestParam("SLOT_2", $Method, NULL), $this);
            $this->SLOT_3 = & new clsControl(ccsHidden, "SLOT_3", "SLOT_3", ccsText, "", CCGetRequestParam("SLOT_3", $Method, NULL), $this);
            $this->SLOT_4 = & new clsControl(ccsHidden, "SLOT_4", "SLOT_4", ccsText, "", CCGetRequestParam("SLOT_4", $Method, NULL), $this);
            $this->SLOT_5 = & new clsControl(ccsHidden, "SLOT_5", "SLOT_5", ccsText, "", CCGetRequestParam("SLOT_5", $Method, NULL), $this);
            $this->MESSAGE = & new clsControl(ccsHidden, "MESSAGE", "MESSAGE", ccsText, "", CCGetRequestParam("MESSAGE", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-6E518196
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->TAKEN_CTL->Validate() && $Validation);
        $Validation = ($this->IS_TAKEN->Validate() && $Validation);
        $Validation = ($this->CURR_DOC_ID->Validate() && $Validation);
        $Validation = ($this->CURR_DOC_TYPE_ID->Validate() && $Validation);
        $Validation = ($this->CURR_PROC_ID->Validate() && $Validation);
        $Validation = ($this->CURR_CTL_ID->Validate() && $Validation);
        $Validation = ($this->USER_ID_DOC->Validate() && $Validation);
        $Validation = ($this->USER_ID_DONOR->Validate() && $Validation);
        $Validation = ($this->USER_ID_LOGIN->Validate() && $Validation);
        $Validation = ($this->USER_ID_TAKEN->Validate() && $Validation);
        $Validation = ($this->IS_CREATE_DOC->Validate() && $Validation);
        $Validation = ($this->IS_MANUAL->Validate() && $Validation);
        $Validation = ($this->CURR_PROC_STATUS->Validate() && $Validation);
        $Validation = ($this->CURR_DOC_STATUS->Validate() && $Validation);
        $Validation = ($this->PREV_DOC_ID->Validate() && $Validation);
        $Validation = ($this->PREV_DOC_TYPE_ID->Validate() && $Validation);
        $Validation = ($this->PREV_PROC_ID->Validate() && $Validation);
        $Validation = ($this->PREV_CTL_ID->Validate() && $Validation);
        $Validation = ($this->SLOT_1->Validate() && $Validation);
        $Validation = ($this->SLOT_2->Validate() && $Validation);
        $Validation = ($this->SLOT_3->Validate() && $Validation);
        $Validation = ($this->SLOT_4->Validate() && $Validation);
        $Validation = ($this->SLOT_5->Validate() && $Validation);
        $Validation = ($this->MESSAGE->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->TAKEN_CTL->Errors->Count() == 0);
        $Validation =  $Validation && ($this->IS_TAKEN->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_DOC_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_DOC_TYPE_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_PROC_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_CTL_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->USER_ID_DOC->Errors->Count() == 0);
        $Validation =  $Validation && ($this->USER_ID_DONOR->Errors->Count() == 0);
        $Validation =  $Validation && ($this->USER_ID_LOGIN->Errors->Count() == 0);
        $Validation =  $Validation && ($this->USER_ID_TAKEN->Errors->Count() == 0);
        $Validation =  $Validation && ($this->IS_CREATE_DOC->Errors->Count() == 0);
        $Validation =  $Validation && ($this->IS_MANUAL->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_PROC_STATUS->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_DOC_STATUS->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PREV_DOC_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PREV_DOC_TYPE_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PREV_PROC_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PREV_CTL_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->MESSAGE->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-308FBB1C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->TAKEN_CTL->Errors->Count());
        $errors = ($errors || $this->IS_TAKEN->Errors->Count());
        $errors = ($errors || $this->CURR_DOC_ID->Errors->Count());
        $errors = ($errors || $this->CURR_DOC_TYPE_ID->Errors->Count());
        $errors = ($errors || $this->CURR_PROC_ID->Errors->Count());
        $errors = ($errors || $this->CURR_CTL_ID->Errors->Count());
        $errors = ($errors || $this->USER_ID_DOC->Errors->Count());
        $errors = ($errors || $this->USER_ID_DONOR->Errors->Count());
        $errors = ($errors || $this->USER_ID_LOGIN->Errors->Count());
        $errors = ($errors || $this->USER_ID_TAKEN->Errors->Count());
        $errors = ($errors || $this->IS_CREATE_DOC->Errors->Count());
        $errors = ($errors || $this->IS_MANUAL->Errors->Count());
        $errors = ($errors || $this->CURR_PROC_STATUS->Errors->Count());
        $errors = ($errors || $this->CURR_DOC_STATUS->Errors->Count());
        $errors = ($errors || $this->PREV_DOC_ID->Errors->Count());
        $errors = ($errors || $this->PREV_DOC_TYPE_ID->Errors->Count());
        $errors = ($errors || $this->PREV_PROC_ID->Errors->Count());
        $errors = ($errors || $this->PREV_CTL_ID->Errors->Count());
        $errors = ($errors || $this->SLOT_1->Errors->Count());
        $errors = ($errors || $this->SLOT_2->Errors->Count());
        $errors = ($errors || $this->SLOT_3->Errors->Count());
        $errors = ($errors || $this->SLOT_4->Errors->Count());
        $errors = ($errors || $this->SLOT_5->Errors->Count());
        $errors = ($errors || $this->MESSAGE->Errors->Count());
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

//Operation Method @3-52B2D54D
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        $Redirect = "t_vat_setllement_ro_new.php";
    }
//End Operation Method

//Show Method @3-20EE37E5
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
            $Error = ComposeStrings($Error, $this->TAKEN_CTL->Errors->ToString());
            $Error = ComposeStrings($Error, $this->IS_TAKEN->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_DOC_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_DOC_TYPE_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_PROC_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_CTL_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->USER_ID_DOC->Errors->ToString());
            $Error = ComposeStrings($Error, $this->USER_ID_DONOR->Errors->ToString());
            $Error = ComposeStrings($Error, $this->USER_ID_LOGIN->Errors->ToString());
            $Error = ComposeStrings($Error, $this->USER_ID_TAKEN->Errors->ToString());
            $Error = ComposeStrings($Error, $this->IS_CREATE_DOC->Errors->ToString());
            $Error = ComposeStrings($Error, $this->IS_MANUAL->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_PROC_STATUS->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_DOC_STATUS->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PREV_DOC_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PREV_DOC_TYPE_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PREV_PROC_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PREV_CTL_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->MESSAGE->Errors->ToString());
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

        $this->TAKEN_CTL->Show();
        $this->IS_TAKEN->Show();
        $this->CURR_DOC_ID->Show();
        $this->CURR_DOC_TYPE_ID->Show();
        $this->CURR_PROC_ID->Show();
        $this->CURR_CTL_ID->Show();
        $this->USER_ID_DOC->Show();
        $this->USER_ID_DONOR->Show();
        $this->USER_ID_LOGIN->Show();
        $this->USER_ID_TAKEN->Show();
        $this->IS_CREATE_DOC->Show();
        $this->IS_MANUAL->Show();
        $this->CURR_PROC_STATUS->Show();
        $this->CURR_DOC_STATUS->Show();
        $this->PREV_DOC_ID->Show();
        $this->PREV_DOC_TYPE_ID->Show();
        $this->PREV_PROC_ID->Show();
        $this->PREV_CTL_ID->Show();
        $this->SLOT_1->Show();
        $this->SLOT_2->Show();
        $this->SLOT_3->Show();
        $this->SLOT_4->Show();
        $this->SLOT_5->Show();
        $this->MESSAGE->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_vat_setllementSearch Class @3-FCB6E20C





//Initialize Page @1-E429AF54
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
$TemplateFileName = "t_vat_setllement_ro_new.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-94518D45
include_once("./t_vat_setllement_ro_new_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-FFF8C4A3
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_vat_setllementGrid = & new clsGridt_vat_setllementGrid("", $MainPage);
$t_vat_setllementSearch = & new clsRecordt_vat_setllementSearch("", $MainPage);
$MainPage->t_vat_setllementGrid = & $t_vat_setllementGrid;
$MainPage->t_vat_setllementSearch = & $t_vat_setllementSearch;
$t_vat_setllementGrid->Initialize();

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

//Execute Components @1-D0128F80
$t_vat_setllementSearch->Operation();
//End Execute Components

//Go to destination page @1-24AA2B5D
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_vat_setllementGrid);
    unset($t_vat_setllementSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-47DC6C17
$t_vat_setllementGrid->Show();
$t_vat_setllementSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-ADE72901
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_vat_setllementGrid);
unset($t_vat_setllementSearch);
unset($Tpl);
//End Unload Page


?>
