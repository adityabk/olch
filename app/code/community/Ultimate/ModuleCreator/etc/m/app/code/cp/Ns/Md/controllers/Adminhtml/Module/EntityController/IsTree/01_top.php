<?php
{{License}}
/**
 * {{EntityLabel}} admin controller
 *
 * @category	{{Namespace}}
 * @package		{{Namespace}}_{{Module}}
 * {{qwertyuiop}}
 */
class {{Namespace}}_{{Module}}_Adminhtml_{{Module}}_{{Entity}}Controller extends {{Namespace}}_{{Module}}_Controller_Adminhtml_{{Module}}{
	/**
	 * init {{entityLabel}}
	 * @access protected
	 * @return {{Namespace}}_{{Module}}_Model_{{Entity}}
	 * {{qwertyuiop}}
	 */
	protected function _init{{Entity}}(){
		${{entity}}Id = (int) $this->getRequest()->getParam('id',false);
		${{entity}} = Mage::getModel('{{module}}/{{entity}}');
		if (${{entity}}Id) {
			${{entity}}->load(${{entity}}Id);
		}
		if ($activeTabId = (string) $this->getRequest()->getParam('active_tab_id')) {
			Mage::getSingleton('admin/session')->setActiveTabId($activeTabId);
		}
		Mage::register('{{entity}}', ${{entity}});
		Mage::register('current_{{entity}}', ${{entity}});
		return ${{entity}};
	}
	/**
	 * default action
	 * @access public
	 * @return void
	 * {{qwertyuiop}}
	 */
	public function indexAction(){
		$this->_forward('edit');
	}

	/**
	 * Add new {{entityLabel}} form
	 * @access public
	 * @return void
	 * {{qwertyuiop}}
	 */
	public function addAction(){
		Mage::getSingleton('admin/session')->unsActiveTabId();
		$this->_forward('edit');
	}
	/**
	 * Edit {{entityLabel}} page
	 * @access public
	 * @return void
	 * {{qwertyuiop}}
	 */
	public function editAction(){
		$params['_current'] = true;
		$redirect = false;
		$parentId = (int) $this->getRequest()->getParam('parent');
		${{entity}}Id = (int) $this->getRequest()->getParam('id');
		$_prev{{Entity}}Id = Mage::getSingleton('admin/session')->getLastEdited{{Entity}}(true);
		if ($_prev{{Entity}}Id && !$this->getRequest()->getQuery('isAjax') && !$this->getRequest()->getParam('clear')) {
			$this->getRequest()->setParam('id',$_prev{{Entity}}Id);
		}
		if ($redirect) {
			$this->_redirect('*/*/edit', $params);
			return;
		}
		if (!(${{entity}} = $this->_init{{Entity}}())) {
			return;
		}
		$this->_title(${{entity}}Id ? ${{entity}}->get{{EntityNameMagicCode}}() : $this->__('New {{EntityLabel}}'));
		$data = Mage::getSingleton('adminhtml/session')->get{{Entity}}Data(true);
		if (isset($data['{{entity}}'])) {
			${{entity}}->addData($data['{{entity}}']);
		}
		if ($this->getRequest()->getQuery('isAjax')) {
			$breadcrumbsPath = ${{entity}}->getPath();
			if (empty($breadcrumbsPath)) {
				$breadcrumbsPath = Mage::getSingleton('admin/session')->getDeletedPath(true);
				if (!empty($breadcrumbsPath)) {
					$breadcrumbsPath = explode('/', $breadcrumbsPath);
					if (count($breadcrumbsPath) <= 1) {
						$breadcrumbsPath = '';
					}
					else {
						array_pop($breadcrumbsPath);
						$breadcrumbsPath = implode('/', $breadcrumbsPath);
					}
				}
			}
			Mage::getSingleton('admin/session')->setLastEdited{{Entity}}(${{entity}}->getId());
			$this->loadLayout();			
			$eventResponse = new Varien_Object(array(
				'content' => $this->getLayout()->getBlock('{{entity}}.edit')->getFormHtml(). $this->getLayout()->getBlock('{{entity}}.tree')->getBreadcrumbsJavascript($breadcrumbsPath, 'editing{{Entity}}Breadcrumbs'),
				'messages' => $this->getLayout()->getMessagesBlock()->getGroupedHtml(),
			));
			$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($eventResponse->getData()));			
			return;
		}
		$this->loadLayout();
		$this->_setActiveMenu('{{module}}/{{entity}}');
		$this->getLayout()->getBlock('head')->setCanLoadExtJs(true)
			->setContainerCssClass('{{entity}}');
		
