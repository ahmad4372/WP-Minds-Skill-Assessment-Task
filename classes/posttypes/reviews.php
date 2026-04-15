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
        
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_custom_fields' ) );

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
        $is_searchable   = $post_type_index === 'yes';
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
            'supports'            => array( 'title' ),
            'show_in_rest'        => true,
            'menu_icon'           => 'dashicons-star-filled',
            'taxonomies'          => array(),
            'exclude_from_search' => ! $is_searchable,
        );
        
        register_post_type( 'reviews', $args );
    }

    /**
     * Add meta boxes
     * 
     * @return void
     */
    public function add_meta_boxes() {
        add_meta_box( 'reviews_meta_box', sprintf( __( '%s Content', 'wp-minds-skill-assessment-task' ), wpmsat_get_setting( 'reviews_post_type_title' ) ), array( $this, 'render_meta_box' ), 'reviews', 'normal', 'high' );
    }

    /**
     * Render meta box
     * 
     * @param WP_Post $post
     * @return void
     */
    public function render_meta_box( $post ) {
        wp_nonce_field( 'reviews_meta_box_nonce', 'reviews_meta_box_nonce' );
        ?>
        <p>
            <label for="_content"><?php _e( 'Content', 'wp-minds-skill-assessment-task' ); ?></label>
            <textarea class="widefat" id="_content" name="_content" rows="4"><?php echo esc_attr( get_post_meta( $post->ID, '_content', true ) ); ?></textarea>
        </p>
        <p>
            <label for="_author_name"><?php _e( 'Author Name', 'wp-minds-skill-assessment-task' ); ?></label>
            <input type="text" class="widefat" id="_author_name" name="_author_name" value="<?php echo esc_attr( get_post_meta( $post->ID, '_author_name', true ) ); ?>" />
        </p>
        <p>
            <label for="_author_tagline"><?php _e( 'Author Tagline', 'wp-minds-skill-assessment-task' ); ?></label>
            <input type="text" class="widefat" id="_author_tagline" name="_author_tagline" value="<?php echo esc_attr( get_post_meta( $post->ID, '_author_tagline', true ) ); ?>" />
        </p>
        <?php
    }

    /**
     * Save custom fields
     * 
     * @param int $post_id
     * @return void
     */
    public function save_custom_fields( $post_id ) {
        if ( empty( $_POST['reviews_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['reviews_meta_box_nonce'], 'reviews_meta_box_nonce' ) ) {
            return;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        
        if ( isset( $_POST['_content'] ) ) {
            update_post_meta( $post_id, '_content', sanitize_textarea_field( $_POST['_content'] ) );
        }
        if ( isset( $_POST['_author_name'] ) ) {
            update_post_meta( $post_id, '_author_name', sanitize_text_field( $_POST['_author_name'] ) );
        }
        if ( isset( $_POST['_author_tagline'] ) ) {
            update_post_meta( $post_id, '_author_tagline', sanitize_text_field( $_POST['_author_tagline'] ) );
        }
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