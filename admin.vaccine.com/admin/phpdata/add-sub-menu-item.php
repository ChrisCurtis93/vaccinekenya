<?php

include('../../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['sub_item_name'])||isset($_GET['sub_cat_id'])
){

//saving the data to local variables
$sub_item_name=$_GET['sub_item_name'];
$sub_cat_id=$_GET['sub_cat_id'];



//writing the sql query command

$queryCommand="INSERT INTO `sub_menu_category`(`sub_menu_category_name`, `menu_category_submenu_id`)
 VALUES ('$sub_item_name','$sub_cat_id')";



//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$response['success']=1;
	
	$response['message']="sub menu item added successfully";

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

$response['message']="sub menu item not found";

echo json_encode($response);

}

?>


