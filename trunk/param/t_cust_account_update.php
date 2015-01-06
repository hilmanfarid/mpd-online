<?php
//Include Common Files @1-04278E13
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "t_cust_account_update.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_custAccountGrid { //t_custAccountGrid class @2-1C8EC641

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

//Class_Initialize Event @2-9F4CBBC7
    function clsGridt_custAccountGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_custAccountGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_custAccountGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_custAccountGridDataSource($this);
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
        $this->DLink->Page = "t_cust_account_update.php";
        $this->npwd = & new clsControl(ccsLabel, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", ccsGet, NULL), $this);
        $this->registration_date = & new clsControl(ccsLabel, "registration_date", "registration_date", ccsText, "", CCGetRequestParam("registration_date", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsText, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->vat_code = & new clsControl(ccsLabel, "vat_code", "vat_code", ccsText, "", CCGetRequestParam("vat_code", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->customer_name = & new clsControl(ccsLabel, "customer_name", "customer_name", ccsText, "", CCGetRequestParam("customer_name", ccsGet, NULL), $this);
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

//Show Method @2-E8A0B64A
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["urlt_customer_id"] = CCGetFromGet("t_customer_id", NULL);

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
            $this->ControlsVisible["npwd"] = $this->npwd->Visible;
            $this->ControlsVisible["registration_date"] = $this->registration_date->Visible;
            $this->ControlsVisible["t_cust_account_id"] = $this->t_cust_account_id->Visible;
            $this->ControlsVisible["vat_code"] = $this->vat_code->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_cust_account_id", $this->DataSource->f("t_cust_account_id"));
                $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                $this->registration_date->SetValue($this->DataSource->registration_date->GetValue());
                $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->npwd->Show();
                $this->registration_date->Show();
                $this->t_cust_account_id->Show();
                $this->vat_code->Show();
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
        $this->customer_name->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-E26EBA78
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->npwd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->registration_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_account_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_custAccountGrid Class @2-FCB6E20C

class clst_custAccountGridDataSource extends clsDBConnSIKP {  //t_custAccountGridDataSource Class @2-4119FF54

//DataSource Variables @2-3959D78F
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $npwd;
    var $registration_date;
    var $t_cust_account_id;
    var $vat_code;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-C0E377EF
    function clst_custAccountGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_custAccountGrid";
        $this->Initialize();
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->registration_date = new clsField("registration_date", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsText, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-3B2105F3
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "a.t_cust_account_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-ED7BAE7B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urlt_customer_id", ccsInteger, "", "", $this->Parameters["urlt_customer_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-1D51ED51
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.t_cust_account_id, a.t_customer_id, a.npwd, a.p_vat_type_id, a.t_vat_registration_id, a.t_customer_order_id,\n" .
        "a.registration_date, a.company_name, a.company_brand, a.address_name, a.address_no, a.address_rt, a.address_rw, a.p_region_id_kelurahan, a.p_region_id_kecamatan, a.p_region_id, a.phone_no, a.mobile_no, a.fax_no, a.zip_code, a.creation_date, a.created_by, a.updated_date, a.updated_by,\n" .
        "b.vat_code,\n" .
        "c.registration_date AS vat_registration_date,\n" .
        "d.order_no, d. order_date,\n" .
        "e.region_name AS nama_kota,\n" .
        "f.region_name AS nama_kecamatan,\n" .
        "g.region_name AS nama_kelurahan\n" .
        "\n" .
        "FROM t_cust_account a\n" .
        "LEFT JOIN p_vat_type b ON a.p_vat_type_id = b.p_vat_type_id\n" .
        "LEFT JOIN t_vat_registration c ON a.t_vat_registration_id = c.t_vat_registration_id\n" .
        "LEFT JOIN t_customer_order d ON a.t_customer_order_id = d.t_customer_order_id\n" .
        "LEFT JOIN p_region e ON a.p_region_id = e.p_region_id\n" .
        "LEFT JOIN p_region f ON a.p_region_id_kecamatan = f.p_region_id\n" .
        "LEFT JOIN p_region g ON a.p_region_id_kelurahan = g.p_region_id\n" .
        "\n" .
        "\n" .
        "WHERE (upper(a.company_name) ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' OR upper(a.npwd) ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')\n" .
        "AND a.t_customer_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . ") cnt";
        $this->SQL = "SELECT a.t_cust_account_id, a.t_customer_id, a.npwd, a.p_vat_type_id, a.t_vat_registration_id, a.t_customer_order_id,\n" .
        "a.registration_date, a.company_name, a.company_brand, a.address_name, a.address_no, a.address_rt, a.address_rw, a.p_region_id_kelurahan, a.p_region_id_kecamatan, a.p_region_id, a.phone_no, a.mobile_no, a.fax_no, a.zip_code, a.creation_date, a.created_by, a.updated_date, a.updated_by,\n" .
        "b.vat_code,\n" .
        "c.registration_date AS vat_registration_date,\n" .
        "d.order_no, d. order_date,\n" .
        "e.region_name AS nama_kota,\n" .
        "f.region_name AS nama_kecamatan,\n" .
        "g.region_name AS nama_kelurahan\n" .
        "\n" .
        "FROM t_cust_account a\n" .
        "LEFT JOIN p_vat_type b ON a.p_vat_type_id = b.p_vat_type_id\n" .
        "LEFT JOIN t_vat_registration c ON a.t_vat_registration_id = c.t_vat_registration_id\n" .
        "LEFT JOIN t_customer_order d ON a.t_customer_order_id = d.t_customer_order_id\n" .
        "LEFT JOIN p_region e ON a.p_region_id = e.p_region_id\n" .
        "LEFT JOIN p_region f ON a.p_region_id_kecamatan = f.p_region_id\n" .
        "LEFT JOIN p_region g ON a.p_region_id_kelurahan = g.p_region_id\n" .
        "\n" .
        "\n" .
        "WHERE (upper(a.company_name) ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' OR upper(a.npwd) ILIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')\n" .
        "AND a.t_customer_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-2041A464
    function SetValues()
    {
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->registration_date->SetDBValue($this->f("registration_date"));
        $this->t_cust_account_id->SetDBValue($this->f("t_cust_account_id"));
        $this->vat_code->SetDBValue($this->f("vat_code"));
    }
//End SetValues Method

} //End t_custAccountGridDataSource Class @2-FCB6E20C

class clsRecordt_cust_account_updateForm { //t_cust_account_updateForm Class @94-0E775C68

//Variables @94-D6FF3E86

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

//Class_Initialize Event @94-40DB95CB
    function clsRecordt_cust_account_updateForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_cust_account_updateForm/Error";
        $this->DataSource = new clst_cust_account_updateFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_cust_account_updateForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsText, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->p_cust_account_id = & new clsControl(ccsHidden, "p_cust_account_id", "Id", ccsFloat, "", CCGetRequestParam("p_cust_account_id", $Method, NULL), $this);
            $this->p_custGridPage = & new clsControl(ccsHidden, "p_custGridPage", "p_custGridPage", ccsText, "", CCGetRequestParam("p_custGridPage", $Method, NULL), $this);
            $this->p_region_id = & new clsControl(ccsHidden, "p_region_id", "p_region_id", ccsFloat, "", CCGetRequestParam("p_region_id", $Method, NULL), $this);
            $this->p_region_id->Required = true;
            $this->p_region_id_kecamatan = & new clsControl(ccsHidden, "p_region_id_kecamatan", "p_region_id_kecamatan", ccsText, "", CCGetRequestParam("p_region_id_kecamatan", $Method, NULL), $this);
            $this->p_region_id_kelurahan = & new clsControl(ccsHidden, "p_region_id_kelurahan", "p_region_id_kelurahan", ccsText, "", CCGetRequestParam("p_region_id_kelurahan", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsHidden, "updated_by", "updated_by", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->company_name = & new clsControl(ccsTextBox, "company_name", "Nama Perusahaan", ccsText, "", CCGetRequestParam("company_name", $Method, NULL), $this);
            $this->company_name->Required = true;
            $this->company_brand = & new clsControl(ccsTextBox, "company_brand", "Company Brand", ccsText, "", CCGetRequestParam("company_brand", $Method, NULL), $this);
            $this->company_brand->Required = true;
            $this->npwd = & new clsControl(ccsTextBox, "npwd", "NPWD", ccsText, "", CCGetRequestParam("npwd", $Method, NULL), $this);
            $this->npwd->Required = true;
            $this->vat_code = & new clsControl(ccsTextBox, "vat_code", "Jenis Pajak", ccsText, "", CCGetRequestParam("vat_code", $Method, NULL), $this);
            $this->vat_code->Required = true;
            $this->registration_date = & new clsControl(ccsTextBox, "registration_date", "Tgl Registrasi", ccsText, "", CCGetRequestParam("registration_date", $Method, NULL), $this);
            $this->registration_date->Required = true;
            $this->nama_kota = & new clsControl(ccsTextBox, "nama_kota", "Kota", ccsText, "", CCGetRequestParam("nama_kota", $Method, NULL), $this);
            $this->nama_kota->Required = true;
            $this->nama_kecamatan = & new clsControl(ccsTextBox, "nama_kecamatan", "Kecamatan", ccsText, "", CCGetRequestParam("nama_kecamatan", $Method, NULL), $this);
            $this->nama_kecamatan->Required = true;
            $this->nama_kelurahan = & new clsControl(ccsTextBox, "nama_kelurahan", "Kelurahan", ccsText, "", CCGetRequestParam("nama_kelurahan", $Method, NULL), $this);
            $this->nama_kelurahan->Required = true;
            $this->address_rt = & new clsControl(ccsTextBox, "address_rt", "Description", ccsText, "", CCGetRequestParam("address_rt", $Method, NULL), $this);
            $this->address_rw = & new clsControl(ccsTextBox, "address_rw", "Description", ccsText, "", CCGetRequestParam("address_rw", $Method, NULL), $this);
            $this->zip_code = & new clsControl(ccsTextBox, "zip_code", "Description", ccsText, "", CCGetRequestParam("zip_code", $Method, NULL), $this);
            $this->phone_no = & new clsControl(ccsTextBox, "phone_no", "Description", ccsText, "", CCGetRequestParam("phone_no", $Method, NULL), $this);
            $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", $Method, NULL), $this);
            $this->address_no = & new clsControl(ccsTextBox, "address_no", "No", ccsText, "", CCGetRequestParam("address_no", $Method, NULL), $this);
            $this->address_no->Required = true;
            $this->address_name = & new clsControl(ccsTextArea, "address_name", "Alamat", ccsText, "", CCGetRequestParam("address_name", $Method, NULL), $this);
            $this->address_name->Required = true;
            $this->brand_address_name = & new clsControl(ccsTextArea, "brand_address_name", "Alamat", ccsText, "", CCGetRequestParam("brand_address_name", $Method, NULL), $this);
            $this->brand_address_name->Required = true;
            $this->brand_address_no = & new clsControl(ccsTextBox, "brand_address_no", "No - Usaha", ccsText, "", CCGetRequestParam("brand_address_no", $Method, NULL), $this);
            $this->brand_address_no->Required = true;
            $this->brand_kota = & new clsControl(ccsTextBox, "brand_kota", "Kota/Kabupaten - Usaha", ccsText, "", CCGetRequestParam("brand_kota", $Method, NULL), $this);
            $this->brand_kota->Required = true;
            $this->brand_kecamatan = & new clsControl(ccsTextBox, "brand_kecamatan", "Kecamatan - Usaha", ccsText, "", CCGetRequestParam("brand_kecamatan", $Method, NULL), $this);
            $this->brand_kecamatan->Required = true;
            $this->brand_kelurahan = & new clsControl(ccsTextBox, "brand_kelurahan", "Kelurahan - Usaha", ccsText, "", CCGetRequestParam("brand_kelurahan", $Method, NULL), $this);
            $this->brand_kelurahan->Required = true;
            $this->brand_p_region_id = & new clsControl(ccsHidden, "brand_p_region_id", "Kota/Kabupaten - Usaha", ccsFloat, "", CCGetRequestParam("brand_p_region_id", $Method, NULL), $this);
            $this->brand_p_region_id->Required = true;
            $this->brand_p_region_id_kel = & new clsControl(ccsHidden, "brand_p_region_id_kel", "Kelurahan - Usaha", ccsFloat, "", CCGetRequestParam("brand_p_region_id_kel", $Method, NULL), $this);
            $this->brand_p_region_id_kel->Required = true;
            $this->brand_p_region_id_kec = & new clsControl(ccsHidden, "brand_p_region_id_kec", "Kecamatan - Usaha", ccsFloat, "", CCGetRequestParam("brand_p_region_id_kec", $Method, NULL), $this);
            $this->brand_p_region_id_kec->Required = true;
            $this->brand_phone_no = & new clsControl(ccsTextBox, "brand_phone_no", "No. Telephon - Usaha", ccsText, "", CCGetRequestParam("brand_phone_no", $Method, NULL), $this);
            $this->brand_mobile_no = & new clsControl(ccsTextBox, "brand_mobile_no", "No. Selular - Usaha", ccsText, "", CCGetRequestParam("brand_mobile_no", $Method, NULL), $this);
            $this->brand_fax_no = & new clsControl(ccsTextBox, "brand_fax_no", "No. Fax - Usaha", ccsText, "", CCGetRequestParam("brand_fax_no", $Method, NULL), $this);
            $this->brand_zip_code = & new clsControl(ccsTextBox, "brand_zip_code", "Kode Pos - Usaha", ccsText, "", CCGetRequestParam("brand_zip_code", $Method, NULL), $this);
            $this->wp_name = & new clsControl(ccsTextBox, "wp_name", "Nama Wajib Pajak", ccsText, "", CCGetRequestParam("wp_name", $Method, NULL), $this);
            $this->wp_name->Required = true;
            $this->wp_address_name = & new clsControl(ccsTextArea, "wp_address_name", "Alamat Wajib Pajak", ccsText, "", CCGetRequestParam("wp_address_name", $Method, NULL), $this);
            $this->wp_address_name->Required = true;
            $this->wp_address_no = & new clsControl(ccsTextBox, "wp_address_no", "No - WP", ccsText, "", CCGetRequestParam("wp_address_no", $Method, NULL), $this);
            $this->wp_address_no->Required = true;
            $this->wp_kota = & new clsControl(ccsTextBox, "wp_kota", "Kota/Kabupaten - WP", ccsText, "", CCGetRequestParam("wp_kota", $Method, NULL), $this);
            $this->wp_kota->Required = true;
            $this->wp_kecamatan = & new clsControl(ccsTextBox, "wp_kecamatan", "Kecamatan - WP", ccsText, "", CCGetRequestParam("wp_kecamatan", $Method, NULL), $this);
            $this->wp_kecamatan->Required = true;
            $this->wp_kelurahan = & new clsControl(ccsTextBox, "wp_kelurahan", "Kelurahan - WP", ccsText, "", CCGetRequestParam("wp_kelurahan", $Method, NULL), $this);
            $this->wp_kelurahan->Required = true;
            $this->wp_phone_no = & new clsControl(ccsTextBox, "wp_phone_no", "No. Telephon - WP", ccsText, "", CCGetRequestParam("wp_phone_no", $Method, NULL), $this);
            $this->wp_email = & new clsControl(ccsTextBox, "wp_email", "Email - WP", ccsText, "", CCGetRequestParam("wp_email", $Method, NULL), $this);
            $this->wp_fax_no = & new clsControl(ccsTextBox, "wp_fax_no", "No. Fax - WP", ccsText, "", CCGetRequestParam("wp_fax_no", $Method, NULL), $this);
            $this->wp_zip_code = & new clsControl(ccsTextBox, "wp_zip_code", "Kode Pos - WP", ccsText, "", CCGetRequestParam("wp_zip_code", $Method, NULL), $this);
            $this->wp_p_region_id_kelurahan = & new clsControl(ccsHidden, "wp_p_region_id_kelurahan", "Kelurahan - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id_kelurahan", $Method, NULL), $this);
            $this->wp_p_region_id_kelurahan->Required = true;
            $this->wp_p_region_id_kecamatan = & new clsControl(ccsHidden, "wp_p_region_id_kecamatan", "Kecamatan - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id_kecamatan", $Method, NULL), $this);
            $this->wp_p_region_id_kecamatan->Required = true;
            $this->wp_p_region_id = & new clsControl(ccsHidden, "wp_p_region_id", "Kota/Kabupaten - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id", $Method, NULL), $this);
            $this->wp_p_region_id->Required = true;
            $this->wp_address_rt = & new clsControl(ccsTextBox, "wp_address_rt", "Rt - WP", ccsText, "", CCGetRequestParam("wp_address_rt", $Method, NULL), $this);
            $this->wp_mobile_no = & new clsControl(ccsTextBox, "wp_mobile_no", "No. Selular - WP", ccsText, "", CCGetRequestParam("wp_mobile_no", $Method, NULL), $this);
            $this->fax_no = & new clsControl(ccsTextBox, "fax_no", "Description", ccsText, "", CCGetRequestParam("fax_no", $Method, NULL), $this);
            $this->mobile_no = & new clsControl(ccsTextBox, "mobile_no", "Description", ccsText, "", CCGetRequestParam("mobile_no", $Method, NULL), $this);
            $this->wp_address_rw = & new clsControl(ccsTextBox, "wp_address_rw", "Rw - WP", ccsText, "", CCGetRequestParam("wp_address_rw", $Method, NULL), $this);
            $this->brand_address_rt = & new clsControl(ccsTextBox, "brand_address_rt", "Rt - Usaha", ccsText, "", CCGetRequestParam("brand_address_rt", $Method, NULL), $this);
            $this->brand_address_rw = & new clsControl(ccsTextBox, "brand_address_rw", "Rw - Usaha", ccsText, "", CCGetRequestParam("brand_address_rw", $Method, NULL), $this);
            $this->active_date = & new clsControl(ccsTextBox, "active_date", "Tgl Pengukuhan", ccsText, "", CCGetRequestParam("active_date", $Method, NULL), $this);
            $this->active_date->Required = true;
            $this->last_satatus_date = & new clsControl(ccsTextBox, "last_satatus_date", "Tgl Pengukuhan", ccsText, "", CCGetRequestParam("last_satatus_date", $Method, NULL), $this);
            $this->last_satatus_date->Required = true;
            $this->activation_no = & new clsControl(ccsTextBox, "activation_no", "No Pengukuhan", ccsText, "", CCGetRequestParam("activation_no", $Method, NULL), $this);
            $this->activation_no->Required = true;
            $this->status_code = & new clsControl(ccsTextBox, "status_code", "status_code", ccsText, "", CCGetRequestParam("status_code", $Method, NULL), $this);
            $this->status_code->Required = true;
            $this->nama_ayat = & new clsControl(ccsTextBox, "nama_ayat", "Nama Ayat", ccsText, "", CCGetRequestParam("nama_ayat", $Method, NULL), $this);
            $this->nama_ayat->Required = true;
            $this->p_vat_type_dtl_id = & new clsControl(ccsHidden, "p_vat_type_dtl_id", "p_vat_type_dtl_id", ccsText, "", CCGetRequestParam("p_vat_type_dtl_id", $Method, NULL), $this);
            $this->Button1 = & new clsButton("Button1", $Method, $this);
            $this->p_account_status_id = & new clsControl(ccsHidden, "p_account_status_id", "p_account_status_id", ccsText, "", CCGetRequestParam("p_account_status_id", $Method, NULL), $this);
            $this->t_customer_id = & new clsControl(ccsHidden, "t_customer_id", "t_customer_id", ccsText, "", CCGetRequestParam("t_customer_id", $Method, NULL), $this);
            $this->nama_jabatan = & new clsControl(ccsTextBox, "nama_jabatan", "Jabatan", ccsText, "", CCGetRequestParam("nama_jabatan", $Method, NULL), $this);
            $this->nama_jabatan->Required = true;
            $this->nama_kota_owner = & new clsControl(ccsTextBox, "nama_kota_owner", "Kota", ccsText, "", CCGetRequestParam("nama_kota_owner", $Method, NULL), $this);
            $this->nama_kota_owner->Required = true;
            $this->nama_kecamatan_owner = & new clsControl(ccsTextBox, "nama_kecamatan_owner", "Description", ccsText, "", CCGetRequestParam("nama_kecamatan_owner", $Method, NULL), $this);
            $this->nama_kecamatan_owner->Required = true;
            $this->nama_kelurahan_owner = & new clsControl(ccsTextBox, "nama_kelurahan_owner", "Description", ccsText, "", CCGetRequestParam("nama_kelurahan_owner", $Method, NULL), $this);
            $this->nama_kelurahan_owner->Required = true;
            $this->address_rt_owner = & new clsControl(ccsTextBox, "address_rt_owner", "Description", ccsText, "", CCGetRequestParam("address_rt_owner", $Method, NULL), $this);
            $this->address_rw_owner = & new clsControl(ccsTextBox, "address_rw_owner", "Description", ccsText, "", CCGetRequestParam("address_rw_owner", $Method, NULL), $this);
            $this->zip_code_owner = & new clsControl(ccsTextBox, "zip_code_owner", "Description", ccsText, "", CCGetRequestParam("zip_code_owner", $Method, NULL), $this);
            $this->phone_no_owner = & new clsControl(ccsTextBox, "phone_no_owner", "Description", ccsText, "", CCGetRequestParam("phone_no_owner", $Method, NULL), $this);
            $this->mobile_no_owner = & new clsControl(ccsTextBox, "mobile_no_owner", "Description", ccsText, "", CCGetRequestParam("mobile_no_owner", $Method, NULL), $this);
            $this->mobile_no_owner->Required = true;
            $this->email_address = & new clsControl(ccsTextBox, "email_address", "Description", ccsText, "", CCGetRequestParam("email_address", $Method, NULL), $this);
            $this->address_name_owner = & new clsControl(ccsTextArea, "address_name_owner", "Alamat", ccsText, "", CCGetRequestParam("address_name_owner", $Method, NULL), $this);
            $this->address_name_owner->Required = true;
            $this->company_owner = & new clsControl(ccsTextBox, "company_owner", "Nama Perusahaan", ccsText, "", CCGetRequestParam("company_owner", $Method, NULL), $this);
            $this->company_owner->Required = true;
            $this->updated_by1 = & new clsControl(ccsHidden, "updated_by1", "updated_by1", ccsText, "", CCGetRequestParam("updated_by1", $Method, NULL), $this);
            $this->p_job_position_id = & new clsControl(ccsHidden, "p_job_position_id", "p_job_position_id", ccsText, "", CCGetRequestParam("p_job_position_id", $Method, NULL), $this);
            $this->p_region_id_kel_owner = & new clsControl(ccsHidden, "p_region_id_kel_owner", "p_region_id_kel_owner", ccsText, "", CCGetRequestParam("p_region_id_kel_owner", $Method, NULL), $this);
            $this->p_region_id_kec_owner = & new clsControl(ccsHidden, "p_region_id_kec_owner", "p_region_id_kec_owner", ccsText, "", CCGetRequestParam("p_region_id_kec_owner", $Method, NULL), $this);
            $this->p_region_id_owner = & new clsControl(ccsHidden, "p_region_id_owner", "p_region_id_owner", ccsText, "", CCGetRequestParam("p_region_id_owner", $Method, NULL), $this);
            $this->fax_no_owner = & new clsControl(ccsTextBox, "fax_no_owner", "Description", ccsText, "", CCGetRequestParam("fax_no_owner", $Method, NULL), $this);
            $this->address_no_owner = & new clsControl(ccsTextBox, "address_no_owner", "No", ccsText, "", CCGetRequestParam("address_no_owner", $Method, NULL), $this);
            $this->address_no_owner->Required = true;
            if(!$this->FormSubmitted) {
                if(!is_array($this->p_region_id->Value) && !strlen($this->p_region_id->Value) && $this->p_region_id->Value !== false)
                    $this->p_region_id->SetText(749);
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->nama_kota->Value) && !strlen($this->nama_kota->Value) && $this->nama_kota->Value !== false)
                    $this->nama_kota->SetText('KOTA BANDUNG');
                if(!is_array($this->brand_kota->Value) && !strlen($this->brand_kota->Value) && $this->brand_kota->Value !== false)
                    $this->brand_kota->SetText('KOTA BANDUNG');
                if(!is_array($this->brand_p_region_id->Value) && !strlen($this->brand_p_region_id->Value) && $this->brand_p_region_id->Value !== false)
                    $this->brand_p_region_id->SetText(749);
                if(!is_array($this->wp_kota->Value) && !strlen($this->wp_kota->Value) && $this->wp_kota->Value !== false)
                    $this->wp_kota->SetText('KOTA BANDUNG');
                if(!is_array($this->wp_p_region_id->Value) && !strlen($this->wp_p_region_id->Value) && $this->wp_p_region_id->Value !== false)
                    $this->wp_p_region_id->SetText(749);
                if(!is_array($this->updated_by1->Value) && !strlen($this->updated_by1->Value) && $this->updated_by1->Value !== false)
                    $this->updated_by1->SetText(CCGetUserLogin());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-301E8DB0
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_customer_id"] = CCGetFromGet("t_customer_id", NULL);
        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);
    }
//End Initialize Method

//Validate Method @94-7402B078
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if(strlen($this->wp_email->GetText()) && !preg_match ("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $this->wp_email->GetText())) {
            $this->wp_email->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Email - WP"));
        }
        if(strlen($this->email_address->GetText()) && !preg_match ("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $this->email_address->GetText())) {
            $this->email_address->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Description"));
        }
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $Validation = ($this->p_cust_account_id->Validate() && $Validation);
        $Validation = ($this->p_custGridPage->Validate() && $Validation);
        $Validation = ($this->p_region_id->Validate() && $Validation);
        $Validation = ($this->p_region_id_kecamatan->Validate() && $Validation);
        $Validation = ($this->p_region_id_kelurahan->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->company_name->Validate() && $Validation);
        $Validation = ($this->company_brand->Validate() && $Validation);
        $Validation = ($this->npwd->Validate() && $Validation);
        $Validation = ($this->vat_code->Validate() && $Validation);
        $Validation = ($this->registration_date->Validate() && $Validation);
        $Validation = ($this->nama_kota->Validate() && $Validation);
        $Validation = ($this->nama_kecamatan->Validate() && $Validation);
        $Validation = ($this->nama_kelurahan->Validate() && $Validation);
        $Validation = ($this->address_rt->Validate() && $Validation);
        $Validation = ($this->address_rw->Validate() && $Validation);
        $Validation = ($this->zip_code->Validate() && $Validation);
        $Validation = ($this->phone_no->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id->Validate() && $Validation);
        $Validation = ($this->address_no->Validate() && $Validation);
        $Validation = ($this->address_name->Validate() && $Validation);
        $Validation = ($this->brand_address_name->Validate() && $Validation);
        $Validation = ($this->brand_address_no->Validate() && $Validation);
        $Validation = ($this->brand_kota->Validate() && $Validation);
        $Validation = ($this->brand_kecamatan->Validate() && $Validation);
        $Validation = ($this->brand_kelurahan->Validate() && $Validation);
        $Validation = ($this->brand_p_region_id->Validate() && $Validation);
        $Validation = ($this->brand_p_region_id_kel->Validate() && $Validation);
        $Validation = ($this->brand_p_region_id_kec->Validate() && $Validation);
        $Validation = ($this->brand_phone_no->Validate() && $Validation);
        $Validation = ($this->brand_mobile_no->Validate() && $Validation);
        $Validation = ($this->brand_fax_no->Validate() && $Validation);
        $Validation = ($this->brand_zip_code->Validate() && $Validation);
        $Validation = ($this->wp_name->Validate() && $Validation);
        $Validation = ($this->wp_address_name->Validate() && $Validation);
        $Validation = ($this->wp_address_no->Validate() && $Validation);
        $Validation = ($this->wp_kota->Validate() && $Validation);
        $Validation = ($this->wp_kecamatan->Validate() && $Validation);
        $Validation = ($this->wp_kelurahan->Validate() && $Validation);
        $Validation = ($this->wp_phone_no->Validate() && $Validation);
        $Validation = ($this->wp_email->Validate() && $Validation);
        $Validation = ($this->wp_fax_no->Validate() && $Validation);
        $Validation = ($this->wp_zip_code->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id_kelurahan->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id_kecamatan->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id->Validate() && $Validation);
        $Validation = ($this->wp_address_rt->Validate() && $Validation);
        $Validation = ($this->wp_mobile_no->Validate() && $Validation);
        $Validation = ($this->fax_no->Validate() && $Validation);
        $Validation = ($this->mobile_no->Validate() && $Validation);
        $Validation = ($this->wp_address_rw->Validate() && $Validation);
        $Validation = ($this->brand_address_rt->Validate() && $Validation);
        $Validation = ($this->brand_address_rw->Validate() && $Validation);
        $Validation = ($this->active_date->Validate() && $Validation);
        $Validation = ($this->last_satatus_date->Validate() && $Validation);
        $Validation = ($this->activation_no->Validate() && $Validation);
        $Validation = ($this->status_code->Validate() && $Validation);
        $Validation = ($this->nama_ayat->Validate() && $Validation);
        $Validation = ($this->p_vat_type_dtl_id->Validate() && $Validation);
        $Validation = ($this->p_account_status_id->Validate() && $Validation);
        $Validation = ($this->t_customer_id->Validate() && $Validation);
        $Validation = ($this->nama_jabatan->Validate() && $Validation);
        $Validation = ($this->nama_kota_owner->Validate() && $Validation);
        $Validation = ($this->nama_kecamatan_owner->Validate() && $Validation);
        $Validation = ($this->nama_kelurahan_owner->Validate() && $Validation);
        $Validation = ($this->address_rt_owner->Validate() && $Validation);
        $Validation = ($this->address_rw_owner->Validate() && $Validation);
        $Validation = ($this->zip_code_owner->Validate() && $Validation);
        $Validation = ($this->phone_no_owner->Validate() && $Validation);
        $Validation = ($this->mobile_no_owner->Validate() && $Validation);
        $Validation = ($this->email_address->Validate() && $Validation);
        $Validation = ($this->address_name_owner->Validate() && $Validation);
        $Validation = ($this->company_owner->Validate() && $Validation);
        $Validation = ($this->updated_by1->Validate() && $Validation);
        $Validation = ($this->p_job_position_id->Validate() && $Validation);
        $Validation = ($this->p_region_id_kel_owner->Validate() && $Validation);
        $Validation = ($this->p_region_id_kec_owner->Validate() && $Validation);
        $Validation = ($this->p_region_id_owner->Validate() && $Validation);
        $Validation = ($this->fax_no_owner->Validate() && $Validation);
        $Validation = ($this->address_no_owner->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_custGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->company_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->company_brand->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npwd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vat_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->registration_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_kota->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_rt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_rw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->zip_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->phone_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_address_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_kota->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_p_region_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_p_region_id_kel->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_p_region_id_kec->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_phone_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_mobile_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_fax_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_zip_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_kota->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_phone_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_email->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_fax_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_zip_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_rt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_mobile_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fax_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mobile_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_rw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_address_rt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_address_rw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->active_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->last_satatus_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->activation_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->status_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_ayat->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_dtl_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_account_status_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_jabatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_kota_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_kecamatan_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_kelurahan_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_rt_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_rw_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->zip_code_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->phone_no_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mobile_no_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->email_address->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_name_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->company_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_job_position_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_kel_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_kec_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fax_no_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_no_owner->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-B8BAD606
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->p_cust_account_id->Errors->Count());
        $errors = ($errors || $this->p_custGridPage->Errors->Count());
        $errors = ($errors || $this->p_region_id->Errors->Count());
        $errors = ($errors || $this->p_region_id_kecamatan->Errors->Count());
        $errors = ($errors || $this->p_region_id_kelurahan->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->company_name->Errors->Count());
        $errors = ($errors || $this->company_brand->Errors->Count());
        $errors = ($errors || $this->npwd->Errors->Count());
        $errors = ($errors || $this->vat_code->Errors->Count());
        $errors = ($errors || $this->registration_date->Errors->Count());
        $errors = ($errors || $this->nama_kota->Errors->Count());
        $errors = ($errors || $this->nama_kecamatan->Errors->Count());
        $errors = ($errors || $this->nama_kelurahan->Errors->Count());
        $errors = ($errors || $this->address_rt->Errors->Count());
        $errors = ($errors || $this->address_rw->Errors->Count());
        $errors = ($errors || $this->zip_code->Errors->Count());
        $errors = ($errors || $this->phone_no->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
        $errors = ($errors || $this->address_no->Errors->Count());
        $errors = ($errors || $this->address_name->Errors->Count());
        $errors = ($errors || $this->brand_address_name->Errors->Count());
        $errors = ($errors || $this->brand_address_no->Errors->Count());
        $errors = ($errors || $this->brand_kota->Errors->Count());
        $errors = ($errors || $this->brand_kecamatan->Errors->Count());
        $errors = ($errors || $this->brand_kelurahan->Errors->Count());
        $errors = ($errors || $this->brand_p_region_id->Errors->Count());
        $errors = ($errors || $this->brand_p_region_id_kel->Errors->Count());
        $errors = ($errors || $this->brand_p_region_id_kec->Errors->Count());
        $errors = ($errors || $this->brand_phone_no->Errors->Count());
        $errors = ($errors || $this->brand_mobile_no->Errors->Count());
        $errors = ($errors || $this->brand_fax_no->Errors->Count());
        $errors = ($errors || $this->brand_zip_code->Errors->Count());
        $errors = ($errors || $this->wp_name->Errors->Count());
        $errors = ($errors || $this->wp_address_name->Errors->Count());
        $errors = ($errors || $this->wp_address_no->Errors->Count());
        $errors = ($errors || $this->wp_kota->Errors->Count());
        $errors = ($errors || $this->wp_kecamatan->Errors->Count());
        $errors = ($errors || $this->wp_kelurahan->Errors->Count());
        $errors = ($errors || $this->wp_phone_no->Errors->Count());
        $errors = ($errors || $this->wp_email->Errors->Count());
        $errors = ($errors || $this->wp_fax_no->Errors->Count());
        $errors = ($errors || $this->wp_zip_code->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id_kelurahan->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id_kecamatan->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id->Errors->Count());
        $errors = ($errors || $this->wp_address_rt->Errors->Count());
        $errors = ($errors || $this->wp_mobile_no->Errors->Count());
        $errors = ($errors || $this->fax_no->Errors->Count());
        $errors = ($errors || $this->mobile_no->Errors->Count());
        $errors = ($errors || $this->wp_address_rw->Errors->Count());
        $errors = ($errors || $this->brand_address_rt->Errors->Count());
        $errors = ($errors || $this->brand_address_rw->Errors->Count());
        $errors = ($errors || $this->active_date->Errors->Count());
        $errors = ($errors || $this->last_satatus_date->Errors->Count());
        $errors = ($errors || $this->activation_no->Errors->Count());
        $errors = ($errors || $this->status_code->Errors->Count());
        $errors = ($errors || $this->nama_ayat->Errors->Count());
        $errors = ($errors || $this->p_vat_type_dtl_id->Errors->Count());
        $errors = ($errors || $this->p_account_status_id->Errors->Count());
        $errors = ($errors || $this->t_customer_id->Errors->Count());
        $errors = ($errors || $this->nama_jabatan->Errors->Count());
        $errors = ($errors || $this->nama_kota_owner->Errors->Count());
        $errors = ($errors || $this->nama_kecamatan_owner->Errors->Count());
        $errors = ($errors || $this->nama_kelurahan_owner->Errors->Count());
        $errors = ($errors || $this->address_rt_owner->Errors->Count());
        $errors = ($errors || $this->address_rw_owner->Errors->Count());
        $errors = ($errors || $this->zip_code_owner->Errors->Count());
        $errors = ($errors || $this->phone_no_owner->Errors->Count());
        $errors = ($errors || $this->mobile_no_owner->Errors->Count());
        $errors = ($errors || $this->email_address->Errors->Count());
        $errors = ($errors || $this->address_name_owner->Errors->Count());
        $errors = ($errors || $this->company_owner->Errors->Count());
        $errors = ($errors || $this->updated_by1->Errors->Count());
        $errors = ($errors || $this->p_job_position_id->Errors->Count());
        $errors = ($errors || $this->p_region_id_kel_owner->Errors->Count());
        $errors = ($errors || $this->p_region_id_kec_owner->Errors->Count());
        $errors = ($errors || $this->p_region_id_owner->Errors->Count());
        $errors = ($errors || $this->fax_no_owner->Errors->Count());
        $errors = ($errors || $this->address_no_owner->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @94-ED598703
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

//Operation Method @94-E3F65511
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Cancel";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            } else if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "p_region_id", "s_keyword", "FLAG", "p_regionGridPage"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateRow Method @94-778EB276
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_vat_type_id->SetValue($this->p_vat_type_id->GetValue(true));
        $this->DataSource->registration_date->SetValue($this->registration_date->GetValue(true));
        $this->DataSource->company_name->SetValue($this->company_name->GetValue(true));
        $this->DataSource->company_brand->SetValue($this->company_brand->GetValue(true));
        $this->DataSource->address_no->SetValue($this->address_no->GetValue(true));
        $this->DataSource->address_name->SetValue($this->address_name->GetValue(true));
        $this->DataSource->address_rt->SetValue($this->address_rt->GetValue(true));
        $this->DataSource->address_rw->SetValue($this->address_rw->GetValue(true));
        $this->DataSource->p_region_id_kelurahan->SetValue($this->p_region_id_kelurahan->GetValue(true));
        $this->DataSource->p_region_id_kecamatan->SetValue($this->p_region_id_kecamatan->GetValue(true));
        $this->DataSource->p_region_id->SetValue($this->p_region_id->GetValue(true));
        $this->DataSource->phone_no->SetValue($this->phone_no->GetValue(true));
        $this->DataSource->mobile_no->SetValue($this->mobile_no->GetValue(true));
        $this->DataSource->fax_no->SetValue($this->fax_no->GetValue(true));
        $this->DataSource->zip_code->SetValue($this->zip_code->GetValue(true));
        $this->DataSource->updated_by->SetValue($this->updated_by->GetValue(true));
        $this->DataSource->t_cust_account_id->SetValue($this->t_cust_account_id->GetValue(true));
        $this->DataSource->npwd->SetValue($this->npwd->GetValue(true));
        $this->DataSource->wp_name->SetValue($this->wp_name->GetValue(true));
        $this->DataSource->wp_address_name->SetValue($this->wp_address_name->GetValue(true));
        $this->DataSource->wp_address_no->SetValue($this->wp_address_no->GetValue(true));
        $this->DataSource->wp_address_rt->SetValue($this->wp_address_rt->GetValue(true));
        $this->DataSource->wp_address_rw->SetValue($this->wp_address_rw->GetValue(true));
        $this->DataSource->wp_p_region_id_kelurahan->SetValue($this->wp_p_region_id_kelurahan->GetValue(true));
        $this->DataSource->wp_p_region_id_kecamatan->SetValue($this->wp_p_region_id_kecamatan->GetValue(true));
        $this->DataSource->wp_p_region_id->SetValue($this->wp_p_region_id->GetValue(true));
        $this->DataSource->wp_phone_no->SetValue($this->wp_phone_no->GetValue(true));
        $this->DataSource->wp_mobile_no->SetValue($this->wp_mobile_no->GetValue(true));
        $this->DataSource->wp_fax_no->SetValue($this->wp_fax_no->GetValue(true));
        $this->DataSource->wp_zip_code->SetValue($this->wp_zip_code->GetValue(true));
        $this->DataSource->wp_email->SetValue($this->wp_email->GetValue(true));
        $this->DataSource->brand_address_name->SetValue($this->brand_address_name->GetValue(true));
        $this->DataSource->brand_address_no->SetValue($this->brand_address_no->GetValue(true));
        $this->DataSource->brand_address_rt->SetValue($this->brand_address_rt->GetValue(true));
        $this->DataSource->brand_address_rw->SetValue($this->brand_address_rw->GetValue(true));
        $this->DataSource->brand_p_region_id_kel->SetValue($this->brand_p_region_id_kel->GetValue(true));
        $this->DataSource->brand_p_region_id_kec->SetValue($this->brand_p_region_id_kec->GetValue(true));
        $this->DataSource->brand_p_region_id->SetValue($this->brand_p_region_id->GetValue(true));
        $this->DataSource->brand_phone_no->SetValue($this->brand_phone_no->GetValue(true));
        $this->DataSource->brand_mobile_no->SetValue($this->brand_mobile_no->GetValue(true));
        $this->DataSource->brand_fax_no->SetValue($this->brand_fax_no->GetValue(true));
        $this->DataSource->brand_zip_code->SetValue($this->brand_zip_code->GetValue(true));
        $this->DataSource->p_account_status_id->SetValue($this->p_account_status_id->GetValue(true));
        $this->DataSource->activation_no->SetValue($this->activation_no->GetValue(true));
        $this->DataSource->p_vat_type_dtl_id->SetValue($this->p_vat_type_dtl_id->GetValue(true));
        $this->DataSource->company_owner->SetValue($this->company_owner->GetValue(true));
        $this->DataSource->p_job_position_id->SetValue($this->p_job_position_id->GetValue(true));
        $this->DataSource->address_name_owner->SetValue($this->address_name_owner->GetValue(true));
        $this->DataSource->address_no_owner->SetValue($this->address_no_owner->GetValue(true));
        $this->DataSource->address_rt_owner->SetValue($this->address_rt_owner->GetValue(true));
        $this->DataSource->address_rw_owner->SetValue($this->address_rw_owner->GetValue(true));
        $this->DataSource->p_region_id_owner->SetValue($this->p_region_id_owner->GetValue(true));
        $this->DataSource->p_region_id_kec_owner->SetValue($this->p_region_id_kec_owner->GetValue(true));
        $this->DataSource->p_region_id_kel_owner->SetValue($this->p_region_id_kel_owner->GetValue(true));
        $this->DataSource->phone_no_owner->SetValue($this->phone_no_owner->GetValue(true));
        $this->DataSource->fax_no_owner->SetValue($this->fax_no_owner->GetValue(true));
        $this->DataSource->mobile_no_owner->SetValue($this->mobile_no_owner->GetValue(true));
        $this->DataSource->email_address->SetValue($this->email_address->GetValue(true));
        $this->DataSource->zip_code_owner->SetValue($this->zip_code_owner->GetValue(true));
        $this->DataSource->t_customer_id->SetValue($this->t_customer_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @94-C0140AC0
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
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                    $this->p_cust_account_id->SetValue($this->DataSource->p_cust_account_id->GetValue());
                    $this->p_region_id->SetValue($this->DataSource->p_region_id->GetValue());
                    $this->p_region_id_kecamatan->SetValue($this->DataSource->p_region_id_kecamatan->GetValue());
                    $this->p_region_id_kelurahan->SetValue($this->DataSource->p_region_id_kelurahan->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->company_name->SetValue($this->DataSource->company_name->GetValue());
                    $this->company_brand->SetValue($this->DataSource->company_brand->GetValue());
                    $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                    $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                    $this->registration_date->SetValue($this->DataSource->registration_date->GetValue());
                    $this->nama_kota->SetValue($this->DataSource->nama_kota->GetValue());
                    $this->nama_kecamatan->SetValue($this->DataSource->nama_kecamatan->GetValue());
                    $this->nama_kelurahan->SetValue($this->DataSource->nama_kelurahan->GetValue());
                    $this->address_rt->SetValue($this->DataSource->address_rt->GetValue());
                    $this->address_rw->SetValue($this->DataSource->address_rw->GetValue());
                    $this->zip_code->SetValue($this->DataSource->zip_code->GetValue());
                    $this->phone_no->SetValue($this->DataSource->phone_no->GetValue());
                    $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                    $this->address_no->SetValue($this->DataSource->address_no->GetValue());
                    $this->address_name->SetValue($this->DataSource->address_name->GetValue());
                    $this->brand_address_name->SetValue($this->DataSource->brand_address_name->GetValue());
                    $this->brand_address_no->SetValue($this->DataSource->brand_address_no->GetValue());
                    $this->brand_kota->SetValue($this->DataSource->brand_kota->GetValue());
                    $this->brand_kecamatan->SetValue($this->DataSource->brand_kecamatan->GetValue());
                    $this->brand_kelurahan->SetValue($this->DataSource->brand_kelurahan->GetValue());
                    $this->brand_p_region_id->SetValue($this->DataSource->brand_p_region_id->GetValue());
                    $this->brand_p_region_id_kel->SetValue($this->DataSource->brand_p_region_id_kel->GetValue());
                    $this->brand_p_region_id_kec->SetValue($this->DataSource->brand_p_region_id_kec->GetValue());
                    $this->brand_phone_no->SetValue($this->DataSource->brand_phone_no->GetValue());
                    $this->brand_mobile_no->SetValue($this->DataSource->brand_mobile_no->GetValue());
                    $this->brand_fax_no->SetValue($this->DataSource->brand_fax_no->GetValue());
                    $this->brand_zip_code->SetValue($this->DataSource->brand_zip_code->GetValue());
                    $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                    $this->wp_address_name->SetValue($this->DataSource->wp_address_name->GetValue());
                    $this->wp_address_no->SetValue($this->DataSource->wp_address_no->GetValue());
                    $this->wp_kota->SetValue($this->DataSource->wp_kota->GetValue());
                    $this->wp_kecamatan->SetValue($this->DataSource->wp_kecamatan->GetValue());
                    $this->wp_kelurahan->SetValue($this->DataSource->wp_kelurahan->GetValue());
                    $this->wp_phone_no->SetValue($this->DataSource->wp_phone_no->GetValue());
                    $this->wp_email->SetValue($this->DataSource->wp_email->GetValue());
                    $this->wp_fax_no->SetValue($this->DataSource->wp_fax_no->GetValue());
                    $this->wp_zip_code->SetValue($this->DataSource->wp_zip_code->GetValue());
                    $this->wp_p_region_id_kelurahan->SetValue($this->DataSource->wp_p_region_id_kelurahan->GetValue());
                    $this->wp_p_region_id_kecamatan->SetValue($this->DataSource->wp_p_region_id_kecamatan->GetValue());
                    $this->wp_p_region_id->SetValue($this->DataSource->wp_p_region_id->GetValue());
                    $this->wp_address_rt->SetValue($this->DataSource->wp_address_rt->GetValue());
                    $this->wp_mobile_no->SetValue($this->DataSource->wp_mobile_no->GetValue());
                    $this->fax_no->SetValue($this->DataSource->fax_no->GetValue());
                    $this->mobile_no->SetValue($this->DataSource->mobile_no->GetValue());
                    $this->wp_address_rw->SetValue($this->DataSource->wp_address_rw->GetValue());
                    $this->brand_address_rt->SetValue($this->DataSource->brand_address_rt->GetValue());
                    $this->brand_address_rw->SetValue($this->DataSource->brand_address_rw->GetValue());
                    $this->active_date->SetValue($this->DataSource->active_date->GetValue());
                    $this->last_satatus_date->SetValue($this->DataSource->last_satatus_date->GetValue());
                    $this->activation_no->SetValue($this->DataSource->activation_no->GetValue());
                    $this->status_code->SetValue($this->DataSource->status_code->GetValue());
                    $this->nama_ayat->SetValue($this->DataSource->nama_ayat->GetValue());
                    $this->p_vat_type_dtl_id->SetValue($this->DataSource->p_vat_type_dtl_id->GetValue());
                    $this->p_account_status_id->SetValue($this->DataSource->p_account_status_id->GetValue());
                    $this->t_customer_id->SetValue($this->DataSource->t_customer_id->GetValue());
                    $this->nama_jabatan->SetValue($this->DataSource->nama_jabatan->GetValue());
                    $this->nama_kota_owner->SetValue($this->DataSource->nama_kota_owner->GetValue());
                    $this->nama_kecamatan_owner->SetValue($this->DataSource->nama_kecamatan_owner->GetValue());
                    $this->nama_kelurahan_owner->SetValue($this->DataSource->nama_kelurahan_owner->GetValue());
                    $this->address_rt_owner->SetValue($this->DataSource->address_rt_owner->GetValue());
                    $this->address_rw_owner->SetValue($this->DataSource->address_rw_owner->GetValue());
                    $this->zip_code_owner->SetValue($this->DataSource->zip_code_owner->GetValue());
                    $this->phone_no_owner->SetValue($this->DataSource->phone_no_owner->GetValue());
                    $this->mobile_no_owner->SetValue($this->DataSource->mobile_no_owner->GetValue());
                    $this->email_address->SetValue($this->DataSource->email_address->GetValue());
                    $this->address_name_owner->SetValue($this->DataSource->address_name_owner->GetValue());
                    $this->company_owner->SetValue($this->DataSource->company_owner->GetValue());
                    $this->updated_by1->SetValue($this->DataSource->updated_by1->GetValue());
                    $this->p_job_position_id->SetValue($this->DataSource->p_job_position_id->GetValue());
                    $this->p_region_id_kel_owner->SetValue($this->DataSource->p_region_id_kel_owner->GetValue());
                    $this->p_region_id_kec_owner->SetValue($this->DataSource->p_region_id_kec_owner->GetValue());
                    $this->p_region_id_owner->SetValue($this->DataSource->p_region_id_owner->GetValue());
                    $this->fax_no_owner->SetValue($this->DataSource->fax_no_owner->GetValue());
                    $this->address_no_owner->SetValue($this->DataSource->address_no_owner->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_custGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->company_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->company_brand->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npwd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vat_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->registration_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_kota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_rt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_rw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->zip_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->phone_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_address_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_kota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_p_region_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_p_region_id_kel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_p_region_id_kec->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_phone_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_mobile_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_fax_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_zip_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_kota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_phone_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_email->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_fax_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_zip_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_rt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_mobile_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fax_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mobile_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_rw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_address_rt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_address_rw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->active_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->last_satatus_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->activation_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->status_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_ayat->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_dtl_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_account_status_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_jabatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_kota_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_kecamatan_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_kelurahan_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_rt_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_rw_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->zip_code_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->phone_no_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mobile_no_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->email_address->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_name_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->company_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_job_position_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id_kel_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id_kec_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fax_no_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_no_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->t_cust_account_id->Show();
        $this->Button_Update->Show();
        $this->Button_Cancel->Show();
        $this->p_cust_account_id->Show();
        $this->p_custGridPage->Show();
        $this->p_region_id->Show();
        $this->p_region_id_kecamatan->Show();
        $this->p_region_id_kelurahan->Show();
        $this->updated_by->Show();
        $this->company_name->Show();
        $this->company_brand->Show();
        $this->npwd->Show();
        $this->vat_code->Show();
        $this->registration_date->Show();
        $this->nama_kota->Show();
        $this->nama_kecamatan->Show();
        $this->nama_kelurahan->Show();
        $this->address_rt->Show();
        $this->address_rw->Show();
        $this->zip_code->Show();
        $this->phone_no->Show();
        $this->p_vat_type_id->Show();
        $this->address_no->Show();
        $this->address_name->Show();
        $this->brand_address_name->Show();
        $this->brand_address_no->Show();
        $this->brand_kota->Show();
        $this->brand_kecamatan->Show();
        $this->brand_kelurahan->Show();
        $this->brand_p_region_id->Show();
        $this->brand_p_region_id_kel->Show();
        $this->brand_p_region_id_kec->Show();
        $this->brand_phone_no->Show();
        $this->brand_mobile_no->Show();
        $this->brand_fax_no->Show();
        $this->brand_zip_code->Show();
        $this->wp_name->Show();
        $this->wp_address_name->Show();
        $this->wp_address_no->Show();
        $this->wp_kota->Show();
        $this->wp_kecamatan->Show();
        $this->wp_kelurahan->Show();
        $this->wp_phone_no->Show();
        $this->wp_email->Show();
        $this->wp_fax_no->Show();
        $this->wp_zip_code->Show();
        $this->wp_p_region_id_kelurahan->Show();
        $this->wp_p_region_id_kecamatan->Show();
        $this->wp_p_region_id->Show();
        $this->wp_address_rt->Show();
        $this->wp_mobile_no->Show();
        $this->fax_no->Show();
        $this->mobile_no->Show();
        $this->wp_address_rw->Show();
        $this->brand_address_rt->Show();
        $this->brand_address_rw->Show();
        $this->active_date->Show();
        $this->last_satatus_date->Show();
        $this->activation_no->Show();
        $this->status_code->Show();
        $this->nama_ayat->Show();
        $this->p_vat_type_dtl_id->Show();
        $this->Button1->Show();
        $this->p_account_status_id->Show();
        $this->t_customer_id->Show();
        $this->nama_jabatan->Show();
        $this->nama_kota_owner->Show();
        $this->nama_kecamatan_owner->Show();
        $this->nama_kelurahan_owner->Show();
        $this->address_rt_owner->Show();
        $this->address_rw_owner->Show();
        $this->zip_code_owner->Show();
        $this->phone_no_owner->Show();
        $this->mobile_no_owner->Show();
        $this->email_address->Show();
        $this->address_name_owner->Show();
        $this->company_owner->Show();
        $this->updated_by1->Show();
        $this->p_job_position_id->Show();
        $this->p_region_id_kel_owner->Show();
        $this->p_region_id_kec_owner->Show();
        $this->p_region_id_owner->Show();
        $this->fax_no_owner->Show();
        $this->address_no_owner->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_cust_account_updateForm Class @94-FCB6E20C

class clst_cust_account_updateFormDataSource extends clsDBConnSIKP {  //t_cust_account_updateFormDataSource Class @94-3D3B7BED

//DataSource Variables @94-CD47D958
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $t_cust_account_id;
    var $p_cust_account_id;
    var $p_custGridPage;
    var $p_region_id;
    var $p_region_id_kecamatan;
    var $p_region_id_kelurahan;
    var $updated_by;
    var $company_name;
    var $company_brand;
    var $npwd;
    var $vat_code;
    var $registration_date;
    var $nama_kota;
    var $nama_kecamatan;
    var $nama_kelurahan;
    var $address_rt;
    var $address_rw;
    var $zip_code;
    var $phone_no;
    var $p_vat_type_id;
    var $address_no;
    var $address_name;
    var $brand_address_name;
    var $brand_address_no;
    var $brand_kota;
    var $brand_kecamatan;
    var $brand_kelurahan;
    var $brand_p_region_id;
    var $brand_p_region_id_kel;
    var $brand_p_region_id_kec;
    var $brand_phone_no;
    var $brand_mobile_no;
    var $brand_fax_no;
    var $brand_zip_code;
    var $wp_name;
    var $wp_address_name;
    var $wp_address_no;
    var $wp_kota;
    var $wp_kecamatan;
    var $wp_kelurahan;
    var $wp_phone_no;
    var $wp_email;
    var $wp_fax_no;
    var $wp_zip_code;
    var $wp_p_region_id_kelurahan;
    var $wp_p_region_id_kecamatan;
    var $wp_p_region_id;
    var $wp_address_rt;
    var $wp_mobile_no;
    var $fax_no;
    var $mobile_no;
    var $wp_address_rw;
    var $brand_address_rt;
    var $brand_address_rw;
    var $active_date;
    var $last_satatus_date;
    var $activation_no;
    var $status_code;
    var $nama_ayat;
    var $p_vat_type_dtl_id;
    var $p_account_status_id;
    var $t_customer_id;
    var $nama_jabatan;
    var $nama_kota_owner;
    var $nama_kecamatan_owner;
    var $nama_kelurahan_owner;
    var $address_rt_owner;
    var $address_rw_owner;
    var $zip_code_owner;
    var $phone_no_owner;
    var $mobile_no_owner;
    var $email_address;
    var $address_name_owner;
    var $company_owner;
    var $updated_by1;
    var $p_job_position_id;
    var $p_region_id_kel_owner;
    var $p_region_id_kec_owner;
    var $p_region_id_owner;
    var $fax_no_owner;
    var $address_no_owner;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-93CC5429
    function clst_cust_account_updateFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_cust_account_updateForm/Error";
        $this->Initialize();
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsText, "");
        
        $this->p_cust_account_id = new clsField("p_cust_account_id", ccsFloat, "");
        
        $this->p_custGridPage = new clsField("p_custGridPage", ccsText, "");
        
        $this->p_region_id = new clsField("p_region_id", ccsFloat, "");
        
        $this->p_region_id_kecamatan = new clsField("p_region_id_kecamatan", ccsText, "");
        
        $this->p_region_id_kelurahan = new clsField("p_region_id_kelurahan", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->company_name = new clsField("company_name", ccsText, "");
        
        $this->company_brand = new clsField("company_brand", ccsText, "");
        
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        
        $this->registration_date = new clsField("registration_date", ccsText, "");
        
        $this->nama_kota = new clsField("nama_kota", ccsText, "");
        
        $this->nama_kecamatan = new clsField("nama_kecamatan", ccsText, "");
        
        $this->nama_kelurahan = new clsField("nama_kelurahan", ccsText, "");
        
        $this->address_rt = new clsField("address_rt", ccsText, "");
        
        $this->address_rw = new clsField("address_rw", ccsText, "");
        
        $this->zip_code = new clsField("zip_code", ccsText, "");
        
        $this->phone_no = new clsField("phone_no", ccsText, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsText, "");
        
        $this->address_no = new clsField("address_no", ccsText, "");
        
        $this->address_name = new clsField("address_name", ccsText, "");
        
        $this->brand_address_name = new clsField("brand_address_name", ccsText, "");
        
        $this->brand_address_no = new clsField("brand_address_no", ccsText, "");
        
        $this->brand_kota = new clsField("brand_kota", ccsText, "");
        
        $this->brand_kecamatan = new clsField("brand_kecamatan", ccsText, "");
        
        $this->brand_kelurahan = new clsField("brand_kelurahan", ccsText, "");
        
        $this->brand_p_region_id = new clsField("brand_p_region_id", ccsFloat, "");
        
        $this->brand_p_region_id_kel = new clsField("brand_p_region_id_kel", ccsFloat, "");
        
        $this->brand_p_region_id_kec = new clsField("brand_p_region_id_kec", ccsFloat, "");
        
        $this->brand_phone_no = new clsField("brand_phone_no", ccsText, "");
        
        $this->brand_mobile_no = new clsField("brand_mobile_no", ccsText, "");
        
        $this->brand_fax_no = new clsField("brand_fax_no", ccsText, "");
        
        $this->brand_zip_code = new clsField("brand_zip_code", ccsText, "");
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->wp_address_name = new clsField("wp_address_name", ccsText, "");
        
        $this->wp_address_no = new clsField("wp_address_no", ccsText, "");
        
        $this->wp_kota = new clsField("wp_kota", ccsText, "");
        
        $this->wp_kecamatan = new clsField("wp_kecamatan", ccsText, "");
        
        $this->wp_kelurahan = new clsField("wp_kelurahan", ccsText, "");
        
        $this->wp_phone_no = new clsField("wp_phone_no", ccsText, "");
        
        $this->wp_email = new clsField("wp_email", ccsText, "");
        
        $this->wp_fax_no = new clsField("wp_fax_no", ccsText, "");
        
        $this->wp_zip_code = new clsField("wp_zip_code", ccsText, "");
        
        $this->wp_p_region_id_kelurahan = new clsField("wp_p_region_id_kelurahan", ccsFloat, "");
        
        $this->wp_p_region_id_kecamatan = new clsField("wp_p_region_id_kecamatan", ccsFloat, "");
        
        $this->wp_p_region_id = new clsField("wp_p_region_id", ccsFloat, "");
        
        $this->wp_address_rt = new clsField("wp_address_rt", ccsText, "");
        
        $this->wp_mobile_no = new clsField("wp_mobile_no", ccsText, "");
        
        $this->fax_no = new clsField("fax_no", ccsText, "");
        
        $this->mobile_no = new clsField("mobile_no", ccsText, "");
        
        $this->wp_address_rw = new clsField("wp_address_rw", ccsText, "");
        
        $this->brand_address_rt = new clsField("brand_address_rt", ccsText, "");
        
        $this->brand_address_rw = new clsField("brand_address_rw", ccsText, "");
        
        $this->active_date = new clsField("active_date", ccsText, "");
        
        $this->last_satatus_date = new clsField("last_satatus_date", ccsText, "");
        
        $this->activation_no = new clsField("activation_no", ccsText, "");
        
        $this->status_code = new clsField("status_code", ccsText, "");
        
        $this->nama_ayat = new clsField("nama_ayat", ccsText, "");
        
        $this->p_vat_type_dtl_id = new clsField("p_vat_type_dtl_id", ccsText, "");
        
        $this->p_account_status_id = new clsField("p_account_status_id", ccsText, "");
        
        $this->t_customer_id = new clsField("t_customer_id", ccsText, "");
        
        $this->nama_jabatan = new clsField("nama_jabatan", ccsText, "");
        
        $this->nama_kota_owner = new clsField("nama_kota_owner", ccsText, "");
        
        $this->nama_kecamatan_owner = new clsField("nama_kecamatan_owner", ccsText, "");
        
        $this->nama_kelurahan_owner = new clsField("nama_kelurahan_owner", ccsText, "");
        
        $this->address_rt_owner = new clsField("address_rt_owner", ccsText, "");
        
        $this->address_rw_owner = new clsField("address_rw_owner", ccsText, "");
        
        $this->zip_code_owner = new clsField("zip_code_owner", ccsText, "");
        
        $this->phone_no_owner = new clsField("phone_no_owner", ccsText, "");
        
        $this->mobile_no_owner = new clsField("mobile_no_owner", ccsText, "");
        
        $this->email_address = new clsField("email_address", ccsText, "");
        
        $this->address_name_owner = new clsField("address_name_owner", ccsText, "");
        
        $this->company_owner = new clsField("company_owner", ccsText, "");
        
        $this->updated_by1 = new clsField("updated_by1", ccsText, "");
        
        $this->p_job_position_id = new clsField("p_job_position_id", ccsText, "");
        
        $this->p_region_id_kel_owner = new clsField("p_region_id_kel_owner", ccsText, "");
        
        $this->p_region_id_kec_owner = new clsField("p_region_id_kec_owner", ccsText, "");
        
        $this->p_region_id_owner = new clsField("p_region_id_owner", ccsText, "");
        
        $this->fax_no_owner = new clsField("fax_no_owner", ccsText, "");
        
        $this->address_no_owner = new clsField("address_no_owner", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-71613F38
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_customer_id", ccsInteger, "", "", $this->Parameters["urlt_customer_id"], 0, false);
        $this->wp->AddParameter("2", "urlt_cust_account_id", ccsInteger, "", "", $this->Parameters["urlt_cust_account_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-EE453072
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT v.p_region_id as p_region_id_per, *,b.code AS nama_jabatan,\n" .
        "p.region_name as nama_kota_owner,\n" .
        "q.region_name as nama_kecamatan_owner,\n" .
        "r.region_name as nama_kelurahan_owner\n" .
        "FROM v_cust_account_update v\n" .
        "LEFT JOIN t_customer x ON x.t_customer_id=v.t_customer_id\n" .
        "LEFT JOIN p_job_position b ON x.p_job_position_id = b.p_job_position_id\n" .
        "left join p_region p on p.p_region_id = x.p_region_id_owner\n" .
        "left join p_region q on q.p_region_id = x.p_region_id_kec_owner\n" .
        "left join p_region r on r.p_region_id = x.p_region_id_kel_owner\n" .
        "WHERE v.t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . "\n" .
        "AND v.t_customer_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-1D71FB39
    function SetValues()
    {
        $this->t_cust_account_id->SetDBValue($this->f("t_cust_account_id"));
        $this->p_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->p_region_id->SetDBValue(trim($this->f("p_region_id_per")));
        $this->p_region_id_kecamatan->SetDBValue($this->f("p_region_id_kecamatan"));
        $this->p_region_id_kelurahan->SetDBValue($this->f("p_region_id_kelurahan"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->company_name->SetDBValue($this->f("company_name"));
        $this->company_brand->SetDBValue($this->f("company_brand"));
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->registration_date->SetDBValue($this->f("registration_date"));
        $this->nama_kota->SetDBValue($this->f("nama_kota"));
        $this->nama_kecamatan->SetDBValue($this->f("nama_kecamatan"));
        $this->nama_kelurahan->SetDBValue($this->f("nama_kelurahan"));
        $this->address_rt->SetDBValue($this->f("address_rt"));
        $this->address_rw->SetDBValue($this->f("address_rw"));
        $this->zip_code->SetDBValue($this->f("zip_code"));
        $this->phone_no->SetDBValue($this->f("phone_no"));
        $this->p_vat_type_id->SetDBValue($this->f("p_vat_type_id"));
        $this->address_no->SetDBValue($this->f("address_no"));
        $this->address_name->SetDBValue($this->f("address_name"));
        $this->brand_address_name->SetDBValue($this->f("brand_address_name"));
        $this->brand_address_no->SetDBValue($this->f("brand_address_no"));
        $this->brand_kota->SetDBValue($this->f("brand_kota"));
        $this->brand_kecamatan->SetDBValue($this->f("brand_kecamatan"));
        $this->brand_kelurahan->SetDBValue($this->f("brand_kelurahan"));
        $this->brand_p_region_id->SetDBValue(trim($this->f("brand_p_region_id")));
        $this->brand_p_region_id_kel->SetDBValue(trim($this->f("brand_p_region_id_kel")));
        $this->brand_p_region_id_kec->SetDBValue(trim($this->f("brand_p_region_id_kec")));
        $this->brand_phone_no->SetDBValue($this->f("brand_phone_no"));
        $this->brand_mobile_no->SetDBValue($this->f("brand_mobile_no"));
        $this->brand_fax_no->SetDBValue($this->f("brand_fax_no"));
        $this->brand_zip_code->SetDBValue($this->f("brand_zip_code"));
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->wp_address_name->SetDBValue($this->f("wp_address_name"));
        $this->wp_address_no->SetDBValue($this->f("wp_address_no"));
        $this->wp_kota->SetDBValue($this->f("wp_kota"));
        $this->wp_kecamatan->SetDBValue($this->f("wp_kecamatan"));
        $this->wp_kelurahan->SetDBValue($this->f("wp_kelurahan"));
        $this->wp_phone_no->SetDBValue($this->f("wp_phone_no"));
        $this->wp_email->SetDBValue($this->f("wp_email"));
        $this->wp_fax_no->SetDBValue($this->f("wp_fax_no"));
        $this->wp_zip_code->SetDBValue($this->f("wp_zip_code"));
        $this->wp_p_region_id_kelurahan->SetDBValue(trim($this->f("wp_p_region_id_kelurahan")));
        $this->wp_p_region_id_kecamatan->SetDBValue(trim($this->f("wp_p_region_id_kecamatan")));
        $this->wp_p_region_id->SetDBValue(trim($this->f("wp_p_region_id")));
        $this->wp_address_rt->SetDBValue($this->f("wp_address_rt"));
        $this->wp_mobile_no->SetDBValue($this->f("wp_mobile_no"));
        $this->fax_no->SetDBValue($this->f("fax_no"));
        $this->mobile_no->SetDBValue($this->f("mobile_no"));
        $this->wp_address_rw->SetDBValue($this->f("wp_address_rw"));
        $this->brand_address_rt->SetDBValue($this->f("brand_address_rt"));
        $this->brand_address_rw->SetDBValue($this->f("brand_address_rw"));
        $this->active_date->SetDBValue($this->f("active_date"));
        $this->last_satatus_date->SetDBValue($this->f("last_satatus_date"));
        $this->activation_no->SetDBValue($this->f("activation_no"));
        $this->status_code->SetDBValue($this->f("status_code"));
        $this->nama_ayat->SetDBValue($this->f("nama_ayat"));
        $this->p_vat_type_dtl_id->SetDBValue($this->f("p_vat_type_dtl_id"));
        $this->p_account_status_id->SetDBValue($this->f("p_account_status_id"));
        $this->t_customer_id->SetDBValue($this->f("t_customer_id"));
        $this->nama_jabatan->SetDBValue($this->f("nama_jabatan"));
        $this->nama_kota_owner->SetDBValue($this->f("nama_kota_owner"));
        $this->nama_kecamatan_owner->SetDBValue($this->f("nama_kecamatan_owner"));
        $this->nama_kelurahan_owner->SetDBValue($this->f("nama_kelurahan_owner"));
        $this->address_rt_owner->SetDBValue($this->f("address_rt_owner"));
        $this->address_rw_owner->SetDBValue($this->f("address_rw_owner"));
        $this->zip_code_owner->SetDBValue($this->f("zip_code_owner"));
        $this->phone_no_owner->SetDBValue($this->f("phone_no_owner"));
        $this->mobile_no_owner->SetDBValue($this->f("mobile_no_owner"));
        $this->email_address->SetDBValue($this->f("email_address"));
        $this->address_name_owner->SetDBValue($this->f("address_name_owner"));
        $this->company_owner->SetDBValue($this->f("company_owner"));
        $this->updated_by1->SetDBValue($this->f("updated_by"));
        $this->p_job_position_id->SetDBValue($this->f("p_job_position_id"));
        $this->p_region_id_kel_owner->SetDBValue($this->f("p_region_id_kel_owner"));
        $this->p_region_id_kec_owner->SetDBValue($this->f("p_region_id_kec_owner"));
        $this->p_region_id_owner->SetDBValue($this->f("p_region_id_owner"));
        $this->fax_no_owner->SetDBValue($this->f("fax_no_owner"));
        $this->address_no_owner->SetDBValue($this->f("address_no_owner"));
    }
//End SetValues Method

//Update Method @94-57D90503
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_vat_type_id"] = new clsSQLParameter("ctrlp_vat_type_id", ccsFloat, "", "", $this->p_vat_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["registration_date"] = new clsSQLParameter("ctrlregistration_date", ccsText, "", "", $this->registration_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["company_name"] = new clsSQLParameter("ctrlcompany_name", ccsText, "", "", $this->company_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["company_brand"] = new clsSQLParameter("ctrlcompany_brand", ccsText, "", "", $this->company_brand->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_no"] = new clsSQLParameter("ctrladdress_no", ccsText, "", "", $this->address_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_name"] = new clsSQLParameter("ctrladdress_name", ccsText, "", "", $this->address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rt"] = new clsSQLParameter("ctrladdress_rt", ccsText, "", "", $this->address_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rw"] = new clsSQLParameter("ctrladdress_rw", ccsText, "", "", $this->address_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_kelurahan"] = new clsSQLParameter("ctrlp_region_id_kelurahan", ccsText, "", "", $this->p_region_id_kelurahan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_kecamatan"] = new clsSQLParameter("ctrlp_region_id_kecamatan", ccsText, "", "", $this->p_region_id_kecamatan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id"] = new clsSQLParameter("ctrlp_region_id", ccsText, "", "", $this->p_region_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["phone_no"] = new clsSQLParameter("ctrlphone_no", ccsText, "", "", $this->phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobile_no"] = new clsSQLParameter("ctrlmobile_no", ccsText, "", "", $this->mobile_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["fax_no"] = new clsSQLParameter("ctrlfax_no", ccsText, "", "", $this->fax_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["zip_code"] = new clsSQLParameter("ctrlzip_code", ccsText, "", "", $this->zip_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("ctrlupdated_by", ccsText, "", "", $this->updated_by->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_cust_account_id"] = new clsSQLParameter("ctrlt_cust_account_id", ccsText, "", "", $this->t_cust_account_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["npwd"] = new clsSQLParameter("ctrlnpwd", ccsText, "", "", $this->npwd->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_name"] = new clsSQLParameter("ctrlwp_name", ccsText, "", "", $this->wp_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_address_name"] = new clsSQLParameter("ctrlwp_address_name", ccsText, "", "", $this->wp_address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_address_no"] = new clsSQLParameter("ctrlwp_address_no", ccsText, "", "", $this->wp_address_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_address_rt"] = new clsSQLParameter("ctrlwp_address_rt", ccsText, "", "", $this->wp_address_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_address_rw"] = new clsSQLParameter("ctrlwp_address_rw", ccsText, "", "", $this->wp_address_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kelurahan"] = new clsSQLParameter("ctrlwp_p_region_id_kelurahan", ccsFloat, "", "", $this->wp_p_region_id_kelurahan->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kecamatan"] = new clsSQLParameter("ctrlwp_p_region_id_kecamatan", ccsFloat, "", "", $this->wp_p_region_id_kecamatan->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id"] = new clsSQLParameter("ctrlwp_p_region_id", ccsFloat, "", "", $this->wp_p_region_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["wp_phone_no"] = new clsSQLParameter("ctrlwp_phone_no", ccsText, "", "", $this->wp_phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_mobile_no"] = new clsSQLParameter("ctrlwp_mobile_no", ccsText, "", "", $this->wp_mobile_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_fax_no"] = new clsSQLParameter("ctrlwp_fax_no", ccsText, "", "", $this->wp_fax_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_zip_code"] = new clsSQLParameter("ctrlwp_zip_code", ccsText, "", "", $this->wp_zip_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_email"] = new clsSQLParameter("ctrlwp_email", ccsText, "", "", $this->wp_email->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brand_address_name"] = new clsSQLParameter("ctrlbrand_address_name", ccsText, "", "", $this->brand_address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brand_address_no"] = new clsSQLParameter("ctrlbrand_address_no", ccsText, "", "", $this->brand_address_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brand_address_rt"] = new clsSQLParameter("ctrlbrand_address_rt", ccsText, "", "", $this->brand_address_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brand_address_rw"] = new clsSQLParameter("ctrlbrand_address_rw", ccsText, "", "", $this->brand_address_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brand_p_region_id_kel"] = new clsSQLParameter("ctrlbrand_p_region_id_kel", ccsFloat, "", "", $this->brand_p_region_id_kel->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["brand_p_region_id_kec"] = new clsSQLParameter("ctrlbrand_p_region_id_kec", ccsFloat, "", "", $this->brand_p_region_id_kec->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["brand_p_region_id"] = new clsSQLParameter("ctrlbrand_p_region_id", ccsFloat, "", "", $this->brand_p_region_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["brand_phone_no"] = new clsSQLParameter("ctrlbrand_phone_no", ccsText, "", "", $this->brand_phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brand_mobile_no"] = new clsSQLParameter("ctrlbrand_mobile_no", ccsText, "", "", $this->brand_mobile_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brand_fax_no"] = new clsSQLParameter("ctrlbrand_fax_no", ccsText, "", "", $this->brand_fax_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brand_zip_code"] = new clsSQLParameter("ctrlbrand_zip_code", ccsText, "", "", $this->brand_zip_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_account_status_id"] = new clsSQLParameter("ctrlp_account_status_id", ccsFloat, "", "", $this->p_account_status_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["activation_no"] = new clsSQLParameter("ctrlactivation_no", ccsText, "", "", $this->activation_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_vat_type_dtl_id"] = new clsSQLParameter("ctrlp_vat_type_dtl_id", ccsFloat, "", "", $this->p_vat_type_dtl_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["modification_by"] = new clsSQLParameter("expr651", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["company_owner"] = new clsSQLParameter("ctrlcompany_owner", ccsText, "", "", $this->company_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_job_position_id"] = new clsSQLParameter("ctrlp_job_position_id", ccsInteger, "", "", $this->p_job_position_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["address_name_owner"] = new clsSQLParameter("ctrladdress_name_owner", ccsText, "", "", $this->address_name_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_no_owner"] = new clsSQLParameter("ctrladdress_no_owner", ccsText, "", "", $this->address_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rt_owner"] = new clsSQLParameter("ctrladdress_rt_owner", ccsText, "", "", $this->address_rt_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rw_owner"] = new clsSQLParameter("ctrladdress_rw_owner", ccsText, "", "", $this->address_rw_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_owner"] = new clsSQLParameter("ctrlp_region_id_owner", ccsInteger, "", "", $this->p_region_id_owner->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_region_id_kec_owner"] = new clsSQLParameter("ctrlp_region_id_kec_owner", ccsInteger, "", "", $this->p_region_id_kec_owner->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_region_id_kel_owner"] = new clsSQLParameter("ctrlp_region_id_kel_owner", ccsInteger, "", "", $this->p_region_id_kel_owner->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["phone_no_owner"] = new clsSQLParameter("ctrlphone_no_owner", ccsText, "", "", $this->phone_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["fax_no_owner"] = new clsSQLParameter("ctrlfax_no_owner", ccsText, "", "", $this->fax_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobile_no_owner"] = new clsSQLParameter("ctrlmobile_no_owner", ccsText, "", "", $this->mobile_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["email_address"] = new clsSQLParameter("ctrlemail_address", ccsText, "", "", $this->email_address->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["zip_code_owner"] = new clsSQLParameter("ctrlzip_code_owner", ccsText, "", "", $this->zip_code_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_customer_id"] = new clsSQLParameter("ctrlt_customer_id", ccsInteger, "", "", $this->t_customer_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_vat_type_id"]->GetValue()) and !strlen($this->cp["p_vat_type_id"]->GetText()) and !is_bool($this->cp["p_vat_type_id"]->GetValue())) 
            $this->cp["p_vat_type_id"]->SetValue($this->p_vat_type_id->GetValue(true));
        if (!strlen($this->cp["p_vat_type_id"]->GetText()) and !is_bool($this->cp["p_vat_type_id"]->GetValue(true))) 
            $this->cp["p_vat_type_id"]->SetText(0);
        if (!is_null($this->cp["registration_date"]->GetValue()) and !strlen($this->cp["registration_date"]->GetText()) and !is_bool($this->cp["registration_date"]->GetValue())) 
            $this->cp["registration_date"]->SetValue($this->registration_date->GetValue(true));
        if (!is_null($this->cp["company_name"]->GetValue()) and !strlen($this->cp["company_name"]->GetText()) and !is_bool($this->cp["company_name"]->GetValue())) 
            $this->cp["company_name"]->SetValue($this->company_name->GetValue(true));
        if (!is_null($this->cp["company_brand"]->GetValue()) and !strlen($this->cp["company_brand"]->GetText()) and !is_bool($this->cp["company_brand"]->GetValue())) 
            $this->cp["company_brand"]->SetValue($this->company_brand->GetValue(true));
        if (!is_null($this->cp["address_no"]->GetValue()) and !strlen($this->cp["address_no"]->GetText()) and !is_bool($this->cp["address_no"]->GetValue())) 
            $this->cp["address_no"]->SetValue($this->address_no->GetValue(true));
        if (!is_null($this->cp["address_name"]->GetValue()) and !strlen($this->cp["address_name"]->GetText()) and !is_bool($this->cp["address_name"]->GetValue())) 
            $this->cp["address_name"]->SetValue($this->address_name->GetValue(true));
        if (!is_null($this->cp["address_rt"]->GetValue()) and !strlen($this->cp["address_rt"]->GetText()) and !is_bool($this->cp["address_rt"]->GetValue())) 
            $this->cp["address_rt"]->SetValue($this->address_rt->GetValue(true));
        if (!is_null($this->cp["address_rw"]->GetValue()) and !strlen($this->cp["address_rw"]->GetText()) and !is_bool($this->cp["address_rw"]->GetValue())) 
            $this->cp["address_rw"]->SetValue($this->address_rw->GetValue(true));
        if (!is_null($this->cp["p_region_id_kelurahan"]->GetValue()) and !strlen($this->cp["p_region_id_kelurahan"]->GetText()) and !is_bool($this->cp["p_region_id_kelurahan"]->GetValue())) 
            $this->cp["p_region_id_kelurahan"]->SetValue($this->p_region_id_kelurahan->GetValue(true));
        if (!is_null($this->cp["p_region_id_kecamatan"]->GetValue()) and !strlen($this->cp["p_region_id_kecamatan"]->GetText()) and !is_bool($this->cp["p_region_id_kecamatan"]->GetValue())) 
            $this->cp["p_region_id_kecamatan"]->SetValue($this->p_region_id_kecamatan->GetValue(true));
        if (!is_null($this->cp["p_region_id"]->GetValue()) and !strlen($this->cp["p_region_id"]->GetText()) and !is_bool($this->cp["p_region_id"]->GetValue())) 
            $this->cp["p_region_id"]->SetValue($this->p_region_id->GetValue(true));
        if (!is_null($this->cp["phone_no"]->GetValue()) and !strlen($this->cp["phone_no"]->GetText()) and !is_bool($this->cp["phone_no"]->GetValue())) 
            $this->cp["phone_no"]->SetValue($this->phone_no->GetValue(true));
        if (!is_null($this->cp["mobile_no"]->GetValue()) and !strlen($this->cp["mobile_no"]->GetText()) and !is_bool($this->cp["mobile_no"]->GetValue())) 
            $this->cp["mobile_no"]->SetValue($this->mobile_no->GetValue(true));
        if (!is_null($this->cp["fax_no"]->GetValue()) and !strlen($this->cp["fax_no"]->GetText()) and !is_bool($this->cp["fax_no"]->GetValue())) 
            $this->cp["fax_no"]->SetValue($this->fax_no->GetValue(true));
        if (!is_null($this->cp["zip_code"]->GetValue()) and !strlen($this->cp["zip_code"]->GetText()) and !is_bool($this->cp["zip_code"]->GetValue())) 
            $this->cp["zip_code"]->SetValue($this->zip_code->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue($this->updated_by->GetValue(true));
        if (!is_null($this->cp["t_cust_account_id"]->GetValue()) and !strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue())) 
            $this->cp["t_cust_account_id"]->SetValue($this->t_cust_account_id->GetValue(true));
        if (!is_null($this->cp["npwd"]->GetValue()) and !strlen($this->cp["npwd"]->GetText()) and !is_bool($this->cp["npwd"]->GetValue())) 
            $this->cp["npwd"]->SetValue($this->npwd->GetValue(true));
        if (!is_null($this->cp["wp_name"]->GetValue()) and !strlen($this->cp["wp_name"]->GetText()) and !is_bool($this->cp["wp_name"]->GetValue())) 
            $this->cp["wp_name"]->SetValue($this->wp_name->GetValue(true));
        if (!is_null($this->cp["wp_address_name"]->GetValue()) and !strlen($this->cp["wp_address_name"]->GetText()) and !is_bool($this->cp["wp_address_name"]->GetValue())) 
            $this->cp["wp_address_name"]->SetValue($this->wp_address_name->GetValue(true));
        if (!is_null($this->cp["wp_address_no"]->GetValue()) and !strlen($this->cp["wp_address_no"]->GetText()) and !is_bool($this->cp["wp_address_no"]->GetValue())) 
            $this->cp["wp_address_no"]->SetValue($this->wp_address_no->GetValue(true));
        if (!is_null($this->cp["wp_address_rt"]->GetValue()) and !strlen($this->cp["wp_address_rt"]->GetText()) and !is_bool($this->cp["wp_address_rt"]->GetValue())) 
            $this->cp["wp_address_rt"]->SetValue($this->wp_address_rt->GetValue(true));
        if (!is_null($this->cp["wp_address_rw"]->GetValue()) and !strlen($this->cp["wp_address_rw"]->GetText()) and !is_bool($this->cp["wp_address_rw"]->GetValue())) 
            $this->cp["wp_address_rw"]->SetValue($this->wp_address_rw->GetValue(true));
        if (!is_null($this->cp["wp_p_region_id_kelurahan"]->GetValue()) and !strlen($this->cp["wp_p_region_id_kelurahan"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kelurahan"]->GetValue())) 
            $this->cp["wp_p_region_id_kelurahan"]->SetValue($this->wp_p_region_id_kelurahan->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id_kelurahan"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kelurahan"]->GetValue(true))) 
            $this->cp["wp_p_region_id_kelurahan"]->SetText(0);
        if (!is_null($this->cp["wp_p_region_id_kecamatan"]->GetValue()) and !strlen($this->cp["wp_p_region_id_kecamatan"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kecamatan"]->GetValue())) 
            $this->cp["wp_p_region_id_kecamatan"]->SetValue($this->wp_p_region_id_kecamatan->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id_kecamatan"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kecamatan"]->GetValue(true))) 
            $this->cp["wp_p_region_id_kecamatan"]->SetText(0);
        if (!is_null($this->cp["wp_p_region_id"]->GetValue()) and !strlen($this->cp["wp_p_region_id"]->GetText()) and !is_bool($this->cp["wp_p_region_id"]->GetValue())) 
            $this->cp["wp_p_region_id"]->SetValue($this->wp_p_region_id->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id"]->GetText()) and !is_bool($this->cp["wp_p_region_id"]->GetValue(true))) 
            $this->cp["wp_p_region_id"]->SetText(0);
        if (!is_null($this->cp["wp_phone_no"]->GetValue()) and !strlen($this->cp["wp_phone_no"]->GetText()) and !is_bool($this->cp["wp_phone_no"]->GetValue())) 
            $this->cp["wp_phone_no"]->SetValue($this->wp_phone_no->GetValue(true));
        if (!is_null($this->cp["wp_mobile_no"]->GetValue()) and !strlen($this->cp["wp_mobile_no"]->GetText()) and !is_bool($this->cp["wp_mobile_no"]->GetValue())) 
            $this->cp["wp_mobile_no"]->SetValue($this->wp_mobile_no->GetValue(true));
        if (!is_null($this->cp["wp_fax_no"]->GetValue()) and !strlen($this->cp["wp_fax_no"]->GetText()) and !is_bool($this->cp["wp_fax_no"]->GetValue())) 
            $this->cp["wp_fax_no"]->SetValue($this->wp_fax_no->GetValue(true));
        if (!is_null($this->cp["wp_zip_code"]->GetValue()) and !strlen($this->cp["wp_zip_code"]->GetText()) and !is_bool($this->cp["wp_zip_code"]->GetValue())) 
            $this->cp["wp_zip_code"]->SetValue($this->wp_zip_code->GetValue(true));
        if (!is_null($this->cp["wp_email"]->GetValue()) and !strlen($this->cp["wp_email"]->GetText()) and !is_bool($this->cp["wp_email"]->GetValue())) 
            $this->cp["wp_email"]->SetValue($this->wp_email->GetValue(true));
        if (!is_null($this->cp["brand_address_name"]->GetValue()) and !strlen($this->cp["brand_address_name"]->GetText()) and !is_bool($this->cp["brand_address_name"]->GetValue())) 
            $this->cp["brand_address_name"]->SetValue($this->brand_address_name->GetValue(true));
        if (!is_null($this->cp["brand_address_no"]->GetValue()) and !strlen($this->cp["brand_address_no"]->GetText()) and !is_bool($this->cp["brand_address_no"]->GetValue())) 
            $this->cp["brand_address_no"]->SetValue($this->brand_address_no->GetValue(true));
        if (!is_null($this->cp["brand_address_rt"]->GetValue()) and !strlen($this->cp["brand_address_rt"]->GetText()) and !is_bool($this->cp["brand_address_rt"]->GetValue())) 
            $this->cp["brand_address_rt"]->SetValue($this->brand_address_rt->GetValue(true));
        if (!is_null($this->cp["brand_address_rw"]->GetValue()) and !strlen($this->cp["brand_address_rw"]->GetText()) and !is_bool($this->cp["brand_address_rw"]->GetValue())) 
            $this->cp["brand_address_rw"]->SetValue($this->brand_address_rw->GetValue(true));
        if (!is_null($this->cp["brand_p_region_id_kel"]->GetValue()) and !strlen($this->cp["brand_p_region_id_kel"]->GetText()) and !is_bool($this->cp["brand_p_region_id_kel"]->GetValue())) 
            $this->cp["brand_p_region_id_kel"]->SetValue($this->brand_p_region_id_kel->GetValue(true));
        if (!strlen($this->cp["brand_p_region_id_kel"]->GetText()) and !is_bool($this->cp["brand_p_region_id_kel"]->GetValue(true))) 
            $this->cp["brand_p_region_id_kel"]->SetText(0);
        if (!is_null($this->cp["brand_p_region_id_kec"]->GetValue()) and !strlen($this->cp["brand_p_region_id_kec"]->GetText()) and !is_bool($this->cp["brand_p_region_id_kec"]->GetValue())) 
            $this->cp["brand_p_region_id_kec"]->SetValue($this->brand_p_region_id_kec->GetValue(true));
        if (!strlen($this->cp["brand_p_region_id_kec"]->GetText()) and !is_bool($this->cp["brand_p_region_id_kec"]->GetValue(true))) 
            $this->cp["brand_p_region_id_kec"]->SetText(0);
        if (!is_null($this->cp["brand_p_region_id"]->GetValue()) and !strlen($this->cp["brand_p_region_id"]->GetText()) and !is_bool($this->cp["brand_p_region_id"]->GetValue())) 
            $this->cp["brand_p_region_id"]->SetValue($this->brand_p_region_id->GetValue(true));
        if (!strlen($this->cp["brand_p_region_id"]->GetText()) and !is_bool($this->cp["brand_p_region_id"]->GetValue(true))) 
            $this->cp["brand_p_region_id"]->SetText(0);
        if (!is_null($this->cp["brand_phone_no"]->GetValue()) and !strlen($this->cp["brand_phone_no"]->GetText()) and !is_bool($this->cp["brand_phone_no"]->GetValue())) 
            $this->cp["brand_phone_no"]->SetValue($this->brand_phone_no->GetValue(true));
        if (!is_null($this->cp["brand_mobile_no"]->GetValue()) and !strlen($this->cp["brand_mobile_no"]->GetText()) and !is_bool($this->cp["brand_mobile_no"]->GetValue())) 
            $this->cp["brand_mobile_no"]->SetValue($this->brand_mobile_no->GetValue(true));
        if (!is_null($this->cp["brand_fax_no"]->GetValue()) and !strlen($this->cp["brand_fax_no"]->GetText()) and !is_bool($this->cp["brand_fax_no"]->GetValue())) 
            $this->cp["brand_fax_no"]->SetValue($this->brand_fax_no->GetValue(true));
        if (!is_null($this->cp["brand_zip_code"]->GetValue()) and !strlen($this->cp["brand_zip_code"]->GetText()) and !is_bool($this->cp["brand_zip_code"]->GetValue())) 
            $this->cp["brand_zip_code"]->SetValue($this->brand_zip_code->GetValue(true));
        if (!is_null($this->cp["p_account_status_id"]->GetValue()) and !strlen($this->cp["p_account_status_id"]->GetText()) and !is_bool($this->cp["p_account_status_id"]->GetValue())) 
            $this->cp["p_account_status_id"]->SetValue($this->p_account_status_id->GetValue(true));
        if (!strlen($this->cp["p_account_status_id"]->GetText()) and !is_bool($this->cp["p_account_status_id"]->GetValue(true))) 
            $this->cp["p_account_status_id"]->SetText(0);
        if (!is_null($this->cp["activation_no"]->GetValue()) and !strlen($this->cp["activation_no"]->GetText()) and !is_bool($this->cp["activation_no"]->GetValue())) 
            $this->cp["activation_no"]->SetValue($this->activation_no->GetValue(true));
        if (!is_null($this->cp["p_vat_type_dtl_id"]->GetValue()) and !strlen($this->cp["p_vat_type_dtl_id"]->GetText()) and !is_bool($this->cp["p_vat_type_dtl_id"]->GetValue())) 
            $this->cp["p_vat_type_dtl_id"]->SetValue($this->p_vat_type_dtl_id->GetValue(true));
        if (!strlen($this->cp["p_vat_type_dtl_id"]->GetText()) and !is_bool($this->cp["p_vat_type_dtl_id"]->GetValue(true))) 
            $this->cp["p_vat_type_dtl_id"]->SetText(0);
        if (!is_null($this->cp["modification_by"]->GetValue()) and !strlen($this->cp["modification_by"]->GetText()) and !is_bool($this->cp["modification_by"]->GetValue())) 
            $this->cp["modification_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["company_owner"]->GetValue()) and !strlen($this->cp["company_owner"]->GetText()) and !is_bool($this->cp["company_owner"]->GetValue())) 
            $this->cp["company_owner"]->SetValue($this->company_owner->GetValue(true));
        if (!is_null($this->cp["p_job_position_id"]->GetValue()) and !strlen($this->cp["p_job_position_id"]->GetText()) and !is_bool($this->cp["p_job_position_id"]->GetValue())) 
            $this->cp["p_job_position_id"]->SetValue($this->p_job_position_id->GetValue(true));
        if (!strlen($this->cp["p_job_position_id"]->GetText()) and !is_bool($this->cp["p_job_position_id"]->GetValue(true))) 
            $this->cp["p_job_position_id"]->SetText(0);
        if (!is_null($this->cp["address_name_owner"]->GetValue()) and !strlen($this->cp["address_name_owner"]->GetText()) and !is_bool($this->cp["address_name_owner"]->GetValue())) 
            $this->cp["address_name_owner"]->SetValue($this->address_name_owner->GetValue(true));
        if (!is_null($this->cp["address_no_owner"]->GetValue()) and !strlen($this->cp["address_no_owner"]->GetText()) and !is_bool($this->cp["address_no_owner"]->GetValue())) 
            $this->cp["address_no_owner"]->SetValue($this->address_no_owner->GetValue(true));
        if (!is_null($this->cp["address_rt_owner"]->GetValue()) and !strlen($this->cp["address_rt_owner"]->GetText()) and !is_bool($this->cp["address_rt_owner"]->GetValue())) 
            $this->cp["address_rt_owner"]->SetValue($this->address_rt_owner->GetValue(true));
        if (!is_null($this->cp["address_rw_owner"]->GetValue()) and !strlen($this->cp["address_rw_owner"]->GetText()) and !is_bool($this->cp["address_rw_owner"]->GetValue())) 
            $this->cp["address_rw_owner"]->SetValue($this->address_rw_owner->GetValue(true));
        if (!is_null($this->cp["p_region_id_owner"]->GetValue()) and !strlen($this->cp["p_region_id_owner"]->GetText()) and !is_bool($this->cp["p_region_id_owner"]->GetValue())) 
            $this->cp["p_region_id_owner"]->SetValue($this->p_region_id_owner->GetValue(true));
        if (!strlen($this->cp["p_region_id_owner"]->GetText()) and !is_bool($this->cp["p_region_id_owner"]->GetValue(true))) 
            $this->cp["p_region_id_owner"]->SetText(0);
        if (!is_null($this->cp["p_region_id_kec_owner"]->GetValue()) and !strlen($this->cp["p_region_id_kec_owner"]->GetText()) and !is_bool($this->cp["p_region_id_kec_owner"]->GetValue())) 
            $this->cp["p_region_id_kec_owner"]->SetValue($this->p_region_id_kec_owner->GetValue(true));
        if (!strlen($this->cp["p_region_id_kec_owner"]->GetText()) and !is_bool($this->cp["p_region_id_kec_owner"]->GetValue(true))) 
            $this->cp["p_region_id_kec_owner"]->SetText(0);
        if (!is_null($this->cp["p_region_id_kel_owner"]->GetValue()) and !strlen($this->cp["p_region_id_kel_owner"]->GetText()) and !is_bool($this->cp["p_region_id_kel_owner"]->GetValue())) 
            $this->cp["p_region_id_kel_owner"]->SetValue($this->p_region_id_kel_owner->GetValue(true));
        if (!strlen($this->cp["p_region_id_kel_owner"]->GetText()) and !is_bool($this->cp["p_region_id_kel_owner"]->GetValue(true))) 
            $this->cp["p_region_id_kel_owner"]->SetText(0);
        if (!is_null($this->cp["phone_no_owner"]->GetValue()) and !strlen($this->cp["phone_no_owner"]->GetText()) and !is_bool($this->cp["phone_no_owner"]->GetValue())) 
            $this->cp["phone_no_owner"]->SetValue($this->phone_no_owner->GetValue(true));
        if (!is_null($this->cp["fax_no_owner"]->GetValue()) and !strlen($this->cp["fax_no_owner"]->GetText()) and !is_bool($this->cp["fax_no_owner"]->GetValue())) 
            $this->cp["fax_no_owner"]->SetValue($this->fax_no_owner->GetValue(true));
        if (!is_null($this->cp["mobile_no_owner"]->GetValue()) and !strlen($this->cp["mobile_no_owner"]->GetText()) and !is_bool($this->cp["mobile_no_owner"]->GetValue())) 
            $this->cp["mobile_no_owner"]->SetValue($this->mobile_no_owner->GetValue(true));
        if (!is_null($this->cp["email_address"]->GetValue()) and !strlen($this->cp["email_address"]->GetText()) and !is_bool($this->cp["email_address"]->GetValue())) 
            $this->cp["email_address"]->SetValue($this->email_address->GetValue(true));
        if (!is_null($this->cp["zip_code_owner"]->GetValue()) and !strlen($this->cp["zip_code_owner"]->GetText()) and !is_bool($this->cp["zip_code_owner"]->GetValue())) 
            $this->cp["zip_code_owner"]->SetValue($this->zip_code_owner->GetValue(true));
        if (!is_null($this->cp["t_customer_id"]->GetValue()) and !strlen($this->cp["t_customer_id"]->GetText()) and !is_bool($this->cp["t_customer_id"]->GetValue())) 
            $this->cp["t_customer_id"]->SetValue($this->t_customer_id->GetValue(true));
        if (!strlen($this->cp["t_customer_id"]->GetText()) and !is_bool($this->cp["t_customer_id"]->GetValue(true))) 
            $this->cp["t_customer_id"]->SetText(0);
        $this->SQL = "select * from f_update_cust_account (\n" .
        "" . $this->SQLValue($this->cp["t_cust_account_id"]->GetDBValue(), ccsText) . ",\n" .
        "" . $this->SQLValue($this->cp["t_customer_id"]->GetDBValue(), ccsInteger) . ",\n" .
        "'" . $this->SQLValue($this->cp["npwd"]->GetDBValue(), ccsText) . "',\n" .
        "" . $this->SQLValue($this->cp["p_vat_type_id"]->GetDBValue(), ccsFloat) . ",\n" .
        "" . $this->SQLValue($this->cp["p_vat_type_dtl_id"]->GetDBValue(), ccsFloat) . ",\n" .
        "'" . $this->SQLValue($this->cp["activation_no"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["company_name"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["address_name"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["address_no"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["address_rt"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["address_rw"]->GetDBValue(), ccsText) . "',\n" .
        "" . $this->SQLValue($this->cp["p_region_id"]->GetDBValue(), ccsText) . ",\n" .
        "" . $this->SQLValue($this->cp["p_region_id_kecamatan"]->GetDBValue(), ccsText) . ",\n" .
        "" . $this->SQLValue($this->cp["p_region_id_kelurahan"]->GetDBValue(), ccsText) . ",\n" .
        "'" . $this->SQLValue($this->cp["phone_no"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["mobile_no"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["fax_no"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["zip_code"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["company_brand"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["brand_address_name"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["brand_address_no"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["brand_address_rt"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["brand_address_rw"]->GetDBValue(), ccsText) . "',\n" .
        "" . $this->SQLValue($this->cp["brand_p_region_id"]->GetDBValue(), ccsFloat) . ",\n" .
        "" . $this->SQLValue($this->cp["brand_p_region_id_kec"]->GetDBValue(), ccsFloat) . ",\n" .
        "" . $this->SQLValue($this->cp["brand_p_region_id_kel"]->GetDBValue(), ccsFloat) . ",\n" .
        "'" . $this->SQLValue($this->cp["brand_phone_no"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["brand_mobile_no"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["brand_fax_no"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["brand_zip_code"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["wp_name"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["wp_address_name"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["wp_address_no"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["wp_address_rt"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["wp_address_rw"]->GetDBValue(), ccsText) . "',\n" .
        "" . $this->SQLValue($this->cp["wp_p_region_id"]->GetDBValue(), ccsFloat) . ",\n" .
        "" . $this->SQLValue($this->cp["wp_p_region_id_kecamatan"]->GetDBValue(), ccsFloat) . ",\n" .
        "" . $this->SQLValue($this->cp["wp_p_region_id_kelurahan"]->GetDBValue(), ccsFloat) . ",\n" .
        "'" . $this->SQLValue($this->cp["wp_phone_no"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["wp_mobile_no"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["wp_email"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["wp_fax_no"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["wp_zip_code"]->GetDBValue(), ccsText) . "', -- batas t_cust_account\n" .
        "'" . $this->SQLValue($this->cp["company_owner"]->GetDBValue(), ccsText) . "',\n" .
        "" . $this->SQLValue($this->cp["p_job_position_id"]->GetDBValue(), ccsInteger) . ",\n" .
        "'" . $this->SQLValue($this->cp["address_name_owner"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["address_no_owner"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["address_rt_owner"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["address_rw_owner"]->GetDBValue(), ccsText) . "',\n" .
        "" . $this->SQLValue($this->cp["p_region_id_owner"]->GetDBValue(), ccsInteger) . ",\n" .
        "" . $this->SQLValue($this->cp["p_region_id_kec_owner"]->GetDBValue(), ccsInteger) . ",\n" .
        "" . $this->SQLValue($this->cp["p_region_id_kel_owner"]->GetDBValue(), ccsInteger) . ",\n" .
        "'" . $this->SQLValue($this->cp["phone_no_owner"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["fax_no_owner"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["mobile_no_owner"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["email_address"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["zip_code_owner"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["modification_by"]->GetDBValue(), ccsText) . "'\n" .
        ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End t_cust_account_updateFormDataSource Class @94-FCB6E20C

class clsRecordp_cust_account_updateSearch { //p_cust_account_updateSearch Class @3-4B7695CB

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

//Class_Initialize Event @3-0194549F
    function clsRecordp_cust_account_updateSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_cust_account_updateSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_cust_account_updateSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_keyword = & new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->t_customer_id = & new clsControl(ccsHidden, "t_customer_id", "t_customer_id", ccsFloat, "", CCGetRequestParam("t_customer_id", $Method, NULL), $this);
            $this->customer_name = & new clsControl(ccsHidden, "customer_name", "customer_name", ccsText, "", CCGetRequestParam("customer_name", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-66FE111F
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->t_customer_id->Validate() && $Validation);
        $Validation = ($this->customer_name->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->customer_name->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-8697DFE7
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->t_customer_id->Errors->Count());
        $errors = ($errors || $this->customer_name->Errors->Count());
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

//Operation Method @3-B4EB9729
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "t_customer.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_customer.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-330A6882
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
            $Error = ComposeStrings($Error, $this->s_keyword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->customer_name->Errors->ToString());
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

        $this->Button_DoSearch->Show();
        $this->s_keyword->Show();
        $this->t_customer_id->Show();
        $this->customer_name->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End p_cust_account_updateSearch Class @3-FCB6E20C

//Initialize Page @1-F9172592
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
$TemplateFileName = "t_cust_account_update.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-74C20CA8
include_once("./t_cust_account_update_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A30EFC85
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_custAccountGrid = & new clsGridt_custAccountGrid("", $MainPage);
$t_cust_account_updateForm = & new clsRecordt_cust_account_updateForm("", $MainPage);
$p_cust_account_updateSearch = & new clsRecordp_cust_account_updateSearch("", $MainPage);
$MainPage->t_custAccountGrid = & $t_custAccountGrid;
$MainPage->t_cust_account_updateForm = & $t_cust_account_updateForm;
$MainPage->p_cust_account_updateSearch = & $p_cust_account_updateSearch;
$t_custAccountGrid->Initialize();
$t_cust_account_updateForm->Initialize();

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

//Execute Components @1-9D5581C4
$t_cust_account_updateForm->Operation();
$p_cust_account_updateSearch->Operation();
//End Execute Components

//Go to destination page @1-DD926DBF
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_custAccountGrid);
    unset($t_cust_account_updateForm);
    unset($p_cust_account_updateSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-FA2F46E4
$t_custAccountGrid->Show();
$t_cust_account_updateForm->Show();
$p_cust_account_updateSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-4A724523
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_custAccountGrid);
unset($t_cust_account_updateForm);
unset($p_cust_account_updateSearch);
unset($Tpl);
//End Unload Page


?>
