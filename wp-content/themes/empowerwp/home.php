<?php
/**
 * The template for displaying archive pages.
 *
 * @see https://codex.wordpress.org/Template_Hierarchy
 */
mesmerize_get_header();?>
    <div class="wrap-lds"><div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>
    <div id="full" class="content-area">
        <main id="main" class="site-main" role="main">

            <!-- lesson section -->
            <div class="container">
                <div class="list-lesson" >
                    <?php
                    $args_ = array(
                        'post_type' => 'math',
                        'post_status' => 'publish',
                        'posts_per_page' => -1
                    );
                    $posts_ = new WP_Query( $args_ ); 
                    // echo '<pre>';
                    // var_dump($posts_); die();
                    ?>
                    <?php if ($posts_->have_posts()) : ?>
                    <div class="row">
                    <header class="page-header col-md-6">
                        <h2 class="grow"><?php echo 'Danh sách bài giảng' ?></h2>
                    </header><!-- .page-header -->
                    
                    <div id="categories" class="list-categories col-md-6" style="position: relative;">
                       <div class="content"> <div class="list-box" >
                            <span class="current-cate"><?php echo ('Tất cả bài viết '); ?></span>
                            <ul>
                                <li class="item" >
                                    <a  href="<?php global $wp; echo home_url($wp->request); ?>"><?php echo ('All'); ?>
                                    </a>
                                </li>
                                 <?php
                                 // while ($posts->have_posts()) : $posts->the_post();
                                     // $categories = get_the_category();
                                     $categories = get_terms( array(
                                        'taxonomy' => 'math_categories',
                                        'hide_empty' => false,
                                        'order' => 'DESC'
                                     ) );
                                    foreach ($categories as $category) {
                                        echo '<li class="item" ><a href="'.get_category_link($category->term_id).'">'.$category->name.'</a></li>';
                                    }
                                // endwhile;
                                 ?>
                            </ul>
                        </div></div>
                            
                    </div></div>
                    <div class="list-items-container list__lesson" info-main="list__lesson">
                        <div class="row list-item">
                            <?php

                            // Start the Loop.
                            while ($posts_->have_posts()) : $posts_->the_post();
                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part('template-parts/content', 'newsroom');

                            endwhile; // End the loop.
                            ?>

                        </div>
                    <?php
                    // global $posts_;
                    if ($posts_->max_num_pages > 1) :  ?>
                        <span class="nav-links">
                            <?php

                            $big = 999999999; // need an unlikely integer
                            echo paginate_links(array(
                                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                'format' => '?paged=%#%',
                                'current' => max(1, get_query_var('paged')),
                                'total' => $posts_->max_num_pages,
                                'prev_next' => false,
                                'show_all' => true,
                            ));
                            ?>
                        </span>
                    
                    <div class="load-more">
                        <button class="btn btn-loadmore"><?php echo ('Hiển thị thêm bài viết'); ?></button> 
                    
                        </div>
                        <?php endif; ?>   
                    <?php

                    // If no content, include the "No posts found" template.
                    else :
                        get_template_part('template-parts/content', 'none');

                    endif;
                    ?>
                </div>
            </div>
            <hr><br><br>
            <!-- trắc nghiệm section -->
            <div class="container">
                <?php if (have_posts()) : ?>
                <div class="row">
                <header class="page-header col-md-6">
                    <h2 class="grow"><?php echo 'Bài Thi Trắc Nghiệm' ?></h2>
                </header><!-- .page-header -->
  
                <div id="categories" class="list-categories col-md-6">
                   <div class="content"> <div class="list-box">
                        <span class="current-cate"><?php echo ('Tất cả bài viết '); ?></span>
                        <ul>
                            <li class="item" >
                                <a  href="<?php global $wp; echo home_url($wp->request); ?>"><?php echo ('All'); ?>
                                </a>
                            </li>
                             <?php
                                 $categories = get_categories();
                                foreach ($categories as $category) {
                                    echo '<li class="item" ><a href="'.get_category_link($category->term_id).'">'.$category->name.'</a></li>';
                                }
                             ?>
                        </ul>
                    </div></div>
                        
                </div></div>
                <div class="list-items-container quiz" info-main="quiz">
                    <div class="row list-item">
                        <?php

                        // Start the Loop.
                        while (have_posts()) : the_post();
                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part('template-parts/content', 'newsroom');

                        endwhile; // End the loop.
                        ?>

                    </div>
                <?php
                global $wp_query;
                if ($wp_query->max_num_pages > 1) :  ?>
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
                    <button class="btn btn-loadmore"><?php echo ('Hiển thị thêm bài viết'); ?></button> 
           
                    </div>
                    <?php endif; ?>   
                <?php

                // If no content, include the "No posts found" template.
                else :
                    get_template_part('template-parts/content', 'none');

                endif;
                ?>
            </div>
            
            <hr><br><br>
            <div class="container">
                <?php
                $args = array(
                    'post_type' => 'math_2',
                    'post_status' => 'publish',
                    'posts_per_page' => -1
                );
                $posts = new WP_Query( $args ); ?>
                <?php if ($posts->have_posts()) : ?>
                <div class="row">
                <header class="page-header col-md-6">
                    <h2 class="grow"><?php echo 'Bài Thi Tự Luận' ?></h2>
                </header><!-- .page-header -->
            
                <div id="categories" class="list-categories col-md-6">
                   <div class="content"> <div class="list-box">
                        <span class="current-cate"><?php echo ('Tất cả bài viết '); ?></span>
                        <ul>
                            <li class="item" >
                                <a  href="<?php global $wp; echo home_url($wp->request); ?>"><?php echo ('All'); ?>
                                </a>
                            </li>
                             <?php
                             // while ($posts->have_posts()) : $posts->the_post();
                                 $categories = get_the_category();
                                 $categories = get_terms( array(
                                    'taxonomy' => 'math_2_categories',
                                    'hide_empty' => false,
                                    'order' => 'DESC'
                                 ) );
                                foreach ($categories as $category) {
                                    echo '<li class="item" ><a href="'.get_category_link($category->term_id).'">'.$category->name.'</a></li>';
                                }
                            // endwhile;
                             ?>
                        </ul>
                    </div></div>
                        
                </div></div>
                <div class="list-items-container essay" info-main="essay">
                    <div class="row list-item">
                        <?php

                        // Start the Loop.
                        while ($posts->have_posts()) : $posts->the_post();
                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part('template-parts/content', 'newsroom');

                        endwhile; // End the loop.
                        ?>

                    </div>
                <?php
                global $posts;
                if ($posts->max_num_pages > 1) :  ?>
                    <span class="nav-links">
                        <?php

                        $big = 999999999; // need an unlikely integer
                        echo paginate_links(array(
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $posts->max_num_pages,
                            'prev_next' => false,
                            'show_all' => true,
                        ));
                        ?>
                    </span>
               
                <div class="load-more">
                    <button class="btn btn-loadmore"><?php echo ('Hiển thị thêm bài viết'); ?></button> 
            
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
    </div><!-- #primary -->

