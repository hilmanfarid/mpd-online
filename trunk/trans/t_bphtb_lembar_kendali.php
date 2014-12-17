<?php
//Include Common Files @1-E149B6CF
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_bphtb_lembar_kendali.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridt_ppatGrid { //t_ppatGrid class @2-4B4EC346

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

//Class_Initialize Event @2-6A47AAA8
    function clsGridt_ppatGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_ppatGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_ppatGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_ppatGridDataSource($this);
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
        $this->DLink->Page = "t_bphtb_lembar_kendali.php";
        $this->wp_name = & new clsControl(ccsLabel, "wp_name", "wp_name", ccsText, "", CCGetRequestParam("wp_name", ccsGet, NULL), $this);
        $this->t_bphtb_lembar_kendali_id = & new clsControl(ccsHidden, "t_bphtb_lembar_kendali_id", "t_bphtb_lembar_kendali_id", ccsFloat, "", CCGetRequestParam("t_bphtb_lembar_kendali_id", ccsGet, NULL), $this);
        $this->registration_no = & new clsControl(ccsLabel, "registration_no", "registration_no", ccsText, "", CCGetRequestParam("registration_no", ccsGet, NULL), $this);
        $this->updated_by = & new clsControl(ccsLabel, "updated_by", "updated_by", ccsText, "", CCGetRequestParam("updated_by", ccsGet, NULL), $this);
        $this->wp_address_name = & new clsControl(ccsLabel, "wp_address_name", "wp_address_name", ccsText, "", CCGetRequestParam("wp_address_name", ccsGet, NULL), $this);
        $this->updated_date = & new clsControl(ccsLabel, "updated_date", "updated_date", ccsText, "", CCGetRequestParam("updated_date", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "t_bphtb_lembar_kendali.php";
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

//Show Method @2-E42D8000
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
            $this->ControlsVisible["wp_name"] = $this->wp_name->Visible;
            $this->ControlsVisible["t_bphtb_lembar_kendali_id"] = $this->t_bphtb_lembar_kendali_id->Visible;
            $this->ControlsVisible["registration_no"] = $this->registration_no->Visible;
            $this->ControlsVisible["updated_by"] = $this->updated_by->Visible;
            $this->ControlsVisible["wp_address_name"] = $this->wp_address_name->Visible;
            $this->ControlsVisible["updated_date"] = $this->updated_date->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_bphtb_lembar_kendali_id", $this->DataSource->f("t_bphtb_lembar_kendali_id"));
                $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                $this->t_bphtb_lembar_kendali_id->SetValue($this->DataSource->t_bphtb_lembar_kendali_id->GetValue());
                $this->registration_no->SetValue($this->DataSource->registration_no->GetValue());
                $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                $this->wp_address_name->SetValue($this->DataSource->wp_address_name->GetValue());
                $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->wp_name->Show();
                $this->t_bphtb_lembar_kendali_id->Show();
                $this->registration_no->Show();
                $this->updated_by->Show();
                $this->wp_address_name->Show();
                $this->updated_date->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("t_bphtb_lembar_kendali_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-7492378C
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wp_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_bphtb_lembar_kendali_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->registration_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->updated_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->wp_address_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->updated_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_ppatGrid Class @2-FCB6E20C

class clst_ppatGridDataSource extends clsDBConnSIKP {  //t_ppatGridDataSource Class @2-A64414CC

//DataSource Variables @2-AC38C7A7
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $wp_name;
    var $t_bphtb_lembar_kendali_id;
    var $registration_no;
    var $updated_by;
    var $wp_address_name;
    var $updated_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-9380336E
    function clst_ppatGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_ppatGrid";
        $this->Initialize();
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->t_bphtb_lembar_kendali_id = new clsField("t_bphtb_lembar_kendali_id", ccsFloat, "");
        
        $this->registration_no = new clsField("registration_no", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->wp_address_name = new clsField("wp_address_name", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-B292526B
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "t_bphtb_lembar_kendali_id";
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

//Open Method @2-7D0B98E0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT *\n" .
        "FROM t_bphtb_lembar_kendali\n" .
        "WHERE upper(wp_name) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') cnt";
        $this->SQL = "SELECT *\n" .
        "FROM t_bphtb_lembar_kendali\n" .
        "WHERE upper(wp_name) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-6C990191
    function SetValues()
    {
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->t_bphtb_lembar_kendali_id->SetDBValue(trim($this->f("t_bphtb_lembar_kendali_id")));
        $this->registration_no->SetDBValue($this->f("registration_no"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->wp_address_name->SetDBValue($this->f("wp_address_name"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
    }
//End SetValues Method

} //End t_ppatGridDataSource Class @2-FCB6E20C

class clsRecordt_ppatSearch { //t_ppatSearch Class @3-38C020DB

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

//Class_Initialize Event @3-7AAFA38D
    function clsRecordt_ppatSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_ppatSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_ppatSearch";
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

//Operation Method @3-BF9867A7
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
        $Redirect = "t_bphtb_lembar_kendali.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_bphtb_lembar_kendali.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

} //End t_ppatSearch Class @3-FCB6E20C

class clsRecordt_ppatForm { //t_ppatForm Class @23-3750BFA7

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

//Class_Initialize Event @23-C583B97D
    function clsRecordt_ppatForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_ppatForm/Error";
        $this->DataSource = new clst_ppatFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_ppatForm";
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
            $this->t_bphtb_lembar_kendali_id = & new clsControl(ccsHidden, "t_bphtb_lembar_kendali_id", "Id", ccsFloat, "", CCGetRequestParam("t_bphtb_lembar_kendali_id", $Method, NULL), $this);
            $this->phone_no = & new clsControl(ccsTextBox, "phone_no", "Description", ccsText, "", CCGetRequestParam("phone_no", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->mobile_phone_no = & new clsControl(ccsTextBox, "mobile_phone_no", "No Handphone", ccsText, "", CCGetRequestParam("mobile_phone_no", $Method, NULL), $this);
            $this->wp_name = & new clsControl(ccsTextBox, "wp_name", "wp_name", ccsText, "", CCGetRequestParam("wp_name", $Method, NULL), $this);
            $this->npwp = & new clsControl(ccsTextBox, "npwp", "npwp", ccsText, "", CCGetRequestParam("npwp", $Method, NULL), $this);
            $this->wp_address_name = & new clsControl(ccsTextBox, "wp_address_name", "wp_address_name", ccsText, "", CCGetRequestParam("wp_address_name", $Method, NULL), $this);
            $this->wp_rt = & new clsControl(ccsTextBox, "wp_rt", "wp_rt", ccsText, "", CCGetRequestParam("wp_rt", $Method, NULL), $this);
            $this->wp_rw = & new clsControl(ccsTextBox, "wp_rw", "wp_rw", ccsText, "", CCGetRequestParam("wp_rw", $Method, NULL), $this);
            $this->wp_kota = & new clsControl(ccsTextBox, "wp_kota", "Kota/Kabupaten - WP", ccsText, "", CCGetRequestParam("wp_kota", $Method, NULL), $this);
            $this->wp_kota->Required = true;
            $this->wp_p_region_id = & new clsControl(ccsHidden, "wp_p_region_id", "Kota/Kabupaten - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id", $Method, NULL), $this);
            $this->wp_p_region_id->Required = true;
            $this->wp_p_region_id_kec = & new clsControl(ccsHidden, "wp_p_region_id_kec", "Kecamatan - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id_kec", $Method, NULL), $this);
            $this->wp_p_region_id_kec->Required = true;
            $this->wp_kecamatan = & new clsControl(ccsTextBox, "wp_kecamatan", "Kecamatan - WP", ccsText, "", CCGetRequestParam("wp_kecamatan", $Method, NULL), $this);
            $this->wp_kecamatan->Required = true;
            $this->wp_kelurahan = & new clsControl(ccsTextBox, "wp_kelurahan", "Kelurahan - WP", ccsText, "", CCGetRequestParam("wp_kelurahan", $Method, NULL), $this);
            $this->wp_kelurahan->Required = true;
            $this->wp_p_region_id_kel = & new clsControl(ccsHidden, "wp_p_region_id_kel", "Kelurahan - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id_kel", $Method, NULL), $this);
            $this->wp_p_region_id_kel->Required = true;
            $this->jenis_perolehan_hak = & new clsControl(ccsListBox, "jenis_perolehan_hak", "jenis_perolehan_hak", ccsText, "", CCGetRequestParam("jenis_perolehan_hak", $Method, NULL), $this);
            $this->jenis_perolehan_hak->DSType = dsListOfValues;
            $this->jenis_perolehan_hak->Values = array(array("Waris", "Waris"), array("Fasos", "Fasos"), array("Rumah Dinas", "Rumah Dinas"), array("Waris Gono-Gini", "Waris Gono-Gini"), array("Hibah", "Hibah"), array("Peralihan Hak Baru", "Peralihan Hak Baru"), array("Restitusi", "Restitusi"));
            $this->registration_no = & new clsControl(ccsTextBox, "registration_no", "registration_no", ccsText, "", CCGetRequestParam("registration_no", $Method, NULL), $this);
            $this->tgl_masuk = & new clsControl(ccsTextBox, "tgl_masuk", "tgl_masuk", ccsText, "", CCGetRequestParam("tgl_masuk", $Method, NULL), $this);
            $this->DatePicker_tgl_masuk1 = & new clsDatePicker("DatePicker_tgl_masuk1", "t_ppatForm", "tgl_masuk", $this);
            $this->njop_pbb = & new clsControl(ccsTextBox, "njop_pbb", "njop_pbb", ccsText, "", CCGetRequestParam("njop_pbb", $Method, NULL), $this);
            $this->object_address_name = & new clsControl(ccsTextBox, "object_address_name", "object_address_name", ccsText, "", CCGetRequestParam("object_address_name", $Method, NULL), $this);
            $this->object_rt = & new clsControl(ccsTextBox, "object_rt", "object_rt", ccsText, "", CCGetRequestParam("object_rt", $Method, NULL), $this);
            $this->object_rw = & new clsControl(ccsTextBox, "object_rw", "object_rw", ccsText, "", CCGetRequestParam("object_rw", $Method, NULL), $this);
            $this->object_kota = & new clsControl(ccsTextBox, "object_kota", "Kota/Kabupaten - WP", ccsText, "", CCGetRequestParam("object_kota", $Method, NULL), $this);
            $this->object_kota->Required = true;
            $this->object_p_region_id = & new clsControl(ccsHidden, "object_p_region_id", "Kota/Kabupaten - WP", ccsFloat, "", CCGetRequestParam("object_p_region_id", $Method, NULL), $this);
            $this->object_p_region_id->Required = true;
            $this->object_kecamatan = & new clsControl(ccsTextBox, "object_kecamatan", "Kecamatan - WP", ccsText, "", CCGetRequestParam("object_kecamatan", $Method, NULL), $this);
            $this->object_kecamatan->Required = true;
            $this->object_p_region_id_kec = & new clsControl(ccsHidden, "object_p_region_id_kec", "Kecamatan - Object", ccsFloat, "", CCGetRequestParam("object_p_region_id_kec", $Method, NULL), $this);
            $this->object_p_region_id_kec->Required = true;
            $this->object_kelurahan = & new clsControl(ccsTextBox, "object_kelurahan", "Kelurahan - WP", ccsText, "", CCGetRequestParam("object_kelurahan", $Method, NULL), $this);
            $this->object_kelurahan->Required = true;
            $this->object_p_region_id_kel = & new clsControl(ccsHidden, "object_p_region_id_kel", "Kelurahan - Object", ccsFloat, "", CCGetRequestParam("object_p_region_id_kel", $Method, NULL), $this);
            $this->object_p_region_id_kel->Required = true;
            $this->nilai_njop = & new clsControl(ccsTextBox, "nilai_njop", "nilai_njop", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("nilai_njop", $Method, NULL), $this);
            $this->harga_transaksi = & new clsControl(ccsTextBox, "harga_transaksi", "harga_transaksi", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("harga_transaksi", $Method, NULL), $this);
            $this->jumlah_disetor = & new clsControl(ccsTextBox, "jumlah_disetor", "jumlah_disetor", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("jumlah_disetor", $Method, NULL), $this);
            $this->administrator_id = & new clsControl(ccsListBox, "administrator_id", "administrator_id", ccsText, "", CCGetRequestParam("administrator_id", $Method, NULL), $this);
            $this->administrator_id->DSType = dsSQL;
            $this->administrator_id->DataSource = new clsDBConnSIKP();
            $this->administrator_id->ds = & $this->administrator_id->DataSource;
            list($this->administrator_id->BoundColumn, $this->administrator_id->TextColumn, $this->administrator_id->DBFormat) = array("t_bphtb_exemption_pemeriksa_id", "pemeriksa_nama", "");
            $this->administrator_id->DataSource->SQL = "SELECT * FROM t_bphtb_exemption_pemeriksa\n" .
            "WHERE pemeriksa_status = 'administrator'";
            $this->administrator_id->DataSource->Order = "";
            $this->Button_Update1 = & new clsButton("Button_Update1", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->wp_kota->Value) && !strlen($this->wp_kota->Value) && $this->wp_kota->Value !== false)
                    $this->wp_kota->SetText('KOTA BANDUNG');
                if(!is_array($this->wp_p_region_id->Value) && !strlen($this->wp_p_region_id->Value) && $this->wp_p_region_id->Value !== false)
                    $this->wp_p_region_id->SetText(749);
                if(!is_array($this->object_kota->Value) && !strlen($this->object_kota->Value) && $this->object_kota->Value !== false)
                    $this->object_kota->SetText('KOTA BANDUNG');
                if(!is_array($this->object_p_region_id->Value) && !strlen($this->object_p_region_id->Value) && $this->object_p_region_id->Value !== false)
                    $this->object_p_region_id->SetText(749);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @23-8AFED31A
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_bphtb_lembar_kendali_id"] = CCGetFromGet("t_bphtb_lembar_kendali_id", NULL);
    }
//End Initialize Method

//Validate Method @23-8F9D0868
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_bphtb_lembar_kendali_id->Validate() && $Validation);
        $Validation = ($this->phone_no->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->mobile_phone_no->Validate() && $Validation);
        $Validation = ($this->wp_name->Validate() && $Validation);
        $Validation = ($this->npwp->Validate() && $Validation);
        $Validation = ($this->wp_address_name->Validate() && $Validation);
        $Validation = ($this->wp_rt->Validate() && $Validation);
        $Validation = ($this->wp_rw->Validate() && $Validation);
        $Validation = ($this->wp_kota->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id_kec->Validate() && $Validation);
        $Validation = ($this->wp_kecamatan->Validate() && $Validation);
        $Validation = ($this->wp_kelurahan->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id_kel->Validate() && $Validation);
        $Validation = ($this->jenis_perolehan_hak->Validate() && $Validation);
        $Validation = ($this->registration_no->Validate() && $Validation);
        $Validation = ($this->tgl_masuk->Validate() && $Validation);
        $Validation = ($this->njop_pbb->Validate() && $Validation);
        $Validation = ($this->object_address_name->Validate() && $Validation);
        $Validation = ($this->object_rt->Validate() && $Validation);
        $Validation = ($this->object_rw->Validate() && $Validation);
        $Validation = ($this->object_kota->Validate() && $Validation);
        $Validation = ($this->object_p_region_id->Validate() && $Validation);
        $Validation = ($this->object_kecamatan->Validate() && $Validation);
        $Validation = ($this->object_p_region_id_kec->Validate() && $Validation);
        $Validation = ($this->object_kelurahan->Validate() && $Validation);
        $Validation = ($this->object_p_region_id_kel->Validate() && $Validation);
        $Validation = ($this->nilai_njop->Validate() && $Validation);
        $Validation = ($this->harga_transaksi->Validate() && $Validation);
        $Validation = ($this->jumlah_disetor->Validate() && $Validation);
        $Validation = ($this->administrator_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_bphtb_lembar_kendali_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->phone_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mobile_phone_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npwp->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_rt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_rw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_kota->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id_kec->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id_kel->Errors->Count() == 0);
        $Validation =  $Validation && ($this->jenis_perolehan_hak->Errors->Count() == 0);
        $Validation =  $Validation && ($this->registration_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tgl_masuk->Errors->Count() == 0);
        $Validation =  $Validation && ($this->njop_pbb->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_rt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_rw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_kota->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_p_region_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_p_region_id_kec->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_p_region_id_kel->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nilai_njop->Errors->Count() == 0);
        $Validation =  $Validation && ($this->harga_transaksi->Errors->Count() == 0);
        $Validation =  $Validation && ($this->jumlah_disetor->Errors->Count() == 0);
        $Validation =  $Validation && ($this->administrator_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-CC109459
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_bphtb_lembar_kendali_id->Errors->Count());
        $errors = ($errors || $this->phone_no->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->mobile_phone_no->Errors->Count());
        $errors = ($errors || $this->wp_name->Errors->Count());
        $errors = ($errors || $this->npwp->Errors->Count());
        $errors = ($errors || $this->wp_address_name->Errors->Count());
        $errors = ($errors || $this->wp_rt->Errors->Count());
        $errors = ($errors || $this->wp_rw->Errors->Count());
        $errors = ($errors || $this->wp_kota->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id_kec->Errors->Count());
        $errors = ($errors || $this->wp_kecamatan->Errors->Count());
        $errors = ($errors || $this->wp_kelurahan->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id_kel->Errors->Count());
        $errors = ($errors || $this->jenis_perolehan_hak->Errors->Count());
        $errors = ($errors || $this->registration_no->Errors->Count());
        $errors = ($errors || $this->tgl_masuk->Errors->Count());
        $errors = ($errors || $this->DatePicker_tgl_masuk1->Errors->Count());
        $errors = ($errors || $this->njop_pbb->Errors->Count());
        $errors = ($errors || $this->object_address_name->Errors->Count());
        $errors = ($errors || $this->object_rt->Errors->Count());
        $errors = ($errors || $this->object_rw->Errors->Count());
        $errors = ($errors || $this->object_kota->Errors->Count());
        $errors = ($errors || $this->object_p_region_id->Errors->Count());
        $errors = ($errors || $this->object_kecamatan->Errors->Count());
        $errors = ($errors || $this->object_p_region_id_kec->Errors->Count());
        $errors = ($errors || $this->object_kelurahan->Errors->Count());
        $errors = ($errors || $this->object_p_region_id_kel->Errors->Count());
        $errors = ($errors || $this->nilai_njop->Errors->Count());
        $errors = ($errors || $this->harga_transaksi->Errors->Count());
        $errors = ($errors || $this->jumlah_disetor->Errors->Count());
        $errors = ($errors || $this->administrator_id->Errors->Count());
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

//Operation Method @23-0DF9432A
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
            } else if($this->Button_Update1->Pressed) {
                $this->PressedButton = "Button_Update1";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_simple_parameter_type_id", "p_simple_parameter_typeGridPage", "s_keyword"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_simple_parameter_type_id", "p_simple_parameter_typeGridPage", "s_keyword"));
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
            } else if($this->PressedButton == "Button_Update1") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Update1->CCSEvents, "OnClick", $this->Button_Update1) || !$this->UpdateRow()) {
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

//InsertRow Method @23-7984C657
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->registration_no->SetValue($this->registration_no->GetValue(true));
        $this->DataSource->jenis_perolehan_hak->SetValue($this->jenis_perolehan_hak->GetValue(true));
        $this->DataSource->wp_name->SetValue($this->wp_name->GetValue(true));
        $this->DataSource->npwp->SetValue($this->npwp->GetValue(true));
        $this->DataSource->wp_address_name->SetValue($this->wp_address_name->GetValue(true));
        $this->DataSource->wp_rt->SetValue($this->wp_rt->GetValue(true));
        $this->DataSource->wp_rw->SetValue($this->wp_rw->GetValue(true));
        $this->DataSource->wp_p_region_id->SetValue($this->wp_p_region_id->GetValue(true));
        $this->DataSource->wp_p_region_id_kec->SetValue($this->wp_p_region_id_kec->GetValue(true));
        $this->DataSource->wp_p_region_id_kel->SetValue($this->wp_p_region_id_kel->GetValue(true));
        $this->DataSource->phone_no->SetValue($this->phone_no->GetValue(true));
        $this->DataSource->mobile_phone_no->SetValue($this->mobile_phone_no->GetValue(true));
        $this->DataSource->njop_pbb->SetValue($this->njop_pbb->GetValue(true));
        $this->DataSource->object_address_name->SetValue($this->object_address_name->GetValue(true));
        $this->DataSource->object_rt->SetValue($this->object_rt->GetValue(true));
        $this->DataSource->object_rw->SetValue($this->object_rw->GetValue(true));
        $this->DataSource->object_p_region_id->SetValue($this->object_p_region_id->GetValue(true));
        $this->DataSource->object_p_region_id_kec->SetValue($this->object_p_region_id_kec->GetValue(true));
        $this->DataSource->object_p_region_id_kel->SetValue($this->object_p_region_id_kel->GetValue(true));
        $this->DataSource->tgl_masuk->SetValue($this->tgl_masuk->GetValue(true));
        $this->DataSource->nilai_njop->SetValue($this->nilai_njop->GetValue(true));
        $this->DataSource->harga_transaksi->SetValue($this->harga_transaksi->GetValue(true));
        $this->DataSource->jumlah_disetor->SetValue($this->jumlah_disetor->GetValue(true));
        $this->DataSource->creation_date->SetValue($this->creation_date->GetValue(true));
        $this->DataSource->created_by->SetValue($this->created_by->GetValue(true));
        $this->DataSource->updated_date->SetValue($this->updated_date->GetValue(true));
        $this->DataSource->updated_by->SetValue($this->updated_by->GetValue(true));
        $this->DataSource->administrator_id->SetValue($this->administrator_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @23-F65CF7F8
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->jenis_perolehan_hak->SetValue($this->jenis_perolehan_hak->GetValue(true));
        $this->DataSource->wp_name->SetValue($this->wp_name->GetValue(true));
        $this->DataSource->npwp->SetValue($this->npwp->GetValue(true));
        $this->DataSource->wp_address_name->SetValue($this->wp_address_name->GetValue(true));
        $this->DataSource->wp_rt->SetValue($this->wp_rt->GetValue(true));
        $this->DataSource->wp_rw->SetValue($this->wp_rw->GetValue(true));
        $this->DataSource->wp_p_region_id->SetValue($this->wp_p_region_id->GetValue(true));
        $this->DataSource->wp_p_region_id_kec->SetValue($this->wp_p_region_id_kec->GetValue(true));
        $this->DataSource->wp_p_region_id_kel->SetValue($this->wp_p_region_id_kel->GetValue(true));
        $this->DataSource->phone_no->SetValue($this->phone_no->GetValue(true));
        $this->DataSource->mobile_phone_no->SetValue($this->mobile_phone_no->GetValue(true));
        $this->DataSource->njop_pbb->SetValue($this->njop_pbb->GetValue(true));
        $this->DataSource->object_address_name->SetValue($this->object_address_name->GetValue(true));
        $this->DataSource->object_rt->SetValue($this->object_rt->GetValue(true));
        $this->DataSource->object_rw->SetValue($this->object_rw->GetValue(true));
        $this->DataSource->object_p_region_id->SetValue($this->object_p_region_id->GetValue(true));
        $this->DataSource->object_p_region_id_kec->SetValue($this->object_p_region_id_kec->GetValue(true));
        $this->DataSource->object_p_region_id_kel->SetValue($this->object_p_region_id_kel->GetValue(true));
        $this->DataSource->tgl_masuk->SetValue($this->tgl_masuk->GetValue(true));
        $this->DataSource->nilai_njop->SetValue($this->nilai_njop->GetValue(true));
        $this->DataSource->harga_transaksi->SetValue($this->harga_transaksi->GetValue(true));
        $this->DataSource->jumlah_disetor->SetValue($this->jumlah_disetor->GetValue(true));
        $this->DataSource->updated_date->SetValue($this->updated_date->GetValue(true));
        $this->DataSource->updated_by->SetValue($this->updated_by->GetValue(true));
        $this->DataSource->t_bphtb_lembar_kendali_id->SetValue($this->t_bphtb_lembar_kendali_id->GetValue(true));
        $this->DataSource->registration_no->SetValue($this->registration_no->GetValue(true));
        $this->DataSource->administrator_id->SetValue($this->administrator_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-15610426
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

        $this->jenis_perolehan_hak->Prepare();
        $this->administrator_id->Prepare();

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
                    $this->t_bphtb_lembar_kendali_id->SetValue($this->DataSource->t_bphtb_lembar_kendali_id->GetValue());
                    $this->phone_no->SetValue($this->DataSource->phone_no->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->mobile_phone_no->SetValue($this->DataSource->mobile_phone_no->GetValue());
                    $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                    $this->npwp->SetValue($this->DataSource->npwp->GetValue());
                    $this->wp_address_name->SetValue($this->DataSource->wp_address_name->GetValue());
                    $this->wp_rt->SetValue($this->DataSource->wp_rt->GetValue());
                    $this->wp_rw->SetValue($this->DataSource->wp_rw->GetValue());
                    $this->wp_kota->SetValue($this->DataSource->wp_kota->GetValue());
                    $this->wp_p_region_id->SetValue($this->DataSource->wp_p_region_id->GetValue());
                    $this->wp_p_region_id_kec->SetValue($this->DataSource->wp_p_region_id_kec->GetValue());
                    $this->wp_kecamatan->SetValue($this->DataSource->wp_kecamatan->GetValue());
                    $this->wp_kelurahan->SetValue($this->DataSource->wp_kelurahan->GetValue());
                    $this->wp_p_region_id_kel->SetValue($this->DataSource->wp_p_region_id_kel->GetValue());
                    $this->jenis_perolehan_hak->SetValue($this->DataSource->jenis_perolehan_hak->GetValue());
                    $this->registration_no->SetValue($this->DataSource->registration_no->GetValue());
                    $this->tgl_masuk->SetValue($this->DataSource->tgl_masuk->GetValue());
                    $this->njop_pbb->SetValue($this->DataSource->njop_pbb->GetValue());
                    $this->object_address_name->SetValue($this->DataSource->object_address_name->GetValue());
                    $this->object_rt->SetValue($this->DataSource->object_rt->GetValue());
                    $this->object_rw->SetValue($this->DataSource->object_rw->GetValue());
                    $this->object_kota->SetValue($this->DataSource->object_kota->GetValue());
                    $this->object_p_region_id->SetValue($this->DataSource->object_p_region_id->GetValue());
                    $this->object_kecamatan->SetValue($this->DataSource->object_kecamatan->GetValue());
                    $this->object_p_region_id_kec->SetValue($this->DataSource->object_p_region_id_kec->GetValue());
                    $this->object_kelurahan->SetValue($this->DataSource->object_kelurahan->GetValue());
                    $this->object_p_region_id_kel->SetValue($this->DataSource->object_p_region_id_kel->GetValue());
                    $this->nilai_njop->SetValue($this->DataSource->nilai_njop->GetValue());
                    $this->harga_transaksi->SetValue($this->DataSource->harga_transaksi->GetValue());
                    $this->jumlah_disetor->SetValue($this->DataSource->jumlah_disetor->GetValue());
                    $this->administrator_id->SetValue($this->DataSource->administrator_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_bphtb_lembar_kendali_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->phone_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mobile_phone_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npwp->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_rt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_rw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_kota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id_kec->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id_kel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->jenis_perolehan_hak->Errors->ToString());
            $Error = ComposeStrings($Error, $this->registration_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tgl_masuk->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_tgl_masuk1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->njop_pbb->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_rt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_rw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_kota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_p_region_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_p_region_id_kec->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_p_region_id_kel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nilai_njop->Errors->ToString());
            $Error = ComposeStrings($Error, $this->harga_transaksi->Errors->ToString());
            $Error = ComposeStrings($Error, $this->jumlah_disetor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->administrator_id->Errors->ToString());
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
        $this->Button_Update1->Visible = $this->EditMode && $this->UpdateAllowed;

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
        $this->t_bphtb_lembar_kendali_id->Show();
        $this->phone_no->Show();
        $this->creation_date->Show();
        $this->created_by->Show();
        $this->updated_date->Show();
        $this->updated_by->Show();
        $this->mobile_phone_no->Show();
        $this->wp_name->Show();
        $this->npwp->Show();
        $this->wp_address_name->Show();
        $this->wp_rt->Show();
        $this->wp_rw->Show();
        $this->wp_kota->Show();
        $this->wp_p_region_id->Show();
        $this->wp_p_region_id_kec->Show();
        $this->wp_kecamatan->Show();
        $this->wp_kelurahan->Show();
        $this->wp_p_region_id_kel->Show();
        $this->jenis_perolehan_hak->Show();
        $this->registration_no->Show();
        $this->tgl_masuk->Show();
        $this->DatePicker_tgl_masuk1->Show();
        $this->njop_pbb->Show();
        $this->object_address_name->Show();
        $this->object_rt->Show();
        $this->object_rw->Show();
        $this->object_kota->Show();
        $this->object_p_region_id->Show();
        $this->object_kecamatan->Show();
        $this->object_p_region_id_kec->Show();
        $this->object_kelurahan->Show();
        $this->object_p_region_id_kel->Show();
        $this->nilai_njop->Show();
        $this->harga_transaksi->Show();
        $this->jumlah_disetor->Show();
        $this->administrator_id->Show();
        $this->Button_Update1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_ppatForm Class @23-FCB6E20C

class clst_ppatFormDataSource extends clsDBConnSIKP {  //t_ppatFormDataSource Class @23-F9738238

//DataSource Variables @23-11DC0371
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
    var $t_bphtb_lembar_kendali_id;
    var $phone_no;
    var $creation_date;
    var $created_by;
    var $updated_date;
    var $updated_by;
    var $mobile_phone_no;
    var $wp_name;
    var $npwp;
    var $wp_address_name;
    var $wp_rt;
    var $wp_rw;
    var $wp_kota;
    var $wp_p_region_id;
    var $wp_p_region_id_kec;
    var $wp_kecamatan;
    var $wp_kelurahan;
    var $wp_p_region_id_kel;
    var $jenis_perolehan_hak;
    var $registration_no;
    var $tgl_masuk;
    var $njop_pbb;
    var $object_address_name;
    var $object_rt;
    var $object_rw;
    var $object_kota;
    var $object_p_region_id;
    var $object_kecamatan;
    var $object_p_region_id_kec;
    var $object_kelurahan;
    var $object_p_region_id_kel;
    var $nilai_njop;
    var $harga_transaksi;
    var $jumlah_disetor;
    var $administrator_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-6C0159DE
    function clst_ppatFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_ppatForm/Error";
        $this->Initialize();
        $this->t_bphtb_lembar_kendali_id = new clsField("t_bphtb_lembar_kendali_id", ccsFloat, "");
        
        $this->phone_no = new clsField("phone_no", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->mobile_phone_no = new clsField("mobile_phone_no", ccsText, "");
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->npwp = new clsField("npwp", ccsText, "");
        
        $this->wp_address_name = new clsField("wp_address_name", ccsText, "");
        
        $this->wp_rt = new clsField("wp_rt", ccsText, "");
        
        $this->wp_rw = new clsField("wp_rw", ccsText, "");
        
        $this->wp_kota = new clsField("wp_kota", ccsText, "");
        
        $this->wp_p_region_id = new clsField("wp_p_region_id", ccsFloat, "");
        
        $this->wp_p_region_id_kec = new clsField("wp_p_region_id_kec", ccsFloat, "");
        
        $this->wp_kecamatan = new clsField("wp_kecamatan", ccsText, "");
        
        $this->wp_kelurahan = new clsField("wp_kelurahan", ccsText, "");
        
        $this->wp_p_region_id_kel = new clsField("wp_p_region_id_kel", ccsFloat, "");
        
        $this->jenis_perolehan_hak = new clsField("jenis_perolehan_hak", ccsText, "");
        
        $this->registration_no = new clsField("registration_no", ccsText, "");
        
        $this->tgl_masuk = new clsField("tgl_masuk", ccsText, "");
        
        $this->njop_pbb = new clsField("njop_pbb", ccsText, "");
        
        $this->object_address_name = new clsField("object_address_name", ccsText, "");
        
        $this->object_rt = new clsField("object_rt", ccsText, "");
        
        $this->object_rw = new clsField("object_rw", ccsText, "");
        
        $this->object_kota = new clsField("object_kota", ccsText, "");
        
        $this->object_p_region_id = new clsField("object_p_region_id", ccsFloat, "");
        
        $this->object_kecamatan = new clsField("object_kecamatan", ccsText, "");
        
        $this->object_p_region_id_kec = new clsField("object_p_region_id_kec", ccsFloat, "");
        
        $this->object_kelurahan = new clsField("object_kelurahan", ccsText, "");
        
        $this->object_p_region_id_kel = new clsField("object_p_region_id_kel", ccsFloat, "");
        
        $this->nilai_njop = new clsField("nilai_njop", ccsFloat, "");
        
        $this->harga_transaksi = new clsField("harga_transaksi", ccsFloat, "");
        
        $this->jumlah_disetor = new clsField("jumlah_disetor", ccsFloat, "");
        
        $this->administrator_id = new clsField("administrator_id", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-00938B27
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_bphtb_lembar_kendali_id", ccsFloat, "", "", $this->Parameters["urlt_bphtb_lembar_kendali_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @23-8454A304
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select a.*, to_char(a.tgl_masuk,'DD-MM-YYYY') as tgl_masuk,\n" .
        "b.region_name as wp_kota,\n" .
        "c.region_name as wp_kecamatan,\n" .
        "d.region_name as wp_kelurahan,\n" .
        "e.region_name as object_region,\n" .
        "f.region_name as object_kecamatan,\n" .
        "g.region_name as object_kelurahan,\n" .
        "h.pemeriksa_nama as nama_pemeriksa, h.pemeriksa_nip as nip_pemeriksa, h.pemeriksa_jabatan as jabatan_pemeriksa\n" .
        "from t_bphtb_lembar_kendali as a \n" .
        "left join p_region as b\n" .
        "	on a.wp_p_region_id = b.p_region_id\n" .
        "left join p_region as c\n" .
        "	on a.wp_p_region_id_kec = c.p_region_id\n" .
        "left join p_region as d\n" .
        "	on a.wp_p_region_id_kel = d.p_region_id\n" .
        "left join p_region as e\n" .
        "	on a.object_p_region_id = e.p_region_id\n" .
        "left join p_region as f\n" .
        "	on a.object_p_region_id_kec = f.p_region_id\n" .
        "left join p_region as g\n" .
        "	on a.object_p_region_id_kel = g.p_region_id\n" .
        "left join t_bphtb_exemption_pemeriksa as h\n" .
        "	on a.administrator_id = h.t_bphtb_exemption_pemeriksa_id\n" .
        "where a.t_bphtb_lembar_kendali_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-D0CCCE16
    function SetValues()
    {
        $this->t_bphtb_lembar_kendali_id->SetDBValue(trim($this->f("t_bphtb_lembar_kendali_id")));
        $this->phone_no->SetDBValue($this->f("phone_no"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->mobile_phone_no->SetDBValue($this->f("mobile_phone_no"));
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->npwp->SetDBValue($this->f("npwp"));
        $this->wp_address_name->SetDBValue($this->f("wp_address_name"));
        $this->wp_rt->SetDBValue($this->f("wp_rt"));
        $this->wp_rw->SetDBValue($this->f("wp_rw"));
        $this->wp_kota->SetDBValue($this->f("wp_kota"));
        $this->wp_p_region_id->SetDBValue(trim($this->f("wp_p_region_id")));
        $this->wp_p_region_id_kec->SetDBValue(trim($this->f("wp_p_region_id_kec")));
        $this->wp_kecamatan->SetDBValue($this->f("wp_kecamatan"));
        $this->wp_kelurahan->SetDBValue($this->f("wp_kelurahan"));
        $this->wp_p_region_id_kel->SetDBValue(trim($this->f("wp_p_region_id_kel")));
        $this->jenis_perolehan_hak->SetDBValue($this->f("jenis_perolehan_hak"));
        $this->registration_no->SetDBValue($this->f("registration_no"));
        $this->tgl_masuk->SetDBValue($this->f("tgl_masuk"));
        $this->njop_pbb->SetDBValue($this->f("njop_pbb"));
        $this->object_address_name->SetDBValue($this->f("object_address_name"));
        $this->object_rt->SetDBValue($this->f("object_rt"));
        $this->object_rw->SetDBValue($this->f("object_rw"));
        $this->object_kota->SetDBValue($this->f("object_region"));
        $this->object_p_region_id->SetDBValue(trim($this->f("object_p_region_id")));
        $this->object_kecamatan->SetDBValue($this->f("object_kecamatan"));
        $this->object_p_region_id_kec->SetDBValue(trim($this->f("object_p_region_id_kec")));
        $this->object_kelurahan->SetDBValue($this->f("object_kelurahan"));
        $this->object_p_region_id_kel->SetDBValue(trim($this->f("object_p_region_id_kel")));
        $this->nilai_njop->SetDBValue(trim($this->f("nilai_njop")));
        $this->harga_transaksi->SetDBValue(trim($this->f("harga_transaksi")));
        $this->jumlah_disetor->SetDBValue(trim($this->f("jumlah_disetor")));
        $this->administrator_id->SetDBValue($this->f("administrator_id"));
    }
//End SetValues Method

//Insert Method @23-EA29682C
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["registration_no"] = new clsSQLParameter("ctrlregistration_no", ccsText, "", "", $this->registration_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["jenis_perolehan_hak"] = new clsSQLParameter("ctrljenis_perolehan_hak", ccsText, "", "", $this->jenis_perolehan_hak->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_name"] = new clsSQLParameter("ctrlwp_name", ccsText, "", "", $this->wp_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["npwp"] = new clsSQLParameter("ctrlnpwp", ccsText, "", "", $this->npwp->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_address_name"] = new clsSQLParameter("ctrlwp_address_name", ccsText, "", "", $this->wp_address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_rt"] = new clsSQLParameter("ctrlwp_rt", ccsText, "", "", $this->wp_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_rw"] = new clsSQLParameter("ctrlwp_rw", ccsText, "", "", $this->wp_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_p_region_id"] = new clsSQLParameter("ctrlwp_p_region_id", ccsFloat, "", "", $this->wp_p_region_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kec"] = new clsSQLParameter("ctrlwp_p_region_id_kec", ccsFloat, "", "", $this->wp_p_region_id_kec->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kel"] = new clsSQLParameter("ctrlwp_p_region_id_kel", ccsFloat, "", "", $this->wp_p_region_id_kel->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["phone_no"] = new clsSQLParameter("ctrlphone_no", ccsText, "", "", $this->phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobile_phone_no"] = new clsSQLParameter("ctrlmobile_phone_no", ccsText, "", "", $this->mobile_phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["njop_pbb"] = new clsSQLParameter("ctrlnjop_pbb", ccsText, "", "", $this->njop_pbb->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["object_address_name"] = new clsSQLParameter("ctrlobject_address_name", ccsText, "", "", $this->object_address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["object_rt"] = new clsSQLParameter("ctrlobject_rt", ccsText, "", "", $this->object_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["object_rw"] = new clsSQLParameter("ctrlobject_rw", ccsText, "", "", $this->object_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["object_p_region_id"] = new clsSQLParameter("ctrlobject_p_region_id", ccsFloat, "", "", $this->object_p_region_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["object_p_region_id_kec"] = new clsSQLParameter("ctrlobject_p_region_id_kec", ccsFloat, "", "", $this->object_p_region_id_kec->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["object_p_region_id_kel"] = new clsSQLParameter("ctrlobject_p_region_id_kel", ccsFloat, "", "", $this->object_p_region_id_kel->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["tgl_masuk"] = new clsSQLParameter("ctrltgl_masuk", ccsText, "", "", $this->tgl_masuk->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["nilai_njop"] = new clsSQLParameter("ctrlnilai_njop", ccsFloat, "", "", $this->nilai_njop->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["harga_transaksi"] = new clsSQLParameter("ctrlharga_transaksi", ccsFloat, "", "", $this->harga_transaksi->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["jumlah_disetor"] = new clsSQLParameter("ctrljumlah_disetor", ccsFloat, "", "", $this->jumlah_disetor->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["creation_date"] = new clsSQLParameter("ctrlcreation_date", ccsText, "", "", $this->creation_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("ctrlcreated_by", ccsText, "", "", $this->created_by->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_date"] = new clsSQLParameter("ctrlupdated_date", ccsText, "", "", $this->updated_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("ctrlupdated_by", ccsText, "", "", $this->updated_by->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["administrator_id"] = new clsSQLParameter("ctrladministrator_id", ccsInteger, "", "", $this->administrator_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["registration_no"]->GetValue()) and !strlen($this->cp["registration_no"]->GetText()) and !is_bool($this->cp["registration_no"]->GetValue())) 
            $this->cp["registration_no"]->SetValue($this->registration_no->GetValue(true));
        if (!is_null($this->cp["jenis_perolehan_hak"]->GetValue()) and !strlen($this->cp["jenis_perolehan_hak"]->GetText()) and !is_bool($this->cp["jenis_perolehan_hak"]->GetValue())) 
            $this->cp["jenis_perolehan_hak"]->SetValue($this->jenis_perolehan_hak->GetValue(true));
        if (!is_null($this->cp["wp_name"]->GetValue()) and !strlen($this->cp["wp_name"]->GetText()) and !is_bool($this->cp["wp_name"]->GetValue())) 
            $this->cp["wp_name"]->SetValue($this->wp_name->GetValue(true));
        if (!is_null($this->cp["npwp"]->GetValue()) and !strlen($this->cp["npwp"]->GetText()) and !is_bool($this->cp["npwp"]->GetValue())) 
            $this->cp["npwp"]->SetValue($this->npwp->GetValue(true));
        if (!is_null($this->cp["wp_address_name"]->GetValue()) and !strlen($this->cp["wp_address_name"]->GetText()) and !is_bool($this->cp["wp_address_name"]->GetValue())) 
            $this->cp["wp_address_name"]->SetValue($this->wp_address_name->GetValue(true));
        if (!is_null($this->cp["wp_rt"]->GetValue()) and !strlen($this->cp["wp_rt"]->GetText()) and !is_bool($this->cp["wp_rt"]->GetValue())) 
            $this->cp["wp_rt"]->SetValue($this->wp_rt->GetValue(true));
        if (!is_null($this->cp["wp_rw"]->GetValue()) and !strlen($this->cp["wp_rw"]->GetText()) and !is_bool($this->cp["wp_rw"]->GetValue())) 
            $this->cp["wp_rw"]->SetValue($this->wp_rw->GetValue(true));
        if (!is_null($this->cp["wp_p_region_id"]->GetValue()) and !strlen($this->cp["wp_p_region_id"]->GetText()) and !is_bool($this->cp["wp_p_region_id"]->GetValue())) 
            $this->cp["wp_p_region_id"]->SetValue($this->wp_p_region_id->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id"]->GetText()) and !is_bool($this->cp["wp_p_region_id"]->GetValue(true))) 
            $this->cp["wp_p_region_id"]->SetText(0);
        if (!is_null($this->cp["wp_p_region_id_kec"]->GetValue()) and !strlen($this->cp["wp_p_region_id_kec"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kec"]->GetValue())) 
            $this->cp["wp_p_region_id_kec"]->SetValue($this->wp_p_region_id_kec->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id_kec"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kec"]->GetValue(true))) 
            $this->cp["wp_p_region_id_kec"]->SetText(0);
        if (!is_null($this->cp["wp_p_region_id_kel"]->GetValue()) and !strlen($this->cp["wp_p_region_id_kel"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kel"]->GetValue())) 
            $this->cp["wp_p_region_id_kel"]->SetValue($this->wp_p_region_id_kel->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id_kel"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kel"]->GetValue(true))) 
            $this->cp["wp_p_region_id_kel"]->SetText(0);
        if (!is_null($this->cp["phone_no"]->GetValue()) and !strlen($this->cp["phone_no"]->GetText()) and !is_bool($this->cp["phone_no"]->GetValue())) 
            $this->cp["phone_no"]->SetValue($this->phone_no->GetValue(true));
        if (!is_null($this->cp["mobile_phone_no"]->GetValue()) and !strlen($this->cp["mobile_phone_no"]->GetText()) and !is_bool($this->cp["mobile_phone_no"]->GetValue())) 
            $this->cp["mobile_phone_no"]->SetValue($this->mobile_phone_no->GetValue(true));
        if (!is_null($this->cp["njop_pbb"]->GetValue()) and !strlen($this->cp["njop_pbb"]->GetText()) and !is_bool($this->cp["njop_pbb"]->GetValue())) 
            $this->cp["njop_pbb"]->SetValue($this->njop_pbb->GetValue(true));
        if (!is_null($this->cp["object_address_name"]->GetValue()) and !strlen($this->cp["object_address_name"]->GetText()) and !is_bool($this->cp["object_address_name"]->GetValue())) 
            $this->cp["object_address_name"]->SetValue($this->object_address_name->GetValue(true));
        if (!is_null($this->cp["object_rt"]->GetValue()) and !strlen($this->cp["object_rt"]->GetText()) and !is_bool($this->cp["object_rt"]->GetValue())) 
            $this->cp["object_rt"]->SetValue($this->object_rt->GetValue(true));
        if (!is_null($this->cp["object_rw"]->GetValue()) and !strlen($this->cp["object_rw"]->GetText()) and !is_bool($this->cp["object_rw"]->GetValue())) 
            $this->cp["object_rw"]->SetValue($this->object_rw->GetValue(true));
        if (!is_null($this->cp["object_p_region_id"]->GetValue()) and !strlen($this->cp["object_p_region_id"]->GetText()) and !is_bool($this->cp["object_p_region_id"]->GetValue())) 
            $this->cp["object_p_region_id"]->SetValue($this->object_p_region_id->GetValue(true));
        if (!strlen($this->cp["object_p_region_id"]->GetText()) and !is_bool($this->cp["object_p_region_id"]->GetValue(true))) 
            $this->cp["object_p_region_id"]->SetText(0);
        if (!is_null($this->cp["object_p_region_id_kec"]->GetValue()) and !strlen($this->cp["object_p_region_id_kec"]->GetText()) and !is_bool($this->cp["object_p_region_id_kec"]->GetValue())) 
            $this->cp["object_p_region_id_kec"]->SetValue($this->object_p_region_id_kec->GetValue(true));
        if (!strlen($this->cp["object_p_region_id_kec"]->GetText()) and !is_bool($this->cp["object_p_region_id_kec"]->GetValue(true))) 
            $this->cp["object_p_region_id_kec"]->SetText(0);
        if (!is_null($this->cp["object_p_region_id_kel"]->GetValue()) and !strlen($this->cp["object_p_region_id_kel"]->GetText()) and !is_bool($this->cp["object_p_region_id_kel"]->GetValue())) 
            $this->cp["object_p_region_id_kel"]->SetValue($this->object_p_region_id_kel->GetValue(true));
        if (!strlen($this->cp["object_p_region_id_kel"]->GetText()) and !is_bool($this->cp["object_p_region_id_kel"]->GetValue(true))) 
            $this->cp["object_p_region_id_kel"]->SetText(0);
        if (!is_null($this->cp["tgl_masuk"]->GetValue()) and !strlen($this->cp["tgl_masuk"]->GetText()) and !is_bool($this->cp["tgl_masuk"]->GetValue())) 
            $this->cp["tgl_masuk"]->SetValue($this->tgl_masuk->GetValue(true));
        if (!is_null($this->cp["nilai_njop"]->GetValue()) and !strlen($this->cp["nilai_njop"]->GetText()) and !is_bool($this->cp["nilai_njop"]->GetValue())) 
            $this->cp["nilai_njop"]->SetValue($this->nilai_njop->GetValue(true));
        if (!strlen($this->cp["nilai_njop"]->GetText()) and !is_bool($this->cp["nilai_njop"]->GetValue(true))) 
            $this->cp["nilai_njop"]->SetText(0);
        if (!is_null($this->cp["harga_transaksi"]->GetValue()) and !strlen($this->cp["harga_transaksi"]->GetText()) and !is_bool($this->cp["harga_transaksi"]->GetValue())) 
            $this->cp["harga_transaksi"]->SetValue($this->harga_transaksi->GetValue(true));
        if (!strlen($this->cp["harga_transaksi"]->GetText()) and !is_bool($this->cp["harga_transaksi"]->GetValue(true))) 
            $this->cp["harga_transaksi"]->SetText(0);
        if (!is_null($this->cp["jumlah_disetor"]->GetValue()) and !strlen($this->cp["jumlah_disetor"]->GetText()) and !is_bool($this->cp["jumlah_disetor"]->GetValue())) 
            $this->cp["jumlah_disetor"]->SetValue($this->jumlah_disetor->GetValue(true));
        if (!strlen($this->cp["jumlah_disetor"]->GetText()) and !is_bool($this->cp["jumlah_disetor"]->GetValue(true))) 
            $this->cp["jumlah_disetor"]->SetText(0);
        if (!is_null($this->cp["creation_date"]->GetValue()) and !strlen($this->cp["creation_date"]->GetText()) and !is_bool($this->cp["creation_date"]->GetValue())) 
            $this->cp["creation_date"]->SetValue($this->creation_date->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue($this->created_by->GetValue(true));
        if (!is_null($this->cp["updated_date"]->GetValue()) and !strlen($this->cp["updated_date"]->GetText()) and !is_bool($this->cp["updated_date"]->GetValue())) 
            $this->cp["updated_date"]->SetValue($this->updated_date->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue($this->updated_by->GetValue(true));
        if (!is_null($this->cp["administrator_id"]->GetValue()) and !strlen($this->cp["administrator_id"]->GetText()) and !is_bool($this->cp["administrator_id"]->GetValue())) 
            $this->cp["administrator_id"]->SetValue($this->administrator_id->GetValue(true));
        if (!strlen($this->cp["administrator_id"]->GetText()) and !is_bool($this->cp["administrator_id"]->GetValue(true))) 
            $this->cp["administrator_id"]->SetText(0);
        $this->SQL = "INSERT INTO t_bphtb_lembar_kendali\n" .
        "(registration_no, jenis_perolehan_hak, wp_name, npwp, wp_address_name, wp_rt, wp_rw, wp_p_region_id, wp_p_region_id_kec, wp_p_region_id_kel,\n" .
        "phone_no, mobile_phone_no, njop_pbb, object_address_name, object_rt, object_rw, object_p_region_id, object_p_region_id_kec,\n" .
        "object_p_region_id_kel, tgl_masuk, nilai_njop, harga_transaksi, jumlah_disetor, administrator_id, creation_date, created_by, updated_date, \n" .
        "updated_by)\n" .
        "VALUES('" . $this->SQLValue($this->cp["registration_no"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["jenis_perolehan_hak"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["wp_name"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["npwp"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["wp_address_name"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["wp_rt"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["wp_rw"]->GetDBValue(), ccsText) . "'," . $this->SQLValue($this->cp["wp_p_region_id"]->GetDBValue(), ccsFloat) . "," . $this->SQLValue($this->cp["wp_p_region_id_kec"]->GetDBValue(), ccsFloat) . "," . $this->SQLValue($this->cp["wp_p_region_id_kel"]->GetDBValue(), ccsFloat) . ",\n" .
        "'" . $this->SQLValue($this->cp["phone_no"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["mobile_phone_no"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["njop_pbb"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["object_address_name"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["object_rt"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["object_rw"]->GetDBValue(), ccsText) . "'," . $this->SQLValue($this->cp["object_p_region_id"]->GetDBValue(), ccsFloat) . "," . $this->SQLValue($this->cp["object_p_region_id_kec"]->GetDBValue(), ccsFloat) . ",\n" .
        "" . $this->SQLValue($this->cp["object_p_region_id_kel"]->GetDBValue(), ccsFloat) . ",'" . $this->SQLValue($this->cp["tgl_masuk"]->GetDBValue(), ccsText) . "'," . $this->SQLValue($this->cp["nilai_njop"]->GetDBValue(), ccsFloat) . "," . $this->SQLValue($this->cp["harga_transaksi"]->GetDBValue(), ccsFloat) . "," . $this->SQLValue($this->cp["jumlah_disetor"]->GetDBValue(), ccsFloat) . "," . $this->SQLValue($this->cp["administrator_id"]->GetDBValue(), ccsInteger) . ", '" . $this->SQLValue($this->cp["creation_date"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["updated_date"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-4C68A0CB
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["jenis_perolehan_hak"] = new clsSQLParameter("ctrljenis_perolehan_hak", ccsText, "", "", $this->jenis_perolehan_hak->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_name"] = new clsSQLParameter("ctrlwp_name", ccsText, "", "", $this->wp_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["npwp"] = new clsSQLParameter("ctrlnpwp", ccsText, "", "", $this->npwp->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_address_name"] = new clsSQLParameter("ctrlwp_address_name", ccsText, "", "", $this->wp_address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_rt"] = new clsSQLParameter("ctrlwp_rt", ccsText, "", "", $this->wp_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_rw"] = new clsSQLParameter("ctrlwp_rw", ccsText, "", "", $this->wp_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_p_region_id"] = new clsSQLParameter("ctrlwp_p_region_id", ccsFloat, "", "", $this->wp_p_region_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kec"] = new clsSQLParameter("ctrlwp_p_region_id_kec", ccsFloat, "", "", $this->wp_p_region_id_kec->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kel"] = new clsSQLParameter("ctrlwp_p_region_id_kel", ccsFloat, "", "", $this->wp_p_region_id_kel->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["phone_no"] = new clsSQLParameter("ctrlphone_no", ccsText, "", "", $this->phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobile_phone_no"] = new clsSQLParameter("ctrlmobile_phone_no", ccsText, "", "", $this->mobile_phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["njop_pbb"] = new clsSQLParameter("ctrlnjop_pbb", ccsText, "", "", $this->njop_pbb->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["object_address_name"] = new clsSQLParameter("ctrlobject_address_name", ccsText, "", "", $this->object_address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["object_rt"] = new clsSQLParameter("ctrlobject_rt", ccsText, "", "", $this->object_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["object_rw"] = new clsSQLParameter("ctrlobject_rw", ccsText, "", "", $this->object_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["object_p_region_id"] = new clsSQLParameter("ctrlobject_p_region_id", ccsFloat, "", "", $this->object_p_region_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["object_p_region_id_kec"] = new clsSQLParameter("ctrlobject_p_region_id_kec", ccsFloat, "", "", $this->object_p_region_id_kec->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["object_p_region_id_kel"] = new clsSQLParameter("ctrlobject_p_region_id_kel", ccsFloat, "", "", $this->object_p_region_id_kel->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["tgl_masuk"] = new clsSQLParameter("ctrltgl_masuk", ccsText, "", "", $this->tgl_masuk->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["nilai_njop"] = new clsSQLParameter("ctrlnilai_njop", ccsFloat, "", "", $this->nilai_njop->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["harga_transaksi"] = new clsSQLParameter("ctrlharga_transaksi", ccsFloat, "", "", $this->harga_transaksi->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["jumlah_disetor"] = new clsSQLParameter("ctrljumlah_disetor", ccsFloat, "", "", $this->jumlah_disetor->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["updated_date"] = new clsSQLParameter("ctrlupdated_date", ccsText, "", "", $this->updated_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("ctrlupdated_by", ccsText, "", "", $this->updated_by->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_bphtb_lembar_kendali_id"] = new clsSQLParameter("ctrlt_bphtb_lembar_kendali_id", ccsFloat, "", "", $this->t_bphtb_lembar_kendali_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["registration_no"] = new clsSQLParameter("ctrlregistration_no", ccsText, "", "", $this->registration_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["administrator_id"] = new clsSQLParameter("ctrladministrator_id", ccsInteger, "", "", $this->administrator_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["jenis_perolehan_hak"]->GetValue()) and !strlen($this->cp["jenis_perolehan_hak"]->GetText()) and !is_bool($this->cp["jenis_perolehan_hak"]->GetValue())) 
            $this->cp["jenis_perolehan_hak"]->SetValue($this->jenis_perolehan_hak->GetValue(true));
        if (!is_null($this->cp["wp_name"]->GetValue()) and !strlen($this->cp["wp_name"]->GetText()) and !is_bool($this->cp["wp_name"]->GetValue())) 
            $this->cp["wp_name"]->SetValue($this->wp_name->GetValue(true));
        if (!is_null($this->cp["npwp"]->GetValue()) and !strlen($this->cp["npwp"]->GetText()) and !is_bool($this->cp["npwp"]->GetValue())) 
            $this->cp["npwp"]->SetValue($this->npwp->GetValue(true));
        if (!is_null($this->cp["wp_address_name"]->GetValue()) and !strlen($this->cp["wp_address_name"]->GetText()) and !is_bool($this->cp["wp_address_name"]->GetValue())) 
            $this->cp["wp_address_name"]->SetValue($this->wp_address_name->GetValue(true));
        if (!is_null($this->cp["wp_rt"]->GetValue()) and !strlen($this->cp["wp_rt"]->GetText()) and !is_bool($this->cp["wp_rt"]->GetValue())) 
            $this->cp["wp_rt"]->SetValue($this->wp_rt->GetValue(true));
        if (!is_null($this->cp["wp_rw"]->GetValue()) and !strlen($this->cp["wp_rw"]->GetText()) and !is_bool($this->cp["wp_rw"]->GetValue())) 
            $this->cp["wp_rw"]->SetValue($this->wp_rw->GetValue(true));
        if (!is_null($this->cp["wp_p_region_id"]->GetValue()) and !strlen($this->cp["wp_p_region_id"]->GetText()) and !is_bool($this->cp["wp_p_region_id"]->GetValue())) 
            $this->cp["wp_p_region_id"]->SetValue($this->wp_p_region_id->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id"]->GetText()) and !is_bool($this->cp["wp_p_region_id"]->GetValue(true))) 
            $this->cp["wp_p_region_id"]->SetText(0);
        if (!is_null($this->cp["wp_p_region_id_kec"]->GetValue()) and !strlen($this->cp["wp_p_region_id_kec"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kec"]->GetValue())) 
            $this->cp["wp_p_region_id_kec"]->SetValue($this->wp_p_region_id_kec->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id_kec"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kec"]->GetValue(true))) 
            $this->cp["wp_p_region_id_kec"]->SetText(0);
        if (!is_null($this->cp["wp_p_region_id_kel"]->GetValue()) and !strlen($this->cp["wp_p_region_id_kel"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kel"]->GetValue())) 
            $this->cp["wp_p_region_id_kel"]->SetValue($this->wp_p_region_id_kel->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id_kel"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kel"]->GetValue(true))) 
            $this->cp["wp_p_region_id_kel"]->SetText(0);
        if (!is_null($this->cp["phone_no"]->GetValue()) and !strlen($this->cp["phone_no"]->GetText()) and !is_bool($this->cp["phone_no"]->GetValue())) 
            $this->cp["phone_no"]->SetValue($this->phone_no->GetValue(true));
        if (!is_null($this->cp["mobile_phone_no"]->GetValue()) and !strlen($this->cp["mobile_phone_no"]->GetText()) and !is_bool($this->cp["mobile_phone_no"]->GetValue())) 
            $this->cp["mobile_phone_no"]->SetValue($this->mobile_phone_no->GetValue(true));
        if (!is_null($this->cp["njop_pbb"]->GetValue()) and !strlen($this->cp["njop_pbb"]->GetText()) and !is_bool($this->cp["njop_pbb"]->GetValue())) 
            $this->cp["njop_pbb"]->SetValue($this->njop_pbb->GetValue(true));
        if (!is_null($this->cp["object_address_name"]->GetValue()) and !strlen($this->cp["object_address_name"]->GetText()) and !is_bool($this->cp["object_address_name"]->GetValue())) 
            $this->cp["object_address_name"]->SetValue($this->object_address_name->GetValue(true));
        if (!is_null($this->cp["object_rt"]->GetValue()) and !strlen($this->cp["object_rt"]->GetText()) and !is_bool($this->cp["object_rt"]->GetValue())) 
            $this->cp["object_rt"]->SetValue($this->object_rt->GetValue(true));
        if (!is_null($this->cp["object_rw"]->GetValue()) and !strlen($this->cp["object_rw"]->GetText()) and !is_bool($this->cp["object_rw"]->GetValue())) 
            $this->cp["object_rw"]->SetValue($this->object_rw->GetValue(true));
        if (!is_null($this->cp["object_p_region_id"]->GetValue()) and !strlen($this->cp["object_p_region_id"]->GetText()) and !is_bool($this->cp["object_p_region_id"]->GetValue())) 
            $this->cp["object_p_region_id"]->SetValue($this->object_p_region_id->GetValue(true));
        if (!strlen($this->cp["object_p_region_id"]->GetText()) and !is_bool($this->cp["object_p_region_id"]->GetValue(true))) 
            $this->cp["object_p_region_id"]->SetText(0);
        if (!is_null($this->cp["object_p_region_id_kec"]->GetValue()) and !strlen($this->cp["object_p_region_id_kec"]->GetText()) and !is_bool($this->cp["object_p_region_id_kec"]->GetValue())) 
            $this->cp["object_p_region_id_kec"]->SetValue($this->object_p_region_id_kec->GetValue(true));
        if (!strlen($this->cp["object_p_region_id_kec"]->GetText()) and !is_bool($this->cp["object_p_region_id_kec"]->GetValue(true))) 
            $this->cp["object_p_region_id_kec"]->SetText(0);
        if (!is_null($this->cp["object_p_region_id_kel"]->GetValue()) and !strlen($this->cp["object_p_region_id_kel"]->GetText()) and !is_bool($this->cp["object_p_region_id_kel"]->GetValue())) 
            $this->cp["object_p_region_id_kel"]->SetValue($this->object_p_region_id_kel->GetValue(true));
        if (!strlen($this->cp["object_p_region_id_kel"]->GetText()) and !is_bool($this->cp["object_p_region_id_kel"]->GetValue(true))) 
            $this->cp["object_p_region_id_kel"]->SetText(0);
        if (!is_null($this->cp["tgl_masuk"]->GetValue()) and !strlen($this->cp["tgl_masuk"]->GetText()) and !is_bool($this->cp["tgl_masuk"]->GetValue())) 
            $this->cp["tgl_masuk"]->SetValue($this->tgl_masuk->GetValue(true));
        if (!is_null($this->cp["nilai_njop"]->GetValue()) and !strlen($this->cp["nilai_njop"]->GetText()) and !is_bool($this->cp["nilai_njop"]->GetValue())) 
            $this->cp["nilai_njop"]->SetValue($this->nilai_njop->GetValue(true));
        if (!strlen($this->cp["nilai_njop"]->GetText()) and !is_bool($this->cp["nilai_njop"]->GetValue(true))) 
            $this->cp["nilai_njop"]->SetText(0);
        if (!is_null($this->cp["harga_transaksi"]->GetValue()) and !strlen($this->cp["harga_transaksi"]->GetText()) and !is_bool($this->cp["harga_transaksi"]->GetValue())) 
            $this->cp["harga_transaksi"]->SetValue($this->harga_transaksi->GetValue(true));
        if (!strlen($this->cp["harga_transaksi"]->GetText()) and !is_bool($this->cp["harga_transaksi"]->GetValue(true))) 
            $this->cp["harga_transaksi"]->SetText(0);
        if (!is_null($this->cp["jumlah_disetor"]->GetValue()) and !strlen($this->cp["jumlah_disetor"]->GetText()) and !is_bool($this->cp["jumlah_disetor"]->GetValue())) 
            $this->cp["jumlah_disetor"]->SetValue($this->jumlah_disetor->GetValue(true));
        if (!strlen($this->cp["jumlah_disetor"]->GetText()) and !is_bool($this->cp["jumlah_disetor"]->GetValue(true))) 
            $this->cp["jumlah_disetor"]->SetText(0);
        if (!is_null($this->cp["updated_date"]->GetValue()) and !strlen($this->cp["updated_date"]->GetText()) and !is_bool($this->cp["updated_date"]->GetValue())) 
            $this->cp["updated_date"]->SetValue($this->updated_date->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue($this->updated_by->GetValue(true));
        if (!is_null($this->cp["t_bphtb_lembar_kendali_id"]->GetValue()) and !strlen($this->cp["t_bphtb_lembar_kendali_id"]->GetText()) and !is_bool($this->cp["t_bphtb_lembar_kendali_id"]->GetValue())) 
            $this->cp["t_bphtb_lembar_kendali_id"]->SetValue($this->t_bphtb_lembar_kendali_id->GetValue(true));
        if (!strlen($this->cp["t_bphtb_lembar_kendali_id"]->GetText()) and !is_bool($this->cp["t_bphtb_lembar_kendali_id"]->GetValue(true))) 
            $this->cp["t_bphtb_lembar_kendali_id"]->SetText(0);
        if (!is_null($this->cp["registration_no"]->GetValue()) and !strlen($this->cp["registration_no"]->GetText()) and !is_bool($this->cp["registration_no"]->GetValue())) 
            $this->cp["registration_no"]->SetValue($this->registration_no->GetValue(true));
        if (!is_null($this->cp["administrator_id"]->GetValue()) and !strlen($this->cp["administrator_id"]->GetText()) and !is_bool($this->cp["administrator_id"]->GetValue())) 
            $this->cp["administrator_id"]->SetValue($this->administrator_id->GetValue(true));
        if (!strlen($this->cp["administrator_id"]->GetText()) and !is_bool($this->cp["administrator_id"]->GetValue(true))) 
            $this->cp["administrator_id"]->SetText(0);
        $this->SQL = "UPDATE t_bphtb_lembar_kendali\n" .
        "SET registration_no = '" . $this->SQLValue($this->cp["registration_no"]->GetDBValue(), ccsText) . "',\n" .
        "jenis_perolehan_hak = '" . $this->SQLValue($this->cp["jenis_perolehan_hak"]->GetDBValue(), ccsText) . "',\n" .
        "wp_name = '" . $this->SQLValue($this->cp["wp_name"]->GetDBValue(), ccsText) . "',\n" .
        "npwp = '" . $this->SQLValue($this->cp["npwp"]->GetDBValue(), ccsText) . "',\n" .
        "wp_address_name = '" . $this->SQLValue($this->cp["wp_address_name"]->GetDBValue(), ccsText) . "',\n" .
        "wp_rt = '" . $this->SQLValue($this->cp["wp_rt"]->GetDBValue(), ccsText) . "',\n" .
        "wp_rw = '" . $this->SQLValue($this->cp["wp_rw"]->GetDBValue(), ccsText) . "',\n" .
        "wp_p_region_id = " . $this->SQLValue($this->cp["wp_p_region_id"]->GetDBValue(), ccsFloat) . ",\n" .
        "wp_p_region_id_kec = " . $this->SQLValue($this->cp["wp_p_region_id_kec"]->GetDBValue(), ccsFloat) . ",\n" .
        "wp_p_region_id_kel = " . $this->SQLValue($this->cp["wp_p_region_id_kel"]->GetDBValue(), ccsFloat) . ",\n" .
        "phone_no = '" . $this->SQLValue($this->cp["phone_no"]->GetDBValue(), ccsText) . "',\n" .
        "mobile_phone_no = '" . $this->SQLValue($this->cp["mobile_phone_no"]->GetDBValue(), ccsText) . "',\n" .
        "njop_pbb = '" . $this->SQLValue($this->cp["njop_pbb"]->GetDBValue(), ccsText) . "',\n" .
        "object_address_name = '" . $this->SQLValue($this->cp["object_address_name"]->GetDBValue(), ccsText) . "',\n" .
        "object_rt = '" . $this->SQLValue($this->cp["object_rt"]->GetDBValue(), ccsText) . "',\n" .
        "object_rw = '" . $this->SQLValue($this->cp["object_rw"]->GetDBValue(), ccsText) . "',\n" .
        "object_p_region_id = " . $this->SQLValue($this->cp["object_p_region_id"]->GetDBValue(), ccsFloat) . ",\n" .
        "object_p_region_id_kec = " . $this->SQLValue($this->cp["object_p_region_id_kec"]->GetDBValue(), ccsFloat) . ",\n" .
        "object_p_region_id_kel = " . $this->SQLValue($this->cp["object_p_region_id_kel"]->GetDBValue(), ccsFloat) . ",\n" .
        "tgl_masuk = '" . $this->SQLValue($this->cp["tgl_masuk"]->GetDBValue(), ccsText) . "',\n" .
        "nilai_njop = " . $this->SQLValue($this->cp["nilai_njop"]->GetDBValue(), ccsFloat) . ",\n" .
        "harga_transaksi = " . $this->SQLValue($this->cp["harga_transaksi"]->GetDBValue(), ccsFloat) . ",\n" .
        "jumlah_disetor = " . $this->SQLValue($this->cp["jumlah_disetor"]->GetDBValue(), ccsFloat) . ",\n" .
        "administrator_id = " . $this->SQLValue($this->cp["administrator_id"]->GetDBValue(), ccsInteger) . ",\n" .
        "updated_date = '" . $this->SQLValue($this->cp["updated_date"]->GetDBValue(), ccsText) . "',\n" .
        "updated_by = '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "'\n" .
        "WHERE t_bphtb_lembar_kendali_id = " . $this->SQLValue($this->cp["t_bphtb_lembar_kendali_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-A8B7759E
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_bphtb_lembar_kendali_id"] = new clsSQLParameter("urlt_bphtb_lembar_kendali_id", ccsFloat, "", "", CCGetFromGet("t_bphtb_lembar_kendali_id", NULL), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_bphtb_lembar_kendali_id"]->GetValue()) and !strlen($this->cp["t_bphtb_lembar_kendali_id"]->GetText()) and !is_bool($this->cp["t_bphtb_lembar_kendali_id"]->GetValue())) 
            $this->cp["t_bphtb_lembar_kendali_id"]->SetText(CCGetFromGet("t_bphtb_lembar_kendali_id", NULL));
        if (!strlen($this->cp["t_bphtb_lembar_kendali_id"]->GetText()) and !is_bool($this->cp["t_bphtb_lembar_kendali_id"]->GetValue(true))) 
            $this->cp["t_bphtb_lembar_kendali_id"]->SetText(0);
        $this->SQL = "DELETE FROM t_bphtb_lembar_kendali WHERE  t_bphtb_lembar_kendali_id = " . $this->SQLValue($this->cp["t_bphtb_lembar_kendali_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_ppatFormDataSource Class @23-FCB6E20C

//Initialize Page @1-3D3E65B5
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
$TemplateFileName = "t_bphtb_lembar_kendali.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-07CFD079
include_once("./t_bphtb_lembar_kendali_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-B0E09770
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_ppatGrid = & new clsGridt_ppatGrid("", $MainPage);
$t_ppatSearch = & new clsRecordt_ppatSearch("", $MainPage);
$t_ppatForm = & new clsRecordt_ppatForm("", $MainPage);
$MainPage->t_ppatGrid = & $t_ppatGrid;
$MainPage->t_ppatSearch = & $t_ppatSearch;
$MainPage->t_ppatForm = & $t_ppatForm;
$t_ppatGrid->Initialize();
$t_ppatForm->Initialize();

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

//Execute Components @1-DB2756D4
$t_ppatSearch->Operation();
$t_ppatForm->Operation();
//End Execute Components

//Go to destination page @1-935B974D
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_ppatGrid);
    unset($t_ppatSearch);
    unset($t_ppatForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D6A164F7
$t_ppatGrid->Show();
$t_ppatSearch->Show();
$t_ppatForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5C8D22EA
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_ppatGrid);
unset($t_ppatSearch);
unset($t_ppatForm);
unset($Tpl);
//End Unload Page


?>
