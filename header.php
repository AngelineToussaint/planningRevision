<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Planning Révision</title>
    <link rel="stylesheet" href="css/styles.css">
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
</head>
<body class="fond">
    <?php
    if (isset($_SESSION['connexion']) && $_SESSION['connexion'] == true) {
        ?>
        <a class="deconnexion" href="?page=deconnexion">
            <button>Déconnexion</button>
        </a>
        <?php
    }
    ?>

    <div class="page">
        <div class="contenu">