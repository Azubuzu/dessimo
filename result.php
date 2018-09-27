<?php
  include "vendor/script/db_connect.php";
  include "vendor/script/basic_query.php";


  $request = "SELECT *,bien.ID AS bien_ID,bien.nom AS bien_nom,type.nom AS type_nom, localite.nom AS local_nom, bien.description AS bien_desc FROM bien INNER JOIN categorie ON categorie.ID = fk_Categorie_ID INNER JOIN type ON type.ID = fk_Type_ID INNER JOIN localite ON localite.ID = fk_Localite_ID WHERE ";


  if ($_GET['nbre_piece_min'] != "" && $_GET['nbre_piece_max'] != "") {
    $request .= "(piece BETWEEN ".$_GET['nbre_piece_min']." AND ".$_GET['nbre_piece_max'].") AND ";
  }else if ($_GET['nbre_piece_min'] == "" && $_GET['nbre_piece_max'] != "") {
    $request .= "piece <= ".$_GET['nbre_piece_max']." AND ";
  }else if ($_GET['nbre_piece_max'] == "" && $_GET['nbre_piece_min'] != "") {
    $request .= "piece >= ".$_GET['nbre_piece_min']." AND ";
  }

  if ($_GET['prix_min'] != "" && $_GET['prix_max'] != "") {
    $request .= "(prix BETWEEN ".$_GET['prix_min']." AND ".$_GET['prix_max'].") AND ";
  }else if ($_GET['prix_min'] == "" && $_GET['prix_max'] != "") {
    $request .= "prix <= ".$_GET['prix_max']." AND ";
  }else if ($_GET['prix_max'] == "" && $_GET['prix_min'] != "") {
    $request .= "prix >= ".$_GET['prix_min']." AND ";
  }

  $request .= "categorie.ID =".$_GET['categorie']." AND localite.ID =".$_GET['localite']." AND type.ID=".$_GET['type'].";";

  $result = $bdd->query($request);

  function isSeleced($name,$id) {
    if ($id == $_GET[$name])
      return "selected";
    else
      return "";
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
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Bootstrap core CSS -->

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/result.css" rel="stylesheet">

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
              <a class="nav-link-lord" href="#">Accueil
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link-lord" href="#">Louer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link-lord" href="#">Acheter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link-lord" href="#">Services</a>
            </li>
               <li class="nav-item">
              <a class="nav-link-lord" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header>
    <!--Filter Section -->
            <ul class="navbar-nav ml-auto">

            <li class="nav-item active">
              <a class="nav-link-lord-filter" href="#">Date
                <span class="sr-only">(current)</span>
              </a>
            <a class="nav-link-lord-filter" href="#">Prix</a>
     

    
            <a class="nav-link-lord-filter" href="#">Pièces</a>
          

            <a class="nav-link-lord-filter" href="#">Surface</a>

            </li>
            
         
          </ul>
    </header>

    <!-- Page Content -->
    <section class="py-5">
      <div class="container">
        <div class="description col-md-8">
          <h1><?php echo $result->rowCount();?> résultat(s) trouvé(s)</h1>
        </div>


     <!--Liste des items trouvés-->
       
          <div class="row">

          <!-- START ITEM -->
          <?php
            while ($item = $result->fetch())
            {
          ?>
            <div class="col-md-8">
                <div class="lord-item-title ">
                <h1><?php echo $item['bien_nom']; ?></h1>
                </div>
                <?php
                  $pictures = $bdd->query("SELECT * FROM photo WHERE fk_bien_ID = ".$item["bien_ID"]." AND selected = 1");
                  while ($picture = $pictures->fetch()) {
                    echo '<div class="lord-item shadow-lg p-3 mb-5 white rounded" style="background: url(images/upload/'.$picture['name'].');">';
                  }
                ?>

                <div class="lord-item-description">
                <table>

                <tr>
                <td>Localité</td>
                <td><b><?php echo $item['local_nom']; ?></b></td>
                </tr>

                <tr>
                <td>Pièces</td>
                <td><b><?php echo $item['piece']; ?></b></td>
                </tr>

                <tr>
                <td>Chambres</td>
                <td><b><?php echo $item['chambre']; ?></b></td>
                </tr>

                <tr>
                <td>Surface</td>
                <td><b><?php echo $item['surface']; ?> m<sup>2</sup></b></td>
                </tr>
                </table>

                <p> <?php echo (strlen($item['bien_desc']) > 150) ? substr($item['bien_desc'],0,147).'...' : $item['bien_desc']; ?> <a href="detail.php?bien_ID=<?php echo $item['bien_ID'] ;?>">Voir plus</a></p>
                </div>

                </div>
                <span class="lord-price shadow p-3 mb-5">
                CHF <?php echo number_format($item['prix'], 0, ',', '\''); ?>
                </span>
            </div>
            
            <?php
              }
            ?>
          <!--END ITEM-->          

         </div>
       </div>
 
 
        <!-- Fonction de recherche -->
      <div class="row">
        <div class="col-md-4">
          <div class="search-box shadow-lg p-3 mb-5 white rounded">
            <form>
              <div class="form-row">
                  <div class="form-group col-md-6">
                  <label for="categorie">Catégorie</label>
                  <select class="form-control lord-select" name="categorie">
                  <?php
                  foreach ($categories as $item) {
                    echo "<option value='".$item['ID']."' ".isSeleced("categorie",$item['ID']).">".$item['nom']."</option>";
                  }
                  ?>
                  </select>
                </div>


                <div class="form-group col-md-6 ">
                  <label for="canton">Canton</label>
                  <select class="form-control lord-select" name="canton" onchange="fetch_select(this.value);">
                  <?php
                  foreach ($cantons as $item) {
                    echo "<option value='".$item['ID']."' ".isSeleced("canton",$item['ID']).">".$item['nom']."</option>";
                  }
                  ?>
                  </select>
                </div>


                <div class="form-group col-md-12">
                  <label for="localite">Localité</label>
                  <select class="form-control lord-select" name="localite" id="localite">
                  <?php
                  foreach ($localites as $item) {
                    echo "<option value='".$item['ID']."' ".isSeleced("localite",$item['ID']).">".$item['nom']."</option>";
                  }
                  ?>
                  </select>
                </div>


                <div class="form-group col-md-12">
                  <label for="type">Type de biens</label>
                  <select class="form-control lord-select" name="type">
                  <?php
                  foreach ($types as $item) {
                    echo "<option value='".$item['ID']."' ".isSeleced("type",$item['ID']).">".$item['nom']."</option>";
                  }
                  ?>
                  </select>
                </div>

                <div class="form-group col-md-12">

                  <label for="piece">Nombre de pièces</label>
                  <div class="input-group">
                  <input type="number" class="form-control" placeholder="Min." name="nbre_piece_min" value="<?php echo $_GET['nbre_piece_min']; ?>">
                  <input type="number" class="form-control" placeholder="Max." name="nbre_piece_max" value="<?php echo $_GET['nbre_piece_max']; ?>">
                  </div>
                </div>

                <div class="form-group col-md-12">
                  <label for="prix">Prix</label>
                  <div class="input-group">
                  <input type="text" class="form-control" placeholder="Min." name="prix_min" value="<?php echo $_GET['prix_min']; ?>">
                  <input type="text" class="form-control" placeholder="Max." name="prix_max" value="<?php echo $_GET['prix_max']; ?>">
                  </div>
                </div>
              </div>          

              <button type="submit" class="lord-button">Lancer la recherche</button>
            </form>
          </div> <!--end search box-->
        </div> 
      </div> <!--end row-->
    </div>
      
      

<!--Hiden Search box when big screen -->

        <!-- Fonction de recherche -->

          <div class="col-md-8">
            <div class="search-box-little shadow-lg p-3 mb-5 white rounded">

            <form>
              <div class="form-row">

                <div class="form-group col-md-6">
                  <label for="categorie">Catégorie</label>
                  <select class="form-control lord-select" name="categorie">
                  <?php
                  foreach ($categories as $item) {
                    echo "<option value='".$item['ID']."' ".isSeleced("categorie",$item['ID']).">".$item['nom']."</option>";
                  }
                  ?>
                  </select>
                </div>

        
                <div class="form-group col-md-6 ">
                  <label for="canton">Canton</label>
                  <select class="form-control lord-select" name="canton" onchange="fetch_select(this.value);">
                  <?php
                  foreach ($cantons as $item) {
                    echo "<option value='".$item['ID']."' ".isSeleced("canton",$item['ID']).">".$item['nom']."</option>";
                  }
                  ?>
                  </select>
                </div>

          
                <div class="form-group col-md-12">
                  <label for="localite">Localité</label>
                  <select class="form-control lord-select" name="localite" id="localite2">
                  <?php
                  foreach ($localites as $item) {
                    echo "<option value='".$item['ID']."' ".isSeleced("localite",$item['ID']).">".$item['nom']."</option>";
                  }
                  ?>
                  </select>
                </div>

     
                <div class="form-group col-md-12">
                <label for="type">Type de biens</label>
                <select class="form-control lord-select" name="type">
                <?php
                foreach ($types as $item) {
                  echo "<option value='".$item['ID']."' ".isSeleced("type",$item['ID']).">".$item['nom']."</option>";
                }
                ?>
                </select>
                </div>

              <div class="form-group col-md-12">

                <label for="piece">Nombre de pièces</label>
                <div class="input-group">
                <input type="number" class="form-control" placeholder="Min." name="nbre_piece_min" value="<?php echo $_GET['nbre_piece_min']; ?>">
                <input type="number" class="form-control" placeholder="Max." name="nbre_piece_max" value="<?php echo $_GET['nbre_piece_max']; ?>">
                </div>
              </div>

              <div class="form-group col-md-12">
                <label for="prix">Prix</label>
                  <div class="input-group">
                  <input type="text" class="form-control" placeholder="Min." name="prix_min" value="<?php echo $_GET['prix_min']; ?>">
                  <input type="text" class="form-control" placeholder="Max." name="prix_max" value="<?php echo $_GET['prix_max']; ?>">
                  </div>
              </div>



           
              </div>          

               <button type="submit" class="lord-button">Lancer la recherche</button>
             
            </form>
        </div>
        </div>

</div><!--end hidden search-box-->




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
      document.getElementById("localite2").innerHTML=response; 
     }
     });
    }
    </script>
  </body>

</html>
