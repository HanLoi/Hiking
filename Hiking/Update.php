<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title">
</head>
<body>
<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'root','');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$id = $_GET["id"];

$reponse = $bdd->query("SELECT * FROM hiking where id = $id");

$donnees = $reponse->fetch();?>

	<a href="/php-pdo/read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo $donnees["name"];?>">
		</div>
		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
                <option value="<?php echo $donnees["difficulty"];?>" default><?php echo $donnees["difficulty"];?> </option>
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?php echo $donnees["distance"]?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?php echo $donnees["duration"]?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?php echo $donnees["height_difference"]?>">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>


<?php


echo "<tr>\n<td style= \"border: 0.1rem solid black\">" . $donnees["id"] . "</td>
<td style= \"border: 0.1rem solid black\"><a href=\"http://localhost/html/hiking/update.php?id=" . $donnees["id"] . "\">" . $donnees["name"] . "</a></td>
<td style= \"border: 0.1rem solid black\">" . $donnees["difficulty"] . "</td>
<td style= \"border: 0.1rem solid black\">" . $donnees["distance"] . "</td>
<td style= \"border: 0.1rem solid black\">" . $donnees["duration"] . "</td>
<td style= \"border: 0.1rem solid black\">" . $donnees["height_difference"] . "</td>
</tr>\n";
if (isset($_POST["name"]) || isset($_POST["difficulty"]) || isset($_POST["distance"]) || isset($_POST["duration"]) || isset($_POST["height_difference"])) {
           
    $name = strval($_POST["name"]);
    $difficulty = $_POST["difficulty"];
    $distance = (int)$_POST["distance"];
    $duration = $_POST["duration"];
    $height_difference = (int)$_POST["height_difference"];

    $bdd -> exec("UPDATE `hiking`  SET `name` = '$name', difficulty = '$difficulty', distance = $distance, duration = '$duration', height_difference = $height_difference WHERE id = $id");

    print_r("UPDATE `hiking`  SET `name` = '$name', difficulty = '$difficulty', distance = $distance, duration = $duration, height_difference = $height_difference WHERE id = $id");

    echo "succes";
}
?>