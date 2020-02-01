<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<?php include('includes/seo.php');
		$favicon = of_get('favicon');$app_icon = of_get('app_icon');if(!empty($favicon)){ ?>
		<link rel="icon" type="image/png" href="<?php echo $favicon; ?>">
		<?php } if(!empty($app_icon)){ ?>
		<meta name="mobile-web-app-capable" content="yes">
		<link rel="icon" sizes="192x192" href="<?php echo $app_icon; ?>">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>" />
		<link rel="apple-touch-icon-precomposed" href="<?php echo $app_icon; ?>">
		<?php } ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<?php wp_head(); echo of_get('headtext');?>
		<!-- <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/css/style.css"/> -->
	</head>
	<body>
		<div id="main" class="wp uk-grid uk-grid-collapse">
            <div class="uk-width-small-1-1 uk-width-medium-1-4 uk-width-large-1-5">
        				<div id="head" data-uk-sticky="{boundary: true}">
	            			<div class="uk-panel">
	            				<div class="tx">
	            					<?php if(of_get('avatar') != ''){?>
	            						<img src="<?php echo of_get('avatar');?>" />
            						<?php }else{?>
	            						<img src="<?php echo get_template_directory_uri();?>/img/default.jpg" />
            						<?php }?>
	            				</div>
					   		<h1 class="uk-panel-title"><?php bloginfo('name'); ?></h1>
					    		<span> <?php bloginfo('description'); ?></span>
					    		<div class="my uk-grid-collapse uk-grid uk-grid-width-1-3">
					    			<div>	
					    				<span><?php $count_posts = wp_count_posts(); echo $published_posts =$count_posts->publish;?></span>
					    				<span><i class="uk-icon-file-text"></i></span>
					    				<a href="<?php the_permalink(of_get('page_archive')); ?>" title="文章" data-uk-tooltip="{pos:'bottom'}"></a>
					    			</div>
					    			<div>
					    				<span><?php echo $count_categories = wp_count_terms('category'); ?></span>
					    				<span><i class="uk-icon-folder"></i></span>
					    				<a href="<?php the_permalink(of_get('page_category')); ?>" title="分类" data-uk-tooltip="{pos:'bottom'}"></a>
					    			</div>
					    			<div>
					    				<span><?php echo $count_tags = wp_count_terms('post_tag'); ?></span>
					    				<span><i class="uk-icon-tags"></i></span>
					    				<a href="<?php the_permalink(of_get('page_tag')); ?>" title="标签" data-uk-tooltip="{pos:'bottom'}"></a>					    				
					    			</div>
					    		</div>
					    		<?php
							    if(has_nav_menu('main-menu')) {
								    wp_nav_menu(
							    		array(
							    			'theme_location'=>'main-menu',
							    			'menu_id'=>'nav-top',
							    			'menu_class'=>'uk-nav',
							    			'container'=>'ul',
							    			'walker' => new qzhai_menu(),
							    			'depth'=>'1',
							    			));

								    }else{
								    	echo '<ul class="uk-navbar-nav"><li><a href="#">请在后台主题 - 菜单中 创建一个主菜单并勾选导航菜单</a></li></ul>';
								    }
							    ?>
					    		<form class="uk-form" id="searchform" method="get" action="<?php bloginfo('wpurl'); ?>">
									<input class="uk-width-1-1 <?php if(is_search()) echo 'ace';?>" type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="搜索" />
								</form>
							    	

						</div>
						<div class="ft uk-hidden-small">
				        		<p><?php echo of_get('footer');getfoot();?></p>
				        </div>				
            		</div>
            		
            </div>