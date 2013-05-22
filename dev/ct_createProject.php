<?php
	session_start();
?>

<!DOCTYPE html PUB LIC"-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create a Project</title>



	<link href="css/StyleSheet_Employee_CT.css" type="text/css" rel="stylesheet"/>

		<link href="css/Stylesheet.css" type="text/css" rel="stylesheet"/>
  <link href="js/FlexBox/css/jquery.flexbox.css" type="text/css" rel="stylesheet"/>

	<script src="js/jquery-1.8.3.min.js"></script>
  <script src="js/portal.js"></script>
	<script src="js/contact_chooser.js"></script>
  <script src="js/FlexBox/js/jquery.flexbox.min.js"></script>


	<!-- JS file for Modal -->
	<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>

	<? include('titan.php'); ?>

	<script>
		$(function() {
    			$('a[rel*=leanModal]').leanModal({ top : 200, closeButton: ".modal_close" });
				$('button[rel*=leanModal]').leanModal({ top : 200, closeButton: ".modal_close" });
			});


		function startUp() {
			//onLoadProject();
      loadContacts();
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
									<tr><Td style='color: #6d6d6d;border-bottom: 1px dashed #6d6d6d'>Create a Project</td></tr>
								</table>

								<br /><br /><br />

                <div class="projectDiv">
								<form>
                  <input type='hidden' id='data' value=''>
                  <table id="createProject">
                      <tr><td>Title:</td><td colspan="2"><input type="text" name="title"></td></tr>
                      <tr><td>Due:</td><td colspan="2"><input type="datetime-local" name="taskWhen"></td></tr>
                      <tr><td colspan="3">Description:</td></tr>
                      <tr><td colspan="3"><textarea  name="message" style="width: 95%;" rows="5"></textarea></td></tr>
                      <tr><td><button>Add New Task</button></td><td></td><td align="right"><button>Add Existing Task</button></td></tr>
                      <tr><td colspan="3">
                        <div id='tasklist' class='projectDiv'>
                          <ul>
                            <li>example1</li>
                          </ul>
                        </div>
                      </td></tr>
                      <tr><td><button>Cancel</input></td><td></td><td align="right"><input type='submit' value='Create Project'></td></tr>
                  </table>
                </form>
                </div>
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
    <? include('ct_createTaskModal.php'); ?>
</body>
</html>
