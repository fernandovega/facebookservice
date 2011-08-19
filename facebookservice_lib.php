<?php
/**
 * Common library of functions used by Facebook Services.
 *
 * @package facebookservice
 * Facebook Service
 *
 * @package facebookservice
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Fernando Vega fvega@ugto.mx
 * @copyright Universidad de Guanajuato, México
 * @link http://www.dti.ugto.mx
 */


/**
 * User-initiated Facebook authorization
 *
 * Callback action from Facebook registration. Registers a single Elgg user with
 * the authorization tokens. Will revoke access from previous users when a
 * conflict exists.
 *
 * Depends upon {@link facebookservice_get_authorize_url} being called previously
 * to establish session request tokens.
 */
function facebookservice_authorize() {
        global $SESSION;

	$api_id = get_plugin_setting('api_id', 'facebookservice');
	$api_secret = get_plugin_setting('api_secret', 'facebookservice');
    
        $facebook = new Facebook(array(
                'appId' => $api_id,
                'secret' => $api_secret
            ));
        $user       = $facebook->getUser();
        
        if ($user) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $facebook_code = $_SESSION['fb_'.$api_id.'_code'];
                $facebook_token = $_SESSION['fb_'.$api_id.'_access_token'];
                $facebook_id = $_SESSION['fb_'.$api_id.'_user_id'];

                $user_profile = $facebook->api('/me');

                // Updating Facebook values into Users settings                              
                set_plugin_usersetting('facebook_name', $user_profile['name']); //Name register in facebbok
                set_plugin_usersetting('facebook_uid', $facebook_id);
                set_plugin_usersetting('facebook_token', $facebook_token);
                set_plugin_usersetting('facebook_code', $facebook_code);
                system_message(elgg_echo('facebookservice:authorize:success'));
            } catch (FacebookApiException $e) {
                //you should use error_log($e); instead of printing the info on browser
                register_error('Error facebookservice'.$e);  // d is a debug function defined at the end of this file
                $user = null;
            }
        }

        forward('pg/settings/plugins');
	
}

function facebookservice_revoke() {
    // unregister user's access var's
    set_plugin_usersetting('facebook_uid', NULL);
    set_plugin_usersetting('facebook_token', NULL);
    set_plugin_usersetting('facebook_name', NULL);
    set_plugin_usersetting('facebook_code', NULL);

    system_message(elgg_echo('facebookservice:revoke:success'));
    forward('pg/settings/plugins');
}

function facebookservice_get_authorize_url($callback=NULL) {
    global $SESSION;
    $api_id = get_plugin_setting('api_id', 'facebookservice');
    $api_secret = get_plugin_setting('api_secret', 'facebookservice');

    $facebook = new Facebook(array(
                'appId' => $api_id,
                'secret' => $api_secret
            ));

    $url = $facebook->getLoginUrl(
                    array(
                        'scope' => 'user_about_me,email,user_birthday,offline_access,publish_stream,status_update',
                        'redirect_uri' => $callback
                    )
    );

    return $url;
}

/**
 * Returns a list of plugins registered to change user status in facebook.
 *
 * @param array $recache
 */
function facebookservice_get_fbstatus_plugins($recache = FALSE) {
	static $plugins;

	if (!$plugins || $recache) {
		$plugins = trigger_plugin_hook('plugin_list', 'facebook_service', NULL, array());
	}

	return $plugins;
}

/**
 * Can a plugin can change facebook status for $user_guid.
 *
 * @param $plugin
 * @param $user_guid
 * return bool
 */
function facebookservice_can_status($plugin, $user_guid = NULL) {
	if ($user_guid === NULL) {
		$user_guid = get_loggedin_userid();
	}

	$name = "allowed_plugin:$plugin";
	return (bool) get_plugin_usersetting($name, $user_id, 'facebookservice');
}
