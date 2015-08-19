<?php
//Include Common Files @1-C5E811F3
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "t_cacc_masa_jab.php");
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

//Class_Initialize Event @2-FB591376
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
        $this->DLink->Page = "t_cacc_masa_jab.php";
        $this->masa_akhir = & new clsControl(ccsLabel, "masa_akhir", "masa_akhir", ccsText, "", CCGetRequestParam("masa_akhir", ccsGet, NULL), $this);
        $this->nama = & new clsControl(ccsLabel, "nama", "nama", ccsText, "", CCGetRequestParam("nama", ccsGet, NULL), $this);
        $this->masa_awal = & new clsControl(ccsLabel, "masa_awal", "masa_awal", ccsText, "", CCGetRequestParam("masa_awal", ccsGet, NULL), $this);
        $this->t_cust_acc_masa_jab_id = & new clsControl(ccsHidden, "t_cust_acc_masa_jab_id", "t_cust_acc_masa_jab_id", ccsText, "", CCGetRequestParam("t_cust_acc_masa_jab_id", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "t_cacc_masa_jab.php";
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

//Show Method @2-B0339C12
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
            $this->ControlsVisible["masa_akhir"] = $this->masa_akhir->Visible;
            $this->ControlsVisible["nama"] = $this->nama->Visible;
            $this->ControlsVisible["masa_awal"] = $this->masa_awal->Visible;
            $this->ControlsVisible["t_cust_acc_masa_jab_id"] = $this->t_cust_acc_masa_jab_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_cust_acc_masa_jab_id", $this->DataSource->f("t_cust_acc_masa_jab_id"));
                $this->masa_akhir->SetValue($this->DataSource->masa_akhir->GetValue());
                $this->nama->SetValue($this->DataSource->nama->GetValue());
                $this->masa_awal->SetValue($this->DataSource->masa_awal->GetValue());
                $this->t_cust_acc_masa_jab_id->SetValue($this->DataSource->t_cust_acc_masa_jab_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->masa_akhir->Show();
                $this->nama->Show();
                $this->masa_awal->Show();
                $this->t_cust_acc_masa_jab_id->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("t_cacc_masa_jab_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-9CC36535
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->masa_akhir->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nama->Errors->ToString());
        $errors = ComposeStrings($errors, $this->masa_awal->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_acc_masa_jab_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_cacc_legal_docGrid Class @2-FCB6E20C

class clst_cacc_legal_docGridDataSource extends clsDBConnSIKP {  //t_cacc_legal_docGridDataSource Class @2-D84D24FD

//DataSource Variables @2-D87ED94E
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $masa_akhir;
    var $nama;
    var $masa_awal;
    var $t_cust_acc_masa_jab_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-B1FA3C0D
    function clst_cacc_legal_docGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_cacc_legal_docGrid";
        $this->Initialize();
        $this->masa_akhir = new clsField("masa_akhir", ccsText, "");
        
        $this->nama = new clsField("nama", ccsText, "");
        
        $this->masa_awal = new clsField("masa_awal", ccsText, "");
        
        $this->t_cust_acc_masa_jab_id = new clsField("t_cust_acc_masa_jab_id", ccsText, "");
        

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

//Open Method @2-B6FA2762
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT * \n" .
        "FROM t_cust_acc_masa_jab \n" .
        "WHERE nama LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "AND t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . " ) cnt";
        $this->SQL = "SELECT * \n" .
        "FROM t_cust_acc_masa_jab \n" .
        "WHERE nama LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
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

//SetValues Method @2-C1B53160
    function SetValues()
    {
        $this->masa_akhir->SetDBValue($this->f("masa_akhir"));
        $this->nama->SetDBValue($this->f("nama"));
        $this->masa_awal->SetDBValue($this->f("masa_awal"));
        $this->t_cust_acc_masa_jab_id->SetDBValue($this->f("t_cust_acc_masa_jab_id"));
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

//Operation Method @3-EB259DEB
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
        $Redirect = "t_cacc_masa_jab.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_cacc_masa_jab.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

//Class_Initialize Event @94-85D36D73
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
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->t_cust_acc_masa_jab_id = & new clsControl(ccsHidden, "t_cust_acc_masa_jab_id", "Id", ccsFloat, "", CCGetRequestParam("t_cust_acc_masa_jab_id", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->t_cacc_legal_docGridPage = & new clsControl(ccsHidden, "t_cacc_legal_docGridPage", "t_cacc_legal_docGridPage", ccsText, "", CCGetRequestParam("t_cacc_legal_docGridPage", $Method, NULL), $this);
            $this->nama = & new clsControl(ccsTextBox, "nama", "nama", ccsText, "", CCGetRequestParam("nama", $Method, NULL), $this);
            $this->nama->Required = true;
            $this->masa_awal = & new clsControl(ccsTextBox, "masa_awal", "masa awal", ccsText, "", CCGetRequestParam("masa_awal", $Method, NULL), $this);
            $this->masa_awal->Required = true;
            $this->DatePicker_tgl_penerimaan = & new clsDatePicker("DatePicker_tgl_penerimaan", "t_cacc_legal_docForm", "masa_awal", $this);
            $this->masa_akhir = & new clsControl(ccsTextBox, "masa_akhir", "masa akhir", ccsText, "", CCGetRequestParam("masa_akhir", $Method, NULL), $this);
            $this->masa_akhir->Required = true;
            $this->DatePicker_tgl_penerimaan1 = & new clsDatePicker("DatePicker_tgl_penerimaan1", "t_cacc_legal_docForm", "masa_akhir", $this);
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsText, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-m-Y"));
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-m-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-FF648284
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_cust_acc_masa_jab_id"] = CCGetFromGet("t_cust_acc_masa_jab_id", NULL);
    }
//End Initialize Method

//Validate Method @94-E7F58A7A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_cust_acc_masa_jab_id->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->t_cacc_legal_docGridPage->Validate() && $Validation);
        $Validation = ($this->nama->Validate() && $Validation);
        $Validation = ($this->masa_awal->Validate() && $Validation);
        $Validation = ($this->masa_akhir->Validate() && $Validation);
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_cust_acc_masa_jab_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cacc_legal_docGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama->Errors->Count() == 0);
        $Validation =  $Validation && ($this->masa_awal->Errors->Count() == 0);
        $Validation =  $Validation && ($this->masa_akhir->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-DA7BCC42
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_cust_acc_masa_jab_id->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->t_cacc_legal_docGridPage->Errors->Count());
        $errors = ($errors || $this->nama->Errors->Count());
        $errors = ($errors || $this->masa_awal->Errors->Count());
        $errors = ($errors || $this->DatePicker_tgl_penerimaan->Errors->Count());
        $errors = ($errors || $this->masa_akhir->Errors->Count());
        $errors = ($errors || $this->DatePicker_tgl_penerimaan1->Errors->Count());
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
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

//Operation Method @94-ACC40762
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
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "add_flag"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "add_flag", "FLAG", "s_keyword", "t_cacc_legal_doc_id", "t_cacc_legal_docGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "add_flag", "FLAG", "s_keyword", "t_cacc_legal_doc_id", "t_cacc_legal_docGridPage"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "add_flag", "FLAG"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "add_flag", "FLAG"));
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

//InsertRow Method @94-66EDB26F
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->created_by->SetValue($this->created_by->GetValue(true));
        $this->DataSource->updated_by->SetValue($this->updated_by->GetValue(true));
        $this->DataSource->t_cust_account_id->SetValue($this->t_cust_account_id->GetValue(true));
        $this->DataSource->creation_date->SetValue($this->creation_date->GetValue(true));
        $this->DataSource->updated_date->SetValue($this->updated_date->GetValue(true));
        $this->DataSource->t_cust_acc_masa_jab_id->SetValue($this->t_cust_acc_masa_jab_id->GetValue(true));
        $this->DataSource->nama->SetValue($this->nama->GetValue(true));
        $this->DataSource->masa_awal->SetValue($this->masa_awal->GetValue(true));
        $this->DataSource->masa_akhir->SetValue($this->masa_akhir->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-0BBC1BB3
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->updated_by->SetValue($this->updated_by->GetValue(true));
        $this->DataSource->updated_date->SetValue($this->updated_date->GetValue(true));
        $this->DataSource->t_cust_acc_masa_jab_id->SetValue($this->t_cust_acc_masa_jab_id->GetValue(true));
        $this->DataSource->nama->SetValue($this->nama->GetValue(true));
        $this->DataSource->masa_awal->SetValue($this->masa_awal->GetValue(true));
        $this->DataSource->masa_akhir->SetValue($this->masa_akhir->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-53627737
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_cust_acc_masa_jab_id->SetValue($this->t_cust_acc_masa_jab_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-291483BC
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
                    $this->t_cust_acc_masa_jab_id->SetValue($this->DataSource->t_cust_acc_masa_jab_id->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->nama->SetValue($this->DataSource->nama->GetValue());
                    $this->masa_awal->SetValue($this->DataSource->masa_awal->GetValue());
                    $this->masa_akhir->SetValue($this->DataSource->masa_akhir->GetValue());
                    $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_cust_acc_masa_jab_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cacc_legal_docGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama->Errors->ToString());
            $Error = ComposeStrings($Error, $this->masa_awal->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_tgl_penerimaan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->masa_akhir->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_tgl_penerimaan1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
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
        $this->t_cust_acc_masa_jab_id->Show();
        $this->created_by->Show();
        $this->updated_by->Show();
        $this->creation_date->Show();
        $this->updated_date->Show();
        $this->t_cacc_legal_docGridPage->Show();
        $this->nama->Show();
        $this->masa_awal->Show();
        $this->DatePicker_tgl_penerimaan->Show();
        $this->masa_akhir->Show();
        $this->DatePicker_tgl_penerimaan1->Show();
        $this->t_cust_account_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_cacc_legal_docForm Class @94-FCB6E20C

class clst_cacc_legal_docFormDataSource extends clsDBConnSIKP {  //t_cacc_legal_docFormDataSource Class @94-877AB209

//DataSource Variables @94-9106FDF8
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
    var $t_cust_acc_masa_jab_id;
    var $created_by;
    var $updated_by;
    var $creation_date;
    var $updated_date;
    var $t_cacc_legal_docGridPage;
    var $nama;
    var $masa_awal;
    var $masa_akhir;
    var $t_cust_account_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-483160FA
    function clst_cacc_legal_docFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_cacc_legal_docForm/Error";
        $this->Initialize();
        $this->t_cust_acc_masa_jab_id = new clsField("t_cust_acc_masa_jab_id", ccsFloat, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->t_cacc_legal_docGridPage = new clsField("t_cacc_legal_docGridPage", ccsText, "");
        
        $this->nama = new clsField("nama", ccsText, "");
        
        $this->masa_awal = new clsField("masa_awal", ccsText, "");
        
        $this->masa_akhir = new clsField("masa_akhir", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-3F7179D9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_acc_masa_jab_id", ccsFloat, "", "", $this->Parameters["urlt_cust_acc_masa_jab_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-1893D5B7
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT t_cust_acc_masa_jab_id, t_cust_account_id, nama, \n" .
        "to_char(masa_awal, 'DD-MM-YYYY')as masa_awal, \n" .
        "to_char(masa_akhir, 'DD-MM-YYYY')as masa_akhir,\n" .
        "to_char(creation_date, 'DD-MM-YYYY')as creation_date, \n" .
        "created_by , to_char(updated_date,'DD-MM-YYYY')as updated_date, update_by \n" .
        "FROM t_cust_acc_masa_jab\n" .
        "WHERE t_cust_acc_masa_jab_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-A710532D
    function SetValues()
    {
        $this->t_cust_acc_masa_jab_id->SetDBValue(trim($this->f("t_cust_acc_masa_jab_id")));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_by->SetDBValue($this->f("update_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->nama->SetDBValue($this->f("nama"));
        $this->masa_awal->SetDBValue($this->f("masa_awal"));
        $this->masa_akhir->SetDBValue($this->f("masa_akhir"));
        $this->t_cust_account_id->SetDBValue($this->f("t_cust_account_id"));
    }
//End SetValues Method

//Insert Method @94-4CBC4800
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["created_by"] = new clsSQLParameter("ctrlcreated_by", ccsText, "", "", $this->created_by->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("ctrlupdated_by", ccsText, "", "", $this->updated_by->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_cust_account_id"] = new clsSQLParameter("ctrlt_cust_account_id", ccsFloat, "", "", $this->t_cust_account_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["creation_date"] = new clsSQLParameter("ctrlcreation_date", ccsText, "", "", $this->creation_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_date"] = new clsSQLParameter("ctrlupdated_date", ccsText, "", "", $this->updated_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_cust_acc_masa_jab_id"] = new clsSQLParameter("ctrlt_cust_acc_masa_jab_id", ccsFloat, "", "", $this->t_cust_acc_masa_jab_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["nama"] = new clsSQLParameter("ctrlnama", ccsText, "", "", $this->nama->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["masa_awal"] = new clsSQLParameter("ctrlmasa_awal", ccsDate, array("dd", "-", "mm", "-", "yyyy"), $this->DateFormat, $this->masa_awal->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["masa_akhir"] = new clsSQLParameter("ctrlmasa_akhir", ccsDate, array("dd", "-", "mm", "-", "yyyy"), $this->DateFormat, $this->masa_akhir->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue($this->created_by->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue($this->updated_by->GetValue(true));
        if (!is_null($this->cp["t_cust_account_id"]->GetValue()) and !strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue())) 
            $this->cp["t_cust_account_id"]->SetValue($this->t_cust_account_id->GetValue(true));
        if (!strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue(true))) 
            $this->cp["t_cust_account_id"]->SetText(0);
        if (!is_null($this->cp["creation_date"]->GetValue()) and !strlen($this->cp["creation_date"]->GetText()) and !is_bool($this->cp["creation_date"]->GetValue())) 
            $this->cp["creation_date"]->SetValue($this->creation_date->GetValue(true));
        if (!is_null($this->cp["updated_date"]->GetValue()) and !strlen($this->cp["updated_date"]->GetText()) and !is_bool($this->cp["updated_date"]->GetValue())) 
            $this->cp["updated_date"]->SetValue($this->updated_date->GetValue(true));
        if (!is_null($this->cp["t_cust_acc_masa_jab_id"]->GetValue()) and !strlen($this->cp["t_cust_acc_masa_jab_id"]->GetText()) and !is_bool($this->cp["t_cust_acc_masa_jab_id"]->GetValue())) 
            $this->cp["t_cust_acc_masa_jab_id"]->SetValue($this->t_cust_acc_masa_jab_id->GetValue(true));
        if (!strlen($this->cp["t_cust_acc_masa_jab_id"]->GetText()) and !is_bool($this->cp["t_cust_acc_masa_jab_id"]->GetValue(true))) 
            $this->cp["t_cust_acc_masa_jab_id"]->SetText(0);
        if (!is_null($this->cp["nama"]->GetValue()) and !strlen($this->cp["nama"]->GetText()) and !is_bool($this->cp["nama"]->GetValue())) 
            $this->cp["nama"]->SetValue($this->nama->GetValue(true));
        if (!is_null($this->cp["masa_awal"]->GetValue()) and !strlen($this->cp["masa_awal"]->GetText()) and !is_bool($this->cp["masa_awal"]->GetValue())) 
            $this->cp["masa_awal"]->SetValue($this->masa_awal->GetValue(true));
        if (!is_null($this->cp["masa_akhir"]->GetValue()) and !strlen($this->cp["masa_akhir"]->GetText()) and !is_bool($this->cp["masa_akhir"]->GetValue())) 
            $this->cp["masa_akhir"]->SetValue($this->masa_akhir->GetValue(true));
        $this->SQL = "INSERT INTO t_cust_acc_masa_jab \n" .
        "(nama,t_cust_account_id,created_by, update_by, creation_date, updated_date, masa_awal, masa_akhir) \n" .
        "VALUES\n" .
        "('" . $this->SQLValue($this->cp["nama"]->GetDBValue(), ccsText) . "'," . $this->SQLValue($this->cp["t_cust_account_id"]->GetDBValue(), ccsFloat) . ",'" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', to_date('" . $this->SQLValue($this->cp["creation_date"]->GetDBValue(), ccsText) . "','dd-mm-yyyy'), to_date('" . $this->SQLValue($this->cp["updated_date"]->GetDBValue(), ccsText) . "','dd-mm-yyyy'), '" . $this->SQLValue($this->cp["masa_awal"]->GetDBValue(), ccsDate) . "', '" . $this->SQLValue($this->cp["masa_akhir"]->GetDBValue(), ccsDate) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-C7C04223
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["updated_by"] = new clsSQLParameter("ctrlupdated_by", ccsText, "", "", $this->updated_by->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_date"] = new clsSQLParameter("ctrlupdated_date", ccsText, "", "", $this->updated_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_cust_acc_masa_jab_id"] = new clsSQLParameter("ctrlt_cust_acc_masa_jab_id", ccsFloat, "", "", $this->t_cust_acc_masa_jab_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["nama"] = new clsSQLParameter("ctrlnama", ccsText, "", "", $this->nama->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["masa_awal"] = new clsSQLParameter("ctrlmasa_awal", ccsText, "", "", $this->masa_awal->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["masa_akhir"] = new clsSQLParameter("ctrlmasa_akhir", ccsText, "", "", $this->masa_akhir->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue($this->updated_by->GetValue(true));
        if (!is_null($this->cp["updated_date"]->GetValue()) and !strlen($this->cp["updated_date"]->GetText()) and !is_bool($this->cp["updated_date"]->GetValue())) 
            $this->cp["updated_date"]->SetValue($this->updated_date->GetValue(true));
        if (!is_null($this->cp["t_cust_acc_masa_jab_id"]->GetValue()) and !strlen($this->cp["t_cust_acc_masa_jab_id"]->GetText()) and !is_bool($this->cp["t_cust_acc_masa_jab_id"]->GetValue())) 
            $this->cp["t_cust_acc_masa_jab_id"]->SetValue($this->t_cust_acc_masa_jab_id->GetValue(true));
        if (!is_null($this->cp["nama"]->GetValue()) and !strlen($this->cp["nama"]->GetText()) and !is_bool($this->cp["nama"]->GetValue())) 
            $this->cp["nama"]->SetValue($this->nama->GetValue(true));
        if (!is_null($this->cp["masa_awal"]->GetValue()) and !strlen($this->cp["masa_awal"]->GetText()) and !is_bool($this->cp["masa_awal"]->GetValue())) 
            $this->cp["masa_awal"]->SetValue($this->masa_awal->GetValue(true));
        if (!is_null($this->cp["masa_akhir"]->GetValue()) and !strlen($this->cp["masa_akhir"]->GetText()) and !is_bool($this->cp["masa_akhir"]->GetValue())) 
            $this->cp["masa_akhir"]->SetValue($this->masa_akhir->GetValue(true));
        $this->SQL = "UPDATE t_cust_acc_masa_jab \n" .
        "SET update_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "nama='" . $this->SQLValue($this->cp["nama"]->GetDBValue(), ccsText) . "', \n" .
        "masa_awal='" . $this->SQLValue($this->cp["masa_awal"]->GetDBValue(), ccsText) . "', \n" .
        "masa_akhir='" . $this->SQLValue($this->cp["masa_akhir"]->GetDBValue(), ccsText) . "'\n" .
        "where \n" .
        "t_cust_acc_masa_jab_id=" . $this->SQLValue($this->cp["t_cust_acc_masa_jab_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-86E3A1D9
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_cust_acc_masa_jab_id"] = new clsSQLParameter("ctrlt_cust_acc_masa_jab_id", ccsFloat, "", "", $this->t_cust_acc_masa_jab_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_cust_acc_masa_jab_id"]->GetValue()) and !strlen($this->cp["t_cust_acc_masa_jab_id"]->GetText()) and !is_bool($this->cp["t_cust_acc_masa_jab_id"]->GetValue())) 
            $this->cp["t_cust_acc_masa_jab_id"]->SetValue($this->t_cust_acc_masa_jab_id->GetValue(true));
        if (!strlen($this->cp["t_cust_acc_masa_jab_id"]->GetText()) and !is_bool($this->cp["t_cust_acc_masa_jab_id"]->GetValue(true))) 
            $this->cp["t_cust_acc_masa_jab_id"]->SetText(0);
        $this->SQL = "DELETE FROM t_cust_acc_masa_jab\n" .
        "where \n" .
        "t_cust_acc_masa_jab_id = " . $this->SQLValue($this->cp["t_cust_acc_masa_jab_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_cacc_legal_docFormDataSource Class @94-FCB6E20C

//Initialize Page @1-223D2F73
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
$TemplateFileName = "t_cacc_masa_jab.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C48D9673
include_once("./t_cacc_masa_jab_events.php");
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
