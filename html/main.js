//Slider main
$(document).ready(function() {
	
    $(".title_bar").click(function(){

        if($(".chat-box").hasClass('active')){
              $(".chat-box").animate({
                bottom:"0"
                 } , 500);
               $(".chat-box").removeClass('active')
        }
        else{
             $(".chat-box").animate({
            bottom:"-325px"
            } , 500);
              $(".chat-box").addClass('active')
        }
        
       
    })
   
});





