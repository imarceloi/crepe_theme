<?php
/**
 * The default template for displaying content.
 *
 * Used for both single and index/archive/author/catagory/search/tag.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

<article id="post-<?php the_ID(); ?>" class="col-md-12 col-xs-12 <?php echo $conta_articles++ ;?>">
	<?php if ( is_single() ) : ?>
		<div class="col-md-12">
			<?php 
				$blog_thumbnail_id = get_post_thumbnail_id($post->ID);
				$blog_thumbnail_url = wp_get_attachment_url( $blog_thumbnail_id );
			?>
			<div class="img_posts_blg" style="background-image: url('<?php if (!empty($blog_thumbnail_url)) { echo $blog_thumbnail_url; } else { echo get_template_directory_uri().'/assets/img/logo_posts.png'; } ?>');"></div>
		</div>
		<div class="col-md-12">
			<?php the_content(); ?>
		</div>
	<?php else : ?>
		<div class="col-md-6">
			<?php 
				$blog_thumbnail_id = get_post_thumbnail_id($post->ID);
				$blog_thumbnail_url = wp_get_attachment_url( $blog_thumbnail_id );
			?>
			<a href="<?php echo get_permalink(); ?>" class="<?php echo get_the_title(); ?>">
				<div class="img_posts_blg" style="background-image: url('<?php if (!empty($blog_thumbnail_url)) { echo $blog_thumbnail_url; } else { echo get_template_directory_uri().'/assets/img/logo_posts.png'; } ?>');"></div>
			</a>
		</div>
		<div class="col-md-6">
			<?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h1>', '</h1></a>' ); ?>
			<?php odin_posted_on(); ?>
			<?php the_excerpt(); ?>
			<a href="<?php echo get_permalink(); ?>" class="leia_mais">Continue Lendo...</a>
		</div>
	<?php endif; ?>
</article>