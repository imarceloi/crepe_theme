<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
?>
		<!-- CONTATO -->
		<section class="contato">
			<div class="contato_int">
				<?php 
					$post_contato 		= get_post(18); 
					$title_contato		= $post_contato->post_title;
					$content_contato	= apply_filters( 'the_content', $post_contato->post_content );

					$odin_general_opts 	= get_option( 'odin_general' );
					$telefone 			= $odin_general_opts['telefone'];
					$facebook 			= $odin_general_opts['face_input'];
					$twitter 			= $odin_general_opts['twitter_input'];
					$tripadvisor		= $odin_general_opts['trip_input'];
					$foursquare			= $odin_general_opts['four_input'];
				?>
				<div class="container container_tit">
					<div class="tit">
						<h1><?php echo $title_contato; ?></h1>
					</div>
				</div>
				<article class="container">
					<div class="col-md-4">
						<h2>Fale conosco</h2>
						<a href="tel:<?php echo $telefone ;?>" class="tel"><?php echo $telefone ;?></a>

						<h2 class="siga_nos">Siga-nos</h2>
						<?php if (!empty($facebook)) : ?>
							<a href="<?php echo $facebook ;?>" class="facebook media" target="_blank" title="Facebook"></a>
						<?php endif ;
						if (!empty($twitter)) : ?>
							<a href="<?php echo $twitter ;?>" class="twitter media" target="_blank" title="Twitter"></a>
						<?php endif ;
						if (!empty($tripadvisor)) : ?>
							<a href="<?php echo $tripadvisor ;?>" class="tripadvisor media" target="_blank" title="TripAdvisor"></a>
						<?php endif ;
						if (!empty($foursquare)) : ?>
							<a href="<?php echo $foursquare ;?>" class="foursquare media" target="_blank" title="Foursquare"></a>
						<?php endif ;?>
					</div>
					<div class="col-md-8">
						<?php echo do_shortcode( '[contact-form-7 id="56" title="contato"]' ); ?>
					</div>
				</article>
			</div>
		</section>
		<!-- / CONTATO -->


		<!-- ENDEREÇO -->
		<section class="enderecos">
			<div class="enderecos_int">
				<?php
					/*$odin_general_opts 	= get_option( 'odin_address' ); 
					$aguasClaras		= $odin_general_opts['aguas_claras'];
					$asaNorte 			= $odin_general_opts['asa_norte'];
					$asaSul 			= $odin_general_opts['asa_sul'];*/
				?>
				<div class="container container_tit">
					<div class="tit">
						<h1>Endereços</h1>
					</div>
				</div>
				<article class="container">
					<div class="col-md-4">
						<h2 class="ativo" data-item="aguas_claras">Águas Claras</h2>
					</div>
					<div class="col-md-4">
						<h2 data-item="asa_norte">Asa Norte</h2>
					</div>
					<div class="col-md-4">
						<h2 data-item="asa_sul">Asa Sul</h2>
					</div>
				</article>
				<div class="container-fluid">
					<div class="mapa aguas_claras">
						<?php// echo $aguasClaras ; ?>
						<iframe src="<?php echo get_template_directory_uri(); ?>/custom_map/aguas_claras.html" height="400" frameborder="0" style="border:0"></iframe>
					</div>
					<div class="mapa asa_norte">
						<?php //echo $asaNorte ; ?>
						<iframe src="<?php echo get_template_directory_uri(); ?>/custom_map/asa_norte.html" height="400" frameborder="0" style="border:0"></iframe>
					</div>
					<div class="mapa asa_sul">
						<?php// echo $asaSul ; ?>
						<iframe src="<?php echo get_template_directory_uri(); ?>/custom_map/asa_sul.html" height="400" frameborder="0" style="border:0"></iframe>
					</div>
				</div>
			</div>
		</section>
		<!-- / ENDEREÇO -->

	</div><!-- #main -->
	<footer id="footer" role="contentinfo">
		<div class="site-info">
			<span>&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a> - <?php _e( 'All rights reserved', 'odin' ); ?> | <?php echo sprintf( __( 'Desenvolvido por <a href="%s" rel="nofollow" target="_blank">Marcelo Marcelino</a>.', 'odin' ), 'http://www.marcelomarcelino.com' ); ?></span>
		</div><!-- .site-info -->
	</footer><!-- #footer -->
	<?php wp_footer(); ?>
</body>
</html>
