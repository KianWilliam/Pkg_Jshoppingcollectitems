<?php 

/**
 * @package Plugin user - multilanglogj4 for Joomla! 3.x & j4.x
 * @version $Id: user - multi language login  1.0.0 2022-06-10 23:26:33Z $
 * @author KWProductions Co.
 * @copyright (C) 2020- KWProductions Co.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of user - multilanglogj4.
    user - multilanglogj4 is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    It is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with it.  If not, see <http://www.gnu.org/licenses/>.
 
**/


?>
<?php
defined('_JEXEC') or die;
use Joomla\CMS\User\User;
use Joomla\CMS\User\UserHelper;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Factory;
class PlgUserDeleteItemsUserLogout extends CMSPlugin
{		
	protected $autoloadLanguage = true;
		protected $app;


    public function onAfterInitialise()
	{
		
		$this->loadLanguage();
	}
	public function onUserLogout($credentials = [], $options=[])
	{
			 $session = Factory::getSession();
	         $session->clear('wishlist');

		      $app =  Factory::getApplication();
			  $idcookie=$app->input->cookie->get('jshopping_temp_cart');
			  $db = Factory::getDbo();
	          $query = $db->getQuery(true);
              $conditions = array(
                  $db->quoteName('id_cookie') . ' = ' . $db->quote($idcookie) 
              );

             $query->delete($db->quoteName('#__jshopping_cart_temp'));
             $query->where($conditions);
	         $db->setQuery($query);
             $db->execute();
             unset($_COOKIE['jshopping_temp_cart']);

			return true;
	}
		


	
		



}
