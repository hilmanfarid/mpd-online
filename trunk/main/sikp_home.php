<?php
//Include Common Files @1-2105F61B
define("RelativePath", "..");
define("PathToCurrentPage", "/main/");
define("FileName", "sikp_home.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridworkavailable { //workavailable class @4-BF8B5D72

//Variables @4-AC1EDBB9

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

//Class_Initialize Event @4-6B9FF8EF
    function clsGridworkavailable($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "workavailable";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid workavailable";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsworkavailableDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 50;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->SURL = & new clsControl(ccsHidden, "SURL", "SURL", ccsText, "", CCGetRequestParam("SURL", ccsGet, NULL), $this);
        $this->WORKFLOW_NAME = & new clsControl(ccsLink, "WORKFLOW_NAME", "WORKFLOW_NAME", ccsText, "", CCGetRequestParam("WORKFLOW_NAME", ccsGet, NULL), $this);
        $this->WORKFLOW_NAME->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->INBOX = & new clsControl(ccsLink, "INBOX", "INBOX", ccsText, "", CCGetRequestParam("INBOX", ccsGet, NULL), $this);
        $this->INBOX->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->JUMLAH = & new clsControl(ccsLabel, "JUMLAH", "JUMLAH", ccsInteger, "", CCGetRequestParam("JUMLAH", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @4-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @4-CBAF7909
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr101"] = CCGetUserLogin();

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
            $this->ControlsVisible["SURL"] = $this->SURL->Visible;
            $this->ControlsVisible["WORKFLOW_NAME"] = $this->WORKFLOW_NAME->Visible;
            $this->ControlsVisible["INBOX"] = $this->INBOX->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->SURL->SetValue($this->DataSource->SURL->GetValue());
                $this->WORKFLOW_NAME->SetValue($this->DataSource->WORKFLOW_NAME->GetValue());
                $this->WORKFLOW_NAME->Page = $this->DataSource->f("url");
                $this->INBOX->SetValue($this->DataSource->INBOX->GetValue());
                $this->INBOX->Page = $this->DataSource->f("url");
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->SURL->Show();
                $this->WORKFLOW_NAME->Show();
                $this->INBOX->Show();
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
        $this->JUMLAH->SetValue($this->DataSource->JUMLAH->GetValue());
        $this->JUMLAH->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @4-138F0E3D
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->SURL->Errors->ToString());
        $errors = ComposeStrings($errors, $this->WORKFLOW_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->INBOX->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End workavailable Class @4-FCB6E20C

class clsworkavailableDataSource extends clsDBConnSIKP {  //workavailableDataSource Class @4-C1724973

//DataSource Variables @4-73B2ADA3
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $SURL;
    var $WORKFLOW_NAME;
    var $INBOX;
    var $JUMLAH;
//End DataSource Variables

//DataSourceClass_Initialize Event @4-F4DFE3F8
    function clsworkavailableDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid workavailable";
        $this->Initialize();
        $this->SURL = new clsField("SURL", ccsText, "");
        
        $this->WORKFLOW_NAME = new clsField("WORKFLOW_NAME", ccsText, "");
        
        $this->INBOX = new clsField("INBOX", ccsText, "");
        
        $this->JUMLAH = new clsField("JUMLAH", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @4-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @4-97988F42
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr101", ccsText, "", "", $this->Parameters["expr101"], "", false);
    }
//End Prepare Method

//Open Method @4-59ACA143
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select * from pack_task_profile.workflow_name ('" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "')) cnt";
        $this->SQL = "select * from pack_task_profile.workflow_name ('" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @4-7B2777E1
    function SetValues()
    {
        $this->SURL->SetDBValue($this->f("url"));
        $this->WORKFLOW_NAME->SetDBValue($this->f("profile_type"));
        $this->INBOX->SetDBValue($this->f("jumlah"));
        $this->JUMLAH->SetDBValue(trim($this->f("jumlah")));
    }
//End SetValues Method

} //End workavailableDataSource Class @4-FCB6E20C

class clsGridworkavailable_wp { //workavailable_wp class @102-4B4D8BDC

//Variables @102-AC1EDBB9

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

//Class_Initialize Event @102-DD043BC0
    function clsGridworkavailable_wp($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "workavailable_wp";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid workavailable_wp";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsworkavailable_wpDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 50;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->SURL = & new clsControl(ccsHidden, "SURL", "SURL", ccsText, "", CCGetRequestParam("SURL", ccsGet, NULL), $this);
        $this->WORKFLOW_NAME = & new clsControl(ccsLink, "WORKFLOW_NAME", "WORKFLOW_NAME", ccsText, "", CCGetRequestParam("WORKFLOW_NAME", ccsGet, NULL), $this);
        $this->WORKFLOW_NAME->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->INBOX = & new clsControl(ccsLink, "INBOX", "INBOX", ccsText, "", CCGetRequestParam("INBOX", ccsGet, NULL), $this);
        $this->INBOX->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->JUMLAH = & new clsControl(ccsLabel, "JUMLAH", "JUMLAH", ccsInteger, "", CCGetRequestParam("JUMLAH", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @102-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @102-4E6BFF81
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr109"] = CCGetUserLogin();

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
            $this->ControlsVisible["SURL"] = $this->SURL->Visible;
            $this->ControlsVisible["WORKFLOW_NAME"] = $this->WORKFLOW_NAME->Visible;
            $this->ControlsVisible["INBOX"] = $this->INBOX->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->SURL->SetValue($this->DataSource->SURL->GetValue());
                $this->WORKFLOW_NAME->SetValue($this->DataSource->WORKFLOW_NAME->GetValue());
                $this->WORKFLOW_NAME->Page = $this->DataSource->f("url");
                $this->INBOX->SetValue($this->DataSource->INBOX->GetValue());
                $this->INBOX->Page = $this->DataSource->f("url");
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->SURL->Show();
                $this->WORKFLOW_NAME->Show();
                $this->INBOX->Show();
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
        $this->JUMLAH->SetValue($this->DataSource->JUMLAH->GetValue());
        $this->JUMLAH->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @102-138F0E3D
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->SURL->Errors->ToString());
        $errors = ComposeStrings($errors, $this->WORKFLOW_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->INBOX->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End workavailable_wp Class @102-FCB6E20C

class clsworkavailable_wpDataSource extends clsDBConnSIKP {  //workavailable_wpDataSource Class @102-7534990E

//DataSource Variables @102-73B2ADA3
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $SURL;
    var $WORKFLOW_NAME;
    var $INBOX;
    var $JUMLAH;
//End DataSource Variables

//DataSourceClass_Initialize Event @102-BE83CBDD
    function clsworkavailable_wpDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid workavailable_wp";
        $this->Initialize();
        $this->SURL = new clsField("SURL", ccsText, "");
        
        $this->WORKFLOW_NAME = new clsField("WORKFLOW_NAME", ccsText, "");
        
        $this->INBOX = new clsField("INBOX", ccsText, "");
        
        $this->JUMLAH = new clsField("JUMLAH", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @102-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @102-9D47D0E5
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr109", ccsText, "", "", $this->Parameters["expr109"], "", false);
    }
//End Prepare Method

//Open Method @102-43E3801E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select * from pack_task_profile.workflow_name_wp ('" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "')AS tbl(ty_task_profile)) cnt";
        $this->SQL = "select * from pack_task_profile.workflow_name_wp ('" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "')AS tbl(ty_task_profile)";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @102-7B2777E1
    function SetValues()
    {
        $this->SURL->SetDBValue($this->f("url"));
        $this->WORKFLOW_NAME->SetDBValue($this->f("profile_type"));
        $this->INBOX->SetDBValue($this->f("jumlah"));
        $this->JUMLAH->SetDBValue(trim($this->f("jumlah")));
    }
//End SetValues Method

} //End workavailable_wpDataSource Class @102-FCB6E20C

class clsGridHistoryGrid { //HistoryGrid class @2-8E77C6FA

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

//Class_Initialize Event @2-A0A0818D
    function clsGridHistoryGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "HistoryGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid HistoryGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsHistoryGridDataSource($this);
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

        $this->npwd = & new clsControl(ccsLabel, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", ccsGet, NULL), $this);
        $this->company_name = & new clsControl(ccsLabel, "company_name", "company_name", ccsText, "", CCGetRequestParam("company_name", ccsGet, NULL), $this);
        $this->periode_pelaporan = & new clsControl(ccsLabel, "periode_pelaporan", "periode_pelaporan", ccsText, "", CCGetRequestParam("periode_pelaporan", ccsGet, NULL), $this);
        $this->periode_awal_laporan = & new clsControl(ccsLabel, "periode_awal_laporan", "periode_awal_laporan", ccsText, "", CCGetRequestParam("periode_awal_laporan", ccsGet, NULL), $this);
        $this->tgl_pelaporan = & new clsControl(ccsLabel, "tgl_pelaporan", "tgl_pelaporan", ccsText, "", CCGetRequestParam("tgl_pelaporan", ccsGet, NULL), $this);
        $this->total_transaksi = & new clsControl(ccsLabel, "total_transaksi", "total_transaksi", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("total_transaksi", ccsGet, NULL), $this);
        $this->total_pajak = & new clsControl(ccsLabel, "total_pajak", "total_pajak", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("total_pajak", ccsGet, NULL), $this);
        $this->kuitansi_pembayaran = & new clsControl(ccsLabel, "kuitansi_pembayaran", "kuitansi_pembayaran", ccsText, "", CCGetRequestParam("kuitansi_pembayaran", ccsGet, NULL), $this);
        $this->tgl_pembayaran = & new clsControl(ccsLabel, "tgl_pembayaran", "tgl_pembayaran", ccsText, "", CCGetRequestParam("tgl_pembayaran", ccsGet, NULL), $this);
        $this->payment_amount = & new clsControl(ccsLabel, "payment_amount", "payment_amount", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("payment_amount", ccsGet, NULL), $this);
        $this->periode_akhir_laporan = & new clsControl(ccsLabel, "periode_akhir_laporan", "periode_akhir_laporan", ccsText, "", CCGetRequestParam("periode_akhir_laporan", ccsGet, NULL), $this);
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

//Show Method @2-D4AEBB3F
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr126"] = CCGetUserLogin();

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
            $this->ControlsVisible["npwd"] = $this->npwd->Visible;
            $this->ControlsVisible["company_name"] = $this->company_name->Visible;
            $this->ControlsVisible["periode_pelaporan"] = $this->periode_pelaporan->Visible;
            $this->ControlsVisible["periode_awal_laporan"] = $this->periode_awal_laporan->Visible;
            $this->ControlsVisible["tgl_pelaporan"] = $this->tgl_pelaporan->Visible;
            $this->ControlsVisible["total_transaksi"] = $this->total_transaksi->Visible;
            $this->ControlsVisible["total_pajak"] = $this->total_pajak->Visible;
            $this->ControlsVisible["kuitansi_pembayaran"] = $this->kuitansi_pembayaran->Visible;
            $this->ControlsVisible["tgl_pembayaran"] = $this->tgl_pembayaran->Visible;
            $this->ControlsVisible["payment_amount"] = $this->payment_amount->Visible;
            $this->ControlsVisible["periode_akhir_laporan"] = $this->periode_akhir_laporan->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                $this->company_name->SetValue($this->DataSource->company_name->GetValue());
                $this->periode_pelaporan->SetValue($this->DataSource->periode_pelaporan->GetValue());
                $this->periode_awal_laporan->SetValue($this->DataSource->periode_awal_laporan->GetValue());
                $this->tgl_pelaporan->SetValue($this->DataSource->tgl_pelaporan->GetValue());
                $this->total_transaksi->SetValue($this->DataSource->total_transaksi->GetValue());
                $this->total_pajak->SetValue($this->DataSource->total_pajak->GetValue());
                $this->kuitansi_pembayaran->SetValue($this->DataSource->kuitansi_pembayaran->GetValue());
                $this->tgl_pembayaran->SetValue($this->DataSource->tgl_pembayaran->GetValue());
                $this->payment_amount->SetValue($this->DataSource->payment_amount->GetValue());
                $this->periode_akhir_laporan->SetValue($this->DataSource->periode_akhir_laporan->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->npwd->Show();
                $this->company_name->Show();
                $this->periode_pelaporan->Show();
                $this->periode_awal_laporan->Show();
                $this->tgl_pelaporan->Show();
                $this->total_transaksi->Show();
                $this->total_pajak->Show();
                $this->kuitansi_pembayaran->Show();
                $this->tgl_pembayaran->Show();
                $this->payment_amount->Show();
                $this->periode_akhir_laporan->Show();
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

//GetErrors Method @2-2CF56164
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->npwd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->company_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->periode_pelaporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->periode_awal_laporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tgl_pelaporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_transaksi->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_pajak->Errors->ToString());
        $errors = ComposeStrings($errors, $this->kuitansi_pembayaran->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tgl_pembayaran->Errors->ToString());
        $errors = ComposeStrings($errors, $this->payment_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->periode_akhir_laporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End HistoryGrid Class @2-FCB6E20C

class clsHistoryGridDataSource extends clsDBConnSIKP {  //HistoryGridDataSource Class @2-7CE034AB

//DataSource Variables @2-85AE87B6
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $npwd;
    var $company_name;
    var $periode_pelaporan;
    var $periode_awal_laporan;
    var $tgl_pelaporan;
    var $total_transaksi;
    var $total_pajak;
    var $kuitansi_pembayaran;
    var $tgl_pembayaran;
    var $payment_amount;
    var $periode_akhir_laporan;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-EBB85F03
    function clsHistoryGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid HistoryGrid";
        $this->Initialize();
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->company_name = new clsField("company_name", ccsText, "");
        
        $this->periode_pelaporan = new clsField("periode_pelaporan", ccsText, "");
        
        $this->periode_awal_laporan = new clsField("periode_awal_laporan", ccsText, "");
        
        $this->tgl_pelaporan = new clsField("tgl_pelaporan", ccsText, "");
        
        $this->total_transaksi = new clsField("total_transaksi", ccsFloat, "");
        
        $this->total_pajak = new clsField("total_pajak", ccsFloat, "");
        
        $this->kuitansi_pembayaran = new clsField("kuitansi_pembayaran", ccsText, "");
        
        $this->tgl_pembayaran = new clsField("tgl_pembayaran", ccsText, "");
        
        $this->payment_amount = new clsField("payment_amount", ccsFloat, "");
        
        $this->periode_akhir_laporan = new clsField("periode_akhir_laporan", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-FE07BE04
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "c.npwd , b.start_date desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-55E38521
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr126", ccsText, "", "", $this->Parameters["expr126"], "", false);
    }
//End Prepare Method

//Open Method @2-8C75C15D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (Select c.npwd , \n" .
        "       c.company_name, \n" .
        "       b.code as Periode_pelaporan, \n" .
        "       to_char(a.settlement_date,'DD-MON-YYYY') tgl_pelaporan, \n" .
        "       a.total_trans_amount as total_transaksi,\n" .
        "       a.total_vat_amount as total_pajak ,\n" .
        "       d.receipt_no as kuitansi_pembayaran,\n" .
        "       to_char(payment_date,'DD-MON-YYYY HH24:MI:SS') tgl_pembayaran ,\n" .
        "       d.payment_amount,\n" .
        "       c.t_cust_account_id ,\n" .
        "       b.p_finance_period_id ,\n" .
        "       to_char(b.start_date,'DD-MON-YYYY') as periode_awal_laporan,\n" .
        "       to_char(b.end_date,'DD-MON-YYYY') as periode_akhir_laporan\n" .
        "from t_vat_setllement a ,\n" .
        "     p_finance_period b,\n" .
        "     t_cust_account c,\n" .
        "     t_payment_receipt d\n" .
        "where a.p_finance_period_id = b.p_finance_period_id\n" .
        "      and a.t_cust_account_id = c.t_cust_account_id\n" .
        "      and a.t_vat_setllement_id = d.t_vat_setllement_id (+) \n" .
        "      and c.t_customer_id in (select t_customer_id from t_customer_user where user_name = '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "' )) cnt";
        $this->SQL = "Select c.npwd , \n" .
        "       c.company_name, \n" .
        "       b.code as Periode_pelaporan, \n" .
        "       to_char(a.settlement_date,'DD-MON-YYYY') tgl_pelaporan, \n" .
        "       a.total_trans_amount as total_transaksi,\n" .
        "       a.total_vat_amount as total_pajak ,\n" .
        "       d.receipt_no as kuitansi_pembayaran,\n" .
        "       to_char(payment_date,'DD-MON-YYYY HH24:MI:SS') tgl_pembayaran ,\n" .
        "       d.payment_amount,\n" .
        "       c.t_cust_account_id ,\n" .
        "       b.p_finance_period_id ,\n" .
        "       to_char(b.start_date,'DD-MON-YYYY') as periode_awal_laporan,\n" .
        "       to_char(b.end_date,'DD-MON-YYYY') as periode_akhir_laporan\n" .
        "from t_vat_setllement a ,\n" .
        "     p_finance_period b,\n" .
        "     t_cust_account c,\n" .
        "     t_payment_receipt d\n" .
        "where a.p_finance_period_id = b.p_finance_period_id\n" .
        "      and a.t_cust_account_id = c.t_cust_account_id\n" .
        "      and a.t_vat_setllement_id = d.t_vat_setllement_id (+) \n" .
        "      and c.t_customer_id in (select t_customer_id from t_customer_user where user_name = '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "' ){SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-FE49655F
    function SetValues()
    {
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->company_name->SetDBValue($this->f("company_name"));
        $this->periode_pelaporan->SetDBValue($this->f("periode_pelaporan"));
        $this->periode_awal_laporan->SetDBValue($this->f("periode_awal_laporan"));
        $this->tgl_pelaporan->SetDBValue($this->f("tgl_pelaporan"));
        $this->total_transaksi->SetDBValue(trim($this->f("total_transaksi")));
        $this->total_pajak->SetDBValue(trim($this->f("total_pajak")));
        $this->kuitansi_pembayaran->SetDBValue($this->f("kuitansi_pembayaran"));
        $this->tgl_pembayaran->SetDBValue($this->f("tgl_pembayaran"));
        $this->payment_amount->SetDBValue(trim($this->f("payment_amount")));
        $this->periode_akhir_laporan->SetDBValue($this->f("periode_akhir_laporan"));
    }
//End SetValues Method

} //End HistoryGridDataSource Class @2-FCB6E20C

//Initialize Page @1-2204F1DF
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
$TemplateFileName = "sikp_home.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C2D84666
include_once("./sikp_home_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A824A2D1
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$workavailable = & new clsGridworkavailable("", $MainPage);
$workavailable_wp = & new clsGridworkavailable_wp("", $MainPage);
$HistoryGrid = & new clsGridHistoryGrid("", $MainPage);
$MainPage->workavailable = & $workavailable;
$MainPage->workavailable_wp = & $workavailable_wp;
$MainPage->HistoryGrid = & $HistoryGrid;
$workavailable->Initialize();
$workavailable_wp->Initialize();
$HistoryGrid->Initialize();

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

//Go to destination page @1-9C5604AF
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($workavailable);
    unset($workavailable_wp);
    unset($HistoryGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-8AA0A1F6
$workavailable->Show();
$workavailable_wp->Show();
$HistoryGrid->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-2466835D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($workavailable);
unset($workavailable_wp);
unset($HistoryGrid);
unset($Tpl);
//End Unload Page


?>
