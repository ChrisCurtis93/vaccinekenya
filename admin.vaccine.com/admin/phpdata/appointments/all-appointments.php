<?php

require_once('../../data/db.php');
require_once('../../modules/customers/class.php');
@session_start();
global $db;
$user_id=$_SESSION['user']['userid'];


	$results = $db->GetArray("SELECT * FROM tb_appointments WHERE client_to='$user_id'");

	$response['appointment']=array();

	foreach($results as $row){

		$appointment=array();

		$appointment['events_id']=$row["appointment_id"];
		$appointment['title']=$row["client_name"];
		$appointment['start']=$row["start_time"];
		$appointment['phone']=$row["phone"];
		$appointment['end']=$row["end_time"];
		$appointment['agenda']=$row["agenda"];
		$appointment['referral']=$row["referral"];
		$appointment['className']="event-green";

		array_push($response['appointment'], $appointment);
	}

echo json_encode($response['appointment']);
	

?>