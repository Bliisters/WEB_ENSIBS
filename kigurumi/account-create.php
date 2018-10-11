<!DOCTYPE html>

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
			Création de compte
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-b-30">

          <?php
          if(isset($_POST['name']) AND isset($_POST['prenom']) AND isset($_POST['email']) AND isset($_POST['birthday']) AND isset($_POST['password']) AND isset($_POST['civilite'])){
            if($_POST['name']!=null AND $_POST['prenom']!=null AND $_POST['birthday']!=null AND $_POST['email']!=null AND $_POST['password']!=null AND $_POST['civilite']!=null)
            {
							$bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
							$req = $bdd->prepare('SELECT COUNT(ID) FROM users WHERE Mail = ?');
							$req->execute(array($_POST['email']));
							$donnees =  $req->fetch();


							if($donnees['COUNT(ID)'] == 1){
								echo'
		            <form class="leave-comment" action="account-create.php" method="post">
		  						<h4 class="m-text26 p-b-36 p-t-15">
		  							Saisissez vos informations
		  						</h4>

		  						<div class="bo4 of-hidden size15 m-b-20">
		  							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Nom*" value="'.$_POST['name'].'">
		  						</div>

		              <div class="bo4 of-hidden size15 m-b-20">
		  							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="prenom" placeholder="Prénom*" value="'.$_POST['prenom'].'">
		  						</div>

									<div class="bo4 of-hidden size15 m-b-20">
										<select class="sizefull s-text7 p-l-22 p-r-22" name="civilite">
										<option value="homme">Homme</option>
										<option value="femme">Femme</option>
										</select>
									</div>

		              <div>Date de naissance*</div>
		              <div class="bo4 of-hidden size15 m-b-20">
		                <input class="sizefull s-text7 p-l-22 p-r-22" type="date" name="birthday" value="'.$_POST['birthday'].'">
		              </div>

		  						<div class="bo4 of-hidden size15 m-b-20">
		  							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone-number" placeholder="Numéro de téléphone" value="'.$_POST['phone-number'].'">
		  						</div>

		  						<div class="bo4 of-hidden size15 m-b-20">
		  							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Adresse mail*" value="'.$_POST['email'].'">
		  						</div>

		              <div class="bo4 of-hidden size15 m-b-20">
		                <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password" placeholder="Mot de passe*" value="'.$_POST['password'].'">
		              </div>

		              <div class="bo4 of-hidden size15 m-b-20">
		                <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password-confirmation" placeholder="Mot de passe (confirmation)*">
		              </div>

		              <div style="color:red" class="m-text15 p-b-36 p-t-15">
		                Un compte avec cet email a déjà été créé.
		              </div>

		  						<div class="w-size25">
		  							<!-- Button -->
		  							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
		  								S\'inscrire
		  							</button>
		  						</div>

		              <div class="s-text7">
		                Les informations (*) sont obligatoires
		              </div>
		  					</form>';
							}
							else{
								if($_POST['password'] != $_POST['password-confirmation']){
									echo'
			            <form class="leave-comment" action="account-create.php" method="post">
			  						<h4 class="m-text26 p-b-36 p-t-15">
			  							Saisissez vos informations
			  						</h4>

			  						<div class="bo4 of-hidden size15 m-b-20">
			  							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Nom*" value="'.$_POST['name'].'">
			  						</div>

			              <div class="bo4 of-hidden size15 m-b-20">
			  							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="prenom" placeholder="Prénom*" value="'.$_POST['prenom'].'">
			  						</div>

										<div class="bo4 of-hidden size15 m-b-20">
											<select class="sizefull s-text7 p-l-22 p-r-22" name="civilite">
											<option value="homme">Homme</option>
											<option value="femme">Femme</option>
											</select>
										</div>

			              <div>Date de naissance*</div>
			              <div class="bo4 of-hidden size15 m-b-20">
			                <input class="sizefull s-text7 p-l-22 p-r-22" type="date" name="birthday" value="'.$_POST['birthday'].'">
			              </div>

			  						<div class="bo4 of-hidden size15 m-b-20">
			  							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone-number" placeholder="Numéro de téléphone" value="'.$_POST['phone-number'].'">
			  						</div>

			  						<div class="bo4 of-hidden size15 m-b-20">
			  							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Adresse mail*" value="'.$_POST['email'].'">
			  						</div>

			              <div class="bo4 of-hidden size15 m-b-20">
			                <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password" placeholder="Mot de passe*" value="'.$_POST['password'].'">
			              </div>

			              <div class="bo4 of-hidden size15 m-b-20">
			                <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password-confirmation" placeholder="Mot de passe (confirmation)*">
			              </div>

			              <div style="color:red" class="m-text15 p-b-36 p-t-15">
			                Le mot de passe et la confirmation ne sont pas identiques.
			              </div>

			  						<div class="w-size25">
			  							<!-- Button -->
			  							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
			  								S\'inscrire
			  							</button>
			  						</div>

			              <div class="s-text7">
			                Les informations (*) sont obligatoires
			              </div>
			  					</form>';
								}
								else{
									echo '<h4 class="m-text26 p-b-36 p-t-15">Votre compte a été créé</h4>';
									$req=$bdd->prepare('INSERT INTO users (Civilite, Nom, Prenom, DateNaissance, Telephone, Mail, MotDePasse)
										VALUES (:civilite,:name,:prenom,:birthday,:telephone,:email,:password)');
										$req->execute(array(
											'civilite' => $_POST['civilite'],
											'name' =>$_POST['name'],
											'prenom' => $_POST['prenom'],
											'birthday' => $_POST['birthday'],
											'telephone' => $_POST['phone-number'],
											'email' => $_POST['email'],
											'password' => $_POST['password']));
								}
							}
							$req->closeCursor();
            }
            else
            {
  					echo'
            <form class="leave-comment" action="account-create.php" method="post">
  						<h4 class="m-text26 p-b-36 p-t-15">
  							Saisissez vos informations
  						</h4>

  						<div class="bo4 of-hidden size15 m-b-20">
  							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Nom*" value="'.$_POST['name'].'">
  						</div>

              <div class="bo4 of-hidden size15 m-b-20">
  							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="prenom" placeholder="Prénom*" value="'.$_POST['prenom'].'">
  						</div>

							<div class="bo4 of-hidden size15 m-b-20">
								<select class="sizefull s-text7 p-l-22 p-r-22" name="civilite">
								<option value="homme">Homme</option>
								<option value="femme">Femme</option>
								</select>
							</div>

              <div>Date de naissance*</div>
              <div class="bo4 of-hidden size15 m-b-20">
                <input class="sizefull s-text7 p-l-22 p-r-22" type="date" name="birthday" value="'.$_POST['birthday'].'">
              </div>

  						<div class="bo4 of-hidden size15 m-b-20">
  							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone-number" placeholder="Numéro de téléphone" value="'.$_POST['phone-number'].'">
  						</div>

  						<div class="bo4 of-hidden size15 m-b-20">
  							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Adresse mail*" value="'.$_POST['email'].'">
  						</div>

              <div class="bo4 of-hidden size15 m-b-20">
                <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password" placeholder="Mot de passe*" value="'.$_POST['password'].'">
              </div>

              <div class="bo4 of-hidden size15 m-b-20">
                <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password-confirmation" placeholder="Mot de passe (confirmation)*">
              </div>

              <div style="color:red" class="m-text15 p-b-36 p-t-15">
                Informations incomplètes
              </div>

  						<div class="w-size25">
  							<!-- Button -->
  							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
  								S\'inscrire
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
						$mail = "exemple@exemple.exemple";
						if(isset($_POST["mail"]) && $_POST["mail"]!=null) {
							$mail = $_POST["mail"];
						}
          echo'
          <form class="leave-comment" action="account-create.php" method="post">
            <h4 class="m-text26 p-b-36 p-t-15">
              Saisissez vos informations
            </h4>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Nom*">
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="prenom" placeholder="Prénom*">
            </div>

						<div class="bo4 of-hidden size15 m-b-20">
							<select class="sizefull s-text7 p-l-22 p-r-22" name="civilite">
							<option value="homme">Homme</option>
							<option value="femme">Femme</option>
							</select>
						</div>

            <div>Date de naissance*</div>
            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="date" name="birthday">
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="phone-number" placeholder="Nuémro de téléphone">
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="email" name="email" placeholder="Adresse mail*" value="'.$mail.'">
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password" placeholder="Mot de passe*">
            </div>

            <div class="bo4 of-hidden size15 m-b-20">
              <input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password-confirmation" placeholder="Mot de passe (confirmation)*">
            </div>

            <div class="w-size25">
              <!-- Button -->
              <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
                S\'inscrire
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
