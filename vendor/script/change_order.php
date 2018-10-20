<?php
	if(isset($_POST['photo_ID']) && isset($_POST['order'])) {
		include "db_connect.php";

		$update_photo = $bdd->prepare('UPDATE photo SET position=:order WHERE photo.ID = :photo_ID;');
		$update_photo->execute(
			array(
				':order' => $_POST['order'],
				':photo_ID' => $_POST['photo_ID'], 
		));
	}
?>