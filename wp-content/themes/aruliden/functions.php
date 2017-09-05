<?php

// Add Translation Option
load_theme_textdomain( 'wpbootstrap', TEMPLATEPATH.'/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) ) require_once( $locale_file );

// Clean up the WordPress Head
if( !function_exists( "wp_bootstrap_head_cleanup" ) ) {  
  function wp_bootstrap_head_cleanup() {
    // remove header links
    remove_action( 'wp_head', 'feed_links_extra', 3 );                    // Category Feeds
    remove_action( 'wp_head', 'feed_links', 2 );                          // Post and Comment Feeds
    remove_action( 'wp_head', 'rsd_link' );                               // EditURI link
    remove_action( 'wp_head', 'wlwmanifest_link' );                       // Windows Live Writer
    remove_action( 'wp_head', 'index_rel_link' );                         // index link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             // start link
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
    remove_action( 'wp_head', 'wp_generator' );                           // WP version
  }
}
// Launch operation cleanup
add_action( 'init', 'wp_bootstrap_head_cleanup' );

// remove WP version from RSS
if( !function_exists( "wp_bootstrap_rss_version" ) ) {  
  function wp_bootstrap_rss_version() { return ''; }
}
add_filter( 'the_generator', 'wp_bootstrap_rss_version' );

// Remove the […] in a Read More link
if( !function_exists( "wp_bootstrap_excerpt_more" ) ) {  
  function wp_bootstrap_excerpt_more( $more ) {
    global $post;
    return '...  <a href="'. get_permalink($post->ID) . '" class="more-link" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
  }
}
add_filter('excerpt_more', 'wp_bootstrap_excerpt_more');

// Add WP 3+ Functions & Theme Support
if( !function_exists( "wp_bootstrap_theme_support" ) ) {  
  function wp_bootstrap_theme_support() {
    add_theme_support( 'post-thumbnails' );      // wp thumbnails (sizes handled in functions.php)
    set_post_thumbnail_size( 125, 125, true );   // default thumb size
    add_theme_support( 'custom-background' );  // wp custom background
    add_theme_support( 'automatic-feed-links' ); // rss


    add_theme_support('custom-logo');

    // Add post format support - if these are not needed, comment them out
    add_theme_support( 'post-formats',      // post formats
      array( 
        'aside',   // title less blurb
        'gallery', // gallery of images
        'link',    // quick link to other site
        'image',   // an image
        'quote',   // a quick quote
        'status',  // a Facebook like status update
        'video',   // video 
        'audio',   // audio
        'chat'     // chat transcript 
      )
    );  

    add_theme_support( 'menus' );            // wp menus
    
    register_nav_menus(                      // wp3+ menus
      array( 
        'main_nav' => 'The Main Menu',   // main nav in header
        'footer_links' => 'Footer Links' // secondary nav in footer
      )
    );  
  }
}
// launching this stuff after theme setup
add_action( 'after_setup_theme','wp_bootstrap_theme_support' );

function wp_bootstrap_main_nav() {
  // Display the WordPress menu if available
  wp_nav_menu( 
    array( 
      'menu' => 'main_nav', /* menu name */
      'menu_class' => 'nav navbar-nav',
      'theme_location' => 'main_nav', /* where in the theme it's assigned */
      'container' => 'false', /* container class */
      'fallback_cb' => 'wp_bootstrap_main_nav_fallback', /* menu fallback */
      'walker' => new Bootstrap_walker()
    )
  );
}

function wp_bootstrap_footer_links() { 
  // Display the WordPress menu if available
  wp_nav_menu(
    array(
      'menu' => 'footer_links', /* menu name */
      'theme_location' => 'footer_links', /* where in the theme it's assigned */
      'container_class' => 'footer-links clearfix', /* container class */
      'fallback_cb' => 'wp_bootstrap_footer_links_fallback' /* menu fallback */
    )
  );
}

// this is the fallback for header menu
function wp_bootstrap_main_nav_fallback() { 
  /* you can put a default here if you like */ 
}

// this is the fallback for footer menu
function wp_bootstrap_footer_links_fallback() { 
  /* you can put a default here if you like */ 
}

// Shortcodes
require_once('library/shortcodes.php');

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

// Custom Backend Footer
add_filter('admin_footer_text', 'wp_bootstrap_custom_admin_footer');
function wp_bootstrap_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by <a href="http://320press.com" target="_blank">320press</a></span>. aruliden using <a href="http://themble.com/bones" target="_blank">Bones</a>.';
}

// adding it to the admin area
add_filter('admin_footer_text', 'wp_bootstrap_custom_admin_footer');

// Set content width
if ( ! isset( $content_width ) ) $content_width = 580;

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'wpbs-featured', 780, 300, true );
add_image_size( 'wpbs-featured-home', 970, 311, true);
add_image_size( 'wpbs-featured-carousel', 970, 400, true);

add_image_size( '1000x728', 1000, 728, true );
add_image_size( '815x420', 815, 420, true );
add_image_size( '840x495', 840, 495, true );
add_image_size( '330x334', 330, 334, true );

