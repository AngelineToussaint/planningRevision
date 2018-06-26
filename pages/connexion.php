<div>
    <h1>Connexion</h1>
    <?php
    if (isset($_GET['connexion']) && $_GET['connexion'] == 'false'){
        echo '<p style="color: red;">Email ou mot de passe incorrect</p>';
    }
    ?>
    <form method="post" action="?page=connexion_db">
        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="mdp" placeholder="Mot de passe"><br>
        <input type="submit" value="Se connecter">
    </form>
    <a href="?page=accueil">
        <button>S'inscrire</button>
    </a>
</div>
