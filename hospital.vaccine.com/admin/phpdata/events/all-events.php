<?php

require_once('../../data/db.php');
require_once('../../modules/customers/class.php');
@session_start();
global $db;
$user_id=$_SESSION['user']['userid'];


	$results = $db->GetArray("SELECT * FROM tb_events WHERE event_for='$user_id'");

	$response['events']=array();

	foreach($results as $row){

		$events=array();

		$events['events_id']=$row["tb_events_id"];
		$events['title']=$row["title"];
		$events['start']=$row["start"];
		$events['className']=$row["className"];

		array_push($response['events'], $events);
	}
$birthdays=$db->GetArray("SELECT * FROM `tb_customers` where customer_to='$user_id' AND active_status='1'");

foreach($birthdays as $row){

		$events=array();

		$birthday_date=date('m-d',strtotime($row['DOB']));
		$today=date('Y-m-d');

		$this_year=date('Y',strtotime($today));
		$other_year=date('Y',strtotime($row['DOB']));

		$new_date=$this_year.'-'.$birthday_date;

		$year_diff=$this_year-$other_year;

		$username=$row['username'];

		$title=$username." has a birthday on this day. Turning ".$year_diff." years old.";


		$events['events_id']=$row["user_id"];

		$events['title']=$title;
		$events['username']=$row['username'];
		$events['selected_date']=date_create($new_date)->format('d-F-Y');
		$events['start']=$new_date;
		$events['className']="event-azure";

		array_push($response['events'], $events);
	}


	$policy_end_dates = $db->GetArray("SELECT tb_customers.user_id,tb_customers.username,tb_customers.email,tb_insurance_plans.plan_name,tb_premium_frequency.frequecny_type,tb_premiums.premium_paid,tb_premiums.sum_insured,tb_selected_plan.start_date,tb_selected_plan.selected_plan_id,tb_selected_plan.policy_term  FROM tb_customers INNER JOIN tb_selected_plan ON tb_customers.user_id=tb_selected_plan.customer_id INNER JOIN tb_insurance_plans ON tb_insurance_plans.plan_id=tb_selected_plan.plan_id INNER JOIN tb_premiums ON tb_premiums.selected_plan_id=tb_selected_plan.selected_plan_id INNER JOIN tb_premium_frequency ON tb_premium_frequency.premium_frequency_id=tb_premiums.frequency_id WHERE tb_customers.customer_to='$user_id' AND tb_customers.active_status='1'");

	foreach($policy_end_dates as $row){

		$events=array();

		$policy_id=$row['policy_term'];
		$policy_terms=$db->GetOne("SELECT term from tb_policy_term WHERE
		policy_term_id='$policy_id'");

		$dater=date_create($row["start_date"]);
		$end_date= $dater->modify('+'.$policy_terms.' year')->format('Y-m-d');

	//	$warning_date= $end_date->modify('-14 day')->format('Y-m-d');
		//echo $end_date;

		$title=$row["username"].'`s '.$row['plan_name'].' policy plan matures on this day';
		$events['username']=$row['username'];
		$events['events_id']=$row["user_id"];
		$events['title']=$title;
		$events['start']=$end_date;
		$events['selected_date']=date_create($end_date)->format('d-F-Y');
		$events['className']="event-red";

		array_push($response['events'], $events);
	}

	$warning_end_date = $db->GetArray("SELECT tb_customers.user_id,tb_customers.username,tb_customers.email,tb_insurance_plans.plan_name,tb_premium_frequency.frequecny_type,tb_premiums.premium_paid,tb_premiums.sum_insured,tb_selected_plan.start_date,tb_selected_plan.selected_plan_id,tb_selected_plan.policy_term  FROM tb_customers INNER JOIN tb_selected_plan ON tb_customers.user_id=tb_selected_plan.customer_id INNER JOIN tb_insurance_plans ON tb_insurance_plans.plan_id=tb_selected_plan.plan_id INNER JOIN tb_premiums ON tb_premiums.selected_plan_id=tb_selected_plan.selected_plan_id INNER JOIN tb_premium_frequency ON tb_premium_frequency.premium_frequency_id=tb_premiums.frequency_id WHERE tb_customers.customer_to='$user_id' AND tb_customers.active_status='1'");

	foreach($warning_end_date as $row){

		$events=array();

		$policy_id=$row['policy_term'];
		$policy_terms=$db->GetOne("SELECT term from tb_policy_term WHERE
		policy_term_id='$policy_id'");

		$dater=date_create($row["start_date"]);
		$end_date= $dater->modify('+'.$policy_terms.' year')->format('Y-m-d');

		$warning_date= date_create($end_date)->modify('-14 day')->format('Y-m-d');
		//echo $end_date;

		$title=$row["username"].'`s '.$row['plan_name'].' policy plan matures on '.
		date_create($end_date)->format('d-F-Y').' which is in 2 weeks time.';

		$events['events_id']=$row["user_id"];
		$events['title']=$title;
		$events['username']=$row['username'];
		$events['start']=$warning_date;
		$events['selected_date']=date_create($warning_date)->format('d-F-Y');
		$events['className']="event-orange";

		array_push($response['events'], $events);
	}



echo json_encode($response['events']);
	

?>