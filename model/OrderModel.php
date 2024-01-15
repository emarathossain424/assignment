<?php

class OrderModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function storeData($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO form_data (name, email) VALUES (:name, :email)");
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        
        return $stmt->execute();
    }

    public function getAllData()
    {
        $stmt = $this->pdo->query("SELECT * FROM form_data");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}