/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function wp_bootstrap_register_sidebars() {
  register_sidebar(array(
  	'id' => 'sidebar1',
  	'name' => 'Main Sidebar',
  	'description' => 'Used on every page BUT the homepage page template.',
  	'before_widget' => '<div id="%1$s" class="widget %2$s">',
  	'after_widget' => '</div>',
  	'before_title' => '<h4 class="widgettitle">',
  	'after_title' => '</h4>',
  ));
    
  register_sidebar(array(
  	'id' => 'sidebar2',
  	'name' => 'Homepage Sidebar',
  	'description' => 'Used only on the homepage page template.',
  	'before_widget' => '<div id="%1$s" class="widget %2$s">',
  	'after_widget' => '</div>',
  	'before_title' => '<h4 class="widgettitle">',
  	'after_title' => '</h4>',
  ));
    
  register_sidebar(array(
    'id' => 'footer1',
    'name' => 'Footer 1',
    'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer2',
    'name' => 'Footer 2',
    'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer3',
    'name' => 'Footer 3',
    'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));
    
    
  /* 
  to add more sidebars or widgetized areas, just copy
  and edit the above sidebar code. In order to call 
  your new sidebar just use the following code:
  
  Just change the name to whatever your new
  sidebar's id is, for example:
  
  To call the sidebar in your template, you can just copy
  the sidebar.php file and rename it to your sidebar's name.
  So using the above example, it would be:
  sidebar-sidebar2.php
  
  */
} // don't remove this bracket!
add_action( 'widgets_init', 'wp_bootstrap_register_sidebars' );

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function wp_bootstrap_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<div class="comment-author vcard clearfix">
				<div class="avatar col-sm-3">
					<?php echo get_avatar( $comment, $size='75' ); ?>
				</div>
				<div class="col-sm-9 comment-text">
					<?php printf('<h4>%s</h4>', get_comment_author_link()) ?>
					<?php edit_comment_link(__('Edit','wpbootstrap'),'<span class="edit-comment btn btn-sm btn-info"><i class="glyphicon-white glyphicon-pencil"></i>','</span>') ?>
                    
                    <?php if ($comment->comment_approved == '0') : ?>
       					<div class="alert-message success">
          				<p><?php _e('Your comment is awaiting moderation.','wpbootstrap') ?></p>
          				</div>
					<?php endif; ?>
                    
                    <?php comment_text() ?>
                    
                    <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
                    
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
			</div>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

// Display trackbacks/pings callback function
function list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
?>
        <li id="comment-<?php comment_ID(); ?>"><i class="icon icon-share-alt"></i>&nbsp;<?php comment_author_link(); ?>
<?php 

}

/************* SEARCH FORM LAYOUT *****************/

/****************** password protected post form *****/

add_filter( 'the_password_form', 'wp_bootstrap_custom_password_form' );

function wp_bootstrap_custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<div class="clearfix"><form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	' . '<p>' . __( "This post is password protected. To view it please enter your password below:" ,'wpbootstrap') . '</p>' . '
	<label for="' . $label . '">' . __( "Password:" ,'wpbootstrap') . ' </label><div class="input-append"><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" class="btn btn-primary" value="' . esc_attr__( "Submit",'wpbootstrap' ) . '" /></div>
	</form></div>
	';
	return $o;
}

/*********** update standard wp tag cloud widget so it looks better ************/

add_filter( 'widget_tag_cloud_args', 'wp_bootstrap_my_widget_tag_cloud_args' );

function wp_bootstrap_my_widget_tag_cloud_args( $args ) {
	$args['number'] = 20; // show less tags
	$args['largest'] = 9.75; // make largest and smallest the same - i don't like the varying font-size look
	$args['smallest'] = 9.75;
	$args['unit'] = 'px';
	return $args;
}

// filter tag clould output so that it can be styled by CSS
function wp_bootstrap_add_tag_class( $taglinks ) {
    $tags = explode('</a>', $taglinks);
    $regex = "#(.*tag-link[-])(.*)(' title.*)#e";

    foreach( $tags as $tag ) {
    	$tagn[] = preg_replace($regex, "('$1$2 label tag-'.get_tag($2)->slug.'$3')", $tag );
    }

    $taglinks = implode('</a>', $tagn);

    return $taglinks;
}

add_action( 'wp_tag_cloud', 'wp_bootstrap_add_tag_class' );

add_filter( 'wp_tag_cloud','wp_bootstrap_wp_tag_cloud_filter', 10, 2) ;

function wp_bootstrap_wp_tag_cloud_filter( $return, $args )
{
  return '<div id="tag-cloud">' . $return . '</div>';
}

// Enable shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

