<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Commande Detail</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!--===============================================================================================-->
</head>
<body class="animsition">

  <!-- Header -->
  <?php include("entete.php"); ?>

  <!-- Cart -->
  <section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
      <!-- Cart item -->
      <div class="bo9 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
        <h5 class="m-text20 p-b-24">
          Informations Produits
        </h5>
      <div class="container-table-cart pos-relative">
        <div class="wrap-table-shopping-cart bgwhite">
          <table class="table-shopping-cart">
            <tr class="table-head">
              <th class="column-1"></th>
              <th class="column-2">Produit</th>
              <th class="column-3 p-l-70">Quantité</th>
            </tr>

            <?php
            if(isset($_GET['ID']))
            {

              try
  						{
  							$bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  						}
  						catch(Exception $e)
  						{
  							die('Erreur : '.$e->getMessage());
  						}

              $reponse_detail = $bdd->prepare('SELECT command_detail.Quantite as Quantite, products.Nom as Nom, products.ImageName as ImageName FROM command_detail, products WHERE command_detail.ID_Commande = :id AND command_detail.ID_Produit = products.ID');
  						$reponse_detail->execute(array(':id' => $_GET['ID']));

              while ($donnees = $reponse_detail->fetch())
  						{

                echo '<tr class="table-row">
                <td class="column-1">
                <div class="cart-img-product b-rad-4 o-f-hidden">
                <img src="images/'.$donnees['ImageName'].'" alt="IMG-PRODUCT">
                </div>
                </td>
                <td class="column-2">'.$donnees['Nom'].'</td>
                <td class="column-3">x'.$donnees['Quantite'].'</td>
                </tr>';
              }
              $reponse_detail->closeCursor();
            }
            ?>
          </table>
        </div>
      </div>
    </div>

      <?php
      $reponse_command = $bdd->prepare('SELECT * FROM command WHERE ID_Commande LIKE :id_command');
      $reponse_command->execute(array(':id_command' => $_GET['ID']));

      while ($donnees = $reponse_command->fetch())
      {

      ?>

      <!-- Total -->
      <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
        <h5 class="m-text20 p-b-24">
          Informations Commande
        </h5>

        <!--  -->
        <div class="flex-w flex-sb-m p-t-26 p-b-30">
          <span class="m-text22 w-size19 w-full-sm">
            Référence:
          </span>

          <span class="m-text21 w-size20 w-full-sm"><?php echo $_GET['ID']; ?></span>

          <span class="m-text22 w-size19 w-full-sm">
            Total:
          </span>

          <span class="m-text21 w-size20 w-full-sm"><?php echo $donnees['Total']; ?>€</span>

          <span class="m-text22 w-size19 w-full-sm">
            Statut:
          </span>

          <span class="m-text21 w-size20 w-full-sm"><?php echo $donnees['Statut']; ?></span>

          <?php

          if($donnees['Statut']=='Non-Payée'){
            echo'
            <div class="size15 trans-0-4">
            <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" onclick="location.href=\'paiement.php?ID='.$_GET['ID'].'\';">
              Payer
            </button>
            </div>';
          }

          ?>

        </div>
      </div>
    </div>

    <?php
    }
    $reponse_command->closeCursor();
    ?>

    </section>


    <!-- Footer -->
    <?php include("pied_de_page.php"); ?>

    <!-- Back to top -->
    <div class="btn-back-to-top bg0-hov" id="myBtn">
      <span class="symbol-btn-back-to-top">
        <i class="fa fa-angle-double-up" aria-hidden="true"></i>
      </span>
    </div>

    <!-- Container Selection -->
    <div id="dropDownSelect1"></div>
    <div id="dropDownSelect2"></div>

    <!--===============================================================================================-->
    <script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
    <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="vendor/select2/select2.min.js"></script>
    <script type="text/javascript">
    $(".selection-1").select2({
      minimumResultsForSearch: 20,
      dropdownParent: $('#dropDownSelect1')
    });

    $(".selection-2").select2({
      minimumResultsForSearch: 20,
      dropdownParent: $('#dropDownSelect2')
    });

    function update_cart(nameProduct, thisNum) {
      jQuery(function($) {
          var quantity = thisNum.val();
          $.ajax( {
              url : "add_to_cart.php?edit=" + nameProduct + "&q=" + quantity,
              type : "GET",
              success : function(data) {
                var oldquantity = data;
                var prix = thisNum.parent().parent().parent().find(".column-3").html();
                prix = prix.substr(0, prix.length-1);
                thisNum.parent().parent().parent().find(".column-5").html(Math.round(prix*thisNum.val()*100)/100+"€");
                var total = $("#total").html().substr(0, $("#total").html().length-1);
                $("#total").html(Math.round((parseFloat(total) + (thisNum.val()-oldquantity)*prix)*100)/100 + "€");
                $("#subtotal").html($("#total").html());
                update_entete();
              }
          });
      });
    }

    $(".num-product").each(function(){
      var nameProduct = $(this).parent().parent().parent().find(".column-2").html();
      var thisNum = $(this);
      $(this).on("input", function(){
        jQuery(function($) {
          var quantity = thisNum.val();
          $.ajax( {
            url : "add_to_cart.php?edit=" + nameProduct + "&q=" + quantity,
            type : "GET",
            success : function(data) {
              var oldquantity = data;
              var prix = thisNum.parent().parent().parent().find(".column-3").html();
              prix = prix.substr(0, prix.length-1);
              thisNum.parent().parent().parent().find(".column-5").html(prix*thisNum.val() + "€");
              var total = $("#total").html().substr(0, $("#total").html().length-1);
              $("#total").html(Math.round((parseFloat(total) + (thisNum.val()-oldquantity)*prix)*100)/100 + "€");
              $("#subtotal").html($("#total").html());
              update_entete();
            }
          });
        });
      });
    });
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

  </body>
  </html>
