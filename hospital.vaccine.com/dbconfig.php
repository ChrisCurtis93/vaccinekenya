<?php 

$server = 'localhost';
$user_name='nlsbanki_nagalas';
$password = 'nagalaske254';
$database_name='nlsbanki_nagalaske';

$open_database_stream=mysqli_connect($server, $user_name,$password) or die(mysql_error());

$dbconnect=mysqli_select_db($open_database_stream, $database_name);

if(!$dbconnect){
	echo "".$database_name." was not found";
}


?>