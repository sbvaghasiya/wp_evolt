<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package eVolt
 */
$page_404 = evolt_get_option( 'page_404', 'default' );
$page_custom_404 = evolt_get_option( 'page_custom_404' );
get_header(); ?>
    
    <div class="container content-container">
        <div class="row content-row">
            <div id="primary" class="content-area col-12">
                <main id="main" class="site-main">
                    <?php if($page_404 == 'default') { ?>
                        <section class="error-404">
                            <div class="error-404-content">
                                <div class="error-404-image"><img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/image-404.png'); ?>" alt="<?php echo esc_attr__('404 Error', 'evolt'); ?>" /></div>
                                <h3 class="error-404-title">
                                    <?php echo esc_html__('Page Not Found', 'evolt'); ?>
                                </h3>
                                <div class="error-404-desc">
                                    <?php echo esc_html__("Something went wrong, looks like this page doesn't exist anymore.", "evolt"); ?>
                                </div>
                                <a class="btn btn-animate" href="<?php echo esc_url(home_url('/')); ?>">
                                    <?php echo esc_html__('back to home', 'evolt'); ?>
                                </a>
                            </div>
                        </section>
                    <?php } else { ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content clearfix">
                                <?php $post = get_post($page_custom_404);
                                if (!is_wp_error($post) && $post->ID == $page_custom_404 && class_exists('Wider_Theme_Core') && function_exists('evolt_print_html')){
                                    $content = \Elementor\Plugin::$instance->frontend->get_builder_content( $page_custom_404 );
                                    evolt_print_html($content);
                                } ?>
                            </div>
                        </article>
                    <?php } ?>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div>
    </div>

<?php
get_footer();
