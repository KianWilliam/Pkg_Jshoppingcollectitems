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



	
		
class CartHelper
{
	public function AddToCart()
	{
		
						JLoader::registerAlias('JSHelper', 'Joomla\\Component\\Jshopping\\Site\\Helper\\Helper');
						JLoader::registerAlias('CartController', 'Joomla\\Component\\Jshopping\\Site\\Controller\\CartController');

						require_once JPATH_BASE . '/components/com_jshopping/bootstrap.php';

                        $cont = new CartController();


				JLoader::registerAlias('JSFactory', 'Joomla\\Component\\Jshopping\\Site\\Lib\\JSFactory');

			JLoader::registerAlias('CartModel', 'Joomla\\Component\\Jshopping\\Site\\Model\\CartModel');
					$input = Factory::getApplication()->input;
					$products = json_decode($_POST['products'], true);
	 $session = Factory::getSession();
	 $wl = unserialize($session->get('wishlist'));
   

    	$cart = new CartModel();
		
		$cartse = $session->get('cart');
		if($cartse!==null){
			$cartse = unserialize($cartse);
			$wl->products = array_merge($wl->products, $cartse->products);
	    	
		}
		
		
				$cart->products=$wl->products;

			
			
				$cart->saveToSession();
				$cart->init('cart');
				
						 
		
                  $cont->add();
				                  
	 $session->clear('wishlist');
	
	

	 $user = Factory::getUser();
  	  $app = Factory::getApplication();
				$tag = $app->getLanguage()->getTag();
				$language = substr($tag, 0, 2);
				
	  $idcookie=$app->input->cookie->get('jshopping_temp_cart');
	
	  
	  $db = Factory::getDbo();
	  $query = $db->getQuery(true);
	  $query->select($db->quoteName('value'))->from($db->quoteName('#__jshopping_configs'))->where($db->quoteName('key').'='.$db->quote('shop_user_guest'));
	  $db->setQuery($query);
	  $value = $db->loadObject();
	  
	  	  $query = $db->getQuery(true);
$conditions = array(
    $db->quoteName('id_cookie') . ' = ' . $db->quote($idcookie) 
);

$query->delete($db->quoteName('#__jshopping_cart_temp'));
$query->where($conditions);
	  $db->setQuery($query);
$db->execute();
unset($_COOKIE['jshopping_temp_cart']);
	 
	 
	 
	 $len = strlen(Uri::Base());
	 $lenb = strlen("/plugins/system/jshoppingcollectitems/");
	 $lena = $len-$lenb;
	 $baseurl = substr(Uri::Base(), 0, $lena);

	 if($user->id!=0 || $value->value==2)
	 {
		
		 		$app->redirect(Route::_($baseurl."/index.php?option=com_jshopping&view=checkout&Itemid=138&lang=".$language));
	 }
	 else
	 {		
 		 $app->redirect(Route::_($baseurl."/index.php?option=com_jshopping&controller=user&task=login&Itemid=137&lang=".$language));

	 }
	 
	}
}
$ch = new CartHelper();
$ch->AddToCart();
