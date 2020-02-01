<?php
$items = dw_resume_get_repeat_field('exp_item');
?>
<section id="section-experience" class="section section-experience">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<header class="section-header">
					<h2 class="section-title"><?php echo dw_resume_get_theme_option( 'experience_title', 'Experience'); ?></h2>
				</header>
				<div class="section-content">
					<?php echo dw_resume_get_theme_option( 'experience_des', '<p>In posuere nibh ut risus accumsan posuere. Praesent lacinia vel diam nec hendrerit. Sed sed nisi et risus porttitor sodales vitae at lectus. Nullam eu sollicitudin eros. Aliquam quis dolor uitae lacus ultrices porta vitae a lacus.</p>'); ?>
					<?php if ( ! empty( $items ) ) : ?>
					<ul class="timeline">
					<?php
					$item = '';
					foreach ( $items as $key => $value ) {
					 $item .= '<li>';
					 $item .= '<div class="time">'.$value['from'].' - '.$value['to'].'</div>';
					 $item .= '<div class="event">
								<strong>'.$value['company'].'</strong>
								<p>'.$value['position'].'</p>';
					 $item .= '</div></li>';

					}
					echo $item;
					?>
					</ul>
					<?php else: ?>
					<ul class="timeline">
						<li>
							<div class="time">Oct 2015 - Present</div>
							<div class="event">
								<strong>ProductHunt</strong>
								<p>Co-founder, Lead Art Direction</p>
							</div>
						</li>
						<li>
							<div class="time">Mar 2014 - Oct 2015</div>
							<div class="event">
								<strong>DesignBold</strong>
								<p>Lead Art Direction</p>
							</div>
						</li>
						<li>
							<div class="time">Feb 2013 - Feb 2014</div>
							<div class="event">
								<strong>DesignWall & UberThemes</strong>
								<p>Creative Designer & Art Director</p>
							</div>
						</li>
						<li>
							<div class="time">Nov 2011 - Jan 2013</div>
							<div class="event">
								<strong>Solid Group Social Media Company</strong>
								<p>Creative Designer</p>
							</div>
						</li>
						<li>
							<div class="time">Dec 2009 - Nov 2011</div>
							<div class="event">
								<strong>Freelance</strong>
								<p>Creative Designer</p>
							</div>
						</li>
					</ul>
					<?php endif; ?>
					<?php if ( dw_resume_get_theme_option('resume_link') != '' ) : ?>
					<a href="<?php echo dw_resume_get_theme_option('resume_link'); ?>"><i class="ti-download"></i> Download Resume</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
