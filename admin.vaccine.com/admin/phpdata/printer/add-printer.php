<?php

include('../../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['printer_name'])||
	isset($_GET['printer_mac'])||
	isset($_GET['branchId'])||
	isset($_GET['station']))
{

//saving the data to local variables
$printer_name=$_GET['printer_name'];
$printer_mac=$_GET['printer_mac'];
$branchId=$_GET['branchId'];
$station=$_GET['station'];

//writing the sql query command

$queryCommand="INSERT INTO `printer_details`(`printer_name`, `printer_MAC`, `user_category`, `branch_id`, `printer_details_state`) VALUES ('$printer_name','$printer_mac','$station','$branchId','1');";



//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$response['success']=1;
	
	$response['message']="Printer added successfully";

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

$response['message']="measurement name not found";

echo json_encode($response);

}

?>


