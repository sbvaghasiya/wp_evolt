<?php
/**
 * Custom post types register.
 * @since   1.0
 * @author Wider-Themes
 *
 */

class EFramework_CPT_Register
{
    /**
     * Core singleton class
     *
     * @var self - pattern realization
     * @access private
     */
    private static $_instance;

    /**
     * Store supported post types in an array
     * @var array
     * @access private
     */
    private $post_types = array();

    private $post_type = '';

    /**
     * Constructor
     *
     * @access private
     */
    private function __construct()
    {
        add_action('init', array($this, 'init'), 0);
        add_action('init', array($this, 'evolt_featured_handlers'));
        add_action('admin_menu', array($this, 'evolt_remove_post_custom_fields'),99);
    }

    function init()
    {
        $this->post_types = apply_filters('evolt_extra_post_types', array(
            'portfolio' => array()
        ));
        $this->post_types['portfolio'] = array_merge(
            array(
                'status' => true,
                'post_featured' => false,
                'item_name' => __('Portfolio', EVOLT_TEXT_DOMAIN),
                'items_name' => __('Portfolios', EVOLT_TEXT_DOMAIN),
                'args' => array(),
                'labels' => array(
                    'singular_name' => __('Portfolio', EVOLT_TEXT_DOMAIN),
                    'add_new' => _x('Add New', 'add new on admin panel', EVOLT_TEXT_DOMAIN),
                )
            ), $this->post_types['portfolio']
        );
        foreach ($this->post_types as $key => $evolt_post_type) {
            if ($evolt_post_type['status'] === true):
                $evolt_post_type_args = !empty($evolt_post_type['args']) ? $evolt_post_type['args'] : array();
                $evolt_post_type_labels = !empty($evolt_post_type['labels']) ? $evolt_post_type['labels'] : array();
                $args = array_merge(array(
                    'labels' => array_merge(array(
                        'name' => $evolt_post_type['item_name'],
                        'singular_name' => $evolt_post_type['item_name'],
                        'add_new' => _x('Add New', 'add new on admin panel', EVOLT_TEXT_DOMAIN),
                        'add_new_item' => __('Add New', EVOLT_TEXT_DOMAIN) . ' ' . $evolt_post_type['item_name'],
                        'edit_item' => __('Edit', EVOLT_TEXT_DOMAIN) . ' ' . $evolt_post_type['item_name'],
                        'new_item' => __('New', EVOLT_TEXT_DOMAIN) . ' ' . $evolt_post_type['item_name'],
                        'view_item' => __('View', EVOLT_TEXT_DOMAIN) . ' ' . $evolt_post_type['item_name'],
                        'view_items' => __('View', EVOLT_TEXT_DOMAIN) . ' ' . $evolt_post_type['items_name'],
                        'search_items' => __('Search', EVOLT_TEXT_DOMAIN) . ' ' . $evolt_post_type['items_name'],
                        'not_found' => __('No', EVOLT_TEXT_DOMAIN) . ' ' . $evolt_post_type['items_name'] . ' ' . __('Found', EVOLT_TEXT_DOMAIN),
                        'not_found_in_trash' => __('No', EVOLT_TEXT_DOMAIN) . ' ' . $evolt_post_type['items_name'] . ' ' . __('Found in Trash', EVOLT_TEXT_DOMAIN),
                        'parent_item_colon' => __('Parent', EVOLT_TEXT_DOMAIN) . ' ' . $evolt_post_type['item_name'] . ':',
                        'all_items' => __('All', EVOLT_TEXT_DOMAIN) . ' ' . $evolt_post_type['items_name'],
                        'archives' => $evolt_post_type['item_name'] . ' ' . __('Archives', EVOLT_TEXT_DOMAIN),
                        'attributes' => $evolt_post_type['item_name'] . ' ' . __('Entry Attributes', EVOLT_TEXT_DOMAIN),
                        'uploaded_to_this_item' => __('Uploaded to this', EVOLT_TEXT_DOMAIN) . ' ' . $evolt_post_type['item_name'],
                        'menu_name' => $evolt_post_type['item_name'],
                        'filter_items_list' => __('Filter', EVOLT_TEXT_DOMAIN) . ' ' . $evolt_post_type['item_name'] . ' ' . __('list', EVOLT_TEXT_DOMAIN),
                        'items_list_navigation' => $evolt_post_type['item_name'] . ' ' . __('list navigation', EVOLT_TEXT_DOMAIN),
                        'items_list' => $evolt_post_type['item_name'] . ' ' . __('list', EVOLT_TEXT_DOMAIN),
                        'name_admin_bar' => $evolt_post_type['item_name']
                    ), $evolt_post_type_labels),
                    'hierarchical' => false,
                    'description' => '',
                    'public' => true,
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'show_in_admin_bar' => true,
                    'menu_position' => null,
                    'menu_icon' => 'dashicons-portfolio',
                    'show_in_nav_menus' => true,
                    'publicly_queryable' => true,
                    'exclude_from_search' => false,
                    'has_archive' => true,
                    'query_var' => true,
                    'can_export' => true,
                    'capability_type' => 'post',
                    'supports' => array(
                        'title',
                        'editor',
                        'thumbnail',
                        'excerpt',
                        'revisions',
                        'author'
                    )
                ), $evolt_post_type_args);
                register_post_type($key, $args);
                flush_rewrite_rules();
                $this->post_type = $key;
                if (isset($evolt_post_type['post_featured']) && $evolt_post_type['post_featured'] === true) {
                    add_filter('manage_' . $key . '_posts_columns', array($this, 'evolt_add_column_featured'));
                    add_filter('manage_' . $key . '_posts_custom_column', array($this, 'evolt_add_content_featured_column'), 10, 2);
                }

            endif;
        }
    }


