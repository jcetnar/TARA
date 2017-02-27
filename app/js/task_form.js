(function($) {
    $(document).ready(function() {
        var baseURL = document.URL.substring(0, document.URL.lastIndexOf("/"));
        $('.object-submit').click(function() {
            var name = $('#task_name').val();
            var date = $('#date').val();
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
                "date": date,
                "repeat": repeat,
                "objects[]": objects
            };
            console.log(form_data);
            $.ajax({
               url: baseURL + '/tasks.json',
               method: 'POST',
               dataType: 'json',
               data: form_data,
               success: function(data) {
                   console.log(data);
               },
               error: function(xhr, status, error) {
                   console.log(status);
                   console.log(error);
                   console.log('dammnit');
               }   
            });
        });
        //below here was just added, may break everyting
              $('.button-object-delete').click(function() {
          var id= $(this).parent().siblings('.id').text();
          console.log(id);
          //console.log($(this).parent().siblings('.object-rfid').text());
        $.ajax({
                url: baseURL + '/tasks',
                method: 'POST',
                dataType: 'json',
                data: {
                    object_method: 'delete',
                    id: id
                },
            success: function(data) {
                console.log(data);
                 },
            error: function(xhr, status, error) {
                console.log(status);
                console.log(error);
                console.log('dammnit');
                }   
            });
      });
      //above here was the new stuff
    });
})(jQuery);