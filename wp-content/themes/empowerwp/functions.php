<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'mesmerize_notifications_template_slug', function () {
	return "empowerwp";
} );

add_filter( 'mesmerize_notifications_stylesheet_slug', function () {
	return "empowerwp";
} );

function empower_is_embedded() {
	return apply_filters( 'mesmerize_is_child_embedded', false );
}

function empower_has_post_thumbnail() {
	return ( has_post_thumbnail() || get_theme_mod( 'blog_show_post_thumb_placeholder', true ) );
}


function empower_text_domain() {
	$theme      = wp_get_theme();
	$textDomain = $theme->get( 'TextDomain' );

	return $textDomain;
}

function empower_get_stylesheet_directory() {
	if ( empower_is_embedded() ) {
		return get_template_directory() . "/child";
	} else {
		return get_stylesheet_directory();
	}

}


function empower_get_stylesheet_directory_uri() {
	if ( empower_is_embedded() ) {
		return get_template_directory_uri() . "/child";
	} else {
		return get_stylesheet_directory_uri();
	}

}

function empower_require( $path ) {
	$path = trim( $path, "\\/" );

	if ( file_exists( empower_get_stylesheet_directory() . "/{$path}" ) ) {
		require_once empower_get_stylesheet_directory() . "/{$path}";
	}
}

empower_require( "inc/defaults.php" );

empower_require( "customizer/customizer.php" );

 


function empower_enqueue_styles() {

	if ( empower_is_embedded() ) {
		$text_domain        = empower_text_domain();
		$parent_text_domain = mesmerize_get_text_domain();
		wp_enqueue_style( "{$text_domain}-child", empower_get_stylesheet_directory_uri() . '/style.min.css', array( "{$parent_text_domain}-style" ), mesmerize_get_version() );
	} else {
		$parent_style = 'mesmerize-parent';
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.min.css', array(), mesmerize_get_version() );
	}

}

function empower_kirki_add_inline_style_handle( $handle ) {

	if ( empower_is_embedded() ) {
		$text_domain = empower_text_domain();
		$handle      = "{$text_domain}-child";
	}

	return $handle;
}


function empower_print_sticky_class( $class = array() ) {

	$class = (array) $class;
	if ( is_sticky() ) {
		$class[] = 'sticky';
	}
	echo esc_attr( implode( " ", $class ) );
}


add_filter( 'mesmerize_archive_entry_class', function ( $class ) {
	if ( is_sticky() ) {
		$class[] = 'sticky';
	}

	return $class;
} );

function empower_default_values_filter( $args ) {

	$default_values = empower_theme_defaults();

	if ( array_key_exists( $args['settings'], $default_values ) && array_key_exists( 'default', $args ) ) {
		if ( $args['default'] != $default_values[ $args['settings'] ] ) {
			$args['default'] = $default_values[ $args['settings'] ];
		}
	}

	return $args;
}

function empower_replace_theme_tag( $content ) {

	return str_replace( '[tag_child_theme_uri]', empower_get_stylesheet_directory_uri(), $content );

}

function empower_theme_page_name() {
	return __( 'EmpowerWP Info', 'empowerwp' );
}


function empower_demos_page_name() {
	return __( 'EmpowerWP Demos', 'empowerwp' );
}


function empower_demos_available_in_pro() {
	return __( 'EmpowerWP PRO', 'empowerwp' );
}

function empower_thankyou_message() {
	return __( 'Thank you for choosing EmpowerWP!', 'empowerwp' );
}

function empower_companion_description() {
	return esc_html__( 'Mesmerize Companion plugin adds drag and drop functionality and many other features to the EmpowerWP theme.', 'empowerwp' );
}


function empower_info_page_tabs( $tabs ) {
	//Notice: This filter will be removed when the child imports will be created
	if ( array_key_exists( 'demo-imports', $tabs ) ) {
		unset( $tabs['demo-imports'] );
	}

	return $tabs;
}

function empower_get_footer_copyright( $copyright, $preview_atts ) {

	$copyright_text = __( 'Built using WordPress and the %s', 'empowerwp' );
	$copyright_text = sprintf( $copyright_text, '<a target="_blank" href="%s">EmpowerWP Theme</a>' );

	$copyright_text = sprintf( $copyright_text, 'https://extendthemes.com/go/built-with-empower/' );

	$copyright = '<p ' . $preview_atts . ' class="copyright">&copy;&nbsp;' . "&nbsp;" . date_i18n( __( 'Y', 'empowerwp' ) ) . '&nbsp;' . esc_html( get_bloginfo( 'name' ) ) . '.&nbsp;' . wp_kses_post( $copyright_text ) . '</p>';

	return $copyright;
}

function empower_remove_mesmerize_demos_menu_item() {
	//Notice: This filter will be removed when the child imports will be created
	remove_submenu_page( 'themes.php', 'mesmerize-demos' );
}

