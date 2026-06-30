<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Accueil du blog de Pitz Michaël" />
        <meta name="author" content="Pitz Michaël" />
        <title>Mon Blog | Titre</title>
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
                <p class="lead">Article| Titre</p>
                
            <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h3 class="fw-bolder mb-1"><a href="?idarticle=<?=$article['id'] ?>"><?=$article['title'] ?></a></h3>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2"> Ecrit par <a href="?iduser=<?=$article['iduser'] ?>"><?=$article['username'] ?></a> le <?=$article['date'] ?></div>
                            <!-- Post categories-->
                             <?php
                             if(empty($article['idcateg'])):
                             ?>
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!">Pas encore de catégories</a>
                             <?php
                             else:
                                $idcateg = explode(",",$article['idcateg']);
                                $tiltecateg = explode("|||",$article['titlecateg']);
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
                            <p class="fs-5 mb-4 text-start"><?=nl2br($article['content']) ?> </p>
                        </section>
                    </article>

            </div>
            
        </div>
        <!-- Bootstrap core JS-->
        <script src="js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>