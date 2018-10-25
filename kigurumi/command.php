<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Panier</title>
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
  <?php include("entete-command.php"); ?>

  <!-- Title Page -->
  <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-kigurumi.png);">
    <h2 class="l-text2 t-center">
      Commande
    </h2>
  </section>

  <!-- Cart -->
  <section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
      <!-- Cart item -->
      <div class="container-table-cart pos-relative">
        <div class="wrap-table-shopping-cart bgwhite">
          <table class="table-shopping-cart">
            <tr class="table-head">
              <th class="column-1"></th>
              <th class="column-2">Produit</th>
              <th class="column-3">Prix</th>
              <th class="column-4 p-l-70">Quantité</th>
              <th class="column-5">Total</th>
            </tr>

            <?php
            if(isset($_SESSION['cart']))
            {
              $subtotal = 0.00;
              for ($i=0; $i < count($_SESSION['cart']); $i++) {
                $item = $_SESSION['cart'][$i];
                $total = round($item['prix']*$item['quantite'], 2);
                $subtotal = $subtotal + $total;
                echo '<tr class="table-row">
                <td class="column-1">
                <div class="cart-img-product b-rad-4 o-f-hidden">
                <img src="images/'.$item['img'].'" alt="IMG-PRODUCT">
                </div>
                </td>
                <td class="column-2">'.$item['nom'].'</td>
                <td class="column-3">'.$item['prix'].'€</td>
                <td class="column-4">
                <div class="flex-w bo5 of-hidden w-size17">
                <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                </button>

                <input class="size8 m-text18 t-center num-product" type="number" name="num-product'.($i+1).'" value="'.$item['quantite'].'">

                <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                </button>
                </div>
                </td>
                <td class="column-5">'.$total.'€</td>
                </tr>';
              }
            }
            else{
              $subtotal=0.00;
            }
            ?>
          </table>
        </div>
      </div>
    </section>

    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m">
      <span data-toggle="modal" data-target="#modal-video-01">
        <i href="" class="fa fa-play" aria-hidden="true"></i>
        Passer la commande
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

    <!-- Modal Video 01-->
  	<div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">

  		<div class="modal-dialog" role="document" data-dismiss="modal">
  			<div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

  			<div class="wrap-video-mo-01">
  				<div class="w-full wrap-pic-w op-0-0"><img src="images/icons/video-16-9.jpg" alt="IMG"></div>
  				<div class="video-mo-01">
  					<iframe src="https://www.youtube.com/embed/jIPj2OST_lg?ecver=2" allowfullscreen allow="autoplay; encrypted-media"></iframe>
  				</div>
  			</div>
  		</div>
  	</div>

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
