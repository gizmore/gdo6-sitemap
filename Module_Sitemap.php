<?php
namespace GDO\Sitemap;

use GDO\Core\GDO_Module;
use GDO\UI\GDT_Link;
use GDO\DB\GDT_Checkbox;
use GDO\UI\GDT_Page;

/**
 * Build a sitemap reachable from the bottom bar.
 * 
 * @author gizmore
 * @version 6.10
 * @since 6.10
 */
final class Module_Sitemap extends GDO_Module
{
	##############
	### Module ###
	##############
	public function onLoadLanguage() { return $this->loadLanguage('lang/sitemap'); }
	
	public function getConfig()
	{
	    return [
	        GDT_Checkbox::make('bottom_bar')->initial('1'),
	    ];
	}
	public function cfgBottomBar() { return $this->getConfigValue('bottom_bar'); }
	
	#############
	### Hooks ###
	#############
	public function onInitSidebar()
	{
	    if ($this->cfgBottomBar())
	    {
	        GDT_Page::$INSTANCE->bottomNav->addField(GDT_Link::make('link_sitemap')->href($this->href('Show')));
	    }
	}

}
