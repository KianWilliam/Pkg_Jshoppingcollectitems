<?php
define('_JEXEC', 1);   

define('JPATH_BASE', realpath(dirname(__FILE__) . '/../../..'));
define('JPATH_COMPONENT', JPATH_BASE.'/components');

require_once JPATH_BASE . '/includes/defines.php';
require_once JPATH_BASE . '/includes/framework.php';
require_once JPATH_BASE . '/includes/app.php';

defined('_JEXEC') or die;


use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\Session\Session;

use Joomla\CMS\HTML\HTMLHelper;

	 $app = Factory::getApplication();
	  $idcookie=$app->input->cookie->get('jshopping_temp_cart');


$sess = Factory::getSession();
$sess->clear('wishlist');

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
 

	 	$tag = $app->getLanguage()->getTag();
				$language = substr($tag, 0, 2);
	 $len = strlen(Uri::Base());
	 $lenb = strlen("/plugins/system/jshoppingcollectitems/");
	 $lena = $len-$lenb;
	 $baseurl = substr(Uri::Base(), 0, $lena);
	 $app->redirect(Route::_($baseurl."/index.php?option=com_jshopping&controller=wishlist&Itemid=139&lang=".$language));


