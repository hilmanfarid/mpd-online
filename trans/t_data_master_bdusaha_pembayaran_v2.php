<?php
//Include Common Files @1-4C576563
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_data_master_bdusaha_pembayaran_v2.php");
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

//Class_Initialize Event @2-4EB416BB
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

        $this->no_spt = & new clsControl(ccsLabel, "no_spt", "no_spt", ccsText, "", CCGetRequestParam("no_spt", ccsGet, NULL), $this);
        $this->nama_bu = & new clsControl(ccsLabel, "nama_bu", "nama_bu", ccsText, "", CCGetRequestParam("nama_bu", ccsGet, NULL), $this);
        $this->npwpd_set = & new clsControl(ccsLabel, "npwpd_set", "npwpd_set", ccsText, "", CCGetRequestParam("npwpd_set", ccsGet, NULL), $this);
        $this->thn_bln = & new clsControl(ccsLabel, "thn_bln", "thn_bln", ccsText, "", CCGetRequestParam("thn_bln", ccsGet, NULL), $this);
        $this->tgl_tetap = & new clsControl(ccsLabel, "tgl_tetap", "tgl_tetap", ccsText, "", CCGetRequestParam("tgl_tetap", ccsGet, NULL), $this);
        $this->jml_tetap = & new clsControl(ccsLabel, "jml_tetap", "jml_tetap", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("jml_tetap", ccsGet, NULL), $this);
        $this->tanggal_set = & new clsControl(ccsLabel, "tanggal_set", "tanggal_set", ccsText, "", CCGetRequestParam("tanggal_set", ccsGet, NULL), $this);
        $this->no_kohir = & new clsControl(ccsLabel, "no_kohir", "no_kohir", ccsText, "", CCGetRequestParam("no_kohir", ccsGet, NULL), $this);
        $this->no_bukti_set = & new clsControl(ccsLabel, "no_bukti_set", "no_bukti_set", ccsText, "", CCGetRequestParam("no_bukti_set", ccsGet, NULL), $this);
        $this->jml_setor = & new clsControl(ccsLabel, "jml_setor", "jml_setor", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("jml_setor", ccsGet, NULL), $this);
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

