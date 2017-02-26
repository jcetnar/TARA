(function($) {
  $(document).ready(function() {
    // Get the upper left corner of the cell that was clicked on.
    function getSquare(canvas, evnt, cellSize) {
      var rect = canvas.getBoundingClientRect();
      return {
        x: 1 + (evnt.clientX - rect.left) - (evnt.clientX - rect.left) % cellSize,
        y: 1 + (evnt.clientY - rect.top) - (evnt.clientY - rect.top) % cellSize
      };
    }
    // Get the zero indexed cell position in a 2D matrix based on what cell was
    // clicked on.
    function getGridCell(mouseX, mouseY, cellSize) {
      return {
        x: (mouseX - 1) / cellSize,
        y: (mouseY - 1) / cellSize
      }
    }
    // Draw the cell grid.
    function drawGrid(context, gridHeight, gridWidth, cellSize) {
      for (var x = 0; x < gridWidth + 1; x += cellSize) {
        context.moveTo(x, 0);
        context.lineTo(x, gridHeight);
      }
      for (var y = 0; y < gridHeight + 1; y += cellSize) {
        context.moveTo(0, y);
        context.lineTo(gridWidth, y);
      }
      context.strokeStyle = '#ddd';
      context.stroke();
    }
    // Fill in a grid cell with a given color.
    function fillSquare(context, x, y, cellSize, color) {
      context.fillStyle = color;
      context.fillRect(x, y, cellSize - 1, cellSize - 1);
    }
    // Draw a series of text messages one below another.
    function drawMessage(context, x, y, cellSize, fontSize, messages) {
      context.fillStyle = '#000';
      context.font = fontSize + 'px sans-serif';
      var offset = 0;
      messages.forEach(function(message) {
        // Make sure we don't write off the bottom of the cell.
        if (offset + fontSize < cellSize) {
          context.fillText(message, x, y + fontSize + offset);
          offset += fontSize;
        }
      });
    }
    // Modify the Array object to provide an initializer for 2D matricies.
    Array.matrix = function(rows, cols, initialValue) {
      var arr = [];
      for (var i = 0; i < rows; ++i) {
        var columns = [];
        for (var j = 0; j < cols; ++j) {
          columns[j] = initialValue;
        }
        arr[i] = columns;
      }
      return arr;
    };
    var canvas = document.getElementById('grid-canvas');
    var context = canvas.getContext('2d');
    var cellSize = 25;
    var wallValue = 999;
    var clearValue = 0;
    var fontSize = 6;
    var dataGrid = Array.matrix(canvas.height / cellSize, canvas.width / cellSize, clearValue);

    // Variables to hold where context menu was last opened.
    var contextMousePos = {};
    var contextGridCell = {};

    drawGrid(context, canvas.height, canvas.width, cellSize);

    $canvas = $('#grid-canvas');

    $canvas.mousedown(function(event) {
      var mousePos = getSquare(canvas, event, cellSize);
      var gridCell = getGridCell(mousePos.x, mousePos.y, cellSize);
      // On left click.
      if (event.which === 1) {
        // If the cell is occupied clear it.
        if (dataGrid[gridCell.x][gridCell.y] !== clearValue) {
          $(this).trigger('nav-assign-clear', [mousePos, gridCell]);
        }
        else {
          $(this).trigger('nav-assign-wall', [mousePos, gridCell]);
        }
      }
    });

    $canvas.contextmenu(function(event) {
      event.preventDefault();
      // Save the cell where our context menu was opened for retrieval in later
      // handlers.
      contextMousePos = getSquare(canvas, event, cellSize);
      contextGridCell = getGridCell(contextMousePos.x, contextMousePos.y, cellSize);
      // Open the custom menu.
      $('.objects-menu').finish().toggle(100).css({
        top: event.pageY + 'px',
        left: event.pageX + 'px'
      });
    });

    // If one of our items was clicked:
    // * Get the item ID
    // * Hide it in the list
    // * Fire a callback to the grid to have it marked and stored
    // * Hide the entire menu
    $('.objects-menu li').click(function() {
      var objectId = $(this).attr('data-id');
      var objectName = $(this).text();
      if (objectId === 'barcode') {
        $('.barcode-prompt').finish().toggle(100).css({
          top: contextMousePos.y + 'px',
          left: contextMousePos.x + 'px'
        });
        $('.barcode-input').focus();
      }
      else {
        $(this).hide();
        $canvas.trigger('nav-assign-object', [contextMousePos, contextGridCell, objectId, objectName]);
      }
      $('.objects-menu').hide(100);
    });

    $('.barcode-submit-button').click(function() {
      var objectId = $('.barcode-input').val();
      var objectName = objectId;
      if (objectId.length > 0) {
        $('.barcode-input').val('');
        $canvas.trigger('nav-assign-barcode', [contextMousePos, contextGridCell, objectId, objectName]);
      }
      $('.barcode-prompt').hide(100);
    });

   // Close context menu when clicking anywhere else on page.
    $(document).mousedown(function(evnt) {
      if (!$(evnt.target).parents('.objects-menu').length > 0) {
        $('.objects-menu').hide(100);
      }
      if (!$(evnt.target).parents('.barcode-prompt').length > 0) {
        $('.barcode-prompt').hide(100);
      }
    });

    $canvas.on('nav-assign-wall', function(event, mousePos, gridCell) {
      console.log('set wall');
      dataGrid[gridCell.x][gridCell.y] = wallValue;
      fillSquare(context, mousePos.x, mousePos.y, cellSize, '#ff0000');
    });

    $canvas.on('nav-assign-clear', function(event, mousePos, gridCell) {
      console.log('clear');
      // When we clear a cell go into the options and show any options that have
      // the same ID.
      var objectId = dataGrid[gridCell.x][gridCell.y];
      $('.objects-menu li[data-id="' + objectId + '"]').show();
      dataGrid[gridCell.x][gridCell.y] = clearValue;
      context.clearRect(mousePos.x, mousePos.y, cellSize - 1, cellSize - 1);
    });

    $canvas.on('nav-assign-object', function(event, mousePos, gridCell, objectId, objectName) {
      console.log('assign object: ' + objectId);
      dataGrid[gridCell.x][gridCell.y] = objectId;
      fillSquare(context, mousePos.x, mousePos.y, cellSize, '#00ff00');
      drawMessage(context, mousePos.x, mousePos.y, cellSize, fontSize, [objectName]); 
    });

    $canvas.on('nav-assign-barcode', function(event, mousePos, gridCell, objectId, objectName) {
      console.log('assign barcode: ' + objectId);
      dataGrid[gridCell.x][gridCell.y] = objectId;
      fillSquare(context, mousePos.x, mousePos.y, cellSize, '#0000ff');
      drawMessage(context, mousePos.x, mousePos.y, cellSize, fontSize, [objectName]);
    });

    $('.submit-button').click(function() {
      console.log(dataGrid);
    });
  });
})(jQuery);

