<?
//PHP functions for Employee Communication Tool 
//Codenamed "Link"
//May 2013 - CT Innovations


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

function getListOfProjects()
{
	
	
	//Connect to database
	connectToDatabase();
	
	//perform query
	$query = "SELECT id, projectName FROM projects ORDER BY projectName ASC";

			if ($result = mysqli_query($query)) { //if query was successful
			
					$i=0;
					while ($i < $num) //loop through all results from database query
					{
						
							//Select row $i
				    	$result->data_seek($i);
					
					    //Pull data from row
					    $row = mysqli_fetch_row($result);
					
							$id = $row[0];
							$projectName = $row[1];
							
					
							//Add to array
							array_push($projectArray, "$id", "$projecName");
					
					
					    //Free/un-handle reseult set
					    mysqli_free_result($result); //prep for next one
					 
					 
					 $i++;
					 }
			}
			
			return $projectArray; //returns employee info as array
	
}


function getAllEventsByAttendee($attendeeID, $date, $readStatus){
	connectToDatabase();
	
	$query="SELECT a.event as eventID, a.employee as employeeID, a.readStatus as readStatusID FROM attendees as a WHERE a.employee=".$attendeeID;
	$result=mysql_query($query);
	
	$num=mysql_numrows($result);
	
	$i=0;
	
	while($i < $num){
		$eventID=mysql_result($result, $i, "eventID");
		$readStatusID=mysql_result($result, $i, "readStatusID");
		
		$query2="SELECT r.status as ReadStatus FROM readStatus as r WHERE r.id=".$readStatusID;
		$result2=mysql_query($query2);
		$status=mysql_result($result2, 0, "ReadStatus");
		
		//echo $status.$readStatus;
		
		if ($status == $readStatus){
			If ($date != NULL){
			$query3="SELECT e.id as eventID, e.title as eventTitle, e.eventDesc as eventDesc, e.location as eventLocation, e.creator as eventCreator, e.dateOfEvent as eventDate FROM event as e WHERE e.id=$eventID AND e.dateOfEvent < $date";}
			else{
			$query3="SELECT e.id as eventID, e.title as eventTitle, e.eventDesc as eventDesc, e.location as eventLocation, e.creator as eventCreator, e.dateOfEvent as eventDate FROM event as e WHERE e.id=$eventID";}
		
			$result3=mysql_query($query3);
			
			$eventTitle=mysql_result($result3, 0, "eventTitle");
			$eventDesc=mysql_result($result3, 0, "eventDesc");
			$eventID=mysql_result($result3, 0, "eventID");
			$eventLocation=mysql_result($result3, 0, "eventLocation");
			$eventCreatorID=mysql_result($result3, 0, "eventCreator");
			$eventDate=mysql_result($result3, 0, "eventDate");
			
			$query4 = "SELECT a.employee as attendee, a.readStatusID as readStatusID From attendees as a WHERE a.event=".$eventID;
			$result4=mysql_query($query4);		
			$num2=mysql_numrows($result4);
			
			$j = 0;
			
			while($j < $num2){
				$attendees .= getEmployeeName(mysql_result($result4, $j, "attendee")).getReadStatus(mysql_result($result4, $j, "readStatusID")).", ";
				$j++;
			}
		
			echo "From: ".getEmployeeName($eventCreatorID)."<br /> Title: ".$eventTitle."<br /> Description: ".$eventDesc."<br /> Location: ".$eventLocation."<br /> To: ".$attendees."<br /><br />";
			
		}
		
		$attendees="";
		
		$i++;
	}

}

function getAllFilesByAccessor($accessor, $date, $readStatus) {
	connectToDatabase();
	
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
		echo $status, $readStatus;
		
		if ($status == $readStatus){
			If ($date !=NULL){
				$query3="SELECT f.fileName as FileName, f.dateUploaded as fileUploadDate, f.uploader as uploaderID, f.filePath as path, f.id as fileID FROM file as f WHERE f.id=$fileID AND f.dateUploaded < $date";
			}
			else {
				$query3="SELECT f.fileName as FileName, f.dateUploaded as fileUploadDate, f.uploader as uploaderID, f.filePath as path, f.id as fileID FROM file as f WHERE f.id=$fileID";
			}
			
			$result3=mysql_query($query3);
			
			$fileName=mysql_result($result3, 0, "FileName");
			$fileDateUploaded=mysql_result($result3, 0, "fileUploadDate");
			$fileUploaderID=mysql_result($result3, 0, "uploaderID");
			$filePath=mysql_result($result3, 0, "path");
			$fileID=mysql_result($result3, 0, "fileID");
			
			$query4="SELECT f.readStatus as readStatusID, f.security as accessorID FROM fileAccess as f WHERE f.file=".$fileID;
			$result4=mysql_query($query4);		
			$num2=mysql_numrows($result4);
			
			echo mysql_result($result4, $j, "readStatusID");
			
			$j = 0;
			
			while($j < $num2){
				$accessors.=getEmployeeName(mysql_result($result4, $j, "accessorID"))." ".getReadStatus(mysql_result($result4, $j, "readStatusID")).", ";
				$j++;
			}
		
			echo "Uploaded by: ".getEmployeeName($fileUploaderID)."<br /> File Name: ".$fileName."<br /> File path: ".$filePath."<br /> To: ".$accessors."<br /><br />";
			$accessors ="";
		}	
		$i++;
	}
}

