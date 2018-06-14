<?php

require_once('../../data/db.php');
require_once('../dbconfig.php');
global $db;
session_start();

//checking if the value exists or not 
if(isset($_REQUEST['name'])&&
	isset($_REQUEST['email'])&&
	isset($_REQUEST['phone'])&&
	isset($_REQUEST['id'])&&
	isset($_REQUEST['kra_pin'])&&
	isset($_REQUEST['dob'])&&
	isset($_REQUEST['next_of_kin'])&&
	isset($_REQUEST['next_of_kin_id'])&&
	isset($_REQUEST['next_of_kin_phone'])&&	
	isset($_REQUEST['gender'])&&
	isset($_REQUEST['job_cat'])&&
	isset($_REQUEST['user_id'])
){

//saving the data to local variables
$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$phone=$_REQUEST['phone'];
$kra_pin=$_REQUEST['kra_pin'];
$id=$_REQUEST['id'];
$dob=$_REQUEST['dob'];
$next_of_kin=$_REQUEST['next_of_kin'];
$next_of_kin_id=$_REQUEST['next_of_kin_id'];
$next_of_kin_phone=$_REQUEST['next_of_kin_phone'];
$gender=$_REQUEST['gender'];
$job_cat=$_REQUEST['job_cat'];


$user_id=$_REQUEST['user_id'];

	
	$query_command="UPDATE `tb_customers` SET `username`='$name',`email`='$email',`phone_number`='$phone',`KRA_PIN`='$kra_pin',`national_id`='$id',`DOB`='$dob',`next_of_kin`='$next_of_kin',`next_of_kin_rln`='$next_of_kin_id',`next_of_kin_phone`='$next_of_kin_phone' WHERE user_id='$user_id'";

	$query_execute=mysqli_query($open_database_stream,$query_command);

	if(!empty($query_execute)){

		$json = json_encode(array(
	  'success' => '1',
	  'message' => 'Customer Updated successfully'));

		echo $json;

	// 	$query_command_more="UPDATE `tb_more_customer_details` SET `gender`='$gender',`job_cat`='$job_cat' WHERE customer_id='$user_id'";

	// $query_execute_more=mysqli_query($open_database_stream,$query_command_more);

	// if(!empty($query_execute_more)){

	// 	$json = json_encode(array(
	//   'success' => '1',
	//   'message' => 'Customer Updated successfully'));

	// 	echo $json;
	// }else{
	// 	$json = json_encode(array(
	//   'success' => '0',
	//   'message' => 'Failed, Customer Record was not Inserted, in query command more'
	// ));
	// echo $json;
	// }

		
	}else{
		$json = json_encode(array(
	  'success' => '0',
	  'error' => mysqli_error($open_database_stream),
	  'message' => 'Failed, Customer Record was not Inserted, in query command'
	));
	echo $json;

	}
	

}else{

		$json = json_encode(array(
	  'success' => '0',
	  'message' => 'Failed, Customer Record was not Inserted, Some data is missing'
	));
	echo $json;
}


?>


