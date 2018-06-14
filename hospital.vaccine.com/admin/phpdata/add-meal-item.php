<?php

include('../../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['menu_item_name'])||
	isset($_GET['sub_menu_item_id'])||
	isset($_GET['menu_category_id'])||
	isset($_GET['main_menu_sub_id'])||
	isset($_GET['price'])||
	isset($_GET['item_description'])||
	isset($_GET['branch_id'])
){

//saving the data to local variables
$menu_item_name=$_GET['menu_item_name'];
$menu_category_id=$_GET['menu_category_id'];
$sub_menu_item_id=$_GET['sub_menu_item_id'];
$main_menu_sub_id=$_GET['main_menu_sub_id'];
$price=$_GET['price'];
$item_description=$_GET['item_description'];
$branch_id=$_GET['branch_id'];


//writing the sql query command

$queryCommand="INSERT INTO `menu_items`(`menu_item_name`, `sub_menu_item_id`, `main_menu_sub_id`, `price`, `item_description`, `branch_id`,`menu_category_id`)
 VALUES ('$menu_item_name','$sub_menu_item_id','$main_menu_sub_id','$price','$item_description','$branch_id','$menu_category_id')";



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

