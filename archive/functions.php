<?php
// ADD CUSTOM BACKGROUND
add_theme_support( 'custom-background', array(
	// Background color default
	'default-color' => 'fff',
	// Background image default
	'default-image' => get_template_directory_uri() . '/_/images/subtlenet2.png'
) );



	
// ENQUEUE STYLESHEET AND FLEXSLIDER
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_front_page_scripts' );    
function mytheme_enqueue_front_page_scripts() {
   if (is_front_page() || is_home()) {
            // REGISTER AND ENQUEUE FLEXSLIDER JS AND CSS 
               wp_register_script('flexslider',
                   get_stylesheet_directory_uri() . '/_/js/flexslider/jquery.flexslider-min.js',
                   array('jquery'),'',true );
                   
               wp_enqueue_script( 'flexslider');
               
               wp_register_style( 'flexslider_css',
                    get_stylesheet_directory_uri() . '/_/js/flexslider/flexslider.css','','',true);
               
               wp_enqueue_style( 'flexslider_css');
               
              
            
       } 

       if (!is_admin()) {

                //ENQUEUE MMENU FILE IN FOOTER
               wp_enqueue_script( 'mmenu',get_bloginfo('template_directory') . '/_/js/mmenu/src/js/jquery.mmenu.min.js',array('jquery'),false,false );
              
              wp_enqueue_style('mmenu-style', get_bloginfo('template_directory') . '/_/js/mmenu/src/css/jquery.mmenu.css');   
       
                //ENQUEUE LOCAL FUNCTIONS FILE IN FOOTER
               wp_enqueue_script( 'my_functions',get_bloginfo('template_directory') . '/_/js/functions.js',array('jquery'),false,false );

                wp_enqueue_style( 'fontawesome','//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
               
                $data = array( 'my_home_url' => __( home_url() ) );
                wp_localize_script( 'my_functions', 'my_home_object', $data );
                
                // REGISTER AND ENQUEUE PREFIX FREE SHIM
                wp_register_script('prefixfree',
                   get_bloginfo('template_directory') . '/_/js/prefixfree.js');
                   
                wp_enqueue_script( 'prefixfree','','',true );

               //wp_enqueue_script('fonts', 'http://fast.fonts.net/jsapi/28024eeb-b256-4d05-ad27-214d6ef74cdf.js');
                   
            wp_register_style( 'theme_stylesheet',
                    get_stylesheet_uri(),'','','');
               
               wp_enqueue_style( 'theme_stylesheet','','','','');
       }
}
    
add_action( 'widgets_init', 'bones_register_sidebars' );
function bones_register_sidebars() {
  register_sidebar(array(
    'name' => 'Sidebar Widgets',
    'id'   => 'sidebar-widgets',
    'description'   => 'These are widgets for the sidebar.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>'
  ));
    register_sidebar(array(
    'name' => 'Home Page Widgets',
    'id'   => 'home-widgets',
    'description'   => 'These are widgets for the home page.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>'
  ));
    register_sidebar(array(
    'name' => 'Specific Page Widgets',
    'id'   => 'page-widgets',
    'description'   => 'These are widgets for specific pages on the site.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2>',
    'after_title'   => '</h2>'
  ));
}  
    // add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video')); // Add 3.1 post format theme support.
    
    add_theme_support( 'post-thumbnails');
    
    // Add featured image size for home feature
    add_image_size( 'post-feature', 979, 370, true );
    add_image_size( 'home-thumb', 233, 175, true );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
    
    // This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
        'footer' => __( 'Footer Navigation', 'twentyten' ),
	) );

// ENABLE SHORTCODES IN ALL TEXT WIDGETS
add_filter('widget_text', 'do_shortcode');

