<?php
require __DIR__ . '/dbconfig.php';

date_default_timezone_set('America/New_York');

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

//throws exception on sql error, caught in index.php
function insert_object($object_name, $rfid, $object_type){
    $pdo = get_pdo();
    $stmt = $pdo->prepare('INSERT INTO objects (name, type, rfid) VALUES (:name, :type, :rfid)');
    $stmt->bindParam(':name', $object_name, PDO::PARAM_STR);
    $stmt->bindParam(':type', $object_type, PDO::PARAM_BOOL);
    $stmt->bindParam(':rfid', $rfid, PDO::PARAM_STR);
    return $stmt->execute();
}

function insert_contact($name, $email, $phone){
    $pdo = get_pdo();
    $stmt = $pdo->prepare('INSERT INTO contact (name, email, phone) VALUES (:name, :email, :phone)');
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    return $stmt->execute();
}

function insert_navigation($array_l, $array_w, $location){
    $pdo = get_pdo();
    $stmt = $pdo->prepare('INSERT INTO navigation (array_l, array_w, location) VALUES (:array_l, :array_w, :location)');
    $stmt->bindParam(':array_l', $array_l, PDO::PARAM_INT);
    $stmt->bindParam(':array_w', $array_w, PDO::PARAM_INT);
    $stmt->bindParam(':location', $location, PDO::PARAM_INT);
    return $stmt->execute();
}

function save_nav_grid($navigation_grid){
    file_put_contents('navigation_grid', serialize($navigation_grid));
    return true;
}

function add_task($name, $date, $repeat){
    // Ugly and bad. Breaks on changes to capitalization of string.
    // Here to avoid complaints about $repeat being a string.
    $repeat = ($repeat === 'true') ? 1 : 0;
    $pdo = get_pdo();
    $stmt = $pdo->prepare('INSERT INTO tasks (`name`, `date`, `repeat_weekly`) VALUES (:name, :date, :repeat_weekly)');
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':date', date("Y-m-d H:i:s", strtotime($date)), PDO::PARAM_STR);
    // I have no idea why *this* needs to be an INT but the other can be a BOOL.
    // However MySQL has decided to not run queries any other way so sod it.
    $stmt->bindParam(':repeat_weekly', $repeat, PDO::PARAM_INT);
    $stmt->execute();

    return $pdo->lastInsertId(); 
}


function get_objects(){
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT * FROM objects LIMIT 20');
    $stmt->execute();
    
    $results = $stmt->fetchAll();
    return $results;
}

function get_navigation(){
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT * FROM navigation LIMIT 200');
    $stmt->execute();
    
    $results = $stmt->fetchAll();
    return $results;
}

function get_task(){
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT name, date, repeat_weekly FROM tasks');
    $stmt->execute();
    
    $results = $stmt->fetchAll();
    return $results;
}

function get_contact(){
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT name, email, phone FROM contact');
    $stmt->execute();
    
    $results = $stmt->fetchAll();
    return $results;  
}

function link_objects($id, $objects) {
    $pdo = get_pdo();
    $res = TRUE;
    foreach ($objects as $object) {
        var_dump($object);
        $object_id = $object;
        $stmt = $pdo->prepare('INSERT INTO tasks_objects (`task_id`, `object_id`) VALUES (:task_id, :object_id)');
        $stmt->bindParam(':task_id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':object_id', $object_id, PDO::PARAM_STR);
        $res = $stmt->execute();
    }
    return $res;
}

function get_stationary_objects(){
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT * FROM objects WHERE type = 1 LIMIT 20');
    $stmt->execute();
    
    $results = $stmt->fetchAll();
    return $results;
}