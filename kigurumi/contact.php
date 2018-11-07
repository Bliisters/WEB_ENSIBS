<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Contact</title>
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
			Contact
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-b-30">
					<div class="p-r-20 p-r-0-lg">
						<div class="contact-map size21" id="google_map" data-map-x="47.644708" data-map-y="-2.748415" data-pin="images/icons/icon-position-mapKA.png" data-scrollwhell="0" data-draggable="1"></div>
					</div>
				</div>

				<div class="col-md-6 p-b-30">

						<?php
						$bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
						if(isset($_SESSION["loggedin"]) AND isset($_POST['message'])){
							if($_POST['message']!=null){
								if(isset($_POST['destinataire']) AND $_POST['destinataire']!=null){
									$req = $bdd->prepare('SELECT ID FROM employees WHERE Type = :type');
									$req->execute(array(
										'type' => $_POST['destinataire']));
									$id_dest = (int)$req->fetch();
									if($id_dest!=null){
										$req=$bdd->prepare('INSERT INTO messagescontact (ID_envoi, ID_destination, message)
										VALUES (:envoi,:destination,:message)');
										$req->execute(array(
											'envoi' => $_SESSION['ID'],
											'destination' =>$id_dest,
											'message' => htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8'),
										));
									}
								}
							else{
								$req=$bdd->prepare('INSERT INTO messagescontact (ID_envoi, message)
								VALUES (:envoi,:message)');
								$req->execute(array(
									'envoi' => $_SESSION['ID'],
									'message' => htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8'),
								));
							}
							echo '<h4 class="m-text26 p-b-36 p-t-15">Votre message a été envoyé</h4>';
						}
					}
					elseif(isset($_POST['name']) AND isset($_POST['phone-number']) AND isset($_POST['email'])){
						if($_POST['name']!=null AND $_POST['phone-number']!=null AND $_POST['email']!=null)
						{

							echo '<h4 class="m-text26 p-b-36 p-t-15">Votre message a été envoyé</h4>';

						}
							else{

								echo '
								<form class="leave-comment" action="contact.php" method="post">
									<h4 class="m-text26 p-b-36 p-t-15">
										Envoyez nous votre message
									</h4>

									<div class="bo4 of-hidden size15 m-b-20">
										<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Nom complet*" value="'.$_POST['name'].'">
									</div>

									<div class="bo4 of-hidden size15 m-b-20">
										<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone-number" placeholder="Numéro de téléphone*" value="'.$_POST['phone-number'].'">
									</div>

									<div class="bo4 of-hidden size15 m-b-20">
										<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Adresse mail*" value="'.$_POST['email'].'">
									</div>

									<textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Message">
										'.$_POST['message'].'
									</textarea>

									<div style="color:red" class="m-text15 p-b-36 p-t-15">
										Informations incomplètes
									</div>

									<div class="w-size25">
										<!-- Button -->
										<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
											Envoyer
										</button>
									</div>

									<div class="s-text7">
										Les informations (*) sont obligatoires
									</div>
								</form>';
							}
						}
						else
						{
							echo '
							<form class="leave-comment" action="contact.php" method="post">
								<h4 class="m-text26 p-b-36 p-t-15">
									Envoyez nous votre message
								</h4>';

								if(!isset($_SESSION["loggedin"])){

								echo'
								<div class="bo4 of-hidden size15 m-b-20">
									<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Nom complet*">
								</div>

								<div class="bo4 of-hidden size15 m-b-20">
									<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone-number" placeholder="Numéro de téléphone*">
								</div>

								<div class="bo4 of-hidden size15 m-b-20">
									<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Adresse mail*">
								</div>';

							}

							elseif(isset($_SESSION["loggedin"])){
								$req = $bdd->prepare('SELECT ID FROM employees WHERE ID = :id');
								$req->execute(array(
								    'id' => $_SESSION['ID']));
								$resultat = (int) $req->fetch();
								if($_SESSION['ID'] == $resultat){

									echo'
									<p>Bonjour. Souhaitez-vous consulter <a href="view-messages.php">vos messages</a> ?</p>
									<div class="bo4 of-hidden size15 m-b-20">
										<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="destinataire" placeholder="Destinataire*">
									</div>';
								}
							}
							if(isset($_POST['destinataire'])){
								echo $_POST['destinataire'];
							}
							echo'
								<textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Message"></textarea>

								<div class="w-size25">
									<!-- Button -->

									<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
										Send
									</button>
								</div>

								<div class="s-text7">
									Les informations (*) sont obligatoires
								</div>
							</form>';
						}
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
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="js/map-custom.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
