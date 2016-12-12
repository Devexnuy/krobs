<?php
/**
 * @package Krobs – Personal Onepage Responsive Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 20-02-2014
 *
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
 
?>
<div <?php post_class('post krobs-post');?>>
<?php if(has_post_thumbnail( )){ ?>
    <div class="post-media">
   
		<a href="<?php the_permalink();?>" class="fadelink">
			<img src="<?php echo esc_url(krobs_thumbnail_url('full') );?>" class="respimg transition" alt="<?php the_title( ); ?>"/>
        </a>

    </div>
<?php } ?>
	
	<div class="post-title">
        <div class=" clearfix"></div>
        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
    </div>

    
    <div class="post-body">
        <?php edit_post_link( __( 'Edit', 'krobs' ), '<span class="edit-link">', '</span>' ); ?>	
		<?php the_content();?>
		<div class="clearfix"></div>
	    <?php
			wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'krobs' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			) );
		?>

    </div>
    <div class="clearfix"></div>
</div>