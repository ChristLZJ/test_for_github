<section id="section-portfolio" class="section section-portfolio">
	<div class="container">
		<header class="section-header">
			<div class="row"><div class="col-md-8 col-md-offset-2"><h2 class="section-title"><?php echo dw_resume_get_theme_option( 'portfolio_title', 'Portfolio' ); ?></</h2></div></div>
		</header>
		<div class="section-content">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<?php echo dw_resume_get_theme_option( 'portfolio_des', '<p>Phasellus mollis tempor orci. Vivamus convallis rutrum ullamcorper. Sed sed pulvinar arcu, a malesuada augue. Aenean felis nulla, varius ut augue eu, sodales luctus nunc. In malesuada ullamcorper libero a consequat.</p>' ); ?>
				</div>
			</div>
			<?php if( ! dw_resume_get_theme_option( 'hide_portfolios' ) ) : ?>
			<div class="projects">
				<div class="row">
			<?php $items = dw_resume_get_repeat_field('portfolio_item'); ?>
			<?php if ( ! empty( $items ) ) : ?>

					<?php
					$item = '';
					foreach ( $items as $key => $value ) {
						$item .= '<div class="col-xs-6 col-md-4"><div class="project"><a href="'.$value['link'].'"><img src="'.$value['image']['url'].'"></a></div></div>';
					}
					echo $item;
					?>
					<div class="col-xs-12 col-md-8 col-md-offset-2"><a href="javascript:void(0)" id="loadmore" class="btn btn-lg btn-block btn-default">Show more works</a></div>

			<?php else: ?>
					<div class="col-xs-6 col-md-4"><div class="project"><a href="#"><img src="http://placehold.it/352x352/"></a></div></div>
					<div class="col-xs-6 col-md-4"><div class="project"><a href="#"><img src="http://placehold.it/352x352/"></a></div></div>
					<div class="col-xs-6 col-md-4"><div class="project"><a href="#"><img src="http://placehold.it/352x352/"></a></div></div>
					<div class="col-xs-6 col-md-4"><div class="project"><a href="#"><img src="http://placehold.it/352x352/"></a></div></div>
					<div class="col-xs-6 col-md-4"><div class="project"><a href="#"><img src="http://placehold.it/352x352/"></a></div></div>
					<div class="col-xs-6 col-md-4"><div class="project"><a href="#"><img src="http://placehold.it/352x352/"></a></div></div>
					<div class="col-xs-6 col-md-4"><div class="project"><a href="#"><img src="http://placehold.it/352x352/"></a></div></div>
					<div class="col-xs-6 col-md-4"><div class="project"><a href="#"><img src="http://placehold.it/352x352/"></a></div></div>
					<div class="col-xs-6 col-md-4"><div class="project"><a href="#"><img src="http://placehold.it/352x352/"></a></div></div>
					<div class="col-xs-6 col-md-4"><div class="project"><a href="#"><img src="http://placehold.it/352x352/"></a></div></div>
					<div class="col-xs-6 col-md-4"><div class="project"><a href="#"><img src="http://placehold.it/352x352/"></a></div></div>
					<div class="col-md-8 col-md-offset-2"><a href="javascript:void(0)" id="loadmore" class="btn btn-lg btn-block btn-default">Show more works</a></div>
			<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
