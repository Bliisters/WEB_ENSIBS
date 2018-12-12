<?php
session_start();
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || !isset($_SESSION['isadmin']) || !$_SESSION['isadmin']) {
  header('location: index.php');
  exit;
}
?>
