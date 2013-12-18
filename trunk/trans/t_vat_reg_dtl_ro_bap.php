<?php
//Include Common Files @1-0D1007AB
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_reg_dtl_ro_bap.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_vat_reg_dtlGrid { //t_vat_reg_dtlGrid class @2-4F76BDAF

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

//Class_Initialize Event @2-BCAC6DA9
    function clsGridt_vat_reg_dtlGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_dtlGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_dtlGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_dtlGridDataSource($this);
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

        $this->license_type_code = & new clsControl(ccsLabel, "license_type_code", "license_type_code", ccsText, "", CCGetRequestParam("license_type_code", ccsGet, NULL), $this);
        $this->t_license_letter_id = & new clsControl(ccsHidden, "t_license_letter_id", "t_license_letter_id", ccsFloat, "", CCGetRequestParam("t_license_letter_id", ccsGet, NULL), $this);
        $this->license_no = & new clsControl(ccsLabel, "license_no", "license_no", ccsText, "", CCGetRequestParam("license_no", ccsGet, NULL), $this);
        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", ccsGet, NULL), $this);
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

//Show Method @2-F7A126AE
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_vat_registration_id"] = CCGetFromGet("t_vat_registration_id", NULL);

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
            $this->ControlsVisible["license_type_code"] = $this->license_type_code->Visible;
            $this->ControlsVisible["t_license_letter_id"] = $this->t_license_letter_id->Visible;
            $this->ControlsVisible["license_no"] = $this->license_no->Visible;
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["t_vat_registration_id"] = $this->t_vat_registration_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->license_type_code->SetValue($this->DataSource->license_type_code->GetValue());
                $this->t_license_letter_id->SetValue($this->DataSource->t_license_letter_id->GetValue());
                $this->license_no->SetValue($this->DataSource->license_no->GetValue());
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_license_letter_id", $this->DataSource->f("t_license_letter_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_license_letter_id", $this->DataSource->f("t_license_letter_id"));
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->t_vat_registration_id->SetValue($this->DataSource->t_vat_registration_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->license_type_code->Show();
                $this->t_license_letter_id->Show();
                $this->license_no->Show();
                $this->valid_from->Show();
                $this->valid_to->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->description->Show();
                $this->t_vat_registration_id->Show();
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

//GetErrors Method @2-D73B659E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->license_type_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_license_letter_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->license_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_registration_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_dtlGrid Class @2-FCB6E20C

class clst_vat_reg_dtlGridDataSource extends clsDBConnSIKP {  //t_vat_reg_dtlGridDataSource Class @2-CD77B636

//DataSource Variables @2-4750FE52
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $license_type_code;
    var $t_license_letter_id;
    var $license_no;
    var $valid_from;
    var $valid_to;
    var $DLink;
    var $ADLink;
    var $description;
    var $t_vat_registration_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-7E8CE128
    function clst_vat_reg_dtlGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_dtlGrid";
        $this->Initialize();
        $this->license_type_code = new clsField("license_type_code", ccsText, "");
        
        $this->t_license_letter_id = new clsField("t_license_letter_id", ccsFloat, "");
        
        $this->license_no = new clsField("license_no", ccsText, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsFloat, "");
        

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

//Prepare Method @2-7C6FAA6C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_registration_id", ccsFloat, "", "", $this->Parameters["urlt_vat_registration_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_vat_registration_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-7421A1A0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_license_letter";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_license_letter {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-848CC4C6
    function SetValues()
    {
        $this->license_type_code->SetDBValue($this->f("license_type_code"));
        $this->t_license_letter_id->SetDBValue(trim($this->f("t_license_letter_id")));
        $this->license_no->SetDBValue($this->f("license_no"));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
        $this->DLink->SetDBValue($this->f("t_license_letter_id"));
        $this->ADLink->SetDBValue($this->f("t_license_letter_id"));
        $this->description->SetDBValue($this->f("description"));
        $this->t_vat_registration_id->SetDBValue(trim($this->f("t_vat_registration_id")));
    }
//End SetValues Method

} //End t_vat_reg_dtlGridDataSource Class @2-FCB6E20C

class clsRecordt_vat_reg_dtlSearch { //t_vat_reg_dtlSearch Class @3-98402BCA

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

//Class_Initialize Event @3-16343D26
    function clsRecordt_vat_reg_dtlSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_vat_reg_dtlSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_vat_reg_dtlSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_keyword = & new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", $Method, NULL), $this);
            $this->rqst_type_code = & new clsControl(ccsHidden, "rqst_type_code", "rqst_type_code", ccsText, "", CCGetRequestParam("rqst_type_code", $Method, NULL), $this);
            $this->p_rqst_type_id = & new clsControl(ccsHidden, "p_rqst_type_id", "p_rqst_type_id", ccsFloat, "", CCGetRequestParam("p_rqst_type_id", $Method, NULL), $this);
            $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsFloat, "", CCGetRequestParam("t_customer_order_id", $Method, NULL), $this);
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

//Validate Method @3-988E9E1C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->t_vat_registration_id->Validate() && $Validation);
        $Validation = ($this->rqst_type_code->Validate() && $Validation);
        $Validation = ($this->p_rqst_type_id->Validate() && $Validation);
        $Validation = ($this->t_customer_order_id->Validate() && $Validation);
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
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_vat_registration_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rqst_type_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rqst_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_order_id->Errors->Count() == 0);
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

//CheckErrors Method @3-A0E1D196
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->t_vat_registration_id->Errors->Count());
        $errors = ($errors || $this->rqst_type_code->Errors->Count());
        $errors = ($errors || $this->p_rqst_type_id->Errors->Count());
        $errors = ($errors || $this->t_customer_order_id->Errors->Count());
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

//Operation Method @3-E38D045C
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
        $Redirect = "t_vat_reg_dtl_ro_bap.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_vat_reg_dtl_ro_bap.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-7B3EAA63
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
            $Error = ComposeStrings($Error, $this->t_vat_registration_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rqst_type_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rqst_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_order_id->Errors->ToString());
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

        $this->Button_DoSearch->Show();
        $this->s_keyword->Show();
        $this->t_vat_registration_id->Show();
        $this->rqst_type_code->Show();
        $this->p_rqst_type_id->Show();
        $this->t_customer_order_id->Show();
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

} //End t_vat_reg_dtlSearch Class @3-FCB6E20C

class clsGridt_vat_reg_dtl_restaurantGrid { //t_vat_reg_dtl_restaurantGrid class @688-A79EB431

//Variables @688-AC1EDBB9

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

//Class_Initialize Event @688-DE9DF36F
    function clsGridt_vat_reg_dtl_restaurantGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_dtl_restaurantGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_dtl_restaurantGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_dtl_restaurantGridDataSource($this);
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

