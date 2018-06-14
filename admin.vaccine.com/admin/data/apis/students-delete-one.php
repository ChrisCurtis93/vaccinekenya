<?php
include("./db.php");
require_once("./class.php");
$response["resultvalue"] = array();
if (isset($_REQUEST['regnumber'])){	
    $regnumber = $_REQUEST['regnumber'];
	
	$record = new Adodb_Active_Record('sims_students', array('regnumber') );
	$record->Load("regnumber='$regnumber'");
	$record->Delete();

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
    