<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>
  <meta charset='UTF-8'> 
     <!-- for scaling on phone -->
 	<meta name='viewport' content='width=device-width, initial-scale=10'>
     <!-- bring css style sheet -->
  <link rel='stylesheet' href='app/css/default_layout.css'>
</head>
<body>
  <div class='container'>
    <header class='main-header'>
      <?php  echo $header_content; ?>
    </header>
    <div class='main-content'>
      <?php echo $body_content; ?>
    </div>
    <footer class='main-footer'>
      <?php echo $footer_content; ?>
    </footer>
  </div>
</body>
</html>


