<?

//PHP functions for Employee Communication Tool

//Codenamed "Link"

//May 2013 - CT Innovations



include('modules.php');

//Global Variables

$employeeArray = array();

$deptArray = array();

$projectArray = array();

//$connectionStatus = new mysqli();





function connectToDatabase() //Connect to database

{

	//Set credentials

	$db_username = "thevoidc_cti";

	$db_password = "cti2013";

	$db_database = "thevoidc_titan";





	//Connection



	$dbh=mysql_connect ('localhost',$db_username,

	$db_password) or die('Cannot connect to the database because: ' . mysql_error());

	mysql_select_db($db_database) or die( "Cannot Connect");







}



function closeDatabase() //Close Database Connection,

{

	mysqli_close();

}



function listFileDirectory() //List files in directory (without database support - descriptions, uploadedBy etc)

{

	if ($dirHandle = opendir('/pathToFiles')) {





    /* This is the correct way to loop over the directory. */

    while (false !== ($fileEntry = readdir($dirHandle))) {

        echo "$fileEntry\n"; //TO DO - MUST BE CUSTOMIZED

    }

  }



	closedir($dirHandle);



}



function getEmployeesFromDatabase() //Populates an array of Employees

{







	//Connect to database

	connectToDatabase();



	//perform query

	$query = "SELECT id, firstName, lastName, type FROM employees ORDER BY Name ASC";



			if ($result = mysqli_query($query)) { //if query was successful



					$i=0;

					while ($i < $num) //loop through all results from database query

					{



							//Select row $i

				    	$result->data_seek($i);



					    //Pull data from row

					    $row = mysqli_fetch_row($result);



							$id = $row[0];

							$firstName = $row[1];

							$lastName = $row[2];

							$type = $row[3];



							//Add to array

							array_push($employeeArray, "$id", "$firstName", "$lastName", "$type");





					    //Free/un-handle reseult set

					    mysqli_free_result($result); //prep for next one





					 $i++;

					 }

			}



			return $employeeArray; //returns employee info as array



}



function employeeList() //Returns the list of employees as JSON data

{



	return json_encode($employeeArray);



}



function getDepartmentsFromDatabase() //Populates an array of departments

{







	//Connect to database

	connectToDatabase();



	//perform query

	$query = "SELECT id, departmentName, type FROM departments ORDER BY departmentName ASC";



			if ($result = mysqli_query($query)) { //if query was successful



					$i=0;

					while ($i < $num) //loop through all results from database query

					{



							//Select row $i

				    	$result->data_seek($i);



					    //Pull data from row

					    $row = mysqli_fetch_row($result);



							$id = $row[0];

							$deptName = $row[1];

							$type = $row[2];



							//Add to array

							array_push($deptArray, "$id", "$deptName", "", "$type");





					    //Free/un-handle reseult set

					    mysqli_free_result($result); //prep for next one





					 $i++;

					 }

			}



			return $deptArray; //returns employee info as array



}



function departmentList() //Returns the list of employees as JSON data

{



	return json_encode($deptArray);



}



function allContacts() //Returns a list of Employees AND departments as JSON data

{

	//Set lists in array

	employeeList();

	departmentList();



	//Create array to hold lists (employees and departments)

	$groupArray = array();



	//Combine the two

	$groupArray = array_merge($groupArray, $employeeArray); //Add Employees

	$groupArray = array_merge($groupArray, $deptArray); //Add departments



	return json_encode($groupArray);

}

function getAssignedTasks($userid, $status){
  connectToDatabase();

  $userid=" WHERE et.employee=".$userid;
  if($status!=null) $status=" AND task.status=".$status;
  else $status="";

  $query="SELECT et.readStatus, task.* FROM employeeTask as et INNER JOIN task ON task.id=et.task" . $userid . $status;
	$result=mysql_query($query);

  $tasks = array();
  $num=mysql_numrows($result);
  for($i=0;$i<$num;$i++){
    $t_name = mysql_result($result,$i,"taskName");
    $t_desc = mysql_result($result,$i,"taskDesc");
    $t_start = mysql_result($result,$i,"startDate");
    $t_end = mysql_result($result,$i,"endDate");
    $t_complete = mysql_result($result,$i,"completeDate");
    $t_assignor = mysql_result($result,$i,"assignor");
    $t_status = mysql_result($result,$i,"status");
    $t_status = $t_status==0 ? "Incomplete" : "Complete";
    $t_read = mysql_result($result,$i,"readStatus");
    $t_read = $t_read==0 ? "Unread" : "Seen";

    $taskdata = array("Name"=>$t_name, "Description"=>$t_desc, "Start Date"=>$t_start, "Due Date"=>$t_end, "Completed"=>$t_complete,
                     "Assignor"=>$t_assignor,"Status"=>$t_status, "Read Status"=>$t_read);

    array_push($tasks,$taskdata);
  }
  return $tasks;
}

function getAssignedProjects($user)

