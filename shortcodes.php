<?php
function loginout_shortcode() {
    $ret = '';
    if (is_user_logged_in()) {
        $ret = '<a href="' . wp_logout_url( home_url() ) . '" >' . __('Sign out', 'wet-boew') . '</a>';
    } else {
        $ret = '<a href="' . wp_login_url( get_permalink() ) . '" >' . __('Sign in', 'wet-boew') . '</a>';
    }
    return $ret;
}
add_shortcode( 'loginout', 'loginout_shortcode' );
