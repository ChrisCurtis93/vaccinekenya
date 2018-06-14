<?php

include('./dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['email'])||
	isset($_GET['name'])||
	isset($_GET['phone'])||
	isset($_GET['branchId'])||
	isset($_GET['user_category_id'])){

//saving the data to local variables
$email=$_GET['email'];
$name=$_GET['name'];
$phone=$_GET['phone'];
$branchId=$_GET['branchId'];
$user_category_id=$_GET['user_category_id'];


//writing the sql query command

$queryCommand="INSERT INTO `users`(`name`, `email`, `phone`,`branchId`,`user_category_id`) VALUES ('$name','$email','$phone','$branchId','$user_category_id')";



//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$response['success']=1;
	
	$response['message']="item added successfully";

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

$response['message']="menu item not found";

echo json_encode($response);

}

?>


