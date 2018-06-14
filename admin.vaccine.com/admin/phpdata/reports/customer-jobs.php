<?php

require_once('../../data/db.php');
require_once('../../modules/customers/class.php');
@session_start();
global $db;
$user_id=$_SESSION['user']['userid'];

$response['job_details']=array();

$results=$db->GetArray("SELECT * FROM `tb_job_category`");

foreach ($results as $row) {
	$job_details=array();

	$id=$row["job_category_id"];
	$get_job_total=$db->GetOne("SELECT count(tb_more_customer_details.job_cat) as total from tb_more_customer_details INNER JOIN tb_customers ON tb_customers.user_id=tb_more_customer_details.customer_id WHERE tb_customers.customer_to='$user_id' AND tb_customers.active_status='1' AND tb_more_customer_details.job_cat='$id'");

	$job_details['job_category']=$row['job_name'];
	$job_details['total_customers']=$get_job_total;

	array_push($response['job_details'],$job_details);

}

echo json_encode($response);
	

?>