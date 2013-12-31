<?php
//Include Common Files @1-F8A32352
define("RelativePath", "..");
define("PathToCurrentPage", "/lov/");
define("FileName", "lov_npwd_manual.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridLOV_ORDER { //LOV_ORDER class @2-6579D3B5

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

//Class_Initialize Event @2-0977368F
    function clsGridLOV_ORDER($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "LOV_ORDER";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid LOV_ORDER";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsLOV_ORDERDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->npwd = & new clsControl(ccsLabel, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", ccsGet, NULL), $this);
        $this->company_name = & new clsControl(ccsLabel, "company_name", "company_name", ccsText, "", CCGetRequestParam("company_name", ccsGet, NULL), $this);
        $this->PILIH = & new clsControl(ccsLabel, "PILIH", "PILIH", ccsText, "", CCGetRequestParam("PILIH", ccsGet, NULL), $this);
        $this->PILIH->HTML = true;
        $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsFloat, "", CCGetRequestParam("p_vat_type_id", ccsGet, NULL), $this);
        $this->vat_code = & new clsControl(ccsHidden, "vat_code", "vat_code", ccsText, "", CCGetRequestParam("vat_code", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->wp_address_name = & new clsControl(ccsLabel, "wp_address_name", "wp_address_name", ccsText, "", CCGetRequestParam("wp_address_name", ccsGet, NULL), $this);
        $this->p_vat_type_dtl_id = & new clsControl(ccsHidden, "p_vat_type_dtl_id", "p_vat_type_dtl_id", ccsText, "", CCGetRequestParam("p_vat_type_dtl_id", ccsGet, NULL), $this);
        $this->vat_code_dtl = & new clsControl(ccsHidden, "vat_code_dtl", "vat_code_dtl", ccsText, "", CCGetRequestParam("vat_code_dtl", ccsGet, NULL), $this);
        $this->vat_code2 = & new clsControl(ccsLabel, "vat_code2", "vat_code2", ccsText, "", CCGetRequestParam("vat_code2", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
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

//Show Method @2-3D2034CD
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr43"] = CCGetUserLogin();
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
            $this->ControlsVisible["npwd"] = $this->npwd->Visible;
            $this->ControlsVisible["company_name"] = $this->company_name->Visible;
            $this->ControlsVisible["PILIH"] = $this->PILIH->Visible;
            $this->ControlsVisible["p_vat_type_id"] = $this->p_vat_type_id->Visible;
            $this->ControlsVisible["vat_code"] = $this->vat_code->Visible;
            $this->ControlsVisible["t_cust_account_id"] = $this->t_cust_account_id->Visible;
            $this->ControlsVisible["wp_address_name"] = $this->wp_address_name->Visible;
            $this->ControlsVisible["p_vat_type_dtl_id"] = $this->p_vat_type_dtl_id->Visible;
            $this->ControlsVisible["vat_code_dtl"] = $this->vat_code_dtl->Visible;
            $this->ControlsVisible["vat_code2"] = $this->vat_code2->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                $this->company_name->SetValue($this->DataSource->company_name->GetValue());
                $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                $this->wp_address_name->SetValue($this->DataSource->wp_address_name->GetValue());
                $this->p_vat_type_dtl_id->SetValue($this->DataSource->p_vat_type_dtl_id->GetValue());
                $this->vat_code_dtl->SetValue($this->DataSource->vat_code_dtl->GetValue());
                $this->vat_code2->SetValue($this->DataSource->vat_code2->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->npwd->Show();
                $this->company_name->Show();
                $this->PILIH->Show();
                $this->p_vat_type_id->Show();
                $this->vat_code->Show();
                $this->t_cust_account_id->Show();
                $this->wp_address_name->Show();
                $this->p_vat_type_dtl_id->Show();
                $this->vat_code_dtl->Show();
                $this->vat_code2->Show();
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

//GetErrors Method @2-DC45E289
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->npwd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->company_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PILIH->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_vat_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_account_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wp_address_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_vat_type_dtl_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code_dtl->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End LOV_ORDER Class @2-FCB6E20C

class clsLOV_ORDERDataSource extends clsDBConnSIKP {  //LOV_ORDERDataSource Class @2-A587E400

//DataSource Variables @2-C5F3206C
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $npwd;
    var $company_name;
    var $p_vat_type_id;
    var $vat_code;
    var $t_cust_account_id;
    var $wp_address_name;
    var $p_vat_type_dtl_id;
    var $vat_code_dtl;
    var $vat_code2;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-130A0C13
    function clsLOV_ORDERDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid LOV_ORDER";
        $this->Initialize();
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->company_name = new clsField("company_name", ccsText, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsFloat, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->wp_address_name = new clsField("wp_address_name", ccsText, "");
        
        $this->p_vat_type_dtl_id = new clsField("p_vat_type_dtl_id", ccsText, "");
        
        $this->vat_code_dtl = new clsField("vat_code_dtl", ccsText, "");
        
        $this->vat_code2 = new clsField("vat_code2", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-741A94E7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr43", ccsText, "", "", $this->Parameters["expr43"], "", false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
    }
//End Prepare Method

//Open Method @2-BE4880EC
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select ty_lov_npwd as t_cust_account_id, npwd, company_name,company_brand as wp_address_name,\n" .
        "p_vat_type_id, vat_code, p_vat_type_dtl_id, vat_code_dtl\n" .
        "from f_get_npwd_by_username('" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "') AS tbl (ty_lov_npwd)\n" .
        "where upper(npwd) like '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%' OR\n" .
        "upper(company_name) like '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%' OR\n" .
        "upper(company_brand) like '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%') cnt";
        $this->SQL = "select ty_lov_npwd as t_cust_account_id, npwd, company_name,company_brand as wp_address_name,\n" .
        "p_vat_type_id, vat_code, p_vat_type_dtl_id, vat_code_dtl\n" .
        "from f_get_npwd_by_username('" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "') AS tbl (ty_lov_npwd)\n" .
        "where upper(npwd) like '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%' OR\n" .
        "upper(company_name) like '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%' OR\n" .
        "upper(company_brand) like '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%'";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-9F7864B2
    function SetValues()
    {
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->company_name->SetDBValue($this->f("company_name"));
        $this->p_vat_type_id->SetDBValue(trim($this->f("p_vat_type_id")));
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->wp_address_name->SetDBValue($this->f("wp_address_name"));
        $this->p_vat_type_dtl_id->SetDBValue($this->f("p_vat_type_dtl_id"));
        $this->vat_code_dtl->SetDBValue($this->f("vat_code_dtl"));
        $this->vat_code2->SetDBValue($this->f("vat_code"));
    }
//End SetValues Method

} //End LOV_ORDERDataSource Class @2-FCB6E20C

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

//Class_Initialize Event @3-52BADD76
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
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "LOV";
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
            $this->FORM = & new clsControl(ccsTextBox, "FORM", "FORM", ccsText, "", CCGetRequestParam("FORM", $Method, NULL), $this);
            $this->OBJ = & new clsControl(ccsTextBox, "OBJ", "OBJ", ccsText, "", CCGetRequestParam("OBJ", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-FA63F6C6
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->FORM->Validate() && $Validation);
        $Validation = ($this->OBJ->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FORM->Errors->Count() == 0);
        $Validation =  $Validation && ($this->OBJ->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-FBB4E0E8
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->FORM->Errors->Count());
        $errors = ($errors || $this->OBJ->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
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

//Operation Method @3-5B43BFF6
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
        $Redirect = "lov_npwd_manual.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "lov_npwd_manual.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-1DBEB16B
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
            $Error = ComposeStrings($Error, $this->FORM->Errors->ToString());
            $Error = ComposeStrings($Error, $this->OBJ->Errors->ToString());
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
        $this->FORM->Show();
        $this->OBJ->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End LOV Class @3-FCB6E20C

//Initialize Page @1-202C3B13
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
$TemplateFileName = "lov_npwd_manual.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-7005C5CA
include_once("./lov_npwd_manual_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-833AC9DB
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$LOV_ORDER = & new clsGridLOV_ORDER("", $MainPage);
$LOV = & new clsRecordLOV("", $MainPage);
$MainPage->LOV_ORDER = & $LOV_ORDER;
$MainPage->LOV = & $LOV;
$LOV_ORDER->Initialize();

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

//Go to destination page @1-981875AC
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($LOV_ORDER);
    unset($LOV);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F909E89A
$LOV_ORDER->Show();
$LOV->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F9DE0FC4
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($LOV_ORDER);
unset($LOV);
unset($Tpl);
//End Unload Page


?>
