<?php
//Include Common Files @1-E607CE79
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_setllement_ppat_payment.php");
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

//Class_Initialize Event @23-0590898F
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
        $this->ReadAllowed = true;
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
            $this->t_vat_setllement_id = & new clsControl(ccsHidden, "t_vat_setllement_id", "Id", ccsFloat, "", CCGetRequestParam("t_vat_setllement_id", $Method, NULL), $this);
            $this->cetak_payment = & new clsButton("cetak_payment", $Method, $this);
            $this->ppat_name = & new clsControl(ccsTextBox, "ppat_name", "nama PPAT", ccsText, "", CCGetRequestParam("ppat_name", $Method, NULL), $this);
            $this->ppat_name->Required = true;
            $this->t_ppat_id = & new clsControl(ccsHidden, "t_ppat_id", "t_ppat_id", ccsFloat, "", CCGetRequestParam("t_ppat_id", $Method, NULL), $this);
            $this->address_name = & new clsControl(ccsTextBox, "address_name", "Alamat Perusahaan", ccsText, "", CCGetRequestParam("address_name", $Method, NULL), $this);
            $this->address_name->Required = true;
            $this->no_sk = & new clsControl(ccsTextBox, "no_sk", "NO SK", ccsText, "", CCGetRequestParam("no_sk", $Method, NULL), $this);
            $this->no_sk->Required = true;
            $this->year_period_code_denda_profesi = & new clsControl(ccsTextBox, "year_period_code_denda_profesi", "Periode Tahun", ccsText, "", CCGetRequestParam("year_period_code_denda_profesi", $Method, NULL), $this);
            $this->finance_period_code_denda_profesi = & new clsControl(ccsTextBox, "finance_period_code_denda_profesi", "Periode", ccsText, "", CCGetRequestParam("finance_period_code_denda_profesi", $Method, NULL), $this);
            $this->sanksi_ajb = & new clsControl(ccsTextBox, "sanksi_ajb", "Sanksi AJB", ccsText, "", CCGetRequestParam("sanksi_ajb", $Method, NULL), $this);
            $this->year_period_code_sanksi_ajb = & new clsControl(ccsTextBox, "year_period_code_sanksi_ajb", "Periode Tahun", ccsText, "", CCGetRequestParam("year_period_code_sanksi_ajb", $Method, NULL), $this);
            $this->finance_period_code_sanksi_ajb = & new clsControl(ccsTextBox, "finance_period_code_sanksi_ajb", "Periode", ccsText, "", CCGetRequestParam("finance_period_code_sanksi_ajb", $Method, NULL), $this);
            $this->total_vat_amount = & new clsControl(ccsTextBox, "total_vat_amount", "JUMLAH DENDA", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_vat_amount", $Method, NULL), $this);
            $this->total_vat_amount->Required = true;
            $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "Id", ccsFloat, "", CCGetRequestParam("t_customer_order_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @23-8975066B
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
    }
//End Initialize Method

//Validate Method @23-853674D2
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_vat_setllement_id->Validate() && $Validation);
        $Validation = ($this->ppat_name->Validate() && $Validation);
        $Validation = ($this->t_ppat_id->Validate() && $Validation);
        $Validation = ($this->address_name->Validate() && $Validation);
        $Validation = ($this->no_sk->Validate() && $Validation);
        $Validation = ($this->year_period_code_denda_profesi->Validate() && $Validation);
        $Validation = ($this->finance_period_code_denda_profesi->Validate() && $Validation);
        $Validation = ($this->sanksi_ajb->Validate() && $Validation);
        $Validation = ($this->year_period_code_sanksi_ajb->Validate() && $Validation);
        $Validation = ($this->finance_period_code_sanksi_ajb->Validate() && $Validation);
        $Validation = ($this->total_vat_amount->Validate() && $Validation);
        $Validation = ($this->t_customer_order_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_vat_setllement_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ppat_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_ppat_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->no_sk->Errors->Count() == 0);
        $Validation =  $Validation && ($this->year_period_code_denda_profesi->Errors->Count() == 0);
        $Validation =  $Validation && ($this->finance_period_code_denda_profesi->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sanksi_ajb->Errors->Count() == 0);
        $Validation =  $Validation && ($this->year_period_code_sanksi_ajb->Errors->Count() == 0);
        $Validation =  $Validation && ($this->finance_period_code_sanksi_ajb->Errors->Count() == 0);
        $Validation =  $Validation && ($this->total_vat_amount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_order_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-50608668
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_vat_setllement_id->Errors->Count());
        $errors = ($errors || $this->ppat_name->Errors->Count());
        $errors = ($errors || $this->t_ppat_id->Errors->Count());
        $errors = ($errors || $this->address_name->Errors->Count());
        $errors = ($errors || $this->no_sk->Errors->Count());
        $errors = ($errors || $this->year_period_code_denda_profesi->Errors->Count());
        $errors = ($errors || $this->finance_period_code_denda_profesi->Errors->Count());
        $errors = ($errors || $this->sanksi_ajb->Errors->Count());
        $errors = ($errors || $this->year_period_code_sanksi_ajb->Errors->Count());
        $errors = ($errors || $this->finance_period_code_sanksi_ajb->Errors->Count());
        $errors = ($errors || $this->total_vat_amount->Errors->Count());
        $errors = ($errors || $this->t_customer_order_id->Errors->Count());
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

