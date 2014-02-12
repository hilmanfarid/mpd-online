<?php
//Include Common Files @1-69AF305A
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_setllement_ro.php");
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

//Class_Initialize Event @2-3B36DDBD
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
        $this->DLink->Page = "t_vat_setllement_ro_salah.php";
        $this->npwd = & new clsControl(ccsLabel, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", ccsGet, NULL), $this);
        $this->finance_period_code = & new clsControl(ccsLabel, "finance_period_code", "finance_period_code", ccsText, "", CCGetRequestParam("finance_period_code", ccsGet, NULL), $this);
        $this->order_no = & new clsControl(ccsLabel, "order_no", "order_no", ccsText, "", CCGetRequestParam("order_no", ccsGet, NULL), $this);
        $this->t_vat_setllement_id = & new clsControl(ccsHidden, "t_vat_setllement_id", "t_vat_setllement_id", ccsFloat, "", CCGetRequestParam("t_vat_setllement_id", ccsGet, NULL), $this);
        $this->total_trans_amount = & new clsControl(ccsLabel, "total_trans_amount", "total_trans_amount", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("total_trans_amount", ccsGet, NULL), $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "t_vat_setllement_dtl_ro.php";
        $this->ImageLink2 = & new clsControl(ccsImageLink, "ImageLink2", "ImageLink2", ccsText, "", CCGetRequestParam("ImageLink2", ccsGet, NULL), $this);
        $this->ImageLink2->Page = "t_sptpd_legal_doc_ro.php";
        $this->p_rqst_type_id = & new clsControl(ccsHidden, "p_rqst_type_id", "p_rqst_type_id", ccsFloat, "", CCGetRequestParam("p_rqst_type_id", ccsGet, NULL), $this);
        $this->total_vat_amount = & new clsControl(ccsLabel, "total_vat_amount", "total_vat_amount", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("total_vat_amount", ccsGet, NULL), $this);
        $this->cetak_sptpd = & new clsControl(ccsLabel, "cetak_sptpd", "cetak_sptpd", ccsText, "", CCGetRequestParam("cetak_sptpd", ccsGet, NULL), $this);
        $this->cetak_sptpd->HTML = true;
        $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsFloat, "", CCGetRequestParam("p_vat_type_id", ccsGet, NULL), $this);
        $this->cetak = & new clsControl(ccsLabel, "cetak", "cetak", ccsText, "", CCGetRequestParam("cetak", ccsGet, NULL), $this);
        $this->cetak->HTML = true;
        $this->wp_name = & new clsControl(ccsLabel, "wp_name", "wp_name", ccsText, "", CCGetRequestParam("wp_name", ccsGet, NULL), $this);
        $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsInteger, "", CCGetRequestParam("t_customer_order_id", ccsGet, NULL), $this);
        $this->total_penalty_amount = & new clsControl(ccsLabel, "total_penalty_amount", "total_penalty_amount", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("total_penalty_amount", ccsGet, NULL), $this);
        $this->cetak_payment = & new clsButton("cetak_payment", ccsGet, $this);
        $this->user = & new clsControl(ccsHidden, "user", "user", ccsText, "", CCGetRequestParam("user", ccsGet, NULL), $this);
        $this->cetak_register1 = & new clsButton("cetak_register1", ccsGet, $this);
        $this->cetak_register = & new clsButton("cetak_register", ccsGet, $this);
        $this->total_total = & new clsControl(ccsLabel, "total_total", "total_total", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("total_total", ccsGet, NULL), $this);
        $this->no_kohir = & new clsControl(ccsLabel, "no_kohir", "no_kohir", ccsText, "", CCGetRequestParam("no_kohir", ccsGet, NULL), $this);
        $this->Button1 = & new clsButton("Button1", ccsGet, $this);
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

