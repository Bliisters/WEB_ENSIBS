<?php
session_start();
if(isset($_GET['notif']))
{
  if(isset($_SESSION['cart'])) {
    echo count($_SESSION['cart']);
  }
  else{
    echo '0';
  }
}
elseif(isset($_GET['data'])){
  if(isset($_SESSION['cart'])) {
    for ($i=0; $i < count($_SESSION['cart']); $i++) {
      $item = $_SESSION['cart'][$i];
      echo '<li class="header-cart-item">
      <div class="header-cart-item-img" onclick="javascript:clickRemove(\''.$item['nom'].'\')">
        <img src="images/'.$item['img'].'" alt="IMG"/>
      </div>

      <div class="header-cart-item-txt">
      <a href="#" class="header-cart-item-name">
      '.$item['nom'].'
      </a>

      <span class="header-cart-item-info">
      '.$item['quantite'].' x '.$item['prix'].'€
      </span>
      </div>
      </li>';
    }
  }
}
elseif (isset($_GET['total'])) {
  echo 'Total: ' . ((isset($_SESSION['cart_total'])) ? (float)$_SESSION['cart_total'] : '0.00') . '€';
}
?>
