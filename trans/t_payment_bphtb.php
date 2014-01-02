<?php
//Include Common Files @1-1F0F8B8F
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_payment_bphtb.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_vat_setllementForm { //t_vat_setllementForm Class @23-D94969C3

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

//Class_Initialize Event @23-5C43F95C
    function clsRecordt_vat_setllementForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_vat_setllementForm/Error";
        $this->DataSource = new clst_vat_setllementFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_vat_setllementForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->no_registrasi = & new clsControl(ccsTextBox, "no_registrasi", "no_registrasi", ccsText, "", CCGetRequestParam("no_registrasi", $Method, NULL), $this);
            $this->TextArea1 = & new clsControl(ccsTextArea, "TextArea1", "TextArea1", ccsText, "", CCGetRequestParam("TextArea1", $Method, NULL), $this);
            $this->LabelBayar = & new clsControl(ccsLabel, "LabelBayar", "LabelBayar", ccsText, "", CCGetRequestParam("LabelBayar", $Method, NULL), $this);
            $this->LabelBayar->HTML = true;
            $this->bit48 = & new clsControl(ccsHidden, "bit48", "bit48", ccsText, "", CCGetRequestParam("bit48", $Method, NULL), $this);
            $this->nilai_pembayaran = & new clsControl(ccsHidden, "nilai_pembayaran", "nilai_pembayaran", ccsInteger, "", CCGetRequestParam("nilai_pembayaran", $Method, NULL), $this);
            $this->Label1 = & new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", $Method, NULL), $this);
            $this->Label1->HTML = true;
            $this->Button1 = & new clsButton("Button1", $Method, $this);
            $this->BtnBayar = & new clsButton("BtnBayar", $Method, $this);
            $this->no_reg = & new clsControl(ccsHidden, "no_reg", "no_reg", ccsText, "", CCGetRequestParam("no_reg", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @23-5D060BAC
    function Initialize()
    {

        if(!$this->Visible)
            return;

    }
//End Initialize Method

//Validate Method @23-4748AAED
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->no_registrasi->Validate() && $Validation);
        $Validation = ($this->TextArea1->Validate() && $Validation);
        $Validation = ($this->bit48->Validate() && $Validation);
        $Validation = ($this->nilai_pembayaran->Validate() && $Validation);
        $Validation = ($this->no_reg->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->no_registrasi->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TextArea1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bit48->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nilai_pembayaran->Errors->Count() == 0);
        $Validation =  $Validation && ($this->no_reg->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-82932905
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->no_registrasi->Errors->Count());
        $errors = ($errors || $this->TextArea1->Errors->Count());
        $errors = ($errors || $this->LabelBayar->Errors->Count());
        $errors = ($errors || $this->bit48->Errors->Count());
        $errors = ($errors || $this->nilai_pembayaran->Errors->Count());
        $errors = ($errors || $this->Label1->Errors->Count());
        $errors = ($errors || $this->no_reg->Errors->Count());
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

//Operation Method @23-B3AC18B2
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
            $this->PressedButton = "BtnBayar";
            if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            } else if($this->BtnBayar->Pressed) {
                $this->PressedButton = "BtnBayar";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "BtnBayar") {
                if(!CCGetEvent($this->BtnBayar->CCSEvents, "OnClick", $this->BtnBayar) || !$this->InsertRow()) {
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

//InsertRow Method @23-3CFA27A3
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->bit48->SetValue($this->bit48->GetValue(true));
        $this->DataSource->no_reg->SetValue($this->no_reg->GetValue(true));
        $this->DataSource->nilai_pembayaran->SetValue($this->nilai_pembayaran->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @23-2EFB1D01
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
                $this->LabelBayar->SetValue($this->DataSource->LabelBayar->GetValue());
                $this->Label1->SetValue($this->DataSource->Label1->GetValue());
                if(!$this->FormSubmitted){
                    $this->bit48->SetValue($this->DataSource->bit48->GetValue());
                    $this->nilai_pembayaran->SetValue($this->DataSource->nilai_pembayaran->GetValue());
                    $this->no_reg->SetValue($this->DataSource->no_reg->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->no_registrasi->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextArea1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LabelBayar->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bit48->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nilai_pembayaran->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Label1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->no_reg->Errors->ToString());
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
        $this->BtnBayar->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->no_registrasi->Show();
        $this->TextArea1->Show();
        $this->LabelBayar->Show();
        $this->bit48->Show();
        $this->nilai_pembayaran->Show();
        $this->Label1->Show();
        $this->Button1->Show();
        $this->BtnBayar->Show();
        $this->no_reg->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_vat_setllementForm Class @23-FCB6E20C

class clst_vat_setllementFormDataSource extends clsDBConnSIKP {  //t_vat_setllementFormDataSource Class @23-AF9958CC

//DataSource Variables @23-A6742E5C
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $no_registrasi;
    var $TextArea1;
    var $LabelBayar;
    var $bit48;
    var $nilai_pembayaran;
    var $Label1;
    var $no_reg;

//End DataSource Variables
	var $result_pembayaran;
//DataSourceClass_Initialize Event @23-9C66E45B
    function clst_vat_setllementFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_vat_setllementForm/Error";
        $this->Initialize();
        $this->no_registrasi = new clsField("no_registrasi", ccsText, "");
        
        $this->TextArea1 = new clsField("TextArea1", ccsText, "");
        
        $this->LabelBayar = new clsField("LabelBayar", ccsText, "");
        
        $this->bit48 = new clsField("bit48", ccsText, "");
        
        $this->nilai_pembayaran = new clsField("nilai_pembayaran", ccsInteger, "");
        
        $this->Label1 = new clsField("Label1", ccsText, "");
        
        $this->no_reg = new clsField("no_reg", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @23-D86A8E8B
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n" .
        "FROM t_bphtb_registration";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-12C4EE09
    function SetValues()
    {
        $this->LabelBayar->SetDBValue($this->f("LabelBayar"));
        $this->bit48->SetDBValue($this->f("bit48"));
        $this->nilai_pembayaran->SetDBValue(trim($this->f("nilai_pembayaran")));
        $this->Label1->SetDBValue($this->f("Label1"));
        $this->no_reg->SetDBValue($this->f("no_reg"));
    }
//End SetValues Method

//Insert Method @23-D5F82FC8
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["bit48"] = new clsSQLParameter("ctrlbit48", ccsText, "", "", $this->bit48->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["no_reg"] = new clsSQLParameter("ctrlno_reg", ccsText, "", "", $this->no_reg->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["nilai_pembayaran"] = new clsSQLParameter("ctrlnilai_pembayaran", ccsText, "", "", $this->nilai_pembayaran->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["bit48"]->GetValue()) and !strlen($this->cp["bit48"]->GetText()) and !is_bool($this->cp["bit48"]->GetValue())) 
            $this->cp["bit48"]->SetValue($this->bit48->GetValue(true));
        if (!is_null($this->cp["no_reg"]->GetValue()) and !strlen($this->cp["no_reg"]->GetText()) and !is_bool($this->cp["no_reg"]->GetValue())) 
            $this->cp["no_reg"]->SetValue($this->no_reg->GetValue(true));
        if (!is_null($this->cp["nilai_pembayaran"]->GetValue()) and !strlen($this->cp["nilai_pembayaran"]->GetText()) and !is_bool($this->cp["nilai_pembayaran"]->GetValue())) 
            $this->cp["nilai_pembayaran"]->SetValue($this->nilai_pembayaran->GetValue(true));
        $this->SQL = "SELECT * FROM f_payment_bphtb('" . $this->SQLValue($this->cp["no_reg"]->GetDBValue(), ccsText) . "'," . $this->SQLValue($this->cp["nilai_pembayaran"]->GetDBValue(), ccsText) . ", '1', '1', '" . $this->SQLValue($this->cp["bit48"]->GetDBValue(), ccsText) . "', null);";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->result_pembayaran = $this->query($this->SQL);
		    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End t_vat_setllementFormDataSource Class @23-FCB6E20C



//Initialize Page @1-927AAF35
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
$TemplateFileName = "t_payment_bphtb.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-37C74A43
include_once("./t_payment_bphtb_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1DDE5A19
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_vat_setllementForm = & new clsRecordt_vat_setllementForm("", $MainPage);
$MainPage->t_vat_setllementForm = & $t_vat_setllementForm;
$t_vat_setllementForm->Initialize();

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

//Execute Components @1-066D187A
$t_vat_setllementForm->Operation();
//End Execute Components

//Go to destination page @1-41353ACE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_vat_setllementForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-5746EF7A
$t_vat_setllementForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-825C45A1
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_vat_setllementForm);
unset($Tpl);
//End Unload Page


?>
