<?php
if ($_GET['type'] == 'ajout'){
    // Si le type est 'ajout', boucle sur toutes les matières envoyées via le formulaire et les insert une par une.
    for ($i = 0; $i < count($_POST['matiere']); $i++) {
        if ($i == 7) { break; }

        if (!empty($_POST['matiere'][$i]) && !empty($_POST['coef'][$i])) {
            // Insert une matière
            Database::exec('INSERT INTO matiere(libelle, coef, utilisateur_id) VALUES (?, ?, ?)', [
                $_POST['matiere'][$i], $_POST['coef'][$i], $_SESSION['utilisateur']['id']
            ]);
        }
    }
} elseif ($_GET['type'] == 'suppression') {

    if (isset($_GET['id'])) {
        // Si le type est suppression et l'id existe, alors supprime la matière

        // Récupère la matière grâce à son id et l'utilisateur id

        $check = Database::queryFirst('SELECT * FROM matiere WHERE id = ? AND utilisateur_id = ?',[
            $_GET['id'], $_SESSION['utilisateur']['id']
        ]);
        // Si la matière existe bien et si elle correspond à l'utilisateur connecté
        if ($check != null) {
            // Supprime la durée correspondant à la matière
            suppressionDuree($_GET['id']);
            // Supprime la matière
            Database::exec('DELETE FROM matiere WHERE id = ?',[$_GET['id']]);

        }

    } else {
        // Si le type est suppression mais qu'il n'y a pas d'id, alors supprime toutes les matières de l'utilisateur

        // Récupère la liste des matières de l'utilisateur connecté
        $matieres = Database::query('SELECT * FROM matiere WHERE utilisateur_id = ?', [
            $_SESSION['utilisateur']['id']
        ]);

        for ($i = 0; $i < count($matieres); $i++) {
            // Supprime la durée correspondant à la matière ($i)
            suppressionDuree($matieres[$i]['id']);
        }

        // Supprime toutes les matières
        Database::exec('DELETE FROM matiere WHERE utilisateur_id = ?', [
            $_SESSION['utilisateur']['id']
        ]);

    }
}

redirect('tableauDeBord');
?>
