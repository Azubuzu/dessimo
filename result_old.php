<?php
	include "vendor/script/db_connect.php";

	

	$request = "SELECT bien.ID AS bien_ID, bien.nom AS bien_nom,bien.prix,bien.piece,bien.chambre,bien.surface,bien.adresse,bien.annee,bien.description,categorie.nom AS cat_nom,type.nom AS type_nom,localite.nom AS local_nom FROM bien INNER JOIN categorie ON categorie.ID = fk_Categorie_ID INNER JOIN type ON type.ID = fk_Type_ID INNER JOIN localite ON localite.ID = fk_Localite_ID WHERE ";


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

	echo $request;

	$result = $bdd->query($request);


	while ($item = $result->fetch())
	{
		echo "<br>".$item["bien_nom"];
		$pictures = $bdd->query("SELECT * FROM photo WHERE fk_bien_ID = ".$item["bien_ID"]);
		while ($picture = $pictures->fetch()) {
			echo "<img src='".$picture['name']."'/>";
		}
	}
?>