<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Product Detail</title>
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

	<!-- Ajout de la base de donnée -->

	<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	$reponse = $bdd->prepare('SELECT * FROM products WHERE ID = :id');
	$reponse->execute(array(':id' => $_GET['ID']));
	while ($donnees = $reponse->fetch())
	{
		?>

		<!-- breadcrumb -->
		<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
			<a href="index.php" class="s-text16">
				Accueil
				<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
			</a>

			<a href="product.php" class="s-text16">
				Produits
				<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
			</a>

			<a href="product.php?type=<?php echo $donnees['Type']; ?>" class="s-text16">
				<?php echo $donnees['Type']; ?>
				<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
			</a>

			<span class="s-text17">
				<?php echo $donnees['Nom']; ?>
			</span>
		</div>

		<!-- Product Detail -->
		<div class="container bgwhite p-t-35 p-b-80">
			<div class="flex-w flex-sb">
				<div class="w-size13 p-t-30 respon5">
					<div class="wrap-slick3 flex-sb flex-w">
						<div class="wrap-slick3-dots"></div>

						<div class="slick3">
							<div class="item-slick3" data-thumb="images/<?php echo $donnees['ImageName']; ?>">
								<div class="wrap-pic-w">
									<img src="images/<?php echo $donnees['ImageName']; ?>" alt="IMG-PRODUCT">
								</div>
							</div>

							<div class="item-slick3" data-thumb="images/thumb-item-02.jpg">
								<div class="wrap-pic-w">
									<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">
								</div>
							</div>

							<div class="item-slick3" data-thumb="images/thumb-item-03.jpg">
								<div class="wrap-pic-w">
									<img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="w-size14 p-t-30 respon5">
					<h4 class="product-detail-name m-text16 p-b-13">
						<?php echo $donnees['Nom']; ?>
					</h4>

					<span class="m-text17">
						<?php echo $donnees['Prix']; ?>€
					</span>

					<p class="s-text8 p-t-10">
						Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
					</p>

					<!--  -->
					<div class="p-t-33 p-b-60">
						<div class="flex-m flex-w p-b-10">
							<div class="s-text15 w-size15 t-center">
								Taille
							</div>

							<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
								<select class="selection-2" name="size">
									<option>Choisissez votre taille !</option>
									<option> M (taille unique)</option>
								</select>
							</div>
						</div>

						<!-- <div class="flex-m flex-w">
						<div class="s-text15 w-size15 t-center">
						Color
					</div>
					<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
					<select class="selection-2" name="color">
					<option>Choose an option</option>
					<option>Gray</option>
					<option>Red</option>
					<option>Black</option>
					<option>Blue</option>
				</select>
			</div>
		</div> -->

		<div class="flex-r-m flex-w p-t-10">
			<div class="w-size16 flex-m flex-w">
				<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
					<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
						<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
					</button>

					<input class="size8 m-text18 t-center num-product" type="number" name="num-product" value="1">

					<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
						<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
					</button>
				</div>

				<div class="btn-addcart-product-detail size12 trans-0-4 m-t-10 m-b-10">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Ajouter au panier
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="p-b-45">
		<span class="s-text8 m-r-35">ID : <?php echo $donnees['ID']; ?></span>
		<span class="s-text8">Catégorie : <?php echo $donnees['Type']; ?></span>
	</div>

	<!--  -->
	<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
		<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
			Description
			<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
			<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
		</h5>

		<div class="dropdown-content dis-none p-t-15 p-b-23">
			<p class="s-text8">
				<?php echo $donnees['Description']; ?>
			</p>
		</div>
	</div>

	<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
		<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
			Informations supplémentaires
			<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
			<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
		</h5>

		<div class="dropdown-content dis-none p-t-15 p-b-23">
			<p class="s-text8">
				Le saviez-vous ? Nous n'avons pas encore ce champs dans notre bdd
			</div>
		</div>

		<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
			<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">

				<?php
			}
			$reponse->closeCursor();
			?>



			<?php
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
			}
			catch (Exception $e)
			{
				die('Erreur : ' . $e->getMessage());
			}
			$reponse2 = $bdd->prepare('SELECT comments.Titre, comments.Commentaire, users.Prenom FROM products, users, comments WHERE products.ID = :id AND products.ID=comments.ID_products AND users.ID=comments.ID_users GROUP BY comments.ID');
			$reponse2->execute(array(':id' => $_GET['ID']));
			$number = $reponse2->rowCount()
			?>



			Commentaires (<?php echo $number ?>)
			<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
			<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
		</h5>

		<?php
		while ($donnees2 = $reponse2->fetch())
		{
			?>


			<div class="dropdown-content dis-none p-t-15 p-b-23">
				<p class="s-text8">


					<b><?php echo $donnees2['Titre']; ?></b>
					<br>
					<?php echo $donnees2['Commentaire']; ?>
					<br>
					<i><?php echo $donnees2['Prenom']; ?></i>
					<br>
				</p>
				<?php
			}
			$reponse2->closeCursor();

				if (isset($_SESSION["loggedin"])){
					  ?>

						<div class="dropdown-content dis-none p-t-15 p-b-23">
						<form class="leave-comment" action="product-detail-post.php" method="post">

						Votre avis nous intéresse !

						<div class="bo4 of-hidden size15 m-b-20">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="title" placeholder="Titre*" required>
						</div>

						<input type="hidden" name="id-product" value="<?php echo $_GET['ID']; ?>">
						<input type="hidden" name="id-user" value="<?php echo $_SESSION['ID']; ?>">

						<div class="bo4 of-hidden size15 m-b-20">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="comment" placeholder="Commentaire*" required>
						</div>

						<div class="w-size25">
						<!-- Button -->
						<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
						Commenter
						</button>
						</div>
						</form>
		</div>

		<?php } ?>

		</div>
	</div>
