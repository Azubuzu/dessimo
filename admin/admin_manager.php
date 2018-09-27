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
		} 
	}
	else {
		header('Location: page-login.php');
	}
?>