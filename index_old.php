<?php
include "script/db_connect.php";

$categories = $bdd->query('SELECT * FROM categorie');
$cantons = $bdd->query('SELECT * FROM canton');
$localites = $bdd->query('SELECT * FROM localite');
$types = $bdd->query('SELECT * FROM type');

?>

<html>

  <head>
    <link rel="stylesheet" type="text/css" href="select_style.css">
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
    function fetch_select(val)
    {
     $.ajax({
     type: 'post',
     url: 'script/fetch_localite.php',
     data: {
      get_localite_by_canton:val
     },
     success: function (response) {
      document.getElementById("localite").innerHTML=response; 
     }
     });
    }

    </script>

  </head>

  <body>
    <form action="result.php">
      Categorie<br>
      <select name="categorie">
      	<?php
      	while ($item = $categories->fetch())
    	{
    		echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
    	}
        ?>
      </select>
      <br>

      canton<br>
      <select name="canton" onchange="fetch_select(this.value);">
      	<?php
      	while ($item = $cantons->fetch())
    	{
    		echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
    	}
        ?>
      </select>
      <br>

      Localité<br>
      <select name="localite" id="localite">
        <?php
        while ($item = $localites->fetch())
        {
          echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
        }
        ?>
      </select>
      <br>

      Type de bien<br>
      <select name="type">
      	<?php
      	while ($item = $types->fetch())
    	{
    		echo "<option value='".$item['ID']."'>".$item['nom']."</option>";
    	}
        ?>
      </select>
      <br>

      Nombre de Pièces<br>
      <input type="text" name="nbre_piece_min" placeholder="min">
      <input type="text" name="nbre_piece_max" placeholder="max">
       <br>
      Prix<br>
      <input type="text" name="prix_min" placeholder="min">
      <input type="text" name="prix_max" placeholder="max">
      <br>
      <input type="submit" value="Submit">
    </form> 
  </body>
</html>