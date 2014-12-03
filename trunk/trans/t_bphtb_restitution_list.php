<?php
//Include Common Files @1-F77D65AE
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_bphtb_restitution_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_bphtb_registration_list { //t_bphtb_registration_list class @2-DBD5C862

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

//Class_Initialize Event @2-35FEDDD2
    function clsGridt_bphtb_registration_list($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_bphtb_registration_list";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_bphtb_registration_list";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_bphtb_registration_listDataSource($this);
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

        $this->wp_name = & new clsControl(ccsLabel, "wp_name", "wp_name", ccsText, "", CCGetRequestParam("wp_name", ccsGet, NULL), $this);
        $this->origin_file_name = & new clsControl(ccsLink, "origin_file_name", "origin_file_name", ccsText, "", CCGetRequestParam("origin_file_name", ccsGet, NULL), $this);
        $this->origin_file_name->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_bphtb_restitution_list.php";
        $this->t_bphtb_registration_id = & new clsControl(ccsLabel, "t_bphtb_registration_id", "t_bphtb_registration_id", ccsText, "", CCGetRequestParam("t_bphtb_registration_id", ccsGet, NULL), $this);
        $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsText, "", CCGetRequestParam("t_customer_order_id", ccsGet, NULL), $this);
        $this->njop_pbb = & new clsControl(ccsLabel, "njop_pbb", "njop_pbb", ccsText, "", CCGetRequestParam("njop_pbb", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
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

//Show Method @2-1387F774
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);

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
            $this->ControlsVisible["wp_name"] = $this->wp_name->Visible;
            $this->ControlsVisible["origin_file_name"] = $this->origin_file_name->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["t_bphtb_registration_id"] = $this->t_bphtb_registration_id->Visible;
            $this->ControlsVisible["t_customer_order_id"] = $this->t_customer_order_id->Visible;
            $this->ControlsVisible["njop_pbb"] = $this->njop_pbb->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                $this->origin_file_name->SetValue($this->DataSource->origin_file_name->GetValue());
                $this->origin_file_name->Page = $this->DataSource->f("file_name");
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_bphtb_registration_id", $this->DataSource->f("t_bphtb_registration_id"));
                $this->t_bphtb_registration_id->SetValue($this->DataSource->t_bphtb_registration_id->GetValue());
                $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                $this->njop_pbb->SetValue($this->DataSource->njop_pbb->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->wp_name->Show();
                $this->origin_file_name->Show();
                $this->DLink->Show();
                $this->t_bphtb_registration_id->Show();
                $this->t_customer_order_id->Show();
                $this->njop_pbb->Show();
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

//GetErrors Method @2-8B2269BE
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->wp_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->origin_file_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_bphtb_registration_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_customer_order_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->njop_pbb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_bphtb_registration_list Class @2-FCB6E20C

class clst_bphtb_registration_listDataSource extends clsDBConnSIKP {  //t_bphtb_registration_listDataSource Class @2-07378C2F

//DataSource Variables @2-8F623866
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $wp_name;
    var $origin_file_name;
    var $t_bphtb_registration_id;
    var $t_customer_order_id;
    var $njop_pbb;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-C4C36C4D
    function clst_bphtb_registration_listDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_bphtb_registration_list";
        $this->Initialize();
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->origin_file_name = new clsField("origin_file_name", ccsText, "");
        
        $this->t_bphtb_registration_id = new clsField("t_bphtb_registration_id", ccsText, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsText, "");
        
        $this->njop_pbb = new clsField("njop_pbb", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-0390F970
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "regis.t_bphtb_registration_id DESC";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-25AA94A2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
    }
//End Prepare Method

//Open Method @2-756E49ED
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select cust_order.*,regis.* from t_bphtb_registration regis\n" .
        "LEFT JOIN t_customer_order cust_order on regis.t_customer_order_id = cust_order.t_customer_order_id\n" .
        "where\n" .
        "(cust_order.order_no ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' OR\n" .
        "regis.wp_name ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') \n" .
        "AND cust_order.p_order_status_id = 3) cnt";
        $this->SQL = "select cust_order.*,regis.* from t_bphtb_registration regis\n" .
        "LEFT JOIN t_customer_order cust_order on regis.t_customer_order_id = cust_order.t_customer_order_id\n" .
        "where\n" .
        "(cust_order.order_no ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' OR\n" .
        "regis.wp_name ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') \n" .
        "AND cust_order.p_order_status_id = 3{SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-2F02AB21
    function SetValues()
    {
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->origin_file_name->SetDBValue($this->f("order_no"));
        $this->t_bphtb_registration_id->SetDBValue($this->f("t_bphtb_registration_id"));
        $this->t_customer_order_id->SetDBValue($this->f("t_customer_order_id"));
        $this->njop_pbb->SetDBValue($this->f("njop_pbb"));
    }
//End SetValues Method

} //End t_bphtb_registration_listDataSource Class @2-FCB6E20C

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

//Class_Initialize Event @3-4A91CDFC
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
            $this->npwd = & new clsControl(ccsHidden, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", $Method, NULL), $this);
            $this->t_bphtb_registration_id = & new clsControl(ccsHidden, "t_bphtb_registration_id", "t_bphtb_registration_id", ccsText, "", CCGetRequestParam("t_bphtb_registration_id", $Method, NULL), $this);
            $this->t_bphtb_restitusi_id = & new clsControl(ccsHidden, "t_bphtb_restitusi_id", "t_bphtb_restitusi_id", ccsText, "", CCGetRequestParam("t_bphtb_restitusi_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-A8D87730
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->npwd->Validate() && $Validation);
        $Validation = ($this->t_bphtb_registration_id->Validate() && $Validation);
        $Validation = ($this->t_bphtb_restitusi_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npwd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_bphtb_registration_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_bphtb_restitusi_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-3C0F081F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->npwd->Errors->Count());
        $errors = ($errors || $this->t_bphtb_registration_id->Errors->Count());
        $errors = ($errors || $this->t_bphtb_restitusi_id->Errors->Count());
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

//Operation Method @3-BD51FCBD
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
        $Redirect = "t_bphtb_restitution_list.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_bphtb_restitution_list.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-023ADB77
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
            $Error = ComposeStrings($Error, $this->npwd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_bphtb_registration_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_bphtb_restitusi_id->Errors->ToString());
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
        $this->npwd->Show();
        $this->t_bphtb_registration_id->Show();
        $this->t_bphtb_restitusi_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_cust_order_legal_docSearch Class @3-FCB6E20C

class clsGridt_bphtb_restitusi { //t_bphtb_restitusi class @709-DDB62707

//Variables @709-AC1EDBB9

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

//Class_Initialize Event @709-E08D5B8B
    function clsGridt_bphtb_restitusi($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_bphtb_restitusi";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_bphtb_restitusi";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_bphtb_restitusiDataSource($this);
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

        $this->alasan = & new clsControl(ccsLabel, "alasan", "alasan", ccsText, "", CCGetRequestParam("alasan", ccsGet, NULL), $this);
        $this->restitusi_amt = & new clsControl(ccsLabel, "restitusi_amt", "restitusi_amt", ccsText, "", CCGetRequestParam("restitusi_amt", ccsGet, NULL), $this);
        $this->t_bphtb_registration_id = & new clsControl(ccsHidden, "t_bphtb_registration_id", "t_bphtb_registration_id", ccsText, "", CCGetRequestParam("t_bphtb_registration_id", ccsGet, NULL), $this);
        $this->t_bphtb_restitusi_id = & new clsControl(ccsHidden, "t_bphtb_restitusi_id", "t_bphtb_restitusi_id", ccsText, "", CCGetRequestParam("t_bphtb_restitusi_id", ccsGet, NULL), $this);
        $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsText, "", CCGetRequestParam("t_customer_order_id", ccsGet, NULL), $this);
        $this->btn_edit = & new clsButton("btn_edit", ccsGet, $this);
        $this->btn_submit = & new clsButton("btn_submit", ccsGet, $this);
        $this->doc_id = & new clsControl(ccsHidden, "doc_id", "doc_id", ccsText, "", CCGetRequestParam("doc_id", ccsGet, NULL), $this);
        $this->submit_label = & new clsControl(ccsLabel, "submit_label", "submit_label", ccsText, "", CCGetRequestParam("submit_label", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @709-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @709-09937D28
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_bphtb_registration_id"] = CCGetFromGet("t_bphtb_registration_id", NULL);

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
            $this->ControlsVisible["alasan"] = $this->alasan->Visible;
            $this->ControlsVisible["restitusi_amt"] = $this->restitusi_amt->Visible;
            $this->ControlsVisible["t_bphtb_registration_id"] = $this->t_bphtb_registration_id->Visible;
            $this->ControlsVisible["t_bphtb_restitusi_id"] = $this->t_bphtb_restitusi_id->Visible;
            $this->ControlsVisible["t_customer_order_id"] = $this->t_customer_order_id->Visible;
            $this->ControlsVisible["btn_edit"] = $this->btn_edit->Visible;
            $this->ControlsVisible["btn_submit"] = $this->btn_submit->Visible;
            $this->ControlsVisible["doc_id"] = $this->doc_id->Visible;
            $this->ControlsVisible["submit_label"] = $this->submit_label->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                if(!is_array($this->submit_label->Value) && !strlen($this->submit_label->Value) && $this->submit_label->Value !== false)
                    $this->submit_label->SetText(SUBMITTED);
                $this->alasan->SetValue($this->DataSource->alasan->GetValue());
                $this->restitusi_amt->SetValue($this->DataSource->restitusi_amt->GetValue());
                $this->t_bphtb_registration_id->SetValue($this->DataSource->t_bphtb_registration_id->GetValue());
                $this->t_bphtb_restitusi_id->SetValue($this->DataSource->t_bphtb_restitusi_id->GetValue());
                $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                $this->doc_id->SetValue($this->DataSource->doc_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->alasan->Show();
                $this->restitusi_amt->Show();
                $this->t_bphtb_registration_id->Show();
                $this->t_bphtb_restitusi_id->Show();
                $this->t_customer_order_id->Show();
                $this->btn_edit->Show();
                $this->btn_submit->Show();
                $this->doc_id->Show();
                $this->submit_label->Show();
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

//GetErrors Method @709-4171735F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->alasan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->restitusi_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_bphtb_registration_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_bphtb_restitusi_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_customer_order_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->doc_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->submit_label->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_bphtb_restitusi Class @709-FCB6E20C

class clst_bphtb_restitusiDataSource extends clsDBConnSIKP {  //t_bphtb_restitusiDataSource Class @709-8CF8BF9C

//DataSource Variables @709-FC1A809C
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $alasan;
    var $restitusi_amt;
    var $t_bphtb_registration_id;
    var $t_bphtb_restitusi_id;
    var $t_customer_order_id;
    var $doc_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @709-8CBFFE46
    function clst_bphtb_restitusiDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_bphtb_restitusi";
        $this->Initialize();
        $this->alasan = new clsField("alasan", ccsText, "");
        
        $this->restitusi_amt = new clsField("restitusi_amt", ccsText, "");
        
        $this->t_bphtb_registration_id = new clsField("t_bphtb_registration_id", ccsText, "");
        
        $this->t_bphtb_restitusi_id = new clsField("t_bphtb_restitusi_id", ccsText, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsText, "");
        
        $this->doc_id = new clsField("doc_id", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @709-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @709-D181F072
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_bphtb_registration_id", ccsFloat, "", "", $this->Parameters["urlt_bphtb_registration_id"], 0, false);
    }
//End Prepare Method

//Open Method @709-B05C5CDC
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select t_bphtb_restitusi.*,t_product_order_control.doc_id from t_bphtb_restitusi \n" .
        "left join t_product_order_control on t_product_order_control.doc_id = t_bphtb_restitusi.t_customer_order_id\n" .
        "where t_bphtb_registration_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ") cnt";
        $this->SQL = "select t_bphtb_restitusi.*,t_product_order_control.doc_id from t_bphtb_restitusi \n" .
        "left join t_product_order_control on t_product_order_control.doc_id = t_bphtb_restitusi.t_customer_order_id\n" .
        "where t_bphtb_registration_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @709-F6A36874
    function SetValues()
    {
        $this->alasan->SetDBValue($this->f("alasan"));
        $this->restitusi_amt->SetDBValue($this->f("restitusi_amt"));
        $this->t_bphtb_registration_id->SetDBValue($this->f("t_bphtb_registration_id"));
        $this->t_bphtb_restitusi_id->SetDBValue($this->f("t_bphtb_restitusi_id"));
        $this->t_customer_order_id->SetDBValue($this->f("t_customer_order_id"));
        $this->doc_id->SetDBValue($this->f("doc_id"));
    }
//End SetValues Method

} //End t_bphtb_restitusiDataSource Class @709-FCB6E20C



//Initialize Page @1-3DADBBDC
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
$TemplateFileName = "t_bphtb_restitution_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-ACE6F0D2
include_once("./t_bphtb_restitution_list_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E893733E
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_bphtb_registration_list = & new clsGridt_bphtb_registration_list("", $MainPage);
$t_cust_order_legal_docSearch = & new clsRecordt_cust_order_legal_docSearch("", $MainPage);
$t_bphtb_restitusi = & new clsGridt_bphtb_restitusi("", $MainPage);
$MainPage->t_bphtb_registration_list = & $t_bphtb_registration_list;
$MainPage->t_cust_order_legal_docSearch = & $t_cust_order_legal_docSearch;
$MainPage->t_bphtb_restitusi = & $t_bphtb_restitusi;
$t_bphtb_registration_list->Initialize();
$t_bphtb_restitusi->Initialize();

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

//Execute Components @1-0E32A995
$t_cust_order_legal_docSearch->Operation();
//End Execute Components

//Go to destination page @1-744BFBB8
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_bphtb_registration_list);
    unset($t_cust_order_legal_docSearch);
    unset($t_bphtb_restitusi);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E7B68529
$t_bphtb_registration_list->Show();
$t_cust_order_legal_docSearch->Show();
$t_bphtb_restitusi->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-18B33F82
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_bphtb_registration_list);
unset($t_cust_order_legal_docSearch);
unset($t_bphtb_restitusi);
unset($Tpl);
//End Unload Page


?>
