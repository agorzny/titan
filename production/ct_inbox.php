<?php
	session_start();
	include('php/titan.php');

	$msgSendRes = "";
if(isset($_POST['submit'])){
	
	//If form/reply was submitted, send reply
	//$res = addMessage($_SESSION['userId'],'2013-05-AG', );
	//$sendToArray = array( $_POST['assgn_contacts']);

	
	$res = createMessage($_SESSION['userId'], '2013-05-AG', $_POST['message'], $_POST['data'], '');

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

	
	
	<link href="css/titan.css" type="text/css" rel="stylesheet"/>

	
	<script src="js/jquery-1.8.3.min.js"></script>
	
	
	<!-- JS file for Modal -->
	<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
	<script src="js/FlexBox/js/jquery.flexbox.min.js"></script>
	<script src="js/contact_chooser.js"></script>
	<script src="js/createmessage.js"></script>
	<link rel="stylesheet" type="text/css" href="js/FlexBox/css/jquery.flexbox.css" />
	


	

	<script>
		var setReplyId = 0;

	$( document ).ready(function() {
    
    $("#composeButton").click(function() {
   			$( "#composeBox" ).toggle( 400 );
});
    
});
		function startUp() {
			//onLoadProject();
      loadContacts();
		}
		
	</script>


</head>




        
   
<body  style='padding: 0; margin: 0; font-family: arial' onload="startUp()">
	
	
	<table class='mainOverallTable' cellpadding='0' cellspacing='0' >
		
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
						
						<table width='100%' height='100%' class='areaInset'>
							<tr><Td align='center' valign='top'>
								
								
								<?
								
								//Load feed by calling functions
								//echo $_SESSION['userId'];
								getAllMessagesSentTo($_SESSION['userId'], "", 0, "");
								//echo $returnList;
								global $returnList;
								$howMany = count($returnList);
								
								?>
								
								<table width='100%' cellpadding='10px' cellspacing='0'><tr><Td align='left' valign='bottom' style='color: #6d6d6d;border-bottom: 1px dashed #b7b7b7; font-size: 22px'>Inbox<br /><span style='font-size:12'><? echo "You have ".count($returnList)." message(s)<br />"; ?></span></td>
									<td style='border-bottom: 1px dashed #b7b7b7' align='right' valign='bottom'>
										
										<a id='composeButton' href='#' class='linkButton' >Compose Message</a>
												
												
												
								</td></tr></table>
								<? include('ct_createMessage.php'); ?>
								<br />
								<?
								
								
								
								$g=0;
								while($g < $howMany)
								{
									if($returnList[$g][3] == 0)
									{
										$readInd = "<table class='readIndicatorUnread'><tr><Td>D</td></tr></table>";
										
									}else{
										$readInd = "<table class='readIndicator'><tr><Td>R</td></tr></table>";
									}
									
									?>
									<table cellpadding='2px' cellspacing='0' class='messageContainer'><tr><td align='center' valign='center'>
													<table width='100%' height='100%' cellpadding='4px' cellspacing='0' border='0'>
														<tr><td width='40px' height='40px' rowspan='4' valign='center' align='center'><img src='<?= $returnList[$g][5]; ?> ' border='0' height='40px' width='40px'/></td><td align='left' valign='center' >
															
															
															<table cellpadding='0' cellspacing='4px' border='0' height='100%' width='100%'><tr>
															<td valign='center' align='left' class='messageLine'><a href='ct_convo.php?id=<?= $returnList[$g][9];?>&org=<?= $returnList[$g][8];?>' class='inboxItem'><? echo $returnList[$g][0]; ?></a></td>
															<td style='font-size: 10; color: #b7b7b7' align='right' width='70px'><?= date("M d", $returnList[$g][10]);?></td>
															<td align='center' valign='center' width='30px'><?= $readInd;?></td>
															</tr>
														<tr><td colspan='4' style='color: #6d6d6d; font-size:12px'><? echo $returnList[$g][1]; ?></td></tr>
															<table>
															
															
															
															</td></tr>
														</table>
														
														<!--<tr><td align='right' valign='center' style='font-size: 11; color: #6d6d6d'><a  href="javascript: reply(<?= $returnList[$g][6];?>);" title='Reply to this message'>Reply</a></td></tr>	
													<tr ><td align='right' valign='center'><div id='reply-<?= $returnList[$g][6];?>' style='display: none; '>
														<form action="<?php echo $PHP_SELF;?>" method="post">
															<input type='hidden' name='replyRecip' value='<?= $returnList[$g][7];?>' />
															
														<textarea placeholder='Your reply' class='textarea' cols='50' name='replyMsg'></textarea><br /><input type='submit' value='Send' name='submit' />
														
													</form>
														</div></td></tr> -->
										</table>
										
								</td></tr>
									</table>
									
				
									
									<?
									
									
									$g++;
								}
								
								?>
								
								
								
					
								
								
								
								</td></tr>
						</table>			
						
					</td>
					
					<!-- Right Side -->
					<td width='120px' valign='top' align='center'>
						<? include('ct_notificationBarV2.php');?>
						
						
					</td>
				</tr>
				
			</table>


		<?// include('ct_menuModal.php'); ?>

			
			
			</td></tr>
	</table>
</body>
</html>
