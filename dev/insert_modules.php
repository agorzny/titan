<?

  function addReadStatus(){
    connectToDatabase();
    $query='INSERT INTO readStatus (status,dateRead,readType) VALUES ("0","Test Read Status","-1")';
   //echo "Query: ".$query."<br/>";
		$result=mysql_query($query);
    $query2="SELECT LAST_INSERT_ID()";
    $result2=mysql_query($query2);
    $id=mysql_result($result2,0);
    //echo "New readStatus id: " . $id . "<br/>";
    return $id;
  }

  // Adding a Message -----------------------------------------------------------------------------------------------------------

  function addMessage($sender,$date,$text){
    connectToDatabase();
    $query='INSERT INTO message (sender,dateSent,message) VALUES ("'.$sender.'","'.$date.'","'.$text.'")';
    //echo "Query: ".$query."<br/>";
		$result=mysql_query($query);
    $query2="SELECT LAST_INSERT_ID()";
    $result2=mysql_query($query2);
    $id=mysql_result($result2,0);
    //echo "New message id: " . $id . "<br/>";
    return $id;
  }

  function addRecipient($message,$employee){
    connectToDatabase();
    $readStatus = addReadStatus();
    $query='INSERT INTO recipients (message,employee,readStatus) VALUES ("'.$message.'","'.$employee.'","'.$readStatus.'")';
    //echo "Query: ".$query."<br/>";
		$result=mysql_query($query);
    $query2="SELECT LAST_INSERT_ID()";
    $result2=mysql_query($query2);
    $id=mysql_result($result2,0);
    //echo "New recipient id: " . $id . "<br/>";
    return $id;
  }



  // Inserts a message into the database properly by creating
  // recipients and readStatus entries to match
  //
  // $sender: Who is sending the message (id)
  // $date: the date of the message
  // $text: message body
  // $employees: array of employee id's who the message is sent to
  function createMessage($sender, $date, $text, $employees){
    connectToDatabase();
    $message = addMessage($sender,$date,$text);
    foreach($employees as $e){
      addRecipient($message,$e);
    }
  }

  // adding event --------------------------------------------------------------------------------------------------------

  function addEvent($title,$desc,$date,$loc, $creator){
    connectToDatabase();
    $query='INSERT INTO event (title,eventDesc,dateOfEvent, location, creator) VALUES ("'.
      $title.'","'.$desc.'","'.$date.'","'.$loc.'","'.$creator.'")';
    //echo "Query: ".$query."<br/>";
		$result=mysql_query($query);
    $query2="SELECT LAST_INSERT_ID()";
    $result2=mysql_query($query2);
    $id=mysql_result($result2,0);
    //echo "New event id: " . $id . "<br/>";
    return $id;
  }

  function addAttendee($event, $employee){
    connectToDatabase();
    $readStatus = addReadStatus();
    $query='INSERT INTO attendees (event,employee,readStatus) VALUES ("'.$event.'","'.$employee.'","'.$readStatus.'")';
    //echo "Query: ".$query."<br/>";
		$result=mysql_query($query);
    $query2="SELECT LAST_INSERT_ID()";
    $result2=mysql_query($query2);
    $id=mysql_result($result2,0);
    //echo "New attendee id: " . $id . "<br/>";
    return $id;
  }

  // Inserts an event into the database properly by creating
  // attendees and readStatus entries to match
  //
  // $creator: Who is creating the message (id)
  // $attendees: array of employee id's who the event is sent to
  function createEvent($title,$desc,$date,$loc, $creator, $attendees){
    connectToDatabase();
    $event = addEvent($title,$desc,$date,$loc, $creator);
    foreach($attendees as $a){
      addAttendee($event,$a);
    }
  }

  //adding task ------------------------------------------------------------------------------------------------------------

  function addTask($name,$desc,$start,$due, $assignor){
    $status=0;
    $complete="Incomplete";
    connectToDatabase();
    $query='INSERT INTO task (taskName,taskDesc,startDate, endDate, completeDate, assignor, status) VALUES ("'.
      $name.'","'.$desc.'","'.$start.'","'.$due.'","'.$complete.'","'.$assignor.'","'.$status.'")';
    //echo "Query: ".$query."<br/>";
		$result=mysql_query($query);
    $query2="SELECT LAST_INSERT_ID()";
    $result2=mysql_query($query2);
    $id=mysql_result($result2,0);
    //echo "New task id: " . $id . "<br/>";
    return $id;
  }

  function addEmployeeTask($task, $employee){
    connectToDatabase();
    $readStatus = addReadStatus();
    $query='INSERT INTO employeeTask (task,employee,readStatus) VALUES ("'.$task.'","'.$employee.'","'.$readStatus.'")';
    //echo "Query: ".$query."<br/>";
		$result=mysql_query($query);
    $query2="SELECT LAST_INSERT_ID()";
    $result2=mysql_query($query2);
    $id=mysql_result($result2,0);
    //echo "New employeeTask id: " . $id . "<br/>";
    return $id;
  }

  // Inserts a task into the database properly by creating
  // employeeTask and readStatus entries to match
  //
  // $assignor: Who is creating the task (id)
  // $employees: array of employee id's who the task is assigned to
  function createTask($name,$desc,$start,$due, $assignor, $employees){
    connectToDatabase();
    $task = addTask($name,$desc,$start,$due, $assignor);
    foreach($employees as $e){
      addEmployeeTask($task,$e);
    }
  }

  //adding project --------------------------------------------------------------------------------------------------------

  function addProject($name, $desc, $start, $due, $length, $assignor){
    connectToDatabase();
    $query='INSERT INTO project (projectName,projectDesc,startDate, endDate, length, assigner) VALUES ("'.
      $name.'","'.$desc.'","'.$start.'","'.$due.'","'.$length.'","'.$assignor.'")';
    //echo "Query: ".$query."<br/>";
		$result=mysql_query($query);
    $query2="SELECT LAST_INSERT_ID()";
    $result2=mysql_query($query2);
    $id=mysql_result($result2,0);
    //echo "New project id: " . $id . "<br/>";
    return $id;
  }

  function addProjectTask($project, $task){
    $ets = getETForTask($task);
    $num=mysql_numrows($ets);
    for($i=0;$i<$num;$i++){
      $readStatus = addReadStatus();
      connectToDatabase();
      $et = mysql_result($ets,$i,"id");
      $query='INSERT INTO projectTask (project,employeeTask,readStatus) VALUES ("'.$project.'","'.$et.'","'.$readStatus.'")';
     // echo "Query: ".$query."<br/>";
		  $result=mysql_query($query);
      $query2="SELECT LAST_INSERT_ID()";
      $result2=mysql_query($query2);
      $id=mysql_result($result2,0);
      //echo "New projectTask id: " . $id . "<br/>";
    }
  }

  function getETForTask($id){
  connectToDatabase();
    $query="SELECT et.id from employeeTask as et WHERE et.task=". $id;
		$result=mysql_query($query);
    return $result;
  }

  // Inserts a project into the database properly by creating
  // projectTask and readStatus entries to match
  //
  // $assignor: Who is creating the project (id)
  // $tasks: array of task id's that are part of the project
  function createProject($name, $desc, $start, $due, $length, $assignor, $tasks){
    connectToDatabase();
    $project = addProject($name, $desc, $start, $due, $length, $assignor);
    foreach($tasks as $t){
      addProjectTask($project,$t);
    }
  }

