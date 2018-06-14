<?php

include('../../../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['measure_name']))
{

//saving the data to local variables
$measure_name=$_GET['measure_name'];




//writing the sql query command

$queryCommand="INSERT INTO `stock_measurement`(`measurement name`) VALUES ('$measure_name')";



//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$response['success']=1;
	
	$response['message']="Measurement added successfully";

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


