<?php
	include "vendor/script/db_connect.php";

	$biens = $bdd->query("SELECT bien.nom AS bien_nom,bien.prix,bien.piece,bien.chambre,bien.surface,bien.adresse,bien.annee,categorie.nom AS cat_nom,type.nom AS type_nom,localite.nom AS local_nom FROM bien INNER JOIN categorie ON categorie.ID = fk_Categorie_ID INNER JOIN type ON type.ID = fk_Type_ID INNER JOIN localite ON localite.ID = fk_Localite_ID");

	echo "<table border='solid black 1px'>";
	while ($item = $biens->fetch())
	{	
		echo "<tr>";
		echo "<td><input type='text' placeholder='".$item["bien_nom"]."'></input></td>";
		echo "<td>".$item["prix"]."</td>";
		echo "<td>".$item["piece"]."</td>";
		echo "<td>".$item["chambre"]."</td>";
		echo "<td>".$item["surface"]."</td>";
		echo "<td>".$item["adresse"]."</td>";
		echo "<td>".$item["annee"]."</td>";
		echo "<td>".$item["cat_nom"]."</td>";
		echo "<td>".$item["type_nom"]."</td>";
		echo "<td>".$item["local_nom"]."</td>";
		echo "</tr>";
	}
	echo "</table>";
?>