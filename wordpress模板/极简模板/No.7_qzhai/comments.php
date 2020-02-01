<?php
    if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        return;
    if ( post_password_required() ) { ?>
        <h4>评论</h4>
    	<div class="uk-alert" >
			<p class="nocomments"><?php _e('必须输入密码，才能查看评论！'); ?></p>
		</div>
	<?php
		return;
	}

    if (!empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { 
        // if there's a password
        // and it doesn't match the cookie
    ?>
        <h4>评论</h4>
    	<div class="uk-alert" >
        	<p>请输入密码再查看评论内容.</p>
        </div>

    <?php 
        } else if ( !comments_open() ) {
    ?>
  		<div class="uk-alert">
        	<p>评论功能已经关闭!</p>
        </div>

    <?php 
        } else if ( !have_comments() ) { 
    ?>
        <h4>评论</h4>
    	<div class="uk-alert">
        	<p>还没有任何评论，你来说两句吧</p>
    	</div>
 
    <?php 
        } else {
            echo '<h4>评论</h4>';
        	echo '<ul id="comments" class="uk-comment-list">';
                wp_list_comments('type=comment&callback=aurelius_comment');
            echo '</ul>';
	        echo '<ul class="uk-pagination">';
			echo '<li class="uk-pagination-previous">';
			     previous_comments_link();
			echo '</li>';
			echo '<li class="uk-pagination-next">';
			     next_comments_link();
			echo '</li>';
			echo '</ul>';
        }

    ?>
	<?php if ( !comments_open() ) : elseif ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
        <div class="uk-alert" data-uk-alert>
            <a href="" class="uk-alert-close uk-close"></a>
            <p>你必须 <a href="<?php echo wp_login_url( get_permalink() ); ?>">登录</a> 才能发表评论.</p>
        </div>
    <?php else  : ?>
    <div id="respond" class="comment_form" role="form">
                <h2 id="reply-title" class="comments-title"><?php comment_form_title( '发表评论 ', '回复给 %s' ); ?> <small>
                        <?php cancel_comment_reply_link(); ?>
                    </small></h2>
                <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
                    <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
                <?php else : ?>
                    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="uk-form" id="commentform">
                        <?php if ( $user_ID ) : ?>
                            <p style="margin-bottom:10px">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>&nbsp;|&nbsp;<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
                            <textarea id="comment" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};" placeholder="内容..." tabindex="1" name="comment"></textarea>
                            <div style="">
                                <button name="submit" type="submit" id="submit" class="uk-button uk-width-1-1" tabindex="5"/>回复</button>
                        <p></p>
                            </div>
                            
                        <?php else : ?>
                            <textarea id="comment" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};" placeholder="内容..." tabindex="1" name="comment"></textarea>
                            <div class="text uk-grid uk-grid-small">
                                
                                <div class="uk-width-medium-1-4 uk-form-icon">
                                    <i class="uk-icon-user"></i>
                                    <input id="author" type="text" tabindex="2" value="<?php echo $comment_author; ?>" name="author"  placeholder="昵称*" class="uk-width-1-1">
                                </div>
                                <div class=" uk-width-medium-1-4 uk-form-icon">
                                    <i class="uk-icon-envelope"></i>
                                    <input id="email" type="text" tabindex="3" value="<?php echo $comment_author_email; ?>" name="email" placeholder="邮箱*" class="uk-width-1-1">
                                </div>
                                <div class="uk-width-medium-1-4 uk-form-icon">
                                    <i class="uk-icon-laptop"></i>
                                    <input id="url" type="text" tabindex="4" value="<?php echo $comment_author_url; ?>" name="url" placeholder="网址" class="uk-width-1-1">
                                </div>
                                <div class="uk-width-medium-1-4">
                                    <button name="submit" type="submit" id="submit" class="uk-button uk-width-1-1" tabindex="5"/>回复</button>
                                </div>
                                
                            </div>
                        <?php endif; ?>
                            <script type="text/javascript">
                            $('#submit').click(function(){
                                $('#comment').focus(function(){
                                    $(this).removeClass('uk-form-danger');
                                    $('#comment').attr('placeholder','内容...');
                                })
                                $('#author').focus(function(){
                                    $(this).removeClass('uk-form-danger');
                                    $(this).attr('placeholder','昵称*');
                                })
                                $('#email').focus(function(){
                                    $(this).removeClass('uk-form-danger');
                                    $(this).attr('placeholder','邮箱*');
                                })
                                if($('#comment').val() == ""){
                                    $('#comment').addClass('uk-form-danger');
                                    $('#comment').attr('placeholder','内容不能为空');
                                    return false;
                                }
                                if($('#author').val() == ""){
                                    $('#author').addClass('uk-form-danger');
                                    $('#author').attr('placeholder','昵称不能为空');
                                    return false;
                                }
                                if($('#email').val() == ""){
                                    $('#email').addClass('uk-form-danger');
                                    $('#email').attr('placeholder','邮箱不能为空');
                                    return false;
                                }
                            });
                            $('article.uk-comment').mousemove(function(){
                                $(this).children('h6').children('span').show();
                            }).mouseout(function(){
                                $(this).children('h6').children('span').hide();
                            })
                            </script>
                        <?php comment_id_fields(); ?>
                        <?php do_action('comment_form', $post->ID); ?>
                    </form>
                <?php endif; ?>
            </div>
    </form>
<?php endif; ?>
	<!-- Comment Form -->
