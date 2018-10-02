<?php
    require_once "admin_manager.php";

    $biens = $bdd->query("SELECT *,bien.ID AS bien_ID,bien.nom AS bien_nom,type.nom AS type_nom, localite.nom AS local_nom, bien.description AS bien_desc,categorie.nom AS cat_nom FROM bien INNER JOIN categorie ON categorie.ID = fk_Categorie_ID INNER JOIN type ON type.ID = fk_Type_ID INNER JOIN localite ON localite.ID = fk_Localite_ID ORDER BY bien.ID DESC")->fetchAll(PDO::FETCH_ASSOC);
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

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>




</style>


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
                         <a href="clients.php"> <i class="menu-icon ti-wheelchair"></i>Clients</a>
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

                        <li>
                         <a href="biens.php"> <i class="menu-icon ti-home"></i>Biens</a>
                        </li>


                        <li class="menu-item-has-children dropdown active" >
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <i class="menu-icon ti-gallery"></i>Photos</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="ti-gallery"></i><a href="photos.php">Ajouter une photo</a></li>
                                <li><i class="ti-gallery"></i><a href="gallery.php">Gallerie</a></li>
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
        <form method="POST" enctype="multipart/form-data" action="photos.php?admin_action=add_photo">
        <div class="row">



</div>



           <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header"><strong>Ajouter une photo</strong></div>
                      <div class="card-body card-block">
                        
                        <div class="form-group">
                            <label for="company" class=" form-control-label">Sélectionner les images</label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" class="form-control"/>
                            <input type="file" name="pictures[]" accept="image/*" multiple class="form-control"/>
                        </div>


                    </div>
                </div>
            </div>
  <div class="col-lg-6">
                    <div class="card">
                         <div class="card-header"><strong>Sélectionner le bien immobilier</strong>      </div>
     <div class="card-body card-block">
                 


            
                            
                        <input type="hidden" name="admin_action" value="add_photo">
                        <div class="form-group">
                        <label for="company" class=" form-control-label">Types de bien</label>
                        <select id="type_ID" class="form-control" onchange="fetch_select();">
                        <option value="0">Sélectionner un type</option>
                            <?php
                            foreach ($types as $type) {
                                echo '<option value="'.$type["ID"].'">'.$type["nom"].'</option>';
                            }
                            ?>
                        </select>
                        </div> 


                        <div class="form-group">
                        <label for="company" class=" form-control-label">Localité</label>
                        <select id="localite_ID" class="form-control" onchange="fetch_select();">
                        <option value="0">Sélectionner une ville</option>
                            <?php
                            $all_local = $bdd->query('SELECT * FROM localite ORDER BY nom')->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($all_local as $local) {
                                echo '<option value="'.$local["ID"].'">'.$local["nom"].'</option>';
                            }
                            ?>
                        </select>
                        </div>  


                      <div class="form-group">
                        <label for="company" class=" form-control-label"><bold>Bien sélectionné</bold></label>
                        <select name="bien_ID" id="bien" class="form-control" data-live-search="true">
                            <option value="">Sélectionner un bien</option>
                            <?php
                            foreach ($biens as $bien) {
                                echo '<option value="'.$bien["bien_ID"].'">'.$bien["bien_nom"].'</option>';
                            }
                            ?>
                        </select>
                        </div> 


                   
                        <button type="submit" class="btn btn-primary btn-m">
                        <i class="fa fa-dot-circle-o"></i> Valider</button>
                        </form> 
                  
                   



</div>
</div>







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
    function fetch_select()
    {
     jQuery.ajax({
     type: 'post',
     url: '../vendor/script/fetch_localite.php',
     data: {
      photo_search:1,
      type_ID:document.getElementById("type_ID").value,
      localite_ID:document.getElementById("localite_ID").value
     },
     success: function (response) {
      document.getElementById("bien").innerHTML=response; 
     }
     });
    }

    </script>



</body>
</html>
