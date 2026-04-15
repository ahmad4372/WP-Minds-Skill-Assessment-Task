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
        add_options_page( __( 'WP Minds Skill Assessment Task', 'wp-minds-skill-assessment-task' ), __( 'WP Minds Skill Assessment Task', 'wp-minds-skill-assessment-task' ), 'manage_options', 'wp-minds-skill-assessment-task-settings', array( $this, 'render_settings_page' ) );
    }

    /**
     * Settings sections and fields.
     *
     * @return array
     */
    private static function get_settings() {
        return array(
            array(
                'id'       => 'reviews',
                'title'    => __( 'Reviews', 'wp-minds-skill-assessment-task' ),
                'callback' => '__return_false',
                'fields'   => array(
                    array(
                        'name'    => 'reviews_post_type_title',
                        'title'   => __( 'Title', 'wp-minds-skill-assessment-task' ),
                        'desc'    => __( 'The title will be used for the review post type.', 'wp-minds-skill-assessment-task' ),
                        'type'    => 'text',
                        'default' => __( 'Reviews', 'wp-minds-skill-assessment-task' ),
                    ),
                    array(
                        'name'    => 'reviews_post_type_slug',
                        'title'   => __( 'Slug', 'wp-minds-skill-assessment-task' ),
                        'desc'    => __( 'The slug will be used for the URL of the review post type.', 'wp-minds-skill-assessment-task' ),
                        'type'    => 'text',
                        'default' => 'review',
                    ),
                    array(
                        'name'    => 'reviews_post_type_index',
                        'title'   => __( 'Index?', 'wp-minds-skill-assessment-task' ),
                        'desc'    => __( 'Whether the review post type should be indexed by search engines.', 'wp-minds-skill-assessment-task' ),
                        'type'    => 'select',
                        'default' => 'yes',
                        'options' => array(
                            'yes' => __( 'Yes', 'wp-minds-skill-assessment-task' ),
                            'no'  => __( 'No', 'wp-minds-skill-assessment-task' ),
                        ),
                    ),
                ),
            ),
        );
    }

    /**
     * Register settings
     * 
     * @return void
     */
    public function register_settings() {
        foreach ( self::get_settings() as $section ) {
            if ( empty( $section['fields'] ) ) {
                continue;
            }
            
            add_settings_section( 'wp-minds-skill-assessment-task-settings-section-' . $section['id'], $section['title'], $section['callback'], 'wp-minds-skill-assessment-task-settings' );
            foreach ( $section['fields'] as $field ) {
                if ( empty( $field['name'] ) ) {
                    continue;
                }

                register_setting( 'wp-minds-skill-assessment-task-settings-group', $field['name'] );
                add_settings_field( $field['name'], $field['title'], array( $this, 'render_field' ), 'wp-minds-skill-assessment-task-settings', 'wp-minds-skill-assessment-task-settings-section-' . $section['id'], $field );
            }
        }
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