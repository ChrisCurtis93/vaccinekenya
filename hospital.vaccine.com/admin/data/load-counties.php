<?php
include("db.php");

global $db;
$response_data=file_get_contents("php://input");

$obj=json_decode($response_data);

$data=array();
$data=$obj->{'data'};

foreach ($data as $item) {
	$data=array();
	$data["county_name"]=$item->name;
	 
	$db->AutoExecute('tb_counties',$data, 'INSERT');
}

	$db_data=$db->GetArray("SELECT * FROM tb_counties");

	echo json_encode($db_data);

?>