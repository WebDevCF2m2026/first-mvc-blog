<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Accueil du blog de Pitz Michaël" />
        <meta name="author" content="Pitz Michaël" />
        <title>Mon Blog | Accueil</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <?php
        // appel du menu
        include BASE_URL."/view/inc/menu.view.html.php";
        ?>
        <!-- Page content-->
        <div class="container">
            <div class="text-center mt-5">
                <h1>Le blog de Pitz Michaël</h1>
                <p class="lead">Mon Blog | Accueil</p>
                <?php
             if(empty($articles)) :
                ?>
                <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            Pas encore d'article
                        </header>
                </article>        
                <?php
                else:
                $countArticle = count($articles)   ;
                $pluriel = ($countArticle>1) ? "s" : "";
                ?>
                <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            Vous avez <?= $countArticle ?> article<?= $pluriel ?>
                        </header>
                </article> 
                <?php
            foreach($articles as $item):
                ?>
            <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h3 class="fw-bolder mb-1"><a href="?idarticle=<?=$item['id'] ?>"><?=$item['title'] ?></a></h3>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2"> Ecrit par <a href="?iduser=<?=$item['iduser'] ?>"><?=$item['username'] ?></a> le <?=$item['date'] ?></div>
                            <!-- Post categories-->
                             <?php
                             if(empty($item['idcateg'])):
                             ?>
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">Pas encore de catégories</a>
                             <?php
                             else:
                                $idcateg = explode(",",$item['idcateg']);
                                $tiltecateg = explode("|||",$item['titlecateg']);
                                $countid = count($idcateg);
                                for($i=0;$i<$countid;$i++):
                             ?>
                            <a class="badge bg-secondary text-decoration-none link-light" href="?idcateg=<?= $idcateg[$i] ?>"><?= $tiltecateg[$i] ?></a>

                            <?php
                                endfor;
                            endif;
                            ?>
                        </header>

                        <!-- Post content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-4"><?=cutTheString($item['content']) ?> <a href="?idarticle=<?=$item['id'] ?>">... Lire la suite</a></p>
                        </section>
                    </article>
                    <?php
                    endforeach;
                endif;
                    ?>
                <?php
            $jsonArticles = json_encode($articles,JSON_PRETTY_PRINT);   
             
            var_dump($_GET, $menu,$articles);
                ?>
            </div>
            <pre>
                <?php
                echo $jsonArticles;
                ?>
            </pre>
            
        </div>
        <!-- Bootstrap core JS-->
        <script src="js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>