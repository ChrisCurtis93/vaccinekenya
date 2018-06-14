<?php

require_once('../../data/db.php');
@session_start();
global $db;
$user_id=$_SESSION['user']['userid'];

$response=array();

$job=$db->GetArray('SELECT * FROM `tb_job_category`');

foreach ($job as $row) {

	$freq=array();

	$id=$row['job_category_id'];

	$count=$db->GetOne("SELECT COUNT(job_cat) FROM `tb_more_customer_details` INNER JOIN tb_customers ON tb_customers.user_id=tb_more_customer_details.customer_id WHERE tb_customers.active_status=1 AND tb_customers.customer_to='$user_id' AND tb_more_customer_details.job_cat='$id'");

	$freq['job_name']=$row['job_name'];
	$freq['total']=$count;

	array_push($response,$freq);
}

echo json_encode($response);


?>