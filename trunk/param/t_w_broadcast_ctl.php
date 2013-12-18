<?php
//Include Common Files @1-07BFB3AD
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "t_w_broadcast_ctl.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridpengumumanGrid { //pengumumanGrid class @3-90C12FB3

//Variables @3-AC1EDBB9

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

//Class_Initialize Event @3-F54FEF24
    function clsGridpengumumanGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "pengumumanGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid pengumumanGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspengumumanGridDataSource($this);
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
        $this->DLink->Page = "t_w_broadcast_ctl.php";
        $this->t_w_broadcast_ctl_id = & new clsControl(ccsHidden, "t_w_broadcast_ctl_id", "t_w_broadcast_ctl_id", ccsFloat, "", CCGetRequestParam("t_w_broadcast_ctl_id", ccsGet, NULL), $this);
        $this->user_name_entry = & new clsControl(ccsLabel, "user_name_entry", "user_name_entry", ccsText, "", CCGetRequestParam("user_name_entry", ccsGet, NULL), $this);
        $this->is_private_code = & new clsControl(ccsLabel, "is_private_code", "is_private_code", ccsText, "", CCGetRequestParam("is_private_code", ccsGet, NULL), $this);
        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "t_w_broadcast_ctl.php";
    }
//End Class_Initialize Event

