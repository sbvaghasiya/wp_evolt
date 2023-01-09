<?php
/**
 * @template: import-export-handle.php
 * @since: 1.0.0
 * @author: Wider-Themes
 * @create: 16-Nov-17
 */
if (!defined('ABSPATH')) {
    die();
}
if (!class_exists('EVOLT_Import_Export_handle')) {
    class EVOLT_Import_Export_handle
    {
        public function __construct()
        {
            add_action('init', array($this, 'evolt_ie_template_redirect'), 30);
            add_action('init', array($this, 'evolt_ie_import_woo_term'), 29);
        }

        public function evolt_ie_template_redirect()
        {

            if (!isset($_REQUEST['page']) || $_REQUEST['page'] !== 'evolt-import') {
                return;
            }
            do_action('evolt-ie-before-handle');
            /**
             * Export handle
             *
             */
            if (!empty($_REQUEST['action']) && $_REQUEST['action'] === 'evolt-export' && !empty($_REQUEST['evolt-ie-id']) && !empty($_REQUEST['evolt-ie-data-type'])) {

                $folder_name = sanitize_title($_REQUEST['evolt-ie-id']);
                $folder_dir = evolt_ie_process_demo_folder($folder_name);
                $this->evolt_ie_get_screen_shot($folder_name);
                do_action('evolt-ie-export-start', $folder_dir);
                $this->evolt_ie_export_start($folder_dir);
                /**
                 * Hook evolt-ie-extra-options
                 * Export and import extra options
                 * Return $options ( array( $option_key1 , $option_key1 , $option_key3....) )
                 */
                $options = array();
                $options = apply_filters('evolt_ie_extra_options', $options);
                $demo_info = array(
                    'name' => $_REQUEST['evolt-ie-id'],
                    'link' => !empty($_REQUEST['evolt-ie-link']) ? $_REQUEST['evolt-ie-link'] : '#',
                    'old_domain' => site_url()
                );

                /**
                 * Export demo information
                 */
                evolt_ie_export_demo_info($folder_dir . 'demo-info.json', $demo_info);


                /**
                 * Export woo attributes
                 */
                evolt_woo_attributes_export($folder_dir . 'woo_attributes.json');

                /**
                 * Export extra options
                 */
                evolt_ie_extra_options_export($folder_dir . 'extra-options.json', $options);

                /**
                 * Export _elementor_data
                 */
                $elemetor_data = [];
                $post_types = get_post_types();
                $posts = get_posts([
                    'numberposts' => -1,
                    'post_type' => $post_types,
                ]);
                if($posts){
                    foreach ($posts as $key => $post) {
                        $elements = get_post_meta($post->ID, '_elementor_data', true);
                        if ( is_string( $elements ) && ! empty( $elements ) ) {
                            $elemetor_data[$post->ID] = $elements;
                        }
                    }
                }
                evolt_ie_export_elementor_data($folder_dir . '_elementor_data.json', $elemetor_data);

                /**
                 * Export main
                 */
                foreach ($_REQUEST['evolt-ie-data-type'] as $type) {
                    switch ($type) {
                        case 'attachment':
                            evolt_ie_media_export($folder_dir);
                            break;
                        case 'widgets':
                            evolt_ie_widgets_save_export_file($folder_dir);
                            break;
                        case 'settings':
                            evolt_ie_setting_export($folder_dir . 'settings.json');
                            break;
                        case 'options':
                            evolt_ie_options_export($folder_dir . 'options.json');
                            break;
                        case 'content':
                            evolt_ie_content_export($folder_dir);
                            break;
                        case 'revslider':
                            evolt_ie_revslider_export($folder_dir);
                            break;
                    }
                }


                evolt_term_meta_export($folder_dir . 'term-meta.json');

                /**
                 * Clear temp
                 */
                evolt_ie_clear_tmp();

                $this->evolt_ie_export_extra_table($folder_dir . 'extra-tables.json');

                do_action('evolt-ie-export-finish', $folder_dir);
            }

            /**
             * Import handle
             *
             */
            if (!empty($_REQUEST['action']) && $_REQUEST['action'] === 'evolt-import' && !empty($_REQUEST['evolt-ie-id'])) {
                $GLOBALS['import_result'] = array();
                set_time_limit(0);
                $folder_name = sanitize_title($_REQUEST['evolt-ie-id']);
                $folder_dir = evolt_ie_process_demo_folder($folder_name);
                $options = array();
                if (file_exists($folder_dir . 'options.json')) {
                    $options = json_decode(file_get_contents($folder_dir . 'options.json'), true);
                }
                $options['folder'] = $folder_dir;
                
                do_action('evolt-ie-import-start', $folder_dir);
                $this->evolt_ie_import_start($folder_dir);

                //Woocomerce attributes
                evolt_woo_attributes_import($folder_dir . 'woo_attributes.json');

                //attachment
                $manual_import = !empty($_REQUEST['manual_importing']) ? $_REQUEST['manual_importing'] : false;
                evolt_ie_media_import($options, $folder_dir, $manual_import);

                //content
                evolt_ie_content_import($options);

                //settings
                evolt_ie_setting_import($folder_dir);

                //options
                evolt_ie_options_import($options);

                //widgets
                evolt_ie_widgets_process_import_file($folder_dir);

                //extra options
                evolt_ie_extra_options_import($folder_dir . 'extra-options.json');

                //revslider
                evolt_ie_revslider_import($folder_dir);

                // import _elementor_data
                evolt_ie_import_elementor_data($folder_dir . '_elementor_data.json');

                do_action('evolt-ie-import-finish', $folder_dir);

                $this->evolt_ie_crop_images();

                evolt_term_meta_import($folder_dir . 'term-meta.json');
                /**
                 * Save demo id installed
                 */
                evolt_ie_import_finish($_REQUEST['evolt-ie-id'],$folder_dir);

                $this->evolt_ie_import_extra_table($folder_dir . 'extra-tables.json', $folder_dir);

                /**
                 * Clear tmp:
                 * $upload_dir['basedir'] . '/evolt-attachment-tmp
                 * $upload_dir['basedir'] . '/evolt-ie-demo
                 */
                evolt_ie_clear_tmp();
            }

            do_action('evolt-ie-after-handle');

            /**
             * Download zip file of all demo data
             */
            if (!empty($_REQUEST['evolt-ie-download']) && $_REQUEST['evolt-ie-download'] === 'swa' && !empty($_REQUEST['action']) && $_REQUEST['action'] === 'evolt-export') {
                $zip_file = evolt_ie_download_demo_zip();
                header("Content-type: application/zip");
                header("Content-Disposition: attachment; filename=demo-data.zip");
                header("Pragma: no-cache");
                header("Expires: 0");
                readfile($zip_file);

                @unlink($zip_file); //delete file after sending it to user

                exit();
            }

            /**
             * Regenerate thumbnails
             */
            if (!empty($_REQUEST['action']) && $_REQUEST['action'] === 'evolt-regenerate-thumbnails') {
                set_time_limit(0);
                $this->evolt_ie_crop_images();
            }

        }

        public function evolt_ie_import_woo_term(){
            $current_id = get_option('evolt_ie_demo_installed',true);
            $term_imported = get_option('evolt_ie_term_imported',"null");
            $folder_name = sanitize_title($current_id);
            $folder_dir = evolt_ie_process_demo_folder($folder_name);
            if($term_imported === "not_imported"){
                evolt_woo_attributes_term_import($folder_dir . 'woo_attributes.json');
            }
        }


        /**
         * Copy screen_shot of demo
         *
         * @param $folder_name
         */
        function evolt_ie_get_screen_shot($folder_name)
        {

            if (is_file(ct_ie()->theme_dir . $folder_name . '/screenshot.png')) {
                return;
            }

            if (!is_file(get_template_directory() . '/screenshot.png')) {
                return;
            }

            copy(get_template_directory() . '/screenshot.png', evolt_ie()->theme_dir . $folder_name . '/screenshot.png');
        }


        function evolt_ie_export_start($part)
        {
            $css_file = get_template_directory() . '/assets/css/static.css';

            if (file_exists($css_file)) {
                copy($css_file, $part . 'static.css');
            }
        }

        function evolt_ie_import_start($part)
        {
            $css = get_template_directory() . '/assets/css/static.css';

            if (file_exists($part . 'static.css')) {
                copy($part . 'static.css', $css);
            }

            evolt_import_truncate_tables();
        }

        function evolt_ie_crop_images()
        {
            global $import_result;

            /**
             * Crop image
             */
            $query = array(
                'post_type' => 'attachment',
                'posts_per_page' => -1,
                'post_status' => 'inherit',
            );

            $media = new WP_Query($query);
            if ($media->have_posts()) {
                foreach ($media->posts as $image) {
                    if (strpos($image->post_mime_type, 'image/') !== false) {
                        $image_path = get_attached_file($image->ID);
                        $metadata = wp_generate_attachment_metadata($image->ID, $image_path);
                        wp_update_attachment_metadata($image->ID, $metadata);
                    }
                }
                $import_result[] = esc_html__('Crop images successfully!', CTI_TEXT_DOMAIN);
            }
        }

        function evolt_ie_export_extra_table($file)
        {
            global $table_prefix, $wpdb, $wp_filesystem;
            $extra_tables = apply_filters('evolt_ie_extra_tables', array());
            $rs = array();
            if (!empty($extra_tables)) {
                foreach ($extra_tables as $table => $format) {
                    $rs[$table] = $wpdb->get_results('SELECT * FROM `' . $table_prefix . $table . '`', ARRAY_A);
                }
            }

            $file_contents = json_encode($rs);

            $wp_filesystem->put_contents($file, $file_contents, FS_CHMOD_FILE);
        }

        function evolt_ie_import_extra_table($file, $folder_dir)
        {
            global $table_prefix, $wpdb;
            $extra_tables = apply_filters('evolt_ie_extra_tables', array());
            global $import_result;
            if (file_exists($file)) {
                $file_contents = json_decode(evolt_ie_replace_site_url(file_get_contents($file), $folder_dir), true);
                foreach ($file_contents as $table => $datas) {
                    if (!empty($extra_tables[$table])) {
                        $wpdb->query('TRUNCATE TABLE `' . $table_prefix . $table . '`');
                        foreach ($datas as $row) {
                            $wpdb->insert($table_prefix . $table, $row, $extra_tables[$table]
                            );
                        }
                    }
                    $import_result[] = 'Import table "' . $table . '" successfully!';
                }
            }

        }
    }
}