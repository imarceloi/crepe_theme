<?php
/**
 * The template for displaying Category pages.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>

<!-- BLOG -->
<section class="blog s4">
	<div class="blog_int">
		<div class="container">
			<div class="blog_tit">
				<h1>Blog</h1>
			</div>
			<?php 
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
					get_template_part( 'content', get_post_format() );
					endwhile;
				else :
					get_template_part( 'content', 'none' );
				endif;
			?>
		</div>
	</div>
</section>
<!-- / BLOG -->
<?php
get_footer();
