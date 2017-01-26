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
    if (!empty($username) && !empty($password)){
        if (checkadmin($username, $password)){
            $_SESSION['isadmin']=true;
            Flight::render('login_successful', array(), 'body_content');
        }
        else {
            Flight::render('login', array(), 'body_content');
            Flight::render('message', array('message'=> 'incorrect login','severity'=>'error'), 'message_content');
        }
    }
    else {
        Flight::render('login', array(), 'body_content');
        Flight::render('message', array('message'=> 'missing username or password','severity'=>'error'), 'message_content'); 
    }
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Objects Page'));
});


Flight::route('/objects', function(){
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('objects', array(), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Objects Page'));
});

Flight::route('/calendar', function(){
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('calendar', array(), 'body_content');
    Flight::render('task', array(), 'task_bar');
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

Flight::route('/test', function(){
    Flight::render('header', array('isadmin' => isadmin()), 'header_content');
    Flight::render('test', array(), 'body_content');
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
