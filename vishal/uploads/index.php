<?php
	session_start();
	
	if($_GET['setid'])
	{
			$_SESSION['userId'] = $_GET['setid'];
	}else
	{
			$_SESSION['userId'] = 1;
	}

	
	
	
?>

<!DOCTYPE html PUB LIC"-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Project "Titan" - CT Innovations</title>

	
	
	<link href="css/StyleSheet_Employee_CT.css" type="text/css" rel="stylesheet"/>

		<link href="css/Stylesheet.css" type="text/css" rel="stylesheet"/>	
	
	<script src="js/jquery-1.8.3.min.js"></script>
	
	
	<!-- JS file for Modal -->
	<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>

	<? include('titan.php'); ?>

	<script>
		$(function() {
    			$('a[rel*=leanModal]').leanModal({ top : 200, closeButton: ".modal_close" });
				$('button[rel*=leanModal]').leanModal({ top : 200, closeButton: ".modal_close" });
			});
			
			
		function startUp() {
			onLoadProject();
		}
		
	</script>


</head>



        
        <!--
            
            <div id="header_img">
						
							<table height='160px' width='100%' border='0'>
									<tr><td width='50px'>&nbsp</td><td valign='center' align='center' width='60px'><img src='img/Logo_white.png' class='logo'/></td><td style='font-size:11; color: white'>Project<br /><span style='font-size: 48px; color: white'>TITAN</span</td></tr>
							</table>

	
            </div>
            
            <div  class="feed_box">
            	<br /><br /><br />
							<table width='100%' height='100px' border='0'>
								<tr><td valign='center' align='center'><Table width='120px' height='40px'><tr><Td><img src='img/Logo_white.png'  height='20px' width='20px'/></td><td valign='center' align='center'><img src='img/Logo_white.png'  height='20px' width='20px'/></td><td valign='center' align='center'><img src='img/Logo_white.png'  height='20px' width='20px'/></td><td valign='center' align='center'><img src='img/Logo_white.png'  height='20px' width='20px'/></td></tr></table></td></tr>
								<tr><Td colspan='4' style='font-size:12px; color:#bcbcbc' align='center' valign='center'><i>Your feed is loading ...</i></td></tr>
							</table>
            	
            	</div>
            
         	<div class="msg_bar">
         
		         <table width='100%' height='100%' >
		         		<tr><Td class='msg_bar_td' align='center' valign='center'><a href='#' class='ct_menu'>7</a><br /><span class='msg_bar_values'>Unread<br />Messages</span></td></tr>
		         	<tr><Td class='msg_bar_td' align='center' valign='center'><a href='#'  class='ct_menu'>3</a><br /><span class='msg_bar_values'>Tasks</span></td></tr>
		         	<tr><Td class='msg_bar_td' align='center' valign='center'><a href='#'  class='ct_menu'>2</a><br /><span class='msg_bar_values'>Projects</span></td></tr>
		        </table>		
         		
         		<table class=''msg_bar_options'>
         		<tr><td align='center' valign='center' style="font-size: 50px; color: white"'><a id="Add" rel="leanModal" name="createModal" href="#createModal">+</a></td></tr>
         		</table>
         		
         </div>    
             
            <div clss="login">
    
            </div> 
                    
                    -->
		
        
   
<body  style='padding: 0; margin: 0; font-family: arial' onload="startUp()">
	
	
	<table width='100%' height='100%' style='margin:0; padding: 0; background: #e30808' cellpadding='0' cellspacing='0' border='0'>
		
		<!-- Header -->
		<tr><td align='center' valign='center' height='30px' >
			
					<? include('ct_header.php'); ?>
			
		</td></tr>
		
		
	<!-- Content -->
		<tr><td valign='top' align='center' >
	
			<table width='800px' height='100%'  border='0' cellpadding='0' cellspacing='0'>
				
				<tr>
					<!-- Left Side (content) -->
					<td valign='top' align='right'>
						
						
						<table width='96%' height='100%' class='modalInset'>
							<tr><Td align='center' valign='top'>
						
								
								<!-- Content goes here - Feed -->
								<br />
								

								<table width='98%' >
									<tr><Td style='color: #6d6d6d;border-bottom: 1px dashed #6d6d6d'>Feed</td></tr>
								</table>
								
								<br /><br /><br />
								<table>
									<tr><Td><div class='ct_sq_bullet'></div></td><Td><div class='ct_sq_bullet'></div></td><Td><div class='ct_sq_bullet'></div></td><Td><div class='ct_sq_bullet'></div></td></tr>
									<tr><Td style='color: #cfcfcf; font-size:12' colspan='4'><i >Your feed is loading ...</i></td></tr>
								</table>
							
								
								
								
								
								</td></tr>
						</table>			
						
					</td>
					
					<!-- Right Side -->
					<td width='200px' valign='top' align='center'>
						<?include('ct_notificationBar.php');?>
						
						
					</td>
				</tr>
				
			</table>


			<? include('ct_menuModal.php'); ?>
			
			
			</td></tr>
	</table>
</body>
</html>
