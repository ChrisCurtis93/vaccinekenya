<?php

include('../../../dbconfig.php');
require_once('../../data/db.php');
global $db;

//checking if the value exists or not 
if(isset($_GET['stock_to_return'])||isset($_GET['stock_item_id']))
{

//saving the data to local variables
$stock_to_return=$_GET['stock_to_return'];
$stock_item_id=$_GET['stock_item_id'];
date_default_timezone_set('Africa/Nairobi');

$date_time=date('Y-m-d-H-m-s');


//writing the sql query command

$queryCommand="INSERT INTO `stock_item_movement`(`stock_item_id`, `movement_quantity`, `movement_type`, `time_of_movement`) 
VALUES ('$stock_item_id','$stock_to_return','IN','$date_time')";


//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){


	$queryCommand_update_remaining="UPDATE `stock_items_update` SET`opening_stock`=`opening_stock`+'$stock_to_return',`time_of_update`='$date_time' WHERE stock_item_id='$stock_item_id'";
	
	$query_execute_remaining=mysqli_query($open_database_stream, $queryCommand_update_remaining);

	if(!empty($queryCommand_update_remaining)){
		$query_command_update_return_state="SELECT * FROM `stock_item_movement` WHERE stock_item_id='$stock_item_id' AND  movement_type='OUT' ORDER BY stock_item_movement_id DESC LIMIT 1";
		$query_exec_return_state=mysqli_query($open_database_stream, $query_command_update_return_state);

		if(!empty($query_exec_return_state)){
			
			$row=mysqli_fetch_array($query_exec_return_state);

			$stock_item_movement_id=$row['stock_item_movement_id'];

			$query_command_up="UPDATE `stock_item_movement` SET`return_state`='1' WHERE stock_item_movement_id='$stock_item_movement_id'";

			$query_exec_update_of_return=mysqli_query($open_database_stream, $query_command_up);

				if(!empty($query_exec_update_of_return)){
					$closing_stock=$db->GetOne("SELECT opening_stock FROM `stock_items_update` WHERE stock_item_id='$stock_item_id'");
					$update_record_id=$db->GetOne("SELECT stock_record_id FROM `stock_record` WHERE stock_item_id='$stock_item_id' ORDER BY stock_record_id DESC LIMIT 1");
					
					$query_update_record="UPDATE `stock_record` SET `closing_stock`='$closing_stock',`time_of_closing`='$date_time' WHERE stock_record_id ='$update_record_id'";
					$query_execute_update=mysqli_query($open_database_stream, $query_update_record);
					
					if(!empty($query_execute_update)){
							$response['success']=1;
							$response['message']="items moved successfully";

							echo json_encode($response);
					}else{
							$response['success']=0;
							$response['message']="error in executing query updating closed order update_id:".$update_record_id;

							echo json_encode($response);
					}
							
				}else{
							$response['success']=0;
							$response['message']="error in executing query updating selecting last out";

							echo json_encode($response);
	
	}

		}else{
		$response['success']=0;
	$response['message']="error in executing query remaining selecting last out";

	echo json_encode($response);
	
	}
	}else{
		$response['success']=0;
	$response['message']="error in executing query remaining update opening";

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