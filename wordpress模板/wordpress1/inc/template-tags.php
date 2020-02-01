<?php
if ( ! function_exists( 'dw_resume_entry_meta' ) ) :
function dw_resume_entry_meta() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated sr-only" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '<i class="fa fa-calendar"></i> %s', 'post date', 'dw-resume' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( '<i class="fa fa-user"></i> %s', 'post author', 'dw-resume' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

	$categories_list = get_the_category_list( __( ', ', 'dw-resume' ) );
	if ( $categories_list && dw_resume_categorized_blog() ) {
		printf( '<span class="cat-links">' . __( '<i class="fa fa-folder"></i> %1$s', 'dw-resume' ) . '</span>', $categories_list );
	}

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		echo '<i class="fa fa-comments"></i>';
		comments_popup_link( __( '0 Comments', 'dw-resume' ), __( '1 Comment', 'dw-resume' ), __( '% Comments', 'dw-resume' ) );
		echo '</span>';
	}

}
endif;

if ( ! function_exists( 'dw_resume_entry_footer' ) ) :
function dw_resume_entry_footer() {
	if ( 'post' == get_post_type() ) {
		echo '<footer class="entry-footer">';
		$tags_list = get_the_tag_list( '', __( ', ', 'dw-resume' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'dw-resume' ) . '</span>', $tags_list );
		}
		echo '</footer>';
	}
}
endif;

if ( ! function_exists( 'dw_resume_posts_navigation' ) ) :
function dw_resume_posts_navigation() {
	the_posts_pagination( array( 'mid_size' => 4 ) );
}
endif;

function dw_resume_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'dw_resume_categories' ) ) ) {
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		) );

		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'dw_resume_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		return true;
	} else {
		return false;
	}
}

function dw_resume_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	delete_transient( 'dw_resume_categories' );
}
add_action( 'edit_category', 'dw_resume_category_transient_flusher' );
add_action( 'save_post',     'dw_resume_category_transient_flusher' );

if ( ! function_exists( 'dw_resume_breadcrumbs' ) ) :
function dw_resume_breadcrumbs() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<div class="breadcrumbs">', '</div>' );
	}
}
endif;

if ( ! function_exists( 'dw_resume_primary_column_class' ) ) :
function dw_resume_primary_column_class() {
	echo 'col-sm-8';
}
endif;

if ( ! function_exists( 'dw_resume_secondary_column_class' ) ) :
function dw_resume_secondary_column_class() {
	echo 'col-sm-4';
}
endif;
