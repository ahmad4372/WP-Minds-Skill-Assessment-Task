<?php
namespace Wp_Minds_Skill_Assessment_Task\Admin;

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
class Settings extends Singleton {
    /**
     * Initializes the plugin execution flow.
     * 
     * @return void
     */
    protected function __run() {
        add_action( 'admin_menu', array( $this, 'register_settings_page' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );
    }

    /**
     * Register settings page
     * 
     * @return void
     */
    public function register_settings_page() {
        add_options_page( esc_html__( 'WP Minds Skill Assessment Task', 'wp-minds-skill-assessment-task' ), esc_html__( 'WP Minds Skill Assessment Task', 'wp-minds-skill-assessment-task' ), 'manage_options', 'wp-minds-skill-assessment-task-settings', array( $this, 'render_settings_page' ) );
    }

    /**
     * Settings sections and fields.
     *
     * @return array
     */
    public static function get_settings() {
        return array(
            array(
                'id'       => 'reviews_shortcode_info',
                'title'    => esc_html__( 'Shortcode Usage', 'wp-minds-skill-assessment-task' ),
                'callback' => 'render_reviews_shortcode_section',
            ),
            array(
                'id'       => 'reviews',
                'title'    => esc_html__( 'Reviews', 'wp-minds-skill-assessment-task' ),
                'callback' => false,
                'fields'   => array(
                    array(
                        'name'              => 'reviews_post_type_title',
                        'title'             => esc_html__( 'Title', 'wp-minds-skill-assessment-task' ),
                        'desc'              => esc_html__( 'The title will be used for the review post type.', 'wp-minds-skill-assessment-task' ),
                        'type'              => 'text',
                        'default'           => esc_html__( 'Reviews', 'wp-minds-skill-assessment-task' ),
                        'sanitize_callback' => 'sanitize_text_field',
                    ),
                    array(
                        'name'              => 'reviews_post_type_slug',
                        'title'             => esc_html__( 'Slug', 'wp-minds-skill-assessment-task' ),
                        'desc'              => esc_html__( 'The slug will be used for the URL of the review post type.', 'wp-minds-skill-assessment-task' ),
                        'type'              => 'text',
                        'default'           => 'review',
                        'sanitize_callback' => 'sanitize_text_field',
                    ),
                    array(
                        'name'              => 'reviews_post_type_index',
                        'title'             => esc_html__( 'Index?', 'wp-minds-skill-assessment-task' ),
                        'desc'              => esc_html__( 'Whether the review post type should be indexed by search engines.', 'wp-minds-skill-assessment-task' ),
                        'type'              => 'select',
                        'default'           => 'yes',
                        'sanitize_callback' => 'sanitize_text_field',
                        'options'           => array(
                            'yes' => esc_html__( 'Yes', 'wp-minds-skill-assessment-task' ),
                            'no'  => esc_html__( 'No', 'wp-minds-skill-assessment-task' ),
                        ),
                    ),
                ),
            )
        );
    }

    /**
     * Register settings
     * 
     * @return void
     */
    public function register_settings() {
        foreach ( self::get_settings() as $section ) {
            add_settings_section( 'wp-minds-skill-assessment-task-settings-section-' . $section['id'], $section['title'], empty( $section['callback'] ) ? '__return_false' : array( $this, $section['callback'] ), 'wp-minds-skill-assessment-task-settings' );
            if ( empty( $section['fields'] ) ) {
                continue;
            }
            foreach ( $section['fields'] as $field ) {
                if ( empty( $field['name'] ) ) {
                    continue;
                }

                register_setting( 'wp-minds-skill-assessment-task-settings-group', $field['name'], array(
                    'sanitize_callback' => $field['sanitize_callback'],
                ) );
                add_settings_field( $field['name'], $field['title'], array( $this, 'render_field' ), 'wp-minds-skill-assessment-task-settings', 'wp-minds-skill-assessment-task-settings-section-' . $section['id'], $field );
            }
        }
    }

    /**
     * Render reviews shortcode section
     * 
     * @return void
     */
    function render_reviews_shortcode_section() {
        include WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_DIR . 'views/admin/reviews-shortcode-info.php';
    }

    /**
     * Render settings page
     * 
     * @return void
     */
    function render_settings_page() {
        include WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_DIR . 'views/admin/settings.php';
    }

    /**
     * Render text field
     * 
     * @param array $args
     * @return void
     */
    function render_field( $args ) {
        $file = WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_DIR . 'views/admin/fields/' . $args['type'] . '.php';
        if ( ! file_exists( $file ) ) {
            return;
        }

        include $file;
    }
}