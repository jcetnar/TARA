
<?php
require 'flight/Flight.php';

Flight::set('flight.views.path', './app/views');


//comment 

Flight::route('/', function(){
  //  Flight::render('header', array('isadmin' => false), 'header_content');
    Flight::render('header2', array(), 'header_content;);
    Flight::render('homepage', array(), 'body_content');
    Flight::render('footer', array(), 'footer_content');
    Flight::render('layout', array('title' => 'TARA Home Page'));
});

Flight::start();
?>
