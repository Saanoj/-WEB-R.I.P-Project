<!doctype html>
<html>
<head>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<meta charset="utf-8">
<link rel="stylesheet" href="css/abonnement/style.css">
<title>Abonnement</title>
</head>

<body>
    <form action="verifAbonnement.php" method="post">
 <div class="demo" style="background: #10202b;">
        <div class="container">
            <div class="row text-center">
                <h1 class="heading-title">Abonnements</h1>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="pricingTable">
                        <div class="pricingTable-header">
                            <span class="heading">
                                <h3>Standard</h3>
                            </span>
                            <span class="price-value">28€ /mois<span class="month">Sans engagement</span>
                            <span class="month">Accès privilégié en illimité 7/7j</span>
                        </span>
                        </div>
                        <div class="pricingTable-sign-up">
                        <button type="submit"   class="btn btn-default" name="submit"  value="nonEngagementStandard">Souscrire</button>
                    </div>
                </div>
</div>

                <div class="col-md-3 col-sm-6">
                    <div class="pricingTable">
                        <div class="pricingTable-header">
                            <span class="heading">
                                <h3>Standard</h3>
                            </span>
                            <span class="price-value">20€ /mois<span class="month">Engagement sur 12 mois</span>
                            <span class="month">Accès privilégié en illimité 7/7j</span>
                        </span>
                        </div>
                        <div class="pricingTable-sign-up">
                        <button type="submit"   class="btn btn-default" name="submit"  value="engagementStandard">Souscrire</button>
                       </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="pricingTable">
                        <div class="pricingTable-header">
                            <span class="heading">
                                <h3>Entreprise</h3>
                            </span>
                            <span class="price-value">80€ /mois<span class="month">Sans engagement</span>
                           <span class="month">Accès privilégié en illimité 7/7j</span>
                        </span>
                        </div>
                        <div class="pricingTable-sign-up">
                        <button type="submit"   class="btn btn-default" name="submit"  value="nonEngagementEntreprise">Souscrire</button>

                            <!-- <a href="#" class="btn btn-default" >Acheter</a> -->
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="pricingTable">
                        <div class="pricingTable-header">
                            <span class="heading">
                                <h3>Entreprise</h3>
                            </span>
                            
                            <span class="price-value">65€ /mois<span class="month">Engagement sur 12 mois</span>
                            <span class="month">Accès privilégié en illimité 7/7j</span>
                        </span>
                        </div>
                        <div class="pricingTable-sign-up">
                        <button type="submit"   class="btn btn-default" name="submit"  value="engagementEntreprise">Souscrire</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</form>

</body>
<script src="js/abonnement/main.js"></script>
</html>
