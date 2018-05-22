<!-- footer code -->
</div>

 <footer class="text-center" id="footer">&copy; Copyright 2013-2018 Faye's Vintage</footer>

 
 <script>
  jQuery(window).scroll(function(){
   var vscroll = jQuery(this).scrollTop();
   jQuery('#logotext').css({
    "transform" : "translate(0px, "+vscroll/2+"px)"
   });
  });
  jQuery(window).scroll(function(){
   var vscroll = jQuery(this).scrollTop();
   jQuery('#back-flower').css({
    "transform" : "translate(0px, -"+vscroll/5+"px)"
   });
  });
  jQuery(window).scroll(function(){
   var vscroll = jQuery(this).scrollTop();
   jQuery('#fore-flower').css({
    "transform" : "translate(0px, -"+vscroll/5+"px)"
   });
  });

  function detailsmodal(id)
  {
   var data = {"id": id};
   jQuery.ajax({
    url: "/newecom/includes/detailsmodal.php",
    method: "post",
    data: data,
     success : function(data){
     jQuery('body').append(data);
     jQuery('#details-modal').modal('toggle');
    },﻿
    error:function()
    {
     alert("Something went wrong!");
    }
   });
  }
 </script>
</body>
</html>﻿