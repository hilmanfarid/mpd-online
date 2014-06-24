<?php
//Include Common Files @1-34A3384A
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_target_realisasi_jenis_view_large.php");
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

//Class_Initialize Event @2-C1AFFE2F
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
        $this->realisasi_amt = & new clsControl(ccsLabel, "realisasi_amt", "realisasi_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt", ccsGet, NULL), $this);
        $this->percentage = & new clsControl(ccsLabel, "percentage", "percentage", ccsFloat, "", CCGetRequestParam("percentage", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_target_realisasi_jenis.php";
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->t_revenue_target_id = & new clsControl(ccsHidden, "t_revenue_target_id", "t_revenue_target_id", ccsText, "", CCGetRequestParam("t_revenue_target_id", ccsGet, NULL), $this);
        $this->p_year_period_id2 = & new clsControl(ccsHidden, "p_year_period_id2", "p_year_period_id2", ccsText, "", CCGetRequestParam("p_year_period_id2", ccsGet, NULL), $this);
        $this->p_vat_type_id2 = & new clsControl(ccsHidden, "p_vat_type_id2", "p_vat_type_id2", ccsFloat, "", CCGetRequestParam("p_vat_type_id2", ccsGet, NULL), $this);
        $this->target_amount_sum = & new clsControl(ccsLabel, "target_amount_sum", "target_amount_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_sum", ccsGet, NULL), $this);
        $this->realisasi_amt_sum = & new clsControl(ccsLabel, "realisasi_amt_sum", "realisasi_amt_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_sum", ccsGet, NULL), $this);
        $this->percentage_sum = & new clsControl(ccsLabel, "percentage_sum", "percentage_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_sum", ccsGet, NULL), $this);
        $this->p_vat_group_id = & new clsControl(ccsHidden, "p_vat_group_id", "p_vat_group_id", ccsFloat, "", CCGetRequestParam("p_vat_group_id", ccsGet, NULL), $this);
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

//Show Method @2-E9EE1EA4
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
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
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
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_revenue_target_id", $this->DataSource->f("t_revenue_target_id"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_year_period_id", $this->DataSource->f("p_year_period_id"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_vat_type_id", $this->DataSource->f("p_vat_type_id"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->target_amount->Show();
                $this->p_year_period_id->Show();
                $this->vat_code->Show();
                $this->p_vat_type_id->Show();
                $this->realisasi_amt->Show();
                $this->percentage->Show();
                $this->DLink->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-12A13C0E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->target_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_year_period_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_vat_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
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

//Prepare Method @2-295D4ADB
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_year_period_id2", ccsFloat, "", array(False, 0, Null, "", False, "", "", 1, True, ""), $this->Parameters["urlp_year_period_id2"], 0, false);
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

//Class_Initialize Event @880-CAA0BE28
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
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->target_amount_sum = & new clsControl(ccsLabel, "target_amount_sum", "target_amount_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_sum", ccsGet, NULL), $this);
        $this->realisasi_amt_sum = & new clsControl(ccsLabel, "realisasi_amt_sum", "realisasi_amt_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_sum", ccsGet, NULL), $this);
        $this->percentage_sum = & new clsControl(ccsLabel, "percentage_sum", "percentage_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_sum", ccsGet, NULL), $this);
        $this->p_year_period_id2 = & new clsControl(ccsHidden, "p_year_period_id2", "p_year_period_id2", ccsText, "", CCGetRequestParam("p_year_period_id2", ccsGet, NULL), $this);
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

//Show Method @880-AC5C9646
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @880-2125BBC0
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->target_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_year_period_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_vat_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage->Errors->ToString());
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

//Class_Initialize Event @909-869A6057
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

//Show Method @909-A5C748C9
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

//GetErrors Method @909-12C3946C
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->year_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_year_period_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage->Errors->ToString());
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

//Open Method @909-023FD52C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select * from v_target_realisasi_updated\n" .
        "where target_amt > 0 AND realisasi_amt > 0\n" .
        ") cnt";
        $this->SQL = "select * from v_target_realisasi_updated\n" .
        "where target_amt > 0 AND realisasi_amt > 0\n" .
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

//Initialize Page @1-FCC62E73
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
$TemplateFileName = "t_target_realisasi_jenis_view_large.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-CCCBE5A7
include_once("./t_target_realisasi_jenis_view_large_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E862A6C0
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_target_realisasi_jenisGrid = & new clsGridt_target_realisasi_jenisGrid("", $MainPage);
$t_target_realisasi_jenisGrid1 = & new clsGridt_target_realisasi_jenisGrid1("", $MainPage);
$t_target_realisasiGrid = & new clsGridt_target_realisasiGrid("", $MainPage);
$MainPage->t_target_realisasi_jenisGrid = & $t_target_realisasi_jenisGrid;
$MainPage->t_target_realisasi_jenisGrid1 = & $t_target_realisasi_jenisGrid1;
$MainPage->t_target_realisasiGrid = & $t_target_realisasiGrid;
$t_target_realisasi_jenisGrid->Initialize();
$t_target_realisasi_jenisGrid1->Initialize();
$t_target_realisasiGrid->Initialize();

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

//Go to destination page @1-8AE3560C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_target_realisasi_jenisGrid);
    unset($t_target_realisasi_jenisGrid1);
    unset($t_target_realisasiGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-767C0A37
$t_target_realisasi_jenisGrid->Show();
$t_target_realisasi_jenisGrid1->Show();
$t_target_realisasiGrid->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-A617E7D3
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_target_realisasi_jenisGrid);
unset($t_target_realisasi_jenisGrid1);
unset($t_target_realisasiGrid);
unset($Tpl);
//End Unload Page


?>
