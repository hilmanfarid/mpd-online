<?php
//Include Common Files @1-D8049E9E
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_ppat.php");
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

//Class_Initialize Event @2-7E37488D
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
        $this->DLink->Page = "t_ppat.php";
        $this->ppat_name = & new clsControl(ccsLabel, "ppat_name", "ppat_name", ccsText, "", CCGetRequestParam("ppat_name", ccsGet, NULL), $this);
        $this->t_ppat_id = & new clsControl(ccsHidden, "t_ppat_id", "t_ppat_id", ccsFloat, "", CCGetRequestParam("t_ppat_id", ccsGet, NULL), $this);
        $this->identification_no = & new clsControl(ccsLabel, "identification_no", "identification_no", ccsText, "", CCGetRequestParam("identification_no", ccsGet, NULL), $this);
        $this->updated_by = & new clsControl(ccsLabel, "updated_by", "updated_by", ccsText, "", CCGetRequestParam("updated_by", ccsGet, NULL), $this);
        $this->address_name = & new clsControl(ccsLabel, "address_name", "address_name", ccsText, "", CCGetRequestParam("address_name", ccsGet, NULL), $this);
        $this->updated_date = & new clsControl(ccsLabel, "updated_date", "updated_date", ccsText, "", CCGetRequestParam("updated_date", ccsGet, NULL), $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "t_ppat_user.php";
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "t_ppat.php";
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

//Show Method @2-DB414DF0
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
            $this->ControlsVisible["ppat_name"] = $this->ppat_name->Visible;
            $this->ControlsVisible["t_ppat_id"] = $this->t_ppat_id->Visible;
            $this->ControlsVisible["identification_no"] = $this->identification_no->Visible;
            $this->ControlsVisible["updated_by"] = $this->updated_by->Visible;
            $this->ControlsVisible["address_name"] = $this->address_name->Visible;
            $this->ControlsVisible["updated_date"] = $this->updated_date->Visible;
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_ppat_id", $this->DataSource->f("t_ppat_id"));
                $this->ppat_name->SetValue($this->DataSource->ppat_name->GetValue());
                $this->t_ppat_id->SetValue($this->DataSource->t_ppat_id->GetValue());
                $this->identification_no->SetValue($this->DataSource->identification_no->GetValue());
                $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                $this->address_name->SetValue($this->DataSource->address_name->GetValue());
                $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("s_keyword", "t_ppatGridPage", "ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "t_ppat_id", $this->DataSource->f("t_ppat_id"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "ppat_name", $this->DataSource->f("ppat_name"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "email_address", $this->DataSource->f("email_address"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->ppat_name->Show();
                $this->t_ppat_id->Show();
                $this->identification_no->Show();
                $this->updated_by->Show();
                $this->address_name->Show();
                $this->updated_date->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("t_ppat_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-88F34C59
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ppat_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_ppat_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->identification_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->updated_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->address_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->updated_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_ppatGrid Class @2-FCB6E20C

class clst_ppatGridDataSource extends clsDBConnSIKP {  //t_ppatGridDataSource Class @2-A64414CC

//DataSource Variables @2-21E6C8AA
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $ppat_name;
    var $t_ppat_id;
    var $identification_no;
    var $updated_by;
    var $address_name;
    var $updated_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-09D9E963
    function clst_ppatGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_ppatGrid";
        $this->Initialize();
        $this->ppat_name = new clsField("ppat_name", ccsText, "");
        
        $this->t_ppat_id = new clsField("t_ppat_id", ccsFloat, "");
        
        $this->identification_no = new clsField("identification_no", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->address_name = new clsField("address_name", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-AB04106E
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "t_ppat_id";
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

//Open Method @2-76FCCA98
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT t_ppat_id, ppat_name, identification_no, address_name,updated_by, \n" .
        "to_char(updated_date,'DD-MON-YYYY') AS updated_date, email_address\n" .
        "FROM t_ppat\n" .
        "WHERE upper(identification_no) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(ppat_name) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') cnt";
        $this->SQL = "SELECT t_ppat_id, ppat_name, identification_no, address_name,updated_by, \n" .
        "to_char(updated_date,'DD-MON-YYYY') AS updated_date, email_address\n" .
        "FROM t_ppat\n" .
        "WHERE upper(identification_no) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(ppat_name) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'  {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-B545573C
    function SetValues()
    {
        $this->ppat_name->SetDBValue($this->f("ppat_name"));
        $this->t_ppat_id->SetDBValue(trim($this->f("t_ppat_id")));
        $this->identification_no->SetDBValue($this->f("identification_no"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->address_name->SetDBValue($this->f("address_name"));
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

//Operation Method @3-DE8ED2BE
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
        $Redirect = "t_ppat.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_ppat.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

//Class_Initialize Event @23-B81AAF23
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
            $this->t_ppat_id = & new clsControl(ccsHidden, "t_ppat_id", "Id", ccsFloat, "", CCGetRequestParam("t_ppat_id", $Method, NULL), $this);
            $this->phone_no = & new clsControl(ccsTextBox, "phone_no", "Description", ccsText, "", CCGetRequestParam("phone_no", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->ppat_name = & new clsControl(ccsTextBox, "ppat_name", "Kode", ccsText, "", CCGetRequestParam("ppat_name", $Method, NULL), $this);
            $this->ppat_name->Required = true;
            $this->address_name = & new clsControl(ccsTextBox, "address_name", "alamat lokasi", ccsText, "", CCGetRequestParam("address_name", $Method, NULL), $this);
            $this->address_name->Required = true;
            $this->address_no = & new clsControl(ccsTextBox, "address_no", "no lokasi", ccsText, "", CCGetRequestParam("address_no", $Method, NULL), $this);
            $this->address_no->Required = true;
            $this->address_rt = & new clsControl(ccsTextBox, "address_rt", "Description", ccsText, "", CCGetRequestParam("address_rt", $Method, NULL), $this);
            $this->address_rw = & new clsControl(ccsTextBox, "address_rw", "Description", ccsText, "", CCGetRequestParam("address_rw", $Method, NULL), $this);
            $this->kota = & new clsControl(ccsTextBox, "kota", "Kota/Kabupaten - WP", ccsText, "", CCGetRequestParam("kota", $Method, NULL), $this);
            $this->kota->Required = true;
            $this->p_region_id = & new clsControl(ccsHidden, "p_region_id", "Kota/Kabupaten - WP", ccsFloat, "", CCGetRequestParam("p_region_id", $Method, NULL), $this);
            $this->p_region_id->Required = true;
            $this->kecamatan = & new clsControl(ccsTextBox, "kecamatan", "Kecamatan - WP", ccsText, "", CCGetRequestParam("kecamatan", $Method, NULL), $this);
            $this->kecamatan->Required = true;
            $this->p_region_id_kec = & new clsControl(ccsHidden, "p_region_id_kec", "Kecamatan - WP", ccsFloat, "", CCGetRequestParam("p_region_id_kec", $Method, NULL), $this);
            $this->p_region_id_kec->Required = true;
            $this->kelurahan = & new clsControl(ccsTextBox, "kelurahan", "Kelurahan - WP", ccsText, "", CCGetRequestParam("kelurahan", $Method, NULL), $this);
            $this->kelurahan->Required = true;
            $this->p_region_id_kel = & new clsControl(ccsHidden, "p_region_id_kel", "Kelurahan - WP", ccsFloat, "", CCGetRequestParam("p_region_id_kel", $Method, NULL), $this);
            $this->p_region_id_kel->Required = true;
            $this->identification_no = & new clsControl(ccsTextBox, "identification_no", "no identifikasi", ccsText, "", CCGetRequestParam("identification_no", $Method, NULL), $this);
            $this->identification_no->Required = true;
            $this->personal_identification_id = & new clsControl(ccsListBox, "personal_identification_id", "no identifikasi", ccsText, "", CCGetRequestParam("personal_identification_id", $Method, NULL), $this);
            $this->personal_identification_id->DSType = dsSQL;
            $this->personal_identification_id->DataSource = new clsDBConnSIKP();
            $this->personal_identification_id->ds = & $this->personal_identification_id->DataSource;
            list($this->personal_identification_id->BoundColumn, $this->personal_identification_id->TextColumn, $this->personal_identification_id->DBFormat) = array("", "", "");
            $this->personal_identification_id->DataSource->SQL = "select p_simple_parameter_list_id,code from p_simple_parameter_list where p_simple_parameter_type_id = 1";
            $this->personal_identification_id->DataSource->Order = "";
            $this->mobile_no = & new clsControl(ccsTextBox, "mobile_no", "No Handphone", ccsText, "", CCGetRequestParam("mobile_no", $Method, NULL), $this);
            $this->mobile_no->Required = true;
            $this->fax_no = & new clsControl(ccsTextBox, "fax_no", "Description", ccsText, "", CCGetRequestParam("fax_no", $Method, NULL), $this);
            $this->zip_code = & new clsControl(ccsTextBox, "zip_code", "Description", ccsText, "", CCGetRequestParam("zip_code", $Method, NULL), $this);
            $this->email_address = & new clsControl(ccsTextBox, "email_address", "Description", ccsText, "", CCGetRequestParam("email_address", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->kota->Value) && !strlen($this->kota->Value) && $this->kota->Value !== false)
                    $this->kota->SetText('KOTA BANDUNG');
                if(!is_array($this->p_region_id->Value) && !strlen($this->p_region_id->Value) && $this->p_region_id->Value !== false)
                    $this->p_region_id->SetText(749);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @23-3EDBD963
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_ppat_id"] = CCGetFromGet("t_ppat_id", NULL);
    }
//End Initialize Method

//Validate Method @23-AC0B97BA
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_ppat_id->Validate() && $Validation);
        $Validation = ($this->phone_no->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->ppat_name->Validate() && $Validation);
        $Validation = ($this->address_name->Validate() && $Validation);
        $Validation = ($this->address_no->Validate() && $Validation);
        $Validation = ($this->address_rt->Validate() && $Validation);
        $Validation = ($this->address_rw->Validate() && $Validation);
        $Validation = ($this->kota->Validate() && $Validation);
        $Validation = ($this->p_region_id->Validate() && $Validation);
        $Validation = ($this->kecamatan->Validate() && $Validation);
        $Validation = ($this->p_region_id_kec->Validate() && $Validation);
        $Validation = ($this->kelurahan->Validate() && $Validation);
        $Validation = ($this->p_region_id_kel->Validate() && $Validation);
        $Validation = ($this->identification_no->Validate() && $Validation);
        $Validation = ($this->personal_identification_id->Validate() && $Validation);
        $Validation = ($this->mobile_no->Validate() && $Validation);
        $Validation = ($this->fax_no->Validate() && $Validation);
        $Validation = ($this->zip_code->Validate() && $Validation);
        $Validation = ($this->email_address->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_ppat_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->phone_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ppat_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_rt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_rw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kota->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_kec->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_kel->Errors->Count() == 0);
        $Validation =  $Validation && ($this->identification_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->personal_identification_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mobile_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fax_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->zip_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->email_address->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-62989A6E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_ppat_id->Errors->Count());
        $errors = ($errors || $this->phone_no->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->ppat_name->Errors->Count());
        $errors = ($errors || $this->address_name->Errors->Count());
        $errors = ($errors || $this->address_no->Errors->Count());
        $errors = ($errors || $this->address_rt->Errors->Count());
        $errors = ($errors || $this->address_rw->Errors->Count());
        $errors = ($errors || $this->kota->Errors->Count());
        $errors = ($errors || $this->p_region_id->Errors->Count());
        $errors = ($errors || $this->kecamatan->Errors->Count());
        $errors = ($errors || $this->p_region_id_kec->Errors->Count());
        $errors = ($errors || $this->kelurahan->Errors->Count());
        $errors = ($errors || $this->p_region_id_kel->Errors->Count());
        $errors = ($errors || $this->identification_no->Errors->Count());
        $errors = ($errors || $this->personal_identification_id->Errors->Count());
        $errors = ($errors || $this->mobile_no->Errors->Count());
        $errors = ($errors || $this->fax_no->Errors->Count());
        $errors = ($errors || $this->zip_code->Errors->Count());
        $errors = ($errors || $this->email_address->Errors->Count());
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

//Operation Method @23-AB2B1752
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
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @23-14687105
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->created_by->SetValue($this->created_by->GetValue(true));
        $this->DataSource->updated_by->SetValue($this->updated_by->GetValue(true));
        $this->DataSource->creation_date->SetValue($this->creation_date->GetValue(true));
        $this->DataSource->updated_date->SetValue($this->updated_date->GetValue(true));
        $this->DataSource->t_ppat_id->SetValue($this->t_ppat_id->GetValue(true));
        $this->DataSource->phone_no->SetValue($this->phone_no->GetValue(true));
        $this->DataSource->ppat_name->SetValue($this->ppat_name->GetValue(true));
        $this->DataSource->address_name->SetValue($this->address_name->GetValue(true));
        $this->DataSource->address_no->SetValue($this->address_no->GetValue(true));
        $this->DataSource->address_rt->SetValue($this->address_rt->GetValue(true));
        $this->DataSource->address_rw->SetValue($this->address_rw->GetValue(true));
        $this->DataSource->p_region_id->SetValue($this->p_region_id->GetValue(true));
        $this->DataSource->p_region_id_kec->SetValue($this->p_region_id_kec->GetValue(true));
        $this->DataSource->p_region_id_kel->SetValue($this->p_region_id_kel->GetValue(true));
        $this->DataSource->identification_no->SetValue($this->identification_no->GetValue(true));
        $this->DataSource->personal_identification_id->SetValue($this->personal_identification_id->GetValue(true));
        $this->DataSource->mobile_no->SetValue($this->mobile_no->GetValue(true));
        $this->DataSource->fax_no->SetValue($this->fax_no->GetValue(true));
        $this->DataSource->zip_code->SetValue($this->zip_code->GetValue(true));
        $this->DataSource->email_address->SetValue($this->email_address->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @23-B962EEF5
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->updated_by->SetValue($this->updated_by->GetValue(true));
        $this->DataSource->phone_no->SetValue($this->phone_no->GetValue(true));
        $this->DataSource->creation_date->SetValue($this->creation_date->GetValue(true));
        $this->DataSource->created_by->SetValue($this->created_by->GetValue(true));
        $this->DataSource->updated_date->SetValue($this->updated_date->GetValue(true));
        $this->DataSource->ppat_name->SetValue($this->ppat_name->GetValue(true));
        $this->DataSource->address_name->SetValue($this->address_name->GetValue(true));
        $this->DataSource->address_no->SetValue($this->address_no->GetValue(true));
        $this->DataSource->address_rt->SetValue($this->address_rt->GetValue(true));
        $this->DataSource->address_rw->SetValue($this->address_rw->GetValue(true));
        $this->DataSource->p_region_id->SetValue($this->p_region_id->GetValue(true));
        $this->DataSource->p_region_id_kec->SetValue($this->p_region_id_kec->GetValue(true));
        $this->DataSource->p_region_id_kel->SetValue($this->p_region_id_kel->GetValue(true));
        $this->DataSource->identification_no->SetValue($this->identification_no->GetValue(true));
        $this->DataSource->personal_identification_id->SetValue($this->personal_identification_id->GetValue(true));
        $this->DataSource->mobile_no->SetValue($this->mobile_no->GetValue(true));
        $this->DataSource->fax_no->SetValue($this->fax_no->GetValue(true));
        $this->DataSource->zip_code->SetValue($this->zip_code->GetValue(true));
        $this->DataSource->email_address->SetValue($this->email_address->GetValue(true));
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

//Show Method @23-85A280DC
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

        $this->personal_identification_id->Prepare();

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
                    $this->t_ppat_id->SetValue($this->DataSource->t_ppat_id->GetValue());
                    $this->phone_no->SetValue($this->DataSource->phone_no->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->ppat_name->SetValue($this->DataSource->ppat_name->GetValue());
                    $this->address_name->SetValue($this->DataSource->address_name->GetValue());
                    $this->address_no->SetValue($this->DataSource->address_no->GetValue());
                    $this->address_rt->SetValue($this->DataSource->address_rt->GetValue());
                    $this->address_rw->SetValue($this->DataSource->address_rw->GetValue());
                    $this->kota->SetValue($this->DataSource->kota->GetValue());
                    $this->p_region_id->SetValue($this->DataSource->p_region_id->GetValue());
                    $this->kecamatan->SetValue($this->DataSource->kecamatan->GetValue());
                    $this->p_region_id_kec->SetValue($this->DataSource->p_region_id_kec->GetValue());
                    $this->kelurahan->SetValue($this->DataSource->kelurahan->GetValue());
                    $this->p_region_id_kel->SetValue($this->DataSource->p_region_id_kel->GetValue());
                    $this->identification_no->SetValue($this->DataSource->identification_no->GetValue());
                    $this->personal_identification_id->SetValue($this->DataSource->personal_identification_id->GetValue());
                    $this->mobile_no->SetValue($this->DataSource->mobile_no->GetValue());
                    $this->fax_no->SetValue($this->DataSource->fax_no->GetValue());
                    $this->zip_code->SetValue($this->DataSource->zip_code->GetValue());
                    $this->email_address->SetValue($this->DataSource->email_address->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_ppat_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->phone_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ppat_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_rt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_rw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id_kec->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id_kel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->identification_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->personal_identification_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mobile_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fax_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->zip_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->email_address->Errors->ToString());
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
        $this->t_ppat_id->Show();
        $this->phone_no->Show();
        $this->creation_date->Show();
        $this->created_by->Show();
        $this->updated_date->Show();
        $this->updated_by->Show();
        $this->ppat_name->Show();
        $this->address_name->Show();
        $this->address_no->Show();
        $this->address_rt->Show();
        $this->address_rw->Show();
        $this->kota->Show();
        $this->p_region_id->Show();
        $this->kecamatan->Show();
        $this->p_region_id_kec->Show();
        $this->kelurahan->Show();
        $this->p_region_id_kel->Show();
        $this->identification_no->Show();
        $this->personal_identification_id->Show();
        $this->mobile_no->Show();
        $this->fax_no->Show();
        $this->zip_code->Show();
        $this->email_address->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_ppatForm Class @23-FCB6E20C

class clst_ppatFormDataSource extends clsDBConnSIKP {  //t_ppatFormDataSource Class @23-F9738238

//DataSource Variables @23-76C1D156
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
    var $t_ppat_id;
    var $phone_no;
    var $creation_date;
    var $created_by;
    var $updated_date;
    var $updated_by;
    var $ppat_name;
    var $address_name;
    var $address_no;
    var $address_rt;
    var $address_rw;
    var $kota;
    var $p_region_id;
    var $kecamatan;
    var $p_region_id_kec;
    var $kelurahan;
    var $p_region_id_kel;
    var $identification_no;
    var $personal_identification_id;
    var $mobile_no;
    var $fax_no;
    var $zip_code;
    var $email_address;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-ABC47D53
    function clst_ppatFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_ppatForm/Error";
        $this->Initialize();
        $this->t_ppat_id = new clsField("t_ppat_id", ccsFloat, "");
        
        $this->phone_no = new clsField("phone_no", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->ppat_name = new clsField("ppat_name", ccsText, "");
        
        $this->address_name = new clsField("address_name", ccsText, "");
        
        $this->address_no = new clsField("address_no", ccsText, "");
        
        $this->address_rt = new clsField("address_rt", ccsText, "");
        
        $this->address_rw = new clsField("address_rw", ccsText, "");
        
        $this->kota = new clsField("kota", ccsText, "");
        
        $this->p_region_id = new clsField("p_region_id", ccsFloat, "");
        
        $this->kecamatan = new clsField("kecamatan", ccsText, "");
        
        $this->p_region_id_kec = new clsField("p_region_id_kec", ccsFloat, "");
        
        $this->kelurahan = new clsField("kelurahan", ccsText, "");
        
        $this->p_region_id_kel = new clsField("p_region_id_kel", ccsFloat, "");
        
        $this->identification_no = new clsField("identification_no", ccsText, "");
        
        $this->personal_identification_id = new clsField("personal_identification_id", ccsText, "");
        
        $this->mobile_no = new clsField("mobile_no", ccsText, "");
        
        $this->fax_no = new clsField("fax_no", ccsText, "");
        
        $this->zip_code = new clsField("zip_code", ccsText, "");
        
        $this->email_address = new clsField("email_address", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-37115C10
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_ppat_id", ccsFloat, "", "", $this->Parameters["urlt_ppat_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @23-03AA9E68
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT a.*,\n" .
        "b.region_name as kota,\n" .
        "c.region_name as kecamatan,\n" .
        "d.region_name as kelurahan,\n" .
        "to_char(a.creation_date,'DD-MON-YYYY')as creation_date, \n" .
        "to_char(a.updated_date,'DD-MON-YYYY')as updated_date\n" .
        "FROM t_ppat a\n" .
        "left join p_region as b\n" .
        "	on a.p_region_id = b.p_region_id\n" .
        "left join p_region as c\n" .
        "	on a.p_region_id_kec = c.p_region_id\n" .
        "left join p_region as d\n" .
        "	on a.p_region_id_kel = d.p_region_id\n" .
        "WHERE t_ppat_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-03CD617F
    function SetValues()
    {
        $this->t_ppat_id->SetDBValue(trim($this->f("p_simple_parameter_type_id")));
        $this->phone_no->SetDBValue($this->f("phone_no"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->ppat_name->SetDBValue($this->f("ppat_name"));
        $this->address_name->SetDBValue($this->f("address_name"));
        $this->address_no->SetDBValue($this->f("address_no"));
        $this->address_rt->SetDBValue($this->f("address_rt"));
        $this->address_rw->SetDBValue($this->f("address_rw"));
        $this->kota->SetDBValue($this->f("kota"));
        $this->p_region_id->SetDBValue(trim($this->f("p_region_id")));
        $this->kecamatan->SetDBValue($this->f("kecamatan"));
        $this->p_region_id_kec->SetDBValue(trim($this->f("p_region_id_kec")));
        $this->kelurahan->SetDBValue($this->f("kelurahan"));
        $this->p_region_id_kel->SetDBValue(trim($this->f("p_region_id_kel")));
        $this->identification_no->SetDBValue($this->f("identification_no"));
        $this->personal_identification_id->SetDBValue($this->f("personal_identification_id"));
        $this->mobile_no->SetDBValue($this->f("mobile_no"));
        $this->fax_no->SetDBValue($this->f("fax_no"));
        $this->zip_code->SetDBValue($this->f("zip_code"));
        $this->email_address->SetDBValue($this->f("email_address"));
    }
//End SetValues Method

//Insert Method @23-A2A75414
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["created_by"] = new clsSQLParameter("ctrlcreated_by", ccsText, "", "", $this->created_by->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("ctrlupdated_by", ccsText, "", "", $this->updated_by->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["creation_date"] = new clsSQLParameter("ctrlcreation_date", ccsText, "", "", $this->creation_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_date"] = new clsSQLParameter("ctrlupdated_date", ccsText, "", "", $this->updated_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_ppat_id"] = new clsSQLParameter("ctrlt_ppat_id", ccsFloat, "", "", $this->t_ppat_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["phone_no"] = new clsSQLParameter("ctrlphone_no", ccsText, "", "", $this->phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["ppat_name"] = new clsSQLParameter("ctrlppat_name", ccsText, "", "", $this->ppat_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_name"] = new clsSQLParameter("ctrladdress_name", ccsText, "", "", $this->address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_no"] = new clsSQLParameter("ctrladdress_no", ccsText, "", "", $this->address_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rt"] = new clsSQLParameter("ctrladdress_rt", ccsText, "", "", $this->address_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rw"] = new clsSQLParameter("ctrladdress_rw", ccsText, "", "", $this->address_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id"] = new clsSQLParameter("ctrlp_region_id", ccsFloat, "", "", $this->p_region_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_kec"] = new clsSQLParameter("ctrlp_region_id_kec", ccsFloat, "", "", $this->p_region_id_kec->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_kel"] = new clsSQLParameter("ctrlp_region_id_kel", ccsFloat, "", "", $this->p_region_id_kel->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["identification_no"] = new clsSQLParameter("ctrlidentification_no", ccsText, "", "", $this->identification_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["personal_identification_id"] = new clsSQLParameter("ctrlpersonal_identification_id", ccsText, "", "", $this->personal_identification_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobile_no"] = new clsSQLParameter("ctrlmobile_no", ccsText, "", "", $this->mobile_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["fax_no"] = new clsSQLParameter("ctrlfax_no", ccsText, "", "", $this->fax_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["zip_code"] = new clsSQLParameter("ctrlzip_code", ccsText, "", "", $this->zip_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["email_address"] = new clsSQLParameter("ctrlemail_address", ccsText, "", "", $this->email_address->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue($this->created_by->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue($this->updated_by->GetValue(true));
        if (!is_null($this->cp["creation_date"]->GetValue()) and !strlen($this->cp["creation_date"]->GetText()) and !is_bool($this->cp["creation_date"]->GetValue())) 
            $this->cp["creation_date"]->SetValue($this->creation_date->GetValue(true));
        if (!is_null($this->cp["updated_date"]->GetValue()) and !strlen($this->cp["updated_date"]->GetText()) and !is_bool($this->cp["updated_date"]->GetValue())) 
            $this->cp["updated_date"]->SetValue($this->updated_date->GetValue(true));
        if (!is_null($this->cp["t_ppat_id"]->GetValue()) and !strlen($this->cp["t_ppat_id"]->GetText()) and !is_bool($this->cp["t_ppat_id"]->GetValue())) 
            $this->cp["t_ppat_id"]->SetValue($this->t_ppat_id->GetValue(true));
        if (!is_null($this->cp["phone_no"]->GetValue()) and !strlen($this->cp["phone_no"]->GetText()) and !is_bool($this->cp["phone_no"]->GetValue())) 
            $this->cp["phone_no"]->SetValue($this->phone_no->GetValue(true));
        if (!is_null($this->cp["ppat_name"]->GetValue()) and !strlen($this->cp["ppat_name"]->GetText()) and !is_bool($this->cp["ppat_name"]->GetValue())) 
            $this->cp["ppat_name"]->SetValue($this->ppat_name->GetValue(true));
        if (!is_null($this->cp["address_name"]->GetValue()) and !strlen($this->cp["address_name"]->GetText()) and !is_bool($this->cp["address_name"]->GetValue())) 
            $this->cp["address_name"]->SetValue($this->address_name->GetValue(true));
        if (!is_null($this->cp["address_no"]->GetValue()) and !strlen($this->cp["address_no"]->GetText()) and !is_bool($this->cp["address_no"]->GetValue())) 
            $this->cp["address_no"]->SetValue($this->address_no->GetValue(true));
        if (!is_null($this->cp["address_rt"]->GetValue()) and !strlen($this->cp["address_rt"]->GetText()) and !is_bool($this->cp["address_rt"]->GetValue())) 
            $this->cp["address_rt"]->SetValue($this->address_rt->GetValue(true));
        if (!is_null($this->cp["address_rw"]->GetValue()) and !strlen($this->cp["address_rw"]->GetText()) and !is_bool($this->cp["address_rw"]->GetValue())) 
            $this->cp["address_rw"]->SetValue($this->address_rw->GetValue(true));
        if (!is_null($this->cp["p_region_id"]->GetValue()) and !strlen($this->cp["p_region_id"]->GetText()) and !is_bool($this->cp["p_region_id"]->GetValue())) 
            $this->cp["p_region_id"]->SetValue($this->p_region_id->GetValue(true));
        if (!is_null($this->cp["p_region_id_kec"]->GetValue()) and !strlen($this->cp["p_region_id_kec"]->GetText()) and !is_bool($this->cp["p_region_id_kec"]->GetValue())) 
            $this->cp["p_region_id_kec"]->SetValue($this->p_region_id_kec->GetValue(true));
        if (!is_null($this->cp["p_region_id_kel"]->GetValue()) and !strlen($this->cp["p_region_id_kel"]->GetText()) and !is_bool($this->cp["p_region_id_kel"]->GetValue())) 
            $this->cp["p_region_id_kel"]->SetValue($this->p_region_id_kel->GetValue(true));
        if (!is_null($this->cp["identification_no"]->GetValue()) and !strlen($this->cp["identification_no"]->GetText()) and !is_bool($this->cp["identification_no"]->GetValue())) 
            $this->cp["identification_no"]->SetValue($this->identification_no->GetValue(true));
        if (!is_null($this->cp["personal_identification_id"]->GetValue()) and !strlen($this->cp["personal_identification_id"]->GetText()) and !is_bool($this->cp["personal_identification_id"]->GetValue())) 
            $this->cp["personal_identification_id"]->SetValue($this->personal_identification_id->GetValue(true));
        if (!is_null($this->cp["mobile_no"]->GetValue()) and !strlen($this->cp["mobile_no"]->GetText()) and !is_bool($this->cp["mobile_no"]->GetValue())) 
            $this->cp["mobile_no"]->SetValue($this->mobile_no->GetValue(true));
        if (!is_null($this->cp["fax_no"]->GetValue()) and !strlen($this->cp["fax_no"]->GetText()) and !is_bool($this->cp["fax_no"]->GetValue())) 
            $this->cp["fax_no"]->SetValue($this->fax_no->GetValue(true));
        if (!is_null($this->cp["zip_code"]->GetValue()) and !strlen($this->cp["zip_code"]->GetText()) and !is_bool($this->cp["zip_code"]->GetValue())) 
            $this->cp["zip_code"]->SetValue($this->zip_code->GetValue(true));
        if (!is_null($this->cp["email_address"]->GetValue()) and !strlen($this->cp["email_address"]->GetText()) and !is_bool($this->cp["email_address"]->GetValue())) 
            $this->cp["email_address"]->SetValue($this->email_address->GetValue(true));
        $this->SQL = "INSERT INTO t_ppat(creation_date, created_by, \n" .
        "updated_date, updated_by, t_ppat_id, \n" .
        "phone_no, ppat_name, address_name, address_no, \n" .
        "address_rt, address_rw, p_region_id, \n" .
        "p_region_id_kec, p_region_id_kel, identification_no, \n" .
        "personal_identification_id, mobile_no, \n" .
        "fax_no, zip_code, email_address) \n" .
        "VALUES('" . $this->SQLValue($this->cp["creation_date"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["updated_date"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "generate_id('sikp','t_ppat','t_ppat_id'), \n" .
        "'" . $this->SQLValue($this->cp["phone_no"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["ppat_name"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["address_name"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["address_no"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["address_rt"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["address_rw"]->GetDBValue(), ccsText) . "', \n" .
        "" . $this->SQLValue($this->cp["p_region_id"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["p_region_id_kec"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["p_region_id_kel"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["identification_no"]->GetDBValue(), ccsText) . "', \n" .
        "" . $this->SQLValue($this->cp["personal_identification_id"]->GetDBValue(), ccsText) . ", '" . $this->SQLValue($this->cp["mobile_no"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["fax_no"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["zip_code"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["email_address"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-96B91C22
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["updated_by"] = new clsSQLParameter("ctrlupdated_by", ccsText, "", "", $this->updated_by->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_ppat_id"] = new clsSQLParameter("urlt_ppat_id", ccsFloat, "", "", CCGetFromGet("t_ppat_id", NULL), 0, false, $this->ErrorBlock);
        $this->cp["phone_no"] = new clsSQLParameter("ctrlphone_no", ccsText, "", "", $this->phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["creation_date"] = new clsSQLParameter("ctrlcreation_date", ccsText, "", "", $this->creation_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("ctrlcreated_by", ccsText, "", "", $this->created_by->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_date"] = new clsSQLParameter("ctrlupdated_date", ccsText, "", "", $this->updated_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["ppat_name"] = new clsSQLParameter("ctrlppat_name", ccsText, "", "", $this->ppat_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_name"] = new clsSQLParameter("ctrladdress_name", ccsText, "", "", $this->address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_no"] = new clsSQLParameter("ctrladdress_no", ccsText, "", "", $this->address_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rt"] = new clsSQLParameter("ctrladdress_rt", ccsText, "", "", $this->address_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rw"] = new clsSQLParameter("ctrladdress_rw", ccsText, "", "", $this->address_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id"] = new clsSQLParameter("ctrlp_region_id", ccsFloat, "", "", $this->p_region_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_kec"] = new clsSQLParameter("ctrlp_region_id_kec", ccsFloat, "", "", $this->p_region_id_kec->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_kel"] = new clsSQLParameter("ctrlp_region_id_kel", ccsFloat, "", "", $this->p_region_id_kel->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["identification_no"] = new clsSQLParameter("ctrlidentification_no", ccsText, "", "", $this->identification_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["personal_identification_id"] = new clsSQLParameter("ctrlpersonal_identification_id", ccsText, "", "", $this->personal_identification_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobile_no"] = new clsSQLParameter("ctrlmobile_no", ccsText, "", "", $this->mobile_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["fax_no"] = new clsSQLParameter("ctrlfax_no", ccsText, "", "", $this->fax_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["zip_code"] = new clsSQLParameter("ctrlzip_code", ccsText, "", "", $this->zip_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["email_address"] = new clsSQLParameter("ctrlemail_address", ccsText, "", "", $this->email_address->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue($this->updated_by->GetValue(true));
        if (!is_null($this->cp["t_ppat_id"]->GetValue()) and !strlen($this->cp["t_ppat_id"]->GetText()) and !is_bool($this->cp["t_ppat_id"]->GetValue())) 
            $this->cp["t_ppat_id"]->SetText(CCGetFromGet("t_ppat_id", NULL));
        if (!strlen($this->cp["t_ppat_id"]->GetText()) and !is_bool($this->cp["t_ppat_id"]->GetValue(true))) 
            $this->cp["t_ppat_id"]->SetText(0);
        if (!is_null($this->cp["phone_no"]->GetValue()) and !strlen($this->cp["phone_no"]->GetText()) and !is_bool($this->cp["phone_no"]->GetValue())) 
            $this->cp["phone_no"]->SetValue($this->phone_no->GetValue(true));
        if (!is_null($this->cp["creation_date"]->GetValue()) and !strlen($this->cp["creation_date"]->GetText()) and !is_bool($this->cp["creation_date"]->GetValue())) 
            $this->cp["creation_date"]->SetValue($this->creation_date->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue($this->created_by->GetValue(true));
        if (!is_null($this->cp["updated_date"]->GetValue()) and !strlen($this->cp["updated_date"]->GetText()) and !is_bool($this->cp["updated_date"]->GetValue())) 
            $this->cp["updated_date"]->SetValue($this->updated_date->GetValue(true));
        if (!is_null($this->cp["ppat_name"]->GetValue()) and !strlen($this->cp["ppat_name"]->GetText()) and !is_bool($this->cp["ppat_name"]->GetValue())) 
            $this->cp["ppat_name"]->SetValue($this->ppat_name->GetValue(true));
        if (!is_null($this->cp["address_name"]->GetValue()) and !strlen($this->cp["address_name"]->GetText()) and !is_bool($this->cp["address_name"]->GetValue())) 
            $this->cp["address_name"]->SetValue($this->address_name->GetValue(true));
        if (!is_null($this->cp["address_no"]->GetValue()) and !strlen($this->cp["address_no"]->GetText()) and !is_bool($this->cp["address_no"]->GetValue())) 
            $this->cp["address_no"]->SetValue($this->address_no->GetValue(true));
        if (!is_null($this->cp["address_rt"]->GetValue()) and !strlen($this->cp["address_rt"]->GetText()) and !is_bool($this->cp["address_rt"]->GetValue())) 
            $this->cp["address_rt"]->SetValue($this->address_rt->GetValue(true));
        if (!is_null($this->cp["address_rw"]->GetValue()) and !strlen($this->cp["address_rw"]->GetText()) and !is_bool($this->cp["address_rw"]->GetValue())) 
            $this->cp["address_rw"]->SetValue($this->address_rw->GetValue(true));
        if (!is_null($this->cp["p_region_id"]->GetValue()) and !strlen($this->cp["p_region_id"]->GetText()) and !is_bool($this->cp["p_region_id"]->GetValue())) 
            $this->cp["p_region_id"]->SetValue($this->p_region_id->GetValue(true));
        if (!is_null($this->cp["p_region_id_kec"]->GetValue()) and !strlen($this->cp["p_region_id_kec"]->GetText()) and !is_bool($this->cp["p_region_id_kec"]->GetValue())) 
            $this->cp["p_region_id_kec"]->SetValue($this->p_region_id_kec->GetValue(true));
        if (!is_null($this->cp["p_region_id_kel"]->GetValue()) and !strlen($this->cp["p_region_id_kel"]->GetText()) and !is_bool($this->cp["p_region_id_kel"]->GetValue())) 
            $this->cp["p_region_id_kel"]->SetValue($this->p_region_id_kel->GetValue(true));
        if (!is_null($this->cp["identification_no"]->GetValue()) and !strlen($this->cp["identification_no"]->GetText()) and !is_bool($this->cp["identification_no"]->GetValue())) 
            $this->cp["identification_no"]->SetValue($this->identification_no->GetValue(true));
        if (!is_null($this->cp["personal_identification_id"]->GetValue()) and !strlen($this->cp["personal_identification_id"]->GetText()) and !is_bool($this->cp["personal_identification_id"]->GetValue())) 
            $this->cp["personal_identification_id"]->SetValue($this->personal_identification_id->GetValue(true));
        if (!is_null($this->cp["mobile_no"]->GetValue()) and !strlen($this->cp["mobile_no"]->GetText()) and !is_bool($this->cp["mobile_no"]->GetValue())) 
            $this->cp["mobile_no"]->SetValue($this->mobile_no->GetValue(true));
        if (!is_null($this->cp["fax_no"]->GetValue()) and !strlen($this->cp["fax_no"]->GetText()) and !is_bool($this->cp["fax_no"]->GetValue())) 
            $this->cp["fax_no"]->SetValue($this->fax_no->GetValue(true));
        if (!is_null($this->cp["zip_code"]->GetValue()) and !strlen($this->cp["zip_code"]->GetText()) and !is_bool($this->cp["zip_code"]->GetValue())) 
            $this->cp["zip_code"]->SetValue($this->zip_code->GetValue(true));
        if (!is_null($this->cp["email_address"]->GetValue()) and !strlen($this->cp["email_address"]->GetText()) and !is_bool($this->cp["email_address"]->GetValue())) 
            $this->cp["email_address"]->SetValue($this->email_address->GetValue(true));
        $this->SQL = "UPDATE t_ppat SET  \n" .
        "phone_no='" . $this->SQLValue($this->cp["phone_no"]->GetDBValue(), ccsText) . "', \n" .
        "creation_date='" . $this->SQLValue($this->cp["creation_date"]->GetDBValue(), ccsText) . "', \n" .
        "created_by='" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date='" . $this->SQLValue($this->cp["updated_date"]->GetDBValue(), ccsText) . "', \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "ppat_name='" . $this->SQLValue($this->cp["ppat_name"]->GetDBValue(), ccsText) . "', \n" .
        "address_name='" . $this->SQLValue($this->cp["address_name"]->GetDBValue(), ccsText) . "', \n" .
        "address_no='" . $this->SQLValue($this->cp["address_no"]->GetDBValue(), ccsText) . "', \n" .
        "address_rt='" . $this->SQLValue($this->cp["address_rt"]->GetDBValue(), ccsText) . "', \n" .
        "address_rw='" . $this->SQLValue($this->cp["address_rw"]->GetDBValue(), ccsText) . "', \n" .
        "p_region_id=" . $this->SQLValue($this->cp["p_region_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "p_region_id_kec=" . $this->SQLValue($this->cp["p_region_id_kec"]->GetDBValue(), ccsFloat) . ", \n" .
        "p_region_id_kel=" . $this->SQLValue($this->cp["p_region_id_kel"]->GetDBValue(), ccsFloat) . ", \n" .
        "identification_no='" . $this->SQLValue($this->cp["identification_no"]->GetDBValue(), ccsText) . "', \n" .
        "personal_identification_id='" . $this->SQLValue($this->cp["personal_identification_id"]->GetDBValue(), ccsText) . "', \n" .
        "mobile_no='" . $this->SQLValue($this->cp["mobile_no"]->GetDBValue(), ccsText) . "', \n" .
        "fax_no='" . $this->SQLValue($this->cp["fax_no"]->GetDBValue(), ccsText) . "', \n" .
        "zip_code='" . $this->SQLValue($this->cp["zip_code"]->GetDBValue(), ccsText) . "', \n" .
        "email_address='" . $this->SQLValue($this->cp["email_address"]->GetDBValue(), ccsText) . "' \n" .
        "WHERE  t_ppat_id = " . $this->SQLValue($this->cp["t_ppat_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-65CFD311
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_ppat_id"] = new clsSQLParameter("urlt_ppat_id", ccsFloat, "", "", CCGetFromGet("t_ppat_id", NULL), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_ppat_id"]->GetValue()) and !strlen($this->cp["t_ppat_id"]->GetText()) and !is_bool($this->cp["t_ppat_id"]->GetValue())) 
            $this->cp["t_ppat_id"]->SetText(CCGetFromGet("t_ppat_id", NULL));
        if (!strlen($this->cp["t_ppat_id"]->GetText()) and !is_bool($this->cp["t_ppat_id"]->GetValue(true))) 
            $this->cp["t_ppat_id"]->SetText(0);
        $this->SQL = "DELETE FROM t_ppat WHERE  t_ppat_id = " . $this->SQLValue($this->cp["t_ppat_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_ppatFormDataSource Class @23-FCB6E20C

//Initialize Page @1-36BAB729
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
$TemplateFileName = "t_ppat.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-E0E95F5E
include_once("./t_ppat_events.php");
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
