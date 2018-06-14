<?php

require_once('../../data/db.php');
@session_start();
global $db;
$user_id=$_SESSION['user']['userid'];

$response=array();

$plans=$db->GetArray('SELECT * FROM `tb_insurance_plans`');


$usomibora_count=$db->GetOne("SELECT COUNT(selected_plan_id) FROM tb_selected_plan INNER JOIN tb_customers ON tb_selected_plan.customer_id=tb_customers.user_id WHERE
tb_selected_plan.plan_id>=5 AND tb_selected_plan.plan_id <=12  AND tb_selected_plan.active_status=1 AND tb_customers.customer_to='$user_id' AND tb_customers.active_status=1");

$aen=$db->GetOne("SELECT COUNT(selected_plan_id) FROM tb_selected_plan INNER JOIN tb_customers ON tb_selected_plan.customer_id=tb_customers.user_id WHERE
tb_selected_plan.plan_id>=3 AND tb_selected_plan.plan_id <=4  AND tb_selected_plan.active_status=1 AND tb_customers.customer_to='$user_id' AND tb_customers.active_status=1");

$wlw=$db->GetOne("SELECT COUNT(selected_plan_id) FROM tb_selected_plan INNER JOIN tb_customers ON tb_selected_plan.customer_id=tb_customers.user_id WHERE
tb_selected_plan.plan_id>=16 AND tb_selected_plan.plan_id <=18  AND tb_selected_plan.active_status=1 AND tb_customers.customer_to='$user_id' AND tb_customers.active_status=1");

$eaw=$db->GetOne("SELECT COUNT(selected_plan_id) FROM tb_selected_plan INNER JOIN tb_customers ON tb_selected_plan.customer_id=tb_customers.user_id WHERE
tb_selected_plan.plan_id>=13 AND tb_selected_plan.plan_id <=15 AND tb_selected_plan.active_status=1 AND tb_customers.customer_to='$user_id' AND tb_customers.active_status=1");

$others=$db->GetArray('SELECT * FROM `tb_insurance_plans` WHERE plan_id=1 OR plan_id=2 OR plan_id=15 OR plan_id>=20');

		$freq=array();
		

	//	array_push($response, $freq);

foreach ($others as $row) {

	

	$id=$row['plan_id'];

	$count=$db->GetOne("SELECT COUNT(selected_plan_id) FROM tb_selected_plan INNER JOIN tb_customers ON tb_selected_plan.customer_id=tb_customers.user_id WHERE tb_selected_plan.plan_id='$id' AND tb_selected_plan.active_status=1 AND tb_customers.customer_to='$user_id' AND tb_customers.active_status=1");


	
		$freq['plan_type']=$row['plan_name'];
		$freq['total']=$count;
	

	

	array_push($response,$freq);
}

		$freq['plan_type']='USOMIBORA';
		$freq['total']=$usomibora_count;
		array_push($response,$freq);
		$freq['plan_type']='AEN';
		$freq['total']=$aen;
		array_push($response,$freq);
		$freq['plan_type']='WLW';
		$freq['total']=$wlw;
		array_push($response,$freq);
		$freq['plan_type']='EAW';
		$freq['total']=$eaw;
		array_push($response,$freq);

echo json_encode($response);


?>