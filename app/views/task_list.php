<h2>Scheduled Tasks</h2>
<table class="table table-hover task-table">
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
    <?php foreach ($tasks as $task): ?>
      <tr class="task" data-id="<?php echo $task['id']; ?>">
        <td>
          <?php echo $task['name']; ?>
        </td>
        <td>
          <?php echo $task['date']; ?>
        </td>
        <td>
          <?php if (isset($task['task_objects'])): ?>
            <?php echo implode(', ', $task['task_objects']); ?>
          <?php endif; ?>
        </td>
        <td>
          <?php if ($task['repeat_weekly'] === 1): ?>
            Repeat
          <?php else: ?>
            None
          <?php endif; ?>
        </td>
        <td>
          <button class="btn btn-sm button-task-delete">Delete</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

