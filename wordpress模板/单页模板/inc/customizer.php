<?php
include_once ABSPATH . 'wp-includes/class-wp-customize-control.php';
function dw_resume_customize_register( $wp_customize ) {
	require get_template_directory() . '/inc/customizer-controls.php';
	$wp_customize->remove_section( 'static_front_page' );

	$wp_customize->add_setting( 'dw_resume_theme_options[site_logo]', array(
		'default' => '',
		'sanitize_callback' => 'dw_resume_sanitize_file_url',
		));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'site_logo', array(
		'label' => __( 'Site Logo', 'dw-resume' ),
		'section' => 'title_tagline',
		'settings' => 'dw_resume_theme_options[site_logo]',
		)));


	$wp_customize->add_section( 'dw_resume_home_header' ,
		array(
			'priority'    => 60,
			'title'       => esc_html__( 'Header Section', 'dw-resume' ),
			'description' => '',

			)
		);

	// Title
	$wp_customize->add_setting( 'dw_resume_theme_options[header_title]',
		array(
			'sanitize_callback' => 'dw_resume_sanitize_text',
			'default' => 'Radoslav Stankov. Designer & Art Director, Based in Melbourne.',
			)
		);
	$wp_customize->add_control( 'header_title',
		array(
			'label' 		=> esc_html__('Section Title', 'dw-resume'),
			'section' 		=> 'dw_resume_home_header',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[header_title]',
			'type' => 'textarea'
			)
		);

		// Title
	$wp_customize->add_setting( 'dw_resume_theme_options[header_facebook]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => '#',
			)
		);
	$wp_customize->add_control( 'header_facebook',
		array(
			'label' 		=> esc_html__('Facebook Url', 'dw-resume'),
			'section' 		=> 'dw_resume_home_header',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[header_facebook]',
			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[header_twitter]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => '#',
			)
		);
	$wp_customize->add_control( 'header_twitter',
		array(
			'label' 		=> esc_html__('Twitter Url', 'dw-resume'),
			'section' 		=> 'dw_resume_home_header',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[header_twitter]',
			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[header_googleplus]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => '#',
			)
		);
	$wp_customize->add_control( 'header_googleplus',
		array(
			'label' 		=> esc_html__('Google+ Url', 'dw-resume'),
			'section' 		=> 'dw_resume_home_header',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[header_googleplus]',
			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[header_linkedin]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => '#',
			)
		);
	$wp_customize->add_control( 'header_linkedin',
		array(
			'label' 		=> esc_html__('LinkedIn Url', 'dw-resume'),
			'section' 		=> 'dw_resume_home_header',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[header_linkedin]',
			)
		);


	$wp_customize->add_setting( 'dw_resume_theme_options[header_readmore]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'Not Enough? Read More!',
			)
		);
	$wp_customize->add_control( 'header_readmore',
		array(
			'label' 		=> esc_html__('Read More Button Text', 'dw-resume'),
			'section' 		=> 'dw_resume_home_header',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[header_readmore]',
			)
		);


	$wp_customize->add_section( 'dw_resume_home_about' ,
		array(
			'priority'    => 60,
			'title'       => esc_html__( 'About Section', 'dw-resume' ),
			'description' => '',

			)
		);

	// Title
	$wp_customize->add_setting( 'dw_resume_theme_options[about_title]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'About',
			)
		);
	$wp_customize->add_control( 'about_title',
		array(
			'label' 		=> esc_html__('Section Title', 'dw-resume'),
			'section' 		=> 'dw_resume_home_about',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[about_title]',
			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[about_des]',
		array(
			'sanitize_callback' => 'dw_resume_sanitize_text',
			'default' => '<p>I\'m Radoslav Stankov , a multidisciplinary designer with 9 years of experience. I\'m passionate for technology, music, coffee, traveling and everything visually stimulating. Constantly learning and experiencing new things.</p>

			<p>You can find my design work on <a href="#">Dribbble</a> and <a href="#">Behance</a>, random thoughts on Twitter and Medium, beautiful pics on Instagram and almost a full resume on Linkedin. For work inquires please send me an email.</p>',
			)
		);

	$wp_customize->add_control( new DwResume_Editor_Custom_Control(
		$wp_customize,
		'about_des',
		array(
			'label' 		=> esc_html__('About Description', 'dw-resume'),
			'section' 		=> 'dw_resume_home_about',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[about_des]',
			)
		) );

	$wp_customize->add_section( 'dw_resume_home_skills' ,
		array(
			'priority'    => 60,
			'title'       => esc_html__( 'Skills Section', 'dw-resume' ),
			'description' => '',

			)
		);

	// Title
	$wp_customize->add_setting( 'dw_resume_theme_options[skills_title]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'My Skills',
			)
		);
	$wp_customize->add_control( 'skills_title',
		array(
			'label' 		=> esc_html__('Section Title', 'dw-resume'),
			'section' 		=> 'dw_resume_home_skills',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[skills_title]',
			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[skill_title_1]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'Branding',
			)
		);
	$wp_customize->add_control( 'skill_title_1',
		array(
			'label' 		=> esc_html__('Skill Title #1', 'dw-resume'),
			'section' 		=> 'dw_resume_home_skills',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[skill_title_1]',
			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[skill_icon_1]',
		array(
			'sanitize_callback' => 'dw_resume_return_value',
			'default' => 'pe-7s-id',
			)
		);
	$wp_customize->add_control( new DwResume_Icon_Custom_Control( $wp_customize, 'skill_icon_1',
		array(
			'label' 		=> esc_html__('Skill Icon #1', 'dw-resume'),
			'section' 		=> 'dw_resume_home_skills',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[skill_icon_1]',
			)
		) );

	$wp_customize->add_setting( 'dw_resume_theme_options[skill_title_2]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'Marketing',
			)
		);
	$wp_customize->add_control( 'skill_title_2',
		array(
			'label' 		=> esc_html__('Skill Title #2', 'dw-resume'),
			'section' 		=> 'dw_resume_home_skills',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[skill_title_2]',
			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[skill_icon_2]',
		array(
			'sanitize_callback' => 'dw_resume_return_value',
			'default' => 'pe-7s-target',
			)
		);
	$wp_customize->add_control( new DwResume_Icon_Custom_Control( $wp_customize, 'skill_icon_2',
		array(
			'label' 		=> esc_html__('Skill Icon #2', 'dw-resume'),
			'section' 		=> 'dw_resume_home_skills',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[skill_icon_2]',
			)
		) );

	$wp_customize->add_setting( 'dw_resume_theme_options[skill_title_3]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'Web Design',
			)
		);
	$wp_customize->add_control( 'skill_title_3',
		array(
			'label' 		=> esc_html__('Skill Title #3', 'dw-resume'),
			'section' 		=> 'dw_resume_home_skills',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[skill_title_3]',
			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[skill_icon_3]',
		array(
			'sanitize_callback' => 'dw_resume_return_value',
			'default' => 'pe-7s-paint-bucket',
			)
		);
	$wp_customize->add_control( new DwResume_Icon_Custom_Control( $wp_customize, 'skill_icon_3',
		array(
			'label' 		=> esc_html__('Skill Icon #3', 'dw-resume'),
			'section' 		=> 'dw_resume_home_skills',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[skill_icon_3]',
			)
		) );

	$wp_customize->add_setting( 'dw_resume_theme_options[skill_title_4]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'Photography',
			)
		);
	$wp_customize->add_control( 'skill_title_4',
		array(
			'label' 		=> esc_html__('Skill Title #4', 'dw-resume'),
			'section' 		=> 'dw_resume_home_skills',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[skill_title_4]',
			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[skill_icon_4]',
		array(
			'sanitize_callback' => 'dw_resume_return_value',
			'default' => 'pe-7s-camera',
			)
		);
	$wp_customize->add_control( new DwResume_Icon_Custom_Control( $wp_customize, 'skill_icon_4',
		array(
			'label' 		=> esc_html__('Skill Icon #4', 'dw-resume'),
			'section' 		=> 'dw_resume_home_skills',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[skill_icon_4]',
			)
		) );

	$wp_customize->add_setting( 'dw_resume_theme_options[skill_title_5]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'HTML &amp; CSS',
			)
		);
	$wp_customize->add_control( 'skill_title_5',
		array(
			'label' 		=> esc_html__('Skill Title #5', 'dw-resume'),
			'section' 		=> 'dw_resume_home_skills',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[skill_title_5]',
			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[skill_icon_5]',
		array(
			'sanitize_callback' => 'dw_resume_return_value',
			'default' => 'pe-7s-config',
			)
		);
	$wp_customize->add_control( new DwResume_Icon_Custom_Control( $wp_customize, 'skill_icon_5',
		array(
			'label' 		=> esc_html__('Skill Icon #5', 'dw-resume'),
			'section' 		=> 'dw_resume_home_skills',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[skill_icon_5]',
			)
		) );

	$wp_customize->add_setting( 'dw_resume_theme_options[skill_title_6]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'Support',
			)
		);
	$wp_customize->add_control( 'skill_title_6',
		array(
			'label' 		=> esc_html__('Skill Title #6', 'dw-resume'),
			'section' 		=> 'dw_resume_home_skills',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[skill_title_6]',
			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[skill_icon_6]',
		array(
			'sanitize_callback' => 'dw_resume_return_value',
			'default' => 'pe-7s-diamond',
			)
		);
	$wp_customize->add_control( new DwResume_Icon_Custom_Control( $wp_customize, 'skill_icon_6',
		array(
			'label' 		=> esc_html__('Skill Icon #6', 'dw-resume'),
			'section' 		=> 'dw_resume_home_skills',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[skill_icon_6]',
			)
		) );

	$wp_customize->add_section( 'dw_resume_home_expert' ,
		array(
			'priority'    => 60,
			'title'       => esc_html__( 'Expertise Section', 'dw-resume' ),
			'description' => '',

			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[expert_title]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'Expertise',
			)
		);
	$wp_customize->add_control( 'expert_title',
		array(
			'label' 		=> esc_html__('Section Title', 'dw-resume'),
			'section' 		=> 'dw_resume_home_expert',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[expert_title]',
			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[expert_des]',
		array(
			'sanitize_callback' => 'dw_resume_sanitize_text',
			'default' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices rhoncus magna, ac ugestas ante convallis sit amet. Nullam condimentum dui non nunc porta blandit. Morbi placerat dui busto, venenatis pharetra diam faucibus hendrerit.</p>',
			)
		);

	$wp_customize->add_control( new DwResume_Editor_Custom_Control(
		$wp_customize,
		'expert_des',
		array(
			'label' 		=> esc_html__('Section Description', 'dw-resume'),
			'section' 		=> 'dw_resume_home_expert',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[expert_des]',
			)
		) );

	$wp_customize->add_setting( 'dw_resume_theme_options[expert_item]',
		array(
			'sanitize_callback' => 'dw_resume_sanitize_repeatable_data_field',
				'transport' => 'refresh', // refresh or postMessage
				) );

	$wp_customize->add_control( new Dw_Resume_Customize_Repeatable_Control( $wp_customize,
		'dw_resume_theme_options[expert_item]',
		array(
			'label'     => esc_html__('Expertise', 'dw-resume'),
			'description'   => '',
			'section'       => 'dw_resume_home_expert',
				'max_item'      => 99, // Maximum item can add
				'fields'    => array(
					'name' => array(
						'title' => esc_html__('Expert Name', 'dw-resume'),
						'type'  =>'text',
						'desc'  => '',
						),
					'percent' => array(
						'title' => esc_html__('Expert Percent', 'dw-resume'),
						'type'  =>'text',
						'desc'  => '',
						),
					),
				)
		)
	);

	// 	);

	$wp_customize->add_section( 'dw_resume_home_experience' ,
		array(
			'priority'    => 60,
			'title'       => esc_html__( 'Experience Section', 'dw-resume' ),
			'description' => '',

			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[experience_title]',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'Experience',
			)
		);

	$wp_customize->add_control( 'experience_title',
		array(
			'label' 		=> esc_html__('Section Title', 'dw-resume'),
			'section' 		=> 'dw_resume_home_experience',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[experience_title]',
			)
		);

	$wp_customize->add_setting( 'dw_resume_theme_options[experience_des]',
		array(
			'sanitize_callback' => 'dw_resume_sanitize_text',
			'default' => '<p>In posuere nibh ut risus accumsan posuere. Praesent lacinia vel diam nec hendrerit. Sed sed nisi et risus porttitor sodales vitae at lectus. Nullam eu sollicitudin eros. Aliquam quis dolor uitae lacus ultrices porta vitae a lacus.</p>',
			)
		);

	$wp_customize->add_control( new DwResume_Editor_Custom_Control(
		$wp_customize,
		'experience_des',
		array(
			'label' 		=> esc_html__('Section Description', 'dw-resume'),
			'section' 		=> 'dw_resume_home_experience',
			'description'   => '',
			'settings' => 'dw_resume_theme_options[experience_des]',
			)
		) );

	$wp_customize->add_setting( 'dw_resume_theme_options[exp_item]',
		array(
			'sanitize_callback' => 'dw_resume_sanitize_repeatable_data_field',
			'transport' => 'refresh', // refresh or postMessage
			) );

	$wp_customize->add_control( new Dw_Resume_Customize_Repeatable_Control( $wp_customize,
		'dw_resume_theme_options[exp_item]',
		array(
			'label'     => esc_html__('Experiences', 'dw-resume'),
			'description'   => '',
			'section'       => 'dw_resume_home_experience',
				'max_item'      => 99, // Maximum item can add
				'fields'    => array(
					'from' => array(
						'title' => esc_html__('From', 'dw-resume'),
						'type'  =>'text',
						'desc'  => '',
						),
					'to' => array(
						'title' => esc_html__('To', 'dw-resume'),
						'type'  =>'text',
						'desc'  => '',
						),
					'company' => array(
						'title' => esc_html__('Company', 'dw-resume'),
						'type'  =>'text',
						'desc'  => '',
						),
					'position' => array(
						'title' => esc_html__('Position', 'dw-resume'),
						'type'  =>'text',
						'desc'  => '',
						),
					),
				)
)
);

$wp_customize->add_setting( 'dw_resume_theme_options[resume_link]',
	array(
		'sanitize_callback' => 'dw_resume_sanitize_file_url',
		'default' => 'Experience',
		)
	);
$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'dw_resume_theme_options[resume_link]',
	array(
		'label' 		=> esc_html__('Resume Link', 'dw-resume'),
		'section' 		=> 'dw_resume_home_experience',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[resume_link]',
		)
	)
);

