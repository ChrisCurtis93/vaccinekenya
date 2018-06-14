<?php

include('../../../dbconfig.php');

if(isset($_GET['menu_category'])||isset($_GET['recipe_branch'])){

$response=array();

$count=0;

$menu_category=$_GET['menu_category'];
$recipe_branch=$_GET['recipe_branch'];

$queryCommand="SELECT * FROM `menu_items` WHERE menu_category_id='$menu_category'";



$queryExecute=mysqli_query($open_database_stream,$queryCommand);

if(!empty($queryExecute)){
				//start 
						$response['menu_item']=array();

		//creating json objects for the rows

		while ($row=mysqli_fetch_array($queryExecute)) {
			
			$menu_item=array();

			$menu_item['menu_item_id']=$row['menu_item_id'];
			$menu_item['menu_item_name']=$row['menu_item_name'];
		
				

			array_push($response['menu_item'], $menu_item);

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
	$response['message']="no menu category or branch found";

	echo json_encode($response);
}
?>