<?php

include '../config/connection.php';
include '../objects/clsUsers.php';
$database = new Connection();
$db = $database->connect();

$users = new Users($db);
$array = array();

$search = isset($_GET['search']) ? $_GET['search'] : '';
$page_no = isset($_GET['page_no']) ? $_GET['page_no'] : 1;
$itemPerpage = isset($_GET['limit']) ? $_GET['limit'] : 5;
$offset = ($page_no - 1) * $itemPerpage;

$queryResult = $users->users($itemPerpage, $offset, $search);
// print_r($queryResult);
while ($row = $queryResult->fetch(PDO::FETCH_ASSOC)) {
    $data = [
        'firstname' =>  $row['firstname'],
        'lastname' => $row['lastname'],
        'email' => $row['email'],
        'username' => $row['username']
    ];

    $array[] = $data;
}

$total = $users->usersCount();
$totalResult = $total->fetch(PDO::FETCH_ASSOC);

$totalRowPerpage = ceil($totalResult['userCount'] / $itemPerpage);

echo json_encode(['data' => $array, 'totalRowPerpage' => $totalRowPerpage, 'currentPage' => $page_no]);
