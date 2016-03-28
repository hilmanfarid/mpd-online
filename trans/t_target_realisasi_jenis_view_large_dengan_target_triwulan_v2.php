<?php
//Include Common Files @1-E871B5B5
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_target_realisasi_jenis_view_large_dengan_target_triwulan_v2.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_target_realisasi_jenisGrid { //t_target_realisasi_jenisGrid class @2-36C2AB77

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

//Class_Initialize Event @2-5D91D5D2
    function clsGridt_target_realisasi_jenisGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_target_realisasi_jenisGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_target_realisasi_jenisGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_target_realisasi_jenisGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 100;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->target_amount = & new clsControl(ccsLabel, "target_amount", "target_amount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount", ccsGet, NULL), $this);
        $this->p_year_period_id = & new clsControl(ccsHidden, "p_year_period_id", "p_year_period_id", ccsFloat, "", CCGetRequestParam("p_year_period_id", ccsGet, NULL), $this);
        $this->vat_code = & new clsControl(ccsLabel, "vat_code", "vat_code", ccsText, "", CCGetRequestParam("vat_code", ccsGet, NULL), $this);
        $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsFloat, "", CCGetRequestParam("p_vat_type_id", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_target_realisasi_jenis.php";
        $this->realisasi_amt = & new clsControl(ccsLabel, "realisasi_amt", "realisasi_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt", ccsGet, NULL), $this);
        $this->percentage = & new clsControl(ccsLabel, "percentage", "percentage", ccsFloat, "", CCGetRequestParam("percentage", ccsGet, NULL), $this);
        $this->selisih = & new clsControl(ccsLabel, "selisih", "selisih", ccsFloat, "", CCGetRequestParam("selisih", ccsGet, NULL), $this);
        $this->percentage_selisih = & new clsControl(ccsLabel, "percentage_selisih", "percentage_selisih", ccsFloat, "", CCGetRequestParam("percentage_selisih", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->t_revenue_target_id = & new clsControl(ccsHidden, "t_revenue_target_id", "t_revenue_target_id", ccsText, "", CCGetRequestParam("t_revenue_target_id", ccsGet, NULL), $this);
        $this->p_year_period_id2 = & new clsControl(ccsHidden, "p_year_period_id2", "p_year_period_id2", ccsText, "", CCGetRequestParam("p_year_period_id2", ccsGet, NULL), $this);
        $this->p_vat_type_id2 = & new clsControl(ccsHidden, "p_vat_type_id2", "p_vat_type_id2", ccsFloat, "", CCGetRequestParam("p_vat_type_id2", ccsGet, NULL), $this);
        $this->target_amount_sum = & new clsControl(ccsLabel, "target_amount_sum", "target_amount_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_sum", ccsGet, NULL), $this);
        $this->realisasi_amt_sum = & new clsControl(ccsLabel, "realisasi_amt_sum", "realisasi_amt_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_sum", ccsGet, NULL), $this);
        $this->percentage_sum = & new clsControl(ccsLabel, "percentage_sum", "percentage_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_sum", ccsGet, NULL), $this);
        $this->p_vat_group_id = & new clsControl(ccsHidden, "p_vat_group_id", "p_vat_group_id", ccsFloat, "", CCGetRequestParam("p_vat_group_id", ccsGet, NULL), $this);
        $this->selisih_sum = & new clsControl(ccsLabel, "selisih_sum", "selisih_sum", ccsFloat, "", CCGetRequestParam("selisih_sum", ccsGet, NULL), $this);
        $this->percentage_selisih_sum = & new clsControl(ccsLabel, "percentage_selisih_sum", "percentage_selisih_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_selisih_sum", ccsGet, NULL), $this);
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

