<?php
//Include Common Files @1-DFCB213E
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_setllement_ubah_ayat.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordformPerubahanAyat { //formPerubahanAyat Class @3-12C0C589

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

//Class_Initialize Event @3-F96434EA
    function clsRecordformPerubahanAyat($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record formPerubahanAyat/Error";
        $this->DataSource = new clsformPerubahanAyatDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "formPerubahanAyat";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button1 = & new clsButton("Button1", $Method, $this);
            $this->nomor_ayat = & new clsControl(ccsTextBox, "nomor_ayat", "nomor_ayat", ccsText, "", CCGetRequestParam("nomor_ayat", $Method, NULL), $this);
            $this->nama_ayat = & new clsControl(ccsTextBox, "nama_ayat", "nama_ayat", ccsText, "", CCGetRequestParam("nama_ayat", $Method, NULL), $this);
            $this->t_vat_setllement_id = & new clsControl(ccsHidden, "t_vat_setllement_id", "t_vat_setllement_id", ccsText, "", CCGetRequestParam("t_vat_setllement_id", $Method, NULL), $this);
            $this->nama_jns_pajak = & new clsControl(ccsTextBox, "nama_jns_pajak", "nama_jns_pajak", ccsText, "", CCGetRequestParam("nama_jns_pajak", $Method, NULL), $this);
            $this->vat_code_dtl = & new clsControl(ccsTextBox, "vat_code_dtl", "Tipe Ayat", ccsText, "", CCGetRequestParam("vat_code_dtl", $Method, NULL), $this);
            $this->vat_code_dtl->Required = true;
            $this->p_vat_type_dtl_id = & new clsControl(ccsHidden, "p_vat_type_dtl_id", "p_vat_type_dtl_id", ccsText, "", CCGetRequestParam("p_vat_type_dtl_id", $Method, NULL), $this);
            $this->alasan = & new clsControl(ccsTextArea, "alasan", "alasan", ccsText, "", CCGetRequestParam("alasan", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @3-F2D2DDB3
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_vat_setllement_id"] = CCGetFromGet("t_vat_setllement_id", NULL);
    }
//End Initialize Method

//Validate Method @3-1C0EB4D1
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->nomor_ayat->Validate() && $Validation);
        $Validation = ($this->nama_ayat->Validate() && $Validation);
        $Validation = ($this->t_vat_setllement_id->Validate() && $Validation);
        $Validation = ($this->nama_jns_pajak->Validate() && $Validation);
        $Validation = ($this->vat_code_dtl->Validate() && $Validation);
        $Validation = ($this->p_vat_type_dtl_id->Validate() && $Validation);
        $Validation = ($this->alasan->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->nomor_ayat->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_ayat->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_vat_setllement_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_jns_pajak->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vat_code_dtl->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_dtl_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->alasan->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-C5DE60A1
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->nomor_ayat->Errors->Count());
        $errors = ($errors || $this->nama_ayat->Errors->Count());
        $errors = ($errors || $this->t_vat_setllement_id->Errors->Count());
        $errors = ($errors || $this->nama_jns_pajak->Errors->Count());
        $errors = ($errors || $this->vat_code_dtl->Errors->Count());
        $errors = ($errors || $this->p_vat_type_dtl_id->Errors->Count());
        $errors = ($errors || $this->alasan->Errors->Count());
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

//Operation Method @3-6FDE3180
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
            $this->PressedButton = $this->EditMode ? "Button1" : "";
            if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            }
        }
        $Redirect = "t_vat_setllement_ubah_ayat.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1) || !$this->UpdateRow()) {
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

