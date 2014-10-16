<?php
define("RelativePath", "..");
include_once(RelativePath . "/Common.php");
ob_start();
if (isset($_SERVER['HTTP_ORIGIN'])) {
	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

    // Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

	exit(0);
}
function insertHotel($t_vat_registration_id,$item_potensi){
	$dbConn = new clsDBConnSIKP();
	$sql =  " insert into t_vat_reg_dtl_hotel ( " .
            " t_vat_reg_dtl_hotel_id,t_vat_registration_id,p_room_type_id,room_qty," .
            " service_qty,service_charge_wd,service_charge_we,description," .
            " creation_date,created_by,updated_date,updated_by ) values (" .
            " generate_id('sikp','t_vat_reg_dtl_hotel','t_vat_reg_dtl_hotel_id'),".$t_vat_registration_id.",".$item_potensi['p_room_type_id'].",".$item_potensi['room_qty'].",".
            $item_potensi['service_qty'].",".$item_potensi['service_charge_wd'].",".$item_potensi['service_charge_we'].",'".$item_potensi['room_description']."',".
            " sysdate(),'ADMIN',sysdate(),'ADMIN' )";
	if($dbConn->query($sql)){
	}else{
		deleteAll($t_vat_registration_id);
		throw new Exception($dbConn->Errors->Errors[0]);
	}
}
function insertParkir($t_vat_registration_id,$item_potensi){
	$dbConn = new clsDBConnSIKP();
	$sql =  "insert into t_vat_reg_dtl_parking (t_vat_reg_dtl_parking_id,t_vat_registration_id,classification_desc,parking_size," .
		    " max_load_qty,avg_subscription_qty,first_service_charge,next_service_charge," .
		    " description,creation_date,created_by,updated_date,updated_by)" .
            " values (generate_id('sikp','t_vat_reg_dtl_parking','t_vat_reg_dtl_parking_id'),".$t_vat_registration_id.",'classification_desc',".$item_potensi['parking_size']."," .
		    $item_potensi['max_load_qty'].",".$item_potensi['avg_subscription_qty'].",".$item_potensi['first_service_charge'].",".$item_potensi['next_service_charge'].",'".$item_potensi['var_description']."',sysdate(),'ADMIN',sysdate(),'ADMIN')";
	if($dbConn->query($sql)){
	}else{
		deleteAll($t_vat_registration_id);
		throw new Exception($dbConn->Errors->Errors[0]);
	}
}
function insertResto($t_vat_registration_id,$item_potensi){
	$dbConn = new clsDBConnSIKP();
	$sql = " insert into t_vat_reg_dtl_restaurant ( " .
              " t_vat_reg_dtl_restaurant_id,t_vat_registration_id,service_type_desc,seat_qty," .
              " table_qty,max_service_qty,avg_subscription,description," .
              " creation_date,created_by,updated_date,updated_by ) values (" .
              " generate_id('sikp','t_vat_reg_dtl_restaurant','t_vat_reg_dtl_restaurant_id'),".$t_vat_registration_id.",'".$item_potensi['service_type_desc']."',".$item_potensi['seat_qty']."," .
              $item_potensi['table_qty'].",".$item_potensi['max_service_qty'].",".$item_potensi['avg_subscription'].",'".$item_potensi['restaurant_description']."'," .
              " sysdate(),'ADMIN',sysdate(),'ADMIN' )";
	if($dbConn->query($sql)){
	}else{
		deleteAll($t_vat_registration_id);
		throw new Exception($dbConn->Errors->Errors[0]);
	}
}
function insertEnt($t_vat_registration_id,$item_potensi){
	$dbConn = new clsDBConnSIKP();
	$sql = "insert into t_vat_reg_dtl_entertaintment (".
            "t_vat_reg_dtl_entertaintment_id,t_vat_registration_id,entertainment_desc,service_charge_wd," .
            "service_charge_we,seat_qty,room_qty,clerk_qty,booking_hour,f_and_b,portion_person,creation_date," .
            "created_by,updated_date,updated_by ) values ( ".
            "generate_id('sikp','t_vat_reg_dtl_entertaintment','t_vat_reg_dtl_entertaintment_id'),".$t_vat_registration_id.",'".$item_potensi['entertainment_desc']."',".$item_potensi['service_charge_wd']."," .
            $item_potensi['service_charge_we'].",".$item_potensi['seat_qty'].",".$item_potensi['room_qty'].",".$item_potensi['clerk_qty'].",".$item_potensi['booking_hour'].",".$item_potensi['f_and_b'].",".$item_potensi['portion_person'].",sysdate()," .
            "'ADMIN',sysdate(),'ADMIN'".
            ")";
	if($dbConn->query($sql)){
	}else{
		deleteAll($t_vat_registration_id);
		throw new Exception($dbConn->Errors->Errors[0]);
	}
}
function deleteAll($t_vat_registration){
	$dbConn = new clsDBConnSIKP();
	$sql = "delete from t_license_letter where t_vat_registration_id=".$t_vat_registration.";".
		   "delete from t_vat_reg_employee where t_vat_registration_id=".$t_vat_registration.";".
		   "delete from t_vat_reg_dtl_restaurant where t_vat_registration_id=".$t_vat_registration.";".
		   "delete from t_vat_reg_dtl_entertaintment where t_vat_registration_id=".$t_vat_registration.";".
		   "delete from t_vat_reg_dtl_parking where t_vat_registration_id=".$t_vat_registration.";".
		   "delete from t_vat_reg_dtl_hotel where t_vat_registration_id=".$t_vat_registration.";".
		   "delete from t_vat_registration where t_vat_registration_id=".$t_vat_registration.";";
	if($dbConn->query($sql)){
	}else{
		//do something here
	}
}
$dbConn = new clsDBConnSIKP();

