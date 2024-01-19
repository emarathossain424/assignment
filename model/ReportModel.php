<?php

class ReportModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function storeData($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO report (amount, buyer,receipt_id,items,buyer_email,buyer_ip,note,city,phone,hash_key,entry_at,entry_by) VALUES (:amount, :buyer,:receipt_id,:items,:email,:buyer_ip,:note,:city,:phone,:hash_key,:entry_at,:entry_by)");
        $stmt->bindParam(':amount', $data['amount']);
        $stmt->bindParam(':buyer', $data['buyer']);
        $stmt->bindParam(':receipt_id', $data['receipt_id']);
        $stmt->bindParam(':items', $data['items']);
        $stmt->bindParam(':note', $data['note']);
        $stmt->bindParam(':city', $data['city']);

        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':buyer_ip', $data['buyer_ip']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':hash_key', $data['hash_key']);
        $stmt->bindParam(':entry_at', $data['entry_at']);
        $stmt->bindParam(':entry_by', $data['entry_by']);


        return $stmt->execute();
    }

    public function getAllData()
    {
        $stmt = $this->pdo->query("SELECT * FROM report");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
