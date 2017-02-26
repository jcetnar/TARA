
<div class="container">
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
        <form action='<?php echo get_base_url() . '/emergency'; ?>' method='POST'>
            <td>
                <input type="varchar" name="name" value="name" />
            </td>
            <td>
                <input type="varchar" name="email" value="email" />
            </td>
            <td>
                <input type="varchar" name="phone" value="phone" />
            </td>
            <td>
            <button type="submit" class="btn btn-default">Submit</button>
            </td>
        </form>
    <?php foreach ($contacts as $contact): ?>
        <tr>
            <td>
                <?php echo $name['name']; ?>
            </td>
            <td>
                <?php echo $email['email']; ?>
            </td>
            <td>
                <?php echo $phone['phone']; ?>
            </td>
            <td>
                <button class="btn btn-sm">Delete</button>
            </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>


