<?php
//Include Common Files @1-D3582E2C
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "inquery_bphtb_ws.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files



class clsRecordLOV { //LOV Class @3-40E97705

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

//Class_Initialize Event @3-7BB99CCE
    function clsRecordLOV($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record LOV/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "LOV";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->NOP_SEARCH = & new clsControl(ccsTextBox, "NOP_SEARCH", "NOP_SEARCH", ccsText, "", CCGetRequestParam("NOP_SEARCH", $Method, NULL), $this);
            $this->FORM = & new clsControl(ccsTextBox, "FORM", "FORM", ccsText, "", CCGetRequestParam("FORM", $Method, NULL), $this);
            $this->OBJ = & new clsControl(ccsTextBox, "OBJ", "OBJ", ccsText, "", CCGetRequestParam("OBJ", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->TAHUN_SEARCH = & new clsControl(ccsListBox, "TAHUN_SEARCH", "TAHUN_SEARCH", ccsText, "", CCGetRequestParam("TAHUN_SEARCH", $Method, NULL), $this);
            $this->TAHUN_SEARCH->DSType = dsSQL;
            $this->TAHUN_SEARCH->DataSource = new clsDBConnSIKP();
            $this->TAHUN_SEARCH->ds = & $this->TAHUN_SEARCH->DataSource;
            list($this->TAHUN_SEARCH->BoundColumn, $this->TAHUN_SEARCH->TextColumn, $this->TAHUN_SEARCH->DBFormat) = array("year_code", "year_code", "");
            $this->TAHUN_SEARCH->DataSource->SQL = "SELECT * \n" .
            "FROM p_year_period  {SQL_OrderBy}";
            $this->TAHUN_SEARCH->DataSource->Order = "year_code DESC";
            if(!$this->FormSubmitted) {
                if(!is_array($this->TAHUN_SEARCH->Value) && !strlen($this->TAHUN_SEARCH->Value) && $this->TAHUN_SEARCH->Value !== false)
                    $this->TAHUN_SEARCH->SetText(date("Y"));
            }
        }
    }
//End Class_Initialize Event

//Validate Method @3-2883B960
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->NOP_SEARCH->Validate() && $Validation);
        $Validation = ($this->FORM->Validate() && $Validation);
        $Validation = ($this->OBJ->Validate() && $Validation);
        $Validation = ($this->TAHUN_SEARCH->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->NOP_SEARCH->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FORM->Errors->Count() == 0);
        $Validation =  $Validation && ($this->OBJ->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TAHUN_SEARCH->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-6BF9EE3D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->NOP_SEARCH->Errors->Count());
        $errors = ($errors || $this->FORM->Errors->Count());
        $errors = ($errors || $this->OBJ->Errors->Count());
        $errors = ($errors || $this->TAHUN_SEARCH->Errors->Count());
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

//Operation Method @3-57D459AB
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
        $Redirect = "inquery_bphtb_ws.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "inquery_bphtb_ws.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-C802887F
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

        $this->TAHUN_SEARCH->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->NOP_SEARCH->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FORM->Errors->ToString());
            $Error = ComposeStrings($Error, $this->OBJ->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TAHUN_SEARCH->Errors->ToString());
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

        $this->NOP_SEARCH->Show();
        $this->FORM->Show();
        $this->OBJ->Show();
        $this->Button_DoSearch->Show();
        $this->TAHUN_SEARCH->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End LOV Class @3-FCB6E20C