function empower_remove_demo_import_popup( $popups ) {
	//Notice: This filter will be removed when the child imports will be created
	foreach ( $popups as $index => $popup ) {
		if ( array_key_exists( 'id', $popup ) && $popup['id'] === "demo_import" ) {
			unset( $popups[ $index ] );
		}
	}

	return $popups;
}

function empower_archive_post_highlight( $value ) {
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	if ( $paged == 1 ) {
		return $value;
	} else {
		return false;
	}
}

add_filter( 'mesmerize_kirki_field_filter', 'empower_default_values_filter', 10, 1 );
add_filter( 'mesmerize_kirki_add_inline_style_handle', 'empower_kirki_add_inline_style_handle' );
add_filter( 'mesmerize_archive_post_highlight', 'empower_archive_post_highlight', 20 );

add_filter( 'mesmerize_already_colored_sections', function ( $args ) {
	return array_merge( $args, array( 'overlappable-7-mc' ) );
}, 10, 1 );


add_action( 'after_setup_theme', function () {

	add_action( 'wp_enqueue_scripts', 'empower_enqueue_styles', 100 );

	add_filter( 'mesmerize_stylesheet_has_min', "__return_true" );

	add_filter( 'mesmerize_stylesheet_deps', function ( $args ) {

		if ( ! empower_is_embedded() ) {
			$args[] = 'mesmerize-parent';
		}

		return $args;
	} );
	empower_require( "inc/admin.php" );
	empower_require( "inc/blog-options.php" );

	add_action( 'cloudpress\template\load_assets', function ( $companion ) {

		/**@var \Mesmerize\Companion $companion */
		if ( $companion->isMaintainable() ) {
			$ver = $companion->version;
			wp_enqueue_style( 'empower-companion-page-css', empower_get_stylesheet_directory_uri() . "/customizer/sections/content.css", array(), $ver );
		}

	} );

	add_filter( 'mesmerize_theme_page_name', 'empower_theme_page_name' );
	add_filter( 'mesmerize_demos_page_name', 'empower_demos_page_name' );
	add_filter( 'mesmerize_thankyou_message', 'empower_thankyou_message' );
	add_filter( 'mesmerize_companion_description', 'empower_companion_description' );
	add_filter( 'mesmerize_demos_available_in_pro', 'empower_demos_available_in_pro' );
	add_filter( 'mesmerize_theme_logo_url', '__return_false' );


	add_filter( 'mesmerize_get_footer_copyright', 'empower_get_footer_copyright', 10, 2 );

	// add_filter('mesmerize_show_info_pro_messages', '__return_false');
	// add_filter('mesmerize_show_main_info_pro_messages', '__return_false');

    // add_filter('mesmerize_info_page_tabs', 'empower_info_page_tabs');
    // add_action('admin_menu','empower_remove_mesmerize_demos_menu_item',20);
	// add_filter('cloudpress\customizer\feature_popups', 'empower_remove_demo_import_popup');
	

		/*
	* Creating a function to create our CPT
	*/

} );
function custom_post_type() {
	
	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Thi Trắc Nghiệm', 'Post Type General Name', 'twentythirteen' ),
			'singular_name'       => _x( 'quiz', 'Post Type Singular Name', 'twentythirteen' ),
			'menu_name'           => __( 'Quiz', 'twentythirteen' ),
			'parent_item_colon'   => __( 'Parent Movie', 'twentythirteen' ),
			'all_items'           => __( 'All Quiz', 'twentythirteen' ),
			'view_item'           => __( 'Xem Quiz', 'twentythirteen' ),
			'add_new_item'        => __( 'Add New Quiz', 'twentythirteen' ),
			'add_new'             => __( 'Add New', 'twentythirteen' ),
			'edit_item'           => __( 'Edit Quiz', 'twentythirteen' ),
			'update_item'         => __( 'Update Quiz', 'twentythirteen' ),
			'search_items'        => __( 'Search Quiz', 'twentythirteen' ),
			'not_found'           => __( 'Not Found', 'twentythirteen' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
		);
		
	// Set other options for Custom Post Type
		
		$args = array(
			'label'               => __( 'quiz', 'twentythirteen' ),
			'description'         => __( 'Quiz news and reviews', 'twentythirteen' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 2,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
			'taxonomies'          => array( 'quiz_categories' )
		);
		
		// Registering your Custom Post Type
		register_post_type( 'quiz', $args );

		register_taxonomy(  
			'quiz_categories',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
			'quiz',        //post type name
			array(  
				'hierarchical' => true,  
				'label' => 'Quiz Categories',  //Display name
				'query_var' => true,
				'rewrite' => array(
					'slug' => 'quiz', // This controls the base slug that will display before each term
					'with_front' => false // Don't display the category base before 
				)
			)  
		);
	
	}
	
	/* Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/
	
	add_action( 'init', 'custom_post_type', 0 );

	add_action( 'init', 'create_tag_taxonomies', 0 );

//create two taxonomies, genres and tags for the post type "tag"
function create_tag_taxonomies() 
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Quiz Tags', 'taxonomy general name' ),
    'singular_name' => _x( 'Quiz Tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Quiz Tags' ),
    'popular_items' => __( 'Popular Quiz Tags' ),
    'all_items' => __( 'All Quiz Tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Quiz Tag' ), 
    'update_item' => __( 'Update Quiz Tag' ),
    'add_new_item' => __( 'Add New Quiz Tag' ),
    'new_item_name' => __( 'New Quiz Tag Name' ),
    'separate_items_with_commas' => __( 'Separate tags with commas' ),
    'add_or_remove_items' => __( 'Add or remove quiz tags' ),
    'choose_from_most_used' => __( 'Choose from the most used tags' ),
    'menu_name' => __( 'Quiz Tags' ),
  ); 

  register_taxonomy('quiz tag','quiz',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'quiztag' ),
  ));
}

function randomGen($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}


/*
 * Function for post duplication. Dups appear as drafts. User is redirected to the edit screen
 */
function rd_duplicate_post_as_draft(){
  global $wpdb;
  if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
    wp_die('No post to duplicate has been supplied!');
  }
 
  /*
   * Nonce verification
   */
  if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
    return;
 
  /*
   * get the original post id
   */
  $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
  /*
   * and all the original post data then
   */
  $post = get_post( $post_id );
 
  /*
   * if you don't want current user to be the new post author,
   * then change next couple of lines to this: $new_post_author = $post->post_author;
   */
  $current_user = wp_get_current_user();
  $new_post_author = $current_user->ID;
 
  /*
   * if post data exists, create the post duplicate
   */
  if (isset( $post ) && $post != null) {
 
    /*
     * new post data array
     */
    $args = array(
      'comment_status' => $post->comment_status,
      'ping_status'    => $post->ping_status,
      'post_author'    => $new_post_author,
      'post_content'   => $post->post_content,
      'post_excerpt'   => $post->post_excerpt,
      'post_name'      => $post->post_name,
      'post_parent'    => $post->post_parent,
      'post_password'  => $post->post_password,
      'post_status'    => 'draft',
      'post_title'     => $post->post_title,
      'post_type'      => $post->post_type,
      'to_ping'        => $post->to_ping,
      'menu_order'     => $post->menu_order
    );
 
    /*
     * insert the post by wp_insert_post() function
     */
    $new_post_id = wp_insert_post( $args );
 
    /*
     * get all current post terms ad set them to the new post draft
     */
    $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
    foreach ($taxonomies as $taxonomy) {
      $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
      wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
    }
 
    /*
     * duplicate all post meta just in two SQL queries
     */
    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
    if (count($post_meta_infos)!=0) {
      $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
      foreach ($post_meta_infos as $meta_info) {
        $meta_key = $meta_info->meta_key;
        if( $meta_key == '_wp_old_slug' ) continue;
        $meta_value = addslashes($meta_info->meta_value);
        $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
      }
      $sql_query.= implode(" UNION ALL ", $sql_query_sel);
      $wpdb->query($sql_query);
    }
 
 
    /*
     * finally, redirect to the edit post screen for the new draft
     */
    wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
    exit;
  } else {
    wp_die('Post creation failed, could not find original post: ' . $post_id);
  }
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
 
/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
  if (current_user_can('edit_posts')) {
    $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
  }
  return $actions;
}
 
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 ); // post dubplicate
add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2); // page dubplicate


function cp_change_post_object()
{
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
    $labels->name = 'Newsroom';
}

function get_post_thumbnail()
{
    ?>
    <figure class="post-thumbnail">
        <a class="post-thumbnail-inner" 
            <?php  if ((get_the_post_thumbnail_url())) : ?>
                style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)"
            <?php else :  ?>
                style="background-image: url(<?php echo get_site_url().'/wp-content/themes/empowerwp/assets/images/blank-image.png'; ?>)"
            <?php endif; ?>
            href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
            <?php  if ((get_the_post_thumbnail_url())) :
                    echo '<img src="'.get_site_url().'/wp-content/themes/empowerwp/assets/images/blank-image.png'.'" alt="img">'; ?>
            <?php else :
                    echo '<img src="'.get_site_url().'/wp-content/themes/empowerwp/assets/images/blank-image.png'.'" alt="img">';
    endif; ?>
        </a>
    </figure>

<?php
}

function wp_enqueue_assets()
{
    // Enqueue distributable style.css theme file
    wp_enqueue_script('script-visible', get_stylesheet_directory_uri().'/js/jquery.visible.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'wp_enqueue_assets');
