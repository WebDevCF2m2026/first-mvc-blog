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
 * Détail d'une catégorie
 */

// si existance de la variable get idcateg
if(isset($_GET['idcateg'])
    && ctype_digit($_GET['idcateg'])
    && $_GET['idcateg'] !=0
    ){

    

/**
 * Détail d'un article
 */

// si existance de la variable get idarticle,  
    }elseif(isset($_GET['idarticle'])
    && ctype_digit($_GET['idarticle']) # qui ne peut être que du digit 0123456789 (pas de, ou de -)
    && $_GET['idarticle']!=0) # et qui ne peut pas être 0
    {
    
    // conversion de l'id en int
    $id = (int) $_GET['idarticle'];

   
    // récupération de l'article
    $article = selectDetailArticle($dbConnect,$id);

    // si l'article vaut nul
    if($article===null){

        include_once BASE_URL."/view/404.view.html.php";

    // l'article a bien été trouvé
    }else{

        include_once BASE_URL."/view/detail.article.view.html.php"; // view
    }

/**
 * homepage
 */

}else{ 




    // on charge les articles pour la homepage
    // ICI
    $articles = selectAllArticleHomepage($dbConnect);
    include_once BASE_URL."/view/homepage.view.html.php"; // view

}

//var_dump($dbConnect);
$dbConnect = null;