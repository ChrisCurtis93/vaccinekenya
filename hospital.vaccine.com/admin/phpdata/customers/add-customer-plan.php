<?php

require_once('../../data/db.php');
global $db;
session_start();

//checking if the value exists or not 
if(
	isset($_REQUEST['company'])&&
	isset($_REQUEST['policy_no'])&&
	isset($_REQUEST['customer_id'])&&
	isset($_REQUEST['premium_paid'])&&
	isset($_REQUEST['sum_insured'])&&
	isset($_REQUEST['premium_freq'])&&
	isset($_REQUEST['policy_term'])&&
	isset($_REQUEST['policy_start'])&&
	isset($_REQUEST['plan'])){                                                                       

//saving the data to local variables

$company=$_REQUEST['company'];
$plan=$_REQUEST['plan'];

$policy_no=$_REQUEST['policy_no'];

$premium_paid=$_REQUEST['premium_paid'];
$sum_insured=$_REQUEST['sum_insured'];
$premium_freq=$_REQUEST['premium_freq'];

$policy_term=$_REQUEST['policy_term'];
$policy_start=$_REQUEST['policy_start'];

$customer_id=$_REQUEST['customer_id'];



	$selected_plan=array();
	$selected_plan['customer_id'] = $customer_id;
	$selected_plan['insurance_id'] = $company;
	$selected_plan['plan_id'] = $plan;
	$selected_plan['start_date'] = $policy_start;
	$selected_plan['policy_term'] = $policy_term;
	$selected_plan['active_status'] = '1';

	$db->AutoExecute('tb_selected_plan',$selected_plan, 'INSERT');

	$selected_plan_id=$db->GetOne("SELECT tb_selected_plan.selected_plan_id FROM tb_selected_plan WHERE customer_id='$customer_id' ORDER BY tb_selected_plan.selected_plan_id DESC LIMIT 1");

	$insurance_data=array();
	$insurance_data['selected_plan_id'] = $selected_plan_id;
	$insurance_data['premium_paid'] = $premium_paid;
	$insurance_data['sum_insured'] = $sum_insured;
	$insurance_data['frequency_id'] = $premium_freq;
	$insurance_data['policy_no'] = $policy_no;

	$db->AutoExecute('tb_premiums',$insurance_data, 'INSERT');

		$json = json_encode(array(
	  'success' => '1',
	  'message' => 'Plan added successfully'));

		echo $json;

}else{

		$json = json_encode(array(
	  'success' => '0',
	  'message' => 'Failed, Customer Record was not Inserted, Some data is missing'
	));
	echo $json;
}


?>


