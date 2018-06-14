<?php

require_once('../../data/db.php');
global $db;
session_start();

//checking if the value exists or not 
if(isset($_REQUEST['name'])&&
	isset($_REQUEST['email'])&&
	isset($_REQUEST['phone'])&&
	isset($_REQUEST['id'])&&
	isset($_REQUEST['kra_pin'])&&
	isset($_REQUEST['policy_no'])&&
	isset($_REQUEST['dob'])&&
	isset($_REQUEST['next_of_kin'])&&
	isset($_REQUEST['next_of_kin_id'])&&
	isset($_REQUEST['next_of_kin_phone'])&&
	isset($_REQUEST['company'])&&
	isset($_REQUEST['agent_id'])&&
	isset($_REQUEST['gender'])&&
	isset($_REQUEST['job_cat'])&&
	isset($_REQUEST['policy_start'])&&
	isset($_REQUEST['term_of_policy'])&&
	isset($_REQUEST['premium_paid'])&&
	isset($_REQUEST['sum_insured'])&&
	isset($_REQUEST['premium_freq'])&&
	isset($_REQUEST['plan'])){

//saving the data to local variables
$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$phone=$_REQUEST['phone'];
$kra_pin=$_REQUEST['kra_pin'];
$id=$_REQUEST['id'];
$dob=$_REQUEST['dob'];
$next_of_kin=$_REQUEST['next_of_kin'];
$next_of_kin_id=$_REQUEST['next_of_kin_id'];
$next_of_kin_phone=$_REQUEST['next_of_kin_phone'];
$company=$_REQUEST['company'];
$plan=$_REQUEST['plan'];

$premium_paid=$_REQUEST['premium_paid'];
$sum_insured=$_REQUEST['sum_insured'];
$premium_freq=$_REQUEST['premium_freq'];

$gender=$_REQUEST['gender'];
$policy_start=$_REQUEST['policy_start'];
$term_of_policy=$_REQUEST['term_of_policy'];
$job_cat=$_REQUEST['job_cat'];

$policy_no=$_REQUEST['policy_no'];

$agent_id=$_SESSION['user']['userid'];

$data = array();
	$data['username'] = $name;
	$data['email'] = $email;
	$data['phone_number'] = $phone;
	$data['KRA_PIN'] = $kra_pin;
	$data['national_id'] = $id;
	$data['DOB'] = $dob;
	$data['next_of_kin'] = $next_of_kin;
	$data['next_of_kin_rln'] = $next_of_kin_id;
	$data['next_of_kin_phone'] = $next_of_kin_phone;
	$data['customer_to'] = $agent_id;
	$data['active_status'] = '1';
	
	$db->AutoExecute('tb_customers',$data, 'INSERT');


	$customer_id=$db->GetOne("SELECT tb_customers.user_id FROM tb_customers WHERE customer_to='$agent_id' ORDER BY tb_customers.user_id DESC LIMIT 1");

	$selected_plan=array();
	$selected_plan['customer_id'] = $customer_id;
	$selected_plan['insurance_id'] = $company;
	$selected_plan['plan_id'] = $plan;
	$selected_plan['start_date'] = $policy_start;
	$selected_plan['policy_term'] = $term_of_policy;
	$selected_plan['active_status'] = '1';

	$db->AutoExecute('tb_selected_plan',$selected_plan, 'INSERT');

	$more_details=array();
	$more_details['customer_id']=$customer_id;
	$more_details['gender']=$gender;
	$more_details['job_cat']=$job_cat;

	$db->AutoExecute('tb_more_customer_details',$more_details, 'INSERT');

	$selected_plan_id=$db->GetOne("SELECT tb_selected_plan.selected_plan_id FROM tb_selected_plan WHERE customer_id='$customer_id' ORDER BY tb_selected_plan.selected_plan_id DESC LIMIT 1");

	$insurance_data=array();
	$insurance_data['selected_plan_id'] = $selected_plan_id;
	$insurance_data['premium_paid'] = $premium_paid;
	$insurance_data['sum_insured'] = $sum_insured;
	$insurance_data['frequency_id'] = $premium_freq;
	$insurance_data['policy_no'] = $policy_no;

	$db->AutoExecute(' tb_premiums',$insurance_data, 'INSERT');

		$json = json_encode(array(
	  'success' => '1',
	  'message' => 'Customer added successfully'));

		echo $json;

}else{

		$json = json_encode(array(
	  'success' => '0',
	  'message' => 'Failed, Customer Record was not Inserted, Some data is missing'
	));
	echo $json;
}


?>


