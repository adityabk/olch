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
 * @copyright  Copyright © 2011 Sea-Lab Ltd (http://www.mygento.ru)
 * @contacts   connect@mygento.ru
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */ 

class Mygento_Deepzoom_Model_Media extends Mage_Catalog_Model_Product_Attribute_Backend_Media 
{
	
	public function afterSave($object){ 
    	parent::afterSave($object);
    	Mage::helper('mygento_deepzoom')->AddLog('Start of deepzoom');
    	//Mage::log(Mage::getStoreConfig('catalog/mygentodeepzoom/is_enable'));
    	if (!Mage::getStoreConfig('mygento_deepzoom/general/enabled')) {
    		Mage::helper('mygento_deepzoom')->AddLog('Module disabled');
	        return;
	    }
	    Mage::helper('mygento_deepzoom')->AddLog('Module is Enabled');
	    if ($object->getIsDuplicate() == true) {
	    	Mage::helper('mygento_deepzoom')->AddLog('Duplicate');
            $this->duplicate($object);
            return;
        }
	    $attrCode = $this->getAttribute()->getAttributeCode();
        $value = $object->getData($attrCode);
        if (!is_array($value) || !isset($value['images']) || $object->isLockedAttribute($attrCode)) {
        	$error='Invalid or empty image';
        	Mage::helper('mygento_deepzoom')->AddLog($error);
        	//Mage::throwException($error);
            return;
        }
        foreach ($value['images'] as &$image) {
	        if(!empty($image['removed'])) {
                //need to delete image here
                Mage::helper('mygento_deepzoom')->delImage(Mage::getBaseDir('media').'/catalog/product/deepzoom/'.$image['file']); 
        		continue;
            }
	        $source=Mage::getBaseDir('media').'/catalog/product/'.$image['file'];
	        $destination = Mage::getBaseDir('media').'/catalog/product/deepzoom'.$image['file'].'.dzi';
	        Mage::helper('mygento_deepzoom')->newImage($source,$destination);     	
		}
		Mage::helper('mygento_deepzoom')->AddLog('end of deepzoom');
	}
}
?>