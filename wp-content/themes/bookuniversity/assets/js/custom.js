jQuery(document).ready(function($){


    if ($(window).width() < 700){

    }else{
        $(".client").attr("data-aos","zoom-in-left");
        $(".banner-bottom-col").attr("data-aos","flip-left");
        $(".banner-bottom-col").attr('data-aos-duration',"1500");
    
        $(".banner-heading").attr("data-aos","zoom-in-down");
        $(".img-box").attr("data-aos","fade-out-down");
        $(".img-box").attr('data-aos-duration',"1500");

        $(".profile-box").attr("data-aos","fade-up");
        $(".profile-box").attr('data-aos-duration',"1500");
        $(".address-box").attr("data-aos","zoom-in-up");
        $(".contact-map-tab-section").attr("data-aos","fade-up");
        $(".what-included-section").attr("data-aos","fade-up");
        $(".apply-university-section").attr("data-aos","zoom-in-up");
        
    }
   
    
    
    $(window).scroll(function(){
        if ($(this).scrollTop() > 50) {
           $('.Header-nav-row').addClass('fixed-nav');
        } else {
           $('.Header-nav-row').removeClass('fixed-nav');
        }
    });
  jQuery('.test1').owlCarousel({
      loop:true,
      nav:true,
      navText: ["<div class='nav-button owl-prev'>‹</div>", "<div class='nav-button owl-next'>›</div>"],
      margin:10,
      autoplay:true,
      
      responsive:{
          0:{
              items:2
          },
          600:{
              items:3
          },
          1000:{
              items:3
          },
          1200:{
              items:5
          }
      }
  });

//console.log('text ',$.trim(jQuery('.banner-section .home-banner-content').text()).length);
  if($.trim(jQuery('.banner-section .home-banner-content').text()).length > 130){
    //alert('yes');
    //console.log('text ',jQuery('.banner-section .home-banner-content').text().length);
    //var newStr = jQuery('.banner-section .home-banner-content').text().substring(0, 140);
    var newStr = $.trim(jQuery('.banner-section .home-banner-content').text()).substring(0, 125);
    jQuery('.banner-section .home-banner-content').html('<p>'+newStr.replace(/\./g,'.<br/>')+'...</p>');
 }
  


  jQuery(".footer-submit").click(function(e) {
    e.preventDefault();
   let name = $('#name').val();
   let email = $('#email').val();
   let subject = $('#subject').val();
   let message = $('#message').val();
   let nameRes =textVal(name,'name')
   let emailRes =emailVal(email,'email');
   let subRes =textVal(subject,'subject');

   if((nameRes ==true) &&  (emailRes ==true) && (subRes ==true)){
    jQuery('.spinner-border').show();
    jQuery.ajax({
        type: "POST",
        url: myAjax.ajaxurl,
        data: jQuery('#contact-form').serialize(), // serializes the form's elements.
        success: function(data)
        {
         jQuery('.spinner-border').hide();
           let res = JSON.parse(data);
           if(res['status'] == true) {
             jQuery('#contact-form').trigger('reset');
             jQuery('.formMsg').html(res['msg']).addClass('alert alert-success').show().delay(5000).hide('slow');
             setTimeout(function() {
                 jQuery('.formMsg').removeClass('alert alert-success');
             }, 5000);
           } else {
             jQuery('.formMsg').html(res['msg']).addClass('alert alert-danger').show().delay(5000).hide('slow');
             setTimeout(function() {
                 jQuery('.formMsg').removeClass('alert alert-danger');
             }, 5000);
           }
        }
      });

   }else{
    // jQuery('.formMsg').html('Something wentwrong').addClass('alert alert-danger').show().delay(5000).hide('slow');
    // setTimeout(function() {
    //     jQuery('.formMsg').removeClass('alert alert-danger');
    // }, 5000);
   }

   //console.log(emailVal(email,'email'));

  });



jQuery('.partner-submit').click(function(e){
    e.preventDefault();
    let name = $('#name').val();
    let email = $('#email').val();
    let phone = $('#phone').val();
    let orgname = $('#orgname').val();
    let address = $('#address').val();
    
    
    let nameRes =textVal(name,'name')
    let emailRes =emailVal(email,'email');
    let PhoneRes =validatePhoneNumber(phone,'phone');
    let orgnameRes =textVal(orgname,'orgname');
    let addressRes =textVal(address,'address');

    consoData ={
        'name':name,
        'email':email,
        'phone':phone,
        'orgname':orgname,
        'address':address,
        'nameRes':nameRes,
        'emailRes':emailRes,
        'PhoneRes':PhoneRes,
        'orgnameRes':orgnameRes,
        'addressRes':addressRes
    }

    //console.log(consoData);

    if((nameRes ==true) &&  (emailRes ==true) && (PhoneRes ==true) && (orgnameRes ==true) && (addressRes ==true)){
        jQuery('.spinner-border').show();
        jQuery.ajax({
            type: "POST",
            url: myAjax.ajaxurl,
            data: jQuery('#partner-form').serialize(), // serializes the form's elements.
            success: function(data)
            {
             jQuery('.spinner-border').hide();
               let res = JSON.parse(data);
               if(res['status'] == true) {
                 jQuery('#partner-form').trigger('reset');
                 jQuery('.formMsg').html(res['msg']).addClass('alert alert-success').show().delay(5000).hide('slow');
                 setTimeout(function() {
                     jQuery('.formMsg').removeClass('alert alert-success');
                 }, 5000);
               } else {
                 jQuery('.formMsg').html(res['msg']).addClass('alert alert-danger').show().delay(5000).hide('slow');
                 setTimeout(function() {
                     jQuery('.formMsg').removeClass('alert alert-danger');
                 }, 5000);
               }
            }
          });
    
       }else{
        // jQuery('.formMsg').html('Something wentwrong').addClass('alert alert-danger').show().delay(5000).hide('slow');
        // setTimeout(function() {
        //     jQuery('.formMsg').removeClass('alert alert-danger');
        // }, 5000);
       }
      
});

function textVal(data,id){ 
    if( $.trim(data) ==''){
        $('#'+id).siblings('.error').text('Text field required*');
        return false; 
    }else{
        $('#'+id).siblings('.error').text('');
        return true;
    }
}

function emailVal(data,id){ 
    //let validRegex =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    //let regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
     //let regex = new RegExp('[a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-Z]{2,6}$');
    let regex = new RegExp('[a-zA-Z0-9]+@[a-zA-Z]+([.])+[a-zA-Z]{2,6}');
    if( $.trim(data) ==''){
        $('#'+id).siblings('.error').text('Email field required*');
        return false; 
    }else if(!(regex.test(data))){ 
    //if(!(data.match(validRegex))){
        $('#'+id).siblings('.error').text('Email not valid*');
        return false;
    }else{
        $('#'+id).siblings('.error').text('');
        return true;
    }
}

function validatePhoneNumber(data,id){
    var re = /^[\+\0]?[0-9]{8,16}$/im; 
    if( $.trim(data) ==''){
        $('#'+id).siblings('.error').text('Phone field required*');
        return false; 
    }else if(!(re.test($.trim(data)))){
        $('#'+id).siblings('.error').text('Phone number not valid*');
        return false;
    }else{
        $('#'+id).siblings('.error').text('');
        return true;
    }
}


AOS.init();


$('.modelOpen').click(function(){
    let id =$(this).attr('id');
    $('#exampleModal'+id).show();
    $('body').addClass('hidden');
    $('.body-over-lay').show();
});

$('.closeModel').click(function(){
    $(this).parents('.overlay').hide();
    $('body').removeClass('hidden');
    $('.body-over-lay').hide();
});






    $(".service-content").each(function(){
        var maxLength = 300;
        var myStr = $(this).text();
        var myStrHtml = $(this).html();
         var myheading =$(this).siblings('.service-heading').text();
        if($.trim(myStr).length > maxLength){
           // console.log($.trim(myStr).length);
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html('<p>'+newStr+'<a href="javascript:void(0);" class="read-more">read more...</a></p>');
           // $(this).append(' ');
            //$(this).append('<span class="more-text">' + removedStr + '</span>');
            $(this).append('<div class="modal fade popup-content overlay" style="display:none">'+
            '<div class="modal-dialog modal-dialog-centered popup"> <div class="modal-content">'+
            '<span class="closeModel closePopup">'+
            '<i class="fa fa-times closePopup" aria-hidden="true"></i></span>'+
            '<div class="modal-body"><div class="content inner-box"><div class="title">'+myheading+'</div>' + myStrHtml + '</div></div></div>'+
            '</div></div><div class="body-over-lay"></div>');

            //$('.footer-popup').append(myStr);
            
        }
    });
    $(".read-more").click(function(){
        $('body').addClass('hidden');
        $('.body-over-lay').show();
        $(this).parent().siblings(".popup-content").show();
        //$(this).siblings(".more-text").contents().unwrap();
        //$(this).remove();
    });

    $('.closePopup').click(function(){
        $(this).parents('.popup-content').hide();
        $('body').removeClass('hidden');
        $('.body-over-lay').hide();
    });

});



  



