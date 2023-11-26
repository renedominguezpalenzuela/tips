<?php
require_once(get_template_directory() . '/config/MyApp.php');

$app = new MyApp;
$app->init();

function mytheme_comment($comment, $args, $depth)
{
    if ( 'div' === $args['style'] )
    {
        $tag       = 'div';
        $add_below = 'comment';
    }
    else
    {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>

    <li class="list-group-item border-0 <?php echo empty( $args['has_children'] ) ? '' : 'parent'; ?>" id="comment-<?php comment_ID() ?>">
	    <?php 
		    if ( 'div' != $args['style'] )
		    {
		    	?>
		        	<div id="div-comment-<?php comment_ID() ?>" class="comment-body mt-3">
		    	<?php
		    }
	    ?>
        <div class="row px-3">
        	<div class="col-md-1 g-0">
	        	<?php 
		            if ( $args['avatar_size'] != 0 )
		            {
		            	$userFoto = get_user_meta( $comment->user_id, 'user_foto', true );
		            	if($userFoto == '')
		            		$userFoto = get_template_directory_uri() . '/public/images/avatar-default.png';

		            	echo '<img src="' . $userFoto . '" class="comment_avatar img-fluid rounded-circle d-block mx-auto">';
		            }
		        ?>
		    </div>
        	<div class="col-md-11 py-1">
        		<span class="comment_name">
			        <?php 
			            echo get_user_meta( $comment->user_id, 'first_name', true );
			        ?>
			    </span>
        		<span class="comment_content row">
        			<div class="col-10">
				        <?php comment_text(); ?>
				    </div>
				    <div class="col-2">
				    	<?php comments_like_dislike($comment->comment_ID);?>
				    </div>
			        <?php 
				        if ( $comment->comment_approved == '0' )
				        {
				        	?>
					            <em class="comment-awaiting-moderation">
					            	<?php _e( 'Your comment is awaiting moderation.' ); ?>
					            </em>
				            <?php 
			        	}
		        	?>
		        </span>
		        <div class="comment-meta commentmetadata">
		            <?php edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
		        </div>


        <div class="reply comment_reply"><?php 
                comment_reply_link( 
                    array_merge( 
                        $args, 
                        array( 
                            'add_below' => $add_below, 
                            'depth'     => $depth, 
                            'max_depth' => $args['max_depth'] 
                        ) 
                    ) 
                ); ?>
        </div><?php 
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}
?>