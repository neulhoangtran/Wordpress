<?php
/**
 * The template for displaying all single posts.
 *
 * @see https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @since 1.0.0
 */
mesmerize_get_header();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<?php 
$post_type_obj = get_post_type_object('post');
$postLabel = $post_type_obj->labels->name;
$page_for_posts = get_option( 'page_for_posts' );


$check_loggin = wp_is_loggined();


// wpum_get_queried_user_id();
if($check_loggin) : 
?>

<section id="start">
	<div class="container-bt"><button class="start">Bắt đầu thi</button></div>	
</section>
<style type="text/css">
	#primary{
		display: none;
	}
	section#start {
	    min-height: 310px;
	    display: flex;
	    justify-content: flex-start;
	    align-items: center;
	}
	button.start{
		cursor: pointer;
	}
</style>
<section id="primary" class="content-area">
	<main id="main" class="site-main">

		<div class="container top-content">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-12 left">
					<div class="block date">
						<h6><?php echo ('Thời Gian'); ?></h6>
						<p class="grow">
							<div id="timer"></div>
						</p>
					</div>
					<div class="block cate">
						<h6><?php echo ('Chuyên Mục'); ?></h6>
						<div class="grow">
							
								<?php
                                    global $post;
                                    $cate = get_categories();
                                    $categories = get_the_category($post->ID);
                                    for ($i = 0; $i < count($categories); ++$i) {
                                        echo  '<p style="margin:0;"><a href="javascript:void(0)">'.$categories[$i]->name.'</a></p>';
                                    }
                                ?>
							
						</div>
					</div> 
					
					<div class="block link-all">
						<a class="more" href="<?php echo get_home_url(); ?>">
							<i class="fa fa-angle-left" aria-hidden="true"></i><?php echo ('Tất cả bài viết '); ?>
						</a>
					</div>

				</div>
				<div class="col-lg-9 col-md-9 col-sm-12 main">
					<?php

                    while (have_posts()) :
                        the_post();

                        get_template_part('template-parts/content', 'single');

                    endwhile; // End of the loop.
                    ?>
					<div class="block link-all mobile">
						<a class="more" href="<?php echo get_home_url(); ?>">
							<i class="fa fa-angle-left" aria-hidden="true"></i><?php echo ('Tất cả bài viết '); ?>
						</a>
					</div>
				</div>
			</div>
		</div>

	</main><!-- #main -->
</section><!-- #primary -->


<script>
    jQuery(document).ready(function($){
        $('input[type=radio]').change(function(){
            $(this).closest('.sections').addClass('ans');
            var val = $(this).val();
            var val2 = $(this).closest('.ans').find('input[type=hidden]');
            if(val == val2.val()){
                $(this).closest('.sections').addClass('true');
                $(this).closest('.sections').removeClass('false');
            }else{
                $(this).closest('.sections').addClass('false');
                $(this).closest('.sections').removeClass('true');
            }
        })
    })