// REMOVE THE EXTRA WIDTH ADDED TO WP-CAPTION
//add_shortcode('wp_caption', 'slim_img_caption_shortcode');
//add_shortcode('caption', 'slim_img_caption_shortcode');
function slim_img_caption_shortcode($attr, $content = null) {
 // Allow plugins/themes to override the default caption template.
     $output = apply_filters('img_caption_shortcode', '', $attr, $content);
     if ( $output != '' )
     return $output;
     
     extract(shortcode_atts(array(
     'id'    => '',
     'align'    => 'alignnone',
     'width'    => '',
     'caption' => ''
     ), $attr));
     
     if ( 1 > (int) $width || empty($caption) )
     return $content;
     
     if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
     
     $frame_width = 0; // frame width in pixels per side //
     
     return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . ( 2 * $frame_width + (int) $width) . 'px">'
     . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

if (class_exists('MultiPostThumbnails')) {
        new MultiPostThumbnails(
            array(
                'label' => 'Home Thumb Image',
                'id' => 'home-thumb-image',
                'post_type' => 'post'
            )
        );
    }

//HELPER FUNCTION FOR GAVSIU RECENT POSTS, ALSO REMOVES ALL IMG DIMENSIONS
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
// Removes attached image sizes as well
add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

add_shortcode( 'recent_posts', 'gavsiu_recent_posts' );
function gavsiu_recent_posts( $atts ) {
    extract( shortcode_atts( array(
        'cat'            => 1,
        'num_posts'      => 3,
        'words'         => 14
    ), $atts ) );

    $recent_posts = get_posts( array(
        'category'       => "{$cat}",
        'numberposts'    => "{$num_posts}",
        'offset' => 0
    ) );
    foreach($recent_posts as $post) : setup_postdata($post);
        $excerpt = get_the_excerpt();
        $link = esc_url( get_permalink( $post->ID ) );
        $permalink = ' <a class="readmore" href="'. esc_url( get_permalink( $post->ID ) ) . '" title="' . esc_attr( $post->post_title ) . '" rel="bookmark">' . __( 'Read more' ) . '</a>';
        $readall = ' <a class="readall" href="' . home_url('/news') . '">Read all News</a>';       
        $custom = MultiPostThumbnails::get_post_thumbnail_id('post', 'home-thumb-image', $post->ID);
        $custom=wp_get_attachment_image_src($custom, 'home-thumb');
        $return = '<a class="news-img" href="' . $link . '" title="' . $post->post_title . '"><img src="' . $custom[0] . '" /></a>';
        $return .= '<h3><a class="newstitle" href="' . $link . '">' . $post->post_title . "</a></h3>\n";
        $return .= '<p>' . string_limit_words($excerpt,$words) . '&nbsp;&hellip;</p>' . $permalink . $readall . "\n";
        
        return $return;
    endforeach;
}

add_shortcode( 'home_content', 'mkm_home_content' );
function mkm_home_content() {
    $content = get_the_content();
    return wpautop(do_shortcode($content));
}



// Note that your theme must support post thumbnails for this function to work. 
// If you are getting an error try adding add_theme_support('post-thumbnails'); to your functions. php file 
// NOTE: If $feature is set to true, the image will only be returned if it is set as a featured image.
function vp_get_thumb_url($text, $size, $feature = false){
    global $post;
    $imageurl="";
    
    // Check to see which image is set as "Featured Image"
    $featuredimg = get_post_thumbnail_id($post->ID);
    // Get source for featured image
    $img_src = wp_get_attachment_image_src($featuredimg, $size);
    // Set $imageurl to Featured Image
    $imageurl=$img_src[0];
    
    if ($feature == false) {
    
    // If there is no "Featured Image" set, move on and get the first image attached to the post
    if (!$imageurl) {
        // Extract the thumbnail from the first attached imaged
        $allimages =&get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );
        
        foreach ($allimages as $img){
            $img_src = wp_get_attachment_image_src($img->ID, $size);
            break;
        }
        // Set $imageurl to first attached image
        $imageurl=$img_src[0];
    }
    
    // If there is no image attached to the post, look for anything that looks like an image and get that
    if (!$imageurl) {
        preg_match('/<\s*img [^\>]*src\s*=\s*[\""\']?([^\""\'>]*)/i' , $text, $matches);
        $imageurl=$matches[1];
    }
    
    // If there's no image attached or inserted in the post, look for a YouTube video
    if (!$imageurl){
        // look for traditional youtube.com url from address bar
        preg_match("/([a-zA-Z0-9\-\_]+\.|)youtube\.com\/watch(\?v\=|\/v\/)([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $text, $matches2);
        $youtubeurl = $matches2[0];
        $videokey = $matches2[3];
    if (!$youtubeurl) {
        // look for youtu.be 'embed' url
        preg_match("/([a-zA-Z0-9\-\_]+\.|)youtu\.be\/([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $text, $matches2);
        $youtubeurl = $matches2[0];
        $videokey = $matches2[2];
    }
    if ($youtubeurl)
        // Get the thumbnail YouTube automatically generates
        // '0' is the biggest version, use 1 2 or 3 for smaller versions
        $imageurl = "http://i.ytimg.com/vi/{$videokey}/0.jpg";
    }
    
    }
    
    // Spit out the image path
    return $imageurl;
}

// ADD ODD/EVEN FUNCTIONALITY TO WIDGETIZED SIDEBAR
add_filter('dynamic_sidebar_params','custom_widget_counter');
function custom_widget_counter($params) {

	global $my_widget_num;
    $my_widget_num == 1;
	$my_widget_num++;
	$class = 'class="widget-' . $my_widget_num . ' ';

	if($my_widget_num % 2) :
		$class .= 'widget-odd ';
	else :
		$class .= 'widget-even ';
	endif;

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']);

	return $params;
}

// LIMIT WORDS IN EXCERPTS
function string_limit_words($string, $word_limit) {
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

// REMOVE WIDGET TITLE IF IT BEGINS WITH EXCLAMATION POINT
add_filter( 'widget_title', 'remove_widget_title' );
function remove_widget_title( $widget_title ) {
	if ( substr ( $widget_title, 0, 1 ) == '!' )
		return;
	else 
		return ( $widget_title );
}

// REMOVE EMPTY PARAGRAPH TAGS
add_filter('the_content', 'remove_empty_p', 20, 1);
function remove_empty_p($content){
    $content = force_balance_tags($content);
    return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
}

// Add the function to the save_post hook so it runs when posts are published
add_action( 'save_post', 'home_features_delete_transient' );
function home_features_delete_transient() {
     delete_transient( 'features' );
}

?>