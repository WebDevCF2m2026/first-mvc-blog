<?php

/**
 * Notre routeur
 */

/**
 * On va se connecter
 * à notre DB via PDO
 */
try{
    $dbConnect = new PDO(
        dsn:DB_DSN,
        username:DB_LOGIN,
        password:DB_PWD,
        options:[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
}catch(Exception $e){
    die($e->getMessage());
}

/**
 * Route
 */

// On charge les catégories pour les pages publiques
$menu = selectAllCategoryMenu($dbConnect); // model

/**
 * homepage
 */
// on charge les articles pour la homepage
// ICI
$articles = selectAllArticleHomepage($dbConnect);
include_once BASE_URL."/view/homepage.view.html.php"; // view

//var_dump($dbConnect);
$dbConnect = null;