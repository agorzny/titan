<?php

	//Set credentials

	$db_username = "thevoidc_cti";
	$db_password = "cti2013";
	$db_database = "thevoidc_titan";





	//Connection



	$dbh=mysql_connect ('localhost',$db_username,

	$db_password) or die('Cannot connect to the database because: ' . mysql_error());

	mysql_select_db($db_database) or die( "Cannot Connect");

?>