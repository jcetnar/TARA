<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>
  <meta charset='UTF-8'> 
     <!-- for scaling on phone -->
 	<meta name='viewport' content='width=device-width, initial-scale=10'> 
     <!-- bring css style sheet -->
 <!--  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css">

 <link rel='stylesheet' href='app/css/default_layout.css'>
 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</head>
<body>
  <div class='container'>
    <!--<header class='main-header'>-->
      <?php  echo $header_content; ?>
    <!--</header>-->
    <div class='main-content'>
      <?php echo $body_content; ?>
    </div>
    <div class='task-bar'>
        <?php echo $task_bar; ?>
    </div>
    <footer class='main-footer'>
      <?php echo $footer_content; ?>
    </footer>
  </div>
</body>
</html>


