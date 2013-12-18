<?php
//BindEvents Method @1-BA4EF0F3
function BindEvents()
{
    global $t_target_realisasiGrid;
    global $CCSEvents;
    $t_target_realisasiGrid->CCSEvents["BeforeShowRow"] = "t_target_realisasiGrid_BeforeShowRow";
    $t_target_realisasiGrid->CCSEvents["BeforeSelect"] = "t_target_realisasiGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_target_realisasiGrid_BeforeShowRow @2-52730172
function t_target_realisasiGrid_BeforeShowRow(& $sender)
{
    $t_target_realisasiGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasiGrid; //Compatibility
//End t_target_realisasiGrid_BeforeShowRow
global $selected_id;

		if ($selected_id<0) {
    		$selected_id = $Component->DataSource->p_year_period_id->GetValue();
   		}

		$styles = array("Row", "AltRow");
  	// Start Bdr    
        $img_radio= "<img border=\"0\" src=\"../images/radio.gif\">";
        $Style = $styles[0];
        
        if ($Component->DataSource->p_year_period_id->GetValue() == $selected_id) {
        	$img_radio= "<img border=\"0\" src=\"../images/radio_s.gif\">";
            $Style = $styles[1];
            $is_show_form=1;

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
//Close t_target_realisasiGrid_BeforeShowRow @2-DFE61ABB
    return $t_target_realisasiGrid_BeforeShowRow;
}
//End Close t_target_realisasiGrid_BeforeShowRow

//t_target_realisasiGrid_BeforeSelect @2-EC247A5A
function t_target_realisasiGrid_BeforeSelect(& $sender)
{
    $t_target_realisasiGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasiGrid; //Compatibility
//End t_target_realisasiGrid_BeforeSelect
// Write your own code here.
  	$Component->DataSource->Parameters["p_year_period_id"] = CCGetFromGet("p_year_period_id", NULL);
// -------------------------
//Close t_target_realisasiGrid_BeforeSelect @2-EF6BE882
    return $t_target_realisasiGrid_BeforeSelect;
}
//End Close t_target_realisasiGrid_BeforeSelect

//Page_OnInitializeView @1-6D8B7EE4
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi; //Compatibility
//End Page_OnInitializeView
// -------------------------
      // Write your own code here.
  	  	global $selected_id;
        $selected_id = -1;
        $selected_id=CCGetFromGet("p_year_period_id", $selected_id);
  // -------------------------
//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeInitialize @1-3C816F91
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi; //Compatibility
//End Page_BeforeInitialize

//t_target_realisasiFlash_tahunan Initialization @696-224552A2
    if ('t_target_realisasit_target_realisasiFlash_tahunan' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_target_realisasit_target_realisasiFlash_tahunan.xml"));
        $Service->SetFormatter($formatter);
//End t_target_realisasiFlash_tahunan Initialization

//t_target_realisasiFlash_tahunan DataSource @696-30F3CA98
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_year_period_id"] = CCGetFromGet("p_year_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_year_period_id", ccsFloat, "", array(False, 0, Null, "", False, "", "", 1, True, ""), $Service->DataSource->Parameters["urlp_year_period_id"], "", false);
        $Service->DataSource->SQL = "SELECT target_amt, realisasi_amt \n" .
        "FROM v_target_vs_real_anual\n" .
        "WHERE p_year_period_id = " . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . " ";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End t_target_realisasiFlash_tahunan DataSource

//t_target_realisasiFlash_tahunan Execution @696-7C85A659
        $Service->AddDataSetValue("Title", "Target vs Realisasi Tahunan");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End t_target_realisasiFlash_tahunan Execution

//t_target_realisasiFlash_tahunan Tail @696-27890EF8
        exit;
    }
//End t_target_realisasiFlash_tahunan Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