$wp_customize->add_section( 'dw_resume_home_portfolio' ,
	array(
		'priority'    => 60,
		'title'       => esc_html__( 'Portfolio Section', 'dw-resume' ),
		'description' => '',

		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[portfolio_title]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => 'portfolio',
		)
	);

$wp_customize->add_control( 'portfolio_title',
	array(
		'label' 		=> esc_html__('Section Title', 'dw-resume'),
		'section' 		=> 'dw_resume_home_portfolio',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[portfolio_title]',
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[portfolio_des]',
	array(
		'sanitize_callback' => 'dw_resume_sanitize_text',
		'default' => '<p>Phasellus mollis tempor orci. Vivamus convallis rutrum ullamcorper. Sed sed pulvinar arcu, a malesuada augue. Aenean felis nulla, varius ut augue eu, sodales luctus nunc. In malesuada ullamcorper libero a consequat.</p>',
		)
	);

$wp_customize->add_control( new DwResume_Editor_Custom_Control(
	$wp_customize,
	'portfolio_des',
	array(
		'label' 		=> esc_html__('Section Description', 'dw-resume'),
		'section' 		=> 'dw_resume_home_portfolio',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[portfolio_des]',
		)
	) );

$wp_customize->add_setting( 'dw_resume_theme_options[hide_portfolios]',
	array(
		'sanitize_callback' => 'dw_resume_sanitize_checkbox',
		// 'default' => '1',
		)
	);

$wp_customize->add_control( 'hide_portfolios',
	array(
		'label' 		=> esc_html__('Hide Portfolios', 'dw-resume'),
		'section' 		=> 'dw_resume_home_portfolio',
		'description'   => 'If you do not have any portfolio item, please check this box.',
		'settings' => 'dw_resume_theme_options[hide_portfolios]',
		'type' => 'checkbox',
		)
	);



$wp_customize->add_setting( 'dw_resume_theme_options[portfolio_item]',
	array(
		'sanitize_callback' => 'dw_resume_sanitize_repeatable_data_field',
			'transport' => 'refresh', // refresh or postMessage
			) );

$wp_customize->add_control( new Dw_Resume_Customize_Repeatable_Control( $wp_customize,
	'dw_resume_theme_options[portfolio_item]',
	array(
		'label'     => esc_html__('Portfolios', 'dw-resume'),
		'description'   => '',
		'section'       => 'dw_resume_home_portfolio',
				'max_item'      => 99, // Maximum item can add
				'fields'    => array(
					'image' => array(
						'title' => esc_html__('Image', 'dw-resume'),
						'type'  =>'media',
						'desc'  => '',
						),
					'link' => array(
						'title' => esc_html__('Link', 'dw-resume'),
						'type'  =>'text',
						'desc'  => '',
						),
					),
				)
	)
);

$wp_customize->add_section( 'dw_resume_home_client' ,
	array(
		'priority'    => 60,
		'title'       => esc_html__( 'Client Section', 'dw-resume' ),
		'description' => '',

		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[client_title]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => 'Client',
		)
	);

$wp_customize->add_control( 'client_title',
	array(
		'label' 		=> esc_html__('Section Title', 'dw-resume'),
		'section' 		=> 'dw_resume_home_client',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[client_title]',
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[client_item]',
	array(
		'sanitize_callback' => 'dw_resume_sanitize_repeatable_data_field',
			'transport' => 'refresh', // refresh or postMessage
			) );

$wp_customize->add_control( new Dw_Resume_Customize_Repeatable_Control( $wp_customize,
	'dw_resume_theme_options[client_item]',
	array(
		'label'     => esc_html__('Clients', 'dw-resume'),
		'description'   => '',
		'section'       => 'dw_resume_home_client',
				'max_item'      => 99, // Maximum item can add
				'fields'    => array(
					'name' => array(
						'title' => esc_html__('Name', 'dw-resume'),
						'type'  =>'text',
						'desc'  => '',
						),
					'image' => array(
						'title' => esc_html__('Image', 'dw-resume'),
						'type'  =>'media',
						'desc'  => '',
						),
					'position' => array(
						'title' => esc_html__('Position', 'dw-resume'),
						'type'  =>'text',
						'desc'  => '',
						),
					'company' => array(
						'title' => esc_html__('Company', 'dw-resume'),
						'type'  =>'text',
						'desc'  => '',
						),
					'company_url' => array(
						'title' => esc_html__('Company URL', 'dw-resume'),
						'type'  =>'text',
						'desc'  => '',
						),
					'testimonial' => array(
						'title' => esc_html__('Testimonial', 'dw-resume'),
						'type'  =>'textarea',
						'desc'  => '',
						),
					),
				)
)
);

$wp_customize->add_panel( 'dw_resume_home_contact' ,
	array(
		'priority'    => 70,
		'title'       => esc_html__( 'Contact Section', 'dw-resume' ),
		'description' => '',

		)
	);

$wp_customize->add_section( 'dw_resume_home_contact_settings' ,
	array(
		'title'       => esc_html__( 'Contact Settings', 'dw-resume' ),
		'description' => '',
		'panel' => 'dw_resume_home_contact',
		)
	);

$wp_customize->add_section( 'dw_resume_home_contact_social' ,
	array(
		'title'       => esc_html__( 'Contact Social', 'dw-resume' ),
		'description' => '',
		'panel' => 'dw_resume_home_contact',
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[contact_title]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => 'Contact',
		)
	);

$wp_customize->add_control( 'contact_title',
	array(
		'label' 		=> esc_html__('Section Title', 'dw-resume'),
		'section' 		=> 'dw_resume_home_contact_settings',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[contact_title]',
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[contact_bg]', array(
	'default' => '',
	'sanitize_callback' => 'dw_resume_sanitize_file_url',
	));

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'contact_bg', array(
	'label' => __( 'Section Background', 'dw-resume' ),
	'section' 		=> 'dw_resume_home_contact_settings',
	'settings' => 'dw_resume_theme_options[contact_bg]',
	)));

