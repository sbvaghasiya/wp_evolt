<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @package eVolt
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'evolt' ); ?></h1>
    </header><!-- .page-header -->

    <div class="page-content">
        <?php
        if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

            <?php echo esc_html__('Ready to publish your first post?', 'evolt'); ?>
            <a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>"><?php echo esc_html__('Get started here', 'evolt'); ?></a>

        <?php elseif ( is_search() ) : ?>

            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'evolt' ); ?></p>
            <?php
            get_search_form();

        else : ?>

            <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'evolt' ); ?></p>
            <?php
            get_search_form();

        endif; ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->