<?php
//BindEvents Method @1-C31E5BAD
function BindEvents()
{
    global $t_bphtb_registrationForm;
    global $CCSEvents;
    $t_bphtb_registrationForm->Button3->CCSEvents["OnClick"] = "t_bphtb_registrationForm_Button3_OnClick";
    $t_bphtb_registrationForm->CCSEvents["BeforeSelect"] = "t_bphtb_registrationForm_BeforeSelect";
    $t_bphtb_registrationForm->CCSEvents["BeforeInsert"] = "t_bphtb_registrationForm_BeforeInsert";
    $t_bphtb_registrationForm->ds->CCSEvents["AfterExecuteDelete"] = "t_bphtb_registrationForm_ds_AfterExecuteDelete";
    $t_bphtb_registrationForm->CCSEvents["AfterUpdate"] = "t_bphtb_registrationForm_AfterUpdate";
    $t_bphtb_registrationForm->CCSEvents["BeforeShow"] = "t_bphtb_registrationForm_BeforeShow";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

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

//t_bphtb_registrationForm_BeforeSelect @94-50B4A263
function t_bphtb_registrationForm_BeforeSelect(& $sender)
{
    $t_bphtb_registrationForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_BeforeSelect

//Custom Code @842-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_BeforeSelect @94-EE18DB4A
    return $t_bphtb_registrationForm_BeforeSelect;
}
//End Close t_bphtb_registrationForm_BeforeSelect

//t_bphtb_registrationForm_BeforeInsert @94-DD9A285F
function t_bphtb_registrationForm_BeforeInsert(& $sender)
{
    $t_bphtb_registrationForm_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_BeforeInsert

//Custom Code @853-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_BeforeInsert @94-1B4122E7
    return $t_bphtb_registrationForm_BeforeInsert;
}
//End Close t_bphtb_registrationForm_BeforeInsert

//t_bphtb_registrationForm_ds_AfterExecuteDelete @94-5B1BB40B
function t_bphtb_registrationForm_ds_AfterExecuteDelete(& $sender)
{
    $t_bphtb_registrationForm_ds_AfterExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_ds_AfterExecuteDelete

//Custom Code @954-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_ds_AfterExecuteDelete @94-1AE8B690
    return $t_bphtb_registrationForm_ds_AfterExecuteDelete;
}
//End Close t_bphtb_registrationForm_ds_AfterExecuteDelete

//t_bphtb_registrationForm_AfterUpdate @94-437D2A61
function t_bphtb_registrationForm_AfterUpdate(& $sender)
{
    $t_bphtb_registrationForm_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_AfterUpdate

//Custom Code @1004-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_AfterUpdate @94-7E1ED9EB
    return $t_bphtb_registrationForm_AfterUpdate;
}
//End Close t_bphtb_registrationForm_AfterUpdate

//t_bphtb_registrationForm_BeforeShow @94-8B0D3CFC
function t_bphtb_registrationForm_BeforeShow(& $sender)
{
    $t_bphtb_registrationForm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registrationForm; //Compatibility
//End t_bphtb_registrationForm_BeforeShow

//Custom Code @1070-2A29BDB7
// -------------------------
    // Write your own code here.
	$t_bphtb_registrationForm->total_price->SetValue($t_bphtb_registrationForm->building_total_price->GetValue()+$t_bphtb_registrationForm->land_total_price->GetValue());
// -------------------------
//End Custom Code

//Close t_bphtb_registrationForm_BeforeShow @94-4D732B32
    return $t_bphtb_registrationForm_BeforeShow;
}
//End Close t_bphtb_registrationForm_BeforeShow

//Page_BeforeShow @1-A72CCD07
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registration_kb; //Compatibility
//End Page_BeforeShow

//Custom Code @1003-2A29BDB7
// -------------------------
    // Write your own code here.
	global $t_bphtb_registrationForm;
	$del_button = CCGetFromGet('allow_delete');
	if($del_button=='F'){
		$t_bphtb_registrationForm->DeleteAllowed = false;
		$t_bphtb_registrationForm->Button3->Visible =true;
	}else{
		$t_bphtb_registrationForm->Button3->Visible =false;
	}

	$filltheform = CCGetFromGet('filltheform');
	$submitInsert = CCGetFromPost('Button_Insert');
	
	if($filltheform == 'Y' and empty($submitInsert)) {

		$registration_no_ref = CCGetFromGet('registration_no_ref');
		$t_bphtb_registration_id_old = CCGetFromGet('t_bphtb_registration_id_old');
		
		$t_bphtb_registrationForm->registration_no_ref->SetValue($registration_no_ref);
		$t_bphtb_registrationForm->t_bphtb_registration_id_old->SetValue($t_bphtb_registration_id_old);
		

		$dbConn = new clsDBConnSIKP();
		$query = "select a.*,
				b.region_name as wp_kota,
				c.region_name as wp_kecamatan,
				d.region_name as wp_kelurahan,
				e.region_name as object_region,
				f.region_name as object_kecamatan,
				g.region_name as object_kelurahan,
				h.description as doc_name,
				i.payment_vat_amount

				from t_bphtb_registration as a 
				left join p_region as b
					on a.wp_p_region_id = b.p_region_id
				left join p_region as c
					on a.wp_p_region_id_kec = c.p_region_id
				left join p_region as d
					on a.wp_p_region_id_kel = d.p_region_id
				left join p_region as e
					on a.object_p_region_id = e.p_region_id
				left join p_region as f
					on a.object_p_region_id_kec = f.p_region_id
				left join p_region as g
					on a.object_p_region_id_kel = g.p_region_id
				left join p_bphtb_legal_doc_type as h
					on a.p_bphtb_legal_doc_type_id = h.p_bphtb_legal_doc_type_id
				left join t_payment_receipt_bphtb as i
					on a.t_bphtb_registration_id = i.t_bphtb_registration_id
				where a.t_bphtb_registration_id =".$t_bphtb_registration_id_old;
		
		
		$dbConn->query($query);
		while ($dbConn->next_record()) {
			
			/* Subjek Pajak */			
			$t_bphtb_registrationForm->wp_name->SetValue( $dbConn->f("wp_name") );
			$t_bphtb_registrationForm->npwp->SetValue( $dbConn->f("npwp") );
			$t_bphtb_registrationForm->wp_address_name->SetValue( $dbConn->f("wp_address_name") );
			$t_bphtb_registrationForm->phone_no->SetValue( $dbConn->f("phone_no") );
			$t_bphtb_registrationForm->mobile_phone_no->SetValue( $dbConn->f("mobile_phone_no") );
			$t_bphtb_registrationForm->wp_rt->SetValue( $dbConn->f("wp_rt") );
			$t_bphtb_registrationForm->wp_rw->SetValue( $dbConn->f("wp_rw") );

			$t_bphtb_registrationForm->wp_kota->SetValue( $dbConn->f("wp_kota") );
			$t_bphtb_registrationForm->wp_p_region_id->SetValue( $dbConn->f("wp_p_region_id") );

			$t_bphtb_registrationForm->wp_kecamatan->SetValue( $dbConn->f("wp_kecamatan") );
			$t_bphtb_registrationForm->wp_p_region_id_kec->SetValue( $dbConn->f("wp_p_region_id_kec") );

			$t_bphtb_registrationForm->wp_kelurahan->SetValue( $dbConn->f("wp_kelurahan") );
			$t_bphtb_registrationForm->wp_p_region_id_kel->SetValue( $dbConn->f("wp_p_region_id_kel") );


			/* Objek Pajak */
			$t_bphtb_registrationForm->njop_pbb->SetValue( $dbConn->f("njop_pbb") );
			$t_bphtb_registrationForm->object_address_name->SetValue( $dbConn->f("object_address_name") );
			$t_bphtb_registrationForm->object_rt->SetValue( $dbConn->f("object_rt") );
			$t_bphtb_registrationForm->object_rw->SetValue( $dbConn->f("object_rw") );

			$t_bphtb_registrationForm->object_kota->SetValue( $dbConn->f("object_region") );
			$t_bphtb_registrationForm->object_p_region_id->SetValue( trim($dbConn->f("object_p_region_id")) );

			$t_bphtb_registrationForm->object_kecamatan->SetValue( $dbConn->f("object_kecamatan") );
			$t_bphtb_registrationForm->object_p_region_id_kec->SetValue( trim($dbConn->f("object_p_region_id_kec")) );

			$t_bphtb_registrationForm->object_kelurahan->SetValue( $dbConn->f("object_kelurahan") );
			$t_bphtb_registrationForm->object_p_region_id_kel->SetValue( trim($dbConn->f("object_p_region_id_kel")) );
			
			$t_bphtb_registrationForm->p_bphtb_legal_doc_type_id->SetValue( $dbConn->f("p_bphtb_legal_doc_type_id") );
			$t_bphtb_registrationForm->bphtb_legal_doc_description->SetValue( $dbConn->f("bphtb_legal_doc_description") );
			$t_bphtb_registrationForm->add_disc_percent->SetValue( $dbConn->f("add_disc_percent") );
			
			$t_bphtb_registrationForm->add_disc_percent->SetValue( $dbConn->f("add_disc_percent") );
			
			$t_bphtb_registrationForm->land_area->SetValue( $dbConn->f("land_area") );
			$t_bphtb_registrationForm->land_price_per_m->SetValue( $dbConn->f("land_price_per_m") );
			$t_bphtb_registrationForm->land_total_price->SetValue( $dbConn->f("land_total_price") );
			
			$t_bphtb_registrationForm->building_area->SetValue( $dbConn->f("building_area") );
			$t_bphtb_registrationForm->building_price_per_m->SetValue( $dbConn->f("building_price_per_m") );
			$t_bphtb_registrationForm->building_total_price->SetValue( $dbConn->f("building_total_price") );
			
			$t_bphtb_registrationForm->total_price->SetValue( $dbConn->f("land_total_price") +  $dbConn->f("building_total_price"));
			$t_bphtb_registrationForm->market_price->SetValue( $dbConn->f("market_price") );
			$t_bphtb_registrationForm->total_price->SetValue( $dbConn->f("land_total_price") +  $dbConn->f("building_total_price"));
			/*NPOP*/
			$t_bphtb_registrationForm->npop->SetValue( $dbConn->f("npop") );
			$t_bphtb_registrationForm->add_discount->SetValue( $dbConn->f("add_discount") );
			$t_bphtb_registrationForm->npop_tkp->SetValue( $dbConn->f("npop_tkp") );
			$t_bphtb_registrationForm->npop_kp->SetValue( $dbConn->f("npop_kp") );
			$t_bphtb_registrationForm->bphtb_amt->SetValue( $dbConn->f("bphtb_amt") );
			$t_bphtb_registrationForm->bphtb_discount->SetValue( $dbConn->f("bphtb_discount") );
			$t_bphtb_registrationForm->description->SetValue( $dbConn->f("description") );
			$t_bphtb_registrationForm->bphtb_amt_final_old->SetValue( $dbConn->f("bphtb_amt_final") );
			$t_bphtb_registrationForm->prev_payment_amount->SetValue( $dbConn->f("payment_vat_amount") );
			

			/* sisa pembayaran */
			//$t_bphtb_registrationForm->bphtb_amt_final->SetValue( $dbConn->f("bphtb_amt_final") -  $dbConn->f("payment_vat_amount"));
		}
		$dbConn->close();
	}
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeOutput @1-18147201
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registration_kb; //Compatibility
//End Page_BeforeOutput
	global $t_bphtb_registrationForm;
//Custom Code @1069-2A29BDB7
// -------------------------

// -------------------------
//End Custom Code

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput
?>
