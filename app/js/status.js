(function($) {
  var baseURL = document.URL.substring(0, document.URL.lastIndexOf("/"));
  $(document).ready(function() {
      setInterval(function() {
          $.ajax({
            url: baseURL + '/status.json',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $(".status-banner").text(data);
                console.log("i ran");
            },
            error: function(xhr, status, error) {
              console.log(status);
              console.log(error);
            } 
          });
           
      }, 1000);
  });
})(jQuery);
