<?php
//Include Common Files @1-D31891F4
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "status_lapor_sudah_lapor.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridselect_from_f_status_belu { //select_from_f_status_belu class @2-DE6713AC

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

//Class_Initialize Event @2-8EBB4D79
    function clsGridselect_from_f_status_belu($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "select_from_f_status_belu";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid select_from_f_status_belu";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsselect_from_f_status_beluDataSource($this);
        $this->ds = & $this->DataSource;

        $this->tgl_pelaporan = & new clsControl(ccsLabel, "tgl_pelaporan", "tgl_pelaporan", ccsText, "", CCGetRequestParam("tgl_pelaporan", ccsGet, NULL), $this);
        $this->tgl = & new clsControl(ccsLabel, "tgl", "tgl", ccsText, "", CCGetRequestParam("tgl", ccsGet, NULL), $this);
        $this->jml_lapor = & new clsControl(ccsLabel, "jml_lapor", "jml_lapor", ccsFloat, "", CCGetRequestParam("jml_lapor", ccsGet, NULL), $this);
        $this->nilai_lapor = & new clsControl(ccsLabel, "nilai_lapor", "nilai_lapor", ccsFloat, "", CCGetRequestParam("nilai_lapor", ccsGet, NULL), $this);
        $this->nilai_denda = & new clsControl(ccsLabel, "nilai_denda", "nilai_denda", ccsFloat, "", CCGetRequestParam("nilai_denda", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @2-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-1931C467
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $this->DataSource->Parameters["urlactive"] = CCGetFromGet("active", NULL);

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
            $this->ControlsVisible["tgl"] = $this->tgl->Visible;
            $this->ControlsVisible["jml_lapor"] = $this->jml_lapor->Visible;
            $this->ControlsVisible["nilai_lapor"] = $this->nilai_lapor->Visible;
            $this->ControlsVisible["nilai_denda"] = $this->nilai_denda->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
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
                $this->tgl_pelaporan->SetValue($this->DataSource->tgl_pelaporan->GetValue());
                $this->tgl->SetValue($this->DataSource->tgl->GetValue());
                $this->jml_lapor->SetValue($this->DataSource->jml_lapor->GetValue());
                $this->nilai_lapor->SetValue($this->DataSource->nilai_lapor->GetValue());
                $this->nilai_denda->SetValue($this->DataSource->nilai_denda->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->tgl_pelaporan->Show();
                $this->tgl->Show();
                $this->jml_lapor->Show();
                $this->nilai_lapor->Show();
                $this->nilai_denda->Show();
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

//GetErrors Method @2-F0682FB3
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->tgl_pelaporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tgl->Errors->ToString());
        $errors = ComposeStrings($errors, $this->jml_lapor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nilai_lapor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nilai_denda->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End select_from_f_status_belu Class @2-FCB6E20C

class clsselect_from_f_status_beluDataSource extends clsDBConnSIKP {  //select_from_f_status_beluDataSource Class @2-7236D4B9

//DataSource Variables @2-1179F0E1
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $tgl_pelaporan;
    var $tgl;
    var $jml_lapor;
    var $nilai_lapor;
    var $nilai_denda;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-FCA94A69
    function clsselect_from_f_status_beluDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid select_from_f_status_belu";
        $this->Initialize();
        $this->tgl_pelaporan = new clsField("tgl_pelaporan", ccsText, "");
        
        $this->tgl = new clsField("tgl", ccsText, "");
        
        $this->jml_lapor = new clsField("jml_lapor", ccsFloat, "");
        
        $this->nilai_lapor = new clsField("nilai_lapor", ccsFloat, "");
        
        $this->nilai_denda = new clsField("nilai_denda", ccsFloat, "");
        

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

//Prepare Method @2-6D824427
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $this->Parameters["urlp_finance_period_id"], 0, false);
        $this->wp->AddParameter("2", "urlactive", ccsFloat, "", "", $this->Parameters["urlactive"], 0, false);
    }
//End Prepare Method

//Open Method @2-D4782EF0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT * \n" .
        "FROM f_status_sudah_lapor(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ", " . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . ")) cnt";
        $this->SQL = "SELECT * \n" .
        "FROM f_status_sudah_lapor(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ", " . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-E2C07BC4
    function SetValues()
    {
        $this->tgl_pelaporan->SetDBValue($this->f("tgl_pelaporan"));
        $this->tgl->SetDBValue($this->f("tgl"));
        $this->jml_lapor->SetDBValue(trim($this->f("jml_lapor")));
        $this->nilai_lapor->SetDBValue(trim($this->f("nilai_lapor")));
        $this->nilai_denda->SetDBValue(trim($this->f("nilai_denda")));
    }
//End SetValues Method

} //End select_from_f_status_beluDataSource Class @2-FCB6E20C

//Initialize Page @1-32FFF211
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
$TemplateFileName = "status_lapor_sudah_lapor.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-4330BD51
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$select_from_f_status_belu = & new clsGridselect_from_f_status_belu("", $MainPage);
$MainPage->select_from_f_status_belu = & $select_from_f_status_belu;
$select_from_f_status_belu->Initialize();

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

//Go to destination page @1-7638426F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($select_from_f_status_belu);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D847C8D9
$select_from_f_status_belu->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-FBC5C039
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($select_from_f_status_belu);
unset($Tpl);
//End Unload Page


?>
