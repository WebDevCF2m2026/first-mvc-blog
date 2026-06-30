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

/**
 * Pour le détail d'une catégorie
 */

function selectCategoryById(PDO $db, int $id): ?array
{
    # récupération de tous les champs de category quand l'id vaut ?
    $sql = "SELECT * FROM `category` WHERE `id` = ?";
    # préparation de la requête
    $request = $db->prepare($sql);
    # attribution de la valeur en donnant le type
    $request->bindValue(1,$id,PDO::PARAM_INT);
    # on exécute
    $request->execute();
    # si on a pas de résultat
    if($request->rowCount()===0) {
        # bonne pratique
        $request->closeCursor();
        # on envoie null (?)
        return null;
    }
    # on a un résultat
    $result = $request->fetch();
    # bonne pratique
    $request->closeCursor();
    # envoi de la réponse
    return $result;

}
