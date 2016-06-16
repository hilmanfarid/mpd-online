<?php
//Include Common Files @1-4ED2BA75
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_setllement_ubah_ketetapan.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files


//DEL      function Insert()
//DEL      {
//DEL          global $CCSLocales;
//DEL          global $DefaultDateFormat;
//DEL          $this->CmdExecution = true;
//DEL          $this->cp["t_vat_setllement_id"] = new clsSQLParameter("ctrlt_vat_setllement_id", ccsInteger, "", "", $this->t_vat_setllement_id->GetValue(true), 0, false, $this->ErrorBlock);
//DEL          $this->cp["nilai_denda"] = new clsSQLParameter("ctrlnilai_denda", ccsFloat, "", "", $this->nilai_denda->GetValue(true), 0, false, $this->ErrorBlock);
//DEL          $this->cp["deskripsi"] = new clsSQLParameter("ctrldeskripsi", ccsText, "", "", $this->deskripsi->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["user_name"] = new clsSQLParameter("sesUserLogin", ccsText, "", "", CCGetSession("UserLogin", NULL), "", false, $this->ErrorBlock);
//DEL          $this->cp["flag_piutang"] = new clsSQLParameter("ctrlflag_piutang", ccsText, "", "", $this->flag_piutang->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
//DEL          if (!is_null($this->cp["t_vat_setllement_id"]->GetValue()) and !strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue())) 
//DEL              $this->cp["t_vat_setllement_id"]->SetValue($this->t_vat_setllement_id->GetValue(true));
//DEL          if (!strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue(true))) 
//DEL              $this->cp["t_vat_setllement_id"]->SetText(0);
//DEL          if (!is_null($this->cp["nilai_denda"]->GetValue()) and !strlen($this->cp["nilai_denda"]->GetText()) and !is_bool($this->cp["nilai_denda"]->GetValue())) 
//DEL              $this->cp["nilai_denda"]->SetValue($this->nilai_denda->GetValue(true));
//DEL          if (!strlen($this->cp["nilai_denda"]->GetText()) and !is_bool($this->cp["nilai_denda"]->GetValue(true))) 
//DEL              $this->cp["nilai_denda"]->SetText(0);
//DEL          if (!is_null($this->cp["deskripsi"]->GetValue()) and !strlen($this->cp["deskripsi"]->GetText()) and !is_bool($this->cp["deskripsi"]->GetValue())) 
//DEL              $this->cp["deskripsi"]->SetValue($this->deskripsi->GetValue(true));
//DEL          if (!is_null($this->cp["user_name"]->GetValue()) and !strlen($this->cp["user_name"]->GetText()) and !is_bool($this->cp["user_name"]->GetValue())) 
//DEL              $this->cp["user_name"]->SetValue(CCGetSession("UserLogin", NULL));
//DEL          if (!is_null($this->cp["flag_piutang"]->GetValue()) and !strlen($this->cp["flag_piutang"]->GetText()) and !is_bool($this->cp["flag_piutang"]->GetValue())) 
//DEL              $this->cp["flag_piutang"]->SetValue($this->flag_piutang->GetValue(true));
//DEL          $this->SQL = "SELECT f_update_penalty_new(" . $this->SQLValue($this->cp["t_vat_setllement_id"]->GetDBValue(), ccsInteger) . "," . $this->SQLValue($this->cp["flag_piutang"]->GetDBValue(), ccsText) . "," . $this->SQLValue($this->cp["nilai_denda"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["deskripsi"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["user_name"]->GetDBValue(), ccsText) . "') AS msg";
//DEL          $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
//DEL          if($this->Errors->Count() == 0 && $this->CmdExecution) {
//DEL              //$this->query($this->SQL);
//DEL  			$this->itemResult = $this->query($this->SQL);
//DEL              $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
//DEL          }
//DEL      }


