<?php
/*
Plugin Name: Contact Form 7 Leads Integrate in Zoho
Description: Contact Form 7 leads integrate in ZOHO CRM, Please make sure <strong>contact form 7</strong> should be install and activate
Version: 1.3.1
Author: inoday
Author URI: http://inoday.com/
License: MIT
*/

//Do not change this value
define( 'CF7LIZ_VERSION', '1.3.1' );
define( 'CF7LIZ__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

//Include plugin setting file
include CF7LIZ__PLUGIN_DIR . 'admin/admin.php';

        
add_action('wpcf7_before_send_mail', 'cf7liz_wpcf7_mail_sent_function' );
include_once(CF7LIZ__PLUGIN_DIR . 'libs/Cf7liz-lib.php');

function cf7liz_wpcf7_mail_sent_function($WPCF7_ContactForm)
{

	$options = get_option('cf7liz_plugin_options');
	
	$auth = $options['auth_token'];
	$title = $WPCF7_ContactForm->title;  
	
	$submission = WPCF7_Submission::get_instance();        
	$posted_data = $submission->get_posted_data();
	$name = $posted_data['your-name'];
	$email = $posted_data['your-email'];
	$mobile = $posted_data['your-phone'];
	$message = ($posted_data['your-message']) ? $posted_data['your-message'] : "No Message";
	
	$Cf7lizObj 	= new Cf7liz_Lib();
	$company	= $options['company'];
	$name   	= $name;
	$email  	= $email;
	$mobile 	= $mobile;
	$message 	= $message;
	$result 	= $Cf7lizObj->cf7liz_postData($auth, $company, $name, $email, $mobile, $message);
}

?>