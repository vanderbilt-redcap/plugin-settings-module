<?php
namespace Vanderbilt\PluginSettings;

class PluginSettings extends \ExternalModules\AbstractExternalModule{

	public function __construct(){
		parent::__construct();
		$this->disableUserBasedSettingPermissions();
	}

	protected function getSettingKeyPrefix(){
		$requestUri = $_SERVER['REQUEST_URI'];

		$parts = [];
		if ($requestUri) {
			# web
			$parts = explode(APP_PATH_WEBROOT_PARENT . 'plugins/', $requestUri);
		} else {
			# command line
			$filename = self::getAbsolutePathOfScript();
			if ($filename) {
				$redcapRoot = realpath(APP_PATH_DOCROOT . "../");
				$parts = explode($redcapRoot . 'plugins/', $filename);
			}
		}
		if(count($parts) != 2){
			// This method should not be called outside of plugin URIs, but let's just return the default here to be safe.
			return parent::getSettingKeyPrefix();
		}

		$parts = explode('/', $parts[1]);
		$pluginDir = $parts[0];

		return $pluginDir . '_';
	}

	protected static function getAbsolutePathOfScript() {
		global $argv;
		if ($argv[0]) {
			return realpath($argv[0]);
		}
		return "";
	}
}
