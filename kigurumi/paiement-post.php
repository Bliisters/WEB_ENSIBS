<?php
session_start();
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  $date = getdate();
  $log = "[" + $date['mday'] + "/" + $date['mon'] + "/" + $date['year'] + " " + $date['hours'] + ":" + $date['minutes'] + ":" + $date['seconds'] + "] "
  + "paiement-post.php unauthorized access" + "\n";
  file_put_contents('logs/access.log', $log, FILE_APPEND);
  header('location: index.php');
  exit;
}
if(!isset($_GET['ID']) || !is_numeric($_GET['ID'])) {
  $date = getdate();
  $log = "[" + $date['mday'] + "/" + $date['mon'] + "/" + $date['year'] + " " + $date['hours'] + ":" + $date['minutes'] + ":" + $date['seconds'] + "] "
  + "paiement-post.php wrong ID: " + (isset($_GET['ID'])) ? $_GET['ID'] : "no ID" + "\n";
  file_put_contents('logs/access.log', $log, FILE_APPEND);
  header('location: index.php');
  exit;
}

try
{
  $bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

$req=$bdd->prepare('UPDATE command SET Statut=\'Payée\' WHERE ID_Commande == :id');

$req->execute(array(
  'id' => $_GET['ID']));

header('Location: account-profile.php');

?>
