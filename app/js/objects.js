(function($) {
  var baseURL = document.URL.substring(0, document.URL.lastIndexOf("/"));
  $(document).ready(function() {    
      $('.button-object-delete').click(function() {
          var rfid= $(this).parent().siblings('.object-rfid').text();
          console.log(rfid);
          //console.log($(this).parent().siblings('.object-rfid').text());
        $.ajax({
                url: baseURL + '/objects',
                method: 'POST',
                dataType: 'json',
                data: {
                    object_method: 'delete',
                    rfid: rfid
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
 });
  
})(jQuery);