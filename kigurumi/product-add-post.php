<?php
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || !isset($_SESSION['isadmin']) || !$_SESSION['isadmin']) {
  header('location: account-create.php');
  exit;
}

if(isset($_FILES['image']) && $_FILES['image']['error'] == 0 && preg_match('/^[^\.]+\.(jpg|jpeg|png)$/i', basename($_FILES['image']['name']))){
  if ($_FILES['file']['size'] <= 1000000){
    // Testons si l'extension est autorisée
    $infosfichier = pathinfo($_FILES['image']['name']);
      // On peut valider le fichier et le stocker définitivement
      move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . basename($_FILES['image']['name']));


      if(!isset($_POST['name']) || !isset($_POST['type']) || !isset($_POST['number']) || !i_numeric($_POST['number']) || !isset($_POST['price']) || !is_numeric($_POST['number']) || !isset($_POST['description'])) {
        header('location: product-add.php');
        exit;
      }

      if(!preg_match('/^([a-zA-Z0-9\-]+\040?)+$/', $_POST['name']) || !preg_match('/^([a-zA-Z0-9\-]+\040?)+$/', $_POST['type'])) {
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
