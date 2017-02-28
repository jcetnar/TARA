<h2>Emergency Contact</h2>
<table class="table table-hover">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <form action='<?php echo get_base_url() . '/emergency'; ?>' method='POST'>
        <td>
          <input type="text" name="name" value="name" />
        </td>
        <td>
          <input type="text" name="email" value="email" />
        </td>
        <td>
          <input type="text" name="phone" value="phone" />
        </td>
        <td>
          <button type="submit" class="btn btn-default">Submit</button>
        </td>
      </form>
    </tr>
    <?php if (isset($contacts)): ?>
      <?php foreach ($contacts as $contact): ?>
        <tr>
          <td>
            <?php echo $contact['name']; ?>
          </td>
          <td>
            <?php echo $contact['email']; ?>
          </td>
          <td>
            <?php echo $contact['phone']; ?>
          </td>
          <td>
            <button class="btn btn-sm">Delete</button>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>


