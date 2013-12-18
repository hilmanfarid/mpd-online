<?php
//Include Common Files @1-B7F74CDC
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_special_day.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_special_dayGrid { //p_special_dayGrid class @2-F62E9B10

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

//Class_Initialize Event @2-F861DC27
    function clsGridp_special_dayGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_special_dayGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_special_dayGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_special_dayGridDataSource($this);
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
        $this->DLink->Page = "p_special_day.php";
        $this->special_date = & new clsControl(ccsLabel, "special_date", "special_date", ccsText, "", CCGetRequestParam("special_date", ccsGet, NULL), $this);
        $this->update_date = & new clsControl(ccsLabel, "update_date", "update_date", ccsText, "", CCGetRequestParam("update_date", ccsGet, NULL), $this);
        $this->jml_index = & new clsControl(ccsLabel, "jml_index", "jml_index", ccsText, "", CCGetRequestParam("jml_index", ccsGet, NULL), $this);
        $this->p_special_day_id = & new clsControl(ccsHidden, "p_special_day_id", "p_special_day_id", ccsText, "", CCGetRequestParam("p_special_day_id", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_special_day.php";
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

//Show Method @2-472B051E
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
            $this->ControlsVisible["special_date"] = $this->special_date->Visible;
            $this->ControlsVisible["update_date"] = $this->update_date->Visible;
            $this->ControlsVisible["jml_index"] = $this->jml_index->Visible;
            $this->ControlsVisible["p_special_day_id"] = $this->p_special_day_id->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_special_day_id", $this->DataSource->f("p_special_day_id"));
                $this->special_date->SetValue($this->DataSource->special_date->GetValue());
                $this->update_date->SetValue($this->DataSource->update_date->GetValue());
                $this->jml_index->SetValue($this->DataSource->jml_index->GetValue());
                $this->p_special_day_id->SetValue($this->DataSource->p_special_day_id->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->special_date->Show();
                $this->update_date->Show();
                $this->jml_index->Show();
                $this->p_special_day_id->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_app_menu_id", "s_keyword", "ccsForm"));
        $this->Insert_Link->Parameters = CCAddParam($this->Insert_Link->Parameters, "FLAG", "ADD");
        $this->Navigator->Show();
        $this->Insert_Link->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-573825ED
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->special_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->update_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->jml_index->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_special_day_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_special_dayGrid Class @2-FCB6E20C

class clsp_special_dayGridDataSource extends clsDBConnSIKP {  //p_special_dayGridDataSource Class @2-0C3F7B6E

//DataSource Variables @2-83B474E1
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $special_date;
    var $update_date;
    var $jml_index;
    var $p_special_day_id;
    var $description;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-586FA666
    function clsp_special_dayGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_special_dayGrid";
        $this->Initialize();
        $this->special_date = new clsField("special_date", ccsText, "");
        
        $this->update_date = new clsField("update_date", ccsText, "");
        
        $this->jml_index = new clsField("jml_index", ccsText, "");
        
        $this->p_special_day_id = new clsField("p_special_day_id", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-CE087ECC
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "special_date";
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

//Open Method @2-8B4E5C6F
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT * \n" .
        "FROM p_special_day\n" .
        "WHERE description LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') cnt";
        $this->SQL = "SELECT * \n" .
        "FROM p_special_day\n" .
        "WHERE description LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-2758EC3A
    function SetValues()
    {
        $this->special_date->SetDBValue($this->f("special_date"));
        $this->update_date->SetDBValue($this->f("updated_date"));
        $this->jml_index->SetDBValue($this->f("jml_index"));
        $this->p_special_day_id->SetDBValue($this->f("p_special_day_id"));
        $this->description->SetDBValue($this->f("description"));
    }
//End SetValues Method

} //End p_special_dayGridDataSource Class @2-FCB6E20C

class clsRecordp_special_daySearch { //p_special_daySearch Class @3-2910A518

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

//Class_Initialize Event @3-FB61C181
    function clsRecordp_special_daySearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_special_daySearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_special_daySearch";
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
            $this->p_day_category_id = & new clsControl(ccsHidden, "p_day_category_id", "p_day_category_id", ccsFloat, "", CCGetRequestParam("p_day_category_id", $Method, NULL), $this);
            $this->p_special_dayGridPage = & new clsControl(ccsHidden, "p_special_dayGridPage", "p_special_dayGridPage", ccsText, "", CCGetRequestParam("p_special_dayGridPage", $Method, NULL), $this);
            $this->p_day_category_s_keyword = & new clsControl(ccsHidden, "p_day_category_s_keyword", "p_day_category_s_keyword", ccsText, "", CCGetRequestParam("p_day_category_s_keyword", $Method, NULL), $this);
            $this->app_code = & new clsControl(ccsHidden, "app_code", "app_code", ccsText, "", CCGetRequestParam("app_code", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-A2833E13
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->p_day_category_id->Validate() && $Validation);
        $Validation = ($this->p_special_dayGridPage->Validate() && $Validation);
        $Validation = ($this->p_day_category_s_keyword->Validate() && $Validation);
        $Validation = ($this->app_code->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_day_category_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_special_dayGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_day_category_s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->app_code->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-CB38C525
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->p_day_category_id->Errors->Count());
        $errors = ($errors || $this->p_special_dayGridPage->Errors->Count());
        $errors = ($errors || $this->p_day_category_s_keyword->Errors->Count());
        $errors = ($errors || $this->app_code->Errors->Count());
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

//Operation Method @3-17F70C2E
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
        $Redirect = "p_special_day.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_special_day.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-E3DAB36B
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
            $Error = ComposeStrings($Error, $this->p_day_category_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_special_dayGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_day_category_s_keyword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->app_code->Errors->ToString());
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
        $this->p_day_category_id->Show();
        $this->p_special_dayGridPage->Show();
        $this->p_day_category_s_keyword->Show();
        $this->app_code->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End p_special_daySearch Class @3-FCB6E20C

class clsRecordp_special_dayForm { //p_special_dayForm Class @23-02A89503

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

//Class_Initialize Event @23-0E142D1F
    function clsRecordp_special_dayForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_special_dayForm/Error";
        $this->DataSource = new clsp_special_dayFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_special_dayForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->special_date = & new clsControl(ccsTextBox, "special_date", "Tanggal", ccsText, "", CCGetRequestParam("special_date", $Method, NULL), $this);
            $this->special_date->Required = true;
            $this->DatePicker_special_date1 = & new clsDatePicker("DatePicker_special_date1", "p_special_dayForm", "special_date", $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->jml_index = & new clsControl(ccsTextBox, "jml_index", "Jumlah Index", ccsFloat, "", CCGetRequestParam("jml_index", $Method, NULL), $this);
            $this->p_day_category_id = & new clsControl(ccsHidden, "p_day_category_id", "p_day_category_id", ccsText, "", CCGetRequestParam("p_day_category_id", $Method, NULL), $this);
            $this->p_special_day_id = & new clsControl(ccsHidden, "p_special_day_id", "p_special_day_id", ccsText, "", CCGetRequestParam("p_special_day_id", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->special_date->Value) && !strlen($this->special_date->Value) && $this->special_date->Value !== false)
                    $this->special_date->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @23-57AFD34B
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_special_day_id"] = CCGetFromGet("p_special_day_id", NULL);
    }
//End Initialize Method

//Validate Method @23-1288F86D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->special_date->Validate() && $Validation);
        $Validation = ($this->jml_index->Validate() && $Validation);
        $Validation = ($this->p_day_category_id->Validate() && $Validation);
        $Validation = ($this->p_special_day_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->special_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->jml_index->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_day_category_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_special_day_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-807B6363
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->special_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_special_date1->Errors->Count());
        $errors = ($errors || $this->jml_index->Errors->Count());
        $errors = ($errors || $this->p_day_category_id->Errors->Count());
        $errors = ($errors || $this->p_special_day_id->Errors->Count());
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

//Operation Method @23-CF6C436C
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "p_special_day_id", "s_keyword", "FLAG", "p_special_dayGridPage"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "p_special_day_id", "s_keyword", "FLAG", "p_special_dayGridPage"));
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

//InsertRow Method @23-3DAD7C54
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->special_date->SetValue($this->special_date->GetValue(true));
        $this->DataSource->p_day_category_id->SetValue($this->p_day_category_id->GetValue(true));
        $this->DataSource->jml_index->SetValue($this->jml_index->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @23-E35F03EE
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_special_day_id->SetValue($this->p_special_day_id->GetValue(true));
        $this->DataSource->special_date->SetValue($this->special_date->GetValue(true));
        $this->DataSource->p_day_category_id->SetValue($this->p_day_category_id->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->jml_index->SetValue($this->jml_index->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-E7E99EF5
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_special_day_id->SetValue($this->p_special_day_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-105573B9
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
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->special_date->SetValue($this->DataSource->special_date->GetValue());
                    $this->jml_index->SetValue($this->DataSource->jml_index->GetValue());
                    $this->p_day_category_id->SetValue($this->DataSource->p_day_category_id->GetValue());
                    $this->p_special_day_id->SetValue($this->DataSource->p_special_day_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->special_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_special_date1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->jml_index->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_day_category_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_special_day_id->Errors->ToString());
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

        $this->description->Show();
        $this->updated_date->Show();
        $this->updated_by->Show();
        $this->special_date->Show();
        $this->DatePicker_special_date1->Show();
        $this->Button_Cancel->Show();
        $this->Button_Delete->Show();
        $this->Button_Update->Show();
        $this->Button_Insert->Show();
        $this->jml_index->Show();
        $this->p_day_category_id->Show();
        $this->p_special_day_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_special_dayForm Class @23-FCB6E20C

class clsp_special_dayFormDataSource extends clsDBConnSIKP {  //p_special_dayFormDataSource Class @23-5308ED9A

//DataSource Variables @23-ED07A039
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
    var $description;
    var $updated_date;
    var $updated_by;
    var $special_date;
    var $jml_index;
    var $p_day_category_id;
    var $p_special_day_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-2F94442D
    function clsp_special_dayFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_special_dayForm/Error";
        $this->Initialize();
        $this->description = new clsField("description", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->special_date = new clsField("special_date", ccsText, "");
        
        $this->jml_index = new clsField("jml_index", ccsFloat, "");
        
        $this->p_day_category_id = new clsField("p_day_category_id", ccsText, "");
        
        $this->p_special_day_id = new clsField("p_special_day_id", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-A2769FAE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_special_day_id", ccsFloat, "", "", $this->Parameters["urlp_special_day_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "p_special_day_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @23-F2AD68BA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT to_char(updated_date,'DD-MON-YYYY') AS updated_date, to_char(special_date,'DD-MON-YYYY') AS special_date, p_day_category_id,\n\n" .
        "description, jml_index, updated_by, p_special_day_id \n\n" .
        "FROM p_special_day {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-057ACC1A
    function SetValues()
    {
        $this->description->SetDBValue($this->f("description"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->special_date->SetDBValue($this->f("special_date"));
        $this->jml_index->SetDBValue(trim($this->f("jml_index")));
        $this->p_day_category_id->SetDBValue($this->f("p_day_category_id"));
        $this->p_special_day_id->SetDBValue($this->f("p_special_day_id"));
    }
//End SetValues Method

//Insert Method @23-8066B438
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr154", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["special_date"] = new clsSQLParameter("ctrlspecial_date", ccsText, "", "", $this->special_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_day_category_id"] = new clsSQLParameter("ctrlp_day_category_id", ccsText, "", "", $this->p_day_category_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["jml_index"] = new clsSQLParameter("ctrljml_index", ccsText, "", "", $this->jml_index->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["special_date"]->GetValue()) and !strlen($this->cp["special_date"]->GetText()) and !is_bool($this->cp["special_date"]->GetValue())) 
            $this->cp["special_date"]->SetValue($this->special_date->GetValue(true));
        if (!is_null($this->cp["p_day_category_id"]->GetValue()) and !strlen($this->cp["p_day_category_id"]->GetText()) and !is_bool($this->cp["p_day_category_id"]->GetValue())) 
            $this->cp["p_day_category_id"]->SetValue($this->p_day_category_id->GetValue(true));
        if (!is_null($this->cp["jml_index"]->GetValue()) and !strlen($this->cp["jml_index"]->GetText()) and !is_bool($this->cp["jml_index"]->GetValue())) 
            $this->cp["jml_index"]->SetValue($this->jml_index->GetValue(true));
        $this->SQL = "INSERT INTO p_special_day(\n" .
        "            p_special_day_id,\n" .
        "            special_date, \n" .
        "            p_day_category_id, \n" .
        "            updated_date, \n" .
        "            updated_by, \n" .
        "            description, \n" .
        "            jml_index)\n" .
        "    VALUES (generate_id('sikp','p_special_day', 'p_special_day_id'), \n" .
        "            to_date('" . $this->SQLValue($this->cp["special_date"]->GetDBValue(), ccsText) . "', 'DD-MON-YYYY'), \n" .
        "            " . $this->SQLValue($this->cp["p_day_category_id"]->GetDBValue(), ccsText) . ", \n" .
        "            sysdate, \n" .
        "            '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "            '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "            " . $this->SQLValue($this->cp["jml_index"]->GetDBValue(), ccsText) . ");";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-6B25BFA7
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_special_day_id"] = new clsSQLParameter("ctrlp_special_day_id", ccsText, "", "", $this->p_special_day_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["special_date"] = new clsSQLParameter("ctrlspecial_date", ccsText, "", "", $this->special_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_day_category_id"] = new clsSQLParameter("ctrlp_day_category_id", ccsFloat, "", "", $this->p_day_category_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["update_by"] = new clsSQLParameter("expr237", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["jml_index"] = new clsSQLParameter("ctrljml_index", ccsText, "", "", $this->jml_index->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_special_day_id"]->GetValue()) and !strlen($this->cp["p_special_day_id"]->GetText()) and !is_bool($this->cp["p_special_day_id"]->GetValue())) 
            $this->cp["p_special_day_id"]->SetValue($this->p_special_day_id->GetValue(true));
        if (!is_null($this->cp["special_date"]->GetValue()) and !strlen($this->cp["special_date"]->GetText()) and !is_bool($this->cp["special_date"]->GetValue())) 
            $this->cp["special_date"]->SetValue($this->special_date->GetValue(true));
        if (!is_null($this->cp["p_day_category_id"]->GetValue()) and !strlen($this->cp["p_day_category_id"]->GetText()) and !is_bool($this->cp["p_day_category_id"]->GetValue())) 
            $this->cp["p_day_category_id"]->SetValue($this->p_day_category_id->GetValue(true));
        if (!strlen($this->cp["p_day_category_id"]->GetText()) and !is_bool($this->cp["p_day_category_id"]->GetValue(true))) 
            $this->cp["p_day_category_id"]->SetText(0);
        if (!is_null($this->cp["update_by"]->GetValue()) and !strlen($this->cp["update_by"]->GetText()) and !is_bool($this->cp["update_by"]->GetValue())) 
            $this->cp["update_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["jml_index"]->GetValue()) and !strlen($this->cp["jml_index"]->GetText()) and !is_bool($this->cp["jml_index"]->GetValue())) 
            $this->cp["jml_index"]->SetValue($this->jml_index->GetValue(true));
        $this->SQL = "UPDATE p_special_day\n" .
        "   SET special_date='" . $this->SQLValue($this->cp["special_date"]->GetDBValue(), ccsText) . "', \n" .
        "       p_day_category_id=" . $this->SQLValue($this->cp["p_day_category_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "       updated_date=sysdate, \n" .
        "       updated_by='{updated_by}', \n" .
        "       description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "       jml_index=" . $this->SQLValue($this->cp["jml_index"]->GetDBValue(), ccsText) . "\n" .
        " WHERE p_special_day_id=" . $this->SQLValue($this->cp["p_special_day_id"]->GetDBValue(), ccsText) . ";";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-167D5E81
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_special_day_id"] = new clsSQLParameter("ctrlp_special_day_id", ccsFloat, "", "", $this->p_special_day_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_special_day_id"]->GetValue()) and !strlen($this->cp["p_special_day_id"]->GetText()) and !is_bool($this->cp["p_special_day_id"]->GetValue())) 
            $this->cp["p_special_day_id"]->SetValue($this->p_special_day_id->GetValue(true));
        if (!strlen($this->cp["p_special_day_id"]->GetText()) and !is_bool($this->cp["p_special_day_id"]->GetValue(true))) 
            $this->cp["p_special_day_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_special_day WHERE p_special_day_id = " . $this->SQLValue($this->cp["p_special_day_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_special_dayFormDataSource Class @23-FCB6E20C

//Initialize Page @1-A490A40B
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
$TemplateFileName = "p_special_day.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-5BD73C86
include_once("./p_special_day_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-5D26C029
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_special_dayGrid = & new clsGridp_special_dayGrid("", $MainPage);
$p_special_daySearch = & new clsRecordp_special_daySearch("", $MainPage);
$p_special_dayForm = & new clsRecordp_special_dayForm("", $MainPage);
$app_code = & new clsControl(ccsLabel, "app_code", "app_code", ccsText, "", CCGetRequestParam("app_code", ccsGet, NULL), $MainPage);
$MainPage->p_special_dayGrid = & $p_special_dayGrid;
$MainPage->p_special_daySearch = & $p_special_daySearch;
$MainPage->p_special_dayForm = & $p_special_dayForm;
$MainPage->app_code = & $app_code;
$p_special_dayGrid->Initialize();
$p_special_dayForm->Initialize();

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

//Execute Components @1-44E3E4F9
$p_special_daySearch->Operation();
$p_special_dayForm->Operation();
//End Execute Components

//Go to destination page @1-E31D57F4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_special_dayGrid);
    unset($p_special_daySearch);
    unset($p_special_dayForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-C087F205
$p_special_dayGrid->Show();
$p_special_daySearch->Show();
$p_special_dayForm->Show();
$app_code->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-AAE691C5
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_special_dayGrid);
unset($p_special_daySearch);
unset($p_special_dayForm);
unset($Tpl);
//End Unload Page


?>
