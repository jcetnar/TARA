<canvas id='grid-canvas' width='750' height='400'></canvas>
<button type='button' class='submit-button'>Done</button>
<!--Not sure this submit button gets executed-->
<ul class='objects-menu'>
  <li data-id="barcode">QR Code</li>
<!--  Getting rid of stationary objects in nav grid-->
<!--  <?php foreach ($objects as $object): ?>
    <li data-type="object" data-id="<?php echo $object['name']; ?>">
      <?php echo $object['name']; ?>
    </li>
  <?php endforeach; ?> -->
</ul>
<div class='barcode-prompt'>
  <input type='text' class='barcode-input' />
  <button type='button' class='barcode-submit-button'>Done</button>
</div>
<script> 
    var navGrid = <?php echo json_encode($grid, JSON_PARTIAL_OUTPUT_ON_ERROR) ?>;
</script> 