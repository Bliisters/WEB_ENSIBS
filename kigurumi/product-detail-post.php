<?php
if(!isset($_POST['id-product']) || !is_numeric($_POST['id-product']) || !isset($_POST['id-user']) || !is_numeric($_POST['id-user']) || !isset($_POST['title']) || !isset($_POST['comment'])) {
  $date = getdate();
  $log = "[" + $date['mday'] + "/" + $date['mon'] + "/" + $date['year'] + " " + $date['hours'] + ":" + $date['minutes'] + ":" + $date['seconds'] + "] "
  + "product-detail-post.php wrong arguments: id-product=" + (isset($_POST['id-product'])) ? $_POST['id-product'] : "" + "    id-user=" + (isset($_POST['id-user'])) ? $_POST['id-user'] : "" +
  "    title=" + (isset($_POST['title'])) ? $_POST['title'] : "" + (isset($_POST['comment'])) ? "" ? "    no comment" + "\n";
  file_put_contents('logs/access.log', $log, FILE_APPEND);
  header('location: index.php');
  exit;
}
if(!preg_match('/^([a-zA-Z0-9\-]+\040?)+$/', $_POST['title'])) {
  $date = getdate();
  $log = "[" + $date['mday'] + "/" + $date['mon'] + "/" + $date['year'] + " " + $date['hours'] + ":" + $date['minutes'] + ":" + $date['seconds'] + "] "
  + "product-add-post.php wrong title: " + ^$_POST['title'] + "\n";
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

$req=$bdd->prepare('INSERT INTO comments (ID_products, ID_users, Titre, Commentaire)
VALUES (:id_products,:id_users,:titre,:commentaire)');

$req->execute(array(
  'id_products' => $_POST['id-product'],
  'id_users' => $_POST['id-user'],
  'titre' => $_POST['title'],
  'commentaire' => $bdd->quote($_POST['comment'])));

header('Location: product-detail.php?ID='.$_POST['id-product'])

  ?>
