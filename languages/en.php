<?php
/**
 * An english language definition file
 */

$english = array(
	'facebookservice' => 'Facebook Services',

	'facebookservice:api_id' => 'API ID',
	'facebookservice:api_secret' => 'API Secret',
        'facebookservice:fb_name_post' => 'Name',
        'facebookservice:fb_link_post' => 'Link',
        'facebookservice:fb_description_post' => 'Description',
        'facebookservice:fb_image_post' => 'Image URL',
        'facebookservice:fb_msj_config' => 'To configure this plugin you must register your application: <a href="http://developers.facebook.com">facebook developers</a>
                                            <br/ ><br />If you want to publish extra information in each post, fill the fields below.',

	'facebookservice:usersettings:description' => "Link your {$CONFIG->site->name} account with Facebook.",
	'facebookservice:usersettings:request' => "You must first <a href=\"%s\">authorize</a> {$CONFIG->site->name} to access your Facebook account.",
	'facebookservice:authorize:error' => 'Unable to authorize Facebook.',
	'facebookservice:authorize:success' => 'Facebook access has been authorized.',

	'facebookservice:usersettings:authorized' => "You have authorized {$CONFIG->site->name} to access your Facebook account: <a href=\"http://www.facebook.com/profile.php?id=%s\"> %s </a>.  If post in the wall aren't showing up, you might need to reauthorize.  Click revoke below, then go to <a href=\"http://www.facebook.com/settings?tab=applications\">Facebook Connection Settings</a> and revoke access for %s.  Then come back to this page and authorize again.",
	'facebookservice:usersettings:revoke' => 'Click <a href="%s">here</a> to revoke access.',
	'facebookservice:revoke:success' => 'Facebook access has been revoked.',

	'facebookservice:usersettings:allowed_plugins' => 'Allowed Plugins',
);

add_translation('en', $english);
