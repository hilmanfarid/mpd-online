<?php
//Include Common Files @1-FE3EB335
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_executive_summary_report.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_executive_sumary_filter { //t_executive_sumary_filter Class @2-2AFC228B

//Variables @2-D6FF3E86

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

//Class_Initialize Event @2-62596D0C
    function clsRecordt_executive_sumary_filter($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_executive_sumary_filter/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_executive_sumary_filter";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->year_code = & new clsControl(ccsTextBox, "year_code", "Periode Tahun", ccsText, "", CCGetRequestParam("year_code", $Method, NULL), $this);
            $this->year_code->Required = true;
            $this->p_year_period_id = & new clsControl(ccsHidden, "p_year_period_id", "p_year_period_id", ccsFloat, "", CCGetRequestParam("p_year_period_id", $Method, NULL), $this);
            $this->vat_code = & new clsControl(ccsTextBox, "vat_code", "Ayat Pajak", ccsText, "", CCGetRequestParam("vat_code", $Method, NULL), $this);
            $this->vat_code->Required = true;
            $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", $Method, NULL), $this);
            $this->vat_code_dtl = & new clsControl(ccsTextBox, "vat_code_dtl", "Ayat Pajak", ccsText, "", CCGetRequestParam("vat_code_dtl", $Method, NULL), $this);
            $this->vat_code_dtl->Required = true;
            $this->p_vat_type_dtl_id = & new clsControl(ccsHidden, "p_vat_type_dtl_id", "p_vat_type_dtl_id", ccsText, "", CCGetRequestParam("p_vat_type_dtl_id", $Method, NULL), $this);
            $this->Button2 = & new clsButton("Button2", $Method, $this);
            $this->periode_code = & new clsControl(ccsTextBox, "periode_code", "Bulan", ccsText, "", CCGetRequestParam("periode_code", $Method, NULL), $this);
            $this->periode_code->Required = true;
            $this->p_finance_period_id = & new clsControl(ccsHidden, "p_finance_period_id", "p_finance_period_id", ccsText, "", CCGetRequestParam("p_finance_period_id", $Method, NULL), $this);
            $this->ListBox1 = & new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", $Method, NULL), $this);
            $this->ListBox1->DSType = dsListOfValues;
            $this->ListBox1->Values = array(array("1", "Per Bulan"), array("2", "Per Triwulan"), array("3", "Per Semester"));
            $this->ListBox2 = & new clsControl(ccsListBox, "ListBox2", "ListBox2", ccsText, "", CCGetRequestParam("ListBox2", $Method, NULL), $this);
            $this->ListBox2->DSType = dsListOfValues;
            $this->ListBox2->Values = array(array("1", "I"), array("2", "II"), array("3", "III"), array("4", "IV"));
            $this->ListBox3 = & new clsControl(ccsListBox, "ListBox3", "ListBox3", ccsText, "", CCGetRequestParam("ListBox3", $Method, NULL), $this);
            $this->ListBox3->DSType = dsListOfValues;
            $this->ListBox3->Values = array(array("1", "I"), array("2", "II"));
        }
    }
//End Class_Initialize Event

