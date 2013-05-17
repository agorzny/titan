<?php
	session_start();
include('titan.php');
include('insert_modules.php');
	$msgSendRes = "";
if(isset($_POST['submit'])){
	
	//If form/reply was submitted, send reply
	//$res = addMessage($_SESSION['userId'],'2013-05-AG', );
	$sendToArray = array( $_POST['replyRecip']);
	
	$res = createMessage($_SESSION['userId'], '2013-05-AG', $_POST['replyMsg'], $sendToArray);

	if(!$res)
	{
		$msgSendRes = "Message Sent!";
	}else
	{
		$msgSendRes = "The message was not sent.";
	}
	
	
	
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
	<script src="js/jquery.flexbox.min.js"></script>
	<script src="js/contact_chooser.js"></script>
	<script src="js/createmessage.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery.flexbox.css"/>
	


	

	<script>
		var setReplyId = 0;
		/*
		function loadReplyModel(id)
		{
			alert(id);
			leanModal({ top : 200, closeButton: ".modal_close" });
			//$(function() {
	    			//$('a[rel*=leanModal]').leanModal({ top : 200, closeButton: ".modal_close" });
					//$('button[rel*=leanModal]').leanModal({ top : 200, closeButton: ".modal_close" });
				//});
				
				//set id to reply to
				setReplyId = id;
				
		}
			*/
			
		function startUp() {
			onLoadProject();
		}
		
		function reply(id){
			
			$('#reply-'+id).toggle('fast');
			
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
								
								
								<?
								
								//Load feed by calling functions
								//echo $_SESSION['userId'];
								getAllMessagesSentTo($_SESSION['userId'], "", 0, "");
								//echo $returnList;
								global $returnList;
								$howMany = count($returnList);
								
								?>
								
								<table width='98%' cellpadding='10px' cellspacing='0'><tr><Td align='left' valign='bottom' style='color: #6d6d6d;border-bottom: 1px dashed #6d6d6d'>Inbox<br /><span style='font-size:10'><? echo "You have ".count($returnList)." message(s)<br />"; ?></span><br /><? echo $msgSendRes; $msgSendRes="";?></td></tr></table>
								<br />
								<?
								
								
								
								$g=0;
								while($g < $howMany)
								{
									if($returnList[$g][3] == 0)
									{
										$readInd = "style='background:#f10404' width='2px'; font-size:9px";
									}else{
										$readInd = "style='background:' width='2px'; font-size:9px";
									}
									
									?>
									<table width='98%' border='0' cellpadding='8px' cellspacing='0' style='background: #202020'><tr><td align='center' valign='center'>
										
										<table width='99%' height='98%' class='modalInset' cellpadding="0" cellspacing='0' border='0'>
											<tr><td rowspan='2' <?= $readInd; ?>>&nbsp</td><td>
													<table width='100%' height='100%' cellpadding='4px' cellspacing='0' border='0'>
														<tr><td width='40px' height='40px' rowspan='4' valign='top' align='center'><img src='<?= $returnList[$g][5]; ?> ' border='0' height='40px' width='40px'/></td><td align='left' valign='top' style='font-size: 34px; color: #6d6d6d'><? echo $returnList[$g][0]; ?><br /><?= $readFlag;?></td></tr>
														<tr><td align='left' valign='center' style='font-size: 11; color: #6d6d6d'><? echo $returnList[$g][1]; ?></td></tr>	
														<tr><td align='right' valign='center' style='font-size: 11; color: #6d6d6d'><a  href="javascript: reply(<?= $returnList[$g][6];?>);" title='Reply to this message'>Reply</a></td></tr>	
													<tr ><td align='right' valign='center'><div id='reply-<?= $returnList[$g][6];?>' style='display: none; '>
														<form action="<?php echo $PHP_SELF;?>" method="post">
															<input type='hidden' name='replyRecip' value='<?= $returnList[$g][7];?>' />
															
														<textarea placeholder='Your reply' class='textarea' cols='50' name='replyMsg'></textarea><br /><input type='submit' value='Send' name='submit' />
														
													</form>
														</div></td></tr>
													
													</table>
												</td></tr>
										</table>
										
								</td></tr>
									</table>
									
									<table width='98%' border='0' cellpadding='8px' cellspacing='0'>
										<tr><Td style='border-bottom: 1px solid #efefef'>&nbsp</td></tr>
									</table>
									
									<?
									
									
									$g++;
								}
								
								?>
								
								
								
					
								
								
								
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
		<? //include('ct_replyModal.php'); ?>
			
			
			</td></tr>
	</table>
</body>
</html>
