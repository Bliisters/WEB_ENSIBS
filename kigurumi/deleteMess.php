<?php
session_start();
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  $date = getdate();
  $log = "[" + $date['mday'] + "/" + $date['mon'] + "/" + $date['year'] + " " + $date['hours'] + ":" + $date['minutes'] + ":" + $date['seconds'] + "] "
  + "deleteMess.php unauthorized access" + "\n";
  file_put_contents('logs/access.log', $log, FILE_APPEND);
  header('location: index.php');
  exit;
}

else{
  $bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
  $req = $bdd->prepare('SELECT ID FROM employees WHERE ID_User = :id AND Type= "Admin"');
  $req->execute(array(
      'id' => $_SESSION['ID']));
  $count = $req->rowCount();
  if(!($count>0)){
    header('location: index.php');
    exit;
  }
  $req->closeCursor();
  
}

if(isset($_POST['ID_message']) && is_numeric($_POST['ID_message']) && isset($_POST['table']) && preg_match('/^[a-zA-Z_]+$/', $_POST['table'])) {
  $bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
  $bdd->query('DELETE FROM ' . $_POST['table'] . ' WHERE ID_message = ' . $_POST['ID_message']);
}
else {
  $date = getdate();
  $log = "[" + $date['mday'] + "/" + $date['mon'] + "/" + $date['year'] + " " + $date['hours'] + ":" + $date['minutes'] + ":" + $date['seconds'] + "] "
  + "deleteMess.php wrong arguments: ID_message=" + (isset($_POST['ID_message'])) ? $_POST['ID_message'] : "" + "    table=" + (isset($_POST['table'])) ? $_POST['table'] : "" + "\n";
  file_put_contents('logs/access.log', $log, FILE_APPEND);
}
?>
