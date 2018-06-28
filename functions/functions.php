<?php

function getFormats(){
    $formats = Database::query("SELECT * FROM format");
    for($i=0; $i<count($formats); $i++){
        echo '<option value="'.$formats[$i]["id"].'">'.$formats[$i]["titre"].'</option>';
    }
}


/**
 * @return bool
 */
function checkConnexion() {
    if (!$_SESSION['connexion']) {
        redirect('connexion');
        // n'execute pas la suite grâce au exit() du redirect [uniquement si l'utilisateur n'est pas connecté]
    }

    return true;
}

/**
 * Redirige vers la route demandée
 * Le exit permet de ne pas executer le code qui suit l'appel de la fonction
 * @param string $page
 */
function redirect($page) {
    header('Location: ?page='.$page);
    exit(); // N'execute jamais la suite du code
}


// FONCTIONS DE CALCUL

/**
 * Faire un calcul en fonction du format que l'utilisateur a sélectionné
 */
function calcul() {
    $formatId = $_SESSION['utilisateur']['format_id'];

    $matieres = Database::query('SELECT * FROM matiere WHERE utilisateur_id = ?', [
        $_SESSION['utilisateur']['id']
    ]);
        
    if ($formatId == 1) {
        format1($matieres);
    } elseif ($formatId == 2) {
        //format2($matieres);
    } elseif ($formatId == 3) {
        //format3($matieres);
    }
}

/**
 * Réaliser un insert pour chaque matière 1 par jour (avec une durée en fonction de son coef)
 * @param $matieres
 */
function format1($matieres) {
    for ($i = 0; $i < count($matieres); $i++) {
        $dureeTravail = trouveDureeTravail($matieres[$i]['coef']);

        $jour = $i + 1;
        Database::exec(
            'INSERT INTO duree(jour_id, matiere_id, duree) VALUES (?, ?, ?)',[$jour, $matieres[$i]['id'], $dureeTravail]
        );
    }
}

/*function format2($matieres) {
    for ($i = 1; $i <= count($matieres); $i++) {
        $dureeTravail = trouveDureeTravail($matieres[$i]['coef']);

        Database::exec(
            'INSERT INTO duree(jour_id, matiere_id, duree) VALUES ('.$i.', '.$matieres[$i]['id'].', '.$dureeTravail.')'
        );
    }
}

function format3($matieres) {
    for ($i = 1; $i <= count($matieres); $i++) {
        $dureeTravail = trouveDureeTravail($matieres[$i]['coef']);


    }    
}*/

/**
 * Déterminer la durée de travail à effectuer en fonction de son coef
 * @param $coef
 * @return int
 */
function trouveDureeTravail($coef) {
    if ($coef <= 2) {
        $dureeTravail = 1;
    } elseif ($coef > 2 && $coef <= 4) {
        $dureeTravail = 2;
    } else {
        $dureeTravail = 3;
    }

    return $dureeTravail;
}


/**
 * Supprime la durée grâce à l'id de la matière passée en paramètre
 * @param $idMatiere
 */
function suppressionDuree($idMatiere) {
    Database::exec('DELETE FROM duree WHERE matiere_id = ?',[$idMatiere]);
}