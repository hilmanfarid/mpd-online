<?php
//Include Common Files @1-1A362282
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_target_realisasi_jenis_view_large_dengan_target_triwulan.php");
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

//Class_Initialize Event @2-381936DE
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
            $this->PageSize = 7;
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

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
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

//Open Method @2-758E33AF
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
        "and p_vat_group_id=1\n" .
        "ORDER BY p_vat_type_id\n" .
        ")\n" .
        "\n" .
        "UNION\n" .
        "(SELECT\n" .
        "	'999',\n" .
        "	" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ",\n" .
        "	MAX (p_vat_type_id),\n" .
        "	'DENDA',\n" .
        "	'',\n" .
        "	0,\n" .
        "	SUM (round(jml_sd_hari_ini))\n" .
        "FROM\n" .
        "	sikp.f_rep_lap_harian_bdhr_baru (" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ")\n" .
        "where nomor_ayat IN('140701','140702','140703','140707')\n" .
        "and p_vat_group_id = 1\n" .
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
        "and p_vat_group_id=1\n" .
        "ORDER BY p_vat_type_id\n" .
        ")\n" .
        "\n" .
        "UNION\n" .
        "(SELECT\n" .
        "	'999',\n" .
        "	" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ",\n" .
        "	MAX (p_vat_type_id),\n" .
        "	'DENDA',\n" .
        "	'',\n" .
        "	0,\n" .
        "	SUM (round(jml_sd_hari_ini))\n" .
        "FROM\n" .
        "	sikp.f_rep_lap_harian_bdhr_baru (" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ")\n" .
        "where nomor_ayat IN('140701','140702','140703','140707')\n" .
        "and p_vat_group_id = 1\n" .
        ")";
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