function getAllFilesByUploader($uploaderID, $date){
	
	connectToDatabase();
	
	If ($date !=NULL){
		$query="SELECT f.fileName as fileName, f.dateUploaded as fileUploadDate, f.uploader as uploaderID, f.filePath as path, f.id as fileID FROM file as f WHERE f.uploader=$uploaderID AND f.dateUploaded < $date";
		}
	else {
		$query="SELECT f.fileName as fileName, f.dateUploaded as fileUploadDate, f.uploader as uploaderID, f.filePath as path, f.id as fileID FROM file as f WHERE f.uploader=$uploaderID";
		}
	
	$result = mysql_query($query);
	
	$num = mysql_numrows($result);
	

	
	$i=0;
	
	while($i < $num){
		$fileName=mysql_result($result, $i, "fileName");
		$fileDateUploaded=mysql_result($result, $i, "fileUploadDate");
		$fileUploaderID=mysql_result($result, $i, "uploaderID");
		$filePath=mysql_result($result, $i, "path");
		$fileID=mysql_result($result, $i, "fileID");
		

		
		$query2="SELECT f.security as accessorID, f.readStatus as readStatusID FROM fileAccess as f WHERE f.file=".$fileID;
		

		
		$result2=mysql_query($query2);
		
		$num2=mysql_numrows($result2);
		
		$j = 0;
		

		
		while($j < $num2){
			$accessors.=getEmployeeName(mysql_result($result2, $j, "accessorID"))." ".getReadStatus(mysql_result($result2, $j, "readStatusID")).", ";
			$j++;
		}
		
		
		
		echo "Uploaded by: ".getEmployeeName($fileUploaderID)."<br /> File Name: ".$fileName."<br /> File path: ".$filePath."<br /> To: ".$accessors."<br /><br />";
		$accessors = "";
		$i++;
		
	}
	
}

function getAllEventsByCreator($creatorID, $date){
	connectToDatabase();
	
	If ($date != NULL){
		$query="SELECT e.id as eventID, e.title as eventTitle, e.eventDesc as eventDesc, e.location as eventLocation, e.creator as eventCreator, e.dateOfEvent as eventDate FROM event as e WHERE e.creator=$creatorID AND e.dateOfEvent < $date ";}
	else{
		$query="SELECT e.id as eventID, e.title as eventTitle, e.eventDesc as eventDesc, e.location as eventLocation, e.creator as eventCreator, e.dateOfEvent as eventDate FROM event as e WHERE e.creator=$creatorID";}
		
	$result=mysql_query($query);
	
	$num=mysql_numrows($result);
	
	$i=0;
	
	while($i < $num){
		$eventTitle=mysql_result($result, $i, "eventTitle");
		$eventDesc=mysql_result($result, $i, "eventDesc");
		$eventID=mysql_result($result, $i, "eventID");
		$eventLocation=mysql_result($result, $i, "eventLocation");
		$eventCreatorID=mysql_result($result, $i, "eventCreator");
		$eventDate=mysql_result($result, $i, "eventDate");
		
		$query2 = "SELECT a.employee as attendee, a.readStatus as readStatusID From attendees as a WHERE a.event=".$eventID;
		$result2=mysql_query($query2);		
		$num2=mysql_numrows($result2);

		$j = 0;
			
		while($j < $num2){
			$attendees .= getEmployeeName(mysql_result($result2, $j, "attendee")).getReadStatus(mysql_result($result2, $j, "readStatusID")).", ";
			$j++;
		}
		
		echo "From: ".getEmployeeName($eventCreatorID)."<br /> Title: ".$eventTitle."<br /> Description: ".$eventDesc."<br /> Location: ".$eventLocation."<br /> To: ".$attendees."<br /><br />";
		$attendees="";
		$i++;
	}
}

