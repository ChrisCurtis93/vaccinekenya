<?php

require_once('../../data/db.php');
@session_start();
global $db;
$user_id=$_SESSION['user']['userid'];


	$results = $db->GetArray("SELECT * FROM tb_events WHERE event_for='0'");

	$response['events']=array();

	foreach($results as $row){

		$events=array();

		$events['events_id']=$row["tb_events_id"];
		$events['title']=$row["title"];
		$events['start']=$row["start"];
		$events['className']=$row["className"];

		array_push($response['events'], $events);
	}

echo json_encode($response['events']);
	

?>