		$this->_addBreadcrumb(
			Mage::helper('{{module}}')->__('Manage {{EntitiesLabel}}'),
			Mage::helper('{{module}}')->__('Manage {{EntitiesLabel}}')
		);
		if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
			$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
		}
		$this->renderLayout();
	}
	/**
	 * Get tree node (Ajax version)
	 * @access public
	 * @return void
	 * {{qwertyuiop}}
	 */
	public function {{entities}}JsonAction(){
		if ($this->getRequest()->getParam('expand_all')) {
			Mage::getSingleton('admin/session')->set{{Entity}}IsTreeWasExpanded(true);
		} 
		else {
			Mage::getSingleton('admin/session')->set{{Entity}}IsTreeWasExpanded(false);
		}
		if (${{entity}}Id = (int) $this->getRequest()->getPost('id')) {
			$this->getRequest()->setParam('id', ${{entity}}Id);
			if (!${{entity}} = $this->_init{{Entity}}()) {
				return;
			}
			$this->getResponse()->setBody(
				$this->getLayout()->createBlock('{{module}}/adminhtml_{{entity}}_tree')->getTreeJson(${{entity}})
			);
		}
	}
	/**
	 * Move {{entityLabel}} action
	 */
	public function moveAction(){
		${{entity}} = $this->_init{{Entity}}();
		if (!${{entity}}) {
			$this->getResponse()->setBody(Mage::helper('{{module}}')->__('{{EntityLabel}} move error'));
			return;
		}
		$parentNodeId   = $this->getRequest()->getPost('pid', false);
		$prevNodeId = $this->getRequest()->getPost('aid', false);
		try {
			${{entity}}->move($parentNodeId, $prevNodeId);
			$this->getResponse()->setBody("SUCCESS");
		}
		catch (Mage_Core_Exception $e) {
			$this->getResponse()->setBody($e->getMessage());
		}
		catch (Exception $e){
			$this->getResponse()->setBody(Mage::helper('{{module}}')->__('{{EntityLabel}} move error'));
			Mage::logException($e);
		}
	}
	/**
	 * Tree Action
	 * Retrieve {{entityLabel}} tree
	 * @access public
	 * @return void
	 * {{qwertyuiop}}
	 */
	public function treeAction(){
		${{entity}}Id = (int) $this->getRequest()->getParam('id');
		${{entity}} = $this->_init{{Entity}}();
		$block = $this->getLayout()->createBlock('{{module}}/adminhtml_{{entity}}_tree');
		$root  = $block->getRoot();
		$this->getResponse()->setBody(Mage::helper('core')->jsonEncode(
			array(
				'data' => $block->getTree(),
				'parameters' => array(
					'text'=> $block->buildNodeName($root),
					'draggable'   => false,
					'allowDrop'   => ($root->getIsVisible()) ? true : false,
					'id'  => (int) $root->getId(),
					'expanded'=> (int) $block->getIsWasExpanded(),
					'{{entity}}_id' => (int) ${{entity}}->getId(),
					'root_visible'=> (int) $root->getIsVisible()
				)
			)
		));
	}
	/**
	 * Build response for refresh input element 'path' in form
	 * @access public
	 * @return void
	 * {{qwertyuiop}}
	 */
	public function refreshPathAction(){
		if ($id = (int) $this->getRequest()->getParam('id')) {
			${{entity}} = Mage::getModel('{{module}}/{{entity}}')->load($id);
			$this->getResponse()->setBody(
				Mage::helper('core')->jsonEncode(array(
				   'id' => $id,
				   'path' => ${{entity}}->getPath(),
				))
			);
		}
	}
	/**
	 * Delete {{entityLabel}} action
	 * @access public
	 * @return void
	 * {{qwertyuiop}}
	 */
	public function deleteAction(){
		if ($id = (int) $this->getRequest()->getParam('id')) {
			try {
				${{entity}} = Mage::getModel('{{module}}/{{entity}}')->load($id);
				Mage::getSingleton('admin/session')->setDeletedPath(${{entity}}->getPath());
				
				${{entity}}->delete();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('{{module}}')->__('The {{entityLabel}} has been deleted.'));
			}
			catch (Mage_Core_Exception $e){
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->getResponse()->setRedirect($this->getUrl('*/*/edit', array('_current'=>true)));
				return;
			}
			catch (Exception $e){
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('{{module}}')->__('An error occurred while trying to delete the {{entityLabel}}.'));
				$this->getResponse()->setRedirect($this->getUrl('*/*/edit', array('_current'=>true)));
				Mage::logException($e);
				return;
			}
		}
		$this->getResponse()->setRedirect($this->getUrl('*/*/', array('_current'=>true, 'id'=>null)));
	}
	/**
	 * Check if admin has permissions to visit related pages
	 * @access protected
	 * @return boolean
	 * {{qwertyuiop}}
	 */
	protected function _isAllowed(){
		return Mage::getSingleton('admin/session')->isAllowed('{{module}}/{{entity}}');
	}