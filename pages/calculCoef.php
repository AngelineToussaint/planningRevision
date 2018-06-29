<h1>Calcul des notes</h1>
<div class="calculCoef">
<?php
// Récupèrer la liste des matières pour l'utilisateur connecté (grâce à la session 'utilisateur')
$matieres = Database::query('SELECT * FROM matiere WHERE utilisateur_id = ?', [
        $_SESSION['utilisateur']['id']
]);
?>

<form method="post" action="?page=calculCoef_db">
<table>
        <thead>
        <tr>
            <th>
                Matière
            </th>
            <th>
                Notes sur 20
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Boucle sur toutes les matières (affiche le libelle ainsi qu'un bouton calculer)
        foreach ($matieres as $matiere) {
            ?>
            <tr>
                <td><?php echo $matiere['libelle'] ?></td>
                <td>
    				<input type="text" name="notes[]" placeholder="Notes">
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
        if(isset($_GET['note'])){
            ?>
            <h2>La moyenne est de <?php echo $_GET['note'] ?> /20</h2>
            <button>Recalculer les notes</button>
            <?php
        }
        else{
            ?>
            <button>Calculer les notes</button>
            <?php
        }
    ?>
    
</form>

<a href="?page=tableauDeBord">
    <button>Retour sur le tableau de bord</button>
</a>
</div>