//UpdateRow Method @3-7AE64B45
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_vat_setllement_id->SetValue($this->t_vat_setllement_id->GetValue(true));
        $this->DataSource->p_vat_type_dtl_id->SetValue($this->p_vat_type_dtl_id->GetValue(true));
        $this->DataSource->alasan->SetValue($this->alasan->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @3-B4F7180D
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
                    $this->nomor_ayat->SetValue($this->DataSource->nomor_ayat->GetValue());
                    $this->nama_ayat->SetValue($this->DataSource->nama_ayat->GetValue());
                    $this->t_vat_setllement_id->SetValue($this->DataSource->t_vat_setllement_id->GetValue());
                    $this->nama_jns_pajak->SetValue($this->DataSource->nama_jns_pajak->GetValue());
                    $this->alasan->SetValue($this->DataSource->alasan->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->nomor_ayat->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_ayat->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_vat_setllement_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_jns_pajak->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vat_code_dtl->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_dtl_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->alasan->Errors->ToString());
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
        $this->Button1->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button1->Show();
        $this->nomor_ayat->Show();
        $this->nama_ayat->Show();
        $this->t_vat_setllement_id->Show();
        $this->nama_jns_pajak->Show();
        $this->vat_code_dtl->Show();
        $this->p_vat_type_dtl_id->Show();
        $this->alasan->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End formPerubahanAyat Class @3-FCB6E20C

class clsformPerubahanAyatDataSource extends clsDBConnSIKP {  //formPerubahanAyatDataSource Class @3-DA5ECD96

//DataSource Variables @3-65ACF45F
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $nomor_ayat;
    var $nama_ayat;
    var $t_vat_setllement_id;
    var $nama_jns_pajak;
    var $vat_code_dtl;
    var $p_vat_type_dtl_id;
    var $alasan;
//End DataSource Variables
	var $itemResult;
//DataSourceClass_Initialize Event @3-4567C4C3
    function clsformPerubahanAyatDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record formPerubahanAyat/Error";
        $this->Initialize();
        $this->nomor_ayat = new clsField("nomor_ayat", ccsText, "");
        
        $this->nama_ayat = new clsField("nama_ayat", ccsText, "");
        
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsText, "");
        
        $this->nama_jns_pajak = new clsField("nama_jns_pajak", ccsText, "");
        
        $this->vat_code_dtl = new clsField("vat_code_dtl", ccsText, "");
        
        $this->p_vat_type_dtl_id = new clsField("p_vat_type_dtl_id", ccsText, "");
        
        $this->alasan = new clsField("alasan", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-1B814BF5
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_setllement_id", ccsText, "", "", $this->Parameters["urlt_vat_setllement_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @3-C12F6925
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT a.*, b.p_vat_type_id, b.nomor_ayat, b.nama_ayat, b.nama_jns_pajak \n" .
        "FROM  t_vat_setllement AS a\n" .
        "LEFT JOIN v_p_vat_type_dtl_rep AS b ON a.p_vat_type_dtl_id = b.p_vat_type_dtl_id\n" .
        "WHERE a.t_vat_setllement_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-C670D095
    function SetValues()
    {
        $this->nomor_ayat->SetDBValue($this->f("nomor_ayat"));
        $this->nama_ayat->SetDBValue($this->f("nama_ayat"));
        $this->t_vat_setllement_id->SetDBValue($this->f("t_vat_setllement_id"));
        $this->nama_jns_pajak->SetDBValue($this->f("nama_jns_pajak"));
        $this->alasan->SetDBValue($this->f("alasan"));
    }
//End SetValues Method

//Update Method @3-C5F78DEC
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_vat_setllement_id"] = new clsSQLParameter("ctrlt_vat_setllement_id", ccsInteger, "", "", $this->t_vat_setllement_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_vat_type_dtl_id"] = new clsSQLParameter("ctrlp_vat_type_dtl_id", ccsInteger, "", "", $this->p_vat_type_dtl_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["user_name"] = new clsSQLParameter("sesUserLogin", ccsText, "", "", CCGetSession("UserLogin", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_vat_setllement_id"]->GetValue()) and !strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue())) 
            $this->cp["t_vat_setllement_id"]->SetValue($this->t_vat_setllement_id->GetValue(true));
        if (!strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue(true))) 
            $this->cp["t_vat_setllement_id"]->SetText(0);
        if (!is_null($this->cp["p_vat_type_dtl_id"]->GetValue()) and !strlen($this->cp["p_vat_type_dtl_id"]->GetText()) and !is_bool($this->cp["p_vat_type_dtl_id"]->GetValue())) 
            $this->cp["p_vat_type_dtl_id"]->SetValue($this->p_vat_type_dtl_id->GetValue(true));
        if (!strlen($this->cp["p_vat_type_dtl_id"]->GetText()) and !is_bool($this->cp["p_vat_type_dtl_id"]->GetValue(true))) 
            $this->cp["p_vat_type_dtl_id"]->SetText(0);
        if (!is_null($this->cp["user_name"]->GetValue()) and !strlen($this->cp["user_name"]->GetText()) and !is_bool($this->cp["user_name"]->GetValue())) 
            $this->cp["user_name"]->SetValue(CCGetSession("UserLogin", NULL));
        $this->SQL = "SELECT f_update_type_ayat(" . $this->SQLValue($this->cp["t_vat_setllement_id"]->GetDBValue(), ccsInteger) . "," . $this->SQLValue($this->cp["p_vat_type_dtl_id"]->GetDBValue(), ccsInteger) . ", '" . $this->SQLValue($this->cp["user_name"]->GetDBValue(), ccsText) . "') AS msg";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->itemResult = $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End formPerubahanAyatDataSource Class @3-FCB6E20C

//Initialize Page @1-9026B1E5
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
$TemplateFileName = "t_vat_setllement_ubah_ayat.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-8AB78B3D
include_once("./t_vat_setllement_ubah_ayat_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D19EE2D1
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$formPerubahanAyat = & new clsRecordformPerubahanAyat("", $MainPage);
$MainPage->formPerubahanAyat = & $formPerubahanAyat;
$formPerubahanAyat->Initialize();

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

//Execute Components @1-B2C6F0B3
$formPerubahanAyat->Operation();
//End Execute Components

//Go to destination page @1-2C20670C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($formPerubahanAyat);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-82D3C16F
$formPerubahanAyat->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-6AF55C34
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($formPerubahanAyat);
unset($Tpl);
//End Unload Page


?>
