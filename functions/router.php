<?php

function definePage(){
    if (!isset($_GET['page'])){
        $page = 'accueil';
    }
    else {
        $page = $_GET['page'];
    }
    return $page;
}

function route(){
    $page = definePage();

    switch (true) {
        case $page == 'accueil':
            include 'pages/accueil.php';
            break;

        case $page == 'inscription':
            include 'pages/inscription.php';
            break;

        case $page == 'connexion':
            include 'pages/connexion.php';
            break;

        case $page == 'connexion_db':
            include 'pages/connexion_db.php';
            break;

        case $page == 'tableauDeBord' && checkConnexion():
            include 'pages/tableauDeBord.php';
            break;

        case $page == 'tableauDeBord_db' && checkConnexion():
            include 'pages/tableauDeBord_db.php';
            break;

        case $page == 'calcul' && checkConnexion():
            include 'pages/calcul.php';
            break;

        case $page == 'calcul_db' && checkConnexion():
            include 'pages/calcul_db.php';
            break;

        case $page == 'calculCoef' && checkConnexion():
            include 'pages/calculCoef.php';
            break;

        case $page == 'calculCoef_db' && checkConnexion():
            include 'pages/calculCoef_db.php';
            break;

        case $page == 'deconnexion' && checkConnexion():
            include 'pages/deconnexion.php';
            break;

        default:
            include 'pages/page404.php';
    }
}
