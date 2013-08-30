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
 
class Mygento_Deepzoom_Adminhtml_DeepzoomCacheController extends Mage_Adminhtml_Controller_Action
{

	protected function _getSession()
    {
        return Mage::getSingleton('adminhtml/session');
    }
    
	public function cleanAction()
	{
		$files = glob(Mage::getBaseDir('media').DS.'catalog'.DS.'product'.DS.'deepzoom'.DS.'*');
		foreach($files as $folder)
		{
        	 $io = new Varien_Io_File();
       		 $io->rmdir($folder, true);
       		 Mage::helper('mygento_deepzoom')->AddLog($folder.' was Deleted');
		}
		
		$this->_getSession()->addSuccess(
            Mage::helper('adminhtml')->__('The Deepzoom image cache was cleaned.')
        );
        $this->_redirect('*/cache/index');
	}
}
