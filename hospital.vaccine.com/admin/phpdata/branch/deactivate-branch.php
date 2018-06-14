<?php

include('../../../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['branch_id'])){

//saving the data to local variables
$branch_id=$_GET['branch_id'];



//writing the sql query command

$queryCommand="UPDATE `branch` SET `active_status`=0 WHERE branch_id='$branch_id'";



//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$response['success']=1;
	
	$response['message']="Branch deactivated successfully";

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

$response['message']="branch Id not found";

echo json_encode($response);

}

?>

