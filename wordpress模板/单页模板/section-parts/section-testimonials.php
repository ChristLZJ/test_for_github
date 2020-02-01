<?php $items = dw_resume_get_repeat_field( 'client_item' ); ?>
<section id="section-testimonials" class="section section-testimonials text-center">
	<div class="container">
		<header class="section-header">
			<h2 class="section-title"><?php echo dw_resume_get_theme_option( 'client_title', 'Client' ); ?></h2>
		</header>
		<div class="section-content">

			<div class="carousel slide" data-ride="carousel" id="testimonial-carousel">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="carousel-inner">
							<?php if ( ! empty( $items ) ) : ?>
							<?php
							$item = '';
							$i = 0;
							foreach ( $items as $key => $value ) {
								$active = '';
								if ( 0 == $i ) {
									$active = 'active';
								}
								$item .= '<div class="item '.$active.'">
								<div class="row">
									<div class="col-sm-12">
										<p class="testimonial-content">'.$value['testimonial'].'</p>
										<p><img src="'.$value['image']['url'].'" class="img-circle"></p>
										<p><strong>'.$value['name'].'</strong><br><small>'.$value['position'].' of <a href="'.$value['company_url'].'">'.$value['company'].'</a></small></p>
									</div>
								</div>
							</div>';
							$i++;
							}
							echo $item;
							?>
						<?php else: ?>
							<div class="item active">
								<div class="row">
									<div class="col-sm-12">
										<p class="testimonial-content">&ldquo;Lorem sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna.&rdquo;</p>
										<p><img src="https://s3.amazonaws.com/uifaces/faces/twitter/rem/73.jpg" class="img-circle"></p>
										<p><strong>Vulputate M., Dolor</strong><br><small>Creative Designer &amp; Art Director of <a href="#">ProductHunt</a></small></p>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="row">
									<div class="col-sm-12">
										<p class="testimonial-content">&ldquo;Lorem sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna.&rdquo;</p>
										<p><img src="https://s3.amazonaws.com/uifaces/faces/twitter/felipebsb/73.jpg" class="img-circle"></p>
										<p><strong>Vulputate M., Dolor</strong><br><small>Creative Designer &amp; Art Director of <a href="#">ProductHunt</a></small></p>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="row">
									<div class="col-sm-12">
										<p class="testimonial-content">&ldquo;Lorem sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna.&rdquo;</p>
										<p><img src="https://s3.amazonaws.com/uifaces/faces/twitter/spiltmilkstudio/73.jpg" class="img-circle"></p>
										<p><strong>Vulputate M., Dolor</strong><br><small>Creative Designer &amp; Art Director of <a href="#">ProductHunt</a></small></p>
									</div>
								</div>
							</div>
						<?php endif; ?>
						</div>
					</div>
				</div>
				<a class="left carousel-control" href="#testimonial-carousel" role="button" data-slide="prev">
					<span class="ti-arrow-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#testimonial-carousel" role="button" data-slide="next">
					<span class="ti-arrow-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>

		</div>
	</div>
</section>
