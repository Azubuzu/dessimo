<?php 
	$categories = $bdd->query('SELECT * FROM categorie WHERE admin = 0 ORDER BY nom')->fetchAll(PDO::FETCH_ASSOC);
	$cantons = $bdd->query('SELECT * FROM canton ORDER BY nom')->fetchAll(PDO::FETCH_ASSOC);

	if(isset($_GET['canton']))
		$localites = $bdd->query('SELECT * FROM localite WHERE fk_Canton_ID = '.$_GET['canton'].' ORDER BY nom')->fetchAll(PDO::FETCH_ASSOC);
	else {
		$localites = $bdd->query('SELECT * FROM localite WHERE fk_Canton_ID = '.$cantons[0]["ID"].' ORDER BY nom')->fetchAll(PDO::FETCH_ASSOC);
	}

	$types = $bdd->query('SELECT * FROM type')->fetchAll(PDO::FETCH_ASSOC);
	$agents = $bdd->query('SELECT * FROM agent ORDER BY nom')->fetchAll(PDO::FETCH_ASSOC);
	
?>