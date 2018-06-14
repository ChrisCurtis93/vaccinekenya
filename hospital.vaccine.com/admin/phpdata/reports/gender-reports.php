<?php

require_once('../../data/db.php');
require_once('../../modules/customers/class.php');
@session_start();
global $db;
$user_id=$_SESSION['user']['userid'];

$response=array();

	$total_male=$db->GetOne("SELECT count(tb_more_customer_details.more_details_id) as total from tb_more_customer_details INNER JOIN tb_customers ON tb_customers.user_id=tb_more_customer_details.customer_id WHERE tb_customers.customer_to='$user_id' AND tb_more_customer_details.gender='1' AND tb_customers.active_status='1'");
	
	$response['gender']=array();
	$gender=array();

	$gender['gender']='male';
	$gender['total']=$total_male;

	array_push($response['gender'], $gender);


	$total_female=$db->GetOne("SELECT count(tb_more_customer_details.more_details_id) as total from tb_more_customer_details INNER JOIN tb_customers ON tb_customers.user_id=tb_more_customer_details.customer_id WHERE tb_customers.customer_to='$user_id' AND tb_more_customer_details.gender='2' AND tb_customers.active_status='1'");
	
//	$response['gender']=array();
//	$gender=array();

	$gender['gender']='female';
	$gender['total']=$total_female;

	array_push($response['gender'], $gender);

echo json_encode($response);
	

?>