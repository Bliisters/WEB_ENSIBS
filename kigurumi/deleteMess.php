<?php
session_start();
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
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
if(isset($_POST['ID_message']) && is_numeric($_POST['ID_message']) && isset($_POST['table']) && preg_match('/^[a-zA-Z]+$/', $_POST['table'])) {
  $bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
  $bdd->query('DELETE FROM ' . $_POST['table'] . ' WHERE ID_message = ' . $_POST['ID_message']);
}
?>
