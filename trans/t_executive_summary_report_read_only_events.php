<?php
//BindEvents Method @1-1D7E4284
function BindEvents()
{
    global $t_executive_summary_form;
    global $CCSEvents;
    $t_executive_summary_form->CCSEvents["BeforeSelect"] = "t_executive_summary_form_BeforeSelect";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_executive_summary_form_BeforeSelect @25-A60FDDDA
function t_executive_summary_form_BeforeSelect(& $sender)
{
    $t_executive_summary_form_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_executive_summary_form; //Compatibility
//End t_executive_summary_form_BeforeSelect

//Custom Code @45-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_executive_summary_form_BeforeSelect @25-B5E19C7B
    return $t_executive_summary_form_BeforeSelect;
}
//End Close t_executive_summary_form_BeforeSelect

//Page_BeforeShow @1-634D7766
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_executive_summary_report_read_only; //Compatibility
//End Page_BeforeShow

//Custom Code @10-2A29BDB7
// -------------------------
    // Write your own code here.
	global $t_executive_sumary_filter;
	global $t_executive_summary_form;
	$view = CCGetFromGet("lihat_laporan", "F");
	if ($view=="T"){
		$periode = CCGetFromGet("p_year_period_id", "F");
		$pajak = CCGetFromGet("p_vat_type_id", "F");
		$period_type = CCGetFromGet("ListBox1", "1");

		if ($period_type==1)
		{
			$p_finance_period_id = CCGetFromGet("p_finance_period_id", "1");
			$dbConn = new clsDBConnSIKP();
			$query = "select * from t_executive_summary where period_type=1 
				and p_finance_period_id=".$p_finance_period_id;
			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$t_executive_summary_form->penjelasan->SetValue( $dbConn->f("penjelasan") );
				$t_executive_summary_form->permasalahan->SetValue( $dbConn->f("permasalahan") );
				$t_executive_summary_form->saran->SetValue( $dbConn->f("saran") );
				$t_executive_summary_form->kesimpulan->SetValue( $dbConn->f("kesimpulan") );
			}
			$dbConn->close();
		}
		if ($period_type==2)
		{	
			$ListBox2 = CCGetFromGet("ListBox2", "1");
			$dbConn = new clsDBConnSIKP();
			$query = "select * from t_executive_summary where period_type=2 
				and triwulan=".$ListBox2;
			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$t_executive_summary_form->penjelasan->SetValue( $dbConn->f("penjelasan") );
				$t_executive_summary_form->permasalahan->SetValue( $dbConn->f("permasalahan") );
				$t_executive_summary_form->saran->SetValue( $dbConn->f("saran") );
				$t_executive_summary_form->kesimpulan->SetValue( $dbConn->f("kesimpulan") );
			}
			$dbConn->close();
		}
		if ($period_type==3)
		{
			$ListBox3 = CCGetFromGet("ListBox3", "1");
			$dbConn = new clsDBConnSIKP();
			$query = "select * from t_executive_summary where period_type=3 
			and semester=".$ListBox3;
			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$t_executive_summary_form->penjelasan->SetValue( $dbConn->f("penjelasan") );
				$t_executive_summary_form->permasalahan->SetValue( $dbConn->f("permasalahan") );
				$t_executive_summary_form->saran->SetValue( $dbConn->f("saran") );
				$t_executive_summary_form->kesimpulan->SetValue( $dbConn->f("kesimpulan") );
			}
			$dbConn->close();
		}
		
	}
	
	
	/*
	if (empty($period_type))
	{
	
	}else{	

		if ($t_executive_sumary_filter->ListBox1->GetValue()==1)
		{
			$dbConn = new clsDBConnSIKP();
			$query = "select * from t_executive_summary where period_type=1";
			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$t_executive_summary_form->penjelasan->SetValue( $dbConn->f("penjelasan") );
				$t_executive_summary_form->permasalahan->SetValue( $dbConn->f("permasalahan") );
				$t_executive_summary_form->saran->SetValue( $dbConn->f("saran") );
				$t_executive_summary_form->kesimpulan->SetValue( $dbConn->f("kesimpulan") );
			}
			$dbConn->close();
		}
		if ($t_executive_sumary_filter->ListBox1->GetValue()==2)
		{
			$dbConn = new clsDBConnSIKP();
			$query = "select * from t_executive_summary where period_type=1";
			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$t_executive_summary_form->penjelasan->SetValue( $dbConn->f("penjelasan") );
				$t_executive_summary_form->permasalahan->SetValue( $dbConn->f("permasalahan") );
				$t_executive_summary_form->saran->SetValue( $dbConn->f("saran") );
				$t_executive_summary_form->kesimpulan->SetValue( $dbConn->f("kesimpulan") );
			}
			$dbConn->close();
		}
		if ($t_executive_sumary_filter->ListBox1->GetValue()==3)
		{
			$dbConn = new clsDBConnSIKP();
			$query = "select * from t_executive_summary where period_type=1";
			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$t_executive_summary_form->penjelasan->SetValue( $dbConn->f("penjelasan") );
				$t_executive_summary_form->permasalahan->SetValue( $dbConn->f("permasalahan") );
				$t_executive_summary_form->saran->SetValue( $dbConn->f("saran") );
				$t_executive_summary_form->kesimpulan->SetValue( $dbConn->f("kesimpulan") );
			}
			$dbConn->close();
		}
	}
	*/

// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>
