<?php
  include "vendor/script/db_connect.php";
  include "vendor/script/basic_query.php";


  session_start();

  if (isset($_GET['order_by']) && isset($_GET['order_order']) && isset($_SESSION['result'])) {

      $result = $_SESSION['result'];
      

      if ($_GET['order_order'] == "ASC") {
        usort($result, function($a, $b) {
          return $a[$_GET['order_by']] - $b[$_GET['order_by']];
        });
        $order_order = "DESC";
      }
      else {
        usort($result, function($a, $b) {
          return $b[$_GET['order_by']] - $a[$_GET['order_by']];
        });
        $order_order = "ASC";
      }
  } else {

    $order_order = "ASC";
    $request = "SELECT *,bien.ID AS bien_ID,bien.nom AS bien_nom,type.nom AS type_nom, localite.nom AS local_nom, bien.description AS bien_desc,categorie.ID AS cat_ID FROM bien INNER JOIN categorie ON categorie.ID = fk_Categorie_ID INNER JOIN type ON type.ID = fk_Type_ID INNER JOIN localite ON localite.ID = fk_Localite_ID WHERE ";

    //wild card in function of type
    if (isset($_GET['list'])) {
      $request.= "(categorie.ID =".$_GET['list'];
      $request.= " OR categorie.ID =".$categories_admin[$_GET['list']-1]['inverse_ID'].")";
    } else {

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

      if ($_GET['localite'] != 0) {
        $request .= "localite.ID = ".$_GET['localite']." AND ";
      }

      if ($_GET['type'] != 0) {
        $request .= "type.ID = ".$_GET['type']." AND ";
      }

      $request .= "(categorie.ID =".$_GET['categorie']." OR ";
      $request .= "categorie.ID =".$categories_admin[$_GET['categorie']-1]['inverse_ID'].")";
    }

    $result = $bdd->query($request)->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['result'] = $result;
  } 
  

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
              <a class="nav-link-lord" href=".">Accueil
                <span class="sr-only">(current)</span>
              </a>
            </li>
       <li class="nav-item">
              <a class="nav-link-lord" href="result.php?list=1">Acheter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link-lord" href="result.php?list=2">Louer</a>
            </li>
               <li class="nav-item">
              <a class="nav-link-lord" href="contact.html">Services</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header>
    <!--Filter Section -->
            <ul class="navbar-nav ml-auto">

            <li class="nav-item active">
              <a class="nav-link-lord-filter" href="result.php?order_by=creation_date&order_order=<?php echo $order_order;?>">Date
                <span class="sr-only">(current)</span>
              </a>
            <a class="nav-link-lord-filter" href="result.php?order_by=prix&order_order=<?php echo $order_order;?>">Prix</a>
     

    
            <a class="nav-link-lord-filter" href="result.php?order_by=piece&order_order=<?php echo $order_order;?>">Pièces</a>
          

            <a class="nav-link-lord-filter" href="result.php?order_by=surface&order_order=<?php echo $order_order;?>">Surface</a>

            </li>
            
         
          </ul>
    </header>

    <!-- Page Content -->
    <section class="py-5">
      <div class="container">
        <div class="col-md-8 description ">
          <h1><?php echo count($result);?> résultat(s) trouvé(s)</h1>
        </div>


     <!--Liste des items trouvés-->
       
          <div class="row">

          <!-- START ITEM -->
          <?php
            foreach ($result as $item) {
          ?>
            <div class="col-md-8">
                <div class="lord-item-title ">
                <h1><?php echo $item['bien_nom']; ?></h1>
                </div>
                <?php
                  $pictures = $bdd->query("SELECT * FROM photo WHERE fk_bien_ID = ".$item["bien_ID"]." AND selected = 1");
                  while ($picture = $pictures->fetch()) {
                    echo '<div class="lord-item  ">';
                    echo '<img class="img-lord" src="images/upload/'.$picture["name"].'">';
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

                <p> <?php echo (strlen($item['bien_desc']) > 100) ? substr($item['bien_desc'],0,97).'...' : $item['bien_desc']; ?> <a href="detail.php?bien_ID=<?php echo $item['bien_ID'] ;?>">Voir plus</a></p>
                </div>

                </div>
                <span class="lord-price shadow p-3 mb-5">
                <?php
                //Oui c'est pas beau
                if ($item['cat_ID'] == 3) {
                  echo "Vendu";
                } elseif ($item['cat_ID'] == 4) {
                  echo "Loué";
                } else
                   echo "CHF ".number_format($item['prix'], 0, ',', '\''); 
                ?>
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
                  <option value="0">Toutes</option> 
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
                  <option value="0">Tous</option> 
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
                  <input type="number" class="form-control" placeholder="Min." name="nbre_piece_min" value="<?php if(isset($_GET['nbre_piece_min'])) {echo $_GET['nbre_piece_min'];} ?>">
                  <input type="number" class="form-control" placeholder="Max." name="nbre_piece_max" value="<?php if(isset($_GET['nbre_piece_max'])) {echo $_GET['nbre_piece_max'];} ?>">
                  </div>
                </div>

                <div class="form-group col-md-12">
                  <label for="prix">Prix</label>
                  <div class="input-group">
                  <input type="text" class="form-control" placeholder="Min." name="prix_min" value="<?php if(isset($_GET['prix_min'])) {echo $_GET['prix_min'];} ?>">
                  <input type="text" class="form-control" placeholder="Max." name="prix_max" value="<?php if(isset($_GET['prix_max'])) {echo $_GET['prix_max'];} ?>">
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
                  <option value="0">Toutes</option> 
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
                <option value="0">Tous</option> 
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
                <input type="number" class="form-control" placeholder="Min." name="nbre_piece_min" value="<?php if(isset($_GET['nbre_piece_min'])) {echo $_GET['nbre_piece_min'];} ?>">
                <input type="number" class="form-control" placeholder="Max." name="nbre_piece_max" value="<?php if(isset($_GET['nbre_piece_max'])) {echo $_GET['nbre_piece_max'];} ?>">
                </div>
              </div>

              <div class="form-group col-md-12">
                <label for="prix">Prix</label>
                  <div class="input-group">
                  <input type="text" class="form-control" placeholder="Min." name="prix_min" value="<?php if(isset($_GET['prix_min'])) {echo $_GET['prix_min'];} ?>">
                  <input type="text" class="form-control" placeholder="Max." name="prix_max" value="<?php if(isset($_GET['prix_max'])) {echo $_GET['prix_max'];} ?>">
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
