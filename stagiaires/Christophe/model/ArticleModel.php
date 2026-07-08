<?php


/**
 * Ce modèle contient toutes les requêtes
 * dont la table `Article` est le parent 
 */

/**
 * Récupérationderniers articles par ordre de date DESC avec l'auteur
 * 
 */

function selectAllArticleHomepage(PDO $db): array 
{
    # on sélectionne id, title, date et 250 caractères de content de la table article ordonné par date DESC. On prend ensuite en jointure interne id renommé iduser et username de la table user.
    # exercice Je veux récupérer id renommé idcateg (groupé avec la , comme séparateur) et title renommé titlecateg (groupé avec les '|||' comme séparateur) de la table category (jointure externe non obligatoire ! m2m ! (seuls les articles doivent être présent), il faut regrouper les articles pour n'en avoir qu'un article par page
    $sql = "SELECT 
	a.`id` , a.`title` ,a.`date`, LEFT(a.`content`,250) AS `content` ,
    u.`id` AS `iduser`, u.`username`,
    GROUP_CONCAT(c.`id`)  AS `idcateg`,
    GROUP_CONCAT(c.`title` SEPARATOR '|||') AS `titlecateg`
	FROM `article` a
    INNER JOIN `user` u
		ON u.`id` = a.`user_id`
    ORDER BY a.`date` DESC   
    
;";
    $stmt = $db->query($sql);
    $datas = $stmt->fetchAll();
    $stmt->closeCursor();
    return $datas;
}