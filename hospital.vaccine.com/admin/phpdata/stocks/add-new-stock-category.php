<?php

include('../../../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['branch_name'])||
isset($_GET['cat_name']))
{


$stock_cat_branch=$_GET['branch_name'];
$stock_cat_name=$_GET['cat_name'];




//writing the sql query command

$queryCommand="INSERT INTO `stock_category`(`stock_category_name`, `branch_id`, `active_status`) VALUES ('$stock_cat_name','$stock_cat_branch',1)";



//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$response['success']=1;
	
	$response['message']="Stock category added successfully";

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

$response['message']="branch id or stock name not found";

echo json_encode($response);

}

?>
