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

register_elgg_event_handler('init','system','facebookservice_init');

function facebookservice_init() {
    
    global $CONFIG;
    
    // require libraries
    require_once "{$CONFIG->pluginspath}facebookservice/facebookservice_lib.php";

    if (!class_exists('Facebook')) {
            require_once "{$CONFIG->pluginspath}facebookservice/sdk/facebook.php";
    }
       
    // register page handler
    register_page_handler('facebookservice', 'facebookservice_pagehandler');

    // allow plugin authors to hook into this service
    register_plugin_hook('facebookstatus', 'facebook_service', 'facebookservice_fb_status');
}

function facebookservice_pagehandler($page) {
	if (!isset($page[0])) {
		forward();
	}

	switch ($page[0]) {
		case 'authorize':
			facebookservice_authorize();
			break;
		case 'revoke':
			facebookservice_revoke();
			break;
		case 'forward':
			facebookservice_forward();
			break;
		default:
			forward();
			break;
	}
}

function facebookservice_fb_status($hook, $entity_type, $returnvalue, $params) {
	if (!facebookservice_can_status($params['plugin'])) {
		return NULL;
	}

	// check admin settings
	$api_id = get_plugin_setting('api_id', 'facebookservice');
	$api_secret = get_plugin_setting('api_secret', 'facebookservice');
	if (!($api_id && $api_secret)) {
		return NULL;
	}

	// check user settings
	$user_id = get_loggedin_userid();
	$facebook_uid = get_plugin_usersetting('facebook_uid', $user_id, 'facebookservice');
	$facebook_token = get_plugin_usersetting('facebook_token', $user_id, 'facebookservice');
	if (!($facebook_uid && $facebook_token)) {
		return NULL;
	}
     
 
        $facebook = new Facebook(array(
                    'appId' => $api_id,
                    'secret' => $api_secret
                      ));
               
        $fb_name_post = get_plugin_setting('fb_name_post', 'facebookservice');
	    $fb_link_post = get_plugin_setting('fb_link_post', 'facebookservice');
        $fb_description_post = get_plugin_setting('fb_description_post', 'facebookservice');
        $fb_image_post = get_plugin_setting('fb_image_post', 'facebookservice');
        
        $fb_post = array();
        
        //message to post
        $fb_post['access_token'] = $facebook_token;//important if offline_access can publish into facebook

        $fb_post['message'] = $params['message'];
        
        //information extra to post with mesagge
        if($fb_link_post!='')
           $fb_post['link'] = $fb_link_post;
        
        if($fb_image_post!='')
           $fb_post['picture'] = $fb_image_post;
        
        if($fb_name_post!='')
           $fb_post['name'] = $fb_name_post;
        
        if($fb_description_post!='')
           $fb_post['description'] = $fb_description_post;
        
         
        //Facebook Wall Update
         try {
            $publishStream = $facebook->api("/$facebook_uid/feed", 'post', $fb_post);
         } catch (FacebookApiException $e) {
            register_error('Error facebookservice'.$e);
         }
         return TRUE;        
}
