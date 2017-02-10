<?php
function log_message($msg) {
  file_put_contents("php://stdout", "$msg\n");
}
function load_json() {
  $data = file_get_contents('data.json');
  return json_decode($data, true);
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  log_message('Got a GET');
  echo json_encode(load_json());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  log_message('Got a POST');
  $json = load_json();

  $action = $_POST['action'];
  if ($action == 'create') {
    $newID = end($json)['id'] + 1;
    $json[] = array(
      'id' => $newID,
      'name' => $_POST['data']['name'],
      'date' => $_POST['data']['date'],
      'objects' => $_POST['data']['objects'],
    );
    http_response_code(201);
    header("TaskID:$newID");
  }
  else if ($action == 'update') {
    $key = array_search($_POST['data']['id'], array_column($json, 'id'));
    $json[$key] = array(
      'id' => $json[$key]['id'],
      'name' => $_POST['data']['name'],
      'date' => $_POST['data']['date'],
      'objects' => $_POST['data']['objects'],
    );
  }
  else if ($action == 'delete') {
    $key = array_search($_POST['data']['id'], array_column($json, 'id'));
    unset($json[$key]);
  }
  file_put_contents("data.json", json_encode($json));
}
