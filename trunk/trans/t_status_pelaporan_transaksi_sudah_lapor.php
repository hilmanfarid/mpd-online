<?php
//Include Common Files @1-C81DB624
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_status_pelaporan_transaksi_sudah_lapor.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

class clsGridt_status_pelaporan_transaksi_sudah_laporGrid { //t_status_pelaporan_transaksi_sudah_laporGrid class @2-2675196D

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

//Class_Initialize Event @2-51669363
    function clsGridt_status_pelaporan_transaksi_sudah_laporGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_status_pelaporan_transaksi_sudah_laporGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_status_pelaporan_transaksi_sudah_laporGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_status_pelaporan_transaksi_sudah_laporGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 31;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->tgl_pelaporan = & new clsControl(ccsLabel, "tgl_pelaporan", "tgl_pelaporan", ccsText, "", CCGetRequestParam("tgl_pelaporan", ccsGet, NULL), $this);
        $this->nilai_denda = & new clsControl(ccsLabel, "nilai_denda", "nilai_denda", ccsText, "", CCGetRequestParam("nilai_denda", ccsGet, NULL), $this);
        $this->jml_lapor = & new clsControl(ccsLabel, "jml_lapor", "jml_lapor", ccsText, "", CCGetRequestParam("jml_lapor", ccsGet, NULL), $this);
        $this->nilai_lapor = & new clsControl(ccsLabel, "nilai_lapor", "nilai_lapor", ccsText, "", CCGetRequestParam("nilai_lapor", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->p_finance_period_id = & new clsControl(ccsHidden, "p_finance_period_id", "p_finance_period_id", ccsFloat, "", CCGetRequestParam("p_finance_period_id", ccsGet, NULL), $this);
        $this->status_lapor = & new clsControl(ccsHidden, "status_lapor", "status_lapor", ccsText, "", CCGetRequestParam("status_lapor", ccsGet, NULL), $this);
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

//Show Method @2-F51FDA57
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);

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
            $this->ControlsVisible["tgl_pelaporan"] = $this->tgl_pelaporan->Visible;
            $this->ControlsVisible["nilai_denda"] = $this->nilai_denda->Visible;
            $this->ControlsVisible["jml_lapor"] = $this->jml_lapor->Visible;
            $this->ControlsVisible["nilai_lapor"] = $this->nilai_lapor->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->tgl_pelaporan->SetValue($this->DataSource->tgl_pelaporan->GetValue());
                $this->nilai_denda->SetValue($this->DataSource->nilai_denda->GetValue());
                $this->jml_lapor->SetValue($this->DataSource->jml_lapor->GetValue());
                $this->nilai_lapor->SetValue($this->DataSource->nilai_lapor->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->tgl_pelaporan->Show();
                $this->nilai_denda->Show();
                $this->jml_lapor->Show();
                $this->nilai_lapor->Show();
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
        $this->p_finance_period_id->Show();
        $this->status_lapor->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-EABC3CAC
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->tgl_pelaporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nilai_denda->Errors->ToString());
        $errors = ComposeStrings($errors, $this->jml_lapor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nilai_lapor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_status_pelaporan_transaksi_sudah_laporGrid Class @2-FCB6E20C

class clst_status_pelaporan_transaksi_sudah_laporGridDataSource extends clsDBConnSIKP {  //t_status_pelaporan_transaksi_sudah_laporGridDataSource Class @2-99B9DA71

//DataSource Variables @2-53E47720
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $tgl_pelaporan;
    var $nilai_denda;
    var $jml_lapor;
    var $nilai_lapor;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-4950036D
    function clst_status_pelaporan_transaksi_sudah_laporGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_status_pelaporan_transaksi_sudah_laporGrid";
        $this->Initialize();
        $this->tgl_pelaporan = new clsField("tgl_pelaporan", ccsText, "");
        
        $this->nilai_denda = new clsField("nilai_denda", ccsText, "");
        
        $this->jml_lapor = new clsField("jml_lapor", ccsText, "");
        
        $this->nilai_lapor = new clsField("nilai_lapor", ccsText, "");
        

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

//Prepare Method @2-87BF4B13
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $this->Parameters["urlp_finance_period_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-CFB5B7B9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select * from f_status_sudah_transaksi(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ")) cnt";
        $this->SQL = "select * from f_status_sudah_transaksi(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-6797E568
    function SetValues()
    {
        $this->tgl_pelaporan->SetDBValue($this->f("tgl_pelaporan"));
        $this->nilai_denda->SetDBValue($this->f("nilai_denda"));
        $this->jml_lapor->SetDBValue($this->f("jml_lapor"));
        $this->nilai_lapor->SetDBValue($this->f("nilai_lapor"));
    }
//End SetValues Method

} //End t_status_pelaporan_transaksi_sudah_laporGridDataSource Class @2-FCB6E20C



//Initialize Page @1-7E5CD121
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
$TemplateFileName = "t_status_pelaporan_transaksi_sudah_lapor.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-1C4902FB
include_once("./t_status_pelaporan_transaksi_sudah_lapor_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-28F5841A
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_status_pelaporan_transaksi_sudah_laporGrid = & new clsGridt_status_pelaporan_transaksi_sudah_laporGrid("", $MainPage);
$jml_lapor = & new clsFlashChart("jml_lapor", $MainPage);
$jml_lapor->CallbackParameter = "t_status_pelaporan_transaksi_sudah_laporjml_lapor";
$jml_lapor->Title = "Jumlah Lapor";
$jml_lapor->Width = 325;
$jml_lapor->Height = 300;
$nilai_lapor = & new clsFlashChart("nilai_lapor", $MainPage);
$nilai_lapor->CallbackParameter = "t_status_pelaporan_transaksi_sudah_lapornilai_lapor";
$nilai_lapor->Title = "Nilai Pajak";
$nilai_lapor->Width = 325;
$nilai_lapor->Height = 300;
$nilai_denda = & new clsFlashChart("nilai_denda", $MainPage);
$nilai_denda->CallbackParameter = "t_status_pelaporan_transaksi_sudah_lapornilai_denda";
$nilai_denda->Title = "Nilai Denda";
$nilai_denda->Width = 325;
$nilai_denda->Height = 300;
$MainPage->t_status_pelaporan_transaksi_sudah_laporGrid = & $t_status_pelaporan_transaksi_sudah_laporGrid;
$MainPage->jml_lapor = & $jml_lapor;
$MainPage->nilai_lapor = & $nilai_lapor;
$MainPage->nilai_denda = & $nilai_denda;
$t_status_pelaporan_transaksi_sudah_laporGrid->Initialize();

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

//Go to destination page @1-556763C9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_status_pelaporan_transaksi_sudah_laporGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9DF11D6C
$t_status_pelaporan_transaksi_sudah_laporGrid->Show();
$jml_lapor->Show();
$nilai_lapor->Show();
$nilai_denda->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1CE310FB
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_status_pelaporan_transaksi_sudah_laporGrid);
unset($Tpl);
//End Unload Page


?>
