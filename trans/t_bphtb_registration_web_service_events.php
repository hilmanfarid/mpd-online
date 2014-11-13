<?php
//BindEvents Method @1-B8D18366
function BindEvents()
{
    global $t_bphtb_registration_list;
    global $CCSEvents;
    $t_bphtb_registration_list->CCSEvents["BeforeShowRow"] = "t_bphtb_registration_list_BeforeShowRow";
    $t_bphtb_registration_list->CCSEvents["BeforeSelect"] = "t_bphtb_registration_list_BeforeSelect";
    $t_bphtb_registration_list->ds->CCSEvents["AfterExecuteSelect"] = "t_bphtb_registration_list_ds_AfterExecuteSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//t_bphtb_registration_list_BeforeShowRow @2-85900DD6
function t_bphtb_registration_list_BeforeShowRow(& $sender)
{
    $t_bphtb_registration_list_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registration_list; //Compatibility
//End t_bphtb_registration_list_BeforeShowRow

//Set Row Style @10-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close t_bphtb_registration_list_BeforeShowRow @2-96DA6DA7
    return $t_bphtb_registration_list_BeforeShowRow;
}
//End Close t_bphtb_registration_list_BeforeShowRow

//t_bphtb_registration_list_BeforeSelect @2-0E7F8E53
function t_bphtb_registration_list_BeforeSelect(& $sender)
{
    $t_bphtb_registration_list_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registration_list; //Compatibility
//End t_bphtb_registration_list_BeforeSelect

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close t_bphtb_registration_list_BeforeSelect @2-BA5BB964
    return $t_bphtb_registration_list_BeforeSelect;
}
//End Close t_bphtb_registration_list_BeforeSelect

//t_bphtb_registration_list_ds_AfterExecuteSelect @2-12E53A02
function t_bphtb_registration_list_ds_AfterExecuteSelect(& $sender)
{
    $t_bphtb_registration_list_ds_AfterExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registration_list; //Compatibility
//End t_bphtb_registration_list_ds_AfterExecuteSelect

//Custom Code @705-2A29BDB7
// -------------------------
    // Write your own code here.
	$ws_client = getNusoap();
	
	$_POST['username']='teller';
	$_POST['password']='teller';
	
	/*$params = array('search' => '',
				'getParams' => json_encode($_GET),
				'controller' => json_encode(array('module' => 'base','class' => 'roles.dologin', 'method' => 'login', 'type' => 'json' )),
				'postParams' => json_encode($_POST),
				'jsonItems' => '',
				'start' => $start, 
				'limit' => $limit);
	$ws_data = getResultData($ws_client, $params);
	
    $params = array('search' => '',
					'getParams' => json_encode($_GET),
					'controller' => json_encode(array('module' => 'bds','class' => 'bphtb_registration', 'method' => 'read', 'type' => 'json' )),
					'postParams' => json_encode($_POST),
					'jsonItems' => '',
					'start' => 0,
					'limit' => 50);*/
	$params = array('search' => '',
				'getParams' => json_encode($_GET),
				'controller' => json_encode(array('module' => 'base','class' => 'roles.dologin', 'method' => 'login', 'type' => 'json' )),
				'postParams' => json_encode($_POST),
				'jsonItems' => '',
				'start' => $start, 
				'limit' => $limit);
	$ws_data = getResultData($ws_client, $params,'ws_proccess');
	
    $params = array('search' => '',
					'getParams' => json_encode($_GET),
					'controller' => json_encode(array('module' => 'bds','class' => 't_payment_receipt_skpd', 'method' => 'syncPaymentReceipt', 'type' => 'json' )),
					'postParams' => json_encode(array(
													"payment_date"=>"2014-11-13",
													"p_vat_type_dtl_id"=>45,
													"payment_vat_amount"=>"213123123"
												)),
					'jsonItems' => '',
					'start' => 0,
					'limit' => 50);
	$ws_data = getResultData($ws_client, $params,'ws_proccess');
	//================================================webservice bppt===============================
	/*$params = array('key' => '3273250001002014902014'); //NOP+tahun	
	$items = array();
	//$params = array('key' => '2014-09-09'); 	
    $items['items_bphtb']= getResultData($ws_client, $params,'search');
    
	$params = array('key' => '2014-09-09'); 	
    $items['realisasi'] = getResultData($ws_client, $params,'realisasi');*/
	echo '<pre>';
	print_r($ws_data);
	exit;
	            
    if($ws_data['success']) {

	}
                
	$t_bphtb_registration_list->DataSource->Record = $ws_data['data'];
// -------------------------
//End Custom Code

//Close t_bphtb_registration_list_ds_AfterExecuteSelect @2-86BDF331
    return $t_bphtb_registration_list_ds_AfterExecuteSelect;
}
//End Close t_bphtb_registration_list_ds_AfterExecuteSelect

//Page_OnInitializeView @1-9EE943C9
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registration_web_service; //Compatibility
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

//Page_BeforeShow @1-7A54B160
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_bphtb_registration_web_service; //Compatibility
//End Page_BeforeShow

//Custom Code @703-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

	function getNusoap(){
		include '../include/nusoap.php';
        $wsdl='http://localhost/server-ppat/server/wsdl.php?wsdl';
		//$wsdl = 'http://192.168.1.64/ws/server2.php';
        //create instance
        $nusoap = new nusoap_client ( $wsdl );
        
		//==============================wervice bppt tanpa header====================
		//$user = "wsclient";
        //$pass = "secret";
        
        //encrypt header value
        //$user = base64_encode ( $user );
        //$pass = base64_encode ( $pass );
        
        /*$header = '<AuthSoapHeader>
        			<UserName>' . $user . '</UserName>
        			<Password>' . $pass . '</Password>
        			</AuthSoapHeader>';
        
        //set header
        $nusoap->setHeaders ( $header */
        return $nusoap;
    }
    
    function getResultData($ws_client,$params,$call_function){
        //foreach($_COOKIE as $cookie_name => $cookie){
        //    $ws_client->setCookie($cookie_name,$cookie);
        //}
        $ws_data = $ws_client->call($call_function,$params);
		/*print_r($ws_data);
		exit;
		==============================wervice bppt tanpa check fault====================
    	*/if ($ws_client->fault) {
		    exit ( $ws_client->faultstring );
    	} else {
    		$err = $ws_client->getError ();
    		if ($err) {
    			exit ( $err );
    		}
    	}
        $ws_data = unserialize (base64_decode ($ws_data));//*/
        return $ws_data;
    }
?>
