<div class="task_form">
  <p>Create a New Task
      <!-- Make the viewport larger than 768px wide to see that all of the form elements are inline, left aligned, and the labels are alongside.
      --></p>
  <form class="form-inline">
    <div class="form-group">
      <label for="task_name">Name:</label>
      <input type="text" class="form-control" id="task_name" placeholder="Enter Name">
    </div>
    <div class="form-group">
      <label for="date">Date:</label>
      <input type="text" class="form-control" id="date" placeholder="Enter Date">
    </div>
    <ul class="form-group objects_list">
        <?php foreach ($objects as $object): ?>
        <li>
            <label><input type="checkbox" class="object" value="<?php echo $object['rfid']; ?>">
             <?php echo $object['name']; ?>
            </label>
        </li>
        <?php endforeach; ?>
    </ul>
    <div class="checkbox">
      <label><input type="checkbox"> Repeat Weekly</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

<div id="task-grid"></div>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="/app/js/task_grid.js"></script>