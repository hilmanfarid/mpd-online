<?php
//Include Common Files @1-C02A2CDF
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_region.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_regionGrid { //p_regionGrid class @2-7240BB87

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

//Class_Initialize Event @2-7E9C9629
    function clsGridp_regionGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_regionGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_regionGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_regionGridDataSource($this);
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

        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->region_name = & new clsControl(ccsLabel, "region_name", "region_name", ccsText, "", CCGetRequestParam("region_name", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "p_region.php";
        $this->p_region_id = & new clsControl(ccsHidden, "p_region_id", "Id", ccsFloat, "", CCGetRequestParam("p_region_id", ccsGet, NULL), $this);
        $this->region_code = & new clsControl(ccsLabel, "region_code", "region_code", ccsText, "", CCGetRequestParam("region_code", ccsGet, NULL), $this);
        $this->business_area = & new clsControl(ccsLabel, "business_area", "business_area", ccsText, "", CCGetRequestParam("business_area", ccsGet, NULL), $this);
        $this->postal_code = & new clsControl(ccsLabel, "postal_code", "postal_code", ccsText, "", CCGetRequestParam("postal_code", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_region.php";
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

//Show Method @2-F8071B73
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
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["region_name"] = $this->region_name->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["p_region_id"] = $this->p_region_id->Visible;
            $this->ControlsVisible["region_code"] = $this->region_code->Visible;
            $this->ControlsVisible["business_area"] = $this->business_area->Visible;
            $this->ControlsVisible["postal_code"] = $this->postal_code->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->region_name->SetValue($this->DataSource->region_name->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_region_id", $this->DataSource->f("p_region_id"));
                $this->p_region_id->SetValue($this->DataSource->p_region_id->GetValue());
                $this->region_code->SetValue($this->DataSource->region_code->GetValue());
                $this->business_area->SetValue($this->DataSource->business_area->GetValue());
                $this->postal_code->SetValue($this->DataSource->postal_code->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->description->Show();
                $this->region_name->Show();
                $this->DLink->Show();
                $this->p_region_id->Show();
                $this->region_code->Show();
                $this->business_area->Show();
                $this->postal_code->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_region_id", "s_keyword", "ccsForm"));
        $this->Insert_Link->Parameters = CCAddParam($this->Insert_Link->Parameters, "FLAG", "ADD");
        $this->Navigator->Show();
        $this->Insert_Link->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-1E483CD4
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->region_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_region_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->region_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->business_area->Errors->ToString());
        $errors = ComposeStrings($errors, $this->postal_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_regionGrid Class @2-FCB6E20C

class clsp_regionGridDataSource extends clsDBConnSIKP {  //p_regionGridDataSource Class @2-60136BC5

//DataSource Variables @2-59E6B99D
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $description;
    var $region_name;
    var $p_region_id;
    var $region_code;
    var $business_area;
    var $postal_code;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-E6C76434
    function clsp_regionGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_regionGrid";
        $this->Initialize();
        $this->description = new clsField("description", ccsText, "");
        
        $this->region_name = new clsField("region_name", ccsText, "");
        
        $this->p_region_id = new clsField("p_region_id", ccsFloat, "");
        
        $this->region_code = new clsField("region_code", ccsText, "");
        
        $this->business_area = new clsField("business_area", ccsText, "");
        
        $this->postal_code = new clsField("postal_code", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-DA48B1E0
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_region_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-22F266C3
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("3", "urlparent_id", ccsFloat, "", "", $this->Parameters["urlparent_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "upper(region_name)", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "upper(description)", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "nvl(parent_id,0)", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsFloat),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opOR(
             true, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @2-CCA58CDE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM p_region";
        $this->SQL = "SELECT * \n\n" .
        "FROM p_region {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-3957DB49
    function SetValues()
    {
        $this->description->SetDBValue($this->f("description"));
        $this->region_name->SetDBValue($this->f("region_name"));
        $this->p_region_id->SetDBValue(trim($this->f("p_region_id")));
        $this->region_code->SetDBValue($this->f("region_code"));
        $this->business_area->SetDBValue($this->f("business_area"));
        $this->postal_code->SetDBValue($this->f("postal_code"));
    }
//End SetValues Method

} //End p_regionGridDataSource Class @2-FCB6E20C

class clsRecordp_regionSearch { //p_regionSearch Class @3-D5E76A7C

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

//Class_Initialize Event @3-0C10CA96
    function clsRecordp_regionSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_regionSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_regionSearch";
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
            $this->parent_id = & new clsControl(ccsHidden, "parent_id", "parent_id", ccsFloat, "", CCGetRequestParam("parent_id", $Method, NULL), $this);
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

//Operation Method @3-378DC3BC
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
        $Redirect = "p_region.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_region.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-AAF916A3
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

        $this->s_keyword->Show();
        $this->Button_DoSearch->Show();
        $this->parent_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End p_regionSearch Class @3-FCB6E20C

class clsRecordp_regionForm { //p_regionForm Class @23-41339AE1

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

//Class_Initialize Event @23-5D5C4DE6
    function clsRecordp_regionForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_regionForm/Error";
        $this->DataSource = new clsp_regionFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_regionForm";
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
            $this->p_region_id = & new clsControl(ccsHidden, "p_region_id", "Id", ccsFloat, "", CCGetRequestParam("p_region_id", $Method, NULL), $this);
            $this->region_name = & new clsControl(ccsTextBox, "region_name", "Regional", ccsText, "", CCGetRequestParam("region_name", $Method, NULL), $this);
            $this->region_name->Required = true;
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->parent_id = & new clsControl(ccsHidden, "parent_id", "Role", ccsFloat, "", CCGetRequestParam("parent_id", $Method, NULL), $this);
            $this->parent_id->Required = true;
            $this->p_regionGridPage = & new clsControl(ccsHidden, "p_regionGridPage", "p_regionGridPage", ccsText, "", CCGetRequestParam("p_regionGridPage", $Method, NULL), $this);
            $this->p_region_level_id = & new clsControl(ccsListBox, "p_region_level_id", "p_region_level_id", ccsFloat, "", CCGetRequestParam("p_region_level_id", $Method, NULL), $this);
            $this->p_region_level_id->DSType = dsTable;
            $this->p_region_level_id->DataSource = new clsDBConnSIKP();
            $this->p_region_level_id->ds = & $this->p_region_level_id->DataSource;
            $this->p_region_level_id->DataSource->SQL = "SELECT * \n" .
"FROM p_region_level {SQL_Where} {SQL_OrderBy}";
            list($this->p_region_level_id->BoundColumn, $this->p_region_level_id->TextColumn, $this->p_region_level_id->DBFormat) = array("p_region_level_id", "level_name", "");
            $this->p_region_level_id->Required = true;
            $this->region_code = & new clsControl(ccsTextBox, "region_code", "Kode Regional", ccsText, "", CCGetRequestParam("region_code", $Method, NULL), $this);
            $this->business_area = & new clsControl(ccsTextBox, "business_area", "Kode Wilayah", ccsText, "", CCGetRequestParam("business_area", $Method, NULL), $this);
            $this->p_business_area_id = & new clsControl(ccsHidden, "p_business_area_id", "p_business_area_id", ccsFloat, "", CCGetRequestParam("p_business_area_id", $Method, NULL), $this);
            $this->postal_code = & new clsControl(ccsTextBox, "postal_code", "Kode Pos", ccsText, "", CCGetRequestParam("postal_code", $Method, NULL), $this);
            $this->nasional_code = & new clsControl(ccsTextBox, "nasional_code", "Kode Wilayah Nasional", ccsText, "", CCGetRequestParam("nasional_code", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @23-943C19C2
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_region_id"] = CCGetFromGet("p_region_id", NULL);
    }
//End Initialize Method

//Validate Method @23-B602523E
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_region_id->Validate() && $Validation);
        $Validation = ($this->region_name->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->parent_id->Validate() && $Validation);
        $Validation = ($this->p_regionGridPage->Validate() && $Validation);
        $Validation = ($this->p_region_level_id->Validate() && $Validation);
        $Validation = ($this->region_code->Validate() && $Validation);
        $Validation = ($this->business_area->Validate() && $Validation);
        $Validation = ($this->p_business_area_id->Validate() && $Validation);
        $Validation = ($this->postal_code->Validate() && $Validation);
        $Validation = ($this->nasional_code->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_region_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->region_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->parent_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_regionGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_level_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->region_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->business_area->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_business_area_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->postal_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nasional_code->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-87FC1DD8
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_region_id->Errors->Count());
        $errors = ($errors || $this->region_name->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->parent_id->Errors->Count());
        $errors = ($errors || $this->p_regionGridPage->Errors->Count());
        $errors = ($errors || $this->p_region_level_id->Errors->Count());
        $errors = ($errors || $this->region_code->Errors->Count());
        $errors = ($errors || $this->business_area->Errors->Count());
        $errors = ($errors || $this->p_business_area_id->Errors->Count());
        $errors = ($errors || $this->postal_code->Errors->Count());
        $errors = ($errors || $this->nasional_code->Errors->Count());
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

//Operation Method @23-198643A2
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "p_region_id", "s_keyword", "FLAG", "p_regionGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "p_region_id", "s_keyword", "FLAG", "p_regionGridPage"));
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

//InsertRow Method @23-160A4C20
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->region_name->SetValue($this->region_name->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->p_region_level_id->SetValue($this->p_region_level_id->GetValue(true));
        $this->DataSource->parent_id->SetValue($this->parent_id->GetValue(true));
        $this->DataSource->region_code->SetValue($this->region_code->GetValue(true));
        $this->DataSource->p_business_area_id->SetValue($this->p_business_area_id->GetValue(true));
        $this->DataSource->postal_code->SetValue($this->postal_code->GetValue(true));
        $this->DataSource->nasional_code->SetValue($this->nasional_code->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @23-D17D2843
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_region_id->SetValue($this->p_region_id->GetValue(true));
        $this->DataSource->region_name->SetValue($this->region_name->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->p_region_level_id->SetValue($this->p_region_level_id->GetValue(true));
        $this->DataSource->region_code->SetValue($this->region_code->GetValue(true));
        $this->DataSource->p_business_area_id->SetValue($this->p_business_area_id->GetValue(true));
        $this->DataSource->postal_code->SetValue($this->postal_code->GetValue(true));
        $this->DataSource->nasional_code->SetValue($this->nasional_code->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-B67F2766
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_region_id->SetValue($this->p_region_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-9C50CD7F
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

        $this->p_region_level_id->Prepare();

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
                    $this->p_region_id->SetValue($this->DataSource->p_region_id->GetValue());
                    $this->region_name->SetValue($this->DataSource->region_name->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->parent_id->SetValue($this->DataSource->parent_id->GetValue());
                    $this->p_region_level_id->SetValue($this->DataSource->p_region_level_id->GetValue());
                    $this->region_code->SetValue($this->DataSource->region_code->GetValue());
                    $this->business_area->SetValue($this->DataSource->business_area->GetValue());
                    $this->p_business_area_id->SetValue($this->DataSource->p_business_area_id->GetValue());
                    $this->postal_code->SetValue($this->DataSource->postal_code->GetValue());
                    $this->nasional_code->SetValue($this->DataSource->nasional_code->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_region_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->region_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->parent_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_regionGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_level_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->region_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->business_area->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_business_area_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->postal_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nasional_code->Errors->ToString());
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
        $this->p_region_id->Show();
        $this->region_name->Show();
        $this->description->Show();
        $this->updated_date->Show();
        $this->updated_by->Show();
        $this->parent_id->Show();
        $this->p_regionGridPage->Show();
        $this->p_region_level_id->Show();
        $this->region_code->Show();
        $this->business_area->Show();
        $this->p_business_area_id->Show();
        $this->postal_code->Show();
        $this->nasional_code->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_regionForm Class @23-FCB6E20C

class clsp_regionFormDataSource extends clsDBConnSIKP {  //p_regionFormDataSource Class @23-3F24FD31

//DataSource Variables @23-29949BC1
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
    var $p_region_id;
    var $region_name;
    var $description;
    var $updated_date;
    var $updated_by;
    var $parent_id;
    var $p_regionGridPage;
    var $p_region_level_id;
    var $region_code;
    var $business_area;
    var $p_business_area_id;
    var $postal_code;
    var $nasional_code;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-3967B52C
    function clsp_regionFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_regionForm/Error";
        $this->Initialize();
        $this->p_region_id = new clsField("p_region_id", ccsFloat, "");
        
        $this->region_name = new clsField("region_name", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->parent_id = new clsField("parent_id", ccsFloat, "");
        
        $this->p_regionGridPage = new clsField("p_regionGridPage", ccsText, "");
        
        $this->p_region_level_id = new clsField("p_region_level_id", ccsFloat, "");
        
        $this->region_code = new clsField("region_code", ccsText, "");
        
        $this->business_area = new clsField("business_area", ccsText, "");
        
        $this->p_business_area_id = new clsField("p_business_area_id", ccsFloat, "");
        
        $this->postal_code = new clsField("postal_code", ccsText, "");
        
        $this->nasional_code = new clsField("nasional_code", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-2898BEE8
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_region_id", ccsFloat, "", "", $this->Parameters["urlp_region_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "p_region_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @23-F8C4DC8A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM p_region {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-15783809
    function SetValues()
    {
        $this->p_region_id->SetDBValue(trim($this->f("p_region_id")));
        $this->region_name->SetDBValue($this->f("region_name"));
        $this->description->SetDBValue($this->f("description"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->parent_id->SetDBValue(trim($this->f("parent_id")));
        $this->p_region_level_id->SetDBValue(trim($this->f("p_region_level_id")));
        $this->region_code->SetDBValue($this->f("region_code"));
        $this->business_area->SetDBValue($this->f("business_area"));
        $this->p_business_area_id->SetDBValue(trim($this->f("p_business_area_id")));
        $this->postal_code->SetDBValue($this->f("postal_code"));
        $this->nasional_code->SetDBValue($this->f("nasional_code"));
    }
//End SetValues Method

//Insert Method @23-4723EE5A
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["region_name"] = new clsSQLParameter("ctrlregion_name", ccsText, "", "", $this->region_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr220", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["p_region_level_id"] = new clsSQLParameter("ctrlp_region_level_id", ccsText, "", "", $this->p_region_level_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["parent_id"] = new clsSQLParameter("ctrlparent_id", ccsFloat, "", "", $this->parent_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["region_code"] = new clsSQLParameter("ctrlregion_code", ccsText, "", "", $this->region_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_business_area_id"] = new clsSQLParameter("ctrlp_business_area_id", ccsFloat, "", "", $this->p_business_area_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["postal_code"] = new clsSQLParameter("ctrlpostal_code", ccsText, "", "", $this->postal_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["nasional_code"] = new clsSQLParameter("ctrlnasional_code", ccsText, "", "", $this->nasional_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["region_name"]->GetValue()) and !strlen($this->cp["region_name"]->GetText()) and !is_bool($this->cp["region_name"]->GetValue())) 
            $this->cp["region_name"]->SetValue($this->region_name->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["p_region_level_id"]->GetValue()) and !strlen($this->cp["p_region_level_id"]->GetText()) and !is_bool($this->cp["p_region_level_id"]->GetValue())) 
            $this->cp["p_region_level_id"]->SetValue($this->p_region_level_id->GetValue(true));
        if (!is_null($this->cp["parent_id"]->GetValue()) and !strlen($this->cp["parent_id"]->GetText()) and !is_bool($this->cp["parent_id"]->GetValue())) 
            $this->cp["parent_id"]->SetValue($this->parent_id->GetValue(true));
        if (!is_null($this->cp["region_code"]->GetValue()) and !strlen($this->cp["region_code"]->GetText()) and !is_bool($this->cp["region_code"]->GetValue())) 
            $this->cp["region_code"]->SetValue($this->region_code->GetValue(true));
        if (!is_null($this->cp["p_business_area_id"]->GetValue()) and !strlen($this->cp["p_business_area_id"]->GetText()) and !is_bool($this->cp["p_business_area_id"]->GetValue())) 
            $this->cp["p_business_area_id"]->SetValue($this->p_business_area_id->GetValue(true));
        if (!strlen($this->cp["p_business_area_id"]->GetText()) and !is_bool($this->cp["p_business_area_id"]->GetValue(true))) 
            $this->cp["p_business_area_id"]->SetText(0);
        if (!is_null($this->cp["postal_code"]->GetValue()) and !strlen($this->cp["postal_code"]->GetText()) and !is_bool($this->cp["postal_code"]->GetValue())) 
            $this->cp["postal_code"]->SetValue($this->postal_code->GetValue(true));
        if (!is_null($this->cp["nasional_code"]->GetValue()) and !strlen($this->cp["nasional_code"]->GetText()) and !is_bool($this->cp["nasional_code"]->GetValue())) 
            $this->cp["nasional_code"]->SetValue($this->nasional_code->GetValue(true));
        $this->SQL = "INSERT INTO p_region(p_region_id, p_business_area_id, region_name, description, updated_date, updated_by, p_region_level_id, parent_id, region_code, postal_code,nasional_code) \n" .
        "VALUES(generate_id('sikp','p_region','p_region_id'), " . $this->SQLValue($this->cp["p_business_area_id"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["region_name"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["p_region_level_id"]->GetDBValue(), ccsText) . "', decode(" . $this->SQLValue($this->cp["parent_id"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["parent_id"]->GetDBValue(), ccsFloat) . "), '" . $this->SQLValue($this->cp["region_code"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["postal_code"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["nasional_code"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-2AD66A74
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_region_id"] = new clsSQLParameter("ctrlp_region_id", ccsFloat, "", "", $this->p_region_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["region_name"] = new clsSQLParameter("ctrlregion_name", ccsText, "", "", $this->region_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr238", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["p_region_level_id"] = new clsSQLParameter("ctrlp_region_level_id", ccsFloat, "", "", $this->p_region_level_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["region_code"] = new clsSQLParameter("ctrlregion_code", ccsText, "", "", $this->region_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_business_area_id"] = new clsSQLParameter("ctrlp_business_area_id", ccsFloat, "", "", $this->p_business_area_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["postal_code"] = new clsSQLParameter("ctrlpostal_code", ccsText, "", "", $this->postal_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["nasional_code"] = new clsSQLParameter("ctrlnasional_code", ccsText, "", "", $this->nasional_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_region_id"]->GetValue()) and !strlen($this->cp["p_region_id"]->GetText()) and !is_bool($this->cp["p_region_id"]->GetValue())) 
            $this->cp["p_region_id"]->SetValue($this->p_region_id->GetValue(true));
        if (!is_null($this->cp["region_name"]->GetValue()) and !strlen($this->cp["region_name"]->GetText()) and !is_bool($this->cp["region_name"]->GetValue())) 
            $this->cp["region_name"]->SetValue($this->region_name->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["p_region_level_id"]->GetValue()) and !strlen($this->cp["p_region_level_id"]->GetText()) and !is_bool($this->cp["p_region_level_id"]->GetValue())) 
            $this->cp["p_region_level_id"]->SetValue($this->p_region_level_id->GetValue(true));
        if (!strlen($this->cp["p_region_level_id"]->GetText()) and !is_bool($this->cp["p_region_level_id"]->GetValue(true))) 
            $this->cp["p_region_level_id"]->SetText(0);
        if (!is_null($this->cp["region_code"]->GetValue()) and !strlen($this->cp["region_code"]->GetText()) and !is_bool($this->cp["region_code"]->GetValue())) 
            $this->cp["region_code"]->SetValue($this->region_code->GetValue(true));
        if (!is_null($this->cp["p_business_area_id"]->GetValue()) and !strlen($this->cp["p_business_area_id"]->GetText()) and !is_bool($this->cp["p_business_area_id"]->GetValue())) 
            $this->cp["p_business_area_id"]->SetValue($this->p_business_area_id->GetValue(true));
        if (!strlen($this->cp["p_business_area_id"]->GetText()) and !is_bool($this->cp["p_business_area_id"]->GetValue(true))) 
            $this->cp["p_business_area_id"]->SetText(0);
        if (!is_null($this->cp["postal_code"]->GetValue()) and !strlen($this->cp["postal_code"]->GetText()) and !is_bool($this->cp["postal_code"]->GetValue())) 
            $this->cp["postal_code"]->SetValue($this->postal_code->GetValue(true));
        if (!is_null($this->cp["nasional_code"]->GetValue()) and !strlen($this->cp["nasional_code"]->GetText()) and !is_bool($this->cp["nasional_code"]->GetValue())) 
            $this->cp["nasional_code"]->SetValue($this->nasional_code->GetValue(true));
        $this->SQL = "UPDATE p_region SET \n" .
        "region_code='" . $this->SQLValue($this->cp["region_code"]->GetDBValue(), ccsText) . "',\n" .
        "region_name='" . $this->SQLValue($this->cp["region_name"]->GetDBValue(), ccsText) . "', \n" .
        "p_region_level_id=" . $this->SQLValue($this->cp["p_region_level_id"]->GetDBValue(), ccsFloat) . ",\n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "',\n" .
        "p_business_area_id = " . $this->SQLValue($this->cp["p_business_area_id"]->GetDBValue(), ccsFloat) . ",\n" .
        "postal_code='" . $this->SQLValue($this->cp["postal_code"]->GetDBValue(), ccsText) . "',\n" .
        "nasional_code='" . $this->SQLValue($this->cp["nasional_code"]->GetDBValue(), ccsText) . "'\n" .
        "WHERE p_region_id=" . $this->SQLValue($this->cp["p_region_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-C064196B
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_region_id"] = new clsSQLParameter("ctrlp_region_id", ccsFloat, "", "", $this->p_region_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_region_id"]->GetValue()) and !strlen($this->cp["p_region_id"]->GetText()) and !is_bool($this->cp["p_region_id"]->GetValue())) 
            $this->cp["p_region_id"]->SetValue($this->p_region_id->GetValue(true));
        if (!strlen($this->cp["p_region_id"]->GetText()) and !is_bool($this->cp["p_region_id"]->GetValue(true))) 
            $this->cp["p_region_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_region \n" .
        "WHERE  p_region_id = " . $this->SQLValue($this->cp["p_region_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_regionFormDataSource Class @23-FCB6E20C

//Initialize Page @1-D3B12148
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
$TemplateFileName = "p_region.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-D9379713
include_once("./p_region_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-33709C65
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_regionGrid = & new clsGridp_regionGrid("", $MainPage);
$p_regionSearch = & new clsRecordp_regionSearch("", $MainPage);
$p_regionForm = & new clsRecordp_regionForm("", $MainPage);
$MainPage->p_regionGrid = & $p_regionGrid;
$MainPage->p_regionSearch = & $p_regionSearch;
$MainPage->p_regionForm = & $p_regionForm;
$p_regionGrid->Initialize();
$p_regionForm->Initialize();

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

//Execute Components @1-ED899107
$p_regionSearch->Operation();
$p_regionForm->Operation();
//End Execute Components

//Go to destination page @1-8865C3BD
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_regionGrid);
    unset($p_regionSearch);
    unset($p_regionForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-03B40A71
$p_regionGrid->Show();
$p_regionSearch->Show();
$p_regionForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-EDA618F0
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_regionGrid);
unset($p_regionSearch);
unset($p_regionForm);
unset($Tpl);
//End Unload Page


?>
