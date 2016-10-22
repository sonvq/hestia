<?php

/*
	WPB Advanced FAQ
	By WPBean
	
*/


/**
 * Add shortcode support in Text widget
 */

add_filter('widget_text', 'do_shortcode');



/**
 * FAQ category column header for shortcode
 */


add_filter("manage_edit-wpb_af_faq_category_columns", 'wpb_af_term_columns_category'); 
 
function wpb_af_term_columns_category($default) {
	$default['wpb_af_cat_shortcode'] = __( 'Category Shortcode','wpb-advanced-faq' );
    return $default;
}



/**
 * FAQ category column content for shortcode
 */

add_filter("manage_wpb_af_faq_category_custom_column", 'manage_wpb_af_term_columns_category', 10, 3);
 
function manage_wpb_af_term_columns_category($out, $column_name, $term_id) {
	$term = get_term($term_id, 'wpb_af_faq_category');
    switch ($column_name) {
        case 'wpb_af_cat_shortcode': 
            $out .= '[wpb_af_faqs category="'.$term->slug.'"]'; 
            break;
 
        default:
            break;
    }
    return $out;    
}




/**
 * FAQ tag column header for shortcode
 */


add_filter("manage_edit-wpb_af_faq_tags_columns", 'wpb_af_term_columns_tag'); 
 
function wpb_af_term_columns_tag($default) {
	$default['wpb_af_cat_shortcode'] = __( 'Tag Shortcode','wpb-advanced-faq' );
    return $default;
}



/**
 * FAQ tag column content for shortcode
 */

add_filter("manage_wpb_af_faq_tags_custom_column", 'manage_wpb_af_term_columns_tag', 10, 3);
 
function manage_wpb_af_term_columns_tag($out, $column_name, $term_id) {
	$term = get_term($term_id, 'wpb_af_faq_tags');
    switch ($column_name) {
        case 'wpb_af_cat_shortcode': 
            $out .= '[wpb_af_faqs tags="'.$term->slug.'"]'; 
            break;
 
        default:
            break;
    }
    return $out;    
}
