<?php if (session_status() == PHP_SESSION_NONE) {
  session_start();
} ?>

<!-- Header -->
<header class="header1">
  <!-- Header desktop -->
  <div class="container-menu-header">
    <div class="topbar">
      <div class="topbar-social">
        <a href="https://www.fb.me/KigurumiEtLeursAmis" class="topbar-social-item fa fa-facebook"></a>
        <a href="https://www.instagram.com/kigurumietleursamis/" class="topbar-social-item fa fa-instagram"></a>
        <a href="https://www.pinterest.fr/kigurumicontact/" class="topbar-social-item fa fa-pinterest-p"></a>
        <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
        <a href="https://www.youtube.com/channel/UCo5PHPtBjv9CYNmpUiYXv-Q" class="topbar-social-item fa fa-youtube-play"></a>
      </div>

      <span class="topbar-child1">
        Livraison gratuite pour toute commande supérieure à 100€
      </span>

      <div class="topbar-child2">
        <span class="topbar-email">
          <?php if(isset($_SESSION['Nom']) && isset($_SESSION['Prenom'])){
            echo $_SESSION['Nom'].' '.$_SESSION['Prenom'];
          } ?>
        </span>

        <div class="topbar-language rs1-select2">
          <select class="selection-1" name="time">
            <option>EUR</option>
          </select>
        </div>
      </div>
    </div>

    <div class="wrap_header">
      <!-- Logo -->
      <a href="index.php" class="logo">
        <img src="images/icons/logoKA.png" alt="IMG-LOGO">
      </a>

      <!-- Menu -->
      <div class="wrap_menu">
        <nav class="menu">
          <ul class="main_menu">
            <li class="sale-noti">
              <a href="index.php">Accueil</a>
            </li>

            <li>
              <a href="product.php">Produits</a>
              <ul class="sub_menu">
                <li><a href="product.php?type=Kigurumi">Kigurumi</a></li>
                <li><a href="product.php?type=Chausson">Chausson</a></li>
                <li><a href="product.php?type=Bonnet">Bonnet</a></li>
              </ul>
            </li>

            <li>
              <a href="about.php">A propos</a>
            </li>

            <li>
              <a href="contact.php">Contact</a>
            </li>
          </ul>
        </nav>
      </div>

      <!-- Header Icon -->
      <div class="header-icons">
        <a href="account.php" class="header-wrapicon1 dis-block">
          <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
        </a>
      </div>
    </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
      <!-- Logo moblie -->
      <a href="index.php" class="logo-mobile">
        <img src="images/icons/logoKA.png" alt="IMG-LOGO">
      </a>

      <!-- Button show menu -->
      <div class="btn-show-menu">
        <!-- Header Icon mobile -->
        <div class="header-icons-mobile">
          <a href="account.php" class="header-wrapicon1 dis-block">
            <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
          </a>


          </div>
        </div>

        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
        </div>
      </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu" >
      <nav class="side-menu">
        <ul class="main-menu">
          <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
            <span class="topbar-child1">
              Livraison gratuite pour toute commande supérieure à 100€
            </span>
          </li>

          <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
            <div class="topbar-child2-mobile">
              <span class="topbar-email">
                <?php if(isset($_SESSION['Nom']) && isset($_SESSION['Prenom'])){
                  echo $_SESSION['Nom'].' '.$_SESSION['Prenom'];
                } ?>
              </span>

              <div class="topbar-language rs1-select2">
                <select class="selection-1" name="time">
                  <option>EUR</option>
                </select>
              </div>
            </div>
          </li>

          <li class="item-topbar-mobile p-l-10">
            <div class="topbar-social-mobile">
              <a href="https://www.fb.me/KigurumiEtLeursAmis" class="topbar-social-item fa fa-facebook"></a>
              <a href="https://www.instagram.com/kigurumietleursamis/" class="topbar-social-item fa fa-instagram"></a>
              <a href="https://www.pinterest.fr/kigurumicontact/" class="topbar-social-item fa fa-pinterest-p"></a>
              <a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
              <a href="https://www.youtube.com/channel/UCo5PHPtBjv9CYNmpUiYXv-Q" class="topbar-social-item fa fa-youtube-play"></a>
            </div>
          </li>

          <li class="item-menu-mobile">
            <a href="index.php">Accueil</a>
          </li>

          <li class="item-menu-mobile">
            <a href="product.php">Produits</a>
            <ul class="sub-menu">
              <li><a href="product.php?type=Kigurumi">Kigurumi</a></li>
              <li><a href="product.php?type=Chausson">Chausson</a></li>
              <li><a href="product.php?type=Bonnet">Bonnet</a></li>
            </ul>
            <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
          </li>

          <li class="item-menu-mobile">
            <a href="about.php">A propos</a>
          </li>

          <li class="item-menu-mobile">
            <a href="contact.html">Contact</a>
          </li>

        </ul>
      </nav>
    </div>
    <script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
      function clickRemove(nameProduct){
          jQuery(function($) {
              $.ajax( {
                  url : "add_to_cart.php?remove=" + nameProduct,
                  type : "GET",
                  success : function(data) {
                      swal(nameProduct, "a été retiré !", "success");
                      update_entete();
                      }
                  });
              });
      }
      function update_entete(){
          jQuery(function($) {
              $.ajax( {
                  url : "entete-data.php?notif",
                  type : "GET",
                  success : function(data) {
                      $('#entete_notif').html(data);
                      $('#entete_notif_m').html(data);
                  }
            });
            $.ajax( {
                url : "entete-data.php?data",
                type : "GET",
                success : function(data) {
                    $('#entete_data').html(data);
                    $('#entete_data_m').html(data);
                }
          });
          $.ajax( {
              url : "entete-data.php?total",
              type : "GET",
              success : function(data) {
                  $('#entete_total').html(data);
                  $('#entete_total_m').html(data);
              }
        });
        });
      }
      update_entete();
    </script>
  </header>
