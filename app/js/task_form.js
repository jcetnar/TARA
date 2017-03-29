(function($) {
  $(document).ready(function() {
    var baseURL = document.URL.substring(0, document.URL.lastIndexOf("/"));

    function reloadTable() {
      console.log('Reloading table...');
      $.ajax({
        url: baseURL + '/tasks',
        method: 'GET',
        dataType: 'html',
        success: function(data) {
          $('.task-table').html($('.task-table', data).children());
          $('.button-task-delete').click(taskDeleteHandler);
        },
        error: function(xhr, status, error) {
          console.log(status);
          console.log(error);
        }
      });
    }

    $('#task_type').click(function() {
        if ($(this).is(':checked')) {
            $(".object.mobile").parent().hide();
            $(".object.stationary").parent().show();
        }
        else { 
            $(".object.mobile").parent().show();
            $(".object.stationary").parent().hide(); 
        }
    }); 

    $('.object-submit').click(function() {
      var name = $('#task_name').val();
      var start_date = $('#start_date').val();
      var end_date = $('#end_date').val();
      var task_type = $('#task_type').is(':checked');
      var repeat = $('#repeat').is(':checked');
      var objects = [];
      $('.object').each(function() {
        if ($(this).is(':checked')) {
          objects.push($(this).val());
        }
      });
      form_data = {
        "operation": "insert",
        "name": name,
        "start_date": start_date,
        "end_date": end_date,
        "task_type": task_type,
        "repeat": repeat,
        "objects[]": objects
      };
      console.log(form_data);
      $.ajax({
        url: baseURL + '/tasks.json',
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
    });
    //below here was just added, may break everything
    $('.button-task-delete').click(taskDeleteHandler);

    function taskDeleteHandler() {
      var id= $(this).closest('tr.task').attr('data-id');
      console.log(id);
      $.ajax({
        url: baseURL + '/tasks.json',
        method: 'POST',
        dataType: 'json',
        data: {
          operation: 'delete',
          id: id
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