<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Produits</title>
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
	<link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>
<body class="animsition">

	<!-- Header -->
	<?php include("entete.php"); ?>

	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/heading-pages-kigurumi.png);">
		<h2 class="l-text2 t-center">
			Produits
		</h2>
		<p class="m-text13 t-center">
			Nouvelle Collection Hiver 2019
		</p>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Categories
						</h4>

						<ul class="p-b-54">
							<li class="p-t-4">
								<a href="product.php?type=Kigurumi" class="s-text13 active1">
									Kigurumi
								</a>
							</li>

							<li class="p-t-4">
								<a href="product.php?type=Bonnet" class="s-text13">
									Bonnets
								</a>
							</li>

							<li class="p-t-4">
								<a href="product.php?type=Chausson" class="s-text13">
									Chaussons
								</a>
							</li>

							<li class="p-t-4">
								<a href="product.php?type=Accessoire" class="s-text13">
									Accessoires
								</a>
							</li>

							<li class="p-t-4">
								<a href="product.php?type=Kit" class="s-text13">
									Kits
								</a>
							</li>
						</ul>

						<!--  -->
						<h4 class="m-text14 p-b-32">
							Filtres
						</h4>

						<div class="filter-price p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-17">
								Prix
							</div>

							<div class="wra-filter-bar">
								<div id="filter-bar"></div>
							</div>

							<div class="flex-sb-m flex-w p-t-16">
								<div class="w-size11">
									<!-- Button -->
									<button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">
										Filtrer
									</button>
								</div>

								<div class="s-text3 p-t-10 p-b-10">
									Range: €<span id="value-lower">610</span> - €<span id="value-upper">980</span>
								</div>
							</div>
						</div>

						<form action="product.php" method="get">
							<div class="search-product pos-relative bo4 of-hidden">
								<input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Recherche un produit" <?php if(isset($_GET['search-product'])){echo 'value=\''.$_GET['search-product'].'\'' ;} ?>>

								<button type="submit" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
									<i class="fs-12 fa fa-search" aria-hidden="true"></i>
								</button>

							</div>
						</div>
					</div>

					<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
						<!--  -->
						<div class="flex-sb-m flex-w p-b-35">
							<div class="flex-w">
								<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
									<select class="selection-2" name="sorting">
										<option value="default">Trier par</option>
										<option value="popularity">Popularité</option>
										<option value="mintomax">Prix: min to max</option>
										<option value ="maxtomin">Prix: max to min</option>
									</select>
								</div>
							</div>

							<div class="w-size25">
								<!-- Button -->
								<button class="flex-c-m size15 bg7 bo-rad-15 hov1 s-text14 trans-0-4" type="submit">
									Trier
								</button>
							</div>
						</form>

						<?php
						try
						{
							$bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
						}
						catch(Exception $e)
						{
							die('Erreur : '.$e->getMessage());
						}

						if(isset($_GET['type'])){
							$reponse = $bdd->prepare('SELECT * FROM products WHERE Type LIKE :type');
							$reponse->execute(array(':type' => $_GET['type']));
						}
						elseif(isset($_GET['search-product']) AND isset($_GET['sorting'])){
							if($_GET['sorting']=='popularity'){
								$reponse = $bdd->prepare('SELECT * FROM products WHERE Nom LIKE :name');
								$reponse->execute(array(':name' => '%'.$_GET['search-product'].'%'));
							}
							elseif($_GET['sorting']=='mintomax'){
								$reponse = $bdd->prepare('SELECT * FROM products WHERE Nom LIKE :name ORDER BY Prix');
								$reponse->execute(array(':name' => '%'.$_GET['search-product'].'%'));
							}
							elseif($_GET['sorting']=='maxtomin'){
								$reponse = $bdd->prepare('SELECT * FROM products WHERE Nom LIKE :name ORDER BY Prix DESC');
								$reponse->execute(array(':name' => '%'.$_GET['search-product'].'%'));
							}
							else{
								$reponse = $bdd->prepare('SELECT * FROM products WHERE Nom LIKE :name');
								$reponse->execute(array(':name' => '%'.$_GET['search-product'].'%'));
							}
						}
						else{
							$reponse = $bdd->prepare('SELECT * FROM products');
							$reponse->execute();

						}
						$number = $reponse->rowCount();
						?>

						<span class="s-text8 p-t-5 p-b-5">
							<?php echo $number ?> Résultats - Page <?php echo $number ?>
						</span>
					</div>

					<!-- Product -->
					<div class="row">

						<?php
						while ($donnees = $reponse->fetch())
						{
							?>

							<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
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

					<!-- Pagination -->
					<!--
					<div class="pagination flex-m flex-w p-t-26">
					<a href="#" class="item-pagination flex-c-m trans-0-4">1</a>
					<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
				</div>
			-->

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
<script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
$('.block2-btn-addcart').each(function(){
	var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
	$(this).on('click', function(){
		swal(nameProduct, "is added to cart !", "success");
	});
});

$('.block2-btn-addwishlist').each(function(){
	var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
	$(this).on('click', function(){
		swal(nameProduct, "is added to wishlist !", "success");
	});
});
</script>

<!--===============================================================================================-->
<script type="text/javascript" src="vendor/noui/nouislider.min.js"></script>
<script type="text/javascript">
/*[ No ui ]
===========================================================*/
var filterBar = document.getElementById('filter-bar');

noUiSlider.create(filterBar, {
	start: [ 50, 200 ],
	connect: true,
	range: {
		'min': 50,
		'max': 200
	}
});

var skipValues = [
	document.getElementById('value-lower'),
	document.getElementById('value-upper')
];

filterBar.noUiSlider.on('update', function( values, handle ) {
	skipValues[handle].innerHTML = Math.round(values[handle]) ;
});
</script>
<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>
