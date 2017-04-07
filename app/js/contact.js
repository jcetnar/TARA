(function($) {
  $(document).ready(function() {
    var baseURL = document.URL.substring(0, document.URL.lastIndexOf("/"));

   function reloadTable() {
      console.log('Reloading table...');
      $.ajax({
        url: baseURL + '/emergency',
        method: 'GET',
        dataType: 'html',
        success: function(data) {
          $('.contact-table').html($('.contact-table', data).children());
          $('.btn-contact-delete').click(contactDeleteHandler);
          $('.btn-contact-submit').click(contactSubmitHandler);
        },
        error: function(xhr, status, error) {
          console.log(status);
          console.log(error);
        }
      });
    }
    
    $('.btn-contact-delete').click(contactDeleteHandler);

    function contactDeleteHandler() {
  //    var contact_id= $(this).closest('tr.contact').attr('contact-id');
      var contact_name= $(this).closest('tr.contact').attr('contact-name');
      var contact_email= $(this).closest('tr.contact').attr('contact-email');
      var contact_phone= $(this).closest('tr.contact').attr('contact-phone');
      console.log(id);
      console.log('got to the logging contact id part');
      $.ajax({
        url: baseURL + '/emergency',
        method: 'POST',
        dataType: 'html',
        data: {
          operation: 'delete',
//          contact_id: contact_id,
          name: contact_name,
          email: contact_email,
          phone: contact_phone
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

    $('.btn-contact-submit').click(contactSubmitHandler);
            
    function contactSubmitHandler() {
 //     var contact_id = $('#contact_id').val();
      var contact_name = $('#contact_name').val();
      var contact_phone = $('#contact_phone').val();
      var contact_email = $('#contact_email').val();
      form_data = {
        "operation": "insert",
   //     "contact_id": contact_id,
        "contact_name": contact_name,
        "contact_phone": contact_phone,
        "contact_email": contact_email
      };
      
      console.log(form_data);
      $.ajax({
        url: baseURL + '/emergency',
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
