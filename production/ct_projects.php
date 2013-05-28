<?php
	session_start();
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

	<? include('php/titan.php'); ?>

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
	
	
	<table class='mainOverallTable' ='100%' height='100%' cellpadding='0' cellspacing='0' border='0'>
		
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
								
								
								<?
								
								//Load feed by calling functions
								//echo $_SESSION['userId'];
								$projectList = getAssignedProjects($_SESSION['userId']);
								//echo $returnList;
								//global $returnListFiles;
							
								
								
							
								?>
								
								<table width='98%' cellpadding='10px' cellspacing='0'><tr><Td align='left' valign='bottom' style='color: #6d6d6d;border-bottom: 1px dashed #6d6d6d'>Projects</td></tr></table>
								<br />
								<?
								
								
								
								foreach($projectList as $key => $project)
							   {
							    $nameRes = getEmployee($project['Assignor']);
							    //echo $nameRes;
							    $uName = mysql_result($nameRes,0,"firstName")." ".mysql_result($nameRes,0,"lastName");
							      
							      ?>
										      <table width='98%' border='0' cellpadding='8px' cellspacing='0' style='background: #202020'><tr><td align='center' valign='center'>
													
													<table width='99%' height='98%' class='modalInset' cellpadding="0" cellspacing='0'>
														<tr><td rowspan='2' <?= $readInd; ?>>&nbsp</td><td>
												
												
												
																	<table width='98%' border='0' cellpadding='0px' cellspacing='0'>
																		<tr><td rowspan='2' <?= $readInd; ?>>&nbsp</td><td width='60px' height='60' rowspan='2' align='center' valign='center' style='font-size: 60px'>!</td><td align='left' valign='center' style='font-size: 24px; color: #6d6d6d'><?= $project['Name']?><br /><span style='font-size: 10px'>Started on <?=$project['Start']?> by <?= $uName ?> </span></td></tr>
																		<tr><td align='left' valign='center' style='font-size: 11; color: #6d6d6d' colspan='2'><?= $project['Description']?></td></tr>	
																		<tr><Td style='font-size: 11; color: #6d6d6d' colspan='3' height='40px' valign='bottom'>Assigned Tasks</td></tr>
																	
																	
																			<tr><Td style='font-size: 18; color: #6d6d6d; border-bottom: 1px solid #6d6d6d' colspan='4' height='40px' valign='center'>Code INBOX Functions (Due in 22 Hours <Select><option>Assigned</option><option>In Progress</option><option>Completed</option></select></td></tr>
																			<tr><Td style='font-size: 18; color: #6d6d6d; border-bottom: 1px solid #6d6d6d' colspan='4' height='40px' valign='center'>Complete CSS - Main Page (Due in 31.5 Hours)  <Select><option>Assigned</option><option selected='selected'>In Progress</option><option>Completed</option></select></td></tr>
																			<?
																			//Loop through related tasks
																			//$reTasks = getTasksInProject($project['Id']);
																			$r=0;
																			echo getTasksInProject($project['Id']);
																			//$numR = mysql_num_rows(getTasksInProject($project['Id']));
																			while($r < $numR)
							   											{
							   												?>
							   														<tr><Td style='font-size: 11; color: #6d6d6d' colspan='4' height='40px' valign='bottom'>Task : <?= mysql_result($reTasks,$r,"task") ?></td></tr>
							   												<?
							   												$r++;
							   											}
																			?>
																	<tr><Td style='font-size: 11; color: #6d6d6d; border-bottom: 1px solid #6d6d6d' colspan='4' height='20px' valign='center'>View tasks assigned to your coworkers</td></tr>
																	</table>
																	
														</td></tr></table>
														
													</td></tr>
												</table>
							      <br /><Br />
							      <?
							      	
							        // echo $project['Name'];
							   }
							   
							   ?>
									
									
									<table width='98%' border='0' cellpadding='8px' cellspacing='0'>
										<tr><Td style='border-bottom: 1px solid #efefef'>&nbsp</td></tr>
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
