<?php
session_start();



require_once __DIR__ .'/require_class.php';


$form = new App\Form(array());

?>


<!DOCTYPE html>
<html class="no-js">
<?php include "includehtml/head.html" ?>
<script type="text/javascript" src="js/inscription/main.js"></script>
<script type="text/javascript">
        function showURL() {
          var d1 = $("#identifier").find(":selected").attr("class");
          var url = ("/store/vehicle-selected/" + d1);
          window.location = url;
          return true;
        }

        $(document).ready(function() {
        var $make = $( '#make' ),
          $model = $( '#model' ),
          $options = $model.find( 'option' );

        $make.on( 'change', function() {
        $model.html( $options.filter( '[class="' + this.value + '"]') );
        $model.trigger( 'change' );
        } ).trigger( 'change' );

        var $model = $( '#model' ),
          $year = $( '#year' ),
          $yearOptions = $year.find( 'option' );

        $model.on( 'change', function() {
        $year.html( $yearOptions.filter( '[class="' + this.value + '"]' ) );
        $year.trigger( 'change' );
        } ).trigger( 'change' );

        var $year = $( '#year' ),
          $identifier = $( '#identifier' ),
          $identifierOptions = $identifier.find( 'option' );

        $year.on( 'change', function() {
         var filteredIdetifiers = $identifierOptions.filter( '[value="' + this.value + '"]' );
          debugger
          if(!($("#make").val() == 3 && $("#model option:selected").text()  == 'Falcon')) {
             filteredIdetifiers = filteredIdetifiers.filter(function(i,e){ return e.value !== '3'    });
          }
          $identifier.html(filteredIdetifiers);
        $identifier.trigger( 'change' );
        } ).trigger( 'change' );

        });
