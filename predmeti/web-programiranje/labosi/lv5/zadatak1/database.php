<?php

class Database {
    public $connection;

    public function Connect() {
        $this->connection = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $$_ENV['DB_NAME']);

        if(!$this->connection) {
            throw new Exception('Could not connect to the database. Check environment variables ' . $this->connection->connect_error);
        }
    }

    public function Query($query) {
        if($this->connection->query($query) != TRUE) {
            throw new Exception('Query failed: '. $query);
        }
    }

    public function CloseConnection() {
        mysqli_close($this->connection);
    }
} 

?>