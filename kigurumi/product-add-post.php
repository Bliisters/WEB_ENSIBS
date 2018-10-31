<?php

if(isset($_FILES['image']) AND $_FILES['image']['error'] == 0){
  if ($_FILES['file']['size'] <= 1000000){
    // Testons si l'extension est autorisée
    $infosfichier = pathinfo($_FILES['image']['name']);
    $extension_upload = $infosfichier['extension'];
    $extensions_autorisees = array('jpg', 'jpeg', 'png');
    if (in_array($extension_upload, $extensions_autorisees))
    {
      // On peut valider le fichier et le stocker définitivement
      move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . basename($_FILES['image']['name']));

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
        'nom' => htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8'),
        'type' =>htmlspecialchars($_POST['type'], ENT_QUOTES, 'UTF-8'),
        'imageName' => htmlspecialchars($_FILES['image']['name'], ENT_QUOTES, 'UTF-8'),
        'quantite' => htmlspecialchars($_POST['number'], ENT_QUOTES, 'UTF-8'),
        'prix' => htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8'),
        'description' => htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8')));

        header('Location: index.php');
      }
      else{
        header('Location: product-add.php');
      }
    }
    else{
      header('Location: product-add.php');
    }
  }
  else{
    header('Location: product-add.php');
  }
  ?>
