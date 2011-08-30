Facebook Service

This allows users to post in the facebook wall through supported plugins.

To enable:
	1. Enable in the Tool Administration page.
	2. Visit http://developers.facebook.com and register your site with Facebook.
		* The callback URL is http://yoursite.com/pg/facebookservice/authorize.
		* The access type MUST be Read & Write.
	3. Copy the API ID and the API Secret from the Facebook application
	   page to the facebooservice settings sections on Elgg's Tool Administration page.
	4. Visit the Elgg User Settings page by clicking the "Settings" link at the top of the page.
	   Go to "Configure your tools" and authorize your Facebook account.
	5. Check the plugins you want to allow to Post.

Note: Users MUST authorize their Facebook accounts AND select plugins that
are allowed to post before Facebook will accept any posts.


Developers:
	You can register your plugin to provide Facebook integration.
	
	1.  Respond to the "plugin_list", "facebook_services" plugin hook:
		register_plugin_hook('plugin_list', 'facebook_service', 'blog_facebook_integration');

		function blog_facebook_integration($hook, $type, $value, $params) {
			return $value['blog'] = array(
				'name' => 'Blog',
				'description' => 'Post the characters of all public blog posts' 
			);

		}

	2.  When you want to post, emit a "fb_status", "facebook_services" plugin hook:
	
		file: actions/blog/save.php

		$blog = new ElggBlog();
		$blog->body = get_input('body');
		$blog->title = get_input('title');

		if ($blog->save()) {
			$params = array(
				// plugin here must match the array index in the callback for "plugin_list", "facebook_services"
				'plugin' => 'blog',
				'message' => elgg_get_excerpt($blog->body, 140)
			);
			trigger_plugin_hook("tweet", "facebook_services", $params);
		}
