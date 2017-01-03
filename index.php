<html>
  <head>
   <title>
    TARA
   </title>
  </head>

<?php
require 'flight/Flight.php';

Flight::route('/', function(){
    echo 'TARA!';
});

Flight::start();
?>
