<?php
//Include Common Files @1-EE2F3663
define("RelativePath", "..");
define("PathToCurrentPage", "/lov/");
define("FileName", "lov_bphtb_keberatan.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridLOV_REGION { //LOV_REGION class @2-0DD88139

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

//Class_Initialize Event @2-675B2CF8
    function clsGridLOV_REGION($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "LOV_REGION";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid LOV_REGION";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsLOV_REGIONDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->wp_name = & new clsControl(ccsLabel, "wp_name", "wp_name", ccsText, "", CCGetRequestParam("wp_name", ccsGet, NULL), $this);
        $this->registration_no = & new clsControl(ccsLabel, "registration_no", "registration_no", ccsText, "", CCGetRequestParam("registration_no", ccsGet, NULL), $this);
        $this->PILIH = & new clsControl(ccsLabel, "PILIH", "PILIH", ccsText, "", CCGetRequestParam("PILIH", ccsGet, NULL), $this);
        $this->PILIH->HTML = true;
        $this->t_bphtb_registration_id = & new clsControl(ccsTextBox, "t_bphtb_registration_id", "t_bphtb_registration_id", ccsText, "", CCGetRequestParam("t_bphtb_registration_id", ccsGet, NULL), $this);
        $this->t_bphtb_registration_id->Visible = false;
        $this->njop_pbb = & new clsControl(ccsLabel, "njop_pbb", "njop_pbb", ccsText, "", CCGetRequestParam("njop_pbb", ccsGet, NULL), $this);
        $this->bphtb_amt_final = & new clsControl(ccsLabel, "bphtb_amt_final", "bphtb_amt_final", ccsText, "", CCGetRequestParam("bphtb_amt_final", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
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

//Show Method @2-180A38DC
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
            $this->ControlsVisible["wp_name"] = $this->wp_name->Visible;
            $this->ControlsVisible["registration_no"] = $this->registration_no->Visible;
            $this->ControlsVisible["PILIH"] = $this->PILIH->Visible;
            $this->ControlsVisible["t_bphtb_registration_id"] = $this->t_bphtb_registration_id->Visible;
            $this->ControlsVisible["njop_pbb"] = $this->njop_pbb->Visible;
            $this->ControlsVisible["bphtb_amt_final"] = $this->bphtb_amt_final->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                $this->registration_no->SetValue($this->DataSource->registration_no->GetValue());
                $this->t_bphtb_registration_id->SetValue($this->DataSource->t_bphtb_registration_id->GetValue());
                $this->njop_pbb->SetValue($this->DataSource->njop_pbb->GetValue());
                $this->bphtb_amt_final->SetValue($this->DataSource->bphtb_amt_final->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->wp_name->Show();
                $this->registration_no->Show();
                $this->PILIH->Show();
                $this->t_bphtb_registration_id->Show();
                $this->njop_pbb->Show();
                $this->bphtb_amt_final->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-DCC65AEE
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->wp_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->registration_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PILIH->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_bphtb_registration_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->njop_pbb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->bphtb_amt_final->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End LOV_REGION Class @2-FCB6E20C

class clsLOV_REGIONDataSource extends clsDBConnSIKP {  //LOV_REGIONDataSource Class @2-C8BC3AE9

//DataSource Variables @2-10CEB51D
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $wp_name;
    var $registration_no;
    var $t_bphtb_registration_id;
    var $njop_pbb;
    var $bphtb_amt_final;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-0D20340E
    function clsLOV_REGIONDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid LOV_REGION";
        $this->Initialize();
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->registration_no = new clsField("registration_no", ccsText, "");
        
        $this->t_bphtb_registration_id = new clsField("t_bphtb_registration_id", ccsText, "");
        
        $this->njop_pbb = new clsField("njop_pbb", ccsText, "");
        
        $this->bphtb_amt_final = new clsField("bphtb_amt_final", ccsText, "");
        

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

//Prepare Method @2-25AA94A2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
    }
//End Prepare Method

//Open Method @2-5BA91D78
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT b.t_bphtb_registration_id, \n" .
        "b.registration_no, b.wp_name, b.njop_pbb, b.bphtb_amt_final\n" .
        "FROM t_bphtb_registration b\n" .
        "\n" .
        "WHERE (b.registration_no ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' OR\n" .
        "b.njop_pbb ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' OR\n" .
        "b.wp_name ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        ") ) cnt";
        $this->SQL = "SELECT b.t_bphtb_registration_id, \n" .
        "b.registration_no, b.wp_name, b.njop_pbb, b.bphtb_amt_final\n" .
        "FROM t_bphtb_registration b\n" .
        "\n" .
        "WHERE (b.registration_no ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' OR\n" .
        "b.njop_pbb ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' OR\n" .
        "b.wp_name ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        ") ";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-38B6C8DA
    function SetValues()
    {
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->registration_no->SetDBValue($this->f("registration_no"));
        $this->t_bphtb_registration_id->SetDBValue($this->f("t_bphtb_registration_id"));
        $this->njop_pbb->SetDBValue($this->f("njop_pbb"));
        $this->bphtb_amt_final->SetDBValue($this->f("bphtb_amt_final"));
    }
//End SetValues Method

} //End LOV_REGIONDataSource Class @2-FCB6E20C

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

//Class_Initialize Event @3-52BADD76
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
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->FORM = & new clsControl(ccsTextBox, "FORM", "FORM", ccsText, "", CCGetRequestParam("FORM", $Method, NULL), $this);
            $this->OBJ = & new clsControl(ccsTextBox, "OBJ", "OBJ", ccsText, "", CCGetRequestParam("OBJ", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-FA63F6C6
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->FORM->Validate() && $Validation);
        $Validation = ($this->OBJ->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FORM->Errors->Count() == 0);
        $Validation =  $Validation && ($this->OBJ->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-FBB4E0E8
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->FORM->Errors->Count());
        $errors = ($errors || $this->OBJ->Errors->Count());
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

//Operation Method @3-DA6E8D4D
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
        $Redirect = "lov_bphtb_keberatan.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "lov_bphtb_keberatan.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-1DBEB16B
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
        $this->FORM->Show();
        $this->OBJ->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End LOV Class @3-FCB6E20C

//Initialize Page @1-058A4B0A
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
$TemplateFileName = "lov_bphtb_keberatan.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-1D84D144
include_once("./lov_bphtb_keberatan_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-FECF2F75
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$LOV_REGION = & new clsGridLOV_REGION("", $MainPage);
$LOV = & new clsRecordLOV("", $MainPage);
$MainPage->LOV_REGION = & $LOV_REGION;
$MainPage->LOV = & $LOV;
$LOV_REGION->Initialize();

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

//Go to destination page @1-DF92BAF9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($LOV_REGION);
    unset($LOV);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-412788F2
$LOV_REGION->Show();
$LOV->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-8F4FFB94
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($LOV_REGION);
unset($LOV);
unset($Tpl);
//End Unload Page


?>
