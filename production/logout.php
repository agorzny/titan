<?php
session_start();


$past = time() - 100;
//this makes the time in the past to destroy the cookie
setcookie(ID_titan, gone, $past);


//$HowToCon = "normal"; //normal TO START DB CONNECTION, special FOR ALREADY OPEN
//$INusername = $u_name; //global username variable from userInfo.php is $u_name
//$INaction = "Logged Out";
//include('dbtrack.php');

		$_SESSION['userId'] = "";
		$_SESSIONS=array();
		session_destroy();
		

$url = "index.php";
header("Location: ".$url);
?>