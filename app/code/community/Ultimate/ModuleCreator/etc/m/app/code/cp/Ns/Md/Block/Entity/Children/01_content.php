<?php 
{{License}}
/**
 * {{EntityLabel}} children list block
 *
 * @category	{{Namespace}}
 * @package		{{Namespace}}_{{Module}}
 * {{qwertyuiop}}
 */
class {{Namespace}}_{{Module}}_Block_{{Entity}}_Children extends {{Namespace}}_{{Module}}_Block_{{Entity}}_List{
	/**
	 * prepare the layout
	 * @access protected
	 * @return {{Namespace}}_{{Module}}_Block_{{Entity}}_Children
	 * {{qwertyuiop}}
	 */
	protected function _prepareLayout(){
		$this->get{{Entities}}()->addFieldToFilter('parent_id', $this->getCurrent{{Entity}}()->getId());
		return $this;
	}
	/**
	 * ge the current {{entityLabel}}
	 * @access protected
	 * @return {{Namespace}}_{{Module}}_Model_{{Entity}}
	 * {{qwertyuiop}}
	 */
	public function getCurrent{{Entity}}(){
		return Mage::registry('current_{{module}}_{{entity}}');
	}
}