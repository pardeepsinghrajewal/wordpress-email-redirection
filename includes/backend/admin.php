<?php

	/** Added custom page in admin for override all email **/
	add_action('admin_menu', 'wcRedirectEmailsPage');
	if (!function_exists('wcRedirectEmailsPage')) 
	{
		function wcRedirectEmailsPage() 
		{
			add_menu_page(
				'Email Redirection',
				'Email Redirection',
				'manage_options',
				'email-redirection',
				'wcSaveEmailInOptionTable');
		}
	}

	/** Insert email in option table for override all email using in website **/
	if (!function_exists('wcSaveEmailInOptionTable')) 
	{
		function wcSaveEmailInOptionTable()
		{
			if(isset($_POST['submit'])) 
			{
				$email = $_POST['email'];
				$check_val = isset($_POST['enable']) && $_POST['enable'] == 'true' ? 'true' : 'false';
				$existing_data = get_option('email_redirection_test', array());
				$existing_data['email'] = $email;
				$existing_data['enable'] = $check_val;
			
				update_option('email_redirection_test', $existing_data);
			}

			$custom_options = get_option( 'email_redirection_test' ); 
			$C_email = $custom_options['email'];
			$C_checkval = $custom_options['enable'];

			if($C_checkval == 'true')
			{
				$check = 'checked';
			}else{
				$check = '';
			}
			?>
				<h2>Please provide the email address to which you would like all emails redirected</h2>
				<form method="post">
					<h3 for="email">Email</h3>
					<input type="email" id="email" name="email" value="<?php echo $C_email; ?>">
					<h3>Enable/disable</disable></h3>
					<input type="checkbox" name="enable" value="true" <?php echo $check; ?>><br>
					<input type="submit" name="submit" value="Submit">
				</form>
			<?php
		}
	}

	/** Show message for remenber email override plugin is activated **/
	add_action('admin_notices', 'wcShowMessageForActivePlugin');
	if (!function_exists('wcShowMessageForActivePlugin')) 
	{
		function wcShowMessageForActivePlugin()
		{
			global $pagenow;
			$custom_options = get_option( 'email_redirection_test' ); 
			$C_email = $custom_options['email'];
			$C_checkval = $custom_options['enable'];
			if ($C_checkval === 'true')
			{
				echo '<div class="updated"><p>All emails are currently being redirected for testing purposes. Kindly disable the redirection once testing is complete.</p></div>';
			}
		}
	}