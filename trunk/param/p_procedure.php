<?php
//Include Common Files @1-4171B7A5
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_procedure.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_procedureGrid { //p_procedureGrid class @2-EE60CA19

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

//Class_Initialize Event @2-0F22911E
    function clsGridp_procedureGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_procedureGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_procedureGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_procedureGridDataSource($this);
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
        $this->DLink->Page = "p_procedure.php";
        $this->proc_name = & new clsControl(ccsLabel, "proc_name", "proc_name", ccsText, "", CCGetRequestParam("proc_name", ccsGet, NULL), $this);
        $this->is_active = & new clsControl(ccsLabel, "is_active", "is_active", ccsText, "", CCGetRequestParam("is_active", ccsGet, NULL), $this);
        $this->display_name = & new clsControl(ccsLabel, "display_name", "display_name", ccsText, "", CCGetRequestParam("display_name", ccsGet, NULL), $this);
        $this->p_procedure_id = & new clsControl(ccsHidden, "p_procedure_id", "p_procedure_id", ccsFloat, "", CCGetRequestParam("p_procedure_id", ccsGet, NULL), $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "p_procedure_files.php";
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_procedure.php";
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

//Show Method @2-F8ADD432
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
            $this->ControlsVisible["proc_name"] = $this->proc_name->Visible;
            $this->ControlsVisible["is_active"] = $this->is_active->Visible;
            $this->ControlsVisible["display_name"] = $this->display_name->Visible;
            $this->ControlsVisible["p_procedure_id"] = $this->p_procedure_id->Visible;
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_procedure_id", $this->DataSource->f("p_procedure_id"));
                $this->proc_name->SetValue($this->DataSource->proc_name->GetValue());
                $this->is_active->SetValue($this->DataSource->is_active->GetValue());
                $this->display_name->SetValue($this->DataSource->display_name->GetValue());
                $this->p_procedure_id->SetValue($this->DataSource->p_procedure_id->GetValue());
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("s_keyword", "ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "p_procedure_id", $this->DataSource->f("p_procedure_id"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "proc_code", $this->DataSource->f("display_name"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "p_procedureGridPage", CCGetFromGet("p_procedureGridPage", NULL));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "proc_s_keyword", CCGetFromGet("s_keyword", NULL));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->proc_name->Show();
                $this->is_active->Show();
                $this->display_name->Show();
                $this->p_procedure_id->Show();
                $this->ImageLink1->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_procedure_id", "s_keyword", "ccsForm"));
        $this->Insert_Link->Parameters = CCAddParam($this->Insert_Link->Parameters, "FLAG", "ADD");
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Insert_Link->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-91AA3A45
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->proc_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->is_active->Errors->ToString());
        $errors = ComposeStrings($errors, $this->display_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_procedure_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_procedureGrid Class @2-FCB6E20C

class clsp_procedureGridDataSource extends clsDBConnSIKP {  //p_procedureGridDataSource Class @2-791B207E

//DataSource Variables @2-0C7CE9F3
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $proc_name;
    var $is_active;
    var $display_name;
    var $p_procedure_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-FFE49086
    function clsp_procedureGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_procedureGrid";
        $this->Initialize();
        $this->proc_name = new clsField("proc_name", ccsText, "");
        
        $this->is_active = new clsField("is_active", ccsText, "");
        
        $this->display_name = new clsField("display_name", ccsText, "");
        
        $this->p_procedure_id = new clsField("p_procedure_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-85B264EA
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_procedure_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-09F879AC
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "upper(proc_name)", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "upper(display_name)", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opOR(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-3FFD76A1
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM p_procedure";
        $this->SQL = "SELECT p_procedure_id, proc_name, display_name, seqno, f_after, f_before, description, decode(is_active,'Y','YA','TIDAK') AS is_active,\n\n" .
        "updated_date, updated_by, created_by, creation_date \n\n" .
        "FROM p_procedure {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-0433C5DD
    function SetValues()
    {
        $this->proc_name->SetDBValue($this->f("proc_name"));
        $this->is_active->SetDBValue($this->f("is_active"));
        $this->display_name->SetDBValue($this->f("display_name"));
        $this->p_procedure_id->SetDBValue(trim($this->f("p_procedure_id")));
    }
//End SetValues Method

} //End p_procedureGridDataSource Class @2-FCB6E20C

class clsRecordp_procedureSearch { //p_procedureSearch Class @3-BBCA53BF

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

//Class_Initialize Event @3-85354CF8
    function clsRecordp_procedureSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_procedureSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_procedureSearch";
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

//Operation Method @3-1477E609
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
        $Redirect = "p_procedure.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_procedure.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-9830B7FB
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

} //End p_procedureSearch Class @3-FCB6E20C

class clsRecordp_procedureForm { //p_procedureForm Class @94-17A9744E

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

//Class_Initialize Event @94-930599AD
    function clsRecordp_procedureForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_procedureForm/Error";
        $this->DataSource = new clsp_procedureFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_procedureForm";
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
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->p_procedureGridPage = & new clsControl(ccsHidden, "p_procedureGridPage", "p_procedureGridPage", ccsText, "", CCGetRequestParam("p_procedureGridPage", $Method, NULL), $this);
            $this->proc_name = & new clsControl(ccsTextBox, "proc_name", "Pekerjaan", ccsText, "", CCGetRequestParam("proc_name", $Method, NULL), $this);
            $this->proc_name->Required = true;
            $this->display_name = & new clsControl(ccsTextBox, "display_name", "Nama Pekerjaan", ccsText, "", CCGetRequestParam("display_name", $Method, NULL), $this);
            $this->display_name->Required = true;
            $this->f_before = & new clsControl(ccsTextBox, "f_before", "Fungsi Sebelum Submit", ccsText, "", CCGetRequestParam("f_before", $Method, NULL), $this);
            $this->f_after = & new clsControl(ccsTextBox, "f_after", "Fungsi Setelah Submit", ccsText, "", CCGetRequestParam("f_after", $Method, NULL), $this);
            $this->description = & new clsControl(ccsTextBox, "description", "Deskripsi", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->is_active = & new clsControl(ccsListBox, "is_active", "Diaktifkan ?", ccsText, "", CCGetRequestParam("is_active", $Method, NULL), $this);
            $this->is_active->DSType = dsListOfValues;
            $this->is_active->Values = array(array("Y", "YA"), array("N", "TIDAK"));
            $this->is_active->Required = true;
            $this->p_procedure_id = & new clsControl(ccsHidden, "p_procedure_id", "p_procedure_id", ccsFloat, "", CCGetRequestParam("p_procedure_id", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->created_by->Required = true;
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->creation_date->Required = true;
            $this->seqno = & new clsControl(ccsTextBox, "seqno", "Nomor Urut Pekerjaan", ccsFloat, "", CCGetRequestParam("seqno", $Method, NULL), $this);
            $this->seqno->Required = true;
            if(!$this->FormSubmitted) {
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-26E51B1D
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_procedure_id"] = CCGetFromGet("p_procedure_id", NULL);
    }
//End Initialize Method

//Validate Method @94-FF9DB349
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->p_procedureGridPage->Validate() && $Validation);
        $Validation = ($this->proc_name->Validate() && $Validation);
        $Validation = ($this->display_name->Validate() && $Validation);
        $Validation = ($this->f_before->Validate() && $Validation);
        $Validation = ($this->f_after->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->is_active->Validate() && $Validation);
        $Validation = ($this->p_procedure_id->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->seqno->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_procedureGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->proc_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->display_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->f_before->Errors->Count() == 0);
        $Validation =  $Validation && ($this->f_after->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_active->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_procedure_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->seqno->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-B746A9D6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->p_procedureGridPage->Errors->Count());
        $errors = ($errors || $this->proc_name->Errors->Count());
        $errors = ($errors || $this->display_name->Errors->Count());
        $errors = ($errors || $this->f_before->Errors->Count());
        $errors = ($errors || $this->f_after->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->is_active->Errors->Count());
        $errors = ($errors || $this->p_procedure_id->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->seqno->Errors->Count());
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

//Operation Method @94-467B8A63
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_procedure_id", "s_keyword", "p_procedureGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_procedure_id", "s_keyword", "p_procedureGridPage"));
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

//InsertRow Method @94-1999B285
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->proc_name->SetValue($this->proc_name->GetValue(true));
        $this->DataSource->display_name->SetValue($this->display_name->GetValue(true));
        $this->DataSource->f_before->SetValue($this->f_before->GetValue(true));
        $this->DataSource->f_after->SetValue($this->f_after->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->is_active->SetValue($this->is_active->GetValue(true));
        $this->DataSource->seqno->SetValue($this->seqno->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-9A73AB13
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->proc_name->SetValue($this->proc_name->GetValue(true));
        $this->DataSource->display_name->SetValue($this->display_name->GetValue(true));
        $this->DataSource->f_before->SetValue($this->f_before->GetValue(true));
        $this->DataSource->f_after->SetValue($this->f_after->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->is_active->SetValue($this->is_active->GetValue(true));
        $this->DataSource->p_procedure_id->SetValue($this->p_procedure_id->GetValue(true));
        $this->DataSource->seqno->SetValue($this->seqno->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-BC838DC6
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_procedure_id->SetValue($this->p_procedure_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-E7251CD2
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

        $this->is_active->Prepare();

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
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->proc_name->SetValue($this->DataSource->proc_name->GetValue());
                    $this->display_name->SetValue($this->DataSource->display_name->GetValue());
                    $this->f_before->SetValue($this->DataSource->f_before->GetValue());
                    $this->f_after->SetValue($this->DataSource->f_after->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->is_active->SetValue($this->DataSource->is_active->GetValue());
                    $this->p_procedure_id->SetValue($this->DataSource->p_procedure_id->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->seqno->SetValue($this->DataSource->seqno->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_procedureGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->proc_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->display_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->f_before->Errors->ToString());
            $Error = ComposeStrings($Error, $this->f_after->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_active->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_procedure_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->seqno->Errors->ToString());
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
        $this->updated_by->Show();
        $this->p_procedureGridPage->Show();
        $this->proc_name->Show();
        $this->display_name->Show();
        $this->f_before->Show();
        $this->f_after->Show();
        $this->description->Show();
        $this->is_active->Show();
        $this->p_procedure_id->Show();
        $this->updated_date->Show();
        $this->created_by->Show();
        $this->creation_date->Show();
        $this->seqno->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_procedureForm Class @94-FCB6E20C

class clsp_procedureFormDataSource extends clsDBConnSIKP {  //p_procedureFormDataSource Class @94-262CB68A

//DataSource Variables @94-FF2064E1
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
    var $updated_by;
    var $p_procedureGridPage;
    var $proc_name;
    var $display_name;
    var $f_before;
    var $f_after;
    var $description;
    var $is_active;
    var $p_procedure_id;
    var $updated_date;
    var $created_by;
    var $creation_date;
    var $seqno;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-9C218768
    function clsp_procedureFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_procedureForm/Error";
        $this->Initialize();
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->p_procedureGridPage = new clsField("p_procedureGridPage", ccsText, "");
        
        $this->proc_name = new clsField("proc_name", ccsText, "");
        
        $this->display_name = new clsField("display_name", ccsText, "");
        
        $this->f_before = new clsField("f_before", ccsText, "");
        
        $this->f_after = new clsField("f_after", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->is_active = new clsField("is_active", ccsText, "");
        
        $this->p_procedure_id = new clsField("p_procedure_id", ccsFloat, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->seqno = new clsField("seqno", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-AE29749A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_procedure_id", ccsFloat, "", "", $this->Parameters["urlp_procedure_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-53AFD06B
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT p_procedure_id, proc_name, display_name, seqno, f_after, f_before, description, is_active, \n" .
        "to_char(updated_date,'DD-MON-YYY')as updated_date, updated_by, created_by, to_char(creation_date,'DD-MON-YYYY')as creation_date \n" .
        "FROM p_procedure\n" .
        "WHERE p_procedure_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-F3C8149C
    function SetValues()
    {
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->proc_name->SetDBValue($this->f("proc_name"));
        $this->display_name->SetDBValue($this->f("display_name"));
        $this->f_before->SetDBValue($this->f("f_before"));
        $this->f_after->SetDBValue($this->f("f_after"));
        $this->description->SetDBValue($this->f("description"));
        $this->is_active->SetDBValue($this->f("is_active"));
        $this->p_procedure_id->SetDBValue(trim($this->f("p_procedure_id")));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->seqno->SetDBValue(trim($this->f("seqno")));
    }
//End SetValues Method

//Insert Method @94-F570DCF6
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["updated_by"] = new clsSQLParameter("expr631", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["proc_name"] = new clsSQLParameter("ctrlproc_name", ccsText, "", "", $this->proc_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["display_name"] = new clsSQLParameter("ctrldisplay_name", ccsText, "", "", $this->display_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["f_before"] = new clsSQLParameter("ctrlf_before", ccsText, "", "", $this->f_before->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["f_after"] = new clsSQLParameter("ctrlf_after", ccsText, "", "", $this->f_after->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_active"] = new clsSQLParameter("ctrlis_active", ccsText, "", "", $this->is_active->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr640", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["seqno"] = new clsSQLParameter("ctrlseqno", ccsFloat, "", "", $this->seqno->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["proc_name"]->GetValue()) and !strlen($this->cp["proc_name"]->GetText()) and !is_bool($this->cp["proc_name"]->GetValue())) 
            $this->cp["proc_name"]->SetValue($this->proc_name->GetValue(true));
        if (!is_null($this->cp["display_name"]->GetValue()) and !strlen($this->cp["display_name"]->GetText()) and !is_bool($this->cp["display_name"]->GetValue())) 
            $this->cp["display_name"]->SetValue($this->display_name->GetValue(true));
        if (!is_null($this->cp["f_before"]->GetValue()) and !strlen($this->cp["f_before"]->GetText()) and !is_bool($this->cp["f_before"]->GetValue())) 
            $this->cp["f_before"]->SetValue($this->f_before->GetValue(true));
        if (!is_null($this->cp["f_after"]->GetValue()) and !strlen($this->cp["f_after"]->GetText()) and !is_bool($this->cp["f_after"]->GetValue())) 
            $this->cp["f_after"]->SetValue($this->f_after->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["is_active"]->GetValue()) and !strlen($this->cp["is_active"]->GetText()) and !is_bool($this->cp["is_active"]->GetValue())) 
            $this->cp["is_active"]->SetValue($this->is_active->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["seqno"]->GetValue()) and !strlen($this->cp["seqno"]->GetText()) and !is_bool($this->cp["seqno"]->GetValue())) 
            $this->cp["seqno"]->SetValue($this->seqno->GetValue(true));
        if (!strlen($this->cp["seqno"]->GetText()) and !is_bool($this->cp["seqno"]->GetValue(true))) 
            $this->cp["seqno"]->SetText(0);
        $this->SQL = "INSERT INTO p_procedure(p_procedure_id, updated_by, proc_name, display_name, f_before, f_after, description, is_active, updated_date, created_by, creation_date, seqno) \n" .
        "VALUES(generate_id('sikp','p_procedure','p_procedure_id'), '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["proc_name"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["display_name"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["f_before"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["f_after"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["is_active"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', sysdate, " . $this->SQLValue($this->cp["seqno"]->GetDBValue(), ccsFloat) . ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-6A562688
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["updated_by"] = new clsSQLParameter("expr655", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["proc_name"] = new clsSQLParameter("ctrlproc_name", ccsText, "", "", $this->proc_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["display_name"] = new clsSQLParameter("ctrldisplay_name", ccsText, "", "", $this->display_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["f_before"] = new clsSQLParameter("ctrlf_before", ccsText, "", "", $this->f_before->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["f_after"] = new clsSQLParameter("ctrlf_after", ccsText, "", "", $this->f_after->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_active"] = new clsSQLParameter("ctrlis_active", ccsText, "", "", $this->is_active->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_procedure_id"] = new clsSQLParameter("ctrlp_procedure_id", ccsFloat, "", "", $this->p_procedure_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["seqno"] = new clsSQLParameter("ctrlseqno", ccsFloat, "", "", $this->seqno->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["proc_name"]->GetValue()) and !strlen($this->cp["proc_name"]->GetText()) and !is_bool($this->cp["proc_name"]->GetValue())) 
            $this->cp["proc_name"]->SetValue($this->proc_name->GetValue(true));
        if (!is_null($this->cp["display_name"]->GetValue()) and !strlen($this->cp["display_name"]->GetText()) and !is_bool($this->cp["display_name"]->GetValue())) 
            $this->cp["display_name"]->SetValue($this->display_name->GetValue(true));
        if (!is_null($this->cp["f_before"]->GetValue()) and !strlen($this->cp["f_before"]->GetText()) and !is_bool($this->cp["f_before"]->GetValue())) 
            $this->cp["f_before"]->SetValue($this->f_before->GetValue(true));
        if (!is_null($this->cp["f_after"]->GetValue()) and !strlen($this->cp["f_after"]->GetText()) and !is_bool($this->cp["f_after"]->GetValue())) 
            $this->cp["f_after"]->SetValue($this->f_after->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["is_active"]->GetValue()) and !strlen($this->cp["is_active"]->GetText()) and !is_bool($this->cp["is_active"]->GetValue())) 
            $this->cp["is_active"]->SetValue($this->is_active->GetValue(true));
        if (!is_null($this->cp["p_procedure_id"]->GetValue()) and !strlen($this->cp["p_procedure_id"]->GetText()) and !is_bool($this->cp["p_procedure_id"]->GetValue())) 
            $this->cp["p_procedure_id"]->SetValue($this->p_procedure_id->GetValue(true));
        if (!strlen($this->cp["p_procedure_id"]->GetText()) and !is_bool($this->cp["p_procedure_id"]->GetValue(true))) 
            $this->cp["p_procedure_id"]->SetText(0);
        if (!is_null($this->cp["seqno"]->GetValue()) and !strlen($this->cp["seqno"]->GetText()) and !is_bool($this->cp["seqno"]->GetValue())) 
            $this->cp["seqno"]->SetValue($this->seqno->GetValue(true));
        if (!strlen($this->cp["seqno"]->GetText()) and !is_bool($this->cp["seqno"]->GetValue(true))) 
            $this->cp["seqno"]->SetText(0);
        $this->SQL = "UPDATE p_procedure SET \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "proc_name='" . $this->SQLValue($this->cp["proc_name"]->GetDBValue(), ccsText) . "', \n" .
        "display_name='" . $this->SQLValue($this->cp["display_name"]->GetDBValue(), ccsText) . "', \n" .
        "f_before='" . $this->SQLValue($this->cp["f_before"]->GetDBValue(), ccsText) . "', \n" .
        "f_after='" . $this->SQLValue($this->cp["f_after"]->GetDBValue(), ccsText) . "', \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "is_active='" . $this->SQLValue($this->cp["is_active"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate,  \n" .
        "seqno=" . $this->SQLValue($this->cp["seqno"]->GetDBValue(), ccsFloat) . "\n" .
        "WHERE p_procedure_id = " . $this->SQLValue($this->cp["p_procedure_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-A9A6282F
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_procedure_id"] = new clsSQLParameter("ctrlp_procedure_id", ccsFloat, "", "", $this->p_procedure_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_procedure_id"]->GetValue()) and !strlen($this->cp["p_procedure_id"]->GetText()) and !is_bool($this->cp["p_procedure_id"]->GetValue())) 
            $this->cp["p_procedure_id"]->SetValue($this->p_procedure_id->GetValue(true));
        if (!strlen($this->cp["p_procedure_id"]->GetText()) and !is_bool($this->cp["p_procedure_id"]->GetValue(true))) 
            $this->cp["p_procedure_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_procedure \n" .
        "WHERE  p_procedure_id = " . $this->SQLValue($this->cp["p_procedure_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_procedureFormDataSource Class @94-FCB6E20C

//Initialize Page @1-2F756885
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
$TemplateFileName = "p_procedure.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-0A64C8CD
include_once("./p_procedure_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-3D2C01E9
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_procedureGrid = & new clsGridp_procedureGrid("", $MainPage);
$p_procedureSearch = & new clsRecordp_procedureSearch("", $MainPage);
$p_procedureForm = & new clsRecordp_procedureForm("", $MainPage);
$MainPage->p_procedureGrid = & $p_procedureGrid;
$MainPage->p_procedureSearch = & $p_procedureSearch;
$MainPage->p_procedureForm = & $p_procedureForm;
$p_procedureGrid->Initialize();
$p_procedureForm->Initialize();

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

//Execute Components @1-5F0B40DB
$p_procedureSearch->Operation();
$p_procedureForm->Operation();
//End Execute Components

//Go to destination page @1-0BCD5338
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_procedureGrid);
    unset($p_procedureSearch);
    unset($p_procedureForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-400186CB
$p_procedureGrid->Show();
$p_procedureSearch->Show();
$p_procedureForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-81B04318
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_procedureGrid);
unset($p_procedureSearch);
unset($p_procedureForm);
unset($Tpl);
//End Unload Page


?>
