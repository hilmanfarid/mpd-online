<?php
//Include Common Files @1-A3AC4D05
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_work_program.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_work_programGrid { //p_work_programGrid class @2-49DDF30B

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

//Class_Initialize Event @2-398DEDB6
    function clsGridp_work_programGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_work_programGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_work_programGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_work_programGridDataSource($this);
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
        $this->DLink->Page = "p_work_program.php";
        $this->code = & new clsControl(ccsLabel, "code", "code", ccsText, "", CCGetRequestParam("code", ccsGet, NULL), $this);
        $this->program_name = & new clsControl(ccsLabel, "program_name", "program_name", ccsText, "", CCGetRequestParam("program_name", ccsGet, NULL), $this);
        $this->p_work_program_id = & new clsControl(ccsHidden, "p_work_program_id", "p_work_program_id", ccsFloat, "", CCGetRequestParam("p_work_program_id", ccsGet, NULL), $this);
        $this->start_date = & new clsControl(ccsLabel, "start_date", "start_date", ccsText, "", CCGetRequestParam("start_date", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->end_date = & new clsControl(ccsLabel, "end_date", "end_date", ccsText, "", CCGetRequestParam("end_date", ccsGet, NULL), $this);
        $this->is_detail = & new clsControl(ccsLabel, "is_detail", "is_detail", ccsText, "", CCGetRequestParam("is_detail", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_work_program.php";
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

//Show Method @2-1249CE11
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
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
            $this->ControlsVisible["program_name"] = $this->program_name->Visible;
            $this->ControlsVisible["p_work_program_id"] = $this->p_work_program_id->Visible;
            $this->ControlsVisible["start_date"] = $this->start_date->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["end_date"] = $this->end_date->Visible;
            $this->ControlsVisible["is_detail"] = $this->is_detail->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_work_program_id", $this->DataSource->f("p_work_program_id"));
                $this->code->SetValue($this->DataSource->code->GetValue());
                $this->program_name->SetValue($this->DataSource->program_name->GetValue());
                $this->p_work_program_id->SetValue($this->DataSource->p_work_program_id->GetValue());
                $this->start_date->SetValue($this->DataSource->start_date->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->end_date->SetValue($this->DataSource->end_date->GetValue());
                $this->is_detail->SetValue($this->DataSource->is_detail->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->code->Show();
                $this->program_name->Show();
                $this->p_work_program_id->Show();
                $this->start_date->Show();
                $this->description->Show();
                $this->end_date->Show();
                $this->is_detail->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_work_program_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-DB8376FA
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->program_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_work_program_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->start_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->end_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->is_detail->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_work_programGrid Class @2-FCB6E20C

class clsp_work_programGridDataSource extends clsDBConnSIKP {  //p_work_programGridDataSource Class @2-62EFB4F7

//DataSource Variables @2-574E74C3
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $code;
    var $program_name;
    var $p_work_program_id;
    var $start_date;
    var $description;
    var $end_date;
    var $is_detail;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-B6A11B8C
    function clsp_work_programGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_work_programGrid";
        $this->Initialize();
        $this->code = new clsField("code", ccsText, "");
        
        $this->program_name = new clsField("program_name", ccsText, "");
        
        $this->p_work_program_id = new clsField("p_work_program_id", ccsFloat, "");
        
        $this->start_date = new clsField("start_date", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->end_date = new clsField("end_date", ccsText, "");
        
        $this->is_detail = new clsField("is_detail", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-B5B47B6B
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_work_program_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-26205C94
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsMemo, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urlparent_id", ccsFloat, "", "", $this->Parameters["urlparent_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-764D667A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT p_work_program_id, code, program_name, decode(is_detail,'Y','YA','TIDAK')as is_detail, to_char(start_date,'DD-MON-YYYY')as start_date, to_char(end_date,'DD-MON-YYYY')as end_date, \n" .
        "parent_id, description, to_char(creation_date,'DD-MON-YYYY')as creation_date, created_by,\n" .
        "to_char(updated_date,'DD-MON-YYYY')as updated_date, updated_by, kode_urusan_pemerintah \n" .
        "FROM p_work_program\n" .
        "WHERE nvl(parent_id,0) = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . " AND (upper(code) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsMemo) . "%'\n" .
        "OR upper(program_name) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsMemo) . "%')) cnt";
        $this->SQL = "SELECT p_work_program_id, code, program_name, decode(is_detail,'Y','YA','TIDAK')as is_detail, to_char(start_date,'DD-MON-YYYY')as start_date, to_char(end_date,'DD-MON-YYYY')as end_date, \n" .
        "parent_id, description, to_char(creation_date,'DD-MON-YYYY')as creation_date, created_by,\n" .
        "to_char(updated_date,'DD-MON-YYYY')as updated_date, updated_by, kode_urusan_pemerintah \n" .
        "FROM p_work_program\n" .
        "WHERE nvl(parent_id,0) = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . " AND (upper(code) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsMemo) . "%'\n" .
        "OR upper(program_name) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsMemo) . "%')  {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-C6F1FB3D
    function SetValues()
    {
        $this->code->SetDBValue($this->f("code"));
        $this->program_name->SetDBValue($this->f("program_name"));
        $this->p_work_program_id->SetDBValue(trim($this->f("p_work_program_id")));
        $this->start_date->SetDBValue($this->f("start_date"));
        $this->description->SetDBValue($this->f("description"));
        $this->end_date->SetDBValue($this->f("end_date"));
        $this->is_detail->SetDBValue($this->f("is_detail"));
    }
//End SetValues Method

} //End p_work_programGridDataSource Class @2-FCB6E20C

class clsRecordp_work_programSearch { //p_work_programSearch Class @3-1C85281F

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

//Class_Initialize Event @3-33A9F8B5
    function clsRecordp_work_programSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_work_programSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_work_programSearch";
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
            $this->parent_id = & new clsControl(ccsHidden, "parent_id", "parent_id", ccsText, "", CCGetRequestParam("parent_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-4E42497D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->parent_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->parent_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-F7AC56AF
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
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

//Operation Method @3-16869FFE
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
        $Redirect = "p_work_program.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_work_program.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-5CBDA179
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
        $this->parent_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End p_work_programSearch Class @3-FCB6E20C

class clsRecordp_work_programForm { //p_work_programForm Class @94-48D00E76

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

//Class_Initialize Event @94-C63BCE13
    function clsRecordp_work_programForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_work_programForm/Error";
        $this->DataSource = new clsp_work_programFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_work_programForm";
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
            $this->p_work_program_id = & new clsControl(ccsHidden, "p_work_program_id", "Id", ccsFloat, "", CCGetRequestParam("p_work_program_id", $Method, NULL), $this);
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->p_work_programGridPage = & new clsControl(ccsHidden, "p_work_programGridPage", "p_work_programGridPage", ccsText, "", CCGetRequestParam("p_work_programGridPage", $Method, NULL), $this);
            $this->code = & new clsControl(ccsTextBox, "code", "Kode", ccsText, "", CCGetRequestParam("code", $Method, NULL), $this);
            $this->code->Required = true;
            $this->is_detail = & new clsControl(ccsListBox, "is_detail", "Detail?", ccsText, "", CCGetRequestParam("is_detail", $Method, NULL), $this);
            $this->is_detail->DSType = dsListOfValues;
            $this->is_detail->Values = array(array("Y", "YA"), array("N", "TIDAK"));
            $this->is_detail->Required = true;
            $this->start_date = & new clsControl(ccsTextBox, "start_date", "Awal", ccsText, "", CCGetRequestParam("start_date", $Method, NULL), $this);
            $this->start_date->Required = true;
            $this->DatePicker_start_date = & new clsDatePicker("DatePicker_start_date", "p_work_programForm", "start_date", $this);
            $this->parent_id = & new clsControl(ccsHidden, "parent_id", "parent_id", ccsFloat, "", CCGetRequestParam("parent_id", $Method, NULL), $this);
            $this->program_name = & new clsControl(ccsTextBox, "program_name", "Nama Program", ccsText, "", CCGetRequestParam("program_name", $Method, NULL), $this);
            $this->program_name->Required = true;
            $this->urusan_pemerintah = & new clsControl(ccsTextBox, "urusan_pemerintah", "urusan_pemerintah", ccsText, "", CCGetRequestParam("urusan_pemerintah", $Method, NULL), $this);
            $this->kode_urusan_pemerintah = & new clsControl(ccsTextBox, "kode_urusan_pemerintah", "kode_urusan_pemerintah", ccsText, "", CCGetRequestParam("kode_urusan_pemerintah", $Method, NULL), $this);
            $this->end_date = & new clsControl(ccsTextBox, "end_date", "Akhir", ccsText, "", CCGetRequestParam("end_date", $Method, NULL), $this);
            $this->DatePicker_end_date = & new clsDatePicker("DatePicker_end_date", "p_work_programForm", "end_date", $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->is_detail->Value) && !strlen($this->is_detail->Value) && $this->is_detail->Value !== false)
                    $this->is_detail->SetText("Y");
                if(!is_array($this->start_date->Value) && !strlen($this->start_date->Value) && $this->start_date->Value !== false)
                    $this->start_date->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-2B860925
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_work_program_id"] = CCGetFromGet("p_work_program_id", NULL);
    }
//End Initialize Method

//Validate Method @94-3513DC0A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_work_program_id->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->p_work_programGridPage->Validate() && $Validation);
        $Validation = ($this->code->Validate() && $Validation);
        $Validation = ($this->is_detail->Validate() && $Validation);
        $Validation = ($this->start_date->Validate() && $Validation);
        $Validation = ($this->parent_id->Validate() && $Validation);
        $Validation = ($this->program_name->Validate() && $Validation);
        $Validation = ($this->urusan_pemerintah->Validate() && $Validation);
        $Validation = ($this->kode_urusan_pemerintah->Validate() && $Validation);
        $Validation = ($this->end_date->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_work_program_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_work_programGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_detail->Errors->Count() == 0);
        $Validation =  $Validation && ($this->start_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->parent_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->program_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->urusan_pemerintah->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kode_urusan_pemerintah->Errors->Count() == 0);
        $Validation =  $Validation && ($this->end_date->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-2E738100
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_work_program_id->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->p_work_programGridPage->Errors->Count());
        $errors = ($errors || $this->code->Errors->Count());
        $errors = ($errors || $this->is_detail->Errors->Count());
        $errors = ($errors || $this->start_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_start_date->Errors->Count());
        $errors = ($errors || $this->parent_id->Errors->Count());
        $errors = ($errors || $this->program_name->Errors->Count());
        $errors = ($errors || $this->urusan_pemerintah->Errors->Count());
        $errors = ($errors || $this->kode_urusan_pemerintah->Errors->Count());
        $errors = ($errors || $this->end_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_end_date->Errors->Count());
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

//Operation Method @94-D6024CF8
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_work_program_id", "s_keyword", "p_work_programGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_work_program_id", "s_keyword", "p_work_programGridPage"));
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

//InsertRow Method @94-437EBFC0
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->is_detail->SetValue($this->is_detail->GetValue(true));
        $this->DataSource->start_date->SetValue($this->start_date->GetValue(true));
        $this->DataSource->parent_id->SetValue($this->parent_id->GetValue(true));
        $this->DataSource->program_name->SetValue($this->program_name->GetValue(true));
        $this->DataSource->kode_urusan_pemerintah->SetValue($this->kode_urusan_pemerintah->GetValue(true));
        $this->DataSource->end_date->SetValue($this->end_date->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-40D7D184
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_work_program_id->SetValue($this->p_work_program_id->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->is_detail->SetValue($this->is_detail->GetValue(true));
        $this->DataSource->start_date->SetValue($this->start_date->GetValue(true));
        $this->DataSource->program_name->SetValue($this->program_name->GetValue(true));
        $this->DataSource->kode_urusan_pemerintah->SetValue($this->kode_urusan_pemerintah->GetValue(true));
        $this->DataSource->end_date->SetValue($this->end_date->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-B95815C9
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_work_program_id->SetValue($this->p_work_program_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-FD2979FE
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

        $this->is_detail->Prepare();

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
                    $this->p_work_program_id->SetValue($this->DataSource->p_work_program_id->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->code->SetValue($this->DataSource->code->GetValue());
                    $this->is_detail->SetValue($this->DataSource->is_detail->GetValue());
                    $this->start_date->SetValue($this->DataSource->start_date->GetValue());
                    $this->parent_id->SetValue($this->DataSource->parent_id->GetValue());
                    $this->program_name->SetValue($this->DataSource->program_name->GetValue());
                    $this->urusan_pemerintah->SetValue($this->DataSource->urusan_pemerintah->GetValue());
                    $this->kode_urusan_pemerintah->SetValue($this->DataSource->kode_urusan_pemerintah->GetValue());
                    $this->end_date->SetValue($this->DataSource->end_date->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_work_program_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_work_programGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_detail->Errors->ToString());
            $Error = ComposeStrings($Error, $this->start_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_start_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->parent_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->program_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->urusan_pemerintah->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kode_urusan_pemerintah->Errors->ToString());
            $Error = ComposeStrings($Error, $this->end_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_end_date->Errors->ToString());
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
        $this->p_work_program_id->Show();
        $this->description->Show();
        $this->created_by->Show();
        $this->updated_by->Show();
        $this->creation_date->Show();
        $this->updated_date->Show();
        $this->p_work_programGridPage->Show();
        $this->code->Show();
        $this->is_detail->Show();
        $this->start_date->Show();
        $this->DatePicker_start_date->Show();
        $this->parent_id->Show();
        $this->program_name->Show();
        $this->urusan_pemerintah->Show();
        $this->kode_urusan_pemerintah->Show();
        $this->end_date->Show();
        $this->DatePicker_end_date->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_work_programForm Class @94-FCB6E20C

class clsp_work_programFormDataSource extends clsDBConnSIKP {  //p_work_programFormDataSource Class @94-3DD82203

//DataSource Variables @94-D1FF4BFF
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
    var $p_work_program_id;
    var $description;
    var $created_by;
    var $updated_by;
    var $creation_date;
    var $updated_date;
    var $p_work_programGridPage;
    var $code;
    var $is_detail;
    var $start_date;
    var $parent_id;
    var $program_name;
    var $urusan_pemerintah;
    var $kode_urusan_pemerintah;
    var $end_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-67C3AAFB
    function clsp_work_programFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_work_programForm/Error";
        $this->Initialize();
        $this->p_work_program_id = new clsField("p_work_program_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->p_work_programGridPage = new clsField("p_work_programGridPage", ccsText, "");
        
        $this->code = new clsField("code", ccsText, "");
        
        $this->is_detail = new clsField("is_detail", ccsText, "");
        
        $this->start_date = new clsField("start_date", ccsText, "");
        
        $this->parent_id = new clsField("parent_id", ccsFloat, "");
        
        $this->program_name = new clsField("program_name", ccsText, "");
        
        $this->urusan_pemerintah = new clsField("urusan_pemerintah", ccsText, "");
        
        $this->kode_urusan_pemerintah = new clsField("kode_urusan_pemerintah", ccsText, "");
        
        $this->end_date = new clsField("end_date", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-8C944CBA
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_work_program_id", ccsFloat, "", "", $this->Parameters["urlp_work_program_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-C7073FD6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT a.p_work_program_id, a.code, a.program_name, a.is_detail, \n" .
        "to_char(a.start_date,'DD-MON-YYYY')as start_date, to_char(a.end_date,'DD-MON-YYYY')as end_date, \n" .
        "a.parent_id, a.description, to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.created_by,\n" .
        "to_char(a.updated_date,'DD-MON-YYYY')as updated_date, a.updated_by, a.kode_urusan_pemerintah,\n" .
        "b.organization_name as urusan_pemerintah\n" .
        "FROM p_work_program a\n" .
        "LEFT OUTER JOIN p_organization b on (a.kode_urusan_pemerintah = b.organization_code)\n" .
        "WHERE a.p_work_program_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-DE508450
    function SetValues()
    {
        $this->p_work_program_id->SetDBValue(trim($this->f("p_work_program_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->code->SetDBValue($this->f("code"));
        $this->is_detail->SetDBValue($this->f("is_detail"));
        $this->start_date->SetDBValue($this->f("start_date"));
        $this->parent_id->SetDBValue(trim($this->f("parent_id")));
        $this->program_name->SetDBValue($this->f("program_name"));
        $this->urusan_pemerintah->SetDBValue($this->f("urusan_pemerintah"));
        $this->kode_urusan_pemerintah->SetDBValue($this->f("kode_urusan_pemerintah"));
        $this->end_date->SetDBValue($this->f("end_date"));
    }
//End SetValues Method

//Insert Method @94-B575E392
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr494", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr495", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_detail"] = new clsSQLParameter("ctrlis_detail", ccsText, "", "", $this->is_detail->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["start_date"] = new clsSQLParameter("ctrlstart_date", ccsText, "", "", $this->start_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["parent_id"] = new clsSQLParameter("ctrlparent_id", ccsFloat, "", "", $this->parent_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["program_name"] = new clsSQLParameter("ctrlprogram_name", ccsText, "", "", $this->program_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["kode_urusan_pemerintah"] = new clsSQLParameter("ctrlkode_urusan_pemerintah", ccsText, "", "", $this->kode_urusan_pemerintah->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["end_date"] = new clsSQLParameter("ctrlend_date", ccsText, "", "", $this->end_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["is_detail"]->GetValue()) and !strlen($this->cp["is_detail"]->GetText()) and !is_bool($this->cp["is_detail"]->GetValue())) 
            $this->cp["is_detail"]->SetValue($this->is_detail->GetValue(true));
        if (!is_null($this->cp["start_date"]->GetValue()) and !strlen($this->cp["start_date"]->GetText()) and !is_bool($this->cp["start_date"]->GetValue())) 
            $this->cp["start_date"]->SetValue($this->start_date->GetValue(true));
        if (!is_null($this->cp["parent_id"]->GetValue()) and !strlen($this->cp["parent_id"]->GetText()) and !is_bool($this->cp["parent_id"]->GetValue())) 
            $this->cp["parent_id"]->SetValue($this->parent_id->GetValue(true));
        if (!strlen($this->cp["parent_id"]->GetText()) and !is_bool($this->cp["parent_id"]->GetValue(true))) 
            $this->cp["parent_id"]->SetText(0);
        if (!is_null($this->cp["program_name"]->GetValue()) and !strlen($this->cp["program_name"]->GetText()) and !is_bool($this->cp["program_name"]->GetValue())) 
            $this->cp["program_name"]->SetValue($this->program_name->GetValue(true));
        if (!is_null($this->cp["kode_urusan_pemerintah"]->GetValue()) and !strlen($this->cp["kode_urusan_pemerintah"]->GetText()) and !is_bool($this->cp["kode_urusan_pemerintah"]->GetValue())) 
            $this->cp["kode_urusan_pemerintah"]->SetValue($this->kode_urusan_pemerintah->GetValue(true));
        if (!is_null($this->cp["end_date"]->GetValue()) and !strlen($this->cp["end_date"]->GetText()) and !is_bool($this->cp["end_date"]->GetValue())) 
            $this->cp["end_date"]->SetValue($this->end_date->GetValue(true));
        $this->SQL = "INSERT INTO p_work_program(p_work_program_id, description, created_by, updated_by, creation_date, updated_date, code, is_detail, start_date, parent_id, program_name, kode_urusan_pemerintah, end_date) \n" .
        "VALUES(generate_id('sikp','p_work_program','p_work_program_id'), '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', sysdate, sysdate, '" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["is_detail"]->GetDBValue(), ccsText) . "', to_date('" . $this->SQLValue($this->cp["start_date"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'), decode(" . $this->SQLValue($this->cp["parent_id"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["parent_id"]->GetDBValue(), ccsFloat) . "), '" . $this->SQLValue($this->cp["program_name"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["kode_urusan_pemerintah"]->GetDBValue(), ccsText) . "', case when '" . $this->SQLValue($this->cp["end_date"]->GetDBValue(), ccsText) . "' = '' then null else to_date('" . $this->SQLValue($this->cp["end_date"]->GetDBValue(), ccsText) . "','DD-MON-YYYY') end)";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-F825F5B8
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_work_program_id"] = new clsSQLParameter("ctrlp_work_program_id", ccsFloat, "", "", $this->p_work_program_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr523", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_detail"] = new clsSQLParameter("ctrlis_detail", ccsText, "", "", $this->is_detail->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["start_date"] = new clsSQLParameter("ctrlstart_date", ccsText, "", "", $this->start_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["program_name"] = new clsSQLParameter("ctrlprogram_name", ccsText, "", "", $this->program_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["kode_urusan_pemerintah"] = new clsSQLParameter("ctrlkode_urusan_pemerintah", ccsText, "", "", $this->kode_urusan_pemerintah->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["end_date"] = new clsSQLParameter("ctrlend_date", ccsText, "", "", $this->end_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_work_program_id"]->GetValue()) and !strlen($this->cp["p_work_program_id"]->GetText()) and !is_bool($this->cp["p_work_program_id"]->GetValue())) 
            $this->cp["p_work_program_id"]->SetValue($this->p_work_program_id->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["is_detail"]->GetValue()) and !strlen($this->cp["is_detail"]->GetText()) and !is_bool($this->cp["is_detail"]->GetValue())) 
            $this->cp["is_detail"]->SetValue($this->is_detail->GetValue(true));
        if (!is_null($this->cp["start_date"]->GetValue()) and !strlen($this->cp["start_date"]->GetText()) and !is_bool($this->cp["start_date"]->GetValue())) 
            $this->cp["start_date"]->SetValue($this->start_date->GetValue(true));
        if (!is_null($this->cp["program_name"]->GetValue()) and !strlen($this->cp["program_name"]->GetText()) and !is_bool($this->cp["program_name"]->GetValue())) 
            $this->cp["program_name"]->SetValue($this->program_name->GetValue(true));
        if (!is_null($this->cp["kode_urusan_pemerintah"]->GetValue()) and !strlen($this->cp["kode_urusan_pemerintah"]->GetText()) and !is_bool($this->cp["kode_urusan_pemerintah"]->GetValue())) 
            $this->cp["kode_urusan_pemerintah"]->SetValue($this->kode_urusan_pemerintah->GetValue(true));
        if (!is_null($this->cp["end_date"]->GetValue()) and !strlen($this->cp["end_date"]->GetText()) and !is_bool($this->cp["end_date"]->GetValue())) 
            $this->cp["end_date"]->SetValue($this->end_date->GetValue(true));
        $this->SQL = "UPDATE p_work_program SET  \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "code='" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "', \n" .
        "is_detail='" . $this->SQLValue($this->cp["is_detail"]->GetDBValue(), ccsText) . "', \n" .
        "start_date=to_date('" . $this->SQLValue($this->cp["start_date"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'),  \n" .
        "program_name='" . $this->SQLValue($this->cp["program_name"]->GetDBValue(), ccsText) . "', \n" .
        "kode_urusan_pemerintah='" . $this->SQLValue($this->cp["kode_urusan_pemerintah"]->GetDBValue(), ccsText) . "', \n" .
        "end_date=case when '" . $this->SQLValue($this->cp["end_date"]->GetDBValue(), ccsText) . "'='' then null else to_date('" . $this->SQLValue($this->cp["end_date"]->GetDBValue(), ccsText) . "','DD-MON-YYYY') end \n" .
        "WHERE p_work_program_id=" . $this->SQLValue($this->cp["p_work_program_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-125CFDB8
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_work_program_id"] = new clsSQLParameter("ctrlp_work_program_id", ccsFloat, "", "", $this->p_work_program_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_work_program_id"]->GetValue()) and !strlen($this->cp["p_work_program_id"]->GetText()) and !is_bool($this->cp["p_work_program_id"]->GetValue())) 
            $this->cp["p_work_program_id"]->SetValue($this->p_work_program_id->GetValue(true));
        if (!strlen($this->cp["p_work_program_id"]->GetText()) and !is_bool($this->cp["p_work_program_id"]->GetValue(true))) 
            $this->cp["p_work_program_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_work_program \n" .
        "WHERE p_work_program_id = " . $this->SQLValue($this->cp["p_work_program_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_work_programFormDataSource Class @94-FCB6E20C

//Initialize Page @1-4E675F4D
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
$TemplateFileName = "p_work_program.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C683D2AD
include_once("./p_work_program_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-53690210
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_work_programGrid = & new clsGridp_work_programGrid("", $MainPage);
$p_work_programSearch = & new clsRecordp_work_programSearch("", $MainPage);
$p_work_programForm = & new clsRecordp_work_programForm("", $MainPage);
$MainPage->p_work_programGrid = & $p_work_programGrid;
$MainPage->p_work_programSearch = & $p_work_programSearch;
$MainPage->p_work_programForm = & $p_work_programForm;
$p_work_programGrid->Initialize();
$p_work_programForm->Initialize();

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

//Execute Components @1-790F9678
$p_work_programSearch->Operation();
$p_work_programForm->Operation();
//End Execute Components

//Go to destination page @1-04F09B47
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_work_programGrid);
    unset($p_work_programSearch);
    unset($p_work_programForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-C1B66EA6
$p_work_programGrid->Show();
$p_work_programSearch->Show();
$p_work_programForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-4439C8C2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_work_programGrid);
unset($p_work_programSearch);
unset($p_work_programForm);
unset($Tpl);
//End Unload Page


?>
