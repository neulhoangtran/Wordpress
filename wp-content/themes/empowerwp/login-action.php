<?php 
/*
 * Template name: Login action 
 */
mesmerize_get_header(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script>
	jQuery(document).ready(function($){
		// let cookiecheck = $.cookie("last-page");
		let cookiecheck = 'http://localhost:8080/wp/Wordpress/';
		if(cookiecheck){
			window.location = cookiecheck;
		}
	})

</script>