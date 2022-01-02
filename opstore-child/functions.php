<?php
/**
 * opstore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package opstore
 */

function my_theme_enqueue_styles() {
    $parent_style = 'attesa-style';
    
    wp_enqueue_style($parent_style, get_template_directory_uri(). '/style.css');
    wp_enqueue_style (
        'child-style',
        get_stylesheet_directory_uri() . '/style.css', 
        array($parent_style), 
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');


// function my_theme_enqueue_styles() {
//     $parent_style = 'twentyseventeen-style'; 
//     $child_style = 'twentyseventeen-child-style';
//     wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
//     wp_enqueue_style( $child_style, get_stylesheet_uri() );
// }
// add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

if ( ! function_exists('custom_post_type_promo') ) {

    // Register Custom Post Type
    function custom_post_type_promo() {
    
        $labels = array(
            'name'                  => _x( 'Promos', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'Promo', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'Promos', 'text_domain' ),
            'name_admin_bar'        => __( 'Promos', 'text_domain' ),
            'archives'              => __( 'Promo Archives', 'text_domain' ),
            'attributes'            => __( 'Promo Attributes', 'text_domain' ),
            'parent_item_colon'     => __( 'Parent Promo:', 'text_domain' ),
            'all_items'             => __( 'All Promos', 'text_domain' ),
            'add_new_item'          => __( 'Add New Promo', 'text_domain' ),
            'add_new'               => __( 'Add New', 'text_domain' ),
            'new_item'              => __( 'New Promo', 'text_domain' ),
            'edit_item'             => __( 'Edit Promo', 'text_domain' ),
            'update_item'           => __( 'Update Promo', 'text_domain' ),
            'view_item'             => __( 'View Promo', 'text_domain' ),
            'view_items'            => __( 'View Promos', 'text_domain' ),
            'search_items'          => __( 'Search Promo', 'text_domain' ),
            'not_found'             => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
            'featured_image'        => __( 'Featured Image', 'text_domain' ),
            'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
            'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
            'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
            'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
            'items_list'            => __( 'Promos list', 'text_domain' ),
            'items_list_navigation' => __( 'Promos list navigation', 'text_domain' ),
            'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
        );
        $args = array(
            'label'                 => __( 'Promo', 'text_domain' ),
            'description'           => __( 'Post Type Description', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'excerpt','thumbnail', 'post-formats', 'custom-fields'),
            'taxonomies'            => array( 'category', 'post_tag' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'promo',
            'map_meta_cap'          => true,
        );
        register_post_type( 'promo', $args );
    
    }
    add_action( 'init', 'custom_post_type_promo', 0 );
    
    }

    // SHORTCODE
add_shortcode( 'exclusive' , 'codigo_promotores' );
function codigo_promotores($atts, $content = null){
    $user = wp_get_current_user();

    if ( in_array( 'promotor', (array) $user->roles ) ){
        return $content;
    }
}
?>