$wp_customize->add_setting( 'dw_resume_theme_options[contact_email]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => 'admin@example.com',
		)
	);

$wp_customize->add_control( 'contact_email',
	array(
		'label' 		=> esc_html__('Email', 'dw-resume'),
		'section' 		=> 'dw_resume_home_contact_settings',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[contact_email]',
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[contact_phone]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '+123 456 789',
		)
	);

$wp_customize->add_control( 'contact_phone',
	array(
		'label' 		=> esc_html__('Phone', 'dw-resume'),
		'section' 		=> 'dw_resume_home_contact_settings',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[contact_phone]',
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[contact_address]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '81 Eighth Ave, 34th St & 8th Ave 00 1 800-207-4421, Melbourne',
		)
	);

$wp_customize->add_control( 'contact_address',
	array(
		'label' 		=> esc_html__('Address', 'dw-resume'),
		'section' 		=> 'dw_resume_home_contact_settings',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[contact_address]',
		'type' => 'textarea',
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[contact_facebook]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#',
		)
	);
$wp_customize->add_control( 'contact_facebook',
	array(
		'label' 		=> esc_html__('Facebook Url', 'dw-resume'),
		'section' 		=> 'dw_resume_home_contact_social',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[contact_facebook]',
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[contact_twitter]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#',
		)
	);
