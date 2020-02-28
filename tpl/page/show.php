<?php
use GDO\UI\GDT_Link;
use GDO\Core\ModuleLoader;
use GDO\Core\Method;
/** @var $moduleMethods Method[] **/
echo "<h3>" . t('link_sitemap') . "</h3>\n";
echo "<div class=\"gdo-sitemap\">";
foreach ($moduleMethods as $moduleName => $methods)
{
	if (count($methods))
	{
		$module = ModuleLoader::instance()->getModule($moduleName);
		echo "<ul>\n";
		echo "<li><span>{$module->displayName()}</span>\n";
		echo "<ul>\n";
		foreach ($methods as $method)
		{
			$method instanceof Method;
			$link = GDT_Link::make()->rawLabel($method->getDescription())->href($method->methodHref());
			echo "<li>{$link->renderCell()}</li>";
		}
		echo "</ul>\n";
		echo "</ul>\n";
	}
}
echo "</div>\n";
