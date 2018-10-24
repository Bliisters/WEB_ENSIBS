<?php
session_start();
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('location: account.php');
  exit;
}
if(!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
  $_SESSION['cart_total'] = 0.00;
}
if (isset($_GET['add'])) {
  $qtity = 1;
  if(isset($_GET['q']) && is_numeric($_GET['q'])) {
    $qtity = intval($_GET['q']);
  }
  $item = htmlspecialchars($_GET['add'], ENT_QUOTES, 'UTF-8');
  $bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
  $req = $bdd->prepare('SELECT COUNT(Nom) FROM products WHERE Nom=?');
  $req->execute(array($item));
  $donnees = $req->fetch();
  $req->closeCursor();
  if ($donnees['COUNT(Nom)'] == 1) {
    $found = false;
    for ($i=0; $i < count($_SESSION['cart']) && !$found; $i++) {
      if($_SESSION['cart'][$i]['nom'] == $item) {
        $found = true;
        $_SESSION['cart'][$i]['quantite'] = $_SESSION['cart'][$i]['quantite'] + $qtity;
        $_SESSION['cart_total'] = round($_SESSION['cart_total'] + $_SESSION['cart'][$i]['prix'], 2);
      }
    }
    if(!$found) {
      $req = $bdd->prepare('SELECT Prix, ImageName FROM products WHERE Nom=?');
      $req->execute(array($item));
      $donnees = $req->fetch();
      $req->closeCursor();
      $_SESSION['cart'][] = array('nom' => $item,
                                  'quantite' => $qtity,
                                  'prix' => $donnees['Prix'],
                                  'img' => $donnees['ImageName']);
      $_SESSION['cart_total'] = round($_SESSION['cart_total'] + $donnees['Prix'], 2);
    }
  }
}
elseif (isset($_GET['remove'])) {
  $item = htmlspecialchars($_GET['remove'], ENT_QUOTES, 'UTF-8');
  for ($i=0; $i < count($_SESSION['cart']); $i++) {
    if ($_SESSION['cart'][$i]['nom'] == $item)
    {
      $price = $_SESSION['cart'][$i]['prix'];
      unset($_SESSION['cart'][$i]);
      $_SESSION['cart'] = array_values($_SESSION['cart']);
      $_SESSION['cart_total'] = round($_SESSION['cart_total'] - $price, 2);
    }
  }
}
elseif (isset($_GET['edit']) && isset($_GET['q'])) {
  $item = htmlspecialchars($_GET['edit'], ENT_QUOTES, 'UTF-8');
  $quantity = htmlspecialchars($_GET['q'], ENT_QUOTES, 'UTF-8');
  if(is_numeric($quantity)) {
    for ($i=0; $i < count($_SESSION['cart']); $i++) {
      if ($_SESSION['cart'][$i]['nom'] == $item)
      {
        $oldquantity = $_SESSION['cart'][$i]['quantite'];
        if($oldquantity != floatval($quantity)) {
          $_SESSION['cart'][$i]['quantity'] = floatval($quantity);
          $price = $_SESSION['cart'][$i]['prix'];
          $_SESSION['cart_total'] = round($_SESSION['cart_total'] + $oldquantity * $price, 2);
        }
      }
    }
  }
}
?>