//Operation Method @23-750A549F
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
            $this->PressedButton = "cetak_payment";
            if($this->cetak_payment->Pressed) {
                $this->PressedButton = "cetak_payment";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "cetak_payment") {
                if(!CCGetEvent($this->cetak_payment->CCSEvents, "OnClick", $this->cetak_payment)) {
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

//Show Method @23-1963E171
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
                    $this->ppat_name->SetValue($this->DataSource->ppat_name->GetValue());
                    $this->t_ppat_id->SetValue($this->DataSource->t_ppat_id->GetValue());
                    $this->address_name->SetValue($this->DataSource->address_name->GetValue());
                    $this->no_sk->SetValue($this->DataSource->no_sk->GetValue());
                    $this->year_period_code_denda_profesi->SetValue($this->DataSource->year_period_code_denda_profesi->GetValue());
                    $this->finance_period_code_denda_profesi->SetValue($this->DataSource->finance_period_code_denda_profesi->GetValue());
                    $this->sanksi_ajb->SetValue($this->DataSource->sanksi_ajb->GetValue());
                    $this->year_period_code_sanksi_ajb->SetValue($this->DataSource->year_period_code_sanksi_ajb->GetValue());
                    $this->finance_period_code_sanksi_ajb->SetValue($this->DataSource->finance_period_code_sanksi_ajb->GetValue());
                    $this->total_vat_amount->SetValue($this->DataSource->total_vat_amount->GetValue());
                    $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_vat_setllement_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ppat_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_ppat_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->no_sk->Errors->ToString());
            $Error = ComposeStrings($Error, $this->year_period_code_denda_profesi->Errors->ToString());
            $Error = ComposeStrings($Error, $this->finance_period_code_denda_profesi->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sanksi_ajb->Errors->ToString());
            $Error = ComposeStrings($Error, $this->year_period_code_sanksi_ajb->Errors->ToString());
            $Error = ComposeStrings($Error, $this->finance_period_code_sanksi_ajb->Errors->ToString());
            $Error = ComposeStrings($Error, $this->total_vat_amount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_order_id->Errors->ToString());
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

        $this->t_vat_setllement_id->Show();
        $this->cetak_payment->Show();
        $this->ppat_name->Show();
        $this->t_ppat_id->Show();
        $this->address_name->Show();
        $this->no_sk->Show();
        $this->year_period_code_denda_profesi->Show();
        $this->finance_period_code_denda_profesi->Show();
        $this->sanksi_ajb->Show();
        $this->year_period_code_sanksi_ajb->Show();
        $this->finance_period_code_sanksi_ajb->Show();
        $this->total_vat_amount->Show();
        $this->t_customer_order_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_vat_setllementForm Class @23-FCB6E20C

class clst_vat_setllementFormDataSource extends clsDBConnSIKP {  //t_vat_setllementFormDataSource Class @23-AF9958CC

//DataSource Variables @23-D323B3A2
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $t_vat_setllement_id;
    var $ppat_name;
    var $t_ppat_id;
    var $address_name;
    var $no_sk;
    var $year_period_code_denda_profesi;
    var $finance_period_code_denda_profesi;
    var $sanksi_ajb;
    var $year_period_code_sanksi_ajb;
    var $finance_period_code_sanksi_ajb;
    var $total_vat_amount;
    var $t_customer_order_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-6FD610E0
    function clst_vat_setllementFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_vat_setllementForm/Error";
        $this->Initialize();
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsFloat, "");
        
        $this->ppat_name = new clsField("ppat_name", ccsText, "");
        
        $this->t_ppat_id = new clsField("t_ppat_id", ccsFloat, "");
        
        $this->address_name = new clsField("address_name", ccsText, "");
        
        $this->no_sk = new clsField("no_sk", ccsText, "");
        
        $this->year_period_code_denda_profesi = new clsField("year_period_code_denda_profesi", ccsText, "");
        
        $this->finance_period_code_denda_profesi = new clsField("finance_period_code_denda_profesi", ccsText, "");
        
        $this->sanksi_ajb = new clsField("sanksi_ajb", ccsText, "");
        
        $this->year_period_code_sanksi_ajb = new clsField("year_period_code_sanksi_ajb", ccsText, "");
        
        $this->finance_period_code_sanksi_ajb = new clsField("finance_period_code_sanksi_ajb", ccsText, "");
        
        $this->total_vat_amount = new clsField("total_vat_amount", ccsFloat, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-6E7325AA
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @23-2C4D8658
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select \n" .
        "case when sanksi_ajb is not null then '-' else a.p_finance_period_id::VARCHAR end as p_finance_period_id_denda_profesi,\n" .
        "case when sanksi_ajb is null then '-' else a.p_finance_period_id::VARCHAR end as p_finance_period_id_sanksi_ajb,\n" .
        "case when sanksi_ajb is not null then '-' else b.code end as finance_period_code_denda_profesi,\n" .
        "case when sanksi_ajb is null then '-' else b.code end as finance_period_code_sanksi_ajb,\n" .
        "case when sanksi_ajb is not null then '-' else c.year_code end as year_period_code_denda_profesi,\n" .
        "case when sanksi_ajb is null then '-' else c.year_code end as year_period_code_sanksi_ajb,\n" .
        "total_vat_amount,nvl(sanksi_ajb,'-')as sanksi_ajb,ppat_name,address_name,no_sk\n" .
        "from t_vat_setllement_ppat a\n" .
        "left join p_finance_period b on a.p_finance_period_id=b.p_finance_period_id\n" .
        "left join p_year_period c on c.p_year_period_id=b.p_year_period_id\n" .
        "where payment_key  = '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "'";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-C71E5770
    function SetValues()
    {
        $this->t_vat_setllement_id->SetDBValue(trim($this->f("t_vat_setllement_id")));
        $this->ppat_name->SetDBValue($this->f("ppat_name"));
        $this->t_ppat_id->SetDBValue(trim($this->f("t_ppat_id")));
        $this->address_name->SetDBValue($this->f("address_name"));
        $this->no_sk->SetDBValue($this->f("no_sk"));
        $this->year_period_code_denda_profesi->SetDBValue($this->f("year_period_code_denda_profesi"));
        $this->finance_period_code_denda_profesi->SetDBValue($this->f("finance_period_code_denda_profesi"));
        $this->sanksi_ajb->SetDBValue($this->f("sanksi_ajb"));
        $this->year_period_code_sanksi_ajb->SetDBValue($this->f("year_period_code_sanksi_ajb"));
        $this->finance_period_code_sanksi_ajb->SetDBValue($this->f("finance_period_code_sanksi_ajb"));
        $this->total_vat_amount->SetDBValue(trim($this->f("total_vat_amount")));
        $this->t_customer_order_id->SetDBValue(trim($this->f("t_customer_order_id")));
    }
//End SetValues Method

} //End t_vat_setllementFormDataSource Class @23-FCB6E20C

class clsRecordt_vat_setllement_dtlSearch { //t_vat_setllement_dtlSearch Class @355-A55E5ABA

//Variables @355-D6FF3E86

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

//Class_Initialize Event @355-0798A001
    function clsRecordt_vat_setllement_dtlSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_vat_setllement_dtlSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_vat_setllement_dtlSearch";
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
        }
    }
