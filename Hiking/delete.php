<?php          
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'root', '');
    }
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }

    $id = $_GET["id"];
    $reponse = $bdd->exec("DELETE from hiking WHERE id = $id");

    header("Location: http://localhost/html/hiking/read.php");
?>