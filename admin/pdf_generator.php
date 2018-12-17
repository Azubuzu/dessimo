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
		$pdf->SetAuthor('DESSIMMO');
		$pdf->SetTitle($bien['bien_nom']);

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

		$html = <<<EOF
		<!-- EXAMPLE OF CSS STYLE -->
		<style>
		    .price {
		    	text-align:center;
		    	text-decoration: none;
		    	font-size:24px;
		    }

		</style>
EOF;

		$html .= '<h1>'.$bien['bien_nom'].'</h1>';
		$html .= '<p class="npa">'.$bien['adresse'];
		$html .= '<br>'.$bien['NPA'].' '.$bien["local_nom"].'</p>';
		$html .= '<span class="price">CHF '.number_format($bien['prix'], 0, ',', '\'').'</span>';
		$html .= '<h2>Description</h2><p style="text-align:justify;">'.$bien['bien_desc'].'</p>';
		$html .= '<h2>Commodité</h2><p style="text-align:justify;">'.$bien['commodite'].'</p>';
		$html .= '<h2>informations Supplémentaires</h2>';

		if($bien['piece'] != "" && $bien['piece'] != 0) {
          $html .= '<p class="detail">Pièces : '.$bien['piece'].'</p>';
        }
      

      if($bien['chambre'] != "" && $bien['chambre'] != 0) {
          $html .= '<p class="detail">Chambres : '.$bien['chambre'].'</p>';
        }
      

      if($bien['chauffage'] != "" && $bien['chauffage'] != 0) {
          $html .= '<p class="detail">Chauffages : '.$bien['chauffage'].'</p>';
        }
      

      if($bien['nbre_WC'] != "" && $bien['nbre_WC'] != 0) {
          $html .= '<p class="detail">Nombre de WC : '.$bien['nbre_WC'].'</p>';
        }
      

      if($bien['niveau'] != "" && $bien['niveau'] != 0) {
          $html .= '<p class="detail">Niveau : '.$bien['niveau'].'</p>';
        }
      

      if($bien['nbre_niveau'] != "" && $bien['nbre_niveau'] != 0) {
          $html .= '<p class="detail">Nombre de niveaux : '.$bien['nbre_niveau'].'</p>';
        }
      

      if($bien['surface'] != "" && $bien['surface'] != 0) {
          $html .= '<p class="detail">Surface habitable : '.$bien['surface'].'</p>';
        }
      

      if($bien['surface_terrain'] != "" && $bien['surface_terrain'] != 0) {
          $html .= '<p class="detail">Surface du terrain : '.$bien['surface_terrain'].'</p>';
        }
      

      if($bien['annee'] != "" && $bien['annee'] != 0) {
          $html .= '<p class="detail">Année de constr. : '.$bien['annee'].'</p>';
        }
      

      if($bien['charges'] != "" && $bien['charges'] != 0) {
          $html .= '<p class="detail">Charges : '.$bien['charges'].'</p>';
        }
      

      if($bien['disponibilite'] != "" && $bien['disponibilite'] != 0) {
          $html .= '<p class="detail">Disponibilité : '.$bien['disponibilite'].'</p>';
        }
      
		 
		$pdf->writeHTML($html, true, false, true, false, '');

		// add a page
		$pdf->AddPage();

		$html = "<h2>Photos</h2>";

		foreach ($photos as $photo) {
			$html .= '<p><img src="../images/upload/'.$photo['photo_nom'].'"/></p>';
		}

		$pdf->writeHTML($html, true, false, true, false, '');


		// reset pointer to the last page
		$pdf->lastPage();
		//Close and output PDF document
		$pdf->Output('DESSIMMO_'.time().'.pdf', 'I');

	} else {
		header('Location: page-login.php');
	}

?>