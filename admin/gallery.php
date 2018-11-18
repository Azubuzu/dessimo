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
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
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
                         <a href="mandataires.php"> <i class="menu-icon ti-announcement"></i>Mandataires</a>
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

            <?php
            if (!isset($_GET['bien_ID'])) {
                $biens = $bdd->query("SELECT *,bien.ID AS bien_ID,bien.nom AS bien_nom,type.nom AS type_nom, localite.nom AS local_nom, bien.description AS bien_desc,categorie.nom AS cat_nom FROM bien INNER JOIN categorie ON categorie.ID = fk_Categorie_ID INNER JOIN type ON type.ID = fk_Type_ID INNER JOIN localite ON localite.ID = fk_Localite_ID ORDER BY bien.ID DESC")->fetchAll(PDO::FETCH_ASSOC);
            ?>   

        <div class="col-lg-12">
                    <div class="card">
                         <div class="card-header"><strong>Sélectionner le bien immobilier</strong>      </div>
                            <div class="card-body card-block">
                            <form>
                        <div class="form-group">
                        <label for="company" class=" form-control-label">Types de bien</label>
                        <select id="type_ID" class="form-control" onchange="fetch_select();">
                        <option value="0">Tous les types</option>
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
                        <option value="0">Toutes les localités</option>
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

        <?php
        }
        ?>


        <?php
        if (isset($_GET['bien_ID'])) {

            $select_photos = $bdd->prepare("SELECT bien.nom AS bien_nom,bien.ID AS bien_ID,photo.name AS photo_nom,photo.selected,photo.ID AS photo_ID,photo.position,photo.onPDF FROM photo INNER JOIN bien ON bien.ID = fk_bien_ID WHERE fk_bien_ID = :bien_ID ORDER BY photo.position,photo.ID");
            $select_photos->execute(
                array(
                    ':bien_ID' => $_GET['bien_ID'], 
            ));
            $photos = $select_photos->fetchAll();
        ?> 
  <div class="col-lg-12">
                    <div class="card">
                         <div class="card-header"><strong>Gallerie de : <?php echo $photos[0]['bien_nom'] ?> </strong>      </div>
     <div class="card-body card-block">
                 

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                    <th>Photo</th>
                                    <th>Favori</th>
                                    <th>Sur PDF</th>
                                    <th>Ordre</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    foreach ($photos as $photo) {
                                    ?>

                                    <tr>
                                         <td style="width: 70%;">     
                                            <a href="#" class="d-block  h-45">
                                            <img class="img-fluid img-thumbnail" src="../images/upload/<?php echo $photo['photo_nom'] ?>" alt="">
                                            </a>
                                        </td>

                                        <td style="width: 2%;"><?php echo ($photo['selected'] == 1) ? "Oui" : "Non"; ?></td>
                                        <td style="width: 2%;">
                                            <input type="checkbox" name="onPDF" onchange="change_onPDF(<?php echo $photo['photo_ID'] ?>,this.checked);" <?php echo ($photo['onPDF'] == 1) ? "checked" : ""; ?>>
                                        </td>

                                        <td style="width: 10%;">
                                            <select id="order" class="form-control" onchange="change_order(<?php echo $photo['photo_ID'] ?>,this.value);">
                                                <option value="9000">Aucun</option>
                                                <?php
                                                for ($i=0; $i < count($photos); $i++) {
                                                    if ($photo['position'] == $i+1) 
                                                        echo '<option value="'.($i + 1).'" selected>'.($i + 1).'</option>';
                                                    else
                                                        echo '<option value="'.($i + 1).'">'.($i + 1).'</option>';
                                                    
                                                } 
                                                ?>
                                            </select>
                                        </td>

                                        <td style="width: 15%;">
                                            <a href="gallery.php?admin_action=modif_gallery&bien_ID=<?php echo $photo['bien_ID']; ?>&photo_ID=<?php echo $photo['photo_ID']; ?>">
                                                <button type="button" class="btn btn-info">
                                                    <i class="fa fa-star"></i>&nbsp;favori 
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteWarning" onclick="deleteElementGallery(<?php echo $photo['photo_ID'].",".$photo['bien_ID'].",'cette photo','gallery'";?>)">
                                            <i class="fa fa-trash"></i>&nbsp; 
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                                                       
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <?php
        }
        ?>

    <!-- Right Panel -->
   <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/lib/data-table/datatables-init.js"></script>
    <script type="text/javascript">
    function change_order(id,val)
    {
        $.ajax({
        type: 'post',
        url: '../vendor/script/change_order.php',
        data: {
            photo_ID:id,
            order:val
        },
        success: function (response) {
            window.location.reload(false);
        }
        });
    }

    function change_onPDF(id,val)
    {
        $.ajax({
        type: 'post',
        url: '../vendor/script/change_onPDF.php',
        data: {
            photo_ID:id,
            onPDF:val
        },
        success: function (response) {
            //window.location.reload(false);
        }
        });
    }

    </script>

        <!-- Modal -->
    <div class="modal fade" id="deleteWarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Attention !</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modal_message">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <a href="" id="modal_delete_button"><button type="button" class="btn btn-danger">SUPPRIMER</button></a>
          </div>
        </div>
      </div>
    </div>



</body>
</html>
