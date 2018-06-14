<?php

include('./dbconfig.php');

if(isset($_GET['userId'])){



$response=array();

$userId=$_GET['userId'];


$queryCommand="SELECT users.userId,users.name,users.phone,users.email,branch.branch_id,branch.branch_name,user_category.user_type FROM users INNER JOIN branch ON users.branchId=branch.branch_id INNER JOIN user_category ON users.user_category_id=user_category.user_category_id";

$datacount=0;

$total=0;

$query_execute=mysqli_query($open_database_stream, $queryCommand); 

if(!empty($query_execute)){


			
	
		$response['user_data']=array();



		while ($row=mysqli_fetch_array($query_execute)) {
			
			$user_data=array();

			$user_data['userId']=$row['userId'];
			$user_data['name']=$row['name'];
			$user_data['phone']=$row['phone'];
			$user_data['email']=$row['email'];
			$user_data['branch_id']=$row['branch_id'];
			$user_data['branch_name']=$row['branch_name'];
			$user_data['user_type']=$row['user_type'];
			
			
			$datacount++;
			
		
			array_push($response['user_data'], $user_data);
		}

		$response['success']=1;
		$response['message']=" ".$datacount." records found";
		$response['total']=$total;

		echo json_encode($response);


	}
	

else{
	$response['success']=0;
	$response['message']="error in executing query";

	echo json_encode($response);
}


}


else{
		$response['success']=0;
	$response['message']="user id not found";

	echo json_encode($response);
}



?>
