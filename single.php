<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>
<!-- INT BLOG -->
<section class="blog s4">
	<div class="blog_int">
		<div class="container">
			<?php
				while ( have_posts() ) : the_post();
			?>
			<div class="blog_tit">
				<h1><?php the_title(); ?></h1>
			</div>
			<?php
					get_template_part( 'content', get_post_format() );
				endwhile;
			?>
		</div>
	</div>
</section>
<!-- INT BLOG -->
<?php
get_footer();