class clsRecordbphtb_wsForm { //bphtb_wsForm Class @51-99B46739

//Variables @51-D6FF3E86

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

//Class_Initialize Event @51-4F065C0E
    function clsRecordbphtb_wsForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record bphtb_wsForm/Error";
        $this->DataSource = new clsbphtb_wsFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "bphtb_wsForm";
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
            $this->NOP = & new clsControl(ccsTextBox, "NOP", "NOP", ccsText, "", CCGetRequestParam("NOP", $Method, NULL), $this);
            $this->kota = & new clsControl(ccsTextBox, "kota", "kota", ccsText, "", CCGetRequestParam("kota", $Method, NULL), $this);
            $this->kecamatan = & new clsControl(ccsTextBox, "kecamatan", "kecamatan", ccsText, "", CCGetRequestParam("kecamatan", $Method, NULL), $this);
            $this->kelurahan = & new clsControl(ccsTextBox, "kelurahan", "kelurahan", ccsText, "", CCGetRequestParam("kelurahan", $Method, NULL), $this);
            $this->jalan = & new clsControl(ccsTextBox, "jalan", "jalan", ccsText, "", CCGetRequestParam("jalan", $Method, NULL), $this);
            $this->rt = & new clsControl(ccsTextBox, "rt", "rt", ccsText, "", CCGetRequestParam("rt", $Method, NULL), $this);
            $this->rw = & new clsControl(ccsTextBox, "rw", "rw", ccsText, "", CCGetRequestParam("rw", $Method, NULL), $this);
            $this->luas_bumi = & new clsControl(ccsTextBox, "luas_bumi", "luas_bumi", ccsText, "", CCGetRequestParam("luas_bumi", $Method, NULL), $this);
            $this->luas_bangunan = & new clsControl(ccsTextBox, "luas_bangunan", "luas_bangunan", ccsText, "", CCGetRequestParam("luas_bangunan", $Method, NULL), $this);
            $this->njop_bangunan = & new clsControl(ccsTextBox, "njop_bangunan", "njop_bangunan", ccsText, "", CCGetRequestParam("njop_bangunan", $Method, NULL), $this);
            $this->njop_bumi = & new clsControl(ccsTextBox, "njop_bumi", "njop_bumi", ccsText, "", CCGetRequestParam("njop_bumi", $Method, NULL), $this);
            $this->njop_pbb = & new clsControl(ccsTextBox, "njop_pbb", "njop_pbb", ccsText, "", CCGetRequestParam("njop_pbb", $Method, NULL), $this);
            $this->pbb_terhutang = & new clsControl(ccsTextBox, "pbb_terhutang", "pbb_terhutang", ccsText, "", CCGetRequestParam("pbb_terhutang", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @51-ED145515
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_bphtb_registration_id"] = CCGetFromGet("t_bphtb_registration_id", NULL);
    }
//End Initialize Method

//Validate Method @51-28400909
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->NOP->Validate() && $Validation);
        $Validation = ($this->kota->Validate() && $Validation);
        $Validation = ($this->kecamatan->Validate() && $Validation);
        $Validation = ($this->kelurahan->Validate() && $Validation);
        $Validation = ($this->jalan->Validate() && $Validation);
        $Validation = ($this->rt->Validate() && $Validation);
        $Validation = ($this->rw->Validate() && $Validation);
        $Validation = ($this->luas_bumi->Validate() && $Validation);
        $Validation = ($this->luas_bangunan->Validate() && $Validation);
        $Validation = ($this->njop_bangunan->Validate() && $Validation);
        $Validation = ($this->njop_bumi->Validate() && $Validation);
        $Validation = ($this->njop_pbb->Validate() && $Validation);
        $Validation = ($this->pbb_terhutang->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->NOP->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kota->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->jalan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->luas_bumi->Errors->Count() == 0);
        $Validation =  $Validation && ($this->luas_bangunan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->njop_bangunan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->njop_bumi->Errors->Count() == 0);
        $Validation =  $Validation && ($this->njop_pbb->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pbb_terhutang->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @51-06CB6F73
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->NOP->Errors->Count());
        $errors = ($errors || $this->kota->Errors->Count());
        $errors = ($errors || $this->kecamatan->Errors->Count());
        $errors = ($errors || $this->kelurahan->Errors->Count());
        $errors = ($errors || $this->jalan->Errors->Count());
        $errors = ($errors || $this->rt->Errors->Count());
        $errors = ($errors || $this->rw->Errors->Count());
        $errors = ($errors || $this->luas_bumi->Errors->Count());
        $errors = ($errors || $this->luas_bangunan->Errors->Count());
        $errors = ($errors || $this->njop_bangunan->Errors->Count());
        $errors = ($errors || $this->njop_bumi->Errors->Count());
        $errors = ($errors || $this->njop_pbb->Errors->Count());
        $errors = ($errors || $this->pbb_terhutang->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @51-ED598703
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

//Operation Method @51-6A904D8F
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = "t_bphtb_registration_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = "t_bphtb_registration_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
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

//InsertRow Method @51-3C052326
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
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
        $this->DataSource->p_bphtb_legal_doc_type_id->SetValue($this->p_bphtb_legal_doc_type_id->GetValue(true));
        $this->DataSource->land_area->SetValue($this->land_area->GetValue(true));
        $this->DataSource->land_price_per_m->SetValue($this->land_price_per_m->GetValue(true));
        $this->DataSource->land_total_price->SetValue($this->land_total_price->GetValue(true));
        $this->DataSource->building_area->SetValue($this->building_area->GetValue(true));
        $this->DataSource->building_price_per_m->SetValue($this->building_price_per_m->GetValue(true));
        $this->DataSource->building_total_price->SetValue($this->building_total_price->GetValue(true));
        $this->DataSource->market_price->SetValue($this->market_price->GetValue(true));
        $this->DataSource->npop->SetValue($this->npop->GetValue(true));
        $this->DataSource->npop_tkp->SetValue($this->npop_tkp->GetValue(true));
        $this->DataSource->npop_kp->SetValue($this->npop_kp->GetValue(true));
        $this->DataSource->bphtb_amt->SetValue($this->bphtb_amt->GetValue(true));
        $this->DataSource->bphtb_discount->SetValue($this->bphtb_discount->GetValue(true));
        $this->DataSource->bphtb_amt_final->SetValue($this->bphtb_amt_final->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->jenis_harga_bphtb->SetValue($this->jenis_harga_bphtb->GetValue(true));
        $this->DataSource->bphtb_legal_doc_description->SetValue($this->bphtb_legal_doc_description->GetValue(true));
        $this->DataSource->add_disc_percent->SetValue($this->add_disc_percent->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @51-91F2EA44
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_bphtb_registration_id->SetValue($this->t_bphtb_registration_id->GetValue(true));
        $this->DataSource->wp_p_region_id->SetValue($this->wp_p_region_id->GetValue(true));
        $this->DataSource->wp_p_region_id_kel->SetValue($this->wp_p_region_id_kel->GetValue(true));
        $this->DataSource->wp_name->SetValue($this->wp_name->GetValue(true));
        $this->DataSource->wp_address_name->SetValue($this->wp_address_name->GetValue(true));
        $this->DataSource->npwp->SetValue($this->npwp->GetValue(true));
        $this->DataSource->object_p_region_id_kec->SetValue($this->object_p_region_id_kec->GetValue(true));
        $this->DataSource->object_p_region_id->SetValue($this->object_p_region_id->GetValue(true));
        $this->DataSource->land_area->SetValue($this->land_area->GetValue(true));
        $this->DataSource->land_price_per_m->SetValue($this->land_price_per_m->GetValue(true));
        $this->DataSource->land_total_price->SetValue($this->land_total_price->GetValue(true));
        $this->DataSource->building_area->SetValue($this->building_area->GetValue(true));
        $this->DataSource->building_price_per_m->SetValue($this->building_price_per_m->GetValue(true));
        $this->DataSource->building_total_price->SetValue($this->building_total_price->GetValue(true));
        $this->DataSource->wp_rt->SetValue($this->wp_rt->GetValue(true));
        $this->DataSource->wp_rw->SetValue($this->wp_rw->GetValue(true));
        $this->DataSource->object_rt->SetValue($this->object_rt->GetValue(true));
        $this->DataSource->object_rw->SetValue($this->object_rw->GetValue(true));
        $this->DataSource->njop_pbb->SetValue($this->njop_pbb->GetValue(true));
        $this->DataSource->object_address_name->SetValue($this->object_address_name->GetValue(true));
        $this->DataSource->p_bphtb_legal_doc_type_id->SetValue($this->p_bphtb_legal_doc_type_id->GetValue(true));
        $this->DataSource->npop->SetValue($this->npop->GetValue(true));
        $this->DataSource->npop_tkp->SetValue($this->npop_tkp->GetValue(true));
        $this->DataSource->npop_kp->SetValue($this->npop_kp->GetValue(true));
        $this->DataSource->bphtb_amt->SetValue($this->bphtb_amt->GetValue(true));
        $this->DataSource->bphtb_amt_final->SetValue($this->bphtb_amt_final->GetValue(true));
        $this->DataSource->bphtb_discount->SetValue($this->bphtb_discount->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->market_price->SetValue($this->market_price->GetValue(true));
        $this->DataSource->mobile_phone_no->SetValue($this->mobile_phone_no->GetValue(true));
        $this->DataSource->wp_p_region_id_kec->SetValue($this->wp_p_region_id_kec->GetValue(true));
        $this->DataSource->object_p_region_id_kel->SetValue($this->object_p_region_id_kel->GetValue(true));
        $this->DataSource->jenis_harga_bphtb->SetValue($this->jenis_harga_bphtb->GetValue(true));
        $this->DataSource->bphtb_legal_doc_description->SetValue($this->bphtb_legal_doc_description->GetValue(true));
        $this->DataSource->add_disc_percent->SetValue($this->add_disc_percent->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @51-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @51-23135485
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
                    $this->NOP->SetValue($this->DataSource->NOP->GetValue());
                    $this->kota->SetValue($this->DataSource->kota->GetValue());
                    $this->kecamatan->SetValue($this->DataSource->kecamatan->GetValue());
                    $this->kelurahan->SetValue($this->DataSource->kelurahan->GetValue());
                    $this->jalan->SetValue($this->DataSource->jalan->GetValue());
                    $this->rt->SetValue($this->DataSource->rt->GetValue());
                    $this->rw->SetValue($this->DataSource->rw->GetValue());
                    $this->luas_bumi->SetValue($this->DataSource->luas_bumi->GetValue());
                    $this->luas_bangunan->SetValue($this->DataSource->luas_bangunan->GetValue());
                    $this->njop_bangunan->SetValue($this->DataSource->njop_bangunan->GetValue());
                    $this->njop_bumi->SetValue($this->DataSource->njop_bumi->GetValue());
                    $this->njop_pbb->SetValue($this->DataSource->njop_pbb->GetValue());
                    $this->pbb_terhutang->SetValue($this->DataSource->pbb_terhutang->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->NOP->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->jalan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->luas_bumi->Errors->ToString());
            $Error = ComposeStrings($Error, $this->luas_bangunan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->njop_bangunan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->njop_bumi->Errors->ToString());
            $Error = ComposeStrings($Error, $this->njop_pbb->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pbb_terhutang->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->NOP->Show();
        $this->kota->Show();
        $this->kecamatan->Show();
        $this->kelurahan->Show();
        $this->jalan->Show();
        $this->rt->Show();
        $this->rw->Show();
        $this->luas_bumi->Show();
        $this->luas_bangunan->Show();
        $this->njop_bangunan->Show();
        $this->njop_bumi->Show();
        $this->njop_pbb->Show();
        $this->pbb_terhutang->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End bphtb_wsForm Class @51-FCB6E20C

class clsbphtb_wsFormDataSource extends clsDBConnSIKP {  //bphtb_wsFormDataSource Class @51-712692FB

//DataSource Variables @51-242DFC92
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

    var $UpdateFields = array();

    // Datasource fields
    var $NOP;
    var $kota;
    var $kecamatan;
    var $kelurahan;
    var $jalan;
    var $rt;
    var $rw;
    var $luas_bumi;
    var $luas_bangunan;
    var $njop_bangunan;
    var $njop_bumi;
    var $njop_pbb;
    var $pbb_terhutang;
//End DataSource Variables

//DataSourceClass_Initialize Event @51-E15A1000
    function clsbphtb_wsFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record bphtb_wsForm/Error";
        $this->Initialize();
        $this->NOP = new clsField("NOP", ccsText, "");
        
        $this->kota = new clsField("kota", ccsText, "");
        
        $this->kecamatan = new clsField("kecamatan", ccsText, "");
        
        $this->kelurahan = new clsField("kelurahan", ccsText, "");
        
        $this->jalan = new clsField("jalan", ccsText, "");
        
        $this->rt = new clsField("rt", ccsText, "");
        
        $this->rw = new clsField("rw", ccsText, "");
        
        $this->luas_bumi = new clsField("luas_bumi", ccsText, "");
        
        $this->luas_bangunan = new clsField("luas_bangunan", ccsText, "");
        
        $this->njop_bangunan = new clsField("njop_bangunan", ccsText, "");
        
        $this->njop_bumi = new clsField("njop_bumi", ccsText, "");
        
        $this->njop_pbb = new clsField("njop_pbb", ccsText, "");
        
        $this->pbb_terhutang = new clsField("pbb_terhutang", ccsText, "");
        

        $this->UpdateFields["updated_by"] = array("Name" => "updated_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["updated_date"] = array("Name" => "updated_date", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wp_p_region_id"] = array("Name" => "wp_p_region_id", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["wp_p_region_id_kel"] = array("Name" => "wp_p_region_id_kel", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["wp_name"] = array("Name" => "wp_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wp_address_name"] = array("Name" => "wp_address_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["npwp"] = array("Name" => "npwp", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["object_p_region_id_kec"] = array("Name" => "object_p_region_id_kec", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["object_p_region_id"] = array("Name" => "object_p_region_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["land_area"] = array("Name" => "land_area", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["land_price_per_m"] = array("Name" => "land_price_per_m", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["land_total_price"] = array("Name" => "land_total_price", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["building_area"] = array("Name" => "building_area", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["building_price_per_m"] = array("Name" => "building_price_per_m", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["building_total_price"] = array("Name" => "building_total_price", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["wp_rt"] = array("Name" => "wp_rt", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wp_rw"] = array("Name" => "wp_rw", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["object_rt"] = array("Name" => "object_rt", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["object_rw"] = array("Name" => "object_rw", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["njop_pbb"] = array("Name" => "njop_pbb", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["object_address_name"] = array("Name" => "object_address_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["p_bphtb_legal_doc_type_id"] = array("Name" => "p_bphtb_legal_doc_type_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["npop"] = array("Name" => "npop", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["npop_tkp"] = array("Name" => "npop_tkp", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["npop_kp"] = array("Name" => "npop_kp", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["bphtb_amt"] = array("Name" => "bphtb_amt", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["bphtb_amt_final"] = array("Name" => "bphtb_amt_final", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["bphtb_discount"] = array("Name" => "bphtb_discount", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["description"] = array("Name" => "description", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["market_price"] = array("Name" => "market_price", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["mobile_phone_no"] = array("Name" => "mobile_phone_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wp_p_region_id_kec"] = array("Name" => "wp_p_region_id_kec", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["object_p_region_id_kel"] = array("Name" => "object_p_region_id_kel", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["jenis_harga_bphtb"] = array("Name" => "jenis_harga_bphtb", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["bphtb_legal_doc_description"] = array("Name" => "bphtb_legal_doc_description", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["add_disc_percent"] = array("Name" => "add_disc_percent", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @51-A34FC581
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_bphtb_registration_id", ccsText, "", "", $this->Parameters["urlt_bphtb_registration_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @51-9BC57282
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select a.*,\n" .
        "b.region_name as wp_kota,\n" .
        "c.region_name as wp_kecamatan,\n" .
        "d.region_name as wp_kelurahan,\n" .
        "e.region_name as object_region,\n" .
        "f.region_name as object_kecamatan,\n" .
        "g.region_name as object_kelurahan,\n" .
        "h.description as doc_name,\n" .
        "(a.bphtb_amt - a.bphtb_discount) AS bphtb_amt_final_old,\n" .
        "j.payment_vat_amount AS prev_payment_amount\n" .
        "\n" .
        "from t_bphtb_registration as a \n" .
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
        "left join p_bphtb_legal_doc_type as h\n" .
        "	on a.p_bphtb_legal_doc_type_id = h.p_bphtb_legal_doc_type_id\n" .
        "left join t_bphtb_registration as i\n" .
        "	on a.registration_no_ref = i.registration_no\n" .
        "left join t_payment_receipt_bphtb as j\n" .
        "	on i.t_bphtb_registration_id = j.t_bphtb_registration_id\n" .
        "where a.t_bphtb_registration_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @51-D2926183
    function SetValues()
    {
        $this->NOP->SetDBValue($this->f("NOP"));
        $this->kota->SetDBValue($this->f("kota"));
        $this->kecamatan->SetDBValue($this->f("kecamatan"));
        $this->kelurahan->SetDBValue($this->f("kelurahan"));
        $this->jalan->SetDBValue($this->f("jalan"));
        $this->rt->SetDBValue($this->f("rt"));
        $this->rw->SetDBValue($this->f("kelurahan"));
        $this->luas_bumi->SetDBValue($this->f("luas_bumi"));
        $this->luas_bangunan->SetDBValue($this->f("luas_bangunan"));
        $this->njop_bangunan->SetDBValue($this->f("njop_bangunan"));
        $this->njop_bumi->SetDBValue($this->f("njop_bumi"));
        $this->njop_pbb->SetDBValue($this->f("njop_pbb"));
        $this->pbb_terhutang->SetDBValue($this->f("pbb_terhutang"));
    }
//End SetValues Method

//Insert Method @51-B301083A
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["wp_name"] = new clsSQLParameter("ctrlwp_name", ccsText, "", "", $this->wp_name->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["npwp"] = new clsSQLParameter("ctrlnpwp", ccsText, "", "", $this->npwp->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["wp_address_name"] = new clsSQLParameter("ctrlwp_address_name", ccsText, "", "", $this->wp_address_name->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["wp_rt"] = new clsSQLParameter("ctrlwp_rt", ccsText, "", "", $this->wp_rt->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["wp_rw"] = new clsSQLParameter("ctrlwp_rw", ccsText, "", "", $this->wp_rw->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["wp_p_region_id"] = new clsSQLParameter("ctrlwp_p_region_id", ccsFloat, "", "", $this->wp_p_region_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kec"] = new clsSQLParameter("ctrlwp_p_region_id_kec", ccsFloat, "", "", $this->wp_p_region_id_kec->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kel"] = new clsSQLParameter("ctrlwp_p_region_id_kel", ccsFloat, "", "", $this->wp_p_region_id_kel->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["phone_no"] = new clsSQLParameter("ctrlphone_no", ccsText, "", "", $this->phone_no->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["mobile_phone_no"] = new clsSQLParameter("ctrlmobile_phone_no", ccsText, "", "", $this->mobile_phone_no->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["njop_pbb"] = new clsSQLParameter("ctrlnjop_pbb", ccsText, "", "", $this->njop_pbb->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["object_address_name"] = new clsSQLParameter("ctrlobject_address_name", ccsText, "", "", $this->object_address_name->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["object_rt"] = new clsSQLParameter("ctrlobject_rt", ccsText, "", "", $this->object_rt->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["object_rw"] = new clsSQLParameter("ctrlobject_rw", ccsText, "", "", $this->object_rw->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["object_p_region_id"] = new clsSQLParameter("ctrlobject_p_region_id", ccsText, "", "", $this->object_p_region_id->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["object_p_region_id_kec"] = new clsSQLParameter("ctrlobject_p_region_id_kec", ccsText, "", "", $this->object_p_region_id_kec->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["object_p_region_id_kel"] = new clsSQLParameter("ctrlobject_p_region_id_kel", ccsText, "", "", $this->object_p_region_id_kel->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["p_bphtb_legal_doc_type_id"] = new clsSQLParameter("ctrlp_bphtb_legal_doc_type_id", ccsFloat, "", "", $this->p_bphtb_legal_doc_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["land_area"] = new clsSQLParameter("ctrlland_area", ccsFloat, "", "", $this->land_area->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["land_price_per_m"] = new clsSQLParameter("ctrlland_price_per_m", ccsFloat, "", "", $this->land_price_per_m->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["land_total_price"] = new clsSQLParameter("ctrlland_total_price", ccsFloat, "", "", $this->land_total_price->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["building_area"] = new clsSQLParameter("ctrlbuilding_area", ccsFloat, "", "", $this->building_area->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["building_price_per_m"] = new clsSQLParameter("ctrlbuilding_price_per_m", ccsFloat, "", "", $this->building_price_per_m->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["building_total_price"] = new clsSQLParameter("ctrlbuilding_total_price", ccsFloat, "", "", $this->building_total_price->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["market_price"] = new clsSQLParameter("ctrlmarket_price", ccsFloat, "", "", $this->market_price->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["npop"] = new clsSQLParameter("ctrlnpop", ccsFloat, "", "", $this->npop->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["npop_tkp"] = new clsSQLParameter("ctrlnpop_tkp", ccsFloat, "", "", $this->npop_tkp->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["npop_kp"] = new clsSQLParameter("ctrlnpop_kp", ccsFloat, "", "", $this->npop_kp->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["bphtb_amt"] = new clsSQLParameter("ctrlbphtb_amt", ccsFloat, "", "", $this->bphtb_amt->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["bphtb_discount"] = new clsSQLParameter("ctrlbphtb_discount", ccsFloat, "", "", $this->bphtb_discount->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["bphtb_amt_final"] = new clsSQLParameter("ctrlbphtb_amt_final", ccsFloat, "", "", $this->bphtb_amt_final->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["i_user"] = new clsSQLParameter("sesUserLogin", ccsText, "", "", CCGetSession("UserLogin", NULL), "", false, $this->ErrorBlock);
        $this->cp["jenis_harga_bphtb"] = new clsSQLParameter("ctrljenis_harga_bphtb", ccsFloat, "", "", $this->jenis_harga_bphtb->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["bphtb_legal_doc_description"] = new clsSQLParameter("ctrlbphtb_legal_doc_description", ccsText, "", "", $this->bphtb_legal_doc_description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["add_disc_percent"] = new clsSQLParameter("ctrladd_disc_percent", ccsFloat, "", "", $this->add_disc_percent->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["o_t_bphtb_registration_id"] = new clsSQLParameter("urlo_t_bphtb_registration_id", ccsFloat, "", "", CCGetFromGet("o_t_bphtb_registration_id", NULL), "", false, $this->ErrorBlock);
        $this->cp["o_mess"] = new clsSQLParameter("urlo_mess", ccsText, "", "", CCGetFromGet("o_mess", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["wp_name"]->GetValue()) and !strlen($this->cp["wp_name"]->GetText()) and !is_bool($this->cp["wp_name"]->GetValue())) 
            $this->cp["wp_name"]->SetValue($this->wp_name->GetValue(true));
        if (!strlen($this->cp["wp_name"]->GetText()) and !is_bool($this->cp["wp_name"]->GetValue(true))) 
            $this->cp["wp_name"]->SetText("-");
        if (!is_null($this->cp["npwp"]->GetValue()) and !strlen($this->cp["npwp"]->GetText()) and !is_bool($this->cp["npwp"]->GetValue())) 
            $this->cp["npwp"]->SetValue($this->npwp->GetValue(true));
        if (!strlen($this->cp["npwp"]->GetText()) and !is_bool($this->cp["npwp"]->GetValue(true))) 
            $this->cp["npwp"]->SetText("-");
        if (!is_null($this->cp["wp_address_name"]->GetValue()) and !strlen($this->cp["wp_address_name"]->GetText()) and !is_bool($this->cp["wp_address_name"]->GetValue())) 
            $this->cp["wp_address_name"]->SetValue($this->wp_address_name->GetValue(true));
        if (!strlen($this->cp["wp_address_name"]->GetText()) and !is_bool($this->cp["wp_address_name"]->GetValue(true))) 
            $this->cp["wp_address_name"]->SetText("-");
        if (!is_null($this->cp["wp_rt"]->GetValue()) and !strlen($this->cp["wp_rt"]->GetText()) and !is_bool($this->cp["wp_rt"]->GetValue())) 
            $this->cp["wp_rt"]->SetValue($this->wp_rt->GetValue(true));
        if (!strlen($this->cp["wp_rt"]->GetText()) and !is_bool($this->cp["wp_rt"]->GetValue(true))) 
            $this->cp["wp_rt"]->SetText("-");
        if (!is_null($this->cp["wp_rw"]->GetValue()) and !strlen($this->cp["wp_rw"]->GetText()) and !is_bool($this->cp["wp_rw"]->GetValue())) 
            $this->cp["wp_rw"]->SetValue($this->wp_rw->GetValue(true));
        if (!strlen($this->cp["wp_rw"]->GetText()) and !is_bool($this->cp["wp_rw"]->GetValue(true))) 
            $this->cp["wp_rw"]->SetText("-");
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
        if (!strlen($this->cp["phone_no"]->GetText()) and !is_bool($this->cp["phone_no"]->GetValue(true))) 
            $this->cp["phone_no"]->SetText("-");
        if (!is_null($this->cp["mobile_phone_no"]->GetValue()) and !strlen($this->cp["mobile_phone_no"]->GetText()) and !is_bool($this->cp["mobile_phone_no"]->GetValue())) 
            $this->cp["mobile_phone_no"]->SetValue($this->mobile_phone_no->GetValue(true));
        if (!strlen($this->cp["mobile_phone_no"]->GetText()) and !is_bool($this->cp["mobile_phone_no"]->GetValue(true))) 
            $this->cp["mobile_phone_no"]->SetText("-");
        if (!is_null($this->cp["njop_pbb"]->GetValue()) and !strlen($this->cp["njop_pbb"]->GetText()) and !is_bool($this->cp["njop_pbb"]->GetValue())) 
            $this->cp["njop_pbb"]->SetValue($this->njop_pbb->GetValue(true));
        if (!strlen($this->cp["njop_pbb"]->GetText()) and !is_bool($this->cp["njop_pbb"]->GetValue(true))) 
            $this->cp["njop_pbb"]->SetText("-");
        if (!is_null($this->cp["object_address_name"]->GetValue()) and !strlen($this->cp["object_address_name"]->GetText()) and !is_bool($this->cp["object_address_name"]->GetValue())) 
            $this->cp["object_address_name"]->SetValue($this->object_address_name->GetValue(true));
        if (!strlen($this->cp["object_address_name"]->GetText()) and !is_bool($this->cp["object_address_name"]->GetValue(true))) 
            $this->cp["object_address_name"]->SetText("-");
        if (!is_null($this->cp["object_rt"]->GetValue()) and !strlen($this->cp["object_rt"]->GetText()) and !is_bool($this->cp["object_rt"]->GetValue())) 
            $this->cp["object_rt"]->SetValue($this->object_rt->GetValue(true));
        if (!strlen($this->cp["object_rt"]->GetText()) and !is_bool($this->cp["object_rt"]->GetValue(true))) 
            $this->cp["object_rt"]->SetText("-");
        if (!is_null($this->cp["object_rw"]->GetValue()) and !strlen($this->cp["object_rw"]->GetText()) and !is_bool($this->cp["object_rw"]->GetValue())) 
            $this->cp["object_rw"]->SetValue($this->object_rw->GetValue(true));
        if (!strlen($this->cp["object_rw"]->GetText()) and !is_bool($this->cp["object_rw"]->GetValue(true))) 
            $this->cp["object_rw"]->SetText("-");
        if (!is_null($this->cp["object_p_region_id"]->GetValue()) and !strlen($this->cp["object_p_region_id"]->GetText()) and !is_bool($this->cp["object_p_region_id"]->GetValue())) 
            $this->cp["object_p_region_id"]->SetValue($this->object_p_region_id->GetValue(true));
        if (!strlen($this->cp["object_p_region_id"]->GetText()) and !is_bool($this->cp["object_p_region_id"]->GetValue(true))) 
            $this->cp["object_p_region_id"]->SetText("-");
        if (!is_null($this->cp["object_p_region_id_kec"]->GetValue()) and !strlen($this->cp["object_p_region_id_kec"]->GetText()) and !is_bool($this->cp["object_p_region_id_kec"]->GetValue())) 
            $this->cp["object_p_region_id_kec"]->SetValue($this->object_p_region_id_kec->GetValue(true));
        if (!strlen($this->cp["object_p_region_id_kec"]->GetText()) and !is_bool($this->cp["object_p_region_id_kec"]->GetValue(true))) 
            $this->cp["object_p_region_id_kec"]->SetText("-");
        if (!is_null($this->cp["object_p_region_id_kel"]->GetValue()) and !strlen($this->cp["object_p_region_id_kel"]->GetText()) and !is_bool($this->cp["object_p_region_id_kel"]->GetValue())) 
            $this->cp["object_p_region_id_kel"]->SetValue($this->object_p_region_id_kel->GetValue(true));
        if (!strlen($this->cp["object_p_region_id_kel"]->GetText()) and !is_bool($this->cp["object_p_region_id_kel"]->GetValue(true))) 
            $this->cp["object_p_region_id_kel"]->SetText("-");
        if (!is_null($this->cp["p_bphtb_legal_doc_type_id"]->GetValue()) and !strlen($this->cp["p_bphtb_legal_doc_type_id"]->GetText()) and !is_bool($this->cp["p_bphtb_legal_doc_type_id"]->GetValue())) 
            $this->cp["p_bphtb_legal_doc_type_id"]->SetValue($this->p_bphtb_legal_doc_type_id->GetValue(true));
        if (!strlen($this->cp["p_bphtb_legal_doc_type_id"]->GetText()) and !is_bool($this->cp["p_bphtb_legal_doc_type_id"]->GetValue(true))) 
            $this->cp["p_bphtb_legal_doc_type_id"]->SetText(0);
        if (!is_null($this->cp["land_area"]->GetValue()) and !strlen($this->cp["land_area"]->GetText()) and !is_bool($this->cp["land_area"]->GetValue())) 
            $this->cp["land_area"]->SetValue($this->land_area->GetValue(true));
        if (!strlen($this->cp["land_area"]->GetText()) and !is_bool($this->cp["land_area"]->GetValue(true))) 
            $this->cp["land_area"]->SetText(0);
        if (!is_null($this->cp["land_price_per_m"]->GetValue()) and !strlen($this->cp["land_price_per_m"]->GetText()) and !is_bool($this->cp["land_price_per_m"]->GetValue())) 
            $this->cp["land_price_per_m"]->SetValue($this->land_price_per_m->GetValue(true));
        if (!strlen($this->cp["land_price_per_m"]->GetText()) and !is_bool($this->cp["land_price_per_m"]->GetValue(true))) 
            $this->cp["land_price_per_m"]->SetText(0);
        if (!is_null($this->cp["land_total_price"]->GetValue()) and !strlen($this->cp["land_total_price"]->GetText()) and !is_bool($this->cp["land_total_price"]->GetValue())) 
            $this->cp["land_total_price"]->SetValue($this->land_total_price->GetValue(true));
        if (!strlen($this->cp["land_total_price"]->GetText()) and !is_bool($this->cp["land_total_price"]->GetValue(true))) 
            $this->cp["land_total_price"]->SetText(0);
        if (!is_null($this->cp["building_area"]->GetValue()) and !strlen($this->cp["building_area"]->GetText()) and !is_bool($this->cp["building_area"]->GetValue())) 
            $this->cp["building_area"]->SetValue($this->building_area->GetValue(true));
        if (!strlen($this->cp["building_area"]->GetText()) and !is_bool($this->cp["building_area"]->GetValue(true))) 
            $this->cp["building_area"]->SetText(0);
        if (!is_null($this->cp["building_price_per_m"]->GetValue()) and !strlen($this->cp["building_price_per_m"]->GetText()) and !is_bool($this->cp["building_price_per_m"]->GetValue())) 
            $this->cp["building_price_per_m"]->SetValue($this->building_price_per_m->GetValue(true));
        if (!strlen($this->cp["building_price_per_m"]->GetText()) and !is_bool($this->cp["building_price_per_m"]->GetValue(true))) 
            $this->cp["building_price_per_m"]->SetText(0);
        if (!is_null($this->cp["building_total_price"]->GetValue()) and !strlen($this->cp["building_total_price"]->GetText()) and !is_bool($this->cp["building_total_price"]->GetValue())) 
            $this->cp["building_total_price"]->SetValue($this->building_total_price->GetValue(true));
        if (!strlen($this->cp["building_total_price"]->GetText()) and !is_bool($this->cp["building_total_price"]->GetValue(true))) 
            $this->cp["building_total_price"]->SetText(0);
        if (!is_null($this->cp["market_price"]->GetValue()) and !strlen($this->cp["market_price"]->GetText()) and !is_bool($this->cp["market_price"]->GetValue())) 
            $this->cp["market_price"]->SetValue($this->market_price->GetValue(true));
        if (!strlen($this->cp["market_price"]->GetText()) and !is_bool($this->cp["market_price"]->GetValue(true))) 
            $this->cp["market_price"]->SetText(0);
        if (!is_null($this->cp["npop"]->GetValue()) and !strlen($this->cp["npop"]->GetText()) and !is_bool($this->cp["npop"]->GetValue())) 
            $this->cp["npop"]->SetValue($this->npop->GetValue(true));
        if (!strlen($this->cp["npop"]->GetText()) and !is_bool($this->cp["npop"]->GetValue(true))) 
            $this->cp["npop"]->SetText(0);
        if (!is_null($this->cp["npop_tkp"]->GetValue()) and !strlen($this->cp["npop_tkp"]->GetText()) and !is_bool($this->cp["npop_tkp"]->GetValue())) 
            $this->cp["npop_tkp"]->SetValue($this->npop_tkp->GetValue(true));
        if (!strlen($this->cp["npop_tkp"]->GetText()) and !is_bool($this->cp["npop_tkp"]->GetValue(true))) 
            $this->cp["npop_tkp"]->SetText(0);
        if (!is_null($this->cp["npop_kp"]->GetValue()) and !strlen($this->cp["npop_kp"]->GetText()) and !is_bool($this->cp["npop_kp"]->GetValue())) 
            $this->cp["npop_kp"]->SetValue($this->npop_kp->GetValue(true));
        if (!strlen($this->cp["npop_kp"]->GetText()) and !is_bool($this->cp["npop_kp"]->GetValue(true))) 
            $this->cp["npop_kp"]->SetText(0);
        if (!is_null($this->cp["bphtb_amt"]->GetValue()) and !strlen($this->cp["bphtb_amt"]->GetText()) and !is_bool($this->cp["bphtb_amt"]->GetValue())) 
            $this->cp["bphtb_amt"]->SetValue($this->bphtb_amt->GetValue(true));
        if (!strlen($this->cp["bphtb_amt"]->GetText()) and !is_bool($this->cp["bphtb_amt"]->GetValue(true))) 
            $this->cp["bphtb_amt"]->SetText(0);
        if (!is_null($this->cp["bphtb_discount"]->GetValue()) and !strlen($this->cp["bphtb_discount"]->GetText()) and !is_bool($this->cp["bphtb_discount"]->GetValue())) 
            $this->cp["bphtb_discount"]->SetValue($this->bphtb_discount->GetValue(true));
        if (!strlen($this->cp["bphtb_discount"]->GetText()) and !is_bool($this->cp["bphtb_discount"]->GetValue(true))) 
            $this->cp["bphtb_discount"]->SetText(0);
        if (!is_null($this->cp["bphtb_amt_final"]->GetValue()) and !strlen($this->cp["bphtb_amt_final"]->GetText()) and !is_bool($this->cp["bphtb_amt_final"]->GetValue())) 
            $this->cp["bphtb_amt_final"]->SetValue($this->bphtb_amt_final->GetValue(true));
        if (!strlen($this->cp["bphtb_amt_final"]->GetText()) and !is_bool($this->cp["bphtb_amt_final"]->GetValue(true))) 
            $this->cp["bphtb_amt_final"]->SetText(0);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue(true))) 
            $this->cp["description"]->SetText("-");
        if (!is_null($this->cp["i_user"]->GetValue()) and !strlen($this->cp["i_user"]->GetText()) and !is_bool($this->cp["i_user"]->GetValue())) 
            $this->cp["i_user"]->SetValue(CCGetSession("UserLogin", NULL));
        if (!is_null($this->cp["jenis_harga_bphtb"]->GetValue()) and !strlen($this->cp["jenis_harga_bphtb"]->GetText()) and !is_bool($this->cp["jenis_harga_bphtb"]->GetValue())) 
            $this->cp["jenis_harga_bphtb"]->SetValue($this->jenis_harga_bphtb->GetValue(true));
        if (!is_null($this->cp["bphtb_legal_doc_description"]->GetValue()) and !strlen($this->cp["bphtb_legal_doc_description"]->GetText()) and !is_bool($this->cp["bphtb_legal_doc_description"]->GetValue())) 
            $this->cp["bphtb_legal_doc_description"]->SetValue($this->bphtb_legal_doc_description->GetValue(true));
        if (!is_null($this->cp["add_disc_percent"]->GetValue()) and !strlen($this->cp["add_disc_percent"]->GetText()) and !is_bool($this->cp["add_disc_percent"]->GetValue())) 
            $this->cp["add_disc_percent"]->SetValue($this->add_disc_percent->GetValue(true));
        if (!is_null($this->cp["o_t_bphtb_registration_id"]->GetValue()) and !strlen($this->cp["o_t_bphtb_registration_id"]->GetText()) and !is_bool($this->cp["o_t_bphtb_registration_id"]->GetValue())) 
            $this->cp["o_t_bphtb_registration_id"]->SetText(CCGetFromGet("o_t_bphtb_registration_id", NULL));
        if (!is_null($this->cp["o_mess"]->GetValue()) and !strlen($this->cp["o_mess"]->GetText()) and !is_bool($this->cp["o_mess"]->GetValue())) 
            $this->cp["o_mess"]->SetText(CCGetFromGet("o_mess", NULL));
        $this->SQL = "SELECT f_bphtb_registration (" . $this->ToSQL($this->cp["wp_name"]->GetDBValue(), $this->cp["wp_name"]->DataType) . ", "
             . $this->ToSQL($this->cp["npwp"]->GetDBValue(), $this->cp["npwp"]->DataType) . ", "
             . $this->ToSQL($this->cp["wp_address_name"]->GetDBValue(), $this->cp["wp_address_name"]->DataType) . ", "
             . $this->ToSQL($this->cp["wp_rt"]->GetDBValue(), $this->cp["wp_rt"]->DataType) . ", "
             . $this->ToSQL($this->cp["wp_rw"]->GetDBValue(), $this->cp["wp_rw"]->DataType) . ", "
             . $this->ToSQL($this->cp["wp_p_region_id"]->GetDBValue(), $this->cp["wp_p_region_id"]->DataType) . ", "
             . $this->ToSQL($this->cp["wp_p_region_id_kec"]->GetDBValue(), $this->cp["wp_p_region_id_kec"]->DataType) . ", "
             . $this->ToSQL($this->cp["wp_p_region_id_kel"]->GetDBValue(), $this->cp["wp_p_region_id_kel"]->DataType) . ", "
             . $this->ToSQL($this->cp["phone_no"]->GetDBValue(), $this->cp["phone_no"]->DataType) . ", "
             . $this->ToSQL($this->cp["mobile_phone_no"]->GetDBValue(), $this->cp["mobile_phone_no"]->DataType) . ", "
             . $this->ToSQL($this->cp["njop_pbb"]->GetDBValue(), $this->cp["njop_pbb"]->DataType) . ", "
             . $this->ToSQL($this->cp["object_address_name"]->GetDBValue(), $this->cp["object_address_name"]->DataType) . ", "
             . $this->ToSQL($this->cp["object_rt"]->GetDBValue(), $this->cp["object_rt"]->DataType) . ", "
             . $this->ToSQL($this->cp["object_rw"]->GetDBValue(), $this->cp["object_rw"]->DataType) . ", "
             . $this->ToSQL($this->cp["object_p_region_id"]->GetDBValue(), $this->cp["object_p_region_id"]->DataType) . ", "
             . $this->ToSQL($this->cp["object_p_region_id_kec"]->GetDBValue(), $this->cp["object_p_region_id_kec"]->DataType) . ", "
             . $this->ToSQL($this->cp["object_p_region_id_kel"]->GetDBValue(), $this->cp["object_p_region_id_kel"]->DataType) . ", "
             . $this->ToSQL($this->cp["p_bphtb_legal_doc_type_id"]->GetDBValue(), $this->cp["p_bphtb_legal_doc_type_id"]->DataType) . ", "
             . $this->ToSQL($this->cp["land_area"]->GetDBValue(), $this->cp["land_area"]->DataType) . ", "
             . $this->ToSQL($this->cp["land_price_per_m"]->GetDBValue(), $this->cp["land_price_per_m"]->DataType) . ", "
             . $this->ToSQL($this->cp["land_total_price"]->GetDBValue(), $this->cp["land_total_price"]->DataType) . ", "
             . $this->ToSQL($this->cp["building_area"]->GetDBValue(), $this->cp["building_area"]->DataType) . ", "
             . $this->ToSQL($this->cp["building_price_per_m"]->GetDBValue(), $this->cp["building_price_per_m"]->DataType) . ", "
             . $this->ToSQL($this->cp["building_total_price"]->GetDBValue(), $this->cp["building_total_price"]->DataType) . ", "
             . $this->ToSQL($this->cp["market_price"]->GetDBValue(), $this->cp["market_price"]->DataType) . ", "
             . $this->ToSQL($this->cp["npop"]->GetDBValue(), $this->cp["npop"]->DataType) . ", "
             . $this->ToSQL($this->cp["npop_tkp"]->GetDBValue(), $this->cp["npop_tkp"]->DataType) . ", "
             . $this->ToSQL($this->cp["npop_kp"]->GetDBValue(), $this->cp["npop_kp"]->DataType) . ", "
             . $this->ToSQL($this->cp["bphtb_amt"]->GetDBValue(), $this->cp["bphtb_amt"]->DataType) . ", "
             . $this->ToSQL($this->cp["bphtb_discount"]->GetDBValue(), $this->cp["bphtb_discount"]->DataType) . ", "
             . $this->ToSQL($this->cp["bphtb_amt_final"]->GetDBValue(), $this->cp["bphtb_amt_final"]->DataType) . ", "
             . $this->ToSQL($this->cp["description"]->GetDBValue(), $this->cp["description"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_user"]->GetDBValue(), $this->cp["i_user"]->DataType) . ", "
             . $this->ToSQL($this->cp["jenis_harga_bphtb"]->GetDBValue(), $this->cp["jenis_harga_bphtb"]->DataType) . ", "
             . $this->ToSQL($this->cp["bphtb_legal_doc_description"]->GetDBValue(), $this->cp["bphtb_legal_doc_description"]->DataType) . ", "
             . $this->ToSQL($this->cp["add_disc_percent"]->GetDBValue(), $this->cp["add_disc_percent"]->DataType) . ", "
             . $this->ToSQL($this->cp["o_t_bphtb_registration_id"]->GetDBValue(), $this->cp["o_t_bphtb_registration_id"]->DataType) . ", "
             . $this->ToSQL($this->cp["o_mess"]->GetDBValue(), $this->cp["o_mess"]->DataType) . ");";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @51-AE880FDE
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["updated_by"] = new clsSQLParameter("sesUserLogin", ccsText, "", "", CCGetSession("UserLogin", NULL), NULL, false, $this->ErrorBlock);
        $this->cp["updated_date"] = new clsSQLParameter("expr183", ccsText, "", "", date("Y-m-d H:i:s"), NULL, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id"] = new clsSQLParameter("ctrlwp_p_region_id", ccsFloat, "", "", $this->wp_p_region_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kel"] = new clsSQLParameter("ctrlwp_p_region_id_kel", ccsFloat, "", "", $this->wp_p_region_id_kel->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["wp_name"] = new clsSQLParameter("ctrlwp_name", ccsText, "", "", $this->wp_name->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["wp_address_name"] = new clsSQLParameter("ctrlwp_address_name", ccsText, "", "", $this->wp_address_name->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["npwp"] = new clsSQLParameter("ctrlnpwp", ccsText, "", "", $this->npwp->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["object_p_region_id_kec"] = new clsSQLParameter("ctrlobject_p_region_id_kec", ccsText, "", "", $this->object_p_region_id_kec->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["object_p_region_id"] = new clsSQLParameter("ctrlobject_p_region_id", ccsText, "", "", $this->object_p_region_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["land_area"] = new clsSQLParameter("ctrlland_area", ccsFloat, "", "", $this->land_area->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["land_price_per_m"] = new clsSQLParameter("ctrlland_price_per_m", ccsFloat, "", "", $this->land_price_per_m->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["land_total_price"] = new clsSQLParameter("ctrlland_total_price", ccsFloat, "", "", $this->land_total_price->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["building_area"] = new clsSQLParameter("ctrlbuilding_area", ccsFloat, "", "", $this->building_area->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["building_price_per_m"] = new clsSQLParameter("ctrlbuilding_price_per_m", ccsFloat, "", "", $this->building_price_per_m->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["building_total_price"] = new clsSQLParameter("ctrlbuilding_total_price", ccsFloat, "", "", $this->building_total_price->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["wp_rt"] = new clsSQLParameter("ctrlwp_rt", ccsText, "", "", $this->wp_rt->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["wp_rw"] = new clsSQLParameter("ctrlwp_rw", ccsText, "", "", $this->wp_rw->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["object_rt"] = new clsSQLParameter("ctrlobject_rt", ccsText, "", "", $this->object_rt->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["object_rw"] = new clsSQLParameter("ctrlobject_rw", ccsText, "", "", $this->object_rw->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["njop_pbb"] = new clsSQLParameter("ctrlnjop_pbb", ccsText, "", "", $this->njop_pbb->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["object_address_name"] = new clsSQLParameter("ctrlobject_address_name", ccsText, "", "", $this->object_address_name->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["p_bphtb_legal_doc_type_id"] = new clsSQLParameter("ctrlp_bphtb_legal_doc_type_id", ccsText, "", "", $this->p_bphtb_legal_doc_type_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["npop"] = new clsSQLParameter("ctrlnpop", ccsFloat, "", "", $this->npop->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["npop_tkp"] = new clsSQLParameter("ctrlnpop_tkp", ccsFloat, "", "", $this->npop_tkp->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["npop_kp"] = new clsSQLParameter("ctrlnpop_kp", ccsFloat, "", "", $this->npop_kp->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["bphtb_amt"] = new clsSQLParameter("ctrlbphtb_amt", ccsFloat, "", "", $this->bphtb_amt->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["bphtb_amt_final"] = new clsSQLParameter("ctrlbphtb_amt_final", ccsFloat, "", "", $this->bphtb_amt_final->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["bphtb_discount"] = new clsSQLParameter("ctrlbphtb_discount", ccsFloat, "", "", $this->bphtb_discount->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["market_price"] = new clsSQLParameter("ctrlmarket_price", ccsFloat, "", "", $this->market_price->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mobile_phone_no"] = new clsSQLParameter("ctrlmobile_phone_no", ccsText, "", "", $this->mobile_phone_no->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kec"] = new clsSQLParameter("ctrlwp_p_region_id_kec", ccsFloat, "", "", $this->wp_p_region_id_kec->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["object_p_region_id_kel"] = new clsSQLParameter("ctrlobject_p_region_id_kel", ccsFloat, "", "", $this->object_p_region_id_kel->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["jenis_harga_bphtb"] = new clsSQLParameter("ctrljenis_harga_bphtb", ccsText, "", "", $this->jenis_harga_bphtb->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["bphtb_legal_doc_description"] = new clsSQLParameter("ctrlbphtb_legal_doc_description", ccsText, "", "", $this->bphtb_legal_doc_description->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["add_disc_percent"] = new clsSQLParameter("ctrladd_disc_percent", ccsFloat, "", "", $this->add_disc_percent->GetValue(true), NULL, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "ctrlt_bphtb_registration_id", ccsFloat, "", "", $this->t_bphtb_registration_id->GetValue(true), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("2", "urlt_bphtb_registration_id", ccsFloat, "", "", CCGetFromGet("t_bphtb_registration_id", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("3", "urlt_bphtb_registration_id", ccsFloat, "", "", CCGetFromGet("t_bphtb_registration_id", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetSession("UserLogin", NULL));
        if (!is_null($this->cp["updated_date"]->GetValue()) and !strlen($this->cp["updated_date"]->GetText()) and !is_bool($this->cp["updated_date"]->GetValue())) 
            $this->cp["updated_date"]->SetValue(date("Y-m-d H:i:s"));
        if (!is_null($this->cp["wp_p_region_id"]->GetValue()) and !strlen($this->cp["wp_p_region_id"]->GetText()) and !is_bool($this->cp["wp_p_region_id"]->GetValue())) 
            $this->cp["wp_p_region_id"]->SetValue($this->wp_p_region_id->GetValue(true));
        if (!is_null($this->cp["wp_p_region_id_kel"]->GetValue()) and !strlen($this->cp["wp_p_region_id_kel"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kel"]->GetValue())) 
            $this->cp["wp_p_region_id_kel"]->SetValue($this->wp_p_region_id_kel->GetValue(true));
        if (!is_null($this->cp["wp_name"]->GetValue()) and !strlen($this->cp["wp_name"]->GetText()) and !is_bool($this->cp["wp_name"]->GetValue())) 
            $this->cp["wp_name"]->SetValue($this->wp_name->GetValue(true));
        if (!is_null($this->cp["wp_address_name"]->GetValue()) and !strlen($this->cp["wp_address_name"]->GetText()) and !is_bool($this->cp["wp_address_name"]->GetValue())) 
            $this->cp["wp_address_name"]->SetValue($this->wp_address_name->GetValue(true));
        if (!is_null($this->cp["npwp"]->GetValue()) and !strlen($this->cp["npwp"]->GetText()) and !is_bool($this->cp["npwp"]->GetValue())) 
            $this->cp["npwp"]->SetValue($this->npwp->GetValue(true));
        if (!is_null($this->cp["object_p_region_id_kec"]->GetValue()) and !strlen($this->cp["object_p_region_id_kec"]->GetText()) and !is_bool($this->cp["object_p_region_id_kec"]->GetValue())) 
            $this->cp["object_p_region_id_kec"]->SetValue($this->object_p_region_id_kec->GetValue(true));
        if (!is_null($this->cp["object_p_region_id"]->GetValue()) and !strlen($this->cp["object_p_region_id"]->GetText()) and !is_bool($this->cp["object_p_region_id"]->GetValue())) 
            $this->cp["object_p_region_id"]->SetValue($this->object_p_region_id->GetValue(true));
        if (!is_null($this->cp["land_area"]->GetValue()) and !strlen($this->cp["land_area"]->GetText()) and !is_bool($this->cp["land_area"]->GetValue())) 
            $this->cp["land_area"]->SetValue($this->land_area->GetValue(true));
        if (!is_null($this->cp["land_price_per_m"]->GetValue()) and !strlen($this->cp["land_price_per_m"]->GetText()) and !is_bool($this->cp["land_price_per_m"]->GetValue())) 
            $this->cp["land_price_per_m"]->SetValue($this->land_price_per_m->GetValue(true));
        if (!is_null($this->cp["land_total_price"]->GetValue()) and !strlen($this->cp["land_total_price"]->GetText()) and !is_bool($this->cp["land_total_price"]->GetValue())) 
            $this->cp["land_total_price"]->SetValue($this->land_total_price->GetValue(true));
        if (!is_null($this->cp["building_area"]->GetValue()) and !strlen($this->cp["building_area"]->GetText()) and !is_bool($this->cp["building_area"]->GetValue())) 
            $this->cp["building_area"]->SetValue($this->building_area->GetValue(true));
        if (!is_null($this->cp["building_price_per_m"]->GetValue()) and !strlen($this->cp["building_price_per_m"]->GetText()) and !is_bool($this->cp["building_price_per_m"]->GetValue())) 
            $this->cp["building_price_per_m"]->SetValue($this->building_price_per_m->GetValue(true));
        if (!is_null($this->cp["building_total_price"]->GetValue()) and !strlen($this->cp["building_total_price"]->GetText()) and !is_bool($this->cp["building_total_price"]->GetValue())) 
            $this->cp["building_total_price"]->SetValue($this->building_total_price->GetValue(true));
        if (!is_null($this->cp["wp_rt"]->GetValue()) and !strlen($this->cp["wp_rt"]->GetText()) and !is_bool($this->cp["wp_rt"]->GetValue())) 
            $this->cp["wp_rt"]->SetValue($this->wp_rt->GetValue(true));
        if (!is_null($this->cp["wp_rw"]->GetValue()) and !strlen($this->cp["wp_rw"]->GetText()) and !is_bool($this->cp["wp_rw"]->GetValue())) 
            $this->cp["wp_rw"]->SetValue($this->wp_rw->GetValue(true));
        if (!is_null($this->cp["object_rt"]->GetValue()) and !strlen($this->cp["object_rt"]->GetText()) and !is_bool($this->cp["object_rt"]->GetValue())) 
            $this->cp["object_rt"]->SetValue($this->object_rt->GetValue(true));
        if (!is_null($this->cp["object_rw"]->GetValue()) and !strlen($this->cp["object_rw"]->GetText()) and !is_bool($this->cp["object_rw"]->GetValue())) 
            $this->cp["object_rw"]->SetValue($this->object_rw->GetValue(true));
        if (!is_null($this->cp["njop_pbb"]->GetValue()) and !strlen($this->cp["njop_pbb"]->GetText()) and !is_bool($this->cp["njop_pbb"]->GetValue())) 
            $this->cp["njop_pbb"]->SetValue($this->njop_pbb->GetValue(true));
        if (!is_null($this->cp["object_address_name"]->GetValue()) and !strlen($this->cp["object_address_name"]->GetText()) and !is_bool($this->cp["object_address_name"]->GetValue())) 
            $this->cp["object_address_name"]->SetValue($this->object_address_name->GetValue(true));
        if (!is_null($this->cp["p_bphtb_legal_doc_type_id"]->GetValue()) and !strlen($this->cp["p_bphtb_legal_doc_type_id"]->GetText()) and !is_bool($this->cp["p_bphtb_legal_doc_type_id"]->GetValue())) 
            $this->cp["p_bphtb_legal_doc_type_id"]->SetValue($this->p_bphtb_legal_doc_type_id->GetValue(true));
        if (!is_null($this->cp["npop"]->GetValue()) and !strlen($this->cp["npop"]->GetText()) and !is_bool($this->cp["npop"]->GetValue())) 
            $this->cp["npop"]->SetValue($this->npop->GetValue(true));
        if (!is_null($this->cp["npop_tkp"]->GetValue()) and !strlen($this->cp["npop_tkp"]->GetText()) and !is_bool($this->cp["npop_tkp"]->GetValue())) 
            $this->cp["npop_tkp"]->SetValue($this->npop_tkp->GetValue(true));
        if (!is_null($this->cp["npop_kp"]->GetValue()) and !strlen($this->cp["npop_kp"]->GetText()) and !is_bool($this->cp["npop_kp"]->GetValue())) 
            $this->cp["npop_kp"]->SetValue($this->npop_kp->GetValue(true));
        if (!is_null($this->cp["bphtb_amt"]->GetValue()) and !strlen($this->cp["bphtb_amt"]->GetText()) and !is_bool($this->cp["bphtb_amt"]->GetValue())) 
            $this->cp["bphtb_amt"]->SetValue($this->bphtb_amt->GetValue(true));
        if (!is_null($this->cp["bphtb_amt_final"]->GetValue()) and !strlen($this->cp["bphtb_amt_final"]->GetText()) and !is_bool($this->cp["bphtb_amt_final"]->GetValue())) 
            $this->cp["bphtb_amt_final"]->SetValue($this->bphtb_amt_final->GetValue(true));
        if (!is_null($this->cp["bphtb_discount"]->GetValue()) and !strlen($this->cp["bphtb_discount"]->GetText()) and !is_bool($this->cp["bphtb_discount"]->GetValue())) 
            $this->cp["bphtb_discount"]->SetValue($this->bphtb_discount->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["market_price"]->GetValue()) and !strlen($this->cp["market_price"]->GetText()) and !is_bool($this->cp["market_price"]->GetValue())) 
            $this->cp["market_price"]->SetValue($this->market_price->GetValue(true));
        if (!is_null($this->cp["mobile_phone_no"]->GetValue()) and !strlen($this->cp["mobile_phone_no"]->GetText()) and !is_bool($this->cp["mobile_phone_no"]->GetValue())) 
            $this->cp["mobile_phone_no"]->SetValue($this->mobile_phone_no->GetValue(true));
        if (!is_null($this->cp["wp_p_region_id_kec"]->GetValue()) and !strlen($this->cp["wp_p_region_id_kec"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kec"]->GetValue())) 
            $this->cp["wp_p_region_id_kec"]->SetValue($this->wp_p_region_id_kec->GetValue(true));
        if (!is_null($this->cp["object_p_region_id_kel"]->GetValue()) and !strlen($this->cp["object_p_region_id_kel"]->GetText()) and !is_bool($this->cp["object_p_region_id_kel"]->GetValue())) 
            $this->cp["object_p_region_id_kel"]->SetValue($this->object_p_region_id_kel->GetValue(true));
        if (!is_null($this->cp["jenis_harga_bphtb"]->GetValue()) and !strlen($this->cp["jenis_harga_bphtb"]->GetText()) and !is_bool($this->cp["jenis_harga_bphtb"]->GetValue())) 
            $this->cp["jenis_harga_bphtb"]->SetValue($this->jenis_harga_bphtb->GetValue(true));
        if (!is_null($this->cp["bphtb_legal_doc_description"]->GetValue()) and !strlen($this->cp["bphtb_legal_doc_description"]->GetText()) and !is_bool($this->cp["bphtb_legal_doc_description"]->GetValue())) 
            $this->cp["bphtb_legal_doc_description"]->SetValue($this->bphtb_legal_doc_description->GetValue(true));
        if (!is_null($this->cp["add_disc_percent"]->GetValue()) and !strlen($this->cp["add_disc_percent"]->GetText()) and !is_bool($this->cp["add_disc_percent"]->GetValue())) 
            $this->cp["add_disc_percent"]->SetValue($this->add_disc_percent->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "t_bphtb_registration_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsFloat),false);
        $wp->Criterion[2] = $wp->Operation(opEqual, "t_bphtb_registration_id", $wp->GetDBValue("2"), $this->ToSQL($wp->GetDBValue("2"), ccsFloat),false);
        $wp->Criterion[3] = $wp->Operation(opEqual, "t_bphtb_registration_id", $wp->GetDBValue("3"), $this->ToSQL($wp->GetDBValue("3"), ccsFloat),false);
        $Where = $wp->opAND(
             false, $wp->opAND(
             false, 
             $wp->Criterion[1], 
             $wp->Criterion[2]), 
             $wp->Criterion[3]);
        $this->UpdateFields["updated_by"]["Value"] = $this->cp["updated_by"]->GetDBValue(true);
        $this->UpdateFields["updated_date"]["Value"] = $this->cp["updated_date"]->GetDBValue(true);
        $this->UpdateFields["wp_p_region_id"]["Value"] = $this->cp["wp_p_region_id"]->GetDBValue(true);
        $this->UpdateFields["wp_p_region_id_kel"]["Value"] = $this->cp["wp_p_region_id_kel"]->GetDBValue(true);
        $this->UpdateFields["wp_name"]["Value"] = $this->cp["wp_name"]->GetDBValue(true);
        $this->UpdateFields["wp_address_name"]["Value"] = $this->cp["wp_address_name"]->GetDBValue(true);
        $this->UpdateFields["npwp"]["Value"] = $this->cp["npwp"]->GetDBValue(true);
        $this->UpdateFields["object_p_region_id_kec"]["Value"] = $this->cp["object_p_region_id_kec"]->GetDBValue(true);
        $this->UpdateFields["object_p_region_id"]["Value"] = $this->cp["object_p_region_id"]->GetDBValue(true);
        $this->UpdateFields["land_area"]["Value"] = $this->cp["land_area"]->GetDBValue(true);
        $this->UpdateFields["land_price_per_m"]["Value"] = $this->cp["land_price_per_m"]->GetDBValue(true);
        $this->UpdateFields["land_total_price"]["Value"] = $this->cp["land_total_price"]->GetDBValue(true);
        $this->UpdateFields["building_area"]["Value"] = $this->cp["building_area"]->GetDBValue(true);
        $this->UpdateFields["building_price_per_m"]["Value"] = $this->cp["building_price_per_m"]->GetDBValue(true);
        $this->UpdateFields["building_total_price"]["Value"] = $this->cp["building_total_price"]->GetDBValue(true);
        $this->UpdateFields["wp_rt"]["Value"] = $this->cp["wp_rt"]->GetDBValue(true);
        $this->UpdateFields["wp_rw"]["Value"] = $this->cp["wp_rw"]->GetDBValue(true);
        $this->UpdateFields["object_rt"]["Value"] = $this->cp["object_rt"]->GetDBValue(true);
        $this->UpdateFields["object_rw"]["Value"] = $this->cp["object_rw"]->GetDBValue(true);
        $this->UpdateFields["njop_pbb"]["Value"] = $this->cp["njop_pbb"]->GetDBValue(true);
        $this->UpdateFields["object_address_name"]["Value"] = $this->cp["object_address_name"]->GetDBValue(true);
        $this->UpdateFields["p_bphtb_legal_doc_type_id"]["Value"] = $this->cp["p_bphtb_legal_doc_type_id"]->GetDBValue(true);
        $this->UpdateFields["npop"]["Value"] = $this->cp["npop"]->GetDBValue(true);
        $this->UpdateFields["npop_tkp"]["Value"] = $this->cp["npop_tkp"]->GetDBValue(true);
        $this->UpdateFields["npop_kp"]["Value"] = $this->cp["npop_kp"]->GetDBValue(true);
        $this->UpdateFields["bphtb_amt"]["Value"] = $this->cp["bphtb_amt"]->GetDBValue(true);
        $this->UpdateFields["bphtb_amt_final"]["Value"] = $this->cp["bphtb_amt_final"]->GetDBValue(true);
        $this->UpdateFields["bphtb_discount"]["Value"] = $this->cp["bphtb_discount"]->GetDBValue(true);
        $this->UpdateFields["description"]["Value"] = $this->cp["description"]->GetDBValue(true);
        $this->UpdateFields["market_price"]["Value"] = $this->cp["market_price"]->GetDBValue(true);
        $this->UpdateFields["mobile_phone_no"]["Value"] = $this->cp["mobile_phone_no"]->GetDBValue(true);
        $this->UpdateFields["wp_p_region_id_kec"]["Value"] = $this->cp["wp_p_region_id_kec"]->GetDBValue(true);
        $this->UpdateFields["object_p_region_id_kel"]["Value"] = $this->cp["object_p_region_id_kel"]->GetDBValue(true);
        $this->UpdateFields["jenis_harga_bphtb"]["Value"] = $this->cp["jenis_harga_bphtb"]->GetDBValue(true);
        $this->UpdateFields["bphtb_legal_doc_description"]["Value"] = $this->cp["bphtb_legal_doc_description"]->GetDBValue(true);
        $this->UpdateFields["add_disc_percent"]["Value"] = $this->cp["add_disc_percent"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("t_bphtb_registration", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @51-AEEB9CE7
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "urlt_bphtb_registration_id", ccsFloat, "", "", CCGetFromGet("t_bphtb_registration_id", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $wp->Criterion[1] = $wp->Operation(opEqual, "t_bphtb_registration_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsFloat),false);
        $Where = 
             $wp->Criterion[1];
        $this->SQL = "DELETE FROM t_bphtb_registration";
        $this->SQL = CCBuildSQL($this->SQL, $Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End bphtb_wsFormDataSource Class @51-FCB6E20C

//Initialize Page @1-8ADFBDF8
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
$TemplateFileName = "inquery_bphtb_ws.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-3A419C8C
include_once("./inquery_bphtb_ws_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9F2947AA
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$LOV = & new clsRecordLOV("", $MainPage);
$bphtb_wsForm = & new clsRecordbphtb_wsForm("", $MainPage);
$MainPage->LOV = & $LOV;
$MainPage->bphtb_wsForm = & $bphtb_wsForm;
$bphtb_wsForm->Initialize();

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

//Execute Components @1-E36258A4
$LOV->Operation();
$bphtb_wsForm->Operation();
//End Execute Components

//Go to destination page @1-64B26231
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($LOV);
    unset($bphtb_wsForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-643BEC7F
$LOV->Show();
$bphtb_wsForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-0CE9AD9A
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($LOV);
unset($bphtb_wsForm);
unset($Tpl);
//End Unload Page


?>
