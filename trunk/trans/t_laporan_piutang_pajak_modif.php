<?php
//Include Common Files @1-6EDF78F4
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_laporan_piutang_pajak_modif.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordformPerubahanMasaPajak { //formPerubahanMasaPajak Class @3-41295F21

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

//Class_Initialize Event @3-375F9865
    function clsRecordformPerubahanMasaPajak($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record formPerubahanMasaPajak/Error";
        $this->DataSource = new clsformPerubahanMasaPajakDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "formPerubahanMasaPajak";
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
            $this->t_piutang_pajak_penetapan_final_id = & new clsControl(ccsHidden, "t_piutang_pajak_penetapan_final_id", "t_piutang_pajak_penetapan_final_id", ccsText, "", CCGetRequestParam("t_piutang_pajak_penetapan_final_id", $Method, NULL), $this);
            $this->keterangan = & new clsControl(ccsTextArea, "keterangan", "keterangan", ccsText, "", CCGetRequestParam("keterangan", $Method, NULL), $this);
            $this->keterangan->Required = true;
            $this->tgl_bayar = & new clsControl(ccsTextBox, "tgl_bayar", "tgl_bayar", ccsText, "", CCGetRequestParam("tgl_bayar", $Method, NULL), $this);
            $this->tgl_bayar->Required = true;
            $this->DatePicker_settlement_date_new1 = & new clsDatePicker("DatePicker_settlement_date_new1", "formPerubahanMasaPajak", "tgl_bayar", $this);
            $this->nilai_piutang = & new clsControl(ccsTextBox, "nilai_piutang", "nilai_piutang", ccsText, "", CCGetRequestParam("nilai_piutang", $Method, NULL), $this);
            $this->sisa_piutang = & new clsControl(ccsTextBox, "sisa_piutang", "sisa_piutang", ccsText, "", CCGetRequestParam("sisa_piutang", $Method, NULL), $this);
            $this->temp_realisasi_piutang = & new clsControl(ccsTextBox, "temp_realisasi_piutang", "temp_realisasi_piutang", ccsText, "", CCGetRequestParam("temp_realisasi_piutang", $Method, NULL), $this);
            $this->masa_pajak = & new clsControl(ccsLabel, "masa_pajak", "masa_pajak", ccsText, "", CCGetRequestParam("masa_pajak", $Method, NULL), $this);
            $this->npwd = & new clsControl(ccsLabel, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", $Method, NULL), $this);
            $this->realisasi_piutang = & new clsControl(ccsTextBox, "realisasi_piutang", "realisasi_piutang", ccsText, "", CCGetRequestParam("realisasi_piutang", $Method, NULL), $this);
            $this->wp_name = & new clsControl(ccsLabel, "wp_name", "wp_name", ccsText, "", CCGetRequestParam("wp_name", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @3-0BF4C4BF
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_piutang_pajak_penetapan_final_id"] = CCGetFromGet("t_piutang_pajak_penetapan_final_id", NULL);
    }
//End Initialize Method

//Validate Method @3-0C4DFBCA
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_piutang_pajak_penetapan_final_id->Validate() && $Validation);
        $Validation = ($this->keterangan->Validate() && $Validation);
        $Validation = ($this->tgl_bayar->Validate() && $Validation);
        $Validation = ($this->nilai_piutang->Validate() && $Validation);
        $Validation = ($this->sisa_piutang->Validate() && $Validation);
        $Validation = ($this->temp_realisasi_piutang->Validate() && $Validation);
        $Validation = ($this->realisasi_piutang->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_piutang_pajak_penetapan_final_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->keterangan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tgl_bayar->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nilai_piutang->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sisa_piutang->Errors->Count() == 0);
        $Validation =  $Validation && ($this->temp_realisasi_piutang->Errors->Count() == 0);
        $Validation =  $Validation && ($this->realisasi_piutang->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-18DA4BB8
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_piutang_pajak_penetapan_final_id->Errors->Count());
        $errors = ($errors || $this->keterangan->Errors->Count());
        $errors = ($errors || $this->tgl_bayar->Errors->Count());
        $errors = ($errors || $this->DatePicker_settlement_date_new1->Errors->Count());
        $errors = ($errors || $this->nilai_piutang->Errors->Count());
        $errors = ($errors || $this->sisa_piutang->Errors->Count());
        $errors = ($errors || $this->temp_realisasi_piutang->Errors->Count());
        $errors = ($errors || $this->masa_pajak->Errors->Count());
        $errors = ($errors || $this->npwd->Errors->Count());
        $errors = ($errors || $this->realisasi_piutang->Errors->Count());
        $errors = ($errors || $this->wp_name->Errors->Count());
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

//Operation Method @3-3DA5191E
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
        $Redirect = "t_laporan_piutang_pajak_modif.php";
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

//UpdateRow Method @3-87AD5E0D
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_piutang_pajak_penetapan_final_id->SetValue($this->t_piutang_pajak_penetapan_final_id->GetValue(true));
        $this->DataSource->realisasi_piutang->SetValue($this->realisasi_piutang->GetValue(true));
        $this->DataSource->sisa_piutang->SetValue($this->sisa_piutang->GetValue(true));
        $this->DataSource->tgl_bayar->SetValue($this->tgl_bayar->GetValue(true));
        $this->DataSource->keterangan->SetValue($this->keterangan->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @3-879B87AF
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
                $this->masa_pajak->SetValue($this->DataSource->masa_pajak->GetValue());
                $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                if(!$this->FormSubmitted){
                    $this->t_piutang_pajak_penetapan_final_id->SetValue($this->DataSource->t_piutang_pajak_penetapan_final_id->GetValue());
                    $this->keterangan->SetValue($this->DataSource->keterangan->GetValue());
                    $this->tgl_bayar->SetValue($this->DataSource->tgl_bayar->GetValue());
                    $this->nilai_piutang->SetValue($this->DataSource->nilai_piutang->GetValue());
                    $this->sisa_piutang->SetValue($this->DataSource->sisa_piutang->GetValue());
                    $this->temp_realisasi_piutang->SetValue($this->DataSource->temp_realisasi_piutang->GetValue());
                    $this->realisasi_piutang->SetValue($this->DataSource->realisasi_piutang->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_piutang_pajak_penetapan_final_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->keterangan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tgl_bayar->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_settlement_date_new1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nilai_piutang->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sisa_piutang->Errors->ToString());
            $Error = ComposeStrings($Error, $this->temp_realisasi_piutang->Errors->ToString());
            $Error = ComposeStrings($Error, $this->masa_pajak->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npwd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->realisasi_piutang->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_name->Errors->ToString());
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
        $this->t_piutang_pajak_penetapan_final_id->Show();
        $this->keterangan->Show();
        $this->tgl_bayar->Show();
        $this->DatePicker_settlement_date_new1->Show();
        $this->nilai_piutang->Show();
        $this->sisa_piutang->Show();
        $this->temp_realisasi_piutang->Show();
        $this->masa_pajak->Show();
        $this->npwd->Show();
        $this->realisasi_piutang->Show();
        $this->wp_name->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End formPerubahanMasaPajak Class @3-FCB6E20C

class clsformPerubahanMasaPajakDataSource extends clsDBConnSIKP {  //formPerubahanMasaPajakDataSource Class @3-5BBED413

//DataSource Variables @3-0DA8957E
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $t_piutang_pajak_penetapan_final_id;
    var $keterangan;
    var $tgl_bayar;
    var $nilai_piutang;
    var $sisa_piutang;
    var $temp_realisasi_piutang;
    var $masa_pajak;
    var $npwd;
    var $realisasi_piutang;
    var $wp_name;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-0072E3A7
    function clsformPerubahanMasaPajakDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record formPerubahanMasaPajak/Error";
        $this->Initialize();
        $this->t_piutang_pajak_penetapan_final_id = new clsField("t_piutang_pajak_penetapan_final_id", ccsText, "");
        
        $this->keterangan = new clsField("keterangan", ccsText, "");
        
        $this->tgl_bayar = new clsField("tgl_bayar", ccsText, "");
        
        $this->nilai_piutang = new clsField("nilai_piutang", ccsText, "");
        
        $this->sisa_piutang = new clsField("sisa_piutang", ccsText, "");
        
        $this->temp_realisasi_piutang = new clsField("temp_realisasi_piutang", ccsText, "");
        
        $this->masa_pajak = new clsField("masa_pajak", ccsText, "");
        
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->realisasi_piutang = new clsField("realisasi_piutang", ccsText, "");
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-CBAA2CC9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_piutang_pajak_penetapan_final_id", ccsText, "", "", $this->Parameters["urlt_piutang_pajak_penetapan_final_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @3-15BD9CD2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select a.*,to_char(a.tgl_tap,'dd-mm-yyyy') as tgl_tap_formated, to_char(a.tgl_bayar,'dd-mm-yyyy') as tgl_bayar_formated , b.wp_name, c.code as periode_bayar\n" .
        "from t_piutang_pajak_penetapan_final as a\n" .
        "LEFT JOIN t_cust_account as b ON a.t_cust_account_id = b.t_cust_account_id\n" .
        "LEFT JOIN p_finance_period as c ON a.p_finance_period_id = c.p_finance_period_id\n" .
        "where a.t_piutang_pajak_penetapan_final_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "\n" .
        "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-379D2050
    function SetValues()
    {
        $this->t_piutang_pajak_penetapan_final_id->SetDBValue($this->f("t_piutang_pajak_penetapan_final_id"));
        $this->keterangan->SetDBValue($this->f("keterangan"));
        $this->tgl_bayar->SetDBValue($this->f("tgl_bayar_formated"));
        $this->nilai_piutang->SetDBValue($this->f("nilai_piutang"));
        $this->sisa_piutang->SetDBValue($this->f("sisa_piutang"));
        $this->temp_realisasi_piutang->SetDBValue($this->f("realisasi_piutang"));
        $this->masa_pajak->SetDBValue($this->f("periode_bayar"));
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->realisasi_piutang->SetDBValue($this->f("realisasi_piutang"));
        $this->wp_name->SetDBValue($this->f("wp_name"));
    }
//End SetValues Method

//Update Method @3-0E96E9CD
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_piutang_pajak_penetapan_final_id"] = new clsSQLParameter("ctrlt_piutang_pajak_penetapan_final_id", ccsInteger, "", "", $this->t_piutang_pajak_penetapan_final_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["realisasi_piutang"] = new clsSQLParameter("ctrlrealisasi_piutang", ccsFloat, "", "", $this->realisasi_piutang->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["sisa_piutang"] = new clsSQLParameter("ctrlsisa_piutang", ccsFloat, "", "", $this->sisa_piutang->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["tgl_bayar"] = new clsSQLParameter("ctrltgl_bayar", ccsText, "", "", $this->tgl_bayar->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["keterangan"] = new clsSQLParameter("ctrlketerangan", ccsText, "", "", $this->keterangan->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_piutang_pajak_penetapan_final_id"]->GetValue()) and !strlen($this->cp["t_piutang_pajak_penetapan_final_id"]->GetText()) and !is_bool($this->cp["t_piutang_pajak_penetapan_final_id"]->GetValue())) 
            $this->cp["t_piutang_pajak_penetapan_final_id"]->SetValue($this->t_piutang_pajak_penetapan_final_id->GetValue(true));
        if (!strlen($this->cp["t_piutang_pajak_penetapan_final_id"]->GetText()) and !is_bool($this->cp["t_piutang_pajak_penetapan_final_id"]->GetValue(true))) 
            $this->cp["t_piutang_pajak_penetapan_final_id"]->SetText(0);
        if (!is_null($this->cp["realisasi_piutang"]->GetValue()) and !strlen($this->cp["realisasi_piutang"]->GetText()) and !is_bool($this->cp["realisasi_piutang"]->GetValue())) 
            $this->cp["realisasi_piutang"]->SetValue($this->realisasi_piutang->GetValue(true));
        if (!strlen($this->cp["realisasi_piutang"]->GetText()) and !is_bool($this->cp["realisasi_piutang"]->GetValue(true))) 
            $this->cp["realisasi_piutang"]->SetText(0);
        if (!is_null($this->cp["sisa_piutang"]->GetValue()) and !strlen($this->cp["sisa_piutang"]->GetText()) and !is_bool($this->cp["sisa_piutang"]->GetValue())) 
            $this->cp["sisa_piutang"]->SetValue($this->sisa_piutang->GetValue(true));
        if (!strlen($this->cp["sisa_piutang"]->GetText()) and !is_bool($this->cp["sisa_piutang"]->GetValue(true))) 
            $this->cp["sisa_piutang"]->SetText(0);
        if (!is_null($this->cp["tgl_bayar"]->GetValue()) and !strlen($this->cp["tgl_bayar"]->GetText()) and !is_bool($this->cp["tgl_bayar"]->GetValue())) 
            $this->cp["tgl_bayar"]->SetValue($this->tgl_bayar->GetValue(true));
        if (!strlen($this->cp["tgl_bayar"]->GetText()) and !is_bool($this->cp["tgl_bayar"]->GetValue(true))) 
            $this->cp["tgl_bayar"]->SetText(NULL);
        if (!is_null($this->cp["keterangan"]->GetValue()) and !strlen($this->cp["keterangan"]->GetText()) and !is_bool($this->cp["keterangan"]->GetValue())) 
            $this->cp["keterangan"]->SetValue($this->keterangan->GetValue(true));
        $this->SQL = "UPDATE t_piutang_pajak_penetapan_final\n" .
        "SET realisasi_piutang = " . $this->SQLValue($this->cp["realisasi_piutang"]->GetDBValue(), ccsFloat) . ",\n" .
        "sisa_piutang = " . $this->SQLValue($this->cp["sisa_piutang"]->GetDBValue(), ccsFloat) . ",\n" .
        "tgl_bayar = '" . $this->SQLValue($this->cp["tgl_bayar"]->GetDBValue(), ccsText) . "',\n" .
        "keterangan = '" . $this->SQLValue($this->cp["keterangan"]->GetDBValue(), ccsText) . "'\n" .
        "WHERE t_piutang_pajak_penetapan_final_id = " . $this->SQLValue($this->cp["t_piutang_pajak_penetapan_final_id"]->GetDBValue(), ccsInteger) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End formPerubahanMasaPajakDataSource Class @3-FCB6E20C

//Initialize Page @1-8DA95613
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
$TemplateFileName = "t_laporan_piutang_pajak_modif.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-FCBDE7C7
include_once("./t_laporan_piutang_pajak_modif_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-CFC51940
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$formPerubahanMasaPajak = & new clsRecordformPerubahanMasaPajak("", $MainPage);
$MainPage->formPerubahanMasaPajak = & $formPerubahanMasaPajak;
$formPerubahanMasaPajak->Initialize();

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

//Execute Components @1-F6E7AE4D
$formPerubahanMasaPajak->Operation();
//End Execute Components

//Go to destination page @1-3655191F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($formPerubahanMasaPajak);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-EEC4AADA
$formPerubahanMasaPajak->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-7A5DFD6A
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($formPerubahanMasaPajak);
unset($Tpl);
//End Unload Page


?>
