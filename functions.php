<?php

function register_top_nav() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}

function register_footer_nav() {
  register_nav_menu('footer-menu',__( 'Footer Menu' ));
}

function register_about_nav() {
    register_nav_menu( 'about-menu', 'About Us Menu');
}

function rrchnm_show_project_contributors() {
    $html = '';
    $pageID = get_the_ID();
    if (function_exists('get_coauthors')):
        $contributors = get_coauthors($pageID);
        foreach ($contributors as $contributor):
            $contributorID = $contributor->ID;
            $contributorName = $contributor->first_name . ' ' . $contributor->last_name;

            if (function_exists('get_cimyFieldValue') && get_cimyFieldValue($contributorID, 'picture')):
                $avatar = get_cimyFieldValue($contributorID, 'picture');
            else:
                $avatar = get_bloginfo('template_directory') . '/img/blank_staff.png';
            endif;
            $html .= '<div class="contributor">';
            $html .= '<a href="' . get_author_posts_url($contributorID) . '" class="avatar">';
            $html .= '<img src="' . $avatar .'" title="avatar for ' . $contributorName .'">';
            $html .= '</a>';
            $html .= '<a href="' . get_author_posts_url($contributorID) . '" class="name">' . $contributorName . '</a>';
            $html .= '</div>';
        endforeach;
    endif;
    return $html;
}

function rrchnm_show_project_categories() {
    $html = '';
    $pageID = get_the_ID();
    $categoryHeadings = ['Division', 'Platform', 'Funder', 'Content'];
    $postCategories = get_the_category($pageID);
    $sortedCategories = [];
    foreach ($postCategories as $postCategory) {
        $categoryParentID = $postCategory->parent;
        $categoryParent = get_category($categoryParentID);
        if (in_array($categoryParent->name, $categoryHeadings)) {
            $sortedCategories[$categoryParentID][] = $postCategory;
        }
    }

    foreach ($categoryHeadings as $categoryHeading) {
        if ($currentCategories = $sortedCategories[get_cat_ID($categoryHeading)]) {
            $html .= '<h3>' . $categoryHeading . '</h3>';
            $html .= '<ul class="post-categories">';
            foreach ($currentCategories as $currentCategory) {
                $html .= '<li><a href="' . get_category_link($currentCategory->term_id) . '">' . $currentCategory->cat_name . '</a></li>';
            }
            $html .= '</ul>';
        }
    }

    return $html;
}

function rrchnm_get_users_by_cimy_field_value($field_name, $field_value) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if (is_plugin_active('cimy-user-extra-fields/cimy_user_extra_fields.php')) {
        global $wpdb_fields_table, $wpdb_data_table, $wpdb;
        $sql_field_name = esc_sql($field_name);
        $sql_field_value = esc_sql($field_value);
        $sql = "SELECT ID FROM $wpdb_fields_table WHERE NAME='$sql_field_name'";
        $fieldRow = $wpdb->get_results($sql, ARRAY_A);
        $fieldID = (string) $fieldRow[0]['ID'];
        $sql = "SELECT USER_ID FROM $wpdb_data_table WHERE FIELD_ID='$fieldID' AND VALUE='$sql_field_value'";
        $userIDRows = $wpdb->get_results($sql, ARRAY_A);

        $userIDs = [];
        foreach ($userIDRows as $userIDRow) {
            $userIDs[] = $userIDRow['USER_ID'];
        }
        return $userIDs;
    } else {
        return "CIMY User Extra fields is not installed.";
    }
}

function rrchnm_staff_member($userID) {
    $userData = get_userdata($userID);
    $displayName = $userData->first_name . ' ' . $userData->last_name;
    $userUrl = get_author_posts_url($userID);
    $html = '<div class="person">';
    if (function_exists('get_cimyFieldValue') && get_cimyFieldValue($userID, 'picture')) {
        $avatar = get_cimyFieldValue($userID, 'picture');
    } else {
        $avatar = get_bloginfo('template_directory') . '/img/blank_staff.png';
    }
    $html .= '<a href="' . $userUrl . '" class="avatar" aria-title="staff avatar" style="background-image:url(\'' . $avatar . '\')"></a>';
    $html .= '<span class="name"><a href="' . $userUrl . '">' . $displayName . '</a></span>';
    if (function_exists('get_cimyFieldValue') && get_cimyFieldValue($userID, 'jobtitle')) {
        $html .= '<span class="position">' . get_cimyFieldValue($userID, 'jobtitle') . '</span>';
    }
    $html .= '</div>';
    return $html;
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

function create_essay_type() {
  register_post_type( 'essay',
    array(
      'labels' => array(
        'name' => __( 'Essays' ),
        'singular_name' => __( 'Essay' )
      ),
      'public' => true,
      'has_archive' => true,
      'taxonomies' => array(
            'category'
      ),
      'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','page-attributes'),
      'rewrite' => array( 'slug' => 'essay','with_front' => FALSE),
    )
  );
  flush_rewrite_rules();
}

remove_filter( 'taxonomy_template', 'get_custom_taxonomy_template' );
add_filter( 'taxonomy_template', 'rrchnm_get_custom_taxonomy_template' );

add_theme_support( 'post-thumbnails' );

add_action( 'init', 'register_top_nav' );
add_action( 'init', 'register_footer_nav' );
add_action( 'init', 'register_about_nav' );
add_action( 'init', 'create_essay_type' );
add_action( 'show_user_profile', 'show_staff_position' );
add_action( 'edit_user_profile', 'show_staff_position' );
