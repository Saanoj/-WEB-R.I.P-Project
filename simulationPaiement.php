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
  <style type="text/css">
  .col-centered {
    display:inline-block;
    float:none;
    text-align:left;
    margin-right:-4px;
  }
  .row-centered {
    margin-left: 9px;
    margin-right: 9px;
  }

</style>
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
<script type="text/javascript">

$(document).ready(function() {
  $('#payment-form').bootstrapValidator({
    message: 'This value is not valid',
    feedbackIcons: {
      valid: 'glyphicon glyphicon-ok',
      invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    submitHandler: function(validator, form, submitButton) {
      // createToken returns immediately - the supplied callback submits the form if there are no errors
      Stripe.card.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()

      }, stripeResponseHandler);
      return false; // submit from callback
    },
    fields: {
      cardholdername: {
        validators: {
          notEmpty: {
            message: 'Le nom de la carte bleu ne peut pas être vide.'
          },
          stringLength: {
            min: 6,
            max: 70,
            message: 'La taille du nom doit faire entre 6 et 70 caractères.'
          }
        }
      },
      cardnumber: {
        selector: '#cardnumber',
        validators: {
          notEmpty: {
            message: 'Le numéro de carte bleu ne peut pas être vide.'
          },
          creditCard: {
            message: 'La carte de crédit n\'est pas valide.'
          },
        }
      },
      expMonth: {
        selector: '[data-stripe="exp-month"]',
        validators: {
          notEmpty: {
            message: 'La date d\'expiration est obligatoire.'
          },
          digits: {
            message: 'La date d\'expiration est composé de chiffres uniquement.'
          },
          callback: {
            message: 'Expired',
            callback: function(value, validator) {
              value = parseInt(value, 10);
              var year         = validator.getFieldElements('expYear').val(),
              currentMonth = new Date().getMonth() + 1,
              currentYear  = new Date().getFullYear();
              if (value < 0 || value > 12) {
                return false;
              }
              if (year == '') {
                return true;
              }
              year = parseInt(year, 10);
              if (year > currentYear || (year == currentYear && value > currentMonth)) {
                validator.updateStatus('expYear', 'VALID');
                return true;
              } else {
                return false;
              }
            }
          }
        }
      },
      expYear: {
        selector: '[data-stripe="exp-year"]',
        validators: {
          notEmpty: {
            message: 'La date d\'expiration est obligatoire.'
          },
          digits: {
            message: 'La date d\'expiration est composé de chiffres uniquement.'
          },
          callback: {
            message: 'Expired',
            callback: function(value, validator) {
              value = parseInt(value, 10);
              var month        = validator.getFieldElements('expMonth').val(),
              currentMonth = new Date().getMonth() + 1,
              currentYear  = new Date().getFullYear();
              if (value < currentYear || value > currentYear + 100) {
                return false;
              }
              if (month == '') {
                return false;
              }
              month = parseInt(month, 10);
              if (value > currentYear || (value == currentYear && month > currentMonth)) {
                validator.updateStatus('expMonth', 'VALID');
                return true;
              } else {
                return false;
              }
            }
          }
        }
      },
      cvv: {
        selector: '#cvv',
        validators: {
          notEmpty: {
            message: 'Le code CVV est obligatoire.'
          },
          cvv: {
            message: 'Code invalide.',
            creditCardField: 'cardnumber'
          }
        }
      },
    }
  });
});
</script>
<script type="text/javascript">
// this identifies your website in the createToken call below
Stripe.setPublishableKey('pk_test_lwDEu24XNnK0Phc4YD3aagcp');

function stripeResponseHandler(status, response) {
  if (response.error) {
    // re-enable the submit button
    $('.submit-button').removeAttr("disabled");
    // show hidden div
    document.getElementById('a_x200').style.display = 'block';
    // show the errors on the form
    $(".payment-errors").html(response.error.message);
  } else {
    var form$ = $("#payment-form");
    // token contains id, last4, and card type
    var token = response['id'];
    // insert the token into the form so it gets submitted to the server
    form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
    // and submit
    form$.get(0).submit();
  }
}

function addPDFButton(){
  var button = document.createElement("submit");
	button.onclick = function(){sayHi()};
  button.className = "btn btn-success";
	button.innerText = "Facture PDF";
  document.getElementById('id1').appendChild(button);
  generatePDF();

}

function sayHi(){
  console.log("Hi mate :3");
  generatePDF();
}

function generatePDF() {
  	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
	  if(request.status == 200 && request.readyState == 4){

	  }
	};
	data=''
	request.open('POST', 'paymentProcess.php');
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
	request.send(data);
	return false;

  }

</script>
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



        <!-- Card Holder Name -->
        <div class="form-group">
          <label class="col-sm-4 control-label"  for="textinput">Nom et Prenom</label>
          <div class="col-sm-6">
            <input type="text" name="cardholdername" maxlength="70" placeholder="Nom et Prenom" class="card-holder-name form-control">
          </div>
        </div>

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
            <input type="text" id="cvv" placeholder="CVV" maxlength="4" class="card-cvc form-control">
          </div>
        </div>



        <!-- Submit -->
        <div class="control-group">
          <div class="controls">
            <center>
              <button class="btn btn-success" type="submit">Payez maintenant <?= $_SESSION['price']."€";?></button>
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
  </body>
  </html>
