<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

<link href="StyleSheet_Employee_CT.css" rel="stylesheet" type="text/css" />



<? include('titan.php');
include('insert_modules.php');?>

</head>





    <div id="container">









            <div id="header_img">

            	<a><img src="img/Logo_white.png" width="100%" height="auto"/></a>



            </div>



            <div  class="feed_box">



            	<?



                $type = $_GET["type"];

                $sender = $_GET["sender"];

                $date = $_GET["date"];

                $user = $_GET["user"];

                $read = $_GET["read"];

                $status = $_GET["status"];

                if($type=="sent") getAllMessagesSentBy($user,$date);

                else if($type=="inbox") getAllMessagesSentTo($user,$date,$read,$sender);

                else if($type=="projects"){
                  echo "Projects: <br/>";
                  $p = getAssignedProjects($user);

                  foreach($p as $project){
                    foreach($project as $key=>$property){
                      echo $key . ": ". $property . "<br />";
                    }
                  }

                }

                else if($type=="tasks"){
                  echo "Tasks: <br/>";
                  $t = getAssignedTasks($user, $status);

                  foreach($t as $task){
                    foreach($task as $key=>$property){
                      echo $key . ": ". $property . "<br />";
                    }
                  }

                }

            	?>



            	</div>



         	<div class="msg_bar"></div>



            <div clss="login">



            </div>









    </div>

<body >





	<table width='800px'>

		<tr><td height='600px'>&nbsp</td></tr>

	<tr><td align='center' valign='center'>

		<br/>		<br/>		<br/>		<br/>		<br/>		<br/>









	</td></tr>

	</table>





</body>

</html>

