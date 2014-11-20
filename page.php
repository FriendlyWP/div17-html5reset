<?php get_header(); ?>
    
    <div id="articles" class="mmcolumn clearfix">
       
	   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
       
            <?php
                // SET UP THUMBNAIL STUFF TO USE WITH POSTS
                if (function_exists('vp_get_thumb_url')) {
                    // Set the desired image size. Swap out 'thumbnail' for 'medium', 'large', or custom size
                    $thumb=vp_get_thumb_url($post->post_content, 'post-feature', true); 
                }
                
                if ($thumb!='') { ?>
                    <img class="page-feature" src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" />
            <?php }?>
			
    		<article class="post clearfix" id="post-<?php the_ID(); ?>">
    
    			<h2 class="page-title"><?php the_title(); ?></h2>
                
                 <?php if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
                } ?>
                
                <?php 
                    if (get_post_meta($post->ID, "sidebar_content", true)) { ?> 
    			     
                     <div class="entry has-side">
    
    				    <?php the_content(); ?>
                    </div>
                        <div class="page-side">
                                <?php echo wpautop(get_post_meta($post->ID, "sidebar_content", true)); ?>
                        </div>
                    <?php }  else { ?>
                     <div class="entry">
    				    <?php the_content(); ?>
                    </div>
                    <?php } ?>
    			
    
    		</article>

		<?php endwhile; endif; ?>
        
    </div><!-- #articles -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
