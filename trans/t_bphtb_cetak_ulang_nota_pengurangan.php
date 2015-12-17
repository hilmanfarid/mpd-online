<?php
//Include Common Files @1-A727541D
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_bphtb_cetak_ulang_nota_pengurangan.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_bphtb_registrationGrid { //t_bphtb_registrationGrid class @2-1401A19F

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

//Class_Initialize Event @2-4B8009DF
    function clsGridt_bphtb_registrationGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_bphtb_registrationGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_bphtb_registrationGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_bphtb_registrationGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 15;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->registration_no = & new clsControl(ccsLabel, "registration_no", "registration_no", ccsText, "", CCGetRequestParam("registration_no", ccsGet, NULL), $this);
        $this->njop_pbb = & new clsControl(ccsLabel, "njop_pbb", "njop_pbb", ccsText, "", CCGetRequestParam("njop_pbb", ccsGet, NULL), $this);
        $this->wp_address_name = & new clsControl(ccsLabel, "wp_address_name", "wp_address_name", ccsText, "", CCGetRequestParam("wp_address_name", ccsGet, NULL), $this);
        $this->t_bphtb_registration_id = & new clsControl(ccsHidden, "t_bphtb_registration_id", "t_bphtb_registration_id", ccsFloat, "", CCGetRequestParam("t_bphtb_registration_id", ccsGet, NULL), $this);
        $this->object_address_name = & new clsControl(ccsLabel, "object_address_name", "object_address_name", ccsText, "", CCGetRequestParam("object_address_name", ccsGet, NULL), $this);
        $this->bphtb_amt_final = & new clsControl(ccsLabel, "bphtb_amt_final", "bphtb_amt_final", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("bphtb_amt_final", ccsGet, NULL), $this);
        $this->wp_name = & new clsControl(ccsLabel, "wp_name", "wp_name", ccsText, "", CCGetRequestParam("wp_name", ccsGet, NULL), $this);
        $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsInteger, "", CCGetRequestParam("t_customer_order_id", ccsGet, NULL), $this);
        $this->BtnCetak = & new clsButton("BtnCetak", ccsGet, $this);
        $this->BtnCetak1 = & new clsButton("BtnCetak1", ccsGet, $this);
        $this->BtnCetak2 = & new clsButton("BtnCetak2", ccsGet, $this);
        $this->BtnCetak3 = & new clsButton("BtnCetak3", ccsGet, $this);
        $this->BtnCetak4 = & new clsButton("BtnCetak4", ccsGet, $this);
        $this->pilihan_lembar_cetak = & new clsControl(ccsHidden, "pilihan_lembar_cetak", "pilihan_lembar_cetak", ccsInteger, "", CCGetRequestParam("pilihan_lembar_cetak", ccsGet, NULL), $this);
        $this->BtnCetak5 = & new clsButton("BtnCetak5", ccsGet, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @2-A7749BE1
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


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
            $this->ControlsVisible["registration_no"] = $this->registration_no->Visible;
            $this->ControlsVisible["njop_pbb"] = $this->njop_pbb->Visible;
            $this->ControlsVisible["wp_address_name"] = $this->wp_address_name->Visible;
            $this->ControlsVisible["t_bphtb_registration_id"] = $this->t_bphtb_registration_id->Visible;
            $this->ControlsVisible["object_address_name"] = $this->object_address_name->Visible;
            $this->ControlsVisible["bphtb_amt_final"] = $this->bphtb_amt_final->Visible;
            $this->ControlsVisible["wp_name"] = $this->wp_name->Visible;
            $this->ControlsVisible["t_customer_order_id"] = $this->t_customer_order_id->Visible;
            $this->ControlsVisible["BtnCetak"] = $this->BtnCetak->Visible;
            $this->ControlsVisible["BtnCetak1"] = $this->BtnCetak1->Visible;
            $this->ControlsVisible["BtnCetak2"] = $this->BtnCetak2->Visible;
            $this->ControlsVisible["BtnCetak3"] = $this->BtnCetak3->Visible;
            $this->ControlsVisible["BtnCetak4"] = $this->BtnCetak4->Visible;
            $this->ControlsVisible["pilihan_lembar_cetak"] = $this->pilihan_lembar_cetak->Visible;
            $this->ControlsVisible["BtnCetak5"] = $this->BtnCetak5->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->registration_no->SetValue($this->DataSource->registration_no->GetValue());
                $this->njop_pbb->SetValue($this->DataSource->njop_pbb->GetValue());
                $this->wp_address_name->SetValue($this->DataSource->wp_address_name->GetValue());
                $this->t_bphtb_registration_id->SetValue($this->DataSource->t_bphtb_registration_id->GetValue());
                $this->object_address_name->SetValue($this->DataSource->object_address_name->GetValue());
                $this->bphtb_amt_final->SetValue($this->DataSource->bphtb_amt_final->GetValue());
                $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                $this->pilihan_lembar_cetak->SetValue($this->DataSource->pilihan_lembar_cetak->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->registration_no->Show();
                $this->njop_pbb->Show();
                $this->wp_address_name->Show();
                $this->t_bphtb_registration_id->Show();
                $this->object_address_name->Show();
                $this->bphtb_amt_final->Show();
                $this->wp_name->Show();
                $this->t_customer_order_id->Show();
                $this->BtnCetak->Show();
                $this->BtnCetak1->Show();
                $this->BtnCetak2->Show();
                $this->BtnCetak3->Show();
                $this->BtnCetak4->Show();
                $this->pilihan_lembar_cetak->Show();
                $this->BtnCetak5->Show();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-AD69B2A1
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->registration_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->njop_pbb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wp_address_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_bphtb_registration_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->object_address_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->bphtb_amt_final->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wp_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_customer_order_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pilihan_lembar_cetak->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_bphtb_registrationGrid Class @2-FCB6E20C

class clst_bphtb_registrationGridDataSource extends clsDBConnSIKP {  //t_bphtb_registrationGridDataSource Class @2-E2CB564B

//DataSource Variables @2-74A60D5B
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $registration_no;
    var $njop_pbb;
    var $wp_address_name;
    var $t_bphtb_registration_id;
    var $object_address_name;
    var $bphtb_amt_final;
    var $wp_name;
    var $t_customer_order_id;
    var $pilihan_lembar_cetak;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-B067F0E5
    function clst_bphtb_registrationGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_bphtb_registrationGrid";
        $this->Initialize();
        $this->registration_no = new clsField("registration_no", ccsText, "");
        
        $this->njop_pbb = new clsField("njop_pbb", ccsText, "");
        
        $this->wp_address_name = new clsField("wp_address_name", ccsText, "");
        
        $this->t_bphtb_registration_id = new clsField("t_bphtb_registration_id", ccsFloat, "");
        
        $this->object_address_name = new clsField("object_address_name", ccsText, "");
        
        $this->bphtb_amt_final = new clsField("bphtb_amt_final", ccsFloat, "");
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsInteger, "");
        
        $this->pilihan_lembar_cetak = new clsField("pilihan_lembar_cetak", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-865AFB22
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "trim(b.wp_name) ASC";
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

//Open Method @2-CAFD1327
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.t_bphtb_registration_id, a.pilihan_lembar_cetak, b.t_customer_order_id, b.registration_no, b.wp_name, b.njop_pbb, b.wp_address_name, b.object_address_name, b.bphtb_amt_final, a.exemption_amount\n" .
        "FROM t_bphtb_exemption AS a \n" .
        "INNER JOIN t_bphtb_registration AS b ON a.t_bphtb_registration_id = b.t_bphtb_registration_id\n" .
        "WHERE ( upper(b.wp_name) LIKE upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') OR \n" .
        "  upper(b.njop_pbb) LIKE upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') OR\n" .
        "  upper(b.registration_no) LIKE upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')\n" .
        ")\n" .
        "AND a.pilihan_lembar_cetak is not null) cnt";
        $this->SQL = "SELECT a.t_bphtb_registration_id, a.pilihan_lembar_cetak, b.t_customer_order_id, b.registration_no, b.wp_name, b.njop_pbb, b.wp_address_name, b.object_address_name, b.bphtb_amt_final, a.exemption_amount\n" .
        "FROM t_bphtb_exemption AS a \n" .
        "INNER JOIN t_bphtb_registration AS b ON a.t_bphtb_registration_id = b.t_bphtb_registration_id\n" .
        "WHERE ( upper(b.wp_name) LIKE upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') OR \n" .
        "  upper(b.njop_pbb) LIKE upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') OR\n" .
        "  upper(b.registration_no) LIKE upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')\n" .
        ")\n" .
        "AND a.pilihan_lembar_cetak is not null {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-3F2EDF6D
    function SetValues()
    {
        $this->registration_no->SetDBValue($this->f("registration_no"));
        $this->njop_pbb->SetDBValue($this->f("njop_pbb"));
        $this->wp_address_name->SetDBValue($this->f("wp_address_name"));
        $this->t_bphtb_registration_id->SetDBValue(trim($this->f("t_bphtb_registration_id")));
        $this->object_address_name->SetDBValue($this->f("object_address_name"));
        $this->bphtb_amt_final->SetDBValue(trim($this->f("bphtb_amt_final")));
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->t_customer_order_id->SetDBValue(trim($this->f("t_customer_order_id")));
        $this->pilihan_lembar_cetak->SetDBValue(trim($this->f("pilihan_lembar_cetak")));
    }
//End SetValues Method

} //End t_bphtb_registrationGridDataSource Class @2-FCB6E20C

class clsRecordsearchForm { //searchForm Class @312-7BAF3A53

//Variables @312-D6FF3E86

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

//Class_Initialize Event @312-68605B77
    function clsRecordsearchForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record searchForm/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "searchForm";
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

//Validate Method @312-A144A629
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

//CheckErrors Method @312-D6729123
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @312-ED598703
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

//Operation Method @312-63F41AE6
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
        $Redirect = "t_bphtb_cetak_ulang_nota_pengurangan.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_bphtb_cetak_ulang_nota_pengurangan.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @312-7913FA87
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

} //End searchForm Class @312-FCB6E20C

//Initialize Page @1-F0F7DA89
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
$TemplateFileName = "t_bphtb_cetak_ulang_nota_pengurangan.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-265CBC36
include_once("./t_bphtb_cetak_ulang_nota_pengurangan_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-5DD28512
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_bphtb_registrationGrid = & new clsGridt_bphtb_registrationGrid("", $MainPage);
$searchForm = & new clsRecordsearchForm("", $MainPage);
$MainPage->t_bphtb_registrationGrid = & $t_bphtb_registrationGrid;
$MainPage->searchForm = & $searchForm;
$t_bphtb_registrationGrid->Initialize();

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

//Execute Components @1-A769A799
$searchForm->Operation();
//End Execute Components

//Go to destination page @1-E83861CC
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_bphtb_registrationGrid);
    unset($searchForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

if(CCGetFromGet("s_keyword") == "") {
	$t_bphtb_registrationGrid->Visible = false;
}else {
	$t_bphtb_registrationGrid->Show();
}

//Show Page @1-BE43C9D7
//$t_bphtb_registrationGrid->Show();
$searchForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-78809EE1
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_bphtb_registrationGrid);
unset($searchForm);
unset($Tpl);
//End Unload Page


?>