<?php
//get_sidebar();
get_footer();

?>

<script type="text/javascript">
         jQuery(document).ready(function($){

            function effectFunction(){
                var visible = jQuery('.eff');
                var i = 0.1;
                visible.each(function(){
                    var ad = jQuery(this).visible(true);
                    if(ad == true){
                        jQuery(this).addClass('eff2');
                        i+= 0.1;
                    }
                })
                $(window).scroll(function(){
                    var visible = jQuery('.eff');
                    var i = 0.1;
                    visible.each(function(){
                        var ad = jQuery(this).visible(true);
                        if(ad == true){
                            jQuery(this).addClass('eff2');
                            i+= 0.1;
                        }
                    })
                })
            }
            
            function openDropdown(){
                $('.list-box ul li:first-child').addClass('active');
                $('.current-cate').click(function(){
                    $(this).next().addClass('test').slideDown();
                    $(this).next().slideDown();
                    $(this).hide();
                });
            }

            function loadMoreFunction(){
                var a = $('.btn.btn-loadmore').click(function(){
                    let $this = $(this),
                        currentSection = $(this).closest('.list-items-container').attr('info-main'),
                        currentPage = $(this).closest('.list-items-container').find('.nav-links .page-numbers.current');
                        $('.wrap-lds').show();
                        $this.text('Loading...').addClass('loading');
                        currentPage.removeClass('current');
                        currentPage.next().addClass('current');
                        
                        if(currentPage.length){
                            let nextPage = currentPage.next();
                            if(nextPage.length){
                                let href = nextPage.attr('href');
                                $.ajax({
                                    type: "POST",
                                    url: href,
                                    success: function(response){
                                        let filterContent = '.' + currentSection + '.list-items-container .list-item .blog-item';
                                        let content =  ($(response).find('' + filterContent));
                                        $this.text('Load more').removeClass('loading');
                                        if($('.three-col').length >0 ) {
                                            content.each(function( i ) {
                                                if(i == 0 || i == 1 || i == 2 || i == 3 || i == 4 || i == 5) {
                                                    $('body .list-item .col-1').append($(this));
                                                }
                                                if(i == 6 || i == 7 || i == 8 || i == 9 || i == 10) {
                                                    $('body .list-item .col-2').append($(this));
                                                }
                                                if(i == 11 || i == 12 || i == 13 || i == 14 || i == 15) {
                                                    $('body .list-item .col-3').append($(this));
                                                }
                                            });
                                        }else {
                                            $('body .list-item').append(content);
                                        }
                                        var currentPageLength = $('body .nav-links .page-numbers.current').next();
                                        if(!currentPageLength.length){
                                            $this.remove();
                                        }
                                        $('.wrap-lds').hide();
                                        effectFunction();
                                    }
                                });
                            }else{
                                $this.remove();
                            }
                        }
                })
            }

            function dropdownCate(){
                $('.list-categories li a').click(function(){
                    event.preventDefault();
                    let $this = $(this),
                    href = $this.attr('href'),
                    currentSection = $(this).closest('.list-items-container').attr('info-main'),
                    text = $this.text();
                    $this.parent().addClass('active').siblings().removeClass('active');
                    $this.closest('ul').removeClass('test');
                    $this.closest('.list-box').find('.current-cate').show().text(text);
                    $this.closest('ul').hide();
                    $('.wrap-lds').show();
                    if(href.length){
                        $.ajax({
                            type: "POST",
                            url: href,
                            success: function(response){
                                let filterContent = '.' + currentSection + '.list-items-container';
                                let content =  $(response).find('' + filterContent).html();
                                // let content =  $(response).find('.list-items-container');
                                $(this).closest('.list-items-container').html(content);
                                $('.wrap-lds').hide();
                                loadMoreFunction();
                                effectFunction();
                            }
                        });
                    }
                });
            }

            effectFunction();
            dropdownCate();
            loadMoreFunction();
            openDropdown();


            
         });


     </script>

