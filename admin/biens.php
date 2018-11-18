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


        <link rel="stylesheet" href="assets/css/lib/lord-main.css">

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

                        <li class="active">
                         <a href="biens.php"> <i class="menu-icon ti-home"></i>Biens</a>
                        </li>

                        <li class="menu-item-has-children dropdown">
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


            <?php
        if (!isset($_GET['bien_ID']) && !isset($_GET['add_bien'])) {

            $biens = $bdd->query("SELECT *,bien.ID AS bien_ID,bien.nom AS bien_nom,type.nom AS type_nom, localite.nom AS local_nom, bien.description AS bien_desc,categorie.nom AS cat_nom FROM bien INNER JOIN categorie ON categorie.ID = fk_Categorie_ID INNER JOIN type ON type.ID = fk_Type_ID INNER JOIN localite ON localite.ID = fk_Localite_ID")->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Listes des Biens</strong>
                        </div>
                        <div class="card-body">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Nom</th>
                        <th>Type de bien</th>
                        <th>Catégorie</th>
                        <th>Favori</th>
                        <th>Date de création</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                        foreach ($biens as $bien) {
                    ?>

                    <tr>
                        <td><?php echo $bien['bien_nom'];?></td>
                        <td><?php echo $bien['type_nom'];?></td>
                        <td><?php echo $bien['cat_nom'];?></td>
                        <td><?php echo $bien['favori'];?></td>
                        <td><?php echo date('d/m/Y', $bien['creation_date']);?></td>
                        <td>
                            <a href="biens.php?bien_ID=<?php echo $bien['bien_ID'];?>"><button type="button" class="btn btn-info"><i class="fa fa-edit"></i>&nbsp; </button></a>
                            <a href="pdf_generator.php?bien_ID=<?php echo $bien['bien_ID'];?>"><button type="button" class="btn btn-success"><i class="fa fa-file-pdf-o"></i>&nbsp; </button></a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteWarning" onclick="deleteElement(<?php echo $bien['bien_ID'].",'".$bien['bien_nom']."','bien'";?>)">
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
                        <div class="lord-button" style="margin-left :25px; margin-bottom: 25px;">
                    <a href="biens.php?add_bien"><button type="submit" class="btn btn-success btn-m">
                    <i class="fa fa-plus"></i> Ajouter un bien</button></div>
                    </div>
                </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        <?php
        }
        ?>


<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        
         <?php
        if (isset($_GET['bien_ID']) && !isset($_GET['add_bien'])) {
            
            $bien_selected = $bdd->prepare("SELECT *,bien.ID AS bien_ID,bien.nom AS bien_nom,type.nom AS type_nom, localite.nom AS local_nom, bien.description AS bien_desc FROM bien INNER JOIN categorie ON categorie.ID = fk_Categorie_ID INNER JOIN type ON type.ID = fk_Type_ID INNER JOIN localite ON localite.ID = fk_Localite_ID WHERE bien.ID =:bien_ID");
            $bien_selected->execute(
                array(
                    ':bien_ID' => $_GET['bien_ID'],
            ));
            $bien = $bien_selected->fetchAll();
            
        ?>
 
        </div>
         <div class="card-header"><strong>Modifier un bien immobilier</strong>      </div>
         <form method="POST" enctype="multipart/form-data" action="biens.php?admin_action=modif_bien&bien_ID=<?php echo $bien[0]['bien_ID']; ?>"> 
        <div class="row">
           
           <div class="col-lg-6">
                    <div class="card">
               
                      <div class="card-body card-block">
                        <div class="form-group"><label for="company" class=" form-control-label">Nom</label><input type="text" id="company" placeholder="Nom" class="form-control" name="bien_nom" value="<?php echo $bien[0]['bien_nom']; ?>"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Prix</label><input type="number" id="company" placeholder="CHF" class="form-control" name="bien_prix" value="<?php echo $bien[0]['prix']; ?>"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Nombre de pièces</label><input type="text" id="company" placeholder="Pièces" class="form-control" name="bien_piece" value="<?php echo $bien[0]['piece']; ?>"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Nombre de chambres</label><input type="text" id="company" placeholder="Chambres" class="form-control" name="bien_chambre" value="<?php echo $bien[0]['chambre']; ?>"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">Chauffage</label><input type="text" id="company" placeholder="Chauffage" class="form-control" name="bien_chauffage" value="<?php echo $bien[0]['chauffage']; ?>"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">Surface</label><input type="text" id="company" placeholder="m2" class="form-control" name="bien_surface" value="<?php echo $bien[0]['surface']; ?>"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Surface de terrain</label><input type="text" id="company" placeholder="Nom" class="form-control" name="bien_surface_terrain" value="<?php echo $bien[0]['surface_terrain']; ?>"></div>
                        <div class="form-group"><label for="textarea-input" class=" form-control-label">Description</label>

                        <textarea id="textarea-input" rows="4" placeholder="Contenu.." class="form-control" name="bien_desc"><?php echo $bien[0]['bien_desc']; ?></textarea></div>
                        <div class="form-group"><label for="textarea-input" class=" form-control-label">Commodités</label>
                        <textarea id="textarea-input" rows="4" placeholder="Contenu.." class="form-control" name="bien_commodite"><?php echo $bien[0]['commodite']; ?></textarea></div>

                        <div class="form-group"><label for="company" class=" form-control-label">Situation</label><input type="text" id="company" placeholder="Description" class="form-control" name="bien_situation" value="<?php echo $bien[0]['situation']; ?>"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Particularité</label><input type="text" id="company" placeholder="Description" class="form-control" name="bien_particularite" value="<?php echo $bien[0]['particularite']; ?>"></div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body card-block">
                 

                        <div class="form-group"><label for="company" class=" form-control-label">Niveau</label><input type="text" id="company" placeholder="Nom" class="form-control" name="bien_niveau" value="<?php echo $bien[0]['niveau']; ?>"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">Nombre d'étages</label><input type="text" id="company" placeholder="WC" class="form-control" name="bien_nbre_niveau" value="<?php echo $bien[0]['nbre_niveau']; ?>"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">Nombre de WC</label><input type="text" id="company" placeholder="WC" class="form-control" name="bien_nbre_WC" value="<?php echo $bien[0]['nbre_WC']; ?>"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">Charges</label><input type="text" id="company" placeholder="Nom" class="form-control" name="bien_charges" value="<?php echo $bien[0]['charges']; ?>"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">Année de construction</label><input type="text" id="company" placeholder="Année" class="form-control" name="bien_annee" value="<?php echo $bien[0]['annee']; ?>"></div> 
                        <div class="form-group"><label for="company" class=" form-control-label">Disponibilité</label><input type="text" id="company" placeholder="Nom" class="form-control" name="bien_disponibilite" value="<?php echo $bien[0]['disponibilite']; ?>"></div>



                        <div class="row form-group">
                            <div class="col col-md-3"><label class=" form-control-label">Favoris</label></div>
                            <div class="col col-md-9">
                              <div class="form-check">
                                <div class="radio">
                                  <label for="radio1" class="form-check-label ">
                                    <?php 
                                        if ($bien[0]['favori'] == 1)
                                            echo '<input type="radio" id="radio1" name="bien_favori" value="1" class="form-check-input" checked>Oui';
                                        else
                                            echo '<input type="radio" id="radio1" name="bien_favori" value="1" class="form-check-input">Oui';
                                        
                                    ?>
                                  </label>
                                </div>
                                <div class="radio">
                                  <label for="radio3" class="form-check-label ">
                                    <?php 
                                        if ($bien[0]['favori'] == 0) 
                                            echo '<input type="radio" id="radio3" name="bien_favori" value="0" class="form-check-input" checked>Non';
                                        else
                                            echo '<input type="radio" id="radio3" name="bien_favori" value="0" class="form-check-input">Non';
                                        
                                    ?>
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>


                        <div class="form-group"><label for="company" class=" form-control-label">Google Maps source</label><input type="text" id="company" placeholder='<iframe src="https://www.google.com/maps/embed ...' class="form-control" name="bien_gmaps" value="<?php echo $bien[0]['gmaps']; ?>"></div>


                        <div class="form-group">
                        <label for="company" class=" form-control-label">Types de bien</label>
                        <select name="bien_type_id"  class="form-control">
                        <?php
                            foreach ($types as $item) {
                                if ($item['ID'] == $bien[0]['fk_Type_ID'])
                                    echo "<option value='".$item['ID']."' selected>".$item['nom']."</option>";
                                else
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
                            if ($item['ID'] == $bien[0]['fk_Localite_ID'])
                                echo "<option value='".$item['ID']."' selected>".$item['nom']."</option>";
                            else
                                echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
                          }
                        ?>
                        </select>
                        </div>

                        <div class="form-group">
                        <label for="company" class=" form-control-label">Catégorie</label>
                        <select name="bien_categorie_id" class="form-control">
                        <?php
                            foreach ($categories_admin as $item) {
                                if ($item['ID'] == $bien[0]['fk_Categorie_ID'])
                                    echo "<option value='".$item['ID']."' selected>".$item['nom']."</option>";
                                else
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
                                if ($item['ID'] == $bien[0]['fk_Agent_ID'])
                                    echo "<option value='".$item['ID']."' selected>".$item['nom']." ".$item['prenom']."</option>";
                                else
                                    echo "<option value='".$item['ID']."'>".$item['nom']." ".$item['prenom']."</option>";
                            }
                        ?>
                        </select>
                        </div>                   
                        <button type="submit" class="btn btn-primary btn-m">
                        <i class="fa fa-dot-circle-o"></i> Valider</button>
                    </div>
                </div>
            </div>
        
        </div>
        </form>
        <?php
        }
        ?>


        <!-- Add a new client ///////////////////////////////////////////////////////////////////////////////////////////// -->

         <?php
        if (!isset($_GET['bien_ID']) && isset($_GET['add_bien'])) {            
        ?>
 
        </div>
         <div class="card-header"><strong>Ajouter un bien immobilier</strong>      </div>
         <form method="POST" enctype="multipart/form-data" action="biens.php?admin_action=add_bien"> 
        <div class="row">
           
           <div class="col-lg-6">
                    <div class="card">
               
                      <div class="card-body card-block">
                        <div class="form-group"><label for="company" class=" form-control-label">Nom</label><input type="text" id="company" placeholder="Nom" class="form-control" name="bien_nom"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Prix</label><input type="number" id="company" placeholder="CHF" class="form-control" name="bien_prix"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Nombre de pièces</label><input type="text" id="company" placeholder="Pièces" class="form-control" name="bien_piece"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Nombre de chambres</label><input type="text" id="company" placeholder="Chambres" class="form-control" name="bien_chambre"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">Chauffage</label><input type="text" id="company" placeholder="Chauffage" class="form-control" name="bien_chauffage"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">Surface</label><input type="text" id="company" placeholder="m2" class="form-control" name="bien_surface"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Surface de terrain</label><input type="text" id="company" placeholder="Nom" class="form-control" name="bien_surface_terrain"></div>
                        <div class="form-group"><label for="textarea-input" class=" form-control-label">Description</label>

                        <textarea id="textarea-input" rows="4" placeholder="Contenu.." class="form-control" name="bien_desc"></textarea></div>
                        <div class="form-group"><label for="textarea-input" class=" form-control-label">Commodités</label>
                        <textarea id="textarea-input" rows="4" placeholder="Contenu.." class="form-control" name="bien_commodite"></textarea></div>

                        <div class="form-group"><label for="company" class=" form-control-label">Situation</label><input type="text" id="company" placeholder="Description" class="form-control" name="bien_situation"></div>
                        <div class="form-group"><label for="company" class=" form-control-label">Particularité</label><input type="text" id="company" placeholder="Description" class="form-control" name="bien_particularite"></div>

                        <div class="form-group">
                            <label for="company" class=" form-control-label">Photos</label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" class="form-control"/>
                            <input type="file" name="pictures[]" accept="image/*" multiple class="form-control"/>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body card-block">
                 

                        <div class="form-group"><label for="company" class=" form-control-label">Niveau</label><input type="text" id="company" placeholder="Nom" class="form-control" name="bien_niveau"></div>

                        <div class="form-group"><label for="company" class=" form-control-label">Nombre d'étages</label><input type="text" id="company" placeholder="Nombre" class="form-control" name="bien_nbre_niveau"></div>

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


                        <div class="form-group"><label for="company" class=" form-control-label">Google Maps source</label><input type="text" id="company" placeholder='<iframe src="https://www.google.com/maps/embed ...' class="form-control" name="bien_gmaps"></div>


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
                            foreach ($categories_admin as $item) {
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
                        </div>                   
                        <button type="submit" class="btn btn-primary btn-m">
                        <i class="fa fa-dot-circle-o"></i> Valider</button>
                    </div>
                </div>
            </div>
        
        </div>
        </form>
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
    function fetch_select(val)
    {
     jQuery.ajax({
     type: 'post',
     url: '../vendor/script/fetch_localite.php',
     data: {
      get_localite_by_canton_no_wildcard:val
     },
     success: function (response) {
      document.getElementById("localite").innerHTML=response; 
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
