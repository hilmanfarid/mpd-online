<?php
//Include Common Files @1-5F6EF36F
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "t_modifikasi_no_hp_wp.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_customerGrid { //t_customerGrid class @2-4EE8899F

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

//Class_Initialize Event @2-763FBA36
    function clsGridt_customerGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_customerGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_customerGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_customerGridDataSource($this);
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
        $this->DLink->Page = "t_modifikasi_no_hp_wp.php";
        $this->company_owner = & new clsControl(ccsLabel, "company_owner", "company_owner", ccsText, "", CCGetRequestParam("company_owner", ccsGet, NULL), $this);
        $this->email_address = & new clsControl(ccsLabel, "email_address", "email_address", ccsText, "", CCGetRequestParam("email_address", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsText, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "t_cust_account.php";
        $this->mobile_no_owner = & new clsControl(ccsLabel, "mobile_no_owner", "mobile_no_owner", ccsText, "", CCGetRequestParam("mobile_no_owner", ccsGet, NULL), $this);
        $this->address_name_owner = & new clsControl(ccsLabel, "address_name_owner", "address_name_owner", ccsText, "", CCGetRequestParam("address_name_owner", ccsGet, NULL), $this);
        $this->address_no_owner = & new clsControl(ccsLabel, "address_no_owner", "address_no_owner", ccsText, "", CCGetRequestParam("address_no_owner", ccsGet, NULL), $this);
        $this->address_rt_owner = & new clsControl(ccsLabel, "address_rt_owner", "address_rt_owner", ccsText, "", CCGetRequestParam("address_rt_owner", ccsGet, NULL), $this);
        $this->address_rw_owner = & new clsControl(ccsLabel, "address_rw_owner", "address_rw_owner", ccsText, "", CCGetRequestParam("address_rw_owner", ccsGet, NULL), $this);
        $this->npwd = & new clsControl(ccsLabel, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", ccsGet, NULL), $this);
        $this->nama_ayat = & new clsControl(ccsLabel, "nama_ayat", "nama_ayat", ccsText, "", CCGetRequestParam("nama_ayat", ccsGet, NULL), $this);
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

//Show Method @2-94FF24B6
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["urls_npwd"] = CCGetFromGet("s_npwd", NULL);
        $this->DataSource->Parameters["urls_wp_name"] = CCGetFromGet("s_wp_name", NULL);
        $this->DataSource->Parameters["urls_company_name"] = CCGetFromGet("s_company_name", NULL);
        $this->DataSource->Parameters["urls_company_brand"] = CCGetFromGet("s_company_brand", NULL);
        $this->DataSource->Parameters["urlp_vat_type_id"] = CCGetFromGet("p_vat_type_id", NULL);
        $this->DataSource->Parameters["urlp_vat_type_dtl_id"] = CCGetFromGet("p_vat_type_dtl_id", NULL);

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
            $this->ControlsVisible["company_owner"] = $this->company_owner->Visible;
            $this->ControlsVisible["email_address"] = $this->email_address->Visible;
            $this->ControlsVisible["t_cust_account_id"] = $this->t_cust_account_id->Visible;
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            $this->ControlsVisible["mobile_no_owner"] = $this->mobile_no_owner->Visible;
            $this->ControlsVisible["address_name_owner"] = $this->address_name_owner->Visible;
            $this->ControlsVisible["address_no_owner"] = $this->address_no_owner->Visible;
            $this->ControlsVisible["address_rt_owner"] = $this->address_rt_owner->Visible;
            $this->ControlsVisible["address_rw_owner"] = $this->address_rw_owner->Visible;
            $this->ControlsVisible["npwd"] = $this->npwd->Visible;
            $this->ControlsVisible["nama_ayat"] = $this->nama_ayat->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_cust_account_id", $this->DataSource->f("t_cust_account_id"));
                $this->company_owner->SetValue($this->DataSource->company_owner->GetValue());
                $this->email_address->SetValue($this->DataSource->email_address->GetValue());
                $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("s_keyword", "ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "t_customer_id", $this->DataSource->f("t_customer_id"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "customer_name", $this->DataSource->f("company_owner"));
                $this->mobile_no_owner->SetValue($this->DataSource->mobile_no_owner->GetValue());
                $this->address_name_owner->SetValue($this->DataSource->address_name_owner->GetValue());
                $this->address_no_owner->SetValue($this->DataSource->address_no_owner->GetValue());
                $this->address_rt_owner->SetValue($this->DataSource->address_rt_owner->GetValue());
                $this->address_rw_owner->SetValue($this->DataSource->address_rw_owner->GetValue());
                $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                $this->nama_ayat->SetValue($this->DataSource->nama_ayat->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->company_owner->Show();
                $this->email_address->Show();
                $this->t_cust_account_id->Show();
                $this->ImageLink1->Show();
                $this->mobile_no_owner->Show();
                $this->address_name_owner->Show();
                $this->address_no_owner->Show();
                $this->address_rt_owner->Show();
                $this->address_rw_owner->Show();
                $this->npwd->Show();
                $this->nama_ayat->Show();
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

//GetErrors Method @2-FD194EF3
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->company_owner->Errors->ToString());
        $errors = ComposeStrings($errors, $this->email_address->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_account_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->mobile_no_owner->Errors->ToString());
        $errors = ComposeStrings($errors, $this->address_name_owner->Errors->ToString());
        $errors = ComposeStrings($errors, $this->address_no_owner->Errors->ToString());
        $errors = ComposeStrings($errors, $this->address_rt_owner->Errors->ToString());
        $errors = ComposeStrings($errors, $this->address_rw_owner->Errors->ToString());
        $errors = ComposeStrings($errors, $this->npwd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nama_ayat->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_customerGrid Class @2-FCB6E20C

class clst_customerGridDataSource extends clsDBConnSIKP {  //t_customerGridDataSource Class @2-DC00010F

//DataSource Variables @2-B7B99B51
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $company_owner;
    var $email_address;
    var $t_cust_account_id;
    var $mobile_no_owner;
    var $address_name_owner;
    var $address_no_owner;
    var $address_rt_owner;
    var $address_rw_owner;
    var $npwd;
    var $nama_ayat;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-82906438
    function clst_customerGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_customerGrid";
        $this->Initialize();
        $this->company_owner = new clsField("company_owner", ccsText, "");
        
        $this->email_address = new clsField("email_address", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsText, "");
        
        $this->mobile_no_owner = new clsField("mobile_no_owner", ccsText, "");
        
        $this->address_name_owner = new clsField("address_name_owner", ccsText, "");
        
        $this->address_no_owner = new clsField("address_no_owner", ccsText, "");
        
        $this->address_rt_owner = new clsField("address_rt_owner", ccsText, "");
        
        $this->address_rw_owner = new clsField("address_rw_owner", ccsText, "");
        
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->nama_ayat = new clsField("nama_ayat", ccsText, "");
        

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

//Prepare Method @2-E9065F00
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urls_npwd", ccsText, "", "", $this->Parameters["urls_npwd"], "", false);
        $this->wp->AddParameter("3", "urls_wp_name", ccsText, "", "", $this->Parameters["urls_wp_name"], "", false);
        $this->wp->AddParameter("4", "urls_company_name", ccsText, "", "", $this->Parameters["urls_company_name"], "", false);
        $this->wp->AddParameter("5", "urls_company_brand", ccsText, "", "", $this->Parameters["urls_company_brand"], "", false);
        $this->wp->AddParameter("6", "urlp_vat_type_id", ccsText, "", "", $this->Parameters["urlp_vat_type_id"], "", false);
        $this->wp->AddParameter("7", "urlp_vat_type_dtl_id", ccsText, "", "", $this->Parameters["urlp_vat_type_dtl_id"], "", false);
    }
//End Prepare Method

//Open Method @2-32D16214
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select a.mobile_no as hp,a.*, a.npwd, d.vat_code as nama_ayat\n" .
        "FROM t_cust_account a\n" .
        "LEFT JOIN p_vat_type_dtl d ON a.p_vat_type_dtl_id = d.p_vat_type_dtl_id\n" .
        "\n" .
        "WHERE upper(a.wp_address_name) like upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')\n" .
        "       and upper(a.npwd) like upper('%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%')\n" .
        "       and upper(a.wp_name) like upper('%" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "%')\n" .
        "       and upper(a.company_name) like upper('%" . $this->SQLValue($this->wp->GetDBValue("4"), ccsText) . "%')\n" .
        "       and upper(a.company_brand) like upper('%" . $this->SQLValue($this->wp->GetDBValue("5"), ccsText) . "%')) cnt";
        $this->SQL = "select a.mobile_no as hp,a.*, a.npwd, d.vat_code as nama_ayat\n" .
        "FROM t_cust_account a\n" .
        "LEFT JOIN p_vat_type_dtl d ON a.p_vat_type_dtl_id = d.p_vat_type_dtl_id\n" .
        "\n" .
        "WHERE upper(a.wp_address_name) like upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')\n" .
        "       and upper(a.npwd) like upper('%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%')\n" .
        "       and upper(a.wp_name) like upper('%" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "%')\n" .
        "       and upper(a.company_name) like upper('%" . $this->SQLValue($this->wp->GetDBValue("4"), ccsText) . "%')\n" .
        "       and upper(a.company_brand) like upper('%" . $this->SQLValue($this->wp->GetDBValue("5"), ccsText) . "%')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-5ACFF6D3
    function SetValues()
    {
        $this->company_owner->SetDBValue($this->f("wp_name"));
        $this->email_address->SetDBValue($this->f("wp_email"));
        $this->t_cust_account_id->SetDBValue($this->f("t_cust_account_id"));
        $this->mobile_no_owner->SetDBValue($this->f("hp"));
        $this->address_name_owner->SetDBValue($this->f("wp_address_name"));
        $this->address_no_owner->SetDBValue($this->f("wp_address_no"));
        $this->address_rt_owner->SetDBValue($this->f("wp_address_rt"));
        $this->address_rw_owner->SetDBValue($this->f("wp_address_rw"));
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->nama_ayat->SetDBValue($this->f("nama_ayat"));
    }
//End SetValues Method

} //End t_customerGridDataSource Class @2-FCB6E20C

class clsRecordt_customerSearch { //t_customerSearch Class @3-BDF1E587

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

//Class_Initialize Event @3-BC43AC0C
    function clsRecordt_customerSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_customerSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_customerSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_npwd = & new clsControl(ccsTextBox, "s_npwd", "s_npwd", ccsText, "", CCGetRequestParam("s_npwd", $Method, NULL), $this);
            $this->s_wp_name = & new clsControl(ccsTextBox, "s_wp_name", "s_wp_name", ccsText, "", CCGetRequestParam("s_wp_name", $Method, NULL), $this);
            $this->s_company_name = & new clsControl(ccsTextBox, "s_company_name", "s_company_name", ccsText, "", CCGetRequestParam("s_company_name", $Method, NULL), $this);
            $this->s_keyword = & new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->s_company_brand = & new clsControl(ccsTextBox, "s_company_brand", "s_company_brand", ccsText, "", CCGetRequestParam("s_company_brand", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->Button_DoPrint = & new clsButton("Button_DoPrint", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-2AC60F7D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_npwd->Validate() && $Validation);
        $Validation = ($this->s_wp_name->Validate() && $Validation);
        $Validation = ($this->s_company_name->Validate() && $Validation);
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->s_company_brand->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_npwd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_wp_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_company_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_company_brand->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-51FEC2D3
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_npwd->Errors->Count());
        $errors = ($errors || $this->s_wp_name->Errors->Count());
        $errors = ($errors || $this->s_company_name->Errors->Count());
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->s_company_brand->Errors->Count());
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

//Operation Method @3-230B3273
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
            } else if($this->Button_DoPrint->Pressed) {
                $this->PressedButton = "Button_DoPrint";
            }
        }
        $Redirect = "t_modifikasi_no_hp_wp.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_modifikasi_no_hp_wp.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y", "Button_DoPrint", "Button_DoPrint_x", "Button_DoPrint_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_DoPrint") {
                if(!CCGetEvent($this->Button_DoPrint->CCSEvents, "OnClick", $this->Button_DoPrint)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-770A2D0F
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
            $Error = ComposeStrings($Error, $this->s_npwd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_wp_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_company_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_keyword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_company_brand->Errors->ToString());
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

        $this->s_npwd->Show();
        $this->s_wp_name->Show();
        $this->s_company_name->Show();
        $this->s_keyword->Show();
        $this->s_company_brand->Show();
        $this->Button_DoSearch->Show();
        $this->Button_DoPrint->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_customerSearch Class @3-FCB6E20C

class clsRecordt_customer_updateForm { //t_customer_updateForm Class @94-52E26210

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

//Class_Initialize Event @94-1A7C005B
    function clsRecordt_customer_updateForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_customer_updateForm/Error";
        $this->DataSource = new clst_customer_updateFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_customer_updateForm";
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
            $this->nama_kota = & new clsControl(ccsTextBox, "nama_kota", "Kota", ccsText, "", CCGetRequestParam("nama_kota", $Method, NULL), $this);
            $this->nama_kecamatan = & new clsControl(ccsTextBox, "nama_kecamatan", "Description", ccsText, "", CCGetRequestParam("nama_kecamatan", $Method, NULL), $this);
            $this->nama_kelurahan = & new clsControl(ccsTextBox, "nama_kelurahan", "Description", ccsText, "", CCGetRequestParam("nama_kelurahan", $Method, NULL), $this);
            $this->address_rt_owner = & new clsControl(ccsTextBox, "address_rt_owner", "Description", ccsText, "", CCGetRequestParam("address_rt_owner", $Method, NULL), $this);
            $this->address_rw_owner = & new clsControl(ccsTextBox, "address_rw_owner", "Description", ccsText, "", CCGetRequestParam("address_rw_owner", $Method, NULL), $this);
            $this->zip_code_owner = & new clsControl(ccsTextBox, "zip_code_owner", "Description", ccsText, "", CCGetRequestParam("zip_code_owner", $Method, NULL), $this);
            $this->phone_no_owner = & new clsControl(ccsTextBox, "phone_no_owner", "Description", ccsText, "", CCGetRequestParam("phone_no_owner", $Method, NULL), $this);
            $this->mobile_no = & new clsControl(ccsTextBox, "mobile_no", "no selular", ccsText, "", CCGetRequestParam("mobile_no", $Method, NULL), $this);
            $this->mobile_no->Required = true;
            $this->email_address = & new clsControl(ccsTextBox, "email_address", "Description", ccsText, "", CCGetRequestParam("email_address", $Method, NULL), $this);
            $this->address_name_owner = & new clsControl(ccsTextArea, "address_name_owner", "Alamat", ccsText, "", CCGetRequestParam("address_name_owner", $Method, NULL), $this);
            $this->company_owner = & new clsControl(ccsTextBox, "company_owner", "Nama Perusahaan", ccsText, "", CCGetRequestParam("company_owner", $Method, NULL), $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->updated_by = & new clsControl(ccsHidden, "updated_by", "updated_by", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->p_region_id_kel_owner = & new clsControl(ccsHidden, "p_region_id_kel_owner", "p_region_id_kel_owner", ccsText, "", CCGetRequestParam("p_region_id_kel_owner", $Method, NULL), $this);
            $this->p_region_id_kec_owner = & new clsControl(ccsHidden, "p_region_id_kec_owner", "p_region_id_kec_owner", ccsText, "", CCGetRequestParam("p_region_id_kec_owner", $Method, NULL), $this);
            $this->p_region_id_owner = & new clsControl(ccsHidden, "p_region_id_owner", "p_region_id_owner", ccsText, "", CCGetRequestParam("p_region_id_owner", $Method, NULL), $this);
            $this->fax_no_owner = & new clsControl(ccsTextBox, "fax_no_owner", "Description", ccsText, "", CCGetRequestParam("fax_no_owner", $Method, NULL), $this);
            $this->address_no_owner = & new clsControl(ccsTextBox, "address_no_owner", "No", ccsText, "", CCGetRequestParam("address_no_owner", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-2B96BD7E
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);
    }
//End Initialize Method

//Validate Method @94-700D0E68
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if(strlen($this->email_address->GetText()) && !preg_match ("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $this->email_address->GetText())) {
            $this->email_address->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Description"));
        }
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $Validation = ($this->nama_kota->Validate() && $Validation);
        $Validation = ($this->nama_kecamatan->Validate() && $Validation);
        $Validation = ($this->nama_kelurahan->Validate() && $Validation);
        $Validation = ($this->address_rt_owner->Validate() && $Validation);
        $Validation = ($this->address_rw_owner->Validate() && $Validation);
        $Validation = ($this->zip_code_owner->Validate() && $Validation);
        $Validation = ($this->phone_no_owner->Validate() && $Validation);
        $Validation = ($this->mobile_no->Validate() && $Validation);
        $Validation = ($this->email_address->Validate() && $Validation);
        $Validation = ($this->address_name_owner->Validate() && $Validation);
        $Validation = ($this->company_owner->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->p_region_id_kel_owner->Validate() && $Validation);
        $Validation = ($this->p_region_id_kec_owner->Validate() && $Validation);
        $Validation = ($this->p_region_id_owner->Validate() && $Validation);
        $Validation = ($this->fax_no_owner->Validate() && $Validation);
        $Validation = ($this->address_no_owner->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_kota->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_rt_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_rw_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->zip_code_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->phone_no_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mobile_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->email_address->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_name_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->company_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_kel_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_kec_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fax_no_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_no_owner->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-28CC1792
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->nama_kota->Errors->Count());
        $errors = ($errors || $this->nama_kecamatan->Errors->Count());
        $errors = ($errors || $this->nama_kelurahan->Errors->Count());
        $errors = ($errors || $this->address_rt_owner->Errors->Count());
        $errors = ($errors || $this->address_rw_owner->Errors->Count());
        $errors = ($errors || $this->zip_code_owner->Errors->Count());
        $errors = ($errors || $this->phone_no_owner->Errors->Count());
        $errors = ($errors || $this->mobile_no->Errors->Count());
        $errors = ($errors || $this->email_address->Errors->Count());
        $errors = ($errors || $this->address_name_owner->Errors->Count());
        $errors = ($errors || $this->company_owner->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
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

//Operation Method @94-D9F83B22
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
            if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_customer_id", "p_customerGridPage", "s_keyword"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
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

//UpdateRow Method @94-42064C30
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_cust_account_id->SetValue($this->t_cust_account_id->GetValue(true));
        $this->DataSource->mobile_no->SetValue($this->mobile_no->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @94-CF6B83F6
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
                    $this->nama_kota->SetValue($this->DataSource->nama_kota->GetValue());
                    $this->nama_kecamatan->SetValue($this->DataSource->nama_kecamatan->GetValue());
                    $this->nama_kelurahan->SetValue($this->DataSource->nama_kelurahan->GetValue());
                    $this->address_rt_owner->SetValue($this->DataSource->address_rt_owner->GetValue());
                    $this->address_rw_owner->SetValue($this->DataSource->address_rw_owner->GetValue());
                    $this->zip_code_owner->SetValue($this->DataSource->zip_code_owner->GetValue());
                    $this->phone_no_owner->SetValue($this->DataSource->phone_no_owner->GetValue());
                    $this->mobile_no->SetValue($this->DataSource->mobile_no->GetValue());
                    $this->email_address->SetValue($this->DataSource->email_address->GetValue());
                    $this->address_name_owner->SetValue($this->DataSource->address_name_owner->GetValue());
                    $this->company_owner->SetValue($this->DataSource->company_owner->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
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

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_kota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_rt_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_rw_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->zip_code_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->phone_no_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mobile_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->email_address->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_name_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->company_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
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
        $this->nama_kota->Show();
        $this->nama_kecamatan->Show();
        $this->nama_kelurahan->Show();
        $this->address_rt_owner->Show();
        $this->address_rw_owner->Show();
        $this->zip_code_owner->Show();
        $this->phone_no_owner->Show();
        $this->mobile_no->Show();
        $this->email_address->Show();
        $this->address_name_owner->Show();
        $this->company_owner->Show();
        $this->Button_Cancel->Show();
        $this->Button_Update->Show();
        $this->updated_by->Show();
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

} //End t_customer_updateForm Class @94-FCB6E20C

class clst_customer_updateFormDataSource extends clsDBConnSIKP {  //t_customer_updateFormDataSource Class @94-14C13181

//DataSource Variables @94-EA1EE393
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
    var $nama_kota;
    var $nama_kecamatan;
    var $nama_kelurahan;
    var $address_rt_owner;
    var $address_rw_owner;
    var $zip_code_owner;
    var $phone_no_owner;
    var $mobile_no;
    var $email_address;
    var $address_name_owner;
    var $company_owner;
    var $updated_by;
    var $p_region_id_kel_owner;
    var $p_region_id_kec_owner;
    var $p_region_id_owner;
    var $fax_no_owner;
    var $address_no_owner;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-1FA6D455
    function clst_customer_updateFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_customer_updateForm/Error";
        $this->Initialize();
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsText, "");
        
        $this->nama_kota = new clsField("nama_kota", ccsText, "");
        
        $this->nama_kecamatan = new clsField("nama_kecamatan", ccsText, "");
        
        $this->nama_kelurahan = new clsField("nama_kelurahan", ccsText, "");
        
        $this->address_rt_owner = new clsField("address_rt_owner", ccsText, "");
        
        $this->address_rw_owner = new clsField("address_rw_owner", ccsText, "");
        
        $this->zip_code_owner = new clsField("zip_code_owner", ccsText, "");
        
        $this->phone_no_owner = new clsField("phone_no_owner", ccsText, "");
        
        $this->mobile_no = new clsField("mobile_no", ccsText, "");
        
        $this->email_address = new clsField("email_address", ccsText, "");
        
        $this->address_name_owner = new clsField("address_name_owner", ccsText, "");
        
        $this->company_owner = new clsField("company_owner", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->p_region_id_kel_owner = new clsField("p_region_id_kel_owner", ccsText, "");
        
        $this->p_region_id_kec_owner = new clsField("p_region_id_kec_owner", ccsText, "");
        
        $this->p_region_id_owner = new clsField("p_region_id_owner", ccsText, "");
        
        $this->fax_no_owner = new clsField("fax_no_owner", ccsText, "");
        
        $this->address_no_owner = new clsField("address_no_owner", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-6E835A06
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_account_id", ccsFloat, "", "", $this->Parameters["urlt_cust_account_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-6A0CCF74
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select a.*, a.npwd, d.vat_code as nama_ayat,\n" .
        "x.region_name as kota,\n" .
        "y.region_name as kecamatan,\n" .
        "z.region_name as kelurahan\n" .
        "FROM t_cust_account a\n" .
        "--LEFT JOIN t_cust_account b ON a.t_customer_id = b.t_customer_id\n" .
        "--LEFT JOIN p_vat_type c ON b.p_vat_type_id = c.p_vat_type_id\n" .
        "LEFT JOIN p_vat_type_dtl d ON a.p_vat_type_dtl_id = d.p_vat_type_dtl_id\n" .
        "left join p_region x on a.wp_p_region_id = x.p_region_id\n" .
        "left join p_region y on a.wp_p_region_id_kecamatan = y.p_region_id\n" .
        "left join p_region z on a.wp_p_region_id_kelurahan = z.p_region_id\n" .
        "\n" .
        "WHERE a.t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-36E30616
    function SetValues()
    {
        $this->t_cust_account_id->SetDBValue($this->f("t_cust_account_id"));
        $this->nama_kota->SetDBValue($this->f("kota"));
        $this->nama_kecamatan->SetDBValue($this->f("kecamatan"));
        $this->nama_kelurahan->SetDBValue($this->f("kelurahan"));
        $this->address_rt_owner->SetDBValue($this->f("wp_address_rt"));
        $this->address_rw_owner->SetDBValue($this->f("wp_address_rw"));
        $this->zip_code_owner->SetDBValue($this->f("zip_code"));
        $this->phone_no_owner->SetDBValue($this->f("phone_no"));
        $this->mobile_no->SetDBValue($this->f("mobile_no"));
        $this->email_address->SetDBValue($this->f("wp_email"));
        $this->address_name_owner->SetDBValue($this->f("wp_address_name"));
        $this->company_owner->SetDBValue($this->f("wp_name"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->p_region_id_kel_owner->SetDBValue($this->f("wp_p_region_id_kelurahan"));
        $this->p_region_id_kec_owner->SetDBValue($this->f("wp_p_region_id_kecamatan"));
        $this->p_region_id_owner->SetDBValue($this->f("wp_p_region_id"));
        $this->fax_no_owner->SetDBValue($this->f("fax_no"));
        $this->address_no_owner->SetDBValue($this->f("wp_address_no"));
    }
//End SetValues Method

//Update Method @94-34BF4BBA
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["updated_by"] = new clsSQLParameter("expr449", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["t_cust_account_id"] = new clsSQLParameter("ctrlt_cust_account_id", ccsFloat, "", "", $this->t_cust_account_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["mobile_no"] = new clsSQLParameter("ctrlmobile_no", ccsText, "", "", $this->mobile_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["t_cust_account_id"]->GetValue()) and !strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue())) 
            $this->cp["t_cust_account_id"]->SetValue($this->t_cust_account_id->GetValue(true));
        if (!strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue(true))) 
            $this->cp["t_cust_account_id"]->SetText(0);
        if (!is_null($this->cp["mobile_no"]->GetValue()) and !strlen($this->cp["mobile_no"]->GetText()) and !is_bool($this->cp["mobile_no"]->GetValue())) 
            $this->cp["mobile_no"]->SetValue($this->mobile_no->GetValue(true));
        $this->SQL = "UPDATE t_cust_account\n" .
        "SET mobile_no = '" . $this->SQLValue($this->cp["mobile_no"]->GetDBValue(), ccsText) . "',\n" .
        "updated_date = sysdate, \n" .
        "updated_by = '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "'\n" .
        "WHERE t_cust_account_id = " . $this->SQLValue($this->cp["t_cust_account_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End t_customer_updateFormDataSource Class @94-FCB6E20C

//Initialize Page @1-FBD66CFC
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
$TemplateFileName = "t_modifikasi_no_hp_wp.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-09B350B2
include_once("./t_modifikasi_no_hp_wp_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-7DCAC9A7
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_customerGrid = & new clsGridt_customerGrid("", $MainPage);
$t_customerSearch = & new clsRecordt_customerSearch("", $MainPage);
$t_customer_updateForm = & new clsRecordt_customer_updateForm("", $MainPage);
$MainPage->t_customerGrid = & $t_customerGrid;
$MainPage->t_customerSearch = & $t_customerSearch;
$MainPage->t_customer_updateForm = & $t_customer_updateForm;
$t_customerGrid->Initialize();
$t_customer_updateForm->Initialize();

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

//Execute Components @1-DB07AFB7
$t_customerSearch->Operation();
$t_customer_updateForm->Operation();
//End Execute Components

//Go to destination page @1-AA90FECA
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_customerGrid);
    unset($t_customerSearch);
    unset($t_customer_updateForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-1E3DFF6D
$t_customerGrid->Show();
$t_customerSearch->Show();
$t_customer_updateForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-BCCA0540
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_customerGrid);
unset($t_customerSearch);
unset($t_customer_updateForm);
unset($Tpl);
//End Unload Page


?>
