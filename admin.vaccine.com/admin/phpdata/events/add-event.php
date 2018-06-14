<?php

require_once('../../data/db.php');
global $db;
session_start();

//checking if the value exists or not 
if(
	isset($_REQUEST['event_title'])&&
	isset($_REQUEST['end'])&&
	isset($_REQUEST['date'])){                                                                       

//saving the data to local variables

$event_title=$_REQUEST['event_title'];
$date=$_REQUEST['date'];
$end=$_REQUEST['end'];
$user_id=$_SESSION['user']['userid'];

	$event=array();
	$event['title'] = $event_title;
	$event['start'] = $date;
	$event['end'] = $end;
	$event['className'] = "event-green";
	$event['event_for'] = $user_id;

	$db->AutoExecute('tb_events',$event, 'INSERT');

		$json = json_encode(array(
	  'success' => '1',
	  'message' => 'event added successfully'));

		echo $json;

}else{

		$json = json_encode(array(
	  'success' => '0',
	  'message' => 'Failed, event Record was not Inserted, Some data is missing'
	));
	echo $json;
}


?>


