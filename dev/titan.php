<?php

//PHP functions for Employee Communication Tool

//Codenamed "Link"

//May 2013 - CT Innovations
//Global Variables

$employeeArray = array();
$deptArray = array();
$projectArray = array();
$returnList = array();
$returnListFiles = array();
$returnCoworkers = array();
$returnUnreadCount = 0;



include('modules.php');






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

  $temp = array();

	connectToDatabase();



	//perform query

	$query = "SELECT id, firstName, lastName, rank FROM employees ORDER BY lastName ASC";



			if ($result = mysql_query($query)) { //if query was successful

          $num=mysql_numrows($result);
					for($i=0;$i<$num;$i++){

              $id = mysql_result($result,$i,"id");

							$firstName = mysql_result($result,$i,"firstName");

							$lastName = mysql_result($result,$i,"lastName");

							$type = mysql_result($result,$i,"rank");

              $name = $lastName . ", " . $firstName;

							//Add to array
              $t = array("index"=>"0","id"=>$id,"name"=>$name,"type"=>"person");
							array_push($temp, $t);

					 }

			}


      $employeeArray=$temp;
			return $temp; //returns employee info as array



}



function employeeList() //Returns the list of employees as JSON data

{



	return json_encode($employeeArray);



}



function getDepartmentsFromDatabase() //Populates an array of departments

{

	//Connect to database
  $temp=array();
	connectToDatabase();



	//perform query

	$query = "SELECT id, deptName FROM department ORDER BY deptName ASC";



			if ($result = mysql_query($query)) { //if query was successful



					$num=mysql_numrows($result);
					for($i=0;$i<$num;$i++){

							$id = mysql_result($result,$i,"id");

							$deptName = mysql_result($result,$i,"deptName");

              $t = array("index"=>"0","id"=>$id,"name"=>$deptName,"type"=>"group");
							array_push($temp, $t);


					 }

			}else{
        return "flag";
      }


      $deptArray=$temp;
			return $temp; //returns employee info as array



}



function departmentList() //Returns the list of employees as JSON data

{



	return json_encode($deptArray);



}



function allContacts() //Returns a list of Employees AND departments as JSON data

{

	//Set lists in array

	$e = getEmployeesFromDatabase();
  $d = getDepartmentsFromDatabase();



	//Create array to hold lists (employees and departments)

	$groupArray = array();



	//Combine the two

	$groupArray = array_merge($e, $d); //Add departments



	return json_encode($groupArray);

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
				$p_id = mysql_result($result3,$k,"id");

        $p_name = mysql_result($result3,$k,"projectName");

        $p_desc = mysql_result($result3,$k,"projectDesc");

        $p_start = mysql_result($result3,$k,"startDate");

        $p_due = mysql_result($result3,$k,"endDate");

        $p_assignor = mysql_result($result3,$k,"assigner");

        $project = array("Id" =>$p_id,"Name"=>$p_name,"Description"=>$p_desc,"Start"=>$p_start,"Due"=>$p_due,"Assignor"=>$p_assignor);

        array_push($projects,$project);

      }

    }

	}

  return $projects;

}





function getAllMessagesSentTo($reciever, $date, $readstatus, $sender) //Populates an array of Employees

