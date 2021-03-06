<?php
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || !isset($_SESSION['isadmin']) || !$_SESSION['isadmin']) {
  $date = getdate();
  $log = "[" . $date['mday'] . "/" . $date['mon'] . "/" . $date['year'] . " " . $date['hours'] . ":" . $date['minutes'] . ":" . $date['seconds'] . "] "
  . "product-add-post.php unauthorized access" . "\n";
  file_put_contents('logs/access.log', $log, FILE_APPEND);
  header('location: account-create.php');
  exit;
}

if(isset($_FILES['image']) && $_FILES['image']['error'] == 0 && preg_match('/^[^\.]+\.(jpg|jpeg|png)$/i', basename($_FILES['image']['name']))){
  if ($_FILES['file']['size'] <= 1000000){
    // Testons si l'extension est autorisée
    $infosfichier = pathinfo($_FILES['image']['name']);
      // On peut valider le fichier et le stocker définitivement
      move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . basename($_FILES['image']['name']));


      if(!isset($_POST['name']) || !isset($_POST['type']) || !isset($_POST['number']) || !is_numeric($_POST['number']) || !isset($_POST['price']) || !is_numeric($_POST['number']) || !isset($_POST['description'])) {
        $date = getdate();
        $log = "[" . $date['mday'] . "/" . $date['mon'] . "/" . $date['year'] . " " . $date['hours'] . ":" . $date['minutes'] . ":" . $date['seconds'] . "] "
        . "product-add-post.php wrong arguments: name=" . (isset($_POST['name'])) ? $_POST['name'] : "" . "    type=" + (isset($_POST['type'])) ? $_POST['type'] : "" .
        "    number=" . (isset($_POST['number'])) ? $_POST['number'] : "" . "    price=" . (isset($_POST['price'])) ? $_POST['price'] : "" . (!isset($_POST['description'])) ? "    no description" : "" . "\n";
        file_put_contents('logs/access.log', $log, FILE_APPEND);
        header('location: product-add.php');
        exit;
      }

      if(!preg_match('/^([a-zA-Z0-9\-]+\040?)+$/', $_POST['name']) || !preg_match('/^([a-zA-Z0-9\-]+\040?)+$/', $_POST['type'])) {
        $date = getdate();
        $log = "[" . $date['mday'] . "/" . $date['mon'] . "/" . $date['year'] . " " . $date['hours'] . ":" . $date['minutes'] . ":" . $date['seconds'] . "] "
        . "product-add-post.php wrong arguments: name=" . $_POST['name'] . "    type=" . $_POST['type'] . "\n";
        file_put_contents('logs/access.log', $log, FILE_APPEND);
        header('location: product-add.php');
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

      $req=$bdd->prepare('INSERT INTO products (Nom, Type, ImageName, Quantite, Prix, Description)
      VALUES (:nom,:type,:imageName,:quantite,:prix,:description)');

      $req->execute(array(
        'nom' => $_POST['name'],
        'type' => $_POST['type'],
        'imageName' => $_FILES['image']['name'],
        'quantite' => $_POST['number'],
        'prix' => $_POST['price'],
        'description' => $bdd->quote($_POST['description'])));

        header('Location: index.php');
    }
    else{
      header('Location: product-add.php');
    }
  }
  else{
    header('Location: product-add.php');
  }
  ?>
