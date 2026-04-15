<?php
namespace Wp_Minds_Skill_Assessment_Task\Core;

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Plugin Class
 *
 * Responsible for bootstrapping the plugin functionality.
 *
 * @package Wp_Minds_Skill_Assessment_Task\Core
 */
class Plugin extends Singleton {
    /**
     * Initializes the plugin execution flow.
     * 
     * @return void
     */
    protected function __run() {
        self::helper();
        self::textdomain();
        self::classes();
    }

    /**
     * Load helper functions required across the plugin.
     *
     * @return void
     */
    private static function helper() {
        require_once WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_DIR . 'includes/helpers.php';
    }

    /**
     * Load plugin text domain for translations.
     *
     * @return void
     */
    private static function textdomain() {
        load_plugin_textdomain( 'wp-minds-skill-assessment-task', false, dirname( plugin_basename( WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_FILE ) ) . '/languages' );
    }

    /**
     * Load classes
     * 
     * @return void
     */
    private static function classes() {
        \Wp_Minds_Skill_Assessment_Task\Admin\Settings::instance();
    }
}