//Initialize Method @3-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @3-B1ED4E9C
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

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
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["t_w_broadcast_ctl_id"] = $this->t_w_broadcast_ctl_id->Visible;
            $this->ControlsVisible["user_name_entry"] = $this->user_name_entry->Visible;
            $this->ControlsVisible["is_private_code"] = $this->is_private_code->Visible;
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_w_broadcast_ctl_id", $this->DataSource->f("t_w_broadcast_ctl_id"));
                $this->t_w_broadcast_ctl_id->SetValue($this->DataSource->t_w_broadcast_ctl_id->GetValue());
                $this->user_name_entry->SetValue($this->DataSource->user_name_entry->GetValue());
                $this->is_private_code->SetValue($this->DataSource->is_private_code->GetValue());
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->t_w_broadcast_ctl_id->Show();
                $this->user_name_entry->Show();
                $this->is_private_code->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("t_w_broadcast_ctl_id", "s_keyword", "ccsForm"));
        $this->Insert_Link->Parameters = CCAddParam($this->Insert_Link->Parameters, "FLAG", "ADD");
        $this->Navigator->Show();
        $this->Insert_Link->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @3-3CC56596
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_w_broadcast_ctl_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->user_name_entry->Errors->ToString());
        $errors = ComposeStrings($errors, $this->is_private_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End pengumumanGrid Class @3-FCB6E20C

class clspengumumanGridDataSource extends clsDBConnSIKP {  //pengumumanGridDataSource Class @3-78513765

//DataSource Variables @3-3FB2BDAF
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $t_w_broadcast_ctl_id;
    var $user_name_entry;
    var $is_private_code;
    var $valid_from;
    var $valid_to;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-2F56DCFC
    function clspengumumanGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid pengumumanGrid";
        $this->Initialize();
        $this->t_w_broadcast_ctl_id = new clsField("t_w_broadcast_ctl_id", ccsFloat, "");
        
        $this->user_name_entry = new clsField("user_name_entry", ccsText, "");
        
        $this->is_private_code = new clsField("is_private_code", ccsText, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @3-952EF632
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "t_w_broadcast_ctl_id desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @3-25AA94A2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
    }
//End Prepare Method

//Open Method @3-F37C984E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select t_w_broadcast_ctl_id, to_char(valid_from, 'DD-MON-YYYY') as valid_from, \n" .
        "to_char(valid_to, 'DD-MON-YYYY') as valid_to, user_name_entry, p_organ_input_id, is_private, decode(is_private,'Y','YA','TIDAK')is_private_code, p_organ_regional_id \n" .
        "from t_w_broadcast_ctl\n" .
        "where upper(user_name_entry) like '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') cnt";
        $this->SQL = "select t_w_broadcast_ctl_id, to_char(valid_from, 'DD-MON-YYYY') as valid_from, \n" .
        "to_char(valid_to, 'DD-MON-YYYY') as valid_to, user_name_entry, p_organ_input_id, is_private, decode(is_private,'Y','YA','TIDAK')is_private_code, p_organ_regional_id \n" .
        "from t_w_broadcast_ctl\n" .
        "where upper(user_name_entry) like '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'  {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-B528CA8B
    function SetValues()
    {
        $this->t_w_broadcast_ctl_id->SetDBValue(trim($this->f("t_w_broadcast_ctl_id")));
        $this->user_name_entry->SetDBValue($this->f("user_name_entry"));
        $this->is_private_code->SetDBValue($this->f("is_private_code"));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
    }
//End SetValues Method

} //End pengumumanGridDataSource Class @3-FCB6E20C

class clsRecordpengumumanForm { //pengumumanForm Class @24-C2AA627D

//Variables @24-D6FF3E86

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

//Class_Initialize Event @24-A63CC046
    function clsRecordpengumumanForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record pengumumanForm/Error";
        $this->DataSource = new clspengumumanFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "pengumumanForm";
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
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->p_organ_input_id = & new clsControl(ccsHidden, "p_organ_input_id", "p_organ_input_id", ccsFloat, "", CCGetRequestParam("p_organ_input_id", $Method, NULL), $this);
            $this->p_organ_regional_id = & new clsControl(ccsHidden, "p_organ_regional_id", "p_organ_regional_id", ccsFloat, "", CCGetRequestParam("p_organ_regional_id", $Method, NULL), $this);
            $this->valid_from = & new clsControl(ccsTextBox, "valid_from", "Valid From", ccsText, "", CCGetRequestParam("valid_from", $Method, NULL), $this);
            $this->valid_from->Required = true;
            $this->DatePicker_valid_from = & new clsDatePicker("DatePicker_valid_from", "pengumumanForm", "valid_from", $this);
            $this->valid_to = & new clsControl(ccsTextBox, "valid_to", "Valid To", ccsText, "", CCGetRequestParam("valid_to", $Method, NULL), $this);
            $this->valid_to->Required = true;
            $this->DatePicker_valid_to = & new clsDatePicker("DatePicker_valid_to", "pengumumanForm", "valid_to", $this);
            $this->user_name_entry = & new clsControl(ccsTextBox, "user_name_entry", "Nama User", ccsText, "", CCGetRequestParam("user_name_entry", $Method, NULL), $this);
            $this->user_name_entry->Required = true;
            $this->is_private = & new clsControl(ccsListBox, "is_private", "Publikasikan?", ccsText, "", CCGetRequestParam("is_private", $Method, NULL), $this);
            $this->is_private->DSType = dsListOfValues;
            $this->is_private->Values = array(array("Y", "YA"), array("N", "TIDAK"));
            $this->is_private->Required = true;
            $this->postcast = & new clsControl(ccsTextArea, "postcast", "Postcast", ccsText, "", CCGetRequestParam("postcast", $Method, NULL), $this);
            $this->postcast->Required = true;
            $this->t_w_broadcast_ctl_id = & new clsControl(ccsHidden, "t_w_broadcast_ctl_id", "t_w_broadcast_ctl_id", ccsFloat, "", CCGetRequestParam("t_w_broadcast_ctl_id", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->user_name_entry->Value) && !strlen($this->user_name_entry->Value) && $this->user_name_entry->Value !== false)
                    $this->user_name_entry->SetText(CCGetUserLogin());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @24-60303D0A
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_w_broadcast_ctl_id"] = CCGetFromGet("t_w_broadcast_ctl_id", NULL);
    }
//End Initialize Method

//Validate Method @24-DA1685B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_organ_input_id->Validate() && $Validation);
        $Validation = ($this->p_organ_regional_id->Validate() && $Validation);
        $Validation = ($this->valid_from->Validate() && $Validation);
        $Validation = ($this->valid_to->Validate() && $Validation);
        $Validation = ($this->user_name_entry->Validate() && $Validation);
        $Validation = ($this->is_private->Validate() && $Validation);
        $Validation = ($this->postcast->Validate() && $Validation);
        $Validation = ($this->t_w_broadcast_ctl_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_organ_input_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_organ_regional_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_from->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_to->Errors->Count() == 0);
        $Validation =  $Validation && ($this->user_name_entry->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_private->Errors->Count() == 0);
        $Validation =  $Validation && ($this->postcast->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_w_broadcast_ctl_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @24-1D7360C7
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_organ_input_id->Errors->Count());
        $errors = ($errors || $this->p_organ_regional_id->Errors->Count());
        $errors = ($errors || $this->valid_from->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_from->Errors->Count());
        $errors = ($errors || $this->valid_to->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_to->Errors->Count());
        $errors = ($errors || $this->user_name_entry->Errors->Count());
        $errors = ($errors || $this->is_private->Errors->Count());
        $errors = ($errors || $this->postcast->Errors->Count());
        $errors = ($errors || $this->t_w_broadcast_ctl_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @24-ED598703
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

//Operation Method @24-C2926A35
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
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_w_broadcast_ctl_id", "s_keyword", "pengumumanGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_w_broadcast_ctl_id", "s_keyword", "pengumumanGridPage"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
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

//InsertRow Method @24-B89E5B4B
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->user_name_entry->SetValue($this->user_name_entry->GetValue(true));
        $this->DataSource->valid_from->SetValue($this->valid_from->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->is_private->SetValue($this->is_private->GetValue(true));
        $this->DataSource->postcast->SetValue($this->postcast->GetValue(true));
        $this->DataSource->p_organ_regional_id->SetValue($this->p_organ_regional_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @24-986D970D
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->user_name_entry->SetValue($this->user_name_entry->GetValue(true));
        $this->DataSource->valid_from->SetValue($this->valid_from->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->is_private->SetValue($this->is_private->GetValue(true));
        $this->DataSource->postcast->SetValue($this->postcast->GetValue(true));
        $this->DataSource->p_organ_regional_id->SetValue($this->p_organ_regional_id->GetValue(true));
        $this->DataSource->t_w_broadcast_ctl_id->SetValue($this->t_w_broadcast_ctl_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @24-34B870B9
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_w_broadcast_ctl_id->SetValue($this->t_w_broadcast_ctl_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @24-C29177DF
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

        $this->is_private->Prepare();

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
                    $this->p_organ_input_id->SetValue($this->DataSource->p_organ_input_id->GetValue());
                    $this->p_organ_regional_id->SetValue($this->DataSource->p_organ_regional_id->GetValue());
                    $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                    $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                    $this->user_name_entry->SetValue($this->DataSource->user_name_entry->GetValue());
                    $this->is_private->SetValue($this->DataSource->is_private->GetValue());
                    $this->postcast->SetValue($this->DataSource->postcast->GetValue());
                    $this->t_w_broadcast_ctl_id->SetValue($this->DataSource->t_w_broadcast_ctl_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_organ_input_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_organ_regional_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valid_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valid_to->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_to->Errors->ToString());
            $Error = ComposeStrings($Error, $this->user_name_entry->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_private->Errors->ToString());
            $Error = ComposeStrings($Error, $this->postcast->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_w_broadcast_ctl_id->Errors->ToString());
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
        $this->Button_Cancel->Show();
        $this->p_organ_input_id->Show();
        $this->p_organ_regional_id->Show();
        $this->valid_from->Show();
        $this->DatePicker_valid_from->Show();
        $this->valid_to->Show();
        $this->DatePicker_valid_to->Show();
        $this->user_name_entry->Show();
        $this->is_private->Show();
        $this->postcast->Show();
        $this->t_w_broadcast_ctl_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End pengumumanForm Class @24-FCB6E20C

class clspengumumanFormDataSource extends clsDBConnSIKP {  //pengumumanFormDataSource Class @24-2766A191

//DataSource Variables @24-00367B4F
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $p_organ_input_id;
    var $p_organ_regional_id;
    var $valid_from;
    var $valid_to;
    var $user_name_entry;
    var $is_private;
    var $postcast;
    var $t_w_broadcast_ctl_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @24-38CAA20A
    function clspengumumanFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record pengumumanForm/Error";
        $this->Initialize();
        $this->p_organ_input_id = new clsField("p_organ_input_id", ccsFloat, "");
        
        $this->p_organ_regional_id = new clsField("p_organ_regional_id", ccsFloat, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        
        $this->user_name_entry = new clsField("user_name_entry", ccsText, "");
        
        $this->is_private = new clsField("is_private", ccsText, "");
        
        $this->postcast = new clsField("postcast", ccsText, "");
        
        $this->t_w_broadcast_ctl_id = new clsField("t_w_broadcast_ctl_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @24-1F90E456
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_w_broadcast_ctl_id", ccsFloat, "", "", $this->Parameters["urlt_w_broadcast_ctl_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @24-6A308E85
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select t_w_broadcast_ctl_id, to_char(valid_from, 'DD-MON-YYYY') as valid_from, \n" .
        "to_char(valid_to, 'DD-MON-YYYY') as valid_to, user_name_entry, p_organ_input_id, is_private, decode(is_private,'Y','YA','TIDAK')is_private_code, \n" .
        "p_organ_regional_id, postcast\n" .
        "from t_w_broadcast_ctl\n" .
        "where t_w_broadcast_ctl_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @24-FDF57875
    function SetValues()
    {
        $this->p_organ_input_id->SetDBValue(trim($this->f("p_organ_input_id")));
        $this->p_organ_regional_id->SetDBValue(trim($this->f("p_organ_regional_id")));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
        $this->user_name_entry->SetDBValue($this->f("user_name_entry"));
        $this->is_private->SetDBValue($this->f("is_private"));
        $this->postcast->SetDBValue($this->f("postcast"));
        $this->t_w_broadcast_ctl_id->SetDBValue(trim($this->f("t_w_broadcast_ctl_id")));
    }
//End SetValues Method

//Insert Method @24-7331DFA9
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["user_name_entry"] = new clsSQLParameter("ctrluser_name_entry", ccsText, "", "", $this->user_name_entry->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_from"] = new clsSQLParameter("ctrlvalid_from", ccsText, "", "", $this->valid_from->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_private"] = new clsSQLParameter("ctrlis_private", ccsText, "", "", $this->is_private->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["postcast"] = new clsSQLParameter("ctrlpostcast", ccsText, "", "", $this->postcast->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_organ_input_id"] = new clsSQLParameter("expr152", ccsFloat, "", "", CCGetUserId(), -99, false, $this->ErrorBlock);
        $this->cp["p_organ_regional_id"] = new clsSQLParameter("ctrlp_organ_regional_id", ccsFloat, "", "", $this->p_organ_regional_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["user_name_entry"]->GetValue()) and !strlen($this->cp["user_name_entry"]->GetText()) and !is_bool($this->cp["user_name_entry"]->GetValue())) 
            $this->cp["user_name_entry"]->SetValue($this->user_name_entry->GetValue(true));
        if (!is_null($this->cp["valid_from"]->GetValue()) and !strlen($this->cp["valid_from"]->GetText()) and !is_bool($this->cp["valid_from"]->GetValue())) 
            $this->cp["valid_from"]->SetValue($this->valid_from->GetValue(true));
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        if (!is_null($this->cp["is_private"]->GetValue()) and !strlen($this->cp["is_private"]->GetText()) and !is_bool($this->cp["is_private"]->GetValue())) 
            $this->cp["is_private"]->SetValue($this->is_private->GetValue(true));
        if (!is_null($this->cp["postcast"]->GetValue()) and !strlen($this->cp["postcast"]->GetText()) and !is_bool($this->cp["postcast"]->GetValue())) 
            $this->cp["postcast"]->SetValue($this->postcast->GetValue(true));
        if (!is_null($this->cp["p_organ_input_id"]->GetValue()) and !strlen($this->cp["p_organ_input_id"]->GetText()) and !is_bool($this->cp["p_organ_input_id"]->GetValue())) 
            $this->cp["p_organ_input_id"]->SetValue(CCGetUserId());
        if (!strlen($this->cp["p_organ_input_id"]->GetText()) and !is_bool($this->cp["p_organ_input_id"]->GetValue(true))) 
            $this->cp["p_organ_input_id"]->SetText(-99);
        if (!is_null($this->cp["p_organ_regional_id"]->GetValue()) and !strlen($this->cp["p_organ_regional_id"]->GetText()) and !is_bool($this->cp["p_organ_regional_id"]->GetValue())) 
            $this->cp["p_organ_regional_id"]->SetValue($this->p_organ_regional_id->GetValue(true));
        if (!strlen($this->cp["p_organ_regional_id"]->GetText()) and !is_bool($this->cp["p_organ_regional_id"]->GetValue(true))) 
            $this->cp["p_organ_regional_id"]->SetText(0);
        $this->SQL = "INSERT INTO t_w_broadcast_ctl(t_w_broadcast_ctl_id, \n" .
        "user_name_entry, \n" .
        "valid_from,\n" .
        "valid_to, \n" .
        "is_private, \n" .
        "postcast, \n" .
        "p_organ_input_id,\n" .
        "p_organ_regional_id) \n" .
        "VALUES(generate_id('sikp','t_w_broadcast_ctl','t_w_broadcast_ctl_id'), \n" .
        "'" . $this->SQLValue($this->cp["user_name_entry"]->GetDBValue(), ccsText) . "', \n" .
        "to_date('" . $this->SQLValue($this->cp["valid_from"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'), \n" .
        "to_date('" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'),\n" .
        "'" . $this->SQLValue($this->cp["is_private"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["postcast"]->GetDBValue(), ccsText) . "', \n" .
        "" . $this->SQLValue($this->cp["p_organ_input_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["p_organ_regional_id"]->GetDBValue(), ccsFloat) . ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @24-64DC5D04
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["user_name_entry"] = new clsSQLParameter("ctrluser_name_entry", ccsText, "", "", $this->user_name_entry->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_from"] = new clsSQLParameter("ctrlvalid_from", ccsText, "", "", $this->valid_from->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_private"] = new clsSQLParameter("ctrlis_private", ccsText, "", "", $this->is_private->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["postcast"] = new clsSQLParameter("ctrlpostcast", ccsText, "", "", $this->postcast->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_organ_input_id"] = new clsSQLParameter("expr166", ccsText, "", "", CCGetUserId(), -99, false, $this->ErrorBlock);
        $this->cp["p_organ_regional_id"] = new clsSQLParameter("ctrlp_organ_regional_id", ccsFloat, "", "", $this->p_organ_regional_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["t_w_broadcast_ctl_id"] = new clsSQLParameter("ctrlt_w_broadcast_ctl_id", ccsFloat, "", "", $this->t_w_broadcast_ctl_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["user_name_entry"]->GetValue()) and !strlen($this->cp["user_name_entry"]->GetText()) and !is_bool($this->cp["user_name_entry"]->GetValue())) 
            $this->cp["user_name_entry"]->SetValue($this->user_name_entry->GetValue(true));
        if (!is_null($this->cp["valid_from"]->GetValue()) and !strlen($this->cp["valid_from"]->GetText()) and !is_bool($this->cp["valid_from"]->GetValue())) 
            $this->cp["valid_from"]->SetValue($this->valid_from->GetValue(true));
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        if (!is_null($this->cp["is_private"]->GetValue()) and !strlen($this->cp["is_private"]->GetText()) and !is_bool($this->cp["is_private"]->GetValue())) 
            $this->cp["is_private"]->SetValue($this->is_private->GetValue(true));
        if (!is_null($this->cp["postcast"]->GetValue()) and !strlen($this->cp["postcast"]->GetText()) and !is_bool($this->cp["postcast"]->GetValue())) 
            $this->cp["postcast"]->SetValue($this->postcast->GetValue(true));
        if (!is_null($this->cp["p_organ_input_id"]->GetValue()) and !strlen($this->cp["p_organ_input_id"]->GetText()) and !is_bool($this->cp["p_organ_input_id"]->GetValue())) 
            $this->cp["p_organ_input_id"]->SetValue(CCGetUserId());
        if (!strlen($this->cp["p_organ_input_id"]->GetText()) and !is_bool($this->cp["p_organ_input_id"]->GetValue(true))) 
            $this->cp["p_organ_input_id"]->SetText(-99);
        if (!is_null($this->cp["p_organ_regional_id"]->GetValue()) and !strlen($this->cp["p_organ_regional_id"]->GetText()) and !is_bool($this->cp["p_organ_regional_id"]->GetValue())) 
            $this->cp["p_organ_regional_id"]->SetValue($this->p_organ_regional_id->GetValue(true));
        if (!strlen($this->cp["p_organ_regional_id"]->GetText()) and !is_bool($this->cp["p_organ_regional_id"]->GetValue(true))) 
            $this->cp["p_organ_regional_id"]->SetText(0);
        if (!is_null($this->cp["t_w_broadcast_ctl_id"]->GetValue()) and !strlen($this->cp["t_w_broadcast_ctl_id"]->GetText()) and !is_bool($this->cp["t_w_broadcast_ctl_id"]->GetValue())) 
            $this->cp["t_w_broadcast_ctl_id"]->SetValue($this->t_w_broadcast_ctl_id->GetValue(true));
        if (!strlen($this->cp["t_w_broadcast_ctl_id"]->GetText()) and !is_bool($this->cp["t_w_broadcast_ctl_id"]->GetValue(true))) 
            $this->cp["t_w_broadcast_ctl_id"]->SetText(0);
        $this->SQL = "UPDATE t_w_broadcast_ctl SET \n" .
        "user_name_entry='" . $this->SQLValue($this->cp["user_name_entry"]->GetDBValue(), ccsText) . "', \n" .
        "valid_from=to_date('" . $this->SQLValue($this->cp["valid_from"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'), \n" .
        "valid_to=to_date('" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'), \n" .
        "is_private='" . $this->SQLValue($this->cp["is_private"]->GetDBValue(), ccsText) . "', \n" .
        "postcast='" . $this->SQLValue($this->cp["postcast"]->GetDBValue(), ccsText) . "', \n" .
        "p_organ_input_id=" . $this->SQLValue($this->cp["p_organ_input_id"]->GetDBValue(), ccsText) . ", \n" .
        "p_organ_regional_id = " . $this->SQLValue($this->cp["p_organ_regional_id"]->GetDBValue(), ccsFloat) . "\n" .
        "WHERE t_w_broadcast_ctl_id = " . $this->SQLValue($this->cp["t_w_broadcast_ctl_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @24-E8057B26
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_w_broadcast_ctl_id"] = new clsSQLParameter("ctrlt_w_broadcast_ctl_id", ccsFloat, "", "", $this->t_w_broadcast_ctl_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_w_broadcast_ctl_id"]->GetValue()) and !strlen($this->cp["t_w_broadcast_ctl_id"]->GetText()) and !is_bool($this->cp["t_w_broadcast_ctl_id"]->GetValue())) 
            $this->cp["t_w_broadcast_ctl_id"]->SetValue($this->t_w_broadcast_ctl_id->GetValue(true));
        if (!strlen($this->cp["t_w_broadcast_ctl_id"]->GetText()) and !is_bool($this->cp["t_w_broadcast_ctl_id"]->GetValue(true))) 
            $this->cp["t_w_broadcast_ctl_id"]->SetText(0);
        $this->SQL = "DELETE FROM t_w_broadcast_ctl\n" .
        "WHERE t_w_broadcast_ctl_id = " . $this->SQLValue($this->cp["t_w_broadcast_ctl_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End pengumumanFormDataSource Class @24-FCB6E20C

class clsRecordpengumumanSearch { //pengumumanSearch Class @100-BB7556DD

//Variables @100-D6FF3E86

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

//Class_Initialize Event @100-153E6B3F
    function clsRecordpengumumanSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record pengumumanSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "pengumumanSearch";
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
        }
    }
//End Class_Initialize Event

//Validate Method @100-A144A629
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

//CheckErrors Method @100-D6729123
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @100-ED598703
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

//Operation Method @100-D2CF3BC7
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
        $Redirect = "t_w_broadcast_ctl.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_w_broadcast_ctl.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @100-9830B7FB
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

        $this->Button_DoSearch->Show();
        $this->s_keyword->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End pengumumanSearch Class @100-FCB6E20C

//Initialize Page @1-4B72A9F4
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
$TemplateFileName = "t_w_broadcast_ctl.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-AA0CC88F
include_once("./t_w_broadcast_ctl_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-51286C17
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$pengumumanGrid = & new clsGridpengumumanGrid("", $MainPage);
$pengumumanForm = & new clsRecordpengumumanForm("", $MainPage);
$pengumumanSearch = & new clsRecordpengumumanSearch("", $MainPage);
$MainPage->pengumumanGrid = & $pengumumanGrid;
$MainPage->pengumumanForm = & $pengumumanForm;
$MainPage->pengumumanSearch = & $pengumumanSearch;
$pengumumanGrid->Initialize();
$pengumumanForm->Initialize();

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

//Execute Components @1-FFFC7B5E
$pengumumanForm->Operation();
$pengumumanSearch->Operation();
//End Execute Components

//Go to destination page @1-CC40F4D7
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($pengumumanGrid);
    unset($pengumumanForm);
    unset($pengumumanSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E1565C50
$pengumumanGrid->Show();
$pengumumanForm->Show();
$pengumumanSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-72484AA6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($pengumumanGrid);
unset($pengumumanForm);
unset($pengumumanSearch);
unset($Tpl);
//End Unload Page


?>
