<?php

/**
 * @package Plugin system - jshoppingcollectitems for Joomla! 3.x and Joomla 4 
 * @version $Id: system - jshoppingcollectitems 1.0.0 2022-10-12 23:26:33Z $
 * @author KWProductions Co.
 * @(C) 2020-2025.Kian William Productions Co. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of system - jshoppingcollectitems.
    system - jshoppingcollectitems is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    plugin system - jshoppingcollectitems is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with system - jshoppingcollectitems.  If not, see <http://www.gnu.org/licenses/>.
 
**/

?>

<?php 
defined('_JEXEC') or die;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Date\Date;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Form\FormHelper;
use Joomla\String\StringHelper;
use Joomla\CMS\HTML\HTMLHelper;



class PlgSystemJshoppingcollectitems extends CMSPlugin
{
	
	protected $autoloadLanguage = true;
	protected $db;
	protected $app;
	
	public function onAfterInitialise()
	{
		$this->loadLanguage();
		
	}
	
	public function onBeforeRender()
	{
				if(Uri::getInstance()->getVar('view')=="wishlist" || Uri::getInstance()->getVar('controller')=="wishlist" || preg_match('/wishlist/', Uri::getInstance()->toString())){
		           
									$ss = Factory::getSession();
					
 
 if($ss->get('wishlist')!==null && count(unserialize($ss->get('wishlist'))->products)>0):
 			        $doc = Factory::getDocument();
$doc->addScript(Uri::Base().'plugins/system/jshoppingcollectitems/assets/js/carthelper.js');

 $addform =  "
	jQuery.noConflict();
	     jQuery(document).ready(function(){	
		
		jQuery.fn.CartHelper.defaults = {};	
	    jQuery.fn.CartHelper.defaults.fontfamily='".$this->params->get("font-family")."';
		jQuery.fn.CartHelper.defaults.fontsize='".$this->params->get("font-size")."';
		
				jQuery.fn.CartHelper.defaults.addmarginleft='".$this->params->get("addmarginleft")."';
		jQuery.fn.CartHelper.defaults.addmargintop='".$this->params->get("addmargintop")."';
		jQuery.fn.CartHelper.defaults.deletemarginleft='".$this->params->get("deletemarginleft")."';
		jQuery.fn.CartHelper.defaults.deletemargintop='".$this->params->get("deletemargintop")."';

		
		jQuery.fn.CartHelper.defaults.color='".$this->params->get("color")."';
		jQuery.fn.CartHelper.defaults.bkcolor='".$this->params->get("bkcolor")."';
	    jQuery.fn.CartHelper.defaults.fontweight='".$this->params->get("font-weight")."';
	    jQuery.fn.CartHelper.defaults.fontstyle='".$this->params->get("font-style")."';
	    jQuery.fn.CartHelper.defaults.uri='".Uri::Base()."';	

		  		jQuery('#comjshop').CartHelper.config({});

		 
		 });
			";

       
	   
       $doc->addScriptDeclaration($addform);	   

	endif;

				}		

	}
	
	
}