$wp_customize->add_control( 'contact_twitter',
	array(
		'label' 		=> esc_html__('Twitter Url', 'dw-resume'),
		'section' 		=> 'dw_resume_home_contact_social',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[contact_twitter]',
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[contact_googleplus]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#',
		)
	);
$wp_customize->add_control( 'contact_googleplus',
	array(
		'label' 		=> esc_html__('Google+ Url', 'dw-resume'),
		'section' 		=> 'dw_resume_home_contact_social',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[contact_googleplus]',
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[contact_linkedin]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#',
		)
	);
$wp_customize->add_control( 'contact_linkedin',
	array(
		'label' 		=> esc_html__('LinkedIn Url', 'dw-resume'),
		'section' 		=> 'dw_resume_home_contact_social',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[contact_linkedin]',
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[contact_dribbble]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#',
		)
	);
$wp_customize->add_control( 'contact_dribbble',
	array(
		'label' 		=> esc_html__('Dribbble Url', 'dw-resume'),
		'section' 		=> 'dw_resume_home_contact_social',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[contact_dribbble]',
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[contact_pinterest]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#',
		)
	);
$wp_customize->add_control( 'contact_pinterest',
	array(
		'label' 		=> esc_html__('Pinterest Url', 'dw-resume'),
		'section' 		=> 'dw_resume_home_contact_social',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[contact_pinterest]',
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[contact_youtube]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#',
		)
	);
