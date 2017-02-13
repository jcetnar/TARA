<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">TARA</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/about">About</a></li>
      
     

      
      <?php if ($isadmin): ?>
      <li><a href="<?php echo get_base_url() . '/navigation'; ?>">Room Setup</a></li>
      <li><a href="<?php echo get_base_url() . '/objects' ; ?>">Object Library</a></li>
      <li><a href="<?php echo get_base_url() . '/tasks' ; ?>">Scheduling</a></li>
      <li><a href="<?php echo get_base_url() . '/emergency' ; ?>">Emergency Contact</a></li>
      <?php endif; ?>
        <button type="button" class="btn btn-info btn-small navbar-btn" data-toggle="modal" data-target="#myModal">Immediate Task</button>
         <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Request Immediate Task</h4>
                </div>
                <div class="modal-body">
                  <div class="container">
                  <form class="form-inline">
                    <div class="form-group">
                      <label for="text">Name:</label>
                      <input type="text" class="form-control" id="text" placeholder="Morning Pills">
                    </div>
                    <div class="form-group">
                      <label for="text">Objects</label>
                      <input type="text" class="form-control" id="pwd" placeholder="Select Objects">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                  </form>
                </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>   
            </div>
          </div>
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
