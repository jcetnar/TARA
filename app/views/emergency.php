<h2>Emergency Contact</h2>
<table class="table contact-table table-hover">
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
          <input type="text" id="contact_name" placeholder="name" />
        </td>
        <td>
          <input type="text" id="contact_email" placeholder="email" />
        </td>
        <td>
          <input type="text" id="contact_phone" placeholder="phone" />
        </td>
        <td>
          <button type="button" class="btn btn-default btn-contact-submit">Submit</button>
        </td>
      </form>
    </tr>
    <?php if (isset($contacts)): ?>
      <?php foreach ($contacts as $contact): ?>
        <tr class='contact' 
            contact-id="<?php echo $contact['id'] ;?>" >
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
            <button class="btn btn-sm btn-contact-delete">Delete</button>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>