//Validate Method @2-2A79F534
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->year_code->Validate() && $Validation);
        $Validation = ($this->p_year_period_id->Validate() && $Validation);
        $Validation = ($this->vat_code->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id->Validate() && $Validation);
        $Validation = ($this->vat_code_dtl->Validate() && $Validation);
        $Validation = ($this->p_vat_type_dtl_id->Validate() && $Validation);
        $Validation = ($this->periode_code->Validate() && $Validation);
        $Validation = ($this->p_finance_period_id->Validate() && $Validation);
        $Validation = ($this->ListBox1->Validate() && $Validation);
        $Validation = ($this->ListBox2->Validate() && $Validation);
        $Validation = ($this->ListBox3->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->year_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_year_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vat_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vat_code_dtl->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_dtl_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->periode_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_finance_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox3->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-4A2FAF74
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->year_code->Errors->Count());
        $errors = ($errors || $this->p_year_period_id->Errors->Count());
        $errors = ($errors || $this->vat_code->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
        $errors = ($errors || $this->vat_code_dtl->Errors->Count());
        $errors = ($errors || $this->p_vat_type_dtl_id->Errors->Count());
        $errors = ($errors || $this->periode_code->Errors->Count());
        $errors = ($errors || $this->p_finance_period_id->Errors->Count());
        $errors = ($errors || $this->ListBox1->Errors->Count());
        $errors = ($errors || $this->ListBox2->Errors->Count());
        $errors = ($errors || $this->ListBox3->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @2-ED598703
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

//Operation Method @2-304F0DF3
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
            $this->PressedButton = "Button2";
            if($this->Button2->Pressed) {
                $this->PressedButton = "Button2";
            }
        }
        $Redirect = "t_executive_summary_report.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button2") {
                if(!CCGetEvent($this->Button2->CCSEvents, "OnClick", $this->Button2)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-5F48AD2A
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

        $this->ListBox1->Prepare();
        $this->ListBox2->Prepare();
        $this->ListBox3->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->year_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_year_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vat_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vat_code_dtl->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_dtl_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->periode_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_finance_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox3->Errors->ToString());
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

        $this->year_code->Show();
        $this->p_year_period_id->Show();
        $this->vat_code->Show();
        $this->p_vat_type_id->Show();
        $this->vat_code_dtl->Show();
        $this->p_vat_type_dtl_id->Show();
        $this->Button2->Show();
        $this->periode_code->Show();
        $this->p_finance_period_id->Show();
        $this->ListBox1->Show();
        $this->ListBox2->Show();
        $this->ListBox3->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_executive_sumary_filter Class @2-FCB6E20C

class clsRecordt_executive_summary_form { //t_executive_summary_form Class @25-E40DC128

//Variables @25-D6FF3E86

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

//Class_Initialize Event @25-37D027A5
    function clsRecordt_executive_summary_form($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_executive_summary_form/Error";
        $this->DataSource = new clst_executive_summary_formDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_executive_summary_form";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->penjelasan = & new clsControl(ccsTextArea, "penjelasan", "No Faktur", ccsText, "", CCGetRequestParam("penjelasan", $Method, NULL), $this);
            $this->penjelasan->Required = true;
            $this->permasalahan = & new clsControl(ccsTextArea, "permasalahan", "Nilai Transaksi", ccsText, "", CCGetRequestParam("permasalahan", $Method, NULL), $this);
            $this->permasalahan->Required = true;
            $this->kesimpulan = & new clsControl(ccsTextArea, "kesimpulan", "Nilai Transaksi", ccsText, "", CCGetRequestParam("kesimpulan", $Method, NULL), $this);
            $this->kesimpulan->Required = true;
            $this->saran = & new clsControl(ccsTextArea, "saran", "Nilai Transaksi", ccsText, "", CCGetRequestParam("saran", $Method, NULL), $this);
            $this->saran->Required = true;
            $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", $Method, NULL), $this);
            $this->p_year_period_id = & new clsControl(ccsHidden, "p_year_period_id", "p_year_period_id", ccsFloat, "", CCGetRequestParam("p_year_period_id", $Method, NULL), $this);
            $this->p_finance_period_id = & new clsControl(ccsHidden, "p_finance_period_id", "p_finance_period_id", ccsText, "", CCGetRequestParam("p_finance_period_id", $Method, NULL), $this);
            $this->period_type = & new clsControl(ccsHidden, "period_type", "period_type", ccsText, "", CCGetRequestParam("period_type", $Method, NULL), $this);
            $this->triwulan = & new clsControl(ccsHidden, "triwulan", "triwulan", ccsText, "", CCGetRequestParam("triwulan", $Method, NULL), $this);
            $this->semester = & new clsControl(ccsHidden, "semester", "semester", ccsText, "", CCGetRequestParam("semester", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @25-B53CC0E2
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_cust_acc_dtl_trans_id"] = CCGetFromGet("t_cust_acc_dtl_trans_id", NULL);
    }
//End Initialize Method

//Validate Method @25-E5A65B89
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->penjelasan->Validate() && $Validation);
        $Validation = ($this->permasalahan->Validate() && $Validation);
        $Validation = ($this->kesimpulan->Validate() && $Validation);
        $Validation = ($this->saran->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id->Validate() && $Validation);
        $Validation = ($this->p_year_period_id->Validate() && $Validation);
        $Validation = ($this->p_finance_period_id->Validate() && $Validation);
        $Validation = ($this->period_type->Validate() && $Validation);
        $Validation = ($this->triwulan->Validate() && $Validation);
        $Validation = ($this->semester->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->penjelasan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->permasalahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kesimpulan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->saran->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_year_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_finance_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->period_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->triwulan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->semester->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @25-44AC291B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->penjelasan->Errors->Count());
        $errors = ($errors || $this->permasalahan->Errors->Count());
        $errors = ($errors || $this->kesimpulan->Errors->Count());
        $errors = ($errors || $this->saran->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
        $errors = ($errors || $this->p_year_period_id->Errors->Count());
        $errors = ($errors || $this->p_finance_period_id->Errors->Count());
        $errors = ($errors || $this->period_type->Errors->Count());
        $errors = ($errors || $this->triwulan->Errors->Count());
        $errors = ($errors || $this->semester->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @25-ED598703
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

//Operation Method @25-EDDE14EE
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
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
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

//InsertRow Method @25-72741E64
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->penjelasan->SetValue($this->penjelasan->GetValue(true));
        $this->DataSource->permasalahan->SetValue($this->permasalahan->GetValue(true));
        $this->DataSource->kesimpulan->SetValue($this->kesimpulan->GetValue(true));
        $this->DataSource->saran->SetValue($this->saran->GetValue(true));
        $this->DataSource->p_vat_type_id->SetValue($this->p_vat_type_id->GetValue(true));
        $this->DataSource->p_finance_period_id->SetValue($this->p_finance_period_id->GetValue(true));
        $this->DataSource->period_type->SetValue($this->period_type->GetValue(true));
        $this->DataSource->triwulan->SetValue($this->triwulan->GetValue(true));
        $this->DataSource->semester->SetValue($this->semester->GetValue(true));
        $this->DataSource->p_year_period_id->SetValue($this->p_year_period_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @25-202DDCB7
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
                    $this->penjelasan->SetValue($this->DataSource->penjelasan->GetValue());
                    $this->permasalahan->SetValue($this->DataSource->permasalahan->GetValue());
                    $this->kesimpulan->SetValue($this->DataSource->kesimpulan->GetValue());
                    $this->saran->SetValue($this->DataSource->saran->GetValue());
                    $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                    $this->p_year_period_id->SetValue($this->DataSource->p_year_period_id->GetValue());
                    $this->p_finance_period_id->SetValue($this->DataSource->p_finance_period_id->GetValue());
                    $this->period_type->SetValue($this->DataSource->period_type->GetValue());
                    $this->triwulan->SetValue($this->DataSource->triwulan->GetValue());
                    $this->semester->SetValue($this->DataSource->semester->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->penjelasan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->permasalahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kesimpulan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->saran->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_year_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_finance_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->period_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->triwulan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->semester->Errors->ToString());
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->penjelasan->Show();
        $this->permasalahan->Show();
        $this->kesimpulan->Show();
        $this->saran->Show();
        $this->p_vat_type_id->Show();
        $this->p_year_period_id->Show();
        $this->p_finance_period_id->Show();
        $this->period_type->Show();
        $this->triwulan->Show();
        $this->semester->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_executive_summary_form Class @25-FCB6E20C

class clst_executive_summary_formDataSource extends clsDBConnSIKP {  //t_executive_summary_formDataSource Class @25-9A7F4B9F

//DataSource Variables @25-639395F1
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $penjelasan;
    var $permasalahan;
    var $kesimpulan;
    var $saran;
    var $p_vat_type_id;
    var $p_year_period_id;
    var $p_finance_period_id;
    var $period_type;
    var $triwulan;
    var $semester;
//End DataSource Variables

//DataSourceClass_Initialize Event @25-0DAFA240
    function clst_executive_summary_formDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_executive_summary_form/Error";
        $this->Initialize();
        $this->penjelasan = new clsField("penjelasan", ccsText, "");
        
        $this->permasalahan = new clsField("permasalahan", ccsText, "");
        
        $this->kesimpulan = new clsField("kesimpulan", ccsText, "");
        
        $this->saran = new clsField("saran", ccsText, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsText, "");
        
        $this->p_year_period_id = new clsField("p_year_period_id", ccsFloat, "");
        
        $this->p_finance_period_id = new clsField("p_finance_period_id", ccsText, "");
        
        $this->period_type = new clsField("period_type", ccsText, "");
        
        $this->triwulan = new clsField("triwulan", ccsText, "");
        
        $this->semester = new clsField("semester", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @25-3072739C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_acc_dtl_trans_id", ccsFloat, "", "", $this->Parameters["urlt_cust_acc_dtl_trans_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @25-D0C757A4
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT t_cust_acc_dtl_trans_id, t_cust_account_id, to_char(trans_date,'YYYY-MM-DD')as trans_date, bill_no, p_entertaintment_type_id, p_hotel_grade_id, p_room_type_id,\n" .
        "p_parking_classification_id, updated_by, to_char(updated_date,'DD-MON-YYYY')as updated_date, created_by, to_char(creation_date,'DD-MON-YYYY')as creation_date, description, portion_person, f_and_b,\n" .
        "booking_hour, clerk_qty, room_qty, seat_qty, vat_charge, service_charge, service_desc, p_rest_service_type_id, power_capacity,\n" .
        "p_pwr_classification_id \n" .
        "FROM t_cust_acc_dtl_trans\n" .
        "WHERE t_cust_acc_dtl_trans_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @25-9F9FB9F8
    function SetValues()
    {
        $this->penjelasan->SetDBValue($this->f("penjelasan"));
        $this->permasalahan->SetDBValue($this->f("permasalahan"));
        $this->kesimpulan->SetDBValue($this->f("kesimpulan"));
        $this->saran->SetDBValue($this->f("saran"));
        $this->p_vat_type_id->SetDBValue($this->f("p_vat_type_id"));
        $this->p_year_period_id->SetDBValue(trim($this->f("p_year_period_id")));
        $this->p_finance_period_id->SetDBValue($this->f("p_finance_period_id"));
        $this->period_type->SetDBValue($this->f("period_type"));
        $this->triwulan->SetDBValue($this->f("triwulan"));
        $this->semester->SetDBValue($this->f("semester"));
    }
//End SetValues Method

//Insert Method @25-AD41EF6A
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["penjelasan"] = new clsSQLParameter("ctrlpenjelasan", ccsText, "", "", $this->penjelasan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["permasalahan"] = new clsSQLParameter("ctrlpermasalahan", ccsText, "", "", $this->permasalahan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["kesimpulan"] = new clsSQLParameter("ctrlkesimpulan", ccsText, "", "", $this->kesimpulan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["saran"] = new clsSQLParameter("ctrlsaran", ccsText, "", "", $this->saran->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_vat_type_id"] = new clsSQLParameter("ctrlp_vat_type_id", ccsText, "", "", $this->p_vat_type_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_finance_period_id"] = new clsSQLParameter("ctrlp_finance_period_id", ccsFloat, "", "", $this->p_finance_period_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["period_type"] = new clsSQLParameter("ctrlperiod_type", ccsText, "", "", $this->period_type->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["triwulan"] = new clsSQLParameter("ctrltriwulan", ccsFloat, "", "", $this->triwulan->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["semester"] = new clsSQLParameter("ctrlsemester", ccsFloat, "", "", $this->semester->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_year_period_id"] = new clsSQLParameter("ctrlp_year_period_id", ccsFloat, "", "", $this->p_year_period_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["user_id"] = new clsSQLParameter("sesUserLogin", ccsText, "", "", CCGetSession("UserLogin", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["penjelasan"]->GetValue()) and !strlen($this->cp["penjelasan"]->GetText()) and !is_bool($this->cp["penjelasan"]->GetValue())) 
            $this->cp["penjelasan"]->SetValue($this->penjelasan->GetValue(true));
        if (!is_null($this->cp["permasalahan"]->GetValue()) and !strlen($this->cp["permasalahan"]->GetText()) and !is_bool($this->cp["permasalahan"]->GetValue())) 
            $this->cp["permasalahan"]->SetValue($this->permasalahan->GetValue(true));
        if (!is_null($this->cp["kesimpulan"]->GetValue()) and !strlen($this->cp["kesimpulan"]->GetText()) and !is_bool($this->cp["kesimpulan"]->GetValue())) 
            $this->cp["kesimpulan"]->SetValue($this->kesimpulan->GetValue(true));
        if (!is_null($this->cp["saran"]->GetValue()) and !strlen($this->cp["saran"]->GetText()) and !is_bool($this->cp["saran"]->GetValue())) 
            $this->cp["saran"]->SetValue($this->saran->GetValue(true));
        if (!is_null($this->cp["p_vat_type_id"]->GetValue()) and !strlen($this->cp["p_vat_type_id"]->GetText()) and !is_bool($this->cp["p_vat_type_id"]->GetValue())) 
            $this->cp["p_vat_type_id"]->SetValue($this->p_vat_type_id->GetValue(true));
        if (!is_null($this->cp["p_finance_period_id"]->GetValue()) and !strlen($this->cp["p_finance_period_id"]->GetText()) and !is_bool($this->cp["p_finance_period_id"]->GetValue())) 
            $this->cp["p_finance_period_id"]->SetValue($this->p_finance_period_id->GetValue(true));
        if (!strlen($this->cp["p_finance_period_id"]->GetText()) and !is_bool($this->cp["p_finance_period_id"]->GetValue(true))) 
            $this->cp["p_finance_period_id"]->SetText(0);
        if (!is_null($this->cp["period_type"]->GetValue()) and !strlen($this->cp["period_type"]->GetText()) and !is_bool($this->cp["period_type"]->GetValue())) 
            $this->cp["period_type"]->SetValue($this->period_type->GetValue(true));
        if (!is_null($this->cp["triwulan"]->GetValue()) and !strlen($this->cp["triwulan"]->GetText()) and !is_bool($this->cp["triwulan"]->GetValue())) 
            $this->cp["triwulan"]->SetValue($this->triwulan->GetValue(true));
        if (!strlen($this->cp["triwulan"]->GetText()) and !is_bool($this->cp["triwulan"]->GetValue(true))) 
            $this->cp["triwulan"]->SetText(0);
        if (!is_null($this->cp["semester"]->GetValue()) and !strlen($this->cp["semester"]->GetText()) and !is_bool($this->cp["semester"]->GetValue())) 
            $this->cp["semester"]->SetValue($this->semester->GetValue(true));
        if (!strlen($this->cp["semester"]->GetText()) and !is_bool($this->cp["semester"]->GetValue(true))) 
            $this->cp["semester"]->SetText(0);
        if (!is_null($this->cp["p_year_period_id"]->GetValue()) and !strlen($this->cp["p_year_period_id"]->GetText()) and !is_bool($this->cp["p_year_period_id"]->GetValue())) 
            $this->cp["p_year_period_id"]->SetValue($this->p_year_period_id->GetValue(true));
        if (!is_null($this->cp["user_id"]->GetValue()) and !strlen($this->cp["user_id"]->GetText()) and !is_bool($this->cp["user_id"]->GetValue())) 
            $this->cp["user_id"]->SetValue(CCGetSession("UserLogin", NULL));
        $this->SQL = "SELECT\n" .
        "	*\n" .
        "FROM\n" .
        "	f_insert_executive_summary (\n" .
        "		16,\n" .
        "		'" . $this->SQLValue($this->cp["user_id"]->GetDBValue(), ccsText) . "' ," . $this->SQLValue($this->cp["p_year_period_id"]->GetDBValue(), ccsFloat) . "," . $this->SQLValue($this->cp["p_vat_type_id"]->GetDBValue(), ccsText) . ", " . $this->SQLValue($this->cp["period_type"]->GetDBValue(), ccsText) . ", " . $this->SQLValue($this->cp["p_finance_period_id"]->GetDBValue(), ccsFloat) . "," . $this->SQLValue($this->cp["triwulan"]->GetDBValue(), ccsFloat) . "," . $this->SQLValue($this->cp["semester"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["penjelasan"]->GetDBValue(), ccsText) . "',\n" .
        "		'" . $this->SQLValue($this->cp["permasalahan"]->GetDBValue(), ccsText) . "',\n" .
        "		'" . $this->SQLValue($this->cp["kesimpulan"]->GetDBValue(), ccsText) . "',\n" .
        "		'" . $this->SQLValue($this->cp["saran"]->GetDBValue(), ccsText) . "'\n" .
        "	)";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
			$this->query($this->SQL);			
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End t_executive_summary_formDataSource Class @25-FCB6E20C



//Initialize Page @1-6CE69DA5
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
$TemplateFileName = "t_executive_summary_report.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C4B5EC18
include_once("./t_executive_summary_report_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-58AC8248
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_executive_sumary_filter = & new clsRecordt_executive_sumary_filter("", $MainPage);
$t_executive_summary_form = & new clsRecordt_executive_summary_form("", $MainPage);
$MainPage->t_executive_sumary_filter = & $t_executive_sumary_filter;
$MainPage->t_executive_summary_form = & $t_executive_summary_form;
$t_executive_summary_form->Initialize();

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

//Execute Components @1-BE80CF2F
$t_executive_sumary_filter->Operation();
$t_executive_summary_form->Operation();
//End Execute Components

//Go to destination page @1-5AC0715C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_executive_sumary_filter);
    unset($t_executive_summary_form);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-6640A54B
$t_executive_sumary_filter->Show();
$t_executive_summary_form->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-69561865
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_executive_sumary_filter);
unset($t_executive_summary_form);
unset($Tpl);
//End Unload Page


?>
