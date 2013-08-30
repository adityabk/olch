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

class Mygento_Deepzoom_Block_Adminhtml_Cache_Additional extends Mage_Adminhtml_Block_Template
{

	public function canShowButton()
    {
        return Mage::helper('mygento_deepzoom')->isEnabled();
    }
    
    public function getCleanCacheUrl()
    {
        return $this->getUrl('*/deepzoomCache/clean');
    }
}