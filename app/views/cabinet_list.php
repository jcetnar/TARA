<h2>Cabinet List</h2>
<table class="table table-hover task-table">
  <thead>
    <tr>
      <th>Cabinet Name</th>
      <th>Shelf RFID</th>
      <th>Shelf RFID</th>
      <th>Shelf RFID</th>
    </tr>
  </thead>
  <tbody>
      <!-- this will change to logic for 3 rfid's per cabinet---will sort from the unique Cabinet Name -->
    <?php foreach ($cabinets as $cabinet): ?>
      <tr class="task" data-id="<?php echo $cabinet['id']; ?>">
        <td>
          <?php echo $cabinet['name']; ?>
        </td>
        <td>
          <?php if (isset($shelf['shelf_in_cabinet'])): ?>
            <?php echo implode(', ', $shelf['shelf_in_cabinet']); ?>
          <?php endif; ?>
        </td>
        <td>
          <button class="btn btn-sm button-task-delete">Delete</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


