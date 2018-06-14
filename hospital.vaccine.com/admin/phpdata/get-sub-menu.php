<?php

include('../../dbconfig.php');

if(isset($_GET['menu_category_id'])){

$response=array();

$count=0;

$menu_category_id=$_GET['menu_category_id'];

$queryCommand="SELECT *  FROM `menu_category_submenu` WHERE menu_category_id='$menu_category_id'";

$queryExecute=mysqli_query($open_database_stream,$queryCommand);

if(!empty($queryExecute)){
				//start 
						$response['sub_menu']=array();

		//creating json objects for the rows

		while ($row=mysqli_fetch_array($queryExecute)) {
			
			$sub_menu=array();

			$sub_menu['main_menu_sub_id']=$row['main_menu_sub_id'];
			$sub_menu['main_menu_sub_name']=$row['main_menu_sub_name'];
		
				

			array_push($response['sub_menu'], $sub_menu);

			$count++;
		}
		$response['success']=1;
	$response['message']=$count." menus items retrieved";

	echo json_encode($response);

				//end
		}
else{
	$response['success']=0;
	$response['message']="Error in executing query";

	echo json_encode($response);
}
}
else{
	$response['success']=0;
	$response['message']="no sub menu item found";

	echo json_encode($response);
}
?>