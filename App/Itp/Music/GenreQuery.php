<?php
namespace Itp\Music;
use \Itp\Base\Database;
use \PDO;
class GenreQuery extends Database {
    public function getAll()
    {
        $sql = "
        SELECT *
        FROM genres
        ORDER BY genre ASC
        ";

        $statement = static::$pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);

    }


}