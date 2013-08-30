<?php 
{{License}}
/**
 * Admin search model
 *
 * @category	{{Namespace}}
 * @package		{{Namespace}}_{{Module}}
 * {{qwertyuiop}}
 */
class {{Namespace}}_{{Module}}_Model_Adminhtml_Search_{{Entity}} extends Varien_Object{
	/**
	 * Load search results
	 * @access public
	 * @return {{Namespace}}_{{Module}}_Model_Adminhtml_Search_{{Entity}}
	 * {{qwertyuiop}}
	 */
	public function load(){
		$arr = array();
		if (!$this->hasStart() || !$this->hasLimit() || !$this->hasQuery()) {
			$this->setResults($arr);
			return $this;
		}
		$collection = Mage::getResourceModel('{{module}}/{{entity}}_collection')
			->addFieldToFilter('{{nameAttribute}}', array('like' => $this->getQuery().'%'))
			->setCurPage($this->getStart())
            ->setPageSize($this->getLimit())
			->load();
		foreach ($collection->getItems() as ${{entity}}) {
			$arr[] = array(
				'id'=> '{{entity}}/1/'.${{entity}}->getId(),
				'type'  => Mage::helper('{{module}}')->__('{{EntityLabel}}'),
				'name'  => ${{entity}}->get{{EntityNameMagicCode}}(),
				'description'   => ${{entity}}->get{{EntityNameMagicCode}}(),
				'url' => Mage::helper('adminhtml')->getUrl('*/{{module}}_{{entity}}/edit', array('id'=>${{entity}}->getId())),
			);
		}
		$this->setResults($arr);
		return $this;
	}
}