<?php
session_start();
$redirect = 'account-profile.php';
if(isset($_GET['location'])){
	if(preg_match('@^[^/%\\\.]+\.php(\?[a-zA-Z_]+=[a-zA-Z0-9]+)?$@', $_GET['location'])) {
		$redirect = $_GET['location'];
	}
	else {
		$date = getdate();
		$log = "[" . $date['mday'] . "/" . $date['mon'] . "/" . $date['year'] . " " . $date['hours'] . ":" . $date['minutes'] . ":" . $date['seconds'] . "] "
		. "account.php wrong location: " . $_GET['location'] . "\n";
		file_put_contents('logs/access.log', $log, FILE_APPEND);
	}
}
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	if(!isset($_SESSION['isadmin'])) {
		$bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '') or die();
		$req = $bdd->prepare('SELECT ID FROM employees WHERE ID_User = :id AND Type = \'Admin\'');
		$req->execute(array(
				'id' => $_SESSION['ID']));
		$count = $req->rowCount();
		if($count>0) {
			$_SESSION['isadmin'] = true;
		}
		else {
			$_SESSION['isadmin'] = false;
		}
	}
	header('location: '.$redirect);
	exit;
}

if(isset($_POST['email-account']) && isset($_POST['password-account']) && $_POST['email-account'] != NULL && $_POST['password-account'] != NULL){
	if(!filter_var($_POST['email-account'], FILTER_VALIDATE_EMAIL)) {
		$date = getdate();
		$log = "[" . $date['mday'] . "/" . $date['mon'] . "/" . $date['year'] . " " . $date['hours'] . ":" . $date['minutes'] . ":" . $date['seconds'] . "] "
		. "account.php not an email address" . "\n";
		file_put_contents('logs/access.log', $log, FILE_APPEND);
		//afficher une erreur ?
	}
	else {
		$bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '') or die();
		$req = $bdd->prepare('SELECT * FROM users WHERE Mail = ?');

		$req->execute(array($_POST['email-account']));
		$donnees = $req->fetch();
		if(isset($donnees['ID']) && password_verify($_POST['password-account'], $donnees['MotDePasse'])){
			session_start();
			$_SESSION['loggedin'] = true;
			$_SESSION['Nom'] = $donnees['Nom'];
			$_SESSION['Prenom'] = $donnees['Prenom'];
			$_SESSION['ID'] = $donnees['ID'];
			$_SESSION['token'] = rand(5, 999999999);
			$req = $bdd->prepare('SELECT ID FROM employees WHERE ID_User = :id AND Type = \'Admin\'');
			$req->execute(array(
					'id' => $_SESSION['ID']));
			$count = $req->rowCount();
			if($count>0) {
				$_SESSION['isadmin'] = true;
			}
			else {
				$_SESSION['isadmin'] = false;
			}
			header('location: '.$redirect);
			exit;
		}
		else{
			$error = true;
		}
	}
}
//}
?>

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
			Compte client
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 p-b-30">
					<h4 class="m-text26 p-b-36 p-t-15">
						Vous n'avez pas encore de compte ?
					</h4>

					<form method="post" action="account-create.php">
						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="email" name="mail" placeholder="Adresse mail">
						</div>

						<div class="w-size25">
							<!-- Button -->
							<button type="submit" class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
								S'inscrire
							</button>
						</div>
					</form>
				</div>

				<div class="col-md-6 p-b-30" style="background-color:#CCCCCC">
					<div class="p-r-20 p-r-0-lg">
						<h4 class="m-text26 p-b-36 p-t-15">
							Vous avez déjà un compte client ?
						</h4>

						<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<div class="bo4 of-hidden size15 m-b-20">
								<input class="sizefull s-text7 p-l-22 p-r-22" type="email" name="email-account" placeholder="Adresse mail">
							</div>

							<div class="bo4 of-hidden size15 m-b-20">
								<input class="sizefull s-text7 p-l-22 p-r-22" type="password" name="password-account" placeholder="Mot de passe">
							</div>

							<?php  if(isset($error)) {
								echo '<div style="color:red" class="m-text15 p-b-36 p-t-15">
								Le nom d\'utilisateur ou le mot de passe est incorrect.
								</div>';
							}
							?>

							<div class="w-size25">
								<!-- Button -->
								<button type="submit" class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
									Se connecter
								</button>
							</div>
						</form>
					</div>
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
