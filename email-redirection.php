<?php 
/*
Plugin Name: Email redirection
description: All emails are currently being redirected for testing purposes.
Author: Wc
*/

add_action('plugins_loaded', 'wcOverrideAllEmails');
if(!function_exists('wcOverrideAllEmails'))
{
  function wcOverrideAllEmails()
  {
    if(!defined('WE_DIR'))
		{
			define('WE_DIR', plugin_dir_path(__FILE__));	
		}

    if(file_exists(plugin_dir_path(__FILE__).'includes/includes.php'))
    {  
      include_once plugin_dir_path(__FILE__).'includes/includes.php';
    }  
  }
}
