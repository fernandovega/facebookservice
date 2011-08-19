<?php
/**
 * An english language definition file
 */

$espanol = array(
	'facebookservice' => 'Servicio de Facebook',
         //Admin config
	'facebookservice:api_id' => 'API facebook ID',
	'facebookservice:api_secret' => 'API facebook Secret',
        'facebookservice:fb_name_post' => 'Nombre',
        'facebookservice:fb_link_post' => 'Enlace',
        'facebookservice:fb_description_post' => 'Descripción',
        'facebookservice:fb_image_post' => 'URL de imagen',
        'facebookservice:fb_msj_config' => 'Para configurar este plugin debes de registrar tu aplicación en: <a href="http://developers.facebook.com">facebook developers</a>.
                                            <br /><br />Si deseas complementar cada publicación de facebook con información extra, llena los siguientes campos',
        
        //User config
	'facebookservice:usersettings:description' => "<b>Sincroniza tu cuenta de {$CONFIG->site->name} con Facebook.</b>",
	'facebookservice:usersettings:request' => "Lo primero que debes haces es <a href=\"%s\">Autorizar</a> {$CONFIG->site->name} el acceso a tu cuenta de Facebook.",
	'facebookservice:authorize:error' => 'Deshabilitar autorización a  Facebook.',
	'facebookservice:authorize:success' => 'Tu acceso a Facebook ha sido autorizado.',

	'facebookservice:usersettings:authorized' => "<b><i>Sincronización exitosa</i></b><br /><br />Has autorizado a {$CONFIG->site->name} para acceder a tu cuenta de Facebook: <a href=\"http://www.facebook.com/profile.php?id=%s\"> %s </a>.  Si tu cambio de estado no se muestra en tu muro de facebook, necesitas reautorizar tu cuenta.  Haga clic en revocar acceso, y luego ir a Configuración de <a href=\"http://www.facebook.com/settings?tab=applications\"> Facebook </a> y revocar el acceso para %s. Luego regresa a esta página y autorizar de nuevo.",
	
        'facebookservice:usersettings:revoke' => '<a href="%s">Revocar acceso.</a>',

        'facebookservice:revoke:success' => 'El acceso a Facebook ha sido revocado',

	'facebookservice:usersettings:allowed_plugins' => 'Herramientas soportadas',
);

add_translation('es', $espanol);
