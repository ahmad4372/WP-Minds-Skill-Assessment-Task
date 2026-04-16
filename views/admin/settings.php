<?php
/**
 * Settings page view
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<div class="wrap">
    <h1><?php esc_html_e( 'WP Minds Skill Assessment Task Settings', 'wp-minds-skill-assessment-task' ); ?></h1>
    <form method="post" action="<?php echo esc_url( admin_url( 'options.php' ) ); ?>">
        <?php
        settings_fields( 'wp-minds-skill-assessment-task-settings-group' );
        do_settings_sections( 'wp-minds-skill-assessment-task-settings' );
        submit_button();
        ?>
    </form>
</div>