<?php

include('../../../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['meal_item_id'])||isset($_GET['stock_item_id'])||isset($_GET['quantity'])
){

//saving the data to local variables
$meal_item_id=$_GET['meal_item_id'];
$stock_item_id=$_GET['stock_item_id'];
$quantity=$_GET['quantity'];



//writing the sql query command

$queryCommand="INSERT INTO `menu_recipe`(`stock_item_id`, `menu_item_id`, `quantity`, `menu_recipe_state`)
 VALUES ('$stock_item_id','$meal_item_id','$quantity','1')";



//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$response['success']=1;
	
	$response['message']="recipes added successfully";

	echo json_encode($response);
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

$response['message']=" items not found";

echo json_encode($response);

}

?>
