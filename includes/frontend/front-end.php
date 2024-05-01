<?php

	/** Show Message in footer when plugin is enabled **/
	add_action( 'wp_footer', 'wcShowMessagePluginActive' );
	if (!function_exists('wcShowMessagePluginActive')) 
	{
		function wcShowMessagePluginActive() 
		{
			$user = get_current_user();
			$user_id = get_current_user_id();
			$user = get_userdata( $user_id );

			if ($user && isset($user->roles)) 
			{
				$roles = $user->roles; // Array of roles
				if (in_array('administrator', $roles)) 
				{
					$custom_options = get_option( 'email_redirection_test' ); 
					$C_email = $custom_options['email'];
					$C_checkval = $custom_options['enable'];
					
					if($C_checkval == 'true')
					{
						echo '<style>
						p.wc-email-redirect-msg 
						{
							position: fixed;
							bottom: 0;
							background: red;
							width: 100%;
							left: 0;
							text-align: center;
							margin: 0;
							color: #fff;
						}
						</style>';

						echo '<p class="wc-email-redirect-msg">All emails are currently being redirected for testing purposes. Kindly disable the redirection once testing is complete.</p>';
					}			
				}
			}
		}
	}

	/** Redirect all mails to test mail **/
	add_filter('wp_mail','wc_wp_mail', 9999,1);
	if (!function_exists('wc_wp_mail')) 
	{
		function wc_wp_mail( $args )
		{
			$custom_options = get_option( 'email_redirection_test' ); 
			$C_email = $custom_options['email'];
			$C_checkval = $custom_options['enable'];

			if($C_checkval === 'true')
			{
				$args['to'] = $C_email;
			}
			return $args;
		}
	}