<style type="text/css">
@charset "UTF-8";
@import url(https://fonts.googleapis.com/css?family=Muli|Zilla+Slab&display=swap);
@import url(https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css);
@import url(https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css);
@font-face {
	font-family: NonBreakingSpaceOverride;
	src: url(data:application/font-woff2;charset=utf-8;base64,d09GMgABAAAAAAMoAA0AAAAACDQAAALTAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP0ZGVE0cGh4GYACCahEICjx3CywAATYCJANUBCAFhiEHgWwbXQfILgpsY+rQRRARwyAs6uL7pxzYhxEE+32b3aeHmifR6tklkS9hiZA0ewkqGRJE+H7/+6378ASViK/PGeavqJyOzsceKi1s3BCiQsiOdn1r/RBgIJYEgCUhbm/8/8/h4saPssnTNkkiWUBrTRtjmQSajw3Ui3pZ3LYDPD+XG2C3JA/yKAS8/rU5eNfuGqRf4eNNgV4YAlIIgxglEkWe6FYpq10+wi3g+/nUgvgPFczNrz/RsTgVm/zfbPuHZlsuQECxuyqBcQwKFBjFgKO8AqP4bAN9tFJtnM9xPcbNjeXS/x1wY/xU52f5W/X1+9cnH4YwKIaoRRAkUkj/YlAAeF/624foiIDBgBmgQBeGAyhBljUPZUm/l2dTvmpqcBDUOHdbPZWd8JsBAsGr4w8/EDn82/bUPx4eh0YNrQTBuHO2FjQEAGBwK0DeI37DpQVqdERS4gZBhpeUhWCfLFz7J99aEBgsJCHvUGAdAPp4IADDCAPCEFMGpMZ9AQpTfQtQGhLbGVBZFV8BaqNyP68oTZgHNj3M8kBPfXTTC9t90UuzYhy9ciH0grVlOcqyCytisvbsERsEYztiznR0WCrmTksJwbSNK6fd1Rvr25I9oLvctUoEbNOmXJbqgYgPXEHJ82IUsrCnpkxh23F1rfZ2zcRnJYoXtauB3VTFkFXQg3uoZYD5qE0kdjDtoDoF1h2bulGmev5HbYhbrjtohQSRI4aNOkffIcT+d3v6atpaYh3JvPoQsztCcqvaBkppDSPcQ3bw3KaCBo1f5CJWTZEgW3LjLofYg51MaVezrx8xZitYbQ9KYeoRaqQdVLwSEfrKXLK1otCWOKNdR/YwYAfon5Yk8O2MJfSD10dPGA5PIJJQMkah0ugMJiv6x4Dm7LEa8xnrRGGGLAg4sAlbsA07sAt76DOsXKO3hIjtIlpnnFrt1qW4kh6NhS83P/6HB/fl1SMAAA==) format("woff2"), url(data:application/font-woff;charset=utf-8;base64,d09GRgABAAAAAAUQAA0AAAAACDQAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAABGRlRNAAAE9AAAABwAAAAchf5yU0dERUYAAATYAAAAHAAAAB4AJwAbT1MvMgAAAaAAAABJAAAAYJAcgU5jbWFwAAACIAAAAF4AAAFqUUxBZ2dhc3AAAATQAAAACAAAAAgAAAAQZ2x5ZgAAApAAAAAyAAAAPL0n8y9oZWFkAAABMAAAADAAAAA2Fi93Z2hoZWEAAAFgAAAAHQAAACQOSgWaaG10eAAAAewAAAAzAAAAVC7TAQBsb2NhAAACgAAAABAAAAAsAOQBAm1heHAAAAGAAAAAHQAAACAAWQALbmFtZQAAAsQAAAF6AAADIYvD/Adwb3N0AAAEQAAAAI4AAADsapk2o3jaY2BkYGAA4ov5mwzj+W2+MnCzXwCKMNzgCBSB0LfbQDQ7AxuI4mBgAlEAFKQIRHjaY2BkYGD3+NvCwMDBAALsDAyMDKhAFAA3+wH3AAAAeNpjYGRgYBBl4GBgYgABEMnIABJzAPMZAAVmAGUAAAB42mNgZlJhnMDAysDCKsKygYGBYRqEZtrDYMT4D8gHSmEHjgUFOQwODAqqf9g9/rYwMLB7MNUAhRlBcsxBrMlASoGBEQAj8QtyAAAAeNrjYGBkAAGmWQwMjO8gmBnIZ2NA0ExAzNjAAFYJVn0ASBsD6VAIDZb7AtELAgANIgb9AHjaY2BgYGaAYBkGRgYQSAHyGMF8FgYPIM3HwMHAxMDGoMCwQIFLQV8hXvXP//9AcRCfAcb///h/ygPW+w/vb7olBjUHCTCyMcAFGZmABBO6AogThgZgIUsXAEDcEzcAAHjaY2BgECMCyoEgACZaAed42mNgYmRgYGBnYGNgYAZSDJqMgorCgoqCjECRXwwNrCAKSP5mAAFGBiRgyAAAi/YFBQAAeNqtkc1OwkAUhU/5M25cEhcsZick0AwlBJq6MWwgJkAgYV/KAA2lJeUn+hY+gktXvpKv4dLTMqKycGHsTZNv7px7z50ZAFd4hYHjdw1Ls4EiHjVncIFnzVnc4F1zDkWjrzmPW+NNcwGlzIRKI3fJlUyrEjZQxb3mDH2fNGfRx4vmHKqG0JzHg6E0F9DOlFBGBxUI1GEzLNT4S0aLuTtsGAEUuYcQHkyg3KmIum1bNUvKlrjbbAIleqHHnS4iSudpQcySMYtdFiXlAxzSbAwfMxK6kZoHKhbjjespMTioOPZnzI+4ucCeTVyKMVKLfeAS6vSWaTinuZwzyy/Dc7vaed+6KaV0kukdPUk6yOcctZPvvxxqksq2lEW8RvHjMEO2FCl/zy6p3NEm0R9OFSafJdldc4QVeyaaObMBO0/5cCaa6d9Ggyubxire+lEojscdjoWUR1xGOy8KD8mG2ZLO2l2paDc3A39qmU2z2W5YNv5+u79e6QfGJY/hAAB42m3NywrCMBQE0DupWp/1AYI7/6DEaLQu66Mrd35BKUWKJSlFv1+rue4cGM7shgR981qSon+ZNwUJ8iDgoYU2OvDRRQ99DDDECAHGmGCKmf80hZSx/Kik/LliFbtmN6xmt+yOjdg9GztV4tROnRwX/Bsaaw51nt4Lc7tWaZYHp/MlzKx51LZs5htNri+2AAAAAQAB//8AD3jaY2BkYGDgAWIxIGZiYARCESBmAfMYAAR6AEMAAAABAAAAANXtRbgAAAAA2AhRFAAAAADYCNuG) format("woff")
}

	@font-face {
		font-family: TrebuchetMS;
		src: url(../fonts/TrebuchetMS.eot);
		src: url(../fonts/TrebuchetMS.eot?#iefix) format("embedded-opentype"), url(../fonts/TrebuchetMS.woff2) format("woff2"), url(../fonts/TrebuchetMS.woff) format("woff"), url(../fonts/TrebuchetMS.ttf) format("truetype"), url(../fonts/TrebuchetMS.svg#TrebuchetMS) format("svg");
		font-weight: 400;
		font-style: normal
	}
		.row.list-item .blog-item.eff2 {
	    opacity: 1;
	    filter: Alpha(opacity=100);
	    -webkit-filter: Alpha(opacity=100);
	    -webkit-transform: translateY(0);
	    transform: translateY(0);
	}
	@keyframes lds-spinner {
		0% {
			opacity: 1
		}
		100% {
			opacity: 0
		}
	}


	body .container {
	    padding-left: 30px;
	    padding-right: 30px;
	    max-width: 1140px;
	    margin-right: auto;
	    margin-left: auto;
	}
	.header-wrapper {
	    margin-bottom: 72px;
	}
	.row.list-item .blog-item {
		-webkit-transition: opacity 1.5s cubic-bezier(.23, 1, .32, 1), -webkit-transform 1.5s cubic-bezier(.23, 1, .32, 1);
		transition: opacity 1.5s cubic-bezier(.23, 1, .32, 1), -webkit-transform 1.5s cubic-bezier(.23, 1, .32, 1);
		transition: transform 1.5s cubic-bezier(.23, 1, .32, 1), opacity 1.5s cubic-bezier(.23, 1, .32, 1);
		transition: transform 1.5s cubic-bezier(.23, 1, .32, 1), opacity 1.5s cubic-bezier(.23, 1, .32, 1), -webkit-transform 1.5s cubic-bezier(.23, 1, .32, 1);
		opacity: 0;
		filter: Alpha(opacity=0);
		-webkit-filter: Alpha(opacity=0);
		-webkit-transform: translateY(-10px);
		transform: translateY(-10px);
		-webkit-transition-delay: .1s;
		transition-delay: .1s
	}

	.row.list-item .blog-item.eff2 {
		opacity: 1;
		filter: Alpha(opacity=100);
		-webkit-filter: Alpha(opacity=100);
		-webkit-transform: translateY(0);
		transform: translateY(0)
	}
		.white {
		color: #fff
	}

	.black {
		color: #000
	}

	.grow {
		color: #b6932e
	}

	.grow2 {
		color: #d4c088
	}

	.grey {
		color: #979797
	}

	.grey2 {
		color: #6d6d6d
	}

	.grey3 {
		color: #d7c07f
	}

	.grey4 {
		color: #434343
	}

	.greywhite {
		color: #f5f5f5
	}

	.center {
		text-align: center
	}
	.archive .list-categories,
	.blog .list-categories,
	.page-template-newscroom .list-categories {
		text-align: right
	}

	.archive .content-area .load-more,
	.blog .content-area .load-more,
	.page-template-newscroom .content-area .load-more {
		text-align: center;
		margin-bottom: 174px
	}

	.list-categories .category-select select {
		min-width: 310px;
		border: 1px solid #b6932e;
		padding: 19.5px 30px
	}

	.row.list-item {
		margin-left: -20px;
		margin-right: -20px;
		margin-top: 95px;
		margin-bottom: 60px
	}

	.row.list-item .blog-item {
		padding: 0 23px;
		margin-bottom: 60px
	}
	a {
	    text-decoration: none;
	}
	.row.list-item .blog-item .post-thumbnail {
		margin-bottom: 25px;
		overflow: hidden;
		width: 100%;
		display: inline-block;
		vertical-align: top
	}

	.row.list-item .blog-item .post-thumbnail a {
		display: block;
		position: relative;
		transition: all .3s;
		-webkit-transition: all .3s;
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center;
		height: 100%!important
	}

	.row.list-item .blog-item .post-thumbnail a:before {
		content: '';
		display: block;
		width: 0%;
		height: 0%;
		position: absolute;
		top: 0;
		left: 0;
		opacity: 0;
		filter: Alpha(opacity=0);
		-webkit-filter: Alpha(opacity=0);
		background: rgba(0, 0, 0, .5);
		z-index: 1
	}

	.row.list-item .blog-item .post-thumbnail img {
		width: 100%;
		opacity: 0;
		filter: Alpha(opacity=0);
		-webkit-filter: Alpha(opacity=0)
	}

	.row.list-item .blog-item:hover .post-thumbnail a {
		transition: all .5s;
		-webkit-transition: all .5s;
		-moz-transition: all .5s;
		-ms-transition: all .5s;
		-o-transition: all .5s
	}

	.row.list-item .blog-item:hover .post-thumbnail a:before {
		width: 100%;
		height: 100%;
		opacity: 1;
		filter: Alpha(opacity=1);
		-webkit-filter: Alpha(opacity=1)
	}

	.row.list-item .blog-item .entry-meta {
		line-height: 33px;
		font-style: italic
	}

	.row.list-item .blog-item h5 {
		margin: 10px 0 14px;
		line-height: 25px;
		font-style: italic
	}

	.row.list-item .blog-item h5 a {
		color: #000;
		width: 100%;
		font-size: 16px;
	}

	.row.list-item .blog-item h5 a:focus,
	.row.list-item .blog-item h5 a:hover {
		color: #c6ac63;
		outline: 0;
		text-decoration: none
	}

	.row.list-item .blog-item .category {
		color: #000;
		display: inline-block
	}

	.list-items-container .list-items-container {
		padding: 0
	}

	.btn.loading {
		opacity: .5;
		filter: Alpha(opacity=50);
		-webkit-filter: Alpha(opacity=50);
		pointer-events: none
	}

	.btn-loadmore-1,
	.btn.btn-loadmore {
		height: 64px;
		border: solid 1px #b6932e;
		background: #fff;
		width: 310px;
		outline: 0
	}

	.btn-loadmore-1:focus,
	.btn-loadmore-1:hover,
	.btn.btn-loadmore:focus,
	.btn.btn-loadmore:hover {
		border-color: #d4c088
	}

	.btn-loadmore-1.hide,
	.btn.btn-loadmore.hide {
		display: none
	}

	.nav-links {
		display: none
	}

	div#categories {
		display: flex;
		justify-content: flex-end
	}

	.list-box {
		width: 100%;
		max-width: 312px;
		text-align: left;
		border: solid 1px #b6932e;
		position: absolute;
		background: #fff;
		z-index: 1;
		right: 15px;
		top: -7px;
	}
	main#main .container > .row {
	    position: relative;
	}
	.list-box .current-cate {
		position: relative;
		display: block;
		color: #b6932e;
		cursor: pointer;
		font-weight: 700;
		padding: 19px 25px
	}

	.list-box .current-cate:after {
		width: 12px;
		content: "";
		height: 12px;
		border: solid 2px #b6932e;
		transform: rotate(135deg) translateY(-50%);
		position: absolute;
		right: 32px;
		border-bottom: 0;
		border-left: 0
	}

	.list-box ul {
		list-style-type: none;
		margin: 0;
		padding: 8px 10px;
		display: none
	}

	.list-box ul.test {
		display: flex!important;
		flex-wrap: wrap
	}

	.list-box ul li {
		position: relative;
		display: block;
		width: 100%;
		margin: 6px 0
	}

	.list-box ul li.item a {
		color: #b6932e;
		padding: 5px 15px
	}

	.list-box ul li.item a:after {
		display: none
	}

	.list-box ul li.item.active {
		display: block;
		order: -1
	}

	.list-box ul li.item.active a {
		color: #b6932e;
		position: relative;
		font-weight: 700
	}

	.list-box ul li.item.active a:after {
		width: 12px;
		content: "";
		height: 12px;
		display: block;
		border: solid 2px #b6932e;
		transform: rotate(135deg) translateY(-50%);
		position: absolute;
		right: 14px;
		border-bottom: 0;
		border-left: 0;
		-webkit-transform: rotate(135deg) translateY(-50%);
		-moz-transform: rotate(135deg) translateY(-50%);
		-ms-transform: rotate(135deg) translateY(-50%);
		-o-transform: rotate(135deg) translateY(-50%);
		transform: rotate(-45deg) translateY(-50%);
		top: 50%
	}

	.list-box ul li a {
		display: block;
		position: relative;
		color: #b6932e
	}

	.list-box ul li a:after {
		width: 12px;
		content: "";
		height: 12px;
		border: solid 2px #b6932e;
		transform: rotate(135deg) translateY(-50%);
		position: absolute;
		right: 0;
		border-bottom: 0;
		border-left: 0;
		-webkit-transform: rotate(135deg) translateY(-50%);
		-moz-transform: rotate(135deg) translateY(-50%);
		-ms-transform: rotate(135deg) translateY(-50%);
		-o-transform: rotate(135deg) translateY(-50%);
		transform: rotate(-45deg) translateY(-50%);
		top: 40%
	}

	.lds-spinner {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%)
	}

	.wrap-lds {
		display: none;
		color: red;
		position: relative;
		position: fixed;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		bottom: 0;
		background: #000;
		z-index: 9999;
		opacity: .7
	}

	.lds-spinner div {
		transform-origin: 32px 32px;
		animation: lds-spinner 1.2s linear infinite
	}

	.lds-spinner div:after {
		content: " ";
		display: block;
		position: absolute;
		top: 3px;
		left: 29px;
		width: 5px;
		height: 14px;
		border-radius: 20%;
		background: #fff
	}

	.lds-spinner div:nth-child(1) {
		transform: rotate(0);
		animation-delay: -1.1s
	}

	.lds-spinner div:nth-child(2) {
		transform: rotate(30deg);
		animation-delay: -1s
	}

	.lds-spinner div:nth-child(3) {
		transform: rotate(60deg);
		animation-delay: -.9s
	}

	.lds-spinner div:nth-child(4) {
		transform: rotate(90deg);
		animation-delay: -.8s
	}

	.lds-spinner div:nth-child(5) {
		transform: rotate(120deg);
		animation-delay: -.7s
	}

	.lds-spinner div:nth-child(6) {
		transform: rotate(150deg);
		animation-delay: -.6s
	}

	.lds-spinner div:nth-child(7) {
		transform: rotate(180deg);
		animation-delay: -.5s
	}

	.lds-spinner div:nth-child(8) {
		transform: rotate(210deg);
		animation-delay: -.4s
	}

	.lds-spinner div:nth-child(9) {
		transform: rotate(240deg);
		animation-delay: -.3s
	}

	.lds-spinner div:nth-child(10) {
		transform: rotate(270deg);
		animation-delay: -.2s
	}

	.lds-spinner div:nth-child(11) {
		transform: rotate(300deg);
		animation-delay: -.1s
	}

	.lds-spinner div:nth-child(12) {
		transform: rotate(330deg);
		animation-delay: 0s
	}
	@media (min-width:768px) {
		.row.list-item .blog-item:nth-child(3n+2) {
			-webkit-transition-delay: .4s;
			transition-delay: .4s
		}
		.row.list-item .blog-item:nth-child(3n+0) {
			-webkit-transition-delay: .6s;
			transition-delay: .6s
		}
	}
	@media (min-width:576px) and (max-width:767px) {
		.row.list-item .blog-item:nth-child(2n+0) {
			-webkit-transition-delay: .2s;
			transition-delay: .2s
		}
	}
</style>