<div id="createTaskModal" class="modal modalTask">
		<h1>Create a Task</h1>
		<form method="POST" action="ct_createTask.php">
    <input id="data" name="data" type="hidden" value="">
    <input id="current" name="current" type="hidden" value='"'<? echo $_SESSION['userId']; ?>'"'>
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
	</div>