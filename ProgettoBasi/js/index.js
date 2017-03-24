$('.tab a').on('click', function(e) {

  e.preventDefault();

  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');

  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();

  $(target).fadeIn(600);

});


$(document).ready(function(){
  var c = $( 'div#signup' ).find( 'p' ).length;
  if (c>0){
    $('.tab-group li:nth-child(2)').addClass('active');
    $('.tab-group li:nth-child(1)').removeClass('active');

    $('.tab-content > div').not('#signup').hide();
    $('#signup').fadeIn(600);
  }
});
