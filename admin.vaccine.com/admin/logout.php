<?php 
require_once("./data/class.php"); 
session_start();
//Logs::register_log($_SESSION['user']['userid'], 'Logout');
session_destroy();
header("Location: log");