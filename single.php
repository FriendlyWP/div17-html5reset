<?php get_header(); ?>

    <div id="articles" class="clearfix">
        
        
    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
            <?php
                // SET UP THUMBNAIL STUFF TO USE WITH POSTS
                if (function_exists('vp_get_thumb_url')) {
                    // Set the desired image size. Swap out 'thumbnail' for 'medium', 'large', or custom size
                    $thumb=vp_get_thumb_url($post->post_content, 'large-feature', true); 
                }
                
                if ($thumb!='') { ?>
                    <img src="<?php echo $thumb; ?>" alt="<?php the_title(); ?>" />
            <?php }?>
    
    		<article <?php post_class('post') ?> id="post-<?php the_ID(); ?>">
    			
    			<h1 class="page-title"><?php the_title(); ?></h1>
                
                <?php if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('<p id="breadcrumbs">','</p>');
        } ?>
    
    			<div class="entry-content">
    				
    				<?php the_content(); ?>
    
    				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
    				
    				<?php the_tags( 'Tags: ', ', ', ''); ?>
    			
    				<?php include (TEMPLATEPATH . '/_/inc/meta.php' ); ?>
    
    			</div>
    			
    		</article>
    
    	<?php //comments_template(); ?>
    
    	<?php endwhile; endif; ?>
    
    </div><!-- #articles -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>