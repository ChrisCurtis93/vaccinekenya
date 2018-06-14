<?php

include('../db.php');

global $db;
if(isset($_REQUEST['hosi_name'])&&
	isset($_REQUEST['contact_person_name'])&&
	isset($_REQUEST['county'])&&
	isset($_REQUEST['email'])&&
	isset($_REQUEST['password'])&&
	isset($_REQUEST['phone'])
){
	$hosi_name=$_REQUEST['hosi_name'];
	$contact_person_name=$_REQUEST['contact_person_name'];
	$county=$_REQUEST['county'];
	$email=$_REQUEST['email'];
	$password=$_REQUEST['password'];
	$phone=$_REQUEST['phone'];


	$data=array();
	$data['hospital_name']=$hosi_name;
	$data['person_in_charge_name']=$contact_person_name;
	$data['hospital_county']=$county;
	$data['hospital_email']=$email;
	$data['hospital_password']=md5(sha1($password));
	$data['hospital_phonenumber']=$phone;
	$data['active_status']="1";

	$db->AutoExecute('tb_users_hospitals',$data,'INSERT');

	$response['success']=1;
	$response['message']="user added successfully";

	echo json_encode($response);
}else{
	$response['success']=0;
	$response['message']="missing some information";
	echo json_encode($response);
}

?>