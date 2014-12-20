<?php
/*
Template Name: Home Page
*/
?>
<?php get_header(); ?>
    
    <div id="articles" class="mmcolumn clearfix">
        
                <script type="text/javascript" language="javascript">
                    jQuery(document).ready(function($) {
                        $('.flexslider').flexslider({
                          animation: "slide",
                          slideshowSpeed: 6000,
                          controlsContainer: ".flex-container"
                    });
                });
                </script>
	   <?php    //remove_all_filters('posts_orderby', 1);
        $features = new WP_Query( 'category_name=home-slideshow&posts_per_page=30&orderby=rand&order=ASC&post-status=publish' );
        
        // Get any existing copy of our transient data
        if ( false === ( $features = get_transient( 'features' ) ) ) {
            // It wasn't there, so regenerate the data and save the transient
             $features = new WP_Query( 'category_name=home-slideshow&posts_per_page=10&orderby=rand&order=ASC&post-status=publish' );
             set_transient( 'features', $features, 60*5*1 );
        }
               // query_posts(array('orderby' => 'rand', 'category_name' => 'home-slideshow', 'showposts' => 1)) 
               ?>
        <div class="flexslider">
            <ul class="slides">
            <?php while($features->have_posts()) : $features->the_post(); ?>
                <?php
                // SET UP THUMBNAIL STUFF TO USE WITH POSTS
                if (function_exists('vp_get_thumb_url')) {
                    // Set the desired image size. Swap out 'thumbnail' for 'medium', 'large', or custom size
                    $thumb=vp_get_thumb_url($post->post_content, 'post-feature', true); 
                }
                ?>
                <?php $excerpt = get_the_excerpt(); ?>
                <li>
                    <?php 
                    if ( !get_field('hide_text') ) { ?>
                    <div class="copy">
                        <div class="text">
                        <h2><?php the_title(); ?></h2>
                        <?php echo string_limit_words($excerpt,15); ?><?php if ( !get_field('link_slideshow_image') ) { ?>&hellip;&nbsp;<a class="readmorelink" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">&raquo;&nbsp;Read more</a><?php } ?>
                        </div><!-- .text -->
                    </div><!-- .copy -->
                    <?php  } ?>
                    <div class="img">
                        <?php if ($thumb!='') { ?>
                            <?php if ( !get_field('link_slideshow_image') ) { ?>
                            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php } ?><img src="<?php echo $thumb; ?>" alt="<?php get_the_title(); ?>" /><?php if ( !get_field('link_slideshow_image') ) { ?></a><?php } ?>
                        <?php } ?>
                    </div><!-- .img -->
                </li>
            <?php endwhile;

            // Reset Query
           // wp_reset_query();
            //rewind_posts();
            ?>
            </ul><!-- .slider -->
        </div><!-- .flexslider -->
        
        
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
         <article class="post homecopy" id="post-<?php the_ID(); ?>">
    
    			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Home Page Widgets')) : else : ?>
                
                
            <?php endif; ?>
       </article>
    		

		<?php endwhile; endif; ?>
        
        
        
    </div><!-- #articles -->


<?php get_sidebar(); ?>

<?php get_footer(); ?>