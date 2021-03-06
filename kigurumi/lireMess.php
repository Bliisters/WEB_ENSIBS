<?php
session_start();
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  $date = getdate();
  $log = "[" . $date['mday'] . "/" . $date['mon'] . "/" . $date['year'] . " " . $date['hours'] . ":" . $date['minutes'] . ":" . $date['seconds'] . "] "
  . "lireMess.php unauthorized access" . "\n";
  file_put_contents('logs/access.log', $log, FILE_APPEND);
  header('location: index.php');
  exit;
}
else{
  $bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
  $req = $bdd->prepare('SELECT ID FROM employees WHERE ID_User = :id');
  $req->execute(array(
      'id' => $_SESSION['ID']));
  $count = $req->rowCount();
  if(!($count>0)){
    header('location: index.php');
    exit;
  }
  $req->closeCursor();
}

if( isset( $_POST['ID_message'] ) && is_numeric($_POST['ID_message']) )
{

  $id = $_POST['ID_message'];
  if(!is_numeric($id)) exit();
  $bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
  $reponse = $bdd->query('SELECT message FROM '. $_POST['table'] .' WHERE ID_message = ' . $id . '');
  while ($donnees = $reponse->fetch())
  {
    echo "<p>" . htmlspecialchars($donnees['message'], ENT_QUOTES, 'UTF_8') . "</p>";
  }

}
else {
  $date = getdate();
  $log = "[" . $date['mday'] . "/" . $date['mon'] . "/" . $date['year'] . " " . $date['hours'] . ":" . $date['minutes'] . ":" . $date['seconds'] . "] "
  . "lireMess.php wrong ID_message: " . (isset($_POST['ID_message'])) ? $_POST['ID_message'] : "no ID_message" . "\n";
  file_put_contents('logs/access.log', $log, FILE_APPEND);
}
?>
