<?php
namespace GDO\Sitemap\Method;

use GDO\UI\MethodPage;
use GDO\Core\ModuleLoader;
use GDO\Core\GDO_Module;
use GDO\Install\Installer;
use GDO\Util\Strings;
use GDO\User\GDO_User;

/**
 * Show all available module methods.
 * @author gizmore
 */
final class Show extends MethodPage
{
	protected function getTemplateVars()
	{
		return array(
			'moduleMethods' => $this->getModuleMethods(),
		);
	}
	
	private function getModuleMethods()
	{
		$moduleMethods = array();
		foreach (ModuleLoader::instance()->getEnabledModules() as $module)
		{
			$moduleMethods[$module->getName()] = $this->getModuleMethodsB($module);
		}
		return $moduleMethods;
	}
	
	private function getModuleMethodsB(GDO_Module $module)
	{
		$methods = array();
		$user = GDO_User::current();
		Installer::loopMethods($module, function($entry, $fullpath, $args=null) use($module, &$methods, $user) {
			$method = $module->getMethod(Strings::rsubstrTo($entry, '.php'));
			if ($method->hasUserPermission($user))
			{
// 				if (empty($method->gdoParameters()))
				{
					$methods[] = $method;
				}
			}
		});
		return $methods;
	}
	
}
