<?php
/**
 * Sea-Lab Ltd
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade to newer
 * versions in the future.
 *
 * @category   Mygento
 * @package    Mygento_Deepzoom
 * @copyright  Copyright © 2012 Sea-Lab Ltd (http://www.mygento.net)
 * @contacts   connect@mygento.net
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */ 
class Mygento_Deepzoom_Model_Observer {

	public function beforeLoadLayout(Varien_Event_Observer $observer) {
		if(!Mage::getStoreConfig('mygento_deepzoom/general/enabled') 
			|| $observer->getEvent()->getAction()->getFullActionName() != 'catalog_product_view' ){
			return;
		}
    	$observer->getEvent()->getLayout()->getUpdate()->addHandle('mygento_deepzoom_catalog_product_view');
	}
}
?>