(function($) {
  $(document).ready(function() {
    var baseURL = document.URL.substring(0, document.URL.lastIndexOf("/"));

 $('.button-shelf-delete').click(taskDeleteHandler);

    function taskDeleteHandler() {
      var shelf_id= $(this).closest('tr.shelf').attr('shelf-id');
      console.log(shelf_id);
      console.log('got to the logging shelf id part');
      $.ajax({
        url: baseURL + '/shelf.json',
        method: 'POST',
        dataType: 'json',
        data: {
          operation: 'delete',
          shelf_id: shelf_id
        },
        success: function(data) {
          console.log(data);
          reloadTable();
        },
        error: function(xhr, status, error) {
          console.log(status);
          console.log(error);
        }
      });
    };
    //above here was the new stuff
  });
})(jQuery);
