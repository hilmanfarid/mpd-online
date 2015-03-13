<?php
//Include Common Files @1-43D660FE
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "reset_pass_wp.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_app_userGrid { //p_app_userGrid class @2-42EB5B77

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

//Class_Initialize Event @2-14366514
    function clsGridp_app_userGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_app_userGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_app_userGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_app_userGridDataSource($this);
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
        $this->DLink->Page = "reset_pass_wp.php";
        $this->app_user_name = & new clsControl(ccsLabel, "app_user_name", "app_user_name", ccsText, "", CCGetRequestParam("app_user_name", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->full_name = & new clsControl(ccsLabel, "full_name", "full_name", ccsText, "", CCGetRequestParam("full_name", ccsGet, NULL), $this);
        $this->p_app_user_id = & new clsControl(ccsHidden, "p_app_user_id", "p_app_user_id", ccsFloat, "", CCGetRequestParam("p_app_user_id", ccsGet, NULL), $this);
        $this->npwd = & new clsControl(ccsLabel, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "reset_pass_wp.php";
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

//Show Method @2-2639D384
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
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["app_user_name"] = $this->app_user_name->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["full_name"] = $this->full_name->Visible;
            $this->ControlsVisible["p_app_user_id"] = $this->p_app_user_id->Visible;
            $this->ControlsVisible["npwd"] = $this->npwd->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_app_user_id", $this->DataSource->f("p_app_user_id"));
                $this->app_user_name->SetValue($this->DataSource->app_user_name->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->full_name->SetValue($this->DataSource->full_name->GetValue());
                $this->p_app_user_id->SetValue($this->DataSource->p_app_user_id->GetValue());
                $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->app_user_name->Show();
                $this->description->Show();
                $this->full_name->Show();
                $this->p_app_user_id->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_app_user_id", "s_keyword", "ccsForm"));
        $this->Insert_Link->Parameters = CCAddParam($this->Insert_Link->Parameters, "FLAG", "ADD");
        $this->Navigator->Show();
        $this->Insert_Link->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-9B759357
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->app_user_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->full_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_app_user_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->npwd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_app_userGrid Class @2-FCB6E20C

class clsp_app_userGridDataSource extends clsDBConnSIKP {  //p_app_userGridDataSource Class @2-56E5BB0D

//DataSource Variables @2-4D587BAE
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $app_user_name;
    var $description;
    var $full_name;
    var $p_app_user_id;
    var $npwd;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-9C0FBC29
    function clsp_app_userGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_app_userGrid";
        $this->Initialize();
        $this->app_user_name = new clsField("app_user_name", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->full_name = new clsField("full_name", ccsText, "");
        
        $this->p_app_user_id = new clsField("p_app_user_id", ccsFloat, "");
        
        $this->npwd = new clsField("npwd", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-260F101F
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "user_name";
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

//Open Method @2-D09C9A16
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select b.*, c.npwd from t_customer_user a\n" .
        "left join p_app_user b on a.p_app_user_id=b.p_app_user_id\n" .
        "left join t_cust_account c on a.t_customer_id = c.t_customer_id\n" .
        "WHERE ( upper(b.app_user_name) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(b.full_name) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(b.email_address) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(b.description) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' \n" .
        "OR upper(c.npwd) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        ")\n" .
        "and  b.p_user_status_id =1 and is_employee = 'N') cnt";
        $this->SQL = "select b.*, c.npwd from t_customer_user a\n" .
        "left join p_app_user b on a.p_app_user_id=b.p_app_user_id\n" .
        "left join t_cust_account c on a.t_customer_id = c.t_customer_id\n" .
        "WHERE ( upper(b.app_user_name) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(b.full_name) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(b.email_address) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(b.description) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' \n" .
        "OR upper(c.npwd) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        ")\n" .
        "and  b.p_user_status_id =1 and is_employee = 'N' {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-4DFA68C9
    function SetValues()
    {
        $this->app_user_name->SetDBValue($this->f("app_user_name"));
        $this->description->SetDBValue($this->f("description"));
        $this->full_name->SetDBValue($this->f("full_name"));
        $this->p_app_user_id->SetDBValue(trim($this->f("p_app_user_id")));
        $this->npwd->SetDBValue($this->f("npwd"));
    }
//End SetValues Method

} //End p_app_userGridDataSource Class @2-FCB6E20C

class clsRecordp_app_userSearch { //p_app_userSearch Class @3-438B2398

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

//Class_Initialize Event @3-2C51941B
    function clsRecordp_app_userSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_app_userSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_app_userSearch";
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

//Operation Method @3-BAF79DDF
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
        $Redirect = "reset_pass_wp.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "reset_pass_wp.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-9830B7FB
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

        $this->Button_DoSearch->Show();
        $this->s_keyword->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End p_app_userSearch Class @3-FCB6E20C

class clsRecordp_app_userForm { //p_app_userForm Class @94-108016B9

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

//Class_Initialize Event @94-D2203333
    function clsRecordp_app_userForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_app_userForm/Error";
        $this->DataSource = new clsp_app_userFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_app_userForm";
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
            $this->Button_update = & new clsButton("Button_update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->p_app_user_id = & new clsControl(ccsHidden, "p_app_user_id", "P App User Id", ccsFloat, "", CCGetRequestParam("p_app_user_id", $Method, NULL), $this);
            $this->app_user_name = & new clsControl(ccsTextBox, "app_user_name", "Nama User", ccsText, "", CCGetRequestParam("app_user_name", $Method, NULL), $this);
            $this->full_name = & new clsControl(ccsTextBox, "full_name", "Nama Lengkap", ccsText, "", CCGetRequestParam("full_name", $Method, NULL), $this);
            $this->email_address = & new clsControl(ccsTextBox, "email_address", "Email", ccsText, "", CCGetRequestParam("email_address", $Method, NULL), $this);
            $this->p_user_status_id = & new clsControl(ccsListBox, "p_user_status_id", "Status", ccsText, "", CCGetRequestParam("p_user_status_id", $Method, NULL), $this);
            $this->p_user_status_id->DSType = dsTable;
            $this->p_user_status_id->DataSource = new clsDBConnSIKP();
            $this->p_user_status_id->ds = & $this->p_user_status_id->DataSource;
            $this->p_user_status_id->DataSource->SQL = "SELECT * \n" .
"FROM p_user_status {SQL_Where} {SQL_OrderBy}";
            list($this->p_user_status_id->BoundColumn, $this->p_user_status_id->TextColumn, $this->p_user_status_id->DBFormat) = array("p_user_status_id", "code", "");
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->ip_address_v4 = & new clsControl(ccsTextBox, "ip_address_v4", "IP Address v4", ccsText, "", CCGetRequestParam("ip_address_v4", $Method, NULL), $this);
            $this->expired_user = & new clsControl(ccsTextBox, "expired_user", "Expired User", ccsText, "", CCGetRequestParam("expired_user", $Method, NULL), $this);
            $this->expired_pwd = & new clsControl(ccsTextBox, "expired_pwd", "Expired Pwd", ccsText, "", CCGetRequestParam("expired_pwd", $Method, NULL), $this);
            $this->last_login_time = & new clsControl(ccsTextBox, "last_login_time", "Terakhir Login", ccsText, "", CCGetRequestParam("last_login_time", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->ip_address_v6 = & new clsControl(ccsTextBox, "ip_address_v6", "IP Address v6", ccsText, "", CCGetRequestParam("ip_address_v6", $Method, NULL), $this);
            $this->p_app_userGridPage = & new clsControl(ccsHidden, "p_app_userGridPage", "p_app_userGridPage", ccsText, "", CCGetRequestParam("p_app_userGridPage", $Method, NULL), $this);
            $this->is_employee = & new clsControl(ccsListBox, "is_employee", "Employee ?", ccsText, "", CCGetRequestParam("is_employee", $Method, NULL), $this);
            $this->is_employee->DSType = dsListOfValues;
            $this->is_employee->Values = array(array("Y", "YA"), array("N", "TIDAK"));
            if(!$this->FormSubmitted) {
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->is_employee->Value) && !strlen($this->is_employee->Value) && $this->is_employee->Value !== false)
                    $this->is_employee->SetText("Y");
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-06ED8DF2
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_app_user_id"] = CCGetFromGet("p_app_user_id", NULL);
    }
//End Initialize Method

//Validate Method @94-7328EE64
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if(strlen($this->email_address->GetText()) && !preg_match ("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $this->email_address->GetText())) {
            $this->email_address->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Email"));
        }
        $Validation = ($this->p_app_user_id->Validate() && $Validation);
        $Validation = ($this->app_user_name->Validate() && $Validation);
        $Validation = ($this->full_name->Validate() && $Validation);
        $Validation = ($this->email_address->Validate() && $Validation);
        $Validation = ($this->p_user_status_id->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->ip_address_v4->Validate() && $Validation);
        $Validation = ($this->expired_user->Validate() && $Validation);
        $Validation = ($this->expired_pwd->Validate() && $Validation);
        $Validation = ($this->last_login_time->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->ip_address_v6->Validate() && $Validation);
        $Validation = ($this->p_app_userGridPage->Validate() && $Validation);
        $Validation = ($this->is_employee->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_app_user_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->app_user_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->full_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->email_address->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_user_status_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ip_address_v4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->expired_user->Errors->Count() == 0);
        $Validation =  $Validation && ($this->expired_pwd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->last_login_time->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ip_address_v6->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_app_userGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_employee->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-3C428DB3
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_app_user_id->Errors->Count());
        $errors = ($errors || $this->app_user_name->Errors->Count());
        $errors = ($errors || $this->full_name->Errors->Count());
        $errors = ($errors || $this->email_address->Errors->Count());
        $errors = ($errors || $this->p_user_status_id->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->ip_address_v4->Errors->Count());
        $errors = ($errors || $this->expired_user->Errors->Count());
        $errors = ($errors || $this->expired_pwd->Errors->Count());
        $errors = ($errors || $this->last_login_time->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->ip_address_v6->Errors->Count());
        $errors = ($errors || $this->p_app_userGridPage->Errors->Count());
        $errors = ($errors || $this->is_employee->Errors->Count());
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

//Operation Method @94-1ED7F9C7
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
            $this->PressedButton = $this->EditMode ? "Button_update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_update->Pressed) {
                $this->PressedButton = "Button_update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_app_user_id", "s_keyword", "p_app_userGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_app_user_id", "s_keyword", "p_app_userGridPage"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_update") {
                if(!CCGetEvent($this->Button_update->CCSEvents, "OnClick", $this->Button_update)) {
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

//InsertRow Method @94-5BB4AFF1
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->full_name->SetValue($this->full_name->GetValue(true));
        $this->DataSource->p_user_status_id->SetValue($this->p_user_status_id->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->ip_address_v4->SetValue($this->ip_address_v4->GetValue(true));
        $this->DataSource->expired_user->SetValue($this->expired_user->GetValue(true));
        $this->DataSource->expired_pwd->SetValue($this->expired_pwd->GetValue(true));
        $this->DataSource->ip_address_v6->SetValue($this->ip_address_v6->GetValue(true));
        $this->DataSource->p_app_user_id->SetValue($this->p_app_user_id->GetValue(true));
        $this->DataSource->app_user_name->SetValue($this->app_user_name->GetValue(true));
        $this->DataSource->email_address->SetValue($this->email_address->GetValue(true));
        $this->DataSource->is_employee->SetValue($this->is_employee->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//DeleteRow Method @94-62706DF9
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_app_user_id->SetValue($this->p_app_user_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-70F484D8
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

        $this->p_user_status_id->Prepare();
        $this->is_employee->Prepare();

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
                    $this->p_app_user_id->SetValue($this->DataSource->p_app_user_id->GetValue());
                    $this->app_user_name->SetValue($this->DataSource->app_user_name->GetValue());
                    $this->full_name->SetValue($this->DataSource->full_name->GetValue());
                    $this->email_address->SetValue($this->DataSource->email_address->GetValue());
                    $this->p_user_status_id->SetValue($this->DataSource->p_user_status_id->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->ip_address_v4->SetValue($this->DataSource->ip_address_v4->GetValue());
                    $this->expired_user->SetValue($this->DataSource->expired_user->GetValue());
                    $this->expired_pwd->SetValue($this->DataSource->expired_pwd->GetValue());
                    $this->last_login_time->SetValue($this->DataSource->last_login_time->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->ip_address_v6->SetValue($this->DataSource->ip_address_v6->GetValue());
                    $this->is_employee->SetValue($this->DataSource->is_employee->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_app_user_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->app_user_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->full_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->email_address->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_user_status_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ip_address_v4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->expired_user->Errors->ToString());
            $Error = ComposeStrings($Error, $this->expired_pwd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->last_login_time->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ip_address_v6->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_app_userGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_employee->Errors->ToString());
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
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $this->p_app_user_id->Show();
        $this->app_user_name->Show();
        $this->full_name->Show();
        $this->email_address->Show();
        $this->p_user_status_id->Show();
        $this->description->Show();
        $this->ip_address_v4->Show();
        $this->expired_user->Show();
        $this->expired_pwd->Show();
        $this->last_login_time->Show();
        $this->created_by->Show();
        $this->updated_by->Show();
        $this->creation_date->Show();
        $this->updated_date->Show();
        $this->ip_address_v6->Show();
        $this->p_app_userGridPage->Show();
        $this->is_employee->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_app_userForm Class @94-FCB6E20C

class clsp_app_userFormDataSource extends clsDBConnSIKP {  //p_app_userFormDataSource Class @94-09D22DF9

//DataSource Variables @94-E0A739EB
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
    var $p_app_user_id;
    var $app_user_name;
    var $full_name;
    var $email_address;
    var $p_user_status_id;
    var $description;
    var $ip_address_v4;
    var $expired_user;
    var $expired_pwd;
    var $last_login_time;
    var $created_by;
    var $updated_by;
    var $creation_date;
    var $updated_date;
    var $ip_address_v6;
    var $p_app_userGridPage;
    var $is_employee;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-4281CF63
    function clsp_app_userFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_app_userForm/Error";
        $this->Initialize();
        $this->p_app_user_id = new clsField("p_app_user_id", ccsFloat, "");
        
        $this->app_user_name = new clsField("app_user_name", ccsText, "");
        
        $this->full_name = new clsField("full_name", ccsText, "");
        
        $this->email_address = new clsField("email_address", ccsText, "");
        
        $this->p_user_status_id = new clsField("p_user_status_id", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->ip_address_v4 = new clsField("ip_address_v4", ccsText, "");
        
        $this->expired_user = new clsField("expired_user", ccsText, "");
        
        $this->expired_pwd = new clsField("expired_pwd", ccsText, "");
        
        $this->last_login_time = new clsField("last_login_time", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->ip_address_v6 = new clsField("ip_address_v6", ccsText, "");
        
        $this->p_app_userGridPage = new clsField("p_app_userGridPage", ccsText, "");
        
        $this->is_employee = new clsField("is_employee", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-576B52F2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_app_user_id", ccsFloat, "", "", $this->Parameters["urlp_app_user_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "p_app_user_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @94-0D0BD60F
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT p_app_user_id, app_user_name, user_pwd, full_name, email_address, p_user_status_id, description, ip_address_v4, ip_address_v6,\n\n" .
        "to_char(expired_user,'DD-MON-YYYY') AS expired_user, to_char(expired_pwd,'DD-MON-YYYY') AS expired_pwd, last_login_time,\n\n" .
        "fail_login_trial, to_char(creation_date,'DD-MON-YYYY') AS creation_date, created_by, to_char(updated_date,'DD-MON-YYYY') AS updated_date,\n\n" .
        "updated_by, is_employee \n\n" .
        "FROM p_app_user {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-5A937914
    function SetValues()
    {
        $this->p_app_user_id->SetDBValue(trim($this->f("p_app_user_id")));
        $this->app_user_name->SetDBValue($this->f("app_user_name"));
        $this->full_name->SetDBValue($this->f("full_name"));
        $this->email_address->SetDBValue($this->f("email_address"));
        $this->p_user_status_id->SetDBValue($this->f("p_user_status_id"));
        $this->description->SetDBValue($this->f("description"));
        $this->ip_address_v4->SetDBValue($this->f("ip_address_v4"));
        $this->expired_user->SetDBValue($this->f("expired_user"));
        $this->expired_pwd->SetDBValue($this->f("expired_pwd"));
        $this->last_login_time->SetDBValue($this->f("last_login_time"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->ip_address_v6->SetDBValue($this->f("ip_address_v6"));
        $this->is_employee->SetDBValue($this->f("is_employee"));
    }
//End SetValues Method

//Insert Method @94-4EB1224F
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["full_name"] = new clsSQLParameter("ctrlfull_name", ccsText, "", "", $this->full_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_user_status_id"] = new clsSQLParameter("ctrlp_user_status_id", ccsText, "", "", $this->p_user_status_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["ip_address_v4"] = new clsSQLParameter("ctrlip_address_v4", ccsText, "", "", $this->ip_address_v4->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["expired_user"] = new clsSQLParameter("ctrlexpired_user", ccsText, "", "", $this->expired_user->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["expired_pwd"] = new clsSQLParameter("ctrlexpired_pwd", ccsText, "", "", $this->expired_pwd->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr206", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr207", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["ip_address_v6"] = new clsSQLParameter("ctrlip_address_v6", ccsText, "", "", $this->ip_address_v6->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_app_user_id"] = new clsSQLParameter("ctrlp_app_user_id", ccsFloat, "", "", $this->p_app_user_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["app_user_name"] = new clsSQLParameter("ctrlapp_user_name", ccsText, "", "", $this->app_user_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["email_address"] = new clsSQLParameter("ctrlemail_address", ccsText, "", "", $this->email_address->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["fail_login_trial"] = new clsSQLParameter("expr229", ccsInteger, "", "", 0, 0, false, $this->ErrorBlock);
        $this->cp["is_employee"] = new clsSQLParameter("ctrlis_employee", ccsText, "", "", $this->is_employee->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["full_name"]->GetValue()) and !strlen($this->cp["full_name"]->GetText()) and !is_bool($this->cp["full_name"]->GetValue())) 
            $this->cp["full_name"]->SetValue($this->full_name->GetValue(true));
        if (!is_null($this->cp["p_user_status_id"]->GetValue()) and !strlen($this->cp["p_user_status_id"]->GetText()) and !is_bool($this->cp["p_user_status_id"]->GetValue())) 
            $this->cp["p_user_status_id"]->SetValue($this->p_user_status_id->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["ip_address_v4"]->GetValue()) and !strlen($this->cp["ip_address_v4"]->GetText()) and !is_bool($this->cp["ip_address_v4"]->GetValue())) 
            $this->cp["ip_address_v4"]->SetValue($this->ip_address_v4->GetValue(true));
        if (!is_null($this->cp["expired_user"]->GetValue()) and !strlen($this->cp["expired_user"]->GetText()) and !is_bool($this->cp["expired_user"]->GetValue())) 
            $this->cp["expired_user"]->SetValue($this->expired_user->GetValue(true));
        if (!is_null($this->cp["expired_pwd"]->GetValue()) and !strlen($this->cp["expired_pwd"]->GetText()) and !is_bool($this->cp["expired_pwd"]->GetValue())) 
            $this->cp["expired_pwd"]->SetValue($this->expired_pwd->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["ip_address_v6"]->GetValue()) and !strlen($this->cp["ip_address_v6"]->GetText()) and !is_bool($this->cp["ip_address_v6"]->GetValue())) 
            $this->cp["ip_address_v6"]->SetValue($this->ip_address_v6->GetValue(true));
        if (!is_null($this->cp["p_app_user_id"]->GetValue()) and !strlen($this->cp["p_app_user_id"]->GetText()) and !is_bool($this->cp["p_app_user_id"]->GetValue())) 
            $this->cp["p_app_user_id"]->SetValue($this->p_app_user_id->GetValue(true));
        if (!is_null($this->cp["app_user_name"]->GetValue()) and !strlen($this->cp["app_user_name"]->GetText()) and !is_bool($this->cp["app_user_name"]->GetValue())) 
            $this->cp["app_user_name"]->SetValue($this->app_user_name->GetValue(true));
        if (!is_null($this->cp["email_address"]->GetValue()) and !strlen($this->cp["email_address"]->GetText()) and !is_bool($this->cp["email_address"]->GetValue())) 
            $this->cp["email_address"]->SetValue($this->email_address->GetValue(true));
        if (!is_null($this->cp["fail_login_trial"]->GetValue()) and !strlen($this->cp["fail_login_trial"]->GetText()) and !is_bool($this->cp["fail_login_trial"]->GetValue())) 
            $this->cp["fail_login_trial"]->SetValue(0);
        if (!strlen($this->cp["fail_login_trial"]->GetText()) and !is_bool($this->cp["fail_login_trial"]->GetValue(true))) 
            $this->cp["fail_login_trial"]->SetText(0);
        if (!is_null($this->cp["is_employee"]->GetValue()) and !strlen($this->cp["is_employee"]->GetText()) and !is_bool($this->cp["is_employee"]->GetValue())) 
            $this->cp["is_employee"]->SetValue($this->is_employee->GetValue(true));
        $this->SQL = "INSERT INTO p_app_user(p_app_user_id, \n" .
        "app_user_name, \n" .
        "user_pwd,\n" .
        "full_name, \n" .
        "email_address, \n" .
        "p_user_status_id, \n" .
        "description, \n" .
        "ip_address_v4, \n" .
        "expired_user, \n" .
        "expired_pwd, \n" .
        "last_login_time, \n" .
        "created_by, \n" .
        "updated_by, \n" .
        "creation_date, \n" .
        "updated_date, \n" .
        "ip_address_v6,\n" .
        "fail_login_trial,\n" .
        "is_employee) VALUES\n" .
        "(generate_id('sikp','p_app_user','p_app_user_id'), \n" .
        "'" . $this->SQLValue($this->cp["app_user_name"]->GetDBValue(), ccsText) . "', \n" .
        "md5('" . $this->SQLValue($this->cp["app_user_name"]->GetDBValue(), ccsText) . "'), \n" .
        "'" . $this->SQLValue($this->cp["full_name"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["email_address"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["p_user_status_id"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["ip_address_v4"]->GetDBValue(), ccsText) . "', \n" .
        "case when '" . $this->SQLValue($this->cp["expired_user"]->GetDBValue(), ccsText) . "'= '' then null else to_date('" . $this->SQLValue($this->cp["expired_user"]->GetDBValue(), ccsText) . "','DD-MON-YYYY') end, \n" .
        "case when '" . $this->SQLValue($this->cp["expired_pwd"]->GetDBValue(), ccsText) . "'= '' then null else to_date('" . $this->SQLValue($this->cp["expired_pwd"]->GetDBValue(), ccsText) . "','DD-MON-YYYY') end, \n" .
        "null, \n" .
        "'" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "sysdate, \n" .
        "sysdate, \n" .
        "'" . $this->SQLValue($this->cp["ip_address_v6"]->GetDBValue(), ccsText) . "',\n" .
        "" . $this->SQLValue($this->cp["fail_login_trial"]->GetDBValue(), ccsInteger) . ",\n" .
        "'" . $this->SQLValue($this->cp["is_employee"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Delete Method @94-011E8ECA
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_app_user_id"] = new clsSQLParameter("ctrlp_app_user_id", ccsFloat, "", "", $this->p_app_user_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_app_user_id"]->GetValue()) and !strlen($this->cp["p_app_user_id"]->GetText()) and !is_bool($this->cp["p_app_user_id"]->GetValue())) 
            $this->cp["p_app_user_id"]->SetValue($this->p_app_user_id->GetValue(true));
        if (!strlen($this->cp["p_app_user_id"]->GetText()) and !is_bool($this->cp["p_app_user_id"]->GetValue(true))) 
            $this->cp["p_app_user_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_app_user WHERE  p_app_user_id = " . $this->SQLValue($this->cp["p_app_user_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_app_userFormDataSource Class @94-FCB6E20C

//Initialize Page @1-05E6E627
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
$TemplateFileName = "reset_pass_wp.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-85FA0933
include_once("./reset_pass_wp_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-CEE7E33F
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_app_userGrid = & new clsGridp_app_userGrid("", $MainPage);
$p_app_userSearch = & new clsRecordp_app_userSearch("", $MainPage);
$p_app_userForm = & new clsRecordp_app_userForm("", $MainPage);
$MainPage->p_app_userGrid = & $p_app_userGrid;
$MainPage->p_app_userSearch = & $p_app_userSearch;
$MainPage->p_app_userForm = & $p_app_userForm;
$p_app_userGrid->Initialize();
$p_app_userForm->Initialize();

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

//Execute Components @1-0DB0EBDE
$p_app_userSearch->Operation();
$p_app_userForm->Operation();
//End Execute Components

//Go to destination page @1-CE5C3B60
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_app_userGrid);
    unset($p_app_userSearch);
    unset($p_app_userForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D23637A8
$p_app_userGrid->Show();
$p_app_userSearch->Show();
$p_app_userForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-10FC7795
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_app_userGrid);
unset($p_app_userSearch);
unset($p_app_userForm);
unset($Tpl);
//End Unload Page


?>
