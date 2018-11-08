<?php

if( isset( $_POST['ID_message'] ) )
{

$id = $_POST['ID_message'];

$bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
$reponse = $bdd->query('SELECT message FROM messagescontact WHERE ID_message = ' . $id . '');
while ($donnees = $reponse->fetch())
{
echo "<p>" . $donnees['message'] . "</p>";
}

}
?>