// adding employee -------------------------------------------------------------------------------------------

function addEmployee($username, $first, $last, $email, $phone, $thumb){
    connectToDatabase();
    $query='INSERT INTO employees (username,firstName,lastName, email, phone, thumb) VALUES ("'.
      $username.'","'.$first.'","'.$last.'","'.$email.'","'.$phone.'","'.$thumb.'")';
    echo "Query: ".$query."<br/>";
		$result=mysql_query($query);
    $query2="SELECT LAST_INSERT_ID()";
    $result2=mysql_query($query2);
    $id=mysql_result($result2,0);
    echo "New employee id: " . $id . "<br/>";
    return $id;
}

function addEmployeeToDept($employee, $dept){
    connectToDatabase();
    $query='INSERT INTO employeeDept (dept, employee) VALUES ("'.$dept.'","'.$employee.'")';
    echo "Query: ".$query."<br/>";
		$result=mysql_query($query);
    $query2="SELECT LAST_INSERT_ID()";
    $result2=mysql_query($query2);
    $id=mysql_result($result2,0);
    echo "New employeeDept id: " . $id . "<br/>";
    return $id;
  }

function createEmployee($username, $first, $last, $email, $phone, $thumb, $depts){
  connectToDatabase();
  $employee = addEmployee($username, $first, $last, $email, $phone, $thumb);
  foreach($depts as $d){
    addEmployeeToDept($employee,$d);
  }
}














?>