<?php 

$server = 'localhost';
$user_name='root';
$password = '';
$database_name='nagalas';

$open_database_stream=mysqli_connect($server, $user_name,$password) or die(mysql_error());

$dbconnect=mysqli_select_db($open_database_stream, $database_name);

if(!$dbconnect){
	echo "".$database_name." was not found";
}


?>