<?php

/**
 * Plugin Name:     WP Minds Skill Assessment Task
 * Plugin URI:      https://github.com/ahmad4372/WP-Minds-Skill-Assessment-Task
 * Description:     Custom WordPress plugin to manage reviews with CPT, meta fields, and a frontend slider with shortcode support.
 * Author:          Muhammad Ahmad
 * Author URI:      https://github.com/ahmad4372/
 * Text Domain:     wp-minds-skill-assessment-task
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Wp_Minds_Skill_Assessment_Task
 */

// Prevent direct access
if (! defined('ABSPATH')) {
    exit;
}

// Plugin file.
define('WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_FILE', trailingslashit(__FILE__));
// Plugin directory path.
define('WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_DIR', trailingslashit(__DIR__));
// Plugin directory URL.
define('WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_URL', trailingslashit(plugin_dir_url(WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_FILE)));
// Plugin assets version.
define('WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_VERSION', '1.0.0');

/**
 * Autoloader for plugin classes.
 * 
 * @return void
 */
function wp_minds_skill_assessment_task_plugin_autoloader($class)
{
    $namespace = 'Wp_Minds_Skill_Assessment_Task\\';
    if (! str_contains($class, $namespace)) {
        return;
    }

    $class_name = str_replace($namespace, '', $class);
    $class_file = strtolower(str_replace('\\', '/', $class_name));
    $class_file = WP_MINDS_SKILL_ASSESSMENT_TASK_PLUGIN_DIR . 'classes/' . $class_file . '.php';
    if (! file_exists($class_file)) {
        return;
    }

    require_once $class_file;
}
spl_autoload_register('wp_minds_skill_assessment_task_plugin_autoloader');

/**
 * Initialize plugin.
 * 
 * @return void
 */
function wp_minds_skill_assessment_task_plugin_init()
{
    \Wp_Minds_Skill_Assessment_Task\Core\Plugin::instance();
}
add_action('plugins_loaded', 'wp_minds_skill_assessment_task_plugin_init');
