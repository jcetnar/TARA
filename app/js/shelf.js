(function($) {
  $(document).ready(function() {
    var baseURL = document.URL.substring(0, document.URL.lastIndexOf("/"));

   function reloadTable() {
      console.log('Reloading table...');
      $.ajax({
        url: baseURL + '/shelf',
        method: 'GET',
        dataType: 'html',
        success: function(data) {
          $('.shelf-table').html($('.shelf-table', data).children());
          $('.button-shelf-delete').click(shelfDeleteHandler);
          $('.btn-shelf-submit').click(shelfSubmitHandler);
        },
        error: function(xhr, status, error) {
          console.log(status);
          console.log(error);
        }
      });
    }
    
    $('.button-shelf-delete').click(shelfDeleteHandler);

    function shelfDeleteHandler() {
      var shelf_id= $(this).closest('tr.shelf').attr('shelf-id');
      var location_barcode= $(this).closest('tr.shelf').attr('location_barcode');
      console.log(shelf_id);
      console.log('got to the logging shelf id part');
      $.ajax({
        url: baseURL + '/shelf',
        method: 'POST',
        dataType: 'html',
        data: {
          operation: 'delete',
          shelf_id: shelf_id,
          location_barcode: location_barcode
        },
        success: function(data) {
          reloadTable();
        },
        error: function(xhr, status, error) {
          console.log(status);
          console.log(error);
        }
      });
    };
    //above here was the new stuff
    $('.btn-shelf-submit').click(shelfSubmitHandler);
            
    function shelfSubmitHandler() {
      var shelf_id = $('#shelf_id').val();
      var location_barcode = $('#location_barcode').val();
      form_data = {
        "operation": "insert",
        "shelf_id": shelf_id,
        "location_barcode": location_barcode
      };
      console.log(form_data);
      $.ajax({
        url: baseURL + '/shelf',
        method: 'POST',
        dataType: 'html',
        data: form_data,
        success: function(data) {
          console.log(data);
          // Now we will do a sloppy reload of the table.
          reloadTable();
        },
        error: function(xhr, status, error) {
          console.log(status);
          console.log(error);
        }
      });
    };
  });  
})(jQuery);
