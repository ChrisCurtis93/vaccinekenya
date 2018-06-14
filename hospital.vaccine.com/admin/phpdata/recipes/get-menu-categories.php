<?php

include('../../../dbconfig.php');

if(isset($_GET['recipe_branch'])){

$response=array();

$count=0;

$count_stock=0;
$recipe_branch=$_GET['recipe_branch'];

$queryCommand="SELECT * FROM `menu_category` WHERE branch_id='$recipe_branch' AND menu_category.menu_cat_status=1";


$queryCommand_stock="SELECT stock_items.stock_item_id,stock_items.stock_item_name FROM stock_items INNER JOIN  stock_category ON stock_category.stock_category_id=stock_items.stock_category_id WHERE stock_category.branch_id='$recipe_branch'";


$queryExecute=mysqli_query($open_database_stream,$queryCommand);
$queryExecute_stock=mysqli_query($open_database_stream,$queryCommand_stock);


if(!empty($queryExecute)){
			
		$response['menu_category']=array();

		

		while ($row=mysqli_fetch_array($queryExecute)) {
			
			$menu_category=array();

			$menu_category['menu_category_id']=$row['menu_category_id'];
			$menu_category['menu_category_name']=$row['menu_category_name'];
		
				

			array_push($response['menu_category'], $menu_category);

			$count++;
		}
		
		if(!empty($queryExecute_stock)){
		
			if(mysqli_num_rows($queryExecute_stock)>0){
				$response['stock_items']=array();

		

					while ($row=mysqli_fetch_array($queryExecute_stock)) {
			
					$stock_items=array();

					$stock_items['stock_item_id']=$row['stock_item_id'];
					$stock_items['stock_item_name']=$row['stock_item_name'];
		
					$count_stock++;

					array_push($response['stock_items'], $stock_items);
					
					}
			$response['success_stock']=1;
			$response['stock_message']=$count_stock;
			}else{
				$response['success_stock']=0;
				$response['stock_message']="recipe items currently unavailable";
			}
		
			
			
				
		}else{
			$response['success_stock']=0;
			$response['stock_message']="error in query execution stocks";
		}
		$response['success']=1;
		$response['message']=$count." menus categories retrieved";

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
	$response['message']="no branch found";

	echo json_encode($response);
}
?>