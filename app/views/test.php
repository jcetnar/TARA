

<div class='task_bar'
<div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="page-header text-center">
              <h2 contenteditable="true">Schedule a Routine Task</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <form class="form-horizontal" role="form">
                    <div class="form-group">
                      <div class="col-sm-2">
                        <label for="inputEmail3" class="control-label">Task Name</label>
                      </div>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Task Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-2">
                        <label for="inputPassword3" class="control-label">Task Day</label>
                      </div>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="Monday">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-2">
                        <label for="inputEmail3" class="control-label">Task Time</label>
                      </div>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="18:00">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox">Repeat Weekly</label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10"></div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <ul id="myUL">
        <li>Object 1</li>
        <li class="checked">Object 2</li>
        <li>Object 3</li>
        <li>Object 4</li>
        <li>Object 5</li>
        <li>Object 6</li>
      </ul>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <button type="submit" class="btn btn-default btn-lg">Submit</button>
          </div>
        </div>
      </div>
      <div class="page-header text-center">
        <h2>Add Object</h2>
      </div>
      <div id="myDIV" class="header">
        <h2 style="margin:5px">Objects</h2>
        <input type="text" id="myInput" placeholder="Add Object Name...">
        <input type="text" id="myInput" placeholder="RFID Number...">
        <div class="btn-group btn-group-lg">
              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Object Type <span class="fa fa-caret-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <a href="#">Mobile</a>
                  <a href="#">Stationary</a>
                </li>
              </ul>
        </div>
        <span onclick="newElement()" class="addBtn">Add</span>
      </div>
      <script>
        // Create a "close" button and append it to each list item
        var myNodelist = document.getElementsByTagName("LI");
        var i;
        for (i = 0; i < myNodelist.length; i++) {
          var span = document.createElement("SPAN");
          var txt = document.createTextNode("\u00D7");
          span.className = "close";
          span.appendChild(txt);
          myNodelist[i].appendChild(span);
        }
        
        // Click on a close button to hide the current list item
        var close = document.getElementsByClassName("close");
        var i;
        for (i = 0; i < close.length; i++) {
          close[i].onclick = function() {
            var div = this.parentElement;
            div.style.display = "none";
          }
        }
        
        // Add a "checked" symbol when clicking on a list item
        var list = document.querySelector('ul');
        list.addEventListener('click', function(ev) {
          if (ev.target.tagName === 'LI') {
            ev.target.classList.toggle('checked');
          }
        }, false);
        
        // Create a new list item when clicking on the "Add" button
        function newElement() {
          var li = document.createElement("li");
          var inputValue = document.getElementById("myInput").value;
          var t = document.createTextNode(inputValue);
          li.appendChild(t);
          if (inputValue === '') {
            alert("You must write something!");
          } else {
            document.getElementById("myUL").appendChild(li);
          }
          document.getElementById("myInput").value = "";
        
          var span = document.createElement("SPAN");
          var txt = document.createTextNode("\u00D7");
          span.className = "close";
          span.appendChild(txt);
          li.appendChild(span);
        
          for (i = 0; i < close.length; i++) {
            close[i].onclick = function() {
              var div = this.parentElement;
              div.style.display = "none";
            }
          }
        }
      </script>
    </div>
  </div>
    <div class="section"></div>
    <div class="page-header text-center">
      <h2>
        <br>
      </h2>
    </div>
    
    
    