<?php

include('../../dbconfig.php');

if(isset($_GET['sub_item_item'])){

$response=array();

$count=0;

$sub_item_item=$_GET['sub_item_item'];

$queryCommand="SELECT * FROM `sub_menu_category` WHERE menu_category_submenu_id='$sub_item_item'";

$queryExecute=mysqli_query($open_database_stream,$queryCommand);

if(!empty($queryExecute)){
				//start 
						$response['sub_item']=array();

		//creating json objects for the rows

		while ($row=mysqli_fetch_array($queryExecute)) {
			
			$sub_item=array();

			$sub_item['sub_menu_category_id']=$row['sub_menu_category_id'];
			$sub_item['sub_menu_category_name']=$row['sub_menu_category_name'];
		
				

			array_push($response['sub_item'], $sub_item);

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