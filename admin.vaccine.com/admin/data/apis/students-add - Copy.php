<?php
include("db.php");
require_once("class.php");
$response["resultvalue"] = array();
if (isset($_REQUEST['names']) 
	|| isset($_REQUEST['nationalid']) 
	|| isset($_REQUEST['dob']) 
	|| isset($_REQUEST['mobile'])
	|| isset($_REQUEST['email'])
	|| isset($_REQUEST['passcode'])
	|| isset($_REQUEST['department'])
	|| isset($_REQUEST['sector'])
	|| isset($_REQUEST['gender'])
	|| isset($_REQUEST['address'])
	|| isset($_REQUEST['photo'])){
		
    $names = $_REQUEST['names'];
	$nationalid = $_REQUEST['nationalid'];
	$dob = $_REQUEST['dob'];
	$mobile = $_REQUEST['mobile'];
	$email = $_REQUEST['email'];
	$passcode = $_REQUEST['passcode'];
	$department = User::get_departmentname($_REQUEST['department']);
	$sector = $_REQUEST['sector'];
	$gender = $_REQUEST['gender'];
	$address = $_REQUEST['address'];
	$photo = $_REQUEST['photo'];
		
	$data = array();
	$data['names'] =  $names;
	$data['nationalid'] =  $nationalid;
	$data['dob'] =  $dob;
	$data['mobile'] =  $mobile;
	$data['address'] =  $address;
	$data['email'] =  $email;
	$data['password'] =  md5(sha1($passcode));
	$data['department'] =  $department;
	$data['sector'] =  $sector;
	$data['gender'] =  $gender;
	$data['address'] =  $address;
	$data['photo'] =  $photo;
	$db->AutoExecute('mtp_app_users',$data, 'INSERT');
	
	
	SMS::sendSMS($mobile, 'Dear ' .  $names . ', Welcome to MTP3 Portal. Your username is ' . $email . ', Password is ' . $passcode);
	Mailer::send_mail($email, $names, "New MTP3 Intranet Account", "Welcome to MTP3 Portal. Your username is " . $email . " Password is " . $passcode . ". <br/> Click on the link below to login to the portal. <a href='http://www.mtp3.go.ke/portal/log'> MTP3 Intranet App </a>");
	
	
	$myresults = array();
	$myresults["success"] = 1;
	$myresults["message"] = 1;
	array_push($response["resultvalue"], $myresults);
	
	echo json_enCode($response);
}else {
	$myresults = array();
	$myresults["success"] = 0;
	$myresults["message"] = "Error!!! You cannot do that!! Some data is needed";
	array_push($response["resultvalue"], $myresults);
    echo json_enCode($response);
}
?>
    