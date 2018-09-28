<?php
  include "vendor/script/db_connect.php";
  if (isset($_GET['bien_ID']) && $_GET['bien_ID'] != "") {

      if($bien = $bdd->query("SELECT *,bien.ID AS bien_ID,bien.nom AS bien_nom,type.nom AS type_nom, localite.nom AS local_nom,agent.nom AS agent_nom,agent.prenom AS agent_prenom,bien.description AS bien_desc FROM bien INNER JOIN categorie ON categorie.ID = fk_Categorie_ID INNER JOIN type ON type.ID = fk_Type_ID INNER JOIN localite ON localite.ID = fk_Localite_ID INNER JOIN agent ON agent.ID = fk_Agent_ID WHERE bien.ID = ".$_GET['bien_ID'])->fetch()) {

      $pictures = $bdd->query('SELECT * FROM photo WHERE fk_bien_ID = '.$_GET['bien_ID'])->fetchAll(PDO::FETCH_ASSOC);
    } else {
      //Error 404
      header('Location: index.php');
    } 
    
  } else {
    //Error 404
      header('Location: index.php');
  } 

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Accueil | DESSIMO1 Sàrl</title>

  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap-slide.css">
 
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Bootstrap core CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
  <link rel="stylesheet" href="dist/css/lightbox.min.css">

    <!-- Custom styles for this template -->
    <link href="css/detail.css" rel="stylesheet">

  </head>

  <body>


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">

      <div class="container">
 
        <a class="navbar-brand" href="."><img src="images/logo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link-lord" href=".">Accueil
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
              <a class="nav-link-lord" href="contact.html">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header>
     
    </header>

    <!--Title Section -->
<section>
  <div class="container">
    <h1><?php echo $bien['bien_nom']; ?></h1>
  </div>
</section>
    <!--End Title Section -->


    <!--Carousel ma gueule -->
<section class="py-5">
<hr/> 
  <div class="container2" >
        <div class="row">
      <div class="col-md-8   nopadding">
    <div class="lord-item">

    <!--SLIDER-->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
 
          <div class="carousel-inner">
              <?php
               foreach ($pictures as $item) {
                if ($item['selected'] == "1")
                  echo '<div class="item active">';
                else
                  echo '<div class="item">';


                echo '   <a class="example-image-link" href="images/upload/'.$item["name"].'" data-lightbox="example-set" data-title="">';

                echo '<img class="img-lord "   src="images/upload/'.$item["name"].'"   >';
                echo '</a>';
                echo '</div>';
               }
              ?>
          </div>
               
        </div>
      </div> <!--lord item-->
      </div><!--col-6-->
    <!--Slider-->


    <!-- START ITEM -->




      <div class="col-md-4 nopadding">
    <div class="lord-item-description">

      <table>

      <tr>
      <td>Catégorie</td>
      <td><b><?php echo $bien['type_nom']; ?></b></td>
      </tr>

      <?php 
        if($bien['piece'] != "") {
          ?>
            <tr>
            <td>Pièces</td>
            <td><b><?php echo $bien['piece'] ?></b></td>
            </tr>
          <?php
        }
      ?>

      <?php 
        if($bien['chambre'] != "") {
          ?>
            <tr>
            <td>Chambres</td>
            <td><b><?php echo $bien['chambre'] ?></b></td>
            </tr>
          <?php
        }
      ?>

      <?php 
        if($bien['nbre_WC'] != "") {
          ?>
            <tr>
            <td>Nombre de WC</td>
            <td><b><?php echo $bien['nbre_WC'] ?></b></td>
            </tr>
          <?php
        }
      ?>

      <?php 
        if($bien['niveau'] != "") {
          ?>
            <tr>
            <td>Niveau</td>
            <td><b><?php echo $bien['niveau'] ?></b></td>
            </tr>
          <?php
        }
      ?>

      <?php 
        if($bien['surface'] != "") {
          ?>
            <tr>
            <td>Surface habitable</td>
            <td><b><?php echo $bien['surface'] ?> m<sup>2</sup></b></td>
            </tr>
          <?php
        }
      ?>

      <?php 
        if($bien['surface_terrain'] != "") {
          ?>
            <tr>
            <td>Surface terrain</td>
            <td><b><?php echo $bien['surface_terrain'] ?> m<sup>2</sup></b></td>
            </tr>
          <?php
        }
      ?>

      <?php 
        if($bien['annee'] != "") {
          ?>
            <tr>
            <td>Année de constr.</td>
            <td><b><?php echo $bien['annee'] ?></b></td>
            </tr>
          <?php
        }
      ?>

      <?php 
        if($bien['disponibilite'] != "") {
          ?>
            <tr>
            <td>Disponibilité</td>
            <td><b><?php echo $bien['disponibilite'] ?></b></td>
            </tr>
          <?php
        }
      ?>
      </table>


      <div class="carousel-indicators">
      <div class="row">
      <?php
        $foo = 0;
        foreach ($pictures as $item) {
          echo '<div class=".col-4 .col-sm-4 shadow p-3 mb-3 nopadding"><span data-target="#myCarousel" data-slide-to="'.$foo++.'"><img src="images/upload/'.$item["name"].'"></span></div>';
        }
      ?>
      </div>
      </div>


    </div>

    <span class="lord-price shadow p-3 mb-5">
    CHF <?php echo number_format($bien['prix'], 0, ',', '\''); ?>
    </span>
   </div><!--end col-6 col-md-4-->
   </div><!--row-->
            
  </div>
</section>


<section>
  <div class= "container3">
    <div class="row description-map">
      <div class="col-md-5  ">

         <iframe src="<?php echo $bien['gmaps']; ?>"   width="100%" height="400px" frameborder="0" style="border:0;box-shadow: 0px 0px 10px 2px #cfcfcf;" allowfullscreen></iframe>

      </div>

      <div class="col-md-7 description">
        <h1>Descriptif</h1>
        <p><?php echo nl2br($bien['bien_desc']); ?> </p>
      </div>
    </div>

  </div>
</section>



<section>
  <div class="container4">
    <div class="row">
      <div class="col-md-4 features ">
        <img src="images/local.png">
        <h1>Situation</h1>
        <p><?php echo $bien['situation']; ?></p>
      </div>

      <div class="col-md-4 features ">
        <img src="images/features.png">
        <h1>Particularités</h1>
        <p><?php echo $bien['particularite']; ?></p>
      </div>

      <div class="col-md-4  features">
        <img src="images/contact.png">
        <h1>Contact Visite</h1>
        <p><?php echo $bien['agent_prenom']." ".$bien['agent_nom']; ?></p>
      </div>
      
      </div>

    <hr/> 
    <button type="submit" class="lord-button">Je suis intéressé</button>

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





  <script src="dist/js/lightbox-plus-jquery.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt_8arMWwUwhSkryyrnhi7A5FVlo_LmA4&callback=myMap"></script>
  </body>

</html>