{



	$projects = array();

	//Connect to database

	connectToDatabase($user);



	//perform query

	$query="SELECT et.id as etId, et.employee, et.readStatus, et.task FROM employeeTask as et WHERE et.employee=" . $user;

	$result=mysql_query($query);

	$num=mysql_numrows($result);

	for ($i=0;$i < $num;$i++) {

		$id=mysql_result($result,$i,"etId");

		$query2="SELECT DISTINCT pt.project FROM projectTask as pt WHERE pt.employeeTask=" . $id;

	  $result2=mysql_query($query2);



		$num2=mysql_numrows($result2);

    for($j=0;$j<$num2;$j++){

      $projectId=mysql_result($result2,$j, "project");


      $query3="SELECT * FROM project as p WHERE p.id=".$projectId;

		  $result3=mysql_query($query3);

      $num3=mysql_numrows($result3);

  	  for($k=0;$k<$num3;$k++){

        $p_name = mysql_result($result3,$k,"projectName");

        $p_desc = mysql_result($result3,$k,"projectDesc");

        $p_start = mysql_result($result3,$k,"startDate");

        $p_due = mysql_result($result3,$k,"endDate");

        $p_assignor = mysql_result($result3,$k,"assigner");

        $project = array("Name"=>$p_name,"Description"=>$p_desc,"Start"=>$p_start,"Due"=>$p_due,"Assignor"=>$p_assignor);

        array_push($projects,$project);

      }

    }

	}

  return $projects;

}





function getAllMessagesSentTo($reciever, $date, $readstatus, $sender) //Populates an array of Employees

{







	//Connect to database

	connectToDatabase();

  $rwhere="";

  $mwhere="";



  if($readstatus!=null) $rwhere = " AND (SELECT status from readStatus WHERE readStatus.id=r.readStatus)=".$readstatus;

  else $rwhere = "";



  if($date!=null && $sender!=null) $mwhere = " AND m.dateSent > " . $date . " AND m.sender= ".$sender;

  else if($date!=null && $sender==null) $mwhere = " AND m.dateSent > " . $date;

  else if($date==null && $sender!=null) $mwhere = " AND m.sender= ".$sender;

  else $mwhere = "";



	$query="SELECT r.message as messageId, r.readStatus FROM recipients as r WHERE r.employee=" . $reciever . $rwhere;

	$result=mysql_query($query);

	$num=mysql_numrows($result);



	for ($i=0;$i < $num;$i++) {

		$id=mysql_result($result,$i,"messageId");

    $status=mysql_result($result,$i,"readStatus");

		$query2="SELECT m.sender, m.message FROM message as m WHERE m.id=" . $id . $mwhere;



	  $result2=mysql_query($query2);



    $sender=mysql_result($result2,0,"sender");

    $text=mysql_result($result2,0,"message");

	  $query3="SELECT firstName FROM employees WHERE id=".$sender;

		$result3=mysql_query($query3);

	  $first=mysql_result($result3,0,"firstName");



    echo "<br />Sent by: ".$first."<br />Message: ".$text."<br />Sent To: ";



 		$query4="SELECT r.employee as reciever FROM recipients as r WHERE r.message=".$id;

		$result4=mysql_query($query4);



		$num2=mysql_numrows($result4);

    for($j=0;$j<$num2;$j++){

      $reciever=mysql_result($result4,$j,"reciever");

      $query5="SELECT firstName FROM employees WHERE id=".$reciever;

		  $result5=mysql_query($query5);

  	  $first2=mysql_result($result5,0,"firstName");

      echo $first2;

      $query6="SELECT rs.status from readStatus as rs WHERE rs.id=" . $status;

      $result6=mysql_query($query6);

      if(mysql_result($result6,0,"status")==0) echo " (unseen)";

      else echo " (seen)";

      if($j<($num2 - 1)){

	      echo ", ";

      }

    }

	  echo "<br />";

	 }

}



function getAllMessagesSentBy($sender, $date) //Populates an array of Employees

{







	//Connect to database

	connectToDatabase();

  $rwhere="";

  $mwhere="";



  if($date!=null) $mwhere = " AND m.dateSent > " . $date;

  else $mwhere = "";



	$query="SELECT m.id as messageId, m.message, m.sender FROM message as m WHERE m.sender=" . $sender . $mwhere;

	$result=mysql_query($query);

  $query2="SELECT firstName FROM employees WHERE id=".$sender;

	$result2=mysql_query($query2);

	$first=mysql_result($result2,0,"firstName");



	$num=mysql_numrows($result);



	for ($i=0;$i < $num;$i++) {

		$id=mysql_result($result,$i,"messageId");

    	$sender=mysql_result($result,$i,"sender");

      $text=mysql_result($result,$i,"message");



		$query3="SELECT r.employee as reciever, r.readStatus FROM recipients as r WHERE r.message=" . $id;

	  $result3=mysql_query($query3);



    $num2=mysql_numrows($result3);

    if($num2==0)continue;



    echo "<br />Sent by: ".$first."<br />Message :" .$text."<br />Sent To: ";



    for($j=0;$j<$num2;$j++){

      $reciever=mysql_result($result3,$j,"reciever");

      $status=mysql_result($result3,$j,"readStatus");

      $query4="SELECT firstName FROM employees WHERE id=".$reciever;

		  $result4=mysql_query($query4);

  	  $first2=mysql_result($result4,0,"firstName");

      echo $first2;

      $query5="SELECT rs.status from readStatus as rs WHERE rs.id=" . $status;

      $result5=mysql_query($query5);

      if(mysql_result($result5,0,"status")==0) echo " (unseen)";

      else echo " (seen)";

      if($j<($num2 - 1)){

	      echo ", ";

      }

    }

	  echo "<br />";

	 }

}



function uploadFile() //TO-DO

{

	//TO DO

	//Upload file to directory



	//Add details to database (user, title, details etc)



	//return confirmation of upload





}








?>