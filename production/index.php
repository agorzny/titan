<?php
session_start();



if (isset($_POST['submit'])) { // if form has been submitted


	include('php/dbsettings.php');


// makes sure they filled it in

	if(!$_POST['username'] | !$_POST['username']) {
		die(header("Location: index.php"));
	}


	$check = mysql_query("SELECT * FROM employees WHERE username = '".$_POST['username']."'")or die(mysql_error());

//Gives error if user dosen't exist

$check2 = mysql_num_rows($check);
if ($check2 == 0) {

		$_SESSION['loginerr'] = "<table cellspacing='0' cellpadding='2' width='600px'><tr><td align='left'  class='' style='color:#f14040; font-size:12'>Sorry, but it looks like you entered the wrong username</td></tr></table>";
		header("Location: index.php");
				}


while($info = mysql_fetch_array( $check )) 	
{

//gives error if the password is wrong

	if ($_POST['username'] != $info['username']) {

		$_SESSION['loginerr'] = "<table cellspacing='0' cellpadding='2' width='600px'><tr><td align='left' class='' style='color:#f14040; font-size:12'>Sorry, but it looks like you entered the wrong username</td></tr></table>";
		header("Location: index.php");
	}



else
{
// if login is ok then we add a cookie 
	
$_POST['username'] = stripslashes($_POST['username']);
	

//$hour = time() + 60*60*2;
setcookie(ID_titan, $_POST['username'], time()+60*60*60*60*24);

//Set Global/Session variables to use throughout the site during the session
$_SESSION['userId'] = $info['id'];
$_SESSION['fullName'] = $info['firstName']." ".$info['lastName'];
$_SESSION['email'] = $info['email'];

//After setting everything up, if everything is valid, send to main feed.
header("Location:feed.php");
				



}

}

} else {	

// if they are not logged in
?>

<!DOCTYPE html PUB LIC"-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Link</title>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>


<link href="css/titan.css" type="text/css" rel="stylesheet"/>

<script>
	
	$( document ).ready(function() {
    $( "#innerLogin" ).fadeIn( 850 );
    $( "#innerLoginText" ).fadeIn( 1000 );
    
});
	
	</script>



</head>




<body  style='padding: 0; margin: 0; font-family: arial'>


	<table width='100%' height='100%' cellpadding='0' cellspacing='0' border='0' class='mainTableLogin'>


	<!-- Content -->
		<tr><td valign='center' align='center' >

			<table class='tableLogin' cellpadding='10px' cellspacing='0px'>

				<tr>
					<!-- Left Side (content) -->
					<td valign='center' align='center'>
			
													<?
															$lerr = $_SESSION['loginerr'];
															if($lerr != '0')
														{
															
															echo "<b>".$lerr."</b>";
															$_SESSION['loginerr'] = "";
													
															
														}
													
													?> 
													
													
					<form method='post' action='<? echo  $PHP_SHELF; ?>'	>
						<table width='600px' height='96%' class='tableLoginInner' id='innerLogin'>
							<tr><td width='80%' style='font-size:50px; color: white; font-family: arial'>Enter PIN</td><td align='center' valign='center'><input type='password' name='username' style='font-size:38; color: black' size='3' maxlength='8' placeholder='PIN'/></td><td align='center' valign='center'><input type='submit' name='submit' value='Login' class='loginButton'/></td></tr>

							
							<tr><td colspan='3' class='textRegularWhite'><div id='innerLoginText' style='display: none'>Welcome to Link. Communicate with co-workers, set and view tasks and more. To login, use your PIN number assigned by your manager or Human Resource representative.</div></tD></tr>
						</table>
					</form>
			
			
				</td>
				</tr>

			</table>





			</td></tr>
	</table>

</body>
</html>

<?php
}


?>
