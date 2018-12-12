<?php
session_start();
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || !isset($_GET['ID']) || !is_numeric($_GET['ID'])) {
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
  'id' => htmlspecialchars($_GET['ID'], ENT_QUOTES, 'UTF-8')));

header('Location: account-profile.php');

?>
