<!--
<div class="container">
  <h2>Scheduled Tasks</h2>         
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Task Name</th>
        <th>Date</th>
        <th>Objects</th>
        <th>Repeat</th>
        <th>Remove </th>
      </tr>
    </thead>
    <tbody>
    <tr>
    </tr>
     <?php foreach ($tasks as $task): ?>
    <tr>
        <td>
            <?php echo $task_name['task_name']; ?>
        </td>
        <td>
            <?php echo $date['date']; ?>
        </td>
        <td>
            <?php echo $task_objects['task_objects']; ?>
        </td>
        <td>
            <?php if ($repeat['repeat_weekly'] === 0): ?>
                Repeat
            <?php else: ?>
                None
            <?php endif; ?>
        </td>
        <td>
            <button class="btn btn-sm">Delete</button>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
-->
