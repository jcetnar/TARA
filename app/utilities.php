<?php
require __DIR__ . '/dbconfig.php';

date_default_timezone_set('America/New_York');

function get_base_url() {
  return '';
}

//admin
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

//navigation
function save_nav_grid($navigation_grid){
  file_put_contents('./app/data/navigation_grid', serialize($navigation_grid));
  return true;
}

function load_nav_grid() {
    $nav_grid = file_get_contents('./app/data/navigation_grid');
    return unserialize($nav_grid);
}

//task
function generate_task_list(){
    $pdo = get_pdo();
    $stmt = $pdo->prepare('SELECT * FROM tasks WHERE id > 2');
//    only send tasks once
    $stmt->execute();
    $results = $stmt->fetchAll();   
    $tasks = array();
    foreach ($results as $result) {
        $stmt = $pdo->prepare('SELECT objects.* FROM objects INNER JOIN tasks_objects WHERE tasks_objects.task_id = :id');
        $stmt->bindParam(':id', $result['id'], PDO::PARAM_INT);
        $stmt->execute();
        $result['objects'] = $stmt->fetchAll();
        $tasks[] = $result;
    }
    return $tasks;

}

function load_task_list() {
    $task_list = file_get_contents('./app/data/task_list');
    return unsearilize($task_list);
}

function add_task($name, $start_date, $end_date, $task_type, $repeat){
  $repeat = (strcasecmp($repeat, 'true') === 0) ? 1 : 0;
  $start_date = !empty($start_date) ? strtotime($start_date) : time();
  $end_date = !empty($end_date) ? strtotime($end_date) : time();
  $start_date = date('Y-m-d H:i:s', strtotime('+2 minutes', $start_date));
  $end_date = date('Y-m-d H:i:s', strtotime('+2 minutes', $end_date));
  $pdo = get_pdo();
  $stmt = $pdo->prepare('INSERT INTO tasks (`name`, `start_date`, `end_date`, `task_type`, `repeat_weekly`) VALUES (:name, :start_date, :end_date, :task_type, :repeat_weekly)');
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
  $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
  // I have no idea why *this* needs to be an INT but the other can be a BOOL.
  // However MySQL has decided to not run queries any other way so sod it.
  $stmt->bindParam(':task_type', $repeat, PDO::PARAM_INT);
  $stmt->bindParam(':repeat_weekly', $repeat, PDO::PARAM_INT);
  $stmt->execute();
  return $pdo->lastInsertId();
}

function get_task(){
  $pdo = get_pdo();
  $stmt = $pdo->prepare('SELECT id, name, start_date, end_date, task_type, repeat_weekly FROM tasks');
  $stmt->execute();
  $results = $stmt->fetchAll();
  for ($i = 0; $i < count($results); $i++) {
    $id = $results[$i]['id'];
    $stmt = $pdo->prepare('SELECT objects.name AS name FROM tasks_objects INNER JOIN objects ON tasks_objects.object_id=objects.id WHERE tasks_objects.task_id=:id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $objs = $stmt->fetchAll();
    foreach ($objs as $obj) {
      $results[$i]['task_objects'][] = $obj['name'];
    }
  }
  return $results;
}

function task_delete($id) {
  $id = trim($id);
  $pdo = get_pdo();
  $stmt = $pdo->prepare('DELETE FROM tasks WHERE id=:id');
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  return $stmt->execute();
}

//contact

function insert_contact($contact_name, $contact_email, $contact_phone){
  $pdo = get_pdo();
  $stmt = $pdo->prepare('INSERT INTO contact (name, email, phone) VALUES (:name, :email, :phone)');
  $stmt->bindParam(':name', $contact_name, PDO::PARAM_STR);
  $stmt->bindParam(':email', $contact_email, PDO::PARAM_STR);
  $stmt->bindParam(':phone', $contact_phone, PDO::PARAM_STR);
  return $stmt->execute();
}

function get_contact(){
  $pdo = get_pdo();
  $stmt = $pdo->prepare('SELECT id, name, email, phone FROM contact');
  $stmt->execute();
  $results = $stmt->fetchAll();
  return $results;
}

function contact_delete($contact_id){
  $pdo = get_pdo();
  $contact_id = trim($contact_id);
  $stmt = $pdo->prepare('DELETE FROM contact WHERE id=:id');
  $stmt->bindParam(':id', $contact_id, PDO::PARAM_INT);
  return $stmt->execute();
}

//SHELF
function insert_shelf($shelf_id, $location_barcode){
  error_log('INFO - Insert Shelf');
  $pdo = get_pdo();
  $stmt = $pdo->prepare('INSERT INTO shelf (shelf_id, location_barcode) VALUES (:shelf_id, :location_barcode)');
  $stmt->bindParam(':shelf_id', $shelf_id, PDO::PARAM_STR);
  $stmt->bindParam(':location_barcode', $location_barcode, PDO::PARAM_STR);
  return $stmt->execute();
}

function get_shelf(){
  $pdo = get_pdo();
  $stmt = $pdo->prepare('SELECT shelf_id, location_barcode FROM shelf');
  $stmt->execute();
  $results = $stmt->fetchAll();
  return $results;
}

function get_shelf_to_send(){
  $pdo = get_pdo();
  $stmt = $pdo->prepare('SELECT shelf_id as shelf, location_barcode as location FROM shelf');
  $stmt->execute();
  $results = $stmt->fetchAll();
  return $results;
}

function shelf_delete($shelf_id){
  $pdo = get_pdo();
  $shelf_id = trim($shelf_id);
  $stmt = $pdo->prepare('DELETE FROM shelf WHERE shelf_id=:shelf_id');
  $stmt->bindParam(':shelf_id', $shelf_id, PDO::PARAM_STR);
  return $stmt->execute();
}

//Object
//throws exception on sql error, caught in index.php
function insert_object($object_name, $object_type, $object_location){
  $pdo = get_pdo();
  $stmt = $pdo->prepare('INSERT INTO objects (name, type, location) VALUES (:name, :type, :location)');
  $stmt->bindParam(':name', $object_name, PDO::PARAM_STR);
  $stmt->bindParam(':type', $object_type, PDO::PARAM_BOOL);
  //$stmt->bindParam(':id', $id, PDO::PARAM_STR);
  $stmt->bindParam(':location', $object_location, PDO::PARAM_STR);
  return $stmt->execute();
}

function get_objects(){
  $pdo = get_pdo();
  $stmt = $pdo->prepare('SELECT * FROM objects LIMIT 20');
  $stmt->execute();
  $results = $stmt->fetchAll();
  return $results;
}

function object_delete($id){
  $pdo = get_pdo();
  $id = trim($id);
  $stmt = $pdo->prepare('DELETE FROM objects WHERE id=:id');
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  return $stmt->execute();
}

function get_stationary_objects(){
  $pdo = get_pdo();
  $stmt = $pdo->prepare('SELECT * FROM objects WHERE type = 1 LIMIT 20');
  $stmt->execute();
  $results = $stmt->fetchAll();
  return $results;
}

function link_objects($id, $objects) {
  $pdo = get_pdo();
  $res = TRUE;
  foreach ($objects as $object) {
    $object_id = $object;
    $stmt = $pdo->prepare('INSERT INTO tasks_objects (`task_id`, `object_id`) VALUES (:task_id, :object_id)');
    $stmt->bindParam(':task_id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':object_id', $object_id, PDO::PARAM_STR);
    $res = $stmt->execute();
  }
  return $res;
}
