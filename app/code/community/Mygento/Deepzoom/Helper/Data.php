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
 * @copyright  Copyright (c) 2012 Sea-Lab Ltd (http://www.mygento.net)
 * @contacts   connect@mygento.net
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
 
class Mygento_Deepzoom_Helper_Data extends Mage_Core_Helper_Abstract
{

	public function isEnabled()
    {
        return Mage::getStoreConfig('mygento_deepzoom/general/enabled');
    }
    
	public function newImage($source,$destination) {
		if (!Mage::getStoreConfig('mygento_deepzoom/general/enabled')) {
    		Mage::helper('mygento_deepzoom')->AddLog('DeepZoom Module disabled');
	        return;
	    }
	    if(is_file($source)){
        	if(!is_file($destination)) {
        		Mage::helper('mygento_deepzoom')->AddLog('Creating from '.$source.'-->'.$destination);
	        	$deep = new Oz_Deepzoom_ImageCreator();
	        	$deep->create($source,$destination);
	        	if(is_file($destination)) {
	        		return true;	
	        	}
        	}
        	else
        	{
        		Mage::helper('mygento_deepzoom')->AddLog("No destination file ".$destinations);
	        	return true;
        	}	
        }
        return false;
	}
	public function AddLog($text)
	{
		if(Mage::getStoreConfig('mygento_deepzoom/general/debug'))
		{
			Mage::log('Mygento_Deepzoom: '.$text);
		}
	}
	public function delImage($source)
	{
		if (!Mage::getStoreConfig('mygento_deepzoom/general/enabled')) {
    		Mage::helper('mygento_deepzoom')->AddLog('Module disabled');
	        return;
	    }
	    $aImage = pathinfo($source.'.dzi');
        $imageName = $aImage['filename'];
        $dirName = $aImage['dirname'];
		Varien_Io_File::rmdirRecursive($dirName.DS.$imageName.'_files');
		@unlink($source.'.dzi');
		@unlink($source);
	}
	
	public function loadImage($image)
	{
		if (!Mage::getStoreConfig('mygento_deepzoom/general/enabled')) {
    		Mage::helper('mygento_deepzoom')->AddLog('DeepZoom Module disabled');
	        return;
	    }
	    if (Mage::getStoreConfig('mygento_deepzoom/general/autogenerate')) {
	        if(!is_file(Mage::getBaseDir('media').'/catalog/product/deepzoom'.$image.'.dzi'))
	        {
	        	Mage::helper('mygento_deepzoom')->AddLog('Deepzoom File Not Found');
	        	Mage::helper('mygento_deepzoom')->AddLog('AutoGenerate from '.Mage::getBaseDir('media').'/catalog/product/deepzoom'.$image);
	        	$this->newImage(
	        		Mage::getBaseDir('media').'/catalog/product/'.$image,
	        		Mage::getBaseDir('media').'/catalog/product/deepzoom'.$image.'.dzi'
	        		);
	        }
        }
	    return Mage::app()->getStore()->getBaseUrl('media').'catalog/product/deepzoom'.$image.'.dzi';
	    
	}
}
?>