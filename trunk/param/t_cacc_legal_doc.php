<?php
//Include Common Files @1-40F26733
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "t_cacc_legal_doc.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_cacc_legal_docGrid { //t_cacc_legal_docGrid class @2-D96D8240

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

//Class_Initialize Event @2-B1ED761D
    function clsGridt_cacc_legal_docGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_cacc_legal_docGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_cacc_legal_docGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_cacc_legal_docGridDataSource($this);
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
        $this->DLink->Page = "t_cacc_legal_doc.php";
        $this->origin_file_name = & new clsControl(ccsLink, "origin_file_name", "origin_file_name", ccsText, "", CCGetRequestParam("origin_file_name", ccsGet, NULL), $this);
        $this->origin_file_name->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->t_cacc_legal_doc_id = & new clsControl(ccsHidden, "t_cacc_legal_doc_id", "t_cacc_legal_doc_id", ccsFloat, "", CCGetRequestParam("t_cacc_legal_doc_id", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->legal_doc_desc = & new clsControl(ccsLabel, "legal_doc_desc", "legal_doc_desc", ccsText, "", CCGetRequestParam("legal_doc_desc", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "t_cacc_legal_doc.php";
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

//Show Method @2-13960208
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);

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
            $this->ControlsVisible["origin_file_name"] = $this->origin_file_name->Visible;
            $this->ControlsVisible["t_cacc_legal_doc_id"] = $this->t_cacc_legal_doc_id->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["legal_doc_desc"] = $this->legal_doc_desc->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_cacc_legal_doc_id", $this->DataSource->f("t_cacc_legal_doc_id"));
                $this->origin_file_name->SetValue($this->DataSource->origin_file_name->GetValue());
                $this->origin_file_name->Page = $this->DataSource->f("file_name");
                $this->t_cacc_legal_doc_id->SetValue($this->DataSource->t_cacc_legal_doc_id->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->legal_doc_desc->SetValue($this->DataSource->legal_doc_desc->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->origin_file_name->Show();
                $this->t_cacc_legal_doc_id->Show();
                $this->description->Show();
                $this->legal_doc_desc->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("t_cacc_legal_doc_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-E27C831E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->origin_file_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cacc_legal_doc_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->legal_doc_desc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_cacc_legal_docGrid Class @2-FCB6E20C

class clst_cacc_legal_docGridDataSource extends clsDBConnSIKP {  //t_cacc_legal_docGridDataSource Class @2-D84D24FD

//DataSource Variables @2-82E8C57F
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $origin_file_name;
    var $t_cacc_legal_doc_id;
    var $description;
    var $legal_doc_desc;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-F9118C24
    function clst_cacc_legal_docGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_cacc_legal_docGrid";
        $this->Initialize();
        $this->origin_file_name = new clsField("origin_file_name", ccsText, "");
        
        $this->t_cacc_legal_doc_id = new clsField("t_cacc_legal_doc_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->legal_doc_desc = new clsField("legal_doc_desc", ccsText, "");
        

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

//Prepare Method @2-8ADD9969
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urlt_cust_account_id", ccsFloat, "", "", $this->Parameters["urlt_cust_account_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-C422B2DC
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT * \n" .
        "FROM t_cacc_legal_doc\n" .
        "WHERE legal_doc_desc LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "AND t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . " ) cnt";
        $this->SQL = "SELECT * \n" .
        "FROM t_cacc_legal_doc\n" .
        "WHERE legal_doc_desc LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "AND t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . " ";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-5D8824FC
    function SetValues()
    {
        $this->origin_file_name->SetDBValue($this->f("origin_file_name"));
        $this->t_cacc_legal_doc_id->SetDBValue(trim($this->f("t_cacc_legal_doc_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->legal_doc_desc->SetDBValue($this->f("legal_doc_desc"));
    }
//End SetValues Method

} //End t_cacc_legal_docGridDataSource Class @2-FCB6E20C

class clsRecordt_cacc_legal_docSearch { //t_cacc_legal_docSearch Class @3-56636B68

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

//Class_Initialize Event @3-F2B9D4BF
    function clsRecordt_cacc_legal_docSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_cacc_legal_docSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_cacc_legal_docSearch";
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
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsText, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            $this->t_customer_id = & new clsControl(ccsHidden, "t_customer_id", "t_customer_id", ccsText, "", CCGetRequestParam("t_customer_id", $Method, NULL), $this);
            $this->customer_name = & new clsControl(ccsHidden, "customer_name", "customer_name", ccsText, "", CCGetRequestParam("customer_name", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-97D20803
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $Validation = ($this->t_customer_id->Validate() && $Validation);
        $Validation = ($this->customer_name->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->customer_name->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-07C547D5
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->t_customer_id->Errors->Count());
        $errors = ($errors || $this->customer_name->Errors->Count());
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

//Operation Method @3-5695267E
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
        $Redirect = "t_cacc_legal_doc.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_cacc_legal_doc.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-A5EA508A
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
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->customer_name->Errors->ToString());
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
        $this->t_cust_account_id->Show();
        $this->t_customer_id->Show();
        $this->customer_name->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_cacc_legal_docSearch Class @3-FCB6E20C

class clsRecordt_cacc_legal_docForm { //t_cacc_legal_docForm Class @94-AD55A895

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

//Class_Initialize Event @94-84782567
    function clsRecordt_cacc_legal_docForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_cacc_legal_docForm/Error";
        $this->DataSource = new clst_cacc_legal_docFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_cacc_legal_docForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "multipart/form-data";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->t_cacc_legal_doc_id = & new clsControl(ccsHidden, "t_cacc_legal_doc_id", "Id", ccsFloat, "", CCGetRequestParam("t_cacc_legal_doc_id", $Method, NULL), $this);
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->t_cacc_legal_docGridPage = & new clsControl(ccsHidden, "t_cacc_legal_docGridPage", "t_cacc_legal_docGridPage", ccsText, "", CCGetRequestParam("t_cacc_legal_docGridPage", $Method, NULL), $this);
            $this->legal_doc_desc = & new clsControl(ccsTextBox, "legal_doc_desc", "Jenis Dokumen", ccsText, "", CCGetRequestParam("legal_doc_desc", $Method, NULL), $this);
            $this->legal_doc_desc->Required = true;
            $this->p_legal_doc_type_id = & new clsControl(ccsHidden, "p_legal_doc_type_id", "p_legal_doc_type_id", ccsFloat, "", CCGetRequestParam("p_legal_doc_type_id", $Method, NULL), $this);
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            $this->file_folder = & new clsControl(ccsHidden, "file_folder", "file_folder", ccsText, "", CCGetRequestParam("file_folder", $Method, NULL), $this);
            $this->origin_file_name = & new clsControl(ccsHidden, "origin_file_name", "origin_file_name", ccsText, "", CCGetRequestParam("origin_file_name", $Method, NULL), $this);
            $this->file_name = & new clsFileUpload("file_name", "file_name", "../files_tmp/", "../files/", "*", "", 2000000, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-6919EBC3
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_cacc_legal_doc_id"] = CCGetFromGet("t_cacc_legal_doc_id", NULL);
    }
//End Initialize Method

//Validate Method @94-35D5A272
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_cacc_legal_doc_id->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->t_cacc_legal_docGridPage->Validate() && $Validation);
        $Validation = ($this->legal_doc_desc->Validate() && $Validation);
        $Validation = ($this->p_legal_doc_type_id->Validate() && $Validation);
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $Validation = ($this->file_folder->Validate() && $Validation);
        $Validation = ($this->origin_file_name->Validate() && $Validation);
        $Validation = ($this->file_name->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_cacc_legal_doc_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cacc_legal_docGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->legal_doc_desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_legal_doc_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->file_folder->Errors->Count() == 0);
        $Validation =  $Validation && ($this->origin_file_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->file_name->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-2F604173
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_cacc_legal_doc_id->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->t_cacc_legal_docGridPage->Errors->Count());
        $errors = ($errors || $this->legal_doc_desc->Errors->Count());
        $errors = ($errors || $this->p_legal_doc_type_id->Errors->Count());
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->file_folder->Errors->Count());
        $errors = ($errors || $this->origin_file_name->Errors->Count());
        $errors = ($errors || $this->file_name->Errors->Count());
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

//Operation Method @94-C1D308F2
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

        $this->file_name->Upload();

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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "s_keyword", "t_cacc_legal_doc_id", "t_cacc_legal_docGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "s_keyword", "t_cacc_legal_doc_id", "t_cacc_legal_docGridPage"));
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

//InsertRow Method @94-285C32A5
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->legal_doc_desc->SetValue($this->legal_doc_desc->GetValue(true));
        $this->DataSource->p_legal_doc_type_id->SetValue($this->p_legal_doc_type_id->GetValue(true));
        $this->DataSource->t_cust_account_id->SetValue($this->t_cust_account_id->GetValue(true));
        $this->DataSource->file_name->SetValue($this->file_name->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->file_name->Move();
        }
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-AF974D33
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_cacc_legal_doc_id->SetValue($this->t_cacc_legal_doc_id->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->legal_doc_desc->SetValue($this->legal_doc_desc->GetValue(true));
        $this->DataSource->p_legal_doc_type_id->SetValue($this->p_legal_doc_type_id->GetValue(true));
        $this->DataSource->file_name->SetValue($this->file_name->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->file_name->Move();
        }
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-76BAC123
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_cacc_legal_doc_id->SetValue($this->t_cacc_legal_doc_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->file_name->Delete();
        }
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-3017EAB0
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
                    $this->t_cacc_legal_doc_id->SetValue($this->DataSource->t_cacc_legal_doc_id->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->legal_doc_desc->SetValue($this->DataSource->legal_doc_desc->GetValue());
                    $this->p_legal_doc_type_id->SetValue($this->DataSource->p_legal_doc_type_id->GetValue());
                    $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                    $this->file_folder->SetValue($this->DataSource->file_folder->GetValue());
                    $this->origin_file_name->SetValue($this->DataSource->origin_file_name->GetValue());
                    $this->file_name->SetValue($this->DataSource->file_name->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_cacc_legal_doc_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cacc_legal_docGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->legal_doc_desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_legal_doc_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->file_folder->Errors->ToString());
            $Error = ComposeStrings($Error, $this->origin_file_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->file_name->Errors->ToString());
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
        $this->t_cacc_legal_doc_id->Show();
        $this->description->Show();
        $this->created_by->Show();
        $this->updated_by->Show();
        $this->creation_date->Show();
        $this->updated_date->Show();
        $this->t_cacc_legal_docGridPage->Show();
        $this->legal_doc_desc->Show();
        $this->p_legal_doc_type_id->Show();
        $this->t_cust_account_id->Show();
        $this->file_folder->Show();
        $this->origin_file_name->Show();
        $this->file_name->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_cacc_legal_docForm Class @94-FCB6E20C

class clst_cacc_legal_docFormDataSource extends clsDBConnSIKP {  //t_cacc_legal_docFormDataSource Class @94-877AB209

//DataSource Variables @94-AF7D6870
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
    var $t_cacc_legal_doc_id;
    var $description;
    var $created_by;
    var $updated_by;
    var $creation_date;
    var $updated_date;
    var $t_cacc_legal_docGridPage;
    var $legal_doc_desc;
    var $p_legal_doc_type_id;
    var $t_cust_account_id;
    var $file_folder;
    var $origin_file_name;
    var $file_name;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-F59D3237
    function clst_cacc_legal_docFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_cacc_legal_docForm/Error";
        $this->Initialize();
        $this->t_cacc_legal_doc_id = new clsField("t_cacc_legal_doc_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->t_cacc_legal_docGridPage = new clsField("t_cacc_legal_docGridPage", ccsText, "");
        
        $this->legal_doc_desc = new clsField("legal_doc_desc", ccsText, "");
        
        $this->p_legal_doc_type_id = new clsField("p_legal_doc_type_id", ccsFloat, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->file_folder = new clsField("file_folder", ccsText, "");
        
        $this->origin_file_name = new clsField("origin_file_name", ccsText, "");
        
        $this->file_name = new clsField("file_name", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-D9F6FF9E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cacc_legal_doc_id", ccsFloat, "", "", $this->Parameters["urlt_cacc_legal_doc_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-8D2693BD
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT t_cacc_legal_doc_id, t_cust_account_id, p_legal_doc_type_id, \n" .
        "legal_doc_desc, origin_file_name, \n" .
        "file_folder, description,\n" .
        "file_name, to_char(creation_date, 'DD-MON-YYYY')as creation_date, \n" .
        "created_by, to_char(updated_date,'DD-MON-YYYY')as updated_date, updated_by \n" .
        "FROM t_cacc_legal_doc\n" .
        "WHERE t_cacc_legal_doc_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-4B40188A
    function SetValues()
    {
        $this->t_cacc_legal_doc_id->SetDBValue(trim($this->f("t_cacc_legal_doc_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->legal_doc_desc->SetDBValue($this->f("legal_doc_desc"));
        $this->p_legal_doc_type_id->SetDBValue(trim($this->f("p_legal_doc_type_id")));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->file_folder->SetDBValue($this->f("file_folder"));
        $this->origin_file_name->SetDBValue($this->f("origin_file_name"));
        $this->file_name->SetDBValue($this->f("file_name"));
    }
//End SetValues Method

//Insert Method @94-B6DA8DDA
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr639", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr640", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["legal_doc_desc"] = new clsSQLParameter("ctrllegal_doc_desc", ccsText, "", "", $this->legal_doc_desc->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_legal_doc_type_id"] = new clsSQLParameter("ctrlp_legal_doc_type_id", ccsFloat, "", "", $this->p_legal_doc_type_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_cust_account_id"] = new clsSQLParameter("ctrlt_cust_account_id", ccsFloat, "", "", $this->t_cust_account_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["file_name"] = new clsSQLParameter("ctrlfile_name", ccsText, "", "", $this->file_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["file_folder"] = new clsSQLParameter("expr649", ccsText, "", "", files, "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["legal_doc_desc"]->GetValue()) and !strlen($this->cp["legal_doc_desc"]->GetText()) and !is_bool($this->cp["legal_doc_desc"]->GetValue())) 
            $this->cp["legal_doc_desc"]->SetValue($this->legal_doc_desc->GetValue(true));
        if (!is_null($this->cp["p_legal_doc_type_id"]->GetValue()) and !strlen($this->cp["p_legal_doc_type_id"]->GetText()) and !is_bool($this->cp["p_legal_doc_type_id"]->GetValue())) 
            $this->cp["p_legal_doc_type_id"]->SetValue($this->p_legal_doc_type_id->GetValue(true));
        if (!is_null($this->cp["t_cust_account_id"]->GetValue()) and !strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue())) 
            $this->cp["t_cust_account_id"]->SetValue($this->t_cust_account_id->GetValue(true));
        if (!strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue(true))) 
            $this->cp["t_cust_account_id"]->SetText(0);
        if (!is_null($this->cp["file_name"]->GetValue()) and !strlen($this->cp["file_name"]->GetText()) and !is_bool($this->cp["file_name"]->GetValue())) 
            $this->cp["file_name"]->SetValue($this->file_name->GetValue(true));
        if (!is_null($this->cp["file_folder"]->GetValue()) and !strlen($this->cp["file_folder"]->GetText()) and !is_bool($this->cp["file_folder"]->GetValue())) 
            $this->cp["file_folder"]->SetValue(files);
        $this->SQL = "INSERT INTO t_cacc_legal_doc(t_cacc_legal_doc_id, description, created_by, updated_by, creation_date, updated_date, p_legal_doc_type_id, t_cust_account_id, origin_file_name, file_folder, file_name, legal_doc_desc) \n" .
        "VALUES(generate_id('sikp','t_cacc_legal_doc','t_cacc_legal_doc_id'), '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', sysdate, sysdate, " . $this->SQLValue($this->cp["p_legal_doc_type_id"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["t_cust_account_id"]->GetDBValue(), ccsFloat) . ", substr('" . $this->SQLValue($this->cp["file_name"]->GetDBValue(), ccsText) . "',17),'" . $this->SQLValue($this->cp["file_folder"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["file_name"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["legal_doc_desc"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-59F53114
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_cacc_legal_doc_id"] = new clsSQLParameter("ctrlt_cacc_legal_doc_id", ccsFloat, "", "", $this->t_cacc_legal_doc_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr666", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["legal_doc_desc"] = new clsSQLParameter("ctrllegal_doc_desc", ccsText, "", "", $this->legal_doc_desc->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_legal_doc_type_id"] = new clsSQLParameter("ctrlp_legal_doc_type_id", ccsFloat, "", "", $this->p_legal_doc_type_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["file_name"] = new clsSQLParameter("ctrlfile_name", ccsText, "", "", $this->file_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["file_folder"] = new clsSQLParameter("expr673", ccsText, "", "", files, "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_cacc_legal_doc_id"]->GetValue()) and !strlen($this->cp["t_cacc_legal_doc_id"]->GetText()) and !is_bool($this->cp["t_cacc_legal_doc_id"]->GetValue())) 
            $this->cp["t_cacc_legal_doc_id"]->SetValue($this->t_cacc_legal_doc_id->GetValue(true));
        if (!strlen($this->cp["t_cacc_legal_doc_id"]->GetText()) and !is_bool($this->cp["t_cacc_legal_doc_id"]->GetValue(true))) 
            $this->cp["t_cacc_legal_doc_id"]->SetText(0);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["legal_doc_desc"]->GetValue()) and !strlen($this->cp["legal_doc_desc"]->GetText()) and !is_bool($this->cp["legal_doc_desc"]->GetValue())) 
            $this->cp["legal_doc_desc"]->SetValue($this->legal_doc_desc->GetValue(true));
        if (!is_null($this->cp["p_legal_doc_type_id"]->GetValue()) and !strlen($this->cp["p_legal_doc_type_id"]->GetText()) and !is_bool($this->cp["p_legal_doc_type_id"]->GetValue())) 
            $this->cp["p_legal_doc_type_id"]->SetValue($this->p_legal_doc_type_id->GetValue(true));
        if (!is_null($this->cp["file_name"]->GetValue()) and !strlen($this->cp["file_name"]->GetText()) and !is_bool($this->cp["file_name"]->GetValue())) 
            $this->cp["file_name"]->SetValue($this->file_name->GetValue(true));
        if (!is_null($this->cp["file_folder"]->GetValue()) and !strlen($this->cp["file_folder"]->GetText()) and !is_bool($this->cp["file_folder"]->GetValue())) 
            $this->cp["file_folder"]->SetValue(files);
        $this->SQL = "UPDATE t_cacc_legal_doc SET \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "legal_doc_desc='" . $this->SQLValue($this->cp["legal_doc_desc"]->GetDBValue(), ccsText) . "', \n" .
        "p_legal_doc_type_id=" . $this->SQLValue($this->cp["p_legal_doc_type_id"]->GetDBValue(), ccsFloat) . ",  \n" .
        "origin_file_name=substr('" . $this->SQLValue($this->cp["file_name"]->GetDBValue(), ccsText) . "',17), \n" .
        "file_folder='" . $this->SQLValue($this->cp["file_folder"]->GetDBValue(), ccsText) . "', \n" .
        "file_name='" . $this->SQLValue($this->cp["file_name"]->GetDBValue(), ccsText) . "'\n" .
        "WHERE t_cacc_legal_doc_id=" . $this->SQLValue($this->cp["t_cacc_legal_doc_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-490BC86F
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_cacc_legal_doc_id"] = new clsSQLParameter("ctrlt_cacc_legal_doc_id", ccsFloat, "", "", $this->t_cacc_legal_doc_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_cacc_legal_doc_id"]->GetValue()) and !strlen($this->cp["t_cacc_legal_doc_id"]->GetText()) and !is_bool($this->cp["t_cacc_legal_doc_id"]->GetValue())) 
            $this->cp["t_cacc_legal_doc_id"]->SetValue($this->t_cacc_legal_doc_id->GetValue(true));
        if (!strlen($this->cp["t_cacc_legal_doc_id"]->GetText()) and !is_bool($this->cp["t_cacc_legal_doc_id"]->GetValue(true))) 
            $this->cp["t_cacc_legal_doc_id"]->SetText(0);
        $this->SQL = "DELETE FROM t_cacc_legal_doc_doc\n" .
        "WHERE t_cacc_legal_doc_id = " . $this->SQLValue($this->cp["t_cacc_legal_doc_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_cacc_legal_docFormDataSource Class @94-FCB6E20C

//Initialize Page @1-47ED6139
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
$TemplateFileName = "t_cacc_legal_doc.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-2A28CC6A
include_once("./t_cacc_legal_doc_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-FFA10B44
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_cacc_legal_docGrid = & new clsGridt_cacc_legal_docGrid("", $MainPage);
$t_cacc_legal_docSearch = & new clsRecordt_cacc_legal_docSearch("", $MainPage);
$t_cacc_legal_docForm = & new clsRecordt_cacc_legal_docForm("", $MainPage);
$MainPage->t_cacc_legal_docGrid = & $t_cacc_legal_docGrid;
$MainPage->t_cacc_legal_docSearch = & $t_cacc_legal_docSearch;
$MainPage->t_cacc_legal_docForm = & $t_cacc_legal_docForm;
$t_cacc_legal_docGrid->Initialize();
$t_cacc_legal_docForm->Initialize();

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

//Execute Components @1-7F66AB4D
$t_cacc_legal_docSearch->Operation();
$t_cacc_legal_docForm->Operation();
//End Execute Components

//Go to destination page @1-CC274F09
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_cacc_legal_docGrid);
    unset($t_cacc_legal_docSearch);
    unset($t_cacc_legal_docForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-16B873AE
$t_cacc_legal_docGrid->Show();
$t_cacc_legal_docSearch->Show();
$t_cacc_legal_docForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-4EE4CCC4
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_cacc_legal_docGrid);
unset($t_cacc_legal_docSearch);
unset($t_cacc_legal_docForm);
unset($Tpl);
//End Unload Page


?>
