<?php
{{License}}
/**
 * {{EntityLabel}} {{SiblingsLabel}} list block 
 *
 * @category	{{Namespace}}
 * @package		{{Namespace}}_{{Module}}
 * {{qwertyuiop}}
 */
class {{Namespace}}_{{Module}}_Block_{{Entity}}_{{Sibling}}_List extends {{Namespace}}_{{Module}}_Block_{{Sibling}}_List{
	/**
	 * initialize
	 * @access public
	 * @return void
	 * {{qwertyuiop}}
	 */
 	public function __construct(){
		parent::__construct();
		${{entity}} = $this->get{{Entity}}();
		if (${{entity}}){
			$this->get{{Siblings}}()->addFilter('{{entity}}_id', ${{entity}}->getId());
		}
	}
	/**
	 * prepare the layout - actually do nothing
	 * @access protected
	 * @return {{Namespace}}_{{Module}}_Block_{{Entity}}_{{Sibling}}_List
	 * {{qwertyuiop}}
	 */
	protected function _prepareLayout(){
		return $this;
	}
	/**
	 * get the current {{entity}}
	 * @access public
	 * @return {{Namespace}}_{{Module}}_Model_{{Entity}}
	 * {{qwertyuiop}}
	 */
	public function get{{Entity}}(){
		return Mage::registry('current_{{module}}_{{entity}}');
	}
}
