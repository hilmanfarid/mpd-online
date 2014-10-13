<?php 
//Include Common Files @1-412FBF65
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_penutupan_wp.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_vat_setllementGrid { //t_vat_setllementGrid class @2-AD714316

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

//Class_Initialize Event @2-CEFAB12C
    function clsGridt_vat_setllementGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_vat_setllementGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_vat_setllementGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_vat_setllementGridDataSource($this);
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
        $this->DLink->Page = "t_penutupan_wp.php";
        $this->status_request_date = & new clsControl(ccsLabel, "status_request_date", "status_request_date", ccsText, "", CCGetRequestParam("status_request_date", ccsGet, NULL), $this);
        $this->p_account_status_mut = & new clsControl(ccsLabel, "p_account_status_mut", "p_account_status_mut", ccsText, "", CCGetRequestParam("p_account_status_mut", ccsGet, NULL), $this);
        $this->reason_code = & new clsControl(ccsLabel, "reason_code", "reason_code", ccsText, "", CCGetRequestParam("reason_code", ccsGet, NULL), $this);
        $this->t_cust_acc_status_modif_id = & new clsControl(ccsHidden, "t_cust_acc_status_modif_id", "t_cust_acc_status_modif_id", ccsFloat, "", CCGetRequestParam("t_cust_acc_status_modif_id", ccsGet, NULL), $this);
        $this->wp_name = & new clsControl(ccsLabel, "wp_name", "wp_name", ccsText, "", CCGetRequestParam("wp_name", ccsGet, NULL), $this);
        $this->npwd = & new clsControl(ccsLabel, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", ccsGet, NULL), $this);
        $this->order_no = & new clsControl(ccsLabel, "order_no", "order_no", ccsText, "", CCGetRequestParam("order_no", ccsGet, NULL), $this);
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

//Show Method @2-4402BBDB
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr384"] = 1;
        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["expr386"] = 2;

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
            $this->ControlsVisible["status_request_date"] = $this->status_request_date->Visible;
            $this->ControlsVisible["p_account_status_mut"] = $this->p_account_status_mut->Visible;
            $this->ControlsVisible["reason_code"] = $this->reason_code->Visible;
            $this->ControlsVisible["t_cust_acc_status_modif_id"] = $this->t_cust_acc_status_modif_id->Visible;
            $this->ControlsVisible["wp_name"] = $this->wp_name->Visible;
            $this->ControlsVisible["npwd"] = $this->npwd->Visible;
            $this->ControlsVisible["order_no"] = $this->order_no->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_cust_acc_status_modif_id", $this->DataSource->f("t_cust_acc_status_modif_id"));
                $this->status_request_date->SetValue($this->DataSource->status_request_date->GetValue());
                $this->p_account_status_mut->SetValue($this->DataSource->p_account_status_mut->GetValue());
                $this->reason_code->SetValue($this->DataSource->reason_code->GetValue());
                $this->t_cust_acc_status_modif_id->SetValue($this->DataSource->t_cust_acc_status_modif_id->GetValue());
                $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                $this->order_no->SetValue($this->DataSource->order_no->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->status_request_date->Show();
                $this->p_account_status_mut->Show();
                $this->reason_code->Show();
                $this->t_cust_acc_status_modif_id->Show();
                $this->wp_name->Show();
                $this->npwd->Show();
                $this->order_no->Show();
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

//GetErrors Method @2-9432DCE0
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->status_request_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_account_status_mut->Errors->ToString());
        $errors = ComposeStrings($errors, $this->reason_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_acc_status_modif_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wp_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->npwd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->order_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_setllementGrid Class @2-FCB6E20C

class clst_vat_setllementGridDataSource extends clsDBConnSIKP {  //t_vat_setllementGridDataSource Class @2-F0AECE38

//DataSource Variables @2-A78B4774
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $status_request_date;
    var $p_account_status_mut;
    var $reason_code;
    var $t_cust_acc_status_modif_id;
    var $wp_name;
    var $npwd;
    var $order_no;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-049D56B8
    function clst_vat_setllementGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_setllementGrid";
        $this->Initialize();
        $this->status_request_date = new clsField("status_request_date", ccsText, "");
        
        $this->p_account_status_mut = new clsField("p_account_status_mut", ccsText, "");
        
        $this->reason_code = new clsField("reason_code", ccsText, "");
        
        $this->t_cust_acc_status_modif_id = new clsField("t_cust_acc_status_modif_id", ccsFloat, "");
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->order_no = new clsField("order_no", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-236A0F42
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "x.updated_date desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-8D93FEF9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr384", ccsFloat, "", "", $this->Parameters["expr384"], "", false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("3", "expr386", ccsFloat, "", "", $this->Parameters["expr386"], "", false);
    }
//End Prepare Method

//Open Method @2-6376BC62
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT x.* \n" .
        "FROM v_t_cust_acc_status_modif x\n" .
        "where p_order_status_id =1) cnt";
        $this->SQL = "SELECT x.* \n" .
        "FROM v_t_cust_acc_status_modif x\n" .
        "where p_order_status_id =1 {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-4B821FF3
    function SetValues()
    {
        $this->status_request_date->SetDBValue($this->f("status_request_date"));
        $this->p_account_status_mut->SetDBValue($this->f("p_account_status_mut"));
        $this->reason_code->SetDBValue($this->f("reason_code"));
        $this->t_cust_acc_status_modif_id->SetDBValue(trim($this->f("t_cust_acc_status_modif_id")));
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->order_no->SetDBValue($this->f("order_no"));
    }
//End SetValues Method

} //End t_vat_setllementGridDataSource Class @2-FCB6E20C

class clsRecordt_vat_setllementForm { //t_vat_setllementForm Class @23-D94969C3

//Variables @23-D6FF3E86

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

//Class_Initialize Event @23-43ED9377
    function clsRecordt_vat_setllementForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_vat_setllementForm/Error";
        $this->DataSource = new clst_vat_setllementFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_vat_setllementForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->order_no = & new clsControl(ccsTextBox, "order_no", "order_no", ccsText, "", CCGetRequestParam("order_no", $Method, NULL), $this);
            $this->order_no->Required = true;
            $this->reason_description = & new clsControl(ccsTextBox, "reason_description", "keterangan alasan penutupan", ccsText, "", CCGetRequestParam("reason_description", $Method, NULL), $this);
            $this->npwd = & new clsControl(ccsTextBox, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", $Method, NULL), $this);
            $this->npwd->Required = true;
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", $Method, NULL), $this);
            $this->wp_name = & new clsControl(ccsTextBox, "wp_name", "Nama Wajib Pajak", ccsText, "", CCGetRequestParam("wp_name", $Method, NULL), $this);
            $this->Button1 = & new clsButton("Button1", $Method, $this);
            $this->Button_Hapus = & new clsButton("Button_Hapus", $Method, $this);
            $this->reason_code = & new clsControl(ccsTextBox, "reason_code", "reason_code", ccsText, "", CCGetRequestParam("reason_code", $Method, NULL), $this);
            $this->reason_code->Required = true;
            $this->reason_status_id = & new clsControl(ccsHidden, "reason_status_id", "reason_status_id", ccsFloat, "", CCGetRequestParam("reason_status_id", $Method, NULL), $this);
            $this->view = & new clsButton("view", $Method, $this);
            $this->t_cust_acc_status_modif_id = & new clsControl(ccsHidden, "t_cust_acc_status_modif_id", "Id", ccsFloat, "", CCGetRequestParam("t_cust_acc_status_modif_id", $Method, NULL), $this);
            $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsFloat, "", CCGetRequestParam("t_customer_order_id", $Method, NULL), $this);
            $this->p_account_status_id = & new clsControl(ccsHidden, "p_account_status_id", "p_account_status_id", ccsFloat, "", CCGetRequestParam("p_account_status_id", $Method, NULL), $this);
            $this->wp_address_name = & new clsControl(ccsTextArea, "wp_address_name", "Alamat Wajib Pajak", ccsText, "", CCGetRequestParam("wp_address_name", $Method, NULL), $this);
            $this->company_brand = & new clsControl(ccsTextBox, "company_brand", "company_brand", ccsText, "", CCGetRequestParam("company_brand", $Method, NULL), $this);
            $this->company_brand->Required = true;
            $this->p_vat_type_code = & new clsControl(ccsTextBox, "p_vat_type_code", "p_vat_type_code", ccsText, "", CCGetRequestParam("p_vat_type_code", $Method, NULL), $this);
            $this->p_vat_type_code->Required = true;
            $this->t_customer_id = & new clsControl(ccsHidden, "t_customer_id", "t_customer_id", ccsFloat, "", CCGetRequestParam("t_customer_id", $Method, NULL), $this);
            $this->p_account_status_mut = & new clsControl(ccsTextBox, "p_account_status_mut", "p_account_status_mut", ccsText, "", CCGetRequestParam("p_account_status_mut", $Method, NULL), $this);
            $this->p_account_status_mut->Required = true;
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @23-D6C09CCB
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_cust_acc_status_modif_id"] = CCGetFromGet("t_cust_acc_status_modif_id", NULL);
    }
//End Initialize Method

//Validate Method @23-B1471699
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->order_no->Validate() && $Validation);
        $Validation = ($this->reason_description->Validate() && $Validation);
        $Validation = ($this->npwd->Validate() && $Validation);
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id->Validate() && $Validation);
        $Validation = ($this->wp_name->Validate() && $Validation);
        $Validation = ($this->reason_code->Validate() && $Validation);
        $Validation = ($this->reason_status_id->Validate() && $Validation);
        $Validation = ($this->t_cust_acc_status_modif_id->Validate() && $Validation);
        $Validation = ($this->t_customer_order_id->Validate() && $Validation);
        $Validation = ($this->p_account_status_id->Validate() && $Validation);
        $Validation = ($this->wp_address_name->Validate() && $Validation);
        $Validation = ($this->company_brand->Validate() && $Validation);
        $Validation = ($this->p_vat_type_code->Validate() && $Validation);
        $Validation = ($this->t_customer_id->Validate() && $Validation);
        $Validation = ($this->p_account_status_mut->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->order_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->reason_description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npwd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->reason_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->reason_status_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_acc_status_modif_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_order_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_account_status_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->company_brand->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_account_status_mut->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-AF3A4DCF
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->order_no->Errors->Count());
        $errors = ($errors || $this->reason_description->Errors->Count());
        $errors = ($errors || $this->npwd->Errors->Count());
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
        $errors = ($errors || $this->wp_name->Errors->Count());
        $errors = ($errors || $this->reason_code->Errors->Count());
        $errors = ($errors || $this->reason_status_id->Errors->Count());
        $errors = ($errors || $this->t_cust_acc_status_modif_id->Errors->Count());
        $errors = ($errors || $this->t_customer_order_id->Errors->Count());
        $errors = ($errors || $this->p_account_status_id->Errors->Count());
        $errors = ($errors || $this->wp_address_name->Errors->Count());
        $errors = ($errors || $this->company_brand->Errors->Count());
        $errors = ($errors || $this->p_vat_type_code->Errors->Count());
        $errors = ($errors || $this->t_customer_id->Errors->Count());
        $errors = ($errors || $this->p_account_status_mut->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @23-ED598703
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

//Operation Method @23-013EB510
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            } else if($this->Button_Hapus->Pressed) {
                $this->PressedButton = "Button_Hapus";
            } else if($this->view->Pressed) {
                $this->PressedButton = "view";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_vat_setllement_id"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Hapus") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "t_cust_acc_status_modif_id"));
                if(!CCGetEvent($this->Button_Hapus->CCSEvents, "OnClick", $this->Button_Hapus)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "view") {
                if(!CCGetEvent($this->view->CCSEvents, "OnClick", $this->view)) {
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

//UpdateRow Method @23-0DB44AD9
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_account_status_id->SetValue($this->p_account_status_id->GetValue(true));
        $this->DataSource->reason_status_id->SetValue($this->reason_status_id->GetValue(true));
        $this->DataSource->reason_description->SetValue($this->reason_description->GetValue(true));
        $this->DataSource->t_cust_acc_status_modif_id->SetValue($this->t_cust_acc_status_modif_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-7BF969AE
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_customer_order_id->SetValue($this->t_customer_order_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-18837A1A
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
                    $this->order_no->SetValue($this->DataSource->order_no->GetValue());
                    $this->reason_description->SetValue($this->DataSource->reason_description->GetValue());
                    $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                    $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                    $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                    $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                    $this->reason_code->SetValue($this->DataSource->reason_code->GetValue());
                    $this->reason_status_id->SetValue($this->DataSource->reason_status_id->GetValue());
                    $this->t_cust_acc_status_modif_id->SetValue($this->DataSource->t_cust_acc_status_modif_id->GetValue());
                    $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                    $this->p_account_status_id->SetValue($this->DataSource->p_account_status_id->GetValue());
                    $this->wp_address_name->SetValue($this->DataSource->wp_address_name->GetValue());
                    $this->company_brand->SetValue($this->DataSource->company_brand->GetValue());
                    $this->p_vat_type_code->SetValue($this->DataSource->p_vat_type_code->GetValue());
                    $this->t_customer_id->SetValue($this->DataSource->t_customer_id->GetValue());
                    $this->p_account_status_mut->SetValue($this->DataSource->p_account_status_mut->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->order_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->reason_description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npwd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->reason_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->reason_status_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cust_acc_status_modif_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_order_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_account_status_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->company_brand->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_account_status_mut->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->order_no->Show();
        $this->reason_description->Show();
        $this->npwd->Show();
        $this->t_cust_account_id->Show();
        $this->p_vat_type_id->Show();
        $this->wp_name->Show();
        $this->Button1->Show();
        $this->Button_Hapus->Show();
        $this->reason_code->Show();
        $this->reason_status_id->Show();
        $this->view->Show();
        $this->t_cust_acc_status_modif_id->Show();
        $this->t_customer_order_id->Show();
        $this->p_account_status_id->Show();
        $this->wp_address_name->Show();
        $this->company_brand->Show();
        $this->p_vat_type_code->Show();
        $this->t_customer_id->Show();
        $this->p_account_status_mut->Show();
        $this->created_by->Show();
        $this->creation_date->Show();
        $this->updated_by->Show();
        $this->updated_date->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_vat_setllementForm Class @23-FCB6E20C

class clst_vat_setllementFormDataSource extends clsDBConnSIKP {  //t_vat_setllementFormDataSource Class @23-AF9958CC

//DataSource Variables @23-FFEC246E
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $order_no;
    var $reason_description;
    var $npwd;
    var $t_cust_account_id;
    var $p_vat_type_id;
    var $wp_name;
    var $reason_code;
    var $reason_status_id;
    var $t_cust_acc_status_modif_id;
    var $t_customer_order_id;
    var $p_account_status_id;
    var $wp_address_name;
    var $company_brand;
    var $p_vat_type_code;
    var $t_customer_id;
    var $p_account_status_mut;
    var $created_by;
    var $creation_date;
    var $updated_by;
    var $updated_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-94E8950C
    function clst_vat_setllementFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_vat_setllementForm/Error";
        $this->Initialize();
        $this->order_no = new clsField("order_no", ccsText, "");
        
        $this->reason_description = new clsField("reason_description", ccsText, "");
        
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsText, "");
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->reason_code = new clsField("reason_code", ccsText, "");
        
        $this->reason_status_id = new clsField("reason_status_id", ccsFloat, "");
        
        $this->t_cust_acc_status_modif_id = new clsField("t_cust_acc_status_modif_id", ccsFloat, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsFloat, "");
        
        $this->p_account_status_id = new clsField("p_account_status_id", ccsFloat, "");
        
        $this->wp_address_name = new clsField("wp_address_name", ccsText, "");
        
        $this->company_brand = new clsField("company_brand", ccsText, "");
        
        $this->p_vat_type_code = new clsField("p_vat_type_code", ccsText, "");
        
        $this->t_customer_id = new clsField("t_customer_id", ccsFloat, "");
        
        $this->p_account_status_mut = new clsField("p_account_status_mut", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-BFBF7004
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_acc_status_modif_id", ccsFloat, "", "", $this->Parameters["urlt_cust_acc_status_modif_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @23-4371C7D4
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT x.* \n" .
        "FROM v_t_cust_acc_status_modif x\n" .
        "WHERE t_cust_acc_status_modif_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-AA4A3070
    function SetValues()
    {
        $this->order_no->SetDBValue($this->f("order_no"));
        $this->reason_description->SetDBValue($this->f("reason_description"));
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->p_vat_type_id->SetDBValue($this->f("p_vat_type_id"));
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->reason_code->SetDBValue($this->f("reason_code"));
        $this->reason_status_id->SetDBValue(trim($this->f("reason_status_id")));
        $this->t_cust_acc_status_modif_id->SetDBValue(trim($this->f("t_cust_acc_status_modif_id")));
        $this->t_customer_order_id->SetDBValue(trim($this->f("t_customer_order_id")));
        $this->p_account_status_id->SetDBValue(trim($this->f("p_account_status_id")));
        $this->wp_address_name->SetDBValue($this->f("wp_address_name"));
        $this->company_brand->SetDBValue($this->f("company_brand"));
        $this->p_vat_type_code->SetDBValue($this->f("p_vat_type_code"));
        $this->t_customer_id->SetDBValue(trim($this->f("t_customer_id")));
        $this->p_account_status_mut->SetDBValue($this->f("p_account_status_mut"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
    }
//End SetValues Method

//Update Method @23-35BA47A2
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_account_status_id"] = new clsSQLParameter("ctrlp_account_status_id", ccsInteger, "", "", $this->p_account_status_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["reason_status_id"] = new clsSQLParameter("ctrlreason_status_id", ccsInteger, "", "", $this->reason_status_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["user"] = new clsSQLParameter("expr403", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["reason_description"] = new clsSQLParameter("ctrlreason_description", ccsText, "", "", $this->reason_description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_cust_acc_status_modif_id"] = new clsSQLParameter("ctrlt_cust_acc_status_modif_id", ccsInteger, "", "", $this->t_cust_acc_status_modif_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_account_status_id"]->GetValue()) and !strlen($this->cp["p_account_status_id"]->GetText()) and !is_bool($this->cp["p_account_status_id"]->GetValue())) 
            $this->cp["p_account_status_id"]->SetValue($this->p_account_status_id->GetValue(true));
        if (!strlen($this->cp["p_account_status_id"]->GetText()) and !is_bool($this->cp["p_account_status_id"]->GetValue(true))) 
            $this->cp["p_account_status_id"]->SetText(0);
        if (!is_null($this->cp["reason_status_id"]->GetValue()) and !strlen($this->cp["reason_status_id"]->GetText()) and !is_bool($this->cp["reason_status_id"]->GetValue())) 
            $this->cp["reason_status_id"]->SetValue($this->reason_status_id->GetValue(true));
        if (!strlen($this->cp["reason_status_id"]->GetText()) and !is_bool($this->cp["reason_status_id"]->GetValue(true))) 
            $this->cp["reason_status_id"]->SetText(0);
        if (!is_null($this->cp["user"]->GetValue()) and !strlen($this->cp["user"]->GetText()) and !is_bool($this->cp["user"]->GetValue())) 
            $this->cp["user"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["reason_description"]->GetValue()) and !strlen($this->cp["reason_description"]->GetText()) and !is_bool($this->cp["reason_description"]->GetValue())) 
            $this->cp["reason_description"]->SetValue($this->reason_description->GetValue(true));
        if (!is_null($this->cp["t_cust_acc_status_modif_id"]->GetValue()) and !strlen($this->cp["t_cust_acc_status_modif_id"]->GetText()) and !is_bool($this->cp["t_cust_acc_status_modif_id"]->GetValue())) 
            $this->cp["t_cust_acc_status_modif_id"]->SetValue($this->t_cust_acc_status_modif_id->GetValue(true));
        if (!strlen($this->cp["t_cust_acc_status_modif_id"]->GetText()) and !is_bool($this->cp["t_cust_acc_status_modif_id"]->GetValue(true))) 
            $this->cp["t_cust_acc_status_modif_id"]->SetText(0);
        $this->SQL = "UPDATE t_cust_acc_status_modif\n" .
        "SET \n" .
        "p_account_status_id = " . $this->SQLValue($this->cp["p_account_status_id"]->GetDBValue(), ccsInteger) . ",\n" .
        "reason_status_id = " . $this->SQLValue($this->cp["reason_status_id"]->GetDBValue(), ccsInteger) . ",\n" .
        "updated_date = sysdate,\n" .
        "updated_by = '" . $this->SQLValue($this->cp["user"]->GetDBValue(), ccsText) . "',\n" .
        "reason_description = '" . $this->SQLValue($this->cp["reason_description"]->GetDBValue(), ccsText) . "'\n" .
        "where \n" .
        "t_cust_acc_status_modif_id = " . $this->SQLValue($this->cp["t_cust_acc_status_modif_id"]->GetDBValue(), ccsInteger) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-B5E9BFF0
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_customer_order_id"] = new clsSQLParameter("ctrlt_customer_order_id", ccsFloat, "", "", $this->t_customer_order_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["UserName"] = new clsSQLParameter("expr343", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_customer_order_id"]->GetValue()) and !strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue())) 
            $this->cp["t_customer_order_id"]->SetValue($this->t_customer_order_id->GetValue(true));
        if (!strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue(true))) 
            $this->cp["t_customer_order_id"]->SetText(0);
        if (!is_null($this->cp["UserName"]->GetValue()) and !strlen($this->cp["UserName"]->GetText()) and !is_bool($this->cp["UserName"]->GetValue())) 
            $this->cp["UserName"]->SetValue(CCGetUserLogin());
        $this->SQL = "select o_result_code, o_result_msg from f_first_submit_engine(507," . $this->SQLValue($this->cp["t_customer_order_id"]->GetDBValue(), ccsFloat) . ",'" . $this->SQLValue($this->cp["UserName"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_vat_setllementFormDataSource Class @23-FCB6E20C

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

//Class_Initialize Event @3-D84A44C2
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
            $this->s_keyword = & new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-A144A629
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-D6729123
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
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

//Operation Method @3-49E827B7
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
        $Redirect = "t_penutupan_wp.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_penutupan_wp.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-7913FA87
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_vat_setllementSearch Class @3-FCB6E20C

//Initialize Page @1-0D8229BE
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
$TemplateFileName = "t_penutupan_wp.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-9E6B4F59
include_once("./t_penutupan_wp_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-14E68814
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_vat_setllementGrid = & new clsGridt_vat_setllementGrid("", $MainPage);
$t_vat_setllementForm = & new clsRecordt_vat_setllementForm("", $MainPage);
$t_vat_setllementSearch = & new clsRecordt_vat_setllementSearch("", $MainPage);
$MainPage->t_vat_setllementGrid = & $t_vat_setllementGrid;
$MainPage->t_vat_setllementForm = & $t_vat_setllementForm;
$MainPage->t_vat_setllementSearch = & $t_vat_setllementSearch;
$t_vat_setllementGrid->Initialize();
$t_vat_setllementForm->Initialize();

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

//Execute Components @1-9F20D4A1
$t_vat_setllementForm->Operation();
$t_vat_setllementSearch->Operation();
//End Execute Components

//Go to destination page @1-B96B3335
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_vat_setllementGrid);
    unset($t_vat_setllementForm);
    unset($t_vat_setllementSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-82B07B1E
$t_vat_setllementGrid->Show();
$t_vat_setllementForm->Show();
$t_vat_setllementSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-33B98A02
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_vat_setllementGrid);
unset($t_vat_setllementForm);
unset($t_vat_setllementSearch);
unset($Tpl);
//End Unload Page


?>
