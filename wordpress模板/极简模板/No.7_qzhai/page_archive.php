<?php
/*
Template Name: 日志存档
*/
?>
<?php get_header(); ?>
            <div class="uk-width-small-1-1 uk-width-medium-3-4 uk-width-large-4-5">
            		<div id="index" class="bs">
						    <h1 class="h4"><?php the_title(); ?></h1>
            			<div id="list">
        					<p class="date"><strong><?php bloginfo('name'); ?></strong>目前共有文章：  <?php echo $hacklog_archives->PostCount();?>篇  </p>
    						<?php echo $hacklog_archives->PostList();?>
						</div>
            		</div>
				<div class="ft uk-visible-small">
		        		<p><?php echo of_get('footer');getfoot();?></p>
		        </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('.car-collapse').find('.car-monthlisting').hide();
                jQuery('.car-collapse').find('.car-monthlisting:first').show();
                jQuery('.car-collapse').find('.car-yearmonth').click(function() {
                    jQuery(this).parent('div').next('ul').slideToggle('fast');
              
                });
                jQuery('.car-collapse').find('.car-toggler').click(function() {
                    if ( '展开所有月份' == jQuery(this).text() ) {
                        jQuery(this).parent('.car-container').find('.car-monthlisting').show();
                        jQuery(this).text('折叠所有月份');
                    }
                    else {
                        jQuery(this).parent('.car-container').find('.car-monthlisting').hide();
                        jQuery(this).text('展开所有月份');
                    }
                    return false;
                });
            });
		</script>

<?php get_footer(); ?>
