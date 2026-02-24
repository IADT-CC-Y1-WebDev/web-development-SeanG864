<?php

class Publisher {
    public $id;
    public $name;

    private $db;

    public function __construct($data = []) {
        $this->db = DB::getInstance()->getConnection();

        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? null;
        }
    }

    public static function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM publishers ORDER BY name");
        $stmt->execute();

        $publishers = [];
        while ($row = $stmt->fetch()) {
            $publishers[] = new Publisher($row);
        }

        return $publishers;
    }


    public static function findById($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM publishers WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if ($row) {
            return new Publisher($row);
        }

        return null;
    }

    public function save() {
        if ($this->id) {
            $stmt = $this->db->prepare("
                UPDATE publishers
                SET name = :name
                WHERE id = :id
            ");

            $params = [
                'name' => $this->name,
                'id' => $this->id
            ];
        } 
        else {
            $stmt = $this->db->prepare("
                INSERT INTO publishers (name)
                VALUES (:name)
            ");

          $params = [
                'name' => $this->name,
            ];
        }
        $status = $stmt->execute($params);

        if (!$status) {
            $error_info = $stmt->errorInfo();
            $message = sprintf(
                "SQLSTATE error code: %d; error message: %s",
                $error_info[0],
                $error_info[2]
            );
            throw new Exception($message);  
        }

        if ($stmt->rowCount() !== 1) {
            throw new Exception("Failed to save publisher.");
        }

        if ($this->id === null) {
            $this->id = $this->db->lastInsertId();
        }
    }

    public function delete() {
        if (!$this->id) {
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM publishers WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);
    }


}