<h2>Objects</h2>
<table class="table table-hover">
  <thead>
    <tr>
      <th>Object Name</th>
      <th>Object Type</th>
      <th>Shelf ID <br> if mobile object, enter tray RFID. if stationary, enter location barcode </br> </th> <!-- formerly RFID --> 
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr class="object-form">
      <form action='<?php echo get_base_url() . '/objects'; ?>' method='POST'>
        <td>
          <input type="text" name="object_name" placeholder="Pills" />
        </td>
         <td>
          <select name="object_type">
            <option value='0'>Mobile</option>
            <option value='1'>Stationary</option>
          </select>
        </td>
        <!-- Location is either tray RFIDs or location barcode for stationary objects -->
        <td>
          <input type="text" name="object_location" placeholder="000901" />
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
        <td class="object-type">
          <?php if ($object['type'] == 0): ?>
            Mobile
          <?php else: ?>
            Stationary
          <?php endif; ?>
        </td>
        <td class="object-location">
          <?php echo $object['location']; ?>
        </td>
        <td>
          <button class = "button-object-delete btn btn-sm" data-id='<?php echo $object['id']; ?>'>Delete</button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


