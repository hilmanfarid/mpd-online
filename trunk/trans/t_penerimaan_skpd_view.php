<?php
//Include Common Files @1-CD66AE90
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_penerimaan_skpd_view.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_penerimaan_skpd_viewGrid { //t_penerimaan_skpd_viewGrid class @2-395F31C5

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

//Class_Initialize Event @2-18540194
    function clsGridt_penerimaan_skpd_viewGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_penerimaan_skpd_viewGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_penerimaan_skpd_viewGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_penerimaan_skpd_viewGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 20;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->payment_vat_amount = & new clsControl(ccsLabel, "payment_vat_amount", "payment_vat_amount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("payment_vat_amount", ccsGet, NULL), $this);
        $this->vat_code = & new clsControl(ccsLabel, "vat_code", "vat_code", ccsText, "", CCGetRequestParam("vat_code", ccsGet, NULL), $this);
        $this->no_urut = & new clsControl(ccsLabel, "no_urut", "no_urut", ccsText, "", CCGetRequestParam("no_urut", ccsGet, NULL), $this);
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

//Show Method @2-F4ACAE7F
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["urlparent_id"] = CCGetFromGet("parent_id", NULL);

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
            $this->ControlsVisible["payment_vat_amount"] = $this->payment_vat_amount->Visible;
            $this->ControlsVisible["vat_code"] = $this->vat_code->Visible;
            $this->ControlsVisible["no_urut"] = $this->no_urut->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->payment_vat_amount->SetValue($this->DataSource->payment_vat_amount->GetValue());
                $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                $this->no_urut->SetValue($this->DataSource->no_urut->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->payment_vat_amount->Show();
                $this->vat_code->Show();
                $this->no_urut->Show();
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

//GetErrors Method @2-CA5368AE
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->payment_vat_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->no_urut->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_penerimaan_skpd_viewGrid Class @2-FCB6E20C

class clst_penerimaan_skpd_viewGridDataSource extends clsDBConnSIKP {  //t_penerimaan_skpd_viewGridDataSource Class @2-14CAF917

//DataSource Variables @2-A4D676FC
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $payment_vat_amount;
    var $vat_code;
    var $no_urut;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-3D2C511D
    function clst_penerimaan_skpd_viewGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_penerimaan_skpd_viewGrid";
        $this->Initialize();
        $this->payment_vat_amount = new clsField("payment_vat_amount", ccsFloat, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        
        $this->no_urut = new clsField("no_urut", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-8638E0C3
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "united.p_vat_type_id ASC";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-EDFED027
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urlparent_id", ccsFloat, "", "", $this->Parameters["urlparent_id"], "", false);
    }
//End Prepare Method

//Open Method @2-68ACA4D1
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT row_number() over(order by united.p_vat_type_id) AS no_urut,  united.vat_code, united.payment_vat_amount FROM (\n" .
        "(SELECT b.p_vat_type_id, b.vat_code, \n" .
        "sum(jml_hari_ini) as payment_vat_amount \n" .
        "from f_rep_harian_global(to_char(sysdate,'dd-mm-yyyy')) a \n" .
        "left join p_vat_type b on b.p_vat_type_id = a.p_vat_type_id \n" .
        "where b.p_vat_type_id NOT IN (7,8,9,10)\n" .
        "GROUP BY  b.p_vat_type_id, b.vat_code \n" .
        "ORDER BY b.p_vat_type_id\n" .
        ")\n" .
        "UNION\n" .
        "(SELECT a.p_vat_type_id, c.vat_code, nvl(sum(b.payment_vat_amount),0)\n" .
        "FROM p_vat_type_dtl AS a \n" .
        "LEFT JOIN p_vat_type AS c ON a.p_vat_type_id = c.p_vat_type_id\n" .
        "LEFT JOIN t_payment_receipt_skpd b ON a.p_vat_type_dtl_id = b.p_vat_type_dtl_id\n" .
        "AND trunc(b.payment_date) = trunc(sysdate-1)\n" .
        "WHERE a.p_vat_type_id IN (8,9,10)\n" .
        "GROUP BY a.p_vat_type_id, c.vat_code\n" .
        "ORDER BY a.p_vat_type_id\n" .
        ")) AS united) cnt";
        $this->SQL = "SELECT row_number() over(order by united.p_vat_type_id) AS no_urut,  united.vat_code, united.payment_vat_amount FROM (\n" .
        "(SELECT b.p_vat_type_id, b.vat_code, \n" .
        "sum(jml_hari_ini) as payment_vat_amount \n" .
        "from f_rep_harian_global(to_char(sysdate,'dd-mm-yyyy')) a \n" .
        "left join p_vat_type b on b.p_vat_type_id = a.p_vat_type_id \n" .
        "where b.p_vat_type_id NOT IN (7,8,9,10)\n" .
        "GROUP BY  b.p_vat_type_id, b.vat_code \n" .
        "ORDER BY b.p_vat_type_id\n" .
        ")\n" .
        "UNION\n" .
        "(SELECT a.p_vat_type_id, c.vat_code, nvl(sum(b.payment_vat_amount),0)\n" .
        "FROM p_vat_type_dtl AS a \n" .
        "LEFT JOIN p_vat_type AS c ON a.p_vat_type_id = c.p_vat_type_id\n" .
        "LEFT JOIN t_payment_receipt_skpd b ON a.p_vat_type_dtl_id = b.p_vat_type_dtl_id\n" .
        "AND trunc(b.payment_date) = trunc(sysdate-1)\n" .
        "WHERE a.p_vat_type_id IN (8,9,10)\n" .
        "GROUP BY a.p_vat_type_id, c.vat_code\n" .
        "ORDER BY a.p_vat_type_id\n" .
        ")) AS united {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-8CBB3591
    function SetValues()
    {
        $this->payment_vat_amount->SetDBValue(trim($this->f("payment_vat_amount")));
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->no_urut->SetDBValue($this->f("no_urut"));
    }
//End SetValues Method

} //End t_penerimaan_skpd_viewGridDataSource Class @2-FCB6E20C

//Initialize Page @1-C3982DF4
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
$TemplateFileName = "t_penerimaan_skpd_view.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-A1739001
include_once("./t_penerimaan_skpd_view_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-6CE99B71
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_penerimaan_skpd_viewGrid = & new clsGridt_penerimaan_skpd_viewGrid("", $MainPage);
$MainPage->t_penerimaan_skpd_viewGrid = & $t_penerimaan_skpd_viewGrid;
$t_penerimaan_skpd_viewGrid->Initialize();

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

//Go to destination page @1-B3F9A663
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_penerimaan_skpd_viewGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-6674813A
$t_penerimaan_skpd_viewGrid->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5A2C039C
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_penerimaan_skpd_viewGrid);
unset($Tpl);
//End Unload Page


?>
