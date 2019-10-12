<?php
/**
 * The template for displaying archive pages.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @since 1.0.0
 */
get_header();
$post_per_page = 5;
if (isset($_POST['post_per_page'])) {
   $post_per_page = $_POST['post_per_page'];
}
$argss = array(
    'post_type' => 'post',
    'posts_per_page' => $post_per_page,
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1
  );      
$post_query = new WP_Query($argss);
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">

				<?php if (have_posts()) : ?>

                <div class="row">
                <header class="header col-md-6">
                    <h2 class="grow"><?php wp_title(''); ?></h2>
                </header><!-- .page-header -->
                </div>
                </div>
                <div class="list-items-container">
                    <div class="row list-item">
                    <?php
                    // Start the Loop.
                    while (have_posts()) : the_post();
                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part('template-parts/content', 'excerpt');

                    endwhile; // End the loop.
                    ?>

                    </div>
                    <?php
                    global $wp_query;
                    if ($wp_query->max_num_pages > 1) : ?>
                        <span class="nav-links">
                            <?php

                            $big = 999999999; // need an unlikely integer
                            echo paginate_links(array(
                                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                'format' => '?paged=%#%',
                                'current' => max(1, get_query_var('paged')),
                                'total' => $wp_query->max_num_pages,
                                'prev_next' => false,
                                'show_all' => true,
                            ));
                            ?>
                        </span>
                   
                    <div class="load-more">
                        <button class="btn btn-loadmore"><?= __('Load More'); ?></button> 
               
                        </div>
                        <?php endif; ?>
					
						<?php
                    // If no content, include the "No posts found" template.
                else :
                    get_template_part('template-parts/content', 'none');

                endif;
                ?>
			</div>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
?>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('.list-box ul li:first-child').addClass('active');
        $('.current-cate').click(function(){
            $(this).next().addClass('test').slideDown();
            $(this).next().slideDown();
            $(this).hide();
        })
        function loadMoreFunction(){
            var a = $('.btn.btn-loadmore').click(function(){
                let $this = $(this),
                    currentPage = $('body .nav-links .page-numbers.current');
                    $this.text('Loading...').addClass('loading');
                    currentPage.removeClass('current');
                    currentPage.next().addClass('current');
                    if(currentPage.length){
                        let nextPage = currentPage.next();
                        if(nextPage.length){
                            let href = nextPage.attr('href');
                            $.get(href , function(response){
                                let content =  ($(response).find('.list-item .blog-item'));
                                $this.text('Load more').removeClass('loading');
                                $('body .list-item').append(content)
                            })
                        }else{
                            $this.text('No more posts');
                        }
                    }
            })
        }
        loadMoreFunction();
        $('.list-categories li a').click(function(){
            event.preventDefault();
            let $this = $(this),
            href = $this.attr('href'),
            text = $this.text();
            $this.parent().addClass('active').siblings().removeClass('active');
            $this.closest('ul').removeClass('test');
            $this.closest('.list-box').find('.current-cate').show().text(text);
            $this.closest('ul').hide();
            if(href.length){
                $.get(href , function(response){

                    let content =  $(response).find('.list-items-container');
                    $('body .list-items-container').html(content);

                    loadMoreFunction();
                })
            }
        }) 

    })
</script>
