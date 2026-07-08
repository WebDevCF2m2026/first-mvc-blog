<?php
# formateur/model/UserModel.php


/**
 * Ce modèle contient toutes les requêtes
 * dont la table `user` est le parent 
 */

/**
 * On sélectionne l'id, le login et realname de l'auteur via son id
 */

function selectUserById(PDO $db, int $id): ?array
{
    $sql= "SELECT id, username, realname FROM user WHERE id= ?";

    // préparation de la requête
    $stmt = $db->prepare($sql);

    // exécution de la requête avec l'id en paramettre
    $stmt->execute([$id]);

    // si on a pas d'utilisateur
    $user = ($stmt->rowCount()===0)? null : $stmt->fetch();

    // bonne pratique
    $stmt->closeCursor();

    return $user;

}