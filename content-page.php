<?php
/**
 * The template used for displaying page content.
 *
 * @package Odin
 * @since 2.2.0
 */
get_header();
?>

<!-- CAREROCEL HOME -->
<section class="home banner">
	<ul class="bxslider">
		<?php
			$loopdestaques = array(
				'post_type' => 'destaque',
				'order' => 'ASC',
			);
			$loopdestaques = new WP_Query( $loopdestaques );
			if ($loopdestaques->have_posts()) :
				while ( $loopdestaques->have_posts() ) : $loopdestaques->the_post();
				$pegaBg = wp_get_attachment_url(get_post_thumbnail_id());
				$content = get_the_content();
				$link_destaque = get_post_meta(get_the_ID(), 'url_destaque', true);
		?>
		<li style="background-image: url(<?php echo $pegaBg ;?>);">
			<?php if( ! empty( $content ) ) { ?>
				<div class="container">
					<div class="col-md-4 infos_box">
						<?php 
							the_title('<h1>', '</h1>');
						  	the_excerpt();
						?>
						<a href="<?php echo $link_destaque; ?>" title="<?php the_title() ?>">Leia Mais</a>
					</div>
				</div>
			<?php } ?>
			<img src="<?php echo $pegaBg ;?>" title="<?php echo get_the_title() ?>" />
		</li>
		<?php
				endwhile; 
			endif;
			wp_reset_query();
		?>
	</ul>
</section>
<!-- / CAREROCEL HOME -->

<!-- HISTORIA -->
<section class="historia">
	<?php
		$postHistoria = get_post( 14 );
	?>
	<div class="container historia_int">
		<div class="col-md-8 txt">
			<?php echo $postHistoria->post_content ?>
		</div>
		<div class="col-md-4">
			<h1><?php echo $postHistoria->post_title ?></h1>
			<?php echo get_the_post_thumbnail( $postHistoria->ID ); ?>
		</div>
	</div>
</section>
<!-- / HISTORIA -->

<!-- CARDÁPIO -->
<section class="cardapio">
	<div class="cardapio_int">
		<?php
			$taxonomies = array('cardapio');
			$args = array(
			    'orderby'       => 'ID', 
			    'order'         => 'ASC',
			    'hide_empty'    => false,
			    'fields'        => 'all', 
			    'slug'          => '',
			    'hierarchical'  => false, 
			    'parent'        => $id_cat,
			    'child_of'      => 0,
			    'get'           => '', 
			    'name__like'    => '',
			    'pad_counts'    => true, 
			    'offset'        => '1', 
			    'search'        => '', 
			    'cache_domain'  => 'core'
			);
			$cat = get_terms( $taxonomies, $args );
			//echo "<pre>"; print_r($taxonomies); echo "</pre>";
		?>	

		<div class="container tit_cardapio">
			<h1>Cardápio</h1>
		</div>

			<?php
				//print_r($cat);
				foreach ($cat as $filho) {
			?>
			<article class="col-md-3" style=" background-image: url('<?php echo z_taxonomy_image_url($filho->term_id); ?>'); ">
				<div class="inner">
					<h2><?php echo $filho->name; ?></h2>
					<p><?php echo $filho->description; ?></p>
					<a href="<?php echo get_term_link( $filho ) ; ?>" title="<?php echo $filho->name; ?>">
						Ver Mais
					</a>
				</div>
			</article>
			<?php 
				}
			?>
		<?php 
			wp_reset_query();
		?>
	</div>
</section>
<!-- / CARDÁPIO -->

<!-- BUFFET -->
<section class="buffet">
	<div class="buffet_int">
		<?php 
			$post_buffet 		= get_post(16); 
			$title 				= $post_buffet->post_title;
			$content 			= apply_filters( 'the_content', $post_buffet->post_content );
			$post_thumbnail_id 	= get_post_thumbnail_id($post_buffet->ID);
			$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
		?>
		<div class="container">
			<div class="tit">
				<h1><?php echo $title; ?></h1>
			</div>
		</div>
		<article>
			<div class="col-md-6">
				<div class="img_Buffet" style="background-image: url('<?php echo $post_thumbnail_url ;?>');">
				</div>
			</div>
			<div class="col-md-6">
				<div class="col-md-10 bg_buffet">
					<?php 
						echo $content;
					?>
					<!-- Button trigger modal -->
					<button type="button" class="btn_orcamento" data-toggle="modal" data-target="#myModal">
					Solicitar um Orçamento
					</button>
					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									<h4 class="modal-title" id="myModalLabel">Solicitaçao de Orçamento</h4>
								</div>
								<div class="modal-body">
									Aqui vem o form de solicitação de orçamento...
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary">Save changes</button>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</article>
	</div>
</section>
<!-- / BUFFET -->

<!-- BLOG -->
<section class="blog">
	<div class="blog_int">
		<div class="container">
			
			<div class="blog_tit">
				<h1>Blog</h1>
			</div>

			<?php 
				$blog = new WP_Query( "cat=4&posts_per_page=4" );
			   	if ( $blog->have_posts() ) { 
			       	while ( $blog->have_posts() ) { 
			           	$blog->the_post();
						
						$blog_thumbnail_id = get_post_thumbnail_id($blog->ID);
						$blog_thumbnail_url = wp_get_attachment_url( $blog_thumbnail_id );
			?>
				<article class="col-md-12 col-xs-12 <?php echo $conta_articles++ ;?>">
					<div class="col-md-6">
						<a href="<?php echo get_permalink(); ?>" class="<?php echo get_the_title(); ?>">
							<div class="img_posts_blg" style="background-image: url('<?php if (!empty($blog_thumbnail_url)) { echo $blog_thumbnail_url; } else { echo get_template_directory_uri().'/assets/img/logo_posts.png'; } ?>');"></div>
						</a>
					</div>
					<div class="col-md-6">
						<h1><?php the_title(); ?></h1>
						<?php odin_posted_on(); ?>
						<?php the_excerpt(); ?>
						<a href="<?php echo get_permalink(); ?>" class="leia_mais">Continue Lendo...</a>
					</div>
				</article>
			<?php
					}
			   	}
			  	wp_reset_postdata();
			?>
		</div>
	</div>
</section>
<!-- / BLOG -->
<?php 
get_footer();
