<?php

include('../../../dbconfig.php');
require_once('../../data/db.php');
global $db;

date_default_timezone_set('Africa/Nairobi');

$date_time=date('Y-m-d-H-m-s');

//checking if the value exists or not 
if(isset($_GET['branch_stock'])||
isset($_GET['stock_item_name'])||
isset($_GET['unit_price'])||
isset($_GET['quantity'])||
isset($_GET['unit_measure']))
{

//saving the data to local variables
$branch_stock=$_GET['branch_stock'];
$stock_item_name=$_GET['stock_item_name'];
$unit_price=$_GET['unit_price'];
$quantity=$_GET['quantity'];
$unit_measure=$_GET['unit_measure'];



//writing the sql query command

$queryCommand="INSERT INTO `stock_items`( `stock_item_name`,`unit_price`,`stock_category_id`, `measurement_id`, `date_of_entry`)
 VALUES ('$stock_item_name','$unit_price','$branch_stock','$unit_measure','$date_time')";




//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$get_stock_id=$db->GetOne("SELECT stock_item_id FROM `stock_items` ORDER BY stock_item_id DESC LIMIT 1");
	
	$query_command_update="INSERT INTO `stock_items_update`(`stock_item_id`, `opening_stock`, `time_of_update`) VALUES ('$get_stock_id','$quantity','$date_time')";

	$query_execute_update=mysqli_query($open_database_stream, $query_command_update);
	
	if(!empty($query_execute_update)){
		$query_update_record="INSERT INTO `stock_record`(`stock_item_id`, `opening_stock`,`time_of_opening`) VALUES ('$get_stock_id','$quantity','$date_time')";

		$query_execute_update_record=mysqli_query($open_database_stream, $query_update_record);
		
		if(!empty($query_execute_update_record)){
			$response['success']=1;
	
		$response['message']="Stock item added successfully";

	echo json_encode($response);
		}else{
			$response['success']=0;
	
	$response['message']="error in query execution for stock record";

	echo json_encode($response);
		}
		
		
	}else{
		
	$response['success']=0;
	
	$response['message']="error in query execution for stock update";

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

$response['message']="measurement name not found";

echo json_encode($response);

}

?>