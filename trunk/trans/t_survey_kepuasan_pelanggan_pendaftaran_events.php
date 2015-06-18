<?php
//BindEvents Method @1-C2528DEB
function BindEvents()
{
    global $t_rep_lap_spjpSearch;
    global $CCSEvents;
    $t_rep_lap_spjpSearch->CCSEvents["BeforeShow"] = "t_rep_lap_spjpSearch_BeforeShow";
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

//Custom Code @574-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_rep_lap_spjpSearch_BeforeShow @3-BF26FC34
    return $t_rep_lap_spjpSearch_BeforeShow;
}
//End Close t_rep_lap_spjpSearch_BeforeShow

//Page_OnInitializeView @1-802E44D8
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_survey_kepuasan_pelanggan_pendaftaran; //Compatibility
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

//Page_BeforeShow @1-BB0D70BD
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_survey_kepuasan_pelanggan_pendaftaran; //Compatibility
//End Page_BeforeShow

//Custom Code @572-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	global $Label1;
	if($doAction == 'view_survey') {
		$param_arr['npwpd'] = strtoupper(CCGetFromGet('npwpd'));
		$Label1->SetText(GetSurvey($param_arr));
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

function GetSurvey($param_arr) {
	$output = '';
	$dbConn	= new clsDBConnSIKP();
	$query="select * from t_vat_registration where npwpd = '".$param_arr['npwpd']."'";
	//echo $query;exit;

	$dbConn->query($query);
	if ($dbConn->next_record()) {
		$data = $dbConn->Record;

		$query2="select * from p_survey_question WHERE p_survey_type_id=1 and sequence_no =1";
		$dbConn2 = new clsDBConnSIKP();
		$dbConn2->query($query2);
		if ($dbConn2->next_record()) {
			$data2 = $dbConn2->Record;
			echo '<script language="javascript">';
			echo 'location.href="t_survey_kepuasan_pelanggan_pendaftaran_pertanyaan.php?t_vat_registration_id='.$data["t_vat_registration_id"].'&p_survey_question_id='.$data2["p_survey_question_id"].'"';
			echo '</script>';
		}else{
			echo '<script language="javascript">';
			echo 'alert("Pertanyaan tidak ditemukan.")';
			echo '</script>';
		}
	}else{
		$output = '<table class="Record" cellspacing="0" cellpadding="5" style="font-size:15px;padding-left:15px;" border="0">
		<tr>
			<td colspan="3">NPWPD : <b>'.$param_arr['npwpd'].'</b> <b style="color:#FF0000;">TIDAK DITEMUKAN</b></td>
		</tr>
		</table>';
	}
	$dbConn->close();
	return $output;
}
?>
