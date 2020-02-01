<section id="section-skills" class="section section-skills">
	<header class="section-header">
		<h2 class="section-title"><?php echo dw_resume_get_theme_option( 'skills_title', 'My Skills' ); ?></h2>
	</header>
	<div class="section-content">

		<ul class="icon-box">
			<?php if ( dw_resume_get_theme_option( 'skill_icon_1' ) == '' && dw_resume_get_theme_option( 'skill_icon_2' ) == '' && dw_resume_get_theme_option( 'skill_icon_3' ) == '' ): ?>
			<li><i class="pe-7s-id"></i>Branding</li>
			<li><i class="pe-7s-target"></i>Marketing</li>
			<li><i class="pe-7s-paint-bucket"></i>Web Design</li>
			<?php else: ?>
			<li><i class="<?php echo dw_resume_get_theme_option( 'skill_icon_1' ); ?>"></i><?php echo dw_resume_get_theme_option( 'skill_title_1' ); ?></li>
			<li><i class="<?php echo dw_resume_get_theme_option( 'skill_icon_2' ); ?>"></i><?php echo dw_resume_get_theme_option( 'skill_title_2' ); ?></li>
			<li><i class="<?php echo dw_resume_get_theme_option( 'skill_icon_3' ); ?>"></i><?php echo dw_resume_get_theme_option( 'skill_title_3' ); ?></li>
			<?php endif; ?>
		</ul>
		<ul class="icon-box">
			<?php if ( dw_resume_get_theme_option( 'skill_icon_4' ) == '' && dw_resume_get_theme_option( 'skill_icon_5' ) == '' && dw_resume_get_theme_option( 'skill_icon_6' ) == '' ): ?>
			<li><i class="pe-7s-camera"></i>Photography</li>
			<li><i class="pe-7s-config"></i>HTML &amp; CSS</li>
			<li><i class="pe-7s-diamond"></i>Support</li>
			<?php else: ?>
			<li><i class="<?php echo dw_resume_get_theme_option( 'skill_icon_4' ); ?>"></i><?php echo dw_resume_get_theme_option( 'skill_title_4' ); ?></li>
			<li><i class="<?php echo dw_resume_get_theme_option( 'skill_icon_5' ); ?>"></i><?php echo dw_resume_get_theme_option( 'skill_title_5' ); ?></li>
			<li><i class="<?php echo dw_resume_get_theme_option( 'skill_icon_6' ); ?>"></i><?php echo dw_resume_get_theme_option( 'skill_title_6' ); ?></li>
			<?php endif; ?>
		</ul>
	</div>
</section>
