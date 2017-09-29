<?php
namespace Vanderbilt\PluginSettings;

class PluginSettings extends \ExternalModules\AbstractExternalModule{

	protected function getSettingKeyPrefix(){
		$requestUri = $_SERVER['REQUEST_URI'];

		$parts = explode(APP_PATH_WEBROOT_PARENT . 'plugins/', $requestUri);
		if(count($parts) != 2){
			// This method should not be called outside of plugin URIs, but let's just return the default here to be safe.
			return parent::getSettingKeyPrefix();
		}

		$parts = explode('/', $parts[1]);
		$pluginDir = $parts[0];

		return $pluginDir . '_';
	}
}