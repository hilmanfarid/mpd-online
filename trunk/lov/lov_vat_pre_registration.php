<?php
//Include Common Files @1-66C21BC7
define("RelativePath", "..");
define("PathToCurrentPage", "/lov/");
define("FileName", "lov_vat_pre_registration.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridLOV_REGION { //LOV_REGION class @2-0DD88139

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

//Class_Initialize Event @2-CF38140C
    function clsGridLOV_REGION($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "LOV_REGION";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid LOV_REGION";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsLOV_REGIONDataSource($this);
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

        $this->company_brand = & new clsControl(ccsLabel, "company_brand", "company_brand", ccsText, "", CCGetRequestParam("company_brand", ccsGet, NULL), $this);
        $this->PILIH = & new clsControl(ccsLabel, "PILIH", "PILIH", ccsText, "", CCGetRequestParam("PILIH", ccsGet, NULL), $this);
        $this->PILIH->HTML = true;
        $this->t_vat_pre_registration_id = & new clsControl(ccsTextBox, "t_vat_pre_registration_id", "t_vat_pre_registration_id", ccsText, "", CCGetRequestParam("t_vat_pre_registration_id", ccsGet, NULL), $this);
        $this->t_vat_pre_registration_id->Visible = false;
        $this->brand_address_rt = & new clsControl(ccsTextBox, "brand_address_rt", "brand_address_rt", ccsText, "", CCGetRequestParam("brand_address_rt", ccsGet, NULL), $this);
        $this->brand_address_rt->Visible = false;
        $this->brand_address_no = & new clsControl(ccsLabel, "brand_address_no", "brand_address_no", ccsText, "", CCGetRequestParam("brand_address_no", ccsGet, NULL), $this);
        $this->brand_address_rw = & new clsControl(ccsTextBox, "brand_address_rw", "brand_address_rw", ccsText, "", CCGetRequestParam("brand_address_rw", ccsGet, NULL), $this);
        $this->brand_address_rw->Visible = false;
        $this->brand_address_name = & new clsControl(ccsLabel, "brand_address_name", "brand_address_name", ccsText, "", CCGetRequestParam("brand_address_name", ccsGet, NULL), $this);
        $this->brand_p_region_id = & new clsControl(ccsTextBox, "brand_p_region_id", "brand_p_region_id", ccsText, "", CCGetRequestParam("brand_p_region_id", ccsGet, NULL), $this);
        $this->brand_p_region_id->Visible = false;
        $this->brand_p_region_id_kel = & new clsControl(ccsTextBox, "brand_p_region_id_kel", "brand_p_region_id_kel", ccsText, "", CCGetRequestParam("brand_p_region_id_kel", ccsGet, NULL), $this);
        $this->brand_p_region_id_kel->Visible = false;
        $this->brand_p_region_id_kec = & new clsControl(ccsTextBox, "brand_p_region_id_kec", "brand_p_region_id_kec", ccsText, "", CCGetRequestParam("brand_p_region_id_kec", ccsGet, NULL), $this);
        $this->brand_p_region_id_kec->Visible = false;
        $this->brand_phone_no = & new clsControl(ccsTextBox, "brand_phone_no", "brand_phone_no", ccsText, "", CCGetRequestParam("brand_phone_no", ccsGet, NULL), $this);
        $this->brand_phone_no->Visible = false;
        $this->brand_mobile_no = & new clsControl(ccsTextBox, "brand_mobile_no", "brand_mobile_no", ccsText, "", CCGetRequestParam("brand_mobile_no", ccsGet, NULL), $this);
        $this->brand_mobile_no->Visible = false;
        $this->brand_fax_no = & new clsControl(ccsTextBox, "brand_fax_no", "brand_fax_no", ccsText, "", CCGetRequestParam("brand_fax_no", ccsGet, NULL), $this);
        $this->brand_fax_no->Visible = false;
        $this->brand_zip_code = & new clsControl(ccsTextBox, "brand_zip_code", "brand_zip_code", ccsText, "", CCGetRequestParam("brand_zip_code", ccsGet, NULL), $this);
        $this->brand_zip_code->Visible = false;
        $this->kota = & new clsControl(ccsTextBox, "kota", "kota", ccsText, "", CCGetRequestParam("kota", ccsGet, NULL), $this);
        $this->kota->Visible = false;
        $this->kec = & new clsControl(ccsTextBox, "kec", "kec", ccsText, "", CCGetRequestParam("kec", ccsGet, NULL), $this);
        $this->kec->Visible = false;
        $this->kel = & new clsControl(ccsTextBox, "kel", "kel", ccsText, "", CCGetRequestParam("kel", ccsGet, NULL), $this);
        $this->kel->Visible = false;
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
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

//Show Method @2-A3242158
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr39"] = 3;
        $this->DataSource->Parameters["expr40"] = 4;
        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);

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
            $this->ControlsVisible["company_brand"] = $this->company_brand->Visible;
            $this->ControlsVisible["PILIH"] = $this->PILIH->Visible;
            $this->ControlsVisible["t_vat_pre_registration_id"] = $this->t_vat_pre_registration_id->Visible;
            $this->ControlsVisible["brand_address_rt"] = $this->brand_address_rt->Visible;
            $this->ControlsVisible["brand_address_no"] = $this->brand_address_no->Visible;
            $this->ControlsVisible["brand_address_rw"] = $this->brand_address_rw->Visible;
            $this->ControlsVisible["brand_address_name"] = $this->brand_address_name->Visible;
            $this->ControlsVisible["brand_p_region_id"] = $this->brand_p_region_id->Visible;
            $this->ControlsVisible["brand_p_region_id_kel"] = $this->brand_p_region_id_kel->Visible;
            $this->ControlsVisible["brand_p_region_id_kec"] = $this->brand_p_region_id_kec->Visible;
            $this->ControlsVisible["brand_phone_no"] = $this->brand_phone_no->Visible;
            $this->ControlsVisible["brand_mobile_no"] = $this->brand_mobile_no->Visible;
            $this->ControlsVisible["brand_fax_no"] = $this->brand_fax_no->Visible;
            $this->ControlsVisible["brand_zip_code"] = $this->brand_zip_code->Visible;
            $this->ControlsVisible["kota"] = $this->kota->Visible;
            $this->ControlsVisible["kec"] = $this->kec->Visible;
            $this->ControlsVisible["kel"] = $this->kel->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->company_brand->SetValue($this->DataSource->company_brand->GetValue());
                $this->t_vat_pre_registration_id->SetValue($this->DataSource->t_vat_pre_registration_id->GetValue());
                $this->brand_address_rt->SetValue($this->DataSource->brand_address_rt->GetValue());
                $this->brand_address_no->SetValue($this->DataSource->brand_address_no->GetValue());
                $this->brand_address_rw->SetValue($this->DataSource->brand_address_rw->GetValue());
                $this->brand_address_name->SetValue($this->DataSource->brand_address_name->GetValue());
                $this->brand_p_region_id->SetValue($this->DataSource->brand_p_region_id->GetValue());
                $this->brand_p_region_id_kel->SetValue($this->DataSource->brand_p_region_id_kel->GetValue());
                $this->brand_p_region_id_kec->SetValue($this->DataSource->brand_p_region_id_kec->GetValue());
                $this->brand_phone_no->SetValue($this->DataSource->brand_phone_no->GetValue());
                $this->brand_mobile_no->SetValue($this->DataSource->brand_mobile_no->GetValue());
                $this->brand_fax_no->SetValue($this->DataSource->brand_fax_no->GetValue());
                $this->brand_zip_code->SetValue($this->DataSource->brand_zip_code->GetValue());
                $this->kota->SetValue($this->DataSource->kota->GetValue());
                $this->kec->SetValue($this->DataSource->kec->GetValue());
                $this->kel->SetValue($this->DataSource->kel->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->company_brand->Show();
                $this->PILIH->Show();
                $this->t_vat_pre_registration_id->Show();
                $this->brand_address_rt->Show();
                $this->brand_address_no->Show();
                $this->brand_address_rw->Show();
                $this->brand_address_name->Show();
                $this->brand_p_region_id->Show();
                $this->brand_p_region_id_kel->Show();
                $this->brand_p_region_id_kec->Show();
                $this->brand_phone_no->Show();
                $this->brand_mobile_no->Show();
                $this->brand_fax_no->Show();
                $this->brand_zip_code->Show();
                $this->kota->Show();
                $this->kec->Show();
                $this->kel->Show();
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

//GetErrors Method @2-78ECDA43
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->company_brand->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PILIH->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_pre_registration_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->brand_address_rt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->brand_address_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->brand_address_rw->Errors->ToString());
        $errors = ComposeStrings($errors, $this->brand_address_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->brand_p_region_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->brand_p_region_id_kel->Errors->ToString());
        $errors = ComposeStrings($errors, $this->brand_p_region_id_kec->Errors->ToString());
        $errors = ComposeStrings($errors, $this->brand_phone_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->brand_mobile_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->brand_fax_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->brand_zip_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->kota->Errors->ToString());
        $errors = ComposeStrings($errors, $this->kec->Errors->ToString());
        $errors = ComposeStrings($errors, $this->kel->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End LOV_REGION Class @2-FCB6E20C

class clsLOV_REGIONDataSource extends clsDBConnSIKP {  //LOV_REGIONDataSource Class @2-C8BC3AE9

//DataSource Variables @2-36C3E8D6
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $company_brand;
    var $t_vat_pre_registration_id;
    var $brand_address_rt;
    var $brand_address_no;
    var $brand_address_rw;
    var $brand_address_name;
    var $brand_p_region_id;
    var $brand_p_region_id_kel;
    var $brand_p_region_id_kec;
    var $brand_phone_no;
    var $brand_mobile_no;
    var $brand_fax_no;
    var $brand_zip_code;
    var $kota;
    var $kec;
    var $kel;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-F6FB273F
    function clsLOV_REGIONDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid LOV_REGION";
        $this->Initialize();
        $this->company_brand = new clsField("company_brand", ccsText, "");
        
        $this->t_vat_pre_registration_id = new clsField("t_vat_pre_registration_id", ccsText, "");
        
        $this->brand_address_rt = new clsField("brand_address_rt", ccsText, "");
        
        $this->brand_address_no = new clsField("brand_address_no", ccsText, "");
        
        $this->brand_address_rw = new clsField("brand_address_rw", ccsText, "");
        
        $this->brand_address_name = new clsField("brand_address_name", ccsText, "");
        
        $this->brand_p_region_id = new clsField("brand_p_region_id", ccsText, "");
        
        $this->brand_p_region_id_kel = new clsField("brand_p_region_id_kel", ccsText, "");
        
        $this->brand_p_region_id_kec = new clsField("brand_p_region_id_kec", ccsText, "");
        
        $this->brand_phone_no = new clsField("brand_phone_no", ccsText, "");
        
        $this->brand_mobile_no = new clsField("brand_mobile_no", ccsText, "");
        
        $this->brand_fax_no = new clsField("brand_fax_no", ccsText, "");
        
        $this->brand_zip_code = new clsField("brand_zip_code", ccsText, "");
        
        $this->kota = new clsField("kota", ccsText, "");
        
        $this->kec = new clsField("kec", ccsText, "");
        
        $this->kel = new clsField("kel", ccsText, "");
        

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

//Prepare Method @2-E3EF1584
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr39", ccsFloat, "", "", $this->Parameters["expr39"], "", false);
        $this->wp->AddParameter("2", "expr40", ccsFloat, "", "", $this->Parameters["expr40"], "", false);
        $this->wp->AddParameter("3", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
    }
//End Prepare Method

//Open Method @2-EA87E8B3
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.*, b.region_name as kota,c.region_name as kec, d.region_name as kel\n" .
        "FROM t_vat_pre_registration a\n" .
        "left join p_region b on a.brand_p_region_id=b.p_region_id\n" .
        "left join p_region c on a.brand_p_region_id_kec=c.p_region_id\n" .
        "left join p_region d on a.brand_p_region_id_kel=d.p_region_id\n" .
        "WHERE ( upper(company_brand) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "%'\n" .
        "OR upper(brand_address_name) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "%' )) cnt";
        $this->SQL = "SELECT a.*, b.region_name as kota,c.region_name as kec, d.region_name as kel\n" .
        "FROM t_vat_pre_registration a\n" .
        "left join p_region b on a.brand_p_region_id=b.p_region_id\n" .
        "left join p_region c on a.brand_p_region_id_kec=c.p_region_id\n" .
        "left join p_region d on a.brand_p_region_id_kel=d.p_region_id\n" .
        "WHERE ( upper(company_brand) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "%'\n" .
        "OR upper(brand_address_name) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "%' )";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-38F77845
    function SetValues()
    {
        $this->company_brand->SetDBValue($this->f("company_brand"));
        $this->t_vat_pre_registration_id->SetDBValue($this->f("t_vat_pre_registration_id"));
        $this->brand_address_rt->SetDBValue($this->f("brand_address_rt"));
        $this->brand_address_no->SetDBValue($this->f("brand_address_no"));
        $this->brand_address_rw->SetDBValue($this->f("brand_address_rw"));
        $this->brand_address_name->SetDBValue($this->f("brand_address_name"));
        $this->brand_p_region_id->SetDBValue($this->f("brand_p_region_id"));
        $this->brand_p_region_id_kel->SetDBValue($this->f("brand_p_region_id_kel"));
        $this->brand_p_region_id_kec->SetDBValue($this->f("brand_p_region_id_kec"));
        $this->brand_phone_no->SetDBValue($this->f("brand_phone_no"));
        $this->brand_mobile_no->SetDBValue($this->f("brand_mobile_no"));
        $this->brand_fax_no->SetDBValue($this->f("brand_fax_no"));
        $this->brand_zip_code->SetDBValue($this->f("brand_zip_code"));
        $this->kota->SetDBValue($this->f("kota"));
        $this->kec->SetDBValue($this->f("kec"));
        $this->kel->SetDBValue($this->f("kel"));
    }
//End SetValues Method

} //End LOV_REGIONDataSource Class @2-FCB6E20C

class clsRecordLOV { //LOV Class @3-40E97705

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

//Class_Initialize Event @3-52BADD76
    function clsRecordLOV($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record LOV/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "LOV";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_keyword = & new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->FORM = & new clsControl(ccsTextBox, "FORM", "FORM", ccsText, "", CCGetRequestParam("FORM", $Method, NULL), $this);
            $this->OBJ = & new clsControl(ccsTextBox, "OBJ", "OBJ", ccsText, "", CCGetRequestParam("OBJ", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-FA63F6C6
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->FORM->Validate() && $Validation);
        $Validation = ($this->OBJ->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FORM->Errors->Count() == 0);
        $Validation =  $Validation && ($this->OBJ->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-FBB4E0E8
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->FORM->Errors->Count());
        $errors = ($errors || $this->OBJ->Errors->Count());
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

//Operation Method @3-FACF1E14
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
        $Redirect = "lov_vat_pre_registration.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "lov_vat_pre_registration.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-1DBEB16B
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
            $Error = ComposeStrings($Error, $this->FORM->Errors->ToString());
            $Error = ComposeStrings($Error, $this->OBJ->Errors->ToString());
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

        $this->s_keyword->Show();
        $this->Button_DoSearch->Show();
        $this->FORM->Show();
        $this->OBJ->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End LOV Class @3-FCB6E20C

//Initialize Page @1-CFBE8E80
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
$TemplateFileName = "lov_vat_pre_registration.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-17EF96C3
include_once("./lov_vat_pre_registration_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-FECF2F75
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$LOV_REGION = & new clsGridLOV_REGION("", $MainPage);
$LOV = & new clsRecordLOV("", $MainPage);
$MainPage->LOV_REGION = & $LOV_REGION;
$MainPage->LOV = & $LOV;
$LOV_REGION->Initialize();

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

//Execute Components @1-0F06B063
$LOV->Operation();
//End Execute Components

//Go to destination page @1-DF92BAF9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($LOV_REGION);
    unset($LOV);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-412788F2
$LOV_REGION->Show();
$LOV->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-8F4FFB94
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($LOV_REGION);
unset($LOV);
unset($Tpl);
//End Unload Page


?>
