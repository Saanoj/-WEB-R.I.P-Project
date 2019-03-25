$(document).ready(function() {
    $('#payment-form').bootstrapValidator({
      message: 'Valeur invalide',
      feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      },
      submitHandler: function(validator, form, submitButton) {
  
        // Créer un token qui se génère instantanément. S'il n'y a pas d'erreur dans le formulaire => on soumet les informations a Stripe
        Stripe.card.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
  
        }, stripeResponseHandler);
        return false; // submit from callback
      },
      fields: {
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
              message: 'Mois invalide',
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
              message: 'Année invalide',
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

    var isEngagement = $_GET('isEngagement');
    var idAbonnement = $_GET('idAbonnement');
    console.log(isEngagement)
    console.log(idAbonnement)
    if (idAbonnement != null) {
     document.location.href="recapAbonnement.php?isEngagement="+isEngagement+"&idAbonnement="+idAbonnement+"";
    }
    else 
    {
        document.location.href="verifConfigAbonnementEntreprise.php?isEngagement="+isEngagement+"";
    }
  }
  
    
  function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}