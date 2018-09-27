<?php
	session_start();

	if (isset($_SESSION['is_logged'])) {

		if ($_SESSION['is_logged'] != "#çl0rd$!#ç2") {
			header('Location: page-login.php');
		}

		require_once "../vendor/script/db_connect.php";
		require_once "../vendor/script/basic_query.php";

		
		if (isset($_GET['admin_action'])) {
			
			//Page agent
			if ($_GET['admin_action'] == "add_agent") {
				$hash = hash('sha256', $_GET['agent_hash']."l0rdç$!");
				$check_mail = $bdd->query("SELECT * from agent WHERE mail LIKE '".$_GET['agent_mail']."'");
				if ($check_mail->rowCount() > 0) {
					echo "<script>alert('Mail déjà enregistré !')</script>";
				} else {
					$bdd->exec("INSERT INTO  agent (nom, prenom, mail, hash, admin) VALUES ('".$_GET['agent_nom']."','".$_GET['agent_prenom']."','".$_GET['agent_mail']."','".$hash."','1')");
				}
			}

			if ($_GET['admin_action'] == "add_canton") {
				$check_canton = $bdd->query("SELECT * FROM canton WHERE LOWER(nom) LIKE LOWER('".$_GET['canton_name']."')");
				if ($check_canton->rowCount() > 0) {
					echo "<script>alert('Canton déjà enregistré !')</script>";
				} else {
					$bdd->exec("INSERT INTO canton(nom) VALUES ('".$_GET['canton_name']."')");
				}
			}

			if ($_GET['admin_action'] == "add_localite") {
				$check_localite = $bdd->query("SELECT * FROM localite WHERE LOWER(nom) LIKE LOWER('".$_GET['localite_name']."') OR NPA = ".$_GET['localite_npa']);
				if ($check_localite->rowCount() > 0) {
					echo "<script>alert('Localité peut-être déjà enregistré, vérifier les données entrées !')</script>";
				} else {
					$bdd->exec("INSERT INTO localite(nom,NPA,fk_Canton_ID) VALUES ('".$_GET['localite_name']."',".$_GET['localite_npa'].",".$_GET['canton_id'].")");
				}
			}

			if ($_GET['admin_action'] == "add_type") {
				$check_type = $bdd->query("SELECT * FROM type WHERE LOWER(nom) LIKE LOWER('".$_GET['type_name']."')");
				if ($check_type->rowCount() > 0) {
					echo "<script>alert('Type de bien déjà enregistré !')</script>";
				} else {
					$bdd->exec("INSERT INTO type(nom, description) VALUES ('".$_GET['type_name']."','".$_GET['type_desc']."')");
				}
			}

			if ($_GET['admin_action'] == "add_bien") {

				require_once  "../vendor/bulletproof/bulletproof.php";
				require_once  "../vendor/script/bulletproof_config.php";

				if (isset($_GET['bien_favori'])) {
					$bien_favori = $_GET['bien_favori'];
				} else {
					$bien_favori = 0;
				}
				
				$bdd->exec("INSERT INTO bien VALUES (NULL,'".$_GET['bien_nom']."','".$_GET['bien_prix']."','".$_GET['bien_piece']."','".$_GET['bien_chambre']."','".$_GET['bien_surface']."','".$_GET['bien_adresse']."','".$_GET['bien_annee']."','".$_GET['bien_desc']."','".$_GET['bien_situation']."','".$_GET['bien_particularite']."','".$_GET['bien_niveau']."','".$_GET['bien_nbre_WC']."','".$_GET['bien_nbre_niveau']."','".$_GET['bien_charges']."','".$_GET['bien_surface_terrain']."','".$_GET['bien_disponibilite']."',".$bien_favori.",'".$_GET['bien_gmaps']."',".$_GET['bien_type_id'].",".$_GET['bien_localite_id'].",".$_GET['bien_categorie_id'].",".$_GET['bien_agent_id'].",'".time()."')");

				if(isset($_FILES['pictures'])) {
					$img = $_FILES['pictures'];

					$last_reg = $bdd->query('SELECT * FROM bien WHERE nom LIKE "'.$_GET['bien_nom'].'" ORDER BY creation_date DESC')->fetchAll(PDO::FETCH_ASSOC);

					if(!empty($img))
					{
					    $img_desc = reArrayFiles($img);
					    
					    foreach($img_desc as $val)
					    {
					        $image = new Bulletproof\Image($val);
							$image->setLocation($bulletproof_upload_dir);
							$image->setSize($bulletproof_size_min, $bulletproof_size_max);
							$image->setMime($bulletproof_accepted_format);
							
							if($image->upload()){
								$bdd->exec("INSERT INTO photo(name, selected, fk_bien_ID) VALUES ('".$image->getFullPath()."',0,".$last_reg[0]['ID'].")");
							} else {
								echo $image->getError();
							}
					    }
					}
				}

			}

		} 
	}
	else {
		header('Location: page-login.php');
	}
?>