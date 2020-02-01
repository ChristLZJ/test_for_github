<?php get_header(); ?>
            <div class="uk-width-small-1-1 uk-width-medium-3-4 uk-width-large-4-5">
            		<div id="index" class="bs">
            			<h4><?php the_search_query(); ?> - 搜索结果</h4>
            			<div id="list">
							<?php
								if (have_posts()) {
									while (have_posts()) {
						            	the_post();
										echo '<article class="article">';
										echo '<h1><a href="';
												the_permalink();
							            echo '" >';
								            	the_title();
							            echo '</a></h1>';

											echo '<p>';
												if (has_post_thumbnail()) {
													echo '<a href="';
						                				the_permalink();
													echo '">';
						                			the_post_thumbnail(array(180, 110, ' uk-overlay-scale'));
													echo '</a>';
												} else {
													if ($images = get_children(array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image'))) {
									                    echo '<a href="';
									                    	the_permalink();
									                    echo '">';
									                    $image = current($images);
									                    $image = wp_get_attachment_image_src($image->ID, array(180, 100));
									                    echo '<img src="' . $image[0] . '"  />';
									                    echo '</a>';
									                }
												}
											$content = get_the_content();
							            	$trimmed_content = wp_trim_words($content, 120, '...');
							            	echo $trimmed_content;
								            echo '<time><br>';
				            						the_time('Y年n月j日');	
								            echo '</time>';
											echo '</p>';
											echo '</article>';
		
									}
								} else {
						    		echo '<p class="_404">没发现什么...</p>';
							    }
								?>
            			</div>
            		</div>
					<ul class="uk-pagination">
					    <?php par_pagenavi(); ?>
					</ul>
				<div class="ft uk-visible-small">
		        		<p><?php echo of_get('footer');getfoot();?></p>
		        </div>
            </div>
        </div>
<?php get_footer(); ?>
