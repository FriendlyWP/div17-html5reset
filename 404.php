<?php get_header(); ?>
    
    <div id="articles" class="clearfix">
        
        
        <article class="post" id="post-<?php the_ID(); ?>">
        
	       <h2 class="page-title">Sorry - Page Not Found!</h2>
           
           <?php if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb('<p id="breadcrumbs">','</p>');
        } ?>
           
           Try searching our site for the content you're looking for. If you're trying to find member-only content, please log in first, then try again.
           
           <?php echo do_shortcode('[list-pages sort_column="menu_order,post_title" exclude="209"]'); ?>
           
           <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Specific Page Widgets')) : else : ?>
           <?php endif; ?>
            
        </article>

    </div><!-- #articles -->
    
<?php get_sidebar(); ?>

<?php get_footer(); ?>