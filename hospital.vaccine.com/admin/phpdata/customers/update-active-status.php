<?php

include('../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['active'])&&isset($_GET['id'])){

//saving the data to local variables
$active=$_GET['active'];
$id=$_GET['id'];


//writing the sql query command

$queryCommand="UPDATE `tb_selected_plan` SET `active_status`='$active' WHERE selected_plan_id='$id'";



//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$response['success']=1;
	
	$response['message']="policy updated successfully";

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

$response['message']="missing info";

echo json_encode($response);

}

?>


