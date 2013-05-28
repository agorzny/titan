<table width='100%' cellpadding='0' cellspacing='0'>
							<tr><Td valign='top' align='center'>
								
								<?
								getAllUnreadMessagesCount($_SESSION['userId'], '', 0, '');
								
								$activeProjectsForUser = count(getAssignedProjects($_SESSION['userId']));
								?>
								
								<table style='background: #202020;' width='105px' cellpadding='4px' cellspacing='0'>
										<tr><Td class='msg_bar_td' align='center' valign='center'><a href='ct_inbox.php' class='ct_menu' title='You have <?=$returnUnreadCount;;?> new message(s)'><?= $returnUnreadCount;?></a><br /><span class='msg_bar_values'>Unread<br />Messages</span></td></tr>
										<tr><Td class='msg_bar_td' align='center' valign='center'><a href='ct_existingTasks.php' class='ct_menu'>0</a><br /><span class='msg_bar_values'>Tasks</span></td></tr>
										<tr><Td class='msg_bar_td' align='center' valign='center'><a href='ct_projects.php' class='ct_menu' title='You are currently involved in <?= $activeProjectsForUser;?> projects'><?= $activeProjectsForUser?></a><br /><span class='msg_bar_values'>Projects</span></td></tr>
								</table>
								
								<!-- 
								<table style='background: #202020;' width='105px' cellpadding='4px' cellspacing='0'>
									
         				<tr><td align='center' valign='top' style="font-size: 50px; color: white">
         					
         						<table width='80px' cellpadding='0' cellspacing='0' border='0' >
         						<tr><td valign='top' align='center'><Br />
         					
         				<?
										getCoworkers($_SESSION['userId']);
										$howManyCW = count($returnCoworkers);
								?>
								
								<?
										//Get all employees in the same department
										
										
										$cw = 0;
										while($cw < $howManyCW)
										{
											
											if($cw == 0)
											{
												echo "<tr>";
											}
											?>
											<td align='center' valign='center'><img src='/cti/dev/<?= $returnCoworkers[$cw][2]?>' title='<?= $returnCoworkers[$cw][0]." ".$returnCoworkers[$cw][1]?>' height='40px' width='40px'/></td>
											<?
											
											if($cw != 0 )
											{
												if($cw%2 != 0)
												{
													echo "</tr>";
												}
											}
											
											
											$cw++;
										}
								?>
         					
         				</td></tr>
         					</table>
         					
         					</td></tr>
         				</table>
								
								-->
								<table class=''msg_bar_options'>
         				<tr><td align='center' valign='center' style="font-size: 50px; color: white"><a id="Add" rel="leanModal" name="createModal" href="#createModal" class='ct_menu'>+</a></td></tr>
         				<tr><td align='center' valign='center' style="font-size: 50px; color: white"><a href='ct_fileCabinet.php' class='ct_menu' style='font-size:11'><img src='img/fileCabinet.png' width='50px' height='50px' border='0'/></a></td></tr>
         				</table>
								
								</td></tr>
						</table>