	<div id="composeBox" style='display:none'>
		
		<form method="POST" action="<?= $PHP_SELF;?>">
		<input id="data" name="data" type="hidden" value="">
		<input id="current" name="current" type="hidden" value='<? echo $_SESSION['userId']; ?>'>
		<table width='610px' height='200px' cellpadding='4px' style='background: #fff'>
			<tr><td colspan='2'>Send a message</td></tr>
			<tr><td width='100px' valign='center' align='left'><div name="" id="dropdown" rel="dropdown" value=""  style='font-size:16; font-family: arial; color: #6d6d6d'/></td></tr>
          <tr><td align='left' valign='center' style='font-size: 12px; color: #b7b7b7'>To: <div id="assgn_contacts" name='assgn_contacts'></div><script>
              getContacts("assgn_contacts");
          </script></td></tr>          
      <tr><TD colspan='2''><textarea  name="message" id="message" style="width: 95%;" rows="5" style='color: #6d6d6d; font-size:12; font-family: arial'></textarea></td></tr>
      <tr><td colspan='2'><button type="submit" class="modal_close">Cancel</button>
			<input type="submit" class="modal_close" value="Send" name='submit'></td></tr>
				
				
		</table>
	</form>
		
</div>
<!--		

<h1>Create a Task</h1>
		<form method="POST" action="ct_createTask.php">
    <input id="data" name="data" type="hidden" value="">
    <input id="current" name="current" type="hidden" value='<? echo $_SESSION['userId']; ?>'>
			<table border="0">
				<tr>
					<td><p> Task Title: </p></td>
					<td><input class="textbox" name="taskTitle" id="taskTitle"></td>
				</tr>
				<tr>
					<td><p>Assigned To:  </p></td>
					<td><div name="" id="dropdown" rel="dropdown" value=""></div></td>
				</tr>
        <tr><td colspan="2">
            <div id="assgn_contacts">

            </div>
            <script>
              getContacts("assgn_contacts");
          </script>
        </td></tr>
				<tr>
					<td><p> Due Date: </p></td>
					<td><input type="datetime-local" name="taskWhen" id="taskWhen"></td>
				</tr>
			</table>
			<p> Task Description </p>
			<textarea  name="message" id="message" style="width: 95%;" rows="5"></textarea>
			<button type="submit" class="modal_close">Cancel Task</button>
			<input type="submit" class="modal_close" value="Create Task">
    <form>
  	
-->