//Show Method @2-1CA331B6
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["urlnpwpd_bu"] = CCGetFromGet("npwpd_bu", NULL);

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
            $this->ControlsVisible["no_spt"] = $this->no_spt->Visible;
            $this->ControlsVisible["nama_bu"] = $this->nama_bu->Visible;
            $this->ControlsVisible["npwpd_set"] = $this->npwpd_set->Visible;
            $this->ControlsVisible["thn_bln"] = $this->thn_bln->Visible;
            $this->ControlsVisible["tgl_tetap"] = $this->tgl_tetap->Visible;
            $this->ControlsVisible["jml_tetap"] = $this->jml_tetap->Visible;
            $this->ControlsVisible["tanggal_set"] = $this->tanggal_set->Visible;
            $this->ControlsVisible["no_kohir"] = $this->no_kohir->Visible;
            $this->ControlsVisible["no_bukti_set"] = $this->no_bukti_set->Visible;
            $this->ControlsVisible["jml_setor"] = $this->jml_setor->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->no_spt->SetValue($this->DataSource->no_spt->GetValue());
                $this->npwpd_set->SetValue($this->DataSource->npwpd_set->GetValue());
                $this->thn_bln->SetValue($this->DataSource->thn_bln->GetValue());
                $this->tgl_tetap->SetValue($this->DataSource->tgl_tetap->GetValue());
                $this->jml_tetap->SetValue($this->DataSource->jml_tetap->GetValue());
                $this->tanggal_set->SetValue($this->DataSource->tanggal_set->GetValue());
                $this->no_kohir->SetValue($this->DataSource->no_kohir->GetValue());
                $this->no_bukti_set->SetValue($this->DataSource->no_bukti_set->GetValue());
                $this->jml_setor->SetValue($this->DataSource->jml_setor->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->no_spt->Show();
                $this->nama_bu->Show();
                $this->npwpd_set->Show();
                $this->thn_bln->Show();
                $this->tgl_tetap->Show();
                $this->jml_tetap->Show();
                $this->tanggal_set->Show();
                $this->no_kohir->Show();
                $this->no_bukti_set->Show();
                $this->jml_setor->Show();
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

//GetErrors Method @2-77F2149D
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->no_spt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nama_bu->Errors->ToString());
        $errors = ComposeStrings($errors, $this->npwpd_set->Errors->ToString());
        $errors = ComposeStrings($errors, $this->thn_bln->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tgl_tetap->Errors->ToString());
        $errors = ComposeStrings($errors, $this->jml_tetap->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tanggal_set->Errors->ToString());
        $errors = ComposeStrings($errors, $this->no_kohir->Errors->ToString());
        $errors = ComposeStrings($errors, $this->no_bukti_set->Errors->ToString());
        $errors = ComposeStrings($errors, $this->jml_setor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_ppatGrid Class @2-FCB6E20C

class clst_ppatGridDataSource extends clsDBConnSIKP {  //t_ppatGridDataSource Class @2-A64414CC

//DataSource Variables @2-05AB5D47
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $no_spt;
    var $npwpd_set;
    var $thn_bln;
    var $tgl_tetap;
    var $jml_tetap;
    var $tanggal_set;
    var $no_kohir;
    var $no_bukti_set;
    var $jml_setor;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-A7EFBC18
    function clst_ppatGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_ppatGrid";
        $this->Initialize();
        $this->no_spt = new clsField("no_spt", ccsText, "");
        
        $this->npwpd_set = new clsField("npwpd_set", ccsText, "");
        
        $this->thn_bln = new clsField("thn_bln", ccsText, "");
        
        $this->tgl_tetap = new clsField("tgl_tetap", ccsText, "");
        
        $this->jml_tetap = new clsField("jml_tetap", ccsFloat, "");
        
        $this->tanggal_set = new clsField("tanggal_set", ccsText, "");
        
        $this->no_kohir = new clsField("no_kohir", ccsText, "");
        
        $this->no_bukti_set = new clsField("no_bukti_set", ccsText, "");
        
        $this->jml_setor = new clsField("jml_setor", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-710D7E25
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "thn_bln desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-F8DEE63B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urlnpwpd_bu", ccsText, "", "", $this->Parameters["urlnpwpd_bu"], "", false);
    }
//End Prepare Method

//Open Method @2-9A3B9EED
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select left(no_spt,length(no_spt)-3) as no_spt_2,\n" .
        "left(no_kohir,length(no_kohir)-3) as no_kohir_2,\n" .
        "left(no_bukti_set,length(no_bukti_set)-3) as no_bukti_set_2,\n" .
        "* from tuuset98 where npwpd_set = '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "') cnt";
        $this->SQL = "select left(no_spt,length(no_spt)-3) as no_spt_2,\n" .
        "left(no_kohir,length(no_kohir)-3) as no_kohir_2,\n" .
        "left(no_bukti_set,length(no_bukti_set)-3) as no_bukti_set_2,\n" .
        "* from tuuset98 where npwpd_set = '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "' {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-F79FB58C
    function SetValues()
    {
        $this->no_spt->SetDBValue($this->f("no_spt_2"));
        $this->npwpd_set->SetDBValue($this->f("npwpd_set"));
        $this->thn_bln->SetDBValue($this->f("thn_bln"));
        $this->tgl_tetap->SetDBValue($this->f("tgl_tetap"));
        $this->jml_tetap->SetDBValue(trim($this->f("jml_tetap")));
        $this->tanggal_set->SetDBValue($this->f("tanggal_set"));
        $this->no_kohir->SetDBValue($this->f("no_kohir_2"));
        $this->no_bukti_set->SetDBValue($this->f("no_bukti_set_2"));
        $this->jml_setor->SetDBValue(trim($this->f("jml_setor")));
    }
//End SetValues Method

} //End t_ppatGridDataSource Class @2-FCB6E20C





//Initialize Page @1-B30D67C5
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
$TemplateFileName = "t_data_master_bdusaha_pembayaran_v2.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-4FA82028
include_once("./t_data_master_bdusaha_pembayaran_v2_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9F7A9F7D
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_ppatGrid = & new clsGridt_ppatGrid("", $MainPage);
$nama_bu = & new clsControl(ccsHidden, "nama_bu", "nama_bu", ccsText, "", CCGetRequestParam("nama_bu", ccsGet, NULL), $MainPage);
$npwpd_bu = & new clsControl(ccsHidden, "npwpd_bu", "npwpd_bu", ccsText, "", CCGetRequestParam("npwpd_bu", ccsGet, NULL), $MainPage);
$s_keyword = & new clsControl(ccsHidden, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", ccsGet, NULL), $MainPage);
$MainPage->t_ppatGrid = & $t_ppatGrid;
$MainPage->nama_bu = & $nama_bu;
$MainPage->npwpd_bu = & $npwpd_bu;
$MainPage->s_keyword = & $s_keyword;
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

//Go to destination page @1-B8592861
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_ppatGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-63F7A3DF
$t_ppatGrid->Show();
$nama_bu->Show();
$npwpd_bu->Show();
$s_keyword->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-9B504277
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_ppatGrid);
unset($Tpl);
//End Unload Page


?>
