<?php
	if(isset($_POST['get_localite_by_canton'])) {
		include "db_connect.php";
		
		$localites = $bdd->query('SELECT * FROM localite WHERE fk_Canton_ID = '.$_POST['get_localite_by_canton'].' ORDER BY nom');

		echo '<option value="0">Toutes</option>';

		while ($item = $localites->fetch())
    	{
    		echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
    	}

	}

	if(isset($_POST['get_localite_by_canton_no_wildcard'])) {
		include "db_connect.php";
		
		$localites = $bdd->query('SELECT * FROM localite WHERE fk_Canton_ID = '.$_POST['get_localite_by_canton_no_wildcard'].' ORDER BY nom');

		while ($item = $localites->fetch())
    	{
    		echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
    	}

	}

	if(isset($_POST['photo_search'])) {
		include "db_connect.php";
		
		$select_bien = $bdd->prepare('SELECT bien.ID,bien.nom FROM bien WHERE fk_Type_ID = :type_ID AND fk_Localite_ID = :localite_ID ORDER BY nom');
		$select_bien->execute(
					array(
						':type_ID' => $_POST['type_ID'],
						':localite_ID' => $_POST['localite_ID'], 
				));

		while ($item = $select_bien->fetch())
    	{
    		echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
    	}

	}
?>