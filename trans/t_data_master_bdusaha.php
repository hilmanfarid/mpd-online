<?php
//Include Common Files @1-DC92756C
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_data_master_bdusaha.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_ppatGrid { //t_ppatGrid class @2-4B4EC346

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

//Class_Initialize Event @2-D646A8D6
    function clsGridt_ppatGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_ppatGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_ppatGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_ppatGridDataSource($this);
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

        $this->nama_bu = & new clsControl(ccsLabel, "nama_bu", "nama_bu", ccsText, "", CCGetRequestParam("nama_bu", ccsGet, NULL), $this);
        $this->npwpd_bu = & new clsControl(ccsLabel, "npwpd_bu", "npwpd_bu", ccsText, "", CCGetRequestParam("npwpd_bu", ccsGet, NULL), $this);
        $this->nokukuh_bu = & new clsControl(ccsLabel, "nokukuh_bu", "nokukuh_bu", ccsText, "", CCGetRequestParam("nokukuh_bu", ccsGet, NULL), $this);
        $this->almt_bu = & new clsControl(ccsLabel, "almt_bu", "almt_bu", ccsText, "", CCGetRequestParam("almt_bu", ccsGet, NULL), $this);
        $this->tglkukuh_bu = & new clsControl(ccsLabel, "tglkukuh_bu", "tglkukuh_bu", ccsText, "", CCGetRequestParam("tglkukuh_bu", ccsGet, NULL), $this);
        $this->lurah_bu = & new clsControl(ccsLabel, "lurah_bu", "lurah_bu", ccsText, "", CCGetRequestParam("lurah_bu", ccsGet, NULL), $this);
        $this->camat_bu = & new clsControl(ccsLabel, "camat_bu", "camat_bu", ccsText, "", CCGetRequestParam("camat_bu", ccsGet, NULL), $this);
        $this->no_form_bu = & new clsControl(ccsLabel, "no_form_bu", "no_form_bu", ccsText, "", CCGetRequestParam("no_form_bu", ccsGet, NULL), $this);
        $this->nmcatat_bu = & new clsControl(ccsLabel, "nmcatat_bu", "nmcatat_bu", ccsText, "", CCGetRequestParam("nmcatat_bu", ccsGet, NULL), $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "t_data_master_bdusaha_pembayaran_v2.php";
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

//Show Method @2-0797A909
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
            $this->ControlsVisible["nama_bu"] = $this->nama_bu->Visible;
            $this->ControlsVisible["npwpd_bu"] = $this->npwpd_bu->Visible;
            $this->ControlsVisible["nokukuh_bu"] = $this->nokukuh_bu->Visible;
            $this->ControlsVisible["almt_bu"] = $this->almt_bu->Visible;
            $this->ControlsVisible["tglkukuh_bu"] = $this->tglkukuh_bu->Visible;
            $this->ControlsVisible["lurah_bu"] = $this->lurah_bu->Visible;
            $this->ControlsVisible["camat_bu"] = $this->camat_bu->Visible;
            $this->ControlsVisible["no_form_bu"] = $this->no_form_bu->Visible;
            $this->ControlsVisible["nmcatat_bu"] = $this->nmcatat_bu->Visible;
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->nama_bu->SetValue($this->DataSource->nama_bu->GetValue());
                $this->npwpd_bu->SetValue($this->DataSource->npwpd_bu->GetValue());
                $this->nokukuh_bu->SetValue($this->DataSource->nokukuh_bu->GetValue());
                $this->almt_bu->SetValue($this->DataSource->almt_bu->GetValue());
                $this->tglkukuh_bu->SetValue($this->DataSource->tglkukuh_bu->GetValue());
                $this->lurah_bu->SetValue($this->DataSource->lurah_bu->GetValue());
                $this->camat_bu->SetValue($this->DataSource->camat_bu->GetValue());
                $this->no_form_bu->SetValue($this->DataSource->no_form_bu->GetValue());
                $this->nmcatat_bu->SetValue($this->DataSource->nmcatat_bu->GetValue());
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "npwpd_bu", $this->DataSource->f("npwpd_bu"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "s_keyword", CCGetFromGet("s_keyword", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "nama_bu", $this->DataSource->f("nama_bu"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->nama_bu->Show();
                $this->npwpd_bu->Show();
                $this->nokukuh_bu->Show();
                $this->almt_bu->Show();
                $this->tglkukuh_bu->Show();
                $this->lurah_bu->Show();
                $this->camat_bu->Show();
                $this->no_form_bu->Show();
                $this->nmcatat_bu->Show();
                $this->ImageLink1->Show();
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

//GetErrors Method @2-AF68CCAF
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->nama_bu->Errors->ToString());
        $errors = ComposeStrings($errors, $this->npwpd_bu->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nokukuh_bu->Errors->ToString());
        $errors = ComposeStrings($errors, $this->almt_bu->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tglkukuh_bu->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lurah_bu->Errors->ToString());
        $errors = ComposeStrings($errors, $this->camat_bu->Errors->ToString());
        $errors = ComposeStrings($errors, $this->no_form_bu->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nmcatat_bu->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_ppatGrid Class @2-FCB6E20C

class clst_ppatGridDataSource extends clsDBConnSIKP {  //t_ppatGridDataSource Class @2-A64414CC

//DataSource Variables @2-4B79E101
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $nama_bu;
    var $npwpd_bu;
    var $nokukuh_bu;
    var $almt_bu;
    var $tglkukuh_bu;
    var $lurah_bu;
    var $camat_bu;
    var $no_form_bu;
    var $nmcatat_bu;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-BF6CB162
    function clst_ppatGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_ppatGrid";
        $this->Initialize();
        $this->nama_bu = new clsField("nama_bu", ccsText, "");
        
        $this->npwpd_bu = new clsField("npwpd_bu", ccsText, "");
        
        $this->nokukuh_bu = new clsField("nokukuh_bu", ccsText, "");
        
        $this->almt_bu = new clsField("almt_bu", ccsText, "");
        
        $this->tglkukuh_bu = new clsField("tglkukuh_bu", ccsText, "");
        
        $this->lurah_bu = new clsField("lurah_bu", ccsText, "");
        
        $this->camat_bu = new clsField("camat_bu", ccsText, "");
        
        $this->no_form_bu = new clsField("no_form_bu", ccsText, "");
        
        $this->nmcatat_bu = new clsField("nmcatat_bu", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-5713BA98
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "nama_bu_2";
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

//Open Method @2-B9A6A8EF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT replace(nama_bu, '\"', '') as nama_bu_2,*\n" .
        "FROM t_bdusaha1\n" .
        "WHERE \n" .
        "nama_bu != ''\n" .
        "and \n" .
        "(upper(nama_bu) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(npwpd_bu) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' \n" .
        "OR upper(almt_bu) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' \n" .
        "OR upper(lurah_bu) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' \n" .
        "OR upper(camat_bu) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(nokukuh_bu) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(nmcatat_bu) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' )) cnt";
        $this->SQL = "SELECT replace(nama_bu, '\"', '') as nama_bu_2,*\n" .
        "FROM t_bdusaha1\n" .
        "WHERE \n" .
        "nama_bu != ''\n" .
        "and \n" .
        "(upper(nama_bu) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(npwpd_bu) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' \n" .
        "OR upper(almt_bu) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' \n" .
        "OR upper(lurah_bu) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' \n" .
        "OR upper(camat_bu) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(nokukuh_bu) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(nmcatat_bu) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' ){SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-83040245
    function SetValues()
    {
        $this->nama_bu->SetDBValue($this->f("nama_bu_2"));
        $this->npwpd_bu->SetDBValue($this->f("npwpd_bu"));
        $this->nokukuh_bu->SetDBValue($this->f("nokukuh_bu"));
        $this->almt_bu->SetDBValue($this->f("almt_bu"));
        $this->tglkukuh_bu->SetDBValue($this->f("tglkukuh_bu"));
        $this->lurah_bu->SetDBValue($this->f("lurah_bu"));
        $this->camat_bu->SetDBValue($this->f("camat_bu"));
        $this->no_form_bu->SetDBValue($this->f("no_form_bu"));
        $this->nmcatat_bu->SetDBValue($this->f("nmcatat_bu"));
    }
//End SetValues Method

} //End t_ppatGridDataSource Class @2-FCB6E20C

class clsRecordt_ppatSearch { //t_ppatSearch Class @3-38C020DB

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

//Class_Initialize Event @3-7AAFA38D
    function clsRecordt_ppatSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_ppatSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_ppatSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_keyword = & new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-A144A629
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

//CheckErrors Method @3-D6729123
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
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

//Operation Method @3-59F946F2
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
        $Redirect = "t_data_master_bdusaha.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_data_master_bdusaha.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-9830B7FB
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

        $this->Button_DoSearch->Show();
        $this->s_keyword->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_ppatSearch Class @3-FCB6E20C



//Initialize Page @1-85AC7E61
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
$TemplateFileName = "t_data_master_bdusaha.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-8DCD48F3
include_once("./t_data_master_bdusaha_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-F2FBA55D
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_ppatGrid = & new clsGridt_ppatGrid("", $MainPage);
$t_ppatSearch = & new clsRecordt_ppatSearch("", $MainPage);
$MainPage->t_ppatGrid = & $t_ppatGrid;
$MainPage->t_ppatSearch = & $t_ppatSearch;
$t_ppatGrid->Initialize();

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

//Execute Components @1-336F989A
$t_ppatSearch->Operation();
//End Execute Components

//Go to destination page @1-B60F5B6A
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_ppatGrid);
    unset($t_ppatSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-4DEF38A3
$t_ppatGrid->Show();
$t_ppatSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F2C5F479
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_ppatGrid);
unset($t_ppatSearch);
unset($Tpl);
//End Unload Page


?>
