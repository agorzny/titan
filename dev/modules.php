<?



function getEmployee($id){
    connectToDatabase();
    $query="SELECT * FROM employees WHERE id=". $id;
		$result=mysql_query($query);
    return $result;
}

function getProject($id){
    connectToDatabase();
    $query="SELECT * FROM project WHERE id=". $id;
		$result=mysql_query($query);
    return $result;
}

function getTask($id){
    connectToDatabase();
    $query="SELECT * FROM task WHERE id=". $id;
		$result=mysql_query($query);
    return $result;
}

function getEvent($id){
    connectToDatabase();
    $query="SELECT * FROM event WHERE id=". $id;
		$result=mysql_query($query);
    return $result;
}

function getFile($id){
    connectToDatabase();
    $query="SELECT * FROM file WHERE id=". $id;
		$result=mysql_query($query);
    return $result;
}

function getDepartment($id){
    connectToDatabase();
    $query="SELECT * FROM department WHERE id=". $id;
		$result=mysql_query($query);
    return $result;
}

function getEmployeesInDepartment($id){
    connectToDatabase();
    $query="SELECT ed.employee FROM employeeDept as ed WHERE ed.dept=". $id;
		$result=mysql_query($query);
    return $result;
}

function getMessage($id){
    connectToDatabase();
    $query="SELECT * FROM message WHERE id=". $id;
		$result=mysql_query($query);
    return $result;
}

function getRecipientsOfMessage($id){
    connectToDatabase();
    $query="SELECT * FROM recipients as r WHERE r.message=". $id;
		$result=mysql_query($query);
    return $result;
}

function getReadStatus($id){
    connectToDatabase();
    $query="SELECT * FROM readStatus WHERE id=". $id;
		$result=mysql_query($query);
    return $result;
}

function hasBeenRead($id){
    connectToDatabase();
    $query="SELECT status FROM readStatus WHERE id=". $id;
		$result=mysql_query($query);
    return mysql_result($result,0,"status")==1;
}

function getAttendees($id){
    connectToDatabase();
    $query="SELECT * FROM attendies as a WHERE a.event=". $id;
		$result=mysql_query($query);
    return $result;
}

function getEmployeesAssignedToTask($id){
    connectToDatabase();
    $query="SELECT et.employee FROM employeeTask as et WHERE et.task=". $id;
		$result=mysql_query($query);
    return $result;
}

function getTasksAssignedToEmployee($id){
    connectToDatabase();
    $query="SELECT et.task FROM employeeTask as et WHERE et.employee=". $id;
		$result=mysql_query($query);
    return $result;
}

function getEmployeeEvents($id){
    connectToDatabase();
    $query="SELECT a.event FROM attendees as a WHERE a.employee=". $id;
		$result=mysql_query($query);
    return $result;
}

function getEmployeeFiles($id){
    connectToDatabase();
    $query="SELECT fa.file FROM fileAccess as fa WHERE fa.security=". $id;
		$result=mysql_query($query);
    return $result;
}

function getEmployeeDepartments($id){
    connectToDatabase();
    $query="SELECT ed.dept FROM employeeDept as ad WHERE ed.employee=". $id;
		$result=mysql_query($query);
    return $result;
}

function getPTInProject($id){
    connectToDatabase();
    $query="SELECT * FROM projectTask as pt WHERE pt.project=". $id;
		$result=mysql_query($query);
    return $result;
}

function getETInPT($id){
    connectToDatabase();
    $query="SELECT pt.employeeTask FROM projectTask as pt WHERE pt.employeeTask=". $id;
		$result=mysql_query($query);
    return $result;
}

function getTasksInProject($id){
    connectToDatabase();
    $query="SELECT et.task from employeeTask as et ON et.id=projectTask.employeeTask WHERE employeeTask.project=". $id;
		$result=mysql_query($query);
    return $result;
}

?>