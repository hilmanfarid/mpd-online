<?php
//Include Common Files @1-C2960666
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "t_status_pelaporan_wp_detil.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_status_pelaporan_wp_detil { //t_status_pelaporan_wp_detil class @2-67351B05

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

//Class_Initialize Event @2-7F87033B
    function clsGridt_status_pelaporan_wp_detil($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_status_pelaporan_wp_detil";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_status_pelaporan_wp_detil";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_status_pelaporan_wp_detilDataSource($this);
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

        $this->status = & new clsControl(ccsLabel, "status", "status", ccsMemo, "", CCGetRequestParam("status", ccsGet, NULL), $this);
        $this->vat_code = & new clsControl(ccsLabel, "vat_code", "vat_code", ccsMemo, "", CCGetRequestParam("vat_code", ccsGet, NULL), $this);
        $this->jumlah = & new clsControl(ccsLabel, "jumlah", "jumlah", ccsInteger, "", CCGetRequestParam("jumlah", ccsGet, NULL), $this);
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

//Show Method @2-28D2686D
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlstatus_id"] = CCGetFromGet("status_id", NULL);

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
            $this->ControlsVisible["vat_code"] = $this->vat_code->Visible;
            $this->ControlsVisible["jumlah"] = $this->jumlah->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                // Parse Separator
                if($this->RowNumber) {
                    $this->Attributes->Show();
                    $Tpl->parseto("Separator", true, "Row");
                }
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->status->SetValue($this->DataSource->status->GetValue());
                $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                $this->jumlah->SetValue($this->DataSource->jumlah->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->status->Show();
                $this->vat_code->Show();
                $this->jumlah->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
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

//GetErrors Method @2-234834FC
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->jumlah->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_status_pelaporan_wp_detil Class @2-FCB6E20C

class clst_status_pelaporan_wp_detilDataSource extends clsDBConnSIKP {  //t_status_pelaporan_wp_detilDataSource Class @2-F62D7EA1

//DataSource Variables @2-F8EFAB11
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $status;
    var $vat_code;
    var $jumlah;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-0D815DF9
    function clst_status_pelaporan_wp_detilDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_status_pelaporan_wp_detil";
        $this->Initialize();
        $this->status = new clsField("status", ccsMemo, "");
        
        $this->vat_code = new clsField("vat_code", ccsMemo, "");
        
        $this->jumlah = new clsField("jumlah", ccsInteger, "");
        

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

//Prepare Method @2-F0857B1A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlstatus_id", ccsText, "", "", $this->Parameters["urlstatus_id"], 1, false);
    }
//End Prepare Method

//Open Method @2-6675E36A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT\n" .
        "	CASE\n" .
        "WHEN cust_account.p_account_status_id = 1 THEN\n" .
        "	'1'\n" .
        "ELSE\n" .
        "	'2'\n" .
        "END AS status,\n" .
        " vat_type.vat_code,\n" .
        " COUNT (*) AS jumlah\n" .
        "FROM\n" .
        "	t_cust_account cust_account\n" .
        "LEFT JOIN p_vat_type vat_type ON vat_type.p_vat_type_id = cust_account.p_vat_type_id\n" .
        "WHERE\n" .
        "	CASE\n" .
        "WHEN cust_account.p_account_status_id = 1 THEN\n" .
        "	'1'\n" .
        "ELSE\n" .
        "	'2'\n" .
        "END = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "\n" .
        "GROUP BY\n" .
        "	vat_type.vat_code,\n" .
        "	CASE\n" .
        "WHEN cust_account.p_account_status_id = 1 THEN\n" .
        "	'1'\n" .
        "ELSE\n" .
        "	'2'\n" .
        "END) cnt";
        $this->SQL = "SELECT\n" .
        "	CASE\n" .
        "WHEN cust_account.p_account_status_id = 1 THEN\n" .
        "	'1'\n" .
        "ELSE\n" .
        "	'2'\n" .
        "END AS status,\n" .
        " vat_type.vat_code,\n" .
        " COUNT (*) AS jumlah\n" .
        "FROM\n" .
        "	t_cust_account cust_account\n" .
        "LEFT JOIN p_vat_type vat_type ON vat_type.p_vat_type_id = cust_account.p_vat_type_id\n" .
        "WHERE\n" .
        "	CASE\n" .
        "WHEN cust_account.p_account_status_id = 1 THEN\n" .
        "	'1'\n" .
        "ELSE\n" .
        "	'2'\n" .
        "END = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "\n" .
        "GROUP BY\n" .
        "	vat_type.vat_code,\n" .
        "	CASE\n" .
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

//SetValues Method @2-420CB444
    function SetValues()
    {
        $this->status->SetDBValue($this->f("status"));
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->jumlah->SetDBValue(trim($this->f("jumlah")));
    }
//End SetValues Method

} //End t_status_pelaporan_wp_detilDataSource Class @2-FCB6E20C

//Initialize Page @1-AF415ADE
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
$TemplateFileName = "t_status_pelaporan_wp_detil.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DE3A88FA
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_status_pelaporan_wp_detil = & new clsGridt_status_pelaporan_wp_detil("", $MainPage);
$MainPage->t_status_pelaporan_wp_detil = & $t_status_pelaporan_wp_detil;
$t_status_pelaporan_wp_detil->Initialize();

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

//Go to destination page @1-83851376
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_status_pelaporan_wp_detil);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-0D9A8F49
$t_status_pelaporan_wp_detil->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-EBF43A53
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_status_pelaporan_wp_detil);
unset($Tpl);
//End Unload Page


?>
