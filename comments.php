<?php
/**
 * @package Krobs – Personal Onepage Responsive Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 20-02-2014
 *
 * @copyright  Copyright ( C ) 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

if ( post_password_required() )
    return;
?>

<!--comment section-->
<div id="comments">
<!--title-->
<?php if ( have_comments() ) : ?>
    <h6 id="comments-title"><?php printf(__('Comments <span>( %d )</span>','krobs'),number_format_i18n( get_comments_number() ));?></h6>
    <ul class="commentlist">
        <?php 

		$args = array(
			'walker'            => null,
			'max_depth'         => '',
			'style'             => 'ul',
			'callback'          => 'krobs_theme_comment',
			'end-callback'      => null,
			'type'              => 'all',
			'reply_text'        => __('Reply','krobs'),
			'page'              => '',
			'per_page'          => '',
			'avatar_size'       => 50,
			'reverse_top_level' => null,
			'reverse_children'  => '',
			'format'            => 'html5', //or xhtml if no HTML5 theme support
			'short_ping'        => false, // @since 3.6,
		    'echo'     			=> true, // boolean, default is true
		);
		?>

		<?php wp_list_comments($args);?>

    </ul>
    <div class="clearfix"></div>
<?php endif;?>

<?php
// Are there comments to navigate through?
if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<ul class="pager">
		<li class="previous"><?php previous_comments_link( __( '<i class="fa fa-arrow-left"></i> Previous', 'krobs' ) ); ?></li>
		<li class="next"><?php next_comments_link( __( 'Next <i class="fa fa-arrow-right"></i>', 'krobs' ) ); ?></li>
	</ul>
<?php endif; // Check for comment navigation ?>


<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
	<p class="no-comments"><?php _e( 'Comments are closed.', 'krobs' ); ?></p>
<?php endif; ?>

<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$required_text = __(' Your name and email address are required','krobs');

	$fields =  array(

	  	'author' =>'<div class="comment-form-author control-group">
                        <div class="controls">
                            <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" size="40"' . $aria_req . ' />
                        </div>
                        <label class="control-label" for="author">' .( $req ? __( 'Name * ', 'krobs' ) : __( 'Name ', 'krobs' ) )  . '</label>
                    </div>',

	  	'email' =>'<div class="comment-form-email control-group">
                        <div class="controls">
                            <input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="40"' . $aria_req . ' />
                        </div>
                        <label class="control-label" for="email">'.( $req ?  __( 'Email * ', 'krobs' ) :  __( 'Email', 'krobs' ) ).'</label>
                    </div>',

	  	'url' =>'<div class="comment-form-url control-group">
                        <div class="controls">
                            <input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .'" size="40" />
                        </div>
                        <label class="control-label" for="url">'. __( 'Website', 'krobs' ).'</label>
                    </div>',
	);
	

	$args = array(
	  	'id_form'           => 'commentform',
	  	'id_submit'         => 'submit',
	  	'class_submit'      => 'btn btn-success transition button',
	  	'name_submit'       => 'submit',
	  	'title_reply'       => __( 'Leave a Reply','krobs' ),
	  	'title_reply_to'    => __( 'Leave a Reply to %s' ,'krobs'),
	  	'cancel_reply_link' => __( 'Cancel Reply' ,'krobs'),
	  	'label_submit'      => __( 'Post Comment' ,'krobs'),
	  	'format'            => 'html5',//xhtml

	  	'comment_field' =>  '<div class="comment-form-comment control-group">
                                <div class="controls">
                                	<textarea id="comment" name="comment" cols="50" rows="8" aria-required="true" placeholder="'.__('Your comment here..','krobs').'"></textarea>
                                </div>
                            </div>',

	  	'must_log_in' => '<p class="must-log-in">' .
	    	sprintf(
	      		__( 'You must be <a href="%s">logged in</a> to post a comment.' ,'krobs'),
	      		wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
	    	) . '</p>',

  		'logged_in_as' => '<p class="logged-in-as">' .
    		sprintf(
			    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ,'krobs'),
			      admin_url( 'profile.php' ),
			      $user_identity,
			      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
			    ) . '</p>',

		'comment_notes_before' => '<p class="comment-notes">' .
		    __( 'Your email address will not be published.' ,'krobs') . ( $req ? $required_text : '' ) .
		    '</p>',

		'comment_notes_after' => '<p class="form-allowed-tags">' .
		    sprintf(
		      __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ,'krobs'),
		      ' <code>' . allowed_tags() . '</code>'
		    ) . '</p>',

	  	'fields' => apply_filters( 'comment_form_default_fields', $fields ),
	);

?>
<?php comment_form($args); ?>
    <!--end respond-->
</div>
