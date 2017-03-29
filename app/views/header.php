<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo get_base_url() . '/'; ?>">TARA</a>
    </div>
    <ul class="nav navbar-nav">
<!--      <li><a href="<?php echo get_base_url() . '/about'; ?>">About</a></li> --> 
      <?php if ($isadmin): ?>
        <li><a href="<?php echo get_base_url() . '/navigation'; ?>">Room Setup</a></li>
        <li><a href="<?php echo get_base_url() . '/objects' ; ?>">Object Library</a></li>
        <li><a href="<?php echo get_base_url() . '/tasks' ; ?>">Scheduled Tasks</a></li>
        <li><a href="<?php echo get_base_url() . '/emergency' ; ?>">Emergency Contact</a></li>
      <?php endif; ?>
      <a class="btn btn-info btn-small navbar-btn" href="<?php echo get_base_url() . '/immediate'; ?>">Immediate Task</a>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if ($isadmin): ?>
        <li><a href="<?php echo get_base_url() . '/logout'; ?>">Logout</a></li>
      <?php else: ?>
        <li><a href="<?php echo get_base_url() . '/login'; ?>">Login</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
