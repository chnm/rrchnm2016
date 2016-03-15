<?php

function register_top_nav() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}

function show_staff_position( $user ) {
    $html = '<table class="form-table"><tr>';
    $html .= '<th><label for="staff-position">Staff Position</label></th>';
    $html .= '<td><input type="text" name="staff-position" id="staff-position" value="' .
        esc_attr( get_the_author_meta( 'staff-position', $user->ID ) ) . '" class="regular-text" /></td>';
    $html .= '</tr></table>';
    return $html;
}

function rrchnm_get_custom_taxonomy_template( $template = '' ) {
    $taxonomy = get_query_var( 'taxonomy' );

    //check if taxonomy is for user or not
    $user_taxonomies = get_object_taxonomies( 'user', 'object' );

    if ( ! array( $user_taxonomies ) || empty( $user_taxonomies[ $taxonomy ] ) ) {
        return;
    }
    $taxonomy_template = get_template_directory() . "/user-taxonomy-template.php";
    $file_headers      = @get_headers( $taxonomy_template );
    if ( $file_headers[0] != 'HTTP/1.0 404 Not Found' ) {
        return $taxonomy_template;
    }

    return $template;
}

remove_filter( 'taxonomy_template', 'get_custom_taxonomy_template' );
add_filter( 'taxonomy_template', 'rrchnm_get_custom_taxonomy_template' );

add_theme_support( 'post-thumbnails' );

add_action( 'init', 'register_top_nav' );
add_action( 'show_user_profile', 'show_staff_position' );
add_action( 'edit_user_profile', 'show_staff_position' );
