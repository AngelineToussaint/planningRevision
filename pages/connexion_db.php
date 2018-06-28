<?php

$email = $_POST['email'];
$mdp = $_POST['mdp'];

$connexion = false;
if (!empty($email) && !empty($mdp)) {
    $check = Database::query('SELECT * FROM utilisateurs WHERE email = ? AND mdp = ?', [
        $email, sha1($mdp)
    ]);

    if (count($check) == 1) {
        $connexion = true;

        $_SESSION = [
            'connexion' => true,
            'utilisateur' => $check[0]
        ];
    } else {
        $connexion = false;
    }
}

/**
 * Deux possibilités :
 * - true
 * - false
 */
if ($connexion == true) {
    redirect('tableauDeBord');
} else {
    redirect('connexion&connexion=false');
}