{


	//unset($returnList);

global $returnList;


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

		$returnList[$i][6] = $id;

    $status=mysql_result($result,$i,"readStatus");

		$query2="SELECT m.sender, m.message FROM message as m WHERE m.id=" . $id . $mwhere;



	  $result2=mysql_query($query2);



    $sender=mysql_result($result2,0,"sender");

    $text=mysql_result($result2,0,"message");

	  $query3="SELECT firstName, lastName, thumb FROM employees WHERE id=".$sender;

		$result3=mysql_query($query3);

	  $first=mysql_result($result3,0,"firstName");
	  $last=mysql_result($result3,0,"lastName");
	  $thumb=mysql_result($result3,0,"thumb");



   // echo "<br />Sent by: ".$first."<br />Message: ".$text."<br />Sent To: ";

		$returnList[$i][0] = $first; //Add sender (firstname) to array
		$returnList[$i][4] = $last; //Add sender (firstname) to array
		$returnList[$i][1] = $text; //Add Message to array
		$returnList[$i][5] = $thumb; //thumb
		$returnList[$i][7] = $sender;



 		$query4="SELECT r.employee as reciever FROM recipients as r WHERE r.message=".$id;

		$result4=mysql_query($query4);




		$num2=mysql_numrows($result4);

    for($j=0;$j<$num2;$j++){

      $reciever=mysql_result($result4,$j,"reciever");

      $query5="SELECT firstName FROM employees WHERE id=".$reciever;

		  $result5=mysql_query($query5);

  	  $first2=mysql_result($result5,0,"firstName");

     // echo $first2;

      $returnList[$i][2] = $first2; //Add receipient(firstname) to array

      $query6="SELECT rs.status from readStatus as rs WHERE rs.id=" . $status;

      $result6=mysql_query($query6);

      if(mysql_result($result6,0,"status")==0) $returnList[$i][3] = 0; //Add read flag;

      else //echo " (seen)";
      $returnList[$i][3] = 1; //Add read flag

      if($j<($num2 - 1)){

	      //echo ", ";
	      $returnList[$i][2] .=  ", ";//Add read flag

      }


    }

	  //echo "<br />";

	 }


}

function getAllUnreadMessagesCount($reciever, $date, $readstatus, $sender) //Populates an array of Employees

