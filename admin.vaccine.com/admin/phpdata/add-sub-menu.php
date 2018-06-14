<?php

include('../../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['sub_menu_name'])||isset($_GET['menu_name_id'])
){

//saving the data to local variables
$sub_menu_name=$_GET['sub_menu_name'];
$menu_name_id=$_GET['menu_name_id'];



//writing the sql query command

$queryCommand="INSERT INTO `menu_category_submenu`(`main_menu_sub_name`, `menu_category_id`) VALUES ('$sub_menu_name','$menu_name_id')";



//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$response['success']=1;
	
	$response['message']="sub menu added successfully";

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