$wp_customize->add_control( 'contact_youtube',
	array(
		'label' 		=> esc_html__('Youtube Url', 'dw-resume'),
		'section' 		=> 'dw_resume_home_contact_social',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[contact_youtube]',
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[contact_vimeo]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#',
		)
	);
$wp_customize->add_control( 'contact_vimeo',
	array(
		'label' 		=> esc_html__('Vimeo Url', 'dw-resume'),
		'section' 		=> 'dw_resume_home_contact_social',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[contact_vimeo]',
		)
	);

$wp_customize->add_section( 'dw_resume_home_cta' ,
	array(
		'priority'    => 80,
		'title'       => esc_html__( 'CTA Section', 'dw-resume' ),
		'description' => '',

		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[cta_content]',
	array(
		'sanitize_callback' => 'dw_resume_sanitize_text',
		'default' => '<p>Interested in working with me? <a href="#">Contact Me Now!</a></p>',
		)
	);

$wp_customize->add_control( new DwResume_Editor_Custom_Control(
	$wp_customize,
	'cta_content',
	array(
		'label' 		=> esc_html__('CTA Content', 'dw-resume'),
		'section' 		=> 'dw_resume_home_cta',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[cta_content]',
		)
	) );

$wp_customize->add_section( 'dw_resume_home_footer' ,
	array(
		'priority'    => 80,
		'title'       => esc_html__( 'Footer Section', 'dw-resume' ),
		'description' => '',

		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[footer_image]', array(
	'default' => '',
	'sanitize_callback' => 'dw_resume_sanitize_file_url',
	));

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_image', array(
	'label' => __( 'Footer Image', 'dw-resume' ),
	'section' 		=> 'dw_resume_home_footer',
	'settings' => 'dw_resume_theme_options[footer_image]',
	)));

