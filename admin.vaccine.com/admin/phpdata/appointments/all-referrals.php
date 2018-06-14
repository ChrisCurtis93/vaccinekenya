<?php

require_once('../../data/db.php');

$results = $db->GetArray("SELECT * FROM `tb_job_category`");

$response['jobs']=array();

	foreach($results as $row){

		$jobs=array();

		$jobs['id']=$row["job_category_id"];
		$jobs['name']=$row["job_name"];
		

		array_push($response['jobs'], $jobs);
	}

	echo json_encode($response);
?>