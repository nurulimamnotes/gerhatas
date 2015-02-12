<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
wp_reset_query();

do_action( 'yit_before_sidebar_topbarright' ); ?>

<?php if(yit_get_option('show-topbar-login')): ?>
    <div class="topbar_login widget">
        <?php
        //login/register
        if( is_shop_installed() ) {
            $accountPage = get_permalink( get_option('woocommerce_myaccount_page_id') );
            if( is_user_logged_in() ) {
                global $current_user;
                get_currentuserinfo();

                $user_name = $current_user->user_firstname . ' ' . $current_user->user_lastname;
                if( $user_name == ' ' ) {
                    $user_name = __('user', 'yit');
                }

                $output  = '<span class="welcome_username">' . __('Welcome, ', 'yit') . apply_filters( 'yit_welcome_username', $user_name ) . '</span> <span> / </span> ';
                $output .= '<a href="' . $accountPage . '">' . __('My Account', 'yit') . '</a> <span> / </span> ';
                $output .= '<a href="' . wp_logout_url( home_url() ) . '">' . __('Logout', 'yit') . '</a>';
            } else {
                $output  = '<a href="' . $accountPage . '">' . __('Login', 'yit') . ' <span> / </span> ' . __('Register', 'yit') . '</a>';
            }
        } else {
            if( is_user_logged_in() ) {
                global $current_user;
                get_currentuserinfo();

                $user_name = $current_user->user_firstname . ' ' . $current_user->user_lastname;
                if( $user_name == ' ' ) {
                    $user_name = __('user', 'yit');
                }

                $output  = '<span class="welcome_username">' . __('Welcome, ', 'yit') . $user_name . '</span> <span> / </span> ';
                $output .= '<a href="' . wp_logout_url( home_url() ) . '">' . __('Logout', 'yit') . '</a>';
            } else {
                $output  = '<a href="' . wp_login_url() . '">' . __('Login', 'yit') . '</a>';
                $output .= wp_register(' <span> / </span> ','', false);
            }
        }

        echo $output;
        ?>
    </div>
<?php endif ?>

<?php if( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Topbar Right' ) ) { }
do_action( 'yit_after_sidebar_topbarright' );