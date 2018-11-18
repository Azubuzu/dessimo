<?php
	if(isset($_POST['photo_ID']) && isset($_POST['onPDF'])) {
		include "db_connect.php";

		$data = 0;
		if ($_POST['onPDF'] == "true")
			$data = 1;
		else
			$data = 0;

		$update_photo = $bdd->prepare('UPDATE photo SET onPDF=:onPDF WHERE photo.ID = :photo_ID;');
		$update_photo->execute(
			array(
				':onPDF' => $data,
				':photo_ID' => $_POST['photo_ID'], 
		));
	}
?>