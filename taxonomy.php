<?php
/**
 * Template Name: Produtos
 *
 * Template da home, que mostra os custom post para os destaques.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header();
?>
<section class="cardapio s2">
	<div class="cardapio_int interna">
		<div class="container tit_cardapio">
			<div class="col-md-4">
				<h1>Cardápio</h1>
			</div>
		</div>
	<?php
		$taxonomies = array('cardapio');
		$args = array(
		    'orderby'       => 'ID',
		    'order'         => 'ASC',
		    'hide_empty'    => false,
		    'fields'        => 'all', 
		    'slug'          => '',
		    'hierarchical'  => false, 
		    'parent'        => 0,
		    'child_of'      => 0,
		    'get'           => '', 
		    'name__like'    => '',
		    'pad_counts'    => true, 
		    'offset'        => '', 
		    'search'        => '', 
		    'cache_domain'  => 'core'
		);
		$cat = get_terms( $taxonomies, $args );
	?>
		<div class="container cat_interna">
	<?php
		foreach ($cat as $filho) :
	?>
			<a href="<?php echo get_term_link( $filho ) ; ?>" title="<?php echo $filho->name; ?>">
				<?php echo $filho->name; ?>
			</a>
	<?php 
		endforeach;
		wp_reset_query();
	?>
		</div>
	<?php 
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		// VERIFICA SE TEM ITEM CADASTRADO
		if ( have_posts() ) :
			$loopCardapioArgs = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'cardapio',
						'terms'    => $term->term_id,
					),
				),
			);
			$loopareas = new WP_Query( $loopCardapioArgs );
			while ( have_posts() ) : the_post();
			$cardapio_thumbnail_id 	= get_post_thumbnail_id($post_id);
			$cardapio_thumbnail_url = wp_get_attachment_url( $cardapio_thumbnail_id );
			$link_delivery	 		= get_post_meta(get_the_ID(), 'url_site', true);
	?>
			<article class="det_cardapio">
				<div class="col-md-6 img_Cardapio">
					<div style="background-image: url('<?php if (!empty($cardapio_thumbnail_url)) { echo $cardapio_thumbnail_url; } else { echo get_template_directory_uri().'/assets/img/logo_posts.png'; } ?>');"></div>
				</div>
				<div class="col-md-6">
					<div class="col-md-10">
						<h2><?php the_title(); ?></h2>
						<?php the_content(); ?>
						<?php if (!empty($link_delivery)): ?>
							<a href="http://<?php echo $link_delivery ; ?>" title="<?php echo get_the_title(); ?>" class="btn_orcamento" target="_blank">Pedir Online</a>
						<?php endif ?>
					</div>
				</div>
			</article>


	<?php
			endwhile;
			wp_reset_query();
	?>
	</div>
</section>
	<?php
		// CASO NÃO TENHA ITEM CADASTRADO
		else :
	?>
	<?php 
		// CHAMA O TEMPLATE CONTENT_NONE (CASO NÃO TENHA ITEM CADASTRADO NA CATEGORIA)
		get_template_part( 'content', 'none' );
	endif;
	?>
<?php
get_footer();