//Show Method @2-0B328E3F
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_customer_order_id"] = CCGetFromGet("t_customer_order_id", NULL);

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
            $this->ControlsVisible["finance_period_code"] = $this->finance_period_code->Visible;
            $this->ControlsVisible["order_no"] = $this->order_no->Visible;
            $this->ControlsVisible["t_vat_setllement_id"] = $this->t_vat_setllement_id->Visible;
            $this->ControlsVisible["total_trans_amount"] = $this->total_trans_amount->Visible;
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            $this->ControlsVisible["ImageLink2"] = $this->ImageLink2->Visible;
            $this->ControlsVisible["p_rqst_type_id"] = $this->p_rqst_type_id->Visible;
            $this->ControlsVisible["total_vat_amount"] = $this->total_vat_amount->Visible;
            $this->ControlsVisible["cetak_sptpd"] = $this->cetak_sptpd->Visible;
            $this->ControlsVisible["p_vat_type_id"] = $this->p_vat_type_id->Visible;
            $this->ControlsVisible["cetak"] = $this->cetak->Visible;
            $this->ControlsVisible["wp_name"] = $this->wp_name->Visible;
            $this->ControlsVisible["t_customer_order_id"] = $this->t_customer_order_id->Visible;
            $this->ControlsVisible["total_penalty_amount"] = $this->total_penalty_amount->Visible;
            $this->ControlsVisible["cetak_payment"] = $this->cetak_payment->Visible;
            $this->ControlsVisible["user"] = $this->user->Visible;
            $this->ControlsVisible["cetak_register1"] = $this->cetak_register1->Visible;
            $this->ControlsVisible["cetak_register"] = $this->cetak_register->Visible;
            $this->ControlsVisible["total_total"] = $this->total_total->Visible;
            $this->ControlsVisible["no_kohir"] = $this->no_kohir->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_vat_setllement_id", $this->DataSource->f("t_vat_setllement_id"));
                $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                $this->finance_period_code->SetValue($this->DataSource->finance_period_code->GetValue());
                $this->order_no->SetValue($this->DataSource->order_no->GetValue());
                $this->t_vat_setllement_id->SetValue($this->DataSource->t_vat_setllement_id->GetValue());
                $this->total_trans_amount->SetValue($this->DataSource->total_trans_amount->GetValue());
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "t_vat_setllement_id", $this->DataSource->f("t_vat_setllement_id"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "npwd", $this->DataSource->f("npwd"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "t_cust_account_id", $this->DataSource->f("t_cust_account_id"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "finance_period_code", $this->DataSource->f("finance_period_code"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "p_finance_period_id", $this->DataSource->f("p_finance_period_id"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "t_customer_order_id", $this->DataSource->f("t_customer_order_id"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "order_no", $this->DataSource->f("order_no"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "p_rqst_type_id", $this->DataSource->f("p_rqst_type_id"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "rqst_type_code", $this->DataSource->f("rqst_type_code"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "TAKEN_CTL", CCGetFromGet("TAKEN_CTL", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "IS_TAKEN", CCGetFromGet("IS_TAKEN", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "CURR_DOC_ID", CCGetFromGet("CURR_DOC_ID", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "CURR_DOC_TYPE_ID", CCGetFromGet("CURR_DOC_TYPE_ID", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "CURR_PROC_ID", CCGetFromGet("CURR_PROC_ID", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "CURR_CTL_ID", CCGetFromGet("CURR_CTL_ID", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "USER_ID_DOC", CCGetFromGet("USER_ID_DOC", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "USER_ID_DONOR", CCGetFromGet("USER_ID_DONOR", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "USER_ID_LOGIN", CCGetFromGet("USER_ID_LOGIN", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "USER_ID_TAKEN", CCGetFromGet("USER_ID_TAKEN", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "IS_CREATE_DOC", CCGetFromGet("IS_CREATE_DOC", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "IS_MANUAL", CCGetFromGet("IS_MANUAL", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "CURR_PROC_STATUS", CCGetFromGet("CURR_PROC_STATUS", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "CURR_DOC_STATUS", CCGetFromGet("CURR_DOC_STATUS", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "PREV_DOC_ID", CCGetFromGet("PREV_DOC_ID", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "PREV_DOC_TYPE_ID", CCGetFromGet("PREV_DOC_TYPE_ID", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "PREV_PROC_ID", CCGetFromGet("PREV_PROC_ID", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "PREV_CTL_ID", CCGetFromGet("PREV_CTL_ID", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "SLOT_1", CCGetFromGet("SLOT_1", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "SLOT_2", CCGetFromGet("SLOT_2", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "SLOT_3", CCGetFromGet("SLOT_3", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "SLOT_4", CCGetFromGet("SLOT_4", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "SLOT_5", CCGetFromGet("SLOT_5", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "MESSAGE", CCGetFromGet("MESSAGE", NULL));
                $this->ImageLink2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "t_vat_setllement_id", $this->DataSource->f("t_vat_setllement_id"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "npwd", $this->DataSource->f("npwd"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "t_cust_account_id", $this->DataSource->f("t_cust_account_id"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "finance_period_code", $this->DataSource->f("finance_period_code"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "p_finance_period_id", $this->DataSource->f("p_finance_period_id"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "t_customer_order_id", $this->DataSource->f("t_customer_order_id"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "p_rqst_type_id", $this->DataSource->f("p_rqst_type_id"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "order_no", $this->DataSource->f("order_no"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "rqst_type_code", $this->DataSource->f("rqst_type_code"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "TAKEN_CTL", CCGetFromGet("TAKEN_CTL", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "IS_TAKEN", CCGetFromGet("IS_TAKEN", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "CURR_DOC_ID", CCGetFromGet("CURR_DOC_ID", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "CURR_DOC_TYPE_ID", CCGetFromGet("CURR_DOC_TYPE_ID", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "CURR_PROC_ID", CCGetFromGet("CURR_PROC_ID", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "CURR_CTL_ID", CCGetFromGet("CURR_CTL_ID", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "USER_ID_DOC", CCGetFromGet("USER_ID_DOC", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "USER_ID_DONOR", CCGetFromGet("USER_ID_DONOR", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "USER_ID_LOGIN", CCGetFromGet("USER_ID_LOGIN", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "USER_ID_TAKEN", CCGetFromGet("USER_ID_TAKEN", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "IS_CREATE_DOC", CCGetFromGet("IS_CREATE_DOC", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "IS_MANUAL", CCGetFromGet("IS_MANUAL", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "CURR_PROC_STATUS", CCGetFromGet("CURR_PROC_STATUS", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "CURR_DOC_STATUS", CCGetFromGet("CURR_DOC_STATUS", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "PREV_DOC_ID", CCGetFromGet("PREV_DOC_ID", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "PREV_DOC_TYPE_ID", CCGetFromGet("PREV_DOC_TYPE_ID", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "PREV_PROC_ID", CCGetFromGet("PREV_PROC_ID", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "PREV_CTL_ID", CCGetFromGet("PREV_CTL_ID", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "SLOT_1", CCGetFromGet("SLOT_1", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "SLOT_2", CCGetFromGet("SLOT_2", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "SLOT_3", CCGetFromGet("SLOT_3", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "SLOT_4", CCGetFromGet("SLOT_4", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "SLOT_5", CCGetFromGet("SLOT_5", NULL));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "MESSAGE", CCGetFromGet("MESSAGE", NULL));
                $this->p_rqst_type_id->SetValue($this->DataSource->p_rqst_type_id->GetValue());
                $this->total_vat_amount->SetValue($this->DataSource->total_vat_amount->GetValue());
                $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                $this->total_penalty_amount->SetValue($this->DataSource->total_penalty_amount->GetValue());
                $this->user->SetText(CCGetUserLogin());
                $this->no_kohir->SetValue($this->DataSource->no_kohir->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->npwd->Show();
                $this->finance_period_code->Show();
                $this->order_no->Show();
                $this->t_vat_setllement_id->Show();
                $this->total_trans_amount->Show();
                $this->ImageLink1->Show();
                $this->ImageLink2->Show();
                $this->p_rqst_type_id->Show();
                $this->total_vat_amount->Show();
                $this->cetak_sptpd->Show();
                $this->p_vat_type_id->Show();
                $this->cetak->Show();
                $this->wp_name->Show();
                $this->t_customer_order_id->Show();
                $this->total_penalty_amount->Show();
                $this->cetak_payment->Show();
                $this->user->Show();
                $this->cetak_register1->Show();
                $this->cetak_register->Show();
                $this->total_total->Show();
                $this->no_kohir->Show();
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
        $this->Button1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-497EA040
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->npwd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->finance_period_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->order_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_setllement_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_trans_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_rqst_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_vat_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cetak_sptpd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_vat_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cetak->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wp_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_customer_order_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_penalty_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->user->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_total->Errors->ToString());
        $errors = ComposeStrings($errors, $this->no_kohir->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_vat_setllementGrid Class @2-FCB6E20C

class clst_vat_setllementGridDataSource extends clsDBConnSIKP {  //t_vat_setllementGridDataSource Class @2-F0AECE38

//DataSource Variables @2-70935D8E
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $npwd;
    var $finance_period_code;
    var $order_no;
    var $t_vat_setllement_id;
    var $total_trans_amount;
    var $p_rqst_type_id;
    var $total_vat_amount;
    var $p_vat_type_id;
    var $wp_name;
    var $t_customer_order_id;
    var $total_penalty_amount;
    var $user;
    var $no_kohir;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-09EA57F7
    function clst_vat_setllementGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_vat_setllementGrid";
        $this->Initialize();
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->finance_period_code = new clsField("finance_period_code", ccsText, "");
        
        $this->order_no = new clsField("order_no", ccsText, "");
        
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsFloat, "");
        
        $this->total_trans_amount = new clsField("total_trans_amount", ccsFloat, "");
        
        $this->p_rqst_type_id = new clsField("p_rqst_type_id", ccsFloat, "");
        
        $this->total_vat_amount = new clsField("total_vat_amount", ccsFloat, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsFloat, "");
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsInteger, "");
        
        $this->total_penalty_amount = new clsField("total_penalty_amount", ccsFloat, "");
        
        $this->user = new clsField("user", ccsText, "");
        
        $this->no_kohir = new clsField("no_kohir", ccsText, "");
        

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

//Prepare Method @2-F9A3DF44
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_customer_order_id", ccsFloat, "", "", $this->Parameters["urlt_customer_order_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-F0A390AF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.no_kohir,d.wp_name, a.t_vat_setllement_id, a.t_customer_order_id, \n" .
        "a.settlement_date, a.p_finance_period_id, \n" .
        "a.t_cust_account_id, a.npwd, a.total_trans_amount, a.total_penalty_amount,\n" .
        "a.total_vat_amount, b.code as finance_period_code, c.order_no, c.p_rqst_type_id, e.code as rqst_type_code, d.p_vat_type_id\n" .
        "FROM t_vat_setllement a, p_finance_period b, t_customer_order c, t_cust_account d, p_rqst_type e\n" .
        "WHERE a.p_finance_period_id = b.p_finance_period_id AND\n" .
        "a.t_customer_order_id = c.t_customer_order_id AND\n" .
        "a.t_cust_account_id = d.t_cust_account_id AND\n" .
        "c.p_rqst_type_id = e.p_rqst_type_id AND\n" .
        "a.t_customer_order_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ") cnt";
        $this->SQL = "SELECT a.no_kohir,d.wp_name, a.t_vat_setllement_id, a.t_customer_order_id, \n" .
        "a.settlement_date, a.p_finance_period_id, \n" .
        "a.t_cust_account_id, a.npwd, a.total_trans_amount, a.total_penalty_amount,\n" .
        "a.total_vat_amount, b.code as finance_period_code, c.order_no, c.p_rqst_type_id, e.code as rqst_type_code, d.p_vat_type_id\n" .
        "FROM t_vat_setllement a, p_finance_period b, t_customer_order c, t_cust_account d, p_rqst_type e\n" .
        "WHERE a.p_finance_period_id = b.p_finance_period_id AND\n" .
        "a.t_customer_order_id = c.t_customer_order_id AND\n" .
        "a.t_cust_account_id = d.t_cust_account_id AND\n" .
        "c.p_rqst_type_id = e.p_rqst_type_id AND\n" .
        "a.t_customer_order_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-CD0EF48A
    function SetValues()
    {
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->finance_period_code->SetDBValue($this->f("finance_period_code"));
        $this->order_no->SetDBValue($this->f("order_no"));
        $this->t_vat_setllement_id->SetDBValue(trim($this->f("t_vat_setllement_id")));
        $this->total_trans_amount->SetDBValue(trim($this->f("total_trans_amount")));
        $this->p_rqst_type_id->SetDBValue(trim($this->f("p_rqst_type_id")));
        $this->total_vat_amount->SetDBValue(trim($this->f("total_vat_amount")));
        $this->p_vat_type_id->SetDBValue(trim($this->f("p_vat_type_id")));
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->t_customer_order_id->SetDBValue(trim($this->f("t_customer_order_id")));
        $this->total_penalty_amount->SetDBValue(trim($this->f("total_penalty_amount")));
        $this->no_kohir->SetDBValue($this->f("no_kohir"));
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

//Class_Initialize Event @23-041BCC88
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
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->t_vat_setllement_id = & new clsControl(ccsHidden, "t_vat_setllement_id", "Id", ccsFloat, "", CCGetRequestParam("t_vat_setllement_id", $Method, NULL), $this);
            $this->is_anomali = & new clsControl(ccsListBox, "is_anomali", "Anomali ?", ccsText, "", CCGetRequestParam("is_anomali", $Method, NULL), $this);
            $this->is_anomali->DSType = dsListOfValues;
            $this->is_anomali->Values = array(array("N", "TIDAK"), array("Y", "YA"));
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            $this->no_kohir = & new clsControl(ccsTextBox, "no_kohir", "Nomor Kohir", ccsText, "", CCGetRequestParam("no_kohir", $Method, NULL), $this);
            $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsFloat, "", CCGetRequestParam("t_customer_order_id", $Method, NULL), $this);
            $this->npwd = & new clsControl(ccsTextBox, "npwd", "NPWD", ccsText, "", CCGetRequestParam("npwd", $Method, NULL), $this);
            $this->order_no = & new clsControl(ccsTextBox, "order_no", "Nomor Order", ccsText, "", CCGetRequestParam("order_no", $Method, NULL), $this);
            $this->finance_period_code = & new clsControl(ccsTextBox, "finance_period_code", "Periode", ccsText, "", CCGetRequestParam("finance_period_code", $Method, NULL), $this);
            $this->start_period = & new clsControl(ccsTextBox, "start_period", "Masa Pajak", ccsText, "", CCGetRequestParam("start_period", $Method, NULL), $this);
            $this->end_period = & new clsControl(ccsTextBox, "end_period", "end_period", ccsText, "", CCGetRequestParam("end_period", $Method, NULL), $this);
            $this->total_trans_amount = & new clsControl(ccsTextBox, "total_trans_amount", "Total Transaksi", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_trans_amount", $Method, NULL), $this);
            $this->total_vat_amount = & new clsControl(ccsTextBox, "total_vat_amount", "Total Pajak", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_vat_amount", $Method, NULL), $this);
            $this->jenis_pajak = & new clsControl(ccsTextBox, "jenis_pajak", "Jenis Pajak", ccsText, "", CCGetRequestParam("jenis_pajak", $Method, NULL), $this);
            $this->due_date = & new clsControl(ccsTextBox, "due_date", "due_date", ccsText, "", CCGetRequestParam("due_date", $Method, NULL), $this);
            $this->due_date->Required = true;
            $this->wp_name = & new clsControl(ccsTextBox, "wp_name", "Nama Wajib Pajak", ccsText, "", CCGetRequestParam("wp_name", $Method, NULL), $this);
            $this->wp_address_name = & new clsControl(ccsTextArea, "wp_address_name", "Alamat Wajib Pajak", ccsText, "", CCGetRequestParam("wp_address_name", $Method, NULL), $this);
            $this->cetak_payment = & new clsButton("cetak_payment", $Method, $this);
            $this->cetak_register1 = & new clsButton("cetak_register1", $Method, $this);
            $this->user = & new clsControl(ccsHidden, "user", "user", ccsText, "", CCGetRequestParam("user", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->due_date->Value) && !strlen($this->due_date->Value) && $this->due_date->Value !== false)
                    $this->due_date->SetText(date("d-M-Y h:i:s"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @23-E8596F60
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_customer_order_id"] = CCGetFromGet("t_customer_order_id", NULL);
    }
//End Initialize Method

//Validate Method @23-69F64DCE
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_vat_setllement_id->Validate() && $Validation);
        $Validation = ($this->is_anomali->Validate() && $Validation);
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $Validation = ($this->no_kohir->Validate() && $Validation);
        $Validation = ($this->t_customer_order_id->Validate() && $Validation);
        $Validation = ($this->npwd->Validate() && $Validation);
        $Validation = ($this->order_no->Validate() && $Validation);
        $Validation = ($this->finance_period_code->Validate() && $Validation);
        $Validation = ($this->start_period->Validate() && $Validation);
        $Validation = ($this->end_period->Validate() && $Validation);
        $Validation = ($this->total_trans_amount->Validate() && $Validation);
        $Validation = ($this->total_vat_amount->Validate() && $Validation);
        $Validation = ($this->jenis_pajak->Validate() && $Validation);
        $Validation = ($this->due_date->Validate() && $Validation);
        $Validation = ($this->wp_name->Validate() && $Validation);
        $Validation = ($this->wp_address_name->Validate() && $Validation);
        $Validation = ($this->user->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_vat_setllement_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_anomali->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->no_kohir->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_order_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npwd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->order_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->finance_period_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->start_period->Errors->Count() == 0);
        $Validation =  $Validation && ($this->end_period->Errors->Count() == 0);
        $Validation =  $Validation && ($this->total_trans_amount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->total_vat_amount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->jenis_pajak->Errors->Count() == 0);
        $Validation =  $Validation && ($this->due_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->user->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-6043D3E4
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_vat_setllement_id->Errors->Count());
        $errors = ($errors || $this->is_anomali->Errors->Count());
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->no_kohir->Errors->Count());
        $errors = ($errors || $this->t_customer_order_id->Errors->Count());
        $errors = ($errors || $this->npwd->Errors->Count());
        $errors = ($errors || $this->order_no->Errors->Count());
        $errors = ($errors || $this->finance_period_code->Errors->Count());
        $errors = ($errors || $this->start_period->Errors->Count());
        $errors = ($errors || $this->end_period->Errors->Count());
        $errors = ($errors || $this->total_trans_amount->Errors->Count());
        $errors = ($errors || $this->total_vat_amount->Errors->Count());
        $errors = ($errors || $this->jenis_pajak->Errors->Count());
        $errors = ($errors || $this->due_date->Errors->Count());
        $errors = ($errors || $this->wp_name->Errors->Count());
        $errors = ($errors || $this->wp_address_name->Errors->Count());
        $errors = ($errors || $this->user->Errors->Count());
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

//Operation Method @23-52D0105A
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "cetak_payment";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->cetak_payment->Pressed) {
                $this->PressedButton = "cetak_payment";
            } else if($this->cetak_register1->Pressed) {
                $this->PressedButton = "cetak_register1";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "cetak_payment") {
                if(!CCGetEvent($this->cetak_payment->CCSEvents, "OnClick", $this->cetak_payment)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "cetak_register1") {
                if(!CCGetEvent($this->cetak_register1->CCSEvents, "OnClick", $this->cetak_register1)) {
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

//UpdateRow Method @23-E964B810
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->is_anomali->SetValue($this->is_anomali->GetValue(true));
        $this->DataSource->t_vat_setllement_id->SetValue($this->t_vat_setllement_id->GetValue(true));
        $this->DataSource->no_kohir->SetValue($this->no_kohir->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @23-C38248F3
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

        $this->is_anomali->Prepare();

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
                    $this->t_vat_setllement_id->SetValue($this->DataSource->t_vat_setllement_id->GetValue());
                    $this->is_anomali->SetValue($this->DataSource->is_anomali->GetValue());
                    $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                    $this->no_kohir->SetValue($this->DataSource->no_kohir->GetValue());
                    $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                    $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                    $this->order_no->SetValue($this->DataSource->order_no->GetValue());
                    $this->finance_period_code->SetValue($this->DataSource->finance_period_code->GetValue());
                    $this->start_period->SetValue($this->DataSource->start_period->GetValue());
                    $this->end_period->SetValue($this->DataSource->end_period->GetValue());
                    $this->total_trans_amount->SetValue($this->DataSource->total_trans_amount->GetValue());
                    $this->total_vat_amount->SetValue($this->DataSource->total_vat_amount->GetValue());
                    $this->jenis_pajak->SetValue($this->DataSource->jenis_pajak->GetValue());
                    $this->due_date->SetValue($this->DataSource->due_date->GetValue());
                    $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                    $this->wp_address_name->SetValue($this->DataSource->wp_address_name->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
            $this->user->SetText(CCGetUserLogin());
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_vat_setllement_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_anomali->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->no_kohir->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_order_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npwd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->order_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->finance_period_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->start_period->Errors->ToString());
            $Error = ComposeStrings($Error, $this->end_period->Errors->ToString());
            $Error = ComposeStrings($Error, $this->total_trans_amount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->total_vat_amount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->jenis_pajak->Errors->ToString());
            $Error = ComposeStrings($Error, $this->due_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->user->Errors->ToString());
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

        $this->Button_Update->Show();
        $this->t_vat_setllement_id->Show();
        $this->is_anomali->Show();
        $this->t_cust_account_id->Show();
        $this->no_kohir->Show();
        $this->t_customer_order_id->Show();
        $this->npwd->Show();
        $this->order_no->Show();
        $this->finance_period_code->Show();
        $this->start_period->Show();
        $this->end_period->Show();
        $this->total_trans_amount->Show();
        $this->total_vat_amount->Show();
        $this->jenis_pajak->Show();
        $this->due_date->Show();
        $this->wp_name->Show();
        $this->wp_address_name->Show();
        $this->cetak_payment->Show();
        $this->cetak_register1->Show();
        $this->user->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_vat_setllementForm Class @23-FCB6E20C

class clst_vat_setllementFormDataSource extends clsDBConnSIKP {  //t_vat_setllementFormDataSource Class @23-AF9958CC

//DataSource Variables @23-77F7C1EF
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $t_vat_setllement_id;
    var $is_anomali;
    var $t_cust_account_id;
    var $no_kohir;
    var $t_customer_order_id;
    var $npwd;
    var $order_no;
    var $finance_period_code;
    var $start_period;
    var $end_period;
    var $total_trans_amount;
    var $total_vat_amount;
    var $jenis_pajak;
    var $due_date;
    var $wp_name;
    var $wp_address_name;
    var $user;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-3395A667
    function clst_vat_setllementFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_vat_setllementForm/Error";
        $this->Initialize();
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsFloat, "");
        
        $this->is_anomali = new clsField("is_anomali", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->no_kohir = new clsField("no_kohir", ccsText, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsFloat, "");
        
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->order_no = new clsField("order_no", ccsText, "");
        
        $this->finance_period_code = new clsField("finance_period_code", ccsText, "");
        
        $this->start_period = new clsField("start_period", ccsText, "");
        
        $this->end_period = new clsField("end_period", ccsText, "");
        
        $this->total_trans_amount = new clsField("total_trans_amount", ccsFloat, "");
        
        $this->total_vat_amount = new clsField("total_vat_amount", ccsFloat, "");
        
        $this->jenis_pajak = new clsField("jenis_pajak", ccsText, "");
        
        $this->due_date = new clsField("due_date", ccsText, "");
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->wp_address_name = new clsField("wp_address_name", ccsText, "");
        
        $this->user = new clsField("user", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-0AD94F65
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_customer_order_id", ccsText, "", "", $this->Parameters["urlt_customer_order_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @23-75D2CAAF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT *\n" .
        "FROM v_vat_setllement_ro\n" .
        "WHERE t_customer_order_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-67E78B86
    function SetValues()
    {
        $this->t_vat_setllement_id->SetDBValue(trim($this->f("t_vat_setllement_id")));
        $this->is_anomali->SetDBValue($this->f("is_anomali"));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->no_kohir->SetDBValue($this->f("no_kohir"));
        $this->t_customer_order_id->SetDBValue(trim($this->f("t_customer_order_id")));
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->order_no->SetDBValue($this->f("order_no"));
        $this->finance_period_code->SetDBValue($this->f("finance_period_code"));
        $this->start_period->SetDBValue($this->f("start_period"));
        $this->end_period->SetDBValue($this->f("end_period"));
        $this->total_trans_amount->SetDBValue(trim($this->f("total_trans_amount")));
        $this->total_vat_amount->SetDBValue(trim($this->f("total_vat_amount")));
        $this->jenis_pajak->SetDBValue($this->f("jenis_pajak"));
        $this->due_date->SetDBValue($this->f("due_date"));
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->wp_address_name->SetDBValue($this->f("wp_address_name"));
    }
//End SetValues Method

//Update Method @23-8D274A74
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["is_anomali"] = new clsSQLParameter("ctrlis_anomali", ccsText, "", "", $this->is_anomali->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_vat_setllement_id"] = new clsSQLParameter("ctrlt_vat_setllement_id", ccsFloat, "", "", $this->t_vat_setllement_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["no_kohir"] = new clsSQLParameter("ctrlno_kohir", ccsText, "", "", $this->no_kohir->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["is_anomali"]->GetValue()) and !strlen($this->cp["is_anomali"]->GetText()) and !is_bool($this->cp["is_anomali"]->GetValue())) 
            $this->cp["is_anomali"]->SetValue($this->is_anomali->GetValue(true));
        if (!is_null($this->cp["t_vat_setllement_id"]->GetValue()) and !strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue())) 
            $this->cp["t_vat_setllement_id"]->SetValue($this->t_vat_setllement_id->GetValue(true));
        if (!strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue(true))) 
            $this->cp["t_vat_setllement_id"]->SetText(0);
        if (!is_null($this->cp["no_kohir"]->GetValue()) and !strlen($this->cp["no_kohir"]->GetText()) and !is_bool($this->cp["no_kohir"]->GetValue())) 
            $this->cp["no_kohir"]->SetValue($this->no_kohir->GetValue(true));
        $this->SQL = "UPDATE t_vat_setllement SET\n" .
        "is_anomali = '" . $this->SQLValue($this->cp["is_anomali"]->GetDBValue(), ccsText) . "',\n" .
        "no_kohir='" . $this->SQLValue($this->cp["no_kohir"]->GetDBValue(), ccsText) . "' \n" .
        "WHERE t_vat_setllement_id = " . $this->SQLValue($this->cp["t_vat_setllement_id"]->GetDBValue(), ccsFloat) . " ";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End t_vat_setllementFormDataSource Class @23-FCB6E20C

class clsRecordt_vat_setllement_dtlSearch { //t_vat_setllement_dtlSearch Class @355-A55E5ABA

//Variables @355-D6FF3E86

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

//Class_Initialize Event @355-0798A001
    function clsRecordt_vat_setllement_dtlSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_vat_setllement_dtlSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_vat_setllement_dtlSearch";
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

//Validate Method @355-A144A629
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

//CheckErrors Method @355-D6729123
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @355-ED598703
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

//Operation Method @355-2B2F1624
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
        $Redirect = "t_vat_setllement_ro_salah.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_vat_setllement_ro_salah.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @355-7913FA87
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

} //End t_vat_setllement_dtlSearch Class @355-FCB6E20C





//Initialize Page @1-544D17EA
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
$TemplateFileName = "t_vat_setllement_ro.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-E1F0AD86
include_once("./t_vat_setllement_ro_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-726CB197
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_vat_setllementGrid = & new clsGridt_vat_setllementGrid("", $MainPage);
$t_vat_setllementForm = & new clsRecordt_vat_setllementForm("", $MainPage);
$t_vat_setllement_dtlSearch = & new clsRecordt_vat_setllement_dtlSearch("", $MainPage);
$MainPage->t_vat_setllementGrid = & $t_vat_setllementGrid;
$MainPage->t_vat_setllementForm = & $t_vat_setllementForm;
$MainPage->t_vat_setllement_dtlSearch = & $t_vat_setllement_dtlSearch;
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

//Execute Components @1-DD0E0558
$t_vat_setllementForm->Operation();
$t_vat_setllement_dtlSearch->Operation();
//End Execute Components

//Go to destination page @1-0402F6BE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_vat_setllementGrid);
    unset($t_vat_setllementForm);
    unset($t_vat_setllement_dtlSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-8AF6FC46
$t_vat_setllementGrid->Show();
$t_vat_setllementForm->Show();
$t_vat_setllement_dtlSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F1A37573
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_vat_setllementGrid);
unset($t_vat_setllementForm);
unset($t_vat_setllement_dtlSearch);
unset($Tpl);
//End Unload Page


?>
