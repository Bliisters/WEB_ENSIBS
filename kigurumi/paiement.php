<?php
session_start();
if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || !isset($_GET['ID']) || !is_numeric($_GET['ID'])) {
  header('location: index.php');
  exit;
}
 ?>
<!DOCTYPE html>
<html>

<head>
  <title>Credit Card</title>

  <!-- Styles -->
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/paiement.css">
  <meta name="robots" content="noindex,follow" />
</head>

<body>
    <form class="credit-card" action="paiement-post.php?ID=<?php echo $_GET['ID']; ?>" method="post">
      <div class="form-header">
        <h4 class="title">Informations de paiement</h4>
      </div>

      <div class="form-body">
        <!-- Card Number -->
        <input type="text" class="card-number" placeholder="Card Number" required>

        <!-- Date Field -->
        <div class="date-field">
          <div class="month">
            <select name="Month" required>
              <option value="january">January</option>
              <option value="february">February</option>
              <option value="march">March</option>
              <option value="april">April</option>
              <option value="may">May</option>
              <option value="june">June</option>
              <option value="july">July</option>
              <option value="august">August</option>
              <option value="september">September</option>
              <option value="october">October</option>
              <option value="november">November</option>
              <option value="december">December</option>
            </select>
          </div>
          <div class="year">
            <select name="Year" required>
              <option value="2018">2018</option>
              <option value="2019">2019</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
              <option value="2023">2023</option>
              <option value="2024">2024</option>
            </select>
          </div>
        </div>

        <!-- Card Verification Field -->
        <div class="card-verification">
          <div class="cvv-input">
            <input type="text" placeholder="CVV" required>
          </div>
          <div class="cvv-details">
            <p>3 or 4 digits usually found <br> on the signature strip</p>
          </div>
        </div>

        <!-- Buttons -->
        <button type="submit" class="proceed-btn"><a>Payer</a></button>
        <button type="submit" class="paypal-btn"><a>Payer via</a></button>
      </div>
    </form>
</body>

</html>
