jQuery(document).ready(function($) {
	var aulturaTela			= $( window ).height();
	var alturaMenu 			= $( '#aside' ).height();
	var alturaFooter		= $( '.footer' ).height();
	var alturaFooterInt		= $( '.footer-int' ).height();
	var pegaClassFooterInt 	= $( 'footer').hasClass('footer-int');
	var pegaClassHome		= $( 'body').hasClass('home');
	var caluculaAltura		= aulturaTela-alturaMenu-alturaFooter;

	function geralTamanhos() {
		aulturaTela		= $( window ).height();
		alturaMenu 		= $( 'aside' ).height();
		alturaFooter	= $( '.footer' ).height();
		alturaFooterInt	= $( '.footer-int' ).height();
		caluculaAltura	= aulturaTela-alturaMenu-alturaFooter;
		// APLICA O TAMANHO RESTANTE DA ALTURA NOS BANNERS
		$( '.banner' ).height( caluculaAltura-alturaFooterInt );
		$( '.banner li' ).height( caluculaAltura-alturaFooterInt );
		$( '.slider_home' ).height( caluculaAltura );
	}
	geralTamanhos();

	// CAROUSEL HOME - COMEÇA
 	$('.bxslider').bxSlider({
 		infiniteLoop: false,
 		controls: false,
 		auto: true,
 		pause: 5000,
	});
	// CAROUSEL HOME - TERMINA
	
 	//MENU RETRATIL - COMEÇA
 	$('.menu_retratil').click(function(event) {
 		$('aside').animate({
 			'left': 0 
 		}, 200);
 		$('.menu').animate({
 			'marginLeft': 180 
 		}, 200);
 		$('.volta_menu').fadeIn(
 			200, function() {
 			$('.menu_retratil').fadeOut(200);
 		});
 	});
 	$('.volta_menu').click(function(event) {
 		$('aside').animate({
 			'left': -300
 		}, 200);
 		$('.menu').animate({
 			'marginLeft': 0 
 		}, 200);
 		$('.menu_retratil').fadeIn(
 			200, function() {
 			$('.volta_menu').fadeOut(200);
 		});
 	});
 	//MENU RETRATIL - TERMINA

 	// MENU HOME
 	$('.menu_home').click(function(event) {
 		event.preventDefault();
		var $this = $(this),
		target = this.hash,
		$target = $(target);
		// console.info(target);
		$('html,body').animate({
			scrollTop: 0
		}, 1000);
		history.pushState(null, null, target);
 	});

	//MASCARA TELEFONE
    //$('.wpcf7-tel').mask('99 (99) 9?9999-9999');

    //CLIQUES ENDEREÇOS
    $('.enderecos_int h2').click(function(event) {
    	var pegaClass = $(this).attr('data-item');
    	$('.enderecos_int .mapa').fadeOut(100);
    	$('.enderecos_int .' + pegaClass).fadeIn(500);
    	$('.enderecos_int h2').removeClass('ativo').delay(1000);
    	$(this).addClass('ativo');
    });
	setTimeout(function() {
	    $('.asa_norte, .asa_sul').hide();
	}, 500);

	//SMINT NAVEGAÇÂO
	if (pegaClassHome == true) {
		$('#menu-menu-principal').smint({
			'scrollSpeed' : 1000
		});
	};
	
	// GOOGLE ANALYTICS
	console.info('inserir analytics');

	window.onresize = function() {
		geralTamanhos();
	};
});
