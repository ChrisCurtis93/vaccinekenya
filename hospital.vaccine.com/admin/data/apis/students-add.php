<?php
include("db.php");
require_once("class.php");
$response["resultvalue"] = array();
if (isset($_REQUEST['s_surname'])
	&& isset($_REQUEST['s_othernames'])
	&& isset($_REQUEST['s_gender'])
	&& isset($_REQUEST['s_location'])
	&& isset($_REQUEST['s_county'])
	&& isset($_REQUEST['s_dob'])
	&& isset($_REQUEST['s_fschoolname'])
	&& isset($_REQUEST['s_fschoollocation'])
	&& isset($_REQUEST['s_fqualification'])
	
	&& isset($_REQUEST['s_pfullnames'])
	&& isset($_REQUEST['s_pnationalid'])
	&& isset($_REQUEST['s_prelationship'])
	&& isset($_REQUEST['s_mobile'])
	&& isset($_REQUEST['s_email'])
	
	&& isset($_REQUEST['s_sclasscode'])
	&& isset($_REQUEST['s_shousecode'])
	&& isset($_REQUEST['s_sprogramme'])){
		
	$s_surname = $_REQUEST['s_surname'];
	$s_othernames = $_REQUEST['s_othernames'];
	$s_gender = $_REQUEST['s_gender'];
	$s_location = $_REQUEST['s_location'];
	$s_county = $_REQUEST['s_county'];
	$s_dob = $_REQUEST['s_dob'];
	$s_fschoolname = $_REQUEST['s_fschoolname'];
	$s_fschoollocation = $_REQUEST['s_fschoollocation'];
	$s_fqualification = $_REQUEST['s_fqualification'];
	
	$s_pfullnames = $_REQUEST['s_pfullnames'];
	$s_pnationalid = $_REQUEST['s_pnationalid'];
	$s_prelationship = $_REQUEST['s_prelationship'];
	$s_mobile = $_REQUEST['s_mobile'];
	$s_email = $_REQUEST['s_email'];
	
	$s_sclasscode = $_REQUEST['s_sclasscode'];
	$s_shousecode = $_REQUEST['s_shousecode'];
	$s_sprogramme = $_REQUEST['s_sprogramme'];
	
	$data = array();
	$data['names'] = $s_pfullnames;
	$data['nationalid'] = $s_pnationalid;
	$data['mobile'] = $s_mobile;
	$data['email'] = $s_email;
	$data['photo'] = 'default.png';
	$db->AutoExecute('sims_guardians',$data, 'INSERT');
	
	
	$data = array();
	$s_students_count = $db->GetOne("select count(*) from sims_students");
	$s_regnumber = (($db->GetOne("select (concat('ZAL', '-', '$s_students_count' , '/', (select extract(year from curdate()))));")) + 1);
	//$data['regnumber'] = $s_regnumber;
	$data['names'] = $s_surname . " " . $s_othernames;
	$data['gender'] = $s_gender;
	$data['dob'] = $db->GetOne("select now();");
	$data['doe'] = $db->GetOne("select now();");
	$data['classcode'] = $s_sclasscode;
	$data['entrylevel'] = $s_sclasscode;
	$data['gaurdianid'] = $s_pnationalid;
	$data['photo'] = 'default.png';
	$data['dol'] = '';
	$data['reason'] = '';
	$data['status'] = 'active';
	$data['boarding'] = $s_sprogramme;
	$data['formerschool_name'] = $s_fschoolname;
	$data['formerschool_location'] = $s_fschoollocation;
	$data['formerschool_qualification'] = $s_fqualification;
	
	$db->AutoExecute('sims_students',$data, 'INSERT');
	
	$json = json_encode(array(
	  'success' => '1',
	  'message' => 'Student Record Inserted'
	));
	echo $json;
}else {
	$json = json_encode(array(
	  'success' => '0',
	  'message' => 'Failed, Student Record was not Inserted, Some data is missing'
	));
	echo $json;
}
?>
    