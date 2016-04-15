<?php
//Include Common Files @1-A57ED3FD
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_survey_kepuasan_pelanggan_pelaporan_pertanyaan.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_rep_lap_spjpSearch { //t_rep_lap_spjpSearch Class @3-FE45B59C

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

//Class_Initialize Event @3-EBC5EC96
    function clsRecordt_rep_lap_spjpSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_rep_lap_spjpSearch/Error";
        $this->DataSource = new clst_rep_lap_spjpSearchDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_rep_lap_spjpSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->payment_key = & new clsControl(ccsHidden, "payment_key", "payment_key", ccsText, "", CCGetRequestParam("payment_key", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @3-5D060BAC
    function Initialize()
    {

        if(!$this->Visible)
            return;

    }
//End Initialize Method

//Validate Method @3-98CA5F9B
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->payment_key->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->payment_key->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-D82A7D4F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->payment_key->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
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

//Operation Method @3-2D68D435
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = true;
            return;
        }

        $Redirect = "t_survey_kepuasan_pelanggan_pelaporan_pertanyaan.php";
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//Show Method @3-014EE741
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
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->payment_key->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->payment_key->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_rep_lap_spjpSearch Class @3-FCB6E20C

class clst_rep_lap_spjpSearchDataSource extends clsDBConnSIKP {  //t_rep_lap_spjpSearchDataSource Class @3-CB0D4001

//DataSource Variables @3-F1E723AD
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $payment_key;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-7A9E3C8E
    function clst_rep_lap_spjpSearchDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_rep_lap_spjpSearch/Error";
        $this->Initialize();
        $this->payment_key = new clsField("payment_key", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @3-C31DB86F
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select * from p_survey_question \n" .
        "WHERE p_survey_type_id=2 {SQL_OrderBy}";
        $this->Order = "sequence_no";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-BAF0975B
    function SetValues()
    {
    }
//End SetValues Method

} //End t_rep_lap_spjpSearchDataSource Class @3-FCB6E20C

class clsGridt_vat_setllementGrid { //t_vat_setllementGrid class @2-AD714316

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

//Class_Initialize Event @2-C7C6D566
    function clsGridt_vat_setllementGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_setllementGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_setllementGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_setllementGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 25;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->no = & new clsControl(ccsLabel, "no", "no", ccsText, "", CCGetRequestParam("no", ccsGet, NULL), $this);
        $this->survey_question = & new clsControl(ccsLabel, "survey_question", "survey_question", ccsText, "", CCGetRequestParam("survey_question", ccsGet, NULL), $this);
        $this->pilihan_jawaban = & new clsControl(ccsRadioButton, "pilihan_jawaban", "pilihan_jawaban", ccsText, "", CCGetRequestParam("pilihan_jawaban", ccsGet, NULL), $this);
        $this->pilihan_jawaban->DSType = dsSQL;
        $this->pilihan_jawaban->DataSource = new clsDBConnSIKP();
        $this->pilihan_jawaban->ds = & $this->pilihan_jawaban->DataSource;
        list($this->pilihan_jawaban->BoundColumn, $this->pilihan_jawaban->TextColumn, $this->pilihan_jawaban->DBFormat) = array("p_survey_answer_score_id", "score_number", "");
        $this->pilihan_jawaban->DataSource->Parameters["urlp_survey_question_id"] = CCGetFromGet("p_survey_question_id", NULL);
        $this->pilihan_jawaban->DataSource->wp = new clsSQLParameters();
        $this->pilihan_jawaban->DataSource->wp->AddParameter("1", "urlp_survey_question_id", ccsInteger, "", "", $this->pilihan_jawaban->DataSource->Parameters["urlp_survey_question_id"], 0, false);
        $this->pilihan_jawaban->DataSource->SQL = "select p_survey_answer_score_id,score_number from p_survey_answer_score\n" .
        "where p_survey_question_id = 10 {SQL_OrderBy}";
        $this->pilihan_jawaban->DataSource->Order = "score_number desc";
        $this->pilihan_jawaban->HTML = true;
        $this->p_survey_question_id = & new clsControl(ccsHidden, "p_survey_question_id", "p_survey_question_id", ccsText, "", CCGetRequestParam("p_survey_question_id", ccsGet, NULL), $this);
        $this->Button_DoSearch2 = & new clsButton("Button_DoSearch2", ccsGet, $this);
        $this->p_survey_answer_score_id = & new clsControl(ccsHidden, "p_survey_answer_score_id", "p_survey_answer_score_id", ccsText, "", CCGetRequestParam("p_survey_answer_score_id", ccsGet, NULL), $this);
        $this->p_survey_question_id1 = & new clsControl(ccsHidden, "p_survey_question_id1", "p_survey_question_id1", ccsText, "", CCGetRequestParam("p_survey_question_id1", ccsGet, NULL), $this);
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

//Show Method @2-7192C17C
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->pilihan_jawaban->Prepare();

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
            $this->ControlsVisible["no"] = $this->no->Visible;
            $this->ControlsVisible["survey_question"] = $this->survey_question->Visible;
            $this->ControlsVisible["pilihan_jawaban"] = $this->pilihan_jawaban->Visible;
            $this->ControlsVisible["p_survey_question_id"] = $this->p_survey_question_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->no->SetValue($this->DataSource->no->GetValue());
                $this->survey_question->SetValue($this->DataSource->survey_question->GetValue());
                $this->p_survey_question_id->SetValue($this->DataSource->p_survey_question_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->no->Show();
                $this->survey_question->Show();
                $this->pilihan_jawaban->Show();
                $this->p_survey_question_id->Show();
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
        $this->p_survey_question_id1->SetValue($this->DataSource->p_survey_question_id1->GetValue());
        $this->Button_DoSearch2->Show();
        $this->p_survey_answer_score_id->Show();
        $this->p_survey_question_id1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-BC9E16F2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->survey_question->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pilihan_jawaban->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_survey_question_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_setllementGrid Class @2-FCB6E20C

class clst_vat_setllementGridDataSource extends clsDBConnSIKP {  //t_vat_setllementGridDataSource Class @2-F0AECE38

//DataSource Variables @2-9EB1802B
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $no;
    var $survey_question;
    var $p_survey_question_id;
    var $p_survey_question_id1;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-380B8199
    function clst_vat_setllementGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_setllementGrid";
        $this->Initialize();
        $this->no = new clsField("no", ccsText, "");
        
        $this->survey_question = new clsField("survey_question", ccsText, "");
        
        $this->p_survey_question_id = new clsField("p_survey_question_id", ccsText, "");
        
        $this->p_survey_question_id1 = new clsField("p_survey_question_id1", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-84CC671A
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "sequence_no";
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

//Open Method @2-148044B1
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select * from p_survey_question \n" .
        "WHERE p_survey_type_id=2) cnt";
        $this->SQL = "select * from p_survey_question \n" .
        "WHERE p_survey_type_id=2 {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-6198AC9C
    function SetValues()
    {
        $this->no->SetDBValue($this->f("sequence_no"));
        $this->survey_question->SetDBValue($this->f("survey_question"));
        $this->p_survey_question_id->SetDBValue($this->f("p_survey_question_id"));
        $this->p_survey_question_id1->SetDBValue($this->f("p_survey_question_id"));
    }
//End SetValues Method

} //End t_vat_setllementGridDataSource Class @2-FCB6E20C





//Initialize Page @1-4F459624
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
$TemplateFileName = "t_survey_kepuasan_pelanggan_pelaporan_pertanyaan.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-E4C45482
include_once("./t_survey_kepuasan_pelanggan_pelaporan_pertanyaan_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-579861CE
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_rep_lap_spjpSearch = & new clsRecordt_rep_lap_spjpSearch("", $MainPage);
$t_vat_setllementGrid = & new clsGridt_vat_setllementGrid("", $MainPage);
$MainPage->t_rep_lap_spjpSearch = & $t_rep_lap_spjpSearch;
$MainPage->t_vat_setllementGrid = & $t_vat_setllementGrid;
$t_rep_lap_spjpSearch->Initialize();
$t_vat_setllementGrid->Initialize();

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

//Execute Components @1-D6BA083D
$t_rep_lap_spjpSearch->Operation();
//End Execute Components

//Go to destination page @1-A64DE86C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_rep_lap_spjpSearch);
    unset($t_vat_setllementGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-96533153
$t_rep_lap_spjpSearch->Show();
$t_vat_setllementGrid->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-93555772
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_rep_lap_spjpSearch);
unset($t_vat_setllementGrid);
unset($Tpl);
//End Unload Page


?>
