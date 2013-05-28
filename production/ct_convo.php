<?php
	session_start();
	include('php/titan.php');

	$msgSendRes = "";
if(isset($_POST['submit'])){
	
	//If form/reply was submitted, send reply
	//$res = addMessage($_SESSION['userId'],'2013-05-AG', );
	$sendToArray = array( $_POST['replyRecip']);
	$convo = $_POST['convo'];
	
	$res = createMessage($_SESSION['userId'], '2013-05-AG', $_POST['replyMsg'], $sendToArray, $convo);

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




        
   
<body  style='padding: 0; margin: 0; font-family: arial' onload="startUp()">
	
	
	<table class='mainOverallTable' cellpadding='0' cellspacing='0' border='0'>
		
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
								
								
								<?
								
								//Load feed by calling functions
								//echo $_SESSION['userId'];
								
								//echo $returnList;
								
								
								?>
								
								<table width='98%' cellpadding='10px' cellspacing='0'><tr><Td align='left' valign='bottom' style='color: #6d6d6d;border-bottom: 1px dashed #6d6d6d'>Conversation</td><td style='color: #6d6d6d;border-bottom: 1px dashed #6d6d6d' valign='bottom' align='right'><a id='' href='ct_inbox.php' class='linkButton' >Return to Inbox</a></td></tr></table>
								<br />
								<?
								
								if($_GET['org'])
								{
											$getConvoId = $_GET['org'];
										getConvo($_GET['org'], '');
										global $returnConvo;
										$howManyC = count($returnConvo);
										$g=0;
										
										while($g < $howManyC)
								{
									
									/*
									if($returnConvo[$g][3] == 0)
									{
										$readInd = "<table class='readIndicatorUnread'><tr><Td>D</td></tr></table>";
										
									}else{
										$readInd = "<table class='readIndicator'><tr><Td>R</td></tr></table>";
									} */
									
									
									//Output entire conversation
									?>
									<table cellpadding='2px' cellspacing='0' class='messageContainer'><tr><td align='center' valign='center'>
													<table width='100%' height='100%' cellpadding='4px' cellspacing='0' border='0'>
														
														<? 
														
															if($_SESSION['userId'] != $returnConvo[$g][4])
															{
																$convoSide = "right";
															}else
															{
																$convoSide = "left";
															}
														
														
														?>
														<tr><td width='40px' height='40px' rowspan='4' valign='center' align='<?= $convoSide ?>'>
															
															
															<table cellpadding='0' cellspacing='8px' border='0' height='100%' width='80%'><tr>
																<td rowspan='3' align='center' valign='center' width='40px'><img src='<?= getEmployeeThumbnail($returnConvo[$g][4]);?>' border='0' height='40px' width='40px'/></td>
															
																
															<td valign='center' align='left' class='inboxItem'><? echo $returnConvo[$g][0]; ?><br /><span style='color: #6d6d6d; font-size:12px; font-weight: normal'><? echo $returnConvo[$g][2]; ?></span></td>
															</tr></table>
															
															
															
															</td></tr>
														</table>
														
														
									
										
								</td></tr>
									</table>
									
									
									
									<?php
									
									
									$g++;
								}
							}else{
								
								$getConvoId = $_GET['id'];
								//Output single message as there is no conversation yet ...
								
								$messageContainer = getMessage($_GET['id']);
								$senderThumb = getEmployeeThumbnail(mysql_result($messageContainer, 0, "sender"));
								$message = mysql_result($messageContainer, 0, "message");
								$senderFullName = getEmployeeName(mysql_result($messageContainer, 0, "sender"));
								
								?>
										
										<table cellpadding='2px' cellspacing='0' class='messageContainer'><tr><td align='center' valign='center'>
															<table width='100%' height='100%' cellpadding='4px' cellspacing='0' border='0'>
																
																
																<tr><td width='40px' height='40px' rowspan='4' valign='center' align='center'><img src='<?= $senderThumb; ?>' border='0' height='40px' width='40px'/></td><td align='left' valign='center' >
																	
																	
																	<table cellpadding='0' cellspacing='8px' border='0' height='100%' ><tr>
																	<td valign='center' align='left' class='messageLine' class='inboxItem'><?= $senderFullName; ?></a></td>
																	<td valign='center' align='left'>&nbsp</td>
																	<td valign='center' align='left'><span class='messagePreview'><?= $message; ?></span></td>
																	</tr><table>
																	
																	
																	
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
								
								
								
								<?php
								
							}
								?>
								
								
								
					<table width='100%' cellpadding='2px' cellspacing='0'>
															
													<tr ><td align='right' valign='center'>
														<form action="<?php echo $PHP_SELF;?>" method="post">
															<input type='hidden' name='replyRecip' value='<?= $returnConvo[$g][4];?>' />
															<input type='hidden' name='convo' value='<?= $getConvoId;?>' />
															
														<textarea placeholder='Your reply' class='textarea' cols='50' name='replyMsg'></textarea><br /><input type='submit' value='Send' name='submit' />
														
													</form>
														</td></tr>
													</table>
								
								
								
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
