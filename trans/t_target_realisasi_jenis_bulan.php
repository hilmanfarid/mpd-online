<?php
//Include Common Files @1-072AC6A0
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_target_realisasi_jenis_bulan.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_target_realisasi_jenis_bulanForm { //t_target_realisasi_jenis_bulanForm Class @726-7303F36A

//Variables @726-D6FF3E86

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

//Class_Initialize Event @726-A399AF55
    function clsRecordt_target_realisasi_jenis_bulanForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_target_realisasi_jenis_bulanForm/Error";
        $this->DataSource = new clst_target_realisasi_jenis_bulanFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_target_realisasi_jenis_bulanForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->p_year_period_id = & new clsControl(ccsHidden, "p_year_period_id", "p_year_period_id", ccsText, "", CCGetRequestParam("p_year_period_id", $Method, NULL), $this);
            $this->t_revenue_target_id = & new clsControl(ccsHidden, "t_revenue_target_id", "t_revenue_target_id", ccsText, "", CCGetRequestParam("t_revenue_target_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @726-843CB29C
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_revenue_target_id"] = CCGetFromGet("t_revenue_target_id", NULL);
    }
//End Initialize Method

//Validate Method @726-36522410
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_year_period_id->Validate() && $Validation);
        $Validation = ($this->t_revenue_target_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_year_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_revenue_target_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @726-FE7DA4E6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_year_period_id->Errors->Count());
        $errors = ($errors || $this->t_revenue_target_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @726-ED598703
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

//Operation Method @726-17DC9883
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

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//Show Method @726-B7633DE2
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
                    $this->p_year_period_id->SetValue($this->DataSource->p_year_period_id->GetValue());
                    $this->t_revenue_target_id->SetValue($this->DataSource->t_revenue_target_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_year_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_revenue_target_id->Errors->ToString());
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

        $this->p_year_period_id->Show();
        $this->t_revenue_target_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_target_realisasi_jenis_bulanForm Class @726-FCB6E20C

class clst_target_realisasi_jenis_bulanFormDataSource extends clsDBConnSIKP {  //t_target_realisasi_jenis_bulanFormDataSource Class @726-820383E0

//DataSource Variables @726-481B584C
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $p_year_period_id;
    var $t_revenue_target_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @726-11BC8790
    function clst_target_realisasi_jenis_bulanFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_target_realisasi_jenis_bulanForm/Error";
        $this->Initialize();
        $this->p_year_period_id = new clsField("p_year_period_id", ccsText, "");
        
        $this->t_revenue_target_id = new clsField("t_revenue_target_id", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @726-00F8EFCD
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_revenue_target_id", ccsFloat, "", array(False, 0, Null, "", False, "", "", 1, True, ""), $this->Parameters["urlt_revenue_target_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @726-B273EC28
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n" .
        "FROM v_revenue_target_vs_realisasi_month\n" .
        "WHERE t_revenue_target_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @726-FC6620A9
    function SetValues()
    {
        $this->p_year_period_id->SetDBValue($this->f("p_year_period_id"));
        $this->t_revenue_target_id->SetDBValue($this->f("t_revenue_target_id"));
    }
//End SetValues Method

} //End t_target_realisasi_jenis_bulanFormDataSource Class @726-FCB6E20C



//Initialize Page @1-51B41586
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
$TemplateFileName = "t_target_realisasi_jenis_bulan.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-2AB1A43D
include_once("./t_target_realisasi_jenis_bulan_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-728E3E3D
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_target_realisasi_jenis_bulanForm = & new clsRecordt_target_realisasi_jenis_bulanForm("", $MainPage);
$MainPage->t_target_realisasi_jenis_bulanForm = & $t_target_realisasi_jenis_bulanForm;
$t_target_realisasi_jenis_bulanForm->Initialize();

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

//Execute Components @1-C306FCA2
$t_target_realisasi_jenis_bulanForm->Operation();
//End Execute Components

//Go to destination page @1-2069D1A9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_target_realisasi_jenis_bulanForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-5F706F8D
$t_target_realisasi_jenis_bulanForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1C98030F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_target_realisasi_jenis_bulanForm);
unset($Tpl);
//End Unload Page


?>
