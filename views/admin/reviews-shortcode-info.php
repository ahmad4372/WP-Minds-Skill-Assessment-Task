<?php
/**
 * Reviews shortcode info view
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<p><?php esc_html_e( 'Use the following shortcode to display your Reviews:', 'wp-minds-skill-assessment-task' ); ?></p>
<code>[wpmsat_reviews]</code>
<h3><?php esc_html_e( 'Shortcode Parameters', 'wp-minds-skill-assessment-task' ); ?></h3>
<table class="widefat">
    <thead>
        <tr>
            <th><?php esc_html_e( 'Parameter', 'wp-minds-skill-assessment-task' ); ?></th>
            <th><?php esc_html_e( 'Description', 'wp-minds-skill-assessment-task' ); ?></th>
            <th><?php esc_html_e( 'Example', 'wp-minds-skill-assessment-task' ); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>style</code></td>
            <td><?php esc_html_e( 'Display style of reviews. Accepts `slider` or `grid`', 'wp-minds-skill-assessment-task' ); ?></td>
            <td><code>[wpmsat_reviews style="slider"]</code></td>
        </tr>
        <tr>
            <td><code>grid</code></td>
            <td><?php esc_html_e( 'Number of reviews to display in row or per slide. Min `1` max upto `6`', 'wp-minds-skill-assessment-task' ); ?></td>
            <td><code>[wpmsat_reviews style="slider" grid="3"]</code></td>
        </tr>
        <tr>
            <td><code>per_page</code></td>
            <td><?php esc_html_e( 'Number of reviews to display per page. Use `0` to display all reviews.', 'wp-minds-skill-assessment-task' ); ?></td>
            <td><code>[wpmsat_reviews style="slider" grid="3" per_page="12"]</code></td>
        </tr>
    </tbody>
</table>