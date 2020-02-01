<?php
/*
Template Name: 标签页
*/
?>
<?php get_header(); ?>
            <div class="uk-width-small-1-1 uk-width-medium-3-4 uk-width-large-4-5">
            		<div id="index" class="bs">
            		<h1 class="h4"><?php the_title(); ?></h1>
            			<div id="list" class="tag">
            				<p class="date"><strong><?php bloginfo('name'); ?></strong>目前共有标签：  <?php echo $count_tags = wp_count_terms('post_tag'); ?>个  </p>
						    <?php wp_tag_cloud('smallest=14&largest=24&unit=px&number=5000');?>
						</div>
            		</div>
				<div class="ft uk-visible-small">
		        		<p><?php echo of_get('footer');getfoot();?></p>
		        </div>
            </div>
        </div>
<?php get_footer(); ?>