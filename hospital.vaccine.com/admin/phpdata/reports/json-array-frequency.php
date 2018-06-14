<?php

require_once('../../data/db.php');
@session_start();
global $db;
$user_id=$_SESSION['user']['userid'];

$response=array();

$frequencies=$db->GetArray('SELECT * FROM `tb_premium_frequency`');

foreach ($frequencies as $row) {

	$freq=array();

	$id=$row['premium_frequency_id'];

	$count=$db->GetOne("SELECT count(premium_id) FROM `tb_premiums` INNER JOIN tb_selected_plan ON tb_selected_plan.selected_plan_id=tb_premiums.selected_plan_id INNER JOIN tb_customers ON tb_customers.user_id=tb_selected_plan.customer_id WHERE tb_selected_plan.active_status=1 AND tb_premiums.frequency_id='$id' AND tb_customers.customer_to='$user_id'");

	$freq['frequency_type']=$row['frequecny_type'];
	$freq['total']=$count;

	array_push($response,$freq);
}

echo json_encode($response);


?>