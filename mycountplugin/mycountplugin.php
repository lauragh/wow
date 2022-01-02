<?php 
/*
Plugin Name: mycountplugin
Plugin URI: http://www.mycountplugin.com
Description: a plugin to count post views
Version: 1.0
Author: Laura Garcia Hernandez
License: GPL2
*/
?>

<?php
/** Adds a view to the post being viewed*/
    function mycp_add_view() {
        if(is_single()) {
            global $post;
            $current_views = get_post_meta($post->ID, "mycp_views", true);
            
            if(!isset($current_views) OR
            empty($current_views) OR
            !is_numeric($current_views) ) {
                $current_views = 0;
            }
            $new_views = $current_views + 1;
            update_post_meta($post->ID, "mycp_views", $new_views);
                return $new_views;
        }
    }
    add_action("wp_head", "mycp_add_view");
    

    /** Retrieve the number of views for a post*/
    function mycp_get_view_count() {
        global $post;
        $current_views = get_post_meta($post->ID, "mycp_views", true);
       
        if(!isset($current_views) OR
        empty($current_views) OR
        !is_numeric($current_views) ) {
            $current_views = 0;
        }
        return $current_views;
    }


    /* Shows the number of views for a post */
    function mycp_show_views($singular = "view",
        $plural = "views",
        $before = "Número de visitas: ") {
        global $post;
        $current_views = mycp_get_view_count();
        $views_text = $before . $current_views . " ";
        if ($current_views == 1) {
            $views_text .= $singular;
        }
        else {
            $views_text .= $plural;
        }
        echo $views_text;
    }

    /* Displays a list of posts ordered by post count*/
    function mycp_popularity_list($post_count = 10) {
        $today = date( 'Y-m-d' );
        $args = array(
            
        "posts_per_page" => 10,
        "post_type" => "promo",
        'meta_query' => array(
            array(
                'key' => 'fecha_fin_oferta',
                'value' => $today,
                'compare' => '>=',
                'type' => 'DATE'
            )
        ),
        "post_status" => "publish",
        "meta_key" => "mycp_views",
        "orderby" => "meta_value_num",
        "order" => "DESC"
        );
        $mycp_list = new WP_Query($args);
        while ( $mycp_list->have_posts() ) : $mycp_list->the_post();
        get_template_part( '../opstore-child/layout-list', 'list');
        endwhile;

    }

    function set_view_cero() {
        global $post;
        $current_views = get_post_meta($post->ID, "mycp_views", true);
        $current_views = 0;

        $args = array(
            'post_type' => 'promo', // Only get the posts
            'post_status' => 'publish', // Only the posts that are published
            'posts_per_page'   => -1 // Get every post
        );
        $posts = get_posts($args);
        foreach ( $posts as $post ) {
            // Run a loop and update every meta data
            update_post_meta( $post->ID, 'mycp_views', $current_views);
        }
    }
    register_deactivation_hook( __FILE__ , 'set_view_cero' );

    register_activation_hook(__FILE__, 'set_view_cero');

    register_uninstall_hook(__FILE__, 'set_view_cero');
    
    

?>