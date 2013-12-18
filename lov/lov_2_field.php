<?php
//Include Common Files @1-591470A7
define("RelativePath", "..");
define("PathToCurrentPage", "/lov/");
define("FileName", "lov_2_field.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridLovGrid { //LovGrid class @2-85AB34A3

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

//Class_Initialize Event @2-595B2FDA
    function clsGridLovGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "LovGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid LovGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsLovGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 14;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->FIELD_1 = & new clsControl(ccsLabel, "FIELD_1", "FIELD_1", ccsText, "", CCGetRequestParam("FIELD_1", ccsGet, NULL), $this);
        $this->FIELD_2 = & new clsControl(ccsLabel, "FIELD_2", "FIELD_2", ccsText, "", CCGetRequestParam("FIELD_2", ccsGet, NULL), $this);
        $this->PILIH = & new clsControl(ccsLabel, "PILIH", "PILIH", ccsText, "", CCGetRequestParam("PILIH", ccsGet, NULL), $this);
        $this->PILIH->HTML = true;
        $this->FIELD_0 = & new clsControl(ccsTextBox, "FIELD_0", "FIELD_0", ccsText, "", CCGetRequestParam("FIELD_0", ccsGet, NULL), $this);
        $this->FIELD_0->Visible = false;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 5, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Header1 = & new clsControl(ccsLabel, "Header1", "Header1", ccsText, "", CCGetRequestParam("Header1", ccsGet, NULL), $this);
        $this->Header2 = & new clsControl(ccsLabel, "Header2", "Header2", ccsText, "", CCGetRequestParam("Header2", ccsGet, NULL), $this);
        $this->HEADER_LOV = & new clsControl(ccsLabel, "HEADER_LOV", "HEADER_LOV", ccsText, "", CCGetRequestParam("HEADER_LOV", ccsGet, NULL), $this);
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

//Show Method @2-EE652E62
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["urlTABLE"] = CCGetFromGet("TABLE", NULL);
        $this->DataSource->Parameters["urlFIELD_0"] = CCGetFromGet("FIELD_0", NULL);
        $this->DataSource->Parameters["urlFIELD_1"] = CCGetFromGet("FIELD_1", NULL);
        $this->DataSource->Parameters["urlFIELD_2"] = CCGetFromGet("FIELD_2", NULL);
        $this->DataSource->Parameters["urlFIELD_3"] = CCGetFromGet("FIELD_3", NULL);

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
            $this->ControlsVisible["FIELD_1"] = $this->FIELD_1->Visible;
            $this->ControlsVisible["FIELD_2"] = $this->FIELD_2->Visible;
            $this->ControlsVisible["PILIH"] = $this->PILIH->Visible;
            $this->ControlsVisible["FIELD_0"] = $this->FIELD_0->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->FIELD_1->SetValue($this->DataSource->FIELD_1->GetValue());
                $this->FIELD_2->SetValue($this->DataSource->FIELD_2->GetValue());
                $this->FIELD_0->SetValue($this->DataSource->FIELD_0->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->FIELD_1->Show();
                $this->FIELD_2->Show();
                $this->PILIH->Show();
                $this->FIELD_0->Show();
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
        $this->Navigator->Show();
        $this->Header1->Show();
        $this->Header2->Show();
        $this->HEADER_LOV->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-A43A3084
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->FIELD_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FIELD_2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PILIH->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FIELD_0->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End LovGrid Class @2-FCB6E20C

class clsLovGridDataSource extends clsDBConnSIKP {  //LovGridDataSource Class @2-AD73F0AD

//DataSource Variables @2-ACBAF3D3
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $FIELD_1;
    var $FIELD_2;
    var $FIELD_0;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-F4A61568
    function clsLovGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid LovGrid";
        $this->Initialize();
        $this->FIELD_1 = new clsField("FIELD_1", ccsText, "");
        
        $this->FIELD_2 = new clsField("FIELD_2", ccsText, "");
        
        $this->FIELD_0 = new clsField("FIELD_0", ccsText, "");
        

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

//Prepare Method @2-7F956DB0
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urlTABLE", ccsText, "", "", $this->Parameters["urlTABLE"], "", false);
        $this->wp->AddParameter("3", "urlFIELD_0", ccsText, "", "", $this->Parameters["urlFIELD_0"], "", false);
        $this->wp->AddParameter("4", "urlFIELD_1", ccsText, "", "", $this->Parameters["urlFIELD_1"], "", false);
        $this->wp->AddParameter("5", "urlFIELD_2", ccsText, "", "", $this->Parameters["urlFIELD_2"], "", false);
        $this->wp->AddParameter("6", "urlFIELD_3", ccsText, "", "", $this->Parameters["urlFIELD_3"], "", false);
    }
//End Prepare Method

//Open Method @2-7AF57480
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT \n" .
        "" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . " FIELD_0,\n" .
        "" . $this->SQLValue($this->wp->GetDBValue("4"), ccsText) . " FIELD_1,\n" .
        "" . $this->SQLValue($this->wp->GetDBValue("5"), ccsText) . " FIELD_2\n" .
        "FROM " . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "\n" .
        "WHERE \n" .
        "(UPPER(TRIM(" . $this->SQLValue($this->wp->GetDBValue("4"), ccsText) . ")) LIKE upper(trim('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'))\n" .
        "OR UPPER(TRIM(" . $this->SQLValue($this->wp->GetDBValue("5"), ccsText) . ")) LIKE upper(trim('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')))\n" .
        "" . $this->SQLValue($this->wp->GetDBValue("6"), ccsText) . ") cnt";
        $this->SQL = "SELECT \n" .
        "" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . " FIELD_0,\n" .
        "" . $this->SQLValue($this->wp->GetDBValue("4"), ccsText) . " FIELD_1,\n" .
        "" . $this->SQLValue($this->wp->GetDBValue("5"), ccsText) . " FIELD_2\n" .
        "FROM " . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "\n" .
        "WHERE \n" .
        "(UPPER(TRIM(" . $this->SQLValue($this->wp->GetDBValue("4"), ccsText) . ")) LIKE upper(trim('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'))\n" .
        "OR UPPER(TRIM(" . $this->SQLValue($this->wp->GetDBValue("5"), ccsText) . ")) LIKE upper(trim('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')))\n" .
        "" . $this->SQLValue($this->wp->GetDBValue("6"), ccsText) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-8E648374
    function SetValues()
    {
        $this->FIELD_1->SetDBValue($this->f("field_1"));
        $this->FIELD_2->SetDBValue($this->f("field_2"));
        $this->FIELD_0->SetDBValue($this->f("field_0"));
    }
//End SetValues Method

} //End LovGridDataSource Class @2-FCB6E20C

class clsRecordLOV { //LOV Class @3-40E97705

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

//Class_Initialize Event @3-DE88385D
    function clsRecordLOV($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record LOV/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "LOV";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_keyword = & new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->FORM = & new clsControl(ccsHidden, "FORM", "FORM", ccsText, "", CCGetRequestParam("FORM", $Method, NULL), $this);
            $this->OBJ = & new clsControl(ccsHidden, "OBJ", "OBJ", ccsText, "", CCGetRequestParam("OBJ", $Method, NULL), $this);
            $this->LABEL1 = & new clsControl(ccsHidden, "LABEL1", "LABEL1", ccsText, "", CCGetRequestParam("LABEL1", $Method, NULL), $this);
            $this->LABEL2 = & new clsControl(ccsHidden, "LABEL2", "LABEL2", ccsText, "", CCGetRequestParam("LABEL2", $Method, NULL), $this);
            $this->FIELD_0 = & new clsControl(ccsHidden, "FIELD_0", "FIELD_0", ccsText, "", CCGetRequestParam("FIELD_0", $Method, NULL), $this);
            $this->FIELD_1 = & new clsControl(ccsHidden, "FIELD_1", "FIELD_1", ccsText, "", CCGetRequestParam("FIELD_1", $Method, NULL), $this);
            $this->FIELD_2 = & new clsControl(ccsHidden, "FIELD_2", "FIELD_2", ccsText, "", CCGetRequestParam("FIELD_2", $Method, NULL), $this);
            $this->HEADER_PAGE = & new clsControl(ccsHidden, "HEADER_PAGE", "HEADER_PAGE", ccsText, "", CCGetRequestParam("HEADER_PAGE", $Method, NULL), $this);
            $this->HEADER_LOV = & new clsControl(ccsHidden, "HEADER_LOV", "HEADER_LOV", ccsText, "", CCGetRequestParam("HEADER_LOV", $Method, NULL), $this);
            $this->TABLE = & new clsControl(ccsHidden, "TABLE", "TABLE", ccsText, "", CCGetRequestParam("TABLE", $Method, NULL), $this);
            $this->ORDER = & new clsControl(ccsHidden, "ORDER", "ORDER", ccsText, "", CCGetRequestParam("ORDER", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-A444939A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->FORM->Validate() && $Validation);
        $Validation = ($this->OBJ->Validate() && $Validation);
        $Validation = ($this->LABEL1->Validate() && $Validation);
        $Validation = ($this->LABEL2->Validate() && $Validation);
        $Validation = ($this->FIELD_0->Validate() && $Validation);
        $Validation = ($this->FIELD_1->Validate() && $Validation);
        $Validation = ($this->FIELD_2->Validate() && $Validation);
        $Validation = ($this->HEADER_PAGE->Validate() && $Validation);
        $Validation = ($this->HEADER_LOV->Validate() && $Validation);
        $Validation = ($this->TABLE->Validate() && $Validation);
        $Validation = ($this->ORDER->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FORM->Errors->Count() == 0);
        $Validation =  $Validation && ($this->OBJ->Errors->Count() == 0);
        $Validation =  $Validation && ($this->LABEL1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->LABEL2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FIELD_0->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FIELD_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FIELD_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->HEADER_PAGE->Errors->Count() == 0);
        $Validation =  $Validation && ($this->HEADER_LOV->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TABLE->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ORDER->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-8165C652
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->FORM->Errors->Count());
        $errors = ($errors || $this->OBJ->Errors->Count());
        $errors = ($errors || $this->LABEL1->Errors->Count());
        $errors = ($errors || $this->LABEL2->Errors->Count());
        $errors = ($errors || $this->FIELD_0->Errors->Count());
        $errors = ($errors || $this->FIELD_1->Errors->Count());
        $errors = ($errors || $this->FIELD_2->Errors->Count());
        $errors = ($errors || $this->HEADER_PAGE->Errors->Count());
        $errors = ($errors || $this->HEADER_LOV->Errors->Count());
        $errors = ($errors || $this->TABLE->Errors->Count());
        $errors = ($errors || $this->ORDER->Errors->Count());
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

//Operation Method @3-D409EA8F
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
        $Redirect = "lov_2_field.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "lov_2_field.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-3D63DACD
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
            $Error = ComposeStrings($Error, $this->FORM->Errors->ToString());
            $Error = ComposeStrings($Error, $this->OBJ->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LABEL1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LABEL2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FIELD_0->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FIELD_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FIELD_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->HEADER_PAGE->Errors->ToString());
            $Error = ComposeStrings($Error, $this->HEADER_LOV->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TABLE->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ORDER->Errors->ToString());
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
        $this->FORM->Show();
        $this->OBJ->Show();
        $this->LABEL1->Show();
        $this->LABEL2->Show();
        $this->FIELD_0->Show();
        $this->FIELD_1->Show();
        $this->FIELD_2->Show();
        $this->HEADER_PAGE->Show();
        $this->HEADER_LOV->Show();
        $this->TABLE->Show();
        $this->ORDER->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End LOV Class @3-FCB6E20C

//Initialize Page @1-553DBF4E
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
$TemplateFileName = "lov_2_field.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-95CD52B8
include_once("./lov_2_field_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-8E821BCC
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$LovGrid = & new clsGridLovGrid("", $MainPage);
$LOV = & new clsRecordLOV("", $MainPage);
$MainPage->LovGrid = & $LovGrid;
$MainPage->LOV = & $LOV;
$LovGrid->Initialize();

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

//Execute Components @1-0F06B063
$LOV->Operation();
//End Execute Components

//Go to destination page @1-5B9E825D
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($LovGrid);
    unset($LOV);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-02ADAC59
$LovGrid->Show();
$LOV->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-8CD074D4
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($LovGrid);
unset($LOV);
unset($Tpl);
//End Unload Page


?>
