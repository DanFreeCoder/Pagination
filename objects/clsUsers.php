<?php
class Users
{

    private $conn;
    private $table = 'users';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function users($itemPerpage, $offset, $search)
    {
        $searchTerm = "%$search%";
        $sql = "SELECT * FROM $this->table LIMIT :limit OFFSET :offset";
        $sel = $this->conn->prepare($sql);

        // $sel->bindParam(':search', $searchTerm, PDO::PARAM_STR);
        $sel->bindParam(':limit', $itemPerpage, PDO::PARAM_INT);
        $sel->bindParam(':offset', $offset, PDO::PARAM_INT);

        $sel->execute();
        return $sel;
    }

    public function usersCount()
    {
        $sql = "SELECT COUNT(*) as userCount FROM $this->table";
        $sel = $this->conn->prepare($sql);

        $sel->execute();
        return $sel;
    }
}
