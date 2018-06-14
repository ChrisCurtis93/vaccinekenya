<?php

include('../../../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['branch_name']))
	
{

//saving the data to local variables
$branch_name=$_GET['branch_name'];




$queryCommand="INSERT INTO `branch`(`branch_name`,`active_status`) VALUES ('$branch_name',1)";

//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$response['success']=1;
	
	$response['message']="Branch added successfully";

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
