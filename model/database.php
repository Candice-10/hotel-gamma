<?php
// __DIR__ retourne le chemin absolu vers le fichier en cours
require_once __DIR__ . '/../config/parameters.php';

$connection = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASS, [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8', lc_time_names = 'fr_FR'",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
]);

// Fonctions génériques

/**
 * Récupérer l'ensemble des lignes d'une table en base de données
 * @param string $table Le nom de la table
 * @return array Les lignes de résultat
 */
function get_all_rows(string $table): array {
    global $connection;

    $query = "SELECT * FROM $table";

    $stmt = $connection->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll();
}

function get_all_accommodations(): array {
    global $connection;

    $query = "
        SELECT
            accommodation.*,
            CONCAT(type.name, ' ', category.name) AS name,
            type.name AS type_name,
            category.name AS category_name
        FROM accommodation
        INNER JOIN type ON type.id = accommodation.type_id
        INNER JOIN category ON category.id = accommodation.category_id
    ";

    $stmt = $connection->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll();
}

function get_one_accommodation(int $id): array {
    global $connection;

    $query = "
        SELECT
            accommodation.*,
            CONCAT(type.name, ' ', category.name) AS name,
            type.name AS type_name,
            category.name AS category_name
        FROM accommodation
        INNER JOIN type ON type.id = accommodation.type_id
        INNER JOIN category ON category.id = accommodation.category_id
        WHERE accommodation.id = :id
    ";

    $stmt = $connection->prepare($query);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    return $stmt->fetch();
}

function get_all_photo_by_accommodation(int $id): array {
    global $connection;

    $query = "
        SELECT *
        FROM photo
        WHERE photo.accommodation_id = :id
    ";

    $stmt = $connection->prepare($query);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    return $stmt->fetchAll();
}



function get_all_rows("price"): array {
    global $connection;

    //$query = "SELECT * FROM room ORDER BY size DESC LIMIT 0,3";
    //DESC ordre décroissant

    $query = "SELECT accommodation.*,type.name as type,category.name as category FROM accommodation,type,category WHERE (accommodation.category_id=category.id AND accommodation.type_id=type.id) ORDER BY size DESC LIMIT 0,3";
    //SELECT * = sélectionner tous les champs

    $stmt = $connection->prepare($query);
    //$stmt->bindValue(":id", $id);
    $stmt->execute();

    return $stmt->fetchAll();
}






