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

    public function create($data) {

        $stmt = $this->conn->prepare("
            INSERT INTO challenges
            (title, description, category, difficulty, flag, points)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['category'],
            $data['difficulty'],
            $data['flag'],
            $data['points']
        ]);
    }

    public function update($id, $data) {

        $stmt = $this->conn->prepare("
            UPDATE challenges
            SET
                title = ?,
                description = ?,
                type = ?,
                difficulty = ?,
                correct_answer = ?,
                points = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['type'],
            $data['difficulty'],
            $data['answer'],
            $data['points'],
            $id
        ]);
    }

    public function delete($id) {

        $stmt = $this->conn->prepare("
            DELETE FROM challenges
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }
}