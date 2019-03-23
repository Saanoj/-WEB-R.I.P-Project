<?php
session_start();

//multilingue
if (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = "fr";
}
include "multilingue/multilingue.php";
loadLanguageFromSession($_SESSION['lang']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Secure Payment Form</title>
  <link rel="stylesheet" href="css/simulationPaiement/bootstrap-min.css">
  <link rel="stylesheet" href="css/simulationPaiement/bootstrap-formhelpers-min.css" media="screen">
  <link rel="stylesheet" href="css/simulationPaiement/bootstrapValidator-min.css"/>
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
  <link rel="stylesheet" href="css/simulationPaiement/bootstrap-side-notes.css" />

<?php
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
$backOffice=0;
$type = 1;
$navbar = new App\Navbar($backOffice,$type);
$navbar->navbar();
$trajet = unserialize($_SESSION['trajet']);

$form = new App\Form(array());

if (isset($_POST['price'])) {
  $_SESSION['price'] = $_POST["price"];
  }
  $_SESSION['price'] = sprintf("%.2f",$_SESSION['price']);
  $price = sprintf("%.2f",$_SESSION['price']);
  $price = intval($price)."00";

include 'includehtml/head.html'; ?>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/simulationPaiement/bootstrap-min.js"></script>
<script src="js/simulationPaiement/bootstrap-formhelpers-min.js"></script>
<script type="text/javascript" src="js/simulationPaiement/bootstrapValidator-min.js"></script>


</head>
<body>
  <form action="" method="POST" id="payment-form" class="form-horizontal">
    <div class="row row-centered">
      <div class="col-md-4 col-md-offset-4">
        <div class="page-header">
          <h2 class="gdfg">Paiement sécurisé.</h2>
        </div>
        <noscript>
          <div class="bs-callout bs-callout-danger">
            <h4>JavaScript n'est pas installé.</h4>
            <p>Activez javaScript puis reloader la page. Regarder <a href="http://enable-javascript.com" target="_blank">enable-javascript.com</a> for more informations.</p>
          </div>
        </noscript>
        <?php
        require 'lib/Stripe.php';

        $error = '';
        $success = '';

        if ($_POST) {
          Stripe::setApiKey("sk_test_ze3ZePlRbWuZCbCAfKs4DOTc");
          

          try {
            if (!isset($_POST['stripeToken']))
            throw new Exception("Le token a mal été généré.");
            Stripe_Charge::create(array("amount" => $price,
            "currency" => "eur",
            "card" => $_POST['stripeToken']));
            $success = '<div class="alert alert-success">
            <strong>Bravo!</strong> Votre paiement a été accepté.
            </div><script>
            window.onload = function () {
                  addPDFButton();
            };
            </script>';
          }
          catch (Exception $e) {
            $error = '<div class="alert alert-danger">
            <strong>Error!</strong> '.$e->getMessage().'
            </div>';
          }
        }
        ?>
        <div class="alert alert-danger" id="a_x200" style="display: none;"> <strong>Erreur</strong> <span class="payment-errors"></span> </div>
        <span class="payment-success">
          <?= $success ?>
          <?= $error ?>
        </span>

        <!-- Card Number -->
        <div class="form-group">
          <label class="col-sm-4 control-label" for="textinput">Numéro de carte</label>
          <div class="col-sm-6">
            <input type="text" id="cardnumber" maxlength="19" placeholder="Numéro de carte" class="card-number form-control">
          </div>
        </div>

        <!-- Expiry-->
        <div class="form-group">
          <label class="col-sm-4 control-label" for="textinput">Date d'expiration</label>
          <div class="col-sm-6">
            <div class="form-inline">
              <select name="select2" data-stripe="exp-month" class="card-expiry-month stripe-sensitive required form-control">
                <option value="01" selected="selected">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
              <span> / </span>
              <select name="select2" data-stripe="exp-year" class="card-expiry-year stripe-sensitive required form-control">
              </select>
              <script type="text/javascript">
              var select = $(".card-expiry-year"),
              year = new Date().getFullYear();

              for (var i = 0; i < 12; i++) {
                select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
              }
              </script>
            </div>
          </div>
        </div>

        <!-- CVV -->
        <div class="form-group">
          <label class="col-sm-4 control-label" for="textinput">CVV</label>
          <div class="col-sm-3">
            <input type="text" id="cvv" placeholder="CVV" maxlength="3" class="card-cvc form-control">
          </div>
        </div>



        <!-- Submit -->
        <div class="control-group">
          <div class="controls">
            <center>
              <button class="btn btn-success" id="buttonSuccess" type="submit">Payez maintenant <?= $_SESSION['price']."€";?></button>
            </center>
          </div>
        </div>
        <br>
        <div class="control-group">
          <div class="controls">
            <center class="control-group" id="id1">

            </center>
          </div>
        </div>

      </fieldset>
    </form>
    <?php //  include "includehtml/footer.php" ?>
    <script src="js/simulationPaiement/main.js"></script>
  </body>
  </html>
