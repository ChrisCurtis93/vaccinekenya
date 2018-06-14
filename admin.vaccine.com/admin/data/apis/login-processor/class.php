<?php

include("../db.php");

Class userProcessor{

	public static function login_processor($email,$password){
		global $db;

		$getUserInformation=$db->GetRow("SELECT * FROM tb_users_admins WHERE email='".$email."' AND password='".$password."' ORDER BY user_id LIMIT 1");
		if($getUserInformation){
			$myresults=array();
			$response["success"]=1;
			$response["user_id"]=$getUserInformation["user_id"];
			$response["message"]="login successful";
		}else{
			$response["success"]=0;
			$response["message"]="wrong email or password";
		}
		array_push($response["resultvalue"], $myresults);
		return json_decode($response);
	}

}
?>