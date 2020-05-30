<?php

class CatRepository {
    private $seeded = false;
    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    public function migrate() {
        // usually, we would have expose this through command and save what scripts we run previously
        $sql = "CREATE TABLE IF NOT EXISTS cats (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            age INT(11) NOT NULL,
            info TEXT NOT NULL,
            wins INT(11) NOT NULL,
            loss INT(11) NOT NULL,
            image VARCHAR(100)
            )";
        $this->db->Query($sql);
    }

    public function seed() {
        if($this->seeded) return;
        $this->db->Query("insert into cats values ('', 'Cat McTerror', 3, 'Very loud', 22, 4, 'img/cat1.png')");
        $this->db->Query("insert into cats values ('', 'Caterson CatSpyder Silva', 5, 'Slim, broke leg in past years', 34, 18, 'img/cat02.png')");
        $this->seeded = true;
    }

    public function getAll() {
        return $this->db->Select("SELECT * FROM cats");
    }
}

?>