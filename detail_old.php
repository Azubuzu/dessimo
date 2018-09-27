<?php
	include "vendor/script/db_connect.php";
	if (isset($_GET['bien_ID'])) {

		if($bien = $bdd->query("SELECT bien.ID AS bien_ID,bien.nom AS bien_nom,bien.prix,bien.surface,bien.chambre,type.nom AS type_nom,localite.nom AS local_nom FROM bien INNER JOIN categorie ON categorie.ID = fk_Categorie_ID INNER JOIN type ON type.ID = fk_Type_ID INNER JOIN localite ON localite.ID = fk_Localite_ID WHERE bien.ID = ".$_GET['bien_ID'])->fetch()) {
			echo $bien['bien_nom'];
		} else {
			header('Location: index.php');
		}	
		
	}
	echo $bien['bien_nom'];

?>