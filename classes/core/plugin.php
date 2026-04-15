<?php
namespace Wp_Minds_Skill_Assessment_Task\Core;

// Loaded directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Plugin extends Singleton {
    protected function __run() {
        self::helper();
        self::textdomain();
    }

    private static function helper() {
        require_once WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_DIR . 'includes/helpers.php';
    }

    private static function textdomain() {
        load_plugin_textdomain( 'wp-minds-skill-assessment-task', false, dirname( plugin_basename( WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_FILE ) ) . '/languages' );
    }
}