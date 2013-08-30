	/**
	 * {{enititiesLabel}} json action
	 * @access public
	 * @return void
	 * {{qwertyuiop}}
	 */
	public function {{entities}}JsonAction(){
		if ($faqcatsId = (int) $this->getRequest()->getPost('id')) {
			$faqcat = Mage::getModel('{{module}}/{{entity}}')->load(${{entity}}Id);
			if (${{entity}}->getId()) {
				Mage::register('{{entity}}', ${{entity}});
				Mage::register('current_{{entity}}', ${{entity}});
			}
			$this->getResponse()->setBody(
				$this->_get{{Entity}}TreeBlock()->getTreeJson(${{entity}})
			);
		}
	}
	/**
	 * get {{entity}} tree block
	 * @access protected
	 * @return {{Namespace}}_{{Module}}_Block_Adminhtml_{{Entity}}_Widget_Chooser
	 * {{qwertyuiop}}
	 */
	protected function _get{{Entity}}TreeBlock(){
		return $this->getLayout()->createBlock('{{module}}/adminhtml_{{entity}}_widget_chooser', '', array(
			'id' => $this->getRequest()->getParam('uniq_id'),
			'use_massaction' => $this->getRequest()->getParam('use_massaction', false)
		));
	}
