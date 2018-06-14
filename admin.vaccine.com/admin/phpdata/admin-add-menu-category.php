<?php

include('../../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['menuCatName'])&&isset($_GET['cat_branch'])){

//saving the data to local variables
$menuCatName=$_GET['menuCatName'];
$cat_branch=$_GET['cat_branch'];



//writing the sql query command

$queryCommand="INSERT INTO `menu_category`(`menu_category_name`,`menu_cat_status`,`branch_id`) VALUES ('$menuCatName','1','$cat_branch')";



//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$response['success']=1;
	
	$response['message']="menu category added successfully";

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

$response['message']="menu category or branchId not found";

echo json_encode($response);

}

?>

