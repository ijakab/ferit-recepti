<?php

class Database {
    public $connection;

    public function Connect() {
        $this->connection = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

        if(!$this->connection) {
            throw new Exception('Could not connect to the database. Check environment variables ' . $this->connection->connect_error);
        }
    }

    public function error() {
        echo mysqli_error($this->connection);
    }

    public function Query($query) {
        return mysqli_query($this->connection, $query);
    }

    public function Select($query) {
        $res = $this->Query($query);
        $finalArr = [];
        while($row = mysqli_fetch_assoc($res)) {
            array_push($finalArr, $row);
        }
        return $finalArr;
    }

    public function CloseConnection() {
        mysqli_close($this->connection);
    }
}

?>