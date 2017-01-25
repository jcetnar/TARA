<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">TARA</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="/">Home</a></li>
      <li><a href="/about">About</a></li>
      <!-- <button class="btn btn-danger navbar-btn">Immediate Task</button> -->
      
      
      <button type="button" class="btn btn-info btn-small" data-toggle="modal" data-target="#myModal">Immediate Task</button>
         <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Request Immediate Task</h4>
                </div>
                <div class="modal-body">
                  <p>This is a small modal.</p>
                  <div class="container">
                  <form class="form-inline">
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="pwd">Password:</label>
                      <input type="password" class="form-control" id="pwd" placeholder="Enter password">
                    </div>
                    <div class="checkbox">
                      <label><input type="checkbox"> Remember me</label>
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
      
      <?php if ($isadmin): ?>
      <li><a href="/objects">Objects</a></li>
      <li><a href="/calendar">Calendar</a></li>
      <li><a href="/emergency">Emergency Contact</a></li>
      <?php endif; ?>
    </ul>
      
    <ul class="nav navbar-nav navbar-right">
        <?php if ($isadmin): ?>
        <li><a href="#">Logout</a></li>
        <?php else: ?>
        <li><a href="/login">Login</a></li>
        <?php endif; ?>
    </ul>
  </div>
</nav>
