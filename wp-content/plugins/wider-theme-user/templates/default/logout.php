<?php
/**
 * The template for displaying logout text.
 *
 * @package Wider Theme User
 * @author WiderThemes Team
 * @since Wider Theme User 1.0.0
 */

if (! defined ( 'ABSPATH' )) {
	exit ();
}

global $user_press;

?>

<div class="evolt-user-form-logout">
	<a class="btn" href="<?php echo esc_url(wp_logout_url( get_permalink() )); ?>"><?php echo esc_html($user_press['is_logged_text']); ?></a>
</div>