<?php

session_start();
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('location: account.php');
  exit;
}

$ID_Commande = time();

try
{
  $bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

$req_detail=$bdd->prepare('INSERT INTO command_detail (ID_Commande, ID_Produit, Quantite)
VALUES (:id_command,:id_product,:quantite)');

$req_add=$bdd->prepare('INSERT INTO command (ID_Commande, ID_User, Ville, CP, Adresse, Total)
VALUES (:id_command,:id_user,:ville,:cp,:adresse,:total)');

$reponse = $bdd->prepare('SELECT * FROM products WHERE Nom = :nom');

if(isset($_SESSION['cart']))
{

  $req_add->execute(array(
    'id_command' => htmlspecialchars($ID_Commande, ENT_QUOTES, 'UTF-8'),
    'id_user' =>htmlspecialchars($_SESSION['ID'], ENT_QUOTES, 'UTF-8'),
    'ville' => htmlspecialchars($_POST['ville'], ENT_QUOTES, 'UTF-8'),
    'cp' => htmlspecialchars($_POST['cp'], ENT_QUOTES, 'UTF-8'),
    'adresse' => htmlspecialchars($_POST['adresse'], ENT_QUOTES, 'UTF-8'),
    'total' => htmlspecialchars($_SESSION['cart_total'], ENT_QUOTES, 'UTF-8')));

  for ($i=0; $i < count($_SESSION['cart']); $i++) {
    $item = $_SESSION['cart'][$i];

    $reponse->execute(array(':nom' => $item['nom']));
    while ($donnees = $reponse->fetch())
  	{
      $ID_Produit=$donnees['ID'];
    }
    $reponse->closeCursor();

    $req_detail->execute(array(
      'id_command' => htmlspecialchars($ID_Commande, ENT_QUOTES, 'UTF-8'),
      'id_product' =>htmlspecialchars($ID_Produit, ENT_QUOTES, 'UTF-8'),
      'quantite' => htmlspecialchars($item['quantite'], ENT_QUOTES, 'UTF-8')));
  }
}

header('Location: command.php')

?>
