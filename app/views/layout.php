<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>
  <meta charset='UTF-8'> 
  <!-- Set viewport for proper scaling on mobile -->
 	<meta name='viewport' content='width=device-width, initial-scale=10'>
  <!-- General Stylesheets -->
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <!-- Page Specific Stylesheets -->
  <?php if (isset($css) && is_array($css)): ?>
    <?php foreach ($css as $sheet): ?>
      <link rel='stylesheet' href='<?php echo $sheet; ?>'>
    <?php endforeach; ?>
  <?php endif; ?>
  <!-- General JS Libraries -->
  <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
  <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
  <script type='text/javascript' src='app/js/status.js'></script>
  <!-- Page Specific JS -->
  <?php if (isset($js) && is_array($js)): ?>
    <?php foreach ($js as $lib): ?>
      <script type='text/javascript' src='<?php echo $lib; ?>'></script>
    <?php endforeach; ?>
  <?php endif; ?>
</head>
<body>
  <div class='container'>
    <header class='main-header'>
      <?php if (isset($header_content)): ?>
        <?php  echo $header_content; ?>
      <?php endif; ?>
    </header>
      <div class="status-banner alert alert-success">
          
      </div>
    <div class='message-content'>
      <?php if(isset($message_content)): ?>
        <?php echo $message_content; ?>
      <?php endif; ?>
    </div>
    <div class='main-content'>
      <?php if (isset($body_content)): ?>
        <?php echo $body_content; ?>
      <?php endif; ?>
    </div>
    <footer class='main-footer'>
      <?php if (isset($footer_content)): ?>
        <?php echo $footer_content; ?>
      <?php endif; ?>
    </footer>
  </div>
</body>
</html>


