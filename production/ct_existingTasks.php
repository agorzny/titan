<?

  require_once('titan.php');

  connectToDatabase();
  $query="SELECT * FROM task WHERE status <> 1";
	$result=mysql_query($query);

  $tasks = array();

  $num=mysql_numrows($result);

  for($i=0;$i<$num;$i++){
    $id=mysql_result($result,$i,"id");
    $name=mysql_result($result,$i,"taskName");
    $desc=mysql_result($result,$i,"taskDesc");

    $entry = array('id'=>$id,'title'=>$name,'desc'=>$desc, 'type'=>'existing');
    array_push($tasks,$entry);
  }

  $json = json_encode($tasks);
  echo $json;

?>