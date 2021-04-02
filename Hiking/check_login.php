<?php

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'root','');
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }

    $login = $_POST["login"];
    $pwd = $_POST["pwd"];

    // on teste si nos variables sont définies
    if (isset($login) && isset($pwd)) {
        
        $login_valide = $bdd -> query("SELECT Identifiant FROM utilisateur WHERE Identifiant = '$login' ");
        $pwd_valide = $bdd -> query("SELECT Identifiant FROM utilisateur WHERE Identifiant = '$pwd' ");

    	// on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
    	if ($login_valide && $pwd_valide) {
    		// dans ce cas, tout est ok, on peut démarrer notre session

    		// on la démarre :)
    		session_start ();
    		// on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
    		$_SESSION['login'] = $_POST['login'];
    		$_SESSION['pwd'] = $_POST['pwd'];

    		// on redirige notre visiteur vers une page de notre section membre
    		header ('location: Create.php');
    	}
    	else {
    		// Le visiteur n'a pas été reconnu comme étant membre de notre site. On utilise alors un petit javascript lui signalant ce fait
    		echo '<body onLoad="alert(\'Membre non reconnu...\')">';
    		// puis on le redirige vers la page d'accueil
    		echo '<meta http-equiv="refresh" content="0;URL=Read.php">';
    	}
    }
    else {
    	echo 'Les variables du formulaire ne sont pas déclarées.';
    }
    ?>