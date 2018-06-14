<?php

include('../../../dbconfig.php');
require_once('../../data/db.php');
global $db;


//checking if the value exists or not 
if(isset($_GET['stock_to_update'])||isset($_GET['stock_item_id']))
{

//saving the data to local variables
$stock_to_update=$_GET['stock_to_update'];
$stock_item_id=$_GET['stock_item_id'];
date_default_timezone_set('Africa/Nairobi');

$date_time=date('Y-m-d-H-m-s');


//writing the sql query command

$queryCommand="UPDATE `stock_items_update` SET`opening_stock`=`opening_stock`+'$stock_to_update',`time_of_update`='$date_time' WHERE stock_item_id='$stock_item_id'";


//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

$query_command_NEW="INSERT INTO `stock_item_movement`( `stock_item_id`, `movement_quantity`, `movement_type`, `time_of_movement`)
 VALUES ('$stock_item_id','$stock_to_update','NEW','$date_time')";
 
 $query_execute_new=mysqli_query($open_database_stream, $query_command_NEW);
 
 if(!empty($query_execute_new)){
 
 	$update_record_id=$db->GetOne("SELECT stock_record.stock_record_id FROM stock_record WHERE stock_item_id='$stock_item_id' ORDER BY stock_record_id DESC LIMIT 1");
 	
 	$query_command_update_record="UPDATE `stock_record` SET `added_stock`=`added_stock`+'$stock_to_update' WHERE stock_record_id='$update_record_id'";
 	
 	$query_execute_update_record=mysqli_query($open_database_stream, $query_command_update_record);
 	
 	if(!empty($query_execute_update_record)){
 		$response['success']=1;
	
		$response['message']="Item Updated successfully";

		echo json_encode($response);
 	}else{
 	
 		$response['success']=0;
		$response['message']="error in executing query stock record";

		echo json_encode($response);
 	}
 	
 }

	
}else{
	$response['success']=0;
	$response['message']="error in executing query";

	echo json_encode($response);
}


}
//the values do not exist
else{
//getting the responses from the server 
$response['success']=0;

$response['message']="variants not found";

echo json_encode($response);

}

?>