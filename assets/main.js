$(document).ready( function(){

  // Toggle da Classe que ativa o menu do Painel em Mobile
  $('.nav .container .nav-toggle').click( function(){
    $('.nav-toggle, .nav-menu').toggleClass('is-active');
  });

  // Escondendo as notificações depois de 4 segundos
  if($('.notification').length > 0){
    setTimeout( function(){
      $('.notification').fadeOut('normal');
    }, 3100);
  }

});
