<?php
//Include Common Files @1-D15F3750
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_document_type.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_document_typeGrid { //p_document_typeGrid class @2-00362E61

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

//Class_Initialize Event @2-C253444F
    function clsGridp_document_typeGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_document_typeGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_document_typeGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_document_typeGridDataSource($this);
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
        $this->DLink->Page = "p_document_type.php";
        $this->display_name = & new clsControl(ccsLabel, "display_name", "display_name", ccsText, "", CCGetRequestParam("display_name", ccsGet, NULL), $this);
        $this->p_document_type_id = & new clsControl(ccsHidden, "p_document_type_id", "p_document_type_id", ccsFloat, "", CCGetRequestParam("p_document_type_id", ccsGet, NULL), $this);
        $this->tdoc = & new clsControl(ccsLabel, "tdoc", "tdoc", ccsText, "", CCGetRequestParam("tdoc", ccsGet, NULL), $this);
        $this->tctl = & new clsControl(ccsLabel, "tctl", "tctl", ccsText, "", CCGetRequestParam("tctl", ccsGet, NULL), $this);
        $this->package_name = & new clsControl(ccsLabel, "package_name", "package_name", ccsText, "", CCGetRequestParam("package_name", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_document_type.php";
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

//Show Method @2-C47E34E5
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
            $this->ControlsVisible["display_name"] = $this->display_name->Visible;
            $this->ControlsVisible["p_document_type_id"] = $this->p_document_type_id->Visible;
            $this->ControlsVisible["tdoc"] = $this->tdoc->Visible;
            $this->ControlsVisible["tctl"] = $this->tctl->Visible;
            $this->ControlsVisible["package_name"] = $this->package_name->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_document_type_id", $this->DataSource->f("p_document_type_id"));
                $this->display_name->SetValue($this->DataSource->display_name->GetValue());
                $this->p_document_type_id->SetValue($this->DataSource->p_document_type_id->GetValue());
                $this->tdoc->SetValue($this->DataSource->tdoc->GetValue());
                $this->tctl->SetValue($this->DataSource->tctl->GetValue());
                $this->package_name->SetValue($this->DataSource->package_name->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->display_name->Show();
                $this->p_document_type_id->Show();
                $this->tdoc->Show();
                $this->tctl->Show();
                $this->package_name->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_document_type_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-5A8FE1E2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->display_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_document_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tdoc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tctl->Errors->ToString());
        $errors = ComposeStrings($errors, $this->package_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_document_typeGrid Class @2-FCB6E20C

class clsp_document_typeGridDataSource extends clsDBConnSIKP {  //p_document_typeGridDataSource Class @2-8EFD7669

//DataSource Variables @2-F73AEDD1
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $display_name;
    var $p_document_type_id;
    var $tdoc;
    var $tctl;
    var $package_name;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-E8C9AD5F
    function clsp_document_typeGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_document_typeGrid";
        $this->Initialize();
        $this->display_name = new clsField("display_name", ccsText, "");
        
        $this->p_document_type_id = new clsField("p_document_type_id", ccsFloat, "");
        
        $this->tdoc = new clsField("tdoc", ccsText, "");
        
        $this->tctl = new clsField("tctl", ccsText, "");
        
        $this->package_name = new clsField("package_name", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-D933360B
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_document_type_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-605C84C3
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "upper(document_name)", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "upper(description)", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opOR(
             true, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-7EA28D90
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM p_document_type";
        $this->SQL = "SELECT * \n\n" .
        "FROM p_document_type {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-D7DEB508
    function SetValues()
    {
        $this->display_name->SetDBValue($this->f("display_name"));
        $this->p_document_type_id->SetDBValue(trim($this->f("p_document_type_id")));
        $this->tdoc->SetDBValue($this->f("tdoc"));
        $this->tctl->SetDBValue($this->f("tctl"));
        $this->package_name->SetDBValue($this->f("package_name"));
    }
//End SetValues Method

} //End p_document_typeGridDataSource Class @2-FCB6E20C

class clsRecordp_document_typeSearch { //p_document_typeSearch Class @3-7C4742B9

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

//Class_Initialize Event @3-BFEF379D
    function clsRecordp_document_typeSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_document_typeSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_document_typeSearch";
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

//Operation Method @3-EC453551
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
        $Redirect = "p_document_type.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_document_type.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

} //End p_document_typeSearch Class @3-FCB6E20C

class clsRecordp_document_typeForm { //p_document_typeForm Class @94-ABC414B0

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

//Class_Initialize Event @94-A50DD760
    function clsRecordp_document_typeForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_document_typeForm/Error";
        $this->DataSource = new clsp_document_typeFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_document_typeForm";
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
            $this->p_document_type_id = & new clsControl(ccsHidden, "p_document_type_id", "Id", ccsFloat, "", CCGetRequestParam("p_document_type_id", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->p_document_typeGridPage = & new clsControl(ccsHidden, "p_document_typeGridPage", "p_document_typeGridPage", ccsText, "", CCGetRequestParam("p_document_typeGridPage", $Method, NULL), $this);
            $this->display_name = & new clsControl(ccsTextBox, "display_name", "Nama Dokumen Tercetak", ccsText, "", CCGetRequestParam("display_name", $Method, NULL), $this);
            $this->display_name->Required = true;
            $this->tctl = & new clsControl(ccsTextBox, "tctl", "Nama Tabel Kontrol Inbox", ccsText, "", CCGetRequestParam("tctl", $Method, NULL), $this);
            $this->tctl->Required = true;
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->created_by->Required = true;
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->creation_date->Required = true;
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->tuser = & new clsControl(ccsTextBox, "tuser", "Nama Tabel Kontrol User", ccsText, "", CCGetRequestParam("tuser", $Method, NULL), $this);
            $this->tuser->Required = true;
            $this->package_name = & new clsControl(ccsTextBox, "package_name", "Nama Package Aturan Bisnis", ccsText, "", CCGetRequestParam("package_name", $Method, NULL), $this);
            $this->package_name->Required = true;
            $this->f_profile = & new clsControl(ccsTextBox, "f_profile", "Fungsi Layout Profile Inbox", ccsText, "", CCGetRequestParam("f_profile", $Method, NULL), $this);
            $this->f_profile->Required = true;
            $this->tdoc = & new clsControl(ccsTextBox, "tdoc", "Nama Tabel Utama Dokumen", ccsText, "", CCGetRequestParam("tdoc", $Method, NULL), $this);
            $this->tdoc->Required = true;
            $this->profile_source = & new clsControl(ccsTextBox, "profile_source", "Form Summary Inbox", ccsText, "", CCGetRequestParam("profile_source", $Method, NULL), $this);
            $this->profile_source->Required = true;
            $this->f_app_fraud_engine = & new clsControl(ccsTextBox, "f_app_fraud_engine", "Fungsi Deteksi Fraud", ccsText, "", CCGetRequestParam("f_app_fraud_engine", $Method, NULL), $this);
            $this->doc_name = & new clsControl(ccsTextBox, "doc_name", "Nama Dokumen Workflow", ccsText, "", CCGetRequestParam("doc_name", $Method, NULL), $this);
            $this->doc_name->Required = true;
            $this->listing_no = & new clsControl(ccsTextBox, "listing_no", "Nomor Urut Prioritas Dokumen", ccsFloat, "", CCGetRequestParam("listing_no", $Method, NULL), $this);
            $this->listing_no->Required = true;
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

//Initialize Method @94-312DDD07
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_document_type_id"] = CCGetFromGet("p_document_type_id", NULL);
    }
//End Initialize Method

//Validate Method @94-AF606C1C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_document_type_id->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->p_document_typeGridPage->Validate() && $Validation);
        $Validation = ($this->display_name->Validate() && $Validation);
        $Validation = ($this->tctl->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->tuser->Validate() && $Validation);
        $Validation = ($this->package_name->Validate() && $Validation);
        $Validation = ($this->f_profile->Validate() && $Validation);
        $Validation = ($this->tdoc->Validate() && $Validation);
        $Validation = ($this->profile_source->Validate() && $Validation);
        $Validation = ($this->f_app_fraud_engine->Validate() && $Validation);
        $Validation = ($this->doc_name->Validate() && $Validation);
        $Validation = ($this->listing_no->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_document_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_document_typeGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->display_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tctl->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tuser->Errors->Count() == 0);
        $Validation =  $Validation && ($this->package_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->f_profile->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tdoc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->profile_source->Errors->Count() == 0);
        $Validation =  $Validation && ($this->f_app_fraud_engine->Errors->Count() == 0);
        $Validation =  $Validation && ($this->doc_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->listing_no->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-E157EB0B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_document_type_id->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->p_document_typeGridPage->Errors->Count());
        $errors = ($errors || $this->display_name->Errors->Count());
        $errors = ($errors || $this->tctl->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->tuser->Errors->Count());
        $errors = ($errors || $this->package_name->Errors->Count());
        $errors = ($errors || $this->f_profile->Errors->Count());
        $errors = ($errors || $this->tdoc->Errors->Count());
        $errors = ($errors || $this->profile_source->Errors->Count());
        $errors = ($errors || $this->f_app_fraud_engine->Errors->Count());
        $errors = ($errors || $this->doc_name->Errors->Count());
        $errors = ($errors || $this->listing_no->Errors->Count());
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

//Operation Method @94-947C161D
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_document_type_id", "s_keyword", "p_document_typeGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_document_type_id", "s_keyword", "p_document_typeGridPage"));
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

//InsertRow Method @94-8AC7D93E
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->display_name->SetValue($this->display_name->GetValue(true));
        $this->DataSource->tctl->SetValue($this->tctl->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->tuser->SetValue($this->tuser->GetValue(true));
        $this->DataSource->package_name->SetValue($this->package_name->GetValue(true));
        $this->DataSource->f_profile->SetValue($this->f_profile->GetValue(true));
        $this->DataSource->tdoc->SetValue($this->tdoc->GetValue(true));
        $this->DataSource->profile_source->SetValue($this->profile_source->GetValue(true));
        $this->DataSource->f_app_fraud_engine->SetValue($this->f_app_fraud_engine->GetValue(true));
        $this->DataSource->doc_name->SetValue($this->doc_name->GetValue(true));
        $this->DataSource->listing_no->SetValue($this->listing_no->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-34BBD0DC
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_document_type_id->SetValue($this->p_document_type_id->GetValue(true));
        $this->DataSource->display_name->SetValue($this->display_name->GetValue(true));
        $this->DataSource->tctl->SetValue($this->tctl->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->tuser->SetValue($this->tuser->GetValue(true));
        $this->DataSource->package_name->SetValue($this->package_name->GetValue(true));
        $this->DataSource->f_profile->SetValue($this->f_profile->GetValue(true));
        $this->DataSource->tdoc->SetValue($this->tdoc->GetValue(true));
        $this->DataSource->profile_source->SetValue($this->profile_source->GetValue(true));
        $this->DataSource->f_app_fraud_engine->SetValue($this->f_app_fraud_engine->GetValue(true));
        $this->DataSource->doc_name->SetValue($this->doc_name->GetValue(true));
        $this->DataSource->listing_no->SetValue($this->listing_no->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-44888B26
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_document_type_id->SetValue($this->p_document_type_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-612E08B1
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
                    $this->p_document_type_id->SetValue($this->DataSource->p_document_type_id->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->display_name->SetValue($this->DataSource->display_name->GetValue());
                    $this->tctl->SetValue($this->DataSource->tctl->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->tuser->SetValue($this->DataSource->tuser->GetValue());
                    $this->package_name->SetValue($this->DataSource->package_name->GetValue());
                    $this->f_profile->SetValue($this->DataSource->f_profile->GetValue());
                    $this->tdoc->SetValue($this->DataSource->tdoc->GetValue());
                    $this->profile_source->SetValue($this->DataSource->profile_source->GetValue());
                    $this->f_app_fraud_engine->SetValue($this->DataSource->f_app_fraud_engine->GetValue());
                    $this->doc_name->SetValue($this->DataSource->doc_name->GetValue());
                    $this->listing_no->SetValue($this->DataSource->listing_no->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_document_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_document_typeGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->display_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tctl->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tuser->Errors->ToString());
            $Error = ComposeStrings($Error, $this->package_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->f_profile->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tdoc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->profile_source->Errors->ToString());
            $Error = ComposeStrings($Error, $this->f_app_fraud_engine->Errors->ToString());
            $Error = ComposeStrings($Error, $this->doc_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->listing_no->Errors->ToString());
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
        $this->p_document_type_id->Show();
        $this->updated_by->Show();
        $this->p_document_typeGridPage->Show();
        $this->display_name->Show();
        $this->tctl->Show();
        $this->updated_date->Show();
        $this->created_by->Show();
        $this->creation_date->Show();
        $this->description->Show();
        $this->tuser->Show();
        $this->package_name->Show();
        $this->f_profile->Show();
        $this->tdoc->Show();
        $this->profile_source->Show();
        $this->f_app_fraud_engine->Show();
        $this->doc_name->Show();
        $this->listing_no->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_document_typeForm Class @94-FCB6E20C

class clsp_document_typeFormDataSource extends clsDBConnSIKP {  //p_document_typeFormDataSource Class @94-D1CAE09D

//DataSource Variables @94-C324AD17
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
    var $p_document_type_id;
    var $updated_by;
    var $p_document_typeGridPage;
    var $display_name;
    var $tctl;
    var $updated_date;
    var $created_by;
    var $creation_date;
    var $description;
    var $tuser;
    var $package_name;
    var $f_profile;
    var $tdoc;
    var $profile_source;
    var $f_app_fraud_engine;
    var $doc_name;
    var $listing_no;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-4410B0B2
    function clsp_document_typeFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_document_typeForm/Error";
        $this->Initialize();
        $this->p_document_type_id = new clsField("p_document_type_id", ccsFloat, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->p_document_typeGridPage = new clsField("p_document_typeGridPage", ccsText, "");
        
        $this->display_name = new clsField("display_name", ccsText, "");
        
        $this->tctl = new clsField("tctl", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->tuser = new clsField("tuser", ccsText, "");
        
        $this->package_name = new clsField("package_name", ccsText, "");
        
        $this->f_profile = new clsField("f_profile", ccsText, "");
        
        $this->tdoc = new clsField("tdoc", ccsText, "");
        
        $this->profile_source = new clsField("profile_source", ccsText, "");
        
        $this->f_app_fraud_engine = new clsField("f_app_fraud_engine", ccsText, "");
        
        $this->doc_name = new clsField("doc_name", ccsText, "");
        
        $this->listing_no = new clsField("listing_no", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-C6915D60
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_document_type_id", ccsFloat, "", "", $this->Parameters["urlp_document_type_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-36E31DEE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT p_document_type_id, doc_name, display_name, owner, tdoc, tctl, tuser, package_name, f_profile, profile_source, description,\n" .
        "listing_no, f_app_fraud_engine, to_char(creation_date,'DD-MON-YYYY')as creation_date, created_by,  to_char(updated_date,'DD-MON-YYYY')as updated_date, updated_by\n" .
        "FROM p_document_type\n" .
        "WHERE p_document_type_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "   ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-A5ED0067
    function SetValues()
    {
        $this->p_document_type_id->SetDBValue(trim($this->f("p_document_type_id")));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->display_name->SetDBValue($this->f("display_name"));
        $this->tctl->SetDBValue($this->f("tctl"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->description->SetDBValue($this->f("description"));
        $this->tuser->SetDBValue($this->f("tuser"));
        $this->package_name->SetDBValue($this->f("package_name"));
        $this->f_profile->SetDBValue($this->f("f_profile"));
        $this->tdoc->SetDBValue($this->f("tdoc"));
        $this->profile_source->SetDBValue($this->f("profile_source"));
        $this->f_app_fraud_engine->SetDBValue($this->f("f_app_fraud_engine"));
        $this->doc_name->SetDBValue($this->f("doc_name"));
        $this->listing_no->SetDBValue(trim($this->f("listing_no")));
    }
//End SetValues Method

//Insert Method @94-16A549B3
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["updated_by"] = new clsSQLParameter("expr652", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["display_name"] = new clsSQLParameter("ctrldisplay_name", ccsText, "", "", $this->display_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["tctl"] = new clsSQLParameter("ctrltctl", ccsText, "", "", $this->tctl->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr656", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["tuser"] = new clsSQLParameter("ctrltuser", ccsText, "", "", $this->tuser->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["package_name"] = new clsSQLParameter("ctrlpackage_name", ccsText, "", "", $this->package_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["f_profile"] = new clsSQLParameter("ctrlf_profile", ccsText, "", "", $this->f_profile->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["tdoc"] = new clsSQLParameter("ctrltdoc", ccsText, "", "", $this->tdoc->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["profile_source"] = new clsSQLParameter("ctrlprofile_source", ccsText, "", "", $this->profile_source->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["f_app_fraud_engine"] = new clsSQLParameter("ctrlf_app_fraud_engine", ccsText, "", "", $this->f_app_fraud_engine->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["doc_name"] = new clsSQLParameter("ctrldoc_name", ccsText, "", "", $this->doc_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["listing_no"] = new clsSQLParameter("ctrllisting_no", ccsFloat, "", "", $this->listing_no->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["display_name"]->GetValue()) and !strlen($this->cp["display_name"]->GetText()) and !is_bool($this->cp["display_name"]->GetValue())) 
            $this->cp["display_name"]->SetValue($this->display_name->GetValue(true));
        if (!is_null($this->cp["tctl"]->GetValue()) and !strlen($this->cp["tctl"]->GetText()) and !is_bool($this->cp["tctl"]->GetValue())) 
            $this->cp["tctl"]->SetValue($this->tctl->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["tuser"]->GetValue()) and !strlen($this->cp["tuser"]->GetText()) and !is_bool($this->cp["tuser"]->GetValue())) 
            $this->cp["tuser"]->SetValue($this->tuser->GetValue(true));
        if (!is_null($this->cp["package_name"]->GetValue()) and !strlen($this->cp["package_name"]->GetText()) and !is_bool($this->cp["package_name"]->GetValue())) 
            $this->cp["package_name"]->SetValue($this->package_name->GetValue(true));
        if (!is_null($this->cp["f_profile"]->GetValue()) and !strlen($this->cp["f_profile"]->GetText()) and !is_bool($this->cp["f_profile"]->GetValue())) 
            $this->cp["f_profile"]->SetValue($this->f_profile->GetValue(true));
        if (!is_null($this->cp["tdoc"]->GetValue()) and !strlen($this->cp["tdoc"]->GetText()) and !is_bool($this->cp["tdoc"]->GetValue())) 
            $this->cp["tdoc"]->SetValue($this->tdoc->GetValue(true));
        if (!is_null($this->cp["profile_source"]->GetValue()) and !strlen($this->cp["profile_source"]->GetText()) and !is_bool($this->cp["profile_source"]->GetValue())) 
            $this->cp["profile_source"]->SetValue($this->profile_source->GetValue(true));
        if (!is_null($this->cp["f_app_fraud_engine"]->GetValue()) and !strlen($this->cp["f_app_fraud_engine"]->GetText()) and !is_bool($this->cp["f_app_fraud_engine"]->GetValue())) 
            $this->cp["f_app_fraud_engine"]->SetValue($this->f_app_fraud_engine->GetValue(true));
        if (!is_null($this->cp["doc_name"]->GetValue()) and !strlen($this->cp["doc_name"]->GetText()) and !is_bool($this->cp["doc_name"]->GetValue())) 
            $this->cp["doc_name"]->SetValue($this->doc_name->GetValue(true));
        if (!is_null($this->cp["listing_no"]->GetValue()) and !strlen($this->cp["listing_no"]->GetText()) and !is_bool($this->cp["listing_no"]->GetValue())) 
            $this->cp["listing_no"]->SetValue($this->listing_no->GetValue(true));
        if (!strlen($this->cp["listing_no"]->GetText()) and !is_bool($this->cp["listing_no"]->GetValue(true))) 
            $this->cp["listing_no"]->SetText(0);
        $this->SQL = "INSERT INTO p_document_type(p_document_type_id, updated_by, display_name, tctl, updated_date, created_by, creation_date, description, tuser, package_name, f_profile, tdoc, profile_source, f_app_fraud_engine, doc_name, listing_no, owner) \n" .
        "VALUES(generate_id('sikp','p_document_type','p_document_type_id'), '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["display_name"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["tctl"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["tuser"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["package_name"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["f_profile"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["tdoc"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["profile_source"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["f_app_fraud_engine"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["doc_name"]->GetDBValue(), ccsText) . "', " . $this->SQLValue($this->cp["listing_no"]->GetDBValue(), ccsFloat) . ", 'SIKP')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-C82C61EC
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_document_type_id"] = new clsSQLParameter("ctrlp_document_type_id", ccsFloat, "", "", $this->p_document_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr684", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["display_name"] = new clsSQLParameter("ctrldisplay_name", ccsText, "", "", $this->display_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["tctl"] = new clsSQLParameter("ctrltctl", ccsText, "", "", $this->tctl->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["tuser"] = new clsSQLParameter("ctrltuser", ccsText, "", "", $this->tuser->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["package_name"] = new clsSQLParameter("ctrlpackage_name", ccsText, "", "", $this->package_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["f_profile"] = new clsSQLParameter("ctrlf_profile", ccsText, "", "", $this->f_profile->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["tdoc"] = new clsSQLParameter("ctrltdoc", ccsText, "", "", $this->tdoc->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["profile_source"] = new clsSQLParameter("ctrlprofile_source", ccsText, "", "", $this->profile_source->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["f_app_fraud_engine"] = new clsSQLParameter("ctrlf_app_fraud_engine", ccsText, "", "", $this->f_app_fraud_engine->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["doc_name"] = new clsSQLParameter("ctrldoc_name", ccsText, "", "", $this->doc_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["listing_no"] = new clsSQLParameter("ctrllisting_no", ccsFloat, "", "", $this->listing_no->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_document_type_id"]->GetValue()) and !strlen($this->cp["p_document_type_id"]->GetText()) and !is_bool($this->cp["p_document_type_id"]->GetValue())) 
            $this->cp["p_document_type_id"]->SetValue($this->p_document_type_id->GetValue(true));
        if (!strlen($this->cp["p_document_type_id"]->GetText()) and !is_bool($this->cp["p_document_type_id"]->GetValue(true))) 
            $this->cp["p_document_type_id"]->SetText(0);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["display_name"]->GetValue()) and !strlen($this->cp["display_name"]->GetText()) and !is_bool($this->cp["display_name"]->GetValue())) 
            $this->cp["display_name"]->SetValue($this->display_name->GetValue(true));
        if (!is_null($this->cp["tctl"]->GetValue()) and !strlen($this->cp["tctl"]->GetText()) and !is_bool($this->cp["tctl"]->GetValue())) 
            $this->cp["tctl"]->SetValue($this->tctl->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["tuser"]->GetValue()) and !strlen($this->cp["tuser"]->GetText()) and !is_bool($this->cp["tuser"]->GetValue())) 
            $this->cp["tuser"]->SetValue($this->tuser->GetValue(true));
        if (!is_null($this->cp["package_name"]->GetValue()) and !strlen($this->cp["package_name"]->GetText()) and !is_bool($this->cp["package_name"]->GetValue())) 
            $this->cp["package_name"]->SetValue($this->package_name->GetValue(true));
        if (!is_null($this->cp["f_profile"]->GetValue()) and !strlen($this->cp["f_profile"]->GetText()) and !is_bool($this->cp["f_profile"]->GetValue())) 
            $this->cp["f_profile"]->SetValue($this->f_profile->GetValue(true));
        if (!is_null($this->cp["tdoc"]->GetValue()) and !strlen($this->cp["tdoc"]->GetText()) and !is_bool($this->cp["tdoc"]->GetValue())) 
            $this->cp["tdoc"]->SetValue($this->tdoc->GetValue(true));
        if (!is_null($this->cp["profile_source"]->GetValue()) and !strlen($this->cp["profile_source"]->GetText()) and !is_bool($this->cp["profile_source"]->GetValue())) 
            $this->cp["profile_source"]->SetValue($this->profile_source->GetValue(true));
        if (!is_null($this->cp["f_app_fraud_engine"]->GetValue()) and !strlen($this->cp["f_app_fraud_engine"]->GetText()) and !is_bool($this->cp["f_app_fraud_engine"]->GetValue())) 
            $this->cp["f_app_fraud_engine"]->SetValue($this->f_app_fraud_engine->GetValue(true));
        if (!is_null($this->cp["doc_name"]->GetValue()) and !strlen($this->cp["doc_name"]->GetText()) and !is_bool($this->cp["doc_name"]->GetValue())) 
            $this->cp["doc_name"]->SetValue($this->doc_name->GetValue(true));
        if (!is_null($this->cp["listing_no"]->GetValue()) and !strlen($this->cp["listing_no"]->GetText()) and !is_bool($this->cp["listing_no"]->GetValue())) 
            $this->cp["listing_no"]->SetValue($this->listing_no->GetValue(true));
        if (!strlen($this->cp["listing_no"]->GetText()) and !is_bool($this->cp["listing_no"]->GetValue(true))) 
            $this->cp["listing_no"]->SetText(0);
        $this->SQL = "UPDATE p_document_type SET \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "display_name='" . $this->SQLValue($this->cp["display_name"]->GetDBValue(), ccsText) . "', \n" .
        "tctl='" . $this->SQLValue($this->cp["tctl"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "tuser='" . $this->SQLValue($this->cp["tuser"]->GetDBValue(), ccsText) . "', \n" .
        "package_name='" . $this->SQLValue($this->cp["package_name"]->GetDBValue(), ccsText) . "', \n" .
        "f_profile='" . $this->SQLValue($this->cp["f_profile"]->GetDBValue(), ccsText) . "', \n" .
        "tdoc='" . $this->SQLValue($this->cp["tdoc"]->GetDBValue(), ccsText) . "', \n" .
        "profile_source='" . $this->SQLValue($this->cp["profile_source"]->GetDBValue(), ccsText) . "', \n" .
        "f_app_fraud_engine='" . $this->SQLValue($this->cp["f_app_fraud_engine"]->GetDBValue(), ccsText) . "', \n" .
        "doc_name='" . $this->SQLValue($this->cp["doc_name"]->GetDBValue(), ccsText) . "', \n" .
        "listing_no=" . $this->SQLValue($this->cp["listing_no"]->GetDBValue(), ccsFloat) . "\n" .
        "WHERE p_document_type_id=" . $this->SQLValue($this->cp["p_document_type_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-8F4BD6B9
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_document_type_id"] = new clsSQLParameter("ctrlp_document_type_id", ccsFloat, "", "", $this->p_document_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_document_type_id"]->GetValue()) and !strlen($this->cp["p_document_type_id"]->GetText()) and !is_bool($this->cp["p_document_type_id"]->GetValue())) 
            $this->cp["p_document_type_id"]->SetValue($this->p_document_type_id->GetValue(true));
        if (!strlen($this->cp["p_document_type_id"]->GetText()) and !is_bool($this->cp["p_document_type_id"]->GetValue(true))) 
            $this->cp["p_document_type_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_document_type\n" .
        "WHERE  p_document_type_id = " . $this->SQLValue($this->cp["p_document_type_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_document_typeFormDataSource Class @94-FCB6E20C

//Initialize Page @1-58F137AF
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
$TemplateFileName = "p_document_type.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-882BCBFE
include_once("./p_document_type_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-8453E0B3
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_document_typeGrid = & new clsGridp_document_typeGrid("", $MainPage);
$p_document_typeSearch = & new clsRecordp_document_typeSearch("", $MainPage);
$p_document_typeForm = & new clsRecordp_document_typeForm("", $MainPage);
$MainPage->p_document_typeGrid = & $p_document_typeGrid;
$MainPage->p_document_typeSearch = & $p_document_typeSearch;
$MainPage->p_document_typeForm = & $p_document_typeForm;
$p_document_typeGrid->Initialize();
$p_document_typeForm->Initialize();

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

//Execute Components @1-C43981C5
$p_document_typeSearch->Operation();
$p_document_typeForm->Operation();
//End Execute Components

//Go to destination page @1-7ED46E73
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_document_typeGrid);
    unset($p_document_typeSearch);
    unset($p_document_typeForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-041692DC
$p_document_typeGrid->Show();
$p_document_typeSearch->Show();
$p_document_typeForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-4641AF23
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_document_typeGrid);
unset($p_document_typeSearch);
unset($p_document_typeForm);
unset($Tpl);
//End Unload Page


?>