        $this->service_type_desc = & new clsControl(ccsLabel, "service_type_desc", "service_type_desc", ccsText, "", CCGetRequestParam("service_type_desc", ccsGet, NULL), $this);
        $this->t_vat_reg_dtl_restaurant_id = & new clsControl(ccsHidden, "t_vat_reg_dtl_restaurant_id", "t_vat_reg_dtl_restaurant_id", ccsFloat, "", CCGetRequestParam("t_vat_reg_dtl_restaurant_id", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->seat_qty = & new clsControl(ccsLabel, "seat_qty", "seat_qty", ccsText, "", CCGetRequestParam("seat_qty", ccsGet, NULL), $this);
        $this->table_qty = & new clsControl(ccsLabel, "table_qty", "table_qty", ccsText, "", CCGetRequestParam("table_qty", ccsGet, NULL), $this);
        $this->max_service_qty = & new clsControl(ccsLabel, "max_service_qty", "max_service_qty", ccsText, "", CCGetRequestParam("max_service_qty", ccsGet, NULL), $this);
        $this->avg_subscription = & new clsControl(ccsLabel, "avg_subscription", "avg_subscription", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("avg_subscription", ccsGet, NULL), $this);
        $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @688-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @688-B4738648
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_vat_registration_id"] = CCGetFromGet("t_vat_registration_id", NULL);

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
            $this->ControlsVisible["service_type_desc"] = $this->service_type_desc->Visible;
            $this->ControlsVisible["t_vat_reg_dtl_restaurant_id"] = $this->t_vat_reg_dtl_restaurant_id->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["seat_qty"] = $this->seat_qty->Visible;
            $this->ControlsVisible["table_qty"] = $this->table_qty->Visible;
            $this->ControlsVisible["max_service_qty"] = $this->max_service_qty->Visible;
            $this->ControlsVisible["avg_subscription"] = $this->avg_subscription->Visible;
            $this->ControlsVisible["t_vat_registration_id"] = $this->t_vat_registration_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->service_type_desc->SetValue($this->DataSource->service_type_desc->GetValue());
                $this->t_vat_reg_dtl_restaurant_id->SetValue($this->DataSource->t_vat_reg_dtl_restaurant_id->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_vat_reg_dtl_restaurant_id", $this->DataSource->f("t_vat_reg_dtl_restaurant_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_vat_reg_dtl_restaurant_id", $this->DataSource->f("t_vat_reg_dtl_restaurant_id"));
                $this->seat_qty->SetValue($this->DataSource->seat_qty->GetValue());
                $this->table_qty->SetValue($this->DataSource->table_qty->GetValue());
                $this->max_service_qty->SetValue($this->DataSource->max_service_qty->GetValue());
                $this->avg_subscription->SetValue($this->DataSource->avg_subscription->GetValue());
                $this->t_vat_registration_id->SetValue($this->DataSource->t_vat_registration_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->service_type_desc->Show();
                $this->t_vat_reg_dtl_restaurant_id->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->seat_qty->Show();
                $this->table_qty->Show();
                $this->max_service_qty->Show();
                $this->avg_subscription->Show();
                $this->t_vat_registration_id->Show();
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

//GetErrors Method @688-7454DB92
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->service_type_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_reg_dtl_restaurant_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->seat_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->table_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->max_service_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->avg_subscription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_registration_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_dtl_restaurantGrid Class @688-FCB6E20C

class clst_vat_reg_dtl_restaurantGridDataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_restaurantGridDataSource Class @688-0A111FC1

//DataSource Variables @688-5B48B9E6
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $service_type_desc;
    var $t_vat_reg_dtl_restaurant_id;
    var $DLink;
    var $ADLink;
    var $seat_qty;
    var $table_qty;
    var $max_service_qty;
    var $avg_subscription;
    var $t_vat_registration_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @688-09D15845
    function clst_vat_reg_dtl_restaurantGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_dtl_restaurantGrid";
        $this->Initialize();
        $this->service_type_desc = new clsField("service_type_desc", ccsText, "");
        
        $this->t_vat_reg_dtl_restaurant_id = new clsField("t_vat_reg_dtl_restaurant_id", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->seat_qty = new clsField("seat_qty", ccsText, "");
        
        $this->table_qty = new clsField("table_qty", ccsText, "");
        
        $this->max_service_qty = new clsField("max_service_qty", ccsText, "");
        
        $this->avg_subscription = new clsField("avg_subscription", ccsFloat, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @688-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @688-7C6FAA6C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_registration_id", ccsFloat, "", "", $this->Parameters["urlt_vat_registration_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_vat_registration_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @688-35ADFD69
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_vat_reg_dtl_restaurant";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_vat_reg_dtl_restaurant {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @688-224F365F
    function SetValues()
    {
        $this->service_type_desc->SetDBValue($this->f("service_type_desc"));
        $this->t_vat_reg_dtl_restaurant_id->SetDBValue(trim($this->f("t_vat_reg_dtl_restaurant_id")));
        $this->DLink->SetDBValue($this->f("t_vat_reg_dtl_restaurant_id"));
        $this->ADLink->SetDBValue($this->f("t_vat_reg_dtl_restaurant_id"));
        $this->seat_qty->SetDBValue($this->f("seat_qty"));
        $this->table_qty->SetDBValue($this->f("table_qty"));
        $this->max_service_qty->SetDBValue($this->f("max_service_qty"));
        $this->avg_subscription->SetDBValue(trim($this->f("avg_subscription")));
        $this->t_vat_registration_id->SetDBValue(trim($this->f("t_vat_registration_id")));
    }
//End SetValues Method

} //End t_vat_reg_dtl_restaurantGridDataSource Class @688-FCB6E20C

class clsGridt_vat_reg_dtl_hotelGrid1 { //t_vat_reg_dtl_hotelGrid1 class @790-64BFECAD

//Variables @790-AC1EDBB9

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

//Class_Initialize Event @790-129CBF53
    function clsGridt_vat_reg_dtl_hotelGrid1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_dtl_hotelGrid1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_dtl_hotelGrid1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_dtl_hotelGrid1DataSource($this);
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
        $this->DLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->room_type_code = & new clsControl(ccsLabel, "room_type_code", "room_type_code", ccsText, "", CCGetRequestParam("room_type_code", ccsGet, NULL), $this);
        $this->room_qty = & new clsControl(ccsLabel, "room_qty", "room_qty", ccsFloat, "", CCGetRequestParam("room_qty", ccsGet, NULL), $this);
        $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", ccsGet, NULL), $this);
        $this->service_qty = & new clsControl(ccsLabel, "service_qty", "service_qty", ccsFloat, "", CCGetRequestParam("service_qty", ccsGet, NULL), $this);
        $this->service_charge_wd = & new clsControl(ccsLabel, "service_charge_wd", "service_charge_wd", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge_wd", ccsGet, NULL), $this);
        $this->service_charge_we = & new clsControl(ccsLabel, "service_charge_we", "service_charge_we", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge_we", ccsGet, NULL), $this);
        $this->t_vat_reg_dtl_hotel_id = & new clsControl(ccsHidden, "t_vat_reg_dtl_hotel_id", "t_vat_reg_dtl_hotel_id", ccsFloat, "", CCGetRequestParam("t_vat_reg_dtl_hotel_id", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @790-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @790-6D2B32E9
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_vat_registration_id"] = CCGetFromGet("t_vat_registration_id", NULL);

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
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["room_type_code"] = $this->room_type_code->Visible;
            $this->ControlsVisible["room_qty"] = $this->room_qty->Visible;
            $this->ControlsVisible["t_vat_registration_id"] = $this->t_vat_registration_id->Visible;
            $this->ControlsVisible["service_qty"] = $this->service_qty->Visible;
            $this->ControlsVisible["service_charge_wd"] = $this->service_charge_wd->Visible;
            $this->ControlsVisible["service_charge_we"] = $this->service_charge_we->Visible;
            $this->ControlsVisible["t_vat_reg_dtl_hotel_id"] = $this->t_vat_reg_dtl_hotel_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_vat_reg_dtl_hotel_id", $this->DataSource->f("t_vat_reg_dtl_hotel_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_vat_reg_dtl_hotel_id", $this->DataSource->f("t_vat_reg_dtl_hotel_id"));
                $this->room_type_code->SetValue($this->DataSource->room_type_code->GetValue());
                $this->room_qty->SetValue($this->DataSource->room_qty->GetValue());
                $this->t_vat_registration_id->SetValue($this->DataSource->t_vat_registration_id->GetValue());
                $this->service_qty->SetValue($this->DataSource->service_qty->GetValue());
                $this->service_charge_wd->SetValue($this->DataSource->service_charge_wd->GetValue());
                $this->service_charge_we->SetValue($this->DataSource->service_charge_we->GetValue());
                $this->t_vat_reg_dtl_hotel_id->SetValue($this->DataSource->t_vat_reg_dtl_hotel_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->room_type_code->Show();
                $this->room_qty->Show();
                $this->t_vat_registration_id->Show();
                $this->service_qty->Show();
                $this->service_charge_wd->Show();
                $this->service_charge_we->Show();
                $this->t_vat_reg_dtl_hotel_id->Show();
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

//GetErrors Method @790-74076079
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->room_type_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->room_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_registration_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_charge_wd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_charge_we->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_reg_dtl_hotel_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_dtl_hotelGrid1 Class @790-FCB6E20C

class clst_vat_reg_dtl_hotelGrid1DataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_hotelGrid1DataSource Class @790-5809D861

//DataSource Variables @790-07F62BF2
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $DLink;
    var $ADLink;
    var $room_type_code;
    var $room_qty;
    var $t_vat_registration_id;
    var $service_qty;
    var $service_charge_wd;
    var $service_charge_we;
    var $t_vat_reg_dtl_hotel_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @790-2D8AB603
    function clst_vat_reg_dtl_hotelGrid1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_dtl_hotelGrid1";
        $this->Initialize();
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->room_type_code = new clsField("room_type_code", ccsText, "");
        
        $this->room_qty = new clsField("room_qty", ccsFloat, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsFloat, "");
        
        $this->service_qty = new clsField("service_qty", ccsFloat, "");
        
        $this->service_charge_wd = new clsField("service_charge_wd", ccsFloat, "");
        
        $this->service_charge_we = new clsField("service_charge_we", ccsFloat, "");
        
        $this->t_vat_reg_dtl_hotel_id = new clsField("t_vat_reg_dtl_hotel_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @790-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @790-7C6FAA6C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_registration_id", ccsFloat, "", "", $this->Parameters["urlt_vat_registration_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_vat_registration_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @790-B800B4AD
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_vat_reg_dtl_hotel";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_vat_reg_dtl_hotel {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @790-BDDA5263
    function SetValues()
    {
        $this->DLink->SetDBValue($this->f("t_vat_reg_dtl_hotel_id"));
        $this->ADLink->SetDBValue($this->f("t_vat_reg_dtl_hotel_id"));
        $this->room_type_code->SetDBValue($this->f("room_type_code"));
        $this->room_qty->SetDBValue(trim($this->f("room_qty")));
        $this->t_vat_registration_id->SetDBValue(trim($this->f("t_vat_registration_id")));
        $this->service_qty->SetDBValue(trim($this->f("service_qty")));
        $this->service_charge_wd->SetDBValue(trim($this->f("service_charge_wd")));
        $this->service_charge_we->SetDBValue(trim($this->f("service_charge_we")));
        $this->t_vat_reg_dtl_hotel_id->SetDBValue(trim($this->f("t_vat_reg_dtl_hotel_id")));
    }
//End SetValues Method

} //End t_vat_reg_dtl_hotelGrid1DataSource Class @790-FCB6E20C

class clsGridv_vat_reg_dtl_entertaintmentGrid { //v_vat_reg_dtl_entertaintmentGrid class @814-E9C1D9DE

//Variables @814-AC1EDBB9

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

//Class_Initialize Event @814-5B2FD3E2
    function clsGridv_vat_reg_dtl_entertaintmentGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "v_vat_reg_dtl_entertaintmentGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid v_vat_reg_dtl_entertaintmentGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsv_vat_reg_dtl_entertaintmentGridDataSource($this);
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

        $this->entertainment_desc = & new clsControl(ccsLabel, "entertainment_desc", "entertainment_desc", ccsText, "", CCGetRequestParam("entertainment_desc", ccsGet, NULL), $this);
        $this->t_vat_reg_dtl_entertaintment_id = & new clsControl(ccsHidden, "t_vat_reg_dtl_entertaintment_id", "t_vat_reg_dtl_entertaintment_id", ccsFloat, "", CCGetRequestParam("t_vat_reg_dtl_entertaintment_id", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->service_charge_wd = & new clsControl(ccsLabel, "service_charge_wd", "service_charge_wd", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge_wd", ccsGet, NULL), $this);
        $this->clerk_qty = & new clsControl(ccsLabel, "clerk_qty", "clerk_qty", ccsText, "", CCGetRequestParam("clerk_qty", ccsGet, NULL), $this);
        $this->booking_hour = & new clsControl(ccsLabel, "booking_hour", "booking_hour", ccsText, "", CCGetRequestParam("booking_hour", ccsGet, NULL), $this);
        $this->f_and_b = & new clsControl(ccsLabel, "f_and_b", "f_and_b", ccsText, "", CCGetRequestParam("f_and_b", ccsGet, NULL), $this);
        $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", ccsGet, NULL), $this);
        $this->seat_qty = & new clsControl(ccsLabel, "seat_qty", "seat_qty", ccsText, "", CCGetRequestParam("seat_qty", ccsGet, NULL), $this);
        $this->portion_person = & new clsControl(ccsLabel, "portion_person", "portion_person", ccsText, "", CCGetRequestParam("portion_person", ccsGet, NULL), $this);
        $this->room_qty = & new clsControl(ccsLabel, "room_qty", "room_qty", ccsText, "", CCGetRequestParam("room_qty", ccsGet, NULL), $this);
        $this->service_charge_we = & new clsControl(ccsLabel, "service_charge_we", "service_charge_we", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge_we", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @814-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @814-8F03F354
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_vat_registration_id"] = CCGetFromGet("t_vat_registration_id", NULL);

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
            $this->ControlsVisible["entertainment_desc"] = $this->entertainment_desc->Visible;
            $this->ControlsVisible["t_vat_reg_dtl_entertaintment_id"] = $this->t_vat_reg_dtl_entertaintment_id->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["service_charge_wd"] = $this->service_charge_wd->Visible;
            $this->ControlsVisible["clerk_qty"] = $this->clerk_qty->Visible;
            $this->ControlsVisible["booking_hour"] = $this->booking_hour->Visible;
            $this->ControlsVisible["f_and_b"] = $this->f_and_b->Visible;
            $this->ControlsVisible["t_vat_registration_id"] = $this->t_vat_registration_id->Visible;
            $this->ControlsVisible["seat_qty"] = $this->seat_qty->Visible;
            $this->ControlsVisible["portion_person"] = $this->portion_person->Visible;
            $this->ControlsVisible["room_qty"] = $this->room_qty->Visible;
            $this->ControlsVisible["service_charge_we"] = $this->service_charge_we->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->entertainment_desc->SetValue($this->DataSource->entertainment_desc->GetValue());
                $this->t_vat_reg_dtl_entertaintment_id->SetValue($this->DataSource->t_vat_reg_dtl_entertaintment_id->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_vat_reg_dtl_entertaintment_id", $this->DataSource->f("t_vat_reg_dtl_entertaintment_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_vat_reg_dtl_entertaintment_id", $this->DataSource->f("t_vat_reg_dtl_entertaintment_id"));
                $this->service_charge_wd->SetValue($this->DataSource->service_charge_wd->GetValue());
                $this->clerk_qty->SetValue($this->DataSource->clerk_qty->GetValue());
                $this->booking_hour->SetValue($this->DataSource->booking_hour->GetValue());
                $this->f_and_b->SetValue($this->DataSource->f_and_b->GetValue());
                $this->t_vat_registration_id->SetValue($this->DataSource->t_vat_registration_id->GetValue());
                $this->seat_qty->SetValue($this->DataSource->seat_qty->GetValue());
                $this->portion_person->SetValue($this->DataSource->portion_person->GetValue());
                $this->room_qty->SetValue($this->DataSource->room_qty->GetValue());
                $this->service_charge_we->SetValue($this->DataSource->service_charge_we->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->entertainment_desc->Show();
                $this->t_vat_reg_dtl_entertaintment_id->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->service_charge_wd->Show();
                $this->clerk_qty->Show();
                $this->booking_hour->Show();
                $this->f_and_b->Show();
                $this->t_vat_registration_id->Show();
                $this->seat_qty->Show();
                $this->portion_person->Show();
                $this->room_qty->Show();
                $this->service_charge_we->Show();
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

//GetErrors Method @814-A8DEF39C
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->entertainment_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_reg_dtl_entertaintment_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_charge_wd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->clerk_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->booking_hour->Errors->ToString());
        $errors = ComposeStrings($errors, $this->f_and_b->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_registration_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->seat_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->portion_person->Errors->ToString());
        $errors = ComposeStrings($errors, $this->room_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_charge_we->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End v_vat_reg_dtl_entertaintmentGrid Class @814-FCB6E20C

class clsv_vat_reg_dtl_entertaintmentGridDataSource extends clsDBConnSIKP {  //v_vat_reg_dtl_entertaintmentGridDataSource Class @814-1BA53B61

//DataSource Variables @814-F51BB361
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $entertainment_desc;
    var $t_vat_reg_dtl_entertaintment_id;
    var $DLink;
    var $ADLink;
    var $service_charge_wd;
    var $clerk_qty;
    var $booking_hour;
    var $f_and_b;
    var $t_vat_registration_id;
    var $seat_qty;
    var $portion_person;
    var $room_qty;
    var $service_charge_we;
//End DataSource Variables

//DataSourceClass_Initialize Event @814-96DF6D7B
    function clsv_vat_reg_dtl_entertaintmentGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid v_vat_reg_dtl_entertaintmentGrid";
        $this->Initialize();
        $this->entertainment_desc = new clsField("entertainment_desc", ccsText, "");
        
        $this->t_vat_reg_dtl_entertaintment_id = new clsField("t_vat_reg_dtl_entertaintment_id", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->service_charge_wd = new clsField("service_charge_wd", ccsFloat, "");
        
        $this->clerk_qty = new clsField("clerk_qty", ccsText, "");
        
        $this->booking_hour = new clsField("booking_hour", ccsText, "");
        
        $this->f_and_b = new clsField("f_and_b", ccsText, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsFloat, "");
        
        $this->seat_qty = new clsField("seat_qty", ccsText, "");
        
        $this->portion_person = new clsField("portion_person", ccsText, "");
        
        $this->room_qty = new clsField("room_qty", ccsText, "");
        
        $this->service_charge_we = new clsField("service_charge_we", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @814-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @814-7C6FAA6C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_registration_id", ccsFloat, "", "", $this->Parameters["urlt_vat_registration_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_vat_registration_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @814-59277503
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_vat_reg_dtl_entertaintment";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_vat_reg_dtl_entertaintment {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @814-15EA2632
    function SetValues()
    {
        $this->entertainment_desc->SetDBValue($this->f("entertainment_desc"));
        $this->t_vat_reg_dtl_entertaintment_id->SetDBValue(trim($this->f("t_vat_reg_dtl_entertaintment_id")));
        $this->DLink->SetDBValue($this->f("t_vat_reg_dtl_entertaintment_id"));
        $this->ADLink->SetDBValue($this->f("t_vat_reg_dtl_entertaintment_id"));
        $this->service_charge_wd->SetDBValue(trim($this->f("service_charge_wd")));
        $this->clerk_qty->SetDBValue($this->f("clerk_qty"));
        $this->booking_hour->SetDBValue($this->f("booking_hour"));
        $this->f_and_b->SetDBValue($this->f("f_and_b"));
        $this->t_vat_registration_id->SetDBValue(trim($this->f("t_vat_registration_id")));
        $this->seat_qty->SetDBValue($this->f("seat_qty"));
        $this->portion_person->SetDBValue($this->f("portion_person"));
        $this->room_qty->SetDBValue($this->f("room_qty"));
        $this->service_charge_we->SetDBValue(trim($this->f("service_charge_we")));
    }
//End SetValues Method

} //End v_vat_reg_dtl_entertaintmentGridDataSource Class @814-FCB6E20C

class clsGridt_vat_reg_dtl_parkingGrid { //t_vat_reg_dtl_parkingGrid class @838-C5C035E2

//Variables @838-AC1EDBB9

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

//Class_Initialize Event @838-9437398B
    function clsGridt_vat_reg_dtl_parkingGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_dtl_parkingGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_dtl_parkingGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_dtl_parkingGridDataSource($this);
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

        $this->classification_desc = & new clsControl(ccsLabel, "classification_desc", "classification_desc", ccsText, "", CCGetRequestParam("classification_desc", ccsGet, NULL), $this);
        $this->t_vat_reg_dtl_parking_id = & new clsControl(ccsHidden, "t_vat_reg_dtl_parking_id", "t_vat_reg_dtl_parking_id", ccsFloat, "", CCGetRequestParam("t_vat_reg_dtl_parking_id", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->parking_size = & new clsControl(ccsLabel, "parking_size", "parking_size", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("parking_size", ccsGet, NULL), $this);
        $this->max_load_qty = & new clsControl(ccsLabel, "max_load_qty", "max_load_qty", ccsText, "", CCGetRequestParam("max_load_qty", ccsGet, NULL), $this);
        $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", ccsGet, NULL), $this);
        $this->avg_subscription_qty = & new clsControl(ccsLabel, "avg_subscription_qty", "avg_subscription_qty", ccsText, "", CCGetRequestParam("avg_subscription_qty", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @838-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @838-B5A5D572
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_vat_registration_id"] = CCGetFromGet("t_vat_registration_id", NULL);

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
            $this->ControlsVisible["classification_desc"] = $this->classification_desc->Visible;
            $this->ControlsVisible["t_vat_reg_dtl_parking_id"] = $this->t_vat_reg_dtl_parking_id->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["parking_size"] = $this->parking_size->Visible;
            $this->ControlsVisible["max_load_qty"] = $this->max_load_qty->Visible;
            $this->ControlsVisible["t_vat_registration_id"] = $this->t_vat_registration_id->Visible;
            $this->ControlsVisible["avg_subscription_qty"] = $this->avg_subscription_qty->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->classification_desc->SetValue($this->DataSource->classification_desc->GetValue());
                $this->t_vat_reg_dtl_parking_id->SetValue($this->DataSource->t_vat_reg_dtl_parking_id->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_vat_reg_dtl_parking_id", $this->DataSource->f("t_vat_reg_dtl_parking_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_vat_reg_dtl_parking_id", $this->DataSource->f("t_vat_reg_dtl_parking_id"));
                $this->parking_size->SetValue($this->DataSource->parking_size->GetValue());
                $this->max_load_qty->SetValue($this->DataSource->max_load_qty->GetValue());
                $this->t_vat_registration_id->SetValue($this->DataSource->t_vat_registration_id->GetValue());
                $this->avg_subscription_qty->SetValue($this->DataSource->avg_subscription_qty->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->classification_desc->Show();
                $this->t_vat_reg_dtl_parking_id->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->parking_size->Show();
                $this->max_load_qty->Show();
                $this->t_vat_registration_id->Show();
                $this->avg_subscription_qty->Show();
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

//GetErrors Method @838-4A69AF0F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->classification_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_reg_dtl_parking_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->parking_size->Errors->ToString());
        $errors = ComposeStrings($errors, $this->max_load_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_registration_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->avg_subscription_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_dtl_parkingGrid Class @838-FCB6E20C

class clst_vat_reg_dtl_parkingGridDataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_parkingGridDataSource Class @838-5B68347C

//DataSource Variables @838-9E25BE99
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $classification_desc;
    var $t_vat_reg_dtl_parking_id;
    var $DLink;
    var $ADLink;
    var $parking_size;
    var $max_load_qty;
    var $t_vat_registration_id;
    var $avg_subscription_qty;
//End DataSource Variables

//DataSourceClass_Initialize Event @838-DC67C441
    function clst_vat_reg_dtl_parkingGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_dtl_parkingGrid";
        $this->Initialize();
        $this->classification_desc = new clsField("classification_desc", ccsText, "");
        
        $this->t_vat_reg_dtl_parking_id = new clsField("t_vat_reg_dtl_parking_id", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->parking_size = new clsField("parking_size", ccsFloat, "");
        
        $this->max_load_qty = new clsField("max_load_qty", ccsText, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsFloat, "");
        
        $this->avg_subscription_qty = new clsField("avg_subscription_qty", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @838-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @838-7C6FAA6C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_registration_id", ccsFloat, "", "", $this->Parameters["urlt_vat_registration_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_vat_registration_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @838-F1E89054
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_vat_reg_dtl_parking";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_vat_reg_dtl_parking {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @838-9DA038AE
    function SetValues()
    {
        $this->classification_desc->SetDBValue($this->f("classification_desc"));
        $this->t_vat_reg_dtl_parking_id->SetDBValue(trim($this->f("t_vat_reg_dtl_parking_id")));
        $this->DLink->SetDBValue($this->f("t_vat_reg_dtl_parking_id"));
        $this->ADLink->SetDBValue($this->f("t_vat_reg_dtl_entertaintment_id"));
        $this->parking_size->SetDBValue(trim($this->f("parking_size")));
        $this->max_load_qty->SetDBValue($this->f("max_load_qty"));
        $this->t_vat_registration_id->SetDBValue(trim($this->f("t_vat_registration_id")));
        $this->avg_subscription_qty->SetDBValue($this->f("avg_subscription_qty"));
    }
//End SetValues Method

} //End t_vat_reg_dtl_parkingGridDataSource Class @838-FCB6E20C

class clsGridt_vat_reg_dtl_ppjGrid { //t_vat_reg_dtl_ppjGrid class @862-DF1AAD2C

//Variables @862-AC1EDBB9

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

//Class_Initialize Event @862-AD69DA08
    function clsGridt_vat_reg_dtl_ppjGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_dtl_ppjGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_dtl_ppjGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_dtl_ppjGridDataSource($this);
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

        $this->pwr_classification_desc = & new clsControl(ccsLabel, "pwr_classification_desc", "pwr_classification_desc", ccsText, "", CCGetRequestParam("pwr_classification_desc", ccsGet, NULL), $this);
        $this->t_vat_reg_dtl_ppj_id = & new clsControl(ccsHidden, "t_vat_reg_dtl_ppj_id", "t_vat_reg_dtl_ppj_id", ccsFloat, "", CCGetRequestParam("t_vat_reg_dtl_ppj_id", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->power_capacity = & new clsControl(ccsLabel, "power_capacity", "power_capacity", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("power_capacity", ccsGet, NULL), $this);
        $this->service_charge = & new clsControl(ccsLabel, "service_charge", "service_charge", ccsText, "", CCGetRequestParam("service_charge", ccsGet, NULL), $this);
        $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", ccsGet, NULL), $this);
        $this->power_factor = & new clsControl(ccsLabel, "power_factor", "power_factor", ccsText, "", CCGetRequestParam("power_factor", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @862-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @862-E27B0555
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_vat_registration_id"] = CCGetFromGet("t_vat_registration_id", NULL);

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
            $this->ControlsVisible["pwr_classification_desc"] = $this->pwr_classification_desc->Visible;
            $this->ControlsVisible["t_vat_reg_dtl_ppj_id"] = $this->t_vat_reg_dtl_ppj_id->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["power_capacity"] = $this->power_capacity->Visible;
            $this->ControlsVisible["service_charge"] = $this->service_charge->Visible;
            $this->ControlsVisible["t_vat_registration_id"] = $this->t_vat_registration_id->Visible;
            $this->ControlsVisible["power_factor"] = $this->power_factor->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->pwr_classification_desc->SetValue($this->DataSource->pwr_classification_desc->GetValue());
                $this->t_vat_reg_dtl_ppj_id->SetValue($this->DataSource->t_vat_reg_dtl_ppj_id->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_vat_reg_dtl_ppj_id", $this->DataSource->f("t_vat_reg_dtl_ppj_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_vat_reg_dtl_ppj_id", $this->DataSource->f("t_vat_reg_dtl_ppj_id"));
                $this->power_capacity->SetValue($this->DataSource->power_capacity->GetValue());
                $this->service_charge->SetValue($this->DataSource->service_charge->GetValue());
                $this->t_vat_registration_id->SetValue($this->DataSource->t_vat_registration_id->GetValue());
                $this->power_factor->SetValue($this->DataSource->power_factor->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->pwr_classification_desc->Show();
                $this->t_vat_reg_dtl_ppj_id->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->power_capacity->Show();
                $this->service_charge->Show();
                $this->t_vat_registration_id->Show();
                $this->power_factor->Show();
                $this->description->Show();
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

//GetErrors Method @862-EF251B5E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->pwr_classification_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_reg_dtl_ppj_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->power_capacity->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_charge->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_registration_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->power_factor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_dtl_ppjGrid Class @862-FCB6E20C

class clst_vat_reg_dtl_ppjGridDataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_ppjGridDataSource Class @862-26AC7690

//DataSource Variables @862-0967A6E9
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $pwr_classification_desc;
    var $t_vat_reg_dtl_ppj_id;
    var $DLink;
    var $ADLink;
    var $power_capacity;
    var $service_charge;
    var $t_vat_registration_id;
    var $power_factor;
    var $description;
//End DataSource Variables

//DataSourceClass_Initialize Event @862-3682A58F
    function clst_vat_reg_dtl_ppjGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_dtl_ppjGrid";
        $this->Initialize();
        $this->pwr_classification_desc = new clsField("pwr_classification_desc", ccsText, "");
        
        $this->t_vat_reg_dtl_ppj_id = new clsField("t_vat_reg_dtl_ppj_id", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->power_capacity = new clsField("power_capacity", ccsFloat, "");
        
        $this->service_charge = new clsField("service_charge", ccsText, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsFloat, "");
        
        $this->power_factor = new clsField("power_factor", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @862-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @862-7C6FAA6C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_registration_id", ccsFloat, "", "", $this->Parameters["urlt_vat_registration_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_vat_registration_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @862-B9A49E40
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_vat_reg_dtl_ppj";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_vat_reg_dtl_ppj {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @862-F275AC0F
    function SetValues()
    {
        $this->pwr_classification_desc->SetDBValue($this->f("pwr_classification_desc"));
        $this->t_vat_reg_dtl_ppj_id->SetDBValue(trim($this->f("t_vat_reg_dtl_ppj_id")));
        $this->DLink->SetDBValue($this->f("t_vat_reg_dtl_ppj_id"));
        $this->ADLink->SetDBValue($this->f("t_vat_reg_dtl_ppj_id"));
        $this->power_capacity->SetDBValue(trim($this->f("power_capacity")));
        $this->service_charge->SetDBValue($this->f("service_charge"));
        $this->t_vat_registration_id->SetDBValue(trim($this->f("t_vat_registration_id")));
        $this->power_factor->SetDBValue($this->f("power_factor"));
        $this->description->SetDBValue($this->f("description"));
    }
//End SetValues Method

} //End t_vat_reg_dtl_ppjGridDataSource Class @862-FCB6E20C

class clsGridt_vat_reg_dtl_ppj_nplGrid { //t_vat_reg_dtl_ppj_nplGrid class @896-BAFF6062

//Variables @896-AC1EDBB9

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

//Class_Initialize Event @896-FFA25DC0
    function clsGridt_vat_reg_dtl_ppj_nplGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_dtl_ppj_nplGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_dtl_ppj_nplGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_dtl_ppj_nplGridDataSource($this);
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

        $this->owner_qty = & new clsControl(ccsLabel, "owner_qty", "owner_qty", ccsText, "", CCGetRequestParam("owner_qty", ccsGet, NULL), $this);
        $this->t_vat_reg_dtl_ppj_npl_id = & new clsControl(ccsHidden, "t_vat_reg_dtl_ppj_npl_id", "t_vat_reg_dtl_ppj_npl_id", ccsFloat, "", CCGetRequestParam("t_vat_reg_dtl_ppj_npl_id", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->power_capacity = & new clsControl(ccsLabel, "power_capacity", "power_capacity", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("power_capacity", ccsGet, NULL), $this);
        $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @896-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @896-D505BD23
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_vat_registration_id"] = CCGetFromGet("t_vat_registration_id", NULL);

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
            $this->ControlsVisible["owner_qty"] = $this->owner_qty->Visible;
            $this->ControlsVisible["t_vat_reg_dtl_ppj_npl_id"] = $this->t_vat_reg_dtl_ppj_npl_id->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["power_capacity"] = $this->power_capacity->Visible;
            $this->ControlsVisible["t_vat_registration_id"] = $this->t_vat_registration_id->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->owner_qty->SetValue($this->DataSource->owner_qty->GetValue());
                $this->t_vat_reg_dtl_ppj_npl_id->SetValue($this->DataSource->t_vat_reg_dtl_ppj_npl_id->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_vat_reg_dtl_ppj_npl_id", $this->DataSource->f("t_vat_reg_dtl_ppj_npl_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_vat_reg_dtl_ppj_npl_id", $this->DataSource->f("t_vat_reg_dtl_ppj_npl_id"));
                $this->power_capacity->SetValue($this->DataSource->power_capacity->GetValue());
                $this->t_vat_registration_id->SetValue($this->DataSource->t_vat_registration_id->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->owner_qty->Show();
                $this->t_vat_reg_dtl_ppj_npl_id->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->power_capacity->Show();
                $this->t_vat_registration_id->Show();
                $this->description->Show();
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

//GetErrors Method @896-FA4EF5AE
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->owner_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_reg_dtl_ppj_npl_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->power_capacity->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_registration_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_dtl_ppj_nplGrid Class @896-FCB6E20C

class clst_vat_reg_dtl_ppj_nplGridDataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_ppj_nplGridDataSource Class @896-DAD47FE4

//DataSource Variables @896-FEBA9CDF
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $owner_qty;
    var $t_vat_reg_dtl_ppj_npl_id;
    var $DLink;
    var $ADLink;
    var $power_capacity;
    var $t_vat_registration_id;
    var $description;
//End DataSource Variables

//DataSourceClass_Initialize Event @896-A90238C0
    function clst_vat_reg_dtl_ppj_nplGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_dtl_ppj_nplGrid";
        $this->Initialize();
        $this->owner_qty = new clsField("owner_qty", ccsText, "");
        
        $this->t_vat_reg_dtl_ppj_npl_id = new clsField("t_vat_reg_dtl_ppj_npl_id", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->power_capacity = new clsField("power_capacity", ccsFloat, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @896-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @896-7C6FAA6C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_registration_id", ccsFloat, "", "", $this->Parameters["urlt_vat_registration_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_vat_registration_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @896-6E8BABDB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_vat_reg_dtl_ppj_non_pln";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_vat_reg_dtl_ppj_non_pln {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @896-7AE020A3
    function SetValues()
    {
        $this->owner_qty->SetDBValue($this->f("owner_qty"));
        $this->t_vat_reg_dtl_ppj_npl_id->SetDBValue(trim($this->f("t_vat_reg_dtl_ppj_npl_id")));
        $this->DLink->SetDBValue($this->f("t_vat_reg_dtl_ppj_npl_id"));
        $this->ADLink->SetDBValue($this->f("t_vat_reg_dtl_ppj_id"));
        $this->power_capacity->SetDBValue(trim($this->f("power_capacity")));
        $this->t_vat_registration_id->SetDBValue(trim($this->f("t_vat_registration_id")));
        $this->description->SetDBValue($this->f("description"));
    }
//End SetValues Method

} //End t_vat_reg_dtl_ppj_nplGridDataSource Class @896-FCB6E20C

class clsGridt_vat_reg_dtl_hotel_srvcGrid { //t_vat_reg_dtl_hotel_srvcGrid class @915-804C3727

//Variables @915-AC1EDBB9

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

//Class_Initialize Event @915-A66AEB9D
    function clsGridt_vat_reg_dtl_hotel_srvcGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_dtl_hotel_srvcGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_dtl_hotel_srvcGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_dtl_hotel_srvcGridDataSource($this);
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

        $this->services = & new clsControl(ccsLabel, "services", "services", ccsText, "", CCGetRequestParam("services", ccsGet, NULL), $this);
        $this->t_vat_reg_dtl_hotel_srvc_id = & new clsControl(ccsHidden, "t_vat_reg_dtl_hotel_srvc_id", "t_vat_reg_dtl_hotel_srvc_id", ccsFloat, "", CCGetRequestParam("t_vat_reg_dtl_hotel_srvc_id", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @915-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @915-4F8EE868
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_vat_registration_id"] = CCGetFromGet("t_vat_registration_id", NULL);

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
            $this->ControlsVisible["services"] = $this->services->Visible;
            $this->ControlsVisible["t_vat_reg_dtl_hotel_srvc_id"] = $this->t_vat_reg_dtl_hotel_srvc_id->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["t_vat_registration_id"] = $this->t_vat_registration_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->services->SetValue($this->DataSource->services->GetValue());
                $this->t_vat_reg_dtl_hotel_srvc_id->SetValue($this->DataSource->t_vat_reg_dtl_hotel_srvc_id->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_vat_reg_dtl_hotel_srvc_id", $this->DataSource->f("t_vat_reg_dtl_hotel_srvc_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_vat_reg_dtl_hotel_srvc_id", $this->DataSource->f("t_vat_reg_dtl_hotel_srvc_id"));
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->t_vat_registration_id->SetValue($this->DataSource->t_vat_registration_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->services->Show();
                $this->t_vat_reg_dtl_hotel_srvc_id->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->description->Show();
                $this->t_vat_registration_id->Show();
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

//GetErrors Method @915-A2D1765A
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->services->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_reg_dtl_hotel_srvc_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_registration_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_dtl_hotel_srvcGrid Class @915-FCB6E20C

class clst_vat_reg_dtl_hotel_srvcGridDataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_hotel_srvcGridDataSource Class @915-7A5C8D37

//DataSource Variables @915-39B8C081
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $services;
    var $t_vat_reg_dtl_hotel_srvc_id;
    var $DLink;
    var $ADLink;
    var $description;
    var $t_vat_registration_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @915-1E00C9CD
    function clst_vat_reg_dtl_hotel_srvcGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_dtl_hotel_srvcGrid";
        $this->Initialize();
        $this->services = new clsField("services", ccsText, "");
        
        $this->t_vat_reg_dtl_hotel_srvc_id = new clsField("t_vat_reg_dtl_hotel_srvc_id", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @915-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @915-7C6FAA6C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_registration_id", ccsFloat, "", "", $this->Parameters["urlt_vat_registration_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_vat_registration_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @915-8AD9F515
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM t_vat_reg_dtl_hotel_srvc";
        $this->SQL = "SELECT * \n\n" .
        "FROM t_vat_reg_dtl_hotel_srvc {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @915-30323CCF
    function SetValues()
    {
        $this->services->SetDBValue($this->f("services"));
        $this->t_vat_reg_dtl_hotel_srvc_id->SetDBValue(trim($this->f("t_vat_reg_dtl_hotel_srvc_id")));
        $this->DLink->SetDBValue($this->f("t_vat_reg_dtl_hotel_srvc_id"));
        $this->ADLink->SetDBValue($this->f("t_vat_reg_dtl_hotel_srvc_id"));
        $this->description->SetDBValue($this->f("description"));
        $this->t_vat_registration_id->SetDBValue(trim($this->f("t_vat_registration_id")));
    }
//End SetValues Method

} //End t_vat_reg_dtl_hotel_srvcGridDataSource Class @915-FCB6E20C

class clsGridt_vat_reg_employeeGrid { //t_vat_reg_employeeGrid class @952-B79C6852

//Variables @952-AC1EDBB9

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

//Class_Initialize Event @952-DE28477B
    function clsGridt_vat_reg_employeeGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_employeeGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_employeeGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_employeeGridDataSource($this);
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

        $this->jabatan = & new clsControl(ccsLabel, "jabatan", "jabatan", ccsText, "", CCGetRequestParam("jabatan", ccsGet, NULL), $this);
        $this->t_vat_reg_employee_id = & new clsControl(ccsHidden, "t_vat_reg_employee_id", "t_vat_reg_employee_id", ccsFloat, "", CCGetRequestParam("t_vat_reg_employee_id", ccsGet, NULL), $this);
        $this->employee_qty = & new clsControl(ccsLabel, "employee_qty", "employee_qty", ccsFloat, "", CCGetRequestParam("employee_qty", ccsGet, NULL), $this);
        $this->employee_salery = & new clsControl(ccsLabel, "employee_salery", "employee_salery", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("employee_salery", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "t_vat_reg_dtl_ro_bap.php";
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @952-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @952-3B046A33
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_vat_registration_id"] = CCGetFromGet("t_vat_registration_id", NULL);

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
            $this->ControlsVisible["jabatan"] = $this->jabatan->Visible;
            $this->ControlsVisible["t_vat_reg_employee_id"] = $this->t_vat_reg_employee_id->Visible;
            $this->ControlsVisible["employee_qty"] = $this->employee_qty->Visible;
            $this->ControlsVisible["employee_salery"] = $this->employee_salery->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["t_vat_registration_id"] = $this->t_vat_registration_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->jabatan->SetValue($this->DataSource->jabatan->GetValue());
                $this->t_vat_reg_employee_id->SetValue($this->DataSource->t_vat_reg_employee_id->GetValue());
                $this->employee_qty->SetValue($this->DataSource->employee_qty->GetValue());
                $this->employee_salery->SetValue($this->DataSource->employee_salery->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_vat_reg_employee_id", $this->DataSource->f("t_vat_reg_employee_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_vat_reg_employee_id", $this->DataSource->f("t_vat_reg_employee_id"));
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->t_vat_registration_id->SetValue($this->DataSource->t_vat_registration_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->jabatan->Show();
                $this->t_vat_reg_employee_id->Show();
                $this->employee_qty->Show();
                $this->employee_salery->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->description->Show();
                $this->t_vat_registration_id->Show();
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

//GetErrors Method @952-6261AC2E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->jabatan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_reg_employee_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->employee_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->employee_salery->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_registration_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_employeeGrid Class @952-FCB6E20C

class clst_vat_reg_employeeGridDataSource extends clsDBConnSIKP {  //t_vat_reg_employeeGridDataSource Class @952-785B9916

//DataSource Variables @952-BC7AECF5
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $jabatan;
    var $t_vat_reg_employee_id;
    var $employee_qty;
    var $employee_salery;
    var $DLink;
    var $ADLink;
    var $description;
    var $t_vat_registration_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @952-928FD6F7
    function clst_vat_reg_employeeGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_employeeGrid";
        $this->Initialize();
        $this->jabatan = new clsField("jabatan", ccsText, "");
        
        $this->t_vat_reg_employee_id = new clsField("t_vat_reg_employee_id", ccsFloat, "");
        
        $this->employee_qty = new clsField("employee_qty", ccsFloat, "");
        
        $this->employee_salery = new clsField("employee_salery", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @952-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @952-7C6FAA6C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_registration_id", ccsFloat, "", "", $this->Parameters["urlt_vat_registration_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_vat_registration_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @952-D6E30CDD
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_vat_reg_employee";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_vat_reg_employee {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @952-B837B5B1
    function SetValues()
    {
        $this->jabatan->SetDBValue($this->f("jabatan"));
        $this->t_vat_reg_employee_id->SetDBValue(trim($this->f("t_vat_reg_employee_id")));
        $this->employee_qty->SetDBValue(trim($this->f("employee_qty")));
        $this->employee_salery->SetDBValue(trim($this->f("employee_salery")));
        $this->DLink->SetDBValue($this->f("t_vat_reg_employee_id"));
        $this->ADLink->SetDBValue($this->f("t_vat_reg_employee_id"));
        $this->description->SetDBValue($this->f("description"));
        $this->t_vat_registration_id->SetDBValue(trim($this->f("t_vat_registration_id")));
    }
//End SetValues Method

} //End t_vat_reg_employeeGridDataSource Class @952-FCB6E20C

//Initialize Page @1-D25CD019
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
$TemplateFileName = "t_vat_reg_dtl_ro_bap.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-ABAD0B41
include_once("./t_vat_reg_dtl_ro_bap_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9D0E7BFA
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_vat_reg_dtlGrid = & new clsGridt_vat_reg_dtlGrid("", $MainPage);
$t_vat_reg_dtlSearch = & new clsRecordt_vat_reg_dtlSearch("", $MainPage);
$t_vat_reg_dtl_restaurantGrid = & new clsGridt_vat_reg_dtl_restaurantGrid("", $MainPage);
$t_vat_reg_dtl_hotelGrid1 = & new clsGridt_vat_reg_dtl_hotelGrid1("", $MainPage);
$v_vat_reg_dtl_entertaintmentGrid = & new clsGridv_vat_reg_dtl_entertaintmentGrid("", $MainPage);
$t_vat_reg_dtl_parkingGrid = & new clsGridt_vat_reg_dtl_parkingGrid("", $MainPage);
$t_vat_reg_dtl_ppjGrid = & new clsGridt_vat_reg_dtl_ppjGrid("", $MainPage);
$t_vat_reg_dtl_ppj_nplGrid = & new clsGridt_vat_reg_dtl_ppj_nplGrid("", $MainPage);
$t_vat_reg_dtl_hotel_srvcGrid = & new clsGridt_vat_reg_dtl_hotel_srvcGrid("", $MainPage);
$t_vat_reg_employeeGrid = & new clsGridt_vat_reg_employeeGrid("", $MainPage);
$MainPage->t_vat_reg_dtlGrid = & $t_vat_reg_dtlGrid;
$MainPage->t_vat_reg_dtlSearch = & $t_vat_reg_dtlSearch;
$MainPage->t_vat_reg_dtl_restaurantGrid = & $t_vat_reg_dtl_restaurantGrid;
$MainPage->t_vat_reg_dtl_hotelGrid1 = & $t_vat_reg_dtl_hotelGrid1;
$MainPage->v_vat_reg_dtl_entertaintmentGrid = & $v_vat_reg_dtl_entertaintmentGrid;
$MainPage->t_vat_reg_dtl_parkingGrid = & $t_vat_reg_dtl_parkingGrid;
$MainPage->t_vat_reg_dtl_ppjGrid = & $t_vat_reg_dtl_ppjGrid;
$MainPage->t_vat_reg_dtl_ppj_nplGrid = & $t_vat_reg_dtl_ppj_nplGrid;
$MainPage->t_vat_reg_dtl_hotel_srvcGrid = & $t_vat_reg_dtl_hotel_srvcGrid;
$MainPage->t_vat_reg_employeeGrid = & $t_vat_reg_employeeGrid;
$t_vat_reg_dtlGrid->Initialize();
$t_vat_reg_dtl_restaurantGrid->Initialize();
$t_vat_reg_dtl_hotelGrid1->Initialize();
$v_vat_reg_dtl_entertaintmentGrid->Initialize();
$t_vat_reg_dtl_parkingGrid->Initialize();
$t_vat_reg_dtl_ppjGrid->Initialize();
$t_vat_reg_dtl_ppj_nplGrid->Initialize();
$t_vat_reg_dtl_hotel_srvcGrid->Initialize();
$t_vat_reg_employeeGrid->Initialize();

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

//Execute Components @1-6B50B969
$t_vat_reg_dtlSearch->Operation();
//End Execute Components

//Go to destination page @1-7EAC6801
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_vat_reg_dtlGrid);
    unset($t_vat_reg_dtlSearch);
    unset($t_vat_reg_dtl_restaurantGrid);
    unset($t_vat_reg_dtl_hotelGrid1);
    unset($v_vat_reg_dtl_entertaintmentGrid);
    unset($t_vat_reg_dtl_parkingGrid);
    unset($t_vat_reg_dtl_ppjGrid);
    unset($t_vat_reg_dtl_ppj_nplGrid);
    unset($t_vat_reg_dtl_hotel_srvcGrid);
    unset($t_vat_reg_employeeGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-CA1B0417
$t_vat_reg_dtlGrid->Show();
$t_vat_reg_dtlSearch->Show();
$t_vat_reg_dtl_restaurantGrid->Show();
$t_vat_reg_dtl_hotelGrid1->Show();
$v_vat_reg_dtl_entertaintmentGrid->Show();
$t_vat_reg_dtl_parkingGrid->Show();
$t_vat_reg_dtl_ppjGrid->Show();
$t_vat_reg_dtl_ppj_nplGrid->Show();
$t_vat_reg_dtl_hotel_srvcGrid->Show();
$t_vat_reg_employeeGrid->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-66C25A0D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_vat_reg_dtlGrid);
unset($t_vat_reg_dtlSearch);
unset($t_vat_reg_dtl_restaurantGrid);
unset($t_vat_reg_dtl_hotelGrid1);
unset($v_vat_reg_dtl_entertaintmentGrid);
unset($t_vat_reg_dtl_parkingGrid);
unset($t_vat_reg_dtl_ppjGrid);
unset($t_vat_reg_dtl_ppj_nplGrid);
unset($t_vat_reg_dtl_hotel_srvcGrid);
unset($t_vat_reg_employeeGrid);
unset($Tpl);
//End Unload Page


?>
