<?php

class Challenge {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM challenges");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM challenges WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getByDifficulty($difficulty) {
        $stmt = $this->conn->prepare("SELECT * FROM challenges WHERE difficulty = ?");
        $stmt->execute([$difficulty]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}