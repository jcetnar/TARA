
<?php
require 'flight/Flight.php';
require 'app/utilities.php';

Flight::set('flight.views.path', './app/views');
Flight::set('flight.log_errors', true);


Flight::route('/', function(){
    $isadmin = isadmin('admin', 'password');
    Flight::render('header', array('isadmin' => $isadmin), 'header_content');
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
    if (isset($username) && isset($password)){
        if (checkadmin($username, $password)){
            Flight::redirect('/');
            Flight::stop();
        }
        else {
            Flight::redirect('/login');
        }
    }
});


Flight::route('/objects', function(){
    $isadmin = isadmin('admin', 'password');
    Flight::render('header', array('isadmin' => $isadmin), 'header_content');
    //Flight::render('header', array(), 'header_content');
    Flight::render('objects', array(), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Objects Page'));
});

Flight::route('/calendar', function(){
    $isadmin = isadmin('admin', 'password');
    Flight::render('header', array('isadmin' => $isadmin), 'header_content');
    //Flight::render('header', array(), 'header_content');
    Flight::render('calendar', array(), 'body_content');
    Flight::render('task', array(), 'task_bar');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Calendar Page'));
});

Flight::route('/emergency', function(){
    $isadmin = isadmin('admin', 'password');
    Flight::render('header', array('isadmin' => $isadmin), 'header_content');
    //Flight::render('header', array(), 'header_content');
    Flight::render('emergency', array(), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Contact Page'));
});

Flight::route('/about', function(){
    Flight::render('header', array(), 'header_content');
    Flight::render('about', array(), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA About Page'));
});

Flight::route('/test', function(){
    Flight::render('header', array(), 'header_content');
    Flight::render('test', array(), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Test'));
});


Flight::route('/task', function(){
    $isadmin = isadmin('admin', 'password');
    Flight::render('header', array('isadmin' => $isadmin), 'header_content');
    //Flight::render('header', array(), 'header_content');
    Flight::render('task', array(), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Task Page'));
});

Flight::start();
?>
