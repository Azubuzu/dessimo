<?php
  include "vendor/script/db_connect.php";
  include "vendor/script/basic_query.php";

  $favoris = $bdd->query("SELECT *,bien.ID AS bien_ID,bien.nom AS bien_nom,type.nom AS type_nom, localite.nom AS local_nom, bien.description AS bien_desc FROM bien INNER JOIN categorie ON categorie.ID = fk_Categorie_ID INNER JOIN type ON type.ID = fk_Type_ID INNER JOIN localite ON localite.ID = fk_Localite_ID WHERE favori = 1");

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Accueil | DESSIMO1 Sàrl</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <!-- Custom styles for this template -->
    <link href="css/lord-main.css" rel="stylesheet">
  </head>

  <body>


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">

      <div class="container">
 
        <a class="navbar-brand" href="#"><img src="images/logo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link-lord" href="#">Accueil
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link-lord" href="result.php?list=2">Louer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link-lord" href="result.php?list=1">Acheter</a>
            </li>
               <li class="nav-item">
              <a class="nav-link-lord" href="contact.html">A Propos</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header>
      <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">

          <?php ;
            for ($i=0; $i < $favoris->rowCount(); $i++) { 
              if ($i == 0) {
                echo '<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>';
              } else {
                echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"></li>';
              }
            }
          ?>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->       
          <?php
            $first = true;
            while ($item = $favoris->fetch()) {
              $pictures = $bdd->query("SELECT * FROM photo WHERE fk_bien_ID = ".$item["bien_ID"]." AND selected = 1");
              while ($picture = $pictures->fetch()) {
                if($first) {
                  echo '<div class="carousel-item active" style="background-image: url(\'images/upload/'.$picture['name'].'\')">';
                  $first = false;
                }
                else {
                  echo '<div class="carousel-item" style="background-image: url(\'images/upload/'.$picture['name'].'\')">';
                }
              }
                            ?>                   
                <div class="carousel-caption d-none d-md-block">
                  <div class="carousel-data shadow p-3 mb-5  rounded">
                    <p></p>
                    <?php
                      echo "<h1>".$item['local_nom']."</h1>";
                      echo "<h2>".$item['type_nom']."</h2>";
                      echo "<p> Surface de ".$item['surface']." m<sup>2</sup> <br />CHF ".number_format($item['prix'], 0, ',', '\'')." .-</p>";
                    ?>
                  </div>


                  <a href="detail.php?bien_ID=<?php echo $item['bien_ID'] ;?>"><div class="carousel-data-link bottomDiv shadow ">VOIR L'ANNONCE</div></a>
                  </div>
              </div>
              <?php
            }
          ?>

        </div>
   

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <section class="py-5">
      <div class="container">
        <div class="description">
          <h1>Votre partenaire immobilier</h1>
          <p>DESSIMO Sàrl votre partenaire pour vos opérations immobilières en Valais central. <br/>Que vous soyez interessé à vendre, louer ou acheter un bien immobilier dans la région du Valais central, n'hésitez pas à faire appel à nous.
          </p>
        </div>

        <div class="search-box shadow-lg p-3 mb-5 white rounded">

        <form action="result.php">
          <div class="form-row">

            <div class="form-group col-md-4">
              <label for="categorie">Catégorie</label>
              <select class="form-control lord-select" name="categorie">
              <?php
                foreach ($categories as $item) {
                  echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
                }
                ?>
              </select>
            </div>

    
            <div class="form-group col-md-4 ">
              <label for="canton">Canton</label>
              <select class="form-control lord-select" name="canton" onchange="fetch_select(this.value);">
              <?php
              foreach ($cantons as $item) {
                echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
              }
              ?>
              </select>
            </div>

      
            <div class="form-group col-md-4">
              <label for="localite">Localité</label>
              <select class="form-control lord-select" name="localite" id="localite">
              <option value="0">Toutes</option> 
              <?php
              foreach ($localites as $item) {
                echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
              }
              ?>
              </select>
            </div>

 
            <div class="form-group col-md-4">
            <label for="type">Type de biens</label>
            <select class="form-control lord-select" name="type">
            <option value="0">Tous</option> 
            <?php
            foreach ($types as $item) {
              echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
            }
            ?>
            </select>
          </div>

          <div class="form-group col-md-4">

            <label for="piece">Nombre de pièces</label>
            <div class="input-group">
            <input type="number" class="form-control" placeholder="Min." name="nbre_piece_min">
            <input type="number" class="form-control" placeholder="Max." name="nbre_piece_max">
          </div>
          </div>

          <div class="form-group col-md-4">
            <label for="prix">Prix</label>
            <div class="input-group">
            <input type="number" class="form-control" placeholder="Min." name="prix_min">
            <input type="number" class="form-control" placeholder="Max." name="prix_max">
            </div>
          </div>



       
          </div>          

           <button type="submit" class="lord-button">Lancer la recherche</button>
         
        </form>

        </div>

      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-white">
      <div class="container">
      <div class="footer-lord">
      

        <p class="m-0 text-center text-black">
   <i class="fa fa-phone"></i> 079 391 44 16 |
   <i class="fa fa-envelope"></i> yvan@dessimo.ch |
        Rue des Raeres 3 | 1975 St-Séverin</p>
        </div>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
    function fetch_select(val)
    {
     $.ajax({
     type: 'post',
     url: 'vendor/script/fetch_localite.php',
     data: {
      get_localite_by_canton:val
     },
     success: function (response) {
      document.getElementById("localite").innerHTML=response; 
     }
     });
    }

    </script>

  </body>

</html>