$registration_data = $_POST['data_registrasi'];
$pelanggan_data = $_POST['data_pelanggan'];
$potensi_data = $_POST['data_potensi'];
$items_registration = array();
$items_pelanggan = array();
$items_potensi = array();
$registration_data = json_decode($registration_data);
$pelanggan_data = json_decode($pelanggan_data);
$potensi_data = json_decode($potensi_data);
foreach($registration_data as $item){
	$items_registration[$item->name]=$item->value;
}
foreach($pelanggan_data as $item){
	$items_pelanggan[$item->name]=$item->value;
}
foreach($potensi_data as $item){
	$items_potensi[$item->name]=$item->value;
}
$sql = "select * from f_ins_order_registration_new (  " . $items_registration['jenis_permohonan'] . "," .
                                        "'" . $items_registration['description'] . "'," .
                                        "'" . 'ADMIN' . "'," .
                                        "'" . $items_pelanggan['wp_name_Name'] . "'," . //4
                                        "'" . $items_pelanggan['wp_address_name_Name'] . "'," .
                                        "'" . $items_pelanggan['wp_address_no_Name'] . "'," .
                                        "'" . $items_pelanggan['wp_address_rt_Name'] . "'," .
                                        "'" . $items_pelanggan['wp_address_rw_Name'] . "'," .
                                        $items_pelanggan['p_wp_kelurahan'] . "," .
                                        $items_pelanggan['p_wp_kecamatan'] . "," .
                                        $items_pelanggan['p_wp_kota'] . "," .
                                        "'" . $items_pelanggan['wp_phone_no_Name'] . "'," .
                                        "'" . $items_pelanggan['wp_phone_no_Name'] . "'," .
                                        "'" . $items_pelanggan['wp_fax_no_Name'] . "'," .
                                        "'" . $items_pelanggan['wp_zip_code_Name'] . "'," .
                                        "'" . $items_pelanggan['wp_email_Name'] . "'," .
                                        "'" . $items_pelanggan['company_name_Name'] . "'," . //17
                                        "'" . $items_pelanggan['address_name_Name'] . "'," .
                                        "'" . $items_pelanggan['address_no_Name'] . "'," .
                                        "'" . $items_pelanggan['address_rt_Name'] . "'," .
                                        "'" . $items_pelanggan['address_rw_Name'] . "'," .
                                        $items_pelanggan['p_kelurahan_code'] . "," .
                                        $items_pelanggan['p_kecamatan_code'] . "," .
                                        $items_pelanggan['p_kota_code'] . "," .
                                        "'" . $items_pelanggan['phone_no_Name'] . "'," .
                                        "'" . $items_pelanggan['phone_no_Name'] . "'," .
                                        "'" . $items_pelanggan['fax_no_Name'] . "'," .
                                        "'" . $items_pelanggan['zip_code_Name'] . "'," .
                                        "'" . $items_pelanggan['company_brand_Name'] . "'," . //29
                                        "'" . $items_pelanggan['brand_address_name_Name'] . "'," .
                                        "'" . $items_pelanggan['brand_address_no_Name'] . "'," .
                                        "'" . $items_pelanggan['brand_address_rt_Name'] . "'," .
                                        "'" . $items_pelanggan['brand_address_rw_Name'] . "'," .
                                        $items_pelanggan['p_brand_kelurahan'] . "," .
                                        $items_pelanggan['p_brand_kecamatan'] . "," .
                                        $items_pelanggan['p_brand_kota'] . "," .
                                        "'" . $items_pelanggan['brand_phone_no_Name'] . "'," .
                                        "'" . $items_pelanggan['brand_phone_no_Name'] . "'," .
                                        "'" . $items_pelanggan['brand_fax_no_Name'] . "'," .
                                        "'" . $items_pelanggan['brand_zip_code_Name'] . "'," .
                                        "'" . $items_pelanggan['company_owner_Name'] . "'," . //41
                                        $items_pelanggan['p_job_position_id'] . "," .
                                        "'" . $items_pelanggan['address_name_owner_Name'] . "'," .
                                        "'" . $items_pelanggan['address_no_owner_Name'] . "'," .
                                        "'" . $items_pelanggan['address_rt_owner_Name'] . "'," .
                                        "'" . $items_pelanggan['address_rw_owner_Name'] . "'," .
                                        $items_pelanggan['p_kelurahan_own_code'] . "," .
                                        $items_pelanggan['p_kecamatan_own_code'] . "," .
                                        $items_pelanggan['p_kota_own_code'] . "," .
                                        "'" . $items_pelanggan['phone_no_owner_Name'] . "'," .
                                        "'" . $items_pelanggan['phone_no_owner_Name'] . "'," .
                                        "'" . $items_pelanggan['fax_no_owner_Name'] . "'," .
                                        "'" . $items_pelanggan['zip_code_owner_Name'] . "'," .
                                        "'" . $items_pelanggan['email_owner_Name'] . "'," .
                                        $items_pelanggan['p_vat_type_dtl_id'] . "," . //55
                                        $items_pelanggan['p_vat_type_dtl_id'] . "," .
                                        $items_pelanggan['p_vat_type_dtl_id'] . "," .
                                        $items_pelanggan['p_vat_type_dtl_id'] . "," .
                                        "'" . $items_registration['InputUsername'] . "'," . //59
                                        "'" . $items_registration['InputPassword'] . "'," .
                                        $items_registration['p_private_question_id'] . "," .
                                        "'" . $items_registration['question_answer'] . "'," .
                                        $items_registration['p_private_question_id'] . "," .
                                        "'" . $items_registration['question_answer'] . "', " . 
                                        " 1 ," .
                                        " 1 ," .
                                        " '1', " .
                                        " 1," .
                                        " '1' " .
                                        " ) ;";

