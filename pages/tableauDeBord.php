<h1>Matières</h1>

<div class="tableauDeBord">
<?php
// Récupèrer la liste des matières pour l'utilisateur connecté (grâce à la session 'utilisateur')
$matieres = Database::query('SELECT * FROM matiere WHERE utilisateur_id = ?', [
        $_SESSION['utilisateur']['id']
]);

// Si il y a des matières on les affiche (si le nombre de matières est supérieur à 0)
if (count($matieres) > 0){
    ?>
    <p>
        <a href="?page=calcul" class="calcul bold pointer">Calculer le temps de révision</a>
    </p>
    <p>
        <a href="?page=calculCoef" class="calcul bold pointer">Calculer le résultat</a>
    </p>

    <table>
        <thead>
        <tr>
            <th>
                Matière
            </th>
            <th>
                Coefficient
            </th>
            <th>
                Suppression
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Boucle sur toutes les matières (affiche le libelle, le coef ainsi qu'un bouton supprimer qui cible son id)
        foreach ($matieres as $matiere) {
            ?>
            <tr>
                <td><?php echo $matiere['libelle'] ?></td>
                <td><?php echo $matiere['coef'] ?></td>
                <td>
                    <!-- La page ciblée est tableauDeBord_db avec comme type, la suppression
                    et comme id, l'id de la matière sur laquel nous sommes dans la boucle -->
                    <form method="post" action="?page=tableauDeBord_db&type=suppression&id=<?php echo $matiere['id'] ?>">
                        <button class="suppression">
                            <img id="supprimer-matiere" src="img/recycling.png" class="bold pointer">
                        </button>
                    </form>
                </td>

            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    <!-- La page ciblée est tableauDeBord_db avec comme type, l'ajout -->
    <?php
    if (count($matiere) < 7) {
        ?>
        <form  method="post" action="?page=tableauDeBord_db&type=ajout">
            <input type="text" name="matiere[]" placeholder="Matière">
            <input type="text" name="coef[]" placeholder="Coefficient">

            <button>Ajouter une matière</button>
        </form>
        <?php
    }
    ?>
    <!-- La page ciblée est tableauDeBord_db avec comme type, la suppression (donc supprime tout car il n'y a pas d'id) -->
    <form  method="post" action="?page=tableauDeBord_db&type=suppression">
        <button>Supprimer toutes les matières</button>
    </form>
    <?php
} // Sinon (si il n'y a pas de matières), on affiche le formulaire pour en enregistrer
else{
    ?>
    <p id="ajout-matiere" class="bold pointer">Ajouter une matière en plus</p>

    <!-- La page ciblée est tableauDeBord_db avec comme type, l'ajout -->
    <form method="post" action="?page=tableauDeBord_db&type=ajout">
        <table>
            <thead>
            <tr>
                <th>
                    Matière
                </th>
                <th>
                    Coefficient
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <input type="text" name="matiere[]" placeholder="Matière">
                </td>
                <td>
                    <input type="text" name="coef[]" placeholder="Coefficient">
                </td>
            </tr>
            </tbody>
        </table>
        <button>Enregistrer</button>
    </form>

    <?php
}
?>
</div>


<script>
    $(document).ready(function () {

        // Quand l'utilisateur clique sur le texte qui contient l'id 'ajout-matiere', exécute la fonction en dessous
        $('#ajout-matiere').click(function () {

            if ($('tbody tr').length < 7) {
                // Créer une ligne de tableau dans une variable javascript qui sera ensuite ajouter au tableau html
                var tr = '<tr>' +
                    '   <td>' +
                    '       <input type="text" name="matiere[]" placeholder="Matière">' +
                    '   </td>' +
                    '   <td>' +
                    '       <input type="text" name="coef[]" placeholder="Coefficient">' +
                    '   </td>' +
                    '</tr>';

                // Ajouter la ligne dans le tableau html
                $('tbody').append(tr);
            } else {
                alert('7 matières autorisées au maximum')
            }
        })

    })
</script>