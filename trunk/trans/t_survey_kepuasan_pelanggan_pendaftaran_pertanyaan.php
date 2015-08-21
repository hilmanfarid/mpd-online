<?php
//Include Common Files @1-FAC0DEDF
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_survey_kepuasan_pelanggan_pendaftaran_pertanyaan.php");
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

//Class_Initialize Event @3-698E7924
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
            $this->Button_DoSearch2 = & new clsButton("Button_DoSearch2", $Method, $this);
            $this->no = & new clsControl(ccsLabel, "no", "no", ccsText, "", CCGetRequestParam("no", $Method, NULL), $this);
            $this->survey_question = & new clsControl(ccsLabel, "survey_question", "survey_question", ccsText, "", CCGetRequestParam("survey_question", $Method, NULL), $this);
            $this->p_survey_question_id = & new clsControl(ccsHidden, "p_survey_question_id", "p_survey_question_id", ccsText, "", CCGetRequestParam("p_survey_question_id", $Method, NULL), $this);
            $this->pilihan_jawaban = & new clsControl(ccsRadioButton, "pilihan_jawaban", "pilihan_jawaban", ccsText, "", CCGetRequestParam("pilihan_jawaban", $Method, NULL), $this);
            $this->pilihan_jawaban->DSType = dsSQL;
            $this->pilihan_jawaban->DataSource = new clsDBConnSIKP();
            $this->pilihan_jawaban->ds = & $this->pilihan_jawaban->DataSource;
            list($this->pilihan_jawaban->BoundColumn, $this->pilihan_jawaban->TextColumn, $this->pilihan_jawaban->DBFormat) = array("p_survey_answer_score_id", "score_number", "");
            $this->pilihan_jawaban->DataSource->Parameters["urlp_survey_question_id"] = CCGetFromGet("p_survey_question_id", NULL);
            $this->pilihan_jawaban->DataSource->wp = new clsSQLParameters();
            $this->pilihan_jawaban->DataSource->wp->AddParameter("1", "urlp_survey_question_id", ccsInteger, "", "", $this->pilihan_jawaban->DataSource->Parameters["urlp_survey_question_id"], 0, false);
            $this->pilihan_jawaban->DataSource->SQL = "select p_survey_answer_score_id,score_number from p_survey_answer_score\n" .
            "where p_survey_question_id = 1{SQL_OrderBy}";
            $this->pilihan_jawaban->DataSource->Order = "score_number desc";
            $this->pilihan_jawaban->HTML = true;
            $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsInteger, "", CCGetRequestParam("t_vat_registration_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @3-0BB6B289
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_survey_question_id"] = CCGetFromGet("p_survey_question_id", NULL);
    }
//End Initialize Method

//Validate Method @3-59BB7FAD
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_survey_question_id->Validate() && $Validation);
        $Validation = ($this->pilihan_jawaban->Validate() && $Validation);
        $Validation = ($this->t_vat_registration_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_survey_question_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pilihan_jawaban->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_vat_registration_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-FAB7D584
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->no->Errors->Count());
        $errors = ($errors || $this->survey_question->Errors->Count());
        $errors = ($errors || $this->p_survey_question_id->Errors->Count());
        $errors = ($errors || $this->pilihan_jawaban->Errors->Count());
        $errors = ($errors || $this->t_vat_registration_id->Errors->Count());
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

//Operation Method @3-FAB38ECD
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
            $this->PressedButton = "Button_DoSearch2";
            if($this->Button_DoSearch2->Pressed) {
                $this->PressedButton = "Button_DoSearch2";
            }
        }
        $Redirect = "t_survey_kepuasan_pelanggan_pendaftaran_pertanyaan.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch2") {
                if(!CCGetEvent($this->Button_DoSearch2->CCSEvents, "OnClick", $this->Button_DoSearch2)) {
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

//Show Method @3-8061EC34
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

        $this->pilihan_jawaban->Prepare();

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
                $this->no->SetValue($this->DataSource->no->GetValue());
                $this->survey_question->SetValue($this->DataSource->survey_question->GetValue());
                if(!$this->FormSubmitted){
                    $this->p_survey_question_id->SetValue($this->DataSource->p_survey_question_id->GetValue());
                    $this->t_vat_registration_id->SetValue($this->DataSource->t_vat_registration_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->survey_question->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_survey_question_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pilihan_jawaban->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_vat_registration_id->Errors->ToString());
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

        $this->Button_DoSearch2->Show();
        $this->no->Show();
        $this->survey_question->Show();
        $this->p_survey_question_id->Show();
        $this->pilihan_jawaban->Show();
        $this->t_vat_registration_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_rep_lap_spjpSearch Class @3-FCB6E20C

class clst_rep_lap_spjpSearchDataSource extends clsDBConnSIKP {  //t_rep_lap_spjpSearchDataSource Class @3-CB0D4001

//DataSource Variables @3-F502E205
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $no;
    var $survey_question;
    var $p_survey_question_id;
    var $pilihan_jawaban;
    var $t_vat_registration_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-43476719
    function clst_rep_lap_spjpSearchDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_rep_lap_spjpSearch/Error";
        $this->Initialize();
        $this->no = new clsField("no", ccsText, "");
        
        $this->survey_question = new clsField("survey_question", ccsText, "");
        
        $this->p_survey_question_id = new clsField("p_survey_question_id", ccsText, "");
        
        $this->pilihan_jawaban = new clsField("pilihan_jawaban", ccsText, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-848FDF42
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_survey_question_id", ccsInteger, "", "", $this->Parameters["urlp_survey_question_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @3-FD8CE328
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select * from p_survey_question \n" .
        "WHERE p_survey_question_id=" . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-67056F8F
    function SetValues()
    {
        $this->no->SetDBValue($this->f("sequence_no"));
        $this->survey_question->SetDBValue($this->f("survey_question"));
        $this->p_survey_question_id->SetDBValue($this->f("p_survey_question_id"));
        $this->t_vat_registration_id->SetDBValue(trim($this->f("t_vat_registration_id")));
    }
//End SetValues Method

} //End t_rep_lap_spjpSearchDataSource Class @3-FCB6E20C

//Initialize Page @1-C8E43FC3
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
$TemplateFileName = "t_survey_kepuasan_pelanggan_pendaftaran_pertanyaan.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-CBFEA69B
include_once("./t_survey_kepuasan_pelanggan_pendaftaran_pertanyaan_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-2790EC02
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_rep_lap_spjpSearch = & new clsRecordt_rep_lap_spjpSearch("", $MainPage);
$Label1 = & new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $MainPage);
$Label1->HTML = true;
$MainPage->t_rep_lap_spjpSearch = & $t_rep_lap_spjpSearch;
$MainPage->Label1 = & $Label1;
$t_rep_lap_spjpSearch->Initialize();

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

//Go to destination page @1-05822388
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_rep_lap_spjpSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D028F073
$t_rep_lap_spjpSearch->Show();
$Label1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-528B55E6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_rep_lap_spjpSearch);
unset($Tpl);
//End Unload Page


?>
