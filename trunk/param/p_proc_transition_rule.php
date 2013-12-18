<?php
//Include Common Files @1-F0E143A7
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_proc_transition_rule.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_proc_transition_ruleGrid { //p_proc_transition_ruleGrid class @2-35C295C1

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

//Class_Initialize Event @2-365B7606
    function clsGridp_proc_transition_ruleGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_proc_transition_ruleGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_proc_transition_ruleGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_proc_transition_ruleGridDataSource($this);
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
        $this->DLink->Page = "p_proc_transition_rule.php";
        $this->code = & new clsControl(ccsLabel, "code", "code", ccsText, "", CCGetRequestParam("code", ccsGet, NULL), $this);
        $this->p_proc_transition_rule_id = & new clsControl(ccsHidden, "p_proc_transition_rule_id", "p_proc_transition_rule_id", ccsFloat, "", CCGetRequestParam("p_proc_transition_rule_id", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->table_name = & new clsControl(ccsLabel, "table_name", "table_name", ccsText, "", CCGetRequestParam("table_name", ccsGet, NULL), $this);
        $this->column_name = & new clsControl(ccsLabel, "column_name", "column_name", ccsText, "", CCGetRequestParam("column_name", ccsGet, NULL), $this);
        $this->is_active = & new clsControl(ccsLabel, "is_active", "is_active", ccsText, "", CCGetRequestParam("is_active", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_proc_transition_rule.php";
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

//Show Method @2-4586F54A
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
            $this->ControlsVisible["code"] = $this->code->Visible;
            $this->ControlsVisible["p_proc_transition_rule_id"] = $this->p_proc_transition_rule_id->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["table_name"] = $this->table_name->Visible;
            $this->ControlsVisible["column_name"] = $this->column_name->Visible;
            $this->ControlsVisible["is_active"] = $this->is_active->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_proc_transition_rule_id", $this->DataSource->f("p_proc_transition_rule_id"));
                $this->code->SetValue($this->DataSource->code->GetValue());
                $this->p_proc_transition_rule_id->SetValue($this->DataSource->p_proc_transition_rule_id->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->table_name->SetValue($this->DataSource->table_name->GetValue());
                $this->column_name->SetValue($this->DataSource->column_name->GetValue());
                $this->is_active->SetValue($this->DataSource->is_active->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->code->Show();
                $this->p_proc_transition_rule_id->Show();
                $this->description->Show();
                $this->table_name->Show();
                $this->column_name->Show();
                $this->is_active->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_proc_transition_rule_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-6C85C7B6
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_proc_transition_rule_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->table_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->column_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->is_active->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_proc_transition_ruleGrid Class @2-FCB6E20C

class clsp_proc_transition_ruleGridDataSource extends clsDBConnSIKP {  //p_proc_transition_ruleGridDataSource Class @2-E10A751D

//DataSource Variables @2-87A6BC00
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $code;
    var $p_proc_transition_rule_id;
    var $description;
    var $table_name;
    var $column_name;
    var $is_active;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-E5A4609B
    function clsp_proc_transition_ruleGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_proc_transition_ruleGrid";
        $this->Initialize();
        $this->code = new clsField("code", ccsText, "");
        
        $this->p_proc_transition_rule_id = new clsField("p_proc_transition_rule_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->table_name = new clsField("table_name", ccsText, "");
        
        $this->column_name = new clsField("column_name", ccsText, "");
        
        $this->is_active = new clsField("is_active", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-98284C17
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_proc_transition_rule_id";
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

//Open Method @2-A266C6E0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM p_proc_transition_rule";
        $this->SQL = "SELECT * \n\n" .
        "FROM p_proc_transition_rule {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-769FA5FC
    function SetValues()
    {
        $this->code->SetDBValue($this->f("code"));
        $this->p_proc_transition_rule_id->SetDBValue(trim($this->f("p_proc_transition_rule_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->table_name->SetDBValue($this->f("table_name"));
        $this->column_name->SetDBValue($this->f("column_name"));
        $this->is_active->SetDBValue($this->f("is_active"));
    }
//End SetValues Method

} //End p_proc_transition_ruleGridDataSource Class @2-FCB6E20C

class clsRecordp_proc_transition_ruleSearch { //p_proc_transition_ruleSearch Class @3-5C7354E1

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

//Class_Initialize Event @3-73F31499
    function clsRecordp_proc_transition_ruleSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_proc_transition_ruleSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_proc_transition_ruleSearch";
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

//Operation Method @3-0796177B
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
        $Redirect = "p_proc_transition_rule.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_proc_transition_rule.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

} //End p_proc_transition_ruleSearch Class @3-FCB6E20C

class clsRecordp_proc_transition_ruleForm { //p_proc_transition_ruleForm Class @94-E6817C0F

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

//Class_Initialize Event @94-41E8BE71
    function clsRecordp_proc_transition_ruleForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_proc_transition_ruleForm/Error";
        $this->DataSource = new clsp_proc_transition_ruleFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_proc_transition_ruleForm";
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
            $this->p_proc_transition_rule_id = & new clsControl(ccsHidden, "p_proc_transition_rule_id", "Id", ccsFloat, "", CCGetRequestParam("p_proc_transition_rule_id", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->p_proc_transition_ruleGridPage = & new clsControl(ccsHidden, "p_proc_transition_ruleGridPage", "p_proc_transition_ruleGridPage", ccsText, "", CCGetRequestParam("p_proc_transition_ruleGridPage", $Method, NULL), $this);
            $this->code = & new clsControl(ccsTextBox, "code", "Kode", ccsText, "", CCGetRequestParam("code", $Method, NULL), $this);
            $this->code->Required = true;
            $this->column_name = & new clsControl(ccsTextBox, "column_name", "Nama Kolom", ccsText, "", CCGetRequestParam("column_name", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->created_by->Required = true;
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->creation_date->Required = true;
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->table_name = & new clsControl(ccsTextBox, "table_name", "Nama Tabel", ccsText, "", CCGetRequestParam("table_name", $Method, NULL), $this);
            $this->is_active = & new clsControl(ccsListBox, "is_active", "Status?", ccsText, "", CCGetRequestParam("is_active", $Method, NULL), $this);
            $this->is_active->DSType = dsListOfValues;
            $this->is_active->Values = array(array("Y", "AKTIF"), array("N", "TIDAK AKTIF"));
            $this->is_active->Required = true;
            $this->is_range = & new clsControl(ccsListBox, "is_range", "Range?", ccsText, "", CCGetRequestParam("is_range", $Method, NULL), $this);
            $this->is_range->DSType = dsListOfValues;
            $this->is_range->Values = array(array("Y", "YA"), array("N", "TIDAK"));
            $this->is_statement = & new clsControl(ccsListBox, "is_statement", "Statemen?", ccsText, "", CCGetRequestParam("is_statement", $Method, NULL), $this);
            $this->is_statement->DSType = dsListOfValues;
            $this->is_statement->Values = array(array("Y", "STATEMEN"), array("N", "NON STATEMEN"));
            $this->is_statement->Required = true;
            $this->condition_statement = & new clsControl(ccsTextArea, "condition_statement", "Statemen Kondisi", ccsText, "", CCGetRequestParam("condition_statement", $Method, NULL), $this);
            $this->data_type = & new clsControl(ccsListBox, "data_type", "Tipe Data?", ccsText, "", CCGetRequestParam("data_type", $Method, NULL), $this);
            $this->data_type->DSType = dsListOfValues;
            $this->data_type->Values = array(array("Y", "YA"), array("N", "TIDAK"));
            $this->first_value = & new clsControl(ccsTextBox, "first_value", "Nilai Pertama", ccsText, "", CCGetRequestParam("first_value", $Method, NULL), $this);
            $this->second_value = & new clsControl(ccsTextBox, "second_value", "Nilai Kedua", ccsText, "", CCGetRequestParam("second_value", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-DD6E7A3A
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_proc_transition_rule_id"] = CCGetFromGet("p_proc_transition_rule_id", NULL);
    }
//End Initialize Method

//Validate Method @94-5E2D2862
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_proc_transition_rule_id->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->p_proc_transition_ruleGridPage->Validate() && $Validation);
        $Validation = ($this->code->Validate() && $Validation);
        $Validation = ($this->column_name->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->table_name->Validate() && $Validation);
        $Validation = ($this->is_active->Validate() && $Validation);
        $Validation = ($this->is_range->Validate() && $Validation);
        $Validation = ($this->is_statement->Validate() && $Validation);
        $Validation = ($this->condition_statement->Validate() && $Validation);
        $Validation = ($this->data_type->Validate() && $Validation);
        $Validation = ($this->first_value->Validate() && $Validation);
        $Validation = ($this->second_value->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_proc_transition_rule_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_proc_transition_ruleGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->column_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->table_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_active->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_range->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_statement->Errors->Count() == 0);
        $Validation =  $Validation && ($this->condition_statement->Errors->Count() == 0);
        $Validation =  $Validation && ($this->data_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->first_value->Errors->Count() == 0);
        $Validation =  $Validation && ($this->second_value->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-AFAD48FC
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_proc_transition_rule_id->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->p_proc_transition_ruleGridPage->Errors->Count());
        $errors = ($errors || $this->code->Errors->Count());
        $errors = ($errors || $this->column_name->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->table_name->Errors->Count());
        $errors = ($errors || $this->is_active->Errors->Count());
        $errors = ($errors || $this->is_range->Errors->Count());
        $errors = ($errors || $this->is_statement->Errors->Count());
        $errors = ($errors || $this->condition_statement->Errors->Count());
        $errors = ($errors || $this->data_type->Errors->Count());
        $errors = ($errors || $this->first_value->Errors->Count());
        $errors = ($errors || $this->second_value->Errors->Count());
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

//Operation Method @94-562F67EB
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_proc_transition_rule_id", "s_keyword", "p_proc_transition_ruleGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_proc_transition_rule_id", "s_keyword", "p_proc_transition_ruleGridPage"));
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

//InsertRow Method @94-60D8EF16
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->column_name->SetValue($this->column_name->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->table_name->SetValue($this->table_name->GetValue(true));
        $this->DataSource->is_active->SetValue($this->is_active->GetValue(true));
        $this->DataSource->is_range->SetValue($this->is_range->GetValue(true));
        $this->DataSource->is_statement->SetValue($this->is_statement->GetValue(true));
        $this->DataSource->condition_statement->SetValue($this->condition_statement->GetValue(true));
        $this->DataSource->data_type->SetValue($this->data_type->GetValue(true));
        $this->DataSource->first_value->SetValue($this->first_value->GetValue(true));
        $this->DataSource->second_value->SetValue($this->second_value->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-7467BD0E
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_proc_transition_rule_id->SetValue($this->p_proc_transition_rule_id->GetValue(true));
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->column_name->SetValue($this->column_name->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->table_name->SetValue($this->table_name->GetValue(true));
        $this->DataSource->is_active->SetValue($this->is_active->GetValue(true));
        $this->DataSource->is_range->SetValue($this->is_range->GetValue(true));
        $this->DataSource->is_statement->SetValue($this->is_statement->GetValue(true));
        $this->DataSource->condition_statement->SetValue($this->condition_statement->GetValue(true));
        $this->DataSource->data_type->SetValue($this->data_type->GetValue(true));
        $this->DataSource->first_value->SetValue($this->first_value->GetValue(true));
        $this->DataSource->second_value->SetValue($this->second_value->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-E867ED07
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_proc_transition_rule_id->SetValue($this->p_proc_transition_rule_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-C5AD25C0
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
        $this->is_range->Prepare();
        $this->is_statement->Prepare();
        $this->data_type->Prepare();

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
                    $this->p_proc_transition_rule_id->SetValue($this->DataSource->p_proc_transition_rule_id->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->code->SetValue($this->DataSource->code->GetValue());
                    $this->column_name->SetValue($this->DataSource->column_name->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->table_name->SetValue($this->DataSource->table_name->GetValue());
                    $this->is_active->SetValue($this->DataSource->is_active->GetValue());
                    $this->is_range->SetValue($this->DataSource->is_range->GetValue());
                    $this->is_statement->SetValue($this->DataSource->is_statement->GetValue());
                    $this->condition_statement->SetValue($this->DataSource->condition_statement->GetValue());
                    $this->data_type->SetValue($this->DataSource->data_type->GetValue());
                    $this->first_value->SetValue($this->DataSource->first_value->GetValue());
                    $this->second_value->SetValue($this->DataSource->second_value->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_proc_transition_rule_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_proc_transition_ruleGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->column_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->table_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_active->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_range->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_statement->Errors->ToString());
            $Error = ComposeStrings($Error, $this->condition_statement->Errors->ToString());
            $Error = ComposeStrings($Error, $this->data_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->first_value->Errors->ToString());
            $Error = ComposeStrings($Error, $this->second_value->Errors->ToString());
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
        $this->p_proc_transition_rule_id->Show();
        $this->updated_by->Show();
        $this->p_proc_transition_ruleGridPage->Show();
        $this->code->Show();
        $this->column_name->Show();
        $this->updated_date->Show();
        $this->created_by->Show();
        $this->creation_date->Show();
        $this->description->Show();
        $this->table_name->Show();
        $this->is_active->Show();
        $this->is_range->Show();
        $this->is_statement->Show();
        $this->condition_statement->Show();
        $this->data_type->Show();
        $this->first_value->Show();
        $this->second_value->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_proc_transition_ruleForm Class @94-FCB6E20C

class clsp_proc_transition_ruleFormDataSource extends clsDBConnSIKP {  //p_proc_transition_ruleFormDataSource Class @94-BE3DE3E9

//DataSource Variables @94-75EAEC1B
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
    var $p_proc_transition_rule_id;
    var $updated_by;
    var $p_proc_transition_ruleGridPage;
    var $code;
    var $column_name;
    var $updated_date;
    var $created_by;
    var $creation_date;
    var $description;
    var $table_name;
    var $is_active;
    var $is_range;
    var $is_statement;
    var $condition_statement;
    var $data_type;
    var $first_value;
    var $second_value;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-0F2A80FF
    function clsp_proc_transition_ruleFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_proc_transition_ruleForm/Error";
        $this->Initialize();
        $this->p_proc_transition_rule_id = new clsField("p_proc_transition_rule_id", ccsFloat, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->p_proc_transition_ruleGridPage = new clsField("p_proc_transition_ruleGridPage", ccsText, "");
        
        $this->code = new clsField("code", ccsText, "");
        
        $this->column_name = new clsField("column_name", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->table_name = new clsField("table_name", ccsText, "");
        
        $this->is_active = new clsField("is_active", ccsText, "");
        
        $this->is_range = new clsField("is_range", ccsText, "");
        
        $this->is_statement = new clsField("is_statement", ccsText, "");
        
        $this->condition_statement = new clsField("condition_statement", ccsText, "");
        
        $this->data_type = new clsField("data_type", ccsText, "");
        
        $this->first_value = new clsField("first_value", ccsText, "");
        
        $this->second_value = new clsField("second_value", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-DDEEC572
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_proc_transition_rule_id", ccsFloat, "", "", $this->Parameters["urlp_proc_transition_rule_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-66BD2A22
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT p_proc_transition_rule_id, code, description, \n" .
        "table_name, column_name, is_range, first_value, \n" .
        "second_value, data_type, is_statement, condition_statement, \n" .
        "is_active, to_char(creation_date,'DD-MON-YYYY')as creation_date, created_by, \n" .
        "to_char(updated_date,'DD-MON-YYYY')as updated_date, updated_by \n" .
        "FROM p_proc_transition_rule \n" .
        "WHERE p_proc_transition_rule_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-E076DF5A
    function SetValues()
    {
        $this->p_proc_transition_rule_id->SetDBValue(trim($this->f("p_proc_transition_rule_id")));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->code->SetDBValue($this->f("code"));
        $this->column_name->SetDBValue($this->f("column_name"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->description->SetDBValue($this->f("description"));
        $this->table_name->SetDBValue($this->f("table_name"));
        $this->is_active->SetDBValue($this->f("is_active"));
        $this->is_range->SetDBValue($this->f("is_range"));
        $this->is_statement->SetDBValue($this->f("is_statement"));
        $this->condition_statement->SetDBValue($this->f("condition_statement"));
        $this->data_type->SetDBValue($this->f("data_type"));
        $this->first_value->SetDBValue($this->f("first_value"));
        $this->second_value->SetDBValue($this->f("second_value"));
    }
//End SetValues Method

//Insert Method @94-1960CB1A
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["updated_by"] = new clsSQLParameter("expr740", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["column_name"] = new clsSQLParameter("ctrlcolumn_name", ccsText, "", "", $this->column_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr744", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["table_name"] = new clsSQLParameter("ctrltable_name", ccsText, "", "", $this->table_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_active"] = new clsSQLParameter("ctrlis_active", ccsText, "", "", $this->is_active->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_range"] = new clsSQLParameter("ctrlis_range", ccsText, "", "", $this->is_range->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_statement"] = new clsSQLParameter("ctrlis_statement", ccsText, "", "", $this->is_statement->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["condition_statement"] = new clsSQLParameter("ctrlcondition_statement", ccsText, "", "", $this->condition_statement->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["data_type"] = new clsSQLParameter("ctrldata_type", ccsText, "", "", $this->data_type->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["first_value"] = new clsSQLParameter("ctrlfirst_value", ccsText, "", "", $this->first_value->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["second_value"] = new clsSQLParameter("ctrlsecond_value", ccsText, "", "", $this->second_value->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["column_name"]->GetValue()) and !strlen($this->cp["column_name"]->GetText()) and !is_bool($this->cp["column_name"]->GetValue())) 
            $this->cp["column_name"]->SetValue($this->column_name->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["table_name"]->GetValue()) and !strlen($this->cp["table_name"]->GetText()) and !is_bool($this->cp["table_name"]->GetValue())) 
            $this->cp["table_name"]->SetValue($this->table_name->GetValue(true));
        if (!is_null($this->cp["is_active"]->GetValue()) and !strlen($this->cp["is_active"]->GetText()) and !is_bool($this->cp["is_active"]->GetValue())) 
            $this->cp["is_active"]->SetValue($this->is_active->GetValue(true));
        if (!is_null($this->cp["is_range"]->GetValue()) and !strlen($this->cp["is_range"]->GetText()) and !is_bool($this->cp["is_range"]->GetValue())) 
            $this->cp["is_range"]->SetValue($this->is_range->GetValue(true));
        if (!is_null($this->cp["is_statement"]->GetValue()) and !strlen($this->cp["is_statement"]->GetText()) and !is_bool($this->cp["is_statement"]->GetValue())) 
            $this->cp["is_statement"]->SetValue($this->is_statement->GetValue(true));
        if (!is_null($this->cp["condition_statement"]->GetValue()) and !strlen($this->cp["condition_statement"]->GetText()) and !is_bool($this->cp["condition_statement"]->GetValue())) 
            $this->cp["condition_statement"]->SetValue($this->condition_statement->GetValue(true));
        if (!is_null($this->cp["data_type"]->GetValue()) and !strlen($this->cp["data_type"]->GetText()) and !is_bool($this->cp["data_type"]->GetValue())) 
            $this->cp["data_type"]->SetValue($this->data_type->GetValue(true));
        if (!is_null($this->cp["first_value"]->GetValue()) and !strlen($this->cp["first_value"]->GetText()) and !is_bool($this->cp["first_value"]->GetValue())) 
            $this->cp["first_value"]->SetValue($this->first_value->GetValue(true));
        if (!is_null($this->cp["second_value"]->GetValue()) and !strlen($this->cp["second_value"]->GetText()) and !is_bool($this->cp["second_value"]->GetValue())) 
            $this->cp["second_value"]->SetValue($this->second_value->GetValue(true));
        $this->SQL = "INSERT INTO p_proc_transition_rule(p_proc_transition_rule_id, updated_by, code, column_name, updated_date, created_by, creation_date, description, table_name, is_active, is_range, is_statement, condition_statement, data_type, first_value, second_value) \n" .
        "VALUES(generate_id('sikp','p_proc_transition_rule','p_proc_transition_rule_id'), '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["column_name"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["table_name"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["is_active"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["is_range"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["is_statement"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["condition_statement"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["data_type"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["first_value"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["second_value"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-AB5A78FD
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_proc_transition_rule_id"] = new clsSQLParameter("ctrlp_proc_transition_rule_id", ccsFloat, "", "", $this->p_proc_transition_rule_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr772", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["column_name"] = new clsSQLParameter("ctrlcolumn_name", ccsText, "", "", $this->column_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["table_name"] = new clsSQLParameter("ctrltable_name", ccsText, "", "", $this->table_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_active"] = new clsSQLParameter("ctrlis_active", ccsText, "", "", $this->is_active->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_range"] = new clsSQLParameter("ctrlis_range", ccsText, "", "", $this->is_range->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_statement"] = new clsSQLParameter("ctrlis_statement", ccsText, "", "", $this->is_statement->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["condition_statement"] = new clsSQLParameter("ctrlcondition_statement", ccsText, "", "", $this->condition_statement->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["data_type"] = new clsSQLParameter("ctrldata_type", ccsText, "", "", $this->data_type->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["first_value"] = new clsSQLParameter("ctrlfirst_value", ccsText, "", "", $this->first_value->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["second_value"] = new clsSQLParameter("ctrlsecond_value", ccsText, "", "", $this->second_value->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_proc_transition_rule_id"]->GetValue()) and !strlen($this->cp["p_proc_transition_rule_id"]->GetText()) and !is_bool($this->cp["p_proc_transition_rule_id"]->GetValue())) 
            $this->cp["p_proc_transition_rule_id"]->SetValue($this->p_proc_transition_rule_id->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["column_name"]->GetValue()) and !strlen($this->cp["column_name"]->GetText()) and !is_bool($this->cp["column_name"]->GetValue())) 
            $this->cp["column_name"]->SetValue($this->column_name->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["table_name"]->GetValue()) and !strlen($this->cp["table_name"]->GetText()) and !is_bool($this->cp["table_name"]->GetValue())) 
            $this->cp["table_name"]->SetValue($this->table_name->GetValue(true));
        if (!is_null($this->cp["is_active"]->GetValue()) and !strlen($this->cp["is_active"]->GetText()) and !is_bool($this->cp["is_active"]->GetValue())) 
            $this->cp["is_active"]->SetValue($this->is_active->GetValue(true));
        if (!is_null($this->cp["is_range"]->GetValue()) and !strlen($this->cp["is_range"]->GetText()) and !is_bool($this->cp["is_range"]->GetValue())) 
            $this->cp["is_range"]->SetValue($this->is_range->GetValue(true));
        if (!is_null($this->cp["is_statement"]->GetValue()) and !strlen($this->cp["is_statement"]->GetText()) and !is_bool($this->cp["is_statement"]->GetValue())) 
            $this->cp["is_statement"]->SetValue($this->is_statement->GetValue(true));
        if (!is_null($this->cp["condition_statement"]->GetValue()) and !strlen($this->cp["condition_statement"]->GetText()) and !is_bool($this->cp["condition_statement"]->GetValue())) 
            $this->cp["condition_statement"]->SetValue($this->condition_statement->GetValue(true));
        if (!is_null($this->cp["data_type"]->GetValue()) and !strlen($this->cp["data_type"]->GetText()) and !is_bool($this->cp["data_type"]->GetValue())) 
            $this->cp["data_type"]->SetValue($this->data_type->GetValue(true));
        if (!is_null($this->cp["first_value"]->GetValue()) and !strlen($this->cp["first_value"]->GetText()) and !is_bool($this->cp["first_value"]->GetValue())) 
            $this->cp["first_value"]->SetValue($this->first_value->GetValue(true));
        if (!is_null($this->cp["second_value"]->GetValue()) and !strlen($this->cp["second_value"]->GetText()) and !is_bool($this->cp["second_value"]->GetValue())) 
            $this->cp["second_value"]->SetValue($this->second_value->GetValue(true));
        $this->SQL = "UPDATE p_proc_transition_rule SET \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "code='" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "', \n" .
        "column_name='" . $this->SQLValue($this->cp["column_name"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "table_name='" . $this->SQLValue($this->cp["table_name"]->GetDBValue(), ccsText) . "', \n" .
        "is_active='" . $this->SQLValue($this->cp["is_active"]->GetDBValue(), ccsText) . "', \n" .
        "is_range='" . $this->SQLValue($this->cp["is_range"]->GetDBValue(), ccsText) . "', \n" .
        "is_statement='" . $this->SQLValue($this->cp["is_statement"]->GetDBValue(), ccsText) . "', \n" .
        "condition_statement='" . $this->SQLValue($this->cp["condition_statement"]->GetDBValue(), ccsText) . "', \n" .
        "data_type='" . $this->SQLValue($this->cp["data_type"]->GetDBValue(), ccsText) . "', \n" .
        "first_value='" . $this->SQLValue($this->cp["first_value"]->GetDBValue(), ccsText) . "', \n" .
        "second_value='" . $this->SQLValue($this->cp["second_value"]->GetDBValue(), ccsText) . "'\n" .
        "WHERE p_proc_transition_rule_id=" . $this->SQLValue($this->cp["p_proc_transition_rule_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-4F7E3294
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_proc_transition_rule_id"] = new clsSQLParameter("ctrlp_proc_transition_rule_id", ccsFloat, "", "", $this->p_proc_transition_rule_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_proc_transition_rule_id"]->GetValue()) and !strlen($this->cp["p_proc_transition_rule_id"]->GetText()) and !is_bool($this->cp["p_proc_transition_rule_id"]->GetValue())) 
            $this->cp["p_proc_transition_rule_id"]->SetValue($this->p_proc_transition_rule_id->GetValue(true));
        if (!strlen($this->cp["p_proc_transition_rule_id"]->GetText()) and !is_bool($this->cp["p_proc_transition_rule_id"]->GetValue(true))) 
            $this->cp["p_proc_transition_rule_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_proc_transition_rule \n" .
        "WHERE  p_proc_transition_rule_id = " . $this->SQLValue($this->cp["p_proc_transition_rule_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_proc_transition_ruleFormDataSource Class @94-FCB6E20C

//Initialize Page @1-A3A80894
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
$TemplateFileName = "p_proc_transition_rule.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-2B45FFFC
include_once("./p_proc_transition_rule_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-79A52882
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_proc_transition_ruleGrid = & new clsGridp_proc_transition_ruleGrid("", $MainPage);
$p_proc_transition_ruleSearch = & new clsRecordp_proc_transition_ruleSearch("", $MainPage);
$p_proc_transition_ruleForm = & new clsRecordp_proc_transition_ruleForm("", $MainPage);
$MainPage->p_proc_transition_ruleGrid = & $p_proc_transition_ruleGrid;
$MainPage->p_proc_transition_ruleSearch = & $p_proc_transition_ruleSearch;
$MainPage->p_proc_transition_ruleForm = & $p_proc_transition_ruleForm;
$p_proc_transition_ruleGrid->Initialize();
$p_proc_transition_ruleForm->Initialize();

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

//Execute Components @1-7FC7BA4B
$p_proc_transition_ruleSearch->Operation();
$p_proc_transition_ruleForm->Operation();
//End Execute Components

//Go to destination page @1-25706E4E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_proc_transition_ruleGrid);
    unset($p_proc_transition_ruleSearch);
    unset($p_proc_transition_ruleForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-187CC035
$p_proc_transition_ruleGrid->Show();
$p_proc_transition_ruleSearch->Show();
$p_proc_transition_ruleForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B36B233E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_proc_transition_ruleGrid);
unset($p_proc_transition_ruleSearch);
unset($p_proc_transition_ruleForm);
unset($Tpl);
//End Unload Page


?>
