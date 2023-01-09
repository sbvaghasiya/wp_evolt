jQuery(document).ready(function(){  
  jQuery('.evolt-newsletter-close').click(function(){
    jQuery('#evolt-newsletter-popup').fadeOut();
  });
  
  var visits = jQuery.cookie('visits') || 0;
  visits++;
  
  jQuery.cookie('visits', visits, { expires: 1, path: '/' });
    
  if ( jQuery.cookie('visits') > 1 ) {
    jQuery('#evolt-newsletter-popup').hide();
  } else {
    var pageHeight = jQuery(document).height();
    setTimeout(function(){
      jQuery('#evolt-newsletter-popup').fadeIn();
    }, 5000);
  }

  if (jQuery.cookie('noShowWelcome')) { jQuery('#evolt-newsletter-popup').hide(); }
}); 