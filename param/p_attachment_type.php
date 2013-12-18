<?php
//Include Common Files @1-E7A9F185
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_attachment_type.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_attachment_typeGrid { //p_attachment_typeGrid class @2-0B393E70

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

//Class_Initialize Event @2-D0B94C36
    function clsGridp_attachment_typeGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_attachment_typeGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_attachment_typeGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_attachment_typeGridDataSource($this);
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
        $this->DLink->Page = "p_attachment_type.php";
        $this->code = & new clsControl(ccsLabel, "code", "code", ccsText, "", CCGetRequestParam("code", ccsGet, NULL), $this);
        $this->p_attachment_type_id = & new clsControl(ccsHidden, "p_attachment_type_id", "p_attachment_type_id", ccsFloat, "", CCGetRequestParam("p_attachment_type_id", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->listing_no = & new clsControl(ccsLabel, "listing_no", "listing_no", ccsFloat, "", CCGetRequestParam("listing_no", ccsGet, NULL), $this);
        $this->group_code = & new clsControl(ccsLabel, "group_code", "group_code", ccsText, "", CCGetRequestParam("group_code", ccsGet, NULL), $this);
        $this->is_mandatory = & new clsControl(ccsLabel, "is_mandatory", "is_mandatory", ccsText, "", CCGetRequestParam("is_mandatory", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_attachment_type.php";
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

//Show Method @2-C4FBC97F
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
            $this->ControlsVisible["code"] = $this->code->Visible;
            $this->ControlsVisible["p_attachment_type_id"] = $this->p_attachment_type_id->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["listing_no"] = $this->listing_no->Visible;
            $this->ControlsVisible["group_code"] = $this->group_code->Visible;
            $this->ControlsVisible["is_mandatory"] = $this->is_mandatory->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_attachment_type_id", $this->DataSource->f("p_attachment_type_id"));
                $this->code->SetValue($this->DataSource->code->GetValue());
                $this->p_attachment_type_id->SetValue($this->DataSource->p_attachment_type_id->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->listing_no->SetValue($this->DataSource->listing_no->GetValue());
                $this->group_code->SetValue($this->DataSource->group_code->GetValue());
                $this->is_mandatory->SetValue($this->DataSource->is_mandatory->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->code->Show();
                $this->p_attachment_type_id->Show();
                $this->description->Show();
                $this->listing_no->Show();
                $this->group_code->Show();
                $this->is_mandatory->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_attachment_type_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-7D56471A
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_attachment_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->listing_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->group_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->is_mandatory->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_attachment_typeGrid Class @2-FCB6E20C

class clsp_attachment_typeGridDataSource extends clsDBConnSIKP {  //p_attachment_typeGridDataSource Class @2-7E172AD4

//DataSource Variables @2-DFDFB910
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $code;
    var $p_attachment_type_id;
    var $description;
    var $listing_no;
    var $group_code;
    var $is_mandatory;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-5FB631A2
    function clsp_attachment_typeGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_attachment_typeGrid";
        $this->Initialize();
        $this->code = new clsField("code", ccsText, "");
        
        $this->p_attachment_type_id = new clsField("p_attachment_type_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->listing_no = new clsField("listing_no", ccsFloat, "");
        
        $this->group_code = new clsField("group_code", ccsText, "");
        
        $this->is_mandatory = new clsField("is_mandatory", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-34582E48
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "a.listing_no";
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

//Open Method @2-715F746D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.p_attachment_type_id, a.code, decode(a.is_mandatory,'Y','YA','TIDAK')as is_mandatory, \n" .
        "a.listing_no, a.description, a.p_attachment_group_id, b.code as group_code\n" .
        "FROM p_attachment_type a, p_attachment_group b\n" .
        "WHERE a.p_attachment_group_id = b.p_attachment_group_id AND\n" .
        "(upper(a.code) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(b.code) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')) cnt";
        $this->SQL = "SELECT a.p_attachment_type_id, a.code, decode(a.is_mandatory,'Y','YA','TIDAK')as is_mandatory, \n" .
        "a.listing_no, a.description, a.p_attachment_group_id, b.code as group_code\n" .
        "FROM p_attachment_type a, p_attachment_group b\n" .
        "WHERE a.p_attachment_group_id = b.p_attachment_group_id AND\n" .
        "(upper(a.code) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(b.code) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')  {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-E824F19D
    function SetValues()
    {
        $this->code->SetDBValue($this->f("code"));
        $this->p_attachment_type_id->SetDBValue(trim($this->f("p_attachment_type_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->listing_no->SetDBValue(trim($this->f("listing_no")));
        $this->group_code->SetDBValue($this->f("group_code"));
        $this->is_mandatory->SetDBValue($this->f("is_mandatory"));
    }
//End SetValues Method

} //End p_attachment_typeGridDataSource Class @2-FCB6E20C

class clsRecordp_attachment_typeSearch { //p_attachment_typeSearch Class @3-7D88E194

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

//Class_Initialize Event @3-CAB65558
    function clsRecordp_attachment_typeSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_attachment_typeSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_attachment_typeSearch";
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

//Operation Method @3-4DB41D59
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
        $Redirect = "p_attachment_type.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_attachment_type.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

} //End p_attachment_typeSearch Class @3-FCB6E20C

class clsRecordp_attachment_typeForm { //p_attachment_typeForm Class @94-78B31AAC

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

//Class_Initialize Event @94-CEB998F2
    function clsRecordp_attachment_typeForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_attachment_typeForm/Error";
        $this->DataSource = new clsp_attachment_typeFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_attachment_typeForm";
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
            $this->p_attachment_type_id = & new clsControl(ccsHidden, "p_attachment_type_id", "Id", ccsFloat, "", CCGetRequestParam("p_attachment_type_id", $Method, NULL), $this);
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->p_attachment_typeGridPage = & new clsControl(ccsHidden, "p_attachment_typeGridPage", "p_attachment_typeGridPage", ccsText, "", CCGetRequestParam("p_attachment_typeGridPage", $Method, NULL), $this);
            $this->listing_no = & new clsControl(ccsTextBox, "listing_no", "No Urut", ccsFloat, "", CCGetRequestParam("listing_no", $Method, NULL), $this);
            $this->listing_no->Required = true;
            $this->code = & new clsControl(ccsTextBox, "code", "Jenis Kegiatan SPP", ccsText, "", CCGetRequestParam("code", $Method, NULL), $this);
            $this->code->Required = true;
            $this->group_code = & new clsControl(ccsTextBox, "group_code", "Kelompok", ccsText, "", CCGetRequestParam("group_code", $Method, NULL), $this);
            $this->group_code->Required = true;
            $this->p_attachment_group_id = & new clsControl(ccsHidden, "p_attachment_group_id", "Id", ccsFloat, "", CCGetRequestParam("p_attachment_group_id", $Method, NULL), $this);
            $this->is_mandatory = & new clsControl(ccsListBox, "is_mandatory", "Perlu?", ccsText, "", CCGetRequestParam("is_mandatory", $Method, NULL), $this);
            $this->is_mandatory->DSType = dsListOfValues;
            $this->is_mandatory->Values = array(array("Y", "YA"), array("N", "TIDAK"));
            $this->is_mandatory->Required = true;
            if(!$this->FormSubmitted) {
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->is_mandatory->Value) && !strlen($this->is_mandatory->Value) && $this->is_mandatory->Value !== false)
                    $this->is_mandatory->SetText("Y");
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-9C0D0A9F
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_attachment_type_id"] = CCGetFromGet("p_attachment_type_id", NULL);
    }
//End Initialize Method

//Validate Method @94-5BD1CF6F
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_attachment_type_id->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->p_attachment_typeGridPage->Validate() && $Validation);
        $Validation = ($this->listing_no->Validate() && $Validation);
        $Validation = ($this->code->Validate() && $Validation);
        $Validation = ($this->group_code->Validate() && $Validation);
        $Validation = ($this->p_attachment_group_id->Validate() && $Validation);
        $Validation = ($this->is_mandatory->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_attachment_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_attachment_typeGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->listing_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->group_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_attachment_group_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_mandatory->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-85EE6830
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_attachment_type_id->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->p_attachment_typeGridPage->Errors->Count());
        $errors = ($errors || $this->listing_no->Errors->Count());
        $errors = ($errors || $this->code->Errors->Count());
        $errors = ($errors || $this->group_code->Errors->Count());
        $errors = ($errors || $this->p_attachment_group_id->Errors->Count());
        $errors = ($errors || $this->is_mandatory->Errors->Count());
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

//Operation Method @94-94CD9B27
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_attachment_type_id", "s_keyword", "p_attachment_typeGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_attachment_type_id", "s_keyword", "p_attachment_typeGridPage"));
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

//InsertRow Method @94-04BEDE86
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->listing_no->SetValue($this->listing_no->GetValue(true));
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->is_mandatory->SetValue($this->is_mandatory->GetValue(true));
        $this->DataSource->p_attachment_group_id->SetValue($this->p_attachment_group_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-3BC6E58E
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_attachment_group_id->SetValue($this->p_attachment_group_id->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->listing_no->SetValue($this->listing_no->GetValue(true));
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->is_mandatory->SetValue($this->is_mandatory->GetValue(true));
        $this->DataSource->p_attachment_type_id->SetValue($this->p_attachment_type_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-DCCE2355
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_attachment_type_id->SetValue($this->p_attachment_type_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-E53518B6
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

        $this->is_mandatory->Prepare();

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
                    $this->p_attachment_type_id->SetValue($this->DataSource->p_attachment_type_id->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->listing_no->SetValue($this->DataSource->listing_no->GetValue());
                    $this->code->SetValue($this->DataSource->code->GetValue());
                    $this->group_code->SetValue($this->DataSource->group_code->GetValue());
                    $this->p_attachment_group_id->SetValue($this->DataSource->p_attachment_group_id->GetValue());
                    $this->is_mandatory->SetValue($this->DataSource->is_mandatory->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_attachment_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_attachment_typeGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->listing_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->group_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_attachment_group_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_mandatory->Errors->ToString());
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
        $this->p_attachment_type_id->Show();
        $this->description->Show();
        $this->created_by->Show();
        $this->updated_by->Show();
        $this->creation_date->Show();
        $this->updated_date->Show();
        $this->p_attachment_typeGridPage->Show();
        $this->listing_no->Show();
        $this->code->Show();
        $this->group_code->Show();
        $this->p_attachment_group_id->Show();
        $this->is_mandatory->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_attachment_typeForm Class @94-FCB6E20C

class clsp_attachment_typeFormDataSource extends clsDBConnSIKP {  //p_attachment_typeFormDataSource Class @94-2120BC20

//DataSource Variables @94-30FC9630
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
    var $p_attachment_type_id;
    var $description;
    var $created_by;
    var $updated_by;
    var $creation_date;
    var $updated_date;
    var $p_attachment_typeGridPage;
    var $listing_no;
    var $code;
    var $group_code;
    var $p_attachment_group_id;
    var $is_mandatory;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-F6EAC1C6
    function clsp_attachment_typeFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_attachment_typeForm/Error";
        $this->Initialize();
        $this->p_attachment_type_id = new clsField("p_attachment_type_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->p_attachment_typeGridPage = new clsField("p_attachment_typeGridPage", ccsText, "");
        
        $this->listing_no = new clsField("listing_no", ccsFloat, "");
        
        $this->code = new clsField("code", ccsText, "");
        
        $this->group_code = new clsField("group_code", ccsText, "");
        
        $this->p_attachment_group_id = new clsField("p_attachment_group_id", ccsFloat, "");
        
        $this->is_mandatory = new clsField("is_mandatory", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-325AFCD2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_attachment_type_id", ccsFloat, "", "", $this->Parameters["urlp_attachment_type_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-CF20C3D9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT a.p_attachment_type_id, a.code, a.is_mandatory, \n" .
        "a.listing_no, a.description, a.p_attachment_group_id, b.code as group_code,\n" .
        "to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, a.updated_by\n" .
        "FROM p_attachment_type a, p_attachment_group b\n" .
        "WHERE a.p_attachment_group_id = b.p_attachment_group_id AND\n" .
        "a.p_attachment_type_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-447DB95B
    function SetValues()
    {
        $this->p_attachment_type_id->SetDBValue(trim($this->f("p_attachment_type_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->listing_no->SetDBValue(trim($this->f("listing_no")));
        $this->code->SetDBValue($this->f("code"));
        $this->group_code->SetDBValue($this->f("group_code"));
        $this->p_attachment_group_id->SetDBValue(trim($this->f("p_attachment_group_id")));
        $this->is_mandatory->SetDBValue($this->f("is_mandatory"));
    }
//End SetValues Method

//Insert Method @94-FE2D50B4
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr627", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr628", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["listing_no"] = new clsSQLParameter("ctrllisting_no", ccsFloat, "", "", $this->listing_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_mandatory"] = new clsSQLParameter("ctrlis_mandatory", ccsText, "", "", $this->is_mandatory->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_attachment_group_id"] = new clsSQLParameter("ctrlp_attachment_group_id", ccsFloat, "", "", $this->p_attachment_group_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["listing_no"]->GetValue()) and !strlen($this->cp["listing_no"]->GetText()) and !is_bool($this->cp["listing_no"]->GetValue())) 
            $this->cp["listing_no"]->SetValue($this->listing_no->GetValue(true));
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["is_mandatory"]->GetValue()) and !strlen($this->cp["is_mandatory"]->GetText()) and !is_bool($this->cp["is_mandatory"]->GetValue())) 
            $this->cp["is_mandatory"]->SetValue($this->is_mandatory->GetValue(true));
        if (!is_null($this->cp["p_attachment_group_id"]->GetValue()) and !strlen($this->cp["p_attachment_group_id"]->GetText()) and !is_bool($this->cp["p_attachment_group_id"]->GetValue())) 
            $this->cp["p_attachment_group_id"]->SetValue($this->p_attachment_group_id->GetValue(true));
        if (!strlen($this->cp["p_attachment_group_id"]->GetText()) and !is_bool($this->cp["p_attachment_group_id"]->GetValue(true))) 
            $this->cp["p_attachment_group_id"]->SetText(0);
        $this->SQL = "INSERT INTO p_attachment_type(p_attachment_type_id, p_attachment_group_id, description, created_by, updated_by, creation_date, updated_date, listing_no, code, is_mandatory) \n" .
        "VALUES(generate_id('sikp','p_attachment_type','p_attachment_type_id'), " . $this->SQLValue($this->cp["p_attachment_group_id"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', sysdate, sysdate, " . $this->SQLValue($this->cp["listing_no"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["is_mandatory"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-9B54B625
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_attachment_group_id"] = new clsSQLParameter("ctrlp_attachment_group_id", ccsFloat, "", "", $this->p_attachment_group_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr644", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["listing_no"] = new clsSQLParameter("ctrllisting_no", ccsFloat, "", "", $this->listing_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_mandatory"] = new clsSQLParameter("ctrlis_mandatory", ccsText, "", "", $this->is_mandatory->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_attachment_type_id"] = new clsSQLParameter("ctrlp_attachment_type_id", ccsFloat, "", "", $this->p_attachment_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_attachment_group_id"]->GetValue()) and !strlen($this->cp["p_attachment_group_id"]->GetText()) and !is_bool($this->cp["p_attachment_group_id"]->GetValue())) 
            $this->cp["p_attachment_group_id"]->SetValue($this->p_attachment_group_id->GetValue(true));
        if (!strlen($this->cp["p_attachment_group_id"]->GetText()) and !is_bool($this->cp["p_attachment_group_id"]->GetValue(true))) 
            $this->cp["p_attachment_group_id"]->SetText(0);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["listing_no"]->GetValue()) and !strlen($this->cp["listing_no"]->GetText()) and !is_bool($this->cp["listing_no"]->GetValue())) 
            $this->cp["listing_no"]->SetValue($this->listing_no->GetValue(true));
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["is_mandatory"]->GetValue()) and !strlen($this->cp["is_mandatory"]->GetText()) and !is_bool($this->cp["is_mandatory"]->GetValue())) 
            $this->cp["is_mandatory"]->SetValue($this->is_mandatory->GetValue(true));
        if (!is_null($this->cp["p_attachment_type_id"]->GetValue()) and !strlen($this->cp["p_attachment_type_id"]->GetText()) and !is_bool($this->cp["p_attachment_type_id"]->GetValue())) 
            $this->cp["p_attachment_type_id"]->SetValue($this->p_attachment_type_id->GetValue(true));
        if (!strlen($this->cp["p_attachment_type_id"]->GetText()) and !is_bool($this->cp["p_attachment_type_id"]->GetValue(true))) 
            $this->cp["p_attachment_type_id"]->SetText(0);
        $this->SQL = "UPDATE p_attachment_type SET \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "',  \n" .
        "updated_date=sysdate, \n" .
        "listing_no=" . $this->SQLValue($this->cp["listing_no"]->GetDBValue(), ccsFloat) . ", \n" .
        "code='" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "',\n" .
        "is_mandatory='" . $this->SQLValue($this->cp["is_mandatory"]->GetDBValue(), ccsText) . "',\n" .
        "p_attachment_group_id=" . $this->SQLValue($this->cp["p_attachment_group_id"]->GetDBValue(), ccsFloat) . "\n" .
        "WHERE p_attachment_type_id=" . $this->SQLValue($this->cp["p_attachment_type_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-CD69BC57
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_attachment_type_id"] = new clsSQLParameter("ctrlp_attachment_type_id", ccsFloat, "", "", $this->p_attachment_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_attachment_type_id"]->GetValue()) and !strlen($this->cp["p_attachment_type_id"]->GetText()) and !is_bool($this->cp["p_attachment_type_id"]->GetValue())) 
            $this->cp["p_attachment_type_id"]->SetValue($this->p_attachment_type_id->GetValue(true));
        if (!strlen($this->cp["p_attachment_type_id"]->GetText()) and !is_bool($this->cp["p_attachment_type_id"]->GetValue(true))) 
            $this->cp["p_attachment_type_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_attachment_type\n" .
        "WHERE p_attachment_type_id = " . $this->SQLValue($this->cp["p_attachment_type_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_attachment_typeFormDataSource Class @94-FCB6E20C

//Initialize Page @1-229C5078
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
$TemplateFileName = "p_attachment_type.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-6EF45B9A
include_once("./p_attachment_type_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-81C82AE0
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_attachment_typeGrid = & new clsGridp_attachment_typeGrid("", $MainPage);
$p_attachment_typeSearch = & new clsRecordp_attachment_typeSearch("", $MainPage);
$p_attachment_typeForm = & new clsRecordp_attachment_typeForm("", $MainPage);
$MainPage->p_attachment_typeGrid = & $p_attachment_typeGrid;
$MainPage->p_attachment_typeSearch = & $p_attachment_typeSearch;
$MainPage->p_attachment_typeForm = & $p_attachment_typeForm;
$p_attachment_typeGrid->Initialize();
$p_attachment_typeForm->Initialize();

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

//Execute Components @1-CD6EF4F2
$p_attachment_typeSearch->Operation();
$p_attachment_typeForm->Operation();
//End Execute Components

//Go to destination page @1-A8387844
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_attachment_typeGrid);
    unset($p_attachment_typeSearch);
    unset($p_attachment_typeForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A9AC06EB
$p_attachment_typeGrid->Show();
$p_attachment_typeSearch->Show();
$p_attachment_typeForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-94CBA9A6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_attachment_typeGrid);
unset($p_attachment_typeSearch);
unset($p_attachment_typeForm);
unset($Tpl);
//End Unload Page


?>
