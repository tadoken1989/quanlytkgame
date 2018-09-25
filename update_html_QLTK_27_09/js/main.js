//Slider main$('ul.submenu-area').slideDown();
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
    $('.userpro-menu ul li').click(function(){
      $('.userpro-menu ul li').removeClass('active');
      $(this).addClass('active');
      $('.submenu-area').hide();
      $(this).find('.submenu-area').show()
    });
  
   
});





