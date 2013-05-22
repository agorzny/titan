<div id="createTaskModal" class="modal modalTask">
		<h1>Create a Task</h1>
		<form>
			<table border="0">
				<tr>
					<td><p> Task Title: </p></td>
					<td><input class="textbox" type="eventTitle" id="taskTitle"></td>
				</tr>
				<tr>
					<td><p>Assigned To:  </p></td>
					<td><div id="dropdown" rel="dropdown"></div></td>
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
					<td><input type="datetime-local" id="taskWhen"></td>
				</tr>
			</table>
			<p> Task Description </p>
			<textarea  id="message" style="width: 95%;" rows="5"></textarea>
			<button class="modal_close">Cancel Task</button>
			<button type="submit" class="modal_close">Create Task</button>
		<form>
	</div>