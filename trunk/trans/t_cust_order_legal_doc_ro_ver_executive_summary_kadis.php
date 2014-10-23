<?php
//Include Common Files @1-B3E9E805
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_cust_order_legal_doc_ro_ver_executive_summary_kadis.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_cust_order_legal_docGrid { //t_cust_order_legal_docGrid class @2-FB566447

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

//Class_Initialize Event @2-49E476A4
    function clsGridt_cust_order_legal_docGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_cust_order_legal_docGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_cust_order_legal_docGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_cust_order_legal_docGridDataSource($this);
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
        $this->DLink->Page = "t_cust_order_legal_doc_ro_ver_executive_summary_kadis.php";
        $this->origin_file_name = & new clsControl(ccsLink, "origin_file_name", "origin_file_name", ccsText, "", CCGetRequestParam("origin_file_name", ccsGet, NULL), $this);
        $this->origin_file_name->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->t_cust_order_legal_doc_id = & new clsControl(ccsHidden, "t_cust_order_legal_doc_id", "t_cust_order_legal_doc_id", ccsFloat, "", CCGetRequestParam("t_cust_order_legal_doc_id", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->legal_doc_desc = & new clsControl(ccsLabel, "legal_doc_desc", "legal_doc_desc", ccsText, "", CCGetRequestParam("legal_doc_desc", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "t_cust_order_legal_doc_ro_ver_executive_summary_kadis.php";
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

//Show Method @2-DB7DD22C
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["urlt_customer_order_id"] = CCGetFromGet("t_customer_order_id", NULL);

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
            $this->ControlsVisible["origin_file_name"] = $this->origin_file_name->Visible;
            $this->ControlsVisible["t_cust_order_legal_doc_id"] = $this->t_cust_order_legal_doc_id->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["legal_doc_desc"] = $this->legal_doc_desc->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_cust_order_legal_doc_id", $this->DataSource->f("t_cust_order_legal_doc_id"));
                $this->origin_file_name->SetValue($this->DataSource->origin_file_name->GetValue());
                $this->origin_file_name->Page = $this->DataSource->f("file_name");
                $this->t_cust_order_legal_doc_id->SetValue($this->DataSource->t_cust_order_legal_doc_id->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->legal_doc_desc->SetValue($this->DataSource->legal_doc_desc->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->origin_file_name->Show();
                $this->t_cust_order_legal_doc_id->Show();
                $this->description->Show();
                $this->legal_doc_desc->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("t_cust_order_legal_doc_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-9DF559CF
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->origin_file_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_order_legal_doc_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->legal_doc_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_cust_order_legal_docGrid Class @2-FCB6E20C

class clst_cust_order_legal_docGridDataSource extends clsDBConnSIKP {  //t_cust_order_legal_docGridDataSource Class @2-740F03BB

//DataSource Variables @2-F0347373
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $origin_file_name;
    var $t_cust_order_legal_doc_id;
    var $description;
    var $legal_doc_desc;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-81FCAB9B
    function clst_cust_order_legal_docGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_cust_order_legal_docGrid";
        $this->Initialize();
        $this->origin_file_name = new clsField("origin_file_name", ccsText, "");
        
        $this->t_cust_order_legal_doc_id = new clsField("t_cust_order_legal_doc_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->legal_doc_desc = new clsField("legal_doc_desc", ccsText, "");
        

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

//Prepare Method @2-B41DB33F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urlt_customer_order_id", ccsFloat, "", "", $this->Parameters["urlt_customer_order_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "legal_doc_desc", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "t_customer_order_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsFloat),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-8A09D898
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM t_cust_order_legal_doc";
        $this->SQL = "SELECT * \n\n" .
        "FROM t_cust_order_legal_doc {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-D925881E
    function SetValues()
    {
        $this->origin_file_name->SetDBValue($this->f("origin_file_name"));
        $this->t_cust_order_legal_doc_id->SetDBValue(trim($this->f("t_cust_order_legal_doc_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->legal_doc_desc->SetDBValue($this->f("legal_doc_desc"));
    }
//End SetValues Method

} //End t_cust_order_legal_docGridDataSource Class @2-FCB6E20C

class clsRecordt_cust_order_legal_docSearch { //t_cust_order_legal_docSearch Class @3-FB106732

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

//Class_Initialize Event @3-A8072C6E
    function clsRecordt_cust_order_legal_docSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_cust_order_legal_docSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_cust_order_legal_docSearch";
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
            $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsFloat, "", CCGetRequestParam("t_customer_order_id", $Method, NULL), $this);
            $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", $Method, NULL), $this);
            $this->rqst_type_code = & new clsControl(ccsHidden, "rqst_type_code", "rqst_type_code", ccsText, "", CCGetRequestParam("rqst_type_code", $Method, NULL), $this);
            $this->p_rqst_type_id = & new clsControl(ccsHidden, "p_rqst_type_id", "p_rqst_type_id", ccsFloat, "", CCGetRequestParam("p_rqst_type_id", $Method, NULL), $this);
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

//Validate Method @3-AFF54661
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->t_customer_order_id->Validate() && $Validation);
        $Validation = ($this->t_vat_registration_id->Validate() && $Validation);
        $Validation = ($this->rqst_type_code->Validate() && $Validation);
        $Validation = ($this->p_rqst_type_id->Validate() && $Validation);
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
        $Validation =  $Validation && ($this->t_customer_order_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_vat_registration_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rqst_type_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rqst_type_id->Errors->Count() == 0);
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

//CheckErrors Method @3-1A7BAE9B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->t_customer_order_id->Errors->Count());
        $errors = ($errors || $this->t_vat_registration_id->Errors->Count());
        $errors = ($errors || $this->rqst_type_code->Errors->Count());
        $errors = ($errors || $this->p_rqst_type_id->Errors->Count());
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

//Operation Method @3-14176F26
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
        $Redirect = "t_cust_order_legal_doc_ro_ver_executive_summary_kadis.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_cust_order_legal_doc_ro_ver_executive_summary_kadis.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-7D19CA25
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
            $Error = ComposeStrings($Error, $this->t_customer_order_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_vat_registration_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rqst_type_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rqst_type_id->Errors->ToString());
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

        $this->s_keyword->Show();
        $this->Button_DoSearch->Show();
        $this->t_customer_order_id->Show();
        $this->t_vat_registration_id->Show();
        $this->rqst_type_code->Show();
        $this->p_rqst_type_id->Show();
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

} //End t_cust_order_legal_docSearch Class @3-FCB6E20C

class clsRecordt_cust_order_legal_docForm { //t_cust_order_legal_docForm Class @94-28158D89

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

//Class_Initialize Event @94-CFA39B15
    function clsRecordt_cust_order_legal_docForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_cust_order_legal_docForm/Error";
        $this->DataSource = new clst_cust_order_legal_docFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_cust_order_legal_docForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "multipart/form-data";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->t_cust_order_legal_doc_id = & new clsControl(ccsHidden, "t_cust_order_legal_doc_id", "Id", ccsFloat, "", CCGetRequestParam("t_cust_order_legal_doc_id", $Method, NULL), $this);
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->t_cust_order_legal_docGridPage = & new clsControl(ccsHidden, "t_cust_order_legal_docGridPage", "t_cust_order_legal_docGridPage", ccsText, "", CCGetRequestParam("t_cust_order_legal_docGridPage", $Method, NULL), $this);
            $this->legal_doc_desc = & new clsControl(ccsTextBox, "legal_doc_desc", "Jenis Dokumen", ccsText, "", CCGetRequestParam("legal_doc_desc", $Method, NULL), $this);
            $this->legal_doc_desc->Required = true;
            $this->p_legal_doc_type_id = & new clsControl(ccsHidden, "p_legal_doc_type_id", "p_legal_doc_type_id", ccsFloat, "", CCGetRequestParam("p_legal_doc_type_id", $Method, NULL), $this);
            $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsFloat, "", CCGetRequestParam("t_customer_order_id", $Method, NULL), $this);
            $this->file_folder = & new clsControl(ccsHidden, "file_folder", "file_folder", ccsText, "", CCGetRequestParam("file_folder", $Method, NULL), $this);
            $this->origin_file_name = & new clsControl(ccsHidden, "origin_file_name", "origin_file_name", ccsText, "", CCGetRequestParam("origin_file_name", $Method, NULL), $this);
            $this->file_name = & new clsFileUpload("file_name", "file_name", "../files_tmp/", "../files/", "*", "", 2000000, $this);
            $this->Button1 = & new clsButton("Button1", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-880218C1
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_cust_order_legal_doc_id"] = CCGetFromGet("t_cust_order_legal_doc_id", NULL);
    }
//End Initialize Method

//Validate Method @94-96F35655
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_cust_order_legal_doc_id->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->t_cust_order_legal_docGridPage->Validate() && $Validation);
        $Validation = ($this->legal_doc_desc->Validate() && $Validation);
        $Validation = ($this->p_legal_doc_type_id->Validate() && $Validation);
        $Validation = ($this->t_customer_order_id->Validate() && $Validation);
        $Validation = ($this->file_folder->Validate() && $Validation);
        $Validation = ($this->origin_file_name->Validate() && $Validation);
        $Validation = ($this->file_name->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_cust_order_legal_doc_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_order_legal_docGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->legal_doc_desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_legal_doc_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_order_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->file_folder->Errors->Count() == 0);
        $Validation =  $Validation && ($this->origin_file_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->file_name->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-5CF1E4F8
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_cust_order_legal_doc_id->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->t_cust_order_legal_docGridPage->Errors->Count());
        $errors = ($errors || $this->legal_doc_desc->Errors->Count());
        $errors = ($errors || $this->p_legal_doc_type_id->Errors->Count());
        $errors = ($errors || $this->t_customer_order_id->Errors->Count());
        $errors = ($errors || $this->file_folder->Errors->Count());
        $errors = ($errors || $this->origin_file_name->Errors->Count());
        $errors = ($errors || $this->file_name->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
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

//Operation Method @94-01C57536
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

        $this->file_name->Upload();

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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "s_keyword", "t_cust_order_legal_doc_id", "t_cust_order_legal_docGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "s_keyword", "t_cust_order_legal_doc_id", "t_cust_order_legal_docGridPage"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
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

//InsertRow Method @94-6A6E7F7E
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->legal_doc_desc->SetValue($this->legal_doc_desc->GetValue(true));
        $this->DataSource->p_legal_doc_type_id->SetValue($this->p_legal_doc_type_id->GetValue(true));
        $this->DataSource->t_customer_order_id->SetValue($this->t_customer_order_id->GetValue(true));
        $this->DataSource->file_name->SetValue($this->file_name->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->file_name->Move();
        }
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-F224C994
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_cust_order_legal_doc_id->SetValue($this->t_cust_order_legal_doc_id->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->legal_doc_desc->SetValue($this->legal_doc_desc->GetValue(true));
        $this->DataSource->p_legal_doc_type_id->SetValue($this->p_legal_doc_type_id->GetValue(true));
        $this->DataSource->t_customer_order_id->SetValue($this->t_customer_order_id->GetValue(true));
        $this->DataSource->file_name->SetValue($this->file_name->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->file_name->Move();
        }
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-47A7D0F6
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_cust_order_legal_doc_id->SetValue($this->t_cust_order_legal_doc_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->file_name->Delete();
        }
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-4CF13780
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
                    $this->t_cust_order_legal_doc_id->SetValue($this->DataSource->t_cust_order_legal_doc_id->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->legal_doc_desc->SetValue($this->DataSource->legal_doc_desc->GetValue());
                    $this->p_legal_doc_type_id->SetValue($this->DataSource->p_legal_doc_type_id->GetValue());
                    $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                    $this->file_folder->SetValue($this->DataSource->file_folder->GetValue());
                    $this->origin_file_name->SetValue($this->DataSource->origin_file_name->GetValue());
                    $this->file_name->SetValue($this->DataSource->file_name->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_cust_order_legal_doc_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cust_order_legal_docGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->legal_doc_desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_legal_doc_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_order_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->file_folder->Errors->ToString());
            $Error = ComposeStrings($Error, $this->origin_file_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->file_name->Errors->ToString());
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
        $this->t_cust_order_legal_doc_id->Show();
        $this->description->Show();
        $this->created_by->Show();
        $this->updated_by->Show();
        $this->creation_date->Show();
        $this->updated_date->Show();
        $this->t_cust_order_legal_docGridPage->Show();
        $this->legal_doc_desc->Show();
        $this->p_legal_doc_type_id->Show();
        $this->t_customer_order_id->Show();
        $this->file_folder->Show();
        $this->origin_file_name->Show();
        $this->file_name->Show();
        $this->Button1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_cust_order_legal_docForm Class @94-FCB6E20C

class clst_cust_order_legal_docFormDataSource extends clsDBConnSIKP {  //t_cust_order_legal_docFormDataSource Class @94-2B38954F

//DataSource Variables @94-1BAFCC62
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $t_cust_order_legal_doc_id;
    var $description;
    var $created_by;
    var $updated_by;
    var $creation_date;
    var $updated_date;
    var $t_cust_order_legal_docGridPage;
    var $legal_doc_desc;
    var $p_legal_doc_type_id;
    var $t_customer_order_id;
    var $file_folder;
    var $origin_file_name;
    var $file_name;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-CAFAD541
    function clst_cust_order_legal_docFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_cust_order_legal_docForm/Error";
        $this->Initialize();
        $this->t_cust_order_legal_doc_id = new clsField("t_cust_order_legal_doc_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->t_cust_order_legal_docGridPage = new clsField("t_cust_order_legal_docGridPage", ccsText, "");
        
        $this->legal_doc_desc = new clsField("legal_doc_desc", ccsText, "");
        
        $this->p_legal_doc_type_id = new clsField("p_legal_doc_type_id", ccsFloat, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsFloat, "");
        
        $this->file_folder = new clsField("file_folder", ccsText, "");
        
        $this->origin_file_name = new clsField("origin_file_name", ccsText, "");
        
        $this->file_name = new clsField("file_name", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-451BAED1
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_order_legal_doc_id", ccsFloat, "", "", $this->Parameters["urlt_cust_order_legal_doc_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-4C99EB93
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT t_cust_order_legal_doc_id, t_customer_order_id, p_legal_doc_type_id, \n" .
        "legal_doc_desc, origin_file_name, \n" .
        "file_folder, description,\n" .
        "file_name, to_char(creation_date, 'DD-MON-YYYY')as creation_date, \n" .
        "created_by, to_char(updated_date,'DD-MON-YYYY')as updated_date, updated_by \n" .
        "FROM t_cust_order_legal_doc\n" .
        "WHERE t_cust_order_legal_doc_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-95511FDB
    function SetValues()
    {
        $this->t_cust_order_legal_doc_id->SetDBValue(trim($this->f("t_cust_order_legal_doc_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->legal_doc_desc->SetDBValue($this->f("legal_doc_desc"));
        $this->p_legal_doc_type_id->SetDBValue(trim($this->f("p_legal_doc_type_id")));
        $this->t_customer_order_id->SetDBValue(trim($this->f("t_customer_order_id")));
        $this->file_folder->SetDBValue($this->f("file_folder"));
        $this->origin_file_name->SetDBValue($this->f("origin_file_name"));
        $this->file_name->SetDBValue($this->f("file_name"));
    }
//End SetValues Method

//Insert Method @94-520A1ACA
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr639", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr640", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["legal_doc_desc"] = new clsSQLParameter("ctrllegal_doc_desc", ccsText, "", "", $this->legal_doc_desc->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_legal_doc_type_id"] = new clsSQLParameter("ctrlp_legal_doc_type_id", ccsFloat, "", "", $this->p_legal_doc_type_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_customer_order_id"] = new clsSQLParameter("ctrlt_customer_order_id", ccsFloat, "", "", $this->t_customer_order_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["file_name"] = new clsSQLParameter("ctrlfile_name", ccsText, "", "", $this->file_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["file_folder"] = new clsSQLParameter("expr649", ccsText, "", "", files, "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["legal_doc_desc"]->GetValue()) and !strlen($this->cp["legal_doc_desc"]->GetText()) and !is_bool($this->cp["legal_doc_desc"]->GetValue())) 
            $this->cp["legal_doc_desc"]->SetValue($this->legal_doc_desc->GetValue(true));
        if (!is_null($this->cp["p_legal_doc_type_id"]->GetValue()) and !strlen($this->cp["p_legal_doc_type_id"]->GetText()) and !is_bool($this->cp["p_legal_doc_type_id"]->GetValue())) 
            $this->cp["p_legal_doc_type_id"]->SetValue($this->p_legal_doc_type_id->GetValue(true));
        if (!is_null($this->cp["t_customer_order_id"]->GetValue()) and !strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue())) 
            $this->cp["t_customer_order_id"]->SetValue($this->t_customer_order_id->GetValue(true));
        if (!is_null($this->cp["file_name"]->GetValue()) and !strlen($this->cp["file_name"]->GetText()) and !is_bool($this->cp["file_name"]->GetValue())) 
            $this->cp["file_name"]->SetValue($this->file_name->GetValue(true));
        if (!is_null($this->cp["file_folder"]->GetValue()) and !strlen($this->cp["file_folder"]->GetText()) and !is_bool($this->cp["file_folder"]->GetValue())) 
            $this->cp["file_folder"]->SetValue(files);
        $this->SQL = "INSERT INTO t_cust_order_legal_doc(t_cust_order_legal_doc_id, description, created_by, updated_by, creation_date, updated_date, p_legal_doc_type_id, t_customer_order_id, origin_file_name, file_folder, file_name, legal_doc_desc) \n" .
        "VALUES(generate_id('sikp','t_cust_order_legal_doc','t_cust_order_legal_doc_id'), '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', sysdate, sysdate, " . $this->SQLValue($this->cp["p_legal_doc_type_id"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["t_customer_order_id"]->GetDBValue(), ccsFloat) . ", substr('" . $this->SQLValue($this->cp["file_name"]->GetDBValue(), ccsText) . "',17),'" . $this->SQLValue($this->cp["file_folder"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["file_name"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["legal_doc_desc"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-F56BEC5F
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_cust_order_legal_doc_id"] = new clsSQLParameter("ctrlt_cust_order_legal_doc_id", ccsFloat, "", "", $this->t_cust_order_legal_doc_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr666", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["legal_doc_desc"] = new clsSQLParameter("ctrllegal_doc_desc", ccsText, "", "", $this->legal_doc_desc->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_legal_doc_type_id"] = new clsSQLParameter("ctrlp_legal_doc_type_id", ccsFloat, "", "", $this->p_legal_doc_type_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_customer_order_id"] = new clsSQLParameter("ctrlt_customer_order_id", ccsFloat, "", "", $this->t_customer_order_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["file_name"] = new clsSQLParameter("ctrlfile_name", ccsText, "", "", $this->file_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["file_folder"] = new clsSQLParameter("expr673", ccsText, "", "", files, "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_cust_order_legal_doc_id"]->GetValue()) and !strlen($this->cp["t_cust_order_legal_doc_id"]->GetText()) and !is_bool($this->cp["t_cust_order_legal_doc_id"]->GetValue())) 
            $this->cp["t_cust_order_legal_doc_id"]->SetValue($this->t_cust_order_legal_doc_id->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["legal_doc_desc"]->GetValue()) and !strlen($this->cp["legal_doc_desc"]->GetText()) and !is_bool($this->cp["legal_doc_desc"]->GetValue())) 
            $this->cp["legal_doc_desc"]->SetValue($this->legal_doc_desc->GetValue(true));
        if (!is_null($this->cp["p_legal_doc_type_id"]->GetValue()) and !strlen($this->cp["p_legal_doc_type_id"]->GetText()) and !is_bool($this->cp["p_legal_doc_type_id"]->GetValue())) 
            $this->cp["p_legal_doc_type_id"]->SetValue($this->p_legal_doc_type_id->GetValue(true));
        if (!is_null($this->cp["t_customer_order_id"]->GetValue()) and !strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue())) 
            $this->cp["t_customer_order_id"]->SetValue($this->t_customer_order_id->GetValue(true));
        if (!is_null($this->cp["file_name"]->GetValue()) and !strlen($this->cp["file_name"]->GetText()) and !is_bool($this->cp["file_name"]->GetValue())) 
            $this->cp["file_name"]->SetValue($this->file_name->GetValue(true));
        if (!is_null($this->cp["file_folder"]->GetValue()) and !strlen($this->cp["file_folder"]->GetText()) and !is_bool($this->cp["file_folder"]->GetValue())) 
            $this->cp["file_folder"]->SetValue(files);
        $this->SQL = "UPDATE t_cust_order_legal_doc SET \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "legal_doc_desc='" . $this->SQLValue($this->cp["legal_doc_desc"]->GetDBValue(), ccsText) . "', \n" .
        "p_legal_doc_type_id=" . $this->SQLValue($this->cp["p_legal_doc_type_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "t_customer_order_id=" . $this->SQLValue($this->cp["t_customer_order_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "origin_file_name=substr('" . $this->SQLValue($this->cp["file_name"]->GetDBValue(), ccsText) . "',17), \n" .
        "file_folder='" . $this->SQLValue($this->cp["file_folder"]->GetDBValue(), ccsText) . "', \n" .
        "file_name='" . $this->SQLValue($this->cp["file_name"]->GetDBValue(), ccsText) . "'\n" .
        "WHERE t_cust_order_legal_doc_id=" . $this->SQLValue($this->cp["t_cust_order_legal_doc_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-2E38A93F
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_cust_order_legal_doc_id"] = new clsSQLParameter("ctrlt_cust_order_legal_doc_id", ccsFloat, "", "", $this->t_cust_order_legal_doc_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_cust_order_legal_doc_id"]->GetValue()) and !strlen($this->cp["t_cust_order_legal_doc_id"]->GetText()) and !is_bool($this->cp["t_cust_order_legal_doc_id"]->GetValue())) 
            $this->cp["t_cust_order_legal_doc_id"]->SetValue($this->t_cust_order_legal_doc_id->GetValue(true));
        if (!strlen($this->cp["t_cust_order_legal_doc_id"]->GetText()) and !is_bool($this->cp["t_cust_order_legal_doc_id"]->GetValue(true))) 
            $this->cp["t_cust_order_legal_doc_id"]->SetText(0);
        $this->SQL = "DELETE FROM t_cust_order_legal_doc\n" .
        "WHERE t_cust_order_legal_doc_id = " . $this->SQLValue($this->cp["t_cust_order_legal_doc_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_cust_order_legal_docFormDataSource Class @94-FCB6E20C

//Initialize Page @1-E215A76A
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
$TemplateFileName = "t_cust_order_legal_doc_ro_ver_executive_summary_kadis.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-84CF385B
include_once("./t_cust_order_legal_doc_ro_ver_executive_summary_kadis_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-B3231530
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_cust_order_legal_docGrid = & new clsGridt_cust_order_legal_docGrid("", $MainPage);
$t_cust_order_legal_docSearch = & new clsRecordt_cust_order_legal_docSearch("", $MainPage);
$t_cust_order_legal_docForm = & new clsRecordt_cust_order_legal_docForm("", $MainPage);
$MainPage->t_cust_order_legal_docGrid = & $t_cust_order_legal_docGrid;
$MainPage->t_cust_order_legal_docSearch = & $t_cust_order_legal_docSearch;
$MainPage->t_cust_order_legal_docForm = & $t_cust_order_legal_docForm;
$t_cust_order_legal_docGrid->Initialize();
$t_cust_order_legal_docForm->Initialize();

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

//Execute Components @1-0C3361C7
$t_cust_order_legal_docSearch->Operation();
$t_cust_order_legal_docForm->Operation();
//End Execute Components

//Go to destination page @1-27B91A00
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_cust_order_legal_docGrid);
    unset($t_cust_order_legal_docSearch);
    unset($t_cust_order_legal_docForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-872D3C71
$t_cust_order_legal_docGrid->Show();
$t_cust_order_legal_docSearch->Show();
$t_cust_order_legal_docForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-328A5BCB
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_cust_order_legal_docGrid);
unset($t_cust_order_legal_docSearch);
unset($t_cust_order_legal_docForm);
unset($Tpl);
//End Unload Page


?>
