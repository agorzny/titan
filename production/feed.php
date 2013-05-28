<?php
	session_start();
	include('php/titan.php');



?>

<!DOCTYPE html PUB LIC"-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Project "Titan" - CT Innovations</title>

	
	
	<link href="css/titan.css" type="text/css" rel="stylesheet"/>
	
	<script src="js/jquery-1.8.3.min.js"></script>
	
	
	<!-- JS file for Modal -->
	<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
	<script src="js/jquery.flexbox.min.js"></script>
	<script src="js/contact_chooser.js"></script>
	<script src="js/createmessage.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery.flexbox.css"/>
	


	


</head>




        
   
<body  style='padding: 0; margin: 0; font-family: arial' onload="startUp()">
	
	
	<table width='100%' height='100%' style='margin:0; padding: 0; background: #e30808' cellpadding='0' cellspacing='0' border='0'>
		
		<!-- Header -->
		<tr><td align='center' valign='center' height='60px' >
			
				<? include('ct_header.php'); ?>
			
		</td></tr>
		
		
	<!-- Content -->
		<tr><td valign='top' align='center' >
	
			<table width='800px' height='100%'  border='0' cellpadding='0' cellspacing='0'>
				
				<tr>
					<!-- Left Side (content) -->
					<td valign='top' align='right'>
						
						<table width='96%' height='100%' class='areaInset'>
							<tr><Td align='center' valign='top'>
								
						
								
								<table width='98%' cellpadding='10px' cellspacing='0'><tr><Td align='left' valign='bottom' style='color: #6d6d6d;border-bottom: 1px dashed #6d6d6d'>Your Feed<br /><span style='font-size:10'></td></tr></table>
								<br />
								
								
								
								
					
								
								
								
								</td></tr>
						</table>			
						
					</td>
					
					<!-- Right Side -->
					<td width='120px' valign='top' align='center'>
						<? include('ct_notificationBar.php');?>
						
						
					</td>
				</tr>
				
			</table>


		<?// include('ct_menuModal.php'); ?>
		<? //include('ct_replyModal.php'); ?>
			
			
			</td></tr>
	</table>
</body>
</html>
