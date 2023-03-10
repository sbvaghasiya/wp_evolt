<?php

if (!defined('ABSPATH')) {
    die();
}

if (!class_exists('EVOLT_Redux_Extensions')) {
    class EVOLT_Redux_Extensions {
        public static $instance = null;
        public $file;
        public $basename;
        public $plugin_directory;
        public $plugin_directory_uri;
        public $extensions;
        public $extensions_url;

        public static function instance() {
            if (!class_exists('ReduxFramework')) {
                return;
            }
            if (is_null(self::$instance)) {
                self::$instance = new EVOLT_Redux_Extensions();
                self::$instance->define_variable();
                self::$instance->extensions_actions();
            }

            return self::$instance;
        }

        private function define_variable()
        {
            $this->extensions = EVOLT_PATH . 'inc/extensions/';
            $this->extensions_url = EVOLT_URL . 'inc/extensions/';
        }

        private function extensions_actions() {
            add_action('redux/extensions/before', array($this, 'evolt_register_extensions'));
        }

        function evolt_register_extensions($ReduxFramework) {
            $path = $this->extensions;
            $folders = scandir($path, 1);

            foreach ($folders as $folder) {
                if ($folder === '.' or $folder === '..' or !is_dir($path . $folder)) {
                    continue;
                }
                $extension_class = 'EVOLT_Redux_Extensions_' . $folder;
 
                if (!class_exists($extension_class)) {
                    // In case you wanted override your override, hah.
                    $class_file = $path . $folder . '/extension_' . $folder . '.php';
                    $class_file = apply_filters('redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file);
                    if ($class_file) {
                        require_once($class_file);
                    }
                }

                if (!isset($ReduxFramework->extensions[$folder])) {
                    $ReduxFramework->extensions[$folder] = new $extension_class($ReduxFramework);
                }

                // patch Redux Extension errors
                $instance_extensions = Redux::get_extensions( $ReduxFramework->args['opt_name'], '' );
                if ( ! empty( $instance_extensions ) ) {
                    foreach ( $instance_extensions as $name => $extension ) {
                        $ext_class = $extension['class'];
                        $ext_class = preg_replace_callback('/_([a-z]?)/', function($match) {
                            return strtoupper($match[0]);
                        }, $ext_class);
                        $ReduxFramework->extensions[ $name ]      = new $ext_class($ReduxFramework);
                    }
                }
            }
        }
    }
}

if (!function_exists('evolt_redux_extensions')) {
    function evolt_redux_extensions() {
        return EVOLT_Redux_Extensions::instance();
    }
}

$GLOBALS['evolt_redux_extensions'] = evolt_redux_extensions();