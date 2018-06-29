<?php

$durees = Database::query(
    'SELECT matiere.libelle as matiere, jours.libelle as jour, duree FROM duree, matiere,jours WHERE duree.matiere_id = matiere.id AND duree.jour_id = jours.id AND matiere.utilisateur_id = ?', [
            $_SESSION['utilisateur']['id']
    ]);

if (count($durees) == 0) {
    calcul();

    redirect('calcul');
} else {
    ?>
    <a href="?page=calcul_db">
        <button>Recalculer</button>
    </a>
    <?php
}

?>

<table class="calcul">
    <thead>
    <tr>
        <th>
            Matière
        </th>
        <th>
            Durée
        </th>
        <th>
            Jour
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    // Boucle sur toutes les durée (affiche la durée, le libelle et le jour)
    foreach ($durees as $duree){
        ?>
        <tr>
            <td><?php echo $duree['matiere'] ?></td>
            <td><?php echo $duree['duree'] ?>h</td>
            <td><?php echo $duree['jour'] ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

<a href="?page=tableauDeBord">
    <button>Retour sur le tableau de bord</button>
</a>