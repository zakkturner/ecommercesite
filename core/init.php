<?php 
ob_start();
$db = mysqli_connect('localhost', 'root', '', 'faye');

if (mysqli_connect_error()) {
	echo "Database connection failed with following errors" . mysqli_connect_error();
	die();

}
require_once $_SERVER['DOCUMENT_ROOT']."/newecom/config.php";
require_once BASEURL. 'helpers/helpers.php';


?>