function getReadStatus($readStatusID) {
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

function getAllMessages($sender, $reciever, $readStatus) //Populates an array of Employees
{
	

	
	//Connect to database
	connectToDatabase();
	
	/*$whereSender = " TRUE ";
	
	if ($sender != 0) {$whereSender = " $sender=m.sender ";}
	
	echo $sender;
	echo $whereSender;*/
	
	$query="SELECT m.message as message, m.id as messageID, m.sender as sender, recipients.readStatus as statusID FROM message as m  
	LEFT JOIN recipients ON m.id = recipients.message 
	WHERE ($sender=m.sender AND $reciever = recipients.employee)";
	 
	 
	$result=mysql_query($query);
	
	$num=mysql_numrows($result);
		
		
	//	mysql_close();
			
		$i=0;
		while ($i < $num) {
				$recip = "";
				$message=mysql_result($result,$i,"message");
				$messageID=mysql_result($result,$i,"messageID");
				$sender=mysql_result($result, $i, "sender");
				$statusID=mysql_result($result, $i, "statusID");
				echo $statusID;
				
				$query3="SELECT r.status as stats FROM readStatus as r WHERE r.id=".$statusID;
				$result3=mysql_query($query3);
				$status=msql_result($result3, 0, "stats");
				
				if ($status == $readStatus){
				
					$query2="SELECT r.employee as recip FROM recipients as r WHERE r.message=".$messageID;
					$result2=mysql_query($query2);
					
					$num2=mysql_numrows($result2);
					
					$j=0;
					
					while($j < $num2){
						$recip.=", ".mysql_result($result2, $j, "recip");
						$j++;
					}				
				}
				
				echo "From: ".$sender."<br /> Message: ".$message."<br /> To: ".$recip."<br />".$statusID."<br /><br />";
				
		$i++;
		}
	
}



function uploadFile() //TO-DO
{
	//TO DO
	//Upload file to directory
	
	//Add details to database (user, title, details etc)
	
	//return confirmation of upload
}

function deleteFile($fileName) {
	mysql_connect("localhost", "thevoidc_cti", "cti2013") or die(mysql_error());
	mysql_select_db("thevoidc_titan") or die(mysql_error());
	
	$query="SELECT f.id as fileID FROM file as f WHERE f.fileName='".$fileName."'";
	$result=mysql_query($query);
	$fileID=mysql_result($result, 0, "fileID");
	
	echo $fileID."<br />";
	
	/*$query="SELECT f.id as fileID FROM file as f WHERE f.fileName='".$fileName."'";
	$result=(mysql_query($query));
	
	$fileID=mysql_result($result, 0, "fileID");
	
	$query2="SELECT f.readStatus as readStatusID f.id as fileAccessID FROM fileAccess as f WHERE f.file=".$fileID;
	$result2=mysql_query($query2);
	
	$num=mysql_numrows($result2);
	
	$i=0;
	
	while($i<$num){
		$fileAccessID=mysql_result($result2, $i, "fileAccessID");
		$readStatusID=mysql_result($result2, $i, "readStatusID");
		
		$query3="DELETE FROM fileAccess WHERE fileAccess.id=".$fileAccessID;
		mysql_query($query3);
		
		$query4="DELETE FROM readStatus WHERE readStatus.id=".$readStatusID;
		mysql_query($query4);
		$i++;
	}*/
	
	
	/*$query5="DELETE FROM file WHERE file.fileName='".$fileName."'";
	echo "delete: ".$query5."<br />";
	mysql_query("DELETE FROM file WHERE file.fileName='".$fileName."'");*/
}

function addFile($fileName, $fileDateUploaded, $uploaderID, $filePath, &$accessors) {
	 
	mysql_connect("localhost", "thevoidc_cti", "cti2013") or die(mysql_error());
	mysql_select_db("thevoidc_titan") or die(mysql_error());
	
	$query="INSERT INTO file (fileName, dateUploaded, uploader, filePath) VALUES ('".$fileName."', '".$fileDateUploaded."', '".$uploaderID."', '".$filePath."')";
	echo "add: ".$query ."<br />";
	mysql_query($query);
	$fileID = mysql_insert_id();
	
	echo "size of accessors: ".sizeof($accessors)."<br />";
	
	for ($i=0; $i<sizeof($accessors);$i++){
		$query2="INSERT INTO readStatus (status, dateRead, readType) VALUES ('0', '".$fileDateUploaded."', '1')";
		mysql_query($query2);
		
		$readStatusID=mysql_insert_id();
		
		$query3="INSERT INTO fileAccess (file, security, readStatus) VALUES('".$fileID."', '".$accessors[$i]."', '".$readStatusID."')";
		echo "File Access : ".$query3."<br />";
		mysql_query($query3);		
	}

}

function currentDate(){
	$today=mktime(date("G"), date("i"), date("s"), date("m"), date("d"), date("y"));
	//echo date("M",$today);
	return $today;
}

function updateFileSeenStatus($personID, $fileName, $modeOfAccess){
	connectToDatabase();
		
	$query="SELECT f.id as fileID FROM file as f WHERE f.fileName='".$fileName."'";
	$result=mysql_query($query);
	$fileID=mysql_result($result, 0, "fileID");
	
	echo $fileID."<br />";
	
	$query2="SELECT f.readStatus as readStatusID FROM fileAccess as f WHERE f.security=".$personID." AND f.file=".$fileID;
	$result2=mysql_query($query2);
	
	$readStatusID=mysql_result($result2, 0, "readStatusID");
	
	$query3="UPDATE readStatus 
	SET status=1, dateRead=".currentDate().", readType=".$modeOfAccess." 
	WHERE readStatus.id=".$readStatusID;
	
	mysql_query($query3);
	
}


/*function connectToDatabase() //Connect to database
{
	//Set credentials
	$db_username = "thevoidc_cti";
	$db_password = "cti2013";
	$db_database = "thevoidc_titan";


	//Connection

	$dbh=mysql_connect ('localhost',$db_username,
	$db_password) or die('Cannot connect to the database because: ' . mysql_error());
	mysql_select_db($db_database) or die( "Cannot Connect");



}*/

?>