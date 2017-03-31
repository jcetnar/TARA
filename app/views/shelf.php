<h2>Assign Shelves to Locations</h2>
<table class="table shelf-table table-hover">
  <thead>
    <tr>
      <th>Shelf ID</th>
      <th>Location</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <form action='<?php echo get_base_url() . '/shelf'; ?>' method='POST'>
        <td>
          <input type="text" name="shelf_id" placeholder="1" />
        </td>
        <td>
          <input type="text" name="location_barcode" placeholder="12" />
        </td>
        <td>
          <button type="button" class="btn-shelf-submit">Submit</button>
        </td>
      </form>
    </tr>
    <?php if (isset($shelfs)): ?>
      <?php foreach ($shelfs as $shelf): ?>
        <tr class="shelf" shelf-id="<?php echo $shelf['shelf_id']; ?>">
          <td>
            <?php echo $shelf['shelf_id']; ?>
          </td>
          <td>
            <?php echo $shelf['location_barcode']; ?>
          </td>
          <td>
            <button class="btn btn-sm button-shelf-delete">Delete</button>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>


