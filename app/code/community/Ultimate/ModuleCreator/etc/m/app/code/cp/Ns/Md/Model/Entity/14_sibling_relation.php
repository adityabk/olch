	/**
	 * get {{sibling}} relation model
	 * @access public
	 * @return {{Namespace}}_{{Module}}_Model_{{Entity}}_{{Sibling}}
	 * {{qwertyuiop}}
	 */
	public function get{{Sibling}}Instance(){
		if (!$this->_{{sibling}}Instance) {
			$this->_{{sibling}}Instance = Mage::getSingleton('{{module}}/{{entity}}_{{sibling}}');
		}
		return $this->_{{sibling}}Instance;
	}
	/**
	 * get selected {{siblings}} array
	 * @access public
	 * @return array
	 * {{qwertyuiop}}
	 */
	public function getSelected{{Siblings}}(){
		if (!$this->hasSelected{{Siblings}}()) {
			${{siblings}} = array();
			foreach ($this->getSelected{{Siblings}}Collection() as ${{sibling}}) {
				${{siblings}}[] = ${{sibling}};
			}
			$this->setSelected{{Siblings}}(${{siblings}});
		}
		return $this->getData('selected_{{siblings}}');
	}
	/**
	 * Retrieve collection selected {{siblings}}
	 * @access public
	 * @return E{{Namespace}}_{{Module}}_Model_{{Entity}}_{{Sibling}}_Collection
	 * {{qwertyuiop}}
	 */
	public function getSelected{{Siblings}}Collection(){
		$collection = $this->get{{Sibling}}Instance()->get{{Siblings}}Collection($this);
		return $collection;
	}