</div>
</div>
</div>
</div>
</div>





<!-- Relate Product -->
<section class="relateproduct bgwhite p-t-45 p-b-138">
	<div class="container">
		<div class="sec-title p-b-60">
			<h3 class="m-text5 t-center">
				Produits Similaires
			</h3>
		</div>

		<!-- Slide2 -->
		<div class="wrap-slick2">
			<div class="slick2">

				<?php
				$reponse = $bdd->prepare('SELECT * FROM products WHERE ID NOT LIKE :id LIMIT 0, 20');
				$reponse->execute(array(':id' => $_GET['ID']));
				while ($donnees = $reponse->fetch())
				{
					?>


					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
								<img src="images/<?php echo $donnees['ImageName']; ?>" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
											Ajouter
										</button>
									</div>
								</div>
							</div>

							<div class="block2-txt p-t-20">
								<a href="product-detail.php?ID=<?php echo $donnees['ID']; ?>" class="block2-name dis-block s-text3 p-b-5">
									<?php echo $donnees['Nom']; ?>
								</a>

								<span class="block2-price m-text6 p-r-5">
									<?php echo $donnees['Prix']; ?> €
								</span>
							</div>
						</div>
					</div>

					<?php
				}
				$reponse->closeCursor();
				?>

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
<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
	$('.block2-btn-addcart').each(function(){
		var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		$(this).on('click', function(){
			jQuery(function($) {
	        $.ajax( {
	            url : "add_to_cart.php?add=" + nameProduct,
	            type : "GET",
	            success : function(data) {
	                swal(nameProduct, "is added to cart !", "success");
	            }
	        });
	    });
			update_entete();
		});
	});
	$('.block2-btn-addwishlist').each(function(){
		var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
		$(this).on('click', function(){
			swal(nameProduct, "is added to wishlist !", "success");
		});
	});
	$('.btn-addcart-product-detail').each(function(){
		var nameProduct = $('.product-detail-name').html();
		$(this).on('click', function(){
			jQuery(function($) {
	        $.ajax( {
	            url : "add_to_cart.php?add=" + nameProduct,
	            type : "GET",
	            success : function(data) {
	                swal(nameProduct, "is added to cart !", "success");
	            }
	        });
	    });
			update_entete();
		});
	});
</script>

<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>
