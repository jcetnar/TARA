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
    return true; 
}
