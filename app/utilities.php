<?php
require __DIR__ . '/dbconfig.php';

function checkadmin($username, $password){
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT isadmin FROM users WHERE username=:username AND password=:password LIMIT 1');
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    
    $results = $stmt->fetch();
    
    return $results['isadmin'];
    
}

function isadmin(){
    return (isset($_SESSION['isadmin'])) ? $_SESSION['isadmin'] : false; 
}

function insert_object($object_name, $rfid, $object_type){
    try {
    $pdo = get_pdo();
    $stmt = $pdo->prepare('INSERT INTO objects (name, type, rfid) VALUES (:name, :type, :rfid)');
    $stmt->bindParam(':name', $object_name, PDO::PARAM_STR);
    $stmt->bindParam(':type', $object_type, PDO::PARAM_BOOL);
    $stmt->bindParam(':rfid', $rfid, PDO::PARAM_STR);
    return $stmt->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function get_objects(){
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT * FROM objects LIMIT 20');
    $stmt->execute();
    
    $results = $stmt->fetchAll();
    return $results;
}