<?php
//Include Common Files @1-97D0983D
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "t_customer_user.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_customer_userGrid { //t_customer_userGrid class @2-5A909C42

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

//Class_Initialize Event @2-4B046DC5
    function clsGridt_customer_userGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_customer_userGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_customer_userGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_customer_userGridDataSource($this);
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
        $this->DLink->Page = "t_customer_user.php";
        $this->company_owner = & new clsControl(ccsLabel, "company_owner", "company_owner", ccsText, "", CCGetRequestParam("company_owner", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->t_customer_user_id = & new clsControl(ccsHidden, "t_customer_user_id", "t_customer_user_id", ccsFloat, "", CCGetRequestParam("t_customer_user_id", ccsGet, NULL), $this);
        $this->user_name = & new clsControl(ccsLabel, "user_name", "user_name", ccsText, "", CCGetRequestParam("user_name", ccsGet, NULL), $this);
        $this->mobile_phone_no = & new clsControl(ccsLabel, "mobile_phone_no", "mobile_phone_no", ccsText, "", CCGetRequestParam("mobile_phone_no", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "t_customer_user.php";
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

//Show Method @2-D1AB1E57
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
            $this->ControlsVisible["company_owner"] = $this->company_owner->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            $this->ControlsVisible["t_customer_user_id"] = $this->t_customer_user_id->Visible;
            $this->ControlsVisible["user_name"] = $this->user_name->Visible;
            $this->ControlsVisible["mobile_phone_no"] = $this->mobile_phone_no->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_customer_user_id", $this->DataSource->f("t_customer_user_id"));
                $this->company_owner->SetValue($this->DataSource->company_owner->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->t_customer_user_id->SetValue($this->DataSource->t_customer_user_id->GetValue());
                $this->user_name->SetValue($this->DataSource->user_name->GetValue());
                $this->mobile_phone_no->SetValue($this->DataSource->mobile_phone_no->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->company_owner->Show();
                $this->description->Show();
                $this->valid_from->Show();
                $this->valid_to->Show();
                $this->t_customer_user_id->Show();
                $this->user_name->Show();
                $this->mobile_phone_no->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("t_customer_user_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-4B6267FF
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->company_owner->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_customer_user_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->user_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mobile_phone_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_customer_userGrid Class @2-FCB6E20C

class clst_customer_userGridDataSource extends clsDBConnSIKP {  //t_customer_userGridDataSource Class @2-5A71B6FB

//DataSource Variables @2-E0BE5BE2
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $company_owner;
    var $description;
    var $valid_from;
    var $valid_to;
    var $t_customer_user_id;
    var $user_name;
    var $mobile_phone_no;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-09CF831F
    function clst_customer_userGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_customer_userGrid";
        $this->Initialize();
        $this->company_owner = new clsField("company_owner", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        
        $this->t_customer_user_id = new clsField("t_customer_user_id", ccsFloat, "");
        
        $this->user_name = new clsField("user_name", ccsText, "");
        
        $this->mobile_phone_no = new clsField("mobile_phone_no", ccsText, "");
        

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

//Prepare Method @2-4CA1C424
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "upper(company_owner)", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "upper(user_name)", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opOR(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-6A492C63
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_customer_user";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_customer_user {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-26A73E3D
    function SetValues()
    {
        $this->company_owner->SetDBValue($this->f("company_owner"));
        $this->description->SetDBValue($this->f("description"));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
        $this->t_customer_user_id->SetDBValue(trim($this->f("t_customer_user_id")));
        $this->user_name->SetDBValue($this->f("user_name"));
        $this->mobile_phone_no->SetDBValue($this->f("mobile_phone_no"));
    }
//End SetValues Method

} //End t_customer_userGridDataSource Class @2-FCB6E20C

class clsRecordt_customer_userSearch { //t_customer_userSearch Class @3-E781BDDE

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

//Class_Initialize Event @3-5187112C
    function clsRecordt_customer_userSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_customer_userSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_customer_userSearch";
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

//Operation Method @3-3BBF061F
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
        $Redirect = "t_customer_user.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_customer_user.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

} //End t_customer_userSearch Class @3-FCB6E20C

class clsRecordt_customer_userForm { //t_customer_userForm Class @23-F162A693

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

//Class_Initialize Event @23-32429DB7
    function clsRecordt_customer_userForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_customer_userForm/Error";
        $this->DataSource = new clst_customer_userFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_customer_userForm";
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
            $this->t_customer_user_id = & new clsControl(ccsHidden, "t_customer_user_id", "Id", ccsFloat, "", CCGetRequestParam("t_customer_user_id", $Method, NULL), $this);
            $this->company_owner = & new clsControl(ccsTextBox, "company_owner", "Customer", ccsText, "", CCGetRequestParam("company_owner", $Method, NULL), $this);
            $this->company_owner->Required = true;
            $this->valid_from = & new clsControl(ccsTextBox, "valid_from", "Valid From", ccsText, "", CCGetRequestParam("valid_from", $Method, NULL), $this);
            $this->valid_from->Required = true;
            $this->DatePicker_valid_from = & new clsDatePicker("DatePicker_valid_from", "t_customer_userForm", "valid_from", $this);
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->valid_to = & new clsControl(ccsTextBox, "valid_to", "Valid To", ccsText, "", CCGetRequestParam("valid_to", $Method, NULL), $this);
            $this->DatePicker_valid_to = & new clsDatePicker("DatePicker_valid_to", "t_customer_userForm", "valid_to", $this);
            $this->user_name = & new clsControl(ccsTextBox, "user_name", "User Name", ccsText, "", CCGetRequestParam("user_name", $Method, NULL), $this);
            $this->user_name->Required = true;
            $this->mobile_phone_no = & new clsControl(ccsTextBox, "mobile_phone_no", "No Telphone", ccsText, "", CCGetRequestParam("mobile_phone_no", $Method, NULL), $this);
            $this->mobile_phone_no->Required = true;
            $this->t_customer_id = & new clsControl(ccsHidden, "t_customer_id", "t_customer_id", ccsFloat, "", CCGetRequestParam("t_customer_id", $Method, NULL), $this);
            $this->p_app_user_id = & new clsControl(ccsHidden, "p_app_user_id", "p_app_user_id", ccsFloat, "", CCGetRequestParam("p_app_user_id", $Method, NULL), $this);
            $this->user_pwd = & new clsControl(ccsHidden, "user_pwd", "user_pwd", ccsText, "", CCGetRequestParam("user_pwd", $Method, NULL), $this);
            $this->p_user_status_id = & new clsControl(ccsHidden, "p_user_status_id", "p_user_status_id", ccsFloat, "", CCGetRequestParam("p_user_status_id", $Method, NULL), $this);
            $this->t_customer_userGridPage = & new clsControl(ccsHidden, "t_customer_userGridPage", "t_customer_userGridPage", ccsText, "", CCGetRequestParam("t_customer_userGridPage", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->valid_from->Value) && !strlen($this->valid_from->Value) && $this->valid_from->Value !== false)
                    $this->valid_from->SetText(date("d-M-Y"));
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @23-573200C1
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_customer_user_id"] = CCGetFromGet("t_customer_user_id", NULL);
    }
//End Initialize Method

//Validate Method @23-2F6903BE
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_customer_user_id->Validate() && $Validation);
        $Validation = ($this->company_owner->Validate() && $Validation);
        $Validation = ($this->valid_from->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->valid_to->Validate() && $Validation);
        $Validation = ($this->user_name->Validate() && $Validation);
        $Validation = ($this->mobile_phone_no->Validate() && $Validation);
        $Validation = ($this->t_customer_id->Validate() && $Validation);
        $Validation = ($this->p_app_user_id->Validate() && $Validation);
        $Validation = ($this->user_pwd->Validate() && $Validation);
        $Validation = ($this->p_user_status_id->Validate() && $Validation);
        $Validation = ($this->t_customer_userGridPage->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_customer_user_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->company_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_from->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_to->Errors->Count() == 0);
        $Validation =  $Validation && ($this->user_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mobile_phone_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_app_user_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->user_pwd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_user_status_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_userGridPage->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-D2D4343C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_customer_user_id->Errors->Count());
        $errors = ($errors || $this->company_owner->Errors->Count());
        $errors = ($errors || $this->valid_from->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_from->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->valid_to->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_to->Errors->Count());
        $errors = ($errors || $this->user_name->Errors->Count());
        $errors = ($errors || $this->mobile_phone_no->Errors->Count());
        $errors = ($errors || $this->t_customer_id->Errors->Count());
        $errors = ($errors || $this->p_app_user_id->Errors->Count());
        $errors = ($errors || $this->user_pwd->Errors->Count());
        $errors = ($errors || $this->p_user_status_id->Errors->Count());
        $errors = ($errors || $this->t_customer_userGridPage->Errors->Count());
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

//Operation Method @23-6EFB3FDE
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
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_customer_user_id", "t_customer_userGridPage", "s_keyword"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_customer_user_id", "t_customer_userGridPage", "s_keyword"));
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
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @23-E11268CA
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->t_customer_id->SetValue($this->t_customer_id->GetValue(true));
        $this->DataSource->valid_from->SetValue($this->valid_from->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->user_name->SetValue($this->user_name->GetValue(true));
        $this->DataSource->user_pwd->SetValue($this->user_pwd->GetValue(true));
        $this->DataSource->p_user_status_id->SetValue($this->p_user_status_id->GetValue(true));
        $this->DataSource->mobile_phone_no->SetValue($this->mobile_phone_no->GetValue(true));
        $this->DataSource->p_app_user_id->SetValue($this->p_app_user_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @23-8DDDE53D
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_customer_id->SetValue($this->t_customer_id->GetValue(true));
        $this->DataSource->valid_from->SetValue($this->valid_from->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->t_customer_user_id->SetValue($this->t_customer_user_id->GetValue(true));
        $this->DataSource->user_name->SetValue($this->user_name->GetValue(true));
        $this->DataSource->user_pwd->SetValue($this->user_pwd->GetValue(true));
        $this->DataSource->p_user_status_id->SetValue($this->p_user_status_id->GetValue(true));
        $this->DataSource->mobile_phone_no->SetValue($this->mobile_phone_no->GetValue(true));
        $this->DataSource->p_app_user_id->SetValue($this->p_app_user_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-9C976262
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_customer_user_id->SetValue($this->t_customer_user_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-2C99E500
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
                    $this->t_customer_user_id->SetValue($this->DataSource->t_customer_user_id->GetValue());
                    $this->company_owner->SetValue($this->DataSource->company_owner->GetValue());
                    $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                    $this->user_name->SetValue($this->DataSource->user_name->GetValue());
                    $this->mobile_phone_no->SetValue($this->DataSource->mobile_phone_no->GetValue());
                    $this->t_customer_id->SetValue($this->DataSource->t_customer_id->GetValue());
                    $this->p_app_user_id->SetValue($this->DataSource->p_app_user_id->GetValue());
                    $this->user_pwd->SetValue($this->DataSource->user_pwd->GetValue());
                    $this->p_user_status_id->SetValue($this->DataSource->p_user_status_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_customer_user_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->company_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valid_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valid_to->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_to->Errors->ToString());
            $Error = ComposeStrings($Error, $this->user_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mobile_phone_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_app_user_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->user_pwd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_user_status_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_userGridPage->Errors->ToString());
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
        $this->t_customer_user_id->Show();
        $this->company_owner->Show();
        $this->valid_from->Show();
        $this->DatePicker_valid_from->Show();
        $this->description->Show();
        $this->creation_date->Show();
        $this->created_by->Show();
        $this->updated_date->Show();
        $this->updated_by->Show();
        $this->valid_to->Show();
        $this->DatePicker_valid_to->Show();
        $this->user_name->Show();
        $this->mobile_phone_no->Show();
        $this->t_customer_id->Show();
        $this->p_app_user_id->Show();
        $this->user_pwd->Show();
        $this->p_user_status_id->Show();
        $this->t_customer_userGridPage->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_customer_userForm Class @23-FCB6E20C

class clst_customer_userFormDataSource extends clsDBConnSIKP {  //t_customer_userFormDataSource Class @23-0546200F

//DataSource Variables @23-BFCB45C9
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
    var $t_customer_user_id;
    var $company_owner;
    var $valid_from;
    var $description;
    var $creation_date;
    var $created_by;
    var $updated_date;
    var $updated_by;
    var $valid_to;
    var $user_name;
    var $mobile_phone_no;
    var $t_customer_id;
    var $p_app_user_id;
    var $user_pwd;
    var $p_user_status_id;
    var $t_customer_userGridPage;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-F4D73C4B
    function clst_customer_userFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_customer_userForm/Error";
        $this->Initialize();
        $this->t_customer_user_id = new clsField("t_customer_user_id", ccsFloat, "");
        
        $this->company_owner = new clsField("company_owner", ccsText, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        
        $this->user_name = new clsField("user_name", ccsText, "");
        
        $this->mobile_phone_no = new clsField("mobile_phone_no", ccsText, "");
        
        $this->t_customer_id = new clsField("t_customer_id", ccsFloat, "");
        
        $this->p_app_user_id = new clsField("p_app_user_id", ccsFloat, "");
        
        $this->user_pwd = new clsField("user_pwd", ccsText, "");
        
        $this->p_user_status_id = new clsField("p_user_status_id", ccsFloat, "");
        
        $this->t_customer_userGridPage = new clsField("t_customer_userGridPage", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-3D31D63D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_customer_user_id", ccsFloat, "", "", $this->Parameters["urlt_customer_user_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_customer_user_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @23-D8448942
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM v_customer_user {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-62EB51A6
    function SetValues()
    {
        $this->t_customer_user_id->SetDBValue(trim($this->f("t_customer_user_id")));
        $this->company_owner->SetDBValue($this->f("company_owner"));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->description->SetDBValue($this->f("description"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
        $this->user_name->SetDBValue($this->f("user_name"));
        $this->mobile_phone_no->SetDBValue($this->f("mobile_phone_no"));
        $this->t_customer_id->SetDBValue(trim($this->f("t_customer_id")));
        $this->p_app_user_id->SetDBValue(trim($this->f("p_app_user_id")));
        $this->user_pwd->SetDBValue($this->f("user_pwd"));
        $this->p_user_status_id->SetDBValue(trim($this->f("p_user_status_id")));
    }
//End SetValues Method

//Insert Method @23-B536F0E1
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_customer_id"] = new clsSQLParameter("ctrlt_customer_id", ccsFloat, "", "", $this->t_customer_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["valid_from"] = new clsSQLParameter("ctrlvalid_from", ccsText, "", "", $this->valid_from->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr87", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr89", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["user_name"] = new clsSQLParameter("ctrluser_name", ccsText, "", "", $this->user_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["user_pwd"] = new clsSQLParameter("ctrluser_pwd", ccsText, "", "", $this->user_pwd->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_user_status_id"] = new clsSQLParameter("ctrlp_user_status_id", ccsFloat, "", "", $this->p_user_status_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["mobile_phone_no"] = new clsSQLParameter("ctrlmobile_phone_no", ccsText, "", "", $this->mobile_phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_app_user_id"] = new clsSQLParameter("ctrlp_app_user_id", ccsFloat, "", "", $this->p_app_user_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["t_customer_id"]->GetValue()) and !strlen($this->cp["t_customer_id"]->GetText()) and !is_bool($this->cp["t_customer_id"]->GetValue())) 
            $this->cp["t_customer_id"]->SetValue($this->t_customer_id->GetValue(true));
        if (!strlen($this->cp["t_customer_id"]->GetText()) and !is_bool($this->cp["t_customer_id"]->GetValue(true))) 
            $this->cp["t_customer_id"]->SetText(0);
        if (!is_null($this->cp["valid_from"]->GetValue()) and !strlen($this->cp["valid_from"]->GetText()) and !is_bool($this->cp["valid_from"]->GetValue())) 
            $this->cp["valid_from"]->SetValue($this->valid_from->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        if (!is_null($this->cp["user_name"]->GetValue()) and !strlen($this->cp["user_name"]->GetText()) and !is_bool($this->cp["user_name"]->GetValue())) 
            $this->cp["user_name"]->SetValue($this->user_name->GetValue(true));
        if (!is_null($this->cp["user_pwd"]->GetValue()) and !strlen($this->cp["user_pwd"]->GetText()) and !is_bool($this->cp["user_pwd"]->GetValue())) 
            $this->cp["user_pwd"]->SetValue($this->user_pwd->GetValue(true));
        if (!is_null($this->cp["p_user_status_id"]->GetValue()) and !strlen($this->cp["p_user_status_id"]->GetText()) and !is_bool($this->cp["p_user_status_id"]->GetValue())) 
            $this->cp["p_user_status_id"]->SetValue($this->p_user_status_id->GetValue(true));
        if (!strlen($this->cp["p_user_status_id"]->GetText()) and !is_bool($this->cp["p_user_status_id"]->GetValue(true))) 
            $this->cp["p_user_status_id"]->SetText(0);
        if (!is_null($this->cp["mobile_phone_no"]->GetValue()) and !strlen($this->cp["mobile_phone_no"]->GetText()) and !is_bool($this->cp["mobile_phone_no"]->GetValue())) 
            $this->cp["mobile_phone_no"]->SetValue($this->mobile_phone_no->GetValue(true));
        if (!is_null($this->cp["p_app_user_id"]->GetValue()) and !strlen($this->cp["p_app_user_id"]->GetText()) and !is_bool($this->cp["p_app_user_id"]->GetValue())) 
            $this->cp["p_app_user_id"]->SetValue($this->p_app_user_id->GetValue(true));
        if (!strlen($this->cp["p_app_user_id"]->GetText()) and !is_bool($this->cp["p_app_user_id"]->GetValue(true))) 
            $this->cp["p_app_user_id"]->SetText(0);
        $this->SQL = "INSERT INTO t_customer_user(t_customer_user_id, t_customer_id, valid_from, description, creation_date, created_by, updated_date, updated_by, valid_to, user_name, user_pwd, p_user_status_id, mobile_phone_no, p_app_user_id) \n" .
        "VALUES(generate_id('sikp','t_customer_user','t_customer_user_id'), " . $this->SQLValue($this->cp["t_customer_id"]->GetDBValue(), ccsFloat) . ", to_date('" . $this->SQLValue($this->cp["valid_from"]->GetDBValue(), ccsText) . "','dd-mon-yyyy'), '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "case when '" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "' = '' then null else to_date('" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "','dd-mon-yyyy') end, '" . $this->SQLValue($this->cp["user_name"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["user_pwd"]->GetDBValue(), ccsText) . "', " . $this->SQLValue($this->cp["p_user_status_id"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["mobile_phone_no"]->GetDBValue(), ccsText) . "', " . $this->SQLValue($this->cp["p_app_user_id"]->GetDBValue(), ccsFloat) . ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-709EF0BD
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_customer_id"] = new clsSQLParameter("ctrlt_customer_id", ccsFloat, "", "", $this->t_customer_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["valid_from"] = new clsSQLParameter("ctrlvalid_from", ccsText, "", "", $this->valid_from->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr64", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["t_customer_user_id"] = new clsSQLParameter("ctrlt_customer_user_id", ccsFloat, "", "", $this->t_customer_user_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["user_name"] = new clsSQLParameter("ctrluser_name", ccsText, "", "", $this->user_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["user_pwd"] = new clsSQLParameter("ctrluser_pwd", ccsText, "", "", $this->user_pwd->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_user_status_id"] = new clsSQLParameter("ctrlp_user_status_id", ccsFloat, "", "", $this->p_user_status_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["mobile_phone_no"] = new clsSQLParameter("ctrlmobile_phone_no", ccsText, "", "", $this->mobile_phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_app_user_id"] = new clsSQLParameter("ctrlp_app_user_id", ccsFloat, "", "", $this->p_app_user_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_customer_id"]->GetValue()) and !strlen($this->cp["t_customer_id"]->GetText()) and !is_bool($this->cp["t_customer_id"]->GetValue())) 
            $this->cp["t_customer_id"]->SetValue($this->t_customer_id->GetValue(true));
        if (!strlen($this->cp["t_customer_id"]->GetText()) and !is_bool($this->cp["t_customer_id"]->GetValue(true))) 
            $this->cp["t_customer_id"]->SetText(0);
        if (!is_null($this->cp["valid_from"]->GetValue()) and !strlen($this->cp["valid_from"]->GetText()) and !is_bool($this->cp["valid_from"]->GetValue())) 
            $this->cp["valid_from"]->SetValue($this->valid_from->GetValue(true));
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["t_customer_user_id"]->GetValue()) and !strlen($this->cp["t_customer_user_id"]->GetText()) and !is_bool($this->cp["t_customer_user_id"]->GetValue())) 
            $this->cp["t_customer_user_id"]->SetValue($this->t_customer_user_id->GetValue(true));
        if (!strlen($this->cp["t_customer_user_id"]->GetText()) and !is_bool($this->cp["t_customer_user_id"]->GetValue(true))) 
            $this->cp["t_customer_user_id"]->SetText(0);
        if (!is_null($this->cp["user_name"]->GetValue()) and !strlen($this->cp["user_name"]->GetText()) and !is_bool($this->cp["user_name"]->GetValue())) 
            $this->cp["user_name"]->SetValue($this->user_name->GetValue(true));
        if (!is_null($this->cp["user_pwd"]->GetValue()) and !strlen($this->cp["user_pwd"]->GetText()) and !is_bool($this->cp["user_pwd"]->GetValue())) 
            $this->cp["user_pwd"]->SetValue($this->user_pwd->GetValue(true));
        if (!is_null($this->cp["p_user_status_id"]->GetValue()) and !strlen($this->cp["p_user_status_id"]->GetText()) and !is_bool($this->cp["p_user_status_id"]->GetValue())) 
            $this->cp["p_user_status_id"]->SetValue($this->p_user_status_id->GetValue(true));
        if (!strlen($this->cp["p_user_status_id"]->GetText()) and !is_bool($this->cp["p_user_status_id"]->GetValue(true))) 
            $this->cp["p_user_status_id"]->SetText(0);
        if (!is_null($this->cp["mobile_phone_no"]->GetValue()) and !strlen($this->cp["mobile_phone_no"]->GetText()) and !is_bool($this->cp["mobile_phone_no"]->GetValue())) 
            $this->cp["mobile_phone_no"]->SetValue($this->mobile_phone_no->GetValue(true));
        if (!is_null($this->cp["p_app_user_id"]->GetValue()) and !strlen($this->cp["p_app_user_id"]->GetText()) and !is_bool($this->cp["p_app_user_id"]->GetValue())) 
            $this->cp["p_app_user_id"]->SetValue($this->p_app_user_id->GetValue(true));
        if (!strlen($this->cp["p_app_user_id"]->GetText()) and !is_bool($this->cp["p_app_user_id"]->GetValue(true))) 
            $this->cp["p_app_user_id"]->SetText(0);
        $this->SQL = "UPDATE t_customer_user SET \n" .
        "t_customer_id=" . $this->SQLValue($this->cp["t_customer_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "valid_from=to_date('" . $this->SQLValue($this->cp["valid_from"]->GetDBValue(), ccsText) . "','dd-mon-yyyy'), \n" .
        "valid_to=case when '" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "' = '' then null else to_date('" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "','dd-mon-yyyy') end, \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "',\n" .
        "user_name='" . $this->SQLValue($this->cp["user_name"]->GetDBValue(), ccsText) . "', \n" .
        "user_pwd='" . $this->SQLValue($this->cp["user_pwd"]->GetDBValue(), ccsText) . "', \n" .
        "p_user_status_id=" . $this->SQLValue($this->cp["p_user_status_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "mobile_phone_no='" . $this->SQLValue($this->cp["mobile_phone_no"]->GetDBValue(), ccsText) . "', \n" .
        "p_app_user_id=" . $this->SQLValue($this->cp["p_app_user_id"]->GetDBValue(), ccsFloat) . "\n" .
        "WHERE t_customer_user_id = " . $this->SQLValue($this->cp["t_customer_user_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-B38DEE74
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_customer_user_id"] = new clsSQLParameter("ctrlt_customer_user_id", ccsFloat, "", "", $this->t_customer_user_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_customer_user_id"]->GetValue()) and !strlen($this->cp["t_customer_user_id"]->GetText()) and !is_bool($this->cp["t_customer_user_id"]->GetValue())) 
            $this->cp["t_customer_user_id"]->SetValue($this->t_customer_user_id->GetValue(true));
        if (!strlen($this->cp["t_customer_user_id"]->GetText()) and !is_bool($this->cp["t_customer_user_id"]->GetValue(true))) 
            $this->cp["t_customer_user_id"]->SetText(0);
        $this->SQL = "DELETE FROM t_customer_user\n" .
        "WHERE t_customer_user_id = " . $this->SQLValue($this->cp["t_customer_user_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_customer_userFormDataSource Class @23-FCB6E20C

//Initialize Page @1-E1810875
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
$TemplateFileName = "t_customer_user.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-2EEA6987
include_once("./t_customer_user_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-2A874652
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_customer_userGrid = & new clsGridt_customer_userGrid("", $MainPage);
$t_customer_userSearch = & new clsRecordt_customer_userSearch("", $MainPage);
$t_customer_userForm = & new clsRecordt_customer_userForm("", $MainPage);
$MainPage->t_customer_userGrid = & $t_customer_userGrid;
$MainPage->t_customer_userSearch = & $t_customer_userSearch;
$MainPage->t_customer_userForm = & $t_customer_userForm;
$t_customer_userGrid->Initialize();
$t_customer_userForm->Initialize();

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

//Execute Components @1-63A6BEEB
$t_customer_userSearch->Operation();
$t_customer_userForm->Operation();
//End Execute Components

//Go to destination page @1-3B10D10C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_customer_userGrid);
    unset($t_customer_userSearch);
    unset($t_customer_userForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-DA4ED508
$t_customer_userGrid->Show();
$t_customer_userSearch->Show();
$t_customer_userForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-6AADDFE3
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_customer_userGrid);
unset($t_customer_userSearch);
unset($t_customer_userForm);
unset($Tpl);
//End Unload Page


?>