// connect to the database
$dbConn->query( $sql );
$dbConn->next_record(); 
$record = $dbConn->Record;
$return = array('items' => '','success' => true,'message'=>'');
try{
	if(!empty($items_potensi['p_license_type_id'])){
		$sql = "insert into t_license_letter (t_license_letter_id,t_vat_registration_id,p_license_type_id,license_no,valid_from,description,creation_date,created_by,updated_date,updated_by)".
			   "values (generate_id('sikp','t_license_letter','t_license_letter_id'),".$record['o_vat_reg_id'].",".$items_potensi['p_license_type_id'].",'".$items_potensi['license_no']."',sysdate(),'".$items_potensi['description']."',sysdate(),'ADMIN',sysdate(),'ADMIN')";
		$dbConn->query( $sql );
	}
	if(!empty($items_potensi['p_license_type_id2'])){
		$sql = "insert into t_license_letter (t_license_letter_id,t_vat_registration_id,p_license_type_id,license_no,valid_from,description,creation_date,created_by,updated_date,updated_by)".
			   "values (generate_id('sikp','t_license_letter','t_license_letter_id'),".$record['o_vat_reg_id'].",".$items_potensi['p_license_type_id2'].",'".$items_potensi['license_no2']."',sysdate(),'".$items_potensi['description2']."',sysdate(),'ADMIN',sysdate(),'ADMIN')";
		$dbConn->query( $sql );
	}
	if(!empty($items_potensi['p_job_position_id'])){ 
	$sql = " insert into t_vat_reg_employee ( ".
				" t_vat_reg_employee_id,t_vat_registration_id,p_job_position_id,employee_qty," .
				" employee_salery,description,creation_date,created_by,updated_date,updated_by )" .
				" values ( ".
				" generate_id('sikp','t_vat_reg_employee','t_vat_reg_employee_id'),".
				$record['o_vat_reg_id'] .",".
				$items_potensi['p_license_type_id'] .",".
				$items_potensi['num_worker'] .",".
				$items_potensi['salary'] .",".
				"'".$items_potensi['job_description']."',".
				"sysdate,".
				"'ADMIN',".
				"sysdate,".
				"'ADMIN')";
		$dbConn->query( $sql );
	}
	if(!empty($items_potensi['p_job_position_id2'])){ 
	$sql = " insert into t_vat_reg_employee ( ".
				" t_vat_reg_employee_id,t_vat_registration_id,p_job_position_id,employee_qty," .
				" employee_salery,description,creation_date,created_by,updated_date,updated_by )" .
				" values ( ".
				" generate_id('sikp','t_vat_reg_employee','t_vat_reg_employee_id'),".
				$record['o_vat_reg_id'] .",".
				$items_potensi['p_license_type_id2'] .",".
				$items_potensi['num_worker2'] .",".
				$items_potensi['salary2'] .",".
				"'".$items_potensi['job_description2']."',".
				"sysdate,".
				"'ADMIN',".
				"sysdate,".
				"'ADMIN')";
		$dbConn->query( $sql );
	}
	$idx_hotel=1;
	while ($idx_hotel <= 5){
		if($idx_hotel == 1){
			$idx =''; 
		}else{
			$idx = $idx_hotel;
		}
		if(!empty($items_potensi['p_room_type_id'.$idx])){
			$array_insert_potensi = array(
											"p_room_type_id" => $items_potensi['p_room_type_id'.$idx],
											"room_qty" => $items_potensi['room_qty'.$idx],
											"service_qty" => $items_potensi['frk_pengguna_layanan'.$idx],
											"service_charge_wd" => $items_potensi['service_charge_wd'.$idx],
											"service_charge_we" => $items_potensi['service_charge_we'.$idx],
											"room_description" => $items_potensi['room_description'.$idx]
										);
			insertHotel($record['o_vat_reg_id'],$array_insert_potensi);
		}
		$idx_hotel++;
	}

	$idx_parkir=1;
	while ($idx_parkir <= 3){
		if($idx_parkir == 1){
			$idx =''; 
		}else{
			$idx = $idx_parkir;
		}
		if(!empty($items_potensi['parking_size'.$idx])&&$items_potensi['parking_size'.$idx]!=''){
			$array_insert_potensi = array(
											"parking_size" => $items_potensi['parking_size'.$idx],
											"max_load_qty" => $items_potensi['max_load_qty'.$idx],
											"avg_subscription_qty" => $items_potensi['avg_subscription_qty'.$idx],
											"first_service_charge" => $items_potensi['first_service_charge'.$idx],
											"next_service_charge" => $items_potensi['next_service_charge'.$idx],
											"var_description" => $items_potensi['parking_description'.$idx]
										);
			insertParkir($record['o_vat_reg_id'],$array_insert_potensi);
		}
		$idx_parkir++;
	}
	$idx_resto=1;
	while ($idx_resto <= 3){
		if($idx_resto == 1){
			$idx =''; 
		}else{
			$idx = $idx_resto;
		}
		if(!empty($items_potensi['service_type_desc'.$idx])&&$items_potensi['service_type_desc'.$idx]!=''){
			$array_insert_potensi = array(
											"service_type_desc" => $items_potensi['parking_size'.$idx],
											"seat_qty" => $items_potensi['seat_qty'.$idx],
											"table_qty" => $items_potensi['table_qty'.$idx],
											"max_service_qty" => $items_potensi['max_service_qty'.$idx],
											"avg_subscription" => $items_potensi['avg_subscription'.$idx],
											"restaurant_description" => $items_potensi['restaurant_description'.$idx]
										);
			insertResto($record['o_vat_reg_id'],$array_insert_potensi);
		}
		$idx_resto++;
	}
	$idx_ent=1;
	while ($idx_ent <= 3){
		if($idx_ent == 1){
			$idx =''; 
		}else{
			$idx = $idx_ent;
		}
		if(!empty($items_potensi['entertainment_desc'.$idx])&&$items_potensi['entertainment_desc'.$idx]!=''){
			$array_insert_potensi = array(
											"entertainment_desc" => $items_potensi['entertainment_desc'.$idx],
											"service_charge_wd" => $items_potensi['entertainment_service_charge_md'.$idx],
											"service_charge_we" => $items_potensi['entertainment_service_charge_we'.$idx],
											"seat_qty" => $items_potensi['ent_seat_qty'.$idx],
											"room_qty" => $items_potensi['ent_room_qty'.$idx],
											"clerk_qty" => $items_potensi['clerk_qty'.$idx],
											"booking_hour" => $items_potensi['booking_hour'.$idx],
											"f_and_b" => $items_potensi['f_and_b'.$idx],
											"portion_person" => $items_potensi['portion_person'.$idx]
										);
			insertEnt($record['o_vat_reg_id'],$array_insert_potensi);
		}
		$idx_ent++;
	}
	$sql_submit = "select o_result_code  as CODE, o_result_msg as MSG ".
                                       "from f_first_submit_engine ( 500 , ".
                                       $record['o_cust_order_id'].",".
                                       " 'ADMIN' ); ";
	$dbConn->query( $sql_submit );
}catch(Exception $e){
	ob_clean();
	$return['message']= $e->getMessage();
	$return['success']= false;
	echo json_encode($return);
	exit;
}
$return['items']=$record;
echo json_encode($return);