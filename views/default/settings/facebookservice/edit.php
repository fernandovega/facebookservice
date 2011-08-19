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

$api_id_string = elgg_echo('facebookservice:api_id');
$api_id_view = elgg_view('input/text', array(
	'internalname' => 'params[api_id]',
	'value' => $vars['entity']->api_id,
	'class' => 'text_input',
));

$api_secret_string = elgg_echo('facebookservice:api_secret');
$api_secret_view = elgg_view('input/text', array(
	'internalname' => 'params[api_secret]',
	'value' => $vars['entity']->api_secret,
	'class' => 'text_input',
));

$fb_name_post_string = elgg_echo('facebookservice:fb_name_post');
$fb_name_post_view = elgg_view('input/text', array(
	'internalname' => 'params[fb_name_post]',
	'value' => $vars['entity']->fb_name_post,
	'class' => 'text_input',
));

$fb_link_post_string = elgg_echo('facebookservice:fb_link_post');
$fb_link_post_view = elgg_view('input/text', array(
	'internalname' => 'params[fb_link_post]',
	'value' => $vars['entity']->fb_link_post,
	'class' => 'text_input',
));

$fb_description_post_string = elgg_echo('facebookservice:fb_description_post');
$fb_description_post_view = elgg_view('input/text', array(
	'internalname' => 'params[fb_description_post]',
	'value' => $vars['entity']->fb_description_post,
	'class' => 'text_input',
));

$fb_image_post_string = elgg_echo('facebookservice:fb_image_post');
$fb_image_post_view = elgg_view('input/text', array(
	'internalname' => 'params[fb_image_post]',
	'value' => $vars['entity']->fb_image_post,
	'class' => 'text_input',
));

$fb_msj_config_string = elgg_echo('facebookservice:fb_msj_config');

$settings = <<<__HTML
<div id="facebookservice_site_settings">
	<div>$api_id_string $api_id_view</div>
	<div>$api_secret_string $api_secret_view</div>        
        <p>$fb_msj_config_string</p>
        <div>$fb_name_post_string $fb_name_post_view</div>
        <div>$fb_link_post_string $fb_link_post_view</div>
        <div>$fb_description_post_string $fb_description_post_view</div>
        <div>$fb_image_post_string $fb_image_post_view</div>
</div>
__HTML;

echo $settings;