$wp_customize->add_setting( 'dw_resume_theme_options[footer_copyright]',
	array(
		'sanitize_callback' => 'dw_resume_sanitize_text',
		'default' => 'Copyright © 2016 by <a href="#" rel="designer">DW Resume</a>. Theme: <a href="http://www.designwall.com/wordpress/themes/dw-resume/">DW Resume</a> by <a href="http://www.designwall.com" rel="designer">DesignWall</a>.<br><a href="http://wordpress.org/">Proudly powered by WordPress</a>',
		)
	);

$wp_customize->add_control( new DwResume_Editor_Custom_Control(
	$wp_customize,
	'footer_copyright',
	array(
		'label' 		=> esc_html__('Footer Copyright', 'dw-resume'),
		'section' 		=> 'dw_resume_home_footer',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[footer_copyright]',
		)
	) );

$wp_customize->add_section( 'dw_resume_typography' ,
	array(
		'priority'    => 80,
		'title'       => esc_html__( 'Typography', 'dw-resume' ),
		'description' => '',

		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[heading_font]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => 'Raleway',
		)
	);

$wp_customize->add_control( 'heading_font',
	array(
		'label' 		=> esc_html__('Heading Font Family', 'dw-resume'),
		'section' 		=> 'dw_resume_typography',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[heading_font]',
		'type' => 'select',
		'choices' => array(
            'Raleway' => 'Raleway',
            'Montserrat' => 'Montserrat',
            'Poiret One' => 'Poiret One',
            'Cabin' => 'Cabin',
            'Oxygen' => 'Oxygen',
            'Muli' => 'Hind',
            'Arvo' => 'Arvo',
            'Varela Round' => 'Varela Round',
            'Questrial' => 'Questrial',
        ),
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[content_font]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => 'Karla',
		)
	);

