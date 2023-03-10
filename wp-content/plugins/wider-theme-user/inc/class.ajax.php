<?php
if (! defined('ABSPATH')) {
    exit();
}
/**
 * Add Wider Theme User Core.
 *
 * @name Wider Theme User_Ajax
 * @since 1.0.0
 */
if (! class_exists('Case_Theme_User_Ajax')) {

    class Case_Theme_User_Ajax
    {

        function __construct() {
            
            /* action login */
            add_action('wp_ajax_nopriv_user_press_login', array(
                $this,
                'form_ajax_login_callback'
            ));
            /* action login facebook */
            add_action('wp_ajax_nopriv_facebook_ajax_login', array(
                $this,
                'facebook_ajax_login_callback'
            ));
            /* action register */
            add_action('wp_ajax_nopriv_form_ajax_register', array(
                $this,
                'form_ajax_register_callback'
            ));
        }

        /**
         * Register callback
         *
         * @package Wider Theme User*/
        function form_ajax_register_callback() {
            header('Content-Type: application/json');
            check_ajax_referer( Case_Theme_User::NONCE );
            /* if login data null. */
            if( empty($_REQUEST['data']) )
                die(json_encode((object)array('error'=> true, 'message' => esc_html__('Request Null', 'evolt-user-form'))));

            $register_data = $_REQUEST['data'];
            $register_data['user']  = sanitize_user($register_data['user']);
            $register_data['pass']  = esc_attr($register_data['pass']);
            $register_data['email'] = sanitize_email($register_data['email']);

            /* check user null */
            if( empty($register_data['user']) )
                die(json_encode((object)array('error'=> true, 'user_null' => esc_html__('User name null', 'evolt-user-form'))));
            /* check pass null */
            if( empty($register_data['pass']) )
                die(json_encode((object)array('error'=> true, 'pass_null' => esc_html__('Password null', 'evolt-user-form'))));
            /* check email null */
            if( empty($register_data['email']) )
                die(json_encode((object)array('error'=> true, 'email_null' => esc_html__('Email null', 'evolt-user-form'))));
            /* check valid email */
            if( $register_data['passconfirm'] != $register_data['pass'] )
                die(json_encode((object)array('error'=> true, 'passconfirm' => esc_html__('Password and confirmation password do not match.', 'evolt-user-form'))));

            /* check valid user name */
            if ( ! validate_username( $register_data['user'] ) )
                die(json_encode((object)array('error'=> true, 'user_invalid' => esc_html__('The username is not valid!', 'evolt-user-form'))));
            /* check user name exists */
            if ( username_exists( $register_data['user'] ) )
                die(json_encode((object)array('error'=> true, 'user_exists' => esc_html__('Username already exists!', 'evolt-user-form'))));
            /* check email already registed */
            if ( email_exists( $register_data['email'] ) )
                die(json_encode((object)array('error'=> true, 'email_exists' => esc_html__('Email Already in use.', 'evolt-user-form'))));
            if( $this->register_action($register_data['user'], $register_data['pass'], $register_data['email']) )
                die( json_encode((object)array('error'=> false)) );
            exit();
        }

        /**
         * To register
         *
         **/
        function register_action( $user, $pass, $email ) {
            $userdata = array(
                'user_login' => $user,
                'user_pass'  => $pass,
                'user_email' => $email
            );

            if( wp_insert_user( $userdata ) ) {
                /* check user & pass */
                if (! wp_login($user, $pass))
                    return false;

                /* get user by name. */
                $user = get_user_by('slug', $user);

                /* set login. */
                wp_set_auth_cookie( $user->data->ID, false, false );
                return true;
            }
            return false;
        }

        /**
         * Login callback.
         *
         * @package Wider Theme User
         */
        function form_ajax_login_callback()
        {
            header('Content-Type: application/json');
            check_ajax_referer( Case_Theme_User::NONCE );
            /* if login data null. */
            if(empty($_REQUEST['data']))
                die(json_encode((object)array('error'=> true, 'message' => esc_html__('Request Null', 'evolt-user-form'))));

            $login_data = $_REQUEST['data'];

            /* if user null. */
            if(empty($login_data['user']))
                die(json_encode((object)array('error'=> true, 'user' => esc_html__('User name null', 'evolt-user-form'))));

            /* if pass null. */
            if(empty($login_data['pass']))
                die(json_encode((object)array('error'=> true, 'pass' => esc_html__('Password null', 'evolt-user-form'))));

            /* rememberme */
            $login_data->rememberme = (isset($login_data['rememberme']) && $login_data['rememberme']) ? true : false;

            /* login. */
            if($this->login_action($login_data['user'], $login_data['pass'], $login_data['rememberme']))
                die(json_encode((object)array('error'=> false)));

            /* error */
            if(username_exists($login_data['user']))
                die(json_encode((object)array('error'=> true, 'pass'=> esc_html__('Password incorrect', 'evolt-user-form'))));

            die(json_encode((object)array('error'=> true, 'user'=> esc_html__('User incorrect', 'evolt-user-form'))));
        }

        /**
         * Login action
         **/
        function login_action($user, $pass, $rememberme = false)
        {
            /* check user & pass */
            if (! wp_login($user, $pass))
                return false;

            /* get user by name. */
            $user = get_user_by('slug', $user);

            /* set login. */
            wp_set_auth_cookie( $user->data->ID, $rememberme, false );

            return true;
        }

        /**
         * Login Facebook call back
         *
         */
        function facebook_ajax_login_callback() {
            check_ajax_referer( Case_Theme_User::NONCE );
            if( empty($_REQUEST['data']) )
                die(json_encode((object)array('error'=> true, 'message' => esc_html__('Request Null', 'evolt-user-form'))));

            $login_data = $_REQUEST['data'];

            if( empty($login_data['name']) )
                die(json_encode((object)array('error'=> true, 'name_null' => esc_html__('Facebook user name null', 'evolt-user-form'))));

            if( empty($login_data['email']) )
                die(json_encode((object)array('error'=> true, 'email_null' => esc_html__('Email null', 'evolt-user-form'))));

            $userdata = array(
                'user_login' => 'Facebook - ' . sanitize_user($login_data['name']),
                'user_pass'  => 'u$3r' . str_replace(' ', '', strtolower($login_data['name'])) . 'pr3$$',
                'user_email' => sanitize_email($login_data['email'])
            );

            if( username_exists( $userdata['user_login'] ) ) {

                /* check user & pass */
                if (! wp_login( $userdata['user_login'], $userdata['user_pass']) )
                    die(json_encode((object)array('error'=> true, 'user'=> esc_html__('The user is incorrect', 'evolt-user-form'))));

                /* get user by name. */
                $user = get_user_by( 'email', $userdata['user_email'] );

                /* set login. */
                wp_set_auth_cookie( $user->data->ID, false, false );
                die( json_encode((object)array('error' => false)) );
            } else {
                if( $this->register_action($userdata['user_login'], $userdata['user_pass'], $userdata['user_email']) )
                    die( json_encode((object)array('error' => false)) );
            }
            die(json_encode((object)array('error'=> true, 'user'=> esc_html__('The user is incorrect', 'evolt-user-form'))));
        }
    }
    
    new Case_Theme_User_Ajax();
}