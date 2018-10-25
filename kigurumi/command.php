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
			Panier
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


			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="flex-w flex-m w-full-sm">
					<div class="size11 bo4 m-r-10">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code" placeholder="Coupon Code">
					</div>

					<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<!-- Button -->
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Utiliser coupon
						</button>
					</div>
				</div>

				<div class="size10 trans-0-4 m-t-10 m-b-10">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Vérifier Panier
					</button>
				</div>
			</div>

			<!-- Total -->
			<form action="command.php" method="post">
			<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
				<h5 class="m-text20 p-b-24">
					Total Panier
				</h5>

				<!--  -->
				<div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						Sous-Total:
					</span>

					<span class="m-text21 w-size20 w-full-sm" id="subtotal"><?php echo $subtotal; ?>€</span>
				</div>

				<!--  -->
				<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
					<span class="s-text18 w-size19 w-full-sm">
						Livraison:
					</span>

					<div class="w-size20 w-full-sm">

						<span class="s-text19">
							Méthode de livraison
						</span>

						<?php
						$standard_shipping=4.99;
						$prio_shipping=14.99;
						$free_shipping=0;
						?>

						<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
							<select class="selection-2" name="type_livraison" required>
								<option value=<?php echo $standard_shipping; ?>>Standard : +<?php echo $standard_shipping; ?>€</option>
								<option value=<?php echo $prio_shipping; ?>>Prioritaire : +<?php echo $prio_shipping; ?>€</option>
								<?php if($subtotal>100.00){
								echo '<option value='.$free_shipping.'>Gratuite : +'.$free_shipping.'€</option>';
								}?>
							</select>
						</div>

            <div class="size13 bo4 m-b-12">
            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="nom-livrason" placeholder="Nom" required>
            </div>

            <div class="size13 bo4 m-b-12">
            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="prenom-livrason" placeholder="Prenom" required>
            </div>

						<div class="size13 bo4 m-b-12">
						<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="ville" placeholder="Ville" required>
						</div>

						<div class="size13 bo4 m-b-22">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="number" name="cp" placeholder="Code Postal" required>
						</div>

            <div class="size13 bo4 m-b-12">
            <input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="Adresse" placeholder="Adresse" required>
            </div>

						<div class="size14 trans-0-4 m-b-10">
							<!-- Button -->
							<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
								Mettre à jour
							</button>
						</div>
					</div>
				</div>

				<!--  -->
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<span class="m-text21 w-size20 w-full-sm" id="total"><?php echo $subtotal; ?>€</span>
				</div>

				<div class="size15 trans-0-4">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit">
						Commander
					</button>
				</div>
			</div>
		</div>
	</form>
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