$wp_customize->add_control( 'content_font',
	array(
		'label' 		=> esc_html__('Content Font Family', 'dw-resume'),
		'section' 		=> 'dw_resume_typography',
		'description'   => '',
		'settings' => 'dw_resume_theme_options[content_font]',
		'type' => 'select',
		'choices' => array(
            'Karla' => 'Karla',
            'Roboto' => 'Roboto',
            'Open Sans' => 'Open Sans',
            'Lato' => 'Lato',
            'Source Sans Pro' => 'Source Sans Pro',
            'PT Sans' => 'PT Sans',
            'Droid Sans' => 'Droid Sans',
            'Arimo' => 'Arimo',
            'Noto Sans' => 'Noto Sans',
        ),
		)
	);

$wp_customize->add_setting( 'dw_resume_theme_options[primary_color]', array(
	'default' => '#2bc69e',
	'sanitize_callback' => 'sanitize_hex_color',
	) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', // Setting id
	array(
		'label' => __( 'Primary Color', 'dw-resume' ),
		'section' => 'dw_resume_typography',
		'settings' => 'dw_resume_theme_options[primary_color]',
		)
	)
);

$wp_customize->add_setting( 'dw_resume_theme_options[text_color]', array(
	'default' => '#b7b8b8',
	'sanitize_callback' => 'sanitize_hex_color',
	) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', // Setting id
	array(
		'label' => __( 'Text Color', 'dw-resume' ),
		'section' => 'dw_resume_typography',
		'settings' => 'dw_resume_theme_options[text_color]',
		)
	)
);

$wp_customize->add_setting( 'dw_resume_theme_options[link_color]', array(
	'default' => '#2bc69e',
	'sanitize_callback' => 'sanitize_hex_color',
	) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', // Setting id
	array(
		'label' => __( 'Link Color', 'dw-resume' ),
		'section' => 'dw_resume_typography',
		'settings' => 'dw_resume_theme_options[link_color]',
		)
	)
);

$wp_customize->add_setting( 'dw_resume_theme_options[link_hover_color]', array(
	'default' => '#2bc69e',
	'sanitize_callback' => 'sanitize_hex_color',
	) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', // Setting id
	array(
		'label' => __( 'Link Hover Color', 'dw-resume' ),
		'section' => 'dw_resume_typography',
		'settings' => 'dw_resume_theme_options[link_hover_color]',
		)
	)
);

}
add_action( 'customize_register', 'dw_resume_customize_register' );
