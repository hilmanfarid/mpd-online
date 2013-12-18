<?php
$add_flag=CCGetFromGet("FLAG", "NONE");
$is_show_form=($add_flag=="ADD");

//BindEvents Method @1-289E2A17
function BindEvents()
{
    global $t_payment_receiptGrid;
    global $CCSEvents;
    $t_payment_receiptGrid->CCSEvents["BeforeShowRow"] = "t_payment_receiptGrid_BeforeShowRow";
    $t_payment_receiptGrid->CCSEvents["BeforeSelect"] = "t_payment_receiptGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

  function t_payment_receiptGrid_BeforeShowRow(& $sender)
  {
      $t_payment_receiptGrid_BeforeShowRow = true;
      $Component = & $sender;
      $Container = & CCGetParentContainer($sender);
      global $t_payment_receiptGrid; //Compatibility

      return $t_payment_receiptGrid_BeforeShowRow;
  }


  function t_payment_receiptGrid_BeforeSelect(& $sender)
  {
      $t_payment_receiptGrid_BeforeSelect = true;
      $Component = & $sender;
      $Container = & CCGetParentContainer($sender);
      global $t_payment_receiptGrid; //Compatibility


  // -------------------------
      // Write your own code here.
          $Component->DataSource->Parameters["urls_keyword"] = strtoupper(CCGetFromGet("s_keyword", NULL));
  // -------------------------


      return $t_payment_receiptGrid_BeforeSelect;
  }

//t_cust_order_legal_docGrid_BeforeShowRow @2-A1499A7C
function t_cust_order_legal_docGrid_BeforeShowRow(& $sender)
{
    $t_cust_order_legal_docGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_order_legal_docGrid; //Compatibility
//End t_cust_order_legal_docGrid_BeforeShowRow

//Close t_cust_order_legal_docGrid_BeforeShowRow @2-55753697
    return $t_cust_order_legal_docGrid_BeforeShowRow;
}
//End Close t_cust_order_legal_docGrid_BeforeShowRow

//t_cust_order_legal_docGrid_BeforeSelect @2-F5794C06
function t_cust_order_legal_docGrid_BeforeSelect(& $sender)
{
    $t_cust_order_legal_docGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_cust_order_legal_docGrid; //Compatibility
//End t_cust_order_legal_docGrid_BeforeSelect

//Close t_cust_order_legal_docGrid_BeforeSelect @2-198E2899
    return $t_cust_order_legal_docGrid_BeforeSelect;
}
//End Close t_cust_order_legal_docGrid_BeforeSelect

//Page_OnInitializeView @1-7D9CA061
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_payment_receipt; //Compatibility
//End Page_OnInitializeView

  // -------------------------
      // Write your own code here.
      global $selected_id;
      $selected_id = -1;
      $selected_id=CCGetFromGet("t_payment_receipt_id", $selected_id);
  // -------------------------


//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeInitialize @1-A98DEF50
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_payment_receipt; //Compatibility
//End Page_BeforeInitialize

//FlashChart1 Initialization @686-E035C57E
    if ('t_payment_receiptFlashChart1' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_payment_receiptFlashChart1.xml"));
        $Service->SetFormatter($formatter);
//End FlashChart1 Initialization

//FlashChart1 DataSource @686-6D9BE062
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->Parameters["urlp_vat_type_id"] = CCGetFromGet("p_vat_type_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->wp->AddParameter("2", "urlp_vat_type_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_vat_type_id"], 0, false);
        $Service->DataSource->SQL = "select b.vat_code, count(1) as jml_wp\n" .
        "from t_cust_account a, p_vat_type b\n" .
        "where\n" .
        "	(not exists(\n" .
        "		select 1 from t_payment_receipt x\n" .
        "		where x.t_cust_account_id = a.t_cust_account_id\n" .
        "		and x.p_finance_period_id = " . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . "\n" .
        "	))\n" .
        "	and \n" .
        "	(a.p_vat_type_id <> " . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("2"), ccsFloat) . ")\n" .
        "group by b.vat_code, b.description";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End FlashChart1 DataSource

//FlashChart1 Execution @686-8BA5D20B
        $Service->AddDataSetValue("Title", "Laporan Rekap Tunggakan");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End FlashChart1 Execution

//FlashChart1 Tail @686-27890EF8
        exit;
    }
//End FlashChart1 Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

?>
