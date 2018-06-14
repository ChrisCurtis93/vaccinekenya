<?php

require_once('../../data/db.php');
require_once('../../modules/customers/class.php');
@session_start();
global $db;
$user_id=$_SESSION['user']['userid'];

$response['plans']=array();

$results=$db->GetArray("SELECT * FROM `tb_insurance_plans`");

foreach ($results as $row) {
	$plan_details=array();

		

	$id=$row["plan_id"];
	$plan_total=$db->GetOne("SELECT count(tb_selected_plan.plan_id) as total from tb_selected_plan INNER JOIN tb_customers ON tb_customers.user_id=tb_selected_plan.customer_id WHERE tb_customers.customer_to='$user_id' AND tb_selected_plan.plan_id='$id' AND tb_customers.active_status='1'");

	$plan_details['plan_name']=$row['plan_name'];
	$plan_details['plan_total']=$plan_total;

	array_push($response['plans'],$plan_details);

}

echo json_encode($response);
	

?>