// Disable jump in 'read more' link
function wp_bootstrap_remove_more_jump_link( $link ) {
	$offset = strpos($link, '#more-');
	if ( $offset ) {
		$end = strpos( $link, '"',$offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}
add_filter( 'the_content_more_link', 'wp_bootstrap_remove_more_jump_link' );

// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'wp_bootstrap_remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'wp_bootstrap_remove_thumbnail_dimensions', 10 );

function wp_bootstrap_remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// Add the Meta Box to the homepage template
function wp_bootstrap_add_homepage_meta_box() {  
	global $post;

	// Only add homepage meta box if template being used is the homepage template
	// $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : "");
	$post_id = $post->ID;
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);

	if ( $template_file == 'page-homepage.php' ){
	    add_meta_box(  
	        'homepage_meta_box', // $id  
	        'Optional Homepage Tagline', // $title  
	        'wp_bootstrap_show_homepage_meta_box', // $callback  
	        'page', // $page  
	        'normal', // $context  
	        'high'); // $priority  
    }
}

add_action( 'add_meta_boxes', 'wp_bootstrap_add_homepage_meta_box' );

// Field Array  
$prefix = 'custom_';  
$custom_meta_fields = array(  
    array(  
        'label'=> 'Homepage tagline area',  
        'desc'  => 'Displayed underneath page title. Only used on homepage template. HTML can be used.',  
        'id'    => $prefix.'tagline',  
        'type'  => 'textarea' 
    )  
);  

// The Homepage Meta Box Callback  
function wp_bootstrap_show_homepage_meta_box() {  
  global $custom_meta_fields, $post;

  // Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'wpbs_nonce' );
    
  // Begin the field table and loop
  echo '<table class="form-table">';

  foreach ( $custom_meta_fields as $field ) {
      // get value of this field if it exists for this post  
      $meta = get_post_meta($post->ID, $field['id'], true);  
      // begin a table row with  
      echo '<tr> 
              <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
              <td>';  
              switch($field['type']) {  
                  // text  
                  case 'text':  
                      echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="60" /> 
                          <br /><span class="description">'.$field['desc'].'</span>';  
                  break;
                  
                  // textarea  
                  case 'textarea':  
                      echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="80" rows="4">'.$meta.'</textarea> 
                          <br /><span class="description">'.$field['desc'].'</span>';  
                  break;  
              } //end switch  
      echo '</td></tr>';  
  } // end foreach  
  echo '</table>'; // end table  
}  

// Save the Data  
function wp_bootstrap_save_homepage_meta( $post_id ) {  

    global $custom_meta_fields;  
  
    // verify nonce  
    if ( !isset( $_POST['wpbs_nonce'] ) || !wp_verify_nonce($_POST['wpbs_nonce'], basename(__FILE__)) )  
        return $post_id;

    // check autosave
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return $post_id;

    // check permissions
    if ( 'page' == $_POST['post_type'] ) {
        if ( !current_user_can( 'edit_page', $post_id ) )
            return $post_id;
        } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
    }
  
    // loop through fields and save the data  
    foreach ( $custom_meta_fields as $field ) {
        $old = get_post_meta( $post_id, $field['id'], true );
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta( $post_id, $field['id'], $new );
        } elseif ( '' == $new && $old ) {
            delete_post_meta( $post_id, $field['id'], $old );
        }
    } // end foreach
}
add_action( 'save_post', 'wp_bootstrap_save_homepage_meta' );

// Add thumbnail class to thumbnail links
function wp_bootstrap_add_class_attachment_link( $html ) {
    $postid = get_the_ID();
    $html = str_replace( '<a','<a class="thumbnail"',$html );
    return $html;
}
add_filter( 'wp_get_attachment_link', 'wp_bootstrap_add_class_attachment_link', 10, 1 );

// Add lead class to first paragraph
function wp_bootstrap_first_paragraph( $content ){
    global $post;

    // if we're on the homepage, don't add the lead class to the first paragraph of text
    if( is_page_template( 'page-homepage.php' ) )
        return $content;
    else
        return preg_replace('/<p([^>]+)?>/', '<p$1 class="lead-temp">', $content, 1);
}
add_filter( 'the_content', 'wp_bootstrap_first_paragraph' );

// Menu output mods
class Bootstrap_walker extends Walker_Nav_Menu{

  function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){

	 global $wp_query;
	 $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
	 $class_names = $value = '';
	
		// If the item has children, add the dropdown class for bootstrap
		if ( $args->has_children ) {
			$class_names = "dropdown ";
		}
	
		$classes = empty( $object->classes ) ? array() : (array) $object->classes;
		
		$class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';
       
   	$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

   	$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
   	$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
   	$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
   	$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

   	// if the item has children add these two attributes to the anchor tag
   	if ( $args->has_children ) {
		  $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
    }

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );
    $item_output .= $args->link_after;

    // if the item has children add the caret just before closing the anchor tag
    if ( $args->has_children ) {
    	$item_output .= '<b class="caret"></b></a>';
    }
    else {
    	$item_output .= '</a>';
    }

    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
  } // end start_el function
        
  function start_lvl(&$output, $depth = 0, $args = Array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }
      
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
    $id_field = $this->db_fields['id'];
    if ( is_object( $args[0] ) ) {
        $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
    }
    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }        
}

add_editor_style('editor-style.css');

function wp_bootstrap_add_active_class($classes, $item) {
	if( $item->menu_item_parent == 0 && in_array('current-menu-item', $classes) ) {
    $classes[] = "active";
	}
  
  return $classes;
}

// Add Twitter Bootstrap's standard 'active' class name to the active nav link item
add_filter('nav_menu_css_class', 'wp_bootstrap_add_active_class', 10, 2 );

