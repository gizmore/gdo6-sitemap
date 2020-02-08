<?php
namespace GDO\Sitemap\Method;

use GDO\UI\MethodPage;
use GDO\Core\ModuleLoader;
use GDO\Core\GDO_Module;
use GDO\Install\Installer;
use GDO\Util\Strings;
use GDO\User\GDO_User;
use GDO\Core\Method;
use GDO\Cronjob\MethodCronjob;

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
			if ($this->showInSitemap($module, $method, $user))
			{
				$methods[] = $method;
			}
		});
		return $methods;
	}
	
	private function showInSitemap(GDO_Module $module, Method $method, GDO_User $user)
	{
		if (!$method->hasUserPermission($user))
		{
			return false;
		}
		
		if ($method instanceof MethodCronjob)
		{
			return false;
		}
		
		
		
	}
	
}
