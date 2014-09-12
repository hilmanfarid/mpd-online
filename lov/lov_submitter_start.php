<?php
//Include Common Files @1-62B45339
define("RelativePath", "..");
define("PathToCurrentPage", "/lov/");
define("FileName", "lov_submitter_start.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordV_SUBMITTER { //V_SUBMITTER Class @82-5FB2DDB2

//Variables @82-D6FF3E86

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

//Class_Initialize Event @82-FBC4A705
    function clsRecordV_SUBMITTER($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record V_SUBMITTER/Error";
        $this->DataSource = new clsV_SUBMITTERDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "V_SUBMITTER";
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
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->SUBMIT_DATE = & new clsControl(ccsTextBox, "SUBMIT_DATE", "SUBMIT_DATE", ccsText, "", CCGetRequestParam("SUBMIT_DATE", $Method, NULL), $this);
            $this->INTERACTIVE_MESSAGE = & new clsControl(ccsTextArea, "INTERACTIVE_MESSAGE", "INTERACTIVE_MESSAGE", ccsText, "", CCGetRequestParam("INTERACTIVE_MESSAGE", $Method, NULL), $this);
            $this->SENT_MESSAGE = & new clsControl(ccsTextArea, "SENT_MESSAGE", "SENT_MESSAGE", ccsText, "", CCGetRequestParam("SENT_MESSAGE", $Method, NULL), $this);
            $this->ERROR_MESSAGE = & new clsControl(ccsTextArea, "ERROR_MESSAGE", "ERROR_MESSAGE", ccsText, "", CCGetRequestParam("ERROR_MESSAGE", $Method, NULL), $this);
            $this->WARNING = & new clsControl(ccsTextArea, "WARNING", "WARNING", ccsText, "", CCGetRequestParam("WARNING", $Method, NULL), $this);
            $this->CURR_DOC_ID = & new clsControl(ccsTextBox, "CURR_DOC_ID", "CURR_DOC_ID", ccsFloat, "", CCGetRequestParam("CURR_DOC_ID", $Method, NULL), $this);
            $this->CURR_DOC_TYPE_ID = & new clsControl(ccsTextBox, "CURR_DOC_TYPE_ID", "CURR_DOC_TYPE_ID", ccsFloat, "", CCGetRequestParam("CURR_DOC_TYPE_ID", $Method, NULL), $this);
            $this->CURR_PROC_ID = & new clsControl(ccsTextBox, "CURR_PROC_ID", "CURR_PROC_ID", ccsFloat, "", CCGetRequestParam("CURR_PROC_ID", $Method, NULL), $this);
            $this->CURR_CTL_ID = & new clsControl(ccsTextBox, "CURR_CTL_ID", "CURR_CTL_ID", ccsFloat, "", CCGetRequestParam("CURR_CTL_ID", $Method, NULL), $this);
            $this->PREV_DOC_ID = & new clsControl(ccsTextBox, "PREV_DOC_ID", "PREV_DOC_ID", ccsFloat, "", CCGetRequestParam("PREV_DOC_ID", $Method, NULL), $this);
            $this->PREV_DOC_TYPE_ID = & new clsControl(ccsTextBox, "PREV_DOC_TYPE_ID", "PREV_DOC_TYPE_ID", ccsFloat, "", CCGetRequestParam("PREV_DOC_TYPE_ID", $Method, NULL), $this);
            $this->PREV_PROC_ID = & new clsControl(ccsTextBox, "PREV_PROC_ID", "PREV_PROC_ID", ccsFloat, "", CCGetRequestParam("PREV_PROC_ID", $Method, NULL), $this);
            $this->PREV_CTL_ID = & new clsControl(ccsTextBox, "PREV_CTL_ID", "PREV_CTL_ID", ccsFloat, "", CCGetRequestParam("PREV_CTL_ID", $Method, NULL), $this);
            $this->SLOT_1 = & new clsControl(ccsTextBox, "SLOT_1", "SLOT_1", ccsText, "", CCGetRequestParam("SLOT_1", $Method, NULL), $this);
            $this->SLOT_2 = & new clsControl(ccsTextBox, "SLOT_2", "SLOT_2", ccsText, "", CCGetRequestParam("SLOT_2", $Method, NULL), $this);
            $this->SLOT_3 = & new clsControl(ccsTextBox, "SLOT_3", "SLOT_3", ccsText, "", CCGetRequestParam("SLOT_3", $Method, NULL), $this);
            $this->SLOT_4 = & new clsControl(ccsTextBox, "SLOT_4", "SLOT_4", ccsText, "", CCGetRequestParam("SLOT_4", $Method, NULL), $this);
            $this->SLOT_5 = & new clsControl(ccsTextBox, "SLOT_5", "SLOT_5", ccsText, "", CCGetRequestParam("SLOT_5", $Method, NULL), $this);
            $this->USER_ID_DOC = & new clsControl(ccsTextBox, "USER_ID_DOC", "USER_ID_DOC", ccsFloat, "", CCGetRequestParam("USER_ID_DOC", $Method, NULL), $this);
            $this->USER_ID_DONOR = & new clsControl(ccsTextBox, "USER_ID_DONOR", "USER_ID_DONOR", ccsFloat, "", CCGetRequestParam("USER_ID_DONOR", $Method, NULL), $this);
            $this->USER_ID_LOGIN = & new clsControl(ccsTextBox, "USER_ID_LOGIN", "USER_ID_LOGIN", ccsFloat, "", CCGetRequestParam("USER_ID_LOGIN", $Method, NULL), $this);
            $this->USER_ID_TAKEN = & new clsControl(ccsTextBox, "USER_ID_TAKEN", "USER_ID_TAKEN", ccsFloat, "", CCGetRequestParam("USER_ID_TAKEN", $Method, NULL), $this);
            $this->IS_CREATE_DOC = & new clsControl(ccsTextBox, "IS_CREATE_DOC", "IS_CREATE_DOC", ccsText, "", CCGetRequestParam("IS_CREATE_DOC", $Method, NULL), $this);
            $this->IS_MANUAL = & new clsControl(ccsTextBox, "IS_MANUAL", "IS_MANUAL", ccsText, "", CCGetRequestParam("IS_MANUAL", $Method, NULL), $this);
            $this->CURR_PROC_STATUS = & new clsControl(ccsTextBox, "CURR_PROC_STATUS", "CURR_PROC_STATUS", ccsText, "", CCGetRequestParam("CURR_PROC_STATUS", $Method, NULL), $this);
            $this->CURR_DOC_STATUS = & new clsControl(ccsTextBox, "CURR_DOC_STATUS", "CURR_DOC_STATUS", ccsText, "", CCGetRequestParam("CURR_DOC_STATUS", $Method, NULL), $this);
            $this->MESSAGE = & new clsControl(ccsTextBox, "MESSAGE", "MESSAGE", ccsText, "", CCGetRequestParam("MESSAGE", $Method, NULL), $this);
            $this->IS_VIEW_ONLY = & new clsControl(ccsTextBox, "IS_VIEW_ONLY", "IS_VIEW_ONLY", ccsText, "", CCGetRequestParam("IS_VIEW_ONLY", $Method, NULL), $this);
            $this->JENIS = & new clsControl(ccsTextBox, "JENIS", "JENIS", ccsText, "", CCGetRequestParam("JENIS", $Method, NULL), $this);
            $this->RETURN_MESSAGE = & new clsControl(ccsTextBox, "RETURN_MESSAGE", "RETURN_MESSAGE", ccsText, "", CCGetRequestParam("RETURN_MESSAGE", $Method, NULL), $this);
            $this->lusername = & new clsControl(ccsLabel, "lusername", "lusername", ccsText, "", CCGetRequestParam("lusername", $Method, NULL), $this);
            $this->SUBMITTER_ID = & new clsControl(ccsTextBox, "SUBMITTER_ID", "SUBMITTER_ID", ccsFloat, "", CCGetRequestParam("SUBMITTER_ID", $Method, NULL), $this);
            $this->NTASK = & new clsControl(ccsLabel, "NTASK", "NTASK", ccsText, "", CCGetRequestParam("NTASK", $Method, NULL), $this);
            $this->NTASK->HTML = true;
            $this->STS = & new clsControl(ccsListBox, "STS", "STS", ccsFloat, "", CCGetRequestParam("STS", $Method, NULL), $this);
            $this->STS->DSType = dsSQL;
            $this->STS->DataSource = new clsDBConnSIKP();
            $this->STS->ds = & $this->STS->DataSource;
            list($this->STS->BoundColumn, $this->STS->TextColumn, $this->STS->DBFormat) = array("p_status_list_id", "code", "");
            $this->STS->DataSource->SQL = "select p_status_list_id, code \n" .
            "from v_document_workflow_status";
            $this->STS->DataSource->Order = "";
            $this->Button_Reject = & new clsButton("Button_Reject", $Method, $this);
            $this->Button_Back = & new clsButton("Button_Back", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->SUBMIT_DATE->Value) && !strlen($this->SUBMIT_DATE->Value) && $this->SUBMIT_DATE->Value !== false)
                    $this->SUBMIT_DATE->SetText(date("d-M-Y"));
                if(!is_array($this->CURR_DOC_ID->Value) && !strlen($this->CURR_DOC_ID->Value) && $this->CURR_DOC_ID->Value !== false)
                    $this->CURR_DOC_ID->SetText(CCGetRequestParam("CURR_DOC_ID", ccsGet, NULL));
                if(!is_array($this->CURR_DOC_TYPE_ID->Value) && !strlen($this->CURR_DOC_TYPE_ID->Value) && $this->CURR_DOC_TYPE_ID->Value !== false)
                    $this->CURR_DOC_TYPE_ID->SetText(CCGetRequestParam("CURR_DOC_TYPE_ID", ccsGet, NULL));
                if(!is_array($this->CURR_PROC_ID->Value) && !strlen($this->CURR_PROC_ID->Value) && $this->CURR_PROC_ID->Value !== false)
                    $this->CURR_PROC_ID->SetText(CCGetRequestParam("CURR_PROC_ID", ccsGet, NULL));
                if(!is_array($this->CURR_CTL_ID->Value) && !strlen($this->CURR_CTL_ID->Value) && $this->CURR_CTL_ID->Value !== false)
                    $this->CURR_CTL_ID->SetText(CCGetRequestParam("CURR_CTL_ID", ccsGet, NULL));
                if(!is_array($this->PREV_DOC_ID->Value) && !strlen($this->PREV_DOC_ID->Value) && $this->PREV_DOC_ID->Value !== false)
                    $this->PREV_DOC_ID->SetText(CCGetRequestParam("PREV_PROC_ID", ccsGet, NULL));
                if(!is_array($this->PREV_DOC_TYPE_ID->Value) && !strlen($this->PREV_DOC_TYPE_ID->Value) && $this->PREV_DOC_TYPE_ID->Value !== false)
                    $this->PREV_DOC_TYPE_ID->SetText(CCGetRequestParam("PREV_DOC_TYPE_ID", ccsGet, NULL));
                if(!is_array($this->PREV_PROC_ID->Value) && !strlen($this->PREV_PROC_ID->Value) && $this->PREV_PROC_ID->Value !== false)
                    $this->PREV_PROC_ID->SetText(CCGetRequestParam("PREV_PROC_ID", ccsGet, NULL));
                if(!is_array($this->PREV_CTL_ID->Value) && !strlen($this->PREV_CTL_ID->Value) && $this->PREV_CTL_ID->Value !== false)
                    $this->PREV_CTL_ID->SetText(CCGetRequestParam("PREV_CTL_ID", ccsGet, NULL));
                if(!is_array($this->SLOT_1->Value) && !strlen($this->SLOT_1->Value) && $this->SLOT_1->Value !== false)
                    $this->SLOT_1->SetText(CCGetRequestParam("SLOT_1", ccsGet, NULL));
                if(!is_array($this->SLOT_2->Value) && !strlen($this->SLOT_2->Value) && $this->SLOT_2->Value !== false)
                    $this->SLOT_2->SetText(CCGetRequestParam("SLOT_2", ccsGet, NULL));
                if(!is_array($this->SLOT_3->Value) && !strlen($this->SLOT_3->Value) && $this->SLOT_3->Value !== false)
                    $this->SLOT_3->SetText(CCGetRequestParam("SLOT_3", ccsGet, NULL));
                if(!is_array($this->SLOT_4->Value) && !strlen($this->SLOT_4->Value) && $this->SLOT_4->Value !== false)
                    $this->SLOT_4->SetText(CCGetRequestParam("SLOT_4", ccsGet, NULL));
                if(!is_array($this->SLOT_5->Value) && !strlen($this->SLOT_5->Value) && $this->SLOT_5->Value !== false)
                    $this->SLOT_5->SetText(CCGetRequestParam("SLOT_5", ccsGet, NULL));
                if(!is_array($this->USER_ID_DOC->Value) && !strlen($this->USER_ID_DOC->Value) && $this->USER_ID_DOC->Value !== false)
                    $this->USER_ID_DOC->SetText(CCGetRequestParam("USER_ID_DOC", ccsGet, NULL));
                if(!is_array($this->USER_ID_DONOR->Value) && !strlen($this->USER_ID_DONOR->Value) && $this->USER_ID_DONOR->Value !== false)
                    $this->USER_ID_DONOR->SetText(CCGetRequestParam("USER_ID_DONOR", ccsGet, NULL));
                if(!is_array($this->USER_ID_LOGIN->Value) && !strlen($this->USER_ID_LOGIN->Value) && $this->USER_ID_LOGIN->Value !== false)
                    $this->USER_ID_LOGIN->SetText(CCGetUserID());
                if(!is_array($this->USER_ID_TAKEN->Value) && !strlen($this->USER_ID_TAKEN->Value) && $this->USER_ID_TAKEN->Value !== false)
                    $this->USER_ID_TAKEN->SetText(CCGetRequestParam("USER_ID_TAKEN", ccsGet, NULL));
                if(!is_array($this->IS_CREATE_DOC->Value) && !strlen($this->IS_CREATE_DOC->Value) && $this->IS_CREATE_DOC->Value !== false)
                    $this->IS_CREATE_DOC->SetText(CCGetRequestParam("IS_CREATE_DOC", ccsGet, NULL));
                if(!is_array($this->IS_MANUAL->Value) && !strlen($this->IS_MANUAL->Value) && $this->IS_MANUAL->Value !== false)
                    $this->IS_MANUAL->SetText(CCGetRequestParam("IS_MANUAL", ccsGet, NULL));
                if(!is_array($this->CURR_PROC_STATUS->Value) && !strlen($this->CURR_PROC_STATUS->Value) && $this->CURR_PROC_STATUS->Value !== false)
                    $this->CURR_PROC_STATUS->SetText(CCGetRequestParam("CURR_PROC_STATUS", ccsGet, NULL));
                if(!is_array($this->CURR_DOC_STATUS->Value) && !strlen($this->CURR_DOC_STATUS->Value) && $this->CURR_DOC_STATUS->Value !== false)
                    $this->CURR_DOC_STATUS->SetText(CCGetRequestParam("CURR_DOC_STATUS", ccsGet, NULL));
                if(!is_array($this->MESSAGE->Value) && !strlen($this->MESSAGE->Value) && $this->MESSAGE->Value !== false)
                    $this->MESSAGE->SetText(CCGetRequestParam("MESSAGE", ccsGet, NULL));
                if(!is_array($this->IS_VIEW_ONLY->Value) && !strlen($this->IS_VIEW_ONLY->Value) && $this->IS_VIEW_ONLY->Value !== false)
                    $this->IS_VIEW_ONLY->SetText(CCGetRequestParam("IS_VIEW_ONLY", ccsGet, NULL));
                if(!is_array($this->JENIS->Value) && !strlen($this->JENIS->Value) && $this->JENIS->Value !== false)
                    $this->JENIS->SetText(CCGetRequestParam("JENIS", ccsGet, NULL));
                if(!is_array($this->SUBMITTER_ID->Value) && !strlen($this->SUBMITTER_ID->Value) && $this->SUBMITTER_ID->Value !== false)
                    $this->SUBMITTER_ID->SetText(-99999);
            }
            if(!is_array($this->lusername->Value) && !strlen($this->lusername->Value) && $this->lusername->Value !== false)
                $this->lusername->SetText(CCGetUserLogin());
        }
    }