// enqueue styles
if( !function_exists("wp_bootstrap_theme_styles") ) {  
    function wp_bootstrap_theme_styles() { 
        // This is the compiled css file from LESS - this means you compile the LESS file locally and put it in the appropriate directory if you want to make any changes to the master bootstrap.css.
        wp_register_style( 'wpbs', get_template_directory_uri() . '/library/dist/css/styles.f6413c85.min.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'wpbs' );

        wp_register_style( 'wpbs-table', get_stylesheet_directory_uri() . '/css/dataTables.bootstrap.min.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'wpbs-table' );

        // For child themes
        wp_register_style( 'wpbs-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'wpbs-style' );

        wp_register_style( 'bxslider', get_stylesheet_directory_uri() . '/css/jquery.bxslider.min.css', array(), '1.0', 'all' );
        wp_enqueue_style( 'bxslider' );
    }
}
add_action( 'wp_enqueue_scripts', 'wp_bootstrap_theme_styles' );

// enqueue javascript
if( !function_exists( "wp_bootstrap_theme_js" ) ) {  
  function wp_bootstrap_theme_js(){

    if ( !is_admin() ){
      if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1) ) 
        wp_enqueue_script( 'comment-reply' );
    }

    // This is the full Bootstrap js distribution file. If you only use a few components that require the js files consider loading them individually instead
    wp_register_script( 'bootstrap', 
      get_template_directory_uri() . '/bower_components/bootstrap/dist/js/bootstrap.js', 
      array('jquery'), 
      '1.2', true );

    wp_register_script( 'wpbs-js', 
      get_template_directory_uri() . '/library/dist/js/scripts.d1e3d952.min.js',
      array('bootstrap'), 
      '1.2', true  );
  
    wp_register_script( 'modernizr', 
      get_template_directory_uri() . '/bower_components/modernizer/modernizr.js', 
      array('jquery'), 
      '1.2', true );

        wp_register_script( 'bxslider', 
      get_template_directory_uri() . '/js/jquery.bxslider.min.js', 
      array('jquery'), 
      '1.2', true );

    wp_register_script( 'scripts', 
      get_template_directory_uri() . '/js/scripts.js', 
      array('jquery'), 
      '1.2', true );

    wp_register_script( 'isotope', 
      get_template_directory_uri() . '/js/isotope.pkgd.min.js', 
      array('jquery'), 
      '1.2', true );

    wp_register_script( 'jqueryDataTable', 
      get_template_directory_uri() . '/js/jquery.dataTables.min.js', 
      array('jquery'), 
      '1.2', true );

    wp_register_script( 'jqueryBSTable', 
      get_template_directory_uri() . '/js/dataTables.bootstrap.min.js', 
      array('jquery'), 
      '1.2', true );

    wp_enqueue_script( 'bootstrap' );
    wp_enqueue_script( 'wpbs-js' );
    wp_enqueue_script( 'modernizr' );
    wp_enqueue_script( 'bxslider' );
    wp_enqueue_script( 'isotope' );
    wp_enqueue_script( 'jqueryDataTable' );
    wp_enqueue_script( 'jqueryBSTable' );
    wp_enqueue_script( 'scripts' );
    
  }
}
add_action( 'wp_enqueue_scripts', 'wp_bootstrap_theme_js' );

// Get <head> <title> to behave like other themes
function wp_bootstrap_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() ) {
    return $title;
  }

  // Add the site name.
  $title .= get_bloginfo( 'name' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title = "$title $sep $site_description";
  }

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 ) {
    $title = "$title $sep " . sprintf( __( 'Page %s', 'wpbootstrap' ), max( $paged, $page ) );
  }

  return $title;
}
add_filter( 'wp_title', 'wp_bootstrap_wp_title', 10, 2 );

// Related Posts Function (call using wp_bootstrap_related_posts(); )
function wp_bootstrap_related_posts() {
  echo '<ul id="bones-related-posts">';
  global $post;
  $tags = wp_get_post_tags($post->ID);
  if($tags) {
    foreach($tags as $tag) { $tag_arr .= $tag->slug . ','; }
        $args = array(
          'tag' => $tag_arr,
          'numberposts' => 5, /* you can change this to show more */
          'post__not_in' => array($post->ID)
      );
        $related_posts = get_posts($args);
        if($related_posts) {
          foreach ($related_posts as $post) : setup_postdata($post); ?>
              <li class="related_post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
          <?php endforeach; } 
      else { ?>
            <li class="no_related_post">No Related Posts Yet!</li>
    <?php }
  }
  wp_reset_query();
  echo '</ul>';
}

// Numeric Page Navi (aruliden into the theme by default)
function wp_bootstrap_page_navi($before = '', $after = '') {
  global $wpdb, $wp_query;
  $request = $wp_query->request;
  $posts_per_page = intval(get_query_var('posts_per_page'));
  $paged = intval(get_query_var('paged'));
  $numposts = $wp_query->found_posts;
  $max_page = $wp_query->max_num_pages;
  if ( $numposts <= $posts_per_page ) { return; }
  if(empty($paged) || $paged == 0) {
    $paged = 1;
  }
  $pages_to_show = 7;
  $pages_to_show_minus_1 = $pages_to_show-1;
  $half_page_start = floor($pages_to_show_minus_1/2);
  $half_page_end = ceil($pages_to_show_minus_1/2);
  $start_page = $paged - $half_page_start;
  if($start_page <= 0) {
    $start_page = 1;
  }
  $end_page = $paged + $half_page_end;
  if(($end_page - $start_page) != $pages_to_show_minus_1) {
    $end_page = $start_page + $pages_to_show_minus_1;
  }
  if($end_page > $max_page) {
    $start_page = $max_page - $pages_to_show_minus_1;
    $end_page = $max_page;
  }
  if($start_page <= 0) {
    $start_page = 1;
  }
    
  echo $before.'<ul class="pagination">'."";
  if ($paged > 1) {
    $first_page_text = "&laquo";
    echo '<li class="prev"><a href="'.get_pagenum_link().'" title="' . __('First','wpbootstrap') . '">'.$first_page_text.'</a></li>';
  }
    
  $prevposts = get_previous_posts_link( __('&larr; Previous','wpbootstrap') );
  if($prevposts) { echo '<li>' . $prevposts  . '</li>'; }
  else { echo '<li class="disabled"><a href="#">' . __('&larr; Previous','wpbootstrap') . '</a></li>'; }
  
  for($i = $start_page; $i  <= $end_page; $i++) {
    if($i == $paged) {
      echo '<li class="active"><a href="#">'.$i.'</a></li>';
    } else {
      echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
    }
  }
  echo '<li class="">';
  next_posts_link( __('Next &rarr;','wpbootstrap') );
  echo '</li>';
  if ($end_page < $max_page) {
    $last_page_text = "&raquo;";
    echo '<li class="next"><a href="'.get_pagenum_link($max_page).'" title="' . __('Last','wpbootstrap') . '">'.$last_page_text.'</a></li>';
  }
  echo '</ul>'.$after."";
}

