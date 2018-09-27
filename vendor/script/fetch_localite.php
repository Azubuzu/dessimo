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
?>