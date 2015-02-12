<?php
//Include Common Files @1-BB3F6B66
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_bank_branch.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_app_user_roleGrid { //p_app_user_roleGrid class @3-A4A4AE46

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

//Class_Initialize Event @3-2EADFC0E
    function clsGridp_app_user_roleGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_app_user_roleGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_app_user_roleGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_app_user_roleGridDataSource($this);
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
        $this->DLink->Page = "p_bank_branch.php";
        $this->p_bank_branch_id = & new clsControl(ccsHidden, "p_bank_branch_id", "p_bank_branch_id", ccsFloat, "", CCGetRequestParam("p_bank_branch_id", ccsGet, NULL), $this);
        $this->branch_name = & new clsControl(ccsLabel, "branch_name", "branch_name", ccsText, "", CCGetRequestParam("branch_name", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->code = & new clsControl(ccsLabel, "code", "code", ccsText, "", CCGetRequestParam("code", ccsGet, NULL), $this);
        $this->parent_code = & new clsControl(ccsLabel, "parent_code", "parent_code", ccsText, "", CCGetRequestParam("parent_code", ccsGet, NULL), $this);
        $this->maximum_user = & new clsControl(ccsLabel, "maximum_user", "maximum_user", ccsText, "", CCGetRequestParam("maximum_user", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_bank_branch.php";
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

//Show Method @3-0EF99CA8
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlp_bank_id"] = CCGetFromGet("p_bank_id", NULL);
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
            $this->ControlsVisible["p_bank_branch_id"] = $this->p_bank_branch_id->Visible;
            $this->ControlsVisible["branch_name"] = $this->branch_name->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["code"] = $this->code->Visible;
            $this->ControlsVisible["parent_code"] = $this->parent_code->Visible;
            $this->ControlsVisible["maximum_user"] = $this->maximum_user->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_bank_branch_id", $this->DataSource->f("p_bank_branch_id"));
                $this->p_bank_branch_id->SetValue($this->DataSource->p_bank_branch_id->GetValue());
                $this->branch_name->SetValue($this->DataSource->branch_name->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->code->SetValue($this->DataSource->code->GetValue());
                $this->parent_code->SetValue($this->DataSource->parent_code->GetValue());
                $this->maximum_user->SetValue($this->DataSource->maximum_user->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->p_bank_branch_id->Show();
                $this->branch_name->Show();
                $this->description->Show();
                $this->code->Show();
                $this->parent_code->Show();
                $this->maximum_user->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_app_user_role_id", "ccsForm"));
        $this->Insert_Link->Parameters = CCAddParam($this->Insert_Link->Parameters, "FLAG", "ADD");
        $this->Navigator->Show();
        $this->Insert_Link->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @3-9F38CB4F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_bank_branch_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->branch_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->parent_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->maximum_user->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_app_user_roleGrid Class @3-FCB6E20C

class clsp_app_user_roleGridDataSource extends clsDBConnSIKP {  //p_app_user_roleGridDataSource Class @3-B6311215

//DataSource Variables @3-8761961A
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $p_bank_branch_id;
    var $branch_name;
    var $description;
    var $code;
    var $parent_code;
    var $maximum_user;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-F39D3A6F
    function clsp_app_user_roleGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_app_user_roleGrid";
        $this->Initialize();
        $this->p_bank_branch_id = new clsField("p_bank_branch_id", ccsFloat, "");
        
        $this->branch_name = new clsField("branch_name", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->code = new clsField("code", ccsText, "");
        
        $this->parent_code = new clsField("parent_code", ccsText, "");
        
        $this->maximum_user = new clsField("maximum_user", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @3-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @3-1FAAF88B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_bank_id", ccsFloat, "", "", $this->Parameters["urlp_bank_id"], 0, false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
    }
//End Prepare Method

//Open Method @3-4FA239BE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT * \n" .
        "FROM p_bank_branch\n" .
        "WHERE p_bank_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "\n" .
        "AND ( upper(code) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%'\n" .
        "OR upper(branch_name) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%'\n" .
        "OR upper(description) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%' ) ) cnt";
        $this->SQL = "SELECT * \n" .
        "FROM p_bank_branch\n" .
        "WHERE p_bank_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "\n" .
        "AND ( upper(code) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%'\n" .
        "OR upper(branch_name) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%'\n" .
        "OR upper(description) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%' ) ";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-4259F1C1
    function SetValues()
    {
        $this->p_bank_branch_id->SetDBValue(trim($this->f("p_bank_branch_id")));
        $this->branch_name->SetDBValue($this->f("branch_name"));
        $this->description->SetDBValue($this->f("description"));
        $this->code->SetDBValue($this->f("code"));
        $this->parent_code->SetDBValue($this->f("parent_code"));
        $this->maximum_user->SetDBValue($this->f("maximum_user"));
    }
//End SetValues Method

} //End p_app_user_roleGridDataSource Class @3-FCB6E20C

class clsRecordp_app_user_roleForm { //p_app_user_roleForm Class @24-0F569497

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

//Class_Initialize Event @24-58FACBA2
    function clsRecordp_app_user_roleForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_app_user_roleForm/Error";
        $this->DataSource = new clsp_app_user_roleFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_app_user_roleForm";
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
            $this->p_bank_branch_id = & new clsControl(ccsHidden, "p_bank_branch_id", "p_bank_branch_id", ccsFloat, "", CCGetRequestParam("p_bank_branch_id", $Method, NULL), $this);
            $this->code = & new clsControl(ccsTextBox, "code", "Kode", ccsText, "", CCGetRequestParam("code", $Method, NULL), $this);
            $this->p_bank_id = & new clsControl(ccsHidden, "p_bank_id", "p_app_user_id", ccsFloat, "", CCGetRequestParam("p_bank_id", $Method, NULL), $this);
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->update_by = & new clsControl(ccsTextBox, "update_by", "Update By", ccsText, "", CCGetRequestParam("update_by", $Method, NULL), $this);
            $this->update_by->Required = true;
            $this->update_date = & new clsControl(ccsTextBox, "update_date", "Update Date", ccsText, "", CCGetRequestParam("update_date", $Method, NULL), $this);
            $this->update_date->Required = true;
            $this->branch_name = & new clsControl(ccsTextBox, "branch_name", "Nama Cabang", ccsText, "", CCGetRequestParam("branch_name", $Method, NULL), $this);
            $this->maximum_user = & new clsControl(ccsTextBox, "maximum_user", "Jumlah Maksimal Pengguna", ccsText, "", CCGetRequestParam("maximum_user", $Method, NULL), $this);
            $this->parent_code = & new clsControl(ccsTextBox, "parent_code", "Kode Bank", ccsText, "", CCGetRequestParam("parent_code", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->update_by->Value) && !strlen($this->update_by->Value) && $this->update_by->Value !== false)
                    $this->update_by->SetText(CCGetUserLogin());
                if(!is_array($this->update_date->Value) && !strlen($this->update_date->Value) && $this->update_date->Value !== false)
                    $this->update_date->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @24-BC00E31F
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_bank_branch_id"] = CCGetFromGet("p_bank_branch_id", NULL);
    }
//End Initialize Method

//Validate Method @24-5DC3B98C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_bank_branch_id->Validate() && $Validation);
        $Validation = ($this->code->Validate() && $Validation);
        $Validation = ($this->p_bank_id->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->update_by->Validate() && $Validation);
        $Validation = ($this->update_date->Validate() && $Validation);
        $Validation = ($this->branch_name->Validate() && $Validation);
        $Validation = ($this->maximum_user->Validate() && $Validation);
        $Validation = ($this->parent_code->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_bank_branch_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_bank_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->update_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->update_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->branch_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->maximum_user->Errors->Count() == 0);
        $Validation =  $Validation && ($this->parent_code->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @24-9B0D8469
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_bank_branch_id->Errors->Count());
        $errors = ($errors || $this->code->Errors->Count());
        $errors = ($errors || $this->p_bank_id->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->update_by->Errors->Count());
        $errors = ($errors || $this->update_date->Errors->Count());
        $errors = ($errors || $this->branch_name->Errors->Count());
        $errors = ($errors || $this->maximum_user->Errors->Count());
        $errors = ($errors || $this->parent_code->Errors->Count());
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

//Operation Method @24-3A9ADD30
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_app_user_role_id", "s_keyword", "p_app_user_roleGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_app_user_role_id", "s_keyword", "p_app_user_roleGridPage"));
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

//InsertRow Method @24-6C182A25
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->p_bank_id->SetValue($this->p_bank_id->GetValue(true));
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->parent_code->SetValue($this->parent_code->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->maximum_user->SetValue($this->maximum_user->GetValue(true));
        $this->DataSource->branch_name->SetValue($this->branch_name->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @24-02A02D3E
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->parent_code->SetValue($this->parent_code->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->maximum_user->SetValue($this->maximum_user->GetValue(true));
        $this->DataSource->p_bank_branch_id->SetValue($this->p_bank_branch_id->GetValue(true));
        $this->DataSource->branch_name->SetValue($this->branch_name->GetValue(true));
        $this->DataSource->p_app_user_role_id->SetValue($this->p_app_user_role_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @24-618EE687
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_bank_branch_id->SetValue($this->p_bank_branch_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @24-0AE78A58
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
                    $this->p_bank_branch_id->SetValue($this->DataSource->p_bank_branch_id->GetValue());
                    $this->code->SetValue($this->DataSource->code->GetValue());
                    $this->p_bank_id->SetValue($this->DataSource->p_bank_id->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->update_by->SetValue($this->DataSource->update_by->GetValue());
                    $this->update_date->SetValue($this->DataSource->update_date->GetValue());
                    $this->branch_name->SetValue($this->DataSource->branch_name->GetValue());
                    $this->maximum_user->SetValue($this->DataSource->maximum_user->GetValue());
                    $this->parent_code->SetValue($this->DataSource->parent_code->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_bank_branch_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_bank_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->update_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->update_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->branch_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->maximum_user->Errors->ToString());
            $Error = ComposeStrings($Error, $this->parent_code->Errors->ToString());
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
        $this->p_bank_branch_id->Show();
        $this->code->Show();
        $this->p_bank_id->Show();
        $this->description->Show();
        $this->update_by->Show();
        $this->update_date->Show();
        $this->branch_name->Show();
        $this->maximum_user->Show();
        $this->parent_code->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_app_user_roleForm Class @24-FCB6E20C

class clsp_app_user_roleFormDataSource extends clsDBConnSIKP {  //p_app_user_roleFormDataSource Class @24-E90684E1

//DataSource Variables @24-5A4BB63C
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
    var $p_bank_branch_id;
    var $code;
    var $p_bank_id;
    var $description;
    var $update_by;
    var $update_date;
    var $branch_name;
    var $maximum_user;
    var $parent_code;
//End DataSource Variables

//DataSourceClass_Initialize Event @24-A96C2B6B
    function clsp_app_user_roleFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_app_user_roleForm/Error";
        $this->Initialize();
        $this->p_bank_branch_id = new clsField("p_bank_branch_id", ccsFloat, "");
        
        $this->code = new clsField("code", ccsText, "");
        
        $this->p_bank_id = new clsField("p_bank_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->update_by = new clsField("update_by", ccsText, "");
        
        $this->update_date = new clsField("update_date", ccsText, "");
        
        $this->branch_name = new clsField("branch_name", ccsText, "");
        
        $this->maximum_user = new clsField("maximum_user", ccsText, "");
        
        $this->parent_code = new clsField("parent_code", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @24-70B6AD9A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_bank_branch_id", ccsFloat, "", "", $this->Parameters["urlp_bank_branch_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @24-CFD15009
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n" .
        "FROM p_bank_branch\n" .
        "WHERE p_bank_branch_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @24-E294ACBE
    function SetValues()
    {
        $this->p_bank_branch_id->SetDBValue(trim($this->f("p_bank_branch_id")));
        $this->code->SetDBValue($this->f("code"));
        $this->p_bank_id->SetDBValue(trim($this->f("p_bank_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->update_by->SetDBValue($this->f("update_by"));
        $this->update_date->SetDBValue($this->f("update_date"));
        $this->branch_name->SetDBValue($this->f("branch_name"));
        $this->maximum_user->SetDBValue($this->f("maximum_user"));
        $this->parent_code->SetDBValue($this->f("parent_code"));
    }
//End SetValues Method

//Insert Method @24-EDCABD4D
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_bank_id"] = new clsSQLParameter("ctrlp_bank_id", ccsInteger, "", "", $this->p_bank_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["parent_code"] = new clsSQLParameter("ctrlparent_code", ccsText, "", "", $this->parent_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["update_by"] = new clsSQLParameter("expr176", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["maximum_user"] = new clsSQLParameter("ctrlmaximum_user", ccsInteger, "", "", $this->maximum_user->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["branch_name"] = new clsSQLParameter("ctrlbranch_name", ccsText, "", "", $this->branch_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["p_bank_id"]->GetValue()) and !strlen($this->cp["p_bank_id"]->GetText()) and !is_bool($this->cp["p_bank_id"]->GetValue())) 
            $this->cp["p_bank_id"]->SetValue($this->p_bank_id->GetValue(true));
        if (!strlen($this->cp["p_bank_id"]->GetText()) and !is_bool($this->cp["p_bank_id"]->GetValue(true))) 
            $this->cp["p_bank_id"]->SetText(0);
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["parent_code"]->GetValue()) and !strlen($this->cp["parent_code"]->GetText()) and !is_bool($this->cp["parent_code"]->GetValue())) 
            $this->cp["parent_code"]->SetValue($this->parent_code->GetValue(true));
        if (!is_null($this->cp["update_by"]->GetValue()) and !strlen($this->cp["update_by"]->GetText()) and !is_bool($this->cp["update_by"]->GetValue())) 
            $this->cp["update_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["maximum_user"]->GetValue()) and !strlen($this->cp["maximum_user"]->GetText()) and !is_bool($this->cp["maximum_user"]->GetValue())) 
            $this->cp["maximum_user"]->SetValue($this->maximum_user->GetValue(true));
        if (!strlen($this->cp["maximum_user"]->GetText()) and !is_bool($this->cp["maximum_user"]->GetValue(true))) 
            $this->cp["maximum_user"]->SetText(0);
        if (!is_null($this->cp["branch_name"]->GetValue()) and !strlen($this->cp["branch_name"]->GetText()) and !is_bool($this->cp["branch_name"]->GetValue())) 
            $this->cp["branch_name"]->SetValue($this->branch_name->GetValue(true));
        $this->SQL = "INSERT INTO p_bank_branch(p_bank_branch_id, \n" .
        "branch_name,\n" .
        "p_bank_id, \n" .
        "code, \n" .
        "parent_code,  \n" .
        "update_by, \n" .
        "update_date, \n" .
        "description,\n" .
        "maximum_user) \n" .
        "VALUES(generate_id('sikp','p_bank_branch','p_bank_branch_id'), \n" .
        "'" . $this->SQLValue($this->cp["branch_name"]->GetDBValue(), ccsText) . "',\n" .
        "" . $this->SQLValue($this->cp["p_bank_id"]->GetDBValue(), ccsInteger) . ", \n" .
        "'" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["parent_code"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["update_by"]->GetDBValue(), ccsText) . "',  \n" .
        "sysdate,\n" .
        "'" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "" . $this->SQLValue($this->cp["maximum_user"]->GetDBValue(), ccsInteger) . ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @24-0AE8CCD2
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["parent_code"] = new clsSQLParameter("ctrlparent_code", ccsText, "", "", $this->parent_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["update_by"] = new clsSQLParameter("expr181", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["maximum_user"] = new clsSQLParameter("ctrlmaximum_user", ccsInteger, "", "", $this->maximum_user->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_bank_branch_id"] = new clsSQLParameter("ctrlp_bank_branch_id", ccsInteger, "", "", $this->p_bank_branch_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["branch_name"] = new clsSQLParameter("ctrlbranch_name", ccsText, "", "", $this->branch_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["parent_code"]->GetValue()) and !strlen($this->cp["parent_code"]->GetText()) and !is_bool($this->cp["parent_code"]->GetValue())) 
            $this->cp["parent_code"]->SetValue($this->parent_code->GetValue(true));
        if (!is_null($this->cp["update_by"]->GetValue()) and !strlen($this->cp["update_by"]->GetText()) and !is_bool($this->cp["update_by"]->GetValue())) 
            $this->cp["update_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["maximum_user"]->GetValue()) and !strlen($this->cp["maximum_user"]->GetText()) and !is_bool($this->cp["maximum_user"]->GetValue())) 
            $this->cp["maximum_user"]->SetValue($this->maximum_user->GetValue(true));
        if (!strlen($this->cp["maximum_user"]->GetText()) and !is_bool($this->cp["maximum_user"]->GetValue(true))) 
            $this->cp["maximum_user"]->SetText(0);
        if (!is_null($this->cp["p_bank_branch_id"]->GetValue()) and !strlen($this->cp["p_bank_branch_id"]->GetText()) and !is_bool($this->cp["p_bank_branch_id"]->GetValue())) 
            $this->cp["p_bank_branch_id"]->SetValue($this->p_bank_branch_id->GetValue(true));
        if (!strlen($this->cp["p_bank_branch_id"]->GetText()) and !is_bool($this->cp["p_bank_branch_id"]->GetValue(true))) 
            $this->cp["p_bank_branch_id"]->SetText(0);
        if (!is_null($this->cp["branch_name"]->GetValue()) and !strlen($this->cp["branch_name"]->GetText()) and !is_bool($this->cp["branch_name"]->GetValue())) 
            $this->cp["branch_name"]->SetValue($this->branch_name->GetValue(true));
        $this->SQL = "UPDATE p_bank_branch SET \n" .
        "branch_name = '" . $this->SQLValue($this->cp["branch_name"]->GetDBValue(), ccsText) . "',\n" .
        "code='" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "', \n" .
        "parent_code='" . $this->SQLValue($this->cp["parent_code"]->GetDBValue(), ccsText) . "',\n" .
        "update_by='{updated_by}', \n" .
        "update_date=sysdate, \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "maximum_user=" . $this->SQLValue($this->cp["maximum_user"]->GetDBValue(), ccsInteger) . "\n" .
        "WHERE  p_bank_branch_id = " . $this->SQLValue($this->cp["p_bank_branch_id"]->GetDBValue(), ccsInteger) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @24-5949A807
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_bank_branch_id"] = new clsSQLParameter("ctrlp_bank_branch_id", ccsFloat, "", "", $this->p_bank_branch_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_bank_branch_id"]->GetValue()) and !strlen($this->cp["p_bank_branch_id"]->GetText()) and !is_bool($this->cp["p_bank_branch_id"]->GetValue())) 
            $this->cp["p_bank_branch_id"]->SetValue($this->p_bank_branch_id->GetValue(true));
        if (!strlen($this->cp["p_bank_branch_id"]->GetText()) and !is_bool($this->cp["p_bank_branch_id"]->GetValue(true))) 
            $this->cp["p_bank_branch_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_bank_branch WHERE p_bank_branch_id = " . $this->SQLValue($this->cp["p_bank_branch_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_app_user_roleFormDataSource Class @24-FCB6E20C

class clsRecordp_app_user_roleSearch { //p_app_user_roleSearch Class @100-4B3AD76E

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

//Class_Initialize Event @100-DF5169D7
    function clsRecordp_app_user_roleSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_app_user_roleSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_app_user_roleSearch";
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
            $this->p_bank_id = & new clsControl(ccsHidden, "p_bank_id", "p_bank_id", ccsFloat, "", CCGetRequestParam("p_bank_id", $Method, NULL), $this);
            $this->p_app_userGridPage = & new clsControl(ccsHidden, "p_app_userGridPage", "p_app_userGridPage", ccsText, "", CCGetRequestParam("p_app_userGridPage", $Method, NULL), $this);
            $this->user_s_keyword = & new clsControl(ccsHidden, "user_s_keyword", "user_s_keyword", ccsText, "", CCGetRequestParam("user_s_keyword", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @100-84001282
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->p_bank_id->Validate() && $Validation);
        $Validation = ($this->p_app_userGridPage->Validate() && $Validation);
        $Validation = ($this->user_s_keyword->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_bank_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_app_userGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->user_s_keyword->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @100-4F236F66
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->p_bank_id->Errors->Count());
        $errors = ($errors || $this->p_app_userGridPage->Errors->Count());
        $errors = ($errors || $this->user_s_keyword->Errors->Count());
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

//Operation Method @100-213C756D
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
        $Redirect = "p_bank_branch.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_bank_branch.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @100-8F377DD5
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
            $Error = ComposeStrings($Error, $this->p_bank_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_app_userGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->user_s_keyword->Errors->ToString());
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
        $this->p_bank_id->Show();
        $this->p_app_userGridPage->Show();
        $this->user_s_keyword->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End p_app_user_roleSearch Class @100-FCB6E20C

//Initialize Page @1-3C8959FF
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
$TemplateFileName = "p_bank_branch.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-B740D77F
include_once("./p_bank_branch_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-63F04AF6
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_app_user_roleGrid = & new clsGridp_app_user_roleGrid("", $MainPage);
$p_app_user_roleForm = & new clsRecordp_app_user_roleForm("", $MainPage);
$p_app_user_roleSearch = & new clsRecordp_app_user_roleSearch("", $MainPage);
$app_user_name = & new clsControl(ccsLabel, "app_user_name", "app_user_name", ccsText, "", CCGetRequestParam("app_user_name", ccsGet, NULL), $MainPage);
$MainPage->p_app_user_roleGrid = & $p_app_user_roleGrid;
$MainPage->p_app_user_roleForm = & $p_app_user_roleForm;
$MainPage->p_app_user_roleSearch = & $p_app_user_roleSearch;
$MainPage->app_user_name = & $app_user_name;
$p_app_user_roleGrid->Initialize();
$p_app_user_roleForm->Initialize();

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

//Execute Components @1-CC668365
$p_app_user_roleForm->Operation();
$p_app_user_roleSearch->Operation();
//End Execute Components

//Go to destination page @1-124BBEE7
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_app_user_roleGrid);
    unset($p_app_user_roleForm);
    unset($p_app_user_roleSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-28801E00
$p_app_user_roleGrid->Show();
$p_app_user_roleForm->Show();
$p_app_user_roleSearch->Show();
$app_user_name->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-38312F1B
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_app_user_roleGrid);
unset($p_app_user_roleForm);
unset($p_app_user_roleSearch);
unset($Tpl);
//End Unload Page


?>