//End Class_Initialize Event

//Initialize Method @82-D171E9F2
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["postV_SUBMITTERSUBMITTER_ID"] = CCGetFromPost("V_SUBMITTERSUBMITTER_ID", NULL);
    }
//End Initialize Method

//Validate Method @82-8242BAFD
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->SUBMIT_DATE->Validate() && $Validation);
        $Validation = ($this->INTERACTIVE_MESSAGE->Validate() && $Validation);
        $Validation = ($this->SENT_MESSAGE->Validate() && $Validation);
        $Validation = ($this->ERROR_MESSAGE->Validate() && $Validation);
        $Validation = ($this->WARNING->Validate() && $Validation);
        $Validation = ($this->CURR_DOC_ID->Validate() && $Validation);
        $Validation = ($this->CURR_DOC_TYPE_ID->Validate() && $Validation);
        $Validation = ($this->CURR_PROC_ID->Validate() && $Validation);
        $Validation = ($this->CURR_CTL_ID->Validate() && $Validation);
        $Validation = ($this->PREV_DOC_ID->Validate() && $Validation);
        $Validation = ($this->PREV_DOC_TYPE_ID->Validate() && $Validation);
        $Validation = ($this->PREV_PROC_ID->Validate() && $Validation);
        $Validation = ($this->PREV_CTL_ID->Validate() && $Validation);
        $Validation = ($this->SLOT_1->Validate() && $Validation);
        $Validation = ($this->SLOT_2->Validate() && $Validation);
        $Validation = ($this->SLOT_3->Validate() && $Validation);
        $Validation = ($this->SLOT_4->Validate() && $Validation);
        $Validation = ($this->SLOT_5->Validate() && $Validation);
        $Validation = ($this->USER_ID_DOC->Validate() && $Validation);
        $Validation = ($this->USER_ID_DONOR->Validate() && $Validation);
        $Validation = ($this->USER_ID_LOGIN->Validate() && $Validation);
        $Validation = ($this->USER_ID_TAKEN->Validate() && $Validation);
        $Validation = ($this->IS_CREATE_DOC->Validate() && $Validation);
        $Validation = ($this->IS_MANUAL->Validate() && $Validation);
        $Validation = ($this->CURR_PROC_STATUS->Validate() && $Validation);
        $Validation = ($this->CURR_DOC_STATUS->Validate() && $Validation);
        $Validation = ($this->MESSAGE->Validate() && $Validation);
        $Validation = ($this->IS_VIEW_ONLY->Validate() && $Validation);
        $Validation = ($this->JENIS->Validate() && $Validation);
        $Validation = ($this->RETURN_MESSAGE->Validate() && $Validation);
        $Validation = ($this->SUBMITTER_ID->Validate() && $Validation);
        $Validation = ($this->STS->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->SUBMIT_DATE->Errors->Count() == 0);
        $Validation =  $Validation && ($this->INTERACTIVE_MESSAGE->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SENT_MESSAGE->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ERROR_MESSAGE->Errors->Count() == 0);
        $Validation =  $Validation && ($this->WARNING->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_DOC_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_DOC_TYPE_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_PROC_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_CTL_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PREV_DOC_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PREV_DOC_TYPE_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PREV_PROC_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PREV_CTL_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->USER_ID_DOC->Errors->Count() == 0);
        $Validation =  $Validation && ($this->USER_ID_DONOR->Errors->Count() == 0);
        $Validation =  $Validation && ($this->USER_ID_LOGIN->Errors->Count() == 0);
        $Validation =  $Validation && ($this->USER_ID_TAKEN->Errors->Count() == 0);
        $Validation =  $Validation && ($this->IS_CREATE_DOC->Errors->Count() == 0);
        $Validation =  $Validation && ($this->IS_MANUAL->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_PROC_STATUS->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_DOC_STATUS->Errors->Count() == 0);
        $Validation =  $Validation && ($this->MESSAGE->Errors->Count() == 0);
        $Validation =  $Validation && ($this->IS_VIEW_ONLY->Errors->Count() == 0);
        $Validation =  $Validation && ($this->JENIS->Errors->Count() == 0);
        $Validation =  $Validation && ($this->RETURN_MESSAGE->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SUBMITTER_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->STS->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @82-5D551D6B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->SUBMIT_DATE->Errors->Count());
        $errors = ($errors || $this->INTERACTIVE_MESSAGE->Errors->Count());
        $errors = ($errors || $this->SENT_MESSAGE->Errors->Count());
        $errors = ($errors || $this->ERROR_MESSAGE->Errors->Count());
        $errors = ($errors || $this->WARNING->Errors->Count());
        $errors = ($errors || $this->CURR_DOC_ID->Errors->Count());
        $errors = ($errors || $this->CURR_DOC_TYPE_ID->Errors->Count());
        $errors = ($errors || $this->CURR_PROC_ID->Errors->Count());
        $errors = ($errors || $this->CURR_CTL_ID->Errors->Count());
        $errors = ($errors || $this->PREV_DOC_ID->Errors->Count());
        $errors = ($errors || $this->PREV_DOC_TYPE_ID->Errors->Count());
        $errors = ($errors || $this->PREV_PROC_ID->Errors->Count());
        $errors = ($errors || $this->PREV_CTL_ID->Errors->Count());
        $errors = ($errors || $this->SLOT_1->Errors->Count());
        $errors = ($errors || $this->SLOT_2->Errors->Count());
        $errors = ($errors || $this->SLOT_3->Errors->Count());
        $errors = ($errors || $this->SLOT_4->Errors->Count());
        $errors = ($errors || $this->SLOT_5->Errors->Count());
        $errors = ($errors || $this->USER_ID_DOC->Errors->Count());
        $errors = ($errors || $this->USER_ID_DONOR->Errors->Count());
        $errors = ($errors || $this->USER_ID_LOGIN->Errors->Count());
        $errors = ($errors || $this->USER_ID_TAKEN->Errors->Count());
        $errors = ($errors || $this->IS_CREATE_DOC->Errors->Count());
        $errors = ($errors || $this->IS_MANUAL->Errors->Count());
        $errors = ($errors || $this->CURR_PROC_STATUS->Errors->Count());
        $errors = ($errors || $this->CURR_DOC_STATUS->Errors->Count());
        $errors = ($errors || $this->MESSAGE->Errors->Count());
        $errors = ($errors || $this->IS_VIEW_ONLY->Errors->Count());
        $errors = ($errors || $this->JENIS->Errors->Count());
        $errors = ($errors || $this->RETURN_MESSAGE->Errors->Count());
        $errors = ($errors || $this->lusername->Errors->Count());
        $errors = ($errors || $this->SUBMITTER_ID->Errors->Count());
        $errors = ($errors || $this->NTASK->Errors->Count());
        $errors = ($errors || $this->STS->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @82-ED598703
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

//Operation Method @82-D3FC08BE
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
            $this->PressedButton = "Button_Update";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Reject->Pressed) {
                $this->PressedButton = "Button_Reject";
            } else if($this->Button_Back->Pressed) {
                $this->PressedButton = "Button_Back";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Reject") {
                if(!CCGetEvent($this->Button_Reject->CCSEvents, "OnClick", $this->Button_Reject)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Back") {
                if(!CCGetEvent($this->Button_Back->CCSEvents, "OnClick", $this->Button_Back)) {
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

//Show Method @82-90D74B61
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

        $this->STS->Prepare();

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
                    $this->SUBMIT_DATE->SetValue($this->DataSource->SUBMIT_DATE->GetValue());
                    $this->SENT_MESSAGE->SetValue($this->DataSource->SENT_MESSAGE->GetValue());
                    $this->ERROR_MESSAGE->SetValue($this->DataSource->ERROR_MESSAGE->GetValue());
                    $this->WARNING->SetValue($this->DataSource->WARNING->GetValue());
                    $this->RETURN_MESSAGE->SetValue($this->DataSource->RETURN_MESSAGE->GetValue());
                    $this->SUBMITTER_ID->SetValue($this->DataSource->SUBMITTER_ID->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->SUBMIT_DATE->Errors->ToString());
            $Error = ComposeStrings($Error, $this->INTERACTIVE_MESSAGE->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SENT_MESSAGE->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ERROR_MESSAGE->Errors->ToString());
            $Error = ComposeStrings($Error, $this->WARNING->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_DOC_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_DOC_TYPE_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_PROC_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_CTL_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PREV_DOC_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PREV_DOC_TYPE_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PREV_PROC_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PREV_CTL_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->USER_ID_DOC->Errors->ToString());
            $Error = ComposeStrings($Error, $this->USER_ID_DONOR->Errors->ToString());
            $Error = ComposeStrings($Error, $this->USER_ID_LOGIN->Errors->ToString());
            $Error = ComposeStrings($Error, $this->USER_ID_TAKEN->Errors->ToString());
            $Error = ComposeStrings($Error, $this->IS_CREATE_DOC->Errors->ToString());
            $Error = ComposeStrings($Error, $this->IS_MANUAL->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_PROC_STATUS->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_DOC_STATUS->Errors->ToString());
            $Error = ComposeStrings($Error, $this->MESSAGE->Errors->ToString());
            $Error = ComposeStrings($Error, $this->IS_VIEW_ONLY->Errors->ToString());
            $Error = ComposeStrings($Error, $this->JENIS->Errors->ToString());
            $Error = ComposeStrings($Error, $this->RETURN_MESSAGE->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lusername->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SUBMITTER_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->NTASK->Errors->ToString());
            $Error = ComposeStrings($Error, $this->STS->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->SUBMIT_DATE->Show();
        $this->INTERACTIVE_MESSAGE->Show();
        $this->SENT_MESSAGE->Show();
        $this->ERROR_MESSAGE->Show();
        $this->WARNING->Show();
        $this->CURR_DOC_ID->Show();
        $this->CURR_DOC_TYPE_ID->Show();
        $this->CURR_PROC_ID->Show();
        $this->CURR_CTL_ID->Show();
        $this->PREV_DOC_ID->Show();
        $this->PREV_DOC_TYPE_ID->Show();
        $this->PREV_PROC_ID->Show();
        $this->PREV_CTL_ID->Show();
        $this->SLOT_1->Show();
        $this->SLOT_2->Show();
        $this->SLOT_3->Show();
        $this->SLOT_4->Show();
        $this->SLOT_5->Show();
        $this->USER_ID_DOC->Show();
        $this->USER_ID_DONOR->Show();
        $this->USER_ID_LOGIN->Show();
        $this->USER_ID_TAKEN->Show();
        $this->IS_CREATE_DOC->Show();
        $this->IS_MANUAL->Show();
        $this->CURR_PROC_STATUS->Show();
        $this->CURR_DOC_STATUS->Show();
        $this->MESSAGE->Show();
        $this->IS_VIEW_ONLY->Show();
        $this->JENIS->Show();
        $this->RETURN_MESSAGE->Show();
        $this->lusername->Show();
        $this->SUBMITTER_ID->Show();
        $this->NTASK->Show();
        $this->STS->Show();
        $this->Button_Reject->Show();
        $this->Button_Back->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End V_SUBMITTER Class @82-FCB6E20C

class clsV_SUBMITTERDataSource extends clsDBConnSIKP {  //V_SUBMITTERDataSource Class @82-7D9B5972

//DataSource Variables @82-F5A66C79
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $SUBMIT_DATE;
    var $INTERACTIVE_MESSAGE;
    var $SENT_MESSAGE;
    var $ERROR_MESSAGE;
    var $WARNING;
    var $CURR_DOC_ID;
    var $CURR_DOC_TYPE_ID;
    var $CURR_PROC_ID;
    var $CURR_CTL_ID;
    var $PREV_DOC_ID;
    var $PREV_DOC_TYPE_ID;
    var $PREV_PROC_ID;
    var $PREV_CTL_ID;
    var $SLOT_1;
    var $SLOT_2;
    var $SLOT_3;
    var $SLOT_4;
    var $SLOT_5;
    var $USER_ID_DOC;
    var $USER_ID_DONOR;
    var $USER_ID_LOGIN;
    var $USER_ID_TAKEN;
    var $IS_CREATE_DOC;
    var $IS_MANUAL;
    var $CURR_PROC_STATUS;
    var $CURR_DOC_STATUS;
    var $MESSAGE;
    var $IS_VIEW_ONLY;
    var $JENIS;
    var $RETURN_MESSAGE;
    var $lusername;
    var $SUBMITTER_ID;
    var $NTASK;
    var $STS;
//End DataSource Variables

//DataSourceClass_Initialize Event @82-58357424
    function clsV_SUBMITTERDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record V_SUBMITTER/Error";
        $this->Initialize();
        $this->SUBMIT_DATE = new clsField("SUBMIT_DATE", ccsText, "");
        
        $this->INTERACTIVE_MESSAGE = new clsField("INTERACTIVE_MESSAGE", ccsText, "");
        
        $this->SENT_MESSAGE = new clsField("SENT_MESSAGE", ccsText, "");
        
        $this->ERROR_MESSAGE = new clsField("ERROR_MESSAGE", ccsText, "");
        
        $this->WARNING = new clsField("WARNING", ccsText, "");
        
        $this->CURR_DOC_ID = new clsField("CURR_DOC_ID", ccsFloat, "");
        
        $this->CURR_DOC_TYPE_ID = new clsField("CURR_DOC_TYPE_ID", ccsFloat, "");
        
        $this->CURR_PROC_ID = new clsField("CURR_PROC_ID", ccsFloat, "");
        
        $this->CURR_CTL_ID = new clsField("CURR_CTL_ID", ccsFloat, "");
        
        $this->PREV_DOC_ID = new clsField("PREV_DOC_ID", ccsFloat, "");
        
        $this->PREV_DOC_TYPE_ID = new clsField("PREV_DOC_TYPE_ID", ccsFloat, "");
        
        $this->PREV_PROC_ID = new clsField("PREV_PROC_ID", ccsFloat, "");
        
        $this->PREV_CTL_ID = new clsField("PREV_CTL_ID", ccsFloat, "");
        
        $this->SLOT_1 = new clsField("SLOT_1", ccsText, "");
        
        $this->SLOT_2 = new clsField("SLOT_2", ccsText, "");
        
        $this->SLOT_3 = new clsField("SLOT_3", ccsText, "");
        
        $this->SLOT_4 = new clsField("SLOT_4", ccsText, "");
        
        $this->SLOT_5 = new clsField("SLOT_5", ccsText, "");
        
        $this->USER_ID_DOC = new clsField("USER_ID_DOC", ccsFloat, "");
        
        $this->USER_ID_DONOR = new clsField("USER_ID_DONOR", ccsFloat, "");
        
        $this->USER_ID_LOGIN = new clsField("USER_ID_LOGIN", ccsFloat, "");
        
        $this->USER_ID_TAKEN = new clsField("USER_ID_TAKEN", ccsFloat, "");
        
        $this->IS_CREATE_DOC = new clsField("IS_CREATE_DOC", ccsText, "");
        
        $this->IS_MANUAL = new clsField("IS_MANUAL", ccsText, "");
        
        $this->CURR_PROC_STATUS = new clsField("CURR_PROC_STATUS", ccsText, "");
        
        $this->CURR_DOC_STATUS = new clsField("CURR_DOC_STATUS", ccsText, "");
        
        $this->MESSAGE = new clsField("MESSAGE", ccsText, "");
        
        $this->IS_VIEW_ONLY = new clsField("IS_VIEW_ONLY", ccsText, "");
        
        $this->JENIS = new clsField("JENIS", ccsText, "");
        
        $this->RETURN_MESSAGE = new clsField("RETURN_MESSAGE", ccsText, "");
        
        $this->lusername = new clsField("lusername", ccsText, "");
        
        $this->SUBMITTER_ID = new clsField("SUBMITTER_ID", ccsFloat, "");
        
        $this->NTASK = new clsField("NTASK", ccsText, "");
        
        $this->STS = new clsField("STS", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @82-ABA4442B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "postV_SUBMITTERSUBMITTER_ID", ccsFloat, "", "", $this->Parameters["postV_SUBMITTERSUBMITTER_ID"], -99999, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "submitter_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @82-2DFBCDA8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM submitter {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @82-8412B7D8
    function SetValues()
    {
        $this->SUBMIT_DATE->SetDBValue($this->f("submit_date"));
        $this->SENT_MESSAGE->SetDBValue($this->f("error_message"));
        $this->ERROR_MESSAGE->SetDBValue($this->f("error_message"));
        $this->WARNING->SetDBValue($this->f("warning"));
        $this->RETURN_MESSAGE->SetDBValue($this->f("return_message"));
        $this->SUBMITTER_ID->SetDBValue(trim($this->f("submitter_id")));
    }
//End SetValues Method

} //End V_SUBMITTERDataSource Class @82-FCB6E20C

//Initialize Page @1-0CF10E45
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
$TemplateFileName = "lov_submitter_start.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-16894604
include_once("./lov_submitter_start_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C5F81933
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$V_SUBMITTER = & new clsRecordV_SUBMITTER("", $MainPage);
$MainPage->V_SUBMITTER = & $V_SUBMITTER;
$V_SUBMITTER->Initialize();

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

//Execute Components @1-4CBF8722
$V_SUBMITTER->Operation();
//End Execute Components

//Go to destination page @1-EF900971
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($V_SUBMITTER);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-593ADF78
$V_SUBMITTER->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-FE7D6AE4
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($V_SUBMITTER);
unset($Tpl);
//End Unload Page


?>