</script>
<body>
  <?php
  $backOffice=0;
  $type = 0;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();
  ?>

  <div class="container">
    <div class="display-1 text-center">
      Inscription Chauffeur
    </div>
    <div class="container">

      <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="panel-title">Inscrivez vous</div>
          </div>


          <form  class="form-horizontal container" method="post" action="verifInscriptionCollabBDD.php">
            <div class="h1">
              Informations chauffeur
            </div>
            <div class="form-group required mt-3">
              <label class="control-label col-md-4  requiredField">Prix au kilomètre (1 à 5 €)<span class="asteriskField">*</span> </label>
              <div class="controls col-md-8 ">
                <?php echo $form->input('prix_collaborateur','number"  step="0.01" min="1" max=5','Votre prix au kilometre'); ?>
              </div>
            </div>

            <div class="form-group required mt-3">
              <label class="control-label col-md-4  requiredField"> Description<span class="asteriskField">*</span> </label>
              <div class="controls col-md-8 ">
                <?php //echo $form->input('description','textarea','Votre description'); ?>
                <textarea name="description" cols="40" rows="4" placeholder="Votre description"></textarea>
              </div>
            </div>

            <hr class="bg-light">

            <div class="h1">
              Informations voiture
            </div>
            <!-- Vehicle Brand Selector List -->
            <div class="row">
              <div class="col-md-3 h3">Marque</div>
              <div class="col-md-3 h3">Modèle</div>
              <div class="col-md-3 h3">Places</div>
              <div class="col-md-3 h3">Couleur</div>
            </div>
            <div class="row">

              <div class="col-md-3">
                <select name="make" id="make">
                  <option value="Aston-Martin">Aston-Martin</option>
                  <option value="Audi">Audi</option>
                  <option value="Alfa-Romeo">Alfa-Romeo</option>
                  <option value="Bentley">Bentley</option>
                  <option value="BMV">BMV</option>
                  <option value="Chevrolet">Chevrolet</option>
                  <option value="Citroen">Citroen</option>
                  <option value="Dacia">Dacia</option>
                  <option value="Ferrari">Ferrari</option>
                  <option value="Fiat">Fiat</option>
                  <option value="Ford">Ford</option>
                  <option value="Honda">Honda</option>
                  <option value="Hyundai">Hyundai</option>
                  <option value="Jaguar">Jaguar</option>
                  <option value="Lexus">Lexus</option>
                  <option value="Mclaren">Mclaren</option>
                  <option value="Maserati">Maserati</option>
                  <option value="Mazda">Mazda</option>
                  <option value="Mercedez-Benz">Mercedez-Benz</option>
                  <option value="Mitsubishi">Mitsubishi</option>
                  <option value="Nissan">Nissan</option>
                  <option value="Opel">Opel</option>
                  <option value="Peugeot">Peugeot</option>
                	<option value="Porsche">Porsche</option>
                  <option value="Renault">Renault</option>
                	<option value="Rolls-Royce">Rolls-Royce</option>
                  <option value="Subaru">Subaru</option>
                  <option value="Suzuki">Suzuki</option>
                	<option value="Tesla">Tesla</option>
                  <option value="Toyota">Toyota</option>
                  <option value="Volkswagen">Volkswagen</option>
                  <option value="Volvo">Volvo</option>
                </select>
              </div>

              <div class="col-md-3">
                <!-- Vehicle Model List -->
                <select name="model" id="model">
                  <option value="DB11" class="Aston-Martin">DB11</option>
                  <option value="A4" class="Audi">A4</option>
                  <option value="A5" class="Audi">A5</option>
                  <option value="A8" class="Audi">A8</option>
                  <option value="Giulietta" class="Alfa-Romeo">Giulietta</option>
                  <option value="Mulsanne" class="Bentley">Mulsanne</option>
                  <option value="X3" class="BMV">X3</option>
                  <option value="Camaro" class="Chevrolet">Camaro</option>
                  <option value="C5" class="Citroen">C5</option>
                  <option value="Sandero" class="Dacia">Sandero</option>
                  <option value="F40" class="Ferrari">F40</option>
                  <option value="Panda" class="Fiat">Panda</option>
                  <option value="Fiesta" class="Ford">Fiesta</option>
                  <option value="Civic" class="Honda">Civic</option>
                  <option value="i20" class="Hyundai">i20</option>
                  <option value="XJ" class="Jaguar">XJ</option>
                  <option value="LS" class="Lexus">LS</option>
                  <option value="720S" class="Mclaren">720S</option>
                  <option value="Levante" class="Maserati">Levante</option>
                  <option value="CX-3" class="Mazda">CX-3</option>
                  <option value="C-63" class="Mercedez-Benz">C-63</option>
                  <option value="ASX" class="Mitsubishi">ASX</option>
                  <option value="Leaf" class="Nissan">Leaf</option>
                  <option value=Corsa class="Opel">Corsa</option>
                  <option value="508" class="Peugeot">508</option>
                	<option value="Panemara" class="Porsche">Panemara</option>
                  <option value="Clio" class="Renault">Clio</option>
                	<option value="Phantom" class="Rolls-Royce">Phantom</option>
                  <option value="Forester" class="Subaru">Forester</option>
                  <option value="Swift" class="Suzuki">Swift</option>
                	<option value="Model-3" class="Tesla">Model-3</option>
                  <option value="Yaris" class="Toyota">Yaris</option>
                  <option value="Golf" class="Volkswagen">Golf</option>
                  <option value="XC-90" class="Volvo">XC-90</option>
                </select>
              </div>

              <div class="col-md-3">
                <select name="places">
                	<option value="1">1 place</option>
                	<option value="2">2 place</option>
                  <option value="3">3 place</option>
                  <option value="4">4 place</option>
                  <option value="5">5 place</option>
                </select>
              </div>
              <div class="col-md-3">
                <select name="color">
                	<option value="Blanc">Blanc</option>
                	<option value="Gris">Gris</option>
                  <option value="Noir">Noir</option>
                  <option value="Bleu">Bleu</option>
                  <option value="Rouge">Rouge</option>
                  <option value="Vert">Vert</option>
                </select>
              </div>
            </div>
            <input type="hidden" name="carModel" value="default">

            <div style="margin-top:10px" class="form-group">
              <div class="col-sm-12 controls">
                <?php echo $form->submit(); ?>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

</div>
<?php include "includehtml/footer.php" ?>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
