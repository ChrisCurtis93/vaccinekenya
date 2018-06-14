<?php

require_once('../../data/db.php');
global $db;
@session_start();

//checking if the value exists or not 
if(
	isset($_REQUEST['name'])&&
	isset($_REQUEST['date'])&&
	isset($_REQUEST['end'])&&
	isset($_REQUEST['agenda'])&&
	isset($_REQUEST['refrence'])&&
	isset($_REQUEST['phone'])){                                                                       

//saving the data to local variables

$name=$_REQUEST['name'];
$date=$_REQUEST['date'];
$end=$_REQUEST['end'];
$agenda=$_REQUEST['agenda'];
$refrence=$_REQUEST['refrence'];
$phone=$_REQUEST['phone'];
$user_id=$_SESSION['user']['userid'];

	$appointment=array();
	$appointment['client_name'] = $name;
	$appointment['agenda'] = $agenda;
	$appointment['phone'] = $phone;
	$appointment['start_time'] = $date;
	$appointment['end_time'] = $end;
	$appointment['referral'] = $refrence; 
	$appointment['client_to'] = $user_id;
	

	$db->AutoExecute('tb_appointments',$appointment, 'INSERT');

		$json = json_encode(array(
	  'success' => '1',
	  'message' => 'appointment added successfully'));

		echo $json;

}else{

		$json = json_encode(array(
	  'success' => '0',
	  'message' => 'Failed, event Record was not Inserted, Some data is missing'
	));
	echo $json;
}


?>


