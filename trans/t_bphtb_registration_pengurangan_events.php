s<?php
//BindEvents Method @1-BD0B84C4
function BindEvents()
{
    global $t_bphtb_registrationForm;
    $t_bphtb_registrationForm->Button2->CCSEvents["OnClick"] = "t_bphtb_registrationForm_Button2_OnClick";
    $t_bphtb_registrationForm->Button3->CCSEvents["OnClick"] = "t_bphtb_registrationForm_Button3_OnClick";
    $t_bphtb_registrationForm->Button4->CCSEvents["OnClick"] = "t_bphtb_registrationForm_Button4_OnClick";
    $t_bphtb_registrationForm->Button6->CCSEvents["OnClick"] = "t_bphtb_registrationForm_Button6_OnClick";
    $t_bphtb_registrationForm->Button5->CCSEvents["OnClick"] = "t_bphtb_registrationForm_Button5_OnClick";
    $t_bphtb_registrationForm->Button7->CCSEvents["OnClick"] = "t_bphtb_registrationForm_Button7_OnClick";
    $t_bphtb_registrationForm->CCSEvents["BeforeSelect"] = "t_bphtb_registrationForm_BeforeSelect";
    $t_bphtb_registrationForm->CCSEvents["BeforeInsert"] = "t_bphtb_registrationForm_BeforeInsert";
    $t_bphtb_registrationForm->ds->CCSEvents["AfterExecuteDelete"] = "t_bphtb_registrationForm_ds_AfterExecuteDelete";
    $t_bphtb_registrationForm->CCSEvents["BeforeShow"] = "t_bphtb_registrationForm_BeforeShow";
    $t_bphtb_registrationForm->ds->CCSEvents["AfterExecuteSelect"] = "t_bphtb_registrationForm_ds_AfterExecuteSelect";
    $t_bphtb_registrationForm->ds->CCSEvents["BeforeExecuteUpdate"] = "t_bphtb_registrationForm_ds_BeforeExecuteUpdate";
}
//End BindEvents Method

//t_bphtb_registrationForm_Button2_OnClick @71-41066659
function t_bphtb_registrationForm_Button2_OnClick(& $sender)
{
    $t_bphtb_registrationForm_Button2_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_Button2_OnClick

//Custom Code @72-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_Button2_OnClick @71-DE281A2F
    return $t_bphtb_registrationForm_Button2_OnClick;
}
//End Close t_bphtb_registrationForm_Button2_OnClick

//t_bphtb_registrationForm_Button3_OnClick @73-6F1B2C91
function t_bphtb_registrationForm_Button3_OnClick(& $sender)
{
    $t_bphtb_registrationForm_Button3_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_Button3_OnClick

//Custom Code @74-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_Button3_OnClick @73-1FA6C5EF
    return $t_bphtb_registrationForm_Button3_OnClick;
}
//End Close t_bphtb_registrationForm_Button3_OnClick

//t_bphtb_registrationForm_Button4_OnClick @202-A549D8E9
function t_bphtb_registrationForm_Button4_OnClick(& $sender)
{
    $t_bphtb_registrationForm_Button4_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_Button4_OnClick

//Custom Code @203-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_Button4_OnClick @202-369DD06C
    return $t_bphtb_registrationForm_Button4_OnClick;
}
//End Close t_bphtb_registrationForm_Button4_OnClick

//t_bphtb_registrationForm_Button6_OnClick @206-F9734D79
function t_bphtb_registrationForm_Button6_OnClick(& $sender)
{
    $t_bphtb_registrationForm_Button6_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_Button6_OnClick

//Custom Code @207-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_Button6_OnClick @206-6EF169AD
    return $t_bphtb_registrationForm_Button6_OnClick;
}
//End Close t_bphtb_registrationForm_Button6_OnClick

//t_bphtb_registrationForm_Button5_OnClick @204-8B549221
function t_bphtb_registrationForm_Button5_OnClick(& $sender)
{
    $t_bphtb_registrationForm_Button5_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_Button5_OnClick

//Custom Code @205-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_Button5_OnClick @204-F7130FAC
    return $t_bphtb_registrationForm_Button5_OnClick;
}
//End Close t_bphtb_registrationForm_Button5_OnClick

//t_bphtb_registrationForm_Button7_OnClick @220-D76E07B1
function t_bphtb_registrationForm_Button7_OnClick(& $sender)
{
    $t_bphtb_registrationForm_Button7_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_Button7_OnClick

//Custom Code @221-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_Button7_OnClick @220-AF7FB66D
    return $t_bphtb_registrationForm_Button7_OnClick;
}
//End Close t_bphtb_registrationForm_Button7_OnClick

//t_bphtb_registrationForm_BeforeSelect @2-50B4A263
function t_bphtb_registrationForm_BeforeSelect(& $sender)
{
    $t_bphtb_registrationForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_BeforeSelect

//Custom Code @77-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_BeforeSelect @2-EE18DB4A
    return $t_bphtb_registrationForm_BeforeSelect;
}
//End Close t_bphtb_registrationForm_BeforeSelect

//t_bphtb_registrationForm_BeforeInsert @2-DD9A285F
function t_bphtb_registrationForm_BeforeInsert(& $sender)
{
    $t_bphtb_registrationForm_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_BeforeInsert

//Custom Code @78-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_BeforeInsert @2-1B4122E7
    return $t_bphtb_registrationForm_BeforeInsert;
}
//End Close t_bphtb_registrationForm_BeforeInsert