{


	//unset($returnList);

global $returnUnreadCount;
$returnUnreadCount = 0;

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

	  $query3="SELECT firstName, lastName, thumb FROM employees WHERE id=".$sender;

		$result3=mysql_query($query3);

	  //$first=mysql_result($result3,0,"firstName");
	 // $last=mysql_result($result3,0,"lastName");
	  //$thumb=mysql_result($result3,0,"thumb");

		$returnUnreadCount++;

   // echo "<br />Sent by: ".$first."<br />Message: ".$text."<br />Sent To: ";

		//$returnList[$i][0] = $first; //Add sender (firstname) to array
		//$returnList[$i][4] = $last; //Add sender (firstname) to array
		//$returnList[$i][1] = $text; //Add Message to array
		//$returnList[$i][5] = $thumb; //Add sender (firstname) to array



 		$query4="SELECT r.employee as reciever FROM recipients as r WHERE r.message=".$id;

		$result4=mysql_query($query4);



		$num2=mysql_numrows($result4);

    for($j=0;$j<$num2;$j++){

      $reciever=mysql_result($result4,$j,"reciever");

      $query5="SELECT firstName FROM employees WHERE id=".$reciever;

		  $result5=mysql_query($query5);

  	  $first2=mysql_result($result5,0,"firstName");

     // echo $first2;

      //$returnList[$i][2] = $first2; //Add receipient(firstname) to array

      $query6="SELECT rs.status from readStatus as rs WHERE rs.id=" . $status;

      $result6=mysql_query($query6);

      if(mysql_result($result6,0,"status")==0)
      {

      	//$returnList[$i][3] = 0; //Add read flag;

    }else{
    }
     //echo " (seen)";
      //$returnList[$i][3] = 1; //Add read flag

      if($j<($num2 - 1)){

	      //echo ", ";
	      //$returnList[$i][2] .=  ", ";//Add read flag

      }


    }

	  //echo "<br />";

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


function getAllFilesByAccessor($accessor, $date, $readStatus) {
	connectToDatabase();

	global $returnListFiles;

	$query="SELECT f.file as fileID, f.readStatus as readStatusID, f.security as accessorID FROM fileAccess as f WHERE f.security=".$accessor;
	$result=mysql_query($query);

	$num = mysql_numrows($result);



	$i=0;

	while($i < $num){
		$fileID=mysql_result($result, $i, "fileID");
		$readStatusID=mysql_result($result, $i, "readStatusID");

		$query2="SELECT r.status as ReadStatus FROM readStatus as r WHERE r.id=".$readStatusID;
		$result2=mysql_query($query2);
		$status=mysql_result($result2, 0, "ReadStatus");
		//echo $status, $readStatus;

		if ($status == $readStatus){
			If ($date !=NULL){
				$query3="SELECT f.fileName as fileName, f.dateUploaded as fileUploadDate, f.uploader as uploaderID, f.filePath as path, f.id as fileID FROM file as f WHERE f.id=$fileID AND f.dateUploaded < $date";
			}
			else {
				$query3="SELECT f.fileName as fileName, f.dateUploaded as fileUploadDate, f.uploader as uploaderID, f.filePath as path, f.id as fileID FROM file as f WHERE f.id=$fileID";
			}

			$result3=mysql_query($query3);

			$fileName=mysql_result($result3, 0, "fileName");
			$fileDateUploaded=mysql_result($result3, 0, "fileUploadDate");
			$fileUploaderID=mysql_result($result3, 0, "uploaderID");
			$filePath=mysql_result($result3, 0, "path");
			$fileID=mysql_result($result3, 0, "fileID");

			$query4="SELECT f.readStatus as readStatusID, f.security as accessorID FROM fileAccess as f WHERE f.file=".$fileID;
			$result4=mysql_query($query4);
			$num2=mysql_numrows($result4);

			//echo mysql_result($result4, $j, "readStatusID");

			$j = 0;

			while($j < $num2){
				$accessors.=getEmployeeName(mysql_result($result4, $j, "accessorID"))." ".getReadStatus2(mysql_result($result4, $j, "readStatusID")).", ";
				$j++;
			}

			$returnListFiles[$i][0] = getEmployeeName($fileUploaderID); //UploadedBy - Name
			$returnListFiles[$i][1] = $fileName; //FileName
			$returnListFiles[$i][2] = $filePath; //FilePath
			$returnListFiles[$i][3] = $accessors; //Accessors
			$returnListFiles[$i][4] = $fileDateUploaded; //Date uploaded


			//echo "Uploaded by: ".getEmployeeName($fileUploaderID)."<br /> File Name: ".$filename."<br /> File path: ".$filePath."<br /> To: ".$accessors."<br /><br />";
		}
		$accessors="";
		$i++;
	}
}


function getReadStatus2($readStatusID) {
	$query="SELECT r.status as status FROM readStatus as r WHERE r.id=".$readStatusID;
	$result=mysql_query($query);
	$readStatus=mysql_result($result, 0, "status");
	if ($readStatus == 0){
		return "(unseen)";}
	else{
		return " (seen) ";
	}
}

function getEmployeeName($employeeID){
	$query="SELECT e.firstName as first, e.lastName as last FROM employees as e WHERE e.id=".$employeeID;
	$result=mysql_query($query);
	return (mysql_result($result, 0, "first")." ".mysql_result($result, 0, "last"));
}




function getCoworkers($employeedID){
connectToDatabase();

global $returnCoworkers;

		//Find out which department employee is in
		$query2="SELECT  e.id, e.firstName as firstName,  e.lastName as lastName, e.thumb as thumb, d.dept, d.employee, d2.deptName FROM employees e, employeeDept d, department d2 WHERE (e.id = d.employee) AND (d.dept= d2.id) AND (e.id <>".$employeedID.")";
		$result2=mysql_query($query2);
		//$deptID=mysql_result($result2,0,"dept"); //Dept ID



		$num = mysql_numrows($result2);

		$t=0;
		while($t < $num)
		{
			$empFirst=mysql_result($result2,$t,"firstName"); //Firstname
			$empLast=mysql_result($result2,$t,"lastName"); //LastName
			$empThumb=mysql_result($result2,$t,"thumb"); //Thumbnail
			$empDeptName=mysql_result($result2,$t,"deptName");
			$returnCoworkers[$t][0] = $empFirst;
			$returnCoworkers[$t][1] = $empLast;
			$returnCoworkers[$t][2] = $empThumb;
			$returnCoworkers[$t][3] = $empDeptName;
			$t++;
		}




}



?>