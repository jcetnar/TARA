(function($) {
  var baseURL = document.URL.substring(0, document.URL.lastIndexOf("/"));
  $(document).ready(function() {
      setInterval(function() {
          $.ajax({
            url: baseURL + '/status.json',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $(".status-banner-text").text(data['message']);
                if ((data['type'] === 'warning')) {
                    $(".warning-confirm-button").show();
                }
                else {
                    $(".warning-confirm-button").hide();
                }
            },
            error: function(xhr, status, error) {
              console.log(status);
              console.log(error);
            } 
          });
           
      }, 1000);
      $(".warning-confirm-button").click(function(){
         $.ajax({
             url: baseURL + '/status.json',
             method: 'POST',
             dataType: 'json',
             data: { status: 'reset' }
         });
      });
  });
})(jQuery);
