<?php
//Include Common Files @1-1E8944E2
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_app_menu.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_app_menuGrid { //p_app_menuGrid class @2-F025E7F0

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

//Class_Initialize Event @2-3D96CFEE
    function clsGridp_app_menuGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_app_menuGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_app_menuGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_app_menuGridDataSource($this);
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
        $this->DLink->Page = "p_app_menu.php";
        $this->code = & new clsControl(ccsLabel, "code", "code", ccsText, "", CCGetRequestParam("code", ccsGet, NULL), $this);
        $this->file_name = & new clsControl(ccsLabel, "file_name", "file_name", ccsText, "", CCGetRequestParam("file_name", ccsGet, NULL), $this);
        $this->is_active = & new clsControl(ccsLabel, "is_active", "is_active", ccsText, "", CCGetRequestParam("is_active", ccsGet, NULL), $this);
        $this->p_app_menu_id = & new clsControl(ccsHidden, "p_app_menu_id", "p_app_menu_id", ccsFloat, "", CCGetRequestParam("p_app_menu_id", ccsGet, NULL), $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "p_app_role_menu.php";
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_app_menu.php";
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

//Show Method @2-1E5CEBAD
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["urlp_application_id"] = CCGetFromGet("p_application_id", NULL);
        $this->DataSource->Parameters["urlparent_id"] = CCGetFromGet("parent_id", NULL);

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
            $this->ControlsVisible["code"] = $this->code->Visible;
            $this->ControlsVisible["file_name"] = $this->file_name->Visible;
            $this->ControlsVisible["is_active"] = $this->is_active->Visible;
            $this->ControlsVisible["p_app_menu_id"] = $this->p_app_menu_id->Visible;
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_app_menu_id", $this->DataSource->f("p_app_menu_id"));
                $this->code->SetValue($this->DataSource->code->GetValue());
                $this->file_name->SetValue($this->DataSource->file_name->GetValue());
                $this->is_active->SetValue($this->DataSource->is_active->GetValue());
                $this->p_app_menu_id->SetValue($this->DataSource->p_app_menu_id->GetValue());
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("s_keyword", "ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "p_app_menu_id", $this->DataSource->f("p_app_menu_id"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "code", $this->DataSource->f("code"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "p_app_menuGridPage", CCGetFromGet("p_app_menuGridPage", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "p_application_id", CCGetFromGet("p_application_id", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "app_s_keyword", CCGetFromGet("app_s_keyword", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "menu_s_keyword", CCGetFromGet("s_keyword", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "parent_id", CCGetFromGet("parent_id", NULL));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->code->Show();
                $this->file_name->Show();
                $this->is_active->Show();
                $this->p_app_menu_id->Show();
                $this->ImageLink1->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_app_menu_id", "s_keyword", "ccsForm"));
        $this->Insert_Link->Parameters = CCAddParam($this->Insert_Link->Parameters, "FLAG", "ADD");
        $this->Navigator->Show();
        $this->Insert_Link->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-48B8E3FD
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->file_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->is_active->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_app_menu_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_app_menuGrid Class @2-FCB6E20C

class clsp_app_menuGridDataSource extends clsDBConnSIKP {  //p_app_menuGridDataSource Class @2-889D0144

//DataSource Variables @2-8C8339DA
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $code;
    var $file_name;
    var $is_active;
    var $p_app_menu_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-9F1DA9B2
    function clsp_app_menuGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_app_menuGrid";
        $this->Initialize();
        $this->code = new clsField("code", ccsText, "");
        
        $this->file_name = new clsField("file_name", ccsText, "");
        
        $this->is_active = new clsField("is_active", ccsText, "");
        
        $this->p_app_menu_id = new clsField("p_app_menu_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-4068EE0C
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_app_menu_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-4411AF29
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("3", "urlp_application_id", ccsFloat, "", "", $this->Parameters["urlp_application_id"], "", false);
        $this->wp->AddParameter("4", "urlparent_id", ccsFloat, "", "", $this->Parameters["urlparent_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "code", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "description", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "p_application_id", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsFloat),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "nvl(parent_id,0)", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsFloat),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opOR(
             true, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]);
    }
//End Prepare Method

//Open Method @2-006F94B5
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM p_app_menu";
        $this->SQL = "SELECT p_app_menu_id, p_application_id, code, file_name, decode(is_active,'Y','YA','TIDAK') AS is_active \n\n" .
        "FROM p_app_menu {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method


//SetValues Method @2-657E8404
    function SetValues()
    {
        $this->code->SetDBValue($this->f("code"));
        $this->file_name->SetDBValue($this->f("file_name"));
        $this->is_active->SetDBValue($this->f("is_active"));
        $this->p_app_menu_id->SetDBValue(trim($this->f("p_app_menu_id")));
    }
//End SetValues Method

} //End p_app_menuGridDataSource Class @2-FCB6E20C

class clsRecordp_app_menuSearch { //p_app_menuSearch Class @3-F59E607D

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

//Class_Initialize Event @3-29FDE73A
    function clsRecordp_app_menuSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_app_menuSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_app_menuSearch";
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
            $this->p_application_id = & new clsControl(ccsHidden, "p_application_id", "p_application_id", ccsFloat, "", CCGetRequestParam("p_application_id", $Method, NULL), $this);
            $this->p_applicationGridPage = & new clsControl(ccsHidden, "p_applicationGridPage", "p_applicationGridPage", ccsText, "", CCGetRequestParam("p_applicationGridPage", $Method, NULL), $this);
            $this->app_s_keyword = & new clsControl(ccsHidden, "app_s_keyword", "app_s_keyword", ccsText, "", CCGetRequestParam("app_s_keyword", $Method, NULL), $this);
            $this->parent_id = & new clsControl(ccsHidden, "parent_id", "parent_id", ccsText, "", CCGetRequestParam("parent_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-58ACB16B
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->p_application_id->Validate() && $Validation);
        $Validation = ($this->p_applicationGridPage->Validate() && $Validation);
        $Validation = ($this->app_s_keyword->Validate() && $Validation);
        $Validation = ($this->parent_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_application_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_applicationGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->app_s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->parent_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-FF9E7B5E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->p_application_id->Errors->Count());
        $errors = ($errors || $this->p_applicationGridPage->Errors->Count());
        $errors = ($errors || $this->app_s_keyword->Errors->Count());
        $errors = ($errors || $this->parent_id->Errors->Count());
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

//Operation Method @3-923CEFE3
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
        $Redirect = "p_app_menu.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_app_menu.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-F3A61C0C
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
            $Error = ComposeStrings($Error, $this->p_application_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_applicationGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->app_s_keyword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->parent_id->Errors->ToString());
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
        $this->p_application_id->Show();
        $this->p_applicationGridPage->Show();
        $this->app_s_keyword->Show();
        $this->parent_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End p_app_menuSearch Class @3-FCB6E20C

class clsRecordp_app_menuForm { //p_app_menuForm Class @23-A24EAA3E

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

//Class_Initialize Event @23-6C87861B
    function clsRecordp_app_menuForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_app_menuForm/Error";
        $this->DataSource = new clsp_app_menuFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_app_menuForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->code = & new clsControl(ccsTextBox, "code", "Code", ccsText, "", CCGetRequestParam("code", $Method, NULL), $this);
            $this->code->Required = true;
            $this->file_name = & new clsControl(ccsTextBox, "file_name", "Nama File", ccsText, "", CCGetRequestParam("file_name", $Method, NULL), $this);
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->parent_id = & new clsControl(ccsTextBox, "parent_id", "Parent Id", ccsFloat, "", CCGetRequestParam("parent_id", $Method, NULL), $this);
            $this->listing_no = & new clsControl(ccsTextBox, "listing_no", "No Urut", ccsFloat, "", CCGetRequestParam("listing_no", $Method, NULL), $this);
            $this->listing_no->Required = true;
            $this->is_active = & new clsControl(ccsListBox, "is_active", "Aktif?", ccsText, "", CCGetRequestParam("is_active", $Method, NULL), $this);
            $this->is_active->DSType = dsListOfValues;
            $this->is_active->Values = array(array("Y", "YA"), array("N", "TIDAK"));
            $this->is_active->Required = true;
            $this->p_app_menu_id = & new clsControl(ccsHidden, "p_app_menu_id", "p_app_menu_id", ccsFloat, "", CCGetRequestParam("p_app_menu_id", $Method, NULL), $this);
            $this->p_application_id = & new clsControl(ccsHidden, "p_application_id", "p_application_id", ccsFloat, "", CCGetRequestParam("p_application_id", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
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

//Initialize Method @23-A2E13F36
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_app_menu_id"] = CCGetFromGet("p_app_menu_id", NULL);
    }
//End Initialize Method

//Validate Method @23-2AFE3163
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->code->Validate() && $Validation);
        $Validation = ($this->file_name->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->parent_id->Validate() && $Validation);
        $Validation = ($this->listing_no->Validate() && $Validation);
        $Validation = ($this->is_active->Validate() && $Validation);
        $Validation = ($this->p_app_menu_id->Validate() && $Validation);
        $Validation = ($this->p_application_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->file_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->parent_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->listing_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_active->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_app_menu_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_application_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-81213774
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->code->Errors->Count());
        $errors = ($errors || $this->file_name->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->parent_id->Errors->Count());
        $errors = ($errors || $this->listing_no->Errors->Count());
        $errors = ($errors || $this->is_active->Errors->Count());
        $errors = ($errors || $this->p_app_menu_id->Errors->Count());
        $errors = ($errors || $this->p_application_id->Errors->Count());
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

//Operation Method @23-7D22D2C2
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
            if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "p_app_menu_id", "s_keyword", "FLAG", "p_app_menuGridPage"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "p_app_menu_id", "s_keyword", "FLAG", "p_app_menuGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Insert") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
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

//InsertRow Method @23-DF80D3A4
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->file_name->SetValue($this->file_name->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->parent_id->SetValue($this->parent_id->GetValue(true));
        $this->DataSource->listing_no->SetValue($this->listing_no->GetValue(true));
        $this->DataSource->is_active->SetValue($this->is_active->GetValue(true));
        $this->DataSource->p_application_id->SetValue($this->p_application_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @23-51A89715
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->file_name->SetValue($this->file_name->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->listing_no->SetValue($this->listing_no->GetValue(true));
        $this->DataSource->is_active->SetValue($this->is_active->GetValue(true));
        $this->DataSource->p_app_menu_id->SetValue($this->p_app_menu_id->GetValue(true));
        $this->DataSource->p_application_id->SetValue($this->p_application_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-43C892B6
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_app_menu_id->SetValue($this->p_app_menu_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-F612F2C0
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

        $this->is_active->Prepare();

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
                    $this->code->SetValue($this->DataSource->code->GetValue());
                    $this->file_name->SetValue($this->DataSource->file_name->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->parent_id->SetValue($this->DataSource->parent_id->GetValue());
                    $this->listing_no->SetValue($this->DataSource->listing_no->GetValue());
                    $this->is_active->SetValue($this->DataSource->is_active->GetValue());
                    $this->p_app_menu_id->SetValue($this->DataSource->p_app_menu_id->GetValue());
                    $this->p_application_id->SetValue($this->DataSource->p_application_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->file_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->parent_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->listing_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_active->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_app_menu_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_application_id->Errors->ToString());
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
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->code->Show();
        $this->file_name->Show();
        $this->description->Show();
        $this->creation_date->Show();
        $this->created_by->Show();
        $this->updated_date->Show();
        $this->updated_by->Show();
        $this->Button_Cancel->Show();
        $this->Button_Delete->Show();
        $this->Button_Update->Show();
        $this->Button_Insert->Show();
        $this->parent_id->Show();
        $this->listing_no->Show();
        $this->is_active->Show();
        $this->p_app_menu_id->Show();
        $this->p_application_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_app_menuForm Class @23-FCB6E20C

class clsp_app_menuFormDataSource extends clsDBConnSIKP {  //p_app_menuFormDataSource Class @23-D7AA97B0

//DataSource Variables @23-61AEB443
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
    var $code;
    var $file_name;
    var $description;
    var $creation_date;
    var $created_by;
    var $updated_date;
    var $updated_by;
    var $parent_id;
    var $listing_no;
    var $is_active;
    var $p_app_menu_id;
    var $p_application_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-13BD3801
    function clsp_app_menuFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_app_menuForm/Error";
        $this->Initialize();
        $this->code = new clsField("code", ccsText, "");
        
        $this->file_name = new clsField("file_name", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->parent_id = new clsField("parent_id", ccsFloat, "");
        
        $this->listing_no = new clsField("listing_no", ccsFloat, "");
        
        $this->is_active = new clsField("is_active", ccsText, "");
        
        $this->p_app_menu_id = new clsField("p_app_menu_id", ccsFloat, "");
        
        $this->p_application_id = new clsField("p_application_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-D55776F9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_app_menu_id", ccsFloat, "", "", $this->Parameters["urlp_app_menu_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "p_app_menu_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @23-59650083
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT p_app_menu_id, p_application_id, code, parent_id, file_name, listing_no, is_active, description, updated_by, to_char(updated_date,'DD-MON-YYYY') AS updated_date,\n\n" .
        "created_by, to_char(creation_date,'DD-MON-YYYY') AS creation_date \n\n" .
        "FROM p_app_menu {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-AAF9EC46
    function SetValues()
    {
        $this->code->SetDBValue($this->f("code"));
        $this->file_name->SetDBValue($this->f("file_name"));
        $this->description->SetDBValue($this->f("description"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->parent_id->SetDBValue(trim($this->f("parent_id")));
        $this->listing_no->SetDBValue(trim($this->f("listing_no")));
        $this->is_active->SetDBValue($this->f("is_active"));
        $this->p_app_menu_id->SetDBValue(trim($this->f("p_app_menu_id")));
        $this->p_application_id->SetDBValue(trim($this->f("p_application_id")));
    }
//End SetValues Method

//Insert Method @23-4F27BE48
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["file_name"] = new clsSQLParameter("ctrlfile_name", ccsText, "", "", $this->file_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr152", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr154", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["parent_id"] = new clsSQLParameter("ctrlparent_id", ccsFloat, "", "", $this->parent_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["listing_no"] = new clsSQLParameter("ctrllisting_no", ccsFloat, "", "", $this->listing_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_active"] = new clsSQLParameter("ctrlis_active", ccsText, "", "", $this->is_active->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_application_id"] = new clsSQLParameter("ctrlp_application_id", ccsFloat, "", "", $this->p_application_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["file_name"]->GetValue()) and !strlen($this->cp["file_name"]->GetText()) and !is_bool($this->cp["file_name"]->GetValue())) 
            $this->cp["file_name"]->SetValue($this->file_name->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["parent_id"]->GetValue()) and !strlen($this->cp["parent_id"]->GetText()) and !is_bool($this->cp["parent_id"]->GetValue())) 
            $this->cp["parent_id"]->SetValue($this->parent_id->GetValue(true));
        if (!is_null($this->cp["listing_no"]->GetValue()) and !strlen($this->cp["listing_no"]->GetText()) and !is_bool($this->cp["listing_no"]->GetValue())) 
            $this->cp["listing_no"]->SetValue($this->listing_no->GetValue(true));
        if (!is_null($this->cp["is_active"]->GetValue()) and !strlen($this->cp["is_active"]->GetText()) and !is_bool($this->cp["is_active"]->GetValue())) 
            $this->cp["is_active"]->SetValue($this->is_active->GetValue(true));
        if (!is_null($this->cp["p_application_id"]->GetValue()) and !strlen($this->cp["p_application_id"]->GetText()) and !is_bool($this->cp["p_application_id"]->GetValue())) 
            $this->cp["p_application_id"]->SetValue($this->p_application_id->GetValue(true));
        if (!strlen($this->cp["p_application_id"]->GetText()) and !is_bool($this->cp["p_application_id"]->GetValue(true))) 
            $this->cp["p_application_id"]->SetText(0);
        $this->SQL = "INSERT INTO p_app_menu(p_app_menu_id, code, file_name, description, creation_date, created_by, updated_date, updated_by, parent_id, listing_no, is_active, p_application_id) \n" .
        "VALUES(generate_id('sikp','p_app_menu','p_app_menu_id'), '" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["file_name"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', decode(" . $this->SQLValue($this->cp["parent_id"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["parent_id"]->GetDBValue(), ccsFloat) . "), " . $this->SQLValue($this->cp["listing_no"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["is_active"]->GetDBValue(), ccsText) . "'," . $this->SQLValue($this->cp["p_application_id"]->GetDBValue(), ccsFloat) . ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-1CD509ED
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["file_name"] = new clsSQLParameter("ctrlfile_name", ccsText, "", "", $this->file_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr192", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["listing_no"] = new clsSQLParameter("ctrllisting_no", ccsFloat, "", "", $this->listing_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_active"] = new clsSQLParameter("ctrlis_active", ccsText, "", "", $this->is_active->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_app_menu_id"] = new clsSQLParameter("ctrlp_app_menu_id", ccsFloat, "", "", $this->p_app_menu_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_application_id"] = new clsSQLParameter("ctrlp_application_id", ccsFloat, "", "", $this->p_application_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["file_name"]->GetValue()) and !strlen($this->cp["file_name"]->GetText()) and !is_bool($this->cp["file_name"]->GetValue())) 
            $this->cp["file_name"]->SetValue($this->file_name->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["listing_no"]->GetValue()) and !strlen($this->cp["listing_no"]->GetText()) and !is_bool($this->cp["listing_no"]->GetValue())) 
            $this->cp["listing_no"]->SetValue($this->listing_no->GetValue(true));
        if (!is_null($this->cp["is_active"]->GetValue()) and !strlen($this->cp["is_active"]->GetText()) and !is_bool($this->cp["is_active"]->GetValue())) 
            $this->cp["is_active"]->SetValue($this->is_active->GetValue(true));
        if (!is_null($this->cp["p_app_menu_id"]->GetValue()) and !strlen($this->cp["p_app_menu_id"]->GetText()) and !is_bool($this->cp["p_app_menu_id"]->GetValue())) 
            $this->cp["p_app_menu_id"]->SetValue($this->p_app_menu_id->GetValue(true));
        if (!strlen($this->cp["p_app_menu_id"]->GetText()) and !is_bool($this->cp["p_app_menu_id"]->GetValue(true))) 
            $this->cp["p_app_menu_id"]->SetText(0);
        if (!is_null($this->cp["p_application_id"]->GetValue()) and !strlen($this->cp["p_application_id"]->GetText()) and !is_bool($this->cp["p_application_id"]->GetValue())) 
            $this->cp["p_application_id"]->SetValue($this->p_application_id->GetValue(true));
        if (!strlen($this->cp["p_application_id"]->GetText()) and !is_bool($this->cp["p_application_id"]->GetValue(true))) 
            $this->cp["p_application_id"]->SetText(0);
        $this->SQL = "UPDATE p_app_menu SET \n" .
        "code='" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "', \n" .
        "listing_no=" . $this->SQLValue($this->cp["listing_no"]->GetDBValue(), ccsFloat) . ", \n" .
        "file_name='" . $this->SQLValue($this->cp["file_name"]->GetDBValue(), ccsText) . "', \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "is_active='" . $this->SQLValue($this->cp["is_active"]->GetDBValue(), ccsText) . "' \n" .
        "WHERE p_app_menu_id = " . $this->SQLValue($this->cp["p_app_menu_id"]->GetDBValue(), ccsFloat) . "\n" .
        "AND p_application_id = " . $this->SQLValue($this->cp["p_application_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-C983C097
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_app_menu_id"] = new clsSQLParameter("ctrlp_app_menu_id", ccsFloat, "", "", $this->p_app_menu_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_app_menu_id"]->GetValue()) and !strlen($this->cp["p_app_menu_id"]->GetText()) and !is_bool($this->cp["p_app_menu_id"]->GetValue())) 
            $this->cp["p_app_menu_id"]->SetValue($this->p_app_menu_id->GetValue(true));
        if (!strlen($this->cp["p_app_menu_id"]->GetText()) and !is_bool($this->cp["p_app_menu_id"]->GetValue(true))) 
            $this->cp["p_app_menu_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_app_menu WHERE  p_app_menu_id = " . $this->SQLValue($this->cp["p_app_menu_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_app_menuFormDataSource Class @23-FCB6E20C

//Initialize Page @1-6AEA7330
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
$TemplateFileName = "p_app_menu.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C21BEE1B
include_once("./p_app_menu_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A597928E
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_app_menuGrid = & new clsGridp_app_menuGrid("", $MainPage);
$p_app_menuSearch = & new clsRecordp_app_menuSearch("", $MainPage);
$p_app_menuForm = & new clsRecordp_app_menuForm("", $MainPage);
$MainPage->p_app_menuGrid = & $p_app_menuGrid;
$MainPage->p_app_menuSearch = & $p_app_menuSearch;
$MainPage->p_app_menuForm = & $p_app_menuForm;
$p_app_menuGrid->Initialize();
$p_app_menuForm->Initialize();

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

//Execute Components @1-D55D129E
$p_app_menuSearch->Operation();
$p_app_menuForm->Operation();
//End Execute Components

//Go to destination page @1-D0EA8668
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_app_menuGrid);
    unset($p_app_menuSearch);
    unset($p_app_menuForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-AAF1A943
$p_app_menuGrid->Show();
$p_app_menuSearch->Show();
$p_app_menuForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1CF6E9E2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_app_menuGrid);
unset($p_app_menuSearch);
unset($p_app_menuForm);
unset($Tpl);
//End Unload Page


?>
