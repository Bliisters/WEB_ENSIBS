<?php
session_start();

if(!isset($_SESSION['ID']) || !is_numeric($_SESSION['ID']) ) {
  header('location: index.php');
  exit;
}
else{
  $bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
  $req = $bdd->prepare('SELECT ID FROM employees WHERE ID_User = :id');
  $req->execute(array(
      'id' => $_SESSION['ID']));
  $count = $req->rowCount();
  if(!($count>0)){
    header('location: index.php');
    exit;
  }
  $req->closeCursor();

}
?>

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
<script type="text/javascript">

function lireMess(ID)
{
 var ID_message=ID;

 if(ID_message)
 {
	$.ajax({
	type: 'post',
	url: 'lireMess.php',
	data: {
	 'ID_message':ID_message,
	 'table':'messagescontact'
	},
	success: function (response) {
	 $( '#display_message' ).html(response);
	}
	});
 }
}
function lireMessAnon(ID)
{
 var ID_message=ID;

 if(ID_message)
 {
	$.ajax({
	type: 'post',
	url: 'lireMess.php',
	data: {
	 'ID_message':ID_message,
	 'table':'messagesanon'
	},
	success: function (response) {
	 $( '#display_message' ).html(response);
	}
	});
 }
}

 function deleteMess(ID){
	 var ID_message=ID;

	 if(ID_message)
	 {
		$.ajax({
		type: 'post',
		url: 'deleteMess.php',
		data: {
		 'ID_message':ID_message,
		 'table':'messagescontact'
		},
		success: function (response) {
		 location.reload();
		}
		});
 	 }
}
function deleteMessAnon(ID){
  var ID_message=ID;

  if(ID_message)
  {
   $.ajax({
   type: 'post',
   url: 'deleteMess.php',
   data: {
    'ID_message':ID_message,
    'table':'messagesanon'
   },
   success: function (response) {
    location.reload();
   }
   });
  }
}

</script>
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
	<div class="message_table">
    <div class="mess-container">
    <?php
    $bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');

		$reponse = $bdd->query('SELECT * FROM messagescontact WHERE Type IN (SELECT Type FROM employees WHERE ID_User = ' . $_SESSION["ID"] . ') ORDER BY ID_message DESC');
    $req = $bdd->prepare('SELECT Type FROM employees WHERE ID_User = :id');
		$req2 = $bdd->prepare('SELECT Nom,Prenom FROM users WHERE ID = :id');
		$reqAnon = $bdd->query('SELECT Type FROM employees WHERE ID_User = ' . $_SESSION["ID"] . '');
		$res=$reqAnon->fetch();
		$reponse2 = $bdd->query('SELECT * FROM messagesanon');
		if($res['Type']=='Admin'){

	?><table  CLASS="tableMess">
		<caption CLASS='caption'>Messages de non-utilisateurs</caption>
	 	<tr >
      <th CLASS='tableTR'>nom</th>
      <th CLASS='tableTR'>email</th>
      <th CLASS='tableTR'>téléphone</th>
			<th CLASS='tableTR'>Message</th>
      <th CLASS='tableTR'>Suppression</th>
   	</tr>

	 <?php
		while($donnees2 = $reponse2->fetch()){
			?>
			<tr CLASS='tableTR'>
				<td ><?php echo$donnees2['nom'];?></td>
				<td ><?php echo$donnees2['adresse'];?></td>
				<td ><?php echo$donnees2['tel'];?></td>
				<td ONCLICK='lireMessAnon(<?php echo $donnees2['ID_message'];?>)'>Lire message</td>
				<td ONCLICK='deleteMessAnon(<?php echo $donnees2['ID_message'];?>)'> supprimer</td>
			</tr>
			<?php
		}
	}
		?> <?php if($res['Type']=='Admin'){ ?> </table> <?php } ?>

		<table CLASS="tableMess">
			<caption CLASS='caption'>Messages d'utilisateurs</caption>
   		<tr>
      	<th CLASS='tableTR'>Message de :</th>
      	<th CLASS='tableTR'>Message</th>
      	<th CLASS='tableTR'>Suppression</th>
   		</tr>

	 <?php
		while ($donnees = $reponse->fetch())
    {
      $req->execute(array(
          'id' => $donnees['ID_envoi']));
			$count = $req->rowCount();
			if($count>0){
				$resultat = $req->fetch();?>
				<tr CLASS='tableTR'>
					<td ><?php echo $resultat['Type'];?></td>
					<td ONCLICK='lireMess(<?php echo $donnees['ID_message'];?>)'><?php echo'Lire message'?></td>
					<td ONCLICK='deleteMess(<?php echo $donnees['ID_message'];?>)'> supprimer</td>
				</tr><?php
			}
			else{
				$req2->execute(array(
	          'id' => $donnees['ID_envoi']));
				$count = $req2->rowCount();
				if($count>0){
					$resultat = $req2->fetch();
					?>
					<tr CLASS='tableTR'>
						<td ><?php echo $resultat['Nom'] . ' ' . $resultat['Prenom'];?></td>
						<td ONCLICK='lireMess(<?php echo $donnees['ID_message'];?>)'><?php echo'Lire message'?></td>
						<td ONCLICK='deleteMess(<?php echo $donnees['ID_message'];?>'>supprimer</td>
					</tr>
					<?php
				}
			}
    }

		?>

		</table> <?php
		$req->closeCursor();
		$req2->closeCursor();
		$reponse->closeCursor();
		$reponse2->closeCursor();
		$reqAnon->closeCursor();
      ?>


      </div>
			<div class='display_message' id="display_message">
				<?php echo' Vos messages apparaîtront ici'?>
			</div>
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