// Remove <p> tags from around images
function wp_bootstrap_filter_ptags_on_images( $content ){
  return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
}
add_filter( 'the_content', 'wp_bootstrap_filter_ptags_on_images' );



/** allow upload .svg files */
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');







/** custom post for news **/

function aruliden_news() {

  $labels = array(
    'name'                  => _x( 'News', 'Post Type General Name', 'aruliden' ),
    'singular_name'         => _x( 'News', 'Post Type Singular Name', 'aruliden' ),
    'menu_name'             => __( 'News', 'aruliden' ),
    'name_admin_bar'        => __( 'Post Type', 'aruliden' ),
    'archives'              => __( 'Item Archives', 'aruliden' ),
    'attributes'            => __( 'Item Attributes', 'aruliden' ),
    'parent_item_colon'     => __( 'Parent News:', 'aruliden' ),
    'all_items'             => __( 'All News', 'aruliden' ),
    'add_new_item'          => __( 'Add News', 'aruliden' ),
    'add_new'               => __( 'Add News', 'aruliden' ),
    'new_item'              => __( 'New News', 'aruliden' ),
    'edit_item'             => __( 'Edit News', 'aruliden' ),
    'update_item'           => __( 'Update News', 'aruliden' ),
    'view_item'             => __( 'View News', 'aruliden' ),
    'view_items'            => __( 'View News', 'aruliden' ),
    'search_items'          => __( 'Search News', 'aruliden' ),
    'not_found'             => __( 'Not found', 'aruliden' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'aruliden' ),
    'featured_image'        => __( 'Featured Image', 'aruliden' ),
    'set_featured_image'    => __( 'Set featured image', 'aruliden' ),
    'remove_featured_image' => __( 'Remove featured image', 'aruliden' ),
    'use_featured_image'    => __( 'Use as featured image', 'aruliden' ),
    'insert_into_item'      => __( 'Insert into item', 'aruliden' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'aruliden' ),
    'items_list'            => __( 'Past News list', 'aruliden' ),
    'items_list_navigation' => __( 'Past News list navigation', 'aruliden' ),
    'filter_items_list'     => __( 'Filter items list', 'aruliden' ),
  );
  $args = array(
    'label'                 => __( 'News', 'aruliden' ),
    'description'           => __( 'Post Type Description', 'aruliden' ),
    'labels'                => $labels,
    'rewrite'              => array('slug'=>'aruliden_news'),
    'supports'              => array('title', 'editor', 'thumbnail'),
    'taxonomies'            => array('post_tag'),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 2,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,    
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'aruliden_news', $args );
}
add_action( 'init', 'aruliden_news', 0 );





/** custom post for awards **/

function aruliden_awards() {

  $labels = array(
    'name'                  => _x( 'Awards', 'Post Type General Name', 'aruliden' ),
    'singular_name'         => _x( 'Award', 'Post Type Singular Name', 'aruliden' ),
    'menu_name'             => __( 'Awards', 'aruliden' ),
    'name_admin_bar'        => __( 'Post Type', 'aruliden' ),
    'archives'              => __( 'Item Archives', 'aruliden' ),
    'attributes'            => __( 'Item Attributes', 'aruliden' ),
    'parent_item_colon'     => __( 'Parent Awards:', 'aruliden' ),
    'all_items'             => __( 'All Awards', 'aruliden' ),
    'add_new_item'          => __( 'Add Awards', 'aruliden' ),
    'add_new'               => __( 'Add Award', 'aruliden' ),
    'new_item'              => __( 'New Award', 'aruliden' ),
    'edit_item'             => __( 'Edit Awards', 'aruliden' ),
    'update_item'           => __( 'Update Award', 'aruliden' ),
    'view_item'             => __( 'View Awards', 'aruliden' ),
    'view_items'            => __( 'View Awards', 'aruliden' ),
    'search_items'          => __( 'Search Awards', 'aruliden' ),
    'not_found'             => __( 'Not found', 'aruliden' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'aruliden' ),
    'featured_image'        => __( 'Featured Image', 'aruliden' ),
    'set_featured_image'    => __( 'Set featured image', 'aruliden' ),
    'remove_featured_image' => __( 'Remove featured image', 'aruliden' ),
    'use_featured_image'    => __( 'Use as featured image', 'aruliden' ),
    'insert_into_item'      => __( 'Insert into item', 'aruliden' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'aruliden' ),
    'items_list'            => __( 'Past Awards list', 'aruliden' ),
    'items_list_navigation' => __( 'Past Awards list navigation', 'aruliden' ),
    'filter_items_list'     => __( 'Filter items list', 'aruliden' ),
  );
  $args = array(
    'label'                 => __( 'Awards', 'aruliden' ),
    'description'           => __( 'Post Type Description', 'aruliden' ),
    'labels'                => $labels,
    'rewrite'              => array('slug'=>'aruliden_awards'),
    'supports'              => array('title', 'editor', 'thumbnail'),
    'taxonomies'            => array('post_tag'),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 3,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,    
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'aruliden_awards', $args );
}
add_action( 'init', 'aruliden_awards', 0 );




