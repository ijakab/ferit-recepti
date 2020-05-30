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

    public function Insert($table, $data) {
        $sql = 'insert into ' . $table . '(';
        foreach ($data as $key => $value) {
            $sql = $sql . $key . ', ';
        }
        $sql = substr($sql, 0, -2); // remove last ,
        $sql = $sql . ') values (';
        foreach ($data as $value) {
            $sql = $sql . '?, ';
        }
        $sql = substr($sql, 0, -2); // remove last ,
        $sql = $sql . ")";
        $stmt = mysqli_prepare($this->connection, $sql);
        $types = str_repeat('s', count($data));
        mysqli_stmt_bind_param($stmt, $types, ...array_values($data));
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function Update($table, $data, $id) {
        $sql = 'update ' . $table . ' set ';
        foreach ($data as $key => $value) {
            $sql = $sql . $key . ' = ?, ';
        }
        $sql = substr($sql, 0, -2);
        $sql = $sql . " where id = " . $id;
        $stmt = mysqli_prepare($this->connection, $sql);
        $types = str_repeat('s', count($data));
        mysqli_stmt_bind_param($stmt, $types, ...array_values($data));
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function CloseConnection() {
        mysqli_close($this->connection);
    }
}

?>