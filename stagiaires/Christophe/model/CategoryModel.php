<?php

/**
 * Ce modèle contient toutes les requêtes
 * dont la table `category` est le parent 
 * 
 */

/**
 * Pour le menu, on va récupérer id et title de toutes les catégories par title asc
 */

function selectAllCategoryMenu(PDO $db): array
{
    // requête sql
    $sql = "SELECT `id`, `title` FROM `category` ORDER BY `title` ASC";
    // ouverture d'un query qui va s'exécuter imédiatement
    $stmt = $db->query($sql);
    // récupération des données au format tableau associatif
    $datas = $stmt->fetchAll();
    // bonne pratique
    $stmt->closeCursor();
    // retour du tableau
    return $datas;
}