/** custom post for works **/

function aruliden_works() {

  $labels = array(
    'name'                  => _x( 'Works', 'Post Type General Name', 'aruliden' ),
    'singular_name'         => _x( 'Work', 'Post Type Singular Name', 'aruliden' ),
    'menu_name'             => __( 'Works', 'aruliden' ),
    'name_admin_bar'        => __( 'Post Type', 'aruliden' ),
    'archives'              => __( 'Item Archives', 'aruliden' ),
    'attributes'            => __( 'Item Attributes', 'aruliden' ),
    'parent_item_colon'     => __( 'Parent Work:', 'aruliden' ),
    'all_items'             => __( 'All Works', 'aruliden' ),
    'add_new_item'          => __( 'Add Works', 'aruliden' ),
    'add_new'               => __( 'Add Work', 'aruliden' ),
    'new_item'              => __( 'New Work', 'aruliden' ),
    'edit_item'             => __( 'Edit Works', 'aruliden' ),
    'update_item'           => __( 'Update Work', 'aruliden' ),
    'view_item'             => __( 'View Works', 'aruliden' ),
    'view_items'            => __( 'View Works', 'aruliden' ),
    'search_items'          => __( 'Search Works', 'aruliden' ),
    'not_found'             => __( 'Not found', 'aruliden' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'aruliden' ),
    'featured_image'        => __( 'Featured Image', 'aruliden' ),
    'set_featured_image'    => __( 'Set featured image', 'aruliden' ),
    'remove_featured_image' => __( 'Remove featured image', 'aruliden' ),
    'use_featured_image'    => __( 'Use as featured image', 'aruliden' ),
    'insert_into_item'      => __( 'Insert into item', 'aruliden' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'aruliden' ),
    'items_list'            => __( 'Past Works list', 'aruliden' ),
    'items_list_navigation' => __( 'Past Works list navigation', 'aruliden' ),
    'filter_items_list'     => __( 'Filter items list', 'aruliden' ),
  );
  $args = array(
    'label'                 => __( 'Works', 'aruliden' ),
    'description'           => __( 'Post Type Description', 'aruliden' ),
    'labels'                => $labels,
    'rewrite'              => array('slug'=>'aruliden_works'),
    'supports'              => array('title', 'editor', 'thumbnail'),
    'taxonomies'            => array('post_tag'),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 4,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,    
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'aruliden_works', $args );
}
add_action( 'init', 'aruliden_works', 0 );


/** custom post for services **/

function aruliden_services() {

  $labels = array(
    'name'                  => _x( 'Services', 'Post Type General Name', 'aruliden' ),
    'singular_name'         => _x( 'Services', 'Post Type Singular Name', 'aruliden' ),
    'menu_name'             => __( 'Services', 'aruliden' ),
    'name_admin_bar'        => __( 'Post Type', 'aruliden' ),
    'archives'              => __( 'Item Archives', 'aruliden' ),
    'attributes'            => __( 'Item Attributes', 'aruliden' ),
    'parent_item_colon'     => __( 'Parent Services:', 'aruliden' ),
    'all_items'             => __( 'All Services', 'aruliden' ),
    'add_new_item'          => __( 'Add Services', 'aruliden' ),
    'add_new'               => __( 'Add Services', 'aruliden' ),
    'new_item'              => __( 'New Services', 'aruliden' ),
    'edit_item'             => __( 'Edit Services', 'aruliden' ),
    'update_item'           => __( 'Update Services', 'aruliden' ),
    'view_item'             => __( 'View Services', 'aruliden' ),
    'view_items'            => __( 'View Services', 'aruliden' ),
    'search_items'          => __( 'Search Services', 'aruliden' ),
    'not_found'             => __( 'Not found', 'aruliden' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'aruliden' ),
    'featured_image'        => __( 'Featured Image', 'aruliden' ),
    'set_featured_image'    => __( 'Set featured image', 'aruliden' ),
    'remove_featured_image' => __( 'Remove featured image', 'aruliden' ),
    'use_featured_image'    => __( 'Use as featured image', 'aruliden' ),
    'insert_into_item'      => __( 'Insert into item', 'aruliden' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'aruliden' ),
    'items_list'            => __( 'Past Services list', 'aruliden' ),
    'items_list_navigation' => __( 'Past Services list navigation', 'aruliden' ),
    'filter_items_list'     => __( 'Filter items list', 'aruliden' ),
  );
  $args = array(
    'label'                 => __( 'Services', 'aruliden' ),
    'description'           => __( 'Post Type Description', 'aruliden' ),
    'labels'                => $labels,
    'rewrite'              => array('slug'=>'aruliden_services'),
    'supports'              => array('title', 'editor', 'thumbnail'),
    'taxonomies'            => array('post_tag'),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,    
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'aruliden_services', $args );
}
add_action( 'init', 'aruliden_services', 0 );



