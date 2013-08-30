	/**
	 * get products json
	 * @access public
	 * @return string
	 * {{qwertyuiop}}
	 */
	public function getProductsJson(){
		$products = $this->get{{Entity}}()->getSelectedProducts();
		if (!empty($products)) {
			$positions = array();
				foreach ($products as $product){
					$positions[$product->getId()] = $product->getPosition();
				}
			return Mage::helper('core')->jsonEncode($positions);
		}
		return '{}';
	}
