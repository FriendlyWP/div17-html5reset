<?php get_header(); ?>

    <div id="articles" class="clearfix">
        

    	<?php if (have_posts()) : ?>
    
    		<h2 class="page-title indent">Search Results</h2>
            <?php if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('<p id="breadcrumbs" class="indent">','</p>');
            } ?>
    
    		<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>
    
    		<?php while (have_posts()) : the_post(); ?>  
                <?php $excerpt = get_the_excerpt(); ?>
    
    			<article <?php post_class('post') ?> id="post-<?php the_ID(); ?>">
    
    				<h2 id="post-<?php the_ID(); ?>" class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
    
    				<?php if ( get_post_type() != 'ai1ec_event' ) { 
    						  include (TEMPLATEPATH . '/_/inc/meta.php' );
                    } ?>
    
    				<div class="entry">
    
    					<?php echo string_limit_words($excerpt,35); ?>&hellip;&nbsp;<a class="readmorelink" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">&raquo;&nbsp;Read more</a>
    
    				</div>
    
    			</article>
    
    		<?php endwhile; ?>
    
    		<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>
    
    	<?php else : ?>
    
    		<h2>No posts found.</h2>
    
    	<?php endif; ?>
    
    </div><!-- #articles -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
