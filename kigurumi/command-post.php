<?php

session_start();
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  $date = getdate();
  $log = "[" . $date['mday'] . "/" . $date['mon'] . "/" . $date['year'] . " " . $date['hours'] . ":" . $date['minutes'] . ":" . $date['seconds'] . "] "
  . "command-post.php unauthorized access" . "\n";
  file_put_contents('logs/access.log', $log, FILE_APPEND);
  header('location: account-create.php');
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
  if(isset($_POST['cp']) && isset($_POST['adresse']) && isset($_POST['ville'])) {
    if(is_numeric($_POST['cp']) && preg_match('/^[a-z0-9\- ]+$/i', $_POST['adresse']) && preg_match('@^[a-z\-/ ]+$@i', $_POST['ville'])) {
      $req_add->execute(array(
      'id_command' => $ID_Commande,
      'id_user' =>$_SESSION['ID'],
      'ville' => $_POST['ville'],
      'cp' => $_POST['cp'],
      'adresse' => $_POST['adresse'],
      'total' => $_SESSION['cart_total']));

      for ($i=0; $i < count($_SESSION['cart']); $i++) {
        $item = $_SESSION['cart'][$i];

        $reponse->execute(array(':nom' => $item['nom']));
        while ($donnees = $reponse->fetch())
      	{
          $ID_Produit=$donnees['ID'];
        }
        $reponse->closeCursor();

        $req_detail->execute(array(
          'id_command' => $ID_Commande,
          'id_product' => $ID_Produit,
          'quantite' => $item['quantite']));
      }
    }
    else {
      $date = getdate();
  		$log = "[" . $date['mday'] . "/" . $date['mon'] . "/" . $date['year'] . " " . $date['hours'] . ":" . $date['minutes'] . ":" . $date['seconds'] . "] "
  		. "command-post.php wrong arguments: cp=" . $_POST['cp'] . "    adresse=" . $_POST['adresse'] . "    ville=" + $_POST['ville'] . "\n";
  		file_put_contents('logs/access.log', $log, FILE_APPEND);
    }
  }
  else {
    $date = getdate();
		$log = "[" . $date['mday'] . "/" . $date['mon'] . "/" . $date['year'] . " " . $date['hours'] . ":" . $date['minutes'] . ":" . $date['seconds'] . "] "
		. "command-post.php no cp or adresse or ville" . "\n";
		file_put_contents('logs/access.log', $log, FILE_APPEND);
  }
}

header('Location: command-detail.php?ID='.$ID_Commande);

?>
