<?

  include 'insert_modules.php';
  include 'titan.php';

  $json = $_POST['data'];
  $data = json_decode(str_replace("\\","", $json),true);

  echo "Title: ".$_POST['taskTitle'];
  echo "<br/>";

  foreach($data as $i){
    echo "  Assignee: ".$i['name'];
    echo "<br/>";
  }
  echo "Due: ".$_POST['taskWhen'];
  echo "<br/>";
  echo "Description: ".$_POST['message'];


  $title = $_POST['taskTitle'];
  $desc = $_POST['message'];
  $date = $_POST['taskWhen'];
  $assignor = $_POST['current'];
  $start
?>
