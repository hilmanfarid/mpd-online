<?php
//Include Common Files @1-E0DA5236
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_procedure_files.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_procedure_filesGrid { //p_procedure_filesGrid class @2-57839580

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

//Class_Initialize Event @2-AD8950EF
    function clsGridp_procedure_filesGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_procedure_filesGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_procedure_filesGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_procedure_filesGridDataSource($this);
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

        $this->filename = & new clsControl(ccsLabel, "filename", "filename", ccsText, "", CCGetRequestParam("filename", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "p_procedure_files.php";
        $this->p_procedure_files_id = & new clsControl(ccsHidden, "p_procedure_files_id", "p_procedure_files_id", ccsText, "", CCGetRequestParam("p_procedure_files_id", ccsGet, NULL), $this);
        $this->sequence_no = & new clsControl(ccsLabel, "sequence_no", "sequence_no", ccsFloat, "", CCGetRequestParam("sequence_no", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_procedure_files.php";
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

//Show Method @2-F4779D91
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlp_procedure_id"] = CCGetFromGet("p_procedure_id", NULL);
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
            $this->ControlsVisible["filename"] = $this->filename->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["p_procedure_files_id"] = $this->p_procedure_files_id->Visible;
            $this->ControlsVisible["sequence_no"] = $this->sequence_no->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->filename->SetValue($this->DataSource->filename->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_procedure_files_id", $this->DataSource->f("p_procedure_files_id"));
                $this->p_procedure_files_id->SetValue($this->DataSource->p_procedure_files_id->GetValue());
                $this->sequence_no->SetValue($this->DataSource->sequence_no->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->filename->Show();
                $this->DLink->Show();
                $this->p_procedure_files_id->Show();
                $this->sequence_no->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_procedure_files_id", "s_keyword", "ccsForm"));
        $this->Insert_Link->Parameters = CCAddParam($this->Insert_Link->Parameters, "FLAG", "ADD");
        $this->Navigator->Show();
        $this->Insert_Link->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-890ECE61
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->filename->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_procedure_files_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sequence_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_procedure_filesGrid Class @2-FCB6E20C

class clsp_procedure_filesGridDataSource extends clsDBConnSIKP {  //p_procedure_filesGridDataSource Class @2-50F9E88F

//DataSource Variables @2-CE7A0A95
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $filename;
    var $p_procedure_files_id;
    var $sequence_no;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-EDAB1A70
    function clsp_procedure_filesGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_procedure_filesGrid";
        $this->Initialize();
        $this->filename = new clsField("filename", ccsText, "");
        
        $this->p_procedure_files_id = new clsField("p_procedure_files_id", ccsText, "");
        
        $this->sequence_no = new clsField("sequence_no", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-7CEF9001
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_procedure_files_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-BA40C377
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_procedure_id", ccsFloat, "", "", $this->Parameters["urlp_procedure_id"], "", false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "p_procedure_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "upper(filename)", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-C59B77E0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM p_procedure_files";
        $this->SQL = "SELECT * \n\n" .
        "FROM p_procedure_files {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-7796BA2A
    function SetValues()
    {
        $this->filename->SetDBValue($this->f("filename"));
        $this->p_procedure_files_id->SetDBValue($this->f("p_procedure_files_id"));
        $this->sequence_no->SetDBValue(trim($this->f("sequence_no")));
    }
//End SetValues Method

} //End p_procedure_filesGridDataSource Class @2-FCB6E20C

class clsRecordp_procedure_filesSearch { //p_procedure_filesSearch Class @3-283026F3

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

//Class_Initialize Event @3-AC1AEE1E
    function clsRecordp_procedure_filesSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_procedure_filesSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_procedure_filesSearch";
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
            $this->p_procedure_id = & new clsControl(ccsHidden, "p_procedure_id", "p_procedure_id", ccsText, "", CCGetRequestParam("p_procedure_id", $Method, NULL), $this);
            $this->p_procedureGridPage = & new clsControl(ccsHidden, "p_procedureGridPage", "p_procedureGridPage", ccsText, "", CCGetRequestParam("p_procedureGridPage", $Method, NULL), $this);
            $this->proc_s_keyword = & new clsControl(ccsHidden, "proc_s_keyword", "proc_s_keyword", ccsText, "", CCGetRequestParam("proc_s_keyword", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-76C9738C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->p_procedure_id->Validate() && $Validation);
        $Validation = ($this->p_procedureGridPage->Validate() && $Validation);
        $Validation = ($this->proc_s_keyword->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_procedure_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_procedureGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->proc_s_keyword->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-DE367A9F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->p_procedure_id->Errors->Count());
        $errors = ($errors || $this->p_procedureGridPage->Errors->Count());
        $errors = ($errors || $this->proc_s_keyword->Errors->Count());
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

//Operation Method @3-02C96559
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
        $Redirect = "p_procedure_files.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_procedure_files.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-08827FCB
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
            $Error = ComposeStrings($Error, $this->p_procedure_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_procedureGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->proc_s_keyword->Errors->ToString());
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
        $this->p_procedure_id->Show();
        $this->p_procedureGridPage->Show();
        $this->proc_s_keyword->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End p_procedure_filesSearch Class @3-FCB6E20C

class clsRecordp_procedure_filesForm { //p_procedure_filesForm Class @23-2409B15C

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

//Class_Initialize Event @23-366BF394
    function clsRecordp_procedure_filesForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_procedure_filesForm/Error";
        $this->DataSource = new clsp_procedure_filesFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_procedure_filesForm";
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
            $this->p_procedure_files_id = & new clsControl(ccsHidden, "p_procedure_files_id", "Id", ccsFloat, "", CCGetRequestParam("p_procedure_files_id", $Method, NULL), $this);
            $this->filename = & new clsControl(ccsTextBox, "filename", "Folder Web dan Nama File Utama", ccsText, "", CCGetRequestParam("filename", $Method, NULL), $this);
            $this->filename->Required = true;
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->p_procedure_filesGridPage = & new clsControl(ccsHidden, "p_procedure_filesGridPage", "p_procedure_filesGridPage", ccsText, "", CCGetRequestParam("p_procedure_filesGridPage", $Method, NULL), $this);
            $this->p_procedure_id = & new clsControl(ccsHidden, "p_procedure_id", "p_procedure_id", ccsText, "", CCGetRequestParam("p_procedure_id", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->created_by->Required = true;
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->creation_date->Required = true;
            $this->sequence_no = & new clsControl(ccsTextBox, "sequence_no", "Sequence No", ccsFloat, "", CCGetRequestParam("sequence_no", $Method, NULL), $this);
            $this->sequence_no->Required = true;
            if(!$this->FormSubmitted) {
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @23-30C2F464
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_procedure_files_id"] = CCGetFromGet("p_procedure_files_id", NULL);
    }
//End Initialize Method

//Validate Method @23-50B01CAD
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_procedure_files_id->Validate() && $Validation);
        $Validation = ($this->filename->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->p_procedure_filesGridPage->Validate() && $Validation);
        $Validation = ($this->p_procedure_id->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->sequence_no->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_procedure_files_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->filename->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_procedure_filesGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_procedure_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sequence_no->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-79334637
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_procedure_files_id->Errors->Count());
        $errors = ($errors || $this->filename->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->p_procedure_filesGridPage->Errors->Count());
        $errors = ($errors || $this->p_procedure_id->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->sequence_no->Errors->Count());
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

//Operation Method @23-A74400E3
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "p_procedure_files_id", "s_keyword", "FLAG", "p_procedure_filesGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "p_procedure_files_id", "s_keyword", "FLAG", "p_procedure_filesGridPage"));
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

//InsertRow Method @23-E9606962
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->filename->SetValue($this->filename->GetValue(true));
        $this->DataSource->p_procedure_id->SetValue($this->p_procedure_id->GetValue(true));
        $this->DataSource->sequence_no->SetValue($this->sequence_no->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @23-2210F33D
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_procedure_files_id->SetValue($this->p_procedure_files_id->GetValue(true));
        $this->DataSource->filename->SetValue($this->filename->GetValue(true));
        $this->DataSource->sequence_no->SetValue($this->sequence_no->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-388A8667
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_procedure_files_id->SetValue($this->p_procedure_files_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-8B5816A7
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
                    $this->p_procedure_files_id->SetValue($this->DataSource->p_procedure_files_id->GetValue());
                    $this->filename->SetValue($this->DataSource->filename->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->p_procedure_id->SetValue($this->DataSource->p_procedure_id->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->sequence_no->SetValue($this->DataSource->sequence_no->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_procedure_files_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->filename->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_procedure_filesGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_procedure_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sequence_no->Errors->ToString());
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
        $this->p_procedure_files_id->Show();
        $this->filename->Show();
        $this->updated_date->Show();
        $this->updated_by->Show();
        $this->p_procedure_filesGridPage->Show();
        $this->p_procedure_id->Show();
        $this->created_by->Show();
        $this->creation_date->Show();
        $this->sequence_no->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_procedure_filesForm Class @23-FCB6E20C

class clsp_procedure_filesFormDataSource extends clsDBConnSIKP {  //p_procedure_filesFormDataSource Class @23-0FCE7E7B

//DataSource Variables @23-2A67AC0B
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
    var $p_procedure_files_id;
    var $filename;
    var $updated_date;
    var $updated_by;
    var $p_procedure_filesGridPage;
    var $p_procedure_id;
    var $created_by;
    var $creation_date;
    var $sequence_no;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-8BF6A63B
    function clsp_procedure_filesFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_procedure_filesForm/Error";
        $this->Initialize();
        $this->p_procedure_files_id = new clsField("p_procedure_files_id", ccsFloat, "");
        
        $this->filename = new clsField("filename", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->p_procedure_filesGridPage = new clsField("p_procedure_filesGridPage", ccsText, "");
        
        $this->p_procedure_id = new clsField("p_procedure_id", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->sequence_no = new clsField("sequence_no", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-B9E5B210
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_procedure_files_id", ccsFloat, "", "", $this->Parameters["urlp_procedure_files_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @23-B5DC4138
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT p_procedure_id, p_procedure_files_id, filename, \n" .
        "sequence_no, to_char(creation_date,'DD-MON-YYYY')as creation_date, created_by, to_char(updated_date,'DD-MON-YYYY')as updated_date, updated_by \n" .
        "FROM p_procedure_files\n" .
        "WHERE p_procedure_files_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-1E09CCD5
    function SetValues()
    {
        $this->p_procedure_files_id->SetDBValue(trim($this->f("p_procedure_files_id")));
        $this->filename->SetDBValue($this->f("filename"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->p_procedure_id->SetDBValue($this->f("p_procedure_id"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->sequence_no->SetDBValue(trim($this->f("sequence_no")));
    }
//End SetValues Method

//Insert Method @23-A621D108
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["filename"] = new clsSQLParameter("ctrlfilename", ccsText, "", "", $this->filename->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr265", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["p_procedure_id"] = new clsSQLParameter("ctrlp_procedure_id", ccsText, "", "", $this->p_procedure_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr267", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["sequence_no"] = new clsSQLParameter("ctrlsequence_no", ccsFloat, "", "", $this->sequence_no->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["filename"]->GetValue()) and !strlen($this->cp["filename"]->GetText()) and !is_bool($this->cp["filename"]->GetValue())) 
            $this->cp["filename"]->SetValue($this->filename->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["p_procedure_id"]->GetValue()) and !strlen($this->cp["p_procedure_id"]->GetText()) and !is_bool($this->cp["p_procedure_id"]->GetValue())) 
            $this->cp["p_procedure_id"]->SetValue($this->p_procedure_id->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["sequence_no"]->GetValue()) and !strlen($this->cp["sequence_no"]->GetText()) and !is_bool($this->cp["sequence_no"]->GetValue())) 
            $this->cp["sequence_no"]->SetValue($this->sequence_no->GetValue(true));
        if (!strlen($this->cp["sequence_no"]->GetText()) and !is_bool($this->cp["sequence_no"]->GetValue(true))) 
            $this->cp["sequence_no"]->SetText(0);
        $this->SQL = "INSERT INTO p_procedure_files(p_procedure_files_id, filename, updated_date, updated_by, p_procedure_id, created_by, creation_date, sequence_no) \n" .
        "VALUES(generate_id('sikp','p_procedure_files','p_procedure_files_id'), '" . $this->SQLValue($this->cp["filename"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["p_procedure_id"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', sysdate, " . $this->SQLValue($this->cp["sequence_no"]->GetDBValue(), ccsFloat) . ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-3692CF65
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_procedure_files_id"] = new clsSQLParameter("ctrlp_procedure_files_id", ccsFloat, "", "", $this->p_procedure_files_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["filename"] = new clsSQLParameter("ctrlfilename", ccsText, "", "", $this->filename->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr278", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["sequence_no"] = new clsSQLParameter("ctrlsequence_no", ccsFloat, "", "", $this->sequence_no->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_procedure_files_id"]->GetValue()) and !strlen($this->cp["p_procedure_files_id"]->GetText()) and !is_bool($this->cp["p_procedure_files_id"]->GetValue())) 
            $this->cp["p_procedure_files_id"]->SetValue($this->p_procedure_files_id->GetValue(true));
        if (!strlen($this->cp["p_procedure_files_id"]->GetText()) and !is_bool($this->cp["p_procedure_files_id"]->GetValue(true))) 
            $this->cp["p_procedure_files_id"]->SetText(0);
        if (!is_null($this->cp["filename"]->GetValue()) and !strlen($this->cp["filename"]->GetText()) and !is_bool($this->cp["filename"]->GetValue())) 
            $this->cp["filename"]->SetValue($this->filename->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["sequence_no"]->GetValue()) and !strlen($this->cp["sequence_no"]->GetText()) and !is_bool($this->cp["sequence_no"]->GetValue())) 
            $this->cp["sequence_no"]->SetValue($this->sequence_no->GetValue(true));
        if (!strlen($this->cp["sequence_no"]->GetText()) and !is_bool($this->cp["sequence_no"]->GetValue(true))) 
            $this->cp["sequence_no"]->SetText(0);
        $this->SQL = "UPDATE p_procedure_files SET \n" .
        "filename='" . $this->SQLValue($this->cp["filename"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "sequence_no=" . $this->SQLValue($this->cp["sequence_no"]->GetDBValue(), ccsFloat) . ",\n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "' \n" .
        "WHERE p_procedure_files_id=" . $this->SQLValue($this->cp["p_procedure_files_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-AD79BBA3
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_procedure_files_id"] = new clsSQLParameter("ctrlp_procedure_files_id", ccsFloat, "", "", $this->p_procedure_files_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_procedure_files_id"]->GetValue()) and !strlen($this->cp["p_procedure_files_id"]->GetText()) and !is_bool($this->cp["p_procedure_files_id"]->GetValue())) 
            $this->cp["p_procedure_files_id"]->SetValue($this->p_procedure_files_id->GetValue(true));
        if (!strlen($this->cp["p_procedure_files_id"]->GetText()) and !is_bool($this->cp["p_procedure_files_id"]->GetValue(true))) 
            $this->cp["p_procedure_files_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_procedure_files \n" .
        "WHERE  p_procedure_files_id = " . $this->SQLValue($this->cp["p_procedure_files_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_procedure_filesFormDataSource Class @23-FCB6E20C

//Initialize Page @1-1CDDA8CD
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
$TemplateFileName = "p_procedure_files.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-F06CBBB8
include_once("./p_procedure_files_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-EF24A110
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_procedure_filesGrid = & new clsGridp_procedure_filesGrid("", $MainPage);
$p_procedure_filesSearch = & new clsRecordp_procedure_filesSearch("", $MainPage);
$proc_code = & new clsControl(ccsLabel, "proc_code", "proc_code", ccsText, "", CCGetRequestParam("proc_code", ccsGet, NULL), $MainPage);
$p_procedure_filesForm = & new clsRecordp_procedure_filesForm("", $MainPage);
$MainPage->p_procedure_filesGrid = & $p_procedure_filesGrid;
$MainPage->p_procedure_filesSearch = & $p_procedure_filesSearch;
$MainPage->proc_code = & $proc_code;
$MainPage->p_procedure_filesForm = & $p_procedure_filesForm;
$p_procedure_filesGrid->Initialize();
$p_procedure_filesForm->Initialize();

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

//Execute Components @1-943D41CB
$p_procedure_filesSearch->Operation();
$p_procedure_filesForm->Operation();
//End Execute Components

//Go to destination page @1-80BCF3A3
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_procedure_filesGrid);
    unset($p_procedure_filesSearch);
    unset($p_procedure_filesForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-21D1035A
$p_procedure_filesGrid->Show();
$p_procedure_filesSearch->Show();
$p_procedure_filesForm->Show();
$proc_code->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-FB255CD0
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_procedure_filesGrid);
unset($p_procedure_filesSearch);
unset($p_procedure_filesForm);
unset($Tpl);
//End Unload Page


?>