class clsGridt_target_realisasi_jenisGrid1 { //t_target_realisasi_jenisGrid1 class @880-D114C682

//Variables @880-AC1EDBB9

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

//Class_Initialize Event @880-27135672
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
            $this->PageSize = 7;
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
        $this->realisasi_amt = & new clsControl(ccsLabel, "realisasi_amt", "realisasi_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt", ccsGet, NULL), $this);
        $this->percentage = & new clsControl(ccsLabel, "percentage", "percentage", ccsFloat, "", CCGetRequestParam("percentage", ccsGet, NULL), $this);
        $this->selisih = & new clsControl(ccsLabel, "selisih", "selisih", ccsFloat, "", CCGetRequestParam("selisih", ccsGet, NULL), $this);
        $this->percentage_selisih = & new clsControl(ccsLabel, "percentage_selisih", "percentage_selisih", ccsFloat, "", CCGetRequestParam("percentage_selisih", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->target_amount_sum = & new clsControl(ccsLabel, "target_amount_sum", "target_amount_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_sum", ccsGet, NULL), $this);
        $this->realisasi_amt_sum = & new clsControl(ccsLabel, "realisasi_amt_sum", "realisasi_amt_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_sum", ccsGet, NULL), $this);
        $this->percentage_sum = & new clsControl(ccsLabel, "percentage_sum", "percentage_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_sum", ccsGet, NULL), $this);
        $this->p_year_period_id2 = & new clsControl(ccsHidden, "p_year_period_id2", "p_year_period_id2", ccsText, "", CCGetRequestParam("p_year_period_id2", ccsGet, NULL), $this);
        $this->selisih_sum = & new clsControl(ccsLabel, "selisih_sum", "selisih_sum", ccsFloat, "", CCGetRequestParam("selisih_sum", ccsGet, NULL), $this);
        $this->percentage_selisih_sum = & new clsControl(ccsLabel, "percentage_selisih_sum", "percentage_selisih_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_selisih_sum", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @880-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @880-068B10A7
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlp_year_period_id2"] = CCGetFromGet("p_year_period_id2", NULL);
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
                $this->realisasi_amt->SetValue($this->DataSource->realisasi_amt->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->target_amount->Show();
                $this->p_year_period_id->Show();
                $this->vat_code->Show();
                $this->p_vat_type_id->Show();
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
        $this->target_amount_sum->Show();
        $this->realisasi_amt_sum->Show();
        $this->percentage_sum->Show();
        $this->p_year_period_id2->Show();
        $this->selisih_sum->Show();
        $this->percentage_selisih_sum->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @880-C57EF6F9
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->target_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_year_period_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_vat_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage->Errors->ToString());
        $errors = ComposeStrings($errors, $this->selisih->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage_selisih->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_target_realisasi_jenisGrid1 Class @880-FCB6E20C

class clst_target_realisasi_jenisGrid1DataSource extends clsDBConnSIKP {  //t_target_realisasi_jenisGrid1DataSource Class @880-633752AB

//DataSource Variables @880-B23F6986
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $target_amount;
    var $p_year_period_id;
    var $vat_code;
    var $p_vat_type_id;
    var $realisasi_amt;
//End DataSource Variables

//DataSourceClass_Initialize Event @880-C1EDA330
    function clst_target_realisasi_jenisGrid1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_target_realisasi_jenisGrid1";
        $this->Initialize();
        $this->target_amount = new clsField("target_amount", ccsFloat, "");
        
        $this->p_year_period_id = new clsField("p_year_period_id", ccsFloat, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsFloat, "");
        
        $this->realisasi_amt = new clsField("realisasi_amt", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @880-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @880-295D4ADB
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_year_period_id2", ccsFloat, "", array(False, 0, Null, "", False, "", "", 1, True, ""), $this->Parameters["urlp_year_period_id2"], 0, false);
        $this->wp->AddParameter("2", "urlp_vat_group_id", ccsInteger, "", "", $this->Parameters["urlp_vat_group_id"], 0, false);
    }
//End Prepare Method

//Open Method @880-C294EAD8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM ((SELECT t_revenue_target_id, p_year_period_id, p_vat_type_id, vat_code, year_code, target_amount, realisasi_amt\n" .
        "FROM v_revenue_target_vs_realisasi\n" .
        "WHERE p_year_period_id = \n" .
        "	(\n" .
        "	select p_year_period_id from p_year_period \n" .
        "	where year_code = (select extract(year from sysdate))\n" .
        "	)\n" .
        "and p_vat_group_id=2\n" .
        "ORDER BY p_vat_type_id)\n" .
        "UNION\n" .
        "(SELECT\n" .
        "	'999',\n" .
        "	" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "\n" .
        "	,\n" .
        "	MAX (p_vat_type_id),\n" .
        "	'DENDA',\n" .
        "	'',\n" .
        "	0,\n" .
        "	SUM (round(jml_sd_hari_ini))\n" .
        "FROM\n" .
        "	sikp.f_rep_lap_harian_bdhr_baru (" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ")\n" .
        "where nomor_ayat IN('140701','140702','140703','140707')\n" .
        "and p_vat_group_id = 2)) cnt";
        $this->SQL = "(SELECT t_revenue_target_id, p_year_period_id, p_vat_type_id, vat_code, year_code, target_amount, realisasi_amt\n" .
        "FROM v_revenue_target_vs_realisasi\n" .
        "WHERE p_year_period_id = \n" .
        "	(\n" .
        "	select p_year_period_id from p_year_period \n" .
        "	where year_code = (select extract(year from sysdate))\n" .
        "	)\n" .
        "and p_vat_group_id=2\n" .
        "ORDER BY p_vat_type_id)\n" .
        "UNION\n" .
        "(SELECT\n" .
        "	'999',\n" .
        "	" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "\n" .
        "	,\n" .
        "	MAX (p_vat_type_id),\n" .
        "	'DENDA',\n" .
        "	'',\n" .
        "	0,\n" .
        "	SUM (round(jml_sd_hari_ini))\n" .
        "FROM\n" .
        "	sikp.f_rep_lap_harian_bdhr_baru (" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ")\n" .
        "where nomor_ayat IN('140701','140702','140703','140707')\n" .
        "and p_vat_group_id = 2)";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @880-0C9D82C2
    function SetValues()
    {
        $this->target_amount->SetDBValue(trim($this->f("target_amount")));
        $this->p_year_period_id->SetDBValue(trim($this->f("p_year_period_id")));
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->p_vat_type_id->SetDBValue(trim($this->f("p_vat_type_id")));
        $this->realisasi_amt->SetDBValue(trim($this->f("realisasi_amt")));
    }
//End SetValues Method

} //End t_target_realisasi_jenisGrid1DataSource Class @880-FCB6E20C

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

//Open Method @928-7574E296
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select *, f_get_realisasi(to_date('01-01-'||year_code),to_date('31-03-'||year_code)) as realisasi_triwulan_1,\n" .
        "f_get_realisasi(to_date('01-04-'||year_code),to_date('30-06-'||year_code)) as realisasi_triwulan_2,\n" .
        "f_get_realisasi(to_date('01-07-'||year_code),to_date('30-09-'||year_code)) as realisasi_triwulan_3,\n" .
        "f_get_realisasi(to_date('01-10-'||year_code),to_date('31-12-'||year_code)) as realisasi_triwulan_4\n" .
        "from p_year_period  \n" .
        "where sysdate between start_date and end_date) cnt";
        $this->SQL = "select *, f_get_realisasi(to_date('01-01-'||year_code),to_date('31-03-'||year_code)) as realisasi_triwulan_1,\n" .
        "f_get_realisasi(to_date('01-04-'||year_code),to_date('30-06-'||year_code)) as realisasi_triwulan_2,\n" .
        "f_get_realisasi(to_date('01-07-'||year_code),to_date('30-09-'||year_code)) as realisasi_triwulan_3,\n" .
        "f_get_realisasi(to_date('01-10-'||year_code),to_date('31-12-'||year_code)) as realisasi_triwulan_4\n" .
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

//SetValues Method @928-BCDBE926
    function SetValues()
    {
        $this->target_triwulan_1->SetDBValue(trim($this->f("target_triwulan_1")));
        $this->target_triwulan_2->SetDBValue(trim($this->f("target_triwulan_2")));
        $this->target_triwulan_3->SetDBValue(trim($this->f("target_triwulan_3")));
        $this->target_triwulan_4->SetDBValue(trim($this->f("target_triwulan_4")));
        $this->realisasi_triwulan_1->SetDBValue(trim($this->f("realisasi_triwulan_1")));
        $this->realisasi_triwulan_2->SetDBValue(trim($this->f("realisasi_triwulan_2")));
        $this->realisasi_triwulan_3->SetDBValue(trim($this->f("realisasi_triwulan_3")));
        $this->realisasi_triwulan_4->SetDBValue(trim($this->f("realisasi_triwulan_4")));
    }
//End SetValues Method

} //End t_target_realisasi_triwulanGrid1DataSource Class @928-FCB6E20C

//Initialize Page @1-226BF365
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
$TemplateFileName = "t_target_realisasi_jenis_view_large_dengan_target_triwulan.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-2A1A21F2
include_once("./t_target_realisasi_jenis_view_large_dengan_target_triwulan_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-160ACDF3
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_target_realisasi_jenisGrid = & new clsGridt_target_realisasi_jenisGrid("", $MainPage);
$t_target_realisasi_jenisGrid1 = & new clsGridt_target_realisasi_jenisGrid1("", $MainPage);
$t_target_realisasiGrid = & new clsGridt_target_realisasiGrid("", $MainPage);
$t_target_realisasi_triwulanGrid1 = & new clsGridt_target_realisasi_triwulanGrid1("", $MainPage);
$MainPage->t_target_realisasi_jenisGrid = & $t_target_realisasi_jenisGrid;
$MainPage->t_target_realisasi_jenisGrid1 = & $t_target_realisasi_jenisGrid1;
$MainPage->t_target_realisasiGrid = & $t_target_realisasiGrid;
$MainPage->t_target_realisasi_triwulanGrid1 = & $t_target_realisasi_triwulanGrid1;
$t_target_realisasi_jenisGrid->Initialize();
$t_target_realisasi_jenisGrid1->Initialize();
$t_target_realisasiGrid->Initialize();
$t_target_realisasi_triwulanGrid1->Initialize();

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

//Go to destination page @1-3795110E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_target_realisasi_jenisGrid);
    unset($t_target_realisasi_jenisGrid1);
    unset($t_target_realisasiGrid);
    unset($t_target_realisasi_triwulanGrid1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-83B94567
$t_target_realisasi_jenisGrid->Show();
$t_target_realisasi_jenisGrid1->Show();
$t_target_realisasiGrid->Show();
$t_target_realisasi_triwulanGrid1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5B298EE3
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_target_realisasi_jenisGrid);
unset($t_target_realisasi_jenisGrid1);
unset($t_target_realisasiGrid);
unset($t_target_realisasi_triwulanGrid1);
unset($Tpl);
//End Unload Page


?>
