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
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
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

                        <li class="active">
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


        <?php
        if (!isset($_GET['client_ID']) && !isset($_GET['add_client'])) {
            $clients = $bdd->query('SELECT *,client.ID AS client_ID,client.nom AS client_nom,statut.nom AS statut_nom FROM client INNER JOIN statut ON statut.ID = fk_statut_ID')->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Listes des clients</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Nom</th>
                        <th>E-mail</th>
                        <th>Statut</th>
                        <th>Remarques</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                        foreach ($clients as $client) {
                    ?>

                    <tr>
                        <td><?php echo $client['client_nom']." ".$client['prenom'];?></td>
                        <td><?php echo $client['email'];?></td>
                        <td><?php echo $client['statut_nom'];?></td>
                        <td><?php echo $client['remarque'];?></td>
                        <td>
                            <a href="clients.php?client_ID=<?php echo $client['client_ID'];?>"><button type="button" class="btn btn-info"><i class="fa fa-edit"></i>&nbsp; </button></a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteWarning" onclick="changeClientID(<?php echo $client['client_ID'].",'".$client['client_nom']."','".$client['prenom']."'";?>)">
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
            </div><!-- .animated -->
        </div><!-- .content -->
        <?php
        }
        ?>





            <?php
            if (isset($_GET['client_ID'])) {
                $statuts = $bdd->query('SELECT * FROM statut')->fetchAll(PDO::FETCH_ASSOC);
                $request = $bdd->prepare('SELECT *,client.ID AS client_ID,client.nom AS client_nom,statut.nom AS statut_nom,statut.ID AS statut_ID FROM client INNER JOIN statut ON statut.ID = fk_statut_ID WHERE client.ID = :client_ID');
                $request->execute(
                    array(
                        ':client_ID' => $_GET['client_ID'],
                    ));
                $clients = $request->fetchAll();
            ?>

           <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Modifier un client</strong></div>
                    <div class="card-body card-block">

                    <form>
                    <input type="hidden" name="admin_action" value="modif_client">
                    <input type="hidden" name="client_ID" value="<?php echo $clients[0]['client_ID'];?>">
                    <div class="form-group">
                        <label for="company" class=" form-control-label">Nom</label>
                        <input type="text" id="company" placeholder="Nom" class="form-control" name="client_nom" value="<?php echo $clients[0]['client_nom'];?>">
                    </div>

                    <div class="form-group">
                        <label for="company" class=" form-control-label">Prénom</label>
                        <input type="text" id="company" placeholder="Prénom" class="form-control" name="client_prenom" value="<?php echo $clients[0]['prenom'];?>">
                    </div>

                    <div class="form-group">
                        <label for="company" class=" form-control-label">E-mail</label>
                        <input type="text" id="company" placeholder="Nom" class="form-control" name="client_email" value="<?php echo $clients[0]['email'];?>">
                    </div>

                    <div class="form-group">
                        <label class=" form-control-label">Statut</label>
                        <select name="client_statut_ID" id="select" class="form-control">
                        <?php
                        foreach ($statuts as $statut) {
                            if ($statut['ID'] == $clients[0]['ID'])
                                echo "<option value='".$statut['ID']."' selected>".$statut['nom']."</option>";
                            else 
                                 echo "<option value='".$statut['ID']."'>".$statut['nom']."</option>";                          
                        }
                        ?>
                        </select>
                    </div> 

                     <div class="form-group"><label for="textarea-input" class=" form-control-label">Remarques</label>
                    <textarea name="client_remarque" id="textarea-input" rows="5" placeholder="Contenu.." class="form-control"><?php echo $clients[0]['remarque'];?></textarea></div>

               
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
            if (isset($_GET['add_client'])) {
                $statuts = $bdd->query('SELECT * FROM statut')->fetchAll(PDO::FETCH_ASSOC);
                ?>
            <div class="col-lg-12">
                <div class="card">
                  <div class="card-header"><strong>Ajouter un client</strong></div>
                  <div class="card-body card-block">
                    <form>
                    <input type="hidden" name="admin_action" value="add_client">
                    <input type="hidden" name="client_ID" value="<?php echo $clients[0]['client_ID'];?>">
                    <div class="form-group">
                        <label for="company" class=" form-control-label">Nom</label>
                        <input type="text" id="company" placeholder="Nom" class="form-control" name="client_nom">
                    </div>

                    <div class="form-group">
                        <label for="company" class=" form-control-label">Prénom</label>
                        <input type="text" id="company" placeholder="Prénom" class="form-control" name="client_prenom">
                    </div>

                    <div class="form-group">
                        <label for="company" class=" form-control-label">E-mail</label>
                        <input type="text" id="company" placeholder="Nom" class="form-control" name="client_email">
                    </div>

                    <div class="form-group">
                        <label class=" form-control-label">Statut</label>
                        <select name="client_statut_ID" id="select" class="form-control">
                        <?php
                        foreach ($statuts as $statut) {
                            echo "<option value='".$statut['ID']."'>".$statut['nom']."</option>";                          
                        }
                        ?>
                        </select>
                    </div> 

                     <div class="form-group"><label for="textarea-input" class=" form-control-label">Remarques</label>
                    <textarea name="client_remarque" id="textarea-input" rows="5" placeholder="Contenu.." class="form-control"></textarea></div>

               
                    <button type="submit" class="btn btn-primary btn-m">
                    <i class="fa fa-dot-circle-o"></i> Valider</button>
                    </form>
              
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
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>

    <script type="text/javascript">
        function changeClientID(client_ID,client_nom,client_prenom) {
            document.getElementById("modal_message").innerHTML = "Êtes-vous sûr de vouloir supprimer " + client_nom + " " + client_prenom + " ?";
            document.getElementById("modal_delete_button").href = "clients.php?admin_action=delete_client&delete_client_ID=" + client_ID;
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
