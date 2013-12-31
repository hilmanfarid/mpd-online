<?php
//Include Common Files @1-11FA918F
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_status_pelaporan_wp.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_laporan_status_wp { //t_laporan_status_wp class @2-9247CECA

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

//Class_Initialize Event @2-980D0EF3
    function clsGridt_laporan_status_wp($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_laporan_status_wp";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_laporan_status_wp";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_laporan_status_wpDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 40;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->status = & new clsControl(ccsLabel, "status", "status", ccsText, "", CCGetRequestParam("status", ccsGet, NULL), $this);
        $this->jumlah = & new clsControl(ccsLabel, "jumlah", "jumlah", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("jumlah", ccsGet, NULL), $this);
        $this->status_id = & new clsControl(ccsLabel, "status_id", "status_id", ccsText, "", CCGetRequestParam("status_id", ccsGet, NULL), $this);
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

//Show Method @2-2E97F8E4
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;


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
            $this->ControlsVisible["status"] = $this->status->Visible;
            $this->ControlsVisible["jumlah"] = $this->jumlah->Visible;
            $this->ControlsVisible["status_id"] = $this->status_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->status->SetValue($this->DataSource->status->GetValue());
                $this->jumlah->SetValue($this->DataSource->jumlah->GetValue());
                $this->status_id->SetValue($this->DataSource->status_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->status->Show();
                $this->jumlah->Show();
                $this->status_id->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-71CC908A
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->jumlah->Errors->ToString());
        $errors = ComposeStrings($errors, $this->status_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_laporan_status_wp Class @2-FCB6E20C

class clst_laporan_status_wpDataSource extends clsDBConnSIKP {  //t_laporan_status_wpDataSource Class @2-33328345

//DataSource Variables @2-B681992E
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $status;
    var $jumlah;
    var $status_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-339E7EE2
    function clst_laporan_status_wpDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_laporan_status_wp";
        $this->Initialize();
        $this->status = new clsField("status", ccsText, "");
        
        $this->jumlah = new clsField("jumlah", ccsFloat, "");
        
        $this->status_id = new clsField("status_id", ccsText, "");
        

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

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-E1621310
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select CASE WHEN cust_account.p_account_status_id = 1 THEN 'Aktif' ELSE 'Tidak Aktif' END as status,count(*) as jumlah,\n" .
        "CASE\n" .
        "WHEN cust_account.p_account_status_id = 1 THEN\n" .
        "	'1'\n" .
        "ELSE\n" .
        "	'2'\n" .
        "END AS status_id from t_cust_account cust_account \n" .
        "group by cust_account.p_account_status_id,\n" .
        "CASE\n" .
        "WHEN cust_account.p_account_status_id = 1 THEN\n" .
        "	'1'\n" .
        "ELSE\n" .
        "	'2'\n" .
        "END) cnt";
        $this->SQL = "select CASE WHEN cust_account.p_account_status_id = 1 THEN 'Aktif' ELSE 'Tidak Aktif' END as status,count(*) as jumlah,\n" .
        "CASE\n" .
        "WHEN cust_account.p_account_status_id = 1 THEN\n" .
        "	'1'\n" .
        "ELSE\n" .
        "	'2'\n" .
        "END AS status_id from t_cust_account cust_account \n" .
        "group by cust_account.p_account_status_id,\n" .
        "CASE\n" .
        "WHEN cust_account.p_account_status_id = 1 THEN\n" .
        "	'1'\n" .
        "ELSE\n" .
        "	'2'\n" .
        "END";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-378A3854
    function SetValues()
    {
        $this->status->SetDBValue($this->f("status"));
        $this->jumlah->SetDBValue(trim($this->f("jumlah")));
        $this->status_id->SetDBValue($this->f("status_id"));
    }
//End SetValues Method

} //End t_laporan_status_wpDataSource Class @2-FCB6E20C



//Initialize Page @1-921B5926
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
$TemplateFileName = "t_status_pelaporan_wp.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-67071262
include_once("./t_status_pelaporan_wp_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E018F152
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_laporan_status_wp = & new clsGridt_laporan_status_wp("", $MainPage);
$MainPage->t_laporan_status_wp = & $t_laporan_status_wp;
$t_laporan_status_wp->Initialize();

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

//Go to destination page @1-BA70E97F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_laporan_status_wp);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-AEFA0A43
$t_laporan_status_wp->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-FF3D23E3
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_laporan_status_wp);
unset($Tpl);
//End Unload Page


?>
