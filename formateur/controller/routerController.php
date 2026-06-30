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


// existance de la variable get idarticle, qui ne peut être que du digit 0123456789 (pas de, ou de -) et qui ne peut pas être 0
if(isset($_GET['idarticle'])&& ctype_digit($_GET['idarticle']) && $_GET['idarticle']!=0){
    $id = (int) $_GET['idarticle'];

   
/**
 * Détail d'un article
 */
$article = selectDetailArticle($dbConnect,$id);

// si l'article vaut nul
if($article===null){

    include_once BASE_URL."/view/404.view.html.php";

// l'article a bien été trouvé
}else{

    include_once BASE_URL."/view/detail.article.view.html.php"; // view
}


}else{ 



/**
 * homepage
 */
// on charge les articles pour la homepage
// ICI
$articles = selectAllArticleHomepage($dbConnect);
include_once BASE_URL."/view/homepage.view.html.php"; // view

}

//var_dump($dbConnect);
$dbConnect = null;