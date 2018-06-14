<?php

include('../../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['tableId'])){

//saving the data to local variables
$tableId=$_GET['tableId'];



//writing the sql query command

$queryCommand="DELETE FROM `tables` WHERE table_id='$tableId'";



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


