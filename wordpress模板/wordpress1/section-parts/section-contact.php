<section id="section-contact" class="section section-contact" style="background: #2a2b2c url(<?php echo dw_resume_get_theme_option( 'contact_bg', ' http://placehold.it/720x720' ); ?>) no-repeat right center;">
	<div class="container">
		<header class="section-header">
			<h2 class="section-title"><?php echo dw_resume_get_theme_option( 'contact_title', 'Contact' ); ?></h2>
		</header>
		<div class="section-content">
			<div class="row">
				<div class="contact-info col-md-4 col-lg-3">
					<?php echo dw_resume_get_theme_option( 'contact_email' ) != '' ? '<p><strong>Email</strong> <a href="#">'.dw_resume_get_theme_option( 'contact_email' ).'</a></p>' : '' ?>
					<?php echo dw_resume_get_theme_option( 'contact_phone' ) != '' ? '<p><strong>Phone</strong> <a href="#">'.dw_resume_get_theme_option( 'contact_phone' ).'</a></p>' : '' ?>
					<?php echo dw_resume_get_theme_option( 'contact_address' ) != '' ? '<p><strong>Address</strong>'.dw_resume_get_theme_option( 'contact_address' ).'</p>' : '' ?>
					<?php if ( dw_resume_get_theme_option( 'contact_email' ) == '' && dw_resume_get_theme_option( 'contact_phone' ) == '' && dw_resume_get_theme_option( 'contact_address' ) == '' ) : ?>
					<p><strong>Email</strong> <a href="#">radoslavstankov@gmail.com</a></p>
					<p><strong>Phone</strong> <a href="#">+522 234 56789</a></p>
					<p><strong>Address</strong> 81 Eighth Ave, 34th St &amp; 8th Ave 00 1 800-207-4421, Melbourne</p>
				  <?php endif; ?>
				</div>
				<div class="contact-social col-md-4 col-lg-3">
					<ul class="list-unstyled">
						<?php
						if ( dw_resume_get_theme_option( 'contact_twitter' ) == '' &&
							dw_resume_get_theme_option( 'contact_facebook' ) == '' &&
							dw_resume_get_theme_option( 'contact_googleplus' ) == '' &&
							dw_resume_get_theme_option( 'contact_dribbble' ) == '' &&
							dw_resume_get_theme_option( 'contact_linkedin' ) == '' &&
							dw_resume_get_theme_option( 'contact_pinterest' ) == '' &&
							dw_resume_get_theme_option( 'contact_youtube' ) == '' &&
							dw_resume_get_theme_option( 'contact_vimeo' ) == ''
							) :
						?>
						<li><a href="#"><i class="fa fa-twitter"></i> <span>Twitter</span></a></li>
						<li><a href="#"><i class="fa fa-facebook"></i> <span>Facebook</span></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i> <span>Google+</span></a></li>
						<li><a href="#"><i class="fa fa-dribbble"></i> <span>Dribbble</span></a></li>
						<li><a href="#"><i class="fa fa-linkedin"></i> <span>Linkedin</span></a></li>
						<li><a href="#"><i class="fa fa-pinterest"></i> <span>Pinterest</span></a></li>
						<li><a href="#"><i class="fa fa-youtube"></i> <span>YouTube</span></a></li>
						<li><a href="#"><i class="fa fa-vimeo"></i> <span>Vimeo</span></a></li>
						<?php else: ?>
						<?php echo dw_resume_get_theme_option( 'contact_twitter' ) != '' ? '<li><a href="'.dw_resume_get_theme_option( 'contact_twitter' ).'"><i class="fa fa-twitter"></i> <span>Twitter</span></a></li>' : '' ?>
						<?php echo dw_resume_get_theme_option( 'contact_facebook' ) != '' ? '<li><a href="'.dw_resume_get_theme_option( 'contact_facebook' ).'"><i class="fa fa-facebook"></i> <span>Facebook</span></a></li>' : '' ?>
						<?php echo dw_resume_get_theme_option( 'contact_googleplus' ) != '' ? '<li><a href="'.dw_resume_get_theme_option( 'contact_googleplus' ).'"><i class="fa fa-google-plus"></i> <span>Google+</span></a></li>' : '' ?>
						<?php echo dw_resume_get_theme_option( 'contact_dribbble' ) != '' ? '<li><a href="'.dw_resume_get_theme_option( 'contact_dribbble' ).'"><i class="fa fa-dribbble"></i> <span>Dribbble</span></a></li>' : '' ?>
						<?php echo dw_resume_get_theme_option( 'contact_linkedin' ) != '' ? '<li><a href="'.dw_resume_get_theme_option( 'contact_linkedin' ).'"><i class="fa fa-linkedin"></i> <span>Linkedin</span></a></li>' : '' ?>
						<?php echo dw_resume_get_theme_option( 'contact_pinterest' ) != '' ? '<li><a href="'.dw_resume_get_theme_option( 'contact_pinterest' ).'"><i class="fa fa-pinterest"></i> <span>Pinterest</span></a></li>' : '' ?>
						<?php echo dw_resume_get_theme_option( 'contact_youtube' ) != '' ? '<li><a href="'.dw_resume_get_theme_option( 'contact_youtube' ).'"><i class="fa fa-youtube"></i> <span>YouTube</span></a></li>' : '' ?>
						<?php echo dw_resume_get_theme_option( 'contact_vimeo' ) != '' ? '<li><a href="'.dw_resume_get_theme_option( 'contact_vimeo' ).'"><i class="fa fa-vimeo"></i> <span>Vimeo</span></a></li>' : '' ?>
						<?php endif; ?>

					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
