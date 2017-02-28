<h2>Objects</h2>
<table class="table table-hover">
  <thead>
    <tr>
      <th>Object Name</th>
      <th>RFID</th>
      <th>Object Type</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr class="object-form">
      <form action='<?php echo get_base_url() . '/objects'; ?>' method='POST'>
        <td>
          <input type="text" name="object_name" value="Object" />
        </td>
        <td>
          <input type="text" name="rfid" value="RFID" />
        </td>
        <td>
          <select name="object_type">
            <option value='0'>Mobile</option>
            <option value='1'>Stationary</option>
          </select>
        </td>
        <td>
          <button type="submit" class="btn btn-default">Submit</button>
        </td>
      </form>
    </tr>
    <?php foreach ($objects as $object): ?>
      <tr class="object">
        <td class="object-name">
          <?php echo $object['name']; ?>
        </td>
        <td class="object-rfid">
          <?php echo $object['rfid']; ?>
        </td>
        <td class="object-type">
          <?php if ($object['type'] === 0): ?>
            Mobile
          <?php else: ?>
            Stationary
          <?php endif; ?>
        </td>
        <td>
          <button class = "button-object-delete btn btn-sm">Delete</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


