<?php
//Include Common Files @1-999F3986
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_setllement_ubah_denda.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files



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

//Class_Initialize Event @3-18D3AB9D
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
        $this->DataSource = new clsLOVDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "LOV";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->nilai_denda = & new clsControl(ccsTextBox, "nilai_denda", "nilai_denda", ccsText, "", CCGetRequestParam("nilai_denda", $Method, NULL), $this);
            $this->deskripsi = & new clsControl(ccsTextArea, "deskripsi", "deskripsi", ccsText, "", CCGetRequestParam("deskripsi", $Method, NULL), $this);
            $this->t_vat_setllement_id = & new clsControl(ccsHidden, "t_vat_setllement_id", "t_vat_setllement_id", ccsText, "", CCGetRequestParam("t_vat_setllement_id", $Method, NULL), $this);
            $this->Button1 = & new clsButton("Button1", $Method, $this);
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

//Validate Method @3-DE6B8496
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->nilai_denda->Validate() && $Validation);
        $Validation = ($this->deskripsi->Validate() && $Validation);
        $Validation = ($this->t_vat_setllement_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->nilai_denda->Errors->Count() == 0);
        $Validation =  $Validation && ($this->deskripsi->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_vat_setllement_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-E93DEA9E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->nilai_denda->Errors->Count());
        $errors = ($errors || $this->deskripsi->Errors->Count());
        $errors = ($errors || $this->t_vat_setllement_id->Errors->Count());
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

//Operation Method @3-85DCC2A3
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

        if($this->FormSubmitted) {
            $this->PressedButton = "Button1";
            if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            }
        }
        $Redirect = "t_vat_setllement_ubah_denda.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1) || !$this->InsertRow()) {
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

//InsertRow Method @3-8F34A559
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->t_vat_setllement_id->SetValue($this->t_vat_setllement_id->GetValue(true));
        $this->DataSource->nilai_denda->SetValue($this->nilai_denda->GetValue(true));
        $this->DataSource->deskripsi->SetValue($this->deskripsi->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @3-B164FB7C
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
                    $this->t_vat_setllement_id->SetValue($this->DataSource->t_vat_setllement_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->nilai_denda->Errors->ToString());
            $Error = ComposeStrings($Error, $this->deskripsi->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_vat_setllement_id->Errors->ToString());
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
        $this->Button1->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->nilai_denda->Show();
        $this->deskripsi->Show();
        $this->t_vat_setllement_id->Show();
        $this->Button1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End LOV Class @3-FCB6E20C

class clsLOVDataSource extends clsDBConnSIKP {  //LOVDataSource Class @3-D70026EF

//DataSource Variables @3-A7B767F8
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $nilai_denda;
    var $deskripsi;
    var $t_vat_setllement_id;
//End DataSource Variables
	var $itemResult;
	var $theSQL;
//DataSourceClass_Initialize Event @3-0EE1ACBA
    function clsLOVDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record LOV/Error";
        $this->Initialize();
        $this->nilai_denda = new clsField("nilai_denda", ccsText, "");
        
        $this->deskripsi = new clsField("deskripsi", ccsText, "");
        
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @3-8CF5236C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM t_vat_setllement {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-26E0D758
    function SetValues()
    {
        $this->t_vat_setllement_id->SetDBValue($this->f("t_vat_setllement_id"));
    }
//End SetValues Method

//Insert Method @3-D9B6EF01
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_vat_setllement_id"] = new clsSQLParameter("ctrlt_vat_setllement_id", ccsInteger, "", "", $this->t_vat_setllement_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["nilai_denda"] = new clsSQLParameter("ctrlnilai_denda", ccsFloat, "", "", $this->nilai_denda->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["deskripsi"] = new clsSQLParameter("ctrldeskripsi", ccsText, "", "", $this->deskripsi->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["user_name"] = new clsSQLParameter("sesUserLogin", ccsText, "", "", CCGetSession("UserLogin", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["t_vat_setllement_id"]->GetValue()) and !strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue())) 
            $this->cp["t_vat_setllement_id"]->SetValue($this->t_vat_setllement_id->GetValue(true));
        if (!strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue(true))) 
            $this->cp["t_vat_setllement_id"]->SetText(0);
        if (!is_null($this->cp["nilai_denda"]->GetValue()) and !strlen($this->cp["nilai_denda"]->GetText()) and !is_bool($this->cp["nilai_denda"]->GetValue())) 
            $this->cp["nilai_denda"]->SetValue($this->nilai_denda->GetValue(true));
        if (!strlen($this->cp["nilai_denda"]->GetText()) and !is_bool($this->cp["nilai_denda"]->GetValue(true))) 
            $this->cp["nilai_denda"]->SetText(0);
        if (!is_null($this->cp["deskripsi"]->GetValue()) and !strlen($this->cp["deskripsi"]->GetText()) and !is_bool($this->cp["deskripsi"]->GetValue())) 
            $this->cp["deskripsi"]->SetValue($this->deskripsi->GetValue(true));
        if (!is_null($this->cp["user_name"]->GetValue()) and !strlen($this->cp["user_name"]->GetText()) and !is_bool($this->cp["user_name"]->GetValue())) 
            $this->cp["user_name"]->SetValue(CCGetSession("UserLogin", NULL));
        $this->SQL = "SELECT f_update_penalty(" . $this->SQLValue($this->cp["t_vat_setllement_id"]->GetDBValue(), ccsInteger) . "," . $this->SQLValue($this->cp["nilai_denda"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["deskripsi"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["user_name"]->GetDBValue(), ccsText) . "') AS msg";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->itemResult = $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End LOVDataSource Class @3-FCB6E20C

//Initialize Page @1-5CB552F9
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
$TemplateFileName = "t_vat_setllement_ubah_denda.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-5D5501BC
include_once("./t_vat_setllement_ubah_denda_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-39826719
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$LOV = & new clsRecordLOV("", $MainPage);
$MainPage->LOV = & $LOV;
$LOV->Initialize();

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

//Go to destination page @1-4C2A1E6D
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($LOV);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-1CEBCD98
$LOV->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-3F6169EB
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($LOV);
unset($Tpl);
//End Unload Page


?>
