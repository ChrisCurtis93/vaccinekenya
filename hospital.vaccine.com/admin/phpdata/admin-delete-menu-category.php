<?php

include('../../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['menuCategoryId'])){

//saving the data to local variables
$menuCategoryId=$_GET['menuCategoryId'];



//writing the sql query command

$queryCommand="UPDATE `menu_category` SET `menu_cat_status`=0 WHERE `menu_category_id`='$menuCategoryId'";



//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$response['success']=1;
	
	$response['message']="menu category deleted successfully";

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

$response['message']="menu category not found";

echo json_encode($response);

}

?>