</script>
<script type="text/javascript">
	jQuery(document).ready(function($){

		$('.container-bt').click(function(){
			$('#start').remove();
			$('#primary').show();
			stickySidebar();
			makeTimer();
			watchAns();

		});

	    $('.bt button').click(function(){
		    if (confirm("Bạn chắc chắn nộp bài chứ ?")) {
		   		pointCaculation();
		  	}	
	    });

		function watchAns(){
			$('.watch-ans').click(function(){
				event.preventDefault();
				$('.wrap-result-table').removeClass('active');
				$('html').removeClass('not-scroll');
				$('.bt button').remove();
				let ans = $('.ans input[type=hidden]');
				console.log(ans.length);
				ans.each(function(){
					let value = parseInt($(this).val());
					if(value == 0){
						$(this).closest('.ans').find('label:first-child').addClass('yellow');
					}else if (value == 2) {
						$(this).closest('.ans').find('label:nth-child(2)').addClass('yellow');
					}else if (value == 3) {
						$(this).closest('.ans').find('label:nth-child(3)').addClass('yellow');
					}else {
						$(this).closest('.ans').find('label:nth-child(4)').addClass('yellow');
					}
				})

			})
		}
		function pointCaculation(){
	   		let a = $('.sections.ans'),
	   		b = 20 - a.length;

   		    let trues = $('.sections.ans.true'),
   		    falses = b,
   		    point = 10 / 20,
   		    score = trues.length * point ;
   		    let classification = '';
   		    if(score > 7.9){
   		        classification = 'Giỏi';
   		    }else if(score < 8 && score > 6.4){
   		        classification = 'Khá';
   		    }else if(score < 6.5 && score > 4.5){
   		        classification = 'Trung Bình';
   		    }else{
   		        classification = 'Yếu';
   		    }

   		    $('.result-table .true-ans').text(trues.length);
   		    $('.result-table .false-ans').text(falses);
   		    $('.result-table .scores').text(score);
   		    $('.result-table .classification').text(classification);
   		    $('.wrap-result-table').addClass('active');
   		    $('html').addClass('not-scroll');
		}


		function makeTimer() {
			var timer2 = "20:01";
			var count  = 601;
			var interval = setInterval(function() {
				count--;

			  var timer = timer2.split(':');
			  //by parsing integer, I avoid all extra string processing
			  var minutes = parseInt(timer[0], 10);
			  var seconds = parseInt(timer[1], 10);
			  --seconds;
			  minutes = (seconds < 0) ? --minutes : minutes;
			  if (minutes < 0) clearInterval(interval);
			  seconds = (seconds < 0) ? 59 : seconds;
			  seconds = (seconds < 10) ? '0' + seconds : seconds;
			  //minutes = (minutes < 10) ?  minutes : minutes;
			  $('#timer').html(minutes + ':' + seconds);
			  timer2 = minutes + ':' + seconds;
			  if (count == 0) {
			  	alert('hết giờ');
			  	clearInterval(interval);
			  	pointCaculation();

			  }
			}, 1000);

		}

		function stickySidebar(){
			let sidebarPosition = $(' .container.top-content  .left').offset().top;
			$(window).scroll(function(){
				let scrollPosition = $(window).scrollTop() + 100;
				console.log(scrollPosition);
					if (scrollPosition > sidebarPosition) {
						$('html').addClass('sticky-sidebar');
					}else{
						$('html').removeClass('sticky-sidebar');
					}
			})
		}

	})

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
	.yellow{
		background: yellow;
	}
	@keyframes lds-spinner {
		0% {
			opacity: 1
		}
		100% {
			opacity: 0
		}
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
	a {
	    transition: color 110ms ease-in-out;
	    color: #b6932e;
	    text-decoration: none;
	}
	.single-post .detail-name h1 {
		line-height: 52px;
		color: #434343;
		margin: 12px 0 15px;
		font-style: normal;
		text-transform: none;
		padding-right: 10%
	}

	.single-post .row.list-item {
		margin-bottom: 0;
		margin-top: 0;
		padding-top: 55px;
		margin-left: -15px
	}

	.single-post .row.list-item .blog-item .category {
		position: relative
	}

	.single-post .site-content {
		padding-top: 85px
	}

	.top-content .left .block {
		margin-bottom: 40px
	}

	.top-content .left .block h6 {
		font-style: normal;
		font-weight: 700;
		text-transform: uppercase;
		color: #434343;
		margin: 0 0 5px 0;
		line-height: 1.85
	}

	.top-content .left .block .grow {
		font-style: italic;
		line-height: 1.85;
		margin-bottom: 0
	}

	.top-content .left .block.link-all {
		padding-top: 40px
	}

	.top-content .main {
		margin-bottom: 70px
	}

	.top-content .main .detail-category h6 {
		text-transform: uppercase;
		font-weight: 700;
		margin: 0;
		line-height: 1.85;
		font-size: 32px;
	}

	.top-content .main .content {
		color: #000;
		font-size: 16px;
		line-height: 26px;
		padding: 0;
	}

	.top-content .main .content .wp-block-image {
		margin-bottom: 30px;
		padding-top: 15px
	}

	.top-content .main .content p {
		margin-bottom: 30px
	}

	.top-content .main .content h5 {
		margin: 0 0 20px 0;
		padding-top: 5px;
		line-height: 1.28
	}

	.more-detail {
		background: #f5f5f5;
		position: relative;
		padding-bottom: 50px
	}

	.more-detail .title {
		position: relative
	}

	.more-detail .title h2 {
		position: relative;
		margin: 0;
		bottom: 10px
	}

	.more-detail .title h2:before {
		width: 100%;
		content: '';
		height: 14px;
		display: block;
		background: #d4c088;
		display: block;
		position: absolute;
		top: -58px;
		left: 0
	}
	@media (max-width: 1140px){
		body {
		    background-position: center;
		    background-repeat: repeat-y;
		    background-size: calc(100% - 60px);
		}
	}
	#main {
	    background-image: url('<?php echo get_site_url()."/wp-content/themes/empowerwp/assets/images/bkg-body.png"; ?>');
	    background-position: center;
	    background-repeat: repeat-y;
	    background-size: contain;
	    padding: 70px 0;
	}
	body .container {
	    padding: 30px;
	    max-width: 1140px;
	    margin-right: auto;
		margin-left: auto;
	    -webkit-box-shadow: -1px 0px 5px 4px rgba(143,87,87,1);
		-moz-box-shadow: -1px 0px 5px 4px rgba(143,87,87,1);
		box-shadow: -1px 0px 5px 4px rgba(143,87,87,1);
	    width: calc(100% - 60px);
	}
	.container-bt{
	    padding: 30px;
	    max-width: 1140px;
	    margin-right: auto;
		margin-left: auto;
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
	button.start {
	    width: 165px;
	    height: 55px;
	    border-radius: 5px;
	    background: red;
	    border: 2px solid red;
	    color: #fff;
	    font-size: 18px;
	    font-weight: bold;
	    text-transform: uppercase;
	    padding: 0;
	}

	button.start:hover {
	    background: #fff;
	    border: 2px solid red;
	    color: red;
	}

</style>
<?php else : ?>

<section id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="container top-content not-loggin">
			<div class="content">
				<h3><?php echo 'Vui Lòng đăng nhập hoặc đăng ký để thi !' ;?></h3>
				<div class="bt">
					<a href="<?php echo get_site_url() . '/login'?>" class="login" data-link="login">Đăng nhập</a>
					<a href="<?php echo get_site_url() . '/register' ;?>" class="create" data-link="create">Đăng ký</a>
				</div>
			</div>
		</div>
	</main>
</section>
<script>
	jQuery(document).ready(function($){
		$('.container.top-content.not-loggin .content .bt a').click(function(){
			event.preventDefault();
			let pageRedirect =	window.location.href;
			let link = $(this).attr('href');
            let date = new Date();
            let day = 0.001;
            date.setTime(date.getTime() + (day * 24 * 3600 * 1000 ));
            $.cookie("last-page", pageRedirect , { expires: date }, 'http://localhost:8080/wp/Wordpress/');
            window.location = link;
		})
	});
</script>
<style>
	.container.top-content{
	    background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #862077), color-stop(100%, #140027));
	    background-image: -webkit-linear-gradient(#862077, #140027);
	    background-image: -moz-linear-gradient(#862077, #140027);
	    background-image: -o-linear-gradient(#862077, #140027);
	    background-image: linear-gradient(#862077, #140027);
	}
	.container.top-content.not-loggin {
	    min-height: 40vh;
	}
	.container.top-content.not-loggin .content {
	    max-width: 500px;
	    margin: 50px auto;
	    display: flex;
	    /* margin: 50px; */
	    flex-wrap: wrap;
        background: transparent;
	}

	.container.top-content.not-loggin .content h3 {
	    width: 100%;
	    text-align: center;
	    color: #fff;
	    font-weight: bold;
	    font-size: 24px;
	    text-transform: uppercase;
	    line-height: 32px;
	}
	.container.top-content.not-loggin .content .bt a:hover {
		-webkit-transition: color 200ms linear;
		    -moz-transition: color 200ms linear;
		    -o-transition: color 200ms linear;
		    transition: color 200ms linear;
		    -webkit-transition: text-shadow 500ms linear;
		    -moz-transition: text-shadow 500ms linear;
		    -o-transition: text-shadow 500ms linear;
		    transition: text-shadow 500ms linear;
		    color: #caadd2;
		    text-shadow: 0 0 21px rgba(223, 206, 228, 0.5), 0 0 10px rgba(223, 206, 228, 0.4), 0 0 2px #2a153c;
	}
	.container.top-content.not-loggin .content .bt a {
	    width: 200px;
        text-transform: uppercase;
        font-weight: bold;
	    display: block;
	    padding: 10px 15px;
	    background: #00abfa;
	    color: #fff;
	    text-align: center;
	    border-radius: 5px;
	    font-size: 22px;
	    text-decoration: none;
	    -webkit-box-shadow: inset 0 1px 1px rgba(111, 55, 125, 0.8), inset 0 -1px 0px rgba(63, 59, 113, 0.2), 0 9px 16px 0 rgba(0, 0, 0, 0.3), 0 4px 3px 0 rgba(0, 0, 0, 0.3), 0 0 0 1px #150a1e;
    -moz-box-shadow: inset 0 1px 1px rgba(111, 55, 125, 0.8), inset 0 -1px 0px rgba(63, 59, 113, 0.2), 0 9px 16px 0 rgba(0, 0, 0, 0.3), 0 4px 3px 0 rgba(0, 0, 0, 0.3), 0 0 0 1px #150a1e;
    box-shadow: inset 0 1px 1px rgba(111, 55, 125, 0.8), inset 0 -1px 0px rgba(63, 59, 113, 0.2), 0 9px 16px 0 rgba(0, 0, 0, 0.3), 0 4px 3px 0 rgba(0, 0, 0, 0.3), 0 0 0 1px #150a1e;
    background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #3b2751), color-stop(100%, #271739));
    background-image: -webkit-linear-gradient(#3b2751, #271739);
    background-image: -moz-linear-gradient(#3b2751, #271739);
    background-image: -o-linear-gradient(#3b2751, #271739);
    background-image: linear-gradient(#3b2751, #271739);
    text-shadow: 0 0 21px rgba(223, 206, 228, 0.5), 0 -1px 0 #311d47;
	}

	.container.top-content.not-loggin .bt {
	    max-width: 500px;
	    width: 100%;
	    display: flex;
	    justify-content: space-around;
	}
</style>
<?php endif; ?>

<?php
get_footer();
?>