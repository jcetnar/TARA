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

//Flight::route('/about', function(){
//  Flight::render('header', array('isadmin' => isadmin()), 'header_content');
//  Flight::render('about', array(), 'body_content');
//  Flight::render('footer', array(), 'footer_content');
//  Flight::render(
//    'layout',
//    array(
//      'title' => 'TARA About Page',
//      'css' => array(
//        'http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css',
//        'http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css',
//      ),
//    )
//  );
//});

/**
 *
 */
Flight::route('/emergency', function() {
  $request = Flight::request();
  if ($request->method == 'POST' && isadmin()) {
    $contact_name = $request->data['name'];
    $contact_email = $request->data['email'];
    $contact_phone = $request->data['phone'];
    if (!empty($contact_name) && !empty($contact_email) && !empty($contact_phone)) {
      try {
        insert_contact($contact_name, $contact_email, $contact_phone);
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
Flight::route('/shelf', function() {
  $request = Flight::request();
  if ($request->method == 'POST' && isadmin()) {
    $shelf_id = $request->data['shelf_id'];
    $location_barcode = $request->data['location_barcode'];
    $shelf_method = $request->data['operation'];
    error_log('got here');
    if (!empty($shelf_id) && !empty($location_barcode)) {
        error_log('got past the if');
      try {
          if ($shelf_method == 'delete'){
          error_log('2');
          $res = shelf_delete($shelf_id);
          error_log($res);
        }
     else {
         insert_shelf($shelf_id, $location_barcode);
         }
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
  //check below
  Flight::render('shelf', array('shelfs' => get_shelf()), 'body_content');
  Flight::render('footer', array(), 'footer_content');
  Flight::render('layout', array('title' => 'TARA Shelf Page', 'js' => array(
        'app/js/shelf.js',
      ),
    ));
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
    $id = $request->data['id'];//formerly rfid
    $object_type = $request->data['object_type'];
    $object_location = $request->data['object_location'];
    if (!empty($object_name) && isset($object_type) || (!empty($id) && !empty($object_method))){
      error_log('1');
      try {
        if ($object_method == 'delete'){
          error_log('2');
          $res = object_delete($id); //formerly rfid
          error_log($res);
        }
        else {
          insert_object($object_name, $object_type, $object_location);
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


Flight::route('/immediate', function(){
  Flight::render('header', array('isadmin' => isadmin()), 'header_content');
  Flight::render('immediate', array('objects' => get_objects()), 'body_content');
  Flight::render('footer', array(), 'footer_content');
  
  Flight::render('layout',
    array(
      'title' => 'TARA Immediate Page',
      'js' => array(
        'app/js/contact.js'
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
  Flight::render('footer', array(), 'footer_content');
  Flight::render(
    'layout',
    array(
      'title' => 'TARA Task Page',
      'js' => array(
        'app/js/task_form.js'
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
      $id = add_task($request->data->name, $request->data->start_date, $request->data->end_date, $request->data->task_type, $request->data->repeat);
      $res = link_objects($id, $request->data->objects);
      Flight::json(array('id'=>$id));
    }
    else if ($request->data->operation === 'delete') {
      $task_id = $request->data->id;
      Flight::json(array('deleted' => task_delete($task_id)));
    }
  }
});

// for Grace, use GET to cobweb ~jcetnar/task_list.json
Flight::route('/task_list.json', function() {
    $list = generate_task_list();
   //array in PHP is a hash map -> key, value, store
//    $tasks = array(
//        array(
//          //keys are numbers or strings mosttimes
//            'name'=>'Get Pills',
//            'date'=>'05/29/2017 19:00:00',
//            'objects'=> array(
//                array(
//                    'name'=>'Pills',
//                    //location is the shelf RFID
//                    'location'=> '001023',
//                    //object_id is auto-generated when the object is entered
//                    'object_id'=> '1',
//                ),
//            ),
//            'repeat'=> 1,
//        ),
//    );
    Flight::json($list);
});

Flight::route('/nav_grid.json', function() {
    $nav_grid = load_nav_grid();
    $long_grid = array();
    foreach ($nav_grid as $row) {
        $long_grid = array_merge($long_grid, $row);
    }
    $nav_format = array(
        "width" => count($nav_grid),
        "length" => count($nav_grid[0]),
        "array" => $long_grid,
    );
    Flight::json($nav_format);
});

Flight::route('/shelf.json', function() {
    $shelf_grid = array();
    foreach ($shelf_grid as $row) {
        $long_grid = array_merge($long_grid, $row);
    }
    $shelf_format = array(
        "shelf" => count($shelf_grid),
        "locations" => count($shelf_grid[0]),
    );
    Flight::json($nav_format);
});

Flight::route('/status.json', function() {
 $request = Flight::request();
  if ($request->method == 'POST') {
    $status = $request->data['status'];
    file_put_contents('./app/data/status', serialize($status));
  }
  elseif ($request->method == 'GET') {
    $status = file_get_contents('./app/data/status');
        Flight::json(unserialize($status));
  }
});

Flight::start();
