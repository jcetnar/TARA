<?php
// Start PHP session for login handling. 
session_start();

require 'flight/Flight.php';
require 'app/utilities.php';

Flight::set('flight.views.path', './app/views');
Flight::set('flight.log_errors', true);

/**
 *
 */
Flight::route('/', function() {
  Flight::render('header', array('isadmin' => isadmin()), 'header_content');
  Flight::render('homepage', array(), 'body_content');
  Flight::render('footer', array(), 'footer_content');
  Flight::render('layout', array('title' => 'TARA Home Page'));
});

/**
 *
 */
Flight::route('/about', function(){
  Flight::render('header', array('isadmin' => isadmin()), 'header_content');
  Flight::render('about', array(), 'body_content');
  Flight::render('footer', array(), 'footer_content');
  Flight::render(
    'layout',
    array(
      'title' => 'TARA About Page',
      'css' => array(
        'http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css',
        'http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css',
      ),
    )
  );
});

/**
 *
 */
Flight::route('/emergency', function() {
  $request = Flight::request();
  if ($request->method == 'POST' && isadmin()) {
    $name = $request->data['name'];
    $email = $request->data['email'];
    $phone = $request->data['phone'];
    if (!empty($name) && !empty($email) && !empty($phone)) {
      try {
        insert_contact($name, $email, $phone);
      }
      catch (Exception $e) {
        Flight::render(
          'message',
          array(
            'message' => $e->getMessage(),
            'severity' => 'warning'
          ),
          'message_content'
        );
      }
    }
  }
  Flight::render('header', array('isadmin' => isadmin()), 'header_content');
  Flight::render('emergency', array('contacts' => get_contact()), 'body_content');
  Flight::render('footer', array(), 'footer_content');
  Flight::render('layout', array('title' => 'TARA Contact Page'));
});

/**
 *
 */
Flight::route('GET /login', function() {
  Flight::render('header', array('isadmin' => isadmin()), 'header_content');
  Flight::render('login', array(), 'body_content');
  Flight::render('footer', array(), 'footer_content');
  Flight::render('layout', array('title' => 'TARA Login Page'));
});

/**
 *
 */
Flight::route('POST /login', function() {
  $request = Flight::request();
  $username = $request->data['username'];
  $password = $request->data['password'];
  // Fool around with to get better validation of correct input
  if (!empty($username) && !empty($password)) {
    if (checkadmin($username, $password)) {
      $_SESSION['isadmin']=true;
      Flight::render('login_successful', array(), 'body_content');
    }
    else {
      Flight::render('login', array(), 'body_content');
      Flight::render(
        'message',
        array(
          'message' => 'incorrect login',
          'severity'=>'danger',
        ),
        'message_content'
      );
    }
  }
  else {
    Flight::render('login', array(), 'body_content');
    Flight::render(
      'message',
      array(
        'message' => 'missing username or password',
        'severity'=>'error',
      ),
      'message_content'
    ); 
  }
  Flight::render('header', array('isadmin' => isadmin()), 'header_content');
  Flight::render('footer', array(), 'footer_content');
  Flight::render('layout', array('title' => 'TARA Login Page'));
});

/**
 *
 */
Flight::route('/logout', function(){
  // Clear session variables and destroy it on the server side.
  session_unset();
  session_destroy();
  Flight::render('header', array('isadmin' => isadmin()), 'header_content');
  Flight::render('logout', array(), 'body_content');
  Flight::render('footer', array(), 'footer_content');
  Flight::render('layout', array('title' => 'TARA Logout Page'));
});

/**
 *
 */
Flight::route('/navigation', function(){    
  $request = Flight::request();
  if ($request->method == 'POST' && isadmin()) {
    $navigation_grid = $request->data['navigation_grid'];
    if (!empty($navigation_grid)) {
      try {
        save_nav_grid($navigation_grid);
      }
      catch (Exception $e) {
        Flight::render(
          'message',
          array(
            'message' => $e->getMessage(),
            'severity'=>'warning',
          ),
          'message_content'
        ); 
      }
    }
  }
  Flight::render('header', array('isadmin' => isadmin()), 'header_content');
  Flight::render('canvas', array('objects' => get_stationary_objects()), 'body_content');
  Flight::render(
    'layout',
    array(
      'title' => 'TARA Navigation Page',
      'css' => array(
        'app/css/canvas.css', 
      ),
      'js' => array(
        'app/js/canvas.js',
      ),
    )
  );
});

/**
 *
 */
Flight::route('/objects', function(){
  $request = Flight::request();
  if ($request->method == 'POST' && isadmin()){
    $object_method = $request->data['object_method'];
    $object_name = $request->data['object_name'];
    $rfid = $request->data['rfid'];
    $object_type = $request->data['object_type'];
    if ((!empty($object_name) && isset($object_type) && !empty($rfid)) || (!empty($rfid) && !empty($object_method))){
      error_log('1');
      try {
        if ($object_method == 'delete'){
          error_log('2');
          $res = object_delete($rfid);
          error_log($res);
        }
        else {
          insert_object($object_name, $rfid, $object_type);
        }
      } catch (Exception $e){
        Flight::render(
          'message',
          array(
            'message' => $e->getMessage(),
            'severity' => 'warning'
          ),
          'message_content'
        );
      }
    }
  }
  Flight::render('header', array('isadmin' => isadmin()), 'header_content');
  Flight::render('objects', array('objects' => get_objects()), 'body_content');
  Flight::render('footer', array(), 'footer_content');
  Flight::render(
    'layout',
    array(
      'title' => 'TARA Objects Page',
      'js' => array(
        'app/js/objects.js',
      )
    )
  );
});

/**
 *
 */
Flight::route('/tasks', function(){
  Flight::render('header', array('isadmin' => isadmin()), 'header_content');
  Flight::render('task_form', array('objects' => get_objects()), 'task_form_content');
  Flight::render('task_list', array('tasks' => get_task()), 'task_list_content');
  Flight::render('tasks',array(), 'body_content');
  // Flight::render('footer', array(), 'footer_content');
  Flight::render(
    'layout',
    array(
      'title' => 'TARA Task Page',
      'js' => array(
        '/app/js/task_form.js'
      )
    )
  );
});

/**
 * jlkj
 * lkjkl
 */
Flight::route('POST /tasks.json', function() {
  if (isadmin()) {
    $request = Flight::request();
    if ($request->data->operation === 'insert') {
      $id = add_task($request->data->name, $request->data->date, $request->data->repeat);
      $res = link_objects($id, $request->data->objects);
      Flight::json(array('id'=>$id));
    }
    else if ($request->data->operation === 'delete') {
      $task_id = $request->data->id;
      Flight::json(array('deleted' => task_delete($task_id)));
    }
  }
});

Flight::start();
