<?php

require_once('../../data/db.php');
@session_start();
global $db;
$user_id=$_SESSION['user']['userid'];

$response=array();
$year=date("Y");

$color=array();
$color=["#FF0F00","#FF6600","#FF9E01","#FCD202","#F8FF01","#B0DE09","#04D215","#0D8ECF","#0D52D1","#2A0CD0","#8A0CCF","#CD0D74"];

$month=1;

while ($month<=12) {
	$data=array();
	
	$new_month='0'.$month.'-'.$year;
	if($month >9){
		
		$new_month=$month.'-'.$year;
	}

	$dater=date_create("01-".$new_month)->format("F");
	$total=$db->GetOne("SELECT COUNT(start_date) FROM `tb_selected_plan` INNER JOIN tb_customers ON tb_selected_plan.customer_id=tb_customers.user_id WHERE tb_customers.customer_to='$user_id' AND DATE_FORMAT(tb_selected_plan.start_date, '%m-%Y') = '$new_month' AND tb_selected_plan.active_status='1' AND tb_customers.active_status='1'");

	$month_name=date("m",strtotime($dater));

	$data["month"]=$dater;
	$data["total"]=$total;
	$data["color"]=$color[$month-1];

	array_push($response,$data);

	$month++;
}

	


echo json_encode($response);


?>