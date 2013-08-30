<?php

class Mygento_Deepzoom_Block_Version 
extends Mage_Adminhtml_Block_Abstract 
implements Varien_Data_Form_Element_Renderer_Interface {

    public function render(Varien_Data_Form_Element_Abstract $element) {
        $info = '<fieldset class="config">
            ' . $this->__('Mygento Deepzoom version: %s', Mage::getConfig()->getNode('modules/Mygento_Deepzoom/version')) . 
        	
        	'</fieldset>';
        return $info;
    }

}
