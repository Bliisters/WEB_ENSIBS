<?php
session_start();
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || !isset($_SESSION['isadmin']) || !$_SESSION['isadmin']) {
  $date = getdate();
  $log = "[" + $date['mday'] + "/" + $date['mon'] + "/" + $date['year'] + " " + $date['hours'] + ":" + $date['minutes'] + ":" + $date['seconds'] + "] "
  + "product-delete.php unauthorized access" + "\n";
  file_put_contents('logs/access.log', $log, FILE_APPEND);
  header('location: index.php');
  exit;
}
?>
