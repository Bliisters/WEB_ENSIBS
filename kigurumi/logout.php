<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  header('location: index.php');
  exit;
}
session_destroy();
header('Location: index.php');
?>
