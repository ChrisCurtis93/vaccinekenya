<?php

include('../db.php');

@session_start();

$user_id=$_SESSION['user']['userid'];

global $db;
if(isset($_REQUEST['name'])&&
	isset($_REQUEST['inventory'])
){
	$name=$_REQUEST['name'];
	$inventory=$_REQUEST['inventory'];


	$data=array();
	$data['vaccine_name']=$name;
	$data['active_status']="1";

	$db->AutoExecute('tb_inventory_vaccines',$data,'INSERT');

	$id=$db->GetOne('SELECT * FROM tb_inventory_vaccines WHERE vaccine_name="'.$name.'" ORDER BY vaccine_id DESC');

	$data_inventory=array();
	$data_inventory['vaccine_id']=$id;
	$data_inventory['quantity_moved']=$inventory;
	$data_inventory['movement_by']=$user_id;
	$data_inventory['date_of_movement']=$db->GetOne("SELECT now()");

	$db->AutoExecute('tb_inventory_stocks_in',$data_inventory,'INSERT');

	$response['success']=1;
	$response['message']="user added successfully";

	echo json_encode($response);
}else{
	$response['success']=0;
	$response['message']="missing some information";
	echo json_encode($response);
}

?>