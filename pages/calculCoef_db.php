<?php

//Calculer la note

// Récupèrer la liste des matières pour l'utilisateur connecté (grâce à la session 'utilisateur')
$matieres = Database::query('SELECT * FROM matiere WHERE utilisateur_id = ?', [
        $_SESSION['utilisateur']['id']
]);

//Somme total
$sommeTotal = 0;
$sommeUtilisateur = 0;

for($i=0; $i<count($matieres); $i++){
	$sommeTotal += 20 * $matieres[$i]['coef'];
	$sommeUtilisateur += $_POST['notes'][$i] * $matieres[$i]['coef']; 
}

//Calcul de lanote sur 20
$note = $sommeUtilisateur * 20 / $sommeTotal;

//Redirection sur la page calculCoef
redirect('calculCoef&note='. round($note, 2));