<?php

include('../../dbconfig.php');


//checking if the value exists or not 
if(isset($_GET['menu_sub_id'])){

//saving the data to local variables
$menu_sub_id=$_GET['menu_sub_id'];



//writing the sql query command

$queryCommand="DELETE FROM `menu_category_submenu` WHERE main_menu_sub_id='$menu_sub_id'";



//query execution

$query_execute=mysqli_query($open_database_stream, $queryCommand);

if(!empty($query_execute)){

	$response['success']=1;
	
	$response['message']="sub menu deleted successfully";

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


