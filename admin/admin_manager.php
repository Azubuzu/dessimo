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

			if ($_GET['admin_action'] == "add_client") {
				$add_client = $bdd->prepare('INSERT INTO client VALUES(NULL,:client_nom,:client_prenom,:client_email,:client_remarque,:client_statut_ID)');
				$add_client->execute(
					array(
						':client_email' => $_GET['client_email'],
						':client_nom' => $_GET['client_nom'], 
						':client_prenom' => $_GET['client_prenom'], 
						':client_remarque' => $_GET['client_remarque'], 
						':client_statut_ID' => $_GET['client_statut_ID'], 
				));

				header('Location: clients.php');
			}

			if ($_GET['admin_action'] == "modif_client") {
				$update_client = $bdd->prepare('UPDATE client SET email = :client_email, nom = :client_nom, prenom = :client_prenom, remarque = :client_remarque, fk_statut_ID = :client_statut_ID WHERE client.ID = :client_ID;');
				$update_client->execute(
					array(
						':client_email' => $_GET['client_email'],
						':client_nom' => $_GET['client_nom'], 
						':client_prenom' => $_GET['client_prenom'], 
						':client_remarque' => $_GET['client_remarque'], 
						':client_statut_ID' => $_GET['client_statut_ID'], 
						':client_ID' => $_GET['client_ID'], 
				));

				header('Location: clients.php');
			}

			if ($_GET['admin_action'] == "delete_client") {
				$update_client = $bdd->prepare('DELETE FROM client WHERE client.ID = :client_ID');
				$update_client->execute(
					array(
						':client_ID' => $_GET['delete_client_ID'],
				));			
			}

			if ($_GET['admin_action'] == "add_bien") {

				if (isset($_POST['bien_favori'])) {
					$bien_favori = $_POST['bien_favori'];
				} else {
					$bien_favori = 0;
				}

				if ($_POST['bien_gmaps'] == "") {
					$gmaps_data = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1379.766188734781!2d7.367825183637874!3d46.23964330916706!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDbCsDE0JzIyLjciTiA3wrAyMicwNy4wIkU!5e0!3m2!1sfr!2sch!4v1538052863523";
				}
				else {
					$gmaps_data = getBetween($_POST['bien_gmaps'],'src="','"');
					if ($gmaps_data == "") {
						$gmaps_data = $_POST['bien_gmaps'];
					}
				}

				$creation_date = time();

				$add_bien_rq = $bdd->prepare("INSERT INTO bien VALUES (NULL,:bien_nom,:bien_prix,:bien_piece,:bien_chambre,:bien_surface,:bien_adresse,:bien_annee,:bien_desc,:bien_commodite,:bien_situation,:bien_particularite,:bien_niveau,:bien_nbre_WC,:bien_nbre_niveau,:bien_chauffage,:bien_charges,:bien_surface_terrain,:bien_disponibilite,:bien_favori,:bien_gmaps,:bien_type_id,:bien_localite_id,:bien_categorie_id,:bien_agent_id,:bien_creation_date)");

				$add_bien_rq->execute(
					array(
						':bien_nom' => $_POST['bien_nom'], 
						':bien_prix' => $_POST['bien_prix'],
						':bien_piece' => $_POST['bien_piece'],
						':bien_chambre' => $_POST['bien_chambre'],
						':bien_surface' => $_POST['bien_surface'],
						':bien_adresse' => $_POST['bien_adresse'],
						':bien_annee' => $_POST['bien_annee'],
						':bien_desc' => $_POST['bien_desc'],
						':bien_commodite' => $_POST['bien_commodite'],
						':bien_situation' => $_POST['bien_situation'],
						':bien_particularite' => $_POST['bien_particularite'],
						':bien_niveau' => $_POST['bien_niveau'],
						':bien_nbre_WC' => $_POST['bien_nbre_WC'],
						':bien_nbre_niveau' => $_POST['bien_nbre_niveau'],
						':bien_chauffage' => $_POST['bien_chauffage'],
						':bien_charges' => $_POST['bien_charges'],
						':bien_surface_terrain' => $_POST['bien_surface_terrain'],
						':bien_disponibilite' => $_POST['bien_disponibilite'],
						':bien_favori' => $bien_favori,
						':bien_gmaps' => $gmaps_data,
						':bien_type_id' => $_POST['bien_type_id'],
						':bien_localite_id' => $_POST['bien_localite_id'],
						':bien_categorie_id' => $_POST['bien_categorie_id'],
						':bien_agent_id' => $_POST['bien_agent_id'],
						':bien_creation_date' => $creation_date,
					));

				if(isset($_FILES['pictures'])) {

					require_once  "../vendor/bulletproof/bulletproof.php";
					require_once  "../vendor/script/bulletproof_config.php";

					$img = $_FILES['pictures'];

					$last_reg = $bdd->query('SELECT * FROM bien WHERE creation_date = '.$creation_date.' ORDER BY creation_date DESC')->fetchAll(PDO::FETCH_ASSOC);


					if(!empty($img))
					{
					    $img_desc = reArrayFiles($img);
					    $img_first = 1;
					    foreach($img_desc as $val)
					    {
					        $image = new Bulletproof\Image($val);
							$image->setLocation($bulletproof_upload_dir_admin);
							$image->setSize($bulletproof_size_min, $bulletproof_size_max);
							$image->setMime($bulletproof_accepted_format);
							
							if($image->upload()){
								$bdd->exec("INSERT INTO photo(name, selected, fk_bien_ID) VALUES ('".$image->getName().".".$image->getMime()."',".$img_first.",".$last_reg[0]['ID'].")");
							} else {
								//echo $image->getError();
							}

							$img_first = 0;
					    }
					}
				} 
			}

		} 
	}
	else {
		header('Location: page-login.php');
	}

	function getBetween($string, $start = '', $end = ''){
	    if (strpos($string, $start)) { // required if $start not exist in $string
	        $startCharCount = strpos($string, $start) + strlen($start);
	        $firstSubStr = substr($string, $startCharCount, strlen($string));
	        $endCharCount = strpos($firstSubStr, $end);
	        if ($endCharCount == 0) {
	            $endCharCount = strlen($firstSubStr);
	        }
	        return substr($firstSubStr, 0, $endCharCount);
	    } else {
	        return '';
	    }
	}
?>