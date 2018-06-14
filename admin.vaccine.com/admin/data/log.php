<?php
include("./db.php");
$response["resultvalue"] = array();
if (isset($_GET['email']) || isset($_GET['password'])){
    $email = $_GET['email'];
	$password = $_GET['password'];
	$row = $db->GetRow("select * from tb_users_admins where email = '$email' and password = '". md5(sha1($password)) . "'");
	if($row){
		if($row ["active_status"] == '1'){
			$myresults = array();
			$myresults["UserID"] = $row ["user_id"];
			$myresults["success"] = 1;
			$myresults["message"] = $row ["user_id"];
			
	
			array_push($response["resultvalue"], $myresults);
		}else{
			$myresults = array();
			$myresults["success"] = 0;
			$myresults["message"] = 'Account is not Active, Contact Admin';
			array_push($response["resultvalue"], $myresults);
		}
	}else{
		$myresults = array();
		$myresults["success"] = 0;
		$myresults["message"] = 'Alien!!!, Contact Admin';
		array_push($response["resultvalue"], $myresults);
	}
	echo json_enCode($response);
}else {
	$myresults = array();
	$myresults["success"] = 0;
	$myresults["message"] = "Error!!! You cannot do that!! Some data is needed";
	array_push($response["resultvalue"], $myresults);
    echo json_enCode($response);
}
?>
    