    function evolt_remove_post_custom_fields()
    {
        remove_meta_box('postcustom', 'page', 'normal');
        remove_meta_box('postcustom', 'page', 'side');
        remove_meta_box('postcustom', 'page', 'advanced');
    }

    /**
     * Registers portfolio post type, this function should be called in an init hook function.
     * @uses $wp_post_types Inserts new post type object into the list
     *
     * @access protected
     */
    protected function type_portfolio_register() {
    }

    /**
     * Get instance of the class
     *
     * @access public
     * @return object this
     */
    public static function get_instance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function evolt_add_column_featured($defaults)
    {
        $defaults['post_featured'] = esc_html__('Featured', EVOLT_TEXT_DOMAIN);
        return $defaults;
    }

    public function evolt_add_content_featured_column($colum_name, $post_id)
    {
        if ($colum_name === "post_featured") {
            $pt = get_post_type($post_id);
            if ($pt !== false) {
                $href = admin_url("edit.php?post_type=" . $pt);
                $meta_featured = get_post_meta($post_id, 'evolt_post_featured', true);
                if ($meta_featured === "featured") {
                    echo '<a href="' . $href . '&ct_post_id=' . $post_id . '"><span class="fs-show-featured dashicons dashicons-star-filled"></span></a>';
                } else {
                    echo '<a href="' . $href . '&ct_post_id=' . $post_id . '"><span class="fs-show-featured dashicons dashicons-star-empty"></span></a>';
                }
            }
        }
    }

    public function evolt_featured_handlers()
    {
        if (!empty($_REQUEST['evolt_post_id']) && get_post(intval($_REQUEST['evolt_post_id'])) !== null) {
            $pid = intval($_REQUEST['evolt_post_id']);
            $featured_meta = get_post_meta($pid, 'evolt_post_featured', true);
            if ($featured_meta === "featured") {
                update_post_meta($pid, 'evolt_post_featured', '');
            } else {
                update_post_meta($pid, 'evolt_post_featured', 'featured');
            }
            $pt = get_post_type($pid);
            if ($pt !== false) {
                wp_redirect(admin_url("edit.php?post_type=" . $pt));
            }
        }
    }
}