<?php
//Include Common Files @1-FD4AF6B5
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_message_inbox_bphtb.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_message_inboxGrid { //t_message_inboxGrid class @2-8DA38A94

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

//Class_Initialize Event @2-BABC8066
    function clsGridt_message_inboxGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_message_inboxGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_message_inboxGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_message_inboxGridDataSource($this);
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
        $this->DLink->Page = "t_message_inbox_bphtb.php";
        $this->message_status = & new clsControl(ccsHidden, "message_status", "message_status", ccsText, "", CCGetRequestParam("message_status", ccsGet, NULL), $this);
        $this->creation_date = & new clsControl(ccsLabel, "creation_date", "creation_date", ccsText, "", CCGetRequestParam("creation_date", ccsGet, NULL), $this);
        $this->message_type = & new clsControl(ccsLabel, "message_type", "message_type", ccsText, "", CCGetRequestParam("message_type", ccsGet, NULL), $this);
        $this->t_message_inbox_bphtb_id = & new clsControl(ccsHidden, "t_message_inbox_bphtb_id", "t_message_inbox_bphtb_id", ccsFloat, "", CCGetRequestParam("t_message_inbox_bphtb_id", ccsGet, NULL), $this);
        $this->status_view = & new clsControl(ccsLabel, "status_view", "status_view", ccsText, "", CCGetRequestParam("status_view", ccsGet, NULL), $this);
        $this->ppat_name = & new clsControl(ccsLabel, "ppat_name", "ppat_name", ccsText, "", CCGetRequestParam("ppat_name", ccsGet, NULL), $this);
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

//Show Method @2-032693A4
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["sesUserID"] = CCGetSession("UserID", NULL);

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
            $this->ControlsVisible["message_status"] = $this->message_status->Visible;
            $this->ControlsVisible["creation_date"] = $this->creation_date->Visible;
            $this->ControlsVisible["message_type"] = $this->message_type->Visible;
            $this->ControlsVisible["t_message_inbox_bphtb_id"] = $this->t_message_inbox_bphtb_id->Visible;
            $this->ControlsVisible["status_view"] = $this->status_view->Visible;
            $this->ControlsVisible["ppat_name"] = $this->ppat_name->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_message_inbox_id", $this->DataSource->f("t_message_inbox_bphtb_id"));
                $this->message_status->SetValue($this->DataSource->message_status->GetValue());
                $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                $this->message_type->SetValue($this->DataSource->message_type->GetValue());
                $this->t_message_inbox_bphtb_id->SetValue($this->DataSource->t_message_inbox_bphtb_id->GetValue());
                $this->status_view->SetValue($this->DataSource->status_view->GetValue());
                $this->ppat_name->SetValue($this->DataSource->ppat_name->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->message_status->Show();
                $this->creation_date->Show();
                $this->message_type->Show();
                $this->t_message_inbox_bphtb_id->Show();
                $this->status_view->Show();
                $this->ppat_name->Show();
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

//GetErrors Method @2-26AB3B14
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->message_status->Errors->ToString());
        $errors = ComposeStrings($errors, $this->creation_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->message_type->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_message_inbox_bphtb_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->status_view->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ppat_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_message_inboxGrid Class @2-FCB6E20C

class clst_message_inboxGridDataSource extends clsDBConnSIKP {  //t_message_inboxGridDataSource Class @2-023EE474

//DataSource Variables @2-C51C622E
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $message_status;
    var $creation_date;
    var $message_type;
    var $t_message_inbox_bphtb_id;
    var $status_view;
    var $ppat_name;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-86EE93D7
    function clst_message_inboxGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_message_inboxGrid";
        $this->Initialize();
        $this->message_status = new clsField("message_status", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->message_type = new clsField("message_type", ccsText, "");
        
        $this->t_message_inbox_bphtb_id = new clsField("t_message_inbox_bphtb_id", ccsFloat, "");
        
        $this->status_view = new clsField("status_view", ccsText, "");
        
        $this->ppat_name = new clsField("ppat_name", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-B5063110
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "inbox.creation_date DESC";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-3E44CC8B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "sesUserID", ccsText, "", "", $this->Parameters["sesUserID"], "", false);
    }
//End Prepare Method

//Open Method @2-1CB84317
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT\n" .
        "	x.ppat_name,\n" .
        "		inbox.*, to_char(\n" .
        "		inbox.creation_date,\n" .
        "		'yyyy-mm-dd HH24:MI:SS AM'\n" .
        "	) AS creation_date,\n" .
        "	to_char(\n" .
        "		inbox.creation_date,\n" .
        "		'HH24:MI:SS PM'\n" .
        "	) AS creation_time,\n" .
        "	to_char(\n" .
        "		inbox.update_date,\n" .
        "		'yyyy-mm-dd'\n" .
        "	) AS update_date,\n" .
        "	mtype.message_type\n" .
        "FROM\n" .
        "	t_message_inbox_bphtb inbox\n" .
        "LEFT JOIN sikp.p_message_type mtype ON mtype.p_message_type_id = inbox.p_message_type_id\n" .
        "LEFT JOIN t_ppat x on x.t_ppat_id = inbox.t_ppat_id\n" .
        "where p_app_role_id_to = 27) cnt";
        $this->SQL = "SELECT\n" .
        "	x.ppat_name,\n" .
        "		inbox.*, to_char(\n" .
        "		inbox.creation_date,\n" .
        "		'yyyy-mm-dd HH24:MI:SS AM'\n" .
        "	) AS creation_date,\n" .
        "	to_char(\n" .
        "		inbox.creation_date,\n" .
        "		'HH24:MI:SS PM'\n" .
        "	) AS creation_time,\n" .
        "	to_char(\n" .
        "		inbox.update_date,\n" .
        "		'yyyy-mm-dd'\n" .
        "	) AS update_date,\n" .
        "	mtype.message_type\n" .
        "FROM\n" .
        "	t_message_inbox_bphtb inbox\n" .
        "LEFT JOIN sikp.p_message_type mtype ON mtype.p_message_type_id = inbox.p_message_type_id\n" .
        "LEFT JOIN t_ppat x on x.t_ppat_id = inbox.t_ppat_id\n" .
        "where p_app_role_id_to = 27 {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-6D34E728
    function SetValues()
    {
        $this->message_status->SetDBValue($this->f("message_status"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->message_type->SetDBValue($this->f("message_type"));
        $this->t_message_inbox_bphtb_id->SetDBValue(trim($this->f("t_message_inbox__bphtb_id")));
        $this->status_view->SetDBValue($this->f("status_view"));
        $this->ppat_name->SetDBValue($this->f("ppat_name"));
    }
//End SetValues Method

} //End t_message_inboxGridDataSource Class @2-FCB6E20C

class clsRecordt_message_inboxForm { //t_message_inboxForm Class @23-2651B045

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

//Class_Initialize Event @23-822E2CA8
    function clsRecordt_message_inboxForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_message_inboxForm/Error";
        $this->DataSource = new clst_message_inboxFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_message_inboxForm";
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
            $this->message_body = & new clsControl(ccsLabel, "message_body", "message_body", ccsMemo, "", CCGetRequestParam("message_body", $Method, NULL), $this);
            $this->message_body->HTML = true;
            $this->message_type = & new clsControl(ccsTextBox, "message_type", "message_type", ccsText, "", CCGetRequestParam("message_type", $Method, NULL), $this);
            $this->t_message_inbox_bphtb_id = & new clsControl(ccsHidden, "t_message_inbox_bphtb_id", "t_message_inbox_bphtb_id", ccsFloat, "", CCGetRequestParam("t_message_inbox_bphtb_id", $Method, NULL), $this);
            $this->Button_Insert1 = & new clsButton("Button_Insert1", $Method, $this);
            $this->t_ppat_id = & new clsControl(ccsHidden, "t_ppat_id", "t_ppat_id", ccsFloat, "", CCGetRequestParam("t_ppat_id", $Method, NULL), $this);
            $this->ppat_name = & new clsControl(ccsTextBox, "ppat_name", "ppat_name", ccsText, "", CCGetRequestParam("ppat_name", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @23-8316BF79
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_message_inbox_id"] = CCGetFromGet("t_message_inbox_id", NULL);
    }
//End Initialize Method

//Validate Method @23-B702A014
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->message_type->Validate() && $Validation);
        $Validation = ($this->t_message_inbox_bphtb_id->Validate() && $Validation);
        $Validation = ($this->t_ppat_id->Validate() && $Validation);
        $Validation = ($this->ppat_name->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->message_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_message_inbox_bphtb_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_ppat_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ppat_name->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-34A73776
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->message_body->Errors->Count());
        $errors = ($errors || $this->message_type->Errors->Count());
        $errors = ($errors || $this->t_message_inbox_bphtb_id->Errors->Count());
        $errors = ($errors || $this->t_ppat_id->Errors->Count());
        $errors = ($errors || $this->ppat_name->Errors->Count());
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

//Operation Method @23-CA7A1ECE
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
            } else if($this->Button_Insert1->Pressed) {
                $this->PressedButton = "Button_Insert1";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_vat_type_id", "p_vat_typeGridPage", "s_keyword"));
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
            } else if($this->PressedButton == "Button_Insert1") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Insert1->CCSEvents, "OnClick", $this->Button_Insert1) || !$this->UpdateRow()) {
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

//UpdateRow Method @23-A4FD2D05
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_customer_order_id->SetValue($this->t_customer_order_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-3EAB8143
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_vat_setllement_id->SetValue($this->t_vat_setllement_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-087518D6
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
                $this->message_body->SetValue($this->DataSource->message_body->GetValue());
                if(!$this->FormSubmitted){
                    $this->message_type->SetValue($this->DataSource->message_type->GetValue());
                    $this->t_message_inbox_bphtb_id->SetValue($this->DataSource->t_message_inbox_bphtb_id->GetValue());
                    $this->t_ppat_id->SetValue($this->DataSource->t_ppat_id->GetValue());
                    $this->ppat_name->SetValue($this->DataSource->ppat_name->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->message_body->Errors->ToString());
            $Error = ComposeStrings($Error, $this->message_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_message_inbox_bphtb_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_ppat_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ppat_name->Errors->ToString());
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
        $this->Button_Insert1->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->message_body->Show();
        $this->message_type->Show();
        $this->t_message_inbox_bphtb_id->Show();
        $this->Button_Insert1->Show();
        $this->t_ppat_id->Show();
        $this->ppat_name->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_message_inboxForm Class @23-FCB6E20C

class clst_message_inboxFormDataSource extends clsDBConnSIKP {  //t_message_inboxFormDataSource Class @23-5D097280

//DataSource Variables @23-B6AB146A
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
    var $message_body;
    var $message_type;
    var $t_message_inbox_bphtb_id;
    var $t_ppat_id;
    var $ppat_name;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-BADF491C
    function clst_message_inboxFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_message_inboxForm/Error";
        $this->Initialize();
        $this->message_body = new clsField("message_body", ccsMemo, "");
        
        $this->message_type = new clsField("message_type", ccsText, "");
        
        $this->t_message_inbox_bphtb_id = new clsField("t_message_inbox_bphtb_id", ccsFloat, "");
        
        $this->t_ppat_id = new clsField("t_ppat_id", ccsFloat, "");
        
        $this->ppat_name = new clsField("ppat_name", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-C33B0A38
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_message_inbox_id", ccsFloat, "", "", $this->Parameters["urlt_message_inbox_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @23-0A0CA7CB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT\n" .
        "	x.ppat_name,\n" .
        "	inbox.*, to_char(\n" .
        "		inbox.creation_date,\n" .
        "		'yyyy-mm-dd'\n" .
        "	) AS creation_date,\n" .
        "	to_char(\n" .
        "		inbox.creation_date,\n" .
        "		'HH24:MI:SS PM'\n" .
        "	) AS creation_time,\n" .
        "	to_char(\n" .
        "		inbox.update_date,\n" .
        "		'yyyy-mm-dd'\n" .
        "	) AS update_date,\n" .
        "	mtype.message_type\n" .
        "FROM\n" .
        "	t_message_inbox_bphtb inbox\n" .
        "LEFT JOIN sikp.p_message_type mtype ON mtype.p_message_type_id = inbox.p_message_type_id\n" .
        "LEFT JOIN t_ppat x on x.t_ppat_id = inbox.t_ppat_id\n" .
        "where t_message_inbox_bphtb_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-922E47CE
    function SetValues()
    {
        $this->message_body->SetDBValue($this->f("message_body"));
        $this->message_type->SetDBValue($this->f("message_type"));
        $this->t_message_inbox_bphtb_id->SetDBValue(trim($this->f("t_message_inbox_bphtb_id")));
        $this->t_ppat_id->SetDBValue(trim($this->f("t_ppat_id")));
        $this->ppat_name->SetDBValue($this->f("ppat_name"));
    }
//End SetValues Method

//Update Method @23-EF89D7FC
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_customer_order_id"] = new clsSQLParameter("ctrlt_customer_order_id", ccsFloat, "", "", $this->t_customer_order_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["UserName"] = new clsSQLParameter("expr255", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_customer_order_id"]->GetValue()) and !strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue())) 
            $this->cp["t_customer_order_id"]->SetValue($this->t_customer_order_id->GetValue(true));
        if (!strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue(true))) 
            $this->cp["t_customer_order_id"]->SetText(0);
        if (!is_null($this->cp["UserName"]->GetValue()) and !strlen($this->cp["UserName"]->GetText()) and !is_bool($this->cp["UserName"]->GetValue())) 
            $this->cp["UserName"]->SetValue(CCGetUserLogin());
        $this->SQL = "select o_result_code, o_result_msg from f_first_submit_engine(501," . $this->SQLValue($this->cp["t_customer_order_id"]->GetDBValue(), ccsFloat) . ",'" . $this->SQLValue($this->cp["UserName"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-E6A80831
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_vat_setllement_id"] = new clsSQLParameter("ctrlt_vat_setllement_id", ccsFloat, "", "", $this->t_vat_setllement_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_vat_setllement_id"]->GetValue()) and !strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue())) 
            $this->cp["t_vat_setllement_id"]->SetValue($this->t_vat_setllement_id->GetValue(true));
        if (!strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue(true))) 
            $this->cp["t_vat_setllement_id"]->SetText(0);
        $this->SQL = "select * from f_del_vat_setllement(" . $this->SQLValue($this->cp["t_vat_setllement_id"]->GetDBValue(), ccsFloat) . ",null,null)";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_message_inboxFormDataSource Class @23-FCB6E20C



//Initialize Page @1-A4D439D1
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
$TemplateFileName = "t_message_inbox_bphtb.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-363F64F3
include_once("./t_message_inbox_bphtb_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-4610CEEC
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_message_inboxGrid = & new clsGridt_message_inboxGrid("", $MainPage);
$t_message_inboxForm = & new clsRecordt_message_inboxForm("", $MainPage);
$MainPage->t_message_inboxGrid = & $t_message_inboxGrid;
$MainPage->t_message_inboxForm = & $t_message_inboxForm;
$t_message_inboxGrid->Initialize();
$t_message_inboxForm->Initialize();

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

//Execute Components @1-0E40CFD8
$t_message_inboxForm->Operation();
//End Execute Components

//Go to destination page @1-C3D31F0C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_message_inboxGrid);
    unset($t_message_inboxForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-034DA21F
$t_message_inboxGrid->Show();
$t_message_inboxForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-A3700FB5
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_message_inboxGrid);
unset($t_message_inboxForm);
unset($Tpl);
//End Unload Page


?>
