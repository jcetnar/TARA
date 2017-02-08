
<div class="container">
  <h2>Navigation</h2>         
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Array Length</th>
        <th>Array Width</th>
      </tr>
    </thead>
    <tbody>
    <tr>
    <form action='/navigation' method='POST'>
        <td>
            <input type="text" name="array_l" value="length" />
        </td>
        <td>
            <input type="text" name="array_w" value="width" />
        </td>
        <td>
        <button type="submit" class="btn btn-default">Submit</button>
        </td>
    </form>
    </tr>
      <?php foreach ($navigation as $navigation): ?>
        <tr>
            <td>
                <?php echo $navigation['array_l']; ?>
            </td>
            <td>
                <?php echo $navigation['array_w']; ?>
            </td>
            <td>
                <button class="btn btn-sm">Delete</button>
            </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Location</th>
      </tr>
    </thead>
    <tbody>
    <tr>
    <form action='/navigation' method='POST'>
        <td>
            <input type="text" name="location" value="location" />
        </td>
        <td>
        <button type="submit" class="btn btn-default">Submit</button>
        </td>
    </form>
    </tr>
      <?php foreach ($navigation as $navigation): ?>
        <tr>
            <td>
                <?php echo $navigation['location']; ?>
            </td>
            <td>
                <button class="btn btn-sm">Delete</button>
            </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>


