<?php

class Format {
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
        $stmt = $db->prepare("SELECT * FROM formats ORDER BY name");
        $stmt->execute();

        $formats = [];
        while ($row = $stmt->fetch()) {
            $formats[] = new Format($row);
        }

        return $formats;
    }


    public static function findById($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM formats WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if ($row) {
            return new Format($row);
        }

        return null;
    }

    public function save() {
        if ($this->id) {
            $stmt = $this->db->prepare("
                UPDATE formats
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
                INSERT INTO formats (name)
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
            throw new Exception("Failed to save format.");
        }

        if ($this->id === null) {
            $this->id = $this->db->lastInsertId();
        }
    }

    public function delete() {
        if (!$this->id) {
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM formats WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);
    }


}