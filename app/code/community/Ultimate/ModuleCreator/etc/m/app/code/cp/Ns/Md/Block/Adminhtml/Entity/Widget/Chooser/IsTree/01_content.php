<?php
{{License}}

/**
 * {{EntityLavel}} chooser for Wysiwyg CMS widget
 *
 * @category   {{Namespace}}
 * @package{{Namespace}}_{{Module}}
 * {{qwertyuiop}}
 */
class {{Namespace}}_{{Module}}_Block_Adminhtml_{{Entity}}_Widget_Chooser extends {{Namespace}}_{{Module}}_Block_Adminhtml_{{Entity}}_Tree{
	protected $_selected{{Entities}} = array();
	/**
	 * Block construction
	 * Defines tree template and init tree params
	 * @access public
	 * @return void
	 * {{qwertyuiop}}
	 */
	public function __construct(){
		parent::__construct();
		$this->setTemplate('{{namespace}}_{{module}}/{{entity}}/widget/tree.phtml');
	}
	/**
	 * Setter
	 * @access public
	 * @param array $selected{{Entities}}
	 * @return {{Namespace}}_{{Module}}_Block_Adminhtml_{{Entity}}_Widget_Chooser
	 * {{qwertyuiop}}
	 */
	public function setSelected{{Entities}}($selected{{Entities}}){
		$this->_selected{{Entities}} = $selected{{Entities}};
		return $this;
	}
	/**
	 * Getter
	 * @access public
	 * @return array
	 * {{qwertyuiop}}
	 */
	public function getSelected{{Entities}}(){
		return $this->_selected{{Entities}};
	}
	/**
	 * Prepare chooser element HTML
	 * @access public
	 * @param Varien_Data_Form_Element_Abstract $element Form Element
	 * @return Varien_Data_Form_Element_Abstract
	 * {{qwertyuiop}}
	 */
	public function prepareElementHtml(Varien_Data_Form_Element_Abstract $element){
		$uniqId = Mage::helper('core')->uniqHash($element->getId());
		$sourceUrl = $this->getUrl('*/{{module}}_{{entity}}_widget/chooser', array('uniq_id' => $uniqId, 'use_massaction' => false));		
		$chooser = $this->getLayout()->createBlock('widget/adminhtml_widget_chooser')
			->setElement($element)
			->setTranslationHelper($this->getTranslationHelper())
			->setConfig($this->getConfig())
			->setFieldsetId($this->getFieldsetId())
			->setSourceUrl($sourceUrl)
			->setUniqId($uniqId);
		$value = $element->getValue();
		${{entity}}Id = false;
		if ($value) {
			${{entity}}Id = $value;
		}
		if (${{entity}}Id) {
			$label = Mage::getSingleton('{{module}}/{{entity}}')->load(${{entity}}Id)->get{{EntityNameMagicCode}}();
			$chooser->setLabel($label);
		}
		$element->setData('after_element_html', $chooser->toHtml());
		return $element;
	}
	/**
	 * onClick listener js function
	 * @access public
	 * @return string
	 * {{qwertyuiop}}
	 */
	public function getNodeClickListener(){
		if ($this->getData('node_click_listener')) {
			return $this->getData('node_click_listener');
		}
		if ($this->getUseMassaction()) {
			$js = '
				function (node, e) {
					if (node.ui.toggleCheck) {
						node.ui.toggleCheck(true);
					}
				}
			';
		} 
		else {
			$chooserJsObject = $this->getId();
			$js = '
				function (node, e) {
					'.$chooserJsObject.'.setElementValue(node.attributes.id);
					'.$chooserJsObject.'.setElementLabel(node.text);
					'.$chooserJsObject.'.close();
				}
			';
		}
		return $js;
	}

	/**
	 * Get JSON of a tree node or an associative array
	 * @access protected
	 * @param Varien_Data_Tree_Node|array $node
	 * @param int $level
	 * @return string
	 * {{qwertyuiop}}
	 */
	protected function _getNodeJson($node, $level = 0){
		$item = parent::_getNodeJson($node, $level);
		if (in_array($node->getId(), $this->getSelected{{Entities}}())) {
			$item['checked'] = true;
		}
		return $item;
	}

	/**
	 * Tree JSON source URL
	 * @access public
	 * @param mixed $expanded
 	 * @return string
	 * {{qwertyuiop}}
	 */
	public function getLoadTreeUrl($expanded=null){
		return $this->getUrl('*/{{module}}_{{entity}}_widget/{{entities}}Json', array(
			'_current'=>true,
			'uniq_id' => $this->getId(),
			'use_massaction' => $this->getUseMassaction()
		));
	}
}
