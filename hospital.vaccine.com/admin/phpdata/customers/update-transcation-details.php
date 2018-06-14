<?php

require_once('../../data/db.php');
require_once('../dbconfig.php');
global $db;
session_start();

//checking if the value exists or not 
if(isset($_REQUEST['policy_start'])&&
	isset($_REQUEST['premium_paid'])&&
	isset($_REQUEST['sum_insured'])&&
	isset($_REQUEST['term_of_policy'])&&
	isset($_REQUEST['policy_no'])&&
	isset($_REQUEST['selected_plan_id'])
	){

//saving the data to local variables
$policy_start=$_REQUEST['policy_start'];
$premium_paid=$_REQUEST['premium_paid'];
$sum_insured=$_REQUEST['sum_insured'];
$selected_plan_id=$_REQUEST['selected_plan_id'];

$policy_no=$_REQUEST['policy_no'];
$term_of_policy=$_REQUEST['term_of_policy'];

	$query_command="UPDATE `tb_premiums` SET `premium_paid`='$premium_paid',`sum_insured`='$sum_insured',`policy_no`='$policy_no' WHERE selected_plan_id='$selected_plan_id'";;

	$query_execute=mysqli_query($open_database_stream,$query_command);

	if(!empty($query_execute)){

		 $query_command_more="UPDATE `tb_selected_plan` SET `start_date`='$policy_start',`policy_term`='$term_of_policy' WHERE  selected_plan_id='$selected_plan_id'";

		 $query_execute_more=mysqli_query($open_database_stream,$query_command_more);

		 if(!empty($query_execute_more)){

		 	$json = json_encode(array(
	  'success' => '1',
	  'message' => 'Plan Updated successfully'));

		echo $json;
		 }else{
		$json = json_encode(array(
	  'success' => '0',
	  'error' => mysqli_error($open_database_stream),
	  'message' => 'Failed, Plan Record was not Inserted, in query command more'
	));
	echo $json;

	}

		
		
	}else{
		$json = json_encode(array(
	  'success' => '0',
	  'error' => mysqli_error($open_database_stream),
	  'message' => 'Failed, Plan Record was not Inserted, in query command'
	));
	echo $json;

	}
	

}else{

		$json = json_encode(array(
	  'success' => '0',
	  'message' => 'Failed, Customer Record was not Inserted, Some data is missing'
	));
	echo $json;
}


?>


