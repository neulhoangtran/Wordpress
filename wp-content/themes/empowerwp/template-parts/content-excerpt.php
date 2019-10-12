<?php
/**
 * Template part for displaying post archives and search results.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @since 1.0.0
 */
?>

<div id="post-<?php the_ID(); ?>" class="col-md-4 col-sm-6 col-xs-12 blog-item eff">
<div class=""><div class=""><?php get_post_thumbnail(); ?></div></div>
	<?php
    if ('post' === get_post_type()) : ?>
		<div class="entry-meta grow">
             <?php //gssi_posted_on();?>
            <?php echo get_the_date('d.m.Y'); ?>
		</div><!-- .entry-meta --> 
	<?php
    endif; ?>
	<?php
        if (is_sticky() && is_home() && !is_paged()) {
            printf('<span class="sticky-post">%s</span>', _x('Featured', 'post', 'twentynineteen'));
        }
        the_title(sprintf('<h5><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h5>');
    ?>
		<div class="category"><?php echo '- '; single_cat_title(); ?> </div>
	
</div><!-- #post-<?php the_ID(); ?> -->