/** custom post for select clients **/

function aruliden_clients() {

  $labels = array(
    'name'                  => _x( 'Clients', 'Post Type General Name', 'aruliden' ),
    'singular_name'         => _x( 'Clients', 'Post Type Singular Name', 'aruliden' ),
    'menu_name'             => __( 'Clients', 'aruliden' ),
    'name_admin_bar'        => __( 'Post Type', 'aruliden' ),
    'archives'              => __( 'Item Archives', 'aruliden' ),
    'attributes'            => __( 'Item Attributes', 'aruliden' ),
    'parent_item_colon'     => __( 'Parent Clients:', 'aruliden' ),
    'all_items'             => __( 'All Clients', 'aruliden' ),
    'add_new_item'          => __( 'Add Clients', 'aruliden' ),
    'add_new'               => __( 'Add Clients', 'aruliden' ),
    'new_item'              => __( 'New Clients', 'aruliden' ),
    'edit_item'             => __( 'Edit Clients', 'aruliden' ),
    'update_item'           => __( 'Update Clients', 'aruliden' ),
    'view_item'             => __( 'View Clients', 'aruliden' ),
    'view_items'            => __( 'View Clients', 'aruliden' ),
    'search_items'          => __( 'Search Clients', 'aruliden' ),
    'not_found'             => __( 'Not found', 'aruliden' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'aruliden' ),
    'featured_image'        => __( 'Featured Image', 'aruliden' ),
    'set_featured_image'    => __( 'Set featured image', 'aruliden' ),
    'remove_featured_image' => __( 'Remove featured image', 'aruliden' ),
    'use_featured_image'    => __( 'Use as featured image', 'aruliden' ),
    'insert_into_item'      => __( 'Insert into item', 'aruliden' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'aruliden' ),
    'items_list'            => __( 'Past Clients list', 'aruliden' ),
    'items_list_navigation' => __( 'Past Clients list navigation', 'aruliden' ),
    'filter_items_list'     => __( 'Filter items list', 'aruliden' ),
  );
  $args = array(
    'label'                 => __( 'Clients', 'aruliden' ),
    'description'           => __( 'Post Type Description', 'aruliden' ),
    'labels'                => $labels,
    'rewrite'              => array('slug'=>'aruliden_clients'),
    'supports'              => array('title', 'editor', 'thumbnail'),
    'taxonomies'            => array('post_tag'),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 6,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,    
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'aruliden_clients', $args );
}
add_action( 'init', 'aruliden_clients', 0 );




/** custom post for select clients **/

function aruliden_leadership() {

  $labels = array(
    'name'                  => _x( 'Leadership', 'Post Type General Name', 'aruliden' ),
    'singular_name'         => _x( 'Leadership', 'Post Type Singular Name', 'aruliden' ),
    'menu_name'             => __( 'Leadership', 'aruliden' ),
    'name_admin_bar'        => __( 'Post Type', 'aruliden' ),
    'archives'              => __( 'Item Archives', 'aruliden' ),
    'attributes'            => __( 'Item Attributes', 'aruliden' ),
    'parent_item_colon'     => __( 'Parent Leadership:', 'aruliden' ),
    'all_items'             => __( 'All Leadership', 'aruliden' ),
    'add_new_item'          => __( 'Add Leadership', 'aruliden' ),
    'add_new'               => __( 'Add Leadership', 'aruliden' ),
    'new_item'              => __( 'New Leadership', 'aruliden' ),
    'edit_item'             => __( 'Edit Leadership', 'aruliden' ),
    'update_item'           => __( 'Update Leadership', 'aruliden' ),
    'view_item'             => __( 'View Leadership', 'aruliden' ),
    'view_items'            => __( 'View Leadership', 'aruliden' ),
    'search_items'          => __( 'Search Leadership', 'aruliden' ),
    'not_found'             => __( 'Not found', 'aruliden' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'aruliden' ),
    'featured_image'        => __( 'Featured Image', 'aruliden' ),
    'set_featured_image'    => __( 'Set featured image', 'aruliden' ),
    'remove_featured_image' => __( 'Remove featured image', 'aruliden' ),
    'use_featured_image'    => __( 'Use as featured image', 'aruliden' ),
    'insert_into_item'      => __( 'Insert into item', 'aruliden' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'aruliden' ),
    'items_list'            => __( 'Past Leadership list', 'aruliden' ),
    'items_list_navigation' => __( 'Past Leadership list navigation', 'aruliden' ),
    'filter_items_list'     => __( 'Filter items list', 'aruliden' ),
  );
  $args = array(
    'label'                 => __( 'Leadership', 'aruliden' ),
    'description'           => __( 'Post Type Description', 'aruliden' ),
    'labels'                => $labels,
    'rewrite'              => array('slug'=>'aruliden_leadership'),
    'supports'              => array('title', 'editor', 'thumbnail'),
    'taxonomies'            => array('post_tag'),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 6,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,    
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'aruliden_leadership', $args );
}
add_action( 'init', 'aruliden_leadership', 0 );









