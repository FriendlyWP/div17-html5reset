<?php get_header(); ?>

    <div id="articles" class="clearfix">
        
    		<?php if (have_posts()) : ?>
    
     			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
    
    			<?php /* If this is a category archive */ if (is_category()) { ?>
    				<h2 class="page-title indent"><?php single_cat_title(); ?></h2>
                    
                 <?php /* If this is a post type archive */ } elseif (is_post_type_archive()) { ?>
    				<h2 class="page-title indent"><?php post_type_archive_title(); ?></h2>
    
    			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
    				<h2 class="page-title indent">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
    
    			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
    				<h2 class="page-title indent">Archive for <?php the_time('F jS, Y'); ?></h2>
    
    			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
    				<h2 class="page-title indent">Archive for <?php the_time('F, Y'); ?></h2>
    
    			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
    				<h2 class="page-title indent">Archive for <?php the_time('Y'); ?></h2>
    
    			<?php /* If this is an author archive */ } elseif (is_author()) { 
    			     $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
                    
    				<h2 class="page-title indent"><?php echo $curauth->display_name; ?></h2>
                    <?php if ($curauth->user_description) { ?>
                        <h3>About</h3>
                        <?php echo wpautop($curauth->user_description); ?>
                    <?php } ?>
    
    			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    				<h2 class="page-title indent">Blog Archives</h2>
    			
    			<?php } ?>
                
                <?php if ( function_exists('yoast_breadcrumb') ) {
                                yoast_breadcrumb('<p id="breadcrumbs" class="indent">','</p>');
                            } ?>
    
    			<?php //include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>
    
    			<?php while (have_posts()) : the_post(); ?>
    			     <?php $excerpt = get_the_excerpt(); ?>
                     <?php
                            // SET UP THUMBNAIL STUFF TO USE WITH POSTS
                            if (function_exists('vp_get_thumb_url')) {
                                // Set the desired image size. Swap out 'thumbnail' for 'medium', 'large', or custom size
                                $thumb=vp_get_thumb_url($post->post_content, 'thumbnail'); 
                            }
                            ?>
    				<article <?php post_class('clearfix post') ?>>
                    
                            <?php if ($thumb!='') { ?>
                                        <a class="alignleft" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><img src="<?php echo $thumb; ?>" alt="<?php get_the_title(); ?>" /></a>
                                    <?php } ?>
    				
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
    
    		<h2>Nothing found</h2>
    
    	<?php endif; ?>
    
    </div><!-- #articles -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>