//Show Method @2-4BA90D77
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["sesp_year_period_id2"] = CCGetSession("p_year_period_id2", NULL);
        $this->DataSource->Parameters["urlp_vat_group_id"] = CCGetFromGet("p_vat_group_id", NULL);

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
            $this->ControlsVisible["target_amount"] = $this->target_amount->Visible;
            $this->ControlsVisible["p_year_period_id"] = $this->p_year_period_id->Visible;
            $this->ControlsVisible["vat_code"] = $this->vat_code->Visible;
            $this->ControlsVisible["p_vat_type_id"] = $this->p_vat_type_id->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["realisasi_amt"] = $this->realisasi_amt->Visible;
            $this->ControlsVisible["percentage"] = $this->percentage->Visible;
            $this->ControlsVisible["selisih"] = $this->selisih->Visible;
            $this->ControlsVisible["percentage_selisih"] = $this->percentage_selisih->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->target_amount->SetValue($this->DataSource->target_amount->GetValue());
                $this->p_year_period_id->SetValue($this->DataSource->p_year_period_id->GetValue());
                $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_revenue_target_id", $this->DataSource->f("t_revenue_target_id"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_year_period_id", $this->DataSource->f("p_year_period_id"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_vat_type_id", $this->DataSource->f("p_vat_type_id"));
                $this->realisasi_amt->SetValue($this->DataSource->realisasi_amt->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->target_amount->Show();
                $this->p_year_period_id->Show();
                $this->vat_code->Show();
                $this->p_vat_type_id->Show();
                $this->DLink->Show();
                $this->realisasi_amt->Show();
                $this->percentage->Show();
                $this->selisih->Show();
                $this->percentage_selisih->Show();
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
        $this->t_revenue_target_id->Show();
        $this->p_year_period_id2->Show();
        $this->p_vat_type_id2->Show();
        $this->target_amount_sum->Show();
        $this->realisasi_amt_sum->Show();
        $this->percentage_sum->Show();
        $this->p_vat_group_id->Show();
        $this->selisih_sum->Show();
        $this->percentage_selisih_sum->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-7F72D751
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->target_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_year_period_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_vat_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_target_realisasi_jenisGrid Class @2-FCB6E20C

class clst_target_realisasi_jenisGridDataSource extends clsDBConnSIKP {  //t_target_realisasi_jenisGridDataSource Class @2-927688D1

//DataSource Variables @2-0858EFB8
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $realisasi_amt;
    var $target_amount;
    var $p_year_period_id;
	//var $p_year_period_id2;
    var $year_code;
    var $vat_code;
    var $p_vat_type_id;
	//var $p_vat_type_id2;
	var $t_revenue_target_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-62F60A06
    function clst_target_realisasi_jenisGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_target_realisasi_jenisGrid";
        $this->Initialize();
        $this->realisasi_amt = new clsField("realisasi_amt", ccsText, "");
        
        $this->target_amount = new clsField("target_amount", ccsText, "");
        
        $this->p_year_period_id = new clsField("p_year_period_id", ccsFloat, "");
        //$this->p_year_period_id2 = new clsField("p_year_period_id2", ccsFloat, "");
        $this->year_code = new clsField("year_code", ccsText, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsFloat, "");
		//$this->p_vat_type_id2 = new clsField("p_vat_type_id2", ccsFloat, "");
        $this->t_revenue_target_id = new clsField("t_revenue_target_id", ccsFloat, "");

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9B541AA8
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_vat_type_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-4161607E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "sesp_year_period_id2", ccsFloat, "", array(False, 0, Null, "", False, "", "", 1, True, ""), $this->Parameters["sesp_year_period_id2"], 0, false);
        $this->wp->AddParameter("2", "urlp_vat_group_id", ccsInteger, "", "", $this->Parameters["urlp_vat_group_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-0DE4A7E7
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM ((SELECT \n" .
        "	t_revenue_target_id, \n" .
        "	p_year_period_id, \n" .
        "	p_vat_type_id, \n" .
        "	vat_code, \n" .
        "	year_code, \n" .
        "	target_amount, \n" .
        "	realisasi_amt\n" .
        "FROM v_revenue_target_vs_realisasi\n" .
        "WHERE p_year_period_id = \n" .
        "	(\n" .
        "	select p_year_period_id from p_year_period \n" .
        "	where year_code = (select extract(year from sysdate))\n" .
        "	)\n" .
        "ORDER BY p_vat_type_id\n" .
        ")\n" .
        "\n" .
        "UNION\n" .
        "(SELECT\n" .
        "	'999',\n" .
        "	" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ",\n" .
        "	999,\n" .
        "	'DENDA',\n" .
        "	'',\n" .
        "	0,\n" .
        "	SUM (round(jml_sd_hari_ini))\n" .
        "FROM\n" .
        "	sikp.f_rep_lap_harian_bdhr_baru (" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ")\n" .
        "where nomor_ayat IN('140701','140702','140703','140707')\n" .
        ")) cnt";
        $this->SQL = "(SELECT \n" .
        "	t_revenue_target_id, \n" .
        "	p_year_period_id, \n" .
        "	p_vat_type_id, \n" .
        "	vat_code, \n" .
        "	year_code, \n" .
        "	target_amount, \n" .
        "	realisasi_amt\n" .
        "FROM v_revenue_target_vs_realisasi\n" .
        "WHERE p_year_period_id = \n" .
        "	(\n" .
        "	select p_year_period_id from p_year_period \n" .
        "	where year_code = (select extract(year from sysdate))\n" .
        "	)\n" .
        "ORDER BY p_vat_type_id\n" .
        ")\n" .
        "\n" .
        "UNION\n" .
        "(SELECT\n" .
        "	'999',\n" .
        "	" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ",\n" .
        "	999,\n" .
        "	'DENDA',\n" .
        "	'',\n" .
        "	0,\n" .
        "	SUM (round(jml_sd_hari_ini))\n" .
        "FROM\n" .
        "	sikp.f_rep_lap_harian_bdhr_baru (" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ")\n" .
        "where nomor_ayat IN('140701','140702','140703','140707')\n" .
        ") {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-D0D103EE
    function SetValues()
    {
        $this->realisasi_amt->SetDBValue($this->f("realisasi_amt"));
        $this->target_amount->SetDBValue($this->f("target_amount"));
        $this->p_year_period_id->SetDBValue(trim($this->f("p_year_period_id")));
		//$this->p_year_period_id2->SetDBValue(trim($this->f("p_year_period_id2")));
        $this->year_code->SetDBValue($this->f("year_code"));
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->p_vat_type_id->SetDBValue(trim($this->f("p_vat_type_id")));
		//$this->p_vat_type_id2->SetDBValue(trim($this->f("p_vat_type_id2")));
		$this->t_revenue_target_id->SetDBValue(trim($this->f("t_revenue_target_id")));
    }
//End SetValues Method

} //End t_target_realisasi_jenisGridDataSource Class @2-FCB6E20C



class clsGridt_target_realisasiGrid { //t_target_realisasiGrid class @909-7DA52549

//Variables @909-AC1EDBB9

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

//Class_Initialize Event @909-7D20E1CF
    function clsGridt_target_realisasiGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_target_realisasiGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_target_realisasiGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_target_realisasiGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 5;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->year_code = & new clsControl(ccsLabel, "year_code", "year_code", ccsText, "", CCGetRequestParam("year_code", ccsGet, NULL), $this);
        $this->target_amt = & new clsControl(ccsLabel, "target_amt", "target_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amt", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_target_realisasi.php";
        $this->p_year_period_id = & new clsControl(ccsHidden, "p_year_period_id", "p_year_period_id", ccsText, "", CCGetRequestParam("p_year_period_id", ccsGet, NULL), $this);
        $this->realisasi_amt = & new clsControl(ccsLabel, "realisasi_amt", "realisasi_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt", ccsGet, NULL), $this);
        $this->percentage = & new clsControl(ccsLabel, "percentage", "percentage", ccsFloat, "", CCGetRequestParam("percentage", ccsGet, NULL), $this);
        $this->selisih = & new clsControl(ccsLabel, "selisih", "selisih", ccsFloat, "", CCGetRequestParam("selisih", ccsGet, NULL), $this);
        $this->percentage_selisih = & new clsControl(ccsLabel, "percentage_selisih", "percentage_selisih", ccsFloat, "", CCGetRequestParam("percentage_selisih", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->p_year_period_id2 = & new clsControl(ccsHidden, "p_year_period_id2", "p_year_period_id2", ccsText, "", CCGetRequestParam("p_year_period_id2", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @909-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @909-2EA3CD50
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
            $this->ControlsVisible["year_code"] = $this->year_code->Visible;
            $this->ControlsVisible["target_amt"] = $this->target_amt->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["p_year_period_id"] = $this->p_year_period_id->Visible;
            $this->ControlsVisible["realisasi_amt"] = $this->realisasi_amt->Visible;
            $this->ControlsVisible["percentage"] = $this->percentage->Visible;
            $this->ControlsVisible["selisih"] = $this->selisih->Visible;
            $this->ControlsVisible["percentage_selisih"] = $this->percentage_selisih->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->year_code->SetValue($this->DataSource->year_code->GetValue());
                $this->target_amt->SetValue($this->DataSource->target_amt->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_year_period_id", $this->DataSource->f("p_year_period_id"));
                $this->p_year_period_id->SetValue($this->DataSource->p_year_period_id->GetValue());
                $this->realisasi_amt->SetValue($this->DataSource->realisasi_amt->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->year_code->Show();
                $this->target_amt->Show();
                $this->DLink->Show();
                $this->p_year_period_id->Show();
                $this->realisasi_amt->Show();
                $this->percentage->Show();
                $this->selisih->Show();
                $this->percentage_selisih->Show();
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
        $this->p_year_period_id2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @909-C00EB83F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->year_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_year_period_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_target_realisasiGrid Class @909-FCB6E20C

class clst_target_realisasiGridDataSource extends clsDBConnSIKP {  //t_target_realisasiGridDataSource Class @909-9A91A27E

//DataSource Variables @909-7AEB8ABC
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $year_code;
    var $target_amt;
    var $p_year_period_id;
    var $realisasi_amt;
//End DataSource Variables

//DataSourceClass_Initialize Event @909-3716EEE5
    function clst_target_realisasiGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_target_realisasiGrid";
        $this->Initialize();
        $this->year_code = new clsField("year_code", ccsText, "");
        
        $this->target_amt = new clsField("target_amt", ccsFloat, "");
        
        $this->p_year_period_id = new clsField("p_year_period_id", ccsText, "");
        
        $this->realisasi_amt = new clsField("realisasi_amt", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @909-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @909-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @909-D06BE5B5
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select * from v_target_realisasi_updated\n" .
        "where (target_amt > 0) AND (realisasi_amt > 0) \n" .
        "and rownum < 4\n" .
        ") cnt";
        $this->SQL = "select * from v_target_realisasi_updated\n" .
        "where (target_amt > 0) AND (realisasi_amt > 0) \n" .
        "and rownum < 4\n" .
        "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @909-C6209C4F
    function SetValues()
    {
        $this->year_code->SetDBValue($this->f("year_code"));
        $this->target_amt->SetDBValue(trim($this->f("target_amt")));
        $this->p_year_period_id->SetDBValue($this->f("p_year_period_id"));
        $this->realisasi_amt->SetDBValue(trim($this->f("realisasi_amt")));
    }
//End SetValues Method

} //End t_target_realisasiGridDataSource Class @909-FCB6E20C

class clsGridt_target_realisasi_triwulanGrid1 { //t_target_realisasi_triwulanGrid1 class @928-66C91F24

//Variables @928-AC1EDBB9

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

//Class_Initialize Event @928-78782A79
    function clsGridt_target_realisasi_triwulanGrid1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_target_realisasi_triwulanGrid1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_target_realisasi_triwulanGrid1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_target_realisasi_triwulanGrid1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 5;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->target_triwulan_1 = & new clsControl(ccsLabel, "target_triwulan_1", "target_triwulan_1", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_triwulan_1", ccsGet, NULL), $this);
        $this->target_triwulan_2 = & new clsControl(ccsLabel, "target_triwulan_2", "target_triwulan_2", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_triwulan_2", ccsGet, NULL), $this);
        $this->target_triwulan_3 = & new clsControl(ccsLabel, "target_triwulan_3", "target_triwulan_3", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_triwulan_3", ccsGet, NULL), $this);
        $this->target_triwulan_4 = & new clsControl(ccsLabel, "target_triwulan_4", "target_triwulan_4", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_triwulan_4", ccsGet, NULL), $this);
        $this->realisasi_triwulan_1 = & new clsControl(ccsLabel, "realisasi_triwulan_1", "realisasi_triwulan_1", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_triwulan_1", ccsGet, NULL), $this);
        $this->realisasi_triwulan_2 = & new clsControl(ccsLabel, "realisasi_triwulan_2", "realisasi_triwulan_2", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_triwulan_2", ccsGet, NULL), $this);
        $this->realisasi_triwulan_3 = & new clsControl(ccsLabel, "realisasi_triwulan_3", "realisasi_triwulan_3", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_triwulan_3", ccsGet, NULL), $this);
        $this->realisasi_triwulan_4 = & new clsControl(ccsLabel, "realisasi_triwulan_4", "realisasi_triwulan_4", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_triwulan_4", ccsGet, NULL), $this);
        $this->percentage_triwulan_1 = & new clsControl(ccsLabel, "percentage_triwulan_1", "percentage_triwulan_1", ccsFloat, "", CCGetRequestParam("percentage_triwulan_1", ccsGet, NULL), $this);
        $this->percentage_triwulan_2 = & new clsControl(ccsLabel, "percentage_triwulan_2", "percentage_triwulan_2", ccsFloat, "", CCGetRequestParam("percentage_triwulan_2", ccsGet, NULL), $this);
        $this->percentage_triwulan_3 = & new clsControl(ccsLabel, "percentage_triwulan_3", "percentage_triwulan_3", ccsFloat, "", CCGetRequestParam("percentage_triwulan_3", ccsGet, NULL), $this);
        $this->percentage_triwulan_4 = & new clsControl(ccsLabel, "percentage_triwulan_4", "percentage_triwulan_4", ccsFloat, "", CCGetRequestParam("percentage_triwulan_4", ccsGet, NULL), $this);
        $this->selisih_triwulan_1 = & new clsControl(ccsLabel, "selisih_triwulan_1", "selisih_triwulan_1", ccsFloat, "", CCGetRequestParam("selisih_triwulan_1", ccsGet, NULL), $this);
        $this->selisih_triwulan_2 = & new clsControl(ccsLabel, "selisih_triwulan_2", "selisih_triwulan_2", ccsFloat, "", CCGetRequestParam("selisih_triwulan_2", ccsGet, NULL), $this);
        $this->selisih_triwulan_3 = & new clsControl(ccsLabel, "selisih_triwulan_3", "selisih_triwulan_3", ccsFloat, "", CCGetRequestParam("selisih_triwulan_3", ccsGet, NULL), $this);
        $this->selisih_triwulan_4 = & new clsControl(ccsLabel, "selisih_triwulan_4", "selisih_triwulan_4", ccsFloat, "", CCGetRequestParam("selisih_triwulan_4", ccsGet, NULL), $this);
        $this->percentage_selisih_triwulan_1 = & new clsControl(ccsLabel, "percentage_selisih_triwulan_1", "percentage_selisih_triwulan_1", ccsFloat, "", CCGetRequestParam("percentage_selisih_triwulan_1", ccsGet, NULL), $this);
        $this->percentage_selisih_triwulan_2 = & new clsControl(ccsLabel, "percentage_selisih_triwulan_2", "percentage_selisih_triwulan_2", ccsFloat, "", CCGetRequestParam("percentage_selisih_triwulan_2", ccsGet, NULL), $this);
        $this->percentage_selisih_triwulan_3 = & new clsControl(ccsLabel, "percentage_selisih_triwulan_3", "percentage_selisih_triwulan_3", ccsFloat, "", CCGetRequestParam("percentage_selisih_triwulan_3", ccsGet, NULL), $this);
        $this->percentage_selisih_triwulan_4 = & new clsControl(ccsLabel, "percentage_selisih_triwulan_4", "percentage_selisih_triwulan_4", ccsFloat, "", CCGetRequestParam("percentage_selisih_triwulan_4", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @928-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @928-04C5ADE8
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
            $this->ControlsVisible["target_triwulan_1"] = $this->target_triwulan_1->Visible;
            $this->ControlsVisible["target_triwulan_2"] = $this->target_triwulan_2->Visible;
            $this->ControlsVisible["target_triwulan_3"] = $this->target_triwulan_3->Visible;
            $this->ControlsVisible["target_triwulan_4"] = $this->target_triwulan_4->Visible;
            $this->ControlsVisible["realisasi_triwulan_1"] = $this->realisasi_triwulan_1->Visible;
            $this->ControlsVisible["realisasi_triwulan_2"] = $this->realisasi_triwulan_2->Visible;
            $this->ControlsVisible["realisasi_triwulan_3"] = $this->realisasi_triwulan_3->Visible;
            $this->ControlsVisible["realisasi_triwulan_4"] = $this->realisasi_triwulan_4->Visible;
            $this->ControlsVisible["percentage_triwulan_1"] = $this->percentage_triwulan_1->Visible;
            $this->ControlsVisible["percentage_triwulan_2"] = $this->percentage_triwulan_2->Visible;
            $this->ControlsVisible["percentage_triwulan_3"] = $this->percentage_triwulan_3->Visible;
            $this->ControlsVisible["percentage_triwulan_4"] = $this->percentage_triwulan_4->Visible;
            $this->ControlsVisible["selisih_triwulan_1"] = $this->selisih_triwulan_1->Visible;
            $this->ControlsVisible["selisih_triwulan_2"] = $this->selisih_triwulan_2->Visible;
            $this->ControlsVisible["selisih_triwulan_3"] = $this->selisih_triwulan_3->Visible;
            $this->ControlsVisible["selisih_triwulan_4"] = $this->selisih_triwulan_4->Visible;
            $this->ControlsVisible["percentage_selisih_triwulan_1"] = $this->percentage_selisih_triwulan_1->Visible;
            $this->ControlsVisible["percentage_selisih_triwulan_2"] = $this->percentage_selisih_triwulan_2->Visible;
            $this->ControlsVisible["percentage_selisih_triwulan_3"] = $this->percentage_selisih_triwulan_3->Visible;
            $this->ControlsVisible["percentage_selisih_triwulan_4"] = $this->percentage_selisih_triwulan_4->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->target_triwulan_1->SetValue($this->DataSource->target_triwulan_1->GetValue());
                $this->target_triwulan_2->SetValue($this->DataSource->target_triwulan_2->GetValue());
                $this->target_triwulan_3->SetValue($this->DataSource->target_triwulan_3->GetValue());
                $this->target_triwulan_4->SetValue($this->DataSource->target_triwulan_4->GetValue());
                $this->realisasi_triwulan_1->SetValue($this->DataSource->realisasi_triwulan_1->GetValue());
                $this->realisasi_triwulan_2->SetValue($this->DataSource->realisasi_triwulan_2->GetValue());
                $this->realisasi_triwulan_3->SetValue($this->DataSource->realisasi_triwulan_3->GetValue());
                $this->realisasi_triwulan_4->SetValue($this->DataSource->realisasi_triwulan_4->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->target_triwulan_1->Show();
                $this->target_triwulan_2->Show();
                $this->target_triwulan_3->Show();
                $this->target_triwulan_4->Show();
                $this->realisasi_triwulan_1->Show();
                $this->realisasi_triwulan_2->Show();
                $this->realisasi_triwulan_3->Show();
                $this->realisasi_triwulan_4->Show();
                $this->percentage_triwulan_1->Show();
                $this->percentage_triwulan_2->Show();
                $this->percentage_triwulan_3->Show();
                $this->percentage_triwulan_4->Show();
                $this->selisih_triwulan_1->Show();
                $this->selisih_triwulan_2->Show();
                $this->selisih_triwulan_3->Show();
                $this->selisih_triwulan_4->Show();
                $this->percentage_selisih_triwulan_1->Show();
                $this->percentage_selisih_triwulan_2->Show();
                $this->percentage_selisih_triwulan_3->Show();
                $this->percentage_selisih_triwulan_4->Show();
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

//GetErrors Method @928-239DEB37
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->target_triwulan_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_triwulan_2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_triwulan_3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_triwulan_4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_triwulan_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_triwulan_2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_triwulan_3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_triwulan_4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_triwulan_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_triwulan_2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_triwulan_3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_triwulan_4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih_triwulan_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih_triwulan_2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih_triwulan_3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih_triwulan_4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih_triwulan_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih_triwulan_2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih_triwulan_3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih_triwulan_4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_target_realisasi_triwulanGrid1 Class @928-FCB6E20C

class clst_target_realisasi_triwulanGrid1DataSource extends clsDBConnSIKP {  //t_target_realisasi_triwulanGrid1DataSource Class @928-6A1806C2

//DataSource Variables @928-B685AB63
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $target_triwulan_1;
    var $target_triwulan_2;
    var $target_triwulan_3;
    var $target_triwulan_4;
    var $realisasi_triwulan_1;
    var $realisasi_triwulan_2;
    var $realisasi_triwulan_3;
    var $realisasi_triwulan_4;
//End DataSource Variables

//DataSourceClass_Initialize Event @928-1842EF21
    function clst_target_realisasi_triwulanGrid1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_target_realisasi_triwulanGrid1";
        $this->Initialize();
        $this->target_triwulan_1 = new clsField("target_triwulan_1", ccsFloat, "");
        
        $this->target_triwulan_2 = new clsField("target_triwulan_2", ccsFloat, "");
        
        $this->target_triwulan_3 = new clsField("target_triwulan_3", ccsFloat, "");
        
        $this->target_triwulan_4 = new clsField("target_triwulan_4", ccsFloat, "");
        
        $this->realisasi_triwulan_1 = new clsField("realisasi_triwulan_1", ccsFloat, "");
        
        $this->realisasi_triwulan_2 = new clsField("realisasi_triwulan_2", ccsFloat, "");
        
        $this->realisasi_triwulan_3 = new clsField("realisasi_triwulan_3", ccsFloat, "");
        
        $this->realisasi_triwulan_4 = new clsField("realisasi_triwulan_4", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @928-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @928-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @928-0E95E404
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select f_get_realisasi(to_date('31-03-'||year_code)) as realisasi_triwulan_1,\n" .
        "case when sysdate > to_date('30-06-'||year_code) then f_get_realisasi(to_date('30-06-'||year_code)) else 0 end as realisasi_triwulan_2,\n" .
        "case when sysdate > to_date('30-09-'||year_code) then f_get_realisasi(to_date('30-09-'||year_code)) else 0 end as realisasi_triwulan_3,\n" .
        "case when sysdate > to_date('31-12-'||year_code) then f_get_realisasi(to_date('31-12-'||year_code)) else 0 end as realisasi_triwulan_4,\n" .
        "(SELECT o_target FROM f_get_target_triwulan_tahun_berjalan(1)) as target_triwulan_1_v2,\n" .
        "(SELECT o_target FROM f_get_target_triwulan_tahun_berjalan(2)) as target_triwulan_2_v2,\n" .
        "(SELECT o_target FROM f_get_target_triwulan_tahun_berjalan(3)) as target_triwulan_3_v2,\n" .
        "(SELECT o_target FROM f_get_target_triwulan_tahun_berjalan(4)) as target_triwulan_4_v2,	\n" .
        "*\n" .
        "from p_year_period  \n" .
        "where sysdate between start_date and end_date) cnt";
        $this->SQL = "select f_get_realisasi(to_date('31-03-'||year_code)) as realisasi_triwulan_1,\n" .
        "case when sysdate > to_date('30-06-'||year_code) then f_get_realisasi(to_date('30-06-'||year_code)) else 0 end as realisasi_triwulan_2,\n" .
        "case when sysdate > to_date('30-09-'||year_code) then f_get_realisasi(to_date('30-09-'||year_code)) else 0 end as realisasi_triwulan_3,\n" .
        "case when sysdate > to_date('31-12-'||year_code) then f_get_realisasi(to_date('31-12-'||year_code)) else 0 end as realisasi_triwulan_4,\n" .
        "(SELECT o_target FROM f_get_target_triwulan_tahun_berjalan(1)) as target_triwulan_1_v2,\n" .
        "(SELECT o_target FROM f_get_target_triwulan_tahun_berjalan(2)) as target_triwulan_2_v2,\n" .
        "(SELECT o_target FROM f_get_target_triwulan_tahun_berjalan(3)) as target_triwulan_3_v2,\n" .
        "(SELECT o_target FROM f_get_target_triwulan_tahun_berjalan(4)) as target_triwulan_4_v2,	\n" .
        "*\n" .
        "from p_year_period  \n" .
        "where sysdate between start_date and end_date";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @928-1C698A37
    function SetValues()
    {
        $this->target_triwulan_1->SetDBValue(trim($this->f("target_triwulan_1_v2")));
        $this->target_triwulan_2->SetDBValue(trim($this->f("target_triwulan_2_v2")));
        $this->target_triwulan_3->SetDBValue(trim($this->f("target_triwulan_3_v2")));
        $this->target_triwulan_4->SetDBValue(trim($this->f("target_triwulan_4_v2")));
        $this->realisasi_triwulan_1->SetDBValue(trim($this->f("realisasi_triwulan_1")));
        $this->realisasi_triwulan_2->SetDBValue(trim($this->f("realisasi_triwulan_2")));
        $this->realisasi_triwulan_3->SetDBValue(trim($this->f("realisasi_triwulan_3")));
        $this->realisasi_triwulan_4->SetDBValue(trim($this->f("realisasi_triwulan_4")));
    }
//End SetValues Method

} //End t_target_realisasi_triwulanGrid1DataSource Class @928-FCB6E20C

class clsGridt_target_realisasi_jenisGrid1 { //t_target_realisasi_jenisGrid1 class @964-D114C682

//Variables @964-AC1EDBB9

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

//Class_Initialize Event @964-034091DD
    function clsGridt_target_realisasi_jenisGrid1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_target_realisasi_jenisGrid1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_target_realisasi_jenisGrid1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_target_realisasi_jenisGrid1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 100;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->target_amount_hotel = & new clsControl(ccsLabel, "target_amount_hotel", "target_amount_hotel", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_hotel", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_target_realisasi_jenis.php";
        $this->realisasi_amt_hotel = & new clsControl(ccsLabel, "realisasi_amt_hotel", "realisasi_amt_hotel", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_hotel", ccsGet, NULL), $this);
        $this->percentage_hotel = & new clsControl(ccsLabel, "percentage_hotel", "percentage_hotel", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_hotel", ccsGet, NULL), $this);
        $this->selisih_hotel = & new clsControl(ccsLabel, "selisih_hotel", "selisih_hotel", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("selisih_hotel", ccsGet, NULL), $this);
        $this->percentage_selisih_hotel = & new clsControl(ccsLabel, "percentage_selisih_hotel", "percentage_selisih_hotel", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_selisih_hotel", ccsGet, NULL), $this);
        $this->target_amount_resto = & new clsControl(ccsLabel, "target_amount_resto", "target_amount_resto", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_resto", ccsGet, NULL), $this);
        $this->target_amount_hiburan = & new clsControl(ccsLabel, "target_amount_hiburan", "target_amount_hiburan", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_hiburan", ccsGet, NULL), $this);
        $this->target_amount_parkir = & new clsControl(ccsLabel, "target_amount_parkir", "target_amount_parkir", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_parkir", ccsGet, NULL), $this);
        $this->target_amount_ppj = & new clsControl(ccsLabel, "target_amount_ppj", "target_amount_ppj", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_ppj", ccsGet, NULL), $this);
        $this->target_amount_bphtb = & new clsControl(ccsLabel, "target_amount_bphtb", "target_amount_bphtb", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_bphtb", ccsGet, NULL), $this);
        $this->target_amount_pbb = & new clsControl(ccsLabel, "target_amount_pbb", "target_amount_pbb", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_pbb", ccsGet, NULL), $this);
        $this->target_amount_reklame = & new clsControl(ccsLabel, "target_amount_reklame", "target_amount_reklame", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_reklame", ccsGet, NULL), $this);
        $this->target_amount_pat = & new clsControl(ccsLabel, "target_amount_pat", "target_amount_pat", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_pat", ccsGet, NULL), $this);
        $this->target_amount_denda = & new clsControl(ccsLabel, "target_amount_denda", "target_amount_denda", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_denda", ccsGet, NULL), $this);
        $this->realisasi_amt_resto = & new clsControl(ccsLabel, "realisasi_amt_resto", "realisasi_amt_resto", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_resto", ccsGet, NULL), $this);
        $this->realisasi_amt_hiburan = & new clsControl(ccsLabel, "realisasi_amt_hiburan", "realisasi_amt_hiburan", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_hiburan", ccsGet, NULL), $this);
        $this->realisasi_amt_parkir = & new clsControl(ccsLabel, "realisasi_amt_parkir", "realisasi_amt_parkir", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_parkir", ccsGet, NULL), $this);
        $this->realisasi_amt_ppj = & new clsControl(ccsLabel, "realisasi_amt_ppj", "realisasi_amt_ppj", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_ppj", ccsGet, NULL), $this);
        $this->realisasi_amt_bphtb = & new clsControl(ccsLabel, "realisasi_amt_bphtb", "realisasi_amt_bphtb", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_bphtb", ccsGet, NULL), $this);
        $this->realisasi_amt_pbb = & new clsControl(ccsLabel, "realisasi_amt_pbb", "realisasi_amt_pbb", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_pbb", ccsGet, NULL), $this);
        $this->realisasi_amt_reklame = & new clsControl(ccsLabel, "realisasi_amt_reklame", "realisasi_amt_reklame", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_reklame", ccsGet, NULL), $this);
        $this->realisasi_amt_pat = & new clsControl(ccsLabel, "realisasi_amt_pat", "realisasi_amt_pat", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_pat", ccsGet, NULL), $this);
        $this->realisasi_amt_denda = & new clsControl(ccsLabel, "realisasi_amt_denda", "realisasi_amt_denda", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_denda", ccsGet, NULL), $this);
        $this->percentage_resto = & new clsControl(ccsLabel, "percentage_resto", "percentage_resto", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_resto", ccsGet, NULL), $this);
        $this->percentage_hiburan = & new clsControl(ccsLabel, "percentage_hiburan", "percentage_hiburan", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_hiburan", ccsGet, NULL), $this);
        $this->percentage_parkir = & new clsControl(ccsLabel, "percentage_parkir", "percentage_parkir", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_parkir", ccsGet, NULL), $this);
        $this->percentage_ppj = & new clsControl(ccsLabel, "percentage_ppj", "percentage_ppj", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_ppj", ccsGet, NULL), $this);
        $this->percentage_pbb = & new clsControl(ccsLabel, "percentage_pbb", "percentage_pbb", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_pbb", ccsGet, NULL), $this);
        $this->percentage_reklame = & new clsControl(ccsLabel, "percentage_reklame", "percentage_reklame", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_reklame", ccsGet, NULL), $this);
        $this->percentage_pat = & new clsControl(ccsLabel, "percentage_pat", "percentage_pat", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_pat", ccsGet, NULL), $this);
        $this->percentage_denda = & new clsControl(ccsLabel, "percentage_denda", "percentage_denda", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_denda", ccsGet, NULL), $this);
        $this->selisih_resto = & new clsControl(ccsLabel, "selisih_resto", "selisih_resto", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("selisih_resto", ccsGet, NULL), $this);
        $this->selisih_hiburan = & new clsControl(ccsLabel, "selisih_hiburan", "selisih_hiburan", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("selisih_hiburan", ccsGet, NULL), $this);
        $this->selisih_parkir = & new clsControl(ccsLabel, "selisih_parkir", "selisih_parkir", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("selisih_parkir", ccsGet, NULL), $this);
        $this->selisih_ppj = & new clsControl(ccsLabel, "selisih_ppj", "selisih_ppj", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("selisih_ppj", ccsGet, NULL), $this);
        $this->selisih_bphtb = & new clsControl(ccsLabel, "selisih_bphtb", "selisih_bphtb", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("selisih_bphtb", ccsGet, NULL), $this);
        $this->selisih_pbb = & new clsControl(ccsLabel, "selisih_pbb", "selisih_pbb", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("selisih_pbb", ccsGet, NULL), $this);
        $this->selisih_reklame = & new clsControl(ccsLabel, "selisih_reklame", "selisih_reklame", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("selisih_reklame", ccsGet, NULL), $this);
        $this->selisih_pat = & new clsControl(ccsLabel, "selisih_pat", "selisih_pat", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("selisih_pat", ccsGet, NULL), $this);
        $this->selisih_denda = & new clsControl(ccsLabel, "selisih_denda", "selisih_denda", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("selisih_denda", ccsGet, NULL), $this);
        $this->percentage_selisih_resto = & new clsControl(ccsLabel, "percentage_selisih_resto", "percentage_selisih_resto", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_selisih_resto", ccsGet, NULL), $this);
        $this->percentage_selisih_hiburan = & new clsControl(ccsLabel, "percentage_selisih_hiburan", "percentage_selisih_hiburan", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_selisih_hiburan", ccsGet, NULL), $this);
        $this->percentage_selisih_parkir = & new clsControl(ccsLabel, "percentage_selisih_parkir", "percentage_selisih_parkir", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_selisih_parkir", ccsGet, NULL), $this);
        $this->percentage_selisih_ppj = & new clsControl(ccsLabel, "percentage_selisih_ppj", "percentage_selisih_ppj", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_selisih_ppj", ccsGet, NULL), $this);
        $this->percentage_selisih_bphtb = & new clsControl(ccsLabel, "percentage_selisih_bphtb", "percentage_selisih_bphtb", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_selisih_bphtb", ccsGet, NULL), $this);
        $this->percentage_selisih_pbb = & new clsControl(ccsLabel, "percentage_selisih_pbb", "percentage_selisih_pbb", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_selisih_pbb", ccsGet, NULL), $this);
        $this->percentage_selisih_reklame = & new clsControl(ccsLabel, "percentage_selisih_reklame", "percentage_selisih_reklame", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_selisih_reklame", ccsGet, NULL), $this);
        $this->percentage_selisih_pat = & new clsControl(ccsLabel, "percentage_selisih_pat", "percentage_selisih_pat", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_selisih_pat", ccsGet, NULL), $this);
        $this->percentage_selisih_denda = & new clsControl(ccsLabel, "percentage_selisih_denda", "percentage_selisih_denda", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_selisih_denda", ccsGet, NULL), $this);
        $this->percentage_bphtb = & new clsControl(ccsLabel, "percentage_bphtb", "percentage_bphtb", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_bphtb", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->t_revenue_target_id = & new clsControl(ccsHidden, "t_revenue_target_id", "t_revenue_target_id", ccsText, "", CCGetRequestParam("t_revenue_target_id", ccsGet, NULL), $this);
        $this->p_year_period_id2 = & new clsControl(ccsHidden, "p_year_period_id2", "p_year_period_id2", ccsText, "", CCGetRequestParam("p_year_period_id2", ccsGet, NULL), $this);
        $this->p_vat_type_id2 = & new clsControl(ccsHidden, "p_vat_type_id2", "p_vat_type_id2", ccsFloat, "", CCGetRequestParam("p_vat_type_id2", ccsGet, NULL), $this);
        $this->target_amount_sum = & new clsControl(ccsLabel, "target_amount_sum", "target_amount_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_sum", ccsGet, NULL), $this);
        $this->realisasi_amt_sum = & new clsControl(ccsLabel, "realisasi_amt_sum", "realisasi_amt_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_sum", ccsGet, NULL), $this);
        $this->percentage_sum = & new clsControl(ccsLabel, "percentage_sum", "percentage_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_sum", ccsGet, NULL), $this);
        $this->p_vat_group_id = & new clsControl(ccsHidden, "p_vat_group_id", "p_vat_group_id", ccsFloat, "", CCGetRequestParam("p_vat_group_id", ccsGet, NULL), $this);
        $this->selisih_sum = & new clsControl(ccsLabel, "selisih_sum", "selisih_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("selisih_sum", ccsGet, NULL), $this);
        $this->percentage_selisih_sum = & new clsControl(ccsLabel, "percentage_selisih_sum", "percentage_selisih_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_selisih_sum", ccsGet, NULL), $this);
        $this->triwulan = & new clsControl(ccsLabel, "triwulan", "triwulan", ccsText, "", CCGetRequestParam("triwulan", ccsGet, NULL), $this);
        $this->triwulan1 = & new clsControl(ccsLabel, "triwulan1", "triwulan1", ccsText, "", CCGetRequestParam("triwulan1", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @964-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @964-A6022107
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["sesp_year_period_id2"] = CCGetSession("p_year_period_id2", NULL);
        $this->DataSource->Parameters["urlp_vat_group_id"] = CCGetFromGet("p_vat_group_id", NULL);

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
            $this->ControlsVisible["target_amount_hotel"] = $this->target_amount_hotel->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["realisasi_amt_hotel"] = $this->realisasi_amt_hotel->Visible;
            $this->ControlsVisible["percentage_hotel"] = $this->percentage_hotel->Visible;
            $this->ControlsVisible["selisih_hotel"] = $this->selisih_hotel->Visible;
            $this->ControlsVisible["percentage_selisih_hotel"] = $this->percentage_selisih_hotel->Visible;
            $this->ControlsVisible["target_amount_resto"] = $this->target_amount_resto->Visible;
            $this->ControlsVisible["target_amount_hiburan"] = $this->target_amount_hiburan->Visible;
            $this->ControlsVisible["target_amount_parkir"] = $this->target_amount_parkir->Visible;
            $this->ControlsVisible["target_amount_ppj"] = $this->target_amount_ppj->Visible;
            $this->ControlsVisible["target_amount_bphtb"] = $this->target_amount_bphtb->Visible;
            $this->ControlsVisible["target_amount_pbb"] = $this->target_amount_pbb->Visible;
            $this->ControlsVisible["target_amount_reklame"] = $this->target_amount_reklame->Visible;
            $this->ControlsVisible["target_amount_pat"] = $this->target_amount_pat->Visible;
            $this->ControlsVisible["target_amount_denda"] = $this->target_amount_denda->Visible;
            $this->ControlsVisible["realisasi_amt_resto"] = $this->realisasi_amt_resto->Visible;
            $this->ControlsVisible["realisasi_amt_hiburan"] = $this->realisasi_amt_hiburan->Visible;
            $this->ControlsVisible["realisasi_amt_parkir"] = $this->realisasi_amt_parkir->Visible;
            $this->ControlsVisible["realisasi_amt_ppj"] = $this->realisasi_amt_ppj->Visible;
            $this->ControlsVisible["realisasi_amt_bphtb"] = $this->realisasi_amt_bphtb->Visible;
            $this->ControlsVisible["realisasi_amt_pbb"] = $this->realisasi_amt_pbb->Visible;
            $this->ControlsVisible["realisasi_amt_reklame"] = $this->realisasi_amt_reklame->Visible;
            $this->ControlsVisible["realisasi_amt_pat"] = $this->realisasi_amt_pat->Visible;
            $this->ControlsVisible["realisasi_amt_denda"] = $this->realisasi_amt_denda->Visible;
            $this->ControlsVisible["percentage_resto"] = $this->percentage_resto->Visible;
            $this->ControlsVisible["percentage_hiburan"] = $this->percentage_hiburan->Visible;
            $this->ControlsVisible["percentage_parkir"] = $this->percentage_parkir->Visible;
            $this->ControlsVisible["percentage_ppj"] = $this->percentage_ppj->Visible;
            $this->ControlsVisible["percentage_pbb"] = $this->percentage_pbb->Visible;
            $this->ControlsVisible["percentage_reklame"] = $this->percentage_reklame->Visible;
            $this->ControlsVisible["percentage_pat"] = $this->percentage_pat->Visible;
            $this->ControlsVisible["percentage_denda"] = $this->percentage_denda->Visible;
            $this->ControlsVisible["selisih_resto"] = $this->selisih_resto->Visible;
            $this->ControlsVisible["selisih_hiburan"] = $this->selisih_hiburan->Visible;
            $this->ControlsVisible["selisih_parkir"] = $this->selisih_parkir->Visible;
            $this->ControlsVisible["selisih_ppj"] = $this->selisih_ppj->Visible;
            $this->ControlsVisible["selisih_bphtb"] = $this->selisih_bphtb->Visible;
            $this->ControlsVisible["selisih_pbb"] = $this->selisih_pbb->Visible;
            $this->ControlsVisible["selisih_reklame"] = $this->selisih_reklame->Visible;
            $this->ControlsVisible["selisih_pat"] = $this->selisih_pat->Visible;
            $this->ControlsVisible["selisih_denda"] = $this->selisih_denda->Visible;
            $this->ControlsVisible["percentage_selisih_resto"] = $this->percentage_selisih_resto->Visible;
            $this->ControlsVisible["percentage_selisih_hiburan"] = $this->percentage_selisih_hiburan->Visible;
            $this->ControlsVisible["percentage_selisih_parkir"] = $this->percentage_selisih_parkir->Visible;
            $this->ControlsVisible["percentage_selisih_ppj"] = $this->percentage_selisih_ppj->Visible;
            $this->ControlsVisible["percentage_selisih_bphtb"] = $this->percentage_selisih_bphtb->Visible;
            $this->ControlsVisible["percentage_selisih_pbb"] = $this->percentage_selisih_pbb->Visible;
            $this->ControlsVisible["percentage_selisih_reklame"] = $this->percentage_selisih_reklame->Visible;
            $this->ControlsVisible["percentage_selisih_pat"] = $this->percentage_selisih_pat->Visible;
            $this->ControlsVisible["percentage_selisih_denda"] = $this->percentage_selisih_denda->Visible;
            $this->ControlsVisible["percentage_bphtb"] = $this->percentage_bphtb->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_revenue_target_id", $this->DataSource->f("t_revenue_target_id"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_year_period_id", $this->DataSource->f("p_year_period_id"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_vat_type_id", $this->DataSource->f("p_vat_type_id"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->target_amount_hotel->Show();
                $this->DLink->Show();
                $this->realisasi_amt_hotel->Show();
                $this->percentage_hotel->Show();
                $this->selisih_hotel->Show();
                $this->percentage_selisih_hotel->Show();
                $this->target_amount_resto->Show();
                $this->target_amount_hiburan->Show();
                $this->target_amount_parkir->Show();
                $this->target_amount_ppj->Show();
                $this->target_amount_bphtb->Show();
                $this->target_amount_pbb->Show();
                $this->target_amount_reklame->Show();
                $this->target_amount_pat->Show();
                $this->target_amount_denda->Show();
                $this->realisasi_amt_resto->Show();
                $this->realisasi_amt_hiburan->Show();
                $this->realisasi_amt_parkir->Show();
                $this->realisasi_amt_ppj->Show();
                $this->realisasi_amt_bphtb->Show();
                $this->realisasi_amt_pbb->Show();
                $this->realisasi_amt_reklame->Show();
                $this->realisasi_amt_pat->Show();
                $this->realisasi_amt_denda->Show();
                $this->percentage_resto->Show();
                $this->percentage_hiburan->Show();
                $this->percentage_parkir->Show();
                $this->percentage_ppj->Show();
                $this->percentage_pbb->Show();
                $this->percentage_reklame->Show();
                $this->percentage_pat->Show();
                $this->percentage_denda->Show();
                $this->selisih_resto->Show();
                $this->selisih_hiburan->Show();
                $this->selisih_parkir->Show();
                $this->selisih_ppj->Show();
                $this->selisih_bphtb->Show();
                $this->selisih_pbb->Show();
                $this->selisih_reklame->Show();
                $this->selisih_pat->Show();
                $this->selisih_denda->Show();
                $this->percentage_selisih_resto->Show();
                $this->percentage_selisih_hiburan->Show();
                $this->percentage_selisih_parkir->Show();
                $this->percentage_selisih_ppj->Show();
                $this->percentage_selisih_bphtb->Show();
                $this->percentage_selisih_pbb->Show();
                $this->percentage_selisih_reklame->Show();
                $this->percentage_selisih_pat->Show();
                $this->percentage_selisih_denda->Show();
                $this->percentage_bphtb->Show();
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
        $this->triwulan->SetValue($this->DataSource->triwulan->GetValue());
        $this->triwulan1->SetValue($this->DataSource->triwulan1->GetValue());
        $this->Navigator->Show();
        $this->t_revenue_target_id->Show();
        $this->p_year_period_id2->Show();
        $this->p_vat_type_id2->Show();
        $this->target_amount_sum->Show();
        $this->realisasi_amt_sum->Show();
        $this->percentage_sum->Show();
        $this->p_vat_group_id->Show();
        $this->selisih_sum->Show();
        $this->percentage_selisih_sum->Show();
        $this->triwulan->Show();
        $this->triwulan1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @964-9D5F7009
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->target_amount_hotel->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt_hotel->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_hotel->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih_hotel->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih_hotel->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amount_resto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amount_hiburan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amount_parkir->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amount_ppj->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amount_bphtb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amount_pbb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amount_reklame->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amount_pat->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amount_denda->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt_resto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt_hiburan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt_parkir->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt_ppj->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt_bphtb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt_pbb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt_reklame->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt_pat->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt_denda->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_resto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_hiburan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_parkir->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_ppj->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_pbb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_reklame->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_pat->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_denda->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih_resto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih_hiburan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih_parkir->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih_ppj->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih_bphtb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih_pbb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih_reklame->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih_pat->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih_denda->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih_resto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih_hiburan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih_parkir->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih_ppj->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih_bphtb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih_pbb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih_reklame->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih_pat->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih_denda->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_bphtb->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_target_realisasi_jenisGrid1 Class @964-FCB6E20C

class clst_target_realisasi_jenisGrid1DataSource extends clsDBConnSIKP {  //t_target_realisasi_jenisGrid1DataSource Class @964-633752AB

//DataSource Variables @964-3BD34E65
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $triwulan;
    var $triwulan1;
//End DataSource Variables

//DataSourceClass_Initialize Event @964-01D61B1E
    function clst_target_realisasi_jenisGrid1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_target_realisasi_jenisGrid1";
        $this->Initialize();
        $this->triwulan = new clsField("triwulan", ccsText, "");
        
        $this->triwulan1 = new clsField("triwulan1", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @964-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @964-4161607E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "sesp_year_period_id2", ccsFloat, "", array(False, 0, Null, "", False, "", "", 1, True, ""), $this->Parameters["sesp_year_period_id2"], 0, false);
        $this->wp->AddParameter("2", "urlp_vat_group_id", ccsInteger, "", "", $this->Parameters["urlp_vat_group_id"], 0, false);
    }
//End Prepare Method

//Open Method @964-3F840D87
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select to_char(to_char(sysdate,'q'),'FMRN') AS triwulan) cnt";
        $this->SQL = "select to_char(to_char(sysdate,'q'),'FMRN') AS triwulan";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @964-6180E533
    function SetValues()
    {
        $this->triwulan->SetDBValue($this->f("triwulan"));
        $this->triwulan1->SetDBValue($this->f("triwulan"));
    }
//End SetValues Method

} //End t_target_realisasi_jenisGrid1DataSource Class @964-FCB6E20C



//Initialize Page @1-DAA65A7B
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
$TemplateFileName = "t_target_realisasi_jenis_view_large_dengan_target_triwulan_v2.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-B4EDBDB5
include_once("./t_target_realisasi_jenis_view_large_dengan_target_triwulan_v2_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-B68DA465
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_target_realisasi_jenisGrid = & new clsGridt_target_realisasi_jenisGrid("", $MainPage);
$t_target_realisasiGrid = & new clsGridt_target_realisasiGrid("", $MainPage);
$t_target_realisasi_triwulanGrid1 = & new clsGridt_target_realisasi_triwulanGrid1("", $MainPage);
$t_target_realisasi_jenisGrid1 = & new clsGridt_target_realisasi_jenisGrid1("", $MainPage);
$MainPage->t_target_realisasi_jenisGrid = & $t_target_realisasi_jenisGrid;
$MainPage->t_target_realisasiGrid = & $t_target_realisasiGrid;
$MainPage->t_target_realisasi_triwulanGrid1 = & $t_target_realisasi_triwulanGrid1;
$MainPage->t_target_realisasi_jenisGrid1 = & $t_target_realisasi_jenisGrid1;
$t_target_realisasi_jenisGrid->Initialize();
$t_target_realisasiGrid->Initialize();
$t_target_realisasi_triwulanGrid1->Initialize();
$t_target_realisasi_jenisGrid1->Initialize();

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

//Go to destination page @1-33E7222C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_target_realisasi_jenisGrid);
    unset($t_target_realisasiGrid);
    unset($t_target_realisasi_triwulanGrid1);
    unset($t_target_realisasi_jenisGrid1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-7BDD1A8C
$t_target_realisasi_jenisGrid->Show();
$t_target_realisasiGrid->Show();
$t_target_realisasi_triwulanGrid1->Show();
$t_target_realisasi_jenisGrid1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-4D417FB7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_target_realisasi_jenisGrid);
unset($t_target_realisasiGrid);
unset($t_target_realisasi_triwulanGrid1);
unset($t_target_realisasi_jenisGrid1);
unset($Tpl);
//End Unload Page


?>
