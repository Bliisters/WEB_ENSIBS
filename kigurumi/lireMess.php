<?php
session_start();
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('location: index.php');
  exit;
}

if( isset( $_POST['ID_message'] ) && is_numeric($_POST['ID_message']) )
{

  $id = $_POST['ID_message'];
  if(!is_numeric($id)) exit();
  $bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
  $reponse = $bdd->query('SELECT message FROM messagescontact WHERE ID_message = ' . $id . '');
  while ($donnees = $reponse->fetch())
  {
    echo "<p>" . htmlspecialchars($donnees['message'], ENT_QUOTES, 'UTF-8') . "</p>";
  }

}
?>
