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


function getAllMessages() //Populates an array of Employees
{
	

	
	//Connect to database
	connectToDatabase();
	
		$query="SELECT m.id as messID, m.sender as sentID, r.employee as recipID, m.message FROM message as m, recipients as r WHERE m.id=r.message";
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
		
	//	mysql_close();
			
		$i=0;
		while ($i < $num) {
			
			
					$recip=mysql_result($result,$i,"recipID");
					$id=mysql_result($result,$i,"sentID");
					$messID=mysql_result($result,$i,"messID");
					
					
				//loop through recipients
						$query3="SELECT employee, message FROM recipients WHERE message=".$messID;
						$result3=mysql_query($query3);
						$num3=mysql_numrows($result3);
						$x=0;
						while($x< $num3)
						{
							$emp[$x]=mysql_result($result3,$x,"employee");
							$x++;
						}
						
						
						
						$query4="SELECT firstName FROM employees WHERE id=".$id;
						$result4=mysql_query($query4);
						$num4=mysql_numrows($result4);
						$first = mysql_result($result4,0,"firstName");	
				
		
				
				//$dateSsnt=mysql_result($result,$i,"dateSent");
				$message=mysql_result($result,$i,"message");
				//$sender=mysql_result($result,$i,"sender");
				//$recip=mysql_result($result,$i,"recip");
				
				
				
				$h = 0;
				while($h < $x)
				{
						$query2="SELECT firstName FROM employees WHERE id=".$emp[$h];
						$result2=mysql_query($query2);
						$num2=mysql_numrows($result2);
						$recipN = $recipN.", ".mysql_result($result2,$h,"firstName");
					$h++;
				}
				

				
				echo "<br /><Br /><br />Sent by: ".$id." - ".$first."<br />Message: ".$message."<br />Sent TO: ".$recipN;
				
				
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




?>