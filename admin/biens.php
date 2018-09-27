<?php
    require_once "admin_manager.php";
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dessimo | Page d'administration</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Éléments</h3><!-- /.menu-title -->

                        <li>
                         <a href="agents.php"> <i class="menu-icon ti-user"></i>Agents</a>
                        </li>

                        <li>
                         <a href="cantons.php"> <i class="menu-icon ti-map"></i>Cantons</a>
                        </li>

                        <li>
                         <a href="localites.php"> <i class="menu-icon ti-location-pin"></i>Localités</a>
                        </li>

                        <li>
                         <a href="types.php"> <i class="menu-icon ti-direction"></i>Types de biens</a>
                        </li>

                        <li class="active">
                         <a href="biens.php"> <i class="menu-icon ti-home"></i>Biens</a>
                        </li>

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <i class="menu-icon ti-gallery"></i>Photos</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="ti-gallery"></i><a href="photos.php">Ajouter une photo</a></li>
                                <li><i class="ti-gallery"></i><a href="photos.php">Gallerie</a></li>
                            </ul>
                        </li>  

                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Listes des biens</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="fa fa-table"></i><a href="biens.php">À vendre</a></li>
                                <li><i class="fa fa-table"></i><a href="biens.php">À louer</a></li>
                                <li><i class="fa fa-table"></i><a href="biens.php">Vendu</a></li>
                                <li><i class="fa fa-table"></i><a href="biens.php">Loué</a></li>
                            </ul>
                        </li>
                </ul>-->
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">


                <div class="col-sm-12">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                                

                                <a class="nav-link" href="logout.php"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

         

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Pages d'administration</h1>
                    </div>
                </div>
            </div>
 
        </div>
         <div class="card-header"><strong>Ajouter un bien immobilier</strong>      </div>
        <div class="row">
           <div class="col-lg-6">
                    <div class="card">
               
                      <div class="card-body card-block">
                        <form>
                        <input type="hidden" name="admin_action" value="add_bien">
                        <div class="form-group"><label for="company" class=" form-control-label">Nom</label><input type="text" id="company" placeholder="Nom" class="form-control" name="bien_nom"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Prix</label><input type="text" id="company" placeholder="CHF" class="form-control" name="bien_prix"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Nombre de pièces</label><input type="text" id="company" placeholder="Pièces" class="form-control" name="bien_piece"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Nombre de chambres</label><input type="text" id="company" placeholder="Chambres" class="form-control" name="bien_chambre"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Surface</label><input type="text" id="company" placeholder="m2" class="form-control" name="bien_surface"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Surface de terrain</label><input type="text" id="company" placeholder="Nom" class="form-control" name="bien_surface_terrain"></div>
                        <div class="form-group"><label for="textarea-input" class=" form-control-label">Description</label>
                        <textarea id="textarea-input" rows="6" placeholder="Contenu.." class="form-control" name="bien_desc"></textarea></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Situation</label><input type="text" id="company" placeholder="Description" class="form-control" name="bien_situation"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Particularité</label><input type="text" id="company" placeholder="Description" class="form-control" name="bien_particularite"></div>

                        <div class="form-group">
                            <label for="company" class=" form-control-label">Photos</label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" class="form-control"/>
                            <input type="file" name="pictures[]" accept="image/*"/ multiple class="form-control">
                        </div>

                    </div>
                </div>
            </div>
  <div class="col-lg-6">
                    <div class="card">
     <div class="card-body card-block">
                 

                        <div class="form-group"><label for="company" class=" form-control-label">Niveau</label><input type="text" id="company" placeholder="Nom" class="form-control" name="bien_niveau"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">Nombre d'étages</label><input type="text" id="company" placeholder="WC" class="form-control" name="bien_nbre_niveau"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Nombre de WC</label><input type="text" id="company" placeholder="WC" class="form-control" name="bien_nbre_WC"></div>


                        <div class="form-group"><label for="company" class=" form-control-label">Charges</label><input type="text" id="company" placeholder="Nom" class="form-control" name="bien_charges"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">Année de construction</label><input type="text" id="company" placeholder="Année" class="form-control" name="bien_annee"></div> 
                        <div class="form-group"><label for="company" class=" form-control-label">Disponibilité</label><input type="text" id="company" placeholder="Nom" class="form-control" name="bien_disponibilite"></div>



                               <div class="row form-group">
                            <div class="col col-md-3"><label class=" form-control-label">Favoris</label></div>
                            <div class="col col-md-9">
                              <div class="form-check">
                                <div class="radio">
                                  <label for="radio1" class="form-check-label ">
                                    <input type="radio" id="radio1" name="bien_favori" value="1" class="form-check-input">Oui
                                  </label>
                                </div>
                                <div class="radio">
                                  <label for="radio3" class="form-check-label ">
                                    <input type="radio" id="radio3" name="bien_favori" value="0" class="form-check-input">Non
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>


                        <div class="form-group"><label for="company" class=" form-control-label">Google Maps source</label><input type="text" id="company" placeholder="https://www.google.com/maps/embed ..." class="form-control" name="bien_gmaps"></div>


                        <div class="form-group">
                        <label for="company" class=" form-control-label">Types de bien</label>
                        <select name="bien_type_id"  class="form-control">
                        <?php
                            foreach ($types as $item) {
                              echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
                            }
                        ?>
                        </select>
                        </div> 

                        <div class="form-group"><label for="company" class=" form-control-label">Adresse</label><input type="text" id="company" placeholder="Nom" class="form-control" name="bien_adresse"></div>


                        <div class="form-group">
                        <label for="company" class=" form-control-label">Canton</label>
                        <select name="bien_canton_id" id="canton" class="form-control" onchange="fetch_select(this.value);">
                        <?php
                            foreach ($cantons as $item) {
                                echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
                            }
                        ?>
                        </select>
                        </div> 

                        <div class="form-group">
                        <label for="company" class=" form-control-label">Localité</label>
                        <select name="bien_localite_id" class="form-control" id="localite">
                        <?php
                          foreach ($localites as $item) {
                            echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
                          }
                        ?>
                        </select>
                        </div>

                        <div class="form-group">
                        <label for="company" class=" form-control-label">Catégorie</label>
                        <select name="bien_categorie_id" class="form-control">
                        <?php
                            foreach ($categories as $item) {
                              echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
                            }
                        ?>
                        </select>
                        </div> 


                        <div class="form-group">
                        <label for="company" class=" form-control-label">Agent</label>
                        <select name="bien_agent_id" class="form-control">
                        <?php
                            foreach ($agents as $item) {
                              echo "<option value='".$item['ID']."'>".$item['nom']." ".$item['prenom']."</option>";
                            }
                        ?>
                        </select>
                        </select>
                        </div>                   
                        <button type="submit" class="btn btn-primary btn-m">
                        <i class="fa fa-dot-circle-o"></i> Valider</button>
                    </div>
                    </form>
                  
                        </div>
                    </div>

                  </div>

    <!-- Right Panel -->

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>

    <script type="text/javascript">
    function fetch_select(val)
    {
     jQuery.ajax({
     type: 'post',
     url: '../vendor/script/fetch_localite.php',
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
