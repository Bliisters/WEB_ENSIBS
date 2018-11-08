<?php
if(isset($_POST['ID_message']) && is_numeric($_POST['ID_message']) && isset($_POST['table'])) {
  $bdd = new PDO('mysql:host=localhost;dbname=kigurumi;charset=utf8', 'root', '');
  $bdd->query('DELETE FROM ' . htmlspecialchars($_POST['table'], ENT_QUOTES, 'UTF-8') . ' WHERE ID_message = ' . htmlspecialchars($_POST['ID_message'], ENT_QUOTES, 'UTF-8'));
}
?>