class clsRecordt_customer_orderForm { //t_customer_orderForm Class @28-CFAD96CB

//Variables @28-D6FF3E86

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

//Class_Initialize Event @28-FBF50F74
    function clsRecordt_customer_orderForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_customer_orderForm/Error";
        $this->DataSource = new clst_customer_orderFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_customer_orderForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->deskripsi = & new clsControl(ccsTextArea, "deskripsi", "deskripsi", ccsText, "", CCGetRequestParam("deskripsi", $Method, NULL), $this);
            $this->deskripsi->Required = true;
            $this->t_vat_setllement_id = & new clsControl(ccsHidden, "t_vat_setllement_id", "t_vat_setllement_id", ccsText, "", CCGetRequestParam("t_vat_setllement_id", $Method, NULL), $this);
            $this->p_settlement_type_id = & new clsControl(ccsListBox, "p_settlement_type_id", "p_settlement_type_id", ccsText, "", CCGetRequestParam("p_settlement_type_id", $Method, NULL), $this);
            $this->p_settlement_type_id->DSType = dsSQL;
            $this->p_settlement_type_id->DataSource = new clsDBConnSIKP();
            $this->p_settlement_type_id->ds = & $this->p_settlement_type_id->DataSource;
            list($this->p_settlement_type_id->BoundColumn, $this->p_settlement_type_id->TextColumn, $this->p_settlement_type_id->DBFormat) = array("", "", "");
            $this->p_settlement_type_id->DataSource->SQL = "select p_settlement_type_id,code from p_settlement_type";
            $this->p_settlement_type_id->DataSource->Order = "";
            if(!$this->FormSubmitted) {
                if(!is_array($this->p_settlement_type_id->Value) && !strlen($this->p_settlement_type_id->Value) && $this->p_settlement_type_id->Value !== false)
                    $this->p_settlement_type_id->SetText(0);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @28-F2D2DDB3
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_vat_setllement_id"] = CCGetFromGet("t_vat_setllement_id", NULL);
    }
//End Initialize Method

//Validate Method @28-1511308C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->deskripsi->Validate() && $Validation);
        $Validation = ($this->t_vat_setllement_id->Validate() && $Validation);
        $Validation = ($this->p_settlement_type_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->deskripsi->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_vat_setllement_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_settlement_type_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @28-E5D46D0F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->deskripsi->Errors->Count());
        $errors = ($errors || $this->t_vat_setllement_id->Errors->Count());
        $errors = ($errors || $this->p_settlement_type_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @28-ED598703
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

//Operation Method @28-8766F265
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
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

//UpdateRow Method @28-F889876B
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_vat_setllement_id->SetValue($this->t_vat_setllement_id->GetValue(true));
        $this->DataSource->p_settlement_type_id->SetValue($this->p_settlement_type_id->GetValue(true));
        $this->DataSource->deskripsi->SetValue($this->deskripsi->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @28-131AC8D4
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

        $this->p_settlement_type_id->Prepare();

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
                    $this->p_settlement_type_id->SetValue($this->DataSource->p_settlement_type_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->deskripsi->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_vat_setllement_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_settlement_type_id->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->deskripsi->Show();
        $this->t_vat_setllement_id->Show();
        $this->p_settlement_type_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_customer_orderForm Class @28-FCB6E20C

class clst_customer_orderFormDataSource extends clsDBConnSIKP {  //t_customer_orderFormDataSource Class @28-656A3063

//DataSource Variables @28-21C35089
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $deskripsi;
    var $t_vat_setllement_id;
    var $p_settlement_type_id;
//End DataSource Variables
	var $itemResult;
//DataSourceClass_Initialize Event @28-858BC78C
    function clst_customer_orderFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_customer_orderForm/Error";
        $this->Initialize();
        $this->deskripsi = new clsField("deskripsi", ccsText, "");
        
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsText, "");
        
        $this->p_settlement_type_id = new clsField("p_settlement_type_id", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @28-2FF47077
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_setllement_id", ccsFloat, "", "", $this->Parameters["urlt_vat_setllement_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @28-D218034D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n" .
        "FROM t_vat_setllement where t_vat_setllement_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @28-58438281
    function SetValues()
    {
        $this->t_vat_setllement_id->SetDBValue($this->f("t_vat_setllement_id"));
        $this->p_settlement_type_id->SetDBValue($this->f("p_settlement_type_id"));
    }
//End SetValues Method

//Update Method @28-7CBFE6D6
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_vat_setllement_id"] = new clsSQLParameter("ctrlt_vat_setllement_id", ccsFloat, "", "", $this->t_vat_setllement_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_settlement_type_id"] = new clsSQLParameter("ctrlp_settlement_type_id", ccsFloat, "", "", $this->p_settlement_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["deskripsi"] = new clsSQLParameter("ctrldeskripsi", ccsText, "", "", $this->deskripsi->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["user_name"] = new clsSQLParameter("expr102", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_vat_setllement_id"]->GetValue()) and !strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue())) 
            $this->cp["t_vat_setllement_id"]->SetValue($this->t_vat_setllement_id->GetValue(true));
        if (!strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue(true))) 
            $this->cp["t_vat_setllement_id"]->SetText(0);
        if (!is_null($this->cp["p_settlement_type_id"]->GetValue()) and !strlen($this->cp["p_settlement_type_id"]->GetText()) and !is_bool($this->cp["p_settlement_type_id"]->GetValue())) 
            $this->cp["p_settlement_type_id"]->SetValue($this->p_settlement_type_id->GetValue(true));
        if (!strlen($this->cp["p_settlement_type_id"]->GetText()) and !is_bool($this->cp["p_settlement_type_id"]->GetValue(true))) 
            $this->cp["p_settlement_type_id"]->SetText(0);
        if (!is_null($this->cp["deskripsi"]->GetValue()) and !strlen($this->cp["deskripsi"]->GetText()) and !is_bool($this->cp["deskripsi"]->GetValue())) 
            $this->cp["deskripsi"]->SetValue($this->deskripsi->GetValue(true));
        if (!is_null($this->cp["user_name"]->GetValue()) and !strlen($this->cp["user_name"]->GetText()) and !is_bool($this->cp["user_name"]->GetValue())) 
            $this->cp["user_name"]->SetValue(CCGetUserLogin());
        $this->SQL = "SELECT f_update_ketetapan(\n" .
        "" . $this->SQLValue($this->cp["t_vat_setllement_id"]->GetDBValue(), ccsFloat) . ",\n" .
        "" . $this->SQLValue($this->cp["p_settlement_type_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "'" . $this->SQLValue($this->cp["deskripsi"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["user_name"]->GetDBValue(), ccsText) . "') AS msg";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            //$this->query($this->SQL);
			$this->itemResult = $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End t_customer_orderFormDataSource Class @28-FCB6E20C

//Initialize Page @1-A687E7FC
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
$TemplateFileName = "t_vat_setllement_ubah_ketetapan.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-A4E399FB
include_once("./t_vat_setllement_ubah_ketetapan_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9B508FD6
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_customer_orderForm = & new clsRecordt_customer_orderForm("", $MainPage);
$MainPage->t_customer_orderForm = & $t_customer_orderForm;
$t_customer_orderForm->Initialize();

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

//Execute Components @1-D72B9BF8
$t_customer_orderForm->Operation();
//End Execute Components

//Go to destination page @1-D63F1DB9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_customer_orderForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E66AF7C4
$t_customer_orderForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-531AC623
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_customer_orderForm);
unset($Tpl);
//End Unload Page


?>
