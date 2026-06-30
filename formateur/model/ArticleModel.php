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
    # on sélectionne id, title, date et 250 caractères de content de la table article publiés ordonnés par date DESC. On prend ensuite en jointure interne id renommé iduser et username de la table user.
# exercice Je veux récupérer id renommé idcateg (groupé avec la , comme séparateur) et title renommé titlecateg (groupé avec les '|||' comme séparateur) de la table category (jointure externe non obligatoire ! m2m ! (seuls les articles doivent être présent), il faut regrouper les articles pour n'en avoir qu'un article par page
    $sql="SELECT 
	a.`id`, a.`title`,a.`date`, SUBSTRING(a.`content`,1,250) AS `content` ,
    u.`id` AS `iduser`, u.`username`,
	GROUP_CONCAT(c.`id`) AS `idcateg`, GROUP_CONCAT(c.`title` SEPARATOR '|||') AS `titlecateg`
	FROM `article` a
    INNER JOIN `user` u
		ON u.`id` = a.`user_id`
    LEFT JOIN `category_has_article` cha
    	ON cha.`article_id`= a.`id` 
    LEFT JOIN `category` c ON cha.`category_id`= c.`id` 
    WHERE a.`published` = 1
	GROUP BY a.`id` 
	ORDER BY a.`date` DESC ;   
;";
    $stmt = $db->query($sql);
    $datas = $stmt->fetchAll();
    $stmt->closeCursor();
    return $datas;
}

/**
 * Récupération d'un article par son id si il est publique
 * 
 */

function selectDetailArticle(PDO $db, int $id): ?array 
{
    # 
    $sql="SELECT 
	a.`id`, a.`title`,a.`date`, a.`content` ,
    u.`id` AS `iduser`, u.`username`,
	GROUP_CONCAT(c.`id`) AS `idcateg`, GROUP_CONCAT(c.`title` SEPARATOR '|||') AS `titlecateg`
	FROM `article` a
    INNER JOIN `user` u
		ON u.`id` = a.`user_id`
    LEFT JOIN `category_has_article` cha
    	ON cha.`article_id`= a.`id` 
    LEFT JOIN `category` c ON cha.`category_id`= c.`id` 
    WHERE a.`id` = ? AND a.`published` = 1
	GROUP BY a.`id` 
	   
;";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    if($stmt->rowCount()===0) return null;
    $data = $stmt->fetch();
    $stmt->closeCursor();
    return $data;
}


# on coupe les phrase trop longues dans couper dans les mots
function cutTheString(string $text, int $length = 200): string
{
    // si la chaîne est plus courte que ce qu'on veut couper
    if($text<=$length) return $text;
    // on coupe la chaîne à la longueur voulue
    $text = substr($text, 0, $length);
    // on trouve le dernier espace
    $lastSpace = strripos($text," ");
    // on recoupe au dernier espace
    $text = substr($text, 0, $lastSpace);
    // on renvoie le texte
    return $text;
}