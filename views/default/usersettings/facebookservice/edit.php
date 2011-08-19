<?php
/**
 * Facebook Service
 *
 * @package facebookservice
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Fernando Vega fvega@ugto.mx
 * @copyright Universidad de Guanajuato, México
 * @link http://www.dti.ugto.mx
 */

$api_id = get_plugin_setting('api_id', 'facebookservice');
	$api_secret = get_plugin_setting('api_secret', 'facebookservice');
$user_id = get_loggedin_userid();
$facebook_name = get_plugin_usersetting('facebook_name', $user_id, 'facebookservice');
$facebook_uid = get_plugin_usersetting('facebook_uid', $user_id, 'facebookservice');
$facebook_token = get_plugin_usersetting('facebook_token', $user_id, 'facebookservice');
$plugins  = facebookservice_get_fbstatus_plugins();
//echo $api_id.'  '.$api_secret;

echo '<p>' . elgg_echo('facebookservice:usersettings:description') . '</p>';

if (!$facebook_uid || !$facebook_token) {
	// send user off to validate account
	$request_link = facebookservice_get_authorize_url($vars['url'].'pg/facebookservice/authorize');
	echo '<p>' . sprintf(elgg_echo('facebookservice:usersettings:request'), $request_link) . '</p>';
} else {
	$url = "{$CONFIG->site->url}pg/facebookservice/revoke";
	echo '<p class="facebook_anywhere">' . sprintf(elgg_echo('facebookservice:usersettings:authorized'), $facebook_uid,$facebook_name, $vars['config']->site->name) . '</p>';
	echo '<p>' . sprintf(elgg_echo('facebookservice:usersettings:revoke'), $url) . '</p>';

	// allow granular plugin access to facebook
	echo '<h3>' . elgg_echo('facebookservice:usersettings:allowed_plugins') . '</h3><br />';

	foreach ($plugins as $plugin => $info) {
		$name = "allowed_plugin:$plugin";
		$checked = (facebookservice_can_status($plugin, $user_guid)) ? 'checked = checked' : '';

		// can't use input because it doesn't work correctly for sending a single checkbox.
		echo "<input type=\"hidden\" name=\"params[$name]\" value=\"0\" />
			<label><input type=\"checkbox\" name=\"params[$name]\" value=\"1\" $checked />"
			. elgg_echo($info['name']) . '</label>
			<p class="facebookservice_usersettings_desc">' . $info['description'] . '</p>
			';
	}
}
