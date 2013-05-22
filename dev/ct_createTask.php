<?

  require_once('insert_modules.php');
  require_once('titan.php');
  require_once('modules.php');

  $json = $_POST['data'];
  $data = json_decode(str_replace("\\","", $json),true);

  $title = $_POST['taskTitle'];
  $desc = $_POST['message'];
  $date = $_POST['taskWhen'];
  $assignor = $_POST['current'];
  $start = currentDate();
  $employees = array();

  foreach($data as $i){
    if($i['type']=='person'){
      array_push($employees,$i['id']);
    }else{
      $result = getEmployeesInDepartment($i['id']);
      $num=mysql_numrows($result);
		  for($j=0;$j<$num;$j++){
				array_push($employees, mysql_result($result,$j,'employee'));
      }
    }
  }


  echo 'Title: ' . $title . '<br/>';
  echo 'Assignor: ' . $assignor . '<br/>';
  echo 'Due: ' . $date . '<br/>';
  echo 'Description: ' . $desc . '<br/>';
  echo 'Start: ' . $start . '<br/>';
  foreach($employees as $i){
    echo 'Assigned to: ' . $i . '<br/>';
  }

  createTask($title,$desc,$start,$due,$assignor,$employees);


?>
<script>
  window.location="index.php";
</script>