//t_bphtb_registrationForm_ds_AfterExecuteDelete @2-5B1BB40B
function t_bphtb_registrationForm_ds_AfterExecuteDelete(& $sender)
{
    $t_bphtb_registrationForm_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_ds_AfterExecuteDelete

//Custom Code @79-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_ds_AfterExecuteDelete @2-1AE8B690
    return $t_bphtb_registrationForm_ds_AfterExecuteDelete;
}
//End Close t_bphtb_registrationForm_ds_AfterExecuteDelete

//t_bphtb_registrationForm_BeforeShow @2-8B0D3CFC
function t_bphtb_registrationForm_BeforeShow(& $sender)
{
    $t_bphtb_registrationForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_BeforeShow

//Custom Code @140-2A29BDB7
// -------------------------

// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_BeforeShow @2-4D732B32
    return $t_bphtb_registrationForm_BeforeShow;
}
//End Close t_bphtb_registrationForm_BeforeShow

//t_bphtb_registrationForm_ds_AfterExecuteSelect @2-624E9AA7
function t_bphtb_registrationForm_ds_AfterExecuteSelect(& $sender)
{
    $t_bphtb_registrationForm_ds_AfterExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_ds_AfterExecuteSelect

//Custom Code @141-2A29BDB7
// -------------------------
	
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_ds_AfterExecuteSelect @2-BCBC28C3
    return $t_bphtb_registrationForm_ds_AfterExecuteSelect;
}
//End Close t_bphtb_registrationForm_ds_AfterExecuteSelect

//t_bphtb_registrationForm_ds_BeforeExecuteUpdate @2-688545E4
function t_bphtb_registrationForm_ds_BeforeExecuteUpdate(& $sender)
{
    $t_bphtb_registrationForm_ds_BeforeExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_ds_BeforeExecuteUpdate

//Custom Code @191-2A29BDB7
// -------------------------
    $t_bphtb_registration_id = $t_bphtb_registrationForm->t_bphtb_registration_id->GetValue();
	$t_bphtb_exemption_id = $t_bphtb_registrationForm->t_bphtb_exemption_id->GetValue();
	
	//field
	$bphtb_discount = $t_bphtb_registrationForm->bphtb_discount->GetValue();
	
	//administrator
	$administrator_id = $t_bphtb_registrationForm->administrator_id->GetValue();
	
	//pemeriksa
	$pemeriksa_id = $t_bphtb_registrationForm->pemeriksa_id->GetValue();
		
	//lembar perhitungan
	$pilihan_lembar_cetak = $t_bphtb_registrationForm->pilihan_lembar_cetak->GetValue();
    $opsi_a2 = $t_bphtb_registrationForm->opsi_a2->GetValue();
	$opsi_a2_keterangan = $t_bphtb_registrationForm->opsi_a2_keterangan->GetValue();
	$opsi_b7 = $t_bphtb_registrationForm->opsi_b7->GetValue();
	$opsi_b7_keterangan = $t_bphtb_registrationForm->opsi_b7_keterangan->GetValue();
	
	$keterangan_opsi_c = $t_bphtb_registrationForm->keterangan_opsi_c->GetValue();
	$keterangan_opsi_c_gono_gini = $t_bphtb_registrationForm->keterangan_opsi_c_gono_gini->GetValue();
	
	$tanggal_sk = $t_bphtb_registrationForm->tanggal_sk->GetText();
	$tanggal_berita_acara = $t_bphtb_registrationForm->tanggal_berita_acara->GetText();
	$dasar_pengurang = $t_bphtb_registrationForm->dasar_pengurang->GetText();
	$analisa_penguranan = $t_bphtb_registrationForm->analisa_penguranan->GetText();
	
	$jenis_perolehan_hak = '';
	$arrJenisPerolehan = array('1' => 'Waris',
							  '2' => 'Fasos',
							  '3' => 'Rumah Dinas',
							  '4' => 'Waris Gono-Gini',
							  '5' => 'Hibah',
							  '6' => 'Peralihan Hak Baru');
	
	$jenis_perolehan_hak = $arrJenisPerolehan[$pilihan_lembar_cetak];

	$dbConn = new clsDBConnSIKP();
    $query = "UPDATE sikp.t_bphtb_exemption
				SET exemption_amount = ".$bphtb_discount.",
				pemeriksa_id = ".$pemeriksa_id.",
				administrator_id = ".$administrator_id.",
				pilihan_lembar_cetak = '".$pilihan_lembar_cetak."',
				opsi_a2 = '".$opsi_a2."',
				opsi_a2_keterangan = '".$opsi_a2_keterangan."',
				opsi_b7 = '".$opsi_b7."',
				opsi_b7_keterangan = '".$opsi_b7_keterangan."',
				keterangan_opsi_c = '".$keterangan_opsi_c."',
				keterangan_opsi_c_gono_gini = '".$keterangan_opsi_c_gono_gini."',
				jenis_perolehan_hak = '".$jenis_perolehan_hak."',
				tanggal_sk = '".$tanggal_sk."',
				tanggal_berita_acara = '".$tanggal_berita_acara."',
				dasar_pengurang = '".$dasar_pengurang."',
				analisa_penguranan = '".$analisa_penguranan."' WHERE t_bphtb_exemption_id = ".$t_bphtb_exemption_id;
	$dbConn->query($query);
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_ds_BeforeExecuteUpdate @2-EA5ACB50
    return $t_bphtb_registrationForm_ds_BeforeExecuteUpdate;
}
//End Close t_bphtb_registrationForm_ds_BeforeExecuteUpdate
?>
