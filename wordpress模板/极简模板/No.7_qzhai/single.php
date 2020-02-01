<?php get_header(); ?>
            <div class="uk-width-small-1-1 uk-width-medium-3-4 uk-width-large-4-5">
            		<div id="index" class="bs">
            			<article id="article" class="uk-article">
						    <h1 class="uk-article-title"><?php the_title(); ?>	</h1>
						    <time class="uk-article-meta"><i class="uk-icon-calendar"></i><?php the_time('Y-m-d'); ?></time>
						    <?php 
								while ( have_posts() ) : the_post();
	
								the_content();
			
								endwhile;
							?>
							<div class="tags uk-clearfix">
								<div class="tags uk-float-left"><?php the_tags('<i class="uk-icon-tags"></i> ',',',''); ?></div>				
								<div class="uk-float-right"><?php echo of_get('share');?></div>					
							</div>
							
						</article>
						    <?php if ( comments_open() || get_comments_number() ) {?>
							<div id="qzhai_comments">
								<?php comments_template(); ?>
							</div>
							<?php }?>	
						

            		</div>
				<div class="ft uk-visible-small">
		        		<p><?php echo of_get('footer');getfoot();?></p>
		        </div>
            </div>
        </div>
<?php get_footer(); ?>
