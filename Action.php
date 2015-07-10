<?php

class Action {

    public function __construct() {

    }

    public function check($host, $database, $user, $pass, $table) {
        $pdo = new PDO('mysql:host='.$host.';dbname='.$database, $user, $pass);
        //$statement = $pdo->query("SELECT COUNT(*) FROM ".$table);
        $statement = $pdo->prepare("SELECT * FROM ".$table);
        $statement->execute();
        $count = $statement->rowCount();

        return $count;
    }
}