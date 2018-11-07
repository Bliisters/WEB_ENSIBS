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
    <div class="mess-container">
    <?php
    $bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');

		$reponse = $bdd->query('SELECT * FROM messagescontact WHERE Type IN (SELECT Type FROM employees WHERE ID_User = ' . $_SESSION["ID"] . ') ORDER BY ID_message DESC');
    $req = $bdd->prepare('SELECT Type FROM employees WHERE ID_User = :id');
		$req2 = $bdd->prepare('SELECT Nom,Prenom FROM users WHERE ID = :id');
		$reponse2 = $bdd->query('SELECT * FROM messagesanon');

		while($donnees2 = $reponse2->fetch()){
			echo 'Message de  ' . $donnees2['nom'] . ' , email : ' . $donnees2['adresse'] . ' , tel : ' . $donnees2['tel'] . '. Contenu : ' . $donnees2['message'] . '<br />';
		}
    while ($donnees = $reponse->fetch())
    {
      $req->execute(array(
          'id' => $donnees['ID_envoi']));
			$count = $req->rowCount();
			if($count>0){
				$resultat = $req->fetch();
	     echo 'Message de  ' . $resultat['Type'] . ' : ' . $donnees['message'] . '<br />';
			}
			else{
				$req2->execute(array(
	          'id' => $donnees['ID_envoi']));
				$count = $req2->rowCount();
				if($count>0){
					$resultat = $req2->fetch();
		     echo 'Message de  ' . $resultat['Nom'] . ' ' . $resultat['Prenom'] . ' : ' . $donnees['message'] . '<br />';
				}
			}

    }
		$req->closeCursor();
		$req2->closeCursor();
		$reponse->closeCursor();
		$reponse2->closeCursor();
      ?>
      </div>
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
