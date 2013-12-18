<?php
//BindEvents Method @1-55747131
function BindEvents()
{
    global $t_target_realisasi_jenisGrid;
    global $CCSEvents;
    $t_target_realisasi_jenisGrid->CCSEvents["BeforeSelect"] = "t_target_realisasi_jenisGrid_BeforeSelect";
    $t_target_realisasi_jenisGrid->CCSEvents["BeforeShowRow"] = "t_target_realisasi_jenisGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_target_realisasi_jenisGrid_BeforeSelect @2-B5A8F962
function t_target_realisasi_jenisGrid_BeforeSelect(& $sender)
{
    $t_target_realisasi_jenisGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenisGrid; //Compatibility
//End t_target_realisasi_jenisGrid_BeforeSelect
// Write your own code here.
  	$Component->DataSource->Parameters["t_revenue_target_id"] = CCGetFromGet("t_revenue_target_id", NULL);
// -------------------------
//Close t_target_realisasi_jenisGrid_BeforeSelect @2-10124532
    return $t_target_realisasi_jenisGrid_BeforeSelect;
}
//End Close t_target_realisasi_jenisGrid_BeforeSelect

//t_target_realisasi_jenisGrid_BeforeShowRow @2-D46661EC
function t_target_realisasi_jenisGrid_BeforeShowRow(& $sender)
{
    $t_target_realisasi_jenisGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenisGrid; //Compatibility
//End t_target_realisasi_jenisGrid_BeforeShowRow
		global $selected_id;

		if ($selected_id<0) {
    		$selected_id = $Component->DataSource->t_revenue_target_id->GetValue();
   		}

		$styles = array("Row", "AltRow");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        
        if ($Component->DataSource->t_revenue_target_id->GetValue() == $selected_id) {
        	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
            $Style = $styles[1];
            $is_show_form=1;

			$tid = $Component->DataSource->t_revenue_target_id->GetValue();
			$Component->t_revenue_target_id->SetValue($tid);
			$pid = $Component->DataSource->p_year_period_id->GetValue();
			$Component->p_year_period_id2->SetValue($pid);
        }	
    // End Bdr  
      if (count($styles)) {
          //$Style = $styles[($Component->RowNumber - 1) % count($styles)];
          if (strlen($Style) && !strpos($Style, "="))
              $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
          $Component->Attributes->SetValue("rowStyle", $Style);
      }

	 $Component->DLink->SetValue($img_radio); // Bdr
//Close t_target_realisasi_jenisGrid_BeforeShowRow @2-1478D09A
    return $t_target_realisasi_jenisGrid_BeforeShowRow;
}
//End Close t_target_realisasi_jenisGrid_BeforeShowRow

//Page_OnInitializeView @1-B4E4244E
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenis; //Compatibility
//End Page_OnInitializeView
// -------------------------
      // Write your own code here.
  	  global $selected_id;
        $selected_id = -1;
        $selected_id = CCGetFromGet("t_revenue_target_id", $selected_id);
  // -------------------------
//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeInitialize @1-B048A2ED
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenis; //Compatibility
//End Page_BeforeInitialize

//per_pajak Initialization @696-6756941A
    if ('t_target_realisasi_jenisper_pajak' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_target_realisasi_jenisper_pajak.xml"));
        $Service->SetFormatter($formatter);
//End per_pajak Initialization

//per_pajak DataSource @696-866E4826
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlt_revenue_target_id"] = CCGetFromGet("t_revenue_target_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlt_revenue_target_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlt_revenue_target_id"], 0, false);
        $Service->DataSource->SQL = "SELECT target_amount, realisasi_amt\n" .
        "FROM v_revenue_target_vs_realisasi\n" .
        "WHERE t_revenue_target_id = " . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . " {SQL_OrderBy}";
        $Service->DataSource->Order = "p_vat_type_id";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End per_pajak DataSource

//per_pajak Execution @696-57765666
        $Service->AddDataSetValue("Title", "Target vs Realisasi Per Jenis Pajak");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End per_pajak Execution

//per_pajak Tail @696-27890EF8
        exit;
    }
//End per_pajak Tail

//per_tahun Initialization @764-4DD3B284
    if ('t_target_realisasi_jenisper_tahun' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_target_realisasi_jenisper_tahun.xml"));
        $Service->SetFormatter($formatter);
//End per_tahun Initialization

//per_tahun DataSource @764-7221A293
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM v_revenue_target_vs_realisasi {SQL_Where} {SQL_OrderBy}";
        $Service->DataSource->Order = "p_vat_type_id";
        $Service->DataSource->Parameters["urlp_year_period_id"] = CCGetFromGet("p_year_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_year_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_year_period_id"], "", false);
        $Service->DataSource->wp->Criterion[1] = $Service->DataSource->wp->Operation(opEqual, "p_year_period_id", $Service->DataSource->wp->GetDBValue("1"), $Service->DataSource->ToSQL($Service->DataSource->wp->GetDBValue("1"), ccsFloat),false);
        $Service->DataSource->Where = 
             $Service->DataSource->wp->Criterion[1];
        $Service->DataSource->Order = "p_vat_type_id";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End per_tahun DataSource

//per_tahun Execution @764-7C85A659
        $Service->AddDataSetValue("Title", "Target vs Realisasi Tahunan");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End per_tahun Execution

//per_tahun Tail @764-27890EF8
        exit;
    }
//End per_tahun Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
