<?php
//start session (for login) 
session_start();

require 'flight/Flight.php';
require 'app/utilities.php';

Flight::set('flight.views.path', './app/views');
Flight::set('flight.log_errors', true);

Flight::route('/logout', function(){
    //clears variables
    session_unset();
    session_destroy();
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('logout', array(), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Home Page'));
});

Flight::route('/', function(){
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('homepage', array(), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Home Page'));
});


Flight::route('/navigation', function(){    
    $request = Flight::request();
    if ($request->method=='POST' && isadmin()){
        $navigation_grid = $request->data['navigation_grid'];
         if (!empty($navigation_grid)){
            try {
             save_nav_grid($navigation_grid);
            } catch (Exception $e){
                Flight::render('message', array('message'=> $e->getMessage(),'severity'=>'warning'), 'message_content'); 
            }
         }
    }
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('canvas', array('objects' => get_stationary_objects()), 'body_content');
    Flight::render('layout', array('title' => 'TARA Objects Page'));
});


Flight::route('GET /login', function(){
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('login', array(), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Home Page'));
});


Flight::route('POST /login', function(){
    $request = Flight::request();
    $username = $request->data['username'];
    $password = $request->data['password'];
    // Fool around with to get better validation of correct input
    if (!empty($username) && !empty($password)){
        if (checkadmin($username, $password)){
            $_SESSION['isadmin']=true;
            Flight::render('login_successful', array(), 'body_content');
        }
        else {
            Flight::render('login', array(), 'body_content');
            Flight::render('message', array('message'=> 'incorrect login','severity'=>'danger'), 'message_content');
        }
    }
    else {
        Flight::render('login', array(), 'body_content');
        Flight::render('message', array('message'=> 'missing username or password','severity'=>'error'), 'message_content'); 
    }
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Login Page'));
});


Flight::route('/objects', function(){
    $request = Flight::request();
    if ($request->method=='POST' && isadmin()){
        $object_method = $request->data['object_method'];
        $object_name = $request->data['object_name'];
        $rfid = $request->data['rfid'];
        $object_type = $request->data['object_type'];
        if ((!empty($object_name) && isset($object_type) && !empty($rfid)) || (!empty($rfid) && !empty($object_method))){
            try {
                if ($object_method == 'delete'){
                    object_delete($rfid);
                }   
                else {
                    insert_object($object_name, $rfid, $object_type);
                }
            } catch (Exception $e){
                Flight::render('message', array('message'=> $e->getMessage(),'severity'=>'warning'), 'message_content'); 
            }
        }
    }
    else {
        Flight::render('header', array('isadmin' => isadmin()), 'header_content');
        Flight::render('objects', array('objects' => get_objects()), 'body_content');
        Flight::render('footer', array(), 'footer_content');
        Flight::render('layout', array('title' => 'TARA Objects Page'));
    }
});


Flight::route('/navigationOLD', function(){
    $request = Flight::request();
    if ($request->method=='POST' && isadmin()){
        $array_l = $request->data['array_l'];
        $array_w = $request->data['array_w'];
        $location = $request->data['location'];
         if (!empty($array_l) && !empty($array_w) && isset($location)){
            try {
             insert_navigation($array_l, $array_w, $location);
            } catch (Exception $e){
                Flight::render('message', array('message'=> $e->getMessage(),'severity'=>'warning'), 'message_content'); 
            }
         }
    }
    
    
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('navigation', array('navigation' => get_navigation()), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Navigation Page'));
});

Flight::route('/emergency', function(){
$request = Flight::request();
    if ($request->method=='POST' && isadmin()){
        $name = $request->data['name'];
        $email = $request->data['email'];
        $phone = $request->data['phone'];
         if (!empty($name) && !empty($email) && !empty($phone)){
            try {
             insert_contact($name, $email, $phone);
            } catch (Exception $e){
                Flight::render('message', array('message'=> $e->getMessage(),'severity'=>'warning'), 'message_content'); 
            }
         }
    }
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('emergency', array(), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Contact Page'));
});

Flight::route('/about', function(){
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('about', array(), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA About Page'));
});

Flight::route('/tasks', function(){
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('tasks', array('objects' => get_objects()), 'body_content');
    Flight::render('tasks_view', array('tasks' => get_task()), 'footer_content');
   //  Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Task Page'));
});

Flight::route('GET /tasks.json', function() {
});

Flight::route('POST /tasks.json', function() {
    if (isadmin()) {
        $request = Flight::request();
        if ($request->data->operation === 'insert') {
            $id = add_task($request->data->name, $request->data->date, $request->data->repeat);
            $res = link_objects($id, $request->data->objects);
            Flight::json(array('id'=>$id));
        }
        elseif ($request->data->operation === 'delete') {
            $task_id = $request->data->id;
            Flight::json(array('deleted' => true));
        }
    }
});
/*
Flight::route('/objects.json', function(){
    $request = Flight::request();
    if ($request->method=='POST' && isadmin() && false){
        $object_name = $request->data['object_name'];
        $rfid = $request->data['rfid'];
        $object_type = $request->data['object_type'];
         if (!empty($object_name) && !empty($rfid) && isset($object_type)){
            try {
             insert_object($object_name, $rfid, $object_type);
            } catch (Exception $e){
                Flight::render('message', array('message'=> $e->getMessage(),'severity'=>'warning'), 'message_content'); 
            }
         }
    }
});
 */

Flight::start();
