(function($) {
  var baseURL = document.URL.substring(0, document.URL.lastIndexOf("/"));
  $(document).ready(function() {
    $('.button-object-delete').click(objectDeleteHandler);
    function objectDeleteHandler() {
      var rfid= $(this).parent().siblings('.object-rfid').text();
      console.log(rfid);
      $.ajax({
        url: baseURL + '/objects',
        method: 'POST',
        dataType: 'html',
        data: {
          object_method: 'delete',
          rfid: rfid
        },
        success: function(data) {
          $('.object').remove();
          $('.object-form').after($('.object', data));
          $('.button-object-delete').click(objectDeleteHandler);
        },
        error: function(xhr, status, error) {
          console.log(status);
          console.log(error);
        }
      });
    }
  });
})(jQuery);