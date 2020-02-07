<?php
namespace GDO\Sitemap;

use GDO\Core\GDO_Module;
use GDO\UI\GDT_Bar;
use GDO\UI\GDT_Link;

/**
 * Build a sitemap reachable from the bottom bar.
 * 
 * @author gizmore
 * @since 6.10
 * @version 6.10
 */
final class Module_Sitemap extends GDO_Module
{
	##############
	### Module ###
	##############
	public function onLoadLanguage() { return $this->loadLanguage('lang/sitemap'); }
	
	#############
	### Hooks ###
	#############
	public function hookBottomBar(GDT_Bar $bar)
	{
		$bar->addField(GDT_Link::make('link_sitemap')->href($this->href('Show')));
	}
}
