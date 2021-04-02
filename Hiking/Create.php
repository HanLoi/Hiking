<!DOCTYPE html>
<html>
        <head>
            <meta charset="utf-8">
            <title>Ajouter une randonnée</title>
            <link rel="stylesheet" href="css/basics.css" media="screen" title="no title">
        </head>
    <body>
        <a href="/php-pdo/read.php">Liste des données</a>
        <h1>Ajouter</h1>
        <form action="" method="post">
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" value="">
            </div>
            <div>
                <label for="difficulty">Difficulté</label>
                <select name="difficulty">
                    <option value="très facile">Très facile</option>
                    <option value="facile">Facile</option>
                    <option value="moyen">Moyen</option>
                    <option value="difficile">Difficile</option>
                    <option value="très difficile">Très difficile</option>
                </select>
            </div>
            <div>
                <label for="distance">Distance</label>
                <input type="text" name="distance" value="">
            </div>
            <div>
                <label for="duration">Durée</label>
                <input type="time" name="duration" value="">
            </div>
            <div>
                <label for="height_difference">Dénivelé</label>
                <input type="text" name="height_difference" value="">
            </div>
            <button type="submit" name="button">Envoyer</button>
        </form>
        <button type="button" name="button"><a href="http://localhost/html/hiking/logout.php">Se déconnecter</a></button>
    </body>
</html>


<?php          
                try
                {
                    $bdd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'root','');
                }
                catch(Exception $e)
                {
                        die('Erreur : '.$e->getMessage());
                }

            if (isset($_POST["name"]) && isset($_POST["difficulty"]) && isset($_POST["distance"]) &&  isset($_POST["duration"]) &&  isset($_POST["height_difference"])){

                
        
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $name = strval($_POST["name"]);
                $difficulty = $_POST["difficulty"];
                $distance = (int)$_POST["distance"];
                $duration = $_POST["duration"];
                $height_difference = (int)$_POST["height_difference"];
                
                $stmt = $bdd->prepare("INSERT INTO hiking (`name`, difficulty, distance, duration, height_difference) VALUES (?, ?, ?, ?, ?)");
                $stmt->bindValue(1, $name);
                $stmt->bindValue(2, $difficulty);
                $stmt->bindValue(3, $distance);
                $stmt->bindValue(4, $duration);
                $stmt->bindValue(5, $height_difference);
                
                $stmt->execute();
                
                echo "New record created successfully";
            }
?>