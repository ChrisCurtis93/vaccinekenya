<?php

include('../../../dbconfig.php');
require_once('../../data/db.php');
global $db;



//checking if the value exists or not 
if(isset($_GET['stock_to_move'])||isset($_GET['stock_item_id']))
{

//saving the data to local variables
$stock_to_move=$_GET['stock_to_move'];
$stock_item_id=$_GET['stock_item_id'];
date_default_timezone_set('Africa/Nairobi');

$date_time=date('Y-m-d-H-m-s');


//writing the sql query command

$queryCommand="INSERT INTO `stock_item_movement`(`stock_item_id`, `movement_quantity`, `movement_type`, `time_of_movement`) 
VALUES ('$stock_item_id','$stock_to_move','OUT','$date_time')";

$opening_stock=$db->GetOne("SELECT opening_stock FROM `stock_items_update` WHERE stock_item_id='$stock_item_id'");


//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$queryCommand_update_remaining="UPDATE `stock_items_update` SET`opening_stock`=`opening_stock`-'$stock_to_move',`time_of_update`='$date_time' WHERE stock_item_id='$stock_item_id'";
	
	$query_execute_remaining=mysqli_query($open_database_stream, $queryCommand_update_remaining);
	
	
	if(!empty($query_execute_remaining)){
	
		$query_command_record_opening="INSERT INTO `stock_record`(`stock_item_id`, `opening_stock`,`time_of_opening`) VALUES ('$stock_item_id','$opening_stock','$date_time')";
		
		$query_execute_record_opening=mysqli_query($open_database_stream, $query_command_record_opening);
		
		if(!empty($query_execute_record_opening)){
		
			$response['success']=1;
	
			$response['message']="Item Moved successfully";

			echo json_encode($response);
		}
		
		
	}else{
		$response['success']=0;
	$response['message']="error in executing query remaining";

	echo json_encode($response);
	
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