/** custom taxonomy for news **/
function custom_taxonomy_news_cat()  {

$labels = array(
    'name'                       => 'News Categories',
    'singular_name'              => 'News',
    'menu_name'                  => 'News Categories',
    'all_items'                  => 'All News',
    'parent_item'                => 'Parent News',
    'parent_item_colon'          => 'Parent News:',
    'new_item_name'              => 'New News',
    'add_new_item'               => 'Add New News',
    'edit_item'                  => 'Edit News',
    'update_item'                => 'Update News',
    'separate_items_with_commas' => 'Separate News with commas',
    'search_items'               => 'Search News',
    'add_or_remove_items'        => 'Add or remove News',
    'choose_from_most_used'      => 'Choose from the most used News Categories',
);
$args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
);
register_taxonomy( 'news_cat', 'aruliden_news', $args );

}
add_action( 'init', 'custom_taxonomy_news_cat', 0 );





/** custom taxonomy for Awards **/
function custom_taxonomy_award_cat()  {

$labels = array(
    'name'                       => 'Award Categories',
    'singular_name'              => 'Award',
    'menu_name'                  => 'Award Categories',
    'all_items'                  => 'All Awards',
    'parent_item'                => 'Parent Award',
    'parent_item_colon'          => 'Parent Award:',
    'new_item_name'              => 'New Award',
    'add_new_item'               => 'Add New Award',
    'edit_item'                  => 'Edit Award',
    'update_item'                => 'Update Award',
    'separate_items_with_commas' => 'Separate Award with commas',
    'search_items'               => 'Search Awards',
    'add_or_remove_items'        => 'Add or remove Award',
    'choose_from_most_used'      => 'Choose from the most used Award Categories',
);
$args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
);
register_taxonomy( 'awards_cat', 'aruliden_awards', $args );

}
add_action( 'init', 'custom_taxonomy_award_cat', 0 );


/** custom taxonomy for Awards **/
function custom_taxonomy_works_cat()  {

$labels = array(
    'name'                       => 'Work Categories',
    'singular_name'              => 'Work',
    'menu_name'                  => 'Work Categories',
    'all_items'                  => 'All Awards',
    'parent_item'                => 'Parent Work',
    'parent_item_colon'          => 'Parent Work:',
    'new_item_name'              => 'New Work',
    'add_new_item'               => 'Add New Work',
    'edit_item'                  => 'Edit Work',
    'update_item'                => 'Update Work',
    'separate_items_with_commas' => 'Separate Work with commas',
    'search_items'               => 'Search Awards',
    'add_or_remove_items'        => 'Add or remove Work',
    'choose_from_most_used'      => 'Choose from the most used Work Categories',
);
$args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
);
register_taxonomy( 'works_cat', 'aruliden_works', $args );

}
add_action( 'init', 'custom_taxonomy_works_cat', 0 );






/** removing posts from dashboard menu **/
function remove_menu () 
{
   remove_menu_page('edit.php');
} 

add_action('admin_menu', 'remove_menu');






/*  Theme settings page
  ------------------------------------------- */

  function theme_settings_page()
  {
      ?>
        <div class="wrap">
        <h1>Social Media Links</h1>
        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php
                settings_fields("section");
                do_settings_sections("theme-options");      
                submit_button(); 
            ?>          
        </form>
      </div>
    <?php
  }

  function display_twitter_element()
  {
    ?>
        <input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" placeholder="https://" />
      <?php
  }
  
  function display_facebook_element()
  {
    ?>
        <input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" placeholder="https://" />
      <?php
  }
  
  function display_instagram_element()
  {
    ?>
        <input type="text" name="instagram_url" id="instagram_url" value="<?php echo get_option('instagram_url'); ?>" placeholder="https://" />
      <?php
  }
  function display_linkedin_element()
  {
    ?>
        <input type="text" name="linkedin_url" id="linkedin_url" value="<?php echo get_option('linkedin_url'); ?>" placeholder="https://" />
      <?php
  }
  function display_pinterest_element()
  {
    ?>
        <input type="text" name="pinterest_url" id="pinterest_url" value="<?php echo get_option('pinterest_url'); ?>" placeholder="https://" />
      <?php
  }
  function display_email_element()
  {
    ?>
        <input type="text" name="email_url" id="email_url" value="<?php echo get_option('email_url'); ?>" placeholder="https://" />
      <?php
  }

  function display_theme_panel_fields()
  {
    add_settings_section("section", "All Settings", null, "theme-options");
    
    add_settings_field("twitter_url", "Twitter Page", "display_twitter_element", "theme-options", "section");
      add_settings_field("facebook_url", "Facebook Page", "display_facebook_element", "theme-options", "section");
      add_settings_field("instagram_url", "Instagram Page", "display_instagram_element", "theme-options", "section");

      add_settings_field("linkedin_url", "Linkedin Page", "display_linkedin_element", "theme-options", "section");
      add_settings_field("pinterest_url", "Pinterest Page", "display_pinterest_element", "theme-options", "section");
      add_settings_field("email_url", "Email", "display_email_element", "theme-options", "section");



  
      register_setting("section", "twitter_url");
      register_setting("section", "facebook_url");
      register_setting("section", "instagram_url");

      register_setting("section", "linkedin_url");
      register_setting("section", "pinterest_url");
      register_setting("section", "email_url");


      register_setting("section", "theme_layout");

  }
  
  add_action("admin_init", "display_theme_panel_fields");



  /*  add to WP menu
  ------------------------------------------- */

  function add_theme_menu_item()
  {
    add_theme_page("Social Media Links", "Social Media Links", "manage_options", "theme-options", "theme_settings_page", null, 99);
  }
  
  add_action("admin_menu", "add_theme_menu_item");








?>


