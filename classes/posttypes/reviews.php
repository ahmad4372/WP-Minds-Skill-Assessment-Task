<?php
namespace Wp_Minds_Skill_Assessment_Task\PostTypes;

use Wp_Minds_Skill_Assessment_Task\Core\Singleton;

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Settings class
 *
 * @package Wp_Minds_Skill_Assessment_Task\Admin
 */
class Reviews extends Singleton {
    /**
     * Initializes the class execution flow.
     * 
     * @return void
     */
    protected function __run() {
        add_action( 'init', array( $this, 'register_post_type' ) );
        add_action( 'wp_head', array( $this, 'exclude_reviews_from_indexing' ) );
    }

    /**
     * Register post type
     * 
     * @return void
     */
    public function register_post_type() {
        $post_type = wpmsat_get_setting( 'reviews_post_type_slug' );
        $post_type_title = wpmsat_get_setting( 'reviews_post_type_title' );
        $post_type_index = wpmsat_get_setting( 'reviews_post_type_index' );
        $is_searchable   = $post_type_index === 'Yes';
        $labels = array(
            'name'               => $post_type_title,
            'singular_name'      => $post_type_title,
            'menu_name'          => $post_type_title,
            'name_admin_bar'     => $post_type_title,
            'add_new_item'       => sprintf( __( 'Add New %s', 'wp-minds-skill-assessment-task' ), $post_type_title ),
            'edit_item'          => sprintf( __( 'Edit %s', 'wp-minds-skill-assessment-task' ), $post_type_title ),
            'new_item'           => sprintf( __( 'New %s', 'wp-minds-skill-assessment-task' ), $post_type_title ),
            'view_item'          => sprintf( __( 'View %s', 'wp-minds-skill-assessment-task' ), $post_type_title ),
            'search_items'       => sprintf( __( 'Search %s', 'wp-minds-skill-assessment-task' ), $post_type_title ),
            'not_found'          => sprintf( __( 'No %s found', 'wp-minds-skill-assessment-task' ), $post_type_title ),
        );
        $args = array(
            'labels'              => $labels,
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'query_var'           => true,
            'rewrite'             => array( 'slug' => $post_type ),
            'capability_type'     => 'post',
            'has_archive'         => true,
            'hierarchical'        => false,
            'menu_position'       => null,
            'supports'            => array( 'title', 'editor', 'excerpt', 'custom-fields' ),
            'show_in_rest'        => true,
            'menu_icon'           => 'dashicons-star-filled',
            'taxonomies'          => array(),
            'exclude_from_search' => ! $is_searchable,
        );
        
        register_post_type( 'reviews', $args );
    }

    /**
     * Exclude reviews from indexing
     * 
     * @return void
     */
    function exclude_reviews_from_indexing() {
        $post_type_index = wpmsat_get_setting( 'reviews_post_type_index' );
        if ( $post_type_index === 'yes' ) {
            return;
        }
        if ( ! is_singular( 'reviews' ) ) {
            return;
        }
        ?>
        <meta name="robots" content="noindex, nofollow" />
        <?php
    }
}