//End Class_Initialize Event

//Validate Method @355-A144A629
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @355-D6729123
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @355-ED598703
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

//Operation Method @355-15AADE90
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
        $Redirect = "t_vat_setllement_ppat_payment.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_vat_setllement_ppat_payment.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @355-7913FA87
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_vat_setllement_dtlSearch Class @355-FCB6E20C

//Initialize Page @1-F5FB7603
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
$TemplateFileName = "t_vat_setllement_ppat_payment.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C57546C2
include_once("./t_vat_setllement_ppat_payment_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DD793A22
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_vat_setllementForm = & new clsRecordt_vat_setllementForm("", $MainPage);
$t_vat_setllement_dtlSearch = & new clsRecordt_vat_setllement_dtlSearch("", $MainPage);
$MainPage->t_vat_setllementForm = & $t_vat_setllementForm;
$MainPage->t_vat_setllement_dtlSearch = & $t_vat_setllement_dtlSearch;
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

//Execute Components @1-DD0E0558
$t_vat_setllementForm->Operation();
$t_vat_setllement_dtlSearch->Operation();
//End Execute Components

//Go to destination page @1-67A9320C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_vat_setllementForm);
    unset($t_vat_setllement_dtlSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-303E9398
$t_vat_setllementForm->Show();
$t_vat_setllement_dtlSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-BB152D56
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_vat_setllementForm);
unset($t_vat_setllement_dtlSearch);
unset($Tpl);
//End Unload Page


?>
