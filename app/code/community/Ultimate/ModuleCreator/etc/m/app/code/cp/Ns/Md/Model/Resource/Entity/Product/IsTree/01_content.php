<?php 
{{License}}
/**
 * {{EntityLabel}} - product relation model
 *
 * @category	{{Namespace}}
 * @package		{{Namespace}}_{{Module}}
 * {{qwertyuiop}}
 */
class {{Namespace}}_{{Module}}_Model_Resource_{{Entity}}_Product extends Mage_Core_Model_Resource_Db_Abstract{
	/**
	 * initialize resource model
	 * @access protected
	 * @return void
	 * @see Mage_Core_Model_Resource_Abstract::_construct()
	 * {{qwertyuiop}}
	 */
	protected function  _construct(){
		$this->_init('{{module}}/{{entity}}_product', 'rel_id');
	}
	/**
	 * Save {{entityLabel}} - product relations
	 * @access public
	 * @param {{Namespace}}_{{Module}}_Model_{{Entity}} ${{entity}}
	 * @param array $data
	 * @return {{Namespace}}_{{Module}}_Model_Resource_{{Entity}}_Product
	 * {{qwertyuiop}}
	 */
	public function save{{Entity}}Relation(${{entity}}, $data){
		if (!is_array($data)) {
			$data = array();
		}
		$deleteCondition = $this->_getWriteAdapter()->quoteInto('{{entity}}_id=?', ${{entity}}->getId());
		$this->_getWriteAdapter()->delete($this->getMainTable(), $deleteCondition);

		foreach ($data as $productId => $info) {
			$this->_getWriteAdapter()->insert($this->getMainTable(), array(
				'{{entity}}_id'  	=> ${{entity}}->getId(),
				'product_id' 	=> $productId,
				'position'  	=> @$info['position']
			));
		}
		return $this;
	}
	/**
	 * Save  product - {{entityLabel}} relations
	 * @access public
	 * @param Mage_Catalog_Model_Product $prooduct
	 * @param array $data
	 * @return {{Namespace}}_{{Module}}_Model_Resource_{{Entity}}_Product
	 * {{qwertyuiop}}
	 */
	public function saveProductRelation($product, ${{entity}}Ids){
		
		$old{{Entities}} = Mage::helper('{{module}}/product')->getSelected{{Entities}}($product);
		$old{{Entity}}Ids = array();
		foreach ($old{{Entities}} as ${{entity}}){
			$old{{Entity}}Ids[] = ${{entity}}->getId();
		}
		$insert = array_diff(${{entity}}Ids, $old{{Entity}}Ids);
		$delete = array_diff($old{{Entity}}Ids, ${{entity}}Ids);
		$write = $this->_getWriteAdapter();
		if (!empty($insert)) {
			$data = array();
			foreach ($insert as ${{entity}}Id) {
				if (empty(${{entity}}Id)) {
					continue;
				}
				$data[] = array(
					'{{entity}}_id' => (int)${{entity}}Id,
					'product_id'  => (int)$product->getId(),
					'position'=> 1
				);
			}
			if ($data) {
				$write->insertMultiple($this->getMainTable(), $data);
			}
		}
		if (!empty($delete)) {
			foreach ($delete as ${{entity}}Id) {
				$where = array(
					'product_id = ?'  => (int)$product->getId(),
					'{{entity}}_id = ?' => (int)${{entity}}Id,
				);
				$write->delete($this->getMainTable(), $where);
			}
		}
		return $this;
	}
}