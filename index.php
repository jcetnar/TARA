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

Flight::route('GET /login', function(){
    Flight::render('header', array(), 'header_content');
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
    
    
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('objects', array('objects' => get_objects()), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Objects Page'));
});


Flight::route('/navigation', function(){
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


Flight::route('/schedule', function(){
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('schedule', array(), 'body_content');
   // Flight::render('task', array(), 'task_bar');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Calendar Page'));
});

Flight::route('/emergency', function(){
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

Flight::route('/grid', function(){
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('grid', array(), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Test'));
});


Flight::route('/task', function(){
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('task', array(), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Task Page'));
});

Flight::start();
?>
