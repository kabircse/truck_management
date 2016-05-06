<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function is_logged_in() {
    // Get current CodeIgniter instance
    $CI =& get_instance();
    // We need to use $CI->session instead of $this->session
    $user = $CI->session->userdata('is_logged_in');
	if(isset($user) && $user == true) { return true; } else { return false; }
    //if (!isset($user)) { return false; } else { return true; }
}