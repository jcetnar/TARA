<div class="task_form">
  <h1>Create a New Task
      <!-- Make the viewport larger than 768px wide to see that all of the form elements are inline, left aligned, and the labels are alongside.
      --></h1>
  <form class="form-inline">
    <div class="form-group">
      <label for="task_name">Name:</label>
      <input type="text" class="form-control" id="task_name" placeholder="Enter Name">
    </div>
    <div class="form-group">
      <label for="start_date">Start Date:</label>
      <input type="datetime" class="form-control" id="start_date" placeholder="Enter Start Date">
    </div>
    <div class="form-group">
      <label for="end_date">End Date:</label>
      <input type="datetime" class="form-control" id="end_date" placeholder="Enter End Date">
    </div>
<!--      Starting messy logic....-->
    <div class="checkbox">
      <label><input type="checkbox" id="task_type"> Task Type (0 Bring Objects: 1 Guide to)</label>
    </div>
<!--    if task_type == 1, show stationary objects-->
    <ul class="list-unstyled form-group objects_list">
      <?php foreach ($objects as $object): ?>
        <li>
          <label><input type="checkbox" class="object" value="<?php echo $object['id']; ?>">
            <?php echo $object['name']; ?>
          </label>
        </li>
      <?php endforeach; ?>
    </ul>
    <div class="checkbox">
      <label><input type="checkbox" id="repeat"> Repeat Weekly</label>
    </div>
    <button type="button" class="btn btn-default object-submit">Submit</button>
  </form>
</div>