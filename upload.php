<?php
	require_once  "vendor/bulletproof/bulletproof.php";
	require_once  "vendor/script/bulletproof_config.php";
	require_once  "vendor/script/db_connect.php";



	if(isset($_FILES['pictures'])) {
		$img = $_FILES['pictures'];

		if(!empty($img))
		{
		    $img_desc = reArrayFiles($img);
		    
		    foreach($img_desc as $val)
		    {
		        $image = new Bulletproof\Image($val);
				$image->setLocation($bulletproof_upload_dir);
				$image->setSize($bulletproof_size_min, $bulletproof_size_max);
				$image->setMime($bulletproof_accepted_format);
				
				if($image->upload()){
					$bdd->exec("INSERT INTO photo(name, selected, fk_bien_ID) VALUES ('".$image->getFullPath()."',0,1)");
				} else {
					echo $image->getError();
				}
		    }
		}
	}
?>

<form method="POST" enctype="multipart/form-data">
  <input type="hidden" name="MAX_FILE_SIZE" value="20000000"/>
  <input type="file" name="pictures[]" accept="image/*"/ multiple>
  <input type="submit" value="upload"/>
</form>