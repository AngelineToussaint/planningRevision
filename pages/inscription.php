<?php

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$cursus = $_POST['cursus'];
$format_id = $_POST['format'];

$insert = false;
if (!empty($email) && !empty($mdp)) {
    $check = Database::query("SELECT * FROM utilisateurs WHERE email = '". $email ."'");

    if (count($check) == 0) {
        $insert = Database::exec(
            "INSERT INTO utilisateurs (nom, prenom, email, mdp, cursus, format_id) ".
            "VALUES ('". $nom ."', '". $prenom ."', '". $email ."', '". sha1($mdp) ."', '". $cursus ."', ". $format_id .")"
        );
    } else {
        $insert = 'email_deja_pris';
    }
}

/**
 * Trois possibilités :
 * - email_deja_pris
 * - true
 * - false
 */
if ($insert == 'email_deja_pris') {
    redirect('accueil&inscription=email_deja_pris');
} elseif ($insert == true) {
    redirect('connexion');
} else {
    redirect('accueil&inscription=false');
}
