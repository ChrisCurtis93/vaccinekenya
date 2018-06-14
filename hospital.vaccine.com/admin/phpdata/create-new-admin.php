<?php

include('../../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['name'])||
isset($_GET['password'])||
	isset($_GET['email'])||
	isset($_GET['phone'])||
	isset($_GET['branch'])||
	isset($_GET['category'])
	
	){

//saving the data to local variables
$name=$_GET['name'];
$email=$_GET['email'];
$phone=$_GET['phone'];
$branch=$_GET['branch'];
$category=$_GET['category'];

$str=$_GET['password'];
$password=md5(sha1($str));


//writing the sql query command

$queryCommand="INSERT INTO `pb_app_users`( `names`, `email`, `mobile`, `address`, `nationalid`, `department`, `password`, `state`, `gender`) 
VALUES ('$name','$email','$phone','$branch','000000','Administrator','$password','1','M')";

//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$response['success']=1;
	
	$response['message']="Administrator added successfully";

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

$response['message']="missing some information";

echo json_encode($response);

}

?>


