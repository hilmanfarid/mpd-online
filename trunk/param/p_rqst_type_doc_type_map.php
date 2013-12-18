<?php
//Include Common Files @1-342093D4
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_rqst_type_doc_type_map.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_rqst_type_doc_type_mapGrid { //p_rqst_type_doc_type_mapGrid class @2-5E532175

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

//Class_Initialize Event @2-D255EF48
    function clsGridp_rqst_type_doc_type_mapGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_rqst_type_doc_type_mapGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_rqst_type_doc_type_mapGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_rqst_type_doc_type_mapGridDataSource($this);
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
        $this->DLink->Page = "p_rqst_type_doc_type_map.php";
        $this->code = & new clsControl(ccsLabel, "code", "code", ccsText, "", CCGetRequestParam("code", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->updated_by = & new clsControl(ccsLabel, "updated_by", "updated_by", ccsText, "", CCGetRequestParam("updated_by", ccsGet, NULL), $this);
        $this->updated_date = & new clsControl(ccsLabel, "updated_date", "updated_date", ccsText, "", CCGetRequestParam("updated_date", ccsGet, NULL), $this);
        $this->p_rqst_type_doc_type_map_id = & new clsControl(ccsHidden, "p_rqst_type_doc_type_map_id", "p_rqst_type_doc_type_map_id", ccsFloat, "", CCGetRequestParam("p_rqst_type_doc_type_map_id", ccsGet, NULL), $this);
        $this->display_name = & new clsControl(ccsLabel, "display_name", "display_name", ccsText, "", CCGetRequestParam("display_name", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_rqst_type_doc_type_map.php";
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

//Show Method @2-D0CA20A8
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
            $this->ControlsVisible["code"] = $this->code->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["updated_by"] = $this->updated_by->Visible;
            $this->ControlsVisible["updated_date"] = $this->updated_date->Visible;
            $this->ControlsVisible["p_rqst_type_doc_type_map_id"] = $this->p_rqst_type_doc_type_map_id->Visible;
            $this->ControlsVisible["display_name"] = $this->display_name->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_rqst_type_doc_type_map_id", $this->DataSource->f("p_rqst_type_doc_type_map_id"));
                $this->code->SetValue($this->DataSource->code->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                $this->p_rqst_type_doc_type_map_id->SetValue($this->DataSource->p_rqst_type_doc_type_map_id->GetValue());
                $this->display_name->SetValue($this->DataSource->display_name->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->code->Show();
                $this->description->Show();
                $this->updated_by->Show();
                $this->updated_date->Show();
                $this->p_rqst_type_doc_type_map_id->Show();
                $this->display_name->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_rqst_type_doc_type_map_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-A1C4C393
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->updated_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->updated_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_rqst_type_doc_type_map_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->display_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_rqst_type_doc_type_mapGrid Class @2-FCB6E20C

class clsp_rqst_type_doc_type_mapGridDataSource extends clsDBConnSIKP {  //p_rqst_type_doc_type_mapGridDataSource Class @2-73DACDFD

//DataSource Variables @2-64E2AF60
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $code;
    var $description;
    var $updated_by;
    var $updated_date;
    var $p_rqst_type_doc_type_map_id;
    var $display_name;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-BDE302C4
    function clsp_rqst_type_doc_type_mapGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_rqst_type_doc_type_mapGrid";
        $this->Initialize();
        $this->code = new clsField("code", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->p_rqst_type_doc_type_map_id = new clsField("p_rqst_type_doc_type_map_id", ccsFloat, "");
        
        $this->display_name = new clsField("display_name", ccsText, "");
        

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

//Prepare Method @2-25AA94A2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
    }
//End Prepare Method

//Open Method @2-65E7A7FA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT\n" .
        "a.code,\n" .
        "b.p_rqst_type_doc_type_map_id,\n" .
        "b.description,\n" .
        "to_char(b.creation_date,'DD-MON-YYYY') as creation_date,\n" .
        "b.created_by,\n" .
        "to_char(b.updated_date,'DD-MON-YYYY') as updated_date,\n" .
        "b.updated_by,\n" .
        "c.display_name\n" .
        "FROM (p_rqst_type_doc_type_map b INNER JOIN p_rqst_type a ON\n" .
        "b.p_rqst_type_id = a.p_rqst_type_id) INNER JOIN p_document_type c ON\n" .
        "b.p_document_type_id = c.p_document_type_id \n" .
        "\n" .
        "WHERE display_name LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR code LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' ) cnt";
        $this->SQL = "SELECT\n" .
        "a.code,\n" .
        "b.p_rqst_type_doc_type_map_id,\n" .
        "b.description,\n" .
        "to_char(b.creation_date,'DD-MON-YYYY') as creation_date,\n" .
        "b.created_by,\n" .
        "to_char(b.updated_date,'DD-MON-YYYY') as updated_date,\n" .
        "b.updated_by,\n" .
        "c.display_name\n" .
        "FROM (p_rqst_type_doc_type_map b INNER JOIN p_rqst_type a ON\n" .
        "b.p_rqst_type_id = a.p_rqst_type_id) INNER JOIN p_document_type c ON\n" .
        "b.p_document_type_id = c.p_document_type_id \n" .
        "\n" .
        "WHERE display_name LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR code LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' ";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-4B9E4978
    function SetValues()
    {
        $this->code->SetDBValue($this->f("code"));
        $this->description->SetDBValue($this->f("description"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->p_rqst_type_doc_type_map_id->SetDBValue(trim($this->f("p_rqst_type_doc_type_map_id")));
        $this->display_name->SetDBValue($this->f("display_name"));
    }
//End SetValues Method

} //End p_rqst_type_doc_type_mapGridDataSource Class @2-FCB6E20C

class clsRecordp_rqst_type_doc_type_mapSearch { //p_rqst_type_doc_type_mapSearch Class @3-A942E719

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

//Class_Initialize Event @3-70F646E0
    function clsRecordp_rqst_type_doc_type_mapSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_rqst_type_doc_type_mapSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_rqst_type_doc_type_mapSearch";
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

//Operation Method @3-67CB575C
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
        $Redirect = "p_rqst_type_doc_type_map.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_rqst_type_doc_type_map.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

} //End p_rqst_type_doc_type_mapSearch Class @3-FCB6E20C

class clsRecordp_rqst_type_doc_type_mapForm { //p_rqst_type_doc_type_mapForm Class @23-FF59F0E8

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

//Class_Initialize Event @23-853B052A
    function clsRecordp_rqst_type_doc_type_mapForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_rqst_type_doc_type_mapForm/Error";
        $this->DataSource = new clsp_rqst_type_doc_type_mapFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_rqst_type_doc_type_mapForm";
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
            $this->p_rqst_type_id = & new clsControl(ccsHidden, "p_rqst_type_id", "Id", ccsFloat, "", CCGetRequestParam("p_rqst_type_id", $Method, NULL), $this);
            $this->code = & new clsControl(ccsTextBox, "code", "Jenis Permohonan", ccsText, "", CCGetRequestParam("code", $Method, NULL), $this);
            $this->code->Required = true;
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->p_rqst_typeGridPage = & new clsControl(ccsHidden, "p_rqst_typeGridPage", "p_rqst_typeGridPage", ccsText, "", CCGetRequestParam("p_rqst_typeGridPage", $Method, NULL), $this);
            $this->display_name = & new clsControl(ccsTextBox, "display_name", "Jenis Pajak", ccsText, "", CCGetRequestParam("display_name", $Method, NULL), $this);
            $this->p_document_type_id = & new clsControl(ccsHidden, "p_document_type_id", "p_document_type_id", ccsFloat, "", CCGetRequestParam("p_document_type_id", $Method, NULL), $this);
            $this->p_rqst_type_doc_type_map_id = & new clsControl(ccsHidden, "p_rqst_type_doc_type_map_id", "p_rqst_type_doc_type_map_id", ccsText, "", CCGetRequestParam("p_rqst_type_doc_type_map_id", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @23-953F08AA
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_rqst_type_doc_type_map_id"] = CCGetFromGet("p_rqst_type_doc_type_map_id", NULL);
    }
//End Initialize Method

//Validate Method @23-E31CB01C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_rqst_type_id->Validate() && $Validation);
        $Validation = ($this->code->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->p_rqst_typeGridPage->Validate() && $Validation);
        $Validation = ($this->display_name->Validate() && $Validation);
        $Validation = ($this->p_document_type_id->Validate() && $Validation);
        $Validation = ($this->p_rqst_type_doc_type_map_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_rqst_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rqst_typeGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->display_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_document_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rqst_type_doc_type_map_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-E965D01F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_rqst_type_id->Errors->Count());
        $errors = ($errors || $this->code->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->p_rqst_typeGridPage->Errors->Count());
        $errors = ($errors || $this->display_name->Errors->Count());
        $errors = ($errors || $this->p_document_type_id->Errors->Count());
        $errors = ($errors || $this->p_rqst_type_doc_type_map_id->Errors->Count());
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

//Operation Method @23-B01B4380
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_rqst_type_id", "p_rqst_typeGridPage", "s_keyword"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_rqst_type_id", "p_rqst_typeGridPage", "s_keyword"));
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

//InsertRow Method @23-9CE1810E
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->p_rqst_type_id->SetValue($this->p_rqst_type_id->GetValue(true));
        $this->DataSource->p_document_type_id->SetValue($this->p_document_type_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @23-56B06AC9
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->p_rqst_type_id->SetValue($this->p_rqst_type_id->GetValue(true));
        $this->DataSource->p_document_type_id->SetValue($this->p_document_type_id->GetValue(true));
        $this->DataSource->p_rqst_type_doc_type_map_id->SetValue($this->p_rqst_type_doc_type_map_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-A6C8BD76
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_rqst_type_doc_type_map_id->SetValue($this->p_rqst_type_doc_type_map_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-867FAB3E
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
                    $this->p_rqst_type_id->SetValue($this->DataSource->p_rqst_type_id->GetValue());
                    $this->code->SetValue($this->DataSource->code->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->display_name->SetValue($this->DataSource->display_name->GetValue());
                    $this->p_document_type_id->SetValue($this->DataSource->p_document_type_id->GetValue());
                    $this->p_rqst_type_doc_type_map_id->SetValue($this->DataSource->p_rqst_type_doc_type_map_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_rqst_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rqst_typeGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->display_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_document_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rqst_type_doc_type_map_id->Errors->ToString());
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
        $this->p_rqst_type_id->Show();
        $this->code->Show();
        $this->description->Show();
        $this->creation_date->Show();
        $this->created_by->Show();
        $this->updated_date->Show();
        $this->updated_by->Show();
        $this->p_rqst_typeGridPage->Show();
        $this->display_name->Show();
        $this->p_document_type_id->Show();
        $this->p_rqst_type_doc_type_map_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_rqst_type_doc_type_mapForm Class @23-FCB6E20C

class clsp_rqst_type_doc_type_mapFormDataSource extends clsDBConnSIKP {  //p_rqst_type_doc_type_mapFormDataSource Class @23-2CED5B09

//DataSource Variables @23-3A1AA21B
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
    var $p_rqst_type_id;
    var $code;
    var $description;
    var $creation_date;
    var $created_by;
    var $updated_date;
    var $updated_by;
    var $p_rqst_typeGridPage;
    var $display_name;
    var $p_document_type_id;
    var $p_rqst_type_doc_type_map_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-9E32F71F
    function clsp_rqst_type_doc_type_mapFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_rqst_type_doc_type_mapForm/Error";
        $this->Initialize();
        $this->p_rqst_type_id = new clsField("p_rqst_type_id", ccsFloat, "");
        
        $this->code = new clsField("code", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->p_rqst_typeGridPage = new clsField("p_rqst_typeGridPage", ccsText, "");
        
        $this->display_name = new clsField("display_name", ccsText, "");
        
        $this->p_document_type_id = new clsField("p_document_type_id", ccsFloat, "");
        
        $this->p_rqst_type_doc_type_map_id = new clsField("p_rqst_type_doc_type_map_id", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-9445F8E3
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_rqst_type_doc_type_map_id", ccsFloat, "", "", $this->Parameters["urlp_rqst_type_doc_type_map_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @23-9B7FDBFE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT\n" .
        "a.code,\n" .
        "b.p_rqst_type_doc_type_map_id,\n" .
        "b.description,\n" .
        "to_char(b.creation_date,'DD-MON-YYYY') as creation_date,\n" .
        "b.created_by,\n" .
        "to_char(b.updated_date,'DD-MON-YYYY') as updated_date,\n" .
        "b.updated_by,\n" .
        "c.display_name\n" .
        "FROM (p_rqst_type_doc_type_map b INNER JOIN p_rqst_type a ON\n" .
        "b.p_rqst_type_id = a.p_rqst_type_id) INNER JOIN p_document_type c ON\n" .
        "b.p_document_type_id = c.p_document_type_id \n" .
        "\n" .
        "WHERE\n" .
        "p_rqst_type_doc_type_map_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-032F4DF6
    function SetValues()
    {
        $this->p_rqst_type_id->SetDBValue(trim($this->f("p_rqst_type_id")));
        $this->code->SetDBValue($this->f("code"));
        $this->description->SetDBValue($this->f("description"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->display_name->SetDBValue($this->f("display_name"));
        $this->p_document_type_id->SetDBValue(trim($this->f("p_document_type_id")));
        $this->p_rqst_type_doc_type_map_id->SetDBValue($this->f("p_rqst_type_doc_type_map_id"));
    }
//End SetValues Method

//Insert Method @23-AB2D50A5
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr87", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr89", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["p_rqst_type_id"] = new clsSQLParameter("ctrlp_rqst_type_id", ccsFloat, "", "", $this->p_rqst_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_document_type_id"] = new clsSQLParameter("ctrlp_document_type_id", ccsFloat, "", "", $this->p_document_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["p_rqst_type_id"]->GetValue()) and !strlen($this->cp["p_rqst_type_id"]->GetText()) and !is_bool($this->cp["p_rqst_type_id"]->GetValue())) 
            $this->cp["p_rqst_type_id"]->SetValue($this->p_rqst_type_id->GetValue(true));
        if (!strlen($this->cp["p_rqst_type_id"]->GetText()) and !is_bool($this->cp["p_rqst_type_id"]->GetValue(true))) 
            $this->cp["p_rqst_type_id"]->SetText(0);
        if (!is_null($this->cp["p_document_type_id"]->GetValue()) and !strlen($this->cp["p_document_type_id"]->GetText()) and !is_bool($this->cp["p_document_type_id"]->GetValue())) 
            $this->cp["p_document_type_id"]->SetValue($this->p_document_type_id->GetValue(true));
        if (!strlen($this->cp["p_document_type_id"]->GetText()) and !is_bool($this->cp["p_document_type_id"]->GetValue(true))) 
            $this->cp["p_document_type_id"]->SetText(0);
        $this->SQL = "INSERT INTO p_rqst_type_doc_type_map(p_rqst_type_doc_type_map_id, p_rqst_type_id, p_document_type_id, description, creation_date, created_by, updated_date, updated_by) \n" .
        "VALUES(generate_id('sikp','p_rqst_type_doc_type_map','p_rqst_type_doc_type_map_id'), " . $this->SQLValue($this->cp["p_rqst_type_id"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["p_document_type_id"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-46F70881
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr64", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["p_rqst_type_id"] = new clsSQLParameter("ctrlp_rqst_type_id", ccsFloat, "", "", $this->p_rqst_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_document_type_id"] = new clsSQLParameter("ctrlp_document_type_id", ccsFloat, "", "", $this->p_document_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_rqst_type_doc_type_map_id"] = new clsSQLParameter("ctrlp_rqst_type_doc_type_map_id", ccsFloat, "", "", $this->p_rqst_type_doc_type_map_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["p_rqst_type_id"]->GetValue()) and !strlen($this->cp["p_rqst_type_id"]->GetText()) and !is_bool($this->cp["p_rqst_type_id"]->GetValue())) 
            $this->cp["p_rqst_type_id"]->SetValue($this->p_rqst_type_id->GetValue(true));
        if (!strlen($this->cp["p_rqst_type_id"]->GetText()) and !is_bool($this->cp["p_rqst_type_id"]->GetValue(true))) 
            $this->cp["p_rqst_type_id"]->SetText(0);
        if (!is_null($this->cp["p_document_type_id"]->GetValue()) and !strlen($this->cp["p_document_type_id"]->GetText()) and !is_bool($this->cp["p_document_type_id"]->GetValue())) 
            $this->cp["p_document_type_id"]->SetValue($this->p_document_type_id->GetValue(true));
        if (!strlen($this->cp["p_document_type_id"]->GetText()) and !is_bool($this->cp["p_document_type_id"]->GetValue(true))) 
            $this->cp["p_document_type_id"]->SetText(0);
        if (!is_null($this->cp["p_rqst_type_doc_type_map_id"]->GetValue()) and !strlen($this->cp["p_rqst_type_doc_type_map_id"]->GetText()) and !is_bool($this->cp["p_rqst_type_doc_type_map_id"]->GetValue())) 
            $this->cp["p_rqst_type_doc_type_map_id"]->SetValue($this->p_rqst_type_doc_type_map_id->GetValue(true));
        if (!strlen($this->cp["p_rqst_type_doc_type_map_id"]->GetText()) and !is_bool($this->cp["p_rqst_type_doc_type_map_id"]->GetValue(true))) 
            $this->cp["p_rqst_type_doc_type_map_id"]->SetText(0);
        $this->SQL = "UPDATE p_rqst_type_doc_type_map SET\n" .
        "p_rqst_type_id = " . $this->SQLValue($this->cp["p_rqst_type_id"]->GetDBValue(), ccsFloat) . ",\n" .
        "p_document_type_id = " . $this->SQLValue($this->cp["p_document_type_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "description = '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date = sysdate, \n" .
        "updated_by = '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "'\n" .
        "WHERE\n" .
        "p_rqst_type_doc_type_map_id = " . $this->SQLValue($this->cp["p_rqst_type_doc_type_map_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-AD38DBF6
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_rqst_type_doc_type_map_id"] = new clsSQLParameter("ctrlp_rqst_type_doc_type_map_id", ccsFloat, "", "", $this->p_rqst_type_doc_type_map_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_rqst_type_doc_type_map_id"]->GetValue()) and !strlen($this->cp["p_rqst_type_doc_type_map_id"]->GetText()) and !is_bool($this->cp["p_rqst_type_doc_type_map_id"]->GetValue())) 
            $this->cp["p_rqst_type_doc_type_map_id"]->SetValue($this->p_rqst_type_doc_type_map_id->GetValue(true));
        if (!strlen($this->cp["p_rqst_type_doc_type_map_id"]->GetText()) and !is_bool($this->cp["p_rqst_type_doc_type_map_id"]->GetValue(true))) 
            $this->cp["p_rqst_type_doc_type_map_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_rqst_type_doc_type_map \n" .
        "WHERE  p_rqst_type_doc_type_map_id = " . $this->SQLValue($this->cp["p_rqst_type_doc_type_map_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_rqst_type_doc_type_mapFormDataSource Class @23-FCB6E20C

//Initialize Page @1-2368EA99
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
$TemplateFileName = "p_rqst_type_doc_type_map.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-60A387ED
include_once("./p_rqst_type_doc_type_map_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1748AD88
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_rqst_type_doc_type_mapGrid = & new clsGridp_rqst_type_doc_type_mapGrid("", $MainPage);
$p_rqst_type_doc_type_mapSearch = & new clsRecordp_rqst_type_doc_type_mapSearch("", $MainPage);
$p_rqst_type_doc_type_mapForm = & new clsRecordp_rqst_type_doc_type_mapForm("", $MainPage);
$MainPage->p_rqst_type_doc_type_mapGrid = & $p_rqst_type_doc_type_mapGrid;
$MainPage->p_rqst_type_doc_type_mapSearch = & $p_rqst_type_doc_type_mapSearch;
$MainPage->p_rqst_type_doc_type_mapForm = & $p_rqst_type_doc_type_mapForm;
$p_rqst_type_doc_type_mapGrid->Initialize();
$p_rqst_type_doc_type_mapForm->Initialize();

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

//Execute Components @1-7323B0D6
$p_rqst_type_doc_type_mapSearch->Operation();
$p_rqst_type_doc_type_mapForm->Operation();
//End Execute Components

//Go to destination page @1-2D61C3EA
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_rqst_type_doc_type_mapGrid);
    unset($p_rqst_type_doc_type_mapSearch);
    unset($p_rqst_type_doc_type_mapForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B533220B
$p_rqst_type_doc_type_mapGrid->Show();
$p_rqst_type_doc_type_mapSearch->Show();
$p_rqst_type_doc_type_mapForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-2ACA572D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_rqst_type_doc_type_mapGrid);
unset($p_rqst_type_doc_type_mapSearch);
unset($p_rqst_type_doc_type_mapForm);
unset($Tpl);
//End Unload Page


?>
