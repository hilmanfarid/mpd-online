<?php
//BindEvents Method @1-6459F360
function BindEvents()
{
    global $t_rep_lap_spjpSearch;
    global $t_vat_setllementGrid;
    global $CCSEvents;
    $t_rep_lap_spjpSearch->CCSEvents["BeforeShow"] = "t_rep_lap_spjpSearch_BeforeShow";
    $t_vat_setllementGrid->CCSEvents["BeforeSelect"] = "t_vat_setllementGrid_BeforeSelect";
    $t_vat_setllementGrid->CCSEvents["BeforeShow"] = "t_vat_setllementGrid_BeforeShow";
    $t_vat_setllementGrid->CCSEvents["BeforeShowRow"] = "t_vat_setllementGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_rep_lap_spjpSearch_BeforeShow @3-F8DD1AEE
function t_rep_lap_spjpSearch_BeforeShow(& $sender)
{
    $t_rep_lap_spjpSearch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_rep_lap_spjpSearch; //Compatibility
//End t_rep_lap_spjpSearch_BeforeShow

//Custom Code @573-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_rep_lap_spjpSearch_BeforeShow @3-BF26FC34
    return $t_rep_lap_spjpSearch_BeforeShow;
}
//End Close t_rep_lap_spjpSearch_BeforeShow

//t_vat_setllementGrid_BeforeSelect @2-6B06F902
function t_vat_setllementGrid_BeforeSelect(& $sender)
{
    $t_vat_setllementGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeSelect

//Custom Code @585-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_vat_setllementGrid_BeforeSelect @2-3DD75ADF
    return $t_vat_setllementGrid_BeforeSelect;
}
//End Close t_vat_setllementGrid_BeforeSelect

//t_vat_setllementGrid_BeforeShow @2-27F9F7A4
function t_vat_setllementGrid_BeforeShow(& $sender)
{
    $t_vat_setllementGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeShow

//Custom Code @586-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_vat_setllementGrid_BeforeShow @2-542B3DA4
    return $t_vat_setllementGrid_BeforeShow;
}
//End Close t_vat_setllementGrid_BeforeShow

//t_vat_setllementGrid_BeforeShowRow @2-292D3A2A
function t_vat_setllementGrid_BeforeShowRow(& $sender)
{
    $t_vat_setllementGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_vat_setllementGrid; //Compatibility
//End t_vat_setllementGrid_BeforeShowRow

//Set Row Style @581-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Custom Code @596-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_vat_setllementGrid_BeforeShowRow @2-CAEE8B40
    return $t_vat_setllementGrid_BeforeShowRow;
}
//End Close t_vat_setllementGrid_BeforeShowRow

//Page_OnInitializeView @1-3802C536
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_survey_kepuasan_pelanggan_pelaporan_pertanyaan; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeShow @1-BF998835
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_survey_kepuasan_pelanggan_pelaporan_pertanyaan; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	if($doAction == 'submit') {
		global $t_rep_lap_spjpSearch;
		$payment_key = $t_rep_lap_spjpSearch->payment_key->GetValue();
		$dbConn	= new clsDBConnSIKP();
		$query="select t_vat_setllement_id, payment_key, npwd from t_vat_setllement where payment_key = '".$payment_key."'";
		//echo $query;exit;
		$dbConn->query($query);
		$dbConn->next_record();
		$data_vat_set = $dbConn->Record;

		if ($data_vat_set["npwd"]==''){
			echo '<script language="javascript">';
			echo 'alert("Data dengan No. Bayar '.$payment_key.' tidak ditemukan")';
			echo '</script>';
		}else{
			$param_arr[0]['p_survey_question_id'] = CCGetFromGet('p_survey_question_id_1');
			$param_arr[1]['p_survey_question_id'] = CCGetFromGet('p_survey_question_id_2');
			$param_arr[2]['p_survey_question_id'] = CCGetFromGet('p_survey_question_id_3');
			$param_arr[3]['p_survey_question_id'] = CCGetFromGet('p_survey_question_id_4');
			$param_arr[4]['p_survey_question_id'] = CCGetFromGet('p_survey_question_id_5');
			$param_arr[5]['p_survey_question_id'] = CCGetFromGet('p_survey_question_id_6');
			$param_arr[6]['p_survey_question_id'] = CCGetFromGet('p_survey_question_id_7');
			$param_arr[7]['p_survey_question_id'] = CCGetFromGet('p_survey_question_id_8');
			$param_arr[8]['p_survey_question_id'] = CCGetFromGet('p_survey_question_id_9');

			$param_arr[0]['p_survey_answer_score_id'] = CCGetFromGet('p_survey_answer_score_id_1');
			$param_arr[1]['p_survey_answer_score_id'] = CCGetFromGet('p_survey_answer_score_id_2');
			$param_arr[2]['p_survey_answer_score_id'] = CCGetFromGet('p_survey_answer_score_id_3');
			$param_arr[3]['p_survey_answer_score_id'] = CCGetFromGet('p_survey_answer_score_id_4');
			$param_arr[4]['p_survey_answer_score_id'] = CCGetFromGet('p_survey_answer_score_id_5');
			$param_arr[5]['p_survey_answer_score_id'] = CCGetFromGet('p_survey_answer_score_id_6');
			$param_arr[6]['p_survey_answer_score_id'] = CCGetFromGet('p_survey_answer_score_id_7');
			$param_arr[7]['p_survey_answer_score_id'] = CCGetFromGet('p_survey_answer_score_id_8');
			$param_arr[8]['p_survey_answer_score_id'] = CCGetFromGet('p_survey_answer_score_id_9');
			submitSurvey($param_arr);
		}
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function submitSurvey($param_arr) {
	global $t_rep_lap_spjpSearch;
	global $t_vat_setllementGrid;
	
	$dbConn_question	= new clsDBConnSIKP();
	$data_question=array();
	$query_question="select * from p_survey_question 
			WHERE p_survey_type_id=2
			order by sequence_no";
	$dbConn_question->query($query_question);
	while($dbConn_question->next_record()){
		$data_question[] = $dbConn_question->Record;
	}
	
	//echo '<pre>';print_r($data_question[0]['p_survey_question_id']);exit;
	/*echo '<script language="javascript">';
	echo 'alert("'.count($param_arr).'")';
	echo '</script>';*/

	$payment_key = $t_rep_lap_spjpSearch->payment_key->GetValue();
	for ($i=0; $i<count($param_arr); $i++){
		$dbConn	= new clsDBConnSIKP();
		$query="select f_insert_t_req_satisfaction_survey(".$data_question[$i]['p_survey_question_id'].",".$param_arr[$i]['p_survey_answer_score_id'].",'".$payment_key."')";
		//echo $query;exit;
		$dbConn->query($query);
		$dbConn->next_record();
	}
	$dbConn	= new clsDBConnSIKP();
	$query="update t_vat_setllement set is_surveyed = 'Y' where payment_key = '".$payment_key."'";
	//echo $query;exit;
	$dbConn->query($query);
	$dbConn->next_record();

	echo '<script language="javascript">';
	echo 'alert("Terima kasih atas partisipasi Anda. Anda Sekarang bisa mencetak dokumen No. Bayar '.$payment_key.'");';
	echo 'parent.window.close();';
	echo '</script>';

}
?>
