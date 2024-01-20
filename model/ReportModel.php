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

    public function getAllData($entry_at, $entry_by, $per_page, $current_page_number)
    {
        $entry_start_date = '';
        $entry_end_date = '';
        $pagination_start = ($current_page_number-1)*$per_page;

        if (!empty($entry_at)) {
            $exploded_date = explode('~', $entry_at);
            $entry_start_date = $exploded_date[0];
            $entry_end_date = $exploded_date[1];
        }

        $query_string = "SELECT * FROM report";

        if (!empty($entry_start_date) && !empty($entry_end_date) && !empty($entry_by)) {
            $query_string = $query_string . " WHERE entry_at BETWEEN :start_date AND :end_date AND entry_by = :entry_by";
        } elseif (!empty($entry_start_date) && !empty($entry_end_date)) {
            $query_string = $query_string . " WHERE entry_at BETWEEN :start_date AND :end_date";
        } elseif (!empty($entry_by)) {
            $query_string = $query_string . " WHERE entry_by = :entry_by";
        }

        $query_string =$query_string. " LIMIT :start, :limit";


        $stmt = $this->pdo->prepare($query_string);

        if (!empty($entry_start_date) && !empty($entry_end_date) && !empty($entry_by)) {
            $stmt->bindParam(':start_date', $entry_start_date);
            $stmt->bindParam(':end_date', $entry_end_date);
            $stmt->bindParam(':entry_by', $entry_by);
        } elseif (!empty($entry_start_date) && !empty($entry_end_date)) {
            $stmt->bindParam(':start_date', $entry_start_date);
            $stmt->bindParam(':end_date', $entry_end_date);
        } elseif (!empty($entry_by)) {
            $stmt->bindParam(':entry_by', $entry_by);
        }

        $stmt->bindParam(':start', $pagination_start, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $per_page, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalReport()
    {
        $query = "SELECT COUNT(*) as total FROM report";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function getAllEntryById(){
        $query = "SELECT DISTINCT(entry_by) FROM report";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
