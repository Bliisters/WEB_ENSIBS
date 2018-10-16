<?php

try
{
  $bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}

$req=$bdd->prepare('INSERT INTO comments (ID_products, ID_users, Titre, Commentaire)
VALUES (:id_products,:id_users,:titre,:commentaire)');

$req->execute(array(
  'id_products' => htmlspecialchars($_POST['id-product'], ENT_QUOTES, 'UTF-8'),
  'id_users' =>htmlspecialchars($_POST['id-user'], ENT_QUOTES, 'UTF-8'),
  'titre' => htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8'),
  'commentaire' => htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8')));

header('Location: product-detail.php?ID='.$_POST['id-product'])

  ?>
