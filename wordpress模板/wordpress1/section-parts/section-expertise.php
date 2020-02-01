<section id="section-expertise" class="section section-expertise">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<header class="section-header">
					<h2 class="section-title"><?php echo dw_resume_get_theme_option( 'expert_title', 'Expertise' ); ?></h2>
				</header>
				<div class="section-content">
					<?php echo dw_resume_get_theme_option( 'expert_des', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices rhoncus magna, ac ugestas ante convallis sit amet. Nullam condimentum dui non nunc porta blandit. Morbi placerat dui busto, venenatis pharetra diam faucibus hendrerit.</p>' ); ?>
					<?php $items = dw_resume_get_repeat_field( 'expert_item' ); ?>
					<?php if ( ! empty( $items ) ) : ?>
					<?php
					$item = '';
					foreach ( $items as $key => $value ) {
					 $item .= '<div class="proress-title">'.$value['name'].'<span class="pull-right">'.( $value['percent'] / 10 ).'/10</span></div>';
					 $item .= '<div class="progress"><div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'.$value['percent'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$value['percent'].'%"></div></div>';
					}
					echo $item;
					?>
					<?php else: ?>
						<div class="proress-title">Photography <span class="pull-right">8/10</span></div>
					<div class="progress">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
						</div>
					</div>
					<div class="proress-title">Branding &amp; Identity <span class="pull-right">10/10</span></div>
					<div class="progress">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
						</div>
					</div>
					<div class="proress-title">Interface Design <span class="pull-right">5/10</span></div>
					<div class="progress">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
