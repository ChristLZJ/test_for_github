<?php get_header(); ?>
            <div class="uk-width-small-1-1 uk-width-medium-3-4 uk-width-large-4-5">
            		<div id="index" class="bs">
            			<article id="article" class="uk-article">
						    <h1 class="uk-article-title"><?php the_title(); ?></h1>
						    <?php 
								while ( have_posts() ) : the_post();
	
								the_content();
			
								endwhile;
							?>
						</article>
						    <?php if ( comments_open() || get_comments_number() ) {?>
							<div id="qzhai_comments">
								<?php comments_template(); ?>
							</div>
							<?php }?>
            		</div>
				<div class="ft uk-visible-small">
		        		<p><?php echo of_get('footer');?></p>
		        </div>
            </div>
        </div>
<?php get_footer(); ?>
