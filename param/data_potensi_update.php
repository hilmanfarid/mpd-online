<?php
//Include Common Files @1-A6AEC584
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "data_potensi_update.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files





class clsGridt_vat_reg_dtl_restaurantGrid { //t_vat_reg_dtl_restaurantGrid class @688-A79EB431

//Variables @688-AC1EDBB9

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

//Class_Initialize Event @688-E4B6D470
    function clsGridt_vat_reg_dtl_restaurantGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_dtl_restaurantGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_dtl_restaurantGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_dtl_restaurantGridDataSource($this);
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

        $this->service_type_desc = & new clsControl(ccsLabel, "service_type_desc", "service_type_desc", ccsText, "", CCGetRequestParam("service_type_desc", ccsGet, NULL), $this);
        $this->t_cacc_dtl_restaurant_id = & new clsControl(ccsHidden, "t_cacc_dtl_restaurant_id", "t_cacc_dtl_restaurant_id", ccsFloat, "", CCGetRequestParam("t_cacc_dtl_restaurant_id", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "data_potensi_update.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "data_potensi_update.php";
        $this->seat_qty = & new clsControl(ccsLabel, "seat_qty", "seat_qty", ccsText, "", CCGetRequestParam("seat_qty", ccsGet, NULL), $this);
        $this->table_qty = & new clsControl(ccsLabel, "table_qty", "table_qty", ccsText, "", CCGetRequestParam("table_qty", ccsGet, NULL), $this);
        $this->max_service_qty = & new clsControl(ccsLabel, "max_service_qty", "max_service_qty", ccsText, "", CCGetRequestParam("max_service_qty", ccsGet, NULL), $this);
        $this->avg_subscription = & new clsControl(ccsLabel, "avg_subscription", "avg_subscription", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("avg_subscription", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->btn_update = & new clsControl(ccsLabel, "btn_update", "btn_update", ccsText, "", CCGetRequestParam("btn_update", ccsGet, NULL), $this);
        $this->btn_update->HTML = true;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link2 = & new clsControl(ccsLink, "Insert_Link2", "Insert_Link2", ccsText, "", CCGetRequestParam("Insert_Link2", ccsGet, NULL), $this);
        $this->Insert_Link2->Parameters = CCGetQueryString("QueryString", array("t_cacc_dtl_restaurant_id", "ccsForm"));
        $this->Insert_Link2->Page = "";
    }
//End Class_Initialize Event

//Initialize Method @688-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @688-EEA13519
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);

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
            $this->ControlsVisible["service_type_desc"] = $this->service_type_desc->Visible;
            $this->ControlsVisible["t_cacc_dtl_restaurant_id"] = $this->t_cacc_dtl_restaurant_id->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["seat_qty"] = $this->seat_qty->Visible;
            $this->ControlsVisible["table_qty"] = $this->table_qty->Visible;
            $this->ControlsVisible["max_service_qty"] = $this->max_service_qty->Visible;
            $this->ControlsVisible["avg_subscription"] = $this->avg_subscription->Visible;
            $this->ControlsVisible["t_cust_account_id"] = $this->t_cust_account_id->Visible;
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            $this->ControlsVisible["btn_update"] = $this->btn_update->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->service_type_desc->SetValue($this->DataSource->service_type_desc->GetValue());
                $this->t_cacc_dtl_restaurant_id->SetValue($this->DataSource->t_cacc_dtl_restaurant_id->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_cacc_dtl_restaurant_id", $this->DataSource->f("t_cacc_dtl_restaurant_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_cacc_dtl_restaurant_id", $this->DataSource->f("t_cacc_dtl_restaurant_id"));
                $this->seat_qty->SetValue($this->DataSource->seat_qty->GetValue());
                $this->table_qty->SetValue($this->DataSource->table_qty->GetValue());
                $this->max_service_qty->SetValue($this->DataSource->max_service_qty->GetValue());
                $this->avg_subscription->SetValue($this->DataSource->avg_subscription->GetValue());
                $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->service_type_desc->Show();
                $this->t_cacc_dtl_restaurant_id->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->seat_qty->Show();
                $this->table_qty->Show();
                $this->max_service_qty->Show();
                $this->avg_subscription->Show();
                $this->t_cust_account_id->Show();
                $this->valid_from->Show();
                $this->valid_to->Show();
                $this->btn_update->Show();
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
        $this->Insert_Link2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @688-09BFCA3D
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->service_type_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cacc_dtl_restaurant_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->seat_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->table_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->max_service_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->avg_subscription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_account_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->btn_update->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_dtl_restaurantGrid Class @688-FCB6E20C

class clst_vat_reg_dtl_restaurantGridDataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_restaurantGridDataSource Class @688-0A111FC1

//DataSource Variables @688-918E96DC
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $service_type_desc;
    var $t_cacc_dtl_restaurant_id;
    var $DLink;
    var $ADLink;
    var $seat_qty;
    var $table_qty;
    var $max_service_qty;
    var $avg_subscription;
    var $t_cust_account_id;
    var $valid_from;
    var $valid_to;
//End DataSource Variables

//DataSourceClass_Initialize Event @688-9E39BBBF
    function clst_vat_reg_dtl_restaurantGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_dtl_restaurantGrid";
        $this->Initialize();
        $this->service_type_desc = new clsField("service_type_desc", ccsText, "");
        
        $this->t_cacc_dtl_restaurant_id = new clsField("t_cacc_dtl_restaurant_id", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->seat_qty = new clsField("seat_qty", ccsText, "");
        
        $this->table_qty = new clsField("table_qty", ccsText, "");
        
        $this->max_service_qty = new clsField("max_service_qty", ccsText, "");
        
        $this->avg_subscription = new clsField("avg_subscription", ccsFloat, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @688-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @688-3E99123F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_account_id", ccsFloat, "", "", $this->Parameters["urlt_cust_account_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_cust_account_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @688-B129CEB5
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM t_cacc_dtl_restaurant";
        $this->SQL = "SELECT * \n\n" .
        "FROM t_cacc_dtl_restaurant {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @688-A66333BF
    function SetValues()
    {
        $this->service_type_desc->SetDBValue($this->f("service_type_desc"));
        $this->t_cacc_dtl_restaurant_id->SetDBValue(trim($this->f("t_cacc_dtl_restaurant_id")));
        $this->DLink->SetDBValue($this->f("t_cacc_dtl_restaurant_id"));
        $this->ADLink->SetDBValue($this->f("t_cacc_dtl_restaurant_id"));
        $this->seat_qty->SetDBValue($this->f("seat_qty"));
        $this->table_qty->SetDBValue($this->f("table_qty"));
        $this->max_service_qty->SetDBValue($this->f("max_service_qty"));
        $this->avg_subscription->SetDBValue(trim($this->f("avg_subscription")));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
    }
//End SetValues Method

} //End t_vat_reg_dtl_restaurantGridDataSource Class @688-FCB6E20C

class clsGridt_vat_reg_dtl_hotelGrid1 { //t_vat_reg_dtl_hotelGrid1 class @790-64BFECAD

//Variables @790-AC1EDBB9

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

//Class_Initialize Event @790-382B7CD9
    function clsGridt_vat_reg_dtl_hotelGrid1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_dtl_hotelGrid1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_dtl_hotelGrid1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_dtl_hotelGrid1DataSource($this);
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

        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "data_potensi_update.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "data_potensi_update.php";
        $this->room_type_code = & new clsControl(ccsLabel, "room_type_code", "room_type_code", ccsText, "", CCGetRequestParam("room_type_code", ccsGet, NULL), $this);
        $this->room_qty = & new clsControl(ccsLabel, "room_qty", "room_qty", ccsFloat, "", CCGetRequestParam("room_qty", ccsGet, NULL), $this);
        $this->service_qty = & new clsControl(ccsLabel, "service_qty", "service_qty", ccsFloat, "", CCGetRequestParam("service_qty", ccsGet, NULL), $this);
        $this->service_charge_wd = & new clsControl(ccsLabel, "service_charge_wd", "service_charge_wd", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge_wd", ccsGet, NULL), $this);
        $this->service_charge_we = & new clsControl(ccsLabel, "service_charge_we", "service_charge_we", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge_we", ccsGet, NULL), $this);
        $this->t_cacc_dtl_hotel_id = & new clsControl(ccsHidden, "t_cacc_dtl_hotel_id", "t_cacc_dtl_hotel_id", ccsFloat, "", CCGetRequestParam("t_cacc_dtl_hotel_id", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->btn_update = & new clsControl(ccsLabel, "btn_update", "btn_update", ccsText, "", CCGetRequestParam("btn_update", ccsGet, NULL), $this);
        $this->btn_update->HTML = true;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link2 = & new clsControl(ccsLink, "Insert_Link2", "Insert_Link2", ccsText, "", CCGetRequestParam("Insert_Link2", ccsGet, NULL), $this);
        $this->Insert_Link2->Parameters = CCGetQueryString("QueryString", array("t_cacc_dtl_hotel_id", "ccsForm"));
        $this->Insert_Link2->Page = "";
    }
//End Class_Initialize Event

//Initialize Method @790-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @790-94AA5683
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);

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
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["room_type_code"] = $this->room_type_code->Visible;
            $this->ControlsVisible["room_qty"] = $this->room_qty->Visible;
            $this->ControlsVisible["service_qty"] = $this->service_qty->Visible;
            $this->ControlsVisible["service_charge_wd"] = $this->service_charge_wd->Visible;
            $this->ControlsVisible["service_charge_we"] = $this->service_charge_we->Visible;
            $this->ControlsVisible["t_cacc_dtl_hotel_id"] = $this->t_cacc_dtl_hotel_id->Visible;
            $this->ControlsVisible["t_cust_account_id"] = $this->t_cust_account_id->Visible;
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            $this->ControlsVisible["btn_update"] = $this->btn_update->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_cacc_dtl_hotel_id", $this->DataSource->f("t_cacc_dtl_hotel_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_cacc_dtl_hotel_id", $this->DataSource->f("t_cacc_dtl_hotel_id"));
                $this->room_type_code->SetValue($this->DataSource->room_type_code->GetValue());
                $this->room_qty->SetValue($this->DataSource->room_qty->GetValue());
                $this->service_qty->SetValue($this->DataSource->service_qty->GetValue());
                $this->service_charge_wd->SetValue($this->DataSource->service_charge_wd->GetValue());
                $this->service_charge_we->SetValue($this->DataSource->service_charge_we->GetValue());
                $this->t_cacc_dtl_hotel_id->SetValue($this->DataSource->t_cacc_dtl_hotel_id->GetValue());
                $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->room_type_code->Show();
                $this->room_qty->Show();
                $this->service_qty->Show();
                $this->service_charge_wd->Show();
                $this->service_charge_we->Show();
                $this->t_cacc_dtl_hotel_id->Show();
                $this->t_cust_account_id->Show();
                $this->valid_from->Show();
                $this->valid_to->Show();
                $this->btn_update->Show();
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
        $this->Insert_Link2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @790-1DE340B7
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->room_type_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->room_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_charge_wd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_charge_we->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cacc_dtl_hotel_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_account_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->btn_update->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_dtl_hotelGrid1 Class @790-FCB6E20C

class clst_vat_reg_dtl_hotelGrid1DataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_hotelGrid1DataSource Class @790-5809D861

//DataSource Variables @790-3DB8EB9D
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $DLink;
    var $ADLink;
    var $room_type_code;
    var $room_qty;
    var $service_qty;
    var $service_charge_wd;
    var $service_charge_we;
    var $t_cacc_dtl_hotel_id;
    var $t_cust_account_id;
    var $valid_from;
    var $valid_to;
//End DataSource Variables

//DataSourceClass_Initialize Event @790-983D0B38
    function clst_vat_reg_dtl_hotelGrid1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_dtl_hotelGrid1";
        $this->Initialize();
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->room_type_code = new clsField("room_type_code", ccsText, "");
        
        $this->room_qty = new clsField("room_qty", ccsFloat, "");
        
        $this->service_qty = new clsField("service_qty", ccsFloat, "");
        
        $this->service_charge_wd = new clsField("service_charge_wd", ccsFloat, "");
        
        $this->service_charge_we = new clsField("service_charge_we", ccsFloat, "");
        
        $this->t_cacc_dtl_hotel_id = new clsField("t_cacc_dtl_hotel_id", ccsFloat, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @790-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @790-75050C29
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_account_id", ccsFloat, "", "", $this->Parameters["urlt_cust_account_id"], "", false);
    }
//End Prepare Method

//Open Method @790-05A68714
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT t_cacc_dtl_hotel_id, t_cust_account_id, a.p_room_type_id, room_qty, service_qty, service_charge_wd, service_charge_we,\n" .
        "valid_from, valid_to, a.description, a.creation_date, a.created_by,\n" .
        "a.updated_date , a.updated_by, b.code AS room_type_code \n" .
        "FROM t_cacc_dtl_hotel a INNER JOIN p_room_type b ON\n" .
        "a.p_room_type_id = b.p_room_type_id\n" .
        "WHERE a.t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ) cnt";
        $this->SQL = "SELECT t_cacc_dtl_hotel_id, t_cust_account_id, a.p_room_type_id, room_qty, service_qty, service_charge_wd, service_charge_we,\n" .
        "valid_from, valid_to, a.description, a.creation_date, a.created_by,\n" .
        "a.updated_date , a.updated_by, b.code AS room_type_code \n" .
        "FROM t_cacc_dtl_hotel a INNER JOIN p_room_type b ON\n" .
        "a.p_room_type_id = b.p_room_type_id\n" .
        "WHERE a.t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @790-B515D8E7
    function SetValues()
    {
        $this->DLink->SetDBValue($this->f("t_cacc_dtl_hotel_id"));
        $this->ADLink->SetDBValue($this->f("t_cacc_dtl_hotel_id"));
        $this->room_type_code->SetDBValue($this->f("room_type_code"));
        $this->room_qty->SetDBValue(trim($this->f("room_qty")));
        $this->service_qty->SetDBValue(trim($this->f("service_qty")));
        $this->service_charge_wd->SetDBValue(trim($this->f("service_charge_wd")));
        $this->service_charge_we->SetDBValue(trim($this->f("service_charge_we")));
        $this->t_cacc_dtl_hotel_id->SetDBValue(trim($this->f("t_cacc_dtl_hotel_id")));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
    }
//End SetValues Method

} //End t_vat_reg_dtl_hotelGrid1DataSource Class @790-FCB6E20C

class clsGridv_vat_reg_dtl_entertaintmentGrid { //v_vat_reg_dtl_entertaintmentGrid class @814-E9C1D9DE

//Variables @814-AC1EDBB9

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

//Class_Initialize Event @814-9C3BFEC1
    function clsGridv_vat_reg_dtl_entertaintmentGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "v_vat_reg_dtl_entertaintmentGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid v_vat_reg_dtl_entertaintmentGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsv_vat_reg_dtl_entertaintmentGridDataSource($this);
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

        $this->entertainment_desc = & new clsControl(ccsLabel, "entertainment_desc", "entertainment_desc", ccsText, "", CCGetRequestParam("entertainment_desc", ccsGet, NULL), $this);
        $this->t_cacc_dtl_entertaintment_id = & new clsControl(ccsHidden, "t_cacc_dtl_entertaintment_id", "t_cacc_dtl_entertaintment_id", ccsFloat, "", CCGetRequestParam("t_cacc_dtl_entertaintment_id", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "data_potensi_update.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "data_potensi_update.php";
        $this->service_charge_wd = & new clsControl(ccsLabel, "service_charge_wd", "service_charge_wd", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge_wd", ccsGet, NULL), $this);
        $this->clerk_qty = & new clsControl(ccsLabel, "clerk_qty", "clerk_qty", ccsText, "", CCGetRequestParam("clerk_qty", ccsGet, NULL), $this);
        $this->booking_hour = & new clsControl(ccsLabel, "booking_hour", "booking_hour", ccsText, "", CCGetRequestParam("booking_hour", ccsGet, NULL), $this);
        $this->f_and_b = & new clsControl(ccsLabel, "f_and_b", "f_and_b", ccsText, "", CCGetRequestParam("f_and_b", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->seat_qty = & new clsControl(ccsLabel, "seat_qty", "seat_qty", ccsText, "", CCGetRequestParam("seat_qty", ccsGet, NULL), $this);
        $this->portion_person = & new clsControl(ccsLabel, "portion_person", "portion_person", ccsText, "", CCGetRequestParam("portion_person", ccsGet, NULL), $this);
        $this->room_qty = & new clsControl(ccsLabel, "room_qty", "room_qty", ccsText, "", CCGetRequestParam("room_qty", ccsGet, NULL), $this);
        $this->service_charge_we = & new clsControl(ccsLabel, "service_charge_we", "service_charge_we", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge_we", ccsGet, NULL), $this);
        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->btn_update = & new clsControl(ccsLabel, "btn_update", "btn_update", ccsText, "", CCGetRequestParam("btn_update", ccsGet, NULL), $this);
        $this->btn_update->HTML = true;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link2 = & new clsControl(ccsLink, "Insert_Link2", "Insert_Link2", ccsText, "", CCGetRequestParam("Insert_Link2", ccsGet, NULL), $this);
        $this->Insert_Link2->Parameters = CCGetQueryString("QueryString", array("t_cacc_dtl_entertaintment_id", "ccsForm"));
        $this->Insert_Link2->Page = "";
    }
//End Class_Initialize Event

//Initialize Method @814-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @814-A93E2AC5
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);

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
            $this->ControlsVisible["entertainment_desc"] = $this->entertainment_desc->Visible;
            $this->ControlsVisible["t_cacc_dtl_entertaintment_id"] = $this->t_cacc_dtl_entertaintment_id->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["service_charge_wd"] = $this->service_charge_wd->Visible;
            $this->ControlsVisible["clerk_qty"] = $this->clerk_qty->Visible;
            $this->ControlsVisible["booking_hour"] = $this->booking_hour->Visible;
            $this->ControlsVisible["f_and_b"] = $this->f_and_b->Visible;
            $this->ControlsVisible["t_cust_account_id"] = $this->t_cust_account_id->Visible;
            $this->ControlsVisible["seat_qty"] = $this->seat_qty->Visible;
            $this->ControlsVisible["portion_person"] = $this->portion_person->Visible;
            $this->ControlsVisible["room_qty"] = $this->room_qty->Visible;
            $this->ControlsVisible["service_charge_we"] = $this->service_charge_we->Visible;
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            $this->ControlsVisible["btn_update"] = $this->btn_update->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->entertainment_desc->SetValue($this->DataSource->entertainment_desc->GetValue());
                $this->t_cacc_dtl_entertaintment_id->SetValue($this->DataSource->t_cacc_dtl_entertaintment_id->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_cacc_dtl_entertaintment_id", $this->DataSource->f("t_cacc_dtl_entertaintment_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_cacc_dtl_entertaintment_id", $this->DataSource->f("t_cacc_dtl_entertaintment_id"));
                $this->service_charge_wd->SetValue($this->DataSource->service_charge_wd->GetValue());
                $this->clerk_qty->SetValue($this->DataSource->clerk_qty->GetValue());
                $this->booking_hour->SetValue($this->DataSource->booking_hour->GetValue());
                $this->f_and_b->SetValue($this->DataSource->f_and_b->GetValue());
                $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                $this->seat_qty->SetValue($this->DataSource->seat_qty->GetValue());
                $this->portion_person->SetValue($this->DataSource->portion_person->GetValue());
                $this->room_qty->SetValue($this->DataSource->room_qty->GetValue());
                $this->service_charge_we->SetValue($this->DataSource->service_charge_we->GetValue());
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->entertainment_desc->Show();
                $this->t_cacc_dtl_entertaintment_id->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->service_charge_wd->Show();
                $this->clerk_qty->Show();
                $this->booking_hour->Show();
                $this->f_and_b->Show();
                $this->t_cust_account_id->Show();
                $this->seat_qty->Show();
                $this->portion_person->Show();
                $this->room_qty->Show();
                $this->service_charge_we->Show();
                $this->valid_from->Show();
                $this->valid_to->Show();
                $this->btn_update->Show();
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
        $this->Insert_Link2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @814-A5AC3397
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->entertainment_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cacc_dtl_entertaintment_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_charge_wd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->clerk_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->booking_hour->Errors->ToString());
        $errors = ComposeStrings($errors, $this->f_and_b->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_account_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->seat_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->portion_person->Errors->ToString());
        $errors = ComposeStrings($errors, $this->room_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_charge_we->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->btn_update->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End v_vat_reg_dtl_entertaintmentGrid Class @814-FCB6E20C

class clsv_vat_reg_dtl_entertaintmentGridDataSource extends clsDBConnSIKP {  //v_vat_reg_dtl_entertaintmentGridDataSource Class @814-1BA53B61

//DataSource Variables @814-AE1063B0
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $entertainment_desc;
    var $t_cacc_dtl_entertaintment_id;
    var $DLink;
    var $ADLink;
    var $service_charge_wd;
    var $clerk_qty;
    var $booking_hour;
    var $f_and_b;
    var $t_cust_account_id;
    var $seat_qty;
    var $portion_person;
    var $room_qty;
    var $service_charge_we;
    var $valid_from;
    var $valid_to;
//End DataSource Variables

//DataSourceClass_Initialize Event @814-04B74096
    function clsv_vat_reg_dtl_entertaintmentGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid v_vat_reg_dtl_entertaintmentGrid";
        $this->Initialize();
        $this->entertainment_desc = new clsField("entertainment_desc", ccsText, "");
        
        $this->t_cacc_dtl_entertaintment_id = new clsField("t_cacc_dtl_entertaintment_id", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->service_charge_wd = new clsField("service_charge_wd", ccsFloat, "");
        
        $this->clerk_qty = new clsField("clerk_qty", ccsText, "");
        
        $this->booking_hour = new clsField("booking_hour", ccsText, "");
        
        $this->f_and_b = new clsField("f_and_b", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->seat_qty = new clsField("seat_qty", ccsText, "");
        
        $this->portion_person = new clsField("portion_person", ccsText, "");
        
        $this->room_qty = new clsField("room_qty", ccsText, "");
        
        $this->service_charge_we = new clsField("service_charge_we", ccsFloat, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @814-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @814-3E99123F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_account_id", ccsFloat, "", "", $this->Parameters["urlt_cust_account_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_cust_account_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @814-1624827D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM t_cacc_dtl_entertaintment";
        $this->SQL = "SELECT * \n\n" .
        "FROM t_cacc_dtl_entertaintment {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @814-4BF8AFD4
    function SetValues()
    {
        $this->entertainment_desc->SetDBValue($this->f("entertainment_desc"));
        $this->t_cacc_dtl_entertaintment_id->SetDBValue(trim($this->f("t_cacc_dtl_entertaintment_id")));
        $this->DLink->SetDBValue($this->f("t_cacc_dtl_entertaintment_id"));
        $this->ADLink->SetDBValue($this->f("t_cacc_dtl_entertaintment_id"));
        $this->service_charge_wd->SetDBValue(trim($this->f("service_charge_wd")));
        $this->clerk_qty->SetDBValue($this->f("clerk_qty"));
        $this->booking_hour->SetDBValue($this->f("booking_hour"));
        $this->f_and_b->SetDBValue($this->f("f_and_b"));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->seat_qty->SetDBValue($this->f("seat_qty"));
        $this->portion_person->SetDBValue($this->f("portion_person"));
        $this->room_qty->SetDBValue($this->f("room_qty"));
        $this->service_charge_we->SetDBValue(trim($this->f("service_charge_we")));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
    }
//End SetValues Method

} //End v_vat_reg_dtl_entertaintmentGridDataSource Class @814-FCB6E20C

class clsGridt_vat_reg_dtl_parkingGrid { //t_vat_reg_dtl_parkingGrid class @838-C5C035E2

//Variables @838-AC1EDBB9

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

//Class_Initialize Event @838-1864A814
    function clsGridt_vat_reg_dtl_parkingGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_dtl_parkingGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_dtl_parkingGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_dtl_parkingGridDataSource($this);
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

        $this->classification_desc = & new clsControl(ccsLabel, "classification_desc", "classification_desc", ccsText, "", CCGetRequestParam("classification_desc", ccsGet, NULL), $this);
        $this->t_acc_dtl_parking_id = & new clsControl(ccsHidden, "t_acc_dtl_parking_id", "t_acc_dtl_parking_id", ccsFloat, "", CCGetRequestParam("t_acc_dtl_parking_id", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "data_potensi_update.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "data_potensi_update.php";
        $this->parking_size = & new clsControl(ccsLabel, "parking_size", "parking_size", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("parking_size", ccsGet, NULL), $this);
        $this->max_load_qty = & new clsControl(ccsLabel, "max_load_qty", "max_load_qty", ccsText, "", CCGetRequestParam("max_load_qty", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->avg_subscription_qty = & new clsControl(ccsLabel, "avg_subscription_qty", "avg_subscription_qty", ccsText, "", CCGetRequestParam("avg_subscription_qty", ccsGet, NULL), $this);
        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->btn_update = & new clsControl(ccsLabel, "btn_update", "btn_update", ccsText, "", CCGetRequestParam("btn_update", ccsGet, NULL), $this);
        $this->btn_update->HTML = true;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link2 = & new clsControl(ccsLink, "Insert_Link2", "Insert_Link2", ccsText, "", CCGetRequestParam("Insert_Link2", ccsGet, NULL), $this);
        $this->Insert_Link2->Parameters = CCGetQueryString("QueryString", array("t_acc_dtl_parking_id", "ccsForm"));
        $this->Insert_Link2->Page = "";
    }
//End Class_Initialize Event

//Initialize Method @838-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @838-7569BC41
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);

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
            $this->ControlsVisible["classification_desc"] = $this->classification_desc->Visible;
            $this->ControlsVisible["t_acc_dtl_parking_id"] = $this->t_acc_dtl_parking_id->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["parking_size"] = $this->parking_size->Visible;
            $this->ControlsVisible["max_load_qty"] = $this->max_load_qty->Visible;
            $this->ControlsVisible["t_cust_account_id"] = $this->t_cust_account_id->Visible;
            $this->ControlsVisible["avg_subscription_qty"] = $this->avg_subscription_qty->Visible;
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            $this->ControlsVisible["btn_update"] = $this->btn_update->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->classification_desc->SetValue($this->DataSource->classification_desc->GetValue());
                $this->t_acc_dtl_parking_id->SetValue($this->DataSource->t_acc_dtl_parking_id->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_acc_dtl_parking_id", $this->DataSource->f("t_acc_dtl_parking_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_acc_dtl_parking_id", $this->DataSource->f("t_acc_dtl_parking_id"));
                $this->parking_size->SetValue($this->DataSource->parking_size->GetValue());
                $this->max_load_qty->SetValue($this->DataSource->max_load_qty->GetValue());
                $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                $this->avg_subscription_qty->SetValue($this->DataSource->avg_subscription_qty->GetValue());
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->classification_desc->Show();
                $this->t_acc_dtl_parking_id->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->parking_size->Show();
                $this->max_load_qty->Show();
                $this->t_cust_account_id->Show();
                $this->avg_subscription_qty->Show();
                $this->valid_from->Show();
                $this->valid_to->Show();
                $this->btn_update->Show();
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
        $this->Insert_Link2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @838-D03F52E2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->classification_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_acc_dtl_parking_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->parking_size->Errors->ToString());
        $errors = ComposeStrings($errors, $this->max_load_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_account_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->avg_subscription_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->btn_update->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_dtl_parkingGrid Class @838-FCB6E20C

class clst_vat_reg_dtl_parkingGridDataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_parkingGridDataSource Class @838-5B68347C

//DataSource Variables @838-AAE02A5A
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $classification_desc;
    var $t_acc_dtl_parking_id;
    var $DLink;
    var $ADLink;
    var $parking_size;
    var $max_load_qty;
    var $t_cust_account_id;
    var $avg_subscription_qty;
    var $valid_from;
    var $valid_to;
//End DataSource Variables

//DataSourceClass_Initialize Event @838-7FA13F48
    function clst_vat_reg_dtl_parkingGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_dtl_parkingGrid";
        $this->Initialize();
        $this->classification_desc = new clsField("classification_desc", ccsText, "");
        
        $this->t_acc_dtl_parking_id = new clsField("t_acc_dtl_parking_id", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->parking_size = new clsField("parking_size", ccsFloat, "");
        
        $this->max_load_qty = new clsField("max_load_qty", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->avg_subscription_qty = new clsField("avg_subscription_qty", ccsText, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @838-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @838-3E99123F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_account_id", ccsFloat, "", "", $this->Parameters["urlt_cust_account_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_cust_account_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @838-2B3F9AB6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM t_acc_dtl_parking";
        $this->SQL = "SELECT * \n\n" .
        "FROM t_acc_dtl_parking {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @838-081B7EC3
    function SetValues()
    {
        $this->classification_desc->SetDBValue($this->f("classification_desc"));
        $this->t_acc_dtl_parking_id->SetDBValue(trim($this->f("t_acc_dtl_parking_id")));
        $this->DLink->SetDBValue($this->f("t_acc_dtl_parking_id"));
        $this->ADLink->SetDBValue($this->f("t_acc_dtl_parking_id"));
        $this->parking_size->SetDBValue(trim($this->f("parking_size")));
        $this->max_load_qty->SetDBValue($this->f("max_load_qty"));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->avg_subscription_qty->SetDBValue($this->f("avg_subscription_qty"));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
    }
//End SetValues Method

} //End t_vat_reg_dtl_parkingGridDataSource Class @838-FCB6E20C

class clsGridt_vat_reg_dtl_ppjGrid { //t_vat_reg_dtl_ppjGrid class @862-DF1AAD2C

//Variables @862-AC1EDBB9

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

//Class_Initialize Event @862-CE487653
    function clsGridt_vat_reg_dtl_ppjGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_dtl_ppjGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_dtl_ppjGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_dtl_ppjGridDataSource($this);
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

        $this->pwr_classification_desc = & new clsControl(ccsLabel, "pwr_classification_desc", "pwr_classification_desc", ccsText, "", CCGetRequestParam("pwr_classification_desc", ccsGet, NULL), $this);
        $this->t_cacc_dtl_ppj_id = & new clsControl(ccsHidden, "t_cacc_dtl_ppj_id", "t_cacc_dtl_ppj_id", ccsFloat, "", CCGetRequestParam("t_cacc_dtl_ppj_id", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "data_potensi_update.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "data_potensi_update.php";
        $this->power_capacity = & new clsControl(ccsLabel, "power_capacity", "power_capacity", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("power_capacity", ccsGet, NULL), $this);
        $this->service_charge = & new clsControl(ccsLabel, "service_charge", "service_charge", ccsText, "", CCGetRequestParam("service_charge", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->power_factor = & new clsControl(ccsLabel, "power_factor", "power_factor", ccsText, "", CCGetRequestParam("power_factor", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->btn_update = & new clsControl(ccsLabel, "btn_update", "btn_update", ccsText, "", CCGetRequestParam("btn_update", ccsGet, NULL), $this);
        $this->btn_update->HTML = true;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link2 = & new clsControl(ccsLink, "Insert_Link2", "Insert_Link2", ccsText, "", CCGetRequestParam("Insert_Link2", ccsGet, NULL), $this);
        $this->Insert_Link2->Parameters = CCGetQueryString("QueryString", array("t_cacc_dtl_ppj_id", "ccsForm"));
        $this->Insert_Link2->Page = "";
    }
//End Class_Initialize Event

//Initialize Method @862-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @862-56DAF1EE
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);
        $this->DataSource->Parameters["expr976"] = Y;

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
            $this->ControlsVisible["pwr_classification_desc"] = $this->pwr_classification_desc->Visible;
            $this->ControlsVisible["t_cacc_dtl_ppj_id"] = $this->t_cacc_dtl_ppj_id->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["power_capacity"] = $this->power_capacity->Visible;
            $this->ControlsVisible["service_charge"] = $this->service_charge->Visible;
            $this->ControlsVisible["t_cust_account_id"] = $this->t_cust_account_id->Visible;
            $this->ControlsVisible["power_factor"] = $this->power_factor->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            $this->ControlsVisible["btn_update"] = $this->btn_update->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->pwr_classification_desc->SetValue($this->DataSource->pwr_classification_desc->GetValue());
                $this->t_cacc_dtl_ppj_id->SetValue($this->DataSource->t_cacc_dtl_ppj_id->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_cacc_dtl_ppj_id", $this->DataSource->f("t_cacc_dtl_ppj_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_cacc_dtl_ppj_id", $this->DataSource->f("t_cacc_dtl_ppj_id"));
                $this->power_capacity->SetValue($this->DataSource->power_capacity->GetValue());
                $this->service_charge->SetValue($this->DataSource->service_charge->GetValue());
                $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                $this->power_factor->SetValue($this->DataSource->power_factor->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->pwr_classification_desc->Show();
                $this->t_cacc_dtl_ppj_id->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->power_capacity->Show();
                $this->service_charge->Show();
                $this->t_cust_account_id->Show();
                $this->power_factor->Show();
                $this->description->Show();
                $this->valid_from->Show();
                $this->valid_to->Show();
                $this->btn_update->Show();
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
        $this->Insert_Link2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @862-B2595347
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->pwr_classification_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cacc_dtl_ppj_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->power_capacity->Errors->ToString());
        $errors = ComposeStrings($errors, $this->service_charge->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_account_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->power_factor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->btn_update->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_dtl_ppjGrid Class @862-FCB6E20C

class clst_vat_reg_dtl_ppjGridDataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_ppjGridDataSource Class @862-26AC7690

//DataSource Variables @862-A4975004
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $pwr_classification_desc;
    var $t_cacc_dtl_ppj_id;
    var $DLink;
    var $ADLink;
    var $power_capacity;
    var $service_charge;
    var $t_cust_account_id;
    var $power_factor;
    var $description;
    var $valid_from;
    var $valid_to;
//End DataSource Variables

//DataSourceClass_Initialize Event @862-05CB19AD
    function clst_vat_reg_dtl_ppjGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_dtl_ppjGrid";
        $this->Initialize();
        $this->pwr_classification_desc = new clsField("pwr_classification_desc", ccsText, "");
        
        $this->t_cacc_dtl_ppj_id = new clsField("t_cacc_dtl_ppj_id", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->power_capacity = new clsField("power_capacity", ccsFloat, "");
        
        $this->service_charge = new clsField("service_charge", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->power_factor = new clsField("power_factor", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @862-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @862-50B737DA
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_account_id", ccsFloat, "", "", $this->Parameters["urlt_cust_account_id"], "", false);
        $this->wp->AddParameter("2", "expr976", ccsText, "", "", $this->Parameters["expr976"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_cust_account_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "is_pln", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @862-A96F5B05
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM t_cacc_dtl_ppj";
        $this->SQL = "SELECT * \n\n" .
        "FROM t_cacc_dtl_ppj {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @862-8952BED6
    function SetValues()
    {
        $this->pwr_classification_desc->SetDBValue($this->f("pwr_classification_desc"));
        $this->t_cacc_dtl_ppj_id->SetDBValue(trim($this->f("t_cacc_dtl_ppj_id")));
        $this->DLink->SetDBValue($this->f("t_cacc_dtl_ppj_id"));
        $this->ADLink->SetDBValue($this->f("t_cacc_dtl_ppj_id"));
        $this->power_capacity->SetDBValue(trim($this->f("power_capacity")));
        $this->service_charge->SetDBValue($this->f("service_charge"));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->power_factor->SetDBValue($this->f("power_factor"));
        $this->description->SetDBValue($this->f("description"));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
    }
//End SetValues Method

} //End t_vat_reg_dtl_ppjGridDataSource Class @862-FCB6E20C

class clsGridt_vat_reg_dtl_ppj_nplGrid { //t_vat_reg_dtl_ppj_nplGrid class @896-BAFF6062

//Variables @896-AC1EDBB9

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

//Class_Initialize Event @896-67BEFC98
    function clsGridt_vat_reg_dtl_ppj_nplGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_dtl_ppj_nplGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_dtl_ppj_nplGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_dtl_ppj_nplGridDataSource($this);
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

        $this->owner_qty = & new clsControl(ccsLabel, "owner_qty", "owner_qty", ccsText, "", CCGetRequestParam("owner_qty", ccsGet, NULL), $this);
        $this->t_cacc_dtl_ppj_pln_id = & new clsControl(ccsHidden, "t_cacc_dtl_ppj_pln_id", "t_cacc_dtl_ppj_pln_id", ccsFloat, "", CCGetRequestParam("t_cacc_dtl_ppj_pln_id", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "data_potensi_update.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "data_potensi_update.php";
        $this->power_capacity = & new clsControl(ccsLabel, "power_capacity", "power_capacity", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("power_capacity", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->btn_update = & new clsControl(ccsLabel, "btn_update", "btn_update", ccsText, "", CCGetRequestParam("btn_update", ccsGet, NULL), $this);
        $this->btn_update->HTML = true;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link2 = & new clsControl(ccsLink, "Insert_Link2", "Insert_Link2", ccsText, "", CCGetRequestParam("Insert_Link2", ccsGet, NULL), $this);
        $this->Insert_Link2->Parameters = CCGetQueryString("QueryString", array("t_cacc_dtl_ppj_pln_id", "ccsForm"));
        $this->Insert_Link2->Page = "";
    }
//End Class_Initialize Event

//Initialize Method @896-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @896-5E55AF99
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);

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
            $this->ControlsVisible["owner_qty"] = $this->owner_qty->Visible;
            $this->ControlsVisible["t_cacc_dtl_ppj_pln_id"] = $this->t_cacc_dtl_ppj_pln_id->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["power_capacity"] = $this->power_capacity->Visible;
            $this->ControlsVisible["t_cust_account_id"] = $this->t_cust_account_id->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["btn_update"] = $this->btn_update->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->owner_qty->SetValue($this->DataSource->owner_qty->GetValue());
                $this->t_cacc_dtl_ppj_pln_id->SetValue($this->DataSource->t_cacc_dtl_ppj_pln_id->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_cacc_dtl_ppj_pln_id", $this->DataSource->f("t_cacc_dtl_ppj_pln_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_cacc_dtl_ppj_pln_id", $this->DataSource->f("t_cacc_dtl_ppj_pln_id"));
                $this->power_capacity->SetValue($this->DataSource->power_capacity->GetValue());
                $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->owner_qty->Show();
                $this->t_cacc_dtl_ppj_pln_id->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->power_capacity->Show();
                $this->t_cust_account_id->Show();
                $this->description->Show();
                $this->valid_to->Show();
                $this->valid_from->Show();
                $this->btn_update->Show();
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
        $this->Insert_Link2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @896-C53C4792
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->owner_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cacc_dtl_ppj_pln_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->power_capacity->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_account_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->btn_update->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_dtl_ppj_nplGrid Class @896-FCB6E20C

class clst_vat_reg_dtl_ppj_nplGridDataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_ppj_nplGridDataSource Class @896-DAD47FE4

//DataSource Variables @896-BD06A99A
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $owner_qty;
    var $t_cacc_dtl_ppj_pln_id;
    var $DLink;
    var $ADLink;
    var $power_capacity;
    var $t_cust_account_id;
    var $description;
    var $valid_to;
    var $valid_from;
//End DataSource Variables

//DataSourceClass_Initialize Event @896-DEB99B8D
    function clst_vat_reg_dtl_ppj_nplGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_dtl_ppj_nplGrid";
        $this->Initialize();
        $this->owner_qty = new clsField("owner_qty", ccsText, "");
        
        $this->t_cacc_dtl_ppj_pln_id = new clsField("t_cacc_dtl_ppj_pln_id", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->power_capacity = new clsField("power_capacity", ccsFloat, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @896-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @896-43315469
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_account_id", ccsFloat, "", "", $this->Parameters["urlt_cust_account_id"], 0, false);
    }
//End Prepare Method

//Open Method @896-B5274008
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT t_cacc_dtl_ppj_id AS t_cacc_dtl_ppj_pln_id, t_cust_account_id, is_pln, p_pwr_classification_id, pwr_classification_desc, power_capacity, power_factor,\n" .
        "service_charge, valid_from, valid_to, description, creation_date, created_by, updated_date, updated_by, owner_qty \n" .
        "FROM t_cacc_dtl_ppj\n" .
        "WHERE  t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "\n" .
        "AND is_pln = 'N' ) cnt";
        $this->SQL = "SELECT t_cacc_dtl_ppj_id AS t_cacc_dtl_ppj_pln_id, t_cust_account_id, is_pln, p_pwr_classification_id, pwr_classification_desc, power_capacity, power_factor,\n" .
        "service_charge, valid_from, valid_to, description, creation_date, created_by, updated_date, updated_by, owner_qty \n" .
        "FROM t_cacc_dtl_ppj\n" .
        "WHERE  t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "\n" .
        "AND is_pln = 'N' ";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @896-1E4D75E8
    function SetValues()
    {
        $this->owner_qty->SetDBValue($this->f("owner_qty"));
        $this->t_cacc_dtl_ppj_pln_id->SetDBValue(trim($this->f("t_cacc_dtl_ppj_pln_id")));
        $this->DLink->SetDBValue($this->f("t_cacc_dtl_ppj_pln_id"));
        $this->ADLink->SetDBValue($this->f("t_cacc_dtl_ppj_pln_id"));
        $this->power_capacity->SetDBValue(trim($this->f("power_capacity")));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
        $this->valid_from->SetDBValue($this->f("valid_from"));
    }
//End SetValues Method

} //End t_vat_reg_dtl_ppj_nplGridDataSource Class @896-FCB6E20C

class clsGridt_vat_reg_dtl_hotel_srvcGrid { //t_vat_reg_dtl_hotel_srvcGrid class @915-804C3727

//Variables @915-AC1EDBB9

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

//Class_Initialize Event @915-372A58EE
    function clsGridt_vat_reg_dtl_hotel_srvcGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_dtl_hotel_srvcGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_dtl_hotel_srvcGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_dtl_hotel_srvcGridDataSource($this);
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

        $this->services = & new clsControl(ccsLabel, "services", "services", ccsText, "", CCGetRequestParam("services", ccsGet, NULL), $this);
        $this->t_cacc_dtl_hotel_srvc_id = & new clsControl(ccsHidden, "t_cacc_dtl_hotel_srvc_id", "t_cacc_dtl_hotel_srvc_id", ccsFloat, "", CCGetRequestParam("t_cacc_dtl_hotel_srvc_id", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "data_potensi_update.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "data_potensi_update.php";
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->btn_update = & new clsControl(ccsLabel, "btn_update", "btn_update", ccsText, "", CCGetRequestParam("btn_update", ccsGet, NULL), $this);
        $this->btn_update->HTML = true;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link2 = & new clsControl(ccsLink, "Insert_Link2", "Insert_Link2", ccsText, "", CCGetRequestParam("Insert_Link2", ccsGet, NULL), $this);
        $this->Insert_Link2->Parameters = CCGetQueryString("QueryString", array("t_cacc_dtl_hotel_srvc_id", "ccsForm"));
        $this->Insert_Link2->Page = "";
    }
//End Class_Initialize Event

//Initialize Method @915-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @915-6775E57A
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);

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
            $this->ControlsVisible["services"] = $this->services->Visible;
            $this->ControlsVisible["t_cacc_dtl_hotel_srvc_id"] = $this->t_cacc_dtl_hotel_srvc_id->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["t_cust_account_id"] = $this->t_cust_account_id->Visible;
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["btn_update"] = $this->btn_update->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->services->SetValue($this->DataSource->services->GetValue());
                $this->t_cacc_dtl_hotel_srvc_id->SetValue($this->DataSource->t_cacc_dtl_hotel_srvc_id->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_cacc_dtl_hotel_srvc_id", $this->DataSource->f("t_cacc_dtl_hotel_srvc_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_cacc_dtl_hotel_srvc_id", $this->DataSource->f("t_cacc_dtl_hotel_srvc_id"));
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->services->Show();
                $this->t_cacc_dtl_hotel_srvc_id->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->description->Show();
                $this->t_cust_account_id->Show();
                $this->valid_to->Show();
                $this->valid_from->Show();
                $this->btn_update->Show();
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
        $this->Insert_Link2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @915-5CA0A7AC
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->services->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cacc_dtl_hotel_srvc_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_account_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->btn_update->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_dtl_hotel_srvcGrid Class @915-FCB6E20C

class clst_vat_reg_dtl_hotel_srvcGridDataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_hotel_srvcGridDataSource Class @915-7A5C8D37

//DataSource Variables @915-89814C0C
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $services;
    var $t_cacc_dtl_hotel_srvc_id;
    var $DLink;
    var $ADLink;
    var $description;
    var $t_cust_account_id;
    var $valid_to;
    var $valid_from;
//End DataSource Variables

//DataSourceClass_Initialize Event @915-A73C3985
    function clst_vat_reg_dtl_hotel_srvcGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_dtl_hotel_srvcGrid";
        $this->Initialize();
        $this->services = new clsField("services", ccsText, "");
        
        $this->t_cacc_dtl_hotel_srvc_id = new clsField("t_cacc_dtl_hotel_srvc_id", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @915-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @915-3E99123F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_account_id", ccsFloat, "", "", $this->Parameters["urlt_cust_account_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_cust_account_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @915-F7D29A17
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM t_cacc_dtl_hotel_srvc";
        $this->SQL = "SELECT * \n\n" .
        "FROM t_cacc_dtl_hotel_srvc {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @915-EF257FAA
    function SetValues()
    {
        $this->services->SetDBValue($this->f("services"));
        $this->t_cacc_dtl_hotel_srvc_id->SetDBValue(trim($this->f("t_cacc_dtl_hotel_srvc_id")));
        $this->DLink->SetDBValue($this->f("t_cacc_dtl_hotel_srvc_id"));
        $this->ADLink->SetDBValue($this->f("t_cacc_dtl_hotel_srvc_id"));
        $this->description->SetDBValue($this->f("description"));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->valid_to->SetDBValue($this->f("valid_to"));
        $this->valid_from->SetDBValue($this->f("valid_from"));
    }
//End SetValues Method

} //End t_vat_reg_dtl_hotel_srvcGridDataSource Class @915-FCB6E20C

class clsRecordt_vat_setllementSearch { //t_vat_setllementSearch Class @3-56E11780

//Variables @3-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @3-99D92BD2
    function clsRecordt_vat_setllementSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_vat_setllementSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_vat_setllementSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            $this->customer_name = & new clsControl(ccsHidden, "customer_name", "customer_name", ccsText, "", CCGetRequestParam("customer_name", $Method, NULL), $this);
            $this->t_customer_id = & new clsControl(ccsHidden, "t_customer_id", "t_customer_id", ccsFloat, "", CCGetRequestParam("t_customer_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-F11F1387
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $Validation = ($this->customer_name->Validate() && $Validation);
        $Validation = ($this->t_customer_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->customer_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-54ADF393
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->customer_name->Errors->Count());
        $errors = ($errors || $this->t_customer_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @3-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @3-D619FAD4
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        $Redirect = "t_vat_setllement_ro_otobuk.php";
    }
//End Operation Method

//Show Method @3-5701193E
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->customer_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->t_cust_account_id->Show();
        $this->customer_name->Show();
        $this->t_customer_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_vat_setllementSearch Class @3-FCB6E20C

class clsGridt_vat_reg_employeeGrid { //t_vat_reg_employeeGrid class @1037-B79C6852

//Variables @1037-AC1EDBB9

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

//Class_Initialize Event @1037-9B3F1E3F
    function clsGridt_vat_reg_employeeGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_reg_employeeGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_reg_employeeGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_reg_employeeGridDataSource($this);
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

        $this->jabatan = & new clsControl(ccsLabel, "jabatan", "jabatan", ccsText, "", CCGetRequestParam("jabatan", ccsGet, NULL), $this);
        $this->t_cust_acc_employee_id = & new clsControl(ccsHidden, "t_cust_acc_employee_id", "t_cust_acc_employee_id", ccsFloat, "", CCGetRequestParam("t_cust_acc_employee_id", ccsGet, NULL), $this);
        $this->employee_qty = & new clsControl(ccsLabel, "employee_qty", "employee_qty", ccsFloat, "", CCGetRequestParam("employee_qty", ccsGet, NULL), $this);
        $this->employee_salery = & new clsControl(ccsLabel, "employee_salery", "employee_salery", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("employee_salery", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "data_potensi_update.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "data_potensi_update.php";
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->btn_update = & new clsControl(ccsLabel, "btn_update", "btn_update", ccsText, "", CCGetRequestParam("btn_update", ccsGet, NULL), $this);
        $this->btn_update->HTML = true;
        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link1 = & new clsControl(ccsLink, "Insert_Link1", "Insert_Link1", ccsText, "", CCGetRequestParam("Insert_Link1", ccsGet, NULL), $this);
        $this->Insert_Link1->Parameters = CCGetQueryString("QueryString", array("t_cust_acc_employee_id", "s_keyword", "ccsForm"));
        $this->Insert_Link1->Page = "";
    }
//End Class_Initialize Event

//Initialize Method @1037-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @1037-AFEFFC17
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);

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
            $this->ControlsVisible["jabatan"] = $this->jabatan->Visible;
            $this->ControlsVisible["t_cust_acc_employee_id"] = $this->t_cust_acc_employee_id->Visible;
            $this->ControlsVisible["employee_qty"] = $this->employee_qty->Visible;
            $this->ControlsVisible["employee_salery"] = $this->employee_salery->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["t_cust_account_id"] = $this->t_cust_account_id->Visible;
            $this->ControlsVisible["btn_update"] = $this->btn_update->Visible;
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->jabatan->SetValue($this->DataSource->jabatan->GetValue());
                $this->t_cust_acc_employee_id->SetValue($this->DataSource->t_cust_acc_employee_id->GetValue());
                $this->employee_qty->SetValue($this->DataSource->employee_qty->GetValue());
                $this->employee_salery->SetValue($this->DataSource->employee_salery->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_cust_acc_employee_id", $this->DataSource->f("t_cust_acc_employee_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "t_cust_acc_employee_id", $this->DataSource->f("t_cust_acc_employee_id"));
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->jabatan->Show();
                $this->t_cust_acc_employee_id->Show();
                $this->employee_qty->Show();
                $this->employee_salery->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->description->Show();
                $this->t_cust_account_id->Show();
                $this->btn_update->Show();
                $this->valid_from->Show();
                $this->valid_to->Show();
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
        $this->Insert_Link1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @1037-89D8C61A
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->jabatan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_acc_employee_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->employee_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->employee_salery->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_account_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->btn_update->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_reg_employeeGrid Class @1037-FCB6E20C

class clst_vat_reg_employeeGridDataSource extends clsDBConnSIKP {  //t_vat_reg_employeeGridDataSource Class @1037-785B9916

//DataSource Variables @1037-C3343826
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $jabatan;
    var $t_cust_acc_employee_id;
    var $employee_qty;
    var $employee_salery;
    var $DLink;
    var $ADLink;
    var $description;
    var $t_cust_account_id;
    var $valid_from;
    var $valid_to;
//End DataSource Variables

//DataSourceClass_Initialize Event @1037-531FC0F8
    function clst_vat_reg_employeeGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_reg_employeeGrid";
        $this->Initialize();
        $this->jabatan = new clsField("jabatan", ccsText, "");
        
        $this->t_cust_acc_employee_id = new clsField("t_cust_acc_employee_id", ccsFloat, "");
        
        $this->employee_qty = new clsField("employee_qty", ccsFloat, "");
        
        $this->employee_salery = new clsField("employee_salery", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @1037-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @1037-3E99123F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_account_id", ccsFloat, "", "", $this->Parameters["urlt_cust_account_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_cust_account_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @1037-578767C9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_cust_acc_employee";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_cust_acc_employee {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @1037-155B00EE
    function SetValues()
    {
        $this->jabatan->SetDBValue($this->f("jabatan"));
        $this->t_cust_acc_employee_id->SetDBValue(trim($this->f("t_cust_acc_employee_id")));
        $this->employee_qty->SetDBValue(trim($this->f("employee_qty")));
        $this->employee_salery->SetDBValue(trim($this->f("employee_salery")));
        $this->DLink->SetDBValue($this->f("t_cust_acc_employee_id"));
        $this->ADLink->SetDBValue($this->f("t_cust_acc_employee_id"));
        $this->description->SetDBValue($this->f("description"));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
    }
//End SetValues Method

} //End t_vat_reg_employeeGridDataSource Class @1037-FCB6E20C

//Initialize Page @1-68810881
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
$TemplateFileName = "data_potensi_update.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-715C368D
include_once("./data_potensi_update_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-F58B6A48
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_vat_reg_dtl_restaurantGrid = & new clsGridt_vat_reg_dtl_restaurantGrid("", $MainPage);
$t_vat_reg_dtl_hotelGrid1 = & new clsGridt_vat_reg_dtl_hotelGrid1("", $MainPage);
$v_vat_reg_dtl_entertaintmentGrid = & new clsGridv_vat_reg_dtl_entertaintmentGrid("", $MainPage);
$t_vat_reg_dtl_parkingGrid = & new clsGridt_vat_reg_dtl_parkingGrid("", $MainPage);
$t_vat_reg_dtl_ppjGrid = & new clsGridt_vat_reg_dtl_ppjGrid("", $MainPage);
$t_vat_reg_dtl_ppj_nplGrid = & new clsGridt_vat_reg_dtl_ppj_nplGrid("", $MainPage);
$t_vat_reg_dtl_hotel_srvcGrid = & new clsGridt_vat_reg_dtl_hotel_srvcGrid("", $MainPage);
$t_vat_setllementSearch = & new clsRecordt_vat_setllementSearch("", $MainPage);
$t_vat_reg_employeeGrid = & new clsGridt_vat_reg_employeeGrid("", $MainPage);
$MainPage->t_vat_reg_dtl_restaurantGrid = & $t_vat_reg_dtl_restaurantGrid;
$MainPage->t_vat_reg_dtl_hotelGrid1 = & $t_vat_reg_dtl_hotelGrid1;
$MainPage->v_vat_reg_dtl_entertaintmentGrid = & $v_vat_reg_dtl_entertaintmentGrid;
$MainPage->t_vat_reg_dtl_parkingGrid = & $t_vat_reg_dtl_parkingGrid;
$MainPage->t_vat_reg_dtl_ppjGrid = & $t_vat_reg_dtl_ppjGrid;
$MainPage->t_vat_reg_dtl_ppj_nplGrid = & $t_vat_reg_dtl_ppj_nplGrid;
$MainPage->t_vat_reg_dtl_hotel_srvcGrid = & $t_vat_reg_dtl_hotel_srvcGrid;
$MainPage->t_vat_setllementSearch = & $t_vat_setllementSearch;
$MainPage->t_vat_reg_employeeGrid = & $t_vat_reg_employeeGrid;
$t_vat_reg_dtl_restaurantGrid->Initialize();
$t_vat_reg_dtl_hotelGrid1->Initialize();
$v_vat_reg_dtl_entertaintmentGrid->Initialize();
$t_vat_reg_dtl_parkingGrid->Initialize();
$t_vat_reg_dtl_ppjGrid->Initialize();
$t_vat_reg_dtl_ppj_nplGrid->Initialize();
$t_vat_reg_dtl_hotel_srvcGrid->Initialize();
$t_vat_reg_employeeGrid->Initialize();

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

//Execute Components @1-D0128F80
$t_vat_setllementSearch->Operation();
//End Execute Components

//Go to destination page @1-D1EF48AF
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_vat_reg_dtl_restaurantGrid);
    unset($t_vat_reg_dtl_hotelGrid1);
    unset($v_vat_reg_dtl_entertaintmentGrid);
    unset($t_vat_reg_dtl_parkingGrid);
    unset($t_vat_reg_dtl_ppjGrid);
    unset($t_vat_reg_dtl_ppj_nplGrid);
    unset($t_vat_reg_dtl_hotel_srvcGrid);
    unset($t_vat_setllementSearch);
    unset($t_vat_reg_employeeGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-100DA1B3
$t_vat_reg_dtl_restaurantGrid->Show();
$t_vat_reg_dtl_hotelGrid1->Show();
$v_vat_reg_dtl_entertaintmentGrid->Show();
$t_vat_reg_dtl_parkingGrid->Show();
$t_vat_reg_dtl_ppjGrid->Show();
$t_vat_reg_dtl_ppj_nplGrid->Show();
$t_vat_reg_dtl_hotel_srvcGrid->Show();
$t_vat_setllementSearch->Show();
$t_vat_reg_employeeGrid->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D5C067B4
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_vat_reg_dtl_restaurantGrid);
unset($t_vat_reg_dtl_hotelGrid1);
unset($v_vat_reg_dtl_entertaintmentGrid);
unset($t_vat_reg_dtl_parkingGrid);
unset($t_vat_reg_dtl_ppjGrid);
unset($t_vat_reg_dtl_ppj_nplGrid);
unset($t_vat_reg_dtl_hotel_srvcGrid);
unset($t_vat_setllementSearch);
unset($t_vat_reg_employeeGrid);
unset($Tpl);
//End Unload Page


?>
