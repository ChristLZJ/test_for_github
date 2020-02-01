<?php
function optionsframework_option_name() {

	// 从样式表获取主题名称
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}



function optionsframework_options() {
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	$options = array();

	$options[] = array(
		'name' => __('基本设置', 'options_framework_theme'),
		'type' => 'heading');

	
	$options[] = array(
		'name' => __('头像', 'options_framework_theme'),
		'desc' => __('全站头像显示', 'options_framework_theme'),
		'id' => 'avatar',
		'type' => 'upload');

	$options[] = array(
		'name' => __('选择归档页面', 'options_framework_theme'),
		'desc' => __('选择一个通过存档模板添加的归档页', 'options_framework_theme'),
		'id' => 'page_archive',
		'type' => 'select',
		'options' => $options_pages);

	$options[] = array(
		'name' => __('选择分类页面', 'options_framework_theme'),
		'desc' => __('选择一个通过存档模板添加的归档页', 'options_framework_theme'),
		'id' => 'page_category',
		'type' => 'select',
		'options' => $options_pages);

	$options[] = array(
		'name' => __('选择标签页面', 'options_framework_theme'),
		'desc' => __('选择一个通过存档模板添加的归档页', 'options_framework_theme'),
		'id' => 'page_tag',
		'type' => 'select',
		'options' => $options_pages);

	$options[] = array(
		'name' => __('favicon 图片', 'options_framework_theme'),
		'desc' => __('32像素x32像素 favicon 就是在浏览器标题左面显示的图标', 'options_framework_theme'),
		'id' => 'favicon',
		'type' => 'upload');

	$options[] = array(
		'name' => __('app icon 图片', 'options_framework_theme'),
		'desc' => __('144像素x144像素 app - icon 当被用户收藏网站后在收藏夹显示的图标', 'options_framework_theme'),
		'id' => 'app_icon',
		'type' => 'upload');

	$options[] = array(
		'name' => __('页脚文本', 'options_framework_theme'),
		'id' => 'footer',		
		'type' => 'editor',
		'settings' => $wp_editor_settings );

	$options[] = array(
		'name' => __('SEO设置', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('关键词', 'options_framework_theme'),
		'desc' => __('请用英文逗号分隔', 'options_framework_theme'),
		'id' => 'keywords',
		'std' => '衫小寨',
		'type' => 'text');

	$options[] = array(
		'name' => "网站描述",
		'desc' => "",
		'id' => "description",
		'std' => "衫小寨",
		'type' => 'textarea');

	$options[] = array(
		'name' => __('副标题', 'options_framework_theme'),
		'desc' => __('是否在title最后面显示副标题', 'options_framework_theme'),
		'id' => 'logospanseo',
		'std' => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('头部预留', 'options_framework_theme'),
		'desc' => __( '此位置在 head 之前 ', 'options_framework_theme' ),
		'id' => 'headtext',
		'type' => 'editor',
		'settings' => $wp_editor_settings );

	$options[] = array(
		'name' => __('联系我们', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('衫小寨', 'options_framework_theme'),
		'desc' => __('如果您在使用中出现什么问题或有什么好的建议欢迎来我们小寨 <a href="http://qzhai.net" target="_black">点击进入</a>', 'options_framework_theme'),
		'type' => 'info');

	$options[] = array(
		'name' => __('QQ群', 'options_framework_theme'),
		'desc' => __('欢迎加群一起探讨wordpress（535689380）', 'options_framework_theme'),
		'type' => 'info');
	return $options;
}