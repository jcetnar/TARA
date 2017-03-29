<div class="task_form">
  <h1>Create a New Task</h1>
  <form class="form-inline">
    <div class="form-group">
      <label for="task_name">Name:</label>
      <input type="text" class="form-control" id="task_name" placeholder="Enter Name">
    </div>
    <div class="checkbox">
      <label><input type="checkbox" id="task_type"> Task Type (0 Bring Objects: 1 Guide to)</label>
    </div>
<!--    if task_type == 1, show stationary objects-->
    <ul class="list-unstyled form-group objects_list">
      <?php foreach ($objects as $object): ?>
        <li>
          <label><input type="checkbox" class="<?php if ($object['type'] == 1) { echo 'stationary'; } else {echo 'mobile';} ?> object" value="<?php echo $object['id']; ?>">
            <?php echo $object['name']; ?>
          </label>
        </li>
      <?php endforeach; ?>
    </ul>
    <button type="button" class="btn btn-default object-submit">Submit</button>
  </form>
</div>