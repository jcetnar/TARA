(function($) {
  $(document).ready(function() {
    var baseURL = document.URL.substring(0, document.URL.lastIndexOf("/"));

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
      var task_type = $('#task_type').is(':checked');
      var objects = [];
      $('.object').each(function() {
        if ($(this).is(':checked')) {
          objects.push($(this).val());
        }
      });
      form_data = {
        "operation": "insert",
        "name": name,
        "task_type": task_type,
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
        },
        error: function(xhr, status, error) {
          console.log(status);
          console.log(error);
        }
      });
    });
  });
})(jQuery);