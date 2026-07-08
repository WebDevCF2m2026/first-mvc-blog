<?php

/**
 * CONTROLEUR FRONTAL
 */

// lancement d'une session (PHPSESSID)
session_start();

// chargement des dépendances
require_once "../config.php";
// chargement des modèles
require_once BASE_URL."/model/CategoryModel.php";
require_once BASE_URL."/model/ArticleModel.php";

// chargement du router
require_once BASE_URL."/controller/routerController.php";