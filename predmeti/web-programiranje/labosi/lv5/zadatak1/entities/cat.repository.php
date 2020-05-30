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

    public function getOne($id) {
        // this should be escaped to prevent injection
        $res = $this->db->Select("SELECT * FROM cats where id = " . $id);
        return $res[0];
    }

    public function createEmpty() {
        return [
            "age" => 0,
            "info" => "",
            "name" => "",
            "wins" => 0,
            "loss" => 0
        ];
    }

    public function createOrUpdate($data) { //this data could be fetched directly with $_POST, but I find php super-global variables super-idiotic
        // this would normally be split, however suits for this app
        // this would be sanitized and escaped, and XSS attacks
        $subset = $this->getValidSubset($data);
        if ($data['id']) {
            $this->db->Update('cats', $subset, $data['id']);
        } else {
            $this->db->Insert('cats', $subset);
        }
    }

    public function getValidSubset($data) {
        return [
            'name' => $data['name'],
            'age' => $data['age'],
            'info' => $data['info'],
            'loss' => $data['loss'],
            'wins' => $data['wins'],
            'image' => 'bhjsh'
        ];

    }

    public function applyFight($winId, $lossId) {
        // normally, we would make sure cats exists and escape values, as this can cause sql injection.
        $this->db->Query("update cats set wins = wins + 1 where id = " . $winId);
        $this->db->Query("update cats set loss = loss + 1 where id = " . $lossId);
    }
}

?>