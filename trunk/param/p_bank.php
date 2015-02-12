<?php
//Include Common Files @1-DB104F50
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_bank.php");
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

//Class_Initialize Event @2-21653E36
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
        $this->DLink->Page = "p_bank.php";
        $this->bank_name = & new clsControl(ccsLabel, "bank_name", "bank_name", ccsText, "", CCGetRequestParam("bank_name", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->code = & new clsControl(ccsLabel, "code", "code", ccsText, "", CCGetRequestParam("code", ccsGet, NULL), $this);
        $this->p_bank_id = & new clsControl(ccsHidden, "p_bank_id", "p_bank_id", ccsFloat, "", CCGetRequestParam("p_bank_id", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_bank.php";
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

//Show Method @2-270F6CA5
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
            $this->ControlsVisible["bank_name"] = $this->bank_name->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["code"] = $this->code->Visible;
            $this->ControlsVisible["p_bank_id"] = $this->p_bank_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_bank_id", $this->DataSource->f("p_bank_id"));
                $this->bank_name->SetValue($this->DataSource->bank_name->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->code->SetValue($this->DataSource->code->GetValue());
                $this->p_bank_id->SetValue($this->DataSource->p_bank_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->bank_name->Show();
                $this->description->Show();
                $this->code->Show();
                $this->p_bank_id->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_bank_id", "ccsForm"));
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

//GetErrors Method @2-B70AAA28
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->bank_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_bank_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_app_userGrid Class @2-FCB6E20C

class clsp_app_userGridDataSource extends clsDBConnSIKP {  //p_app_userGridDataSource Class @2-56E5BB0D

//DataSource Variables @2-213200C8
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $bank_name;
    var $description;
    var $code;
    var $p_bank_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-731E60C1
    function clsp_app_userGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_app_userGrid";
        $this->Initialize();
        $this->bank_name = new clsField("bank_name", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->code = new clsField("code", ccsText, "");
        
        $this->p_bank_id = new clsField("p_bank_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-1276406B
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_bank_id";
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

//Open Method @2-7034DF1E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT * \n" .
        "FROM p_bank\n" .
        "WHERE ( bank_name ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR code ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR description ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' )) cnt";
        $this->SQL = "SELECT * \n" .
        "FROM p_bank\n" .
        "WHERE ( bank_name ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR code ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR description ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' )  {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-F1509C74
    function SetValues()
    {
        $this->bank_name->SetDBValue($this->f("bank_name"));
        $this->description->SetDBValue($this->f("description"));
        $this->code->SetDBValue($this->f("code"));
        $this->p_bank_id->SetDBValue(trim($this->f("p_bank_id")));
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

//Operation Method @3-4F216CF4
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
        $Redirect = "p_bank.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_bank.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

//Class_Initialize Event @94-EE5F2995
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
        $this->UpdateAllowed = true;
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
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->p_bank_id = & new clsControl(ccsHidden, "p_bank_id", "P Bank Id", ccsFloat, "", CCGetRequestParam("p_bank_id", $Method, NULL), $this);
            $this->bank_name = & new clsControl(ccsTextBox, "bank_name", "Nama Bank", ccsText, "", CCGetRequestParam("bank_name", $Method, NULL), $this);
            $this->bank_name->Required = true;
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->code = & new clsControl(ccsTextBox, "code", "Kode", ccsText, "", CCGetRequestParam("code", $Method, NULL), $this);
            $this->update_by = & new clsControl(ccsTextBox, "update_by", "Update By", ccsText, "", CCGetRequestParam("update_by", $Method, NULL), $this);
            $this->update_date = & new clsControl(ccsTextBox, "update_date", "Update Date", ccsText, "", CCGetRequestParam("update_date", $Method, NULL), $this);
            $this->p_app_userGridPage = & new clsControl(ccsHidden, "p_app_userGridPage", "p_app_userGridPage", ccsText, "", CCGetRequestParam("p_app_userGridPage", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->update_by->Value) && !strlen($this->update_by->Value) && $this->update_by->Value !== false)
                    $this->update_by->SetText(CCGetUserLogin());
                if(!is_array($this->update_date->Value) && !strlen($this->update_date->Value) && $this->update_date->Value !== false)
                    $this->update_date->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-641107CF
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_bank_id"] = CCGetFromGet("p_bank_id", NULL);
    }
//End Initialize Method

//Validate Method @94-123BC728
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_bank_id->Validate() && $Validation);
        $Validation = ($this->bank_name->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->code->Validate() && $Validation);
        $Validation = ($this->update_by->Validate() && $Validation);
        $Validation = ($this->update_date->Validate() && $Validation);
        $Validation = ($this->p_app_userGridPage->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_bank_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bank_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->update_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->update_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_app_userGridPage->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-D2D9D05F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_bank_id->Errors->Count());
        $errors = ($errors || $this->bank_name->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->code->Errors->Count());
        $errors = ($errors || $this->update_by->Errors->Count());
        $errors = ($errors || $this->update_date->Errors->Count());
        $errors = ($errors || $this->p_app_userGridPage->Errors->Count());
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

//Operation Method @94-CC38CD9A
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

//InsertRow Method @94-B01CF0CE
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->bank_name->SetValue($this->bank_name->GetValue(true));
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->update_by->SetValue($this->update_by->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-3B0D3875
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->bank_name->SetValue($this->bank_name->GetValue(true));
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->p_bank_id->SetValue($this->p_bank_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-9FF1237B
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_bank_id->SetValue($this->p_bank_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-EF97083B
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
                    $this->p_bank_id->SetValue($this->DataSource->p_bank_id->GetValue());
                    $this->bank_name->SetValue($this->DataSource->bank_name->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->code->SetValue($this->DataSource->code->GetValue());
                    $this->update_by->SetValue($this->DataSource->update_by->GetValue());
                    $this->update_date->SetValue($this->DataSource->update_date->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_bank_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bank_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->update_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->update_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_app_userGridPage->Errors->ToString());
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
        $this->p_bank_id->Show();
        $this->bank_name->Show();
        $this->description->Show();
        $this->code->Show();
        $this->update_by->Show();
        $this->update_date->Show();
        $this->p_app_userGridPage->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_app_userForm Class @94-FCB6E20C

class clsp_app_userFormDataSource extends clsDBConnSIKP {  //p_app_userFormDataSource Class @94-09D22DF9

//DataSource Variables @94-ADF6AFCC
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
    var $p_bank_id;
    var $bank_name;
    var $description;
    var $code;
    var $update_by;
    var $update_date;
    var $p_app_userGridPage;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-AE5F93D8
    function clsp_app_userFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_app_userForm/Error";
        $this->Initialize();
        $this->p_bank_id = new clsField("p_bank_id", ccsFloat, "");
        
        $this->bank_name = new clsField("bank_name", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->code = new clsField("code", ccsText, "");
        
        $this->update_by = new clsField("update_by", ccsText, "");
        
        $this->update_date = new clsField("update_date", ccsText, "");
        
        $this->p_app_userGridPage = new clsField("p_app_userGridPage", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-575865BE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_bank_id", ccsFloat, "", "", $this->Parameters["urlp_bank_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-DBD82D46
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT p_bank_id, bank_name, description,code,\n" .
        "to_char(update_date,'DD-MON-YYYY') AS update_date,\n" .
        "update_by \n" .
        "FROM p_bank\n" .
        "WHERE p_bank_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-DF75DA6C
    function SetValues()
    {
        $this->p_bank_id->SetDBValue(trim($this->f("p_bank_id")));
        $this->bank_name->SetDBValue($this->f("bank_name"));
        $this->description->SetDBValue($this->f("description"));
        $this->code->SetDBValue($this->f("code"));
        $this->update_by->SetDBValue($this->f("update_by"));
        $this->update_date->SetDBValue($this->f("update_date"));
    }
//End SetValues Method

//Insert Method @94-9B03A415
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["bank_name"] = new clsSQLParameter("ctrlbank_name", ccsText, "", "", $this->bank_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["update_by"] = new clsSQLParameter("ctrlupdate_by", ccsText, "", "", $this->update_by->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["bank_name"]->GetValue()) and !strlen($this->cp["bank_name"]->GetText()) and !is_bool($this->cp["bank_name"]->GetValue())) 
            $this->cp["bank_name"]->SetValue($this->bank_name->GetValue(true));
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["update_by"]->GetValue()) and !strlen($this->cp["update_by"]->GetText()) and !is_bool($this->cp["update_by"]->GetValue())) 
            $this->cp["update_by"]->SetValue($this->update_by->GetValue(true));
        $this->SQL = "INSERT INTO p_bank(p_bank_id, \n" .
        "bank_name, \n" .
        "code, \n" .
        "description, \n" .
        "update_by, \n" .
        "update_date \n" .
        ") VALUES\n" .
        "(generate_id('sikp','p_bank','p_bank_id'), \n" .
        "'" . $this->SQLValue($this->cp["bank_name"]->GetDBValue(), ccsText) . "',  \n" .
        "'" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["update_by"]->GetDBValue(), ccsText) . "', \n" .
        "sysdate)";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-7D10C5DE
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["update_by"] = new clsSQLParameter("expr260", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["bank_name"] = new clsSQLParameter("ctrlbank_name", ccsText, "", "", $this->bank_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_bank_id"] = new clsSQLParameter("ctrlp_bank_id", ccsText, "", "", $this->p_bank_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["update_by"]->GetValue()) and !strlen($this->cp["update_by"]->GetText()) and !is_bool($this->cp["update_by"]->GetValue())) 
            $this->cp["update_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["bank_name"]->GetValue()) and !strlen($this->cp["bank_name"]->GetText()) and !is_bool($this->cp["bank_name"]->GetValue())) 
            $this->cp["bank_name"]->SetValue($this->bank_name->GetValue(true));
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["p_bank_id"]->GetValue()) and !strlen($this->cp["p_bank_id"]->GetText()) and !is_bool($this->cp["p_bank_id"]->GetValue())) 
            $this->cp["p_bank_id"]->SetValue($this->p_bank_id->GetValue(true));
        $this->SQL = "UPDATE p_bank SET  \n" .
        "bank_name='" . $this->SQLValue($this->cp["bank_name"]->GetDBValue(), ccsText) . "', \n" .
        "code='" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "',\n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "update_by='" . $this->SQLValue($this->cp["update_by"]->GetDBValue(), ccsText) . "', \n" .
        "update_date=sysdate\n" .
        "WHERE p_bank_id=" . $this->SQLValue($this->cp["p_bank_id"]->GetDBValue(), ccsText) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-9EA4EE2A
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_bank_id"] = new clsSQLParameter("ctrlp_bank_id", ccsFloat, "", "", $this->p_bank_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_bank_id"]->GetValue()) and !strlen($this->cp["p_bank_id"]->GetText()) and !is_bool($this->cp["p_bank_id"]->GetValue())) 
            $this->cp["p_bank_id"]->SetValue($this->p_bank_id->GetValue(true));
        if (!strlen($this->cp["p_bank_id"]->GetText()) and !is_bool($this->cp["p_bank_id"]->GetValue(true))) 
            $this->cp["p_bank_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_bank WHERE  p_bank_id = " . $this->SQLValue($this->cp["p_bank_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_app_userFormDataSource Class @94-FCB6E20C

//Initialize Page @1-4D786F01
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
$TemplateFileName = "p_bank.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-8B84EA4A
include_once("./p_bank_events.php");
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
