<!DOCTYPE html>
<?php session_start(); ?>
<html lang="fr">
<head>
  <title>Profile</title>
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

  <!-- Title Page -->
  <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-kigurumi.png);">
    <h2 class="l-text2 t-center">
      Ajout de produit
    </h2>
  </section>

  <!-- content page -->
  <section class="bgwhite p-t-66 p-b-60">
    <div class="container">
      <div class="row">
        <div class="col-md-6 p-b-30">


          <form class="leave-comment" action="product-add-post.php" method="post" enctype="multipart/form-data">
            <h4 class="m-text26 p-b-36 p-t-15">
              Saisissez les informations du produit
            </h4>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Nom du produit*" required>
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <select class="sizefull s-text7 p-l-22 p-r-22" name="type">
                <option value="kigurumi">Kigurumi</option>
                <option value="chausson">Chausson</option>
                <option value="kit">Kit</option>
                <option value="accessoire">Accessoire</option>
                <option value="bonnet">Bonnet</option>
              </select>
            </div>

            <div>Quantite*</div>
            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="number" step="1" name="number" min="1" required>
            </div>

            <div>Prix*</div>
            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="number" step="0.01" name="price" min="0.01" required>
            </div>

            <div >
              <textarea name="description" placeholder="Description du produit*" rows="8" cols="45" required></textarea>
            </div>

            <div>Image du produit*</div>
            <div class="bo4 of-hidden size15 m-b-20">
              <input type="file" name="image" required />
            </div>

            <div class="w-size25">
              <!-- Button -->
              <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
                Ajouter
              </button>
            </div>

            <div class="s-text7">
              Les informations (*) sont obligatoires
            </div>
          </form>

        </div>
      </div>
    </div>
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
  </script>
  <!--===============================================================================================-->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
  <script src="js/map-custom.js"></script>
  <!--===============================================================================================-->
  <script src="js/main.js"></script>

</body>
</html>
