<?php
	session_start();

	if (isset($_SESSION['is_logged'])) {

		if ($_SESSION['is_logged'] != "#çl0rd$!#ç2") {
			header('Location: page-login.php');
		}

		require_once "../vendor/script/db_connect.php";

		$bien_selected = $bdd->prepare("SELECT *,bien.ID AS bien_ID,bien.nom AS bien_nom,type.nom AS type_nom, localite.nom AS local_nom, bien.description AS bien_desc FROM bien INNER JOIN categorie ON categorie.ID = fk_Categorie_ID INNER JOIN type ON type.ID = fk_Type_ID INNER JOIN localite ON localite.ID = fk_Localite_ID WHERE bien.ID =:bien_ID");
        $bien_selected->execute(
            array(
                ':bien_ID' => $_GET['bien_ID'],
        ));
        $bien = $bien_selected->fetchAll()[0];

    	$select_photos = $bdd->prepare("SELECT bien.nom AS bien_nom,bien.ID AS bien_ID,photo.name AS photo_nom,photo.selected,photo.ID AS photo_ID,photo.position,photo.onPDF FROM photo INNER JOIN bien ON bien.ID = fk_bien_ID WHERE fk_bien_ID = :bien_ID ORDER BY photo.position,photo.ID");
        $select_photos->execute(
            array(
                ':bien_ID' => $_GET['bien_ID'], 
        ));
        $photos = $select_photos->fetchAll();
        //$bien = $biens[0];

		// PDF RELATED ///////////////////////////////////////////////////////////////////////////////////////////////
		// Include the main TCPDF library (search for installation path).
		require_once('../vendor/tcpdf/tcpdf.php');
		// Extend the TCPDF class to create custom Header and Footer

		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Our Code World');
		$pdf->SetTitle('Example Write Html');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// add a page
		$pdf->AddPage();

		$html = '<h2>'.$bien['bien_nom'].'</h2>';
		$html .= '<p>'.$bien['NPA'].' '.$bien["local_nom"].'</p>';
		$html .= '<h4>Description</h4><p style="text-align:justify;">'.$bien['bien_desc'].'</p>';
		 
		$pdf->writeHTML($html, true, false, true, false, '');

		$html = "";

		foreach ($photos as $photo) {
			$html .= '<img src="../images/upload/'.$photo['photo_nom'].'"><br>';
		}

		$pdf->writeHTML($html, true, false, true, false, '');

		// add a page
		$pdf->AddPage();

		$html = '<h1>Hey</h1>';
		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		// reset pointer to the last page
		$pdf->lastPage();
		//Close and output PDF document
		$pdf->Output('example_006.pdf', 'I');

	} else {
		